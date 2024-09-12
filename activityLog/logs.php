<?php

// ADMIN DASHBOARD
session_start();
// prevent open page through url
if ($_SESSION['admin_login'] != true) {
    header('location: ../adminLogin.php');
}

require '../database/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="img/jpg" href="../img/mainlogo.png">
    <title>Logs</title>
    <!-- Custome CSS -->
    <link href="../css/dashboard.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- datatable css -->
    <link rel="stylesheet" href="../DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <!-- FontAwesomw -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .table-responsive-header thead th,
        .table-responsive-header tbody td {
            white-space: nowrap;
            /* Prevent text from wrapping */
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <div class="d-flex align-items-center">
            <img src="../img/mainlogo.png" class="img-fluid mx-3" alt="mainlogo" width="50" height="auto">
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
                    <li><a class="dropdown-item" href="../logreg/logout.php">Logout</a></li>
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
                        <a class="nav-link" href="../dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="../manageSchoolyear.php">
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
                                <a class="nav-link" href="../accounts.php">Accounts</a>
                                <a class="nav-link" href="logs.php">Activity Log</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Manage Students</div>
                        <a class="nav-link" href="../enrollment.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-address-card"></i></div>
                            Enrollment
                        </a>
                        <a class="nav-link" href="../advanceStudent.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                            Advance Students
                        </a>
                        <a class="nav-link" href="../students.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Students
                        </a>
                        <a class="nav-link" href="../records.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users-rectangle"></i></div>
                            Records
                        </a>
                        <div class="sb-sidenav-menu-heading">Manage Schedule</div>
                        <a class="nav-link" href="../schedule.php">
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
                <div class="container-fluid px-4">
                    <!-- PAGE CONTENT BELOW -->
                    <!-- 
                    <div class="container-fluid">
                        <div class="alert alert-secondary my-2  fw-bold" role="alert">
                            Home / Manage Accounts / Activity Log
                        </div>
                    </div> -->

                    <div class="container mt-3">
                        <div class="row">
                            <div class="alert alert-warning pendinglist border-3 border-warning" role="alert">
                                <h4 class="alert-heading fw-bold">Activity Log</h4>
                                <hr class="my-2 p-0">
                                <p class="m-0">Below are the list of user's <span class="fw-bold">Activity Log</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow border border-2">
                                    <h5 class="card-header fw-bold">User Activity Log</h5>
                                    <div class="card-body">
                                        <!-- Filter Form -->
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12 text-start mb-2">
                                                <button class="btn btn-primary fw-bold active" id="todayLogsBtn">Today</button>
                                                <button class="btn btn-primary fw-bold" id="lastWeekLogsBtn">Last week</button>
                                            </div>
                                            <div class="col-lg-9 col-md-12">
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control dateFilter" id="startDate">
                                                    <span class="input-group-text fw-bold"> - </span>
                                                    <input type="date" class="form-control dateFilter" id="endDate">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- Logs Table -->
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-responsive-header" id="logsTable">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <!-- <th class="text-center" scope="col">logs ID</th> -->
                                                                <th class="text-center visually-hidden" scope="col">Logs ID</th>
                                                                <th class="text-center" scope="col">Teaacher ID</th>
                                                                <th class="text-center" scope="col">Activity</th>
                                                                <th class="text-center" scope="col">Timestamp</th>
                                                                <!-- <th class="text-center" scope="col">Time</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tableBodyOutput">
                                                            <!--  -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
    <script src="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- datatable -->
    <script src="../DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- External JS -->
    <script src="../activityLog/js/logs.js"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>