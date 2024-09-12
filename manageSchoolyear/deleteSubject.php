<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $subject = $_POST['subjectId'];
        $schoolyear = $_POST['schoolyear'];
        
        $delSubjSql = "DELETE FROM subjects WHERE school_year='$schoolyear' AND subject_name='$subject'";
        $delQuery = mysqli_query($connection,$delSubjSql);

        if($delQuery)
        {
            $output = [
                'status' => 'success',
                'message' => 'Subject Deleted'
            ];

            echo json_encode($output);
        }else{
            $output = [
                'status' => 'error',
                'message' => 'Delete Query failed'
            ];

            echo json_encode($output);
        }

    }
?>
