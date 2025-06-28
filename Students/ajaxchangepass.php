<?php
    include "../DataBases/globalconn.php";
    session_start();

    if(isset($_POST['save']))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        if(empty($username) || empty($password) || empty($cpassword))
        {
            echo '<div class="alert alert-danger">All Fields Are Required...</div>';
        }
        elseif($username != $_SESSION['adNo'])
        {
            echo '<div class="alert alert-danger">UserName is Invalid...</div>';
        }
        elseif(strlen($password) < 6)
        {
            echo '<div class="alert alert-danger">Password Must Be 6 Character Long...</div>';
        }
        elseif($password != $cpassword)
        {
            echo '<div class="alert alert-danger">Confirm Password Invalid...</div>';
        }
        else
        {
            $password = password_hash($password,PASSWORD_DEFAULT);
            $query = "UPDATE `tblstudents` SET `password`='$password' WHERE adNo = '$username'";
            if(mysqli_query($conn, $query))
            {
                echo '<div class="alert alert-success">You Are changed Password Successfully...</div>';
            }
            $username = "";
            $password = "";
            $cpassword = "";
        }
    }
?>
