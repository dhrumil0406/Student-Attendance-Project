
<?php 
error_reporting(0);
// include '../Includes/dbcon.php';
include 'session.php';
include '../Databases/globalconn.php';
session_start();

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    $class = $_GET['class'];

    $conn2 = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <style>
        </style>
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
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script>
            function showclass2(str,str2)
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
                    xmlhttp.open("GET","ajaxshowattend.php?dbname2="+ str + "&class=" + str2);
                    xmlhttp.send();
                }
            }

            function changeclass(str)
            {
                if (str == "")
                {
                    document.getElementById("class").innerHTML = "<option value='--Select Class And Semester--'></option>";
                    return;
                }
                else
                {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        document.getElementById("class").innerHTML = this.responseText;
                        document.getElementById("class1").innerHTML = this.responseText;
                    };
                    xmlhttp.open("GET","ajaxselectclass.php?dbname2="+ str);
                    xmlhttp.send();
                }
            }

            function changesubjects(str)
            {
                if (str == "")
                {
                    document.getElementById("subjects").innerHTML = "";
                    return;
                }
                else
                {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        document.getElementById("subjects").innerHTML = this.responseText;
                    };
                    xmlhttp.open("GET","ajaxselectsubject.php?class="+ str);
                    xmlhttp.send();
                }
            }

            function dispsessions()
            {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function() {
                        document.getElementById("table").innerHTML = this.responseText;
                    };
                    xmlhttp.open("GET","ajaxdisplaysessions.php");
                    xmlhttp.send();
            }

            setInterval(function(){
                
            });
            function helo(key, value){
                const searchparams = new URLSearchParams(window.location.search)
                searchparams.set(key, value)
                const newpath = window.location.pathname + "?" + searchparams.toString()
                history.pushState(null,"",newpath)
            }
        </script>
    </head>

    <body id="page-top" onload="dispsessions();">
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
                            <h1 class="h4 mb-0 text-gray-800">Create Attendance Session For (Today's Date : <?php echo $todaysDate = date("d/m/Y");?>)</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Student In Class</li>
                            </ol>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Form Basic -->
                                <div class="card mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Select Department And Class</h6>
                                        <?php echo $statusMsg; ?>
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-6">
                                                    <label class="form-control-label">Select Department<span class="text-danger ml-2">*</span></label>
                                                    <?php
                                                        $query= "SELECT * FROM tbldbs WHERE deptname LIKE '$_SESSION[deptName]' ORDER BY dbname ASC";
                                                        $result = mysqli_query($conn, $query);
                                                        $num = mysqli_num_rows($result);
                                                        if ($num > 0)
                                                        {
                                                            ?>
                                                                <!-- <select required name="dbname" id="dbname" onchange="helo('dbname2',this.value) " class="form-control mb-3"> -->
                                                                <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value),changeclass(this.value)" class="form-control mb-3">
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
                                                <div class="col-xl-6">
                                                    <label class="form-control-label">Select Class & Semester<span class="text-danger ml-2">*</span></label>
                                                    <select required name="class" id="class" onchange="helo('class',this.value),changesubjects(this.value)" class="form-control mb-3">
                                                        <option value="">--Select Class And Semester--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-6">
                                                    <label class="form-control-label">Select Subject<span class="text-danger ml-2">*</span></label>
                                                    <select required name="subjectName" id="subjects" onchange="helo('subject',this.value)" class="form-control mb-3">
                                                        <option value="">--Select Subject--</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label class="form-control-label">Date<span class="text-danger ml-2">*</span></label>
                                                    <input type="text" name="date" value="<?php echo date('d-m-Y')?>" class="form-control mb-3">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-6">
                                                    <?php 
                                                        date_default_timezone_set("Asia/Kolkata");
                                                        $t = date('i')+1;
                                                    ?>
                                                    <label class="form-control-label">Select Start Time<span class="text-danger ml-2">*</span></label>
                                                    <input type="text" name="stime" class="form-control mb-3" value="<?php echo date('h:i A');?>">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label class="form-control-label">Select End Time<span class="text-danger ml-2">*</span></label>
                                                    <input type="text" name="etime" class="form-control mb-3" value="<?php echo date('h:').$t.date(' A');?>">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-6">
                                                    <button type="Submit" data-bs-toggle="modal" data-bs-target="#exampleModal" name="add" class="btn btn-primary" >Create Session</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <?php
                                    if(isset($_POST['dbname']))
                                    {
                                        $dbname2 = $_POST['dbname'];
                                    }
                                    if(isset($_POST['subjectName']))
                                    {
                                        $subject = $_POST['subjectName'];
                                    }

                                    if(isset($_POST['class']))
                                    {
                                        $class = $_POST['class'];
                                    }

                                    if(isset($_POST['add']))
                                    {
                                        $conn2 = mysqli_connect('localhost', 'root', '', $dbname2);
                                        if(!$conn2)
                                        {
                                            echo "connection error!";
                                        }
                                        $dt = date('d_m');
                                        $col_name = $subject . '_' . $dt;

                                        $query1 = "ALTER TABLE `$class` ADD `$col_name` varchar(255) DEFAULT 'A';";
                                        if(mysqli_query($conn2,$query1))
                                        {
                                            $_SESSION['dbname'] = $dbname2;
                                            $_SESSION['class'] = $class;
                                            $_SESSION['colname'] = $col_name;
                                        }
                                        else
                                        {
                                            echo "<script>
                                                    alert('Attendance Fail...');
                                                </script>";
                                        }

                                        $date = $_POST['date'];
                                        $stime = $_POST['stime'];
                                        $etime = $_POST['etime'];

                                        $query = "INSERT INTO `tblsession`(`dbname`, `class`, `subject`, `date`, `stime`, `etime`) VALUES ('$dbname2','$class','$subject','$date','$stime','$etime')";
                                        if(mysqli_query($conn, $query))
                                        {
                                            $statusMsg = "<div class='alert alert-success'  style='margin-right: 500px;'>Session Created Successfully!</div>";
                                        }
                                        else
                                        {
                                            $statusMsg = "<div class='alert alert-success'  style='margin-right: 500px;'>Session Creating Fail!</div>";
                                        }
                                    }
                                ?>

                                <!-- Input Group -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Attendance Session Of <?php echo $_SESSION['deptName'] ?> Department</h6>
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