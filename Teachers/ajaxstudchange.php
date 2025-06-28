<?php

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    // $class = $_GET['class'];

    $conn = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn)
    {
        echo "connection error!";
    }
?>
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>F-Name</th>
            <th>M-Name</th>
            <th>L-Name</th>
            <th>Admission No</th>
            <th>Email</th>
            <th>Department</th>
            <th>Class</th>
            <th>Created Date</th>
            <th>Batch</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM `Students`";
            $result = mysqli_query($conn, $query);
            $num = mysqli_num_rows($result);
            $sn=0;
            if($num > 0)
            { 
                while ($rows = mysqli_fetch_assoc($result))
                {
                    $sn = $sn + 1;
                    echo"
                    <tr>
                        <td>".$rows['id']."</td>
                        <td>".$rows['fname']."</td>
                        <td>".$rows['mname']."</td>
                        <td>".$rows['lname']."</td>
                        <td>".$rows['adno']."</td>
                        <td>".$rows['email']."</td>
                        <td>".$rows['dbname']."</td>
                        <td>".$rows['class']."</td>
                        <td>".$rows['addate']."</td>
                        <td>".$rows['batch']."</td>
                    </tr>";
                }
            }
            else
            {
                echo"<div class='alert alert-danger' role='alert'> No Record Found! </div>";
            }
        ?>
    </tbody>