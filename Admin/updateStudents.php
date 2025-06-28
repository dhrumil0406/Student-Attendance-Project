
<?php 
error_reporting(0);
// include '../Includes/dbcon.php';
include 'session.php';
include '../DataBases/globalconn.php';

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    // $dbname2 = 'BCA_2024_25';

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

// if(isset($_POST['save']))
// {

//     $fName = $_POST['fName'];
//     $mName = $_POST['mName'];
//     $lName = $_POST['lName'];
//     $adNo = $_POST['adNo'];
//     $dbname = $_POST['dbname'];
//     $class = $_POST['class'];
//     $adDate = $_POST['adDate'];
//     // $a = date('y')+3;
//     // $batch = date('Y-').$a;
//     $batch = $_POST['batch'];

//     $fullname = $fName . ' ' . $lName;
    
//     $sl = "SELECT * FROM `Students` WHERE adno = '$adNo' and class = '$class'";
//     $sl3 = "SELECT * FROM `tblstudents` WHERE adno = '$adNo' and class = '$class'";
//     $sl2 = "SELECT * FROM `$class` WHERE adno = '$adNo' and class = '$class'";
//     $query = mysqli_query($conn2, $sl);
//     $query2 = mysqli_query($conn2, $sl2);
//     $query3 = mysqli_query($conn, $sl3);
//     $result = mysqli_fetch_array($query);
//     $result2 = mysqli_fetch_array($query2);
//     $result3 = mysqli_fetch_array($query3);

//     $queryr = "SELECT * FROM `$class`";
//     $resultr = mysqli_query($conn2, $queryr);
//     $numrow = mysqli_num_rows($resultr);
//     $password = "pass123";
//     $password = password_hash($password, PASSWORD_DEFAULT);

//     if($result > 0 or $result2 > 0 or $result3 > 0)
//     { 
//         $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>This Student Already Exists!</div>";
//     }
//     else
//     {
//         $rno = $numrow + 1;
//         $sql = "INSERT INTO `Students`(`fname`, `mname`, `lname`, `adno`, `dbname`, `class`, `addate`, `batch`, `password`) VALUES ('$fName','$mName','$lName','$adNo','$dbname','$class','$adDate','$batch','$password')";
//         $sql3 = "INSERT INTO `tblstudents`(`fname`, `mname`, `lname`, `adno`, `dbname`, `class`, `addate`, `batch`, `password`) VALUES ('$fName','$mName','$lName','$adNo','$dbname','$class','$adDate','$batch','$password')";
//         $sql2 = "INSERT INTO `$class`(`rno`, `fullname`, `adno`, `class`) VALUES ('$rno','$fullname','$adNo','$class')";
//         if(mysqli_query($conn2, $sql) and mysqli_query($conn2, $sql2) and mysqli_query($conn, $sql3))
//         {
//             $statusMsg = "<div class='alert alert-success'  style='margin-right:600px;'>Student Added Successfully!</div>";
//         }
//         else
//         {
//             $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>An error Occurred!</div>";
//         }
//     }
// }

//---------------------------------------EDIT-------------------------------------------------------------




//--------------------EDIT------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
{
    $Id = $_GET['Id'];
    // $class = $_GET['class'];

    $query = mysqli_query($conn2, "SELECT * FROM students WHERE id = '$Id'");
    $row = mysqli_fetch_array($query);

    // ------------UPDATE-----------------------------

    if(isset($_POST['update'])){
        $Id = $_GET['Id'];
    
        $fName = $_POST['fName'];
        $mName = $_POST['mName'];
        $lName = $_POST['lName'];
        $adNo = $_POST['adNo'];
        $email = $_POST['email'];
        // $dbname = $_POST['dbname'];
        $class = $_row['class'];
        // $adDate = $_POST['adDate'];
        // $batch = $_POST['batch'];
    
        $classs = $_GET['class'];
        $fullname = $fName . ' ' . $lName;

        $query = mysqli_query($conn2," UPDATE `Students` SET `fname`='$fName',`mname`='$mName',`lname`='$lName',`adno`='$adNo',`email`='$email' WHERE id = $Id;");
        $query3 = mysqli_query($conn," UPDATE `tblstudents` SET `fname`='$fName',`mname`='$mName',`lname`='$lName',`adno`='$adNo',`email`='$email' WHERE id = $Id;");
        $query2 = mysqli_query($conn2, "UPDATE `$classs` SET `fullname`='$fullname',`adno`='$adNo',`class`='$class' WHERE id = $Id;");
        if ($query && $query2 &&$query3) {
            echo "<script type = 'text/javascript'>
                    window.location = (\"createStudents.php?dbname2=BCA_2024_25&edit=updated\")
                    </script>"; 
        }
        else
        {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>An error Occurred!</div>";
        }
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
                        <h1 class="h3 mb-0 text-gray-800">Update Student</h1>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Student</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Student Details</h6>
                                    <?php echo $statusMsg; ?>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                    <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Department<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" name="dbname" value="<?php echo "$row[dbname]";?>" id="exampleInputFirstName" disabled>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Class & Semester<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" name="class" value="<?php echo "$row[class]";?>" id="exampleInputFirstName" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" name="fName" value="<?php echo "$row[fname]";?>" id="exampleInputFirstName" >
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Middle Name<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" name="mName" value="<?php echo "$row[mname]";?>" id="exampleInputFirstName" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" name="lName" value="<?php echo "$row[lname]";?>" id="exampleInputFirstName" >
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Email Id<span class="text-danger ml-2">*</span></label>
                                                <input type="email" class="form-control" name="email" value="<?php echo "$row[email]";?>" id="exampleInputFirstName" >
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Admission Number<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" required name="adNo" value="<?php echo "$row[adno]";?>" id="exampleInputFirstName" disabled >
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Addmission Date<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" required name="adDate" value="<?php echo "$row[addate]";?>" id="exampleInputFirstName" disabled>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row mb-3">
                                            
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Batch<span class="text-danger ml-2">*</span></label>
                                                <input type="text" class="form-control" required name="batch" placeholder="2021-24" value="<?php echo "$row[batch]";?>" id="exampleInputFirstName" >
                                            </div>
                                        </div> -->
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