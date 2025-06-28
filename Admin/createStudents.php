
<?php 
error_reporting(0);
// include '../Includes/dbcon.php';
include 'session.php';
include '../DataBases/globalconn.php';

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];

    $conn = mysqli_connect($hostname, $user, $pass, 'GLOBAL');
    if(!$conn)
    {
        echo "connection error!";
    }

    $conn2 = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }

   
//------------------------SAVE--------------------------------------------------

if(isset($_POST['save']))
{

    // $fileName = $_FILES["file"]["name"];
    $fileName = $_POST["file"];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads/" . $fileName;
    // if(move_uploaded_file('/Applications/XAMPP/xamppfiles/htdocs/Student Attendance Project/Admin/', $targetDirectory))
    // {
    //     echo "helo";
    // }
    // else
    // {
    //     echo "How";
    // }

    error_reporting(0);
    ini_set('display_errors', 0);

    require 'excelReader/excel_reader2.php';
    require 'excelReader/SpreadsheetReader.php';

    if($fileExtension == 'csv')
    {
        $reader = new SpreadsheetReader($targetDirectory);
    }
    else
    {
        $statusMsg = "<div class='alert alert-success' style='margin-right: 700px;'>Only csv File Allowed!</div>";
    }
    foreach($reader as $key => $row)
    {
        $fName = $row['0'];
        $mName = $row['1'];
        $lName = $row['2'];
        $adNo = $row['3'];
        $email = $row['4'];
        $dbname = $row['5'];
        $class = $row['6'];
        $adDate = $row['7'];
        $batch = $row['8'];
        $password = $row['9'];
        $password = password_hash($password, PASSWORD_DEFAULT);

        $fullname = $fName . ' ' . $lName;
        if($row['0'] == 'fname')
        {

        }
        else
        {
            $sl = "SELECT * FROM `Students` WHERE adno = '$adNo' and class = '$class'";
            $sl2 = "SELECT * FROM `$class` WHERE adno = '$adNo' and class = '$class'";
            $sl3 = "SELECT * FROM `tblstudents` WHERE adno = '$adNo' and class = '$class'";
            $query = mysqli_query($conn2, $sl);
            $query2 = mysqli_query($conn2, $sl2);
            $query3 = mysqli_query($conn, $sl3);
            $result = mysqli_fetch_array($query);
            $result2 = mysqli_fetch_array($query2);
            $result3 = mysqli_fetch_array($query3);

            $queryr = "SELECT * FROM `$class`";
            $resultr = mysqli_query($conn2, $queryr);
            $numrow = mysqli_num_rows($resultr);
    

            if($result > 0 or $result2 > 0 or $result3 > 0)
            { 
                $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>Student ID $adNo Already Exists!</div>";
            }
            else
            {
                $rno = $numrow + 1;
                $sql = "INSERT INTO `Students`(`fname`, `mname`, `lname`, `adno`, `email`, `dbname`, `class`, `addate`, `batch`, `password`) VALUES ('$fName','$mName','$lName','$adNo','$email','$dbname','$class','$adDate','$batch','$password')";
                $sql3 = "INSERT INTO `tblstudents`(`fname`, `mname`, `lname`, `adno`, `email`, `dbname`, `class`, `addate`, `batch`, `password`) VALUES ('$fName','$mName','$lName','$adNo','$email','$dbname','$class','$adDate','$batch','$password')";
                $sql2 = "INSERT INTO `$class`(`rno`, `fullname`, `adno`, `class`) VALUES ('$rno','$fullname','$adNo','$class')";
                if(mysqli_query($conn2, $sql) and mysqli_query($conn2, $sql2) and mysqli_query($conn, $sql3))
                {
                    $statusMsg = "<div class='alert alert-success'  style='margin-right:600px;'>Student Added Successfully!</div>";
                }
                else
                {
                    $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>An error Occurred!</div>";
                }
            }
        }
    }
}

if(isset($_GET['edit']) && $_GET['edit'] == "updated")
{
    $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>Student Data Updated Successfully!</div>";
}

//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
{
    $Id= $_GET['Id'];
    $class = $_GET['class'];
    // echo "hello " . $id . $class;
    $query = mysqli_query($conn2, "DELETE FROM Students WHERE id = '$Id'");
    $query2 = mysqli_query($conn2, "DELETE FROM tblstudents WHERE id = '$Id'");
    $query3 = mysqli_query($conn2, "DELETE FROM `$class` WHERE id = '$Id'");

    if ($query == TRUE && $query2 == TRUE && $query3 == TRUE)
    {
        echo "<script type = \"text/javascript\">
                window.location = (\"createStudents.php?dbname2=BCA_2024_25\")
                </script>";
    }
    else
    {
        $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>An error Occurred!</div>"; 
    }
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
    <?php include 'includes/title.php';?>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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
            xmlhttp.open("GET","ajaxstudchange.php?dbname="+str);
            xmlhttp.send();
            }
        }

        function change(str)
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

        $(document).ready(function(){
            var dbname = "";
            $("#dbchange").change(function(){
                dbname = $(this).val();
                // year = dbname.slice(-7);
                db = dbname.replace(/[0-9_]/g,"");
                $("#deptname").val(db);
            });
        });

        function helo(key, value){
                const searchparams = new URLSearchParams(window.location.search)
                searchparams.set(key, value)
                const newpath = window.location.pathname + "?" + searchparams.toString()
                history.pushState(null,"",newpath)
        }

        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')
        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus();
        });
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
                        <h1 class="h3 mb-0 text-gray-800">Add Students</h1>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Students</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Students</h6>
                                    <?php echo $statusMsg; ?>
                                    <?php $statusMsg1 = "<button type='button' data-bs-toggle='modal' data-bs-target='#exampleModal' name='btn-help' class='alert alert-success' style='margin-right: ;'>!Help</button>";?>
                                    <?php echo $statusMsg1; ?>
                                    <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">How to add data in csv file...</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none;background-color: white;font-size:20px;">X</button>
                                                    </div>
                                                    <div class="modal-body" style="padding: 10px 10px; font-size: 12px;">
                                                        <h6>Data must be of same class...</h6>
                                                        <center>
                                                        <table border='1' >
                                                            <tr>
                                                                <th style="padding: 5px 10px;">Fname</th>
                                                                <th style="padding: 5px 10px;">Mname</th>
                                                                <th style="padding: 5px 10px;">Lname</th>
                                                                <th style="padding: 5px 10px;">AdNo</th>
                                                                <th style="padding: 5px 10px;">Email</th>
                                                                <th style="padding: 5px 10px;">Dept</th>
                                                                <th style="padding: 5px 10px;">Class</th>
                                                                <th style="padding: 5px 10px;">Date</th>
                                                                <th style="padding: 5px 10px;">Aced-Year</th>
                                                                <th style="padding: 5px 10px;">Password</th>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 5px 10px;">Jonsan</td>
                                                                <td style="padding: 5px 10px;">Devil</td>
                                                                <td style="padding: 5px 10px;">Patil</td>
                                                                <td style="padding: 5px 10px;">AD0019</td>
                                                                <td style="padding: 5px 10px;">jonsan@gmail.com</td>
                                                                <td style="padding: 5px 10px;">BCA_2024_25</td>
                                                                <td style="padding: 5px 10px;">BCAS2D1</td>
                                                                <td style="padding: 5px 10px;">01/07/2023</td>
                                                                <td style="padding: 5px 10px;">2023-26</td>
                                                                <td style="padding: 5px 10px;">pass123</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 5px 10px;">Jenil</td>
                                                                <td style="padding: 5px 10px;">B</td>
                                                                <td style="padding: 5px 10px;">Jadav</td>
                                                                <td style="padding: 5px 10px;">AD0020</td>
                                                                <td style="padding: 5px 10px;">jenil@gmail.com</td>
                                                                <td style="padding: 5px 10px;">BCA_2024_25</td>
                                                                <td style="padding: 5px 10px;">BCAS2D1</td>
                                                                <td style="padding: 5px 10px;">01/07/2023</td>
                                                                <td style="padding: 5px 10px;">2023-26</td>
                                                                <td style="padding: 5px 10px;">pass123</td>
                                                            </tr>
                                                        </table>
                                                    </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-body">
                                    <form method="post">

                                        <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Select Department<span class="text-danger ml-2">*</span></label>
                                                <?php
                                                    $query= "SELECT * FROM tbldbs ORDER BY dbname ASC";
                                                    $result = mysqli_query($conn, $query);
                                                    $num = mysqli_num_rows($result);		
                                                    if ($num > 0)
                                                    {
                                                        ?>
                                                            <!-- <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value) " class="form-control mb-3"> -->
                                                            <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value),change(this.value)" class="form-control mb-3">
                                                        <?php
                                                        echo ' <option value="">--Select Department--</option>';
                                                        while ($rows = mysqli_fetch_assoc($result))
                                                        {
                                                            echo'<option value="'.$rows['dbname'].'">'.$rows['dbname'].'</option>';
                                                        }
                                                        echo '</select>';
                                                    }
                                                    else
                                                    {
                                                        echo '
                                                            <select required name="dbname" id="dbchange" onchange="change(this.value), helo("dbname2", this.value)" class="form-control mb-3">
                                                                <option value="">--No Department--</option>
                                                            </select>
                                                        ';
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Select Class & Semester<span class="text-danger ml-2">*</span></label>
                                                <select required name="class" id="class" onchange="helo('class',this.value)" class="form-control mb-3">
                                                    <option value="">--Select Class And Semester--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Select Csv File<span class="text-danger ml-2">*</span></label>
                                                <input type="file" name="file" required class="form-control mb-3">
                                                <!-- <input type="text" name ="file" required class="form-control mb-3"/> -->
                                            </div>
                                        </div>
                                        <?php
                                            if (isset($Id))
                                            {
                                                ?>
                                                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                                                <?php
                                            }         
                                        ?>
                                    </form>
                                </div>
                            </div>

                            <!-- Input Group -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">All Student</h6>
                                        </div>
                                        <div class="table-responsive p-3">
                                            <div class="table-responsive p-3">
                                                <div class="form-group row mb-3">
                                                    <div class="col-xl-6">
                                                        <label class="form-control-label">Show Classes with Department<span class="text-danger ml-2">*</span></label>
                                                        <?php
                                                            $query= "SELECT * FROM tbldbs ORDER BY dbname ASC";
                                                            $result = mysqli_query($conn, $query);
                                                            $num = mysqli_num_rows($result);		
                                                            if ($num > 0){
                                                                ?>
                                                                <!-- <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value) " class="form-control mb-3"> -->
                                                                    <select required name="dbname" id="dbchange" onchange="studchange(this.value),helo('class',this.value)" class="form-control mb-3">
                                                                        <?php
                                                                echo ' <option value="">--Select Department--</option>';
                                                                while ($rows = mysqli_fetch_assoc($result)){
                                                                    echo'<option value="'.$rows['dbname'].'">'.$rows['dbname'].'</option>';
                                                                }
                                                                echo '</select>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <table id="table" class="table align-items-center table-flush table-hover" id="dataTableHover">
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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