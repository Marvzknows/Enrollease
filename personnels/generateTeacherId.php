<?php
    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $id_name = 'TCH-';
        $teacher_id = $id_name . (mt_rand(100000, 999999));
        echo $teacher_id;
    }else{
        echo 'Request Method Do not Match';
    }
?>