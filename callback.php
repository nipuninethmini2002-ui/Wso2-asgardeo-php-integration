<?php
require_once 'config.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $ch = curl_init(TOKEN_ENDPOINT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type'    => 'authorization_code',
        'code'          => $code,
        'redirect_uri'  => REDIRECT_URI,
        'client_id'     => CLIENT_ID,
        'client_secret' => CLIENT_SECRET
    ]));

    $response = curl_exec($ch);
    curl_close($ch);

    $tokenData = json_decode($response, true);

    if (isset($tokenData['access_token'])) {
        $_SESSION['user_info'] = $tokenData;
        header('Location: index.php');
        exit();
    } else {
        echo "Authentication Failed: " . htmlspecialchars($response);
    }
} else {
    header('Location: index.php');
}
?>