document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("token");

    // 如果冇 token 或者已過期 → 強制登出
    if (!token || JwtHelper.isExpired(token)) {
        JwtHelper.logout();
        return;
    }
    // 顯示角色 (Admin/User)
    const role = JwtHelper.getRole(token);
    document.getElementById("currentUsername").textContent = role || "User";
    if (role === "Admin") { 
        document.getElementById("usersMenu").style.display = "block"; 
        document.getElementById("sendMenu").style.display = "block";
    }
}); 

let currentUserId = null;
const API_BASE_URL = 'http://localhost/hgkdb/cms/api';

// 頁面載入時取得用戶列表
$(document).ready(function() {                
    console.log('Page loaded, starting initialization');                
    loadUsers();
});            

// 初始化 DataTable
function initializeDataTable() {
    try {
        $('#usersTable').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.5/i18n/zh-HANT.json'
            },
            destroy: true,
            pageLength: 10,
            order: [[0, 'asc']]
        });
    } catch (error) {
        console.error('DataTable initialization failed:', error);
    }
}

// 載入用戶列表 (GET all)
function loadUsers() {
    const token = localStorage.getItem("token");
    if (!token) {
        alert("No token found. Please login first.");
        return;
    }

    fetch(`${API_BASE_URL}/users.php`, {
        method: "GET",
        headers: { "Authorization": "Bearer " + token }
    })
    .then(res => res.json())
    .then(json => {
        if (json.status === "success") {
            displayUsers(json.data);
        } else {
            alert("Failed to load user data: " + json.message);
        }
    })
    .catch(error => {
        console.error("Failed to load user data:", error);
        alert("Failed to load user data: " + error.message);
    });
}

// 顯示用戶列表
function displayUsers(users) {
    const tbody = document.getElementById('usersTableBody');
    tbody.innerHTML = '';

    users.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.uID || ''}</td>
            <td>${user.uName || ''}</td>
            <td><span class="label label-${user.uRole === 'Admin' ? 'danger' : 'info'}">${user.uRole || ''}</span></td>
            <td>${user.uUsername || ''}</td>
            <td>
                <button class="btn btn-sm btn-info" onclick="editUser('${user.uID}')">
                    <i class="fa fa-edit"></i> 修改
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser('${user.uID}')">
                    <i class="fa fa-trash"></i> 删除
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });

    try {
        if ($.fn.DataTable.isDataTable('#usersTable')) {
            $('#usersTable').DataTable().destroy();
        }
        initializeDataTable();
    } catch (error) {
        console.error('DataTable 處理失敗:', error);
    }
}

// 新增用戶 (POST)
function addUser() {
    const form = document.getElementById('addUserForm');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    const token = localStorage.getItem("token");

    fetch(`${API_BASE_URL}/users.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(json => {
        if (json.status === "success") {
            alert('增加成功');
            $('#addUserModal').modal('hide');
            form.reset();
            loadUsers();
        } else {
            alert('增加失敗: ' + json.message);
        }
    })
    .catch(error => {
        console.error('增加用戶失敗:', error);
        alert('增加用戶失敗');
    });
}

// 編輯用戶 (GET by ID)
function editUser(userId) {
    currentUserId = userId;
    const token = localStorage.getItem("token");

    fetch(`${API_BASE_URL}/users.php?id=${userId}`, {
        method: "GET",
        headers: { "Authorization": "Bearer " + token }
    })
    .then(res => res.json())
    .then(json => {
        if (json.status === "success") {
            const user = json.data[0];
            /* document.getElementById('edit_uID').value = user.uID; */
            document.getElementById('edituName').value = user.uName;
            document.getElementById('edituRole').value = user.uRole || 'User';
            document.getElementById('edituUsername').value = user.uUsername || '';        
            document.getElementById('edituPassword').value = ''; // 密碼唔顯示
            $('#editUserModal').modal('show');
        } else {
            alert('失敗取得用戶資料: ' + json.message);
        }
    })
    .catch(error => {
        console.error('失敗取得用戶資料:', error);
        alert('失敗取得用戶資料');
    });
}

// 更新用戶 (PUT)
function updateUser() {
    if (!currentUserId) return;

    const form = document.getElementById('editUserForm');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    if (!data.uPassword) delete data.uPassword;

    const token = localStorage.getItem("token");

    fetch(`${API_BASE_URL}/users.php?id=${currentUserId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(json => {
        if (json.status === "success") {
            alert('更新成功');
            $('#editUserModal').modal('hide');
            loadUsers();
        } else {
            alert('更新失敗: ' + json.message);
        }
    })
    .catch(error => {
        console.error('更新用戶失敗:', error);
        alert('更新用戶失敗');
    });
}

// 刪除用戶 (DELETE)
function deleteUser(userId) {
    if (confirm('是否確定删除用戶?')) {
        const token = localStorage.getItem("token");

        fetch(`${API_BASE_URL}/users.php?id=${userId}`, {
            method: 'DELETE',
            headers: { "Authorization": "Bearer " + token }
        })
        .then(res => res.json())
        .then(json => {
            if (json.status === "success") {
                alert('删除成功');
                loadUsers();
            } else {
                alert('删除失敗: ' + json.message);
            }
        })
        .catch(error => {
            console.error('删除用戶失敗:', error);
            alert('删除用戶失敗');
        });
    }
}
