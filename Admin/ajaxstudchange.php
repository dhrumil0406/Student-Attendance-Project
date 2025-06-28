<?php
    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname = $_GET['dbname'];
    // $class = $_GET['class'];

    $conn = mysqli_connect($hostname, $user, $pass, $dbname);
    if(!$conn)
    {
        echo "connection error!";
    }
?>
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Admission No</th>
            <th>Email</th>
            <th>Class</th>
            <th>Date Created</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
    <?php
        $query = "SELECT * FROM Students";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        $sn=0;
        $status="";
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
                    <td>".$rows['class']."</td>
                    <td>".$rows['addate']."</td>
                    <td><a href='updateStudents.php?action=edit&Id=".$rows['id']."&class=". $rows['class']."&dbname2=".$rows['dbname']."'><i class='fas fa-fw fa-edit'></i></a></td>
                    <td><a href='?action=delete&Id=".$rows['id']."&dbname2=". $rows['dbname'] ."&class=". $rows['class'] ."'><i class='fas fa-fw fa-trash'></i></a></td>
                </tr>";
            }
        }
        else
        {
            echo "<div class='alert alert-danger' role='alert'> No Record Found! </div>";
            // echo "<p style='margin: 40px 30px;width: 20vw; height:30px; background-color: red; color:aliceblue; text-align:center;'>Hello</p>";
        }
    ?>
    </tbody>