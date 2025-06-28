<?php 
  error_reporting(0);
  // include '../Includes/dbcon.php';
  include 'session.php';
  include '../DataBases/globalconn.php';
  
//--------------------------------SAVE------------------------------------------

if(isset($_POST['save'])){  //edit this code
    
    $deptName = $_POST['deptName'];
    $year = $_POST['year'];
    $dbName = $_POST['dbName'];

    $sql = "select * from tbldbs where dbname = '$dbName'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    if($result > 0)
    { 
        $statusMsg = "<div class='alert alert-danger' style='margin-right: 500px;'>This Department Already Exists!</div>";
    }
    else
    {
        $query1 = mysqli_query($conn, "INSERT INTO `tbldbs`(`deptname`, `year`, `dbname`) VALUES ('$deptName','$year','$dbName')");
        $query2 = mysqli_query($conn, "CREATE DATABASE `$dbName`");
        $query3 = mysqli_query($conn, "CREATE TABLE `$dbName`.`classes` (`id` INT(5) NOT NULL AUTO_INCREMENT , `dbname` VARCHAR(30) NOT NULL , `deptname` VARCHAR(20) NOT NULL , `year` VARCHAR(10) NOT NULL , `semester` INT(5) NOT NULL , `division` INT(5) NOT NULL , PRIMARY KEY (`id`));");
        $query4 = "CREATE TABLE `$dbName`.`Students` (`id` INT(5) NOT NULL AUTO_INCREMENT , `fname` VARCHAR(15) NOT NULL , `mname` VARCHAR(15) NOT NULL , `lname` VARCHAR(15) NOT NULL , `adno` VARCHAR(10) NOT NULL , `email` VARCHAR(40) NOT NULL , `dbname` VARCHAR(20) NOT NULL , `class` VARCHAR(20) NOT NULL , `addate` VARCHAR(20) NOT NULL , `batch` VARCHAR(10) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        if ($query1 && $query2 && $query3 && mysqli_query($conn, $query4))
        {
            $statusMsg = "<div class='alert alert-success'  style='margin-right: 500px;'>Department Created Successfully!</div>";
        }
        else
        {
            $statusMsg = "<div class='alert alert-danger' style='margin-right: 500px;'>An error Occurred!</div>";
        }
    }
}

//---------------------------------------EDIT-------------------------------------------------------------




//--------------------EDIT------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
{
    $Id = $_GET['Id'];
    $deptName = $_POST['deptName'];
    $year = $_POST['year'];
    $dbName = $_POST['dbName'];

    $query = mysqli_query($conn, "select * from tbldbs where deptid = '$Id'");
    $row = mysqli_fetch_array($query);

    //------------UPDATE-----------------------------

    if(isset($_POST['update'])){

        $deptName = $_POST['deptName'];
        $year = $_POST['year'];
        $dbName = $_POST['dbName'];
    
        $query = mysqli_query($conn, "UPDATE `tbldbs` SET `deptname`='$deptName',`year`='$year',`dbname`='$dbName' WHERE deptid = '$ID'");

        if ($query)
        {    
            echo "<script type = \"text/javascript\">
                  window.location = (\"createDepartment.php\")
                  </script> "; 
        }
        else
        {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
        }
    }
}
//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
{
  $Id = $_GET['Id'];

  $query = "DELETE FROM tbldbs WHERE deptid = '$Id'";

  $query2 = mysqli_query($conn, "select * from tbldbs where deptid = '$Id'");
  $row = mysqli_fetch_array($query2);
  $record = $row['dbname'];

  if (mysqli_query($conn, $query) && mysqli_query($conn, "DROP DATABASE `$record`"))
  {
    echo "<script type = \"text/javascript\">
          window.location = (\"createDepartment.php\")
          </script>";  
  }
  else
  {
    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
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
                  <h1 class="h3 mb-0 text-gray-800">Create Department</h1>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Department</li>
                  </ol>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <!-- Form Basic -->
                    <div class="card mb-4">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Create Department</h6>
                        <?php echo $statusMsg; ?>
                      </div>
                      <div class="card-body">
                        <form method="post">
                          <div class="form-group row mb-3">
                              <div class="col-xl-6">
                                    <label class="form-control-label">Department Name<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" name="deptName" value="<?php echo $row['deptname'];?>" id="exampleInputFirstName" placeholder="Ex:BCA">
                              </div>
                              <div class="col-xl-6">
                                    <label class="form-control-label">Acadamic Year<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" name="year" value="<?php echo $row['year'];?>" id="exampleInputFirstName" placeholder="Ex:2023_24">
                              </div>
                          </div>
                          <div class="form-group row mb-3">
                              <div class="col-xl-6">
                                    <label class="form-control-label">DataBase Name<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" name="dbName" value="<?php echo $row['dbname'];?>" id="exampleInputFirstName" placeholder="Ex:BCA_2023_24">
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
                            <h6 class="m-0 font-weight-bold text-primary">All Departments</h6>
                          </div>
                          <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                              <thead class="thead-light">
                                <tr>
                                  <th>DeptId</th>
                                  <th>Department Name</th>
                                  <th>Year</th>
                                  <th>DataBase Name</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                            
                              <tbody>
                                <?php
                                  $query = "SELECT * FROM tbldbs";
                                  $result = mysqli_query($conn, $query);
                                  $num = mysqli_num_rows($result);
                                  $sn=0;
                                  if($num > 0)
                                  { 
                                    while ($rows = mysqli_fetch_assoc($result))
                                    {
                                      $sn = $sn + 1;
                                      echo"
                                        <tr>
                                          <td>".$rows['deptid']."</td>
                                          <td>".$rows['deptname']."</td>
                                          <td>".$rows['year']."</td>
                                          <td>".$rows['dbname']."</td>
                                          <td><a href='?action=edit&Id=".$rows['deptid']."'><i class='fas fa-fw fa-edit'></i>Edit</a></td>
                                          <td><a href='?action=delete&Id=".$rows['deptid']."'><i class='fas fa-fw fa-trash'></i>Delete</a></td>
                                        </tr>";
                                    }
                                  }
                                  else
                                  {
                                      echo   
                                          "<div class='alert alert-danger' role='alert'>
                                            No Record Found!
                                          </div>";
                                  }
                                ?>
                              </tbody>
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