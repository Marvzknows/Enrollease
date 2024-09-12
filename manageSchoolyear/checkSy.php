<?php

    require '../database/dbcon.php';

    header('Content-Type: application/json');
    // PAG NAG ERROR LAGAY MO HEADER JSON FORMAT
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $startYear = $_POST['selectedStartYear'];
        $endYear = $_POST['selectedEndYear'];

        $schoolYear = $startYear.'-'.$endYear;

        $validationSql = "SELECT school_year FROM school_year WHERE school_year='$schoolYear'";
        $validatationQuery = mysqli_query($connection,$validationSql);

        if($validatationQuery){
            if(mysqli_num_rows($validatationQuery) > 0){

                $output = [
                    'status' => 'success',
                    'message' => 'School Year Already Exist.'
                ];
            }else{
                $output = [
                    'status' => 'none',
                    'message' => 'School year Available'
                ];
            }
        }else{
            $output = [
                'status' => 'error',
                'message' => 'SQL ERROR VALIDATION'
            ];
        }

        // JSON response
        echo json_encode($output);
    }else{
        echo 'Request Method do not match';
    }
?>