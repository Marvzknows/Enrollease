<?php
session_start();

$_SESSION['teacher_logged_in'] = false;

require 'database/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link href="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_css_bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/loginacc.css" rel="stylesheet">
    <link rel="icon" type="img/jpg" href="img/mainlogo.png">
    <title>AdminLogin</title>
</head>

<body>
    <div class="container">
        <div class="row text-white main-row">
            <div class="col-lg-5 col-md-block p-5 g-0 d-none d-md-block">
                <img src="img/logo.jpg" alt="logo" class="img-fluid ">
            </div>
            <div class="col-lg-7 d-flex justify-content-center flex-column align-items-center pt-4">
                <form>
                    <div class="header text-center">
                        <h1><span class="text-info mx-2">|</span>Teacher Access</h1>
                    </div>
                    <div class="my-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="email" name="username" id="username" class="form-control">
                        <small class="text-danger fw-semibold" id="usernameError"></small>
                    </div>
                    <div class="my-3">
                        <label for="teacherPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="teacherPassword" class="form-control" id="teacherPassword">
                            <span class="input-group-text" id="showPasswordToggle">
                                <i class="fa-regular fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        <small class="text-danger fw-semibold" id="passwordErrorMssg"></small>
                    </div>
                    <!-- login button -->
                    <button type="submit" name="teacherLoginButton" id="teacherLoginButton" class="mt-2 w-100 admin-login-btn">Submit</button>
                    <div class="my-4">
                        <span>Login as </span><a class="text-decoration-none text-info" href="adminLogin.php">Admin</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <!-- jquery file path -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <!-- sweet alert -->
    <script src="sweetAlert/sweet_alert.js"></script>
    <!-- JS CODE REGISTRATION-->
    <!-- <script src="logreg/registration.js"></script> -->
    <!-- JS CODE LOGIN -->
    <script src="logreg/teacherLogin.js"></script>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <!-- ############################################################################# -->
</body>

</html>