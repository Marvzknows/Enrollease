<?php
    // SA PREVIOUSE DATA NUNG RETURNEE, DAPAT UPDATE NA SA 'Returning' ang student type, OR YUNG Enrrollment status nlang iupdate (ENROLLMNT STATUS NALNAG)
    // UPDATE Enrollmnt status ni returnee from pending to "balikAral"
    require '../database/dbcon.php';
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $schoolyear =  $_POST['schoolyear'];
        $lrn =  $_POST['lrn'];
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
        $lastGradeLevel =  $_POST['lastGradeLevel'];
        $lastSchoolYear =  $_POST['lastSchoolYear'];
        $lastSchool =  $_POST['lastSchool'];
        $dateEnrolled = date('Y-m-d');

        if($gradeLevel == '7'){
            $databaseTable = 'grade_seven';
        }elseif($gradeLevel == '8'){
            $databaseTable = 'grade_eight';
        }elseif($gradeLevel == '9'){
            $databaseTable = 'grade_nine';
        }elseif($gradeLevel == '10'){
            $databaseTable = 'grade_ten';
        }
        // update 
        if($lastGradeLevel == '7'){
            $updateTable = 'grade_seven';
        }elseif($lastGradeLevel == '8'){
            $updateTable = 'grade_eight';
        }elseif($lastGradeLevel == '9'){
            $updateTable = 'grade_nine';
        }elseif($lastGradeLevel == '10'){
            $updateTable = 'grade_ten';
        }

        if(isset($databaseTable) && !empty($databaseTable) && $studentType == 'Returning') {

            $enrollSql = "INSERT INTO $databaseTable (school_year, lrn, grade_level, section, student_type, stud_fname, stud_mname,
            stud_lname, birth_date, age,  place_of_birth, mother_tongue, gender, region, province, city, barangay,
            mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number,
            guardian_fname, guardian_mname, guardian_lname, guardian_number, date_enrolled, last_grade_level, last_School_year, last_school) 
            VALUES ('$schoolyear', '$lrn', '$gradeLevel', '$section', '$studentType', '$studentFname', '$studentMname', '$studentlname',
            '$birthDate', '$age', '$placeOfBirth', '$motherTounge', '$gender', '$region', '$province', '$city', '$barangay',
            '$motherFname', '$motherMname', '$motherLname', '$motherNumber', '$fatherFname', '$fatherMname', '$fatherLname', '$fatherNumber',
            '$guardianFname', '$guardianMname', '$guardianLname', '$guardianNumber', '$dateEnrolled', '$lastGradeLevel', '$lastSchoolYear', '$lastSchool')";

            $enrollQuery = mysqli_query($connection, $enrollSql);

            if ($enrollQuery) {
                // Update Previous data ni returnee na hindi na sya returnee (Enrollment Stataus from 'pending' - 'balikAral')
                // pagbasihan ng uupdate yung last grade lvl at last school year
                // PAG NAG ERROR PREN OR MAY IAPAPREVISE, ID nalng pang update, lagay nlng hidden id sa enrollmnt form

                $updateStudentSql = "UPDATE $updateTable SET `enrollment_status` = 'balikaral' WHERE lrn = '$lrn' AND `grade_level` = '$lastGradeLevel' AND `school_year` ='$lastSchoolYear'";
                $updateStudentQuery = mysqli_query($connection,$updateStudentSql);

                if($updateStudentQuery) {

                    $output = [
                        'status' => 'success',
                        'message' => 'Enrolled'
                    ];
    
                    echo json_encode($output);

                }else {
                    $output = [
                        'status' => 'failed',
                        'message' => 'updateStudenQuery Failed'
                    ];
    
                    echo json_encode($output);
                }
                
            } else {
                $output = [
                    'status' => 'failed',
                    'message' => 'Enroll Query Failed'
                ];

                echo json_encode($output);
            }

        }else {
            $output = [
                'status' => 'error',
                'message' => 'databaseTable or student type do not match'
            ];

            echo json_encode($output);
        }
    }

?>