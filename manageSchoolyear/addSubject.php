<?php

    require '../database/dbcon.php';
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $subject =  $_POST['subject'];
        $schoolyear =  $_POST['schoolyear'];

        $checkSubjSql = "SELECT * FROM subjects WHERE school_year='$schoolyear' AND subject_name='$subject'";
        $checkSubjQuery = mysqli_query($connection,$checkSubjSql);

        if($checkSubjQuery){

            if(mysqli_num_rows($checkSubjQuery) > 0) {
                
                // if subject already exist in database (base sa schoolyear at subj name)
                $output = [
                    'status' => 'error',
                    'message' => 'Suject already Exist'
                ];
    
                echo json_encode($output);
                exit();
            }else{

                $subjSql = "INSERT INTO subjects (school_year ,subject_name) VALUES ('$schoolyear','$subject')";
                $subjQuery = mysqli_query($connection,$subjSql);
        
                if($subjQuery)
                {
                    $output = [
                        'status' => 'success',
                        'message' => 'New Subject Added'
                    ];
        
                    echo json_encode($output);
                }else{
                    $output = [
                        'status' => 'failed',
                        'message' => 'subjQuery Failed'
                    ];
        
                    echo json_encode($output);
                }

            }

        }else{
            $output = [
                'status' => 'failed',
                'message' => 'checkSubjQuery Failed'
            ];

            echo json_encode($output);
        }


    }
?>