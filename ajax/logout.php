<?php
require __DIR__ . '/app.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Use the Log out button.'); }
check_csrf();
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', ['expires' => time()-42000, 'path' => $p['path'], 'domain' => $p['domain'], 'secure' => $p['secure'], 'httponly' => true, 'samesite' => 'Lax']);
}
session_destroy();
header('Cache-Control: no-store');
go('public/login.php');
