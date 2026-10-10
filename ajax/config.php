<?php
// Local XAMPP defaults; an existing private configuration remains optional.
$config = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'uw-ver2',
];
$privatePath = getenv('UW_DB_CONFIG');
if ($privatePath === false || $privatePath === '') {
    $privatePath = dirname(__DIR__, 2) . '/uw-private-db.php';
}
if (is_file($privatePath) && is_readable($privatePath)) {
    $privateConfig = require $privatePath;
    if (!is_array($privateConfig)) {
        http_response_code(500);
        exit('Invalid database configuration. The private file must return an array.');
    }
    $config = array_replace($config, $privateConfig);
} elseif (getenv('UW_DB_CONFIG') !== false && getenv('UW_DB_CONFIG') !== '') {
    http_response_code(500);
    exit('The configured database file could not be found. Check UW_DB_CONFIG.');
}
foreach (['host' => 'UW_DB_HOST', 'user' => 'UW_DB_USER', 'password' => 'UW_DB_PASSWORD', 'database' => 'UW_DB_NAME'] as $key => $variable) {
    $value = getenv($variable);
    if ($value !== false) {
        $config[$key] = $value;
    }
}
if (!extension_loaded('mysqli')) {
    http_response_code(500);
    exit('Enable the mysqli PHP extension, then restart Apache.');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
    $conn->set_charset('utf8mb4');
    $conn->query("SET time_zone = '+08:00'");
} catch (mysqli_sql_exception $exception) {
    error_log('UtangWise database connection: ' . $exception->getMessage());
    http_response_code(503);
    exit('Database connection failed. Start MySQL in XAMPP and check the database settings in ajax/config.php.');
}

