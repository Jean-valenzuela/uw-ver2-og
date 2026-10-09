<?php
    $host="localhost";
    $u="u133616505_uwver2";
    $p="Utangwise1";
    $dbase="u133616505_uwver2";

    $conn = new mysqli($host,$u,$p,$dbase);

    if($conn->connect_error){
        die("database connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");
    


?>