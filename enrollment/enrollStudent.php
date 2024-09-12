<?php

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

        //Pag regular, Hindi mo na sasama last schoolyear at attended
    if (isset($databaseTable) && !empty($databaseTable) && $studentType == 'Regular') {
        // Check Section Capacity
        $capacitySql = "SELECT * FROM $databaseTable WHERE school_year='$schoolyear' AND section='$section'";
        $capacityQuery = mysqli_query($connection,$capacitySql);
        if($secLimit = mysqli_num_rows($capacityQuery) >= 65) // CHANGE TO 60 SOON
        {
            $output = [
                'status' => 'error',
                'message' => 'section capacity already full, please select other section'
            ];

            echo json_encode($output);
        }else{
            // Check LRN availability
            $checkLrnSql = "
                SELECT 'grade_seven' as source_table, lrn FROM grade_seven WHERE lrn = '$lrn'
                UNION ALL
                SELECT 'grade_eight', lrn FROM grade_eight WHERE lrn = '$lrn'
                UNION ALL
                SELECT 'grade_nine', lrn FROM grade_nine WHERE lrn = '$lrn'
                UNION ALL
                SELECT 'grade_ten', lrn FROM grade_ten WHERE lrn = '$lrn'
            ";

            $checkLrnQuery = mysqli_query($connection,$checkLrnSql);
            if($lrnCount = mysqli_num_rows($checkLrnQuery) > 0)
            {
                $output = [
                    'status' => 'error',
                    'message' => 'LRN already Exist in school database'
                ];
    
                echo json_encode($output);
            }else{
            // Inserting Student
                $enrollSql = "INSERT INTO $databaseTable (school_year, lrn, grade_level, section, student_type, stud_fname, stud_mname,
                stud_lname, birth_date, age,  place_of_birth, mother_tongue, gender, region, province, city, barangay,
                mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number,
                guardian_fname, guardian_mname, guardian_lname, guardian_number, date_enrolled) 
                VALUES ('$schoolyear', '$lrn', '$gradeLevel', '$section', '$studentType', '$studentFname', '$studentMname', '$studentlname',
                '$birthDate', '$age', '$placeOfBirth', '$motherTounge', '$gender', '$region', '$province', '$city', '$barangay',
                '$motherFname', '$motherMname', '$motherLname', '$motherNumber', '$fatherFname', '$fatherMname', '$fatherLname', '$fatherNumber',
                '$guardianFname', '$guardianMname', '$guardianLname', '$guardianNumber','$dateEnrolled')";
    
                $enrollQuery = mysqli_query($connection, $enrollSql);
    
                if ($enrollQuery) {
                    $output = [
                        'status' => 'success',
                        'message' => 'Enrolled'
                    ];
    
                    echo json_encode($output);
                } else {
                    $output = [
                        'status' => 'failed',
                        'message' => 'Enroll Query Failed'
                    ];
    
                    echo json_encode($output);
                }
            }

        }
    // Regular Statement End
    } else if(isset($databaseTable) && !empty($databaseTable) && $studentType == 'Transferee' || $studentType == 'Returning') {
        
        $irregCapacitySql = "SELECT * FROM $databaseTable WHERE school_year='$schoolyear' AND section='$section'";
        $irregCapacityQuery = mysqli_query($connection,$irregCapacitySql);
        if($secLimit = mysqli_num_rows($irregCapacityQuery) >= 65) // CHANGE TO 60 SOON
        {
            $output = [
                'status' => 'error',
                'message' => 'section capacity already full, please select other section'
            ];

            echo json_encode($output);
        }else{

            $checkIrregLrnSql = "
            SELECT 'grade_seven' as source_table, lrn FROM grade_seven WHERE lrn = '$lrn'
            UNION ALL
            SELECT 'grade_eight', lrn FROM grade_eight WHERE lrn = '$lrn'
            UNION ALL
            SELECT 'grade_nine', lrn FROM grade_nine WHERE lrn = '$lrn'
            UNION ALL
            SELECT 'grade_ten', lrn FROM grade_ten WHERE lrn = '$lrn'
        ";

        $checkIrregLrnQuery = mysqli_query($connection,$checkIrregLrnSql);

        if($checkLrnForIrreg = mysqli_num_rows($checkIrregLrnQuery) > 0)
        {
            $output = [
                'status' => 'error',
                'message' => 'LRN already Exist in school database'
            ];

            echo json_encode($output);
            } else {
                // Inserting Student
                $irregEnrollSql = "INSERT INTO $databaseTable (school_year, lrn, grade_level, section, student_type, stud_fname, stud_mname,
                stud_lname, birth_date, age, place_of_birth, mother_tongue, gender, region, province, city, barangay,
                mother_fname, mother_mname, mother_lname, mother_number, father_fname, father_mname, father_lname, father_number,
                guardian_fname, guardian_mname, guardian_lname, guardian_number, date_enrolled, last_grade_level, last_School_year, last_school) 
                VALUES ('$schoolyear', '$lrn', '$gradeLevel', '$section', '$studentType', '$studentFname', '$studentMname', '$studentlname',
                '$birthDate', '$age', '$placeOfBirth', '$motherTounge', '$gender', '$region', '$province', '$city', '$barangay',
                '$motherFname', '$motherMname', '$motherLname', '$motherNumber', '$fatherFname', '$fatherMname', '$fatherLname', '$fatherNumber',
                '$guardianFname', '$guardianMname', '$guardianLname', '$guardianNumber','$dateEnrolled','$lastGradeLevel','$lastSchoolYear','$lastSchool')";


                $irregEnrollQuery = mysqli_query($connection, $irregEnrollSql);

                if ($irregEnrollQuery) {
                    $output = [
                        'status' => 'success',
                        'message' => 'Enrolled'
                    ];

                    echo json_encode($output);
                } else {
                    $output = [
                        'status' => 'failed',
                        'message' => 'Enroll Query Failed'
                    ];

                    echo json_encode($output);
                }
            }

        }
    }


    }
