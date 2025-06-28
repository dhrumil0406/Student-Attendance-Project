
<?php 
// include '../Includes/dbcon.php';
    include 'session.php';
    include '../DataBases/globalconn.php';
    session_start();

    $fullName = $_SESSION['studentFirstName'] .' '. $_SESSION['studentLastName'];
    $adNo = $_SESSION['adNo'];

    $query = "SELECT * FROM `tblstudents` WHERE adno = '$adNo'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($result);

    $dbname2 = $rows['dbname'];
    $class = $rows['class'];

    $conn2 = mysqli_connect('localhost','root','',$dbname2);
    if(!$conn2)
    {
        echo "Connection Fail...";
    }

    $query = "SELECT * FROM $class WHERE adno = '$adNo'";
    $result = mysqli_query($conn2, $query);
    $rows = mysqli_fetch_assoc($result);
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
    <title>Student's Dashboard</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Welcome, <?php echo $fullName; ?></b></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>

                    <div class="row mb-3">
                        <!-- New User Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Name</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $rows['fullname'];?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                                                <span>Since last month</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Class</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $rows['class'];?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                                <span>Since last month</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Annual) Card Example -->
                        <?php 
                            $i = 0;
                            $c = array();
                            $d = array();
                            while ($i < mysqli_num_fields($result))
                            {
                                $col = mysqli_fetch_field($result);
                                $colname = $col->name;
                                if($i >= 5)
                                {
                                    array_push($c, $colname);
                                }
                                $i = $i + 1;
                            }
                            $len = count($c);
                            $p = 0;
                            $a = 0;
                           
                            $query1 = "SELECT * FROM `$class` WHERE adno = '$adNo'";
                            $result = mysqli_query($conn2, $query);
                            while($rows = mysqli_fetch_assoc($result))
                            {
                                for($j=0;$j<$len;$j++)
                                {
                                    if($rows[$c[$j]] == 'P')
                                    {
                                        $p++;
                                    }
                                    else
                                    {
                                        $a++;
                                    }
                                }
                            }
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Attendance</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $p;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                                <span>Since last years</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Pending Requests Card Example -->
                        <?php 
                            // $query1=mysqli_query($conn,"SELECT * from tblattendance where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]'");                       
                            // $totAttendance = mysqli_num_rows($query1);
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Leaves</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $a;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                                <span>Since yesterday</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Container Fluid-->
                </div>
                <!-- Footer -->
                    <?php include 'includes/footer.php';?>
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
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
</body>

</html>