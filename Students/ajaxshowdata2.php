<?php
    include "../DataBases/globalconn.php";
    session_start();
    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $dbname2 = $_GET['dbname2'];
    $class = $_GET['class'];
    $adno = $_GET['adno'];

    $conn2 = mysqli_connect($hostname, $user, $pass, $dbname2);
    if(!$conn2)
    {
        echo "connection error!";
    }
    $query = "SELECT * FROM $class where adno = '$adno'";
    $result = mysqli_query($conn2,$query);
    $num = mysqli_num_rows($result);

    $i = 0;
    $cols = array();
    while ($i < mysqli_num_fields($result))
    {
        $col = mysqli_fetch_field($result);
        // echo '<th>' . $col->name . '</th>';
        array_push($cols, $col->name);
        $i = $i + 1;
    }

    $query = "SELECT * FROM $class where adno = '$adno'";
    $result = mysqli_query($conn2,$query);

    $i = 0;
    $c = array();
    $d = array();
    $m = array();
    while ($i < mysqli_num_fields($result))
    {
        $col = mysqli_fetch_field($result);
        $colname = $col->name;
        if($i >= 5)
        {
            $rm = substr($colname,-6,);
            $sub = str_replace($rm,"",$colname);
            array_push($c, $sub);
            array_push($d, substr($colname,-6,6));
            array_push($m, substr($colname,-2,2));
        }
        $i = $i + 1;
    }
    $len = count($c);
    $str = array();
    for($j=0;$j<$len;$j++)
    {
        if($c[$j] && $d[$j])
        {
            $st = $c[$j] . $d[$j];
            // echo $st;
            array_push($str,$st);
        }
    }
    $len = count($str);
    $mattend = $mabsent = 0;
    $lattend = $labsent = 0;
    $lm = date('m')-1;
    // $startdate = '_' . date('01_m');
    // $enddate = '_' . date('31_m');
    $startdate = date('m');
    $lastdate = date('m')-1;
    while($rows = mysqli_fetch_assoc($result))
    {
        for($k=0;$k<$len;$k++)
        {
            if($m[$k] == $startdate)
            {
                if($rows[$str[$k]] == 'P')
                {
                    $mattend++;
                }
                else
                {
                    $mabsent++;
                }
            }

            if($m[$k] == $lastdate)
            {
                if($rows[$str[$k]] == 'P')
                {
                    $lattend++;
                }
                else
                {
                    $labsent++;
                }
            }
        }
    }
    $mtotal = $mattend + $mabsent;
    // $ltotal = $lattend + $labsent;
    $ltotal = 1;

    // $rm = substr($class,-4,);
    // $dept = str_replace($rm,"",$class);

    // $sem = substr($class,-3,1);
    // $query1 = "SELECT * FROM `tblsubjects` WHERE deptname = '$dept' AND semester = $sem";
    // $result1 = mysqli_query($conn, $query1);
    // while($rows = mysqli_fetch_assoc($result1))
    // {
    //     $subjects = $rows['subjects'];
    //     $subject_arr = array();
    //     $subject_arr = explode(" ",$subjects);
    // }
    // $sub_len = count($subject_arr);
    // echo $sub_len;

    // $p = $q = 0;
    // $cgc = $eehc = 0;
    // while($rows = mysqli_fetch_assoc($result))
    // {
    //     for($k=0;$k<$len;$k++)
    //     {
    //         if($c[$k] == 'CG')
    //         {
    //             $cgc++;
    //             if($rows[$str[$k]] == 'P')
    //             {
    //                 $p++;
    //             }
    //         }
    //         elseif($c[$k] == 'EEH')
    //         {
    //             $eehc++;
    //             if($rows[$str[$k]] == 'P')
    //             {
    //                 $q++;
    //             }
    //         }
    //     }
    // }
    // echo "cgc".$cgc;
    // echo "p".$p;
    // echo "eehc".$eehc;
    // echo "p".$q;
?>
                    <div class="row mt-4">
                        <!-- New User Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Attendance</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $lattend ;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span class="text-success mr-2"><i class="fas fa-arrow-right"></i><?php echo substr($lattend * 100 / $ltotal,0,5). '%'?></span>
                                                <span>Since Last month</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Attendance</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $mattend ;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span class="text-success mr-2"><i class="fas fa-arrow-right"></i><?php echo substr($mattend * 100 / $mtotal,0,5).'%'; ?></span>
                                                <span>Since Current month</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Leaves</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mabsent;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span class="text-success mr-2"><i class="fa fa-arrow-right"></i><?php echo substr($mabsent * 100 / $mtotal,0,5).'%'; ?></span>
                                                <span>Since Current month</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Lectures</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mtotal;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <span class="text-success mr-2"><i class="fas fa-arrow-right"></i>100%</span>
                                                <span>Since Current month</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
