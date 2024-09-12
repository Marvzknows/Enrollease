<?php

// ADMIN DASHBOARD
session_start();
// database
require 'database/dbcon.php';
require 'functions.php';
// prevent open page through url
if ($_SESSION['admin_login'] != true) {
    header('location: adminLogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
    .btn.btn-success[disabled] {
        opacity: 0.4;
    }

    .btn.btn-primary[disabled] {
        opacity: 0.4;
    }

    .btn.btn-primary[disabled] {
        opacity: 0.4;
    }
</style>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="img/jpg" href="img/mainlogo.png">
    <title>Admin Dashboard</title>
    <!-- Custome CSS -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- alertify CSS -->
    <link rel="stylesheet" href="alertify/alertifycss.css">
    <link rel="stylesheet" href="alertify/alertifycss2.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />

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
    <!-- Enrollment Status Modal -->
    <?php
    if ($_SESSION['enrollmentStatus'] == 'Close') {
    ?>
        <div class="modal fade" id="enrollmentStatusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Enrollment Status</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body p-0">
                        <div class="alert alert-warning border-3 border-warning shadow-sm m-0 p-4" role="alert">
                            <h5 class="alert-heading fw-bold text-center"><i class="fa-solid fa-triangle-exclamation"></i> Enrollment is currently <span class="fw-bolder text-decoration-underline">Closed</span></h5>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="dashboard.php" class="btn btn-secondary ">Close</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- Move Grade Level Modal -->
    <div class="modal fade" id="moveGradelevelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="moveLevelHeader" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border border-5">
                <div class="modal-header bg-info bg-opacity-10 border border-info border-4">
                    <h1 class="modal-title fs-5" id="moveLevelHeader"><i class="fa-solid fa-person-arrow-up-from-line me-1"></i> Advance Student Grade Level</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Data -->
                    <input type="hidden" name="hiddenOldSchoolYear" id="hiddenOldSchoolYear">
                    <input type="hidden" name="hiddenGradeLevel" id="hiddenGradeLevel">
                    <input type="hidden" name="hiddenSection" id="hiddenSection">

                    <div class="row mb-3">
                        <label for="activeSchoolyear" class="col-sm-2 col-form-label">School Year</label>
                        <div class="col-sm-10">
                            <input class="form-control fw-bold" type="text" name="activeSchoolyear" id="activeSchoolyear" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Grade Level</label>
                        <div class="col-sm-10">
                            <select id="moveGradeLevel" class="form-select">
                                <option value="" selected>- Select Grade Level -</option>
                                <!-- <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="moveSection" class="col-sm-2 col-form-label">Section</label>
                        <div class="col-sm-10">
                            <select id="moveSection" class="form-select">
                                <option value="" selected>- Select section -</option>
                                <!-- move section output -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <small class="text-danger fw-semibold" id="moveStudentError"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmMovebtn" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Completers Modal -->
    <div class="modal fade" id="completersModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completersHeaderModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content  border border-5">
                <div class="modal-header">
                    <!-- <h1 class="modal-title fs-5" id="completersHeaderModal"><i class="fa-solid fa-person-arrow-up-from-line me-1"></i> Advance Student Grade Level</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <!-- Hidden Data -->
                    <input type="hidden" name="compHiddenOldSchoolYear" id="compHiddenOldSchoolYear">
                    <input type="hidden" name="compHiddenGradeLevel" id="compHiddenGradeLevel">
                    <input type="hidden" name="compHiddenSection" id="compHiddenSection">
                    <!-- mssg -->
                    <h5><i class="fa-solid fa-triangle-exclamation me-2"></i> Are you sure you want to set the selected Grade 10 students as completers of the <span class="text-primary" id="compSy"></span>?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmCompletersBtn" class="btn btn-success fw-semibold">Confirm</button>
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
                <div class="container-fluid">
                    <!-- PASTE CONENT BELOW HERE -->
                    <div class="container-fluid my-3">
                        <div class="row">
                            <div class="col">
                                <div class="card border border-2 border-dark-subtle shadow-sm">
                                    <div class="card-header fw-bold">
                                        Advance Students Grade Level
                                    </div>
                                    <!-- Card Body Start -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <h4 class="alert-heading"><strong>Advancement</strong></h4>
                                                    <p>Use this module to select the students from the previous school year to advance to the next grade level for the incoming school year.</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Filter Options -->
                                        <!-- 1st Row -->
                                        <form id="form">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="input-group input-group-sm mb-3">
                                                        <!-- <span class="input-group-text fw-semibold">School Year :</span> -->
                                                        <?php
                                                        $activeSySql = "SELECT MAX(id)-1 as id FROM school_year";
                                                        $activeSyQuery = mysqli_query($connection, $activeSySql);
                                                        if ($activeSyQuery) {
                                                            $activeSyData = mysqli_fetch_assoc($activeSyQuery);
                                                            $activeSchoolYear = $activeSyData['id'];

                                                            $lastSy = "SELECT school_year FROM school_year WHERE id='$activeSchoolYear'";
                                                            $lastSyQuery = mysqli_query($connection, $lastSy);

                                                            if ($lastSyQuery) {
                                                                if (mysqli_num_rows($lastSyQuery) > 0) {
                                                                    $schoolyearData = mysqli_fetch_assoc($lastSyQuery);
                                                                    $sy = $schoolyearData['school_year'];
                                                                } else {
                                                                    $sy = 'no sy found';
                                                                }
                                                            }
                                                        } else {
                                                            echo ' activeSyQuery Failed';
                                                        }
                                                        ?>
                                                        <input type="hidden" class="form-control fst-italic fw-bold" id="lastSchoolYear" value="<?php echo $sy; ?>" aria-label="Sizing example input" aria-describedby="lastSchoolYear" readonly>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select id="gradeLevel" class="form-select">
                                                        <!-- <option value="" selected>- Select Grade Level -</option> -->
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select id="selectSection" class="form-select">
                                                        <option value="" selected>- Select Section -</option>
                                                        <!-- Section output here -->
                                                    </select>
                                                    <small class="text-danger fw-semibold" id="sectionError"></small>
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <button type="button" class="btn btn-primary mb-2 mb-md-0 me-md-2" id="viewBtn">
                                                            <i class="fa-solid fa-magnifying-glass me-1"></i>View
                                                        </button>
                                                        <button type="button" class="btn btn-success mb-2 mb-md-0 me-md-2" id="moveStudentBtn" disabled>
                                                            <i class="fa-solid fa-arrow-trend-up me-1"></i>Advance
                                                        </button>
                                                        <button type="button" class="btn btn-success mb-2 mb-md-0" id="completerBtn" disabled>
                                                            <i class="fa-solid fa-graduation-cap me-1"></i>Completers
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- Table Start -->
                                        <hr>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover border border-secondary d-none" id="studentTable">
                                                        <thead class="table-info">
                                                            <tr class="tableRowHeader">
                                                                <th class="pe-3" scope="col">
                                                                    <input class="border-dark form-check-input" type="checkbox" id="selectAllStudentBtn">
                                                                </th>
                                                                <th scope="col">Student LRN</th>
                                                                <th scope="col">School Year</th>
                                                                <th scope="col">Last Name</th>
                                                                <th scope="col">First Name</th>
                                                                <th scope="col">Student Type</th>
                                                                <th scope="col">Gender</th>
                                                                <th scope="col">Enrollment Status</th>
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
                                    <!-- Card Body End -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PASTE CONENT ABOVE HERE -->
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <!-- alertify -->
    <script src="alertify/alertify.js"></script>
    <!-- DataTable -->
    <script src="DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
    <!-- Sweet Alert -->
    <script src="sweetAlert/sweet_alert.js"></script>
    <!-- External JS -->
    <script src="advanceStudent/js/students.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        $(document).ready(function () {
            $('#enrollmentStatusModal').modal('show');
        });
    </script>
</body>

</html>