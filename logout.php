<?php
require_once 'config.php';

session_start();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

$postLogoutRedirectUri = 'http://localhost/asgardeo-app/index.php';
$asgardeoLogoutUrl = 'https://api.asgardeo.io/t/' . ASGARDEO_TENANT . '/oidc/logout?' . http_build_query([
    'client_id' => CLIENT_ID,
    'post_logout_redirect_uri' => $postLogoutRedirectUri
]);

header('Location: ' . $asgardeoLogoutUrl);
exit();
?>
