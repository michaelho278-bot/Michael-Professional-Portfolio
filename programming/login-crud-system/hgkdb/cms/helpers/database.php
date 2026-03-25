<?php
class Database {
    private $host = "localhost";       // 資料庫伺服器
    private $db_name = "hgkdb";       // 資料庫名稱
    private $username = "root";        // 帳號
    private $password = "";            // 密碼
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // 如果連線失敗，直接停止並顯示錯誤
            die(json_encode([
                "status" => "error",
                "message" => "Database connection failed: " . $e->getMessage()
            ]));
        }
    }

    // SELECT 查詢，返回 array
    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 查詢單筆 
    public function queryOne($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC); // 只取一行
    }

    // INSERT/UPDATE/DELETE，返回成功與否
    public function execute($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    // 如果需要直接 prepare
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}
?>
