<?php
//Matik May value na si School year at gradeLevel, kasi sila tung naka selected na agad sa page
require '../database/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['gradeLevel'] == '7') { //ipasok sa loob ng if statmnt ni gradelvl at school yr kung sakali
        $databaseTable = 'grade_seven';
    } elseif ($_POST['gradeLevel'] == '8') {
        $databaseTable = 'grade_eight';
    } elseif ($_POST['gradeLevel'] == '9') {
        $databaseTable = 'grade_nine';
    } elseif ($_POST['gradeLevel'] == '10') {
        $databaseTable = 'grade_ten';
    }

    if (isset($_POST['gradeLevel']) && !empty($_POST['gradeLevel']) && isset($_POST['schoolyear']) && !empty($_POST['schoolyear'])) {
        $gradeLevel = $_POST['gradeLevel'];
        $schoolyear = $_POST['schoolyear'];

        $sql = "SELECT * FROM $databaseTable WHERE school_year='$schoolyear' AND grade_level='$gradeLevel'";

        if (isset($_POST['section']) && !empty($_POST['section'])) {
            $section = $_POST['section'];
            $sql .= " AND section='$section'";
        }

        if (isset($_POST['gender']) && !empty($_POST['gender'])) {
            $gender = $_POST['gender'];
            $sql .= " AND gender='$gender'";
        }

        if (isset($_POST['studentType']) && !empty($_POST['studentType'])) {
            $studentType = $_POST['studentType'];
            $sql .= " AND student_type='$studentType'";
        }

        // Query Execution
        $query = mysqli_query($connection, $sql);

        $output = '';
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    
                    if (!empty($data['last_school']) && !empty($data['last_School_year']) && !empty($data['last_grade_level'])) {
                        $lastGradeLevel = $data['last_grade_level'];
                        $lastSchoolYear = $data['last_School_year'];
                        $lastSchool = $data['last_school'];
                    } else {
                        $lastGradeLevel = 'NO DATA';
                        $lastSchoolYear = 'NO DATA';
                        $lastSchool = 'NO DATA';
                    }

                    $output .= '
                    <tr class="text-start">
                        <td>' . $data['lrn'] . '</td>
                        <td>' . $data['school_year'] . '</td>
                        <td class="text-center">' . $data['grade_level'] . '</td>
                        <td>' . $data['section'] . '</td>
                        <td>' . $data['date_enrolled'] . '</td>
                        <td>' . $data['stud_fname'] . '</td>
                        <td>' . $data['stud_lname'] . '</td>
                        <td class="text-center">' . $data['student_type'] . '</td>
                        <td>' . $data['gender'] . '</td>
                        <td>' . $data['birth_date'] . '</td>
                        <td>' . $data['place_of_birth'] . '</td>
                        <td>' . $data['mother_tongue'] . '</td>
                        <td>' . $data['region'] . '</td>
                        <td>' . $data['province'] . '</td>
                        <td>' . $data['city'] . '</td>
                        <td>' . $data['barangay'] . '</td>
                        <td>' . $data['mother_fname'] . ' ' . $data['mother_lname'] . '</td>
                        <td>' . $data['father_fname'] . ' ' . $data['father_lname'] . '</td>
                        <td class="text-center">' . $lastGradeLevel . '</td>
                        <td class="text-center">' . $lastSchoolYear . '</td>
                        <td class="text-center">' . $lastSchool . '</td>
                    </tr>
                ';
                }
            }
            // output
            echo $output;
        } else {
            echo 'Query Failed';
        }
    }
}


?>