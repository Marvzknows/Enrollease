<?php
session_start();

require '../database/dbcon.php';

if ($_SESSION['teacher_logged_in'] != true) {
    header('location: ../teacherLogin.php');
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
    <title>Advance Students</title>
</head>

<body>
    <!-- ENROLLMENT STATUS -->
    <!-- NASA BABA YUNG JS SCRIPT NG PAG SHOW NG MODAL -->
    <?php
    $statusSql = "SELECT status FROM enrollment_status WHERE status='close'";
    $statusQuery = mysqli_query($connection, $statusSql);

    if ($statusQuery) {

        if (mysqli_num_rows($statusQuery) > 0) {
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
                            <a href="index.php" class="btn btn-secondary ">Close</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
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
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
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
                                                <thead class="table-dark">
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
        </section>


    </div>
    <!-- Main wrapper End here -->




    <script src="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- Jquery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- Datatable -->
    <script src="../DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- Alertify -->
    <script src="../alertify/alertify.js"></script>
    <!-- SweetAlert -->
    <script src="../sweetAlert/sweet_alert.js"></script>
    <!-- Enrollment Status Modal -->
    <script>
        $(document).ready(function() {
            $('#enrollmentStatusModal').modal('show');
        });
    </script>
    <!-- External JS -->
    <script src="./TeacherStudents/js/students.js"></script>
</body>

</html>