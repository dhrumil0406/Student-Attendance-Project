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
?>
    <?php
    $query= "SELECT * FROM `classes` ORDER BY semester ASC";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);		
    if ($num > 0)
    {
        echo ' <option value="">--Select Class And Semester--</option>';
        while ($rows = mysqli_fetch_assoc($result))
        {
            $class = $rows['deptname'] . ' SEM ' . $rows['semester'] . ' DIV ' . $rows['division'];
            $classval = $rows['deptname'] . 'S' . $rows['semester'] . 'D' . $rows['division'];
            echo'<option value="'.$classval.'">'. $class .'</option>';
        }
    }
    else
    {
        echo '<select required name="class" id="class" onchange="helo("class",this.value)" class="form-control mb-3">
                <option value="">--No Class Available--</option>
            </select>';
    }
?>