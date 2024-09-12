<?php

    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $schoolYear = $_POST['schoolYear'];
        $gradeLevel = $_POST['gradeLevel'];
        $section = $_POST['section'];

        if($gradeLevel == '7'){
            $databaseTable = 'grade_seven';
        }elseif($gradeLevel == '8'){
            $databaseTable = 'grade_eight';
        }elseif($gradeLevel == '9'){
            $databaseTable = 'grade_nine';
        }elseif($gradeLevel == '10'){
            $databaseTable = 'grade_ten';
        }

        $capacitySql = "SELECT * FROM $databaseTable WHERE school_year='$schoolYear' AND section='$section'";
        $capacityQuery = mysqli_query($connection,$capacitySql);

        if($capacityQuery) {

            $count = mysqli_num_rows($capacityQuery);

            if($count >= 60) {  //CHANGE TO 60 
                // display count/total no. ng students at message
                $output = [
                    'status' => 'full',
                    'count' => '('.$count.'/60)',
                    'message' => 'Student capacity already on its limit'
                ];
    
                echo json_encode($output);
            }else {
                // Display lang yung count/total number ng students
                $output = [
                    'status' => 'success',
                    'count' => '('.$count.'/60)',
                ];
    
                echo json_encode($output);
            }

        }else {
            $output = [
                'status' => 'error',
                'message' => 'capacityQuery Failed'
            ];

            echo json_encode($output);
            exit();
        }
        

    }else{
        echo 'Request Method do not match.';
    }

?>
