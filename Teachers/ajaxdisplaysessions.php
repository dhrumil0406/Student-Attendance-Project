<?php

    include '../DataBases/globalconn.php';
    session_start();

    $query = "SELECT * FROM `tblsession` WHERE class LIKE '$_SESSION[deptName]%'";
    $result = mysqli_query($conn,$query);
    $num = mysqli_num_rows($result);
?>
   <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>DBName</th>
            <th>Class</th>
            <th>Subject</th>
            <th>Date</th>
            <th>S-Time</th>
            <th>E-Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($num > 0)
            { 
                while($rows = mysqli_fetch_assoc($result))
                {
                    echo "<tr>
                            <td>$rows[id]</td>
                            <td>$rows[dbname]</td>
                            <td>$rows[class]</td>
                            <td>$rows[subject]</td>
                            <td>$rows[date]</td>
                            <td>$rows[stime]</td>
                            <td>$rows[etime]</td>
                        </tr>
                    ";
                }
            }
            else
            {
                echo "<div class='alert alert-danger' role='alert' style='width: 150px;'> No Record Found! </div>";
            }
        ?>
    </tbody>