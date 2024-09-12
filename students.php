<?php

// ADMIN DASHBOARD
session_start();
// database
require 'database/dbcon.php';
// prevent open page through url
if ($_SESSION['admin_login'] != true) {
    header('location: adminLogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="img/jpg" href="img/mainlogo.png">
    <title>Students</title>
    <!-- Custome CSS -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- Datatable -->
    <link rel="stylesheet" href="DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .tableRowHeader {
            border-bottom: 3px solid #6c757d;
        }

        #studentTable {
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- View -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalHeader" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border border-5">
                <div class="modal-header bg-info bg-opacity-10 border border-info border-4">
                    <h1 class="modal-title fs-5" id="viewModalHeader">Students Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewModalOutput">
                    <!-- output below here -->

                    <!-- output above here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <div class="d-flex align-items-center">
            <img src="img/mainlogo.png" class="img-fluid mx-3" alt="mainlogo" width="50" height="auto">
            <small class="navbar-brand fs-6 " id="schoolName">Kapitangan National High School</small>
            <button class="btn btn-link btn-sm order-1 order-lg-0 ms-3" id="sidebarToggle" href="#!">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logreg/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>



    <div id="layoutSidenav">
        <!-- SIDE BAR -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Admin Panel</div>
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="manageSchoolyear.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-rectangle-list"></i></div>
                            Manage School Year
                        </a>
                        <!-- 2nd -->
                        <div class="sb-sidenav-menu-heading">Manage Accounts</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
                            Manage Accounts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="accounts.php">Accounts</a>
                                <a class="nav-link" href="activityLog/logs.php">Activity Log</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Manage Students</div>
                        <a class="nav-link" href="enrollment.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-address-card"></i></div>
                            Enrollment
                        </a>
                        <a class="nav-link" href="advanceStudent.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                            Advance Students
                        </a>
                        <a class="nav-link" href="students.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Students
                        </a>
                        <a class="nav-link" href="records.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users-rectangle"></i></div>
                            Records
                        </a>
                        <div class="sb-sidenav-menu-heading">Manage Schedule</div>
                        <a class="nav-link" href="schedule.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar"></i></div>
                            Schedule
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- ############# CONTENT -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-2">
                    <!-- PASET CONTENT BELOW HERE -->

                    <div class="container-fluid my-3">
                        <div class="card border border-2 border-dark-subtle shadow-sm">
                            <div class="card-header fw-bold">
                                <?php
                                $sySql = "SELECT active_schoolyear FROM enrollment_status";
                                $syQuery = mysqli_query($connection, $sySql);
                                if ($syQuery) {
                                    $activeSchoolYear = mysqli_fetch_assoc($syQuery);
                                ?>
                                    Students of School Year : <span id="activeSchoolYear"><?php echo $activeSchoolYear['active_schoolyear']; ?></span>
                                <?php
                                } else {
                                ?>
                                    No active school year is set
                                <?php
                                }
                                ?>

                            </div>
                            <div class="card-body">
                                <form id="flterStudentForm">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-12 mb-2">
                                            <select class="form-select" id="selectGradeLevel" aria-label="Default select example">
                                                <!-- <option value="" selected> -- select grade level -- </option> -->
                                                <option value="7" selected>7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            <small class="text-danger fw-semibold" id="gradeLevelError"></small>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mb-2">
                                            <select class="form-select" id="selectSection" aria-label="Default select example">
                                                <option value="" selected> -- select section -- </option>
                                                <!-- Fetch Section list here -->
                                            </select>
                                            <small class="text-danger fw-semibold" id="sectionError"></small>
                                        </div>
                                        <div class="col-lg-1 col-md-12 mb-2">
                                            <button type="button" class="btn btn-primary fw-semibold" id="showBtn">Show</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <!-- Table Start -->
                                <!-- <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body bg-warning p-2 text-dark bg-opacity-50">
                                            To show data, Select a grade level and its section
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover border border-secondary" id="studentTable">
                                                <thead class="table-info">
                                                    <tr class="tableRowHeader">
                                                        <th class="text-center" scope="col">LRN</th>
                                                        <th class="text-center" scope="col">Grade Level</th>
                                                        <th class="text-center" scope="col">Section</th>
                                                        <th class="text-center" scope="col">Last Name</th>
                                                        <th class="text-center" scope="col">First Name</th>
                                                        <th class="text-center" scope="col">Student Type</th>
                                                        <th class="text-center" scope="col">Gender</th>
                                                        <th class="text-center" scope="col">Date Enrolled</th>
                                                        <th class="text-center" scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="studentTbody">
                                                    <!-- output -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PASTE CONENT HERE -->
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <!-- Datatable -->
    <script src="DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- alertify -->
    <script src="alertify/alertify.js"></script>
    <!-- Sweet Alert -->
    <script src="sweetAlert/sweet_alert.js"></script>
    <!-- External JS -->
    <script src="students/js/stud.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>