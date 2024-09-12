<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $schoolYear = $_POST['schoolYear'];
        $gradeLevel = $_POST['gradeLevel'];

        $output = '<option value="" selected>- select section -</option>';
        $sql = "SELECT * FROM sections WHERE school_year='$schoolYear' AND grade_level='$gradeLevel' ORDER BY grade_level"; 
        $query = mysqli_query($connection,$sql);

        if($query){
            
            while($data = mysqli_fetch_assoc($query))
            {
                $output .='
                <option value="'.$data['section'].'">'.$data['section'].'</option>
                ';
            }

        }else{
            echo 'Query Failed.';
        }

        echo $output;

    }else{
        echo 'Request Method do not match.';
    }

?>
