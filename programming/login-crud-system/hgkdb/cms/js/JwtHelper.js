// cms/js/JwtHelper.js
class JwtHelper {
  static parse(token) {
    try {
      const base64Url = token.split('.')[1];
      const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      return JSON.parse(atob(base64));
    } catch (e) {
      console.error("Invalid JWT:", e);
      return null;
    }
  }

  static getRole(token) {
    const payload = this.parse(token);
    return payload ? payload.role : null;
  }

  static getUserId(token) {
    const payload = this.parse(token);
    return payload ? payload.sub : null;
  }

  static isExpired(token) {
    const payload = this.parse(token);
    if (!payload || !payload.exp) return true;
    return Date.now() >= payload.exp * 1000;
  }

  static logout() {
    localStorage.removeItem("token");
    window.location.href = "weblogin.php";
  }
}
