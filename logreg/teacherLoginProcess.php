<?php
    session_start();
    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $tch = $_POST['username'];
        $username = 'TCH-'.$tch;
        $password = $_POST['password'];
        // Logs
        $description = "Logged in";
        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d');
        $time = date('h:i A');

        $sql = "SELECT * FROM teacher_acc WHERE teacher_id='$username'  AND password='$password'";
        $query = mysqli_query($connection,$sql);

        if (mysqli_num_rows($query) > 0){

            $logSql = "INSERT INTO activity_log (teacher_id, description, date_log, time)
            VALUES ('$username', '$description', '$currentDate', '$time')";
            $logQuery = mysqli_query($connection, $logSql);
            
            if($logQuery){

                $userData = mysqli_fetch_assoc($query);
                $_SESSION['teacherId'] = $userData['teacher_id'];
                $_SESSION['teacherName'] = $userData['first_name']; // User's First name
                $_SESSION['teacherLastName'] = $userData['last_name']; // User's Last name
                $_SESSION['teacherStatus'] = $userData['teacher_status']; //Enable or Disabled acc
                $_SESSION['accStatus'] = $userData['account_status']; // New acc or Not, (For change password)
                $_SESSION['teacher_logged_in'] = true; // Accessiong through URL security
    
                $data = [
                    'status' => 'success',
                    'message' => 'Logged in'
                ];
        
                echo json_encode($data);
                exit();
            }else{
                $_SESSION['teacher_logged_in'] = false;
            
                $data = [
                    'status' => 'error',
                    'message' => 'Insert Logs Failed'
                ];
        
                echo json_encode($data);
                exit();
            }

        } 
        else{
            
            $_SESSION['teacher_logged_in'] = false;
            
            $data = [
                'status' => 'error',
                'message' => 'User not found'
            ];
    
            echo json_encode($data);
            exit();
        } 

    }else{
        
    }
