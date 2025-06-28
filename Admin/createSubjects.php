
<?php 
error_reporting(0);
    include 'session.php';
    include '../DataBases/globalconn.php';

    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];

    $conn2 = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }



//------------------------SAVE--------------------------------------------------

if(isset($_POST['save']))
{
    $deptName = $_POST['deptName'];
    $sem = $_POST['sem'];
    $subjects = $_POST['subjects'];
    
    $query = "SELECT * FROM `tblsubjects` WHERE deptname = '$deptName' && semester = '$sem'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_array($result);

    if($rows > 0)
    { 
        $statusMsg = "<div class='alert alert-danger' style='margin-right:500px;'>This Semester`s Subjects Already Added!</div>";
    }
    else
    {
        $query = "INSERT INTO `tblsubjects`(`deptname`, `semester`, `subjects`) VALUES ('$deptName','$sem','$subjects')";
        if (mysqli_query($conn, $query))
        {
            $statusMsg = "<div class='alert alert-success'  style='margin-right:600px;'>Subjects Added Successfully!</div>";
        }
        else
        {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>An error Occurred!</div>";
        }
    }
}

//---------------------------------------EDIT-------------------------------------------------------------



//--------------------EDIT------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
{
    $Id = $_GET['Id'];

    $query = mysqli_query($conn, "SELECT * FROM `tblsubjects` WHERE id = '$Id'");
    $row = mysqli_fetch_array($query);

    //---------------------UPDATE-----------------------------

    if(isset($_POST['update'])){
        $Id = $_GET['Id'];
    
        $deptName = $_POST['deptName'];
        $sem = $_POST['sem'];
        $subjects = $_POST['subjects'];

        $query = "UPDATE `tblsubjects` SET `deptname`='$deptName',`semester`='$sem',`subjects`='$subjects' WHERE id = $Id";
        if(mysqli_query($conn,$query))
        {
            echo "<script type = 'text/javascript'>
                    window.location = (\"createSubjects.php\")
                    </script>"; 
        }
        else
        {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:600px;'>An error Occurred!</div>";
        }
    }
}

//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
{
    $Id= $_GET['Id'];

    $query = "DELETE FROM `tblsubjects` WHERE id = '$Id'";

    if (mysqli_query($conn, $query))
    {
        echo "<script type = \"text/javascript\">
                window.location = (\"createStudents.php?dbname2=BBA_2024_25\")
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            var dbname = "";
            $("#dbchange").change(function(){
                dbname = $(this).val();
                // year = dbname.slice(-7);
                db = dbname.replace(/[0-9_]/g,"");
                $("#deptname").val(db);
            });
        });

        function helo(key, value)
        {
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
                        <h1 class="h3 mb-0 text-gray-800">Add Subjects</h1>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Subjects</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Subjects</h6>
                                    <?php echo $statusMsg; ?>
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
                                                ?>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Department Name<span class="text-danger ml-2">*</span></label>
                                                <input type="text" name="deptName" class="form-control" id="deptname" placeholder="Ex: BCA" value="<?php echo $row['deptname'];?>" id="exampleInputFirstName" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Select Semester<span class="text-danger ml-2">*</span></label>
                                                <select required name="sem" id="sem" class="form-control mb-3">
                                                    <option value="">--Select Semester--</option>
                                                    <?php 
                                                        if($row['semester'] == 1)
                                                        {
                                                            echo '
                                                                <option value="1" selected>1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                            ';
                                                        }
                                                        elseif($row['semester'] == 2)
                                                        {
                                                            echo '
                                                                <option value="1">1</option>
                                                                <option value="2" selected>2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                            ';
                                                        }
                                                        elseif($row['semester'] == 3)
                                                        {
                                                            echo '
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3" selected>3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                            ';
                                                        }
                                                        elseif($row['semester'] == 4)
                                                        {
                                                            echo '
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4" selected>4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                            ';
                                                        }
                                                        elseif($row['semester'] == 5)
                                                        {
                                                            echo '
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5" selected>5</option>
                                                                <option value="6">6</option>
                                                            ';
                                                        }
                                                        elseif($row['semester'] == 6)
                                                        {
                                                            echo '
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6" selected>6</option>
                                                            ';
                                                        }
                                                        else
                                                        {
                                                            echo '
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                            ';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-control-label">Subjects Name<span class="text-danger ml-2">*</span></label>
                                                <textarea name="subjects" id="" cols="0" rows="" class="form-control mb-3" placeholder="Enter All Subjects Name..."><?php echo $row['subjects']; ?></textarea>
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
                                                <table id="table" class="table align-items-center table-flush table-hover" id="dataTableHover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Department</th>
                                                            <th>Semester</th>
                                                            <th>Subjects</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                        $query = "SELECT * FROM `tblsubjects`";
                                                        $result = mysqli_query($conn, $query);
                                                        $num = mysqli_num_rows($result);
                                                        $sn=0;
                                                        $status="";
                                                        if($num > 0)
                                                        { 
                                                            while ($rows = mysqli_fetch_assoc($result))
                                                            {
                                                                $sn = $sn + 1;
                                                                echo"
                                                                    <tr>
                                                                        <td>".$rows['id']."</td>
                                                                        <td>".$rows['deptname']."</td>
                                                                        <td>".$rows['semester']."</td>
                                                                        <td>".$rows['subjects']."</td>
                                                                        <td><a href='?action=edit&Id=".$rows['id']."'><i class='fas fa-fw fa-edit'></i></a></td>
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