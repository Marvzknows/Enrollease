<?php
    session_start();
    // prevent page access through URL
    include '../database/dbcon.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

    // if (empty($username) || empty($password)) {
    //     $_SESSION['invalid_login'] = 'Login input fields are empty!';
    //     // header('location: ../adminLogin.php');
    // } else {

    // }

        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM admin_acc WHERE username=? AND password=?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['admin_login'] = true;
            // $_SESSION['enrollmentStatus'] = false; //enrollment is closed
            // header('location: ../dashboard.php');
            echo 'success';
        } else {
            // echo $_SESSION['invalid_login'] = 'Invalid Username or Password';
            $_SESSION['admin_login'] = false;
            // header('location: ../adminLogin.php');
        }
    }
?>
