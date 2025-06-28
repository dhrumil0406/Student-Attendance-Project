<?php 
error_reporting(0);
// include '../Includes/dbcon.php';
include 'session.php';
include '../DataBases/globalconn.php';
session_start();
if($_SESSION['dbname'])
{
    mysqli_select_db($conn,$_SESSION['dbname']);
?>
<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Rno</th>
            <th>Full Name</th>
            <th>Admission No</th>
            <th>Class</th>
            <th>Date</th>
            <th><?php echo $_SESSION['colname'];?></th>
        </tr>
    </thead>
<?php 
$filename="Attendance list of ".$_SESSION['class']." Date of ". date('d-m-Y');
$dateTaken = date("Y-m-d");

$cnt=1;			
$ret = mysqli_query($conn,"SELECT * FROM $_SESSION[class]");

if(mysqli_num_rows($ret) > 0)
{
    while ($row = mysqli_fetch_array($ret)) 
    {
        $colname = $_SESSION["colname"];
        echo '  
            <tr>  
                <td>'.$cnt.'</td> 
                <td>'.$rno= $row['rno'].'</td>
                <td>'.$fullName= $row['fullname'].'</td>
                <td>'.$admissionNumber= $row['adno'].'</td>
                <td>'.$className= $row['class'].'</td>
                <td>'.$dateTaken.'</td>
                <th>'.$colname=$row[$colname].'</th>
            </tr>
        ';
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".$filename."-report.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $cnt++;
	}
}
}
else
{
    mysqli_select_db($conn,$_SESSION['deptName'].'_2024_25');
    ?><script>
        alert("Does not taked Today's Attendance !");
        window.location.href = "index.php";
    </script><?php
}
?>
</table>