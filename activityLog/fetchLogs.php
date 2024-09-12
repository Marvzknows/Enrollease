<?php
require '../database/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $output = '';
    $logsSql = "SELECT * FROM activity_log ORDER BY id DESC LIMIT 20";
    $logsQuery = mysqli_query($connection, $logsSql);

    if ($logsQuery) {
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
    } else {
        echo 'Activity Log Query failed';
    }
}
?>
