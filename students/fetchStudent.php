<?php

// NAHINTO PAG FETCH NG STUDENT PAG WALANG STUDENT SA SECTION, PAG BASEHAN MO UNG SA TESTING.PHP NA QUERY
    require '../database/dbcon.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST') 
    {
        $schoolYear = $_POST['schoolYear'];
        $gradeLevel = $_POST['gradeLevel'];
        $section = $_POST['section'];

        if($gradeLevel == '7'){
            $databaseTable = 'grade_seven';
        }elseif($gradeLevel == '8'){
            $databaseTable = 'grade_eight';
        }elseif($gradeLevel == '9'){
            $databaseTable = 'grade_nine';
        }elseif($gradeLevel == '10'){
            $databaseTable = 'grade_ten';
        }

        $output = ''; // output
      
        if(!empty($schoolYear) && !empty($gradeLevel) && empty($section)) {


            $allGradelvlSql = "SELECT * FROM $databaseTable WHERE school_year='$schoolYear' AND grade_level='$gradeLevel'";
            $allGradelvlQuery = mysqli_query($connection,$allGradelvlSql);

            if(mysqli_num_rows($allGradelvlQuery) > 0) {
                while($allGradeLevel = mysqli_fetch_assoc($allGradelvlQuery)){

                    $statusColor = '';

                    if ($allGradeLevel['student_type'] == 'Regular') {
                        $statusColor .= 'badge rounded-pill text-bg-success w-75 fw-bold';
                    } elseif ($allGradeLevel['student_type'] == 'Transferee') {
                        $statusColor .= 'badge rounded-pill text-bg-primary w-75 fw-bold';
                    } elseif ($allGradeLevel['student_type'] == 'Returning') {
                        $statusColor .= 'badge rounded-pill text-bg-warning w-75 fw-bold';
                    }

                    $output .= '
                        <tr>
                            <td class="studentLrn fw-semibold">' . $allGradeLevel['lrn'] . '</td>
                            <td class="studentGrade_Level text-center">' . $allGradeLevel['grade_level'] . '</td>
                            <td class="student_sectionName">' . $allGradeLevel['section'] . '</td>
                            <td>' . $allGradeLevel['stud_lname'] . '</td>
                            <td>' . $allGradeLevel['stud_fname'] . '</td>
                            <td><span class="' . $statusColor . '">' . $allGradeLevel['student_type'] . '</span></td>
                            <td>' . $allGradeLevel['gender'] . '</td>
                            <td>' . $allGradeLevel['date_enrolled'] . '</td>
                            <td>
                                <div class="btn-group">
                                    <button class="viewButton btn btn-info btn-sm fw-semibold">View</button>
                                    <a href="students/editStudent.php?data_id=' . $allGradeLevel['id'] . '&school_year=' . $allGradeLevel['school_year'] . '&gradeLevel=' . $allGradeLevel['grade_level'] . '&section=' . $allGradeLevel['section'] . '" class="btn btn-sm btn-primary edit">Edit</a>
                                    <a href="students/student_pdf.php?data_id=' . $allGradeLevel['id'] . '&school_year=' . $allGradeLevel['school_year'] . '&gradeLevel=' . $allGradeLevel['grade_level'] . '&section=' . $allGradeLevel['section'] . '" class="btn btn-sm btn-secondary" target="_blank">Print</a>
                                </div>
                            </td>
                        </tr>
                    ';
                }
                // DESIGN NG ACTION BUTTONS NI PRINT PDF STUDENT PATI SA BABA NITO BAKA MAKALIMUTNA MO
            }else {
                    $output .= '
                        <tr>
                            <td>no data</td>
                            <td>no data</td>
                            <td>no data</td>
                            <td>no data</td>
                            <td>no data</td>
                            <td>no data</td>
                            <td>no data</td>
                            <td>no data</td>
                            <td>
                                <button class="viewButton btn btn-info btn-sm fw-semibold" disabled>View</button>
                                <button class="editButton btn btn-primary btn-sm" disabled><i class="fa-regular fa-pen-to-square"></i></button>
                            </td>
                        </tr>
                    ';
            }
        } else if(!empty($schoolYear) && !empty($gradeLevel) && !empty($section)) {

            $fetchAllSql = "SELECT * FROM $databaseTable WHERE school_year='$schoolYear' AND grade_level='$gradeLevel' AND section='$section'";
            $fetchAllQuery = mysqli_query($connection,$fetchAllSql);

            if(mysqli_num_rows($fetchAllQuery) > 0) {
                while($allData = mysqli_fetch_assoc($fetchAllQuery)){

                    $fetchAllStatusColor = '';

                    if ($allData['student_type'] == 'Regular') {
                        $fetchAllStatusColor .= 'badge rounded-pill text-bg-success w-75 fw-bold';
                    } elseif ($allData['student_type'] == 'Transferee') {
                        $fetchAllStatusColor .= 'badge rounded-pill text-bg-primary w-75 fw-bold';
                    } elseif ($allData['student_type'] == 'Returning') {
                        $fetchAllStatusColor .= 'badge rounded-pill text-bg-warning w-75 fw-bold';
                    }

                    $output .= '
                        <tr>
                            <td class="studentLrn fw-semibold">' . $allData['lrn'] . '</td>
                            <td class="studentGrade_Level text-center">' . $allData['grade_level'] . '</td>
                            <td class="student_sectionName">' . $allData['section'] . '</td>
                            <td>' . $allData['stud_lname'] . '</td>
                            <td>' . $allData['stud_fname'] . '</td>
                            <td><span class="' . $fetchAllStatusColor . '">' . $allData['student_type'] . '</span></td>
                            <td>' . $allData['gender'] . '</td>
                            <td>' . $allData['date_enrolled'] . '</td>
                            <td>
                            
                                <div class="btn-group">
                                    <button class="viewButton btn btn-info btn-sm fw-semibold">View</button>
                                    <a href="students/editStudent.php?data_id=' . $allData['id'] . '&school_year=' . $allData['school_year'] . '&gradeLevel=' . $allData['grade_level'] . '&section=' . $allData['section'] . '" class="btn btn-sm btn-primary edit">Edit</a>
                                    <a href="students/student_pdf.php?data_id=' . $allData['id'] . '&school_year=' . $allData['school_year'] . '&gradeLevel=' . $allData['grade_level'] . '&section=' . $allData['section'] . '" class="btn btn-sm btn-secondary" target="_blank">Print</a>
                                </div>
                            
                            </td>
                        </tr>
                    ';
                }
            }

        }


        // output
        echo $output;
    }


?>
