<?php
header("Access-Control-Allow-Origin: http://localhost:8100");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Content-Type: application/json");

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/LoginModel.php';

use Michaelho\Cms\Services\AuthService;   

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['uUsername'] ?? '';
$password = $data['uPassword'] ?? '';
$loginModel = new LoginModels($pdo);
$user = $loginModel->verifyLogin($username, $password);

if ($user && password_verify($password, $user['uPassword'])) {
    $payload = [
        'sub'  => $user['uID'],
        'role' => $user['uRole']
    ];
    $token = AuthService::generateToken($payload);   // 正確呼叫
    echo json_encode([
        "success" => true,
        "message" => "登入成功",
        "token"   => $token
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "帳號或密碼錯誤"
    ]);
}
