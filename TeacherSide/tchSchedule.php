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
    <link rel="stylesheet" href="../css/tchSchedule.css">
    <!-- Datatable -->
    <link rel="stylesheet" href="../DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <link rel="icon" type="img/jpg" href="../img/mainlogo.png">
    <title>Schedule</title>
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

        <!-- Module Header -->
        <div class="container-fluid my-4">
            <div class="alert alert-warning border-3 border-warning shadow-sm" role="alert">
                <h4 class="alert-heading fw-bold">Schedule</h4>
                <hr class="my-2 p-0">
                <p class="m-0">Use this module to view and download your teaching <span class="fw-bold">Schedule</span>.</p>
            </div>
        </div>

        <!-- Content Wrapper -->
        <section class="m-2">
            <div class="container-fluid">
                <div class="card cardContainer">
                    <div class="card-header fw-semibold d-flex justify-content-between">
                        <div class="text-start">
                            Teaching Schedule for: <span class="fw-bold fst-italic text-decoration-underline"><?php echo $_SESSION['teacherName'] . ' ' . $_SESSION['teacherLastName']; ?></span>
                        </div>
                        <div class="text-end">
                            <a class="btn btn-success btn-sm" href="../sched/pdf_generator.php?data_id=<?php echo $_SESSION['teacherId']; ?>&school_year=<?php echo $_SESSION['activeSchoolYear']; ?>" target="_blank"><i class="fa-solid fa-print"></i> Print schedule</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['data_id']) && isset($_GET['school_year'])) {
                            $teacher_id = $_GET['data_id'];
                            $school_year = $_GET['school_year'];

                            $sql_monday = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Monday' ORDER BY start_time  ASC";
                            $query_monday = mysqli_query($connection, $sql_monday);

                            $sql_tue = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Tuesday' ORDER BY start_time  ASC";
                            $query_tuesday = mysqli_query($connection, $sql_tue);

                            $sql_wed = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Wednesday' ORDER BY start_time  ASC";
                            $query_wednesday = mysqli_query($connection, $sql_wed);

                            $sql_thurs = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Thursday' ORDER BY start_time  ASC";
                            $query_thursday = mysqli_query($connection, $sql_thurs);

                            $sql_fri = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Friday' ORDER BY start_time  ASC";
                            $query_friday = mysqli_query($connection, $sql_fri);

                            if (mysqli_num_rows($query_monday) > 0 || mysqli_num_rows($query_tuesday) > 0 || mysqli_num_rows($query_wednesday) > 0 || mysqli_num_rows($query_thursday) > 0 || mysqli_num_rows($query_friday) > 0) {
                        ?>
                                <div class="row p-0 border border-2 border-primary">
                                    <!-- Monday -->
                                    <div class="col mb-0 p-0">
                                        <table class="table table-bordered border-primary m-0">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Monday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($query_monday) > 0) {
                                                    while ($monday = mysqli_fetch_assoc($query_monday)) {
                                                        $monday_start_time_12h = date("h:i A", strtotime($monday['start_time']));
                                                        $monday_end_time_12h = date("h:i A", strtotime($monday['end_time']));
                                                ?>
                                                        <tr>
                                                            <td class="text-center" colspan="2">
                                                                <span class="fw-semibold"><?php echo $monday_start_time_12h . ' - ' . $monday_end_time_12h; ?></span><br>
                                                                <?php echo $monday['subject']; ?><span class="fw-bold"> / </span><?php echo $monday['section']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            <h2>No schedule set for Monday</h2>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Tuesday -->
                                    <div class="col mb-0 p-0">
                                        <table class="table table-bordered border-primary m-0">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Tuesday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($query_tuesday) > 0) {
                                                    while ($tuesday = mysqli_fetch_assoc($query_tuesday)) {
                                                        $tuesday_start_time_12h = date("h:i A", strtotime($tuesday['start_time']));
                                                        $tuesday_end_time_12h = date("h:i A", strtotime($tuesday['end_time']));
                                                ?>
                                                        <tr>
                                                            <td class="text-center" colspan="2">
                                                                <span class="fw-semibold"><?php echo $tuesday_start_time_12h . ' - ' . $tuesday_end_time_12h; ?></span><br>
                                                                <?php echo $tuesday['subject']; ?><span class="fw-bold"> / </span><?php echo $tuesday['section']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            <h2>No schedule set for Tuesday</h2>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Wednesday -->
                                    <div class="col mb-0 p-0">
                                        <table class="table table-bordered border-primary m-0">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Wednesday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($query_wednesday) > 0) {
                                                    while ($wednesday = mysqli_fetch_assoc($query_wednesday)) {
                                                        $wednesday_start_time_12h = date("h:i A", strtotime($wednesday['start_time']));
                                                        $wednesday_end_time_12h = date("h:i A", strtotime($wednesday['end_time']));
                                                ?>
                                                        <tr>
                                                            <td class="text-center" colspan="2">
                                                                <span class="fw-semibold"><?php echo $wednesday_start_time_12h . ' - ' . $wednesday_end_time_12h; ?></span><br>
                                                                <?php echo $wednesday['subject']; ?><span class="fw-bold"> / </span><?php echo $wednesday['section']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            <h2>No schedule set for Wednesday</h2>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Thursday -->
                                    <div class="col mb-0 p-0">
                                        <table class="table table-bordered border-primary m-0">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Thursday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($query_thursday) > 0) {
                                                    while ($thursday = mysqli_fetch_assoc($query_thursday)) {
                                                        $thursday_start_time_12h = date("h:i A", strtotime($thursday['start_time']));
                                                        $thursday_end_time_12h = date("h:i A", strtotime($thursday['end_time']));
                                                ?>
                                                        <tr>
                                                            <td class="text-center" colspan="2">
                                                                <span class="fw-semibold"><?php echo $thursday_start_time_12h . ' - ' . $thursday_end_time_12h; ?></span><br>
                                                                <?php echo $thursday['subject']; ?><span class="fw-bold"> / </span><?php echo $thursday['section']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            <h2>No schedule set for Thursday</h2>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Friday -->
                                    <div class="col mb-0 p-0">
                                        <table class="table table-bordered border-primary m-0">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Friday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($query_friday) > 0) {
                                                    while ($friday = mysqli_fetch_assoc($query_friday)) {
                                                        $friday_start_time_12h = date("h:i A", strtotime($friday['start_time']));
                                                        $friday_end_time_12h = date("h:i A", strtotime($friday['end_time']));
                                                ?>
                                                        <tr>
                                                            <td class="text-center" colspan="2">
                                                                <span class="fw-semibold"><?php echo $friday_start_time_12h . ' - ' . $friday_end_time_12h; ?></span><br>
                                                                <?php echo $friday['subject']; ?><span class="fw-bold"> / </span><?php echo $friday['section']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="2">
                                                            <h2>No schedule set for Friday</h2>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php
                            } else {
                                // PAG WALANG SCHED NA NAKA SET
                            ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                            <strong>Empty Schedule</strong> your schedule is not yet been set
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col m-0 p-0">
                                        <table class="table table-secondary border-primary">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Monday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="2">
                                                        -
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col m-0 p-0">
                                        <table class="table table-secondary border-primary">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Tuesday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="2">
                                                        -
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col m-0 p-0">
                                        <table class="table table-secondary border-primary">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Wednesday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="2">
                                                        -
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col m-0 p-0">
                                        <table class="table table-secondary border-primary">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Thursday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="2">
                                                        -
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col m-0 p-0">
                                        <table class="table table-secondary border-primary">
                                            <thead class="table-primary border-primary">
                                                <tr>
                                                    <th class="text-center" scope="col">Friday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="2">
                                                        -
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <!-- Main wrapper End here -->




    <script src="../bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- jquery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- Databale -->
    <script src="../DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- External JS File -->
    <script src="./TeacherSchedule/tchSchedule.js"></script>
</body>

</html>