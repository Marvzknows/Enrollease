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
    <title>Records</title>
    <!-- Custome CSS -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">

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
                    <!-- PASTE CONTENT BELOW HERE -->

                    <div class="container-fluid my-3">
                        <div class="card">
                            <div class="card-header fw-bold">
                                <div class="row">
                                    <div class="col-lg-6 text-lg-start text-end">
                                        <h6>Filter Student Data</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="filterForm">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12 mb-1">
                                            <label for="schoolYear" class="form-label fw-semibold">School Year</label>
                                            <select class="form-select filter_selector" id="schoolYear" aria-label="Default select example">
                                                <?php
                                                $sySql = "SELECT school_year FROM school_year ORDER BY id DESC";
                                                $syQuery = mysqli_query($connection, $sySql);
                                                if (mysqli_num_rows($syQuery) > 0) {
                                                    while ($syData = mysqli_fetch_assoc($syQuery)) {
                                                ?>
                                                        <option value="<?php echo $syData['school_year']; ?>"><?php echo $syData['school_year']; ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value=""> no school year found </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 mb-1">
                                            <label for="gradeLevel" class="form-label fw-semibold">Grade Level</label>
                                            <select class="form-select filter_selector" id="gradeLevel" aria-label="Default select example">
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 mb-1">
                                            <label for="section" class="form-label fw-semibold">Section</label>
                                            <select class="form-select filter_selector" id="selectSection" aria-label="Default select example">
                                                <option value="" selected>-- select Section --</option>
                                                <!-- fetch section here -->
                                            </select>
                                        </div>
                                    </div>
                                    <!-- 2nd row -->
                                    <div class="row mt-3">
                                        <!-- Gender -->
                                        <div class="col-lg-5 col-md-12 col-sm-12">
                                            <label class="fw-semibold me-2" for="gender">Gender:</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input filter_selector" type="radio" name="gender" id="Male" value="male">
                                                <label class="form-check-label" for="Male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input filter_selector" type="radio" name="gender" id="Female" value="female">
                                                <label class="form-check-label" for="Female">Female</label>
                                            </div>
                                        </div>
                                        <!-- Student Type -->
                                        <div class="col-lg-7 col-md-12 col-sm-12 text-end">
                                            <label class="fw-semibold me-2" for="gender">Student Type:</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input filter_selector" type="radio" name="studentType" id="Regular" value="Regular">
                                                <label class="form-check-label" for="Regular">Regular</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input filter_selector" type="radio" name="studentType" id="Transferee" value="Transferee">
                                                <label class="form-check-label" for="Transferee">Transferee</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input filter_selector" type="radio" name="studentType" id="Returnee" value="Returning">
                                                <label class="form-check-label" for="Returnee">Returning (Balik-Aral)</label>
                                            </div>
                                            <div class="form-check form-check-inline d-none" id="completer_radioBtn">
                                                <input class="form-check-input filter_selector" type="radio" name="studentType" id="Completer" value="Completer" disabled>
                                                <label class="form-check-label" for="Completer">Completer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col text-end">
                                            <button type="reset" class="btn btn-secondary btn-sm fw-semibold" id="resetFormBtn"><i class="fa-solid fa-rotate-right me-1"></i>Reset</button>
                                            <button class="btn btn-primary btn-sm fw-semibold" id="filterBtn"><i class="fa-solid fa-filter me-1"></i>Apply filters</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <!-- Table Start here -->
                                <div class="row mt-2">
                                    <div class="col">
                                        <table class="table table-striped border border-2 border-secondary table-responsive-header" id="filterTable">
                                            <thead class="table-info">
                                                <tr class="tableRowHeader">
                                                    <th scope="col">LRN</th>
                                                    <th scope="col">School Year</th>
                                                    <th scope="col">Grade Level</th>
                                                    <th scope="col">Section</th>
                                                    <th scope="col">Date Enrolled</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">Student Type</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Birth Date</th>
                                                    <th scope="col">Place of Birth</th>
                                                    <th scope="col">Mother Tongue</th>
                                                    <th scope="col">Region</th>
                                                    <th scope="col">Province</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Barangay</th>
                                                    <th scope="col">Mother Name</th>
                                                    <th scope="col">Father Name</th>
                                                    <th scope="col">Last Grade Level Completed</th>
                                                    <th scope="col">Last School Year Completed</th>
                                                    <th scope="col">Last School Attended</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableOutput">
                                                <!-- Table Output -->
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PASTE CONTENT ABOVE HERE -->
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <!-- DataTable JS -->
    <script src="DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- External Datatables CDN for exporting -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <!-- Datatable Excel library -->
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
    
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.2/js/buttons.html5.min.js"></script> -->
    <!-- datatable Excel button -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.2/js/buttons.html5.min.js"></script> -->

    <!-- External JS -->
    <script src="records/js/records.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>