<?php
// Firebase Admin SDK 配置
// 替換為你的專案 ID
define('PROJECT_ID', 'mobileapp-2459c'); 
// 替換為你的服務帳戶電子郵件
define('CLIENT_EMAIL', 'firebase-adminsdk-fbsvc@mobileapp-2459c.iam.gserviceaccount.com'); 
// 替換為你的服務帳戶PRIVATE KEY
define('PRIVATE_KEY', '-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQD7QSpi1NtvPIHh\nrYQMWWKCxc+QPQT9otzcMaPuIFMfDmpsIaTBZTmPlhrCLCQlUDFR89f5p4oz1qkS\nf2nC3K9mmtAIzW1MLjRKtTG4ehLTQQB2ScwEQxC5Y1M7+OXgoMLLGxgeOGXhnKdP\nmhRPFzC0vh8terrbVeyEQfO6nEg7uoeFK48ts3yt0nboQjfrbYL7R7Z8XwhGzMSL\nF4ZNWDejpmM8BgEW3JVCqrfd9ql1RQ6Lm96vU6lGoH2qj/32xi++nK3So/EsKVIv\nWOb5eBJ+jPFd0HlgiRrPVIpEgvYswcH9u0nVfUBRoQBteXU+Vn1qHMfINQdIkgyi\noTF/BZaBAgMBAAECggEAAMiRWsRK5zstWCMwE/BKb0UfstRuwa4NhXlY4DRTY568\nKmQ6Jti5rDj/S8IV57BZjQrrMYHEsRyNLPT1FiWe1BQR2gI7n5Cg0vFLsMhHSoem\n8Fl7E5kFUaEIFBkVKla9q0AS8HdzyMQWVr8YrMJUt6tfyOW09F4pyPVVTw1qkYwg\nB3E15L5HzRg4RNp/cXqyfCh73skyV+tFLFVwTe4cArka4qjg0zH5dF1fV5ONA0Pz\nfx9ibhqwakPBIR/d+8ZLISLjYwTz0ip59twpS1vCz3OlOkYc3DtwKnr0iONCfZGs\n6TbrngBErwY2jU0VYFbpz+UYuc5gRRaotleJ8e6v0QKBgQDeZ+Jl9t/MOb3t49nv\nrzTLvcXVZR7HuVfivGvXQnYSigkarafd/v9uheO3Cqjw3aFTRBKJSt65YiT6OY0Q\n/sNYLnaTY56vXNGm4egLYmZvXsss/8MvnODgOF4zX8Z2XujjpbUAJJ7KlLC65vaw\nXNUhRkA58X3Echcg+1WPYG0L8QKBgQDXFuPsAYCApccHDRrXjVyyhrK3oSCSWJ3b\npj2I1D0+T3PyIuLOmTJhYs5GPqUSNUmtdUm6/wRiUsIMOPC+DXjt6gxSz6O0DOIV\np02Ywx4e8UdUhuWwed4zhPkhicdXt4thH0rMxKbVNvXdWKYJ4SqotaVAV5pYiYaR\nDHV50f4DkQKBgQC/mUleRCca3me0KEXZCdx25T8ojpvMvexrpZ1V7aigYhBjzlS+\nl+5fvbKmPuW504UmoY9CfaCQnm9yrd/MU13geu6mHP1Y36KxnQ51uEi9CzIHyzLQ\nstq773Of2JO16B/D9j6PJ/0wUpZJ/a1p1B+8MbQk9tk9QniQblWQVia7UQKBgQDT\nAAaZiCOqkHY9qZJycJ/GFrONxogwaLR7PIrTBvoJfWIN4EFFUS4GMSqP6HaA9TuQ\n6SVqRy/i0LLB0L4Cgy7lnht2xXEfeR/1BAnwWUDcM++4sRj0VakwOzs2tnWSzGDz\n5wG2/Rd4xJDPEl7YBEaX+JHjG80zG76h3moEFoessQKBgC036m6lVZqCY9OsmFtQ\n7pwVvZOlWH2sBKrYY/nB3g4jxi2uD9zDxVTZ62zkO2HIR5lbbVmfw42TKmSHxrAZ\n3CCX5Xr1q+CUOe0fhK2+fqTxsyF6v+Brdr8c6/s9XTR+Jqh2iuJKWJZGvpv5wkIj\ngrtqrlVWzqnHQhxPVLoii1aN\n-----END PRIVATE KEY-----\n');

class FCM {
    private $accessToken;
    private $projectId;
    
    public function __construct() {
        $this->projectId = PROJECT_ID;
        $this->accessToken = $this->getAccessToken();
    }
    
    /**
     * 取得 OAuth2 存取權杖
     */
    private function getAccessToken() {
        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
        
        $jwtHeader = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $jwtClaim = json_encode([
            'iss' => CLIENT_EMAIL,
            'scope' => implode(' ', $scopes),
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => time() + 3600,
            'iat' => time(),
        ]);
        
        $header = base64_encode($jwtHeader);
        $claim = base64_encode($jwtClaim);
        
        // 載入私鑰並使用正確的 openssl_sign 參數順序
        $privateKeyStr = str_replace('\n', "\n", PRIVATE_KEY);
        $privateKey = openssl_pkey_get_private($privateKeyStr);
        if (!$privateKey) {
            throw new Exception('無法載入私鑰: ' . openssl_error_string());
        }
        
        $signature = '';
        openssl_sign("$header.$claim", $signature, $privateKey, 'SHA256');
        
        // 釋放私鑰資源
        openssl_free_key($privateKey);
        
        $jwt = "$header.$claim." . base64_encode($signature);
        
        $postFields = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $responseData = json_decode($response, true);
        
        // 檢查是否有錯誤
        if (isset($responseData['error'])) {
            throw new Exception('OAuth2 錯誤: ' . ($responseData['error_description'] ?? $responseData['error']));
        }
        
        if (!isset($responseData['access_token'])) {
            throw new Exception('無法取得存取權杖: ' . json_encode($responseData));
        }
        
        return $responseData['access_token'];
    }
    
    /**
     * 發送通知到主題
     * @param string $title 通知標題
     * @param string $body 通知內容
     * @param array $data 額外資料
     * @return array 結果
     */
    public function sendToTopic($title, $body, $data = []) {
    $url = 'https://fcm.googleapis.com/v1/projects/' . $this->projectId . '/messages:send';

    $message = [
    'message' => [
        'topic'        => "News",
        'notification' => [
            'title' => $title,
            'body'  => $body
        ]
    ]
];


    $headers = [
        'Authorization: Bearer ' . $this->accessToken,
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    file_put_contents("debug.json", json_encode($message, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($result === false) {
        return ['success' => false, 'error' => 'cURL error'];
    }

    $response = json_decode($result, true);

    if ($httpCode === 200) {
        return ['success' => true, 'message_id' => $response['name'] ?? null];
    } else {
        return ['success' => false, 'error' => $response['error']['message'] ?? 'Unknown error'];
    }
}

}
?>
