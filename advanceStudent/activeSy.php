<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $getSySql = "SELECT active_schoolyear FROM enrollment_status";
        $getSyQuery = mysqli_query($connection,$getSySql);

        if($getSyQuery)
        {
            $row = mysqli_fetch_assoc($getSyQuery);
            $activeSchoolYear = $row['active_schoolyear'];
            
            echo $activeSchoolYear;
        }
    }

?>