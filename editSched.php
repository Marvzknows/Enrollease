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
    <title>Admin Dashboard</title>
    <!-- Custome CSS -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- Alertify CSS -->
    <link rel="stylesheet" href="alertify/alertifycss.css">
    <link rel="stylesheet" href="alertify/alertifycss2.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="sb-nav-fixed">

    <!-- Add New Schedule Modal -->
    <div class="modal fade modal-lg" id="addNewScheduleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addScheModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h1 class="modal-title fs-5" id="addScheModalTitle">Edit Schedule</h1> -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <form id="addNewSchedForm">
                        <div class="row my-2">
                            <div class="col">
                                <h5 class="fw-bold text-start">Add Schedule</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="form-label fw-bold">Day :</label>
                                <select name="new_days" id="new_days" class="form-select border-dark">
                                    <option value="" selected> -- Select Day -- </option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">Subject :</label>
                                <select name="new_subject " id="new_subject" class="form-select border-dark">
                                    <option value="" selected> -- Select Subject -- </option>
                                    <?php
                                    $active_schoolyear = $_SESSION['activeSchoolYear'];
                                    $subjSql = "SELECT * FROM subjects WHERE school_year='$active_schoolyear'";
                                    $subjQuery = mysqli_query($connection, $subjSql);
                                    if ($subjQuery) {
                                        while ($subjects = mysqli_fetch_assoc($subjQuery)) {
                                    ?>
                                            <option value="<?php echo $subjects['subject_name']; ?>"><?php echo $subjects['subject_name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo 'fetch subject query failed';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="schoolyear" class="form-label fw-bold">Section :</label>
                                <select name="new_selectSection" class="form-select border-dark" id="new_selectSection">
                                    <!-- section options output -->
                                    <option value="" selected> -- Select Section -- </option>
                                    <?php
                                    if (isset($_GET['school_year']) && !empty($_GET['school_year'])) {
                                        $fetchSectionSyVal = $_GET['school_year'];
                                        $fetchSectionSql = "SELECT * FROM sections WHERE school_year='$fetchSectionSyVal' ORDER BY grade_level ASC";
                                        $fetchSectionQuery = mysqli_query($connection, $fetchSectionSql);
                                        if (mysqli_num_rows($fetchSectionQuery) > 0) {
                                            while ($fetchSecData = mysqli_fetch_assoc($fetchSectionQuery)) {
                                    ?>
                                                <option value="<?php echo $fetchSecData['grade_level'] . ' ' . $fetchSecData['section'] ?>"><?php echo $fetchSecData['grade_level'] . ' ' . $fetchSecData['section'] ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option value=""> - no section found - </option>
                                    <?php
                                        }
                                    } else {
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label class="form-label fw-bold">From :</label>
                                <select name="new_startTime" class="form-select border-dark" id="new_startTime">
                                    <option value="" selected> -- Select Start Time -- </option>
                                    <option value="07:00:00"> 7:00 AM </option>
                                    <option value="08:00:00"> 8:00 AM </option>
                                    <option value="09:00:00"> 9:00 AM </option>
                                    <option value="10:00:00"> 10:00 AM </option>
                                    <option value="11:00:00"> 11:00 AM </option>
                                    <option value="12:00:00"> 12:00 PM </option>
                                    <option value="13:00:00"> 1:00 PM </option>
                                    <option value="14:00:00"> 2:00 PM </option>
                                    <option value="15:00:00"> 3:00 PM </option>
                                    <option value="16:00:00"> 4:00 PM </option>
                                    <option value="17:00:00"> 5:00 PM </option>
                                    <option value="18:00:00"> 6:00 PM </option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">To :</label>
                                <select name="new_endTime" class="form-select border-dark" id="new_endTime">
                                    <option value="" selected> -- Select End Time -- </option>
                                    <option value="07:00:00"> 7:00 AM </option>
                                    <option value="08:00:00"> 8:00 AM </option>
                                    <option value="09:00:00"> 9:00 AM </option>
                                    <option value="10:00:00"> 10:00 AM </option>
                                    <option value="11:00:00"> 11:00 AM </option>
                                    <option value="12:00:00"> 12:00 PM </option>
                                    <option value="13:00:00"> 1:00 PM </option>
                                    <option value="14:00:00"> 2:00 PM </option>
                                    <option value="15:00:00"> 3:00 PM </option>
                                    <option value="16:00:00"> 4:00 PM </option>
                                    <option value="17:00:00"> 5:00 PM </option>
                                    <option value="18:00:00"> 6:00 PM </option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col text-end">
                                <span id="newSchedError" class="text-danger fw-semibold"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" id="close_sched_btn" class="btn btn-secondary">Preview</button> -->
                            <button type="button" class="btn btn-secondary fw-semibold" id="closeAddSchedModal" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="addNewScheduleButton" class="btn btn-primary fw-semibold"><i class="fa-solid fa-plus me-1"></i>Add</button>
                        </div>
                    </form>
                    <!-- section Sched -->
                    <div class="row my-2 d-none" id="sectionSchedPreview">
                        <!-- <hr> -->
                        <div class="col">
                            <div class="table-responsive overflow-auto" style="max-height: 350px;">
                                <table class="table table-striped border border-2 border-dark table-hover caption-top">
                                    <caption id="sectionNameCaption"></caption>
                                    <thead class="table-info">
                                        <tr class="tableRowHeader">
                                            <th scope="col">Day</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sectionSchedTbody">
                                        <!-- SECTION SCHED OUTPUT HERE -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Schedule Modal -->
    <div class="modal fade" id="delSchedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-5">
                <div class="modal-body">
                    <input type="hidden" name="hiddenDel_id" id="hiddenDel_id">

                    <h5><i class="fa-solid fa-triangle-exclamation me-2"></i> Are you sure you want to Delete this data?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm" id="confirmDelSchedData">Delete</button>
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
                    <!-- PASTE CONTENT BELOW HERE -->

                    <div class="container rounded p-4 border border-2 shadow my-5">
                        <!-- filter dropdown -->
                        <div class="row mb-3 justify-content-start">
                            <label for="filterDay" class="col-sm-1 col-form-label fw-bold text-end">Filter by:</label>
                            <div class="col-sm-2 mb-1">
                                <select class="form-select form-select-sm border border-secondary" id="filterDay" aria-label=".form-select-sm example">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>
                            <div class="col-lg-9 col-sm-12 text-end mb-1">
                                <button class="btn btn-primary fw-semibold btn-sm" id="addNewSchedBtn"><i class="fa-solid fa-plus me-1"></i>Add schedule</button>
                            </div>
                        </div>
                        <hr>
                        <!-- table -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border border-2 border-dark border-dark-subtle table-hover rounded" id="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Day</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Start Time</th>
                                                <th scope="col">End Time</th>
                                                <th class="text-center" scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="schedTbody">
                                            <?php
                                            if (isset($_GET['data_id']) && isset($_GET['school_year'])) {

                                                $teacherId = $_GET['data_id'];
                                                $schoolYear = $_GET['school_year'];

                                                $dataSql = "SELECT * FROM teacher_schedule WHERE school_year='$schoolYear' AND teacher_id='$teacherId' AND day='Monday'";
                                                $dataQuery = mysqli_query($connection, $dataSql);

                                                if (mysqli_num_rows($dataQuery) > 0) {
                                                    while ($schedData = mysqli_fetch_assoc($dataQuery)) {
                                                        $startTime = date("h:i A", strtotime($schedData['start_time']));
                                                        $endTime = date("h:i A", strtotime($schedData['end_time']));
                                            ?>
                                                        <tr>
                                                            <td class="edit_id d-none"><?php echo $schedData['id'] ?></td>
                                                            <td class="edit_sy d-none"><?php echo $schedData['school_year'] ?></td>
                                                            <td class="edit_tchid d-none"><?php echo $schedData['teacher_id'] ?></td>
                                                            <td class="edit_Day"><?php echo $schedData['day'] ?></td>
                                                            <td class="edit_Subject"><?php echo $schedData['subject'] ?></td>
                                                            <td class="edit_section"><?php echo $schedData['section'] ?></td>
                                                            <td class="edit_StartTime"><?php echo $startTime; ?></td>
                                                            <td class="edit_EndTime"><?php echo $endTime; ?></td>
                                                            <td class="text-center">
                                                                <!-- <button class="editSched_btn btn btn-primary btn-sm">Edit</button> -->
                                                                <button class="delSched_btn btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="edit_id d-none"> no data </td>
                                                        <td class="edit_sy d-none"> no data </td>
                                                        <td class="edit_tchid d-none"> no data </td>
                                                        <td> no data </td>
                                                        <td> no data </td>
                                                        <td> no data </td>
                                                        <td> no data </td>
                                                        <td> no data </td>
                                                        <td class="text-center">
                                                            <!-- <button class="editSched_btn btn btn-primary btn-sm" disabled>Edit</button> -->
                                                            <button class="delSched_btn btn btn-danger btn-sm" disabled><i class="fa-solid fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <!-- tr/td here -->
                                            <?php
                                            } else {
                                            ?>
                                                <div class="alert alert-warning mt-3 border border-3 border-warning" role="alert">
                                                    <h4 class="alert-heading">WARNING!</h4>
                                                    <p>Invalid Data, The data you're trying to access is empty</p>
                                                    <hr>
                                                    <p class="mb-0">manipulating data from url that does not match to system's data</p>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col text-end">
                                        <a class="btn btn-secondary" href="schedule.php">Back</a>
                                    </div>
                                </div>
                                <!-- hidden Datya -->
                                <input type="hidden" name="hiddenSchoolYear" id="hiddenSchoolYear" value="<?php echo $schoolYear ?>">
                                <input type="hidden" name="hiddenTeacherId" id="hiddenTeacherId" value="<?php echo $teacherId ?>">
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
    <!-- alertify -->
    <script src="alertify/alertify.js"></script>
    <!-- External JS -->
    <script src="sched/js/editSched.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>