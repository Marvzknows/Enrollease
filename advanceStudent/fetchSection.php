<?php

    require '../database/dbcon.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $schoolYear = $_POST['schoolyear'];
        $gradelevel = $_POST['gradelevel'];

        $sql = "SELECT * FROM sections WHERE grade_level='$gradelevel' AND school_year='$schoolYear'";
        $query = mysqli_query($connection,$sql);

        $output = '<option value="" selected>- Select Section -</option>';

        if($query) {

            if(mysqli_num_rows($query) > 0) {
                
                while($row = mysqli_fetch_assoc($query))
                {
                    $output .= '
                        <option value="'.$row['section'].'">'.$row['section'].'</option>
                    ';
                }

            }else {
                $output .= '
                    <option value=""> - no section is set - </option>
                ';
            }

        }else {
            $output = 'Fetch Section Query Failed';
        }

        echo $output;
    }

?>
