<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/config.php';

use Michaelho\Cms\Services\AuthService;

$token = AuthService::generateToken(['user_id' => 123]);
echo "Generated Token: " . $token . PHP_EOL;

$decoded = AuthService::verifyToken($token);
echo "Decoded Payload: " . print_r($decoded, true);
