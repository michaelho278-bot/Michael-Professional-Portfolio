import { ProductImageService } from '../../services/ProductImageService.js'; 
 

document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("token");

    if (!token || JwtHelper.isExpired(token)) {
        JwtHelper.logout();
        return;
    }

    const role = JwtHelper.getRole(token);
    document.getElementById("currentUsername").textContent = role || "User";
    if (role === "Admin") { 
        document.getElementById("usersMenu").style.display = "block"; 
        document.getElementById("sendMenu").style.display = "block";
    }
});

let currentProductId = null;
const API_BASE_URL = 'http://localhost/hgkdb/cms/api';
const imageService = new ProductImageService(API_BASE_URL);

// 頁面載入時取得產品列表
$(document).ready(function() {                
    console.log('Page loaded, starting initialization');                
    loadProducts();
});            

// 初始化 DataTable
function initializeProductTable() {
    try {
        $('#productsTable').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.5/i18n/zh-HANT.json'
            },
            destroy: true,
            pageLength: 10,
            order: [[0, 'asc']],
            columns: [
                { data: pID }, // pID
                { data: pCate }, // pCate
                { data: pName }, // pName
                { data: pDescription }, // pDescription
                { data: pSpec }, // pSpec
                { data: pImage }, // pImage
                { data: pPrice }, // pPrice
                { data: pStock }, // pStock
                { data: null }  // Actions (buttons)
            ]
        });
    } catch (error) {
        console.error('DataTable initialization failed:', error);
    }
}

// 載入產品列表 (GET all)
function loadProducts() {
    const token = localStorage.getItem("token");
    if (!token) {
        alert("No token found. Please login first.");
        return;
    }

    fetch(`${API_BASE_URL}/products.php`, {
        method: "GET",
        headers: { "Authorization": "Bearer " + token }
    })
    .then(res => res.json())
    .then(json => {
        if (json.status === "success") {
            displayProducts(json.data);
        } else {
            alert("Failed to load product data: " + json.message);
        }
    })
    .catch(error => {
        console.error("Failed to load product data:", error);
        alert("Failed to load product data: " + error.message);
    });
}

// 顯示產品列表
function displayProducts(products) {
    const tbody = document.getElementById('productsTableBody');
    tbody.innerHTML = '';

    products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.pID || ''}</td>
            <td>${product.pCate || ''}</td>
            <td>${product.pName || ''}</td>
            <td>${product.pDescription || ''}</td>
            <td>${product.pSpec || ''}</td>
            <img src="/hgkdb${product.pImage}" width="80">
            <td>${product.pPrice || ''}</td>
            <td>${product.pStock || ''}</td>
            <td>
                <button class="btn btn-sm btn-info" onclick="editProduct('${product.pID}')">
                    <i class="fa fa-edit"></i> 修改
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteProduct('${product.pID}')">
                    <i class="fa fa-trash"></i> 删除
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });

    try {
        if ($.fn.DataTable.isDataTable('#productsTable')) {
            $('#productsTable').DataTable().destroy();
        }
        initializeProductTable();
    } catch (error) {
        console.error('DataTable 處理失敗:', error);
    }
}

// 新增產品 (POST)
function addProduct() {
    const form = document.getElementById('addProductForm');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    const token = localStorage.getItem("token");

    fetch(`${API_BASE_URL}/products.php`, {
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
            $('#addProductModal').modal('hide');
            form.reset();
            loadProducts();
        } else {
            alert('增加失敗: ' + json.message);
        }
    })
    .catch(error => {
        console.error('增加產品失敗:', error);
        alert('增加產品失敗');
    });
}window.addProduct = addProduct;

// 編輯產品 (GET by ID)
function editProduct(productId) {
    currentProductId = productId;
    const token = localStorage.getItem("token");

    fetch(`${API_BASE_URL}/products.php?id=${productId}`, {
        method: "GET",
        headers: { "Authorization": "Bearer " + token }
    })
    .then(res => res.json())
    .then(json => {
        if (json.status === "success") {
            const product = json.data[0];
            document.getElementById('editpCate').value = product.pCate;
            document.getElementById('editpName').value = product.pName;
            document.getElementById('editpDescription').value = product.pDescription;
            document.getElementById('editpSpec').value = product.pSpec;
            /* document.getElementById('editpImage').value = product.pImage; */
            document.getElementById('editpPrice').value = product.pPrice;
            document.getElementById('editpStock').value = product.pStock;
            $('#editProductModal').modal('show');
        } else {
            alert('失敗取得產品資料: ' + json.message);
            console.log(API_BASE_URL, productId);
        }
    })
    .catch(error => {
        console.error('失敗取得產品資料:', error);
        alert('失敗取得產品資料');
    });    
}window.editProduct = editProduct;


// 更新產品 (PUT)
function updateProduct() {
    if (!currentProductId) return;

    const form = document.getElementById('editProductForm');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    data.pID = currentProductId; 

    const token = localStorage.getItem("token");

    fetch(`${API_BASE_URL}/products.php?id=${currentProductId}`, {
        method: 'PUT',   
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(data) 
    })
    .then(res => res.json())
    .then(json => {
        console.log("Update response:", json);
        if (json.status === "success") {
            alert('更新成功');
            $('#editProductModal').modal('hide');
            loadProducts();
        } else {
            alert('更新失敗: ' + json.message);
        }   
    })
    .catch(error => {
        console.error('更新產品失敗:', error);
        alert('更新產品失敗');
    });
}window.updateProduct = updateProduct;



// 刪除產品 (DELETE)
function deleteProduct(productId) {
    if (confirm('是否確定删除產品?')) {
        const token = localStorage.getItem("token");

        fetch(`${API_BASE_URL}/products.php?id=${productId}`, {
            method: 'DELETE',
            headers: { "Authorization": "Bearer " + token }
        })
        .then(res => res.json())
        .then(json => {
            if (json.status === "success") {
                alert('删除成功');
                loadProducts();
            } else {
                alert('删除失敗: ' + json.message);
            }
        })
        .catch(error => {
            console.error('删除產品失敗:', error);
            alert('删除產品失敗');
        });
    }
}window.deleteProduct = deleteProduct;


// 打開上傳 modal
function uploadImage(productId) {
    currentProductId = productId;
    document.getElementById('uploadImageForm').reset();
    document.getElementById('imagePreview').style.display = 'none';
    $('#uploadImageModal').modal('show');
}window.uploadImage = uploadImage;

// 提交上傳
async function submitImageUpload() {
    if (!currentProductId) {
        alert('無產品獲取');
        return;
    }

    const fileInput = document.getElementById('imageFile');
    const file = fileInput.files[0];

    if (!file) {
        alert('請選取圖片檔案');
        return;
    }

    const uploadBtn = document.querySelector('#uploadImageModal .btn-primary');
    const originalText = uploadBtn.textContent;
    uploadBtn.textContent = '上載中...';
    uploadBtn.disabled = true;

    try {
        const data = await imageService.upload(currentProductId, file);

        if (data.error) {
            alert('上傳失敗: ' + data.error);
        } else {
            alert('圖片上傳成功');
            $('#uploadImageModal').modal('hide');
            location.reload();
        }
    } catch (error) {
        console.error('上傳失敗:', error);
        alert('上傳失敗: ' + error.message);
    } finally {
        uploadBtn.textContent = originalText;
        uploadBtn.disabled = false;
    }
}window.submitImageUpload = submitImageUpload;

// 圖片預覽
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('imageFile');
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if (fileInput && preview && previewImg) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    }
});
