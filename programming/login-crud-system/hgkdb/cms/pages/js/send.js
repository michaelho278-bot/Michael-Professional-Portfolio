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

  // 表單提交
  const form = document.getElementById("sendForm");
  form.addEventListener("submit", e => {
    e.preventDefault();
    const message = document.getElementById("message").value;

    fetch("../api/sendmessage.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message })
    })
      .then(res => res.json())
      .then(data => {
        document.getElementById("status").innerText = data.success
          ? "推播成功!"
          : "推播失敗: " + data.error;
      })
      .catch(err => {
        document.getElementById("status").innerText = "錯誤: " + err;
      });
  });
