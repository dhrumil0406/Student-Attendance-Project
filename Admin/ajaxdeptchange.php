<?php
    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname = $_GET['dbname'];

    $conn = mysqli_connect($hostname, $user, $pass, $dbname);
    if(!$conn)
    {
        echo "connection error!";
    }
?>
  <!-- <table class="table align-items-center table-flush table-hover" id="dataTableHover"> -->
  <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Department & Year</th>
        <th>Department</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Division</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
  </thead>
  <tbody>
      <?php
        $query = "SELECT * FROM `classes`";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        $sn=0;
        if($num > 0)
        { 
          while ($rows = mysqli_fetch_assoc($result))
            {
              $sn = $sn + 1;
              $tblname = $rows['deptname'] . 'S' . $rows['semester'] . 'D' . $rows['division'];
              echo"
                <tr>
                  <td>".$rows['id']."</td>
                  <td>".$rows['dbname']."</td>
                  <td>".$rows['deptname']."</td>
                  <td>".$rows['year']."</td>
                  <td>".$rows['semester']."</td>
                  <td>".$rows['division']."</td>
                  <td><a href='?action=edit&Id=".$rows['id']."&dbname2=".$rows['dbname']."&class=".$tblname."'><i class='fas fa-fw fa-edit'></i>Edit</a></td>
                  <td><a href='?action=delete&Id=".$rows['id']."&dbname2=".$rows['dbname']."&class=".$tblname."'><i class='fas fa-fw fa-trash'></i>Delete</a></td>
                </tr>";
            }
        }
        else
        {
            echo "<div class='alert alert-danger' role='alert'>
                  No Record Found!
                </div>";
        }
      ?>
      </tbody>
  <!-- </table> -->