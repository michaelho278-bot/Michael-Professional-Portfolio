<?php
class JwtHelper {
    private static $secret = "d9f3a7c1e6b2f8a4c9d0e1b7a5c3f6d8e2b4a7c9f1d0e3b6c8a5f7d2e9c1b4a6f7d8c9e2a1b5c3d4e6f9a0b2c7d8e1f3a4c5b6d7e8f9a1c2d3e4f5b6c7d8e9f0a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9"; // 換成你自己的密鑰

    // 生成 Token
    public static function generateToken($payload, $expMinutes = 60) {
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload['exp'] = time() + ($expMinutes * 60);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    // 驗證 Token
    public static function verifyToken($jwt) {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) return false;

        list($header, $payload, $signature) = $parts;

        $expectedSignature = str_replace(['+', '/', '='], ['-', '_', ''],
            base64_encode(hash_hmac('sha256', $header . "." . $payload, self::$secret, true))
        );

        if ($signature !== $expectedSignature) return false;

        $payloadData = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
        if (!$payloadData || $payloadData['exp'] < time()) return false;

        return $payloadData; // 驗證成功，回傳 payload
    }
}
