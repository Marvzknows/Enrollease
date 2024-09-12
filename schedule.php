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
    <title>Schedule</title>
    <!-- Custome CSS -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="css/sched_view.css"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- datatable css -->
    <link rel="stylesheet" href="DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <!-- alertify -->
    <link rel="stylesheet" href="alertify/alertifycss.css">
    <link rel="stylesheet" href="alertify/alertifycss2.css">

    <style>
        .tableRowHeader {
            border-bottom: 3px solid #6c757d;
        }

        #teacherDatatable {
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }

        .fw-semibold {
            white-space: nowrap;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- Add Schedule Modal -->
    <div class="modal fade modal-lg" id="addSchedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addScheModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addScheModalTitle">Add Schedule</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <form id="addSchedForm">
                        <!-- hidden teacherID -->
                        <input type="hidden" name="hiddenTeacherId" id="hiddenTeacherId">
                        <div class="row">
                            <div class="col">
                                <label class="form-label fw-bold">Teacher Name :</label>
                                <input class="bg-info p-2 bg-opacity-25 text-dark form-control border border-info border-2 fw-semibold" type="text" id="teacherFullName" name="teacherFullName" readonly>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">School Year :</label>
                                <input class="bg-info p-2 bg-opacity-25 text-dark form-control border border-info border-2 fw-semibold" type="text" id="schoolYearVal" name="schoolYearVal" readonly>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <hr>
                                <h5 class="fw-bold text-center">Schedule Form</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="form-label fw-bold">Day :</label>
                                <select name="days" id="days" class="form-select border-dark">
                                    <option value="">Select Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">Subject :</label>
                                <select name="subject " id="subject" class="form-select border-dark">
                                    <option value="">Select Subject</option>
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
                                <select name="selectSection" class="form-select border-dark" id="selectSection">
                                    <option value="">Select Section</option>
                                    <!-- section options output -->
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label class="form-label fw-bold">From :</label>
                                <select name="startTime" class="form-select border-dark" id="startTime">
                                    <option value="">Select start time</option>
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
                                <select name="endTime" class="form-select border-dark" id="endTime">
                                    <option value="">Select end time</option>
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
                            <div class="col">
                                <span id="schedFormError" class="text-danger fw-semibold"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" id="close_sched_btn" class="btn btn-secondary">Preview</button> -->
                            <button type="button" class="btn btn-secondary" id="closeModalBtn" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="submitSchedButton" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                    <!-- Preview Table -->
                    <div class="row">
                        <div class="col">
                            <hr>
                            <ul class="list-group d-none" id="previewTable">
                                <h6 class="fw-semibold fst-italic">Preview</h6>
                            </ul>
                        </div>
                    </div>
                    <!-- Schedule per section Table -->
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
    <!-- View Modal -->
    <div class="modal modal-xl fade" id="viewSchedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="viewSchedOutput">

                    </div>
                    <!-- VIEMODAL OUTPUT -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Schedule Modal -->
    <div class="modal fade" id="deleteSchedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-5">
                <div class="modal-body">
                    <input type="hidden" name="hiddenDelTeacherId" id="hiddenDelTeacherId">
                    <input type="hidden" name="hiddenDelSchoolYear" id="hiddenDelSchoolYear">

                    <h5><i class="fa-solid fa-triangle-exclamation me-2"></i> Are you sure you want to Delete this schedule?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm" id="confirmDelSched">Delete</button>
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
                    <!-- PASTE CONTENT BELOW HERE -->

                    <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="alert alert-warning pendinglist border-3 border-warning" role="alert">
                                <h4 class="alert-heading fw-bold">SCHEDULE</h4>
                                <hr class="my-2 p-0">
                                <p class="m-0">Use this module to manage the <span class="fw-bold">Schedule</span> of the teachers for school year <span class="fw-bold" id="sySession"><?php echo $_SESSION['activeSchoolYear']; ?></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-2 border-dark-subtle shadow-sm">
                        <div class="card-header fw-bold">
                            Teacher's Shedule
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover border border-secondary" id="teacherDatatable">
                                            <thead class="table-info">
                                                <tr class="tableRowHeader">
                                                    <th class="teacherIdHeader text-center" scope="col">Teacher ID</th>
                                                    <th class="fnameHeader text-center" scope="col">First Name</th>
                                                    <th class="lnameHeader text-center" scope="col">Last Name</th>
                                                    <th class="actionHeader text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="teacherTableBody">
                                                <!-- TEACHER SCHED OUTPUT HERE -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PASTE CONENT HERE ABOVE HERE -->
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
    <!-- data table -->
    <script src="DataTable/js/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.js"></script>
    <!-- External JS -->
    <script src="sched/js/sched.js"></script>
    <script src="sched/js/viewSched.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>