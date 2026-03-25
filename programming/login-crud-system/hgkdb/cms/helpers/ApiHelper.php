<?php
require_once __DIR__ . "/JwtHelper.php";

class ApiHelper {
    /**
     * 統一成功輸出 JSON
     */
    public static function jsonResponse($data, $statusCode = 200) {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode([
            "status" => "success",
            "data" => $data
        ]);
        exit;
    }

    /**
     * 統一錯誤輸出 JSON
     */
    public static function jsonError($message, $statusCode = 400) {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode([
            "status" => "error",
            "message" => $message
        ]);
        exit;
    }

    /**
     * 驗證 JWT，失敗即刻回 error JSON，成功回 payload
     */
    public static function requireAuth() {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            self::jsonError("Missing Authorization header", 401);
        }

        $authHeader = $headers['Authorization'];
        if (strpos($authHeader, 'Bearer ') !== 0) {
            self::jsonError("Invalid Authorization format", 401);
        }

        $token = substr($authHeader, 7);
        $payload = JwtHelper::verifyToken($token);

        if (!$payload) {
            self::jsonError("Invalid or expired token", 401);
        }

        return $payload; // 驗證成功 → 回傳 payload
    }

    /**
     * 檢查角色權限 (RBAC)
     */
    public static function requireRole($payload, $role) {
        if (!isset($payload['role']) || $payload['role'] !== $role) {
            self::jsonError("Forbidden: insufficient role", 403);
        }
    }

    /**
     * 解析 JSON body (POST/PUT)
     */
    public static function parseJsonBody() {
        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            self::jsonError("Invalid JSON body", 400);
        }

        return $data;
    }
}
