<?php

    require '../database/dbcon.php';

    if($_SERVER["REQUEST_METHOD"] == "GET")
    {

        $output = '';

        $sql = "SELECT * FROM teacher_acc ORDER BY id DESC";
        $query = mysqli_query($connection, $sql);
        
        foreach ($query as $rows) {
            $statusColor = '';

            if ($rows['teacher_status'] == 'Disabled') {
                $statusColor .= 'badge rounded-pill text-bg-danger w-75 fw-bold';
            } elseif ($rows['teacher_status'] == 'Enable') {
                $statusColor = 'badge rounded-pill text-bg-success w-75 fw-bold';
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
                    <td><span class="'.$statusColor.'">' . $rows['teacher_status'] . '</span></td>
                    <td class="text-center">  
                        <button class="btn btn-sm btn-outline-primary edit_btn"><i class="fa-solid fa-pen-to-square"></i></button>
                    </td>
                </tr>
            ';
        }
        
        echo $output; // Don't forget to echo the output
        
    }

?>