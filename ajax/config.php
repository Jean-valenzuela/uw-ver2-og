<?php
$privatePath = getenv('UW_DB_CONFIG');

$config = [
    'host' => getenv('UW_DB_HOST') ?: 'localhost',
    'user' => getenv('UW_DB_USER') ?: 'root',
    'password' => getenv('UW_DB_PASSWORD') ?: '',
    'database' => getenv('UW_DB_NAME') ?: 'uw-ver2',
];


if ($privatePath === false || $privatePath === '') {
    foreach ([dirname(__DIR__, 4) . '/uw-private-db.php', dirname(__DIR__, 2) . '/uw-private-db.php'] as $candidate) {
        if (is_file($candidate)) {
            $privatePath = $candidate;
            break;
        }
    }
}

$config = ['host' => 'localhost', 'user' => 'root', 'password' => '', 'database' => 'uw-ver2'];
if ($privatePath && is_file($privatePath)) {
    $privateConfig = require $privatePath;
    if (!is_array($privateConfig)) {
        http_response_code(500);
        exit('Invalid private database configuration.');
    }
    $config = array_replace($config, $privateConfig);
} elseif (getenv('UW_DB_CONFIG')) {
    http_response_code(500);
    exit('The configured database file could not be found.');
}

foreach (['host' => 'UW_DB_HOST', 'user' => 'UW_DB_USER', 'password' => 'UW_DB_PASSWORD', 'database' => 'UW_DB_NAME'] as $key => $variable) {
    $value = getenv($variable);
    if ($value !== false) $config[$key] = $value;
}

if (!extension_loaded('mysqli')) {
    http_response_code(500);
    exit('Enable the mysqli PHP extension.');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
    $conn->set_charset('utf8mb4');
    $conn->query("SET time_zone = '+08:00'");
} catch (mysqli_sql_exception $exception) {
    error_log('UtangWise database connection failed: ' . $exception->getMessage());
    http_response_code(503);
    exit('Database connection failed. Check the server error log.');
}
