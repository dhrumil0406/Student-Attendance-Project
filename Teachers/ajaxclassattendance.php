<?php

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];

    $class = $_GET['class'];
    $Idd = $_GET['Idd'];
    $subject = $_GET['subject'];

    $conn = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn)
    {
        echo "connection error!";
    }

    if($Idd == 1)
    {
        // $query = "SELECT * FROM `$class`";
    }
    elseif($Idd == 2)
    {
        $query = "SELECT * FROM `$class`";
    }
    elseif($Idd == 3)
    {
        if($subject == "")
        {
            $query = "SELECT * FROM `$class`";
        }
        else
        {
            $i = 0;
            $c = array();
            $d = array();
            $query = "SELECT * FROM `$class`";
            $result = mysqli_query($conn, $query);
            while ($i < mysqli_num_fields($result))
            {
                $col = mysqli_fetch_field($result);
                $colname = $col->name;
                if($i >= 5)
                {
                    $rm = substr($colname,-6,);
                    $sub = str_replace($rm,"",$colname);
                    array_push($c, $sub);
                    array_push($d, substr($colname,-6,6));
                }
                $i = $i + 1;
            }
            $len = count($c);
            $str = "";
            for($j=0;$j<$len;$j++)
            {
                if($c[$j] == $subject)
                {
                    $str .= $c[$j] . $d[$j] . ',';
                }
            }
            $l = strlen($str);
            $newstr = "";
            for($j=0;$j<$l-1;$j++)
            {
                $newstr .= $str[$j];
            }
            $query = "SELECT id,rno,fullname,adno,class,$newstr FROM `$class`";
        }
    }
    elseif($Idd == 4)
    {
        $student = $_GET['student'];
        if($student == "")
        {
            $query = "SELECT * FROM `$class`";
        }
        else
        {
            $query = "SELECT * FROM `$class` WHERE fullname = '$student'";
        }
    }
    $result = mysqli_query($conn,$query);
    $num = mysqli_num_rows($result);
?>
<table class="table align-items-center table-flush table-hover" id="dataTableHover">
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
                echo '<th>Present</th>';
                echo '<th>Lectures</th>';
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
                    $p = 0;
                    $q = 0;
                    echo "<tr>";
                        for($j=0;$j<$length;$j++)
                        {
                            $name = $cols[$j];
                            echo "<td>$rows[$name]</td>";
                            if($rows[$name] == "P")
                            {
                                $p++;
                            }
                        }
                        $b = $length - 5;
                    echo '<th>'.$p.'</th>';
                    echo '<th>'.$b.'</th>';
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