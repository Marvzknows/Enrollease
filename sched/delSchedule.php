<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $id = $_POST['deleteId'];

        // query
        $sql = "DELETE FROM teacher_schedule WHERE id='$id'";
        $query = mysqli_query($connection,$sql);

        if($query){
            echo "Successfully Deleted!";
        }else{
            echo "Deleting Schedule Query Failed";
        }
        
    }else{
        echo 'Something went wrong please try again later';
    }

?>