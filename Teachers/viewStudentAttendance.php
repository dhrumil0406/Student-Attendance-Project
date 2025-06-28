
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script>
            function showclass(str,str2,str3,str4,str5)
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
                    xmlhttp.open("GET","ajaxclassattendance.php?Idd="+ str +"&dbname2="+ str2 + "&class=" + str3 + "&subject=" + str4 + "&student=" + str5);
                    xmlhttp.send();
                }
            }

            function changeclass(str)
            {
                if (str == "")
                {
                    document.getElementById("class").innerHTML = "";
                    return;
                }
                else
                {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        document.getElementById("class").innerHTML = this.responseText;
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

            function changestudents(str,str2)
            {
                if (str == "")
                {
                    document.getElementById("students").innerHTML = "";
                    return;
                }
                else
                {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        document.getElementById("students").innerHTML = this.responseText;
                    };
                    xmlhttp.open("GET","ajaxselectstudent.php?class="+ str +"&dbname2="+ str2);
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
                            <h1 class="h3 mb-0 text-gray-800">View Student Attendance</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Student Attendance</li>
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
                                            <?php
                                                if(isset($_POST['dbname']))
                                                {
                                                    $dbname2 = $_POST['dbname'];
                                                }
                                                
                                                if(isset($_POST['class']))
                                                {
                                                    $class = $_POST['class'];
                                                }

                                                if(isset($_POST['subjectName']))
                                                {
                                                    $subject = $_POST['subjectName'];
                                                }

                                                if(isset($_POST['studentName']))
                                                {
                                                    $student = $_POST['studentName'];
                                                }
                                            ?>
                                        <form method="post">
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-6">
                                                    <label class="form-control-label">Select Department<span class="text-danger ml-2">*</span></label>
                                                    <?php
                                                        $query= "SELECT * FROM tbldbs WHERE deptname LIKE '$_SESSION[deptName]'";
                                                        $result = mysqli_query($conn, $query);
                                                        $num = mysqli_num_rows($result);
                                                        if ($num > 0)
                                                        {
                                                            ?>
                                                                <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value),changeclass(this.value),showclass(1,this.value,'<?php echo $class; ?>','<?php echo $subject; ?>','<?php echo $student; ?>')" class="form-control mb-3">
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
                                                    <select required name="class" id="class" onchange="helo('class',this.value),changesubjects(this.value),changestudents(this.value,'<?php echo $dbname2;?>'),showclass(2,'<?php echo $dbname2; ?>',this.value,'<?php echo $subject; ?>','<?php echo $student; ?>')" class="form-control mb-3">
                                                        <option value="">--Select Class And Semester--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-6">
                                                    <label class="form-control-label">Select Student<span class="text-danger ml-2">*</span></label>
                                                    <select name="studentName" id="students" onchange="helo('student',this.value),showclass(4,'<?php echo $dbname2;?>','<?php echo $class; ?>','<?php echo $subject; ?>',this.value)" class="form-control mb-3">
                                                        <option value="">--Select Student Name--</option>
                                                    </select>
                                                </div>
                                                <!-- <div class="col-xl-6">
                                                    <label class="form-control-label">Select Subject<span class="text-danger ml-2">*</span></label>
                                                    <select name="subjectName" id="subjects" onchange="helo('subject',this.value),showclass(3,'<?php echo $dbname2; ?>','<?php echo $class; ?>',this.value,'<?php echo $student; ?>')" class="form-control mb-3">
                                                        <option value="">--Select Subject--</option>
                                                    </select>
                                                </div> -->
                                                <!-- <div id="ab"></div> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Input Group -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Student Attendance</h6>
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