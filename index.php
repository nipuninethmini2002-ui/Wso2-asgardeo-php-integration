<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function parseJWT($jwt) {
    $parts = explode('.', $jwt);
    if (count($parts) === 3) {
        $base64Url = $parts[1];
        $base64 = str_replace(['-', '_'], ['+', '/'], $base64Url);
        $payload = base64_decode($base64);
        return json_decode($payload, true);
    }
    return null;
}

$userEmail = "";
if (isset($_SESSION['user_info']['id_token'])) {
    $claims = parseJWT($_SESSION['user_info']['id_token']);
    $userEmail = isset($claims['username']) ? $claims['username'] : (isset($claims['email']) ? $claims['email'] : 'User');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSO2 Asgardeo PHP SSO</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .success-msg {
            color: #27ae60;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .user-email {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .btn-login {
            background-color: #ff7300; 
        }
        .btn-login:hover {
            background-color: #e06500;
        }
        .btn-logout {
            background-color: #e74c3c;
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>WSO2 Asgardeo PHP SSO</h2>

    <?php if (isset($_SESSION['user_info']) && !empty($_SESSION['user_info'])): ?>
        <p class="success-msg">✔ Logged in successfully!</p>
        <p>Welcome, User:</p>
        <div class="user-email">📧 <?php echo htmlspecialchars($userEmail); ?></div>
        <br>
        <a href="logout.php" class="btn btn-logout">Logout</a>
    <?php else: ?>
        <p style="color: #666; margin-bottom: 25px;">Please sign in using your WSO2 Asgardeo account to continue.</p>
        <?php 
            $authUrl = AUTHORIZATION_ENDPOINT . '?' . http_build_query([
                'response_type' => 'code',
                'client_id' => CLIENT_ID,
                'redirect_uri' => REDIRECT_URI,
                'scope' => 'openid profile email'
            ]);
        ?>
        <a href="<?php echo $authUrl; ?>" class="btn btn-login">Login with Asgardeo</a>
    <?php endif; ?>
</div>

</body>
</html>
