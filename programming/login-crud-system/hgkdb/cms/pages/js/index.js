// cms/js/index.js
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

  // 呼叫 API 拎 dashboard stats
  fetch("../api/dashboard_stats.php", {
    headers: { "Authorization": "Bearer " + token }
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      document.getElementById("totalProducts").textContent = data.productCount;
      document.getElementById("totalUsers").textContent = data.userCount;
    } else {
      alert(data.message || "未能取得統計資料");
      JwtHelper.logout();
    }
  })
  .catch(err => {
    console.error("Dashboard stats error:", err);
    JwtHelper.logout();
  });
});
