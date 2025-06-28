<ul class="navbar-nav sidebar sidebar-light accordion " id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center bg-gradient-primary  justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img src="../img/logo/icon2.jpg" height="" width="">
        </div>
        <div class="sidebar-brand-text mx-3">Attendance System</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading"> Department And Classes </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapdept" aria-expanded="true" aria-controls="collapseBootstrapdept">
            <i class="fas fa-chalkboard"></i>
            <span>Manage Departments</span>
        </a>
        <div id="collapseBootstrapdept" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Department</h6>
                <a class="collapse-item" href="createDepartment.php">Add Department</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapclass" aria-expanded="true" aria-controls="collapseBootstrapclass">
            <i class="fas fa-code-branch"></i>
            <span>Manage Class</span>
        </a>
        <div id="collapseBootstrapclass" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Class</h6>
                <a class="collapse-item" href="createClass.php">Add Class</a>
                <!-- <a class="collapse-item" href="usersList.php">User List</a> -->
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading"> Teachers </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapassests" aria-expanded="true" aria-controls="collapseBootstrapassests">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Manage Teachers</span>
        </a>
        <div id="collapseBootstrapassests" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Teachers</h6>
                <a class="collapse-item" href="createTeachers.php">Add Teachers</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading"> Students </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
            <i class="fas fa-user-graduate"></i>
            <span>Manage Students</span>
        </a>
        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Students</h6>
                <a class="collapse-item" href="createStudents.php?dbname2=BCA_2024_25">Add Students</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading"> Subjects </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3" aria-expanded="true" aria-controls="collapseBootstrap2">
            <i class="fas fa-user-graduate"></i>
            <span>Manage Subjects</span>
        </a>
        <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Subjects</h6>
                <a class="collapse-item" href="createSubjects.php">Add Subjects</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading"> Session & Term </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapcon" aria-expanded="true" aria-controls="collapseBootstrapcon">
            <i class="fa fa-calendar-alt"></i>
            <span>Manage Session & Term</span>
        </a>
        <div id="collapseBootstrapcon" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Contribution</h6>
                <a class="collapse-item" href="createSessionTerm.php">Create Session and Term</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
</ul>