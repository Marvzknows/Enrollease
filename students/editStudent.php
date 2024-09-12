<?php

session_start();
// database
require '../database/dbcon.php';
// prevent open page through url
if ($_SESSION['admin_login'] != true) {
    header('location: ../adminLogin.php');
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
    <title>Edit Student Data</title>
    <!-- Custome CSS -->
    <link href="../css/dashboard.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

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
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
                            Manage Accounts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../accounts.php">Accounts</a>
                                <a class="nav-link" href="../activityLog/logs.php">Activity Log</a>
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
                    <!-- PASTE CONTENT BELOW HERE -->

                    <?php
                    if (empty($_GET['data_id']) || empty($_GET['school_year']) || empty($_GET['gradeLevel']) || empty($_GET['section'])) {
                    ?>
                        <div class="alert alert-warning mt-3 border border-3 border-warning" role="alert">
                            <h4 class="alert-heading">WARNING!</h4>
                            <p>Invalid Data, The data you're trying to access is empty</p>
                            <hr>
                            <p class="mb-0">manipulating data from url that does not match to system's data</p>
                        </div>
                        <?php
                    } else {

                        $id = $_GET['data_id'];
                        $schoolYear = $_GET['school_year'];
                        $gradeLevel = $_GET['gradeLevel'];
                        $section = $_GET['section'];

                        if ($gradeLevel == '7') {
                            $databaseTable = 'grade_seven';
                        } elseif ($gradeLevel == '8') {
                            $databaseTable = 'grade_eight';
                        } elseif ($gradeLevel == '9') {
                            $databaseTable = 'grade_nine';
                        } elseif ($gradeLevel == '10') {
                            $databaseTable = 'grade_ten';
                        }

                        $fetchSql = "SELECT * FROM $databaseTable WHERE school_year='$schoolYear' AND grade_level='$gradeLevel' AND section='$section' AND id='$id'";
                        $fetchQuery = mysqli_query($connection, $fetchSql);

                        if (mysqli_num_rows($fetchQuery) > 0) {
                            $data = mysqli_fetch_assoc($fetchQuery);
                        } else {
                            $_SESSION['invalid_student_edit_data'] = true;
                        ?>
                            <script>
                                window.location.href = '../errorPage.php';
                            </script>
                        <?php
                        }
                        ?>
                        <div class="contaier my-3">
                            <div class="card border border-2 shadow-sm">
                                <div class="card-header fw-bold">
                                    Edit student's data form
                                </div>
                                <div class="card-body">
                                    <form id="enrollmentForm">
                                        <!-- HIdden Student ID -->
                                        <input type="hidden" value="<?php echo $id; ?>" id="hiddenStudentId">
                                        <input type="hidden" value="<?php echo $schoolYear; ?>" id="hiddenSchoolYear">
                                        <input type="hidden" value="<?php echo $gradeLevel; ?>" id="hiddenGradeLevel">
                                        <input type="hidden" value="<?php echo $section; ?>" id="hiddenSection">

                                        <div class="row mb-3">
                                            <label for="schoolYear" class="col-sm-2 col-form-label fw-semibold">School Year</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="schoolYear" value="<?php echo $data['school_year']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="lrn" class="col-sm-2 col-form-label fw-semibold">Learner Reference No.</label>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" id="lrn" value="<?php echo $data['lrn']; ?>" readonly>
                                                <small class="text-danger fw-bold" id="lrnError"></small>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col">
                                                <label for="lrn" class="form-label fw-semibold">Grade Level: </label>
                                                <select class="form-select" aria-label="Default select example" name="selectGradeLevel" id="selectGradeLevel">
                                                    <option value="">- select grade level -</option>
                                                    <option value="7" <?php if ($data['grade_level'] == 7) echo 'selected'; ?>>7</option>
                                                    <option value="8" <?php if ($data['grade_level'] == 8) echo 'selected'; ?>>8</option>
                                                    <option value="9" <?php if ($data['grade_level'] == 9) echo 'selected'; ?>>9</option>
                                                    <option value="10" <?php if ($data['grade_level'] == 10) echo 'selected'; ?>>10</option>
                                                </select>
                                                <small class="text-danger fw-bold" id="gradeLvlError"></small>
                                            </div>
                                            <div class="col">
                                                <label for="lrn" class="form-label fw-semibold">Section: </label>
                                                <select class="form-select" aria-label="Default select example" name="selectSection" id="selectSection">
                                                    <?php
                                                    $sectionSql = "SELECT section FROM sections WHERE school_year='$schoolYear' AND grade_level='$gradeLevel'";
                                                    $sectionQuery = mysqli_query($connection, $sectionSql);

                                                    if ($sectionQuery) {
                                                        while ($sectionData = mysqli_fetch_assoc($sectionQuery)) {
                                                            $sectionName = $sectionData['section'];
                                                            $selected = ($sectionName == $section) ? 'selected' : ''; // Check if it should be selected
                                                            echo "<option value='$sectionName' $selected>$sectionName</option>";
                                                        }
                                                    } else {
                                                        echo '<option value="" selected>- section query failed -</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <small class="text-danger fw-bold" id="selectSectionError"></small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="form-label fw-semibold">Student Type</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="student_type" id="regular" value="Regular" <?php if ($data['student_type'] == 'Regular') echo 'checked="checked"'; ?> <?php if ($data['student_type'] == 'Returning') echo 'disabled'; ?>>
                                            <label class="form-check-label" for="regular">Regular</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="student_type" id="transferee" value="Transferee" <?php if ($data['student_type'] == 'Transferee') echo 'checked="checked"'; ?> <?php if ($data['student_type'] == 'Returning') echo 'disabled'; ?>>
                                            <label class="form-check-label" for="transferee">Transferee</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="student_type" id="returnee" value="Returning" <?php if ($data['student_type'] == 'Returning') echo 'checked="checked"'; ?> <?php if ($data['student_type'] == 'Transferee' || $data['student_type'] == 'Regular') echo 'disabled'; ?>>
                                            <label class="form-check-label" for="returnee">Returning (Balik-Aral)</label>
                                        </div>
                                        <div class="row">
                                            <small class="text-danger fw-bold" id="student_typeError"></small>
                                        </div>
                                        <hr>
                                        <div class="alert alert-primary my-3" role="alert">
                                            <h4 class="fw-bold">Learner Information</h4>
                                        </div>
                                        <hr>
                                        <div class="row my-3">
                                            <div class="col-lg-5 col-md-12">
                                                <label for="fname" class="form-label fw-semibold">First Name</label>
                                                <input type="text" class="form-control" id="fname" value="<?php echo $data['stud_fname']; ?>">
                                                <small class="text-danger fw-bold" id="fnameError"></small>
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="mname" class="form-label fw-semibold">Middle Name</label>
                                                <input type="text" class="form-control" id="mname" value="<?php echo $data['stud_mname']; ?>">
                                                <small class="text-danger fw-bold" id="mnameError"></small>
                                            </div>
                                            <div class="col-lg-5 col-md-12">
                                                <label for="lname" class="form-label fw-semibold">Last Name</label>
                                                <input type="text" class="form-control" id="lname" value="<?php echo $data['stud_lname']; ?>">
                                                <small class="text-danger fw-bold" id="lnameError"></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-12">
                                                <label for="birth_Date" class="form-label fw-semibold">Birth Date</label>
                                                <input type="date" class="form-control" id="birth_Date" value="<?php echo $data['birth_date']; ?>">
                                                <small class="text-danger fw-bold" id="birth_DateError"></small>
                                            </div>
                                            <div class="col-lg-1 col-md-12">
                                                <label for="age" class="form-label fw-semibold">Age</label>
                                                <input type="text" class="form-control text-center fw-semibold" id="age" value="<?php echo $data['age']; ?>" readonly disabled>
                                                <small class="text-danger fw-bold" id="age_Error"></small>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="place_of_birth" class="form-label fw-semibold">Place of Birth (Municipality/City)</label>
                                                <input type="text" class="form-control" id="place_of_birth" value="<?php echo $data['place_of_birth']; ?>">
                                                <small class="text-danger fw-bold" id="place_of_birthError"></small>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="mother_tounge" class="form-label fw-semibold">Mother Toungue</label>
                                                <input type="text" class="form-control" id="mother_tongue" value="<?php echo $data['mother_tongue']; ?>">
                                                <small class="text-danger fw-bold" id="mother_toungeError"></small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="form-label fw-semibold">Gender</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if ($data['gender'] == 'Male') echo 'checked="checked"'; ?>>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if ($data['gender'] == 'Female') echo 'checked="checked"'; ?>>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        <div class="row">
                                            <small class="text-danger fw-bold" id="genderError"></small>
                                        </div>
                                        <hr>
                                        <div class="alert alert-primary my-3" role="alert">
                                            <h4 class="fw-bold">Address</h4>
                                        </div>
                                        <hr>
                                        <!-- ADDRESS -->
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="lrn" class="form-label fw-semibold">Region: </label>
                                                <select class="form-select" aria-label="Default select example" name="region" id="region">
                                                    <option value="" selected><?php echo $data['region'] ?></option>
                                                    <!-- region output -->
                                                </select>
                                                <small class="text-danger fw-bold" id="regionError"></small>
                                            </div>
                                            <div class="col">
                                                <label for="lrn" class="form-label fw-semibold">Province: </label>
                                                <select class="form-select" aria-label="Default select example" name="province" id="province">
                                                    <!-- <option value="" selected>- select province -</option> -->
                                                    <option value="" selected><?php echo $data['province'] ?></option>
                                                    <!-- province output -->
                                                </select>
                                                <small class="text-danger fw-bold" id="provinceError"></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="lrn" class="form-label fw-semibold">City: </label>
                                                <select class="form-select" aria-label="Default select example" name="city" id="city">
                                                    <!-- <option value="" selected>- select city -</option> -->
                                                    <option value="" selected><?php echo $data['city'] ?></option>
                                                    <!-- city output -->
                                                </select>
                                                <small class="text-danger fw-bold" id="cityError"></small>
                                            </div>
                                            <div class="col">
                                                <label for="lrn" class="form-label fw-semibold">Barangay: </label>
                                                <select class="form-select" aria-label="Default select example" name="barangay" id="barangay">
                                                    <!-- <option value="" selected>- select barangay -</option> -->
                                                    <option value="" selected><?php echo $data['barangay'] ?></option>
                                                    <!-- barangay output -->
                                                </select>
                                                <small class="text-danger fw-bold" id="barangayError"></small>
                                            </div>
                                        </div>
                                        <!-- PARENT GUARDIAN INFORMATION -->
                                        <hr>
                                        <div class="alert alert-primary my-3" role="alert">
                                            <h4 class="fw-bold">Parent's / Guardian Information</h4>
                                        </div>
                                        <hr>
                                        <div class="row my-3">
                                            <!-- Mother -->
                                            <div class="col-12">
                                                <h5 class="fst-italic fw-semibold text-decoration-underline">Mother Name</h5>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="mother_fname" class="form-label fw-semibold">First Name</label>
                                                <input type="text" class="form-control" id="mother_fname" value="<?php echo $data['mother_fname']; ?>">
                                                <small class="text-danger fw-bold" id="mother_fnameError"></small>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <label for="mother_mname" class="form-label fw-semibold">Middle Name</label>
                                                <input type="text" class="form-control" id="mother_mname" value="<?php echo $data['mother_mname']; ?>">
                                                <small class="text-danger fw-bold" id="mother_mnameError"></small>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="mother_lname" class="form-label fw-semibold">Last Name</label>
                                                <input type="text" class="form-control" id="mother_lname" value="<?php echo $data['mother_lname']; ?>">
                                                <small class="text-danger fw-bold" id="mother_lnameError"></small>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <label for="mother_number" class="form-label fw-semibold">Contact Number</label>
                                                <input type="number" class="form-control" id="mother_number" value="<?php echo $data['mother_number']; ?>">
                                                <small class="text-danger fw-bold" id="mother_numberError"></small>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <!-- Father -->
                                            <div class="col-12">
                                                <h5 class="fst-italic fw-semibold text-decoration-underline">Father Name</h5>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="father_fname" class="form-label fw-semibold">First Name</label>
                                                <input type="text" class="form-control" id="father_fname" value="<?php echo $data['father_fname']; ?>">
                                                <small class="text-danger fw-bold" id="father_fnameError"></small>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <label for="father_mname" class="form-label fw-semibold">Middle Name</label>
                                                <input type="text" class="form-control" id="father_mname" value="<?php echo $data['father_mname']; ?>">
                                                <small class="text-danger fw-bold" id="father_mnameError"></small>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="father_lname" class="form-label fw-semibold">Last Name</label>
                                                <input type="text" class="form-control" id="father_lname" value="<?php echo $data['father_lname']; ?>">
                                                <small class="text-danger fw-bold" id="father_lnameError"></small>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <label for="father_number" class="form-label fw-semibold">Contact Number</label>
                                                <input type="number" class="form-control" id="father_number" value="<?php echo $data['father_number']; ?>">
                                                <small class="text-danger fw-bold" id="father_numberError"></small>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <!-- Guardian -->
                                            <div class="col-12">
                                                <h5 class="fst-italic fw-semibold text-decoration-underline">Legal Guardian Name</h5>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="guardian_fname" class="form-label fw-semibold">First Name</label>
                                                <input type="text" class="form-control" id="guardian_fname" value="<?php echo $data['guardian_fname']; ?>">
                                                <small class="text-danger fw-bold" id="guardian_fnameError"></small>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <label for="guardian_mname" class="form-label fw-semibold">Middle Name</label>
                                                <input type="text" class="form-control" id="guardian_mname" value="<?php echo $data['guardian_mname']; ?>">
                                                <small class="text-danger fw-bold" id="guardian_mnameError"></small>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label for="guardian_lname" class="form-label fw-semibold">Last Name</label>
                                                <input type="text" class="form-control" id="guardian_lname" value="<?php echo $data['guardian_lname']; ?>">
                                                <small class="text-danger fw-bold" id="guardian_lnameError"></small>
                                            </div>
                                            <div class="col-lg-2 col-md-12">
                                                <label for="guardian_number" class="form-label fw-semibold">Contact Number</label>
                                                <input type="number" class="form-control" id="guardian_number" value="<?php echo $data['guardian_number']; ?>">
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
                                                <label for="last_gradel_level" class="form-label fw-semibold">Last Grade level completed</label>
                                                <input type="number" class="form-control" id="last_gradel_level" value="<?php echo $data['last_grade_level']; ?>" <?php if ($data['student_type'] == 'Regular' || $data['student_type'] == 'Returning') echo 'disabled'; ?>>
                                                <small class="fst-italic text-muted">(accepting grade 7-10 only)</small>
                                                <small class="text-danger fw-bold" id="last_gradel_levelError"></small>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <label for="last_school_year" class="form-label fw-semibold">Last School Year Completed</label>
                                                <input type="text" class="form-control" id="last_school_year" value="<?php echo $data['last_School_year']; ?>" <?php if ($data['student_type'] == 'Regular' || $data['student_type'] == 'Returning') echo 'disabled'; ?>>
                                                <small class="text-danger fw-bold" id="last_school_yearError"></small>
                                            </div>
                                            <div class="col-12">
                                                <label for="last_school" class="form-label fw-semibold">Last School Attended</label>
                                                <input type="text" class="form-control" id="last_school" value="<?php echo $data['last_school']; ?>" <?php if ($data['student_type'] == 'Regular' || $data['student_type'] == 'Returning') echo 'disabled'; ?>>
                                                <small class="text-danger fw-bold" id="last_schoolError"></small>
                                            </div>
                                        </div>
                                        <div class="row mt-3 justify-content-end">
                                            <div class="col-2">
                                                <button type="submit" class="btn btn-primary fw-semibold w-100" id="submitFormBtn">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- PASTE CONTENT ABOVE HERE -->
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- Sweet Alert -->
    <script src="../sweetAlert/sweet_alert.js"></script>
    <!-- JQuery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- External JS -->
    <script src="../students/js/editStudent.js"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>