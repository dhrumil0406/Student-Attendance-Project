<?php
    include "../DataBases/globalconn.php";
    session_start();

    if(isset($_POST['save']))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        if(empty($email) || empty($password) || empty($cpassword))
        {
            echo '<div class="alert alert-danger">All Fields Are Required...</div>';
        }
        elseif($email != $_SESSION['teacherEmail'])
        {
            echo '<div class="alert alert-danger">Email is Invalid...</div>';
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
            $query = "UPDATE `tblteachers` SET `password`='$password' WHERE email = '$email'";
            if(mysqli_query($conn, $query))
            {
                echo '<div class="alert alert-success">You Are changed Password Successfully...</div>';
            }
            $email = "";
            $password = "";
            $cpassword = "";
        }
    }
?>
