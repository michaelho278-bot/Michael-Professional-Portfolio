<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <title>登入 - 產品内容管理系統</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/startmin.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .login-header { text-align: center; margin-bottom: 30px; }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none; border-radius: 5px;
            padding: 12px; font-size: 16px; font-weight: 600;
            width: 100%; margin-top: 10px;
        }
        .alert { border-radius: 5px; margin-top: 20px; }
        .loading { display: none; }
        .spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            width: 20px; height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block; margin-right: 10px;
        }
        @keyframes spin { 0% { transform: rotate(0deg);} 100% { transform: rotate(360deg);} }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h2><i class="fa fa-shopping-cart"></i></h2>
        <h2>產品内容管理系統</h2>
        <p>請登入系統</p>
    </div>

    <form id="loginForm">
        <div class="form-group">
            <label for="username">用戶名稱</label>
            <input type="text" class="form-control" id="username" placeholder="請輸入用戶名稱" required>
        </div>
        <div class="form-group">
            <label for="password">密碼</label>
            <input type="password" class="form-control" id="password" placeholder="請輸入密碼" required>
        </div>
        <button type="submit" class="btn btn-primary btn-login">
            <span class="loading"><span class="spinner"></span></span>
            <span class="btn-text">登入</span>
        </button>
    </form>

    <div id="alertContainer"></div>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script src="js/weblogin.js"></script>
`
</body>
</html>
