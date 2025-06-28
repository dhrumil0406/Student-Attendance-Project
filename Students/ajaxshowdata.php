<?php
    include "../DataBases/globalconn.php";
    session_start();
    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    $class = $_GET['class'];
    $adno = $_GET['adno'];

    $conn2 = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }
    $query = "SELECT * FROM $class where adno = '$adno'";
    $result = mysqli_query($conn2,$query);
    $num = mysqli_num_rows($result);
?>
<table id="table" class="table align-items-center table-flush table-hover" id="dataTableHover">
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
                }
            }
            else
            {
                echo "<div class='alert alert-danger' role='alert' style='width: 150px;'> No Record Found! </div>";
            }
        ?>
    </tbody>
</table>