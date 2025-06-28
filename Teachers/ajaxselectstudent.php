<?php

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    $class = $_GET['class'];

    $conn2 = mysqli_connect($hostname, $user, $pass,$dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }
?>
<?php
    $query= "SELECT * FROM `$class`";
    $result = mysqli_query($conn2, $query);
    $num = mysqli_num_rows($result);
    if ($num > 0)
    {
        echo ' <option value="">--Select Student Name--</option>';
        while ($rows = mysqli_fetch_assoc($result))
        {
            echo'<option value="'.$rows['fullname'].'">'.$rows['fullname'].'</option>';
        }
    }
    else
    {
        echo '<select required name="studentName" id="students" onchange="helo("student",this.value);" class="form-control mb-3">
                <option value="">--Select Student Name--</option>
            </select>';
    }
?>