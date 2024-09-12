<?php
    require '../database/dbcon.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $schoolYear = $_POST['hiddenSchoolYear'];
        $teacherId = $_POST['hiddenTeacherId'];
        $day = $_POST['filterDayVal'];

        $sql = "SELECT * FROM teacher_schedule WHERE school_year='$schoolYear' AND teacher_id='$teacherId' AND day='$day' ORDER BY start_time ASC";
        $query = mysqli_query($connection,$sql);

        $output = '';

        if(mysqli_num_rows($query) > 0) {
            while($data = mysqli_fetch_assoc($query))
            {
                $startTime = date("h:i A", strtotime($data['start_time']));
                $endTime = date("h:i A", strtotime($data['end_time']));
                $output.='
                <tr>
                    <td class="edit_id d-none">'.$data['id'].'</td>
                    <td class="edit_sy d-none">'.$data['school_year'].'</td>
                    <td class="edit_tchid d-none">'.$data['teacher_id'].'</td>
                    <td class="edit_Day">'.$data['day'].'</td>
                    <td class="edit_Subject">'.$data['subject'].'</td>
                    <td class="edit_section">'.$data['section'].'</td>
                    <td class="edit_StartTime">'.$startTime.'</td>
                    <td class="edit_EndTime">'.$endTime.'</td>
                    <td class="text-center">
                        <button class="delSched_btn btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button>
                    </td>
                </tr>
                ';
            }
        }else{
            $output.='
            <tr>
                <td class="edit_id d-none"> no data </td>
                <td class="edit_sy d-none"> no data </td>
                <td class="edit_tchid d-none"> no data </td>
                <td> no data </td>
                <td> no data </td>
                <td> no data </td>
                <td> no data </td>
                <td> no data </td>
                <td class="text-center">
                    <button class="delSched_btn btn btn-danger btn-sm" disabled><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
            ';
        }

        echo $output;
    }

?>