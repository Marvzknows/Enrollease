<?php

    session_start();
    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['schoolYear']) && !empty($_POST['schoolYear'])){

            $activeSchoolyear = $_POST['schoolYear'];

            $output = '';
            $sql = "SELECT * FROM sections WHERE school_year='$activeSchoolyear' ORDER BY grade_level ASC";
            $query = mysqli_query($connection,$sql);
    
            if($query)
            {
                while($data = mysqli_fetch_assoc($query))
                {
                    $output .= '<option value="'.$data['grade_level'].' '.$data['section'].'">'.$data['grade_level'].' '.$data['section'].'</option>';
                }
            }else{
                echo 'Query failed (fetchSection.php)';
                exit();
            }

        }

        echo $output;

    }else{
        echo 'Request Method do not match';
    }

?>

