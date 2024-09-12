<?php

    // session_start();
    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $teacherId = $_POST['teacherId'];
        $schoolYear = $_POST['schoolYear'];
        $day = $_POST['day'];
        $subject = $_POST['subject'];
        $section = $_POST['section'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];

        // CHECK Schedule of other teachers
        $otherSchedSql = "SELECT * FROM teacher_schedule WHERE day='$day' AND subject='$subject' AND section='$section' AND school_year='$schoolYear'";
        $otherSchedQuery = mysqli_query($connection,$otherSchedSql);

        if(mysqli_num_rows($otherSchedQuery) > 0) {
            // pag may ka same sched sa ibang teacher display error
            $data = [
                'status' => 'error',
                'message' => 'Schedule already taken for the that section'
            ];

            echo json_encode($data);
            exit();
        }else {

            // SUBJECT WITH THE SAME DAY,SECTION,SUBJECT INPUTVALIDATION
            $subjectSectionSql = "SELECT * FROM teacher_schedule 
            WHERE teacher_id = '$teacherId'
            AND school_year = '$schoolYear'
            AND subject = '$subject'
            AND section = '$section'
            AND day = '$day'";

            $subjectSectionQuery = mysqli_query($connection, $subjectSectionSql);

            if (mysqli_num_rows($subjectSectionQuery) > 0) {
                $data = [
                    'status' => 'error',
                    'message' => 'Subject with the same section already taken.'
                ];

                echo json_encode($data);
                exit();
            } else {
                // CHECK TIME OVERLAP
                // WHERE teacherid='$teacherId' (dating where clause bago yang section = $section)
                $timeOverlapSql = "SELECT * FROM teacher_schedule 
                WHERE section = '$section'
                AND school_year = '$schoolYear'
                AND day = '$day'
                AND (
                    ('$startTime' >= start_time AND '$startTime' < end_time) OR
                    ('$endTime' > start_time AND '$endTime' <= end_time) OR
                    ('$startTime' < start_time AND '$endTime' >= end_time)
                )";

                $timeOverlapQuery = mysqli_query($connection, $timeOverlapSql);

                if (mysqli_num_rows($timeOverlapQuery) > 0) {
                    $data = [
                        'status' => 'error',
                        'message' => 'Time overlap with existing schedule.'
                    ];

                    echo json_encode($data);
                    exit();
                } else {
                    //INSERT SCHEDULE QUERY
                    $insertSchedSql = "INSERT INTO teacher_schedule (school_year, teacher_id, day, subject, section, start_time, end_time)
                    VALUES ('$schoolYear', '$teacherId', '$day', '$subject', '$section', '$startTime', '$endTime')";
                    $insertSchedQuery = mysqli_query($connection, $insertSchedSql);

                    if ($insertSchedQuery) {
                        $data = [
                            'status' => 'success',
                            'message' => 'New Scheduel Added.'
                        ];

                        echo json_encode($data);
                        exit();
                    } else {
                        $data = [
                            'status' => 'failed',
                            'message' => 'Insert Sched Query Failed.'
                        ];

                        echo json_encode($data);
                        exit();
                    }
                }
            }

        }








    }else{
        echo 'Request Method do not match';
    }

?>

