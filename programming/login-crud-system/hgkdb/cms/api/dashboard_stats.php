<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 引入 config/config.php，提供 $pdo 和 JWT_SECRET
require_once(__DIR__ . "/../config/config.php");
require_once(__DIR__ . "/../helpers/JwtHelper.php");

$headers = getallheaders();
$authHeader = $headers["Authorization"] ?? "";
$token = str_replace("Bearer ", "", $authHeader);

$payload = JwtHelper::verifyToken($token);
if (!$payload) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "未授權"]);
    exit();
}

try {
    // 查用戶數量
    $stmt = $pdo->query("SELECT COUNT(*) FROM userlist");
    $userCount = $stmt->fetchColumn();

    // 查產品數量
    $stmt = $pdo->query("SELECT COUNT(*) FROM productlist");
    $productCount = $stmt->fetchColumn();

    echo json_encode([
        "success" => true,
        "userCount" => $userCount,
        "productCount" => $productCount
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "查詢失敗",
        "error" => $e->getMessage()
    ]);
}
