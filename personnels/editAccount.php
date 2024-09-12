<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $editId = $_POST['hiddenIdValue'];
        $fname = $_POST['editFnameVal'];
        $mname = $_POST['editMnameVal'];
        $lname = $_POST['editLnameVal'];
        $password = $_POST['editPasswordVal'];

        $updateSql = "UPDATE `teacher_acc` SET `first_name` = '$fname', `last_name` = '$lname', `middle_name` = '$mname', `password` = '$password' WHERE id='$editId'";
        $updateQuery = mysqli_query($connection,$updateSql);

        if($updateQuery){
            echo 'Changes Successfully Saved';
        }else{
            echo 'Updating Failed';
        }

    }else{
        echo 'Request Method Do not match';
    }

?>