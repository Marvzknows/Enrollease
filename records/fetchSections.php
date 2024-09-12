<?php

    require '../database/dbcon.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $schoolYear = $_POST['schoolyear'];
        $gradeLevel = $_POST['gradeLevel'];

        $sectionSql = "SELECT section FROM sections WHERE school_year='$schoolYear' AND grade_level='$gradeLevel'";
        $sectionQuery = mysqli_query($connection,$sectionSql);

        $output = '<option value="" selected> -- select section -- </option>';

        if(mysqli_num_rows($sectionQuery) > 0) {
            while($data = mysqli_fetch_assoc($sectionQuery)) {
                $output .= '
                    <option value="'.$data['section'].'">'.$data['section'].'</option>
                ';
            }
        }else {
            $output .= '
                <option value=""> -- no section found -- </option>
            ';
        }

        // Output
        echo $output;
    }

?>