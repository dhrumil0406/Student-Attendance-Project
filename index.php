<?php 
// include 'Includes/dbcon.php';
    include 'DataBases/globalconn.php';
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
    <link href="img/logo/icon2.jpg" rel="icon">
    <title>Attendance System - Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

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
                                        <img src="img/logo/icon2.jpg" style="width:120px;height:120px">
                                        <br><br>
                                        <h1 class="h4 text-gray-900 mb-4" style="margin-top: -30px;">Login</h1>
                                    </div>
                                    <form class="user" method="Post" action="">
                                        <div class="form-group">
                                            <select required name="userType" class="form-control mb-3">
                                                <option value="">--Select User Roles--</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="Teacher">Teacher</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Enter Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control" id="exampleInputPassword" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <a href="forgetpass.php">Forget Password</a>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-block" value="Login" name="login" />
                                        </div>
                                    </form>

                                    <?php
                                        if(isset($_POST['login']))
                                        {
                                            $userType = $_POST['userType'];
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];

                                            if($userType == "Administrator")
                                            {
                                                $query = "SELECT * FROM `tbladmin` WHERE email = '$username'";
                                                $rs = $conn->query($query);
                                                $num = $rs->num_rows;
                                                $rows = $rs->fetch_assoc();

                                                if($num > 0)
                                                {
                                                    if($password == $rows['password'])
                                                    {
                                                        $_SESSION['adminId'] = $rows['id'];
                                                        $_SESSION['adminFirstName'] = $rows['fname'];
                                                        $_SESSION['adminLastName'] = $rows['lname'];
                                                        $_SESSION['adminEmail'] = $rows['email'];

                                                        echo "<script type = \"text/javascript\">
                                                                window.location = (\"Admin/index.php\")
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
                                            else if($userType == "Teacher")
                                            {
                                                $query = "SELECT * FROM `tblteachers` WHERE email = '$username'";
                                                $rs = $conn->query($query);
                                                $num = $rs->num_rows;
                                                $rows = $rs->fetch_assoc();
                                                if($num > 0)
                                                {
                                                    if(password_verify($password,$rows['password']))
                                                    {
                                                        $_SESSION['teacherId'] = $rows['id'];
                                                        $_SESSION['teacherFirstName'] = $rows['fname'];
                                                        $_SESSION['teacherLastName'] = $rows['lname'];
                                                        $_SESSION['teacherEmail'] = $rows['email'];
                                                        $_SESSION['deptName'] = $rows['deptname'];
                                                        $_SESSION['class2'] = $rows['class'];
                                                        
                                                        echo "<script type = \"text/javascript\">
                                                            window.location = (\"Teachers/index.php\")
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