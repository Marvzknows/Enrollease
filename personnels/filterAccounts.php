<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $filterData = $_POST['statusValue'];

        $output = '';

        $filterSql = "SELECT * FROM teacher_acc WHERE teacher_status='$filterData'";
        $filterQuery = mysqli_query($connection,$filterSql);

        if($filterQuery)
        {
            if(mysqli_num_rows($filterQuery) > 0)
            {
                // Pag merong Output
                foreach($filterQuery as $rows)
                {
                    $teacherStatus = '';
    
                    if ($rows['teacher_status'] == 'Disabled') {
                        $teacherStatus .= 'badge rounded-pill text-bg-danger w-75 fw-bold';
                    } elseif ($rows['teacher_status'] == 'Enable') {
                        $teacherStatus = 'badge rounded-pill text-bg-success w-75 fw-bold';
                    }
    
                    $output .= '
                        <tr>
                            <td class="id">
                                <input class="selectData border-dark form-check-input" type="checkbox" name="id[]" value="' . $rows['id'] . '">
                            </td>
                            <td class"empID">' . $rows['emp_id'] . '</td>
                            <td>' . $rows['teacher_id'] . '</td>
                            <td>' . $rows['last_name'] . '</td>
                            <td>' . $rows['first_name'] . '</td>
                            <td><span class="'.$teacherStatus.'">' . $rows['teacher_status'] . '</span></td>
                            <td class="text-center">  
                                <button class="btn btn-sm btn-outline-primary edit_btn"><i class="fa-solid fa-pen-to-square"></i></button>
                            </td>
                        </tr>
                    ';
                
                }

            }

            // Output
            echo $output;
        }else{
        }

    }else{
        echo 'Request Method Do not match';
    }
?>  