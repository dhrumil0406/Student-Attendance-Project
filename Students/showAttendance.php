
<?php 
    error_reporting(0);
    // include '../Includes/dbcon.php';
    include 'session.php';
    include '../DataBases/globalconn.php';
    session_start();

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    $class = $_GET['class'];
    $adno = $_SESSION['adNo'];

    $conn2 = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }
   
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
        <title>Student Attendance</title>
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/ruang-admin.min.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script>

            function showclass(str,str2,str3)
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
                    xmlhttp.open("GET","ajaxshowdata.php?adno="+ str +"&dbname2="+ str2 + "&class=" + str3);
                    xmlhttp.send();
                }
            }
            function showclass1(str,str2,str3)
            {
                if (str == "")
                {
                    document.getElementById("table2").innerHTML = "";
                    return;
                }
                else
                {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        document.getElementById("table2").innerHTML = this.responseText;
                    };
                    xmlhttp.open("GET","ajaxshowdata2.php?adno="+ str +"&dbname2="+ str2 + "&class=" + str3);
                    xmlhttp.send();
                }
            }

            setInterval(function(){
                
            },1000);
            function helo(key, value){
                const searchparams = new URLSearchParams(window.location.search)
                searchparams.set(key, value)
                const newpath = window.location.pathname + "?" + searchparams.toString()
                history.pushState(null,"",newpath)
            }
        </script>
    </head>

    <body id="page-top" onload="showclass('<?php echo $adno;?>','<?php echo $dbname2;?>','<?php echo $class;?>');showclass1('<?php echo $adno;?>','<?php echo $dbname2;?>','<?php echo $class;?>');">
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
                            <h1 class="h3 mb-0 text-gray-800">View Attendance</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Attendance</li>
                            </ol>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Input Group -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">View Attendance</h6>
                                            </div>
                                            <div class="table-responsive p-3" id='table'>
                                            </div>
                                            <div class="table-responsive p-3" id='table2'>
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