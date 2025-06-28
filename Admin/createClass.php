<?php 
error_reporting(0);
// include '../Includes/dbcon.php';
include 'session.php';
include '../DataBases/globalconn.php';

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    // $dbname2 = 'BCOM_2024_25';

    $conn2 = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }
//--------------------------------SAVE------------------------------------------

if(isset($_POST['save']))
{  //edit this code
  
    $dbname = $_POST['dbname'];
    $deptname = $_POST['deptname'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $div = $_POST['div'];
  
    $sql = "select * from `classes` where deptname = '$deptname' &&  semester = '$sem' && division = '$div'";
    $query = mysqli_query($conn2, $sql);
    $result = mysqli_fetch_array($query);

    if($result > 0)
    { 
        $statusMsg = "<div class='alert alert-danger' style='margin-right:500px;'>This Class Already Exists!</div>";
    }
    else
    {
      $query = "INSERT INTO `$dbname2`.`classes`(`dbname`, `deptname`, `year`, `semester`, `division`) VALUES ('$dbname','$deptname','$year','$sem','$div')";
      
      $tblname = $deptname . 'S' . $sem . 'D' . $div;
      $query2 = "CREATE TABLE `$tblname` (`id` INT(5) NOT NULL AUTO_INCREMENT, `rno` INT(5) NOT NULL , `fullname` VARCHAR(30) NOT NULL , `adno` VARCHAR(10) NOT NULL , `class` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`))";
      if (mysqli_query($conn2, $query) && mysqli_query($conn2, $query2))
      {    
          $statusMsg = "<div class='alert alert-success' style='margin-right:600px;'>Class Created Successfully!</div>";
      }
      else
      {
          $statusMsg = "<div class='alert alert-danger' style='margin-right:500px;'>An error Occurred!</div>";
      }
    }
}

//---------------------------------------EDIT-------------------------------------------------------------





//--------------------EDIT------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
{
    $Id = $_GET['Id'];

    $query = mysqli_query($conn2, "select * from classes where id = '$Id'");
    $row = mysqli_fetch_array($query);

    $oldclass = $row['deptname'] . 'S' .$row['semester'] .'D' . $row['division'];
    // echo $oldclass;
    //------------UPDATE-----------------------------

    if(isset($_POST['update']))
    {
      $dbname = $_POST['dbname'];
      $deptname = $_POST['deptname'];
      $year = $_POST['year'];
      $sem = $_POST['sem'];
      $div = $_POST['div'];

      $class = $deptname . 'S' . $sem . 'D' . $div;
      $query = mysqli_query($conn2, "UPDATE `classes` SET `dbname`='$dbname',`deptname`='$deptname',`year`='$year',`semester`='$sem',`division`='$div' where id = '$Id'");
      $query2 = mysqli_query($conn2, "ALTER TABLE `$oldclass` RENAME TO `$class`");
      if ($query == TRUE && $query2 == TRUE) 
      {
          $statusMsg = "<div class='alert alert-success' style='margin-right:600px;'>Class Updated Successfully!</div>";
          echo "<script type = \"text/javascript\">
                window.location = (\"createClass.php\")
                </script>"; 
      }
      else
      {
          $statusMsg = "<div class='alert alert-danger' style='margin-right:500px;'>An error Occurred!</div>";
      }
    }
}


//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
{
    $Id = $_GET['Id'];

    $query = mysqli_query($conn2, "select * from `classes` where id = '$Id'");
    $row = mysqli_fetch_array($query);

    $tblname = $_GET['class'];
    $query2 = mysqli_query($conn2, "DELETE FROM classes WHERE id = '$Id'");
    $query3 = mysqli_query($conn2, "DROP TABLE $tblname");

    if ($query2 == true && $query3 == true)
    {
      echo "<script type = \"text/javascript\">
            window.location = (\"createClass.php\")
            </script>";
    }
    else
    {
      $statusMsg = "<div class='alert alert-danger' style='margin-right:500px;'>An error Occurred!</div>"; 
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
      function deptDropdown(str)
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
          xmlhttp.open("GET","ajaxdeptchange.php?dbname="+str);
          xmlhttp.send();
        }
      }

      $(document).ready(function(){
        var dbname = "";
        $("#dbchange").change(function(){
            dbname = $(this).val();
            year = dbname.slice(-7);
            db = dbname.replace(/[0-9_]/g,"");
            $("#deptname").val(db);
            $("#year").val(year);
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
                      <h1 class="h3 mb-0 text-gray-800">Create Class</h1>
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Class</li>
                      </ol>
                    </div>

                  <div class="row">
                    <div class="col-lg-12">
                      <!-- Form Basic -->
                      <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Create Class</h6>
                            <?php echo $statusMsg; ?>
                        </div>
                        <div class="card-body">
                          <form method="post">
                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                  <label class="form-control-label">Select Department & Year<span class="text-danger ml-2">*</span></label>
                                  <?php
                                    $query= "SELECT * FROM tbldbs ORDER BY dbname ASC";
                                    $result = mysqli_query($conn, $query);
                                    $num = mysqli_num_rows($result);		
                                    if ($num > 0)
                                    {
                                      ?>
                                        <!-- <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value) " class="form-control mb-3"> -->
                                        <select required name="dbname" id="dbchange" onchange="deptDropdown(this.value), helo('dbname2', this.value)" class="form-control mb-3">
                                      <?php
                                      echo ' <option value="">--Select Department--</option>';
                                        while ($rows = mysqli_fetch_assoc($result)){
                                          echo'<option value="'.$rows['dbname'].'">'.$rows['dbname'].'</option>';
                                        }
                                      echo '</select>';
                                    }
                                    else
                                    {
                                        echo '
                                            <select required name="dbname" id="dbchange" onchange="deptDropdown(this.value), helo("dbname2", this.value)" class="form-control mb-3">
                                              <option value="">--No Department--</option>
                                            </select>
                                        ';
                                    }
                                  ?>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Department Name<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" name="deptname" value="<?php echo $row['deptname'];?>" id="deptname" placeholder="Ex: BCA">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                    <label class="form-control-label">Acadamic Year<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" name="year" value="<?php echo $row['year'];?>" id="year" placeholder="Ex: 2023_24">
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Select Semester<span class="text-danger ml-2">*</span></label>
                                    <select required name="sem" class="form-control mb-3">
                                        <option value="">--Select Semester--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                <label class="form-control-label">Select Division<span class="text-danger ml-2">*</span></label>
                                    <select required name="div" class="form-control mb-3">
                                        <option value="">--Select Division--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
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
                            <h6 class="m-0 font-weight-bold text-primary">All Classes</h6>
                          </div>
                            <div class="table-responsive p-3">
                              <div class="form-group row mb-3">
                                  <div class="col-xl-6">
                                    <label class="form-control-label">Show Classes with Department<span class="text-danger ml-2">*</span></label>
                                    <?php
                                      $query= "SELECT * FROM tbldbs ORDER BY dbname ASC";
                                      $result = mysqli_query($conn, $query);
                                      $num = mysqli_num_rows($result);		
                                      if ($num > 0)
                                      {
                                        ?>
                                          <!-- <select required name="dbname" id="dbchange" onchange="helo('dbname2',this.value) " class="form-control mb-3"> -->
                                          <select required name="dbname" id="dbchange" onchange="deptDropdown(this.value)" class="form-control mb-3">
                                        <?php
                                        echo ' <option value="">--Select Department--</option>';
                                          while ($rows = mysqli_fetch_assoc($result)){
                                            echo'<option value="'.$rows['dbname'].'">'.$rows['dbname'].'</option>';
                                          }
                                        echo '</select>';
                                      }
                                      else
                                      {
                                        echo '
                                            <select required name="dbname" id="dbchange" onchange="deptDropdown(this.value), helo("dbname2", this.value)" class="form-control mb-3">
                                              <option value="">--Select Department--</option>
                                            </select>
                                        ';
                                      }
                                    ?>
                                  </div>
                                  <!-- <div class="col-xl-6"></div> -->
                              </div>
                              <table id="table" class="table align-items-center table-flush table-hover" id="dataTableHover">
                              </table>
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