<?php

include '../database/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $day = $_POST['day'];
    $teacher_id = $_POST['teacher_id'];
    $school_year = $_POST['school_year'];

    $sql = "SELECT * FROM teacher_schedule WHERE school_year='$school_year' AND teacher_id='$teacher_id' AND day='$day' ORDER BY start_time";
    $query = mysqli_query($connection, $sql);

    $output = "";
    if (mysqli_num_rows($query) > 0) {

        foreach ($query as $rows) {
            // Convert start_time and end_time to 12-hour format
            $start_time = date('h:i A', strtotime($rows['start_time']));
            $end_time = date('h:i A', strtotime($rows['end_time']));

            $output .= '
                <tr>
                    <td class="sched_id visually-hidden">' . $rows['id'] . '</td>
                    <td class="day">' . $rows['day'] . '</td>
                    <td class="subject">' . $rows['subject'] . '</td>
                    <td class="section">' . $rows['section'] . '</td>
                    <td class="start_time">' . $start_time . '</td>
                    <td class="end_time">' . $end_time . '</td>
                    <td class="text-center">
                        <button class="edit_btn btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="delete_btn btn btn-sm btn-outline-danger"><i class="fa-regular fa-trash-can"></i></button>
                    </td>
                </tr>
            ';
        }
    } else {
        $output .= '
            <tr>
                <td class="visually-hidden"> No Schedule Found </td>
                <td class="day"> No Schedule Found </td>
                <td class="subject"> No Schedule Found </td>
                <td class="section"> No Schedule Found </td>
                <td class="start_time"> No Schedule Found </td>
                <td class="end_time"> No Schedule Found </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary disabled"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="delete_btn btn btn-sm btn-outline-danger disabled"><i class="fa-regular fa-trash-can"></i></button>
                </td>
            </tr>
        ';
    }

    // output
    echo $output;
} else {
    echo 'Something went Wrong, Try again later';
}
