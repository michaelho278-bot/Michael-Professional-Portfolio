<?php

class ImageHelper {
    // 沒有檔案也視為成功（呼叫端可用於維持原圖）
    public static function uploadImage($file) {
        if ($file === null || !isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return [
            'success' => true,
            'file_path' => null,
            'message' => 'No image provided'
        ];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => 'File too large (server limit)',
            UPLOAD_ERR_FORM_SIZE => 'File too large (form limit)',
            UPLOAD_ERR_PARTIAL => 'File partially uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'No temporary directory',
            UPLOAD_ERR_CANT_WRITE => 'Cannot write to disk',
            UPLOAD_ERR_EXTENSION => 'Upload stopped by extension'
        ];
        $errorMsg = $errorMessages[$file['error']] ?? 'Unknown upload error';
        return [
            'success' => false,
            'file_path' => null,
            'message' => 'Upload error: ' . $errorMsg . ' (code: ' . $file['error'] . ')'
        ];
    }

    // 檢查檔案是否存在
    if (!file_exists($file['tmp_name'])) {
        return [
            'success' => false,
            'file_path' => null,
            'message' => 'Temporary file not found'
        ];
    }

    $allowedMime = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    if (!isset($allowedMime[$mime])) {
        return [
            'success' => false,
            'file_path' => null,
            'message' => 'Unsupported image type: ' . $mime
        ];
    }

    $uploadsDir = dirname(__DIR__, 2) . '/uploads';
    if (!is_dir($uploadsDir)) {
        if (!mkdir($uploadsDir, 0775, true) && !is_dir($uploadsDir)) {
            return [
                'success' => false,
                'file_path' => null,
                'message' => 'Failed to create uploads directory: ' . $uploadsDir
            ];
        }
    }

    // 檢查目錄是否可寫
    if (!is_writable($uploadsDir)) {
        return [
            'success' => false,
            'file_path' => null,
            'message' => 'Uploads directory is not writable: ' . $uploadsDir
        ];
    }

    $extension = $allowedMime[$mime];
    $baseName = bin2hex(random_bytes(8)) . '-' . date('YmdHis');
    $fileName = $baseName . '.' . $extension;
    $targetPath = $uploadsDir . '/' . $fileName;

    // 檢查目標路徑是否已存在
    if (file_exists($targetPath)) {
        return [
            'success' => false,
            'file_path' => null,
            'message' => 'Target file already exists: ' . $targetPath
        ];
    }

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        $error = error_get_last();
        return [
            'success' => false,
            'file_path' => null,
            'message' => 'Failed to move uploaded file. Source: ' . $file['tmp_name'] . ', Target: ' . $targetPath . '. Error: ' . ($error['message'] ?? 'Unknown error')
        ];
    }

    // Web 路徑（以 /uploads/ 開頭）
    $webPath = '/uploads/' . $fileName;

    return [
        'success' => true,
        'file_path' => $webPath,
        'message' => 'Image uploaded successfully'
    ];
}

public static function deleteImage($webPath)
{
    if (!$webPath) {
        return false;
    }

    // 僅允許刪除 uploads 目錄內的檔案
    if (strpos($webPath, '/uploads/') !== 0) {
        return false;
    }

    $absolutePath = dirname(__DIR__) . $webPath; // $webPath 以 /uploads 開頭
    if (is_file($absolutePath)) {
        return @unlink($absolutePath);
    }

    return false;
}
}
?>


