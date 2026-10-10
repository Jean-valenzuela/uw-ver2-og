<?php
declare(strict_types=1);

$privateConfigPath = dirname(__DIR__, 2) . '/uw-private-db.php';
$privateConfig = is_file($privateConfigPath) ? require $privateConfigPath : [];
if (!is_array($privateConfig)) {
    $privateConfig = [];
}

$host = getenv('UW_DB_HOST') ?: ($privateConfig['host'] ?? 'localhost');
$u = getenv('UW_DB_USER') ?: ($privateConfig['user'] ?? 'root');
$p = getenv('UW_DB_PASSWORD') ?: ($privateConfig['password'] ?? '');
$dbase = getenv('UW_DB_NAME') ?: ($privateConfig['database'] ?? 'uw-ver2');

mysqli_report(MYSQLI_REPORT_OFF);
$conn = @new mysqli($host, $u, $p, $dbase);

if ($conn->connect_errno) {
    error_log('Database connection failed (' . $conn->connect_errno . '): ' . $conn->connect_error);
    http_response_code(500);
    exit('Database connection is not configured. Check the server error log.');
}

$conn->set_charset('utf8mb4');