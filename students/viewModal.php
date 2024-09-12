<?php

    require '../database/dbcon.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $schoolYear = $_POST['viewSchoolyear'];
        $studentLrn = $_POST['viewStudLrn'];
        $gradeLevel = $_POST['viewGradeLevel'];
        $section = $_POST['viewSectionName'];

        if($gradeLevel == '7'){
            $databaseTable = 'grade_seven';
        }elseif($gradeLevel == '8'){
            $databaseTable = 'grade_eight';
        }elseif($gradeLevel == '9'){
            $databaseTable = 'grade_nine';
        }elseif($gradeLevel == '10'){
            $databaseTable = 'grade_ten';
        }


        if(!empty($databaseTable)) {

            $viewSql = "SELECT * FROM $databaseTable WHERE school_year='$schoolYear' AND lrn='$studentLrn' AND grade_level='$gradeLevel' AND section='$section'";
            $viewQuery = mysqli_query($connection,$viewSql);
            $output = '';

            if(mysqli_num_rows($viewQuery) > 0) {

                $data = mysqli_fetch_assoc($viewQuery);
                
                $output = '
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="viewLrn" class="form-label">Learner Reference No.</label>
                            <input type="text" class="form-control" id="viewLrn" value="'.$data['lrn'].'" disabled>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-4 col-sm-12 mb-2">
                            <label for="viewGradelevel" class="form-label">Grade Level</label>
                            <input type="text" class="form-control" id="viewGradelevel" value="'.$data['grade_level'].'" disabled>
                        </div>
                        <div class="col-lg-4 col-sm-12 mb-2">
                            <label for="viewSection" class="form-label">Section</label>
                            <input type="text" class="form-control" id="viewSection" value="'.$data['section'].'" disabled>
                        </div>
                        <div class="col-lg-4 col-sm-12 mb-2">
                            <label for="viewStudType" class="form-label">Student Type</label>
                            <input type="text" class="form-control" id="viewStudType" value="'.$data['student_type'].'" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-8">
                            <label for="viewName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="viewName" value="'.$data['stud_lname'].' '.$data['stud_fname'].' '.$data['stud_mname'].'" disabled>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <label for="age" class="form-label">Age</label>
                            <input type="text" class="form-control text-center" id="age" value="'.$data['age'].'" readonly disabled>
                        </div>
                        <div class="col-lg-2">
                            <label for="viewGender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="viewGender" value="'.$data['gender'].'" disabled>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-12">
                            <label for="viewBdate" class="form-label">Birth Date</label>
                            <input type="text" class="form-control" id="viewBdate" value="'.$data['birth_date'].'" disabled>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label for="viewPlaceofBirth" class="form-label">Place of Birth</label>
                            <input type="text" class="form-control" id="viewPlaceofBirth" value="'.$data['place_of_birth'].'" disabled>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label for="viewToungue" class="form-label">Mother Tongue</label>
                            <input type="text" class="form-control" id="viewToungue" value="'.$data['mother_tongue'].'" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-12">
                            <label for="viewProvince" class="form-label">Province</label>
                            <input type="text" class="form-control" id="viewProvince" value="'.$data['province'].'" disabled>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label for="viewCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="viewCity" value="'.$data['city'].'" disabled>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label for="viewBarangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="viewBarangay" value="'.$data['barangay'].'" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewMotherName" class="form-label">Mother Name</label>
                            <input type="text" class="form-control" id="viewMotherName" value="'.$data['mother_fname'].' '.$data['mother_lname'].' '.$data['mother_mname'].'" disabled>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewMotherNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="viewMotherNumber" value="'.$data['mother_number'].'" disabled>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewFatherName" class="form-label">Father Name</label>
                            <input type="text" class="form-control" id="viewFatherName" value="'.$data['father_fname'].' '.$data['father_lname'].' '.$data['father_mname'].'" disabled>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewFatherNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="viewFatherNumber" value="'.$data['father_number'].'" disabled>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewGuardianName" class="form-label">Legal Guardian Name</label>
                            <input type="text" class="form-control" id="viewGuardianName" value="'.$data['guardian_fname'].' '.$data['guardian_lname'].' '.$data['guardian_mname'].'" disabled>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewGuardianNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="viewGuardianNumber" value="'.$data['guardian_number'].'" disabled>
                        </div>
                    </div>
                ';

                if($data['student_type'] == 'Transferee' || $data['student_type'] == 'Returning') {
                    $output .= '
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewLastgrade" class="form-label">Last Grade Level</label>
                            <input type="text" class="form-control" id="viewLastgrade" value="'.$data['last_grade_level'].'" disabled>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="viewLastSy" class="form-label">Last School Year Completed</label>
                            <input type="text" class="form-control" id="viewLastSy" value="'.$data['last_School_year'].'" disabled>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label for="viewLastSchoolAttended" class="form-label">Last School Attended</label>
                            <input type="text" class="form-control" id="viewLastSchoolAttended" value="'.$data['last_school'].'" disabled>
                        </div>
                    </div>
                    ';
                }

            }else {
                echo '<h1>No data found</h1>';
            }

            // Display Output
            echo $output;

        }else {
            echo 'Grade level is empty';
        }
    }

?>