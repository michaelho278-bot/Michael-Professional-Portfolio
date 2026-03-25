<?php
require_once __DIR__ . "/../helpers/Database.php";

class LoginModels{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 登入驗證
    public function verifyLogin($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM userlist WHERE uUsername=?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['uPassword'])) {
            return $user; // 登入成功，回傳用戶資料
        }
        return null; // 登入失敗
    }
}
