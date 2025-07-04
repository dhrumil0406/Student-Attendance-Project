
<?php 
// include '../Includes/dbcon.php';
include 'session.php';
include '../DataBases/globalconn.php';

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
    <title>Dashboard</title>
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
            <h1 class="h3 mb-0 text-gray-800">Administrator Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            
            <!-- Department Card -->
            <?php 
              $query = mysqli_query($conn,"SELECT * from tbldbs"); // edit this code
              $dbs = mysqli_num_rows($query);
              $arr_dbs = array();
              while($rows = mysqli_fetch_assoc($query))
              {
                array_push($arr_dbs,$rows['dbname']);
              }
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Department</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $dbs;?></div> <!-- edit code -->
                      <div class="mt-2 mb-0 text-muted text-xs"></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-depart fa-2x text-info"></i> -->
                      <i class="fas fa-regular fa-building fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Class Card -->
            <?php
              $count_dbs = count($arr_dbs);
              for($i=0;$i<$count_dbs;$i++)
              {
                  mysqli_select_db($conn,$arr_dbs[$i]);
                  $query = mysqli_query($conn,"SELECT * FROM classes");
                  $num_class += mysqli_num_rows($query);
              }
              mysqli_select_db($conn,'GLOBAL');
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Classes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num_class;?></div> <!-- edit code -->
                      <div class="mt-2 mb-0 text-muted text-xs"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Teachers Card  -->
            <?php 
              $query = mysqli_query($conn,"SELECT * from tblteachers"); // edit code
              $classTeacher = mysqli_num_rows($query);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Faculties</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $classTeacher;?></div> <!-- edit code -->
                      <div class="mt-2 mb-0 text-muted text-xs"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Students Card -->
            <?php 
              $query = mysqli_query($conn,"SELECT * from tblstudents"); // edit this code
              $students = mysqli_num_rows($query);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Students</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $students;?></div> <!-- edit code -->
                      <div class="mt-2 mb-0 text-muted text-xs"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <!-- Session and Terms Card  -->
            <?php 
              $query = mysqli_query($conn,"SELECT * from tblsessionterm"); // edit code
              $sessTerm = mysqli_num_rows($query);
            ?>
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Session & Terms</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sessTerm;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-alt fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- Std Att Card  -->
            <?php 
              // $query1=mysqli_query($conn,"SELECT * from tblattendance"); // edit code
              // $totAttendance = mysqli_num_rows($query1);
            ?>
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Student Attendance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 30;?></div> 
                      <div class="mt-2 mb-0 text-muted text-xs"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          </div>
        </div><!---Container Fluid-->
      <!-- Footer -->
      <?php include 'includes/footer.php';?>
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
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>
</html>