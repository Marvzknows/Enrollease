<?php
require '../database/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $startDate = $_POST['startDate'];   
    $endDate = $_POST['endDate'];    

    $output = '';

    // Modify the SQL query to fetch records from the last week
    $logsSql = "SELECT * FROM activity_log WHERE date_log BETWEEN '$endDate' AND '$startDate'";
    $logsQuery = mysqli_query($connection, $logsSql);

    if (mysqli_num_rows($logsQuery) > 0) {
        while ($data = mysqli_fetch_assoc($logsQuery)) {
            $formattedDate = date("F d, Y", strtotime($data['date_log']));
            $formattedTime = date("h:i A", strtotime($data['time']));
            $output .= '
                <tr class="text-start">
                    <td class="text-center visually-hidden">' . $data['id'] . '</td>
                    <td class="text-center">' . $data['teacher_id'] . '</td>
                    <td class="text-center">' . $data['description'] . '</td>
                    <td class="text-center">' . $formattedDate . ' - ' . $formattedTime . '</td>
                </tr>
            ';
        }

        echo $output;
    }
}
?>
