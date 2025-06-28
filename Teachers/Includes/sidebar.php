<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center bg-gradient-primary justify-content-center" href="index.php">
        <div class="sidebar-brand-icon" >
            <img src="../img/logo/icon2.jpg">
        </div>
        <div class="sidebar-brand-text mx-3">Attendance System</div>
    </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> 
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Students
      </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
          aria-expanded="true" aria-controls="collapseBootstrap2">
          <i class="fas fa-user-graduate"></i>
          <span>Manage Students</span>
        </a>
        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Students</h6>
            <a class="collapse-item" href="viewStudents.php">View Students</a>
            <!-- <a class="collapse-item" href="#">Assets Type</a> -->
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading"> Attendance </div>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapcon"
          aria-expanded="true" aria-controls="collapseBootstrapcon">
          <i class="fa fa-calendar-alt"></i>
          <span>Manage Attendance</span>
        </a>
        <div id="collapseBootstrapcon" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Attendance</h6>
            <a class="collapse-item" href="takeAttendanceByRno.php?dbname2=BCA_2024_25">Take Attendance By Rno</a>
            <a class="collapse-item" href="takeAttendanceByName.php?dbname2=BCA_2024_25">Take Attendance By Name</a>
            <a class="collapse-item" href="viewAttendance.php?dbname2=BCA_2024_25">View Class Attendance</a>
            <a class="collapse-item" href="viewStudentAttendance.php?dbname2=BCA_2024_25">View Student Attendance</a>
            <a class="collapse-item" href="downloadRecord.php">Today's Report (xls)</a>
            <!-- <a class="collapse-item" href="addMemberToContLevel.php ">Add Member to Level</a> -->
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading"> Profile </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3"
          aria-expanded="true" aria-controls="collapseBootstrap3">
          <i class="fas fa-lock"></i>
          <span>Manage Password</span>
        </a>
        <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Change Password</h6>
            <a class="collapse-item" href="changepass.php">Change Password</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
    </ul>