<?php
namespace Michaelho\Cms\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService {
    private const SECRET = JWT_SECRET;

    public static function generateToken(array $payload): string {
        $issuedAt = time();
        $expire   = $issuedAt + 3600; // 1小時有效
        $payload['iat'] = $issuedAt;
        $payload['exp'] = $expire;

        return JWT::encode($payload, self::SECRET, 'HS256');
    }

    public static function verifyToken(string $token): array|false {
        try {
            $decoded = JWT::decode($token, new Key(self::SECRET, 'HS256'));
            return json_decode(json_encode($decoded), true);
        } catch (\Exception $e) {
            return false;
        }
    }
}
