<?php

    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // $schoolyear = $_POST['schoolyearData'];
        $sectionName = $_POST['sectionName'];
        // $gradeLevel = $_POST['gradeLevel'];

        $sql = "SELECT * FROM sections WHERE section='$sectionName'";
        $query = mysqli_query($connection,$sql);

        if($query)
        {
            if(mysqli_num_rows($query) > 0)
            {
                // Display Error pag hindi na available ang Section Name
                $output = [
                    'status' => 'error',
                    'message' => 'Section Name already exist'
                ];
            }else{
                $output = [
                    'status' => 'success',
                    'message' => 'New Section Added'
                ];
            }
            
        }else{
            // Query for Check Number of rows Error
            $output = [
                'status' => 'error',
                'message' => 'Executing Query Failed'
            ];
        }


        // JSON response
        echo json_encode($output);
    }

?>