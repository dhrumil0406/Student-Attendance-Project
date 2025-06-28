<?php
    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "GLOBAL";

    $conn = mysqli_connect($hostname, $user, $pass, $dbname);
    if(!$conn)
    {
        echo "connection error!";
    }
?>