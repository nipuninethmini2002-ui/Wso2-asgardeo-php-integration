<?php
session_start();

define('ASGARDEO_TENANT', 'org9v5i2'); 
define('CLIENT_ID', 'ZE7U8uN63Q11GGmEZozkaGrgFpIa'); 
define('CLIENT_SECRET', 'WALtsisEV_FgeSQxq3czICAQdMtdBEBKxkoZrWY1v1Ea'); 
define('REDIRECT_URI', 'http://localhost/asgardeo-app/callback.php');

define('AUTHORIZATION_ENDPOINT', 'https://api.asgardeo.io/t/' . ASGARDEO_TENANT . '/oauth2/authorize');
define('TOKEN_ENDPOINT', 'https://api.asgardeo.io/t/' . ASGARDEO_TENANT . '/oauth2/token');
?>
