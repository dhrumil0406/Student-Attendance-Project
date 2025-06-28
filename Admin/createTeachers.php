
<?php 
error_reporting(0);
    // include '../Includes/dbcon.php';
    include 'session.php';
    include '../DataBases/globalconn.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save']))
{    
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $phNo = $_POST['phNo'];
    $deptName = $_POST['deptname'];
    $joinDate = $_POST['joinDate'];

    $query = mysqli_query($conn,"SELECT * FROM tblteachers WHERE email ='$email'");
    $result = mysqli_fetch_array($query);

    $password = "teacher123";
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if($result > 0)
    { 
        $statusMsg = "<div class='alert alert-danger' style='margin-right:500px;'>This Email Address Already Exists!</div>";
    }
    else
    {
        $query = mysqli_query($conn, "INSERT INTO `tblteachers`(`fname`, `lname`, `email`, `phno`, `password`, `deptname`, `joindate`) VALUES ('$fName','$lName','$email','$phNo','$password_hash','$deptName','$joinDate')");

        if($query)
        {
            $statusMsg = "<div class='alert alert-success'  style='margin-right:500px;'>Teacher Added Successfully!</div>";
        }
        else
        {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
        }
    }
}

//---------------------------------------EDIT-------------------------------------------------------------




//--------------------EDIT------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
{
    $Id = $_GET['Id'];

    $query = mysqli_query($conn,"SELECT * FROM tblteachers WHERE id ='$Id'");
    $row = mysqli_fetch_array($query);

    //------------UPDATE-----------------------------

    if(isset($_POST['update'])){

        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $phNo = $_POST['phNo'];
        $deptName = $_POST['deptname'];
        $joinDate = $_POST['joinDate'];

        $query = mysqli_query($conn, "UPDATE `tblteachers` SET `fname`='$fName',`lname`='$lName',`email`='$email',`phno`='$phNo',`deptname`='$deptName' WHERE id = $Id");
        if($query)
        {
            echo" <script type = \"text/javascript\">
                    window.location = (\"createTeachers.php\")
                    </script>"; 
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
    $query = mysqli_query($conn, "DELETE FROM tblteachers WHERE id = '$Id'");

    if($query == TRUE)
    {
        echo "<script type = \"text/javascript\">
                window.location = (\"createTeachers.php\")
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
                        <h1 class="h3 mb-0 text-gray-800">Create Teachers</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Teachers</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                        <!-- Form Basic -->
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Create Teachers</h6>
                                <?php echo $statusMsg; ?>
                            </div>
                            <div class="card-body">
                            <form method="post">
                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                    <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" required name="fName" value="<?php echo $row['fname'];?>" id="exampleInputFirstName">
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" required name="lName" value="<?php echo $row['lname'];?>" id="exampleInputFirstName" >
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                    <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
                                    <input type="email" class="form-control" required name="email" value="<?php echo $row['email'];?>" id="exampleInputFirstName" >
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Phone No<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" name="phNo" value="<?php echo $row['phno'];?>" id="exampleInputFirstName" >
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                    <label class="form-control-label">Select Department<span class="text-danger ml-2">*</span></label>
                                    <?php
                                        $query= "SELECT * FROM tbldbs ORDER BY deptname ASC";
                                        $result = mysqli_query($conn, $query);
                                        $num = mysqli_num_rows($result);
                                        if ($num > 0){
                                            echo '<select required name="deptname" class="form-control mb-3">';
                                            echo '<option value="">--Select Department--</option>';
                                            while ($rows = mysqli_fetch_assoc($result)){
                                                echo'<option value="'.$rows['deptname'].'" >'.$rows['deptname'].'</option>';
                                            }
                                            echo '</select>';
                                        }
                                    ?>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Joining Date<span class="text-danger ml-2">*</span></label>
                                    <input type="text" class="form-control" name="joinDate" value="<?php echo date('d/m/Y');?>" id="exampleInputFirstName" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                                <?php
                                    if (isset($Id))
                                    {
                                        ?>
                                            <button type="submit" name="update" class="btn btn-warning">Update</button>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php
                                    } else
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
                                            <h6 class="m-0 font-weight-bold text-primary">All Class Teachers</h6>
                                        </div>
                                        <div class="table-responsive p-3">
                                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No</th>
                                                    <th>Department</th>
                                                    <th>Joining Date</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                            
                                                <tbody>

                                                <?php
                                                    $query = "SELECT * FROM tblteachers";
                                                    $result = mysqli_query($conn, $query);
                                                    $num = mysqli_num_rows($result);

                                                    if($num > 0)
                                                    { 
                                                        while ($rows = mysqli_fetch_assoc($result))
                                                        {
                                                            $sn = $sn + 1;
                                                            echo"
                                                            <tr>
                                                                <td>".$rows['id']."</td>
                                                                <td>".$rows['fname']."</td>
                                                                <td>".$rows['lname']."</td>
                                                                <td>".$rows['email']."</td>
                                                                <td>".$rows['phno']."</td>
                                                                <td>".$rows['deptname']."</td>
                                                                <td>".$rows['joindate']."</td>
                                                                <td><a href='?action=delete&Id=".$rows['id']."'><i class='fas fa-fw fa-trash'></i></a></td>
                                                            </tr>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<div class='alert alert-danger' role='alert'> No Record Found! </div>";
                                                    }    
                                                ?>
                                                </tbody>
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