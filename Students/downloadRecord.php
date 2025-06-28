<?php 
error_reporting(0);
// include '../Includes/dbcon.php';
    include 'session.php';
    include '../DataBases/globalconn.php';
    session_start();
    mysqli_select_db($conn ,$_SESSION['dbname2']);
    // mysqli_select_db($conn ,$_SESSION['dbname']);

    $class = $_SESSION['class'];
    // $class = 'BCAS6D3';

    $adNo = $_SESSION['adNo'];
    $query = "SELECT * FROM `$class` Where adno = '$adNo'";
    $result = mysqli_query($conn,$query);
    $num = mysqli_num_rows($result);
?>
<table class="table align-items-center table-flush table-hover" id="dataTableHover" border="1">
   <thead class="thead-light">
        <tr>
            <?php
                $i = 0;
                $cols = array();
                while ($i < mysqli_num_fields($result))
                {
                    $col = mysqli_fetch_field($result);
                    echo '<th>' . $col->name . '</th>';
                    array_push($cols, $col->name);
                    $i = $i + 1;
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            $filename="My Attendance ". $adNo ." Date of ". date('d-m-Y');
            // $dateTaken = date("Y-m-d");
            if($num > 0)
            { 
                $length = count($cols);
                while($rows = mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                        for($j=0;$j<$length;$j++)
                        {
                            $name = $cols[$j];
                            echo "<td>$rows[$name]</td>";
                        }
                    echo "</tr>";
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=".$filename."-report.xls");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                }
            }
            else
            {
                echo "<div class='alert alert-danger' role='alert' style='width: 150px;'> No Record Found! </div>";
            }
        ?>
    </tbody>
</table>