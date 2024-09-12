<?php

    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $subjId = $_POST['subjId'];
        $subject = $_POST['subjectName'];
        $schoolyear = $_POST['schoolyear'];

        $sql = "SELECT * FROM subjects WHERE subject_name='$subject' AND school_year='$schoolyear'";
        $query = mysqli_query($connection,$sql);

        if($query)
        {
            if(mysqli_num_rows($query) > 0)
            {
                // Display Error pag hindi na available ang Section Name
                $output = [
                    'status' => 'error',
                    'message' => 'Subject already exist'
                ];
                // JSON response
                echo json_encode($output);
                exit();
            }else{
                // UPDATE DATA CODE HERE
                $updateSql = "UPDATE `subjects` SET `subject_name` = '$subject'
                WHERE subject_name='$subjId' AND school_year='$schoolyear'";
                
                $updateQuery = mysqli_query($connection,$updateSql);
                // UPDATE SUBJECT OF SCHUDULE HERE -> <-
                if($updateQuery)
                {
                    $output = [
                        'status' => 'success',
                        'message' => 'Subject Successfully Updated'
                    ];
                    echo json_encode($output);
                    exit();
                }else{
                    $output = [
                        'status' => 'failed',
                        'message' => 'update query failed'
                    ];
                    echo json_encode($output);
                    exit();
                }
            }
            
        }else{
            // Query for Check Number of rows Error
            $output = [
                'status' => 'failed',
                'message' => 'Executing Query Failed'
            ];
            echo json_encode($output);
            exit();
        }

    }

?>