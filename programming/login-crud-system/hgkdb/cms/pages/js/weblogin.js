
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        console.log("📩 表單 submit 被攔截");
        login();
    });
});

function login() {

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!username || !password) {
        showAlert("請輸入用戶名稱和密碼", "danger");
        return;
    }

    setLoading(true);

    fetch("../api/auth_login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ uUsername: username, uPassword: password })
    })
    .then(res => {
        console.log("HTTP 狀態:", res.status);
        return res.json();
    })
    .then(data => {
        console.log("API 回應:", data);
        setLoading(false);
        if (data.success) {
            localStorage.setItem("token", data.token);
            showAlert(data.message || "登入成功", "success");
            setTimeout(() => { window.location.href = "index.php"; }, 1000);
        } else {
            showAlert(data.message || "登入失敗", "danger");
            document.getElementById("password").value = "";
        }
    })
    .catch(err => {
        setLoading(false);
        console.error("登入失敗 (catch):", err);
        showAlert("登入失敗, 請檢查網絡連接", "danger");
    });
}

function showAlert(message, type) {
    const alertContainer = document.getElementById("alertContainer");
    alertContainer.innerHTML = `
        <div class="alert alert-${type}">
            ${message}
        </div>
    `;
}

function setLoading(isLoading) {
    const loading = document.querySelector(".loading");
    const btnText = document.querySelector(".btn-text");
    if (loading && btnText) {
        if (isLoading) {
            loading.style.display = "inline-block";
            btnText.style.display = "none";
        } else {
            loading.style.display = "none";
            btnText.style.display = "inline";
        }
    }
}