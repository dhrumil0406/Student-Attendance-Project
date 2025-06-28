<?php
    include '../DataBases/globalconn.php';
    $class = $_GET['class'];

    $rm = substr($class,-4,);
    $dept = str_replace($rm,"",$class);

    $sem = substr($class,-3,1);
?>
   <?php
        $query= "SELECT * FROM `tblsubjects` WHERE deptname = '$dept' AND semester = $sem";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

        if ($num > 0)
        {
            echo ' <option value="">--Select Subject--</option>';
            while ($rows = mysqli_fetch_assoc($result))
            {
                $subjects = $rows['subjects'];
                $subject_arr = array();
                $subject_arr = explode(" ",$subjects);
                $sub_len = count($subject_arr);
                for($i=0;$i<$sub_len;$i++)
                {
                    echo'<option value="'.$subject_arr[$i].'">'.$subject_arr[$i].'</option>';
                }
            }
        }
        else
        {
            echo '<select required name="subjectName" id="subjects" onchange="helo("subject",this.value);" class="form-control mb-3">
                    <option value="">--Select Subject--</option>
                </select>';
        }
    ?>