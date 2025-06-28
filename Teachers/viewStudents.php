
<?php 
    error_reporting(0);
    // include '../Includes/dbcon.php';
    include 'session.php';
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
    <link href="../img/logo/icon2.jpg" rel="icon">
    <title>Teacher's Dashboard</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

    <script>
        function studchange(str)
        {
            if (str == "")
            {
                document.getElementById("table").innerHTML = "";
                return;
            }
            else
            {
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    document.getElementById("table").innerHTML = this.responseText;
                };
                xmlhttp.open("GET","ajaxstudchange.php?dbname2="+str);
                xmlhttp.send();
            }
        }

        function helo(key, value){
            const searchparams = new URLSearchParams(window.location.search)
            searchparams.set(key, value)
            const newpath = window.location.pathname + "?" + searchparams.toString()
            history.pushState(null,"",newpath)
        }
    </script>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
            <?php include "Includes/sidebar.php";?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                    <?php include "Includes/topbar.php";?>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All Student in Department</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Student in Department</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Select Department & Year</h6>
                                    <?php echo $statusMsg; ?>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Select Department & Year<span class="text-danger ml-2">*</span></label>
                                                <?php
                                                    $query= "SELECT * FROM tbldbs WHERE deptname LIKE '$_SESSION[deptName]' ";
                                                    $result = mysqli_query($conn, $query);
                                                    $num = mysqli_num_rows($result);
                                                    if ($num > 0)
                                                    {
                                                        ?>
                                                            <!-- <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value) " class="form-control mb-3"> -->
                                                            <select required name="dbname" id="dbchange" onchange="studchange(this.value), helo('dbname2',this.value)" class="form-control mb-3">
                                                        <?php
                                                        echo ' <option value="">--Select Department--</option>';
                                                        while ($rows = mysqli_fetch_assoc($result))
                                                        {
                                                            echo'<option value="'.$rows['dbname'].'">'.$rows['dbname'].'</option>';
                                                        }
                                                        echo '</select>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Input Group -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">All Student In Class</h6>
                                        </div>
                                        <div class="table-responsive p-3">
                                            <table id="table" class="table align-items-center table-flush table-hover" id="dataTableHover">

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Row-->
                    </div>
                    <!---Container Fluid-->
                </div>
                <!-- Footer -->
                    <?php include "Includes/footer.php";?>
                <!-- Footer -->
            </div>
        </div>
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