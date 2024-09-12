<?php

    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // HiddenData Value
        $schoolyear = $_POST['schoolYear'];
        $OldGradeLevel = $_POST['OldGradeLevel'];
        $OldSectionName = $_POST['OldSectionName'];
        // Edit Input Fields
        $newGradeLevel = $_POST['gradeLevel'];
        $newSectionName = $_POST['sectionName'];

        $sql = "SELECT * FROM sections WHERE section='$newSectionName' AND school_year='$schoolyear'";
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
                if($OldGradeLevel == '7'){
                    $databaseTable = 'grade_seven';
                }elseif($OldGradeLevel == '8'){
                    $databaseTable = 'grade_eight';
                }elseif($OldGradeLevel == '9'){
                    $databaseTable = 'grade_nine';
                }elseif($OldGradeLevel == '10'){
                    $databaseTable = 'grade_ten';
                }
                // UPDATE DATA CODE HERE
                $updateSql = "UPDATE `sections` SET `grade_level` = '$newGradeLevel', `section` = '$newSectionName' 
                WHERE school_year='$schoolyear' AND grade_level='$OldGradeLevel' AND section='$OldSectionName'";

                // Schedule section name update
                $scheduleSectionSql = "UPDATE `teacher_schedule` SET `section` = '" . $newGradeLevel . " " . $newSectionName . "' 
                WHERE school_year = '" . $schoolyear . "' AND section = '" . $OldGradeLevel . " " . $OldSectionName . "'";

                // Students Section name update
                $studentSectionSql = "UPDATE $databaseTable SET `grade_level` = '$newGradeLevel', `section` = '$newSectionName' 
                WHERE school_year='$schoolyear' AND grade_level='$OldGradeLevel' AND section='$OldSectionName'";

                // Query Executions
                $updateQuery = mysqli_query($connection,$updateSql);
                $updateScheduleQuery = mysqli_query($connection,$scheduleSectionSql);
                $updateStudentQuery = mysqli_query($connection,$studentSectionSql);

                if($updateQuery && $updateScheduleQuery && $updateStudentQuery)
                {
                    $output = [
                        'status' => 'success',
                        'message' => 'Data Successfully Updated'
                    ];
                }else{
                    $output = [
                        'status' => 'error',
                        'message' => 'update query failed'
                    ];
                }
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