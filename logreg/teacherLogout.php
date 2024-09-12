<?php

session_start();

require '../database/dbcon.php';
// session_destroy();
// unset( $_SESSION['teacher_logged_in']);
if(isset($_SESSION['teacherId']) && isset($_SESSION['teacherName'])) {
    $teacherId = $_SESSION['teacherId'];
    $teacherName = $_SESSION['teacherName'];

    $description = "Logged Out";
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');
    $time = date('h:i A');

    $insertLogSql = "INSERT INTO activity_log (teacher_id, description, date_log, time)
    VALUES ('$teacherId', '$description', '$currentDate', '$time')";
    
    $insertLogsQuery = mysqli_query($connection,$insertLogSql);

    if($insertLogsQuery) {
        session_destroy();
        header('location: ../teacherLogin.php');
    }else {
        echo "Error: " . mysqli_error($connection);
    }
}


?>