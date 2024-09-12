<?php
    // ## NAHINTO ##
    // UPDATE ENROLLMENT STATUS MUNA TAPOS,

    // SELECT ALL STUDENT BASE SA INSERT DATA COMMENT, TAPOS INSERT YUNG SINELECT ALL (mssnger stackoverflow link)

    // PAG NAG INSERT NA OR AMG MOVING TO NEXT GRADE LEVEL, MATIK ANG STUDENT TYPE AY REGULAR NA AGAD, TAPOS ENROLLMEN
    // STATUS AY BALIK SA 'unset'
    
    // SA LAST SCHOOL ATTENDED ETC... SET AS NULL NLNG SINCE REGULAR NA ANG STUDENT TYPE

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Hidden Data/old data - Gamitin to update enrollment status from pendting to enrolled
        $hiddenOldSchoolYearVal = $_POST['hiddenOldSchoolYearVal'];
        $hiddenGradeLevelVal = $_POST['hiddenGradeLevelVal'];
        $hiddenSectionVal = $_POST['hiddenSectionVal'];
        $setEnrolledStatus = 'Enrolled';
        // Insert Data
        $studentId = $_POST['studentId']; // Kasama sa Hidden Data/old data
        $moveSchoolyearVal = $_POST['moveSchoolyearVal'];
        $moveGradelevelVal = $_POST['moveGradelevelVal'];
        $moveSectionVal = $_POST['moveSectionVal'];
        $newStudentType = 'Regular'; 
        date_default_timezone_set("Asia/Manila");
        $currentDate = date("Y-m-d"); // This will give you the date in the format "YYYY-MM-DD" in the Philippines timezone
        $setEnrollmentStatus = 'unset';

        if($hiddenGradeLevelVal == '7'){
            $databaseTable = 'grade_seven';
        }elseif($hiddenGradeLevelVal == '8'){
            $databaseTable = 'grade_eight';
        }elseif($hiddenGradeLevelVal == '9'){
            $databaseTable = 'grade_nine';
        }elseif($hiddenGradeLevelVal == '10'){
            $databaseTable = 'grade_ten';
        }

        if($moveGradelevelVal == '7'){
            $moveToDatabaseTable = 'grade_seven';
        }elseif($moveGradelevelVal == '8'){
            $moveToDatabaseTable = 'grade_eight';
        }elseif($moveGradelevelVal == '9'){
            $moveToDatabaseTable = 'grade_nine';
        }elseif($moveGradelevelVal == '10'){
            $moveToDatabaseTable = 'grade_ten';
        }
        
        if(isset($databaseTable) && isset($studentId) && !empty($databaseTable) && !empty($studentId)) {

            foreach ($studentId as $id) { //Old Data manipulation
                $updateStatusSql = "UPDATE `$databaseTable` SET `enrollment_status` = '$setEnrolledStatus' WHERE id = '$id'";
                $updateStatusQuery = mysqli_query($connection,$updateStatusSql);

                if($updateStatusQuery) {
                    // select query dito for getting the birth date base sa '$id' then compute the age (birhtdate lang kukunin)
                    //  -> DITO <-
                    // 
                    $getDataSql = "INSERT INTO $moveToDatabaseTable (school_year, lrn, grade_level, section, student_type, stud_fname, stud_mname, stud_lname, enrollment_status, birth_date, age, place_of_birth, mother_tongue, gender, region, province, city, barangay, mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number, guardian_fname, guardian_mname, guardian_lname, guardian_number, date_enrolled, last_grade_level, last_School_year, last_school)
                    SELECT '$moveSchoolyearVal', lrn, '$moveGradelevelVal', '$moveSectionVal', '$newStudentType', stud_fname, stud_mname, stud_lname, '$setEnrollmentStatus', birth_date, age, place_of_birth, mother_tongue, gender, region, province, city, barangay, mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number, guardian_fname, guardian_mname, guardian_lname, guardian_number, '$currentDate', NULL, NULL, NULL
                    FROM $databaseTable
                    WHERE id='$id'";
                                                            
                    $getDataQuery = mysqli_query($connection,$getDataSql);

                    if($getDataQuery) {
                        // ADD INSERT TO LOGS PAG DITO PAG SA TEACHER SIDE NA
                        echo 'success';
                    }else {
                        echo 'failed';
                    }

                }else {
                    echo 'Updating Enrollment status failed';
                }
            }

        }else {
            echo 'Data is not isset or its Empty';
        }

    }else{
        echo 'Something went Wrong, Try again later';
    }
?>