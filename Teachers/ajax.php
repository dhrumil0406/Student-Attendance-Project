<?php
    date_default_timezone_set("Asia/Kolkata");
    echo date('h:i A');

    include '../Includes/session.php';
    include '../DataBases/globalconn.php';
    session_start();

    $adno = 'AD0006';
    $colname = $_SESSION['colname'];

    $query = "SELECT * FROM tblsession order by id desc limit 1";
    $result = mysqli_query($conn,$query);
    $rows = mysqli_fetch_assoc($result);

    $curtime = date('h:i A');

    $id = $rows['id'];
    $dbname2 = $rows['dbname'];
    $class = $rows['class'];
    $subject = $rows['subject'];
    $date = $rows['date'];
    $stime = $rows['stime'];
    $etime = $rows['etime'];

    echo $id, $dbname2, $class, $subject,$date,$stime,$etime;
    $conn2 = mysqli_connect('localhost','root','',$dbname2);
    if(!$conn2)
    {
        echo "Connetion Fail!";
    }
    else
    {
        echo "Hello";
    }

    if($curtime >= $stime && $curtime < $etime)
    {
        echo '<form action="" method="post">
                <button type="submit" name="attend1">Submit</button>
            </form>';
    }
    else
    {
        echo '<form action="" method="post">
                <button type="submit" name="attend1" disabled>Submit</button>
            </form>';
    }

    $query = "SELECT * FROM $class WHERE adno = '$adno'";
    $result = mysqli_query($conn2, $query);
    $record = mysqli_fetch_assoc($result);

    $col = $record[$colname];

    echo $col;
    if(isset($_POST['attend']))
    {
        echo "abc";
        // if($record[$colname] == 'P')
        // {
        //     echo "Attendance Already Done!";
        // }
        // else
        // {
            $query = "UPDATE `$class` SET `$colname`='P' WHERE adno = '$adno'";
            if(mysqli_query($conn2,$query))
            {
                echo "Attendance Done!";
            }
            else
            {
                echo "abc";
            }
        // }
    }
?>