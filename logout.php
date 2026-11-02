<?php
require_once 'config.php';

// Local PHP Session එක destroy කිරීම
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

// Asgardeo OIDC Logout URL (client_id සහ post_logout_redirect_uri සමඟ)
$postLogoutRedirectUri = 'http://localhost/asgardeo-app/index.php';
$asgardeoLogoutUrl = 'https://api.asgardeo.io/t/' . ASGARDEO_TENANT . '/oidc/logout?' . http_build_query([
    'client_id' => CLIENT_ID,
    'post_logout_redirect_uri' => $postLogoutRedirectUri
]);

// Asgardeo Logout වෙත redirect කිරීම
header('Location: ' . $asgardeoLogoutUrl);
exit();
?>