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
    <!-- FontAwesom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="../css/teacherEnrollment.css">
    <link rel="icon" type="img/jpg" href="../img/mainlogo.png">
    <title>Enrollment</title>

    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
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
                        <li class="nav-item me-3">
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

        <!-- Module Header -->
        <div class="container-fluid my-4">
            <div class="alert alert-warning border-3 border-warning shadow-sm" role="alert">
                <h4 class="alert-heading fw-bold">Student Enrollment</h4>
                <hr class="my-2 p-0">
                <p class="m-0">Use this module to <span class="fw-bold">Enroll</span> a students.</p>
            </div>
        </div>

        <!-- Enrollment Content Wrapper -->
        <section class="m-3">
            <div class="contaier-fluid my-2">
                <?php
                $lastSySql = "SELECT MAX(id)-1 as id FROM school_year";
                $lastSyQuery = mysqli_query($connection, $lastSySql);
                if ($lastSyQuery) {
                    $activeSyData = mysqli_fetch_assoc($lastSyQuery);
                    $current_sy = $activeSyData['id'];

                    $lastSy_sql = "SELECT school_year FROM school_year WHERE id='$current_sy'";
                    $lastSy_Query = mysqli_query($connection, $lastSy_sql);

                    if ($lastSy_Query) {
                        if (mysqli_num_rows($lastSy_Query) > 0) {
                            $schoolyearData = mysqli_fetch_assoc($lastSy_Query);
                            $last_school_year_val = $schoolyearData['school_year'];
                ?>
                            <input type="hidden" id="hidden_last_school_year" value="<?php echo $last_school_year_val; ?>">
                <?php
                        } else {
                            echo 'no sy found';
                        }
                    }
                } else {
                    echo ' lastSyQuery Failed';
                }
                ?>
                <div class="card border border-2 shadow-sm">
                    <div class="card-header fw-bold">
                        Enrollment Form
                    </div>
                    <div class="card-body">
                        <form id="enrollmentForm">
                            <!-- hidden Teacher ID -->
                            <input type="hidden" name="hiddenTeacherId" id="hiddenTeacherId" value="<?php echo $_SESSION['teacherId']; ?>">
                            <div class="row mb-3">
                                <label for="schoolYear" class="col-sm-2 col-form-label fw-semibold">School Year</label>
                                <div class="col-sm-3">
                                    <?php
                                    $activeSySql = "SELECT * FROM enrollment_status";
                                    $activeSyQuery = mysqli_query($connection, $activeSySql);
                                    if ($activeSyQuery) {
                                        $sy = mysqli_fetch_assoc($activeSyQuery);
                                    ?>
                                        <input type="text" class="form-control bg-secondary bg-opacity-50 fw-bold" id="schoolYear" value="<?php echo $sy['active_schoolyear']; ?>" readonly>
                                    <?php
                                    } else {
                                        echo 'school year query failed';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="lrn" class="col-sm-2 col-form-label fw-semibold">Learner Reference No. <span class="text-danger fw-bold">*</span></label>
                                <div class="col-sm-3">
                                    <div class="input-group ">
                                        <input type="number" class="form-control" id="lrn" autocomplete="off">
                                        <button type="button" class="btn btn-outline-success d-none" id="returnee_btn"><i class="fa-solid fa-check"></i></button>
                                    </div>
                                    <div id="lrnList">
                                        <!-- studet LRN list output -->
                                    </div>
                                    <small class="text-muted fw-bold" id="returnee_policy"></small>
                                    <small class="text-danger fw-bold" id="lrnError"></small>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-3 col-sm-12">
                                    <label for="lrn" class="form-label fw-semibold">Grade Level: <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select" aria-label="Default select example" name="selectGradeLevel" id="selectGradeLevel">
                                        <option value="">- select grade level -</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <small class="text-danger fw-bold" id="gradeLvlError"></small>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <label for="lrn" class="form-label fw-semibold">Section: <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select" aria-label="Default select example" name="selectSection" id="selectSection">
                                        <option value="" selected>- select section -</option>
                                        <!-- section output -->
                                    </select>
                                    <small class="text-danger fw-bold" id="selectSectionError"></small>
                                    <small class="fst-italic text-muted fw-semibold" id="capacityError"></small>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="row">
                                        <label class="form-label fw-semibold">Student Type <span class="text-danger fw-bold">*</span></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="student_type" id="regular" value="Regular">
                                        <label class="form-check-label" for="regular">Regular</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="student_type" id="transferee" value="Transferee">
                                        <label class="form-check-label" for="transferee">Transferee</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="student_type" id="returnee" value="Returning">
                                        <label class="form-check-label" for="returnee">Returnee (Balik-Aral)</label>
                                    </div>
                                    <div class="row">
                                        <small class="text-danger fw-bold" id="student_typeError"></small>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="alert alert-primary my-3" role="alert">
                                        <h4 class="fw-bold">Learner Information</h4>
                                    </div>
                                    <hr> -->
                            <div class="row my-3">
                                <div class="col-lg-5 col-md-12">
                                    <label for="fname" class="form-label fw-semibold">First Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="fname">
                                    <small class="text-danger fw-bold" id="fnameError"></small>
                                </div>
                                <div class="col-lg-2">
                                    <label for="mname" class="form-label fw-semibold">Middle Name</label>
                                    <input type="text" class="form-control" id="mname">
                                    <small class="text-danger fw-bold" id="mnameError"></small>
                                </div>
                                <div class="col-lg-5 col-md-12">
                                    <label for="lname" class="form-label fw-semibold">Last Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="lname">
                                    <small class="text-danger fw-bold" id="lnameError"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-12">
                                    <label for="birth_Date" class="form-label fw-semibold">Birth Date <span class="text-danger fw-bold">*</span></label>
                                    <input type="date" class="form-control" id="birth_Date">
                                    <small class="text-danger fw-bold" id="birth_DateError"></small>
                                </div>
                                <div class="col-lg-1 col-md-12">
                                    <label for="age" class="form-label fw-semibold">Age</label>
                                    <input type="text" class="form-control text-center fw-semibold" id="age" readonly disabled>
                                    <small class="text-danger fw-bold" id="age_Error"></small>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="place_of_birth" class="form-label fw-semibold">Place of Birth (Municipality/City) <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="place_of_birth">
                                    <small class="text-danger fw-bold" id="place_of_birthError"></small>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="mother_tounge" class="form-label fw-semibold">Mother Tongue<span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="mother_tounge">
                                    <small class="text-danger fw-bold" id="mother_toungeError"></small>
                                </div>
                            </div>
                            <div class="row">
                                <label class="form-label fw-semibold">Gender <span class="text-danger fw-bold">*</span></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="row">
                                <small class="text-danger fw-bold" id="genderError"></small>
                            </div>
                            <hr>
                            <!-- <div class="alert alert-primary my-3" role="alert">
                                        <h4 class="fw-bold">Address</h4>
                                    </div>
                                    <hr> -->
                            <!-- ADDRESS -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="lrn" class="form-label fw-semibold">Region: <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select" aria-label="Default select example" name="region" id="region">
                                        <option value="" selected>- select region -</option>
                                        <!-- region output -->
                                    </select>
                                    <small class="text-danger fw-bold" id="regionError"></small>
                                </div>
                                <div class="col">
                                    <label for="lrn" class="form-label fw-semibold">Province: <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select" aria-label="Default select example" name="province" id="province" disabled>
                                        <option value="" selected>- select province -</option>
                                        <!-- province output -->
                                    </select>
                                    <small class="text-danger fw-bold" id="provinceError"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="lrn" class="form-label fw-semibold">City: <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select" aria-label="Default select example" name="city" id="city" disabled>
                                        <option value="" selected>- select city -</option>
                                        <!-- city output -->
                                    </select>
                                    <small class="text-danger fw-bold" id="cityError"></small>
                                </div>
                                <div class="col">
                                    <label for="lrn" class="form-label fw-semibold">Barangay: <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select" aria-label="Default select example" name="barangay" id="barangay" disabled>
                                        <option value="" selected>- select barangay -</option>
                                        <!-- barangay output -->
                                    </select>
                                    <small class="text-danger fw-bold" id="barangayError"></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-end">
                                    <button type="button" class="btn btn-info btn-sm d-none" id="resetAddressBtn"><i class="fa-solid fa-rotate-right me-1"></i>Input new address</button>
                                </div>
                            </div>
                            <!-- PARENT GUARDIAN INFORMATION -->
                            <hr>
                            <!-- <div class="alert alert-primary my-3" role="alert">
                                        <h4 class="fw-bold">Parent's / Guardian Information</h4>
                                    </div>
                                    <hr> -->
                            <div class="row my-3">
                                <!-- Mother -->
                                <div class="col-12">
                                    <h5 class="fst-italic fw-semibold text-decoration-underline">Mother Name</h5>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="mother_fname" class="form-label fw-semibold">First Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="mother_fname">
                                    <small class="text-danger fw-bold" id="mother_fnameError"></small>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <label for="mother_mname" class="form-label fw-semibold">Middle Name</label>
                                    <input type="text" class="form-control" id="mother_mname">
                                    <small class="text-danger fw-bold" id="mother_mnameError"></small>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="mother_lname" class="form-label fw-semibold">Last Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="mother_lname">
                                    <small class="text-danger fw-bold" id="mother_lnameError"></small>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <label for="mother_number" class="form-label fw-semibold">Contact Number <span class="text-danger fw-bold">*</span></label>
                                    <input type="number" class="form-control" id="mother_number">
                                    <small class="text-danger fw-bold" id="mother_numberError"></small>
                                </div>
                            </div>
                            <div class="row my-3">
                                <!-- Father -->
                                <div class="col-12">
                                    <h5 class="fst-italic fw-semibold text-decoration-underline">Father Name</h5>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="father_fname" class="form-label fw-semibold">First Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="father_fname">
                                    <small class="text-danger fw-bold" id="father_fnameError"></small>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <label for="father_mname" class="form-label fw-semibold">Middle Name</label>
                                    <input type="text" class="form-control" id="father_mname">
                                    <small class="text-danger fw-bold" id="father_mnameError"></small>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="father_lname" class="form-label fw-semibold">Last Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="father_lname">
                                    <small class="text-danger fw-bold" id="father_lnameError"></small>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <label for="father_number" class="form-label fw-semibold">Contact Number <span class="text-danger fw-bold">*</span></label>
                                    <input type="number" class="form-control" id="father_number">
                                    <small class="text-danger fw-bold" id="father_numberError"></small>
                                </div>
                            </div>
                            <div class="row my-3">
                                <!-- Guardian -->
                                <div class="col-12">
                                    <h5 class="fst-italic fw-semibold text-decoration-underline">Legal Guardian Name</h5>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="guardian_fname" class="form-label fw-semibold">First Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="guardian_fname">
                                    <small class="text-danger fw-bold" id="guardian_fnameError"></small>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <label for="guardian_mname" class="form-label fw-semibold">Middle Name</label>
                                    <input type="text" class="form-control" id="guardian_mname">
                                    <small class="text-danger fw-bold" id="guardian_mnameError"></small>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="guardian_lname" class="form-label fw-semibold">Last Name <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="guardian_lname">
                                    <small class="text-danger fw-bold" id="guardian_lnameError"></small>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <label for="guardian_number" class="form-label fw-semibold">Contact Number <span class="text-danger fw-bold">*</span></label>
                                    <input type="number" class="form-control" id="guardian_number">
                                    <small class="text-danger fw-bold" id="guardian_numberError"></small>
                                </div>
                            </div>
                            <hr>
                            <div class="alert alert-primary my-3" role="alert">
                                <h4 class="fw-bold">For Returning Learner (Balik-Aral) and Those Who will Transfer/Move In</h4>
                            </div>
                            <hr>
                            <!-- TRANSFEREE / RETURNEE -->
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="last_gradel_level" class="form-label fw-semibold">Last Grade level completed <span class="text-danger fw-bold">*</span></label>
                                    <input type="number" class="form-control" id="last_gradel_level" disabled>
                                    <small class="fst-italic text-muted">(accepting grade 6-10 only)</small>
                                    <small class="text-danger fw-bold" id="last_gradel_levelError"></small>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="last_school_year" class="form-label fw-semibold">Last School Year Completed <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="last_school_year" disabled>
                                    <small class="text-danger fw-bold" id="last_school_yearError"></small>
                                </div>
                                <div class="col-12">
                                    <label for="last_school" class="form-label fw-semibold">Last School Attended <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control" id="last_school" disabled>
                                    <small class="text-danger fw-bold" id="last_schoolError"></small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="reset" class="btn btn-secondary fw-semibold me-2" id="resetFormBtn">Reset</button>
                                <button type="submit" class="btn btn-primary fw-semibold" id="submitFormBtn">Enroll</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <!-- Main wrapper End here -->



    <!-- Bootstrap JS -->
    <script src="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- Sweet Alert -->
    <script src="../sweetAlert/sweet_alert.js"></script>
    <!-- Jquery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- Enrollment Status Modal -->
    <script>
        $(document).ready(function() {
            $('#enrollmentStatusModal').modal('show');
        });
    </script>
    <!-- External JS -->
    <!-- INCLUDE MO DITO SCRIPTS NUNG ENROLLMNT VALIDATION JS NUNG SA ADMIN SIDE -->
    <script src="../TeacherSide/TeacherEnrollment/js/address.js"></script>
    <script src="../TeacherSide/TeacherEnrollment/js/enrollment.js"></script>
    <!-- <script src="TeacherEnrollment/fetchSection.js"></script> -->
    <!-- <script src="TeacherEnrollment/enrollmentValidation.js"></script> -->
</body>

</html>