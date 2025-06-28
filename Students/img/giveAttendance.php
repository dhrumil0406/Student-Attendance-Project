
<?php 
    error_reporting(0);
    // include '../Includes/dbcon.php';
    include 'session.php';
    include '../DataBases/globalconn.php';
    session_start();
    date_default_timezone_set("Asia/Kolkata");

    
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
    
    $colname = $_SESSION['colname'];
    // $colname = 'CG_06_03';

    $query = "SELECT * FROM tblsession ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn,$query);
    $rows = mysqli_fetch_assoc($result);

    $curtime = date('h:i A');

    $id = $rows['id'];
    $dbname1 = $rows['dbname'];
    // $dbname2 = 'BCOM_2024_25';
    $class1 = $rows['class'];
    $subject = $rows['subject'];
    $date = $rows['date'];
    $stime = $rows['stime'];
    $etime = $rows['etime'];

    $conn3 = mysqli_connect('localhost','root','',$dbname1);
    if(!$conn3)
    {
        echo "Connetion Fail!";
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

    <body id="page-top" onload="showclass('<?php echo $adno;?>','<?php echo $dbname2;?>','<?php echo $class;?>');">
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
                            <h1 class="h3 mb-0 text-gray-800">Give Attendance of <span class="h4"><?php echo $colname;?></span></h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Give Attendance</li>
                            </ol>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Input Group -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Give Attendance</h6>
                                            </div>
                                            <div class="table-responsive p-3">
                                                <div class="table align-items-center table-flush table-hover ">
                                                    <div class="card-body d-flex align-item-center flex-row justify-content-center" style="height: 100px; background-color: rgba(0,0,0,0.1);border-radius:5px;">
                                                        <div class="col-5">
                                                        <?php
                                                            if($dbname2 == $_GET['dbname2'] && $class1 == $_GET['class'])
                                                            {
                                                                if($curtime >= $stime && $curtime <= $etime)
                                                                {
                                                                    $statusMsg = "<div class='alert alert-success d-flex' style='align-items:center;width: 100%; height: 60px;font-size: 19px;letter-spacing:2px;'>Session Available!</div>";
                                                                    echo '<form action="" method="post">
                                                                            <button class="btn-success" style="width: 80%;height: 60px;" type="submit" name="attend">Submit</button>
                                                                        </form>';
                                                                }
                                                                else
                                                                {
                                                                    $statusMsg = "<div class='alert alert-danger d-flex' style='align-items:center;width: 100%; height: 60px;font-size: 19px;letter-spacing:2px;'>Session Not Available!</div>";
                                                                    echo '<form action="" method="post">
                                                                            <button class="btn btn-success btn-lg" style="width: 80%;height: 60px;" type="submit" name="attend" disabled>Submit</button>
                                                                        </form>';
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $statusMsg = "<div class='alert alert-danger d-flex' style='align-items:center;width: 100%; height: 60px;font-size: 19px;letter-spacing:2px;'>Session Not Available!</div>";
                                                                echo '<form action="" method="post">
                                                                        <button type="submit" class="btn btn-success" style="width: 80%;height: 60px;" name="attend" disabled>Submit</button>
                                                                    </form>';
                                                            }
                                                            ?>
                                                        </div> 
                                                        <?php
                                                            if(isset($_POST['attend']))
                                                            {
                                                                $query = "SELECT * FROM $class1 WHERE adno = '$adno'";
                                                                $result = mysqli_query($conn3, $query);
                                                                $record = mysqli_fetch_assoc($result);
                                                        
                                                                if($record[$colname] == 'P')
                                                                {
                                                                    $statusMsg = "<div class='alert alert-danger d-flex' style='align-items:center;width: 100%;height: 60px;font-size: 19px;letter-spacing:2px;'>Attendance Already Done!</div>";
                                                                }
                                                                else
                                                                {
                                                                    $query = "UPDATE `$class1` SET `$colname`='P' WHERE adno = '$adno'";
                                                                    if(mysqli_query($conn3, $query))
                                                                    {
                                                                        $statusMsg = "<div class='alert alert-success d-flex' style='align-items:center;width: 100%; height: 60px;font-size: 19px;letter-spacing:2px;'>Thank You For Attend Class!</div>";
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                        <div class="col-7 d-flex">
                                                           <?php echo $statusMsg;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Row-->
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

<?php
    
?>