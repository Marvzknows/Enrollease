<?php

    // UUPDATE MO LANG CURRENT DATA, WALANG IINSERT
    // update enrollment status from enrolled to 'Finished'
    // Tapos Fetch Student
    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $compHiddenOldSchoolYearVal = $_POST['compHiddenOldSchoolYearVal']; //school_year
        $compHiddenGradeLevelVal = $_POST['compHiddenGradeLevelVal']; //grade_level
        $compHiddenSectionVal = $_POST['compHiddenSectionVal']; //section

        $setStudentType = 'Completer'; // student_type
        $setCompleterStatus = 'Finished'; // enrollment_status
        $dateEnrolled = date('Y-m-d'); // date_enrolled
        $sid = $_POST['sid']; // id

        if($compHiddenGradeLevelVal == '10'){
            $databaseTable = 'grade_ten';
        }else {
            echo 'Selected Data is not yet grade 10';
        }
        
        if(isset($databaseTable) && isset($sid) && !empty($databaseTable) && !empty($sid)) {

            foreach($sid as $studentId) {
                $updateStudentSql = "UPDATE `$databaseTable` SET `student_type` = '$setStudentType', `enrollment_status` = '$setCompleterStatus', `date_enrolled` = '$dateEnrolled' 
                WHERE id = '$studentId'";
                $updateStudentQuery = mysqli_query($connection,$updateStudentSql);

                if($updateStudentQuery) {
                    // ADD INSERT TO LOGS PAG DITO PAG SA TEACHER SIDE NA
                    echo 'success';
                }else {
                    echo 'failed';
                }
            }

        }else {
            echo 'Data is not isset or its Empty';
        }

    }else{
        echo 'Something went Wrong, Try again later';
    }
?>