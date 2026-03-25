<?php
require_once __DIR__ . "/../helpers/JwtHelper.php";
require_once __DIR__ . "/../helpers/ApiHelper.php";
require_once __DIR__ . "/../middleware/ApiMiddleware.php";
require_once __DIR__ . "/../models/UserModel.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Content-Type: application/json");

$userModel = new UserModel();

ApiMiddleware::handle(function($payload) use ($userModel) {

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':            
            if (isset($_GET['id'])) {
                $user = $userModel->getById($_GET['id']);
                if ($user) {                    
                    ApiHelper::jsonResponse([$user]);
                } else {
                    ApiHelper::jsonError("User not found", 404);
                }
            } else {
                $users = $userModel->getAll();
                ApiHelper::jsonResponse($users);
            }
            break;

        case 'POST':            
            // 只有 Admin 可以新增
            ApiHelper::requireRole($payload, "Admin");

            $data = ApiHelper::parseJsonBody();
            if (!isset($data['uName'], $data['uRole'], $data['uUsername'], $data['uPassword'])) {
                ApiHelper::jsonError("Missing required fields", 400);
            }
            $added = $userModel->add($data);
            $added ? ApiHelper::jsonResponse(["added"=>$added], 201) : ApiHelper::jsonError("Add failed", 500);
            break;

        case 'PUT':           
            // 只有 Admin 可以更新
            ApiHelper::requireRole($payload, "Admin");

            if (!isset($_GET['id'])) ApiHelper::jsonError("Missing user ID", 400);
            $data = ApiHelper::parseJsonBody();
            $updated = $userModel->update($_GET['id'], $data);
            $updated ? ApiHelper::jsonResponse(["updated"=>$updated]) : ApiHelper::jsonError("Update failed", 500);
            break;

        case 'DELETE':
            // 只有 Admin 可以刪除
            ApiHelper::requireRole($payload, "Admin");

            if (!isset($_GET['id'])) ApiHelper::jsonError("Missing user ID", 400);
            $deleted = $userModel->delete($_GET['id']);
            $deleted ? ApiHelper::jsonResponse(["deleted"=>$deleted]) : ApiHelper::jsonError("Delete failed", 500);
            break;

        default:
            ApiHelper::jsonError("Method not allowed", 405);
    }
});
