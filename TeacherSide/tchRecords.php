<?php
session_start();

require '../database/dbcon.php';

if ($_SESSION['teacher_logged_in'] != true) {
    header('location: ../teacherLogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="../DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <!-- Alertify CSS -->
    <link rel="stylesheet" href="../alertify/alertifycss.css">
    <link rel="stylesheet" href="../alertify/alertifycss2.css">
    <!-- FontAwesom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="../css/teacherEnrollment.css">
    <link rel="icon" type="img/jpg" href="../img/mainlogo.png">
    <title>Records</title>

    <style>
        .table-responsive-header thead th,
        .table-responsive-header tbody td {
            white-space: nowrap;
            /* Prevent text from wrapping */
        }
    </style>
</head>

<body>

    <!-- Main wrapper Start here -->
    <div class="container-fluid p-0">
        <!-- nav bar -->
        <nav class="navbar navbar-expand-lg py-3 sticky-top">
            <div class="container-fluid">
                <!-- img logo -->
                <img src="../img/mainlogo.png" class="img-fluid d-inline mx-2" alt="mainlogo" width="45" height="auto">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand text-white fw-bold" href="index.php">
                        Kapitangan National HighSchool
                    </a>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="tchEnrollment.php">Enrollment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="tchStudent.php">Advance Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="tchRecords.php">Records</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="tchSchedule.php?data_id=<?php echo $_SESSION['teacherId']; ?>&school_year=<?php echo $_SESSION['activeSchoolYear']; ?>">Schedule</a>
                        </li>
                        <li class="nav-item mx-3">
                            <div class="dropdown-center mx-3">
                                <button class="fw-semibold btn bg-transparent border-none border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="teacherName"><i class="fa-regular fa-user mx-2"></i><?php echo $_SESSION['teacherName'] ?></span>
                                </button>
                                <ul class="dropdown-menu ">
                                    <!-- <li><a class="dropdown-item" href="#">Change Password</a></li> -->
                                    <li><a class="dropdown-item" href="../logreg/teacherLogout.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <section class="m-2">
            <div class="container-fluid mt-2">
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
        </section>


    </div>
    <!-- Main wrapper End here -->




    <script src="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- Jquery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- Datatable -->
    <script src="../DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- External Datatables CDN for exporting -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <!-- Datatable Excel library -->
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
    <!-- Alertify -->
    <script src="../alertify/alertify.js"></script>
    <!-- SweetAlert -->
    <script src="../sweetAlert/sweet_alert.js"></script>
    <!-- External JS -->
    <script src="../TeacherSide/TeacherRecord/records.js"></script>
</body>

</html>