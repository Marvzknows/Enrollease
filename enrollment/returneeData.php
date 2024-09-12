<?php

    require '../database/dbcon.php';
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // current active schoolyear
        $schoolyear = $_POST['schoolyear'];
        // Lastt school year
        $lastSchoolYear = $_POST['lastSchoolYear'];
        $lrn = $_POST['lrn'];

        $sql = "
            SELECT * FROM grade_seven WHERE lrn = '$lrn' AND enrollment_status = 'Pending' AND school_year != '$schoolyear' AND school_year != '$lastSchoolYear'
            UNION 
            SELECT * FROM grade_eight WHERE lrn = '$lrn' AND enrollment_status = 'Pending' AND school_year != '$schoolyear' AND school_year != '$lastSchoolYear'
            UNION 
            SELECT * FROM grade_nine WHERE lrn = '$lrn' AND enrollment_status = 'Pending' AND school_year != '$schoolyear' AND school_year != '$lastSchoolYear'
            UNION 
            SELECT * FROM grade_ten WHERE lrn = '$lrn' AND enrollment_status = 'Pending' AND school_year != '$schoolyear' AND school_year != '$lastSchoolYear'
        ";
        
        $query = mysqli_query($connection,$sql);

        if(mysqli_num_rows($query) > 0) {
            
            $data = mysqli_fetch_assoc($query);

            $output = [
                'status' => 'success',
                'message' => 'user found',
                'fname' => $data['stud_fname'],
                'lname' => $data['stud_fname'],
                'mname' => $data['stud_mname'],
                'fname' => $data['stud_fname'],
                'gradeLevel' => $data['grade_level'],
                'section' => $data['section'],
                'studentType' => $data['student_type'],
                'birthDate' => $data['birth_date'],
                'placeofBirth' => $data['place_of_birth'],
                'motherTongue' => $data['mother_tongue'],
                'gender' => $data['gender'],
                'region' => $data['region'],
                'province' => $data['province'],
                'city' => $data['city'],
                'barangay' => $data['barangay'],
                'motherFname' => $data['mother_fname'],
                'motherMname' => $data['mother_mname'],
                'motherLname' => $data['mother_lname'],
                'motherNumber' => $data['mother_number'],
                'fatherFname' => $data['father_lname'],
                'fatherMname' => $data['father_lname'],
                'fatherLname' => $data['father_lname'],
                'fatherNumber' => $data['father_number'],
                'guardianFname' => $data['guardian_lname'],
                'guardianMname' => $data['guardian_lname'],
                'guardianLname' => $data['guardian_lname'],
                'guardianNumber' => $data['guardian_number'],
                'lastGradeLevel' => $data['grade_level'],
                'lastSchool' => 'Kapitangan National High School',
                'lastSchoolYear' => $data['school_year'],
            ];

            echo json_encode($output);
            exit();
        }else {
            $output = [
                'status' => 'failed',
                'message' => 'No Returnee data found in our records, please ensure the LRN you inputed is valid and previously enrolled in our school'
            ];

            echo json_encode($output);
        }

    }

?>