<?php

// ADMIN DASHBOARD
session_start();
// database
require 'database/dbcon.php';
require 'functions.php';
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
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                        <!--  -->
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
                        <!-- <div class="sb-sidenav-menu-heading">Manage Accounts</div>
                        <a class="nav-link" href="accounts.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-address-card"></i></div>
                            Accounts
                        </a>
                        <a class="nav-link" href="activityLog/logs.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-address-card"></i></div>
                            Activity Log
                        </a> -->
                    </div>
                </div>
            </nav>
        </div>

        <!-- ############# CONTENT -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <!-- PASTE CONTENT UNDER THIS COMMENT -->
                    <!-- <div class="container-fluid">
                        <div class="alert alert-secondary my-2 shadow-sm fw-bold" role="alert">
                            Home / Dashboard
                        </div>
                    </div> -->

                    <div class="container-fluid my-3">
                        <div class="row">
                            <div class="col-lg-4 cold-md-12 col-sm-12 mb-3 mb-sm-0">
                                <div class="card shadow-sm">
                                    <div class="shadow card-body bg-info bg-opacity-10 border border-2 border-info">
                                        <h4 class="card-title fw-bold"> <i class="fa-solid fa-person-chalkboard me-2"></i>
                                            TEACHERS <span class="badge bg-info  border border-2 border-info fs-5 "><?php numOfTeachers(); ?></span>
                                        </h4>
                                        <p class="card-text fw-medium">Number of users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 cold-md-12 col-sm-12 mb-3 mb-sm-0">
                                <div class="card shadow-sm">
                                    <div class="shadow card-body bg-danger bg-opacity-10 border border-2 border-danger">
                                        <h4 class="card-title fw-bold"> <i class="fa-solid fa-clipboard-list me-2"></i>
                                            SECTION <span class="badge bg-danger  border border-2 border-danger fs-5 "><?php numOfSection($current_schoolyear); ?></span>
                                        </h4>
                                        <p class="card-text fw-medium">Number of sections</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 cold-md-12 col-sm-12 mb-3 mb-sm-0">
                                <div class="card shadow-sm">
                                    <div class="shadow card-body bg-success bg-opacity-10 border border-2 border-success">
                                        <h4 class="card-title fw-bold"> <i class="fa-solid fa-people-group me-2"></i>
                                            Students <span class="badge bg-success  border border-2 border-success fs-5 "><?php numOfStudents($current_schoolyear); ?></span>
                                        </h4>
                                        <p class="card-text fw-medium">Total Number of Students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid main-container">
                        <div class="row mt-4">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                                <div class="input-group">
                                    <!-- Select School Year -->
                                    <div class="input-group-text fw-bold border-2 bg-success bg-opacity-25 border-success">Active School Year</div>
                                    <input type="text" class="form-control border-2 fw-semibold bg-secondary bg-opacity-10 border-success" id="activeSchoolYear" readonly>
                                    <!-- Select Enrollment Status -->
                                    <div class="input-group-text fw-bold border-2 bg-success bg-opacity-25 border-success">Enrollment Status</div>
                                    <select class="form-select border-2 fw-semibold bg-secondary bg-opacity-10 border-success" id="enrollmentStatus">
                                        <option value="Open">Open</option>
                                        <option value="Close">Close</option>
                                    </select>
                                    <button type="button" class="btn bg-success bg-opacity-25 btn-sm border-success border-2" id="submitEnrollmentStaus"><i class="fa-regular fa-circle-check"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <!-- SCHOOL YEAR CHART -->
                            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                                <div class="card shadow-sm border border-2">
                                    <div class="card-header fw-bold mb-2">
                                        Number of Enrolled Student
                                    </div>
                                    <div class="card-body chart-container">
                                        <canvas id="myChart">
                                            <!-- barchart output -->
                                        </canvas>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <!-- schoolyear text output -->
                                        <div class="row" id="schoolYearText">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SECTION CHART -->
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="card shadow-sm border border-2">
                                    <div class="card-header fw-bold">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12 mb-1">
                                                <h6 class="fw-bold">
                                                    Total students in each grade level.
                                                </h6>
                                            </div>
                                            <div class="col-lg-3 col-sm-12 mb-1">
                                                <select id="schoolYear" class="chart_Selector form-select form-select-sm">
                                                    <?php
                                                    $chartSql = "SELECT school_year FROM school_year ORDER BY id DESC";
                                                    $chartQuery = mysqli_query($connection, $chartSql);
                                                    if (mysqli_num_rows($chartQuery) > 0) {
                                                        while ($chartData = mysqli_fetch_assoc($chartQuery)) {
                                                    ?>
                                                            <option value="<?php echo $chartData['school_year']; ?>"><?php echo $chartData['school_year']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value=""> - no data found - </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-sm-12">
                                                <select class="chart_Selector form-select form-select-sm" id="grade_Level" aria-label=".form-select-sm example">
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body chart-container">
                                        <canvas id="mySectionChart">
                                            <!-- section chart here -->
                                        </canvas>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <!-- section text output -->
                                        <div class="row" id="sectionText">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Gender chart -->
                        <div class="row my-3">
                            <div class="col">
                                <div class="card shadow-sm border border-2">
                                    <div class="card-header fw-bold">
                                        <div class="row">
                                            <div class="col-lg-8 col-sm-12 mb-1">
                                                <h6 class="fw-bold">
                                                    Numbers of Boys and Girls in each Level and Section
                                                </h6>
                                            </div>
                                            <div class="col-lg-2 col-sm-12 mb-1">
                                                <select id="gender_schoolyear" class="genderChartSelector form-select form-select-sm">
                                                    <?php
                                                    $gender_chartSql = "SELECT school_year FROM school_year ORDER BY id DESC";
                                                    $gender_chartQuery = mysqli_query($connection, $gender_chartSql);
                                                    if (mysqli_num_rows($gender_chartQuery) > 0) {
                                                        while ($genderData = mysqli_fetch_assoc($gender_chartQuery)) {
                                                    ?>
                                                            <option value="<?php echo $genderData['school_year']; ?>"><?php echo $genderData['school_year']; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value=""> - no data found - </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <select class="genderChartSelector form-select form-select-sm" id="gender_gradelevel" aria-label=".form-select-sm example">
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body chart-container">
                                        <canvas id="genderChart">
                                            <!-- section chart here -->
                                        </canvas>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <!-- section text output -->
                                        <div class="row" id="genderText">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PASTE CONTENT HERE ABOVE THIS COMMENT-->
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
    <!-- Chart JS -->
    <script src="chartjs/chart.js"></script>
    <!-- Enrollment Status JS -->
    <script src="dashboard/enrollmentStatus.js"></script>
    <!-- External JS -->
    <script src="dashboard/js/charts.js"></script>
    <script src="js/scripts.js"></script>




    <!-- CHART JS -->
    <!-- chartjs code -->
    <script>
        <?php
        // Modify the SQL query to include grade_nine and grade_ten
        $sql = "SELECT school_year, COUNT(*) AS row_count
            FROM (
                SELECT school_year FROM grade_seven
                UNION ALL
                SELECT school_year FROM grade_eight
                UNION ALL
                SELECT school_year FROM grade_nine
                UNION ALL
                SELECT school_year FROM grade_ten
            ) AS combined_tables
            GROUP BY school_year";

        $query = mysqli_query($connection, $sql);

        if ($query) {
            $counts = []; // Array to store the counts

            while ($row = mysqli_fetch_assoc($query)) {
                $school_year = $row['school_year'];
                $row_count = $row['row_count'];

                $counts[$school_year] = $row_count;
            }
        }
        ?>

        // Card Footer
        const counts = <?php echo json_encode($counts); ?>;
        const chartFooterTextArray = Object.keys(counts).map(function(schoolYear) {
            return 'S.Y '+schoolYear + ' : ' + counts[schoolYear];
        });

        // Append each school year count to the designated element
        for (var i = 0; i < chartFooterTextArray.length; i++) {
            $('#schoolYearText').append('<div class="col fw-semibold">' + chartFooterTextArray[i] + '</div>');
        }

        // Schoolyear Chart
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_keys($counts)); ?>,
                datasets: [{
                    label: 'Number of Enrolled Students',
                    data: <?php echo json_encode(array_values($counts)); ?>,
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(153, 102, 255)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <!-- GENDER -->
    <!-- <script>
        
    </script> -->


</body>

</html>