
<?php 
    error_reporting(0);
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
        <link href="../img/logo/icon2.jpg" rel="icon">
        <title>Forget Password</title>
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/ruang-admin.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/profile.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.second-box').hide();
            });
        </script>
    </head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->
                    <!-- Topbar -->

                    <!-- Container Fluid-->
                    
                    <div class="container-login my-5">
                        <div class="row justify-content-center my-5">
                            <div class="col-xl-10 col-lg-12 col-md-9 my-5">
                                <div class="card shadow-sm my-5 p-4">
                                    <!-- Input Group -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h3 class="m-0 font-weight-bold text-primary">Reset Password</h3>
                                    </div>
                                    <div class="card-body py-1">
                                        <?php 
                                            include "ajaxforgetpass.php";
                                        ?>
                                        <form method="Post" action="" class="first-box">
                                            <div id="err">
                                                <?php
                                                    echo $errmsg;
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required class="form-control" name="adno" id="adno" placeholder="Enter Student Id" value="<?php echo $adno; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" value="<?php echo $email; ?>">
                                            </div>
                                            <div class="form-group">
                                                <a href="index.php">Login!</a>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-block" value="Send OTP" name="next" style="font-size: 20px;"/>
                                            </div>
                                        </form>

                                        <form action="" method="post" class="second-box">
                                            <div id="err">
                                                <?php
                                                    echo $errmsg;
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control second-box" name="password" id="password" placeholder="Enter Password" value="<?php echo $password; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control second-box" name="cpassword" id="cpassword" placeholder="Enter Confirm Password" value="<?php echo $cpassword; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control second-box" name="otp" id="otp" placeholder="Enter OTP" value="<?php echo $otp; ?>">
                                            </div>
                                            <div class="form-group">
                                                <a href="index.php" class="second-box">Login!</a>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-block second-box" value="Save" name="save" style="font-size: 20px;"/>
                                            </div>
                                        </form>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Row-->
            </div>
            <!---Container Fluid-->
        </div>

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/ruang-admin.min.js"></script>
        <!-- Page level plugins -->
        <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable(); // ID From dataTable 
                $('#dataTableHover').DataTable(); // ID From dataTable with Hover
            });
        </script>
    </body>
</html>