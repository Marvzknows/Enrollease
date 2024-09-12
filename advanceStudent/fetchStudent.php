<?php

    require '../database/dbcon.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $schoolYear = $_POST['schoolyear'];
        $gradeLevel = $_POST['gradelevel'];
        $section = $_POST['section'];
        $setEnrollmentStatus = 'Pending';

        if($gradeLevel == '7'){
            $databaseTable = 'grade_seven';
        }elseif($gradeLevel == '8'){
            $databaseTable = 'grade_eight';
        }elseif($gradeLevel == '9'){
            $databaseTable = 'grade_nine';
        }elseif($gradeLevel == '10'){
            $databaseTable = 'grade_ten';
        }

        if(isset($databaseTable) && !empty($databaseTable)) {

            // Update First the Enrollment Status to Pending for checkbox disable enable validation
            $pendingSql = "UPDATE `$databaseTable` SET `enrollment_status` = '$setEnrollmentStatus' WHERE enrollment_status = 'unset'";
            $pendingQuery = mysqli_query($connection,$pendingSql);

            if($pendingQuery) 
            {

                $sql = "SELECT * FROM $databaseTable WHERE school_year='$schoolYear' AND grade_level='$gradeLevel' AND section='$section'";
                $query = mysqli_query($connection, $sql);
                $output = '';

                if ($query) {

                    if (mysqli_num_rows($query) > 0) {

                        while ($rows = mysqli_fetch_assoc($query)) {
                            $statusColor = '';

                            if ($rows['enrollment_status'] == 'Enrolled') {
                                $statusColor .= 'badge rounded-pill text-bg-success w-75 fw-bold';
                                $checkboxDisabled = 'disabled';
                            } elseif ($rows['enrollment_status'] == 'Finished') {
                                $statusColor .= 'badge rounded-pill text-bg-info w-75 fw-bold';
                                $checkboxDisabled = 'disabled';
                            } elseif ($rows['enrollment_status'] == 'Pending') {
                                $statusColor .= 'badge rounded-pill text-bg-warning w-75 fw-bold';
                                $checkboxDisabled = '';
                            } else {
                                $statusColor .= 'badge rounded-pill text-bg-info w-75 fw-bold';
                                $checkboxDisabled = '';
                            }

                            // Remove 'selectData' class if enrollment_status is 'Finished' or 'Enrolled'
                            if ($rows['enrollment_status'] == 'Finished' || $rows['enrollment_status'] == 'Enrolled') {
                                $selectDataClass = '';
                            } else {
                                $selectDataClass = ' selectData';
                            }

                            $output .= '
                                    <tr>
                                        <td>
                                            <input class="form-check-input' . $selectDataClass . '" type="checkbox" name="id[]" value="' . $rows['id'] . '" ' . $checkboxDisabled . '>
                                        </td>
                                        <td class="selectLrn">' . $rows['lrn'] . '</td>
                                        <td>' . $rows['school_year'] . '</td>
                                        <td>' . $rows['stud_lname'] . '</td>
                                        <td>' . $rows['stud_fname'] . '</td>
                                        <td>' . $rows['student_type'] . '</td>
                                        <td>' . $rows['gender'] . '</td>
                                        <td><span class="' . $statusColor . '">' . $rows['enrollment_status'] . '</span></td>
                                    </tr>
                                ';
                        }
                        
                    }
                }


                // Output
                echo $output;
            }else {
                echo 'Updating Status Query Failed';
            }

        }
        
    }

?>
