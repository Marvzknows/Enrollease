<?php

    session_start();
    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $output = '';
        $sql = "SELECT * FROM teacher_acc WHERE teacher_status='Enable'";
        $query = mysqli_query($connection,$sql);

        if($query)
        {
            while($data = mysqli_fetch_assoc($query))
            {
                $output .= '
                <tr>
                    <td class="teacher_id text-center">' . $data['teacher_id'] . '</td>
                    <td class="l_name text-center">' . $data['last_name'] . '</td>
                    <td class="f_name text-center">' . $data['first_name'] . '</td>
                    <td>
                        <div class="btn-group">
                            <button class="addSchedBtn btn btn-success btn-sm fw-semibold ">Add Schedule</button>
                            <button class="view_sched_btn btn btn-info btn-sm fw-semibold">View</button>
                            <a href="editSched.php?data_id=' . $data['teacher_id'] . '&school_year=' . $_SESSION['activeSchoolYear'] . '" class="edit_sched_btn btn btn-primary btn-sm fw-semibold">Edit</a>
                            <button class="delete_sched_btn btn btn-danger btn-sm fw-semibold">Delete</button>
                            <a href="sched/pdf_generator.php?data_id=' . $data['teacher_id'] . '&school_year=' . $_SESSION['activeSchoolYear'] . '" class="btn btn-outline-dark btn-sm fw-semibold" target="_blank">Print</a>
                        </div>
                    </td>
                </tr>
            ';
            
            }
        }

        echo $output;

    }else{
        echo 'Request Method do not match';
    }

?>

