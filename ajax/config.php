<?php






$host = getenv("UW_DB_HOST") ?: "localhost";
$u = getenv("UW_DB_USER") ?: "root";
$p = getenv("UW_DB_PASSWORD") ?: "";
$dbase = getenv("UW_DB_NAME") ?: "uw-ver2";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $u, $p, $dbase);

    $conn->set_charset("utf8mb4");

    $conn->query("SET time_zone = '+08:00'");

} catch (mysqli_sql_exception $e) {

    die("Database connection failed: " . $e->getMessage());

}
