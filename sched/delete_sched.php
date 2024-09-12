<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $id = $_POST['delTeacherId'];
        $sy = $_POST['delSchoolYear'];

        // query
        $sql = "DELETE FROM teacher_schedule WHERE school_year='$sy' AND teacher_id='$id'";
        $query = mysqli_query($connection,$sql);

        if($query){
            echo "Schedule Successfully Deleted!";
        }else{
            echo "Deleting Schedule Query Failed";
        }
        
    }else{
        echo 'Something went wrong please try again later';
    }

?>