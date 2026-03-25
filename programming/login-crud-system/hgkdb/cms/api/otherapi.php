<?php
require_once __DIR__ . "/../helpers/ApiHelper.php";
require_once __DIR__ . "/../helpers/ImageHelper.php";
require_once __DIR__ . "/../models/ProductModel.php";
require_once __DIR__ . "/../helpers/Database.php";

$db = new Database();
$productModel = new ProductModel($db);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // 驗證 JWT
        $payload = ApiHelper::requireAuth();

        // 只有 Admin 可以上傳
        ApiHelper::requireRole($payload, "Admin");

        if (!isset($_GET['id'])) {
            ApiHelper::jsonError("Missing product ID", 400);
        }
        $pID = $_GET['id'];

        // 檢查產品是否存在
        $product = $productModel->getById($pID);
        if (!$product) {
            ApiHelper::jsonError("Product not found", 404);
        }

        // 上傳圖片
        $file = $_FILES['image'] ?? null;
        $result = ImageHelper::uploadImage($file);
        if (!$result['success']) {
            ApiHelper::jsonError($result['message'], 400);
        }

        // 更新 DB
        $newPath = $result['file_path'];
        if ($newPath) {
            if (!empty($product['pImage'])) {
                ImageHelper::deleteImage($product['pImage']);
            }
            $productModel->updateImage($pID, $newPath);
        }

        // 回傳最新 product
        $updated = $productModel->getById($pID);
        ApiHelper::jsonResponse($updated);
        break;

    default:
        ApiHelper::jsonError("Method not allowed", 405);
}
