<?php
    $host=getenv("UW_DB_HOST") ?: "localhost";
    $u=getenv("UW_DB_USER") ?: "root";
    $p=getenv("UW_DB_PASSWORD") ?: "";
    $dbase=getenv("UW_DB_NAME") ?: "uw-ver2";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($host,$u,$p,$dbase);

    if($conn->connect_error){
        die("database connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");
    


?>