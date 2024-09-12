<?php

    session_start();
    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $enrollmentStatus = $_POST['status'];
        $activeSchoolYear = $_POST['activeSy'];

        // ENROLLMENT and ACTIVE SCHOOL YEAR LOGIC
        $sql = "UPDATE enrollment_status SET active_schoolyear='$activeSchoolYear', status='$enrollmentStatus'";
        $query = mysqli_query($connection, $sql);

        if ($query) {

            $_SESSION['enrollmentStatus'] = $enrollmentStatus;
            
            $output = [
                'status' => 'success',
                'message' => 'Enrollment is now '.$enrollmentStatus
            ];
    
            echo json_encode($output);
            exit();

        }else{
            $output = [
                'status' => 'error',
                'message' => 'Query Failed'
            ];
    
            echo json_encode($output);
            exit();
        }



    }else{
        echo 'Request Method do not match';
    }
?>