<?php
header("Access-Control-Allow-Origin: http://localhost:8100");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . "/../middleware/ApiMiddleware.php";
require_once __DIR__ . "/../helpers/ApiHelper.php";
require_once __DIR__ . "/../models/ProductModel.php";


$productModel = new ProductModel();

ApiMiddleware::handle(function($payload) use ($productModel) {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (isset($_GET['id'])) {
                $product = $productModel->getById($_GET['id']);
                if ($product) {
                    ApiHelper::jsonResponse([$product]);
                } else {
                    ApiHelper::jsonError("Product not found", 404);
                }
            } else {
                $products = $productModel->getAll();
                ApiHelper::jsonResponse($products);
            }
            break;

        case 'POST':
            // 只有 Admin 可以新增
            ApiHelper::requireRole($payload, "Admin");

            $data = ApiHelper::parseJsonBody();
            if (!isset($data['pName'], $data['pCate'], $data['pPrice'], $data['pStock'])) {
                ApiHelper::jsonError("Missing required fields", 400);
            }
            $created = $productModel->create($data);
            $created ? ApiHelper::jsonResponse(["created" => $created], 201)
                     : ApiHelper::jsonError("Create failed", 500);
            break;

        case 'PUT':
            // 只有 Admin 可以更新
            ApiHelper::requireRole($payload, "Admin");

            if (!isset($_GET['id'])) ApiHelper::jsonError("Missing product ID", 400);
            $data = ApiHelper::parseJsonBody();
            $updated = $productModel->update($_GET['id'], $data);
            $updated ? ApiHelper::jsonResponse(["updated" => $updated])
                     : ApiHelper::jsonError("Update failed", 500);
            break;

        case 'DELETE':
            // 只有 Admin 可以刪除
            ApiHelper::requireRole($payload, "Admin");

            if (!isset($_GET['id'])) ApiHelper::jsonError("Missing product ID", 400);
            $deleted = $productModel->delete($_GET['id']);
            $deleted ? ApiHelper::jsonResponse(["deleted" => $deleted])
                     : ApiHelper::jsonError("Delete failed", 500);
            break;

        default:
            ApiHelper::jsonError("Method not allowed", 405);
    }
});
