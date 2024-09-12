<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $accStatus = $_POST['accStatus'];

        foreach($_POST['dataId'] as $dataId)
        {
            $sql = "UPDATE `teacher_acc` SET `teacher_status` = '$accStatus' WHERE id = '$dataId'";
            $query = mysqli_query($connection, $sql);

            if(!$query)
            {
                echo 'Error Updating Status';
                exit();
            }
        }

        echo 'Status Updated';
        exit();

    }else{
        echo 'Something went Wrong, Try again later';
    }
?>