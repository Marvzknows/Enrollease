<?php

    session_start();
    include '../database/dbcon.php';

    header('Content-Type: application/json');

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $sql = "SELECT * FROM enrollment_status";
        $query = mysqli_query($connection, $sql);

        if ($query) {
            $data = mysqli_fetch_assoc($query);
            $sy = $data['active_schoolyear'];
            $enrollmentStatus = $data['status'];
            $_SESSION['activeSchoolYear'] = $sy;
            $_SESSION['enrollmentStatus'] = $data['status'];

            $output = [
                'status' => 'success',
                'schoolyear' => $sy,
                'enollstatus' => $enrollmentStatus
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
            
    } else {
        echo 'Error';
    }
?>
