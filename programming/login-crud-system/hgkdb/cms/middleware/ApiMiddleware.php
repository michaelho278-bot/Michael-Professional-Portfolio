<?php
require_once __DIR__ . "/../helpers/JwtHelper.php";
require_once __DIR__ . "/../helpers/ApiHelper.php";

class ApiMiddleware {
    public static function handle(callable $callback) {
        try {
            // 1. 檢查 Authorization header
            $headers = getallheaders();
            if (!isset($headers['Authorization'])) {
                ApiHelper::jsonError("Missing Authorization header", 401);
            }

            $authHeader = $headers['Authorization'];
            if (strpos($authHeader, 'Bearer ') !== 0) {
                ApiHelper::jsonError("Invalid Authorization format", 401);
            }

            $token = substr($authHeader, 7);

            // 2. 驗證 JWT
            $payload = JwtHelper::verifyToken($token);
            if (!$payload) {
                ApiHelper::jsonError("Invalid or expired token", 401);
            }

            // 3. 執行 API 邏輯，傳 payload 入去
            $callback($payload);

        } catch (Exception $e) {
            // 4. 統一錯誤輸出
            ApiHelper::jsonError("Server error: " . $e->getMessage(), 500);
        }
    }
}
