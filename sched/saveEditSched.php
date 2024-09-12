<?php
    
    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $scheduleId = $_POST['editId_val'];
        $schoolyear = $_POST['schoolYear_val'];
        $teacherId = $_POST['teacherId_val'];
        $day = $_POST['day_val'];
        $subject = $_POST['subj_val'];
        $section = $_POST['section_val'];
        $startTime = $_POST['startTime_val'];
        $endTime = $_POST['endTime_Val'];

        if($startTime >= $endTime) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Time'
            ];

            echo json_encode($data);
            exit();
        }

        $subjectSectionSql = "SELECT * FROM teacher_schedule 
        WHERE teacher_id = '$teacherId'
        AND school_year = '$schoolyear'
        AND subject = '$subject'
        AND section = '$section'
        AND day = '$day'
        ";

// yung time hindi equal sa current time set
        $subjectSectionQuery = mysqli_query($connection,$subjectSectionSql);

        if(mysqli_num_rows($subjectSectionQuery) > 0) {
            // CHECK SUBJECT WITH THE SAME SECTION
            $data = [
                'status' => 'error',
                'message' => 'Subject with the same section already taken.'
            ];

            echo json_encode($data);
            exit();

        }else {

            $data = [
                'status' => 'success',
                'message' => 'guds'
            ];

            echo json_encode($data);
            exit();
            // CHECK TIME OVERLAP
            // $timeOverlapSql = "SELECT * FROM teacher_schedule 
            // WHERE teacher_id = '$teacherId'
            // AND school_year = '$schoolyear'
            // AND day = '$day'
            // AND (
            //     ('$startTime' >= start_time AND '$startTime' < end_time) OR
            //     ('$endTime' > start_time AND '$endTime' <= end_time) OR
            //     ('$startTime' < start_time AND '$endTime' >= end_time)
            // )";

            // $timeOverlapQuery = mysqli_query($connection, $timeOverlapSql);

            // if(mysqli_num_rows($timeOverlapQuery) > 0)
            // {
            //     $data = [
            //         'status' => 'error',
            //         'message' => 'Time overlap with existing schedule.'
            //     ];
    
            //     echo json_encode($data);
            //     exit();

            // }else {

            //     $data = [
            //         'status' => 'success',
            //         'message' => 'GOODS'
            //     ];
    
            //     echo json_encode($data);
            //     exit();

            // }
        }

    }
