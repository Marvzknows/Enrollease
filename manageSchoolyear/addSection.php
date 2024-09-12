<?php

    require '../database/dbcon.php';
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $schoolyear = $_POST['schoolyear'];
        $gradeLevel = $_POST['gradeLevel'];
        $sectionName = $_POST['sectionName'];
        
        $checkSectionSql = "SELECT * FROM sections WHERE section='$sectionName'";
        $checkSectionQuery = mysqli_query($connection,$checkSectionSql);

        if($checkSectionQuery)
        {
            if($validateSection = mysqli_num_rows($checkSectionQuery) > 0){
                // Check Section Name availability
                $output = [
                    'status' => 'error',
                    'message' => 'Section Name alreadt Exist'
                ];

                echo json_encode($output);
            }else{
                // Inser New Section
                $insertNewSectionSql = "INSERT INTO sections (school_year, grade_level, section) VALUES ('$schoolyear', '$gradeLevel', '$sectionName')";
                $insertNewSectionQuery = mysqli_query($connection,$insertNewSectionSql);
                if($insertNewSectionQuery)
                {
                    $output = [
                        'status' => 'success',
                        'message' => 'New Section Added'
                    ];
    
                    echo json_encode($output);
                }else{
                    $output = [
                        'status' => 'failed',
                        'message' => 'Query Failed'
                    ];
    
                    echo json_encode($output);
                }
            }
        }else{
            $output = [
                'status' => 'failed',
                'message' => 'Query Failed'
            ];

            echo json_encode($output);
        }


    }
