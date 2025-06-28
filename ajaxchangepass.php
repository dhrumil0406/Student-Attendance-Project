<?php
    include "/DataBases/globalconn.php";

    include "./PHPMailer/Exception.php";
    include "./PHPMailer/PHPMailer.php";
    include "./PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    session_start();

    function sendMail($email,$opt)
    {
        try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
        $mail->Port       =  465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->Username   = 'dhrumilmandaviya464@gmail.com';                     //SMTP username
        $mail->Password   = 'qcycsdhlotvyctpk';                               //SMTP password

        $mail->setFrom('dhrumilmandaviya464@gmail.com', 'Dhrumil Mandaviya');
        $mail->addAddress('dhrumilmandaviya464@gmail.com');     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML

        $mail->Subject = 'Your Forget Password verification Code.';
        $mail->Body    = 'Hello, '. $email .'<br> Your OTP is : '. $opt;
        $mail->send();

        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // header('location : index.php');
    }

    if(isset($_POST['next']))
    {
        $usertype = $_POST['usertype'];
        $email = $_POST["email"];

        if($usertype == 'teacher')
        {
            $query = "SELECT * FROM tblteachers Where email = '$email'";
            $result = mysqli_query($conn,$query);
            $rows = mysqli_fetch_assoc($result);
            if(empty($email) || empty($usertype))
            {
                echo '<div class="alert alert-danger">Please Enter email Id...</div>';
            }
            elseif($email != $rows['email'])
            {
                echo '<div class="alert alert-danger">Email is Invalid...</div>';
            }
            else
            {
                echo '<script>$(document).ready(function(){
                        $(".first-box").hide();
                        $(".second-box").show();
                    });</script>';
                $_SESSION['email1'] = $email;
                $_SESSION['usertype1'] = $usertype;
                $sendotp = rand(100000,999999);
                $_SESSION['otp'] = $sendotp;
                // echo $_SESSION['otp'];

                sendMail($email,$sendotp);
                echo '<div class="alert alert-warning">Check Your gmail account for OTP...</div>';
            }
        }
        elseif($usertype == 'admin')
        {
            $query = "SELECT * FROM tbladmin";
            $result = mysqli_query($conn,$query);
            $rows = mysqli_fetch_assoc($result);
            if(empty($email))
            {
                echo '<div class="alert alert-danger">Please Enter email Id...</div>';
            }
            elseif($email != $rows['email'])
            {
                echo '<div class="alert alert-danger">Email is Invalid...</div>';
            }
            else
            {
                echo '<script>$(document).ready(function(){
                    $(".first-box").hide();
                    $(".second-box").show();
                });</script>';
                $_SESSION['email1'] = $email;
                $_SESSION['usertype1'] = $usertype;
                $sendotp = rand(100000,999999);
                $_SESSION['otp'] = $sendotp;
                // echo $_SESSION['otp'];

                sendMail($email,$sendotp);
                echo '<div class="alert alert-warning">Check Your gmail account for OTP...</div>';
            }
        }
    }

    if(isset($_POST['save']))
    {
        $email = $_SESSION['email1'];
        $usertype = $_SESSION['usertype1'];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $otp = $_POST["otp"];
        if(empty($password) || empty($cpassword) || empty($otp))
        {
            echo '<script>$(document).ready(function(){
                $(".first-box").hide();
                $(".second-box").show();
            });</script>';
            echo '<div class="alert alert-danger">Please enter password & OTP...</div>';
        }
        elseif(strlen($password) < 6)
        {
            echo '<script>$(document).ready(function(){
                $(".first-box").hide();
                $(".second-box").show();
            });</script>';
            echo '<div class="alert alert-danger">Password Must Be 6 Character Long...</div>';
        }
        elseif($password != $cpassword)
        {
            echo '<script>$(document).ready(function(){
                $(".first-box").hide();
                $(".second-box").show();
            });</script>';
            echo '<div class="alert alert-danger">Confirm Password Invalid...</div>';
        }
        elseif(strlen($otp) != 6)
        {
            echo '<script>$(document).ready(function(){
                $(".first-box").hide();
                $(".second-box").show();
            });</script>';
            echo '<div class="alert alert-danger">Invalid Must be 6 Character Long...</div>';
        }
        elseif($otp != $_SESSION['otp'])
        {
            echo '<script>$(document).ready(function(){
                $(".first-box").hide();
                $(".second-box").show();
            });</script>';
            echo '<div class="alert alert-danger">Invalid OTP...</div>';
        }
        else
        {
            echo '<script>$(document).ready(function(){
                $(".first-box").hide();
                $(".second-box").show();
            });</script>';

            if($usertype == 'teacher')
            {
                $password = password_hash($password,PASSWORD_DEFAULT);
                $query = "UPDATE `tblteachers` SET `password`='$password' WHERE email = '$email'";
                if(mysqli_query($conn, $query))
                {
                    // echo '<script>window.location.href = "index.php"</script>';
                    echo '<div class="alert alert-success">Password Reset Successfully...</div>';
                    $password = "";
                    $cpassword = "";
                    $otp = "";
                }
            }
            elseif($usertype == 'admin')
            {
                // $password = password_hash($password,PASSWORD_DEFAULT);
                $query = "UPDATE `tbladmin` SET `password`='$password' WHERE email = '$email'";
                if(mysqli_query($conn, $query))
                {
                    // echo '<script>window.location.href = "index.php"</script>';
                    echo '<div class="alert alert-success">Password Reset Successfully...</div>';
                    $password = "";
                    $cpassword = "";
                    $otp = "";
                }
            }
            
        }
    }
?>