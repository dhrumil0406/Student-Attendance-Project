<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body >
    <!-- <script>
        function hello()
            {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function() {
                        document.getElementById("ab").innerHTML = this.responseText;
                    };
                    xmlhttp.open("GET","ajax.php");
                    xmlhttp.send();
            }
            setInterval(function(){
                hello();
            });
    </script> -->
    <!-- <h1 id="ab">

    </h1> -->
<?php
    include 'session.php';
    include '../DataBases/globalconn.php';
    session_start();
    date_default_timezone_set("Asia/Kolkata");

    $adno = 'AD0009';
    $colname = $_SESSION['colname'];

    $query = "SELECT * FROM tblsession ORDER BY id DESC LIMIT 1";
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

    $conn2 = mysqli_connect('localhost','root','',$dbname2);
    if(!$conn2)
    {
        echo "Connetion Fail!";
    }
    else
    {
        echo "Hello";
    }

    
    if($curtime >= $rows['stime'] && $curtime < $rows['etime'])
    {
        echo '<form action="" method="post">
                <button type="submit" name="attend">Submit</button>
            </form>';
    }
    else
    {
        echo '<form action="" method="post">
                <button type="submit" name="attend" disabled>Submit</button>
            </form>';
    }

    if(isset($_POST['attend']))
    {
        $query = "SELECT * FROM $class WHERE adno = '$adno'";
        $result = mysqli_query($conn2, $query);
        $record = mysqli_fetch_assoc($result);

        if($record[$colname] == 'P')
        {
            echo "Attendance Already Done!";
        }
        else
        {
            $query = "UPDATE `$class` SET `$colname`='P' WHERE adno = '$adno'";
            if(mysqli_query($conn2,$query))
            {
                echo "Attendance Done!";
            }
        }
    }


?>
    </body>
</html>