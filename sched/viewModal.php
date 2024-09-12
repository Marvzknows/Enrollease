<?php

require '../database/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $teacher_id = $_POST['teacherId'];
    $tch_fullname = $_POST['teacherName']; // teacher Fullname
    $school_year = $_POST['schoolYear'];

    $sql_monday = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Monday' ORDER BY start_time  ASC";
    $query_monday = mysqli_query($connection, $sql_monday);

    $sql_tue = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Tuesday' ORDER BY start_time  ASC";
    $query_tuesday = mysqli_query($connection, $sql_tue);

    $sql_wed = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Wednesday' ORDER BY start_time  ASC";
    $query_wednesday = mysqli_query($connection, $sql_wed);

    $sql_thurs = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Thursday' ORDER BY start_time  ASC";
    $query_thursday = mysqli_query($connection, $sql_thurs);

    $sql_fri = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Friday' ORDER BY start_time  ASC";
    $query_friday = mysqli_query($connection, $sql_fri);

    echo '<h3 class="ms-3 mb-3 text-primary">
            <span class="text-dark"><i class="fa-solid fa-circle-user"></i> Teacher: </span>' . $tch_fullname . '
            <span class="text-dark ms-5"><i class="fa-solid fa-calendar-days"></i> School year: </span>' . $school_year . '
        </h3>';
    
    if(mysqli_num_rows($query_monday) > 0 || mysqli_num_rows($query_tuesday) > 0 || mysqli_num_rows($query_wednesday) > 0 || mysqli_num_rows($query_thursday) > 0 || mysqli_num_rows($query_friday) > 0)
    {   

        echo '<div class="row">';
        ################ MONDAY
        echo '<div class="col custom-column m-0 p-0">';
        echo '<table class="table table-bordered border-primary m-0">
                <thead class="table-primary border-primary">
                    <tr>
                        <th scope="col">MONDAY</th>
                    </tr>
                </thead>
                <tbody>';
                while ($monday = mysqli_fetch_assoc($query_monday)) {
                    // Convert start_time to 12-hour format
                    $start_time_12h = date("h:i A", strtotime($monday['start_time']));
                    
                    // Convert end_time to 12-hour format
                    $end_time_12h = date("h:i A", strtotime($monday['end_time']));
                
                    echo '
                        <tr>
                            <td><span>' . $start_time_12h . ' - ' . $end_time_12h . '<br></span>
                            <span class="fw-bold">' . $monday['subject'] . '</span> : <span class="fw-bold">' . $monday['section'] . '</span></td>
                        </tr>
                    ';
                }
                
        echo '</tbody>
            </table>'; //monday table end
        echo '</div>'; //col end
        
        ################ TUESDAY
        echo '<div class="col custom-column m-0 p-0">';
        echo '<table class="table table-bordered border-primary m-0">
                <thead class="table-primary border-primary">
                    <tr>
                        <th scope="col">TUESDAY</th>
                    </tr>
                </thead>
                <tbody>';
                while ($tuesday = mysqli_fetch_assoc($query_tuesday)) {
                    // Convert start_time to 12-hour format
                    $tuesday_start_time_12h = date("h:i A", strtotime($tuesday['start_time']));
                
                    // Convert end_time to 12-hour format
                    $tuesday_end_time_12h = date("h:i A", strtotime($tuesday['end_time']));
                
                    echo '
                        <tr>
                            <td><span>' . $tuesday_start_time_12h . ' - ' . $tuesday_end_time_12h . '<br></span>
                            <span class="fw-bold">' . $tuesday['subject'] . '</span> : <span class="fw-bold">' . $tuesday['section'] . '</span></td>
                        </tr>
                    ';
                }
                

        echo '</tbody>
            </table>'; //tuesday table end
        echo '</div>'; //col end

        ####################### WEDNESDAY
        echo '<div class="col custom-column m-0 p-0">';
        echo '<table class="table table-bordered border-primary m-0">
                <thead class="table-primary border-primary">
                    <tr>
                        <th scope="col">WEDNESDAY</th>
                    </tr>
                </thead>
                <tbody>';
        while($wednesday = mysqli_fetch_assoc($query_wednesday))
        {
            // Convert start_time to 12-hour format
            $wednesday_start_time_12h = date("h:i A", strtotime($wednesday['start_time']));
                
            // Convert end_time to 12-hour format
            $wednesday_end_time_12h = date("h:i A", strtotime($wednesday['end_time']));
            echo '
                    <tr>
                        <td><span>'.$wednesday_start_time_12h .' -  '.$wednesday_end_time_12h .' <br></span>
                        <span class="fw-bold">'.$wednesday['subject'] .'</span> :  <span class="fw-bold">'.$wednesday['section'] .'</span></td>
                    </tr>
                    ';
        }

        echo '</tbody>
            </table>'; //wednesday table end
        echo '</div>'; //col end


        ####################### THURSDAY
        echo '<div class="col custom-column m-0 p-0">';
        echo '<table class="table table-bordered border-primary m-0">
                <thead class="table-primary border-primary">
                    <tr>
                        <th scope="col">THURSDAY</th>
                    </tr>
                </thead>
                <tbody>';
        while ($thursday = mysqli_fetch_assoc($query_thursday)) {
            // Convert start_time to 12-hour format
            $thursday_start_time_12h = date("h:i A", strtotime($thursday['start_time']));
                
            // Convert end_time to 12-hour format
            $thursday_end_time_12h = date("h:i A", strtotime($thursday['end_time']));
            echo '
                    <tr>
                        <td><span>' . $thursday_start_time_12h . ' -  ' . $thursday_end_time_12h . ' <br></span>
                        <span class="fw-bold">' . $thursday['subject'] . '</span> :  <span class="fw-bold">' . $thursday['section'] . '</span></td>
                    </tr>
                    ';
        }

        echo '</tbody>
            </table>'; // thursday table end
        echo '</div>'; //col end

        ####################### FRIDAY
        echo '<div class="col custom-column m-0 p-0">';
        echo '<table class="table table-bordered border-primary m-0">
                <thead class="table-primary border-primary">
                    <tr>
                        <th scope="col">FRIDAY</th>
                    </tr>
                </thead>
                <tbody>';
        while ($friday = mysqli_fetch_assoc($query_friday)) {

            // Convert start_time to 12-hour format
            $friday_start_time_12h = date("h:i A", strtotime($friday['start_time']));
                
            // Convert end_time to 12-hour format
            $friday_end_time_12h = date("h:i A", strtotime($friday['end_time']));

            echo '
                    <tr>
                        <td><span>' . $friday_start_time_12h . ' -  ' . $friday_end_time_12h . ' <br></span>
                        <span class="fw-bold">' . $friday['subject'] . '</span> :  <span class="fw-bold">' . $friday['section'] . '</span></td>
                    </tr>
                    ';
        }

        echo '</tbody>
            </table>'; // thursday table end
        echo '</div>'; //col end

        // ROW END
        echo '</div>'; // row end

    }else{
        echo 'No schedule found.'; //TRY MAGLAGAY NG REDIRECT BUTTON FOR ADD SCHED
    }
    

} else {
    echo 'Something Went Wrong, Please try again later';
}
