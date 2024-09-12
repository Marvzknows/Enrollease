<?php

    require '../database/dbcon.php';
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {

        // Student ID
        $studentId = $_POST['studentId'];
        // Hidden Data
        $hiddenSchoolYear = $_POST['hiddenSchoolYear'];
        $hiddenGradeLevel = $_POST['hiddenGradeLevel'];
        $hiddenSection = $_POST['hiddenSection'];

        $schoolyear =  $_POST['schoolyear']; // Di na isasama sa update
        $lrn =  $_POST['lrn']; // Di na isasama sa update
        $gradeLevel =  $_POST['gradeLevel'];
        $section =  $_POST['section'];
        $studentType =  $_POST['studentType'];
        $studentFname =  $_POST['studentFname'];
        $studentMname =  $_POST['studentMname'];
        $studentlname =  $_POST['studentlname'];
        $birthDate =  $_POST['birthDate'];
        $age = $_POST['age'];
        $placeOfBirth =  $_POST['placeOfBirth'];
        $motherTounge =  $_POST['motherTounge'];
        $gender =  $_POST['gender'];
        $region =  $_POST['region'];
        $province =  $_POST['province'];
        $city =  $_POST['city'];
        $barangay =  $_POST['barangay'];
        $motherFname =  $_POST['motherFname'];
        $motherMname =  $_POST['motherMname'];
        $motherLname =  $_POST['motherLname'];
        $motherNumber =  $_POST['motherNumber'];
        $fatherFname =  $_POST['fatherFname'];
        $fatherMname =  $_POST['fatherMname'];
        $fatherLname =  $_POST['fatherLname'];
        $fatherNumber =  $_POST['fatherNumber'];
        $guardianFname =  $_POST['guardianFname'];
        $guardianMname =  $_POST['guardianMname'];
        $guardianLname =  $_POST['guardianLname'];
        $guardianNumber =  $_POST['guardianNumber'];
        // For Transferee/Returning students
        $lastGradeLevel =  $_POST['lastGradeLevel'];
        $lastSchoolYear =  $_POST['lastSchoolYear'];
        $lastSchool =  $_POST['lastSchool'];
        $dateEnrolled = date('Y-m-d'); // Di na isasama sa update

        // old gradelvl
        if($hiddenGradeLevel == '7'){
            $databaseTable = 'grade_seven';
        }elseif($hiddenGradeLevel == '8'){
            $databaseTable = 'grade_eight';
        }elseif($hiddenGradeLevel == '9'){
            $databaseTable = 'grade_nine';
        }elseif($hiddenGradeLevel == '10'){
            $databaseTable = 'grade_ten';
        }

        // Updating Grade level
        if($gradeLevel == '7'){
            $moveToDatabaseTable = 'grade_seven';
        }elseif($gradeLevel == '8'){
            $moveToDatabaseTable = 'grade_eight';
        }elseif($gradeLevel == '9'){
            $moveToDatabaseTable = 'grade_nine';
        }elseif($gradeLevel == '10'){
            $moveToDatabaseTable = 'grade_ten';
        }

        if(isset($databaseTable) && !empty($databaseTable) && $studentType == 'Regular') {

            //  Dagdag ka ng Remove from DataBase base sa $studentId, para d mwala na sa table ng grade level na yon yung inupdate (specifically pag nag update ng grade level)
            // Then pag nag Upate na, select all mo data nung inupdate para iinsert don sa new table kung san gradelevel nilagay
            // LOGIC: (same ng ginawa mo sa pag move ng students)
            // Bale UPDATE muna tapos SELECT all data basi sa studentId nung inedit na data para INSERT sa new table tapos DELETE data base sa hidden studentId,gradelvl,sectionName
            
            $regularStudSql = "UPDATE $databaseTable SET `grade_level` = '$gradeLevel', `section` = '$section', `student_type` = '$studentType'
            , `stud_fname` = '$studentFname', `stud_mname` = '$studentMname', `stud_lname` = '$studentlname'
            , `birth_date` = '$birthDate', `age` = '$age', `place_of_birth` = '$placeOfBirth', `mother_tongue` = '$motherTounge', `gender` = '$gender'
            , `region` = '$region', `province` = '$province', `city` = '$city', `barangay` = '$barangay'
            , `mother_fname` = '$motherFname', `mother_mname` = '$motherMname', `mother_lname` = '$motherLname', `mother_number` = '$motherNumber'
            , `father_fname` = '$fatherFname', `father_mname` = '$fatherMname', `father_lname` = '$fatherLname', `father_number` = '$fatherNumber'
            , `guardian_fname` = '$guardianFname', `guardian_mname` = '$guardianMname', `guardian_lname` = '$guardianLname', `guardian_number` = '$guardianNumber' 
            WHERE id='$studentId' AND school_year='$hiddenSchoolYear' AND grade_level='$hiddenGradeLevel' AND section='$hiddenSection'";

            $regularStudQuery = mysqli_query($connection,$regularStudSql);

            if ($regularStudQuery) {

                $getDataSql = "INSERT INTO $moveToDatabaseTable (school_year, lrn, grade_level, section, student_type, stud_fname, stud_mname, stud_lname, enrollment_status, birth_date, age, place_of_birth, mother_tongue, gender, region, province, city, barangay, mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number, guardian_fname, guardian_mname, guardian_lname, guardian_number, date_enrolled, last_grade_level, last_School_year, last_school)
                SELECT `school_year`, lrn, `grade_level`, `section`, `student_type`, stud_fname, stud_mname, stud_lname, `enrollment_status`, birth_date, age, place_of_birth, mother_tongue, gender, region, province, city, barangay, mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number, guardian_fname, guardian_mname, guardian_lname, guardian_number, `date_enrolled`, NULL, NULL, NULL
                FROM $databaseTable
                WHERE id='$studentId'";

                $getDataQuery = mysqli_query($connection, $getDataSql);

                if ($getDataQuery) {
                    // Deleting Old Data to avoid duplication if update and insert query success
                    $regularDeleteSql = "DELETE FROM $databaseTable WHERE id='$studentId'";
                    $regularDeleteQuery = mysqli_query($connection, $regularDeleteSql);

                    if ($regularDeleteQuery) {
                        $output = [
                            'status' => 'success',
                            'message' => 'Update Success'
                        ];
                        echo json_encode($output);
                    } else {
                        $output = [
                            'status' => 'failed',
                            'message' => 'regularDeleteQuery failed'
                        ];
                        echo json_encode($output);
                    }
                } else {
                    $output = [
                        'status' => 'failed',
                        'message' => 'getDataQuery failed'
                    ];
                    echo json_encode($output);
                }
            } else {
                $output = [
                    'status' => 'failed',
                    'message' => 'regularStudQuery failed'
                ];
                echo json_encode($output);
            }
            
        } elseif (isset($databaseTable) && !empty($databaseTable) && ($studentType == 'Transferee' || $studentType == 'Returning')) {

            $irregularStudSql = "UPDATE $databaseTable SET `grade_level` = '$gradeLevel', `section` = '$section', `student_type` = '$studentType'
            , `stud_fname` = '$studentFname', `stud_mname` = '$studentMname', `stud_lname` = '$studentlname'
            , `birth_date` = '$birthDate', `age` = '$age', `place_of_birth` = '$placeOfBirth', `mother_tongue` = '$motherTounge', `gender` = '$gender'
            , `region` = '$region', `province` = '$province', `city` = '$city', `barangay` = '$barangay'
            , `mother_fname` = '$motherFname', `mother_mname` = '$motherMname', `mother_lname` = '$motherLname', `mother_number` = '$motherNumber'
            , `father_fname` = '$fatherFname', `father_mname` = '$fatherMname', `father_lname` = '$fatherLname', `father_number` = '$fatherNumber'
            , `guardian_fname` = '$guardianFname', `guardian_mname` = '$guardianMname', `guardian_lname` = '$guardianLname', `guardian_number` = '$guardianNumber'
            , `last_grade_level` = '$lastGradeLevel', `last_school_year` = '$lastSchoolYear', `last_school` = '$lastSchool' 
            WHERE id='$studentId' AND school_year='$hiddenSchoolYear' AND grade_level='$hiddenGradeLevel' AND section='$hiddenSection'";
        
            $irregularStudQuery = mysqli_query($connection, $irregularStudSql);

            if ($irregularStudQuery) {

                $irregGetDataSql = "INSERT INTO $moveToDatabaseTable (school_year, lrn, grade_level, section, student_type, stud_fname, stud_mname, stud_lname, enrollment_status, birth_date, age, place_of_birth, mother_tongue, gender, region, province, city, barangay, mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number, guardian_fname, guardian_mname, guardian_lname, guardian_number, date_enrolled, last_grade_level, last_School_year, last_school)
                    SELECT `school_year`, lrn, `grade_level`, `section`, `student_type`, stud_fname, stud_mname, stud_lname, `enrollment_status`, birth_date, age, place_of_birth, mother_tongue, gender, region, province, city, barangay, mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number, guardian_fname, guardian_mname, guardian_lname, guardian_number, `date_enrolled`, last_grade_level, last_School_year, last_school
                    FROM $databaseTable
                    WHERE id='$studentId'";

                $irregGetDataQuery = mysqli_query($connection, $irregGetDataSql);

                if ($irregGetDataQuery) {
                    // Deleting Old Data to avoid duplication if update and insert query success
                    $irregularDeleteSql = "DELETE FROM $databaseTable WHERE id='$studentId'";
                    $irregularDeleteQuery = mysqli_query($connection, $irregularDeleteSql);

                    if ($irregularDeleteQuery) {
                        $output = [
                            'status' => 'success',
                            'message' => 'Update Success'
                        ];
                        echo json_encode($output);
                    } else {
                        $output = [
                            'status' => 'failed',
                            'message' => 'irregularDeleteQuery failed'
                        ];
                        echo json_encode($output);
                    }
                } else {
                    $output = [
                        'status' => 'failed',
                        'message' => 'irregGetDataQuery failed'
                    ];
                    echo json_encode($output);
                }
            } else {
                $output = [
                    'status' => 'failed',
                    'message' => 'irregularStudQuery failed'
                ];
                echo json_encode($output);
            }
    }
    }

?>