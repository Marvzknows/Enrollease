<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $section = $_POST['section'];
        $schoolYear = $_POST['schoolYear'];
        $output = '';

        $sql = "SELECT day, subject, section, start_time, end_time FROM teacher_schedule WHERE school_year='$schoolYear' AND section='$section' ORDER BY day, start_time";
        $query = mysqli_query($connection,$sql);

        if(mysqli_num_rows($query) > 0) {
            while($sectionSched = mysqli_fetch_assoc($query))
            {
                // Convert start_time to 12-hour format
                $startTime = date("h:i A", strtotime($sectionSched['start_time']));              
                // Convert end_time to 12-hour format
                $endTime = date("h:i A", strtotime($sectionSched['end_time']));

                $output .= '
                <tr>
                    <td>' . $sectionSched['day'] . '</td>
                    <td>' . $sectionSched['section'] . '</td>
                    <td>' . $sectionSched['subject'] . '</td>
                    <td>' . $startTime . ' - ' . $endTime . '</td>
                </tr>
                ';
            }
        }else {
            $output = '
                <tr>
                    <td> no schedule found </td>
                    <td> no schedule found </td>
                    <td> no schedule found </td>
                    <td> no schedule found </td>
                </tr>
                ';
        }

        // output
        echo $output;

    }

?>

