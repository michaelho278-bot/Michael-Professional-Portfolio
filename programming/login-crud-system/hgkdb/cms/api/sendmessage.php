<?php
// cms/api/sendMessage.php

// --- CORS & headers ---
header("Access-Control-Allow-Origin: http://localhost:8100");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// --- dependencies ---
require_once __DIR__ . "/../middleware/ApiMiddleware.php";
require_once __DIR__ . "/../helpers/ApiHelper.php";
require_once __DIR__ . "/../helpers/fcm.php";

// --- main handler ---
ApiMiddleware::handle(function($payload) {
    // 1. 確認角色
    if (!isset($payload['role']) || $payload['role'] !== 'Admin') {
        ApiHelper::jsonError("未授權", 403);
        return;
    }

    // 2. 讀取前端傳入的訊息
    $data = json_decode(file_get_contents("php://input"), true);
    $message = $data['message'] ?? "";
    if (empty($message)) {
        ApiHelper::jsonError("訊息內容不可為空", 400);
        return;
    }

    // 3. 呼叫 FCM 發送推播
    try {
        $fcm = new FCM();
        $result = $fcm->sendToTopic("news", "最新消息", $message);

        // 4. 回傳結果
        ApiHelper::jsonResponse($result);
    } catch (Exception $e) {
        ApiHelper::jsonError($e->getMessage(), 500);
    }
});
