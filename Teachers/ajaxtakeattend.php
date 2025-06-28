<?php

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];

    $conn = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn)
    {
        echo "connection error!";
    }

    // $query = "SELECT * FROM `$class`";
    // $result = mysqli_query($conn,$query);
    // $num = mysqli_num_rows($result);

    // $query1 = "ALTER TABLE `$class` ADD `$col_name` varchar(255);";
    // if(mysqli_query($conn,$query1))
    // {}
    // else
    // {
    //     echo "<script>
    //             alert('Attendance Fail...');
    //         </script>";
    // }
?>