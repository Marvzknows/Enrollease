<?php
    session_start();
    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $schoolYear = $_POST['schoolYear'];
        $currentSchoolyear = $_SESSION['activeSchoolYear'];

        $output = '';
        $sql = "SELECT * FROM sections WHERE school_year='$schoolYear' GROUP BY section"; 
        $query = mysqli_query($connection,$sql);

        if($query){
            
            while($data = mysqli_fetch_assoc($query))
            {
                // Check if the subject school year is not equal to the current school year
                $disabledAttribute = ($schoolYear != $currentSchoolyear) ? 'disabled' : '';

                $output .='
                <tr>
                    <td class="gradeLevelTxt text-center w-25">'.$data['grade_level'].'</td>
                    <td class="sectionTxt text-center w-50">'.$data['section'].'</td>
                    <td class="text-center w-25">
                        <button class="editSectionBtn btn btn-primary btn-sm fw-semibold" ' . $disabledAttribute . '><i class="fa-regular fa-pen-to-square"></i></button>
                    </td>
                </tr>
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
