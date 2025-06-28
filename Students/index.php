<?php 
// include 'Includes/dbcon.php';
    include '../DataBases/globalconn.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../img/user-icn.png" rel="icon">
    <title>Student's - Login</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login" style="background-image: url('img/logo/loral1.jpe00g');">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <h5 align="center">STUDENT ATTENDANCE SYSTEM</h5>
                                    <div class="text-center">
                                        <img src="img/user-icn.png" style="width:90px;height:90px">
                                        <br><br>
                                        <h1 class="h4 text-gray-900 mb-4">Student's Login</h1>
                                    </div>
                                    <form class="user" method="Post" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Enter Student Id">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control" id="exampleInputPassword" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                           <a href="./forgetpass.php">Forget Password</a>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-block" value="Login" name="login" />
                                        </div>
                                    </form>

                                    <?php
                                        if(isset($_POST['login']))
                                        {
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];

                                                $query = "SELECT * FROM `tblstudents` WHERE adno = '$username'";
                                                $rs = $conn->query($query);
                                                $num = $rs->num_rows;
                                                $rows = $rs->fetch_assoc();

                                                if($num > 0)
                                                {
                                                    if(password_verify($password,$rows['password']))
                                                    {
                                                        $_SESSION['studentId'] = $rows['id'];
                                                        $_SESSION['studentFirstName'] = $rows['fname'];
                                                        $_SESSION['studentLastName'] = $rows['lname'];
                                                        $_SESSION['adNo'] = $rows['adno'];
                                                        $_SESSION['class'] = $rows['class'];
                                                        $_SESSION['dbname2'] = $rows['dbname'];

                                                        echo "<script type = \"text/javascript\">
                                                                window.location = (\"home.php\")
                                                                </script>";
                                                    }
                                                    else
                                                    {
                                                        echo "<div class='alert alert-danger' role='alert'>
                                                                Invalid Password!
                                                                </div>";
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<div class='alert alert-danger' role='alert'>
                                                        Invalid Username/Password!
                                                        </div>";
                                                }
                                            }
                                    ?>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>

</html>