
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
        <link href="img/logo/attnlg.jpg" rel="icon">
        <title>Dashboard</title>
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/ruang-admin.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script>
            var myModal = document.getElementById('myModal')
            var myInput = document.getElementById('myInput')

            myModal.addEventListener('shown.bs.modal', function () {
                myInput.focus();
            });

            // function showclass(str,str3,str4)
            // {
            //     if (str == "")
            //     {
            //         document.getElementById("table").innerHTML = "";
            //         return;
            //     }
            //     else
            //     {
            //         const xmlhttp = new XMLHttpRequest();
            //         xmlhttp.onreadystatechange = function() {
            //             document.getElementById("table").innerHTML = this.responseText;
            //         };
            //         xmlhttp.open("GET","ajaxtakeattend.php?dbname2="+ str + "&class=" + str3 + "&subject=" + str4);
            //         xmlhttp.send();
            //     }
            // }

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
                            <h1 class="h3 mb-0 text-gray-800">Take Attendance For (Today's Date : <?php echo $todaysDate = date("d/m/Y");?>)</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Take Attendance</li>
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
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-6">
                                                    <button type="Submit" data-bs-toggle="modal" data-bs-target="#exampleModal" name="view" id="view" class="btn btn-primary" >Take Attendance</button>
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

                                    if(isset($_POST['view']))
                                    {
                                        $conn2 = mysqli_connect('localhost', 'root', '', $dbname2);
                                        if(!$conn2)
                                        {
                                            echo "connection error!";
                                        }
                                        $date = date('d_m');
                                        $col_name = $subject . '_' . $date;

                                        $query1 = "ALTER TABLE `$class` ADD `$col_name` varchar(255);";
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
                                    }
                                ?>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Take Attendance</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none;background-color: white;font-size:20px;">X</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="class-date" style="display: flex;justify-content: space-between;">
                                                    <h5>Class : <?php echo $class; ?></h5>
                                                    <h5>Date : <?php echo date('d-m-Y'); ?></h5>
                                                </div>
                                                <h5>Subject : <?php echo $subject; ?></h5>
                                                    <?php
                                                        $query = "SELECT * FROM `$class`";
                                                        $result = mysqli_query($conn2,$query);
                                                        $num = mysqli_num_rows($result);
                                                    ?>
                                                <div class="table-responsive p-3">
                                                    <form action="" method="post">
                                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <?php
                                                               echo'<th>RNo</th>
                                                                    <th>Name</th>
                                                                    <th>AdNo</th>
                                                                    <th>Class</th>
                                                                    <th>'.$col_name.'</th>';
                                                                    // <th>Col</th>';
                                                            ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            if($num > 0)
                                                            { 
                                                                while($rows = mysqli_fetch_assoc($result))
                                                                {
                                                                    echo "<tr>";
                                                                    echo '<td>'.$rows["rno"].'</td>
                                                                        <td>'.$rows["fullname"].'</td>
                                                                        <td>'.$rows["adno"].'</td>
                                                                        <td>'.$rows["class"].'</td>
                                                                        <td>
                                                                                <input type="checkbox" name="check[]" value="'.$rows["rno"].'">
                                                                        </td>';
                                                                    echo "</tr>";
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "<div class='alert alert-danger' role='alert' style='width: 150px;'> No Record Found! </div>";
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                    <button type="Submit" class="btn btn-secondary" name="cancel" id="cancel">Cancel</button>
                                                    <button type="Submit" class="btn btn-primary" name="Done" id="done">Done</button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Input Group -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                                            </div>
                                            <div class="card-body">
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
                                                                    <select required name="dbname" id="dbchange" onchange="changeclass(this.value),helo('dbname2',this.value)" class="form-control mb-3">
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
                                                        <select required name="class" id="class1" onchange="helo('class',this.value),showclass2('<?php echo $_GET['dbname2']; ?>',this.value)" class="form-control mb-3">
                                                            <option value="">--Select Class And Semester--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="table" class="table-responsive p-3">
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

<?php
    if(isset($_POST['Done']))
    {
        $subject = $_GET['subject'];
        $class = $_GET['class'];
        $date = date('d_m');
        $col_name = $subject . '_' . $date;

        $check = $_POST['check'];
        $rnos_arr = array();
        foreach($check as $ch)
        {
            array_push($rnos_arr,$ch);
        }

        $len = count($rnos_arr);
        $query = "SELECT * FROM `$class`";
        $result = mysqli_query($conn2, $query);
        $num = mysqli_num_rows($result);

        while($rows = mysqli_fetch_assoc($result))
        {
            if(in_array($rows['rno'],$rnos_arr))
            {
                // echo $rows['rno'];
                $query2 = "UPDATE `$class` SET `$col_name`='P' WHERE rno = $rows[rno]";
                mysqli_query($conn2, $query2);
            }
            else
            {
                $query3 = "UPDATE `$class` SET `$col_name`='A' WHERE rno = $rows[rno]";
                mysqli_query($conn2, $query3);
            }
        }
    }
?>
