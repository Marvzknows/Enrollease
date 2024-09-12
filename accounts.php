<?php

// ADMIN DASHBOARD
session_start();
// prevent open page through url
include 'database/dbcon.php';

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
    <title>Accounts</title>
    <!-- Custome CSS -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- Alertify CSS -->
    <link rel="stylesheet" href="alertify/alertifycss.css">
    <link rel="stylesheet" href="alertify/alertifycss2.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- datatable css -->
    <link rel="stylesheet" href="DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="sb-nav-fixed">
    <!-- EDIT MODAL -->
    <div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-5 ">
                <div class="modal-header bg-info bg-opacity-10 border border-info border-4">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Teaching Personnels Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hiddenId" id="hiddenId">
                    <form id="editForm">
                        <!-- fetchEditData.php -->
                    </form>
                    <div class="modal-footer">
                        <button type="button" name="submitEditBtn" id="submitEditBtn" class="btn btn-primary fw-semibold">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD TEACHER MODAL -->
    <div class="modal fade modal-lg" id="addteachermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-5 ">
                <div class="modal-header bg-info bg-opacity-10 border border-info border-2">
                    <h1 class="fw-bold modal-title fs-5" id="staticBackdropLabel">Add Teacher Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTeacherForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Teacher ID</label>
                                    <input type="text" name="teacherId" id="teacherId" class="form-control bg-secondary-subtle fw-bold border-dark-subtle" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control border-dark-subtle">
                                    <small id="fnameError" class="text-danger fw-semibold"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Middle Name</label>
                                    <input type="text" name="mname" id="mname" class="form-control border-dark-subtle">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control border-dark-subtle">
                                    <small id="lnameError" class="text-danger fw-semibold"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Set default Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control border-dark-subtle">
                                        <span class="input-group-text" id="showPasswordToggle">
                                            <i class="fa-regular fa-eye" id="addteacher_eyeIcon"></i>
                                        </span>
                                    </div>
                                    <small id="passwordError" class="text-danger fw-semibold"></small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-grid ">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                            <button type="submit" id="add_teacher_btn" name="add_teacher_btn" class="btn btn-primary">Add</button>
                        </div>
                    </form>
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
                <div class="container-fluid px-4">

                    <!-- <div class="container-fluid">
                        <div class="alert alert-secondary my-2 fw-bold" role="alert">
                            Home / Manage Accounts / Accounts
                        </div>
                    </div> -->

                    <div class="container-fluid my-3 border border-dark-subtle shadow rounded">
                        <div class="row my-4 p-1 ">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-label fw-bold">
                                    <label class="fw-bold">Status : </label>
                                    <select name="filterStatus" class="mx-2 border-dark px-4 py-1 rounded col-12 col-sm-auto" id="filterStatus">
                                        <option value="">--filter status--</option>
                                        <option value="Enable">Enable</option>
                                        <option value="Disabled">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 text-lg-end text-md-end text-sm-start">
                                <div class="d-lg-flex justify-content-end gap-1">
                                    <div class="d-md-grid d-sm-grid">
                                        <button class="btn btn-danger border border-4 shadow-sm fw-semibold d-block d-sm-inline-block w-100 my-1" id="disabledButton" disabled>Disable</button>
                                    </div>
                                    <div class="d-md-grid d-sm-grid">
                                        <button class="btn btn-success border border-4 shadow-sm fw-semibold d-block d-sm-inline-block w-100 my-1" id="enableButton" disabled>Enable</button>
                                    </div>
                                    <div class="d-md-grid">
                                        <button class="btn btn-primary fw-semibold d-block d-sm-inline-block w-100 my-1" id="addteacher_btn">Add Teacher</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover border border-2 border-secondary" id="acctable">
                                <thead class="table-info">
                                    <tr class="tableRowHeader">
                                        <th class="p-1" scope="col">
                                            <input class="border-dark form-check-input" type="checkbox" id="selectAllButton">
                                            <!-- <label class="form-check-label fw-bold">All</label> -->
                                        </th>
                                        <th scope="col">Employe ID</th>
                                        <th scope="col">Teacher ID</th>
                                        <th scope="col">Last Name</th>
                                        <th class="p-1" scope="col">First Name</th>
                                        <th scope="col p-0 m-0">status</th>
                                        <th class="p-1 text-center" scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="tbodyOutput">
                                    <!-- output -->
                                </tbody>
                            </table>
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
    <!-- alertify -->
    <script src="alertify/alertify.js"></script>
    <!-- Sweet Alert -->
    <script src="sweetAlert/sweet_alert.js"></script>
    <!-- Datatable -->
    <script src="DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- Chart JS -->
    <script src="chartjs/chart.js"></script>
    <!-- External JS -->
    <script src="personnels/personnelsJs/personnels.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>