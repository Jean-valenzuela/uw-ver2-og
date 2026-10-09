<?php
    $host="localhost";
    $u="root";
    $p="utangwise";
    $dbase="uw-ver2";

    $conn = new mysqli($host,$u,$p,$dbase);

    if($conn->connect_error){
        die("database connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");
    


?>