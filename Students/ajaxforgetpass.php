<?php
    include "../DataBases/globalconn.php";

    include "../PHPMailer/Exception.php";
    include "../PHPMailer/PHPMailer.php";
    include "../PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    session_start();

    function sendMail($adno1,$email,$opt)
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
        $mail->addAddress($email);     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML

        $mail->Subject = 'Your Forget Password verification Code.';
        $mail->Body    = 'Hello, '. $email .'<br> Your Student Id is : '. $adno1.'<br> Your Verification OTP is : '. $opt;
        $mail->send();

        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // header('location : index.php');
    }

    if(isset($_POST['next']))
    {
        $adno = $_POST['adno'];
        $email = $_POST["email"];

        $query = "SELECT * FROM tblstudents WHERE adno = '$adno'";
        $result = mysqli_query($conn,$query);
        $rows = mysqli_fetch_assoc($result);
        if(empty($email) || empty($adno))
        {
            echo '<div class="alert alert-danger">Please Enter Your Email Id...</div>';
        }
        elseif($adno != $rows['adno'])
        {
            echo '<div class="alert alert-danger">Student ID is Invalid...</div>';
        }
        elseif($email != $rows['email'])
        {
            echo '<div class="alert alert-danger">Email ID is Invalid...</div>';
        }
        else
        {
            echo '<script>$(document).ready(function(){
                    $(".first-box").hide();
                    $(".second-box").show();
                });</script>';
            $_SESSION['email1'] = $email;
            $_SESSION['adno1'] = $adno;
            $sendotp = rand(100000,999999);
            $_SESSION['otp'] = $sendotp;
            
            // echo $_SESSION['otp'];

            sendMail($adno,$email,$sendotp);
            echo '<div class="alert alert-warning">Check Your gmail account for OTP...</div>';
        }
    }

    if(isset($_POST['save']))
    {
        $email = $_SESSION['email1'];
        $adno = $_SESSION['adno1'];
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

            $password = password_hash($password,PASSWORD_DEFAULT);
            $query = "UPDATE `tblstudents` SET `password`='$password' WHERE email = '$email'";
            if(mysqli_query($conn, $query))
            {
                echo '<div class="alert alert-success">Password Reset Successfully...</div>';
                $password = "";
                $cpassword = "";
                $otp = "";
                // echo '<script>window.location.href = "index.php"</script>';
            }
            
        }
    }
?>
