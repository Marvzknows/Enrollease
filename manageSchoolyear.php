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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="img/jpg" href="img/mainlogo.png">
    <title>Manage School Year</title>
    <!-- Custome CSS -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="css/manageSy.css"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css">
    <!-- alertify CSS -->
    <link rel="stylesheet" href="alertify/alertifycss.css">
    <link rel="stylesheet" href="alertify/alertifycss2.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="DataTable/css/cdn.datatables.net_v_bs5_dt-1.13.4_datatables.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Add School Year Modal -->
    <div class="modal fade" id="addSchoolYearModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSchoolYearHeader" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable modal-lg">
            <div class="modal-content border border-5">
                <div class="modal-header bg-info p-2 text-dark bg-opacity-10 border border-2 border-info">
                    <h1 class="modal-title fs-5 fw-bold" id="addSchoolYearHeader">Add New School Year</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <div class="row w-75">
                                    <div class="col input-group mb-3">
                                        <span class="input-group-text fw-semibold">Current School Year: </span>
                                        <input type="text" class="form-control" name="hiddenActiveSy" id="hiddenActiveSy" value="<?php echo $_SESSION['activeSchoolYear']; ?>" readonly>
                                    </div>
                                </div>
                                <label class="form-label fw-bold">Add School Year</label>
                                <div class="input-group">
                                    <select class="form-select fw-semibold" name="startYear" id="startYear">
                                        <option value=""> -- Select year -- </option>
                                    </select>
                                    <span class="input-group-text fw-bold px-3"> - </span>
                                    <select class="form-select fw-semibold" name="endYear" id="endYear">
                                        <option value=""> -- Select year -- </option>
                                    </select>
                                </div>
                                <div class="d-block">
                                    <small class="text-danger fw-semibold" id="syError"></small>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-outline-success border border-2 border-success btn-sm fw-bold" id="addSyButton" disabled>
                                <i class="fa-regular fa-calendar-plus mx-1"></i>Add
                            </button>
                        </div>
                    </div>
                    <!-- SECOND INPUT FIELDS -->
                    <div id="secondInputFields" class="container d-none">
                        <hr class="mx-2 border-2">
                        <div class="row">
                            <div class="col">
                                <div class="alert bg-info p-2 text-dark bg-opacity-10 border border-2 border-info" role="alert">
                                    <h5 class="fw-semibold">Add Section for the School year: <span class="schoolYearText fw-bolder text-decoration-underline fw-semibold text-primary" id="schoolyearData"></span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2 d-flex justify-content-center">
                            <label for="selectGradeLevel" class="col-sm-2 d-sm-block col-form-label fw-semibold">Grade Level</label>
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <select class="form-select form-select-sm fw-semibold" name="selectGradeLevel" id="selectGradeLevel">
                                    <option value=""> </option>
                                    <option value="7"> 7 </option>
                                    <option value="8"> 8 </option>
                                    <option value="9"> 9 </option>
                                    <option value="10"> 10 </option>
                                </select>
                                <small class="text-danger fw-semibold" id="gradeLevelError"></small>
                            </div>
                        </div>
                        <div class="row my-2 d-flex justify-content-center">
                            <label for="sectionName" class="col-sm-2 col-form-label fw-semibold">Section</label>
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <input type="text" class="form-control form-control-sm" id="sectionName">
                                <small class="text-danger fw-semibold" id="sectionError"></small>
                                <!-- Add Section Button -->
                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary fw-bold w-100" id="saveSchoolYearBtn" type="button" disabled>Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- THIRD CONTENT  (TABLE) -->
                    <div id="previewTable" class="d-none"> <!-- display none mo -->
                        <hr class="mx-2 border-2">
                        <div class="row">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="fw-semibold nav-link" id="nav-sectionList-tab" data-bs-toggle="tab" data-bs-target="#nav-section" type="button" role="tab" aria-controls="nav-section" aria-selected="true">List of Sections</button>
                                    <button class="fw-semibold nav-link active" id="nav-userPreview-tab" data-bs-toggle="tab" data-bs-target="#nav-userPreview" type="button" role="tab" aria-controls="nav-userPreview" aria-selected="false">Preview</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade" id="nav-section" role="tabpanel" aria-labelledby="nav-sectionList-tab" tabindex="0">
                                    <div class="col">
                                        <table class="table caption-top table-sm table-success border border-3 border-dark table-striped" id="previreModal">
                                            <caption>List of current sections</caption>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-center" scope="col">Grade Level</th>
                                                    <th class="text-center" scope="col">Section Name</th>
                                                </tr>
                                            </thead>
                                            <tbody class="previewTableBody table-group-divider">
                                                <!-- FETCH SECTION AJAX HERE -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-userPreview" role="tabpanel" aria-labelledby="nav-userPreview-tab" tabindex="0">
                                    <div class="col">
                                        <table class="table caption-top table-sm table-success border border-3 border-dark table-striped" id="userPreviewTable">
                                            <caption>Your Preview</caption>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th class="text-center" scope="col">Grade Level</th>
                                                    <th class="text-center" scope="col">Section Name</th>
                                                    <th class="text-center" scope="col">Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody class="userPreviewTbody table-group-divider">
                                                <!-- APPEND HERE -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mx-3 border-2">
                    <div class="text-end d-lg-block d-md-grid d-sm-grid">
                        <!-- SAVE BUTTON HERE -->
                        <!-- UNHIDE PAG NAKAPAG ADD NG NEW SCHOOL YEAR, HIDE PAG NAGBAGO NG SCHOOL YEAR SA ONCHANGE -->
                        <button type="button" class="d-none btn btn-success" id="confirmButton">Confirm New School Year</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSubjectHeader" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-5">
                <div class="modal-header bg-info p-2 text-dark bg-opacity-10 border border-2 border-info">
                    <h1 class="modal-title fs-5 fw-bold" id="addSubjectHeader">Add Subject</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <!-- hidden data -->
                        <input type="hidden" name="hiddeActiveSy" id="hiddeActiveSy">
                        <div class="mb-3">
                            <label for="subjectInput" class="form-label fw-bold">Subject</label>
                            <input type="text" class="form-control border-dark-subtle" id="subjectInput">
                            <small class="text-danger fw-semibold" id="subjError"></small>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm" id="submitSubjBtn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Subject Modal -->
    <div class="modal fade" id="deleteSubjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-5">
                <!-- <div class="modal-header bg-info p-2 text-dark bg-opacity-10 border border-2 border-info">
                    <h1 class="modal-title fs-5" id="delSubjHeader">Modal title</h1>
                </div> -->
                <div class="modal-body">
                    <input type="hidden" name="hiddenSubjName" id="hiddenSubjName">
                    <h5><i class="fa-solid fa-triangle-exclamation me-2"></i> Are you sure you want to Delete this subject?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm" id="confirmDelSubjbtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Section Modal -->
    <div class="modal fade" id="editSectionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSectionHeader" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-5">
                <div class="modal-header bg-info p-2 text-dark bg-opacity-10 border border-2 border-info">
                    <h1 class="modal-title fs-5" id="editSectionHeader">Edit Section</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <!-- Hidden Data -->
                    <input type="hidden" name="hiddenSchoolYear" id="hiddenSchoolYear">
                    <input type="hidden" name="hiddenGradeLevel" id="hiddenGradeLevel">
                    <input type="hidden" name="hiddenSecName" id="hiddenSecName">
                    <!-- Input Fields -->
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="editGradeLevel" class="form-label fw-semibold">Grade Level</label>
                            <input type="number" class="form-control border-dark-subtle w-50" id="editGradeLevel">
                            <small class="text-danger fw-semibold" id="editGradeLevelError"></small>
                        </div>
                        <div class="col-12">
                            <label for="editSectionName" class="form-label fw-semibold">Section</label>
                            <input type="text" class="form-control border-dark-subtle" id="editSectionName">
                            <small class="text-danger fw-semibold" id="editSectioNameError"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancelEditBtn btn btn-secondary btn-sm fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm fw-semibold" id="saveEditBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Subject Modal -->
    <div class="modal fade" id="editSubjModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalHeader" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-5">
                <div class="modal-header bg-info p-2 text-dark bg-opacity-10 border border-2 border-info">
                    <h1 class="modal-title fs-5" id="editModalHeader">Edit Subject</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" name="hiddenEditSubjVal" id="hiddenEditSubjVal">
                        <div class="mb-3">
                            <label for="subjectInput" class="form-label fw-bold">Subject</label>
                            <input type="text" class="form-control border-dark-subtle" id="editSubjVal">
                            <small class="text-danger fw-semibold" id="editSubjError"></small>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm" id="submitEditSubj">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Section Modal -->
    <div class="modal fade" id="addSectionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSectionModalHeader" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-5">
                <div class="modal-header bg-info p-2 text-dark bg-opacity-10 border border-2 border-info">
                    <h1 class="modal-title fs-5" id="addSectionModalHeader">Add Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <?php
                        $addSectionSql = "SELECT active_schoolyear FROM enrollment_status";
                        $addSectionQuery = mysqli_query($connection, $addSectionSql);
                        if ($addSectionQuery) {
                            $addSecSy = mysqli_fetch_assoc($addSectionQuery);
                        ?>
                            <input type="hidden" name="hiddenAddSectionSchoolYear" id="hiddenAddSectionSchoolYear" value="<?php echo $addSecSy['active_schoolyear']; ?>">
                        <?php
                        }
                        ?>
                        <div class="row my-2 d-flex justify-content-center">
                            <label for="addGradeLevel" class="col-sm-2 d-sm-block col-form-label fw-semibold">Grade Level</label>
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <select class="form-select form-select-sm fw-semibold" name="addGradeLevel" id="addGradeLevel">
                                    <option value=""> - select grade level - </option>
                                    <option value="7"> 7 </option>
                                    <option value="8"> 8 </option>
                                    <option value="9"> 9 </option>
                                    <option value="10"> 10 </option>
                                </select>
                                <small class="text-danger fw-semibold" id="addGradeLevelError"></small>
                            </div>
                        </div>
                        <div class="row my-2 d-flex justify-content-center">
                            <label for="addSectionName" class="col-sm-2 col-form-label fw-semibold">Section</label>
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <input type="text" class="form-control form-control-sm" id="addSectionName">
                                <small class="text-danger fw-semibold" id="addSectionNameError"></small>
                                <!-- Add Section Button -->
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary fw-bold w-100" id="saveAddSectionBtn" type="button">Add</button>
                                </div>
                            </div>
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
                <div class="container-fluid">
                    <!-- PASTE CONTENT UNDER THIS COMMENT -->
                    <!-- ACTIVE SCHOOL YEAR REFERENCE -->
                    <input type="hidden" name="currentActiveSchoolYear" id="currentActiveSchoolYear" value="<?php echo $addSecSy['active_schoolyear']; ?>">

                    <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="alert alert-warning pendinglist border-3 border-warning" role="alert">
                                <h4 class="alert-heading fw-bold">Manage School Year</h4>
                                <hr class="my-2 p-0">
                                <p class="m-0">Use this module to manage the <span class="fw-bold">School Year</span> and <span class="fw-bold">Sections</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid mt-3">
                        <!-- table row start -->
                        <div class="row gap-3">
                            <div class="col-lg-7 col-md-12 col-sm-12 rounded p-4  border border-2 shadow">
                                <!-- dropdown filter by year -->
                                <div class="d-sm-flex justify-content-between mb-1 pb-2">
                                    <div class="schoolYearContainer">
                                        <label class="form-label">
                                            <h5 class="fw-bold">Filter By : </h5>
                                        </label>
                                        <select name="select_school_year" class="mx-2 border-dark px-3 py-1 " id="filterBar">
                                            <?php
                                            $selectFilterSy = "SELECT * FROM school_year ORDER BY id DESC";
                                            $selectFilterQuery = mysqli_query($connection, $selectFilterSy);
                                            if ($selectFilterQuery) {
                                                while ($options = mysqli_fetch_assoc($selectFilterQuery)) {
                                            ?>
                                                    <option value="<?php echo $options['school_year'] ?>"><?php echo $options['school_year'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- add section & school year buttons -->
                                    <div class="buttonContainer">
                                        <button type="button" class="btn btn-success btn-sm fw-semibold" id="addSectionBtn" <?php echo ($_SESSION['enrollmentStatus'] == 'Open') ? 'disabled' : ''; ?>><i class="fa-solid fa-plus me-1"></i>Add Section</button>
                                        <button type="button" class="btn btn-success btn-sm fw-semibold" id="addSubjBtn" <?php echo ($_SESSION['enrollmentStatus'] == 'Open') ? 'disabled' : ''; ?>><i class="fa-solid fa-plus me-1"></i>Add Subject</button>
                                        <button class="fw-semibold btn btn-sm btn-success addyr_btn" id="addSchoolyearButton" <?php echo ($_SESSION['enrollmentStatus'] == 'Open') ? 'disabled' : ''; ?>><i class="fa-regular fa-calendar-plus me-2"></i>Add School Year</button>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <hr class="border-1 mx-2">
                                </div>
                                <!-- table start -->
                                <table class="table table-striped table-hover table-sm border border-dark border-3" id="SectionTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center" scope="col">Grade Level</th>
                                            <th class="text-center" scope="col">Section</th>
                                            <th class="text-center m-0 p-0" scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="SectionOutputData">
                                        <!-- Sections Output -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="col rounded p-2 border border-2 shadow">
                                <div class="schoolYearContainer">
                                    <label class="form-label">
                                        <h5 class="fw-bold">Filter By : </h5>
                                    </label>
                                    <select name="subjectSchoolYear" class="mx-2 border-dark px-3 py-1 " id="subjectSchoolYear">
                                        <?php
                                        $selectFilterSy = "SELECT * FROM school_year ORDER BY id DESC";
                                        $selectFilterQuery = mysqli_query($connection, $selectFilterSy);
                                        if ($selectFilterQuery) {
                                            while ($options = mysqli_fetch_assoc($selectFilterQuery)) {
                                        ?>
                                                <option value="<?php echo $options['school_year'] ?>"><?php echo $options['school_year'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="table-container">
                                    <table class="table table-striped table-hover border border-2 border-dark caption-top">
                                        <thead class="table-dark sticky-top">
                                            <tr>
                                                <!-- <th class="text-center" scope="col">Grade Level</th> -->
                                                <th class="text-center" scope="col">Subjects</th>
                                                <th class="text-center" scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="subjectOutput">
                                            <!-- SUBJECTS -->
                                            <!-- <tr>
                                                <td>7</td>
                                                <td class="text0-">Technology and Livelihood Education</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="editSubjBtn btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        <button class="delSubjbtn btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                                    </div>
                                                </td>
                                            </tr> -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- PASTE CONENT HERE ABOVE THIS COMMENT-->
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
    <!-- alertify -->
    <script src="alertify/alertify.js"></script>
    <!-- sweetAlert -->
    <script src="sweetAlert/sweet_alert.js"></script>
    <!-- External JS -->
    <script src="manageSchoolyear/js/manageSy.js"></script>
    <script src="manageSchoolyear/js/displayData.js"></script>
    <script src="manageSchoolyear/js/subject.js"></script>
    <!-- External JS FOR TOGGLE-->
    <script src="js/scripts.js"></script>
</body>

</html>