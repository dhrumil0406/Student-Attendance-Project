<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center bg-gradient-primary justify-content-center" href="../home.php">
        <div class="sidebar-brand-icon" >
            <img src="img/logo/attnlg.jpg">
        </div>
        <div class="sidebar-brand-text mx-3">Student Attendance</div>
    </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> 
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Attendance
      </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapcon"
          aria-expanded="true" aria-controls="collapseBootstrapcon">
          <i class="fa fa-calendar-alt"></i>
          <span>Show Attendance</span>
        </a>
        <div id="collapseBootstrapcon" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Attendance</h6>
            <a class="collapse-item" href="showAttendance.php?dbname2=<?php echo $dbname2 ?>&class=<?php echo $class;?>">Show Attendance</a>
            <!-- <a class="collapse-item" href="giveAttendance.php?dbname2=<?php echo $dbname2 ?>&class=<?php echo $class;?>">Give Attendance</a> -->
            <a class="collapse-item" href="downloadRecord.php?dbname2=<?php echo $dbname2 ?>&class=<?php echo $class;?>">Download Report (xls)</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Profile
      </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapcon1"
          aria-expanded="true" aria-controls="collapseBootstrapcon">
          <i class="fa fa-lock"></i>
          <span>Manage Password</span>
        </a>
        <div id="collapseBootstrapcon1" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Change Password</h6>
            <a class="collapse-item" href="changepass.php?dbname2=<?php echo $dbname2 ?>&class=<?php echo $class;?>">Change Password</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
</ul>