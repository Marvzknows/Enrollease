<?php

    require '../database/dbcon.php';
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $teacherId = $_POST['teacherId'];
        $password = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        // LOGS
        $description = "Successfully Changed Password";
        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d');
        $time = date('h:i A');

        $checkPasswordSql = "SELECT * FROM teacher_acc WHERE teacher_id='$teacherId' AND password='$password'";
        $checkPasswordQuery = mysqli_query($connection,$checkPasswordSql);

        if($checkPasswordQuery)
        {
            if(mysqli_num_rows($checkPasswordQuery) > 0) // PAG NAG MATCH OLD PASS
            {
                // CHANGE account_status (from new to old) at set the new Password inser data sa ACTIVITY LOG table
                $updateSql = "UPDATE teacher_acc SET account_status='old', password='$newPassword' WHERE teacher_id='$teacherId'";
                $updateQuery = mysqli_query($connection,$updateSql);
                // Activity Log
                $logSql = "INSERT INTO activity_log (teacher_id, description, date_log, time)
                VALUES ('$teacherId', '$description', '$currentDate', '$time')";
                $logQuery = mysqli_query($connection, $logSql);


                if($updateQuery && $logQuery){
                    // ALL ACTIONS SUCCESSFULLY EXECUTED
                    $data = [
                        'status' => 'success',
                        'message' => 'Password successfully updated'
                    ];
    
                    echo json_encode($data);
                    exit();
                }else{
                    $data = [
                        'status' => 'error',
                        'message' => 'Update or Log Query Failed'
                    ];
    
                    echo json_encode($data);
                    exit();
                }
            }else{
                //Pag Hindi match old password
                $data = [
                    'status' => 'failed',
                    'message' => 'Old password doesnt match'
                ];

                echo json_encode($data);
                exit();
            }
        }else{
            $data = [
                'status' => 'error',
                'message' => 'Checking Password Query failed'
            ];
    
            echo json_encode($data);
            exit();
        }
    }
?>