<?php
session_start();
// Palitan mo nalang ng sa database galing validation pag nag error sa session
require '../database/dbcon.php';
if ($_SESSION['teacher_logged_in'] != true) {
    header('location: ../teacherLogin.php');
}

$schoolYearSql = "SELECT active_schoolyear FROM enrollment_status";
$schoolYearQuery = mysqli_query($connection, $schoolYearSql);
if($schoolYearQuery) {
    $schoolYearSession = mysqli_fetch_assoc($schoolYearQuery);
    $_SESSION['activeSchoolYear'] = $schoolYearSession['active_schoolyear'];
}else {
    echo 'Active school year session is not yet set';
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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" type="img/jpg" href="../img/mainlogo.png">
    <title>Home</title>
</head>

<body>

    <!-- ACC VALIDATION MODALS -->
    <?php
    if ($_SESSION['teacherStatus'] != 'Enable') {
    ?>
        <div class="modal fade" id="teacherStatusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="teacherStatusHeader" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="teacherStatusHeader">Account Status</h1>
                    </div>
                    <div class="modal-body p-0">
                        <div class="alert alert-warning border-3 border-warning shadow-sm m-0 p-4" role="alert">
                            <h5 class="alert-heading fw-bold text-center"><i class="fa-solid fa-triangle-exclamation"></i> Your account is currently <span class="fw-bolder text-decoration-underline">Disabled</span></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="../logreg/logout.php" class="btn btn-secondary ">I Understand</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if ($_SESSION['accStatus'] != 'old') {
    ?>
        <div class="modal fade" id="changePassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePasswordHeader" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="changePasswordHeader">Change Password</h1>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <form action="post" id="changePasswordForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Teacher ID</label>
                                <input type="text" class="form-control border border-dark-subtle" id="sessionTeacherId" value="<?php echo $_SESSION['teacherId']; ?>" readonly disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Old Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control border border-dark-subtle" id="oldPassword">
                                    <span class="input-group-text" id="oldpass_showPasswordToggle">
                                        <i class="fa-regular fa-eye" id="oldpass_eyeIcon"></i>
                                    </span>
                                </div>
                                <small class="text-danger fw-semibold" id="oldPassError"></small>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label fw-bold">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control border border-dark-subtle" id="newPassword">
                                    <span class="input-group-text" id="newpass_showPasswordToggle">
                                        <i class="fa-regular fa-eye" id="newpass_eyeIcon"></i>
                                    </span>
                                </div>
                                <small class="text-danger fw-semibold" id="newPassError"></small>
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPassword" class="form-label fw-bold">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control border border-dark-subtle" id="confirmNewPassword">
                                    <span class="input-group-text" id="confirmpass_showPasswordToggle">
                                        <i class="fa-regular fa-eye" id="confirmpass_eyeIcon"></i>
                                    </span>
                                </div>
                                <small class="text-danger fw-semibold" id="confirmNewPassError"></small>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                <button type="submit" class="btn btn-primary" id="saveChangePassBtn"><i class="fa-regular fa-circle-check me-1"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- ACC VALIDATION MODALS END HERE -->

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
        <section class="hero">
            <div class="container">
                <div class="row">
                    <!-- text -->
                    <div class="col text-column">
                        <div class="hero-text">
                            Welcome Back <span class="fw-bold text-warning"><?php echo $_SESSION['teacherName']; ?>!</span>
                        </div>
                        <p class="text-center text-white">Welcome, respected teacher of our school! We are thrilled to have you here. Get ready to streamline the enrollment process for students and easily access your teaching schedules with our user-friendly online system. Real efficiency awaits you.</p>
                        <div class="buttons">
                            <a class="btn btn-primary fw-bold border border-2 border-primary" href="../TeacherSide/tchEnrollment.php">Enrollment</a>
                            <a class="btn btn-secondary fw-bold border border-2 border-secondary" href="tchSchedule.php?data_id=<?php echo $_SESSION['teacherId']; ?>&school_year=<?php echo $_SESSION['activeSchoolYear']; ?>">View Schedule</a>
                        </div>
                    </div>
                    <!-- image -->
                    <!-- <div class="col-md-6">
                        <img src="../img/index-bg.jpg" alt="hero-img" class="w-100 column-image">
                    </div> -->
                </div>
            </div>
        </section>

    </div>
    <!-- Main wrapper End here -->


    <!-- JQuery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- Sweet Alert JS -->
    <script src="../sweetAlert/sweet_alert.js"></script>
    <!-- External JS -->
    <script src="../TeacherSide/changePassword/changePassword.js"></script>
    <!-- DISPLAY ACC VALIDATION MODALS -->
    <script>
        $(document).ready(function() {
            $('#teacherStatusModal').modal('show');
            $('#changePassModal').modal('show');
        });
    </script>
</body>

</html>