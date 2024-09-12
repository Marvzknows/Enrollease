<?php
    session_start();
    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $subjectSchoolyear = $_POST['subjectSchoolyear'];
        $currentSchoolyear = $_SESSION['activeSchoolYear'];

        $output = '';
        $subjSql = "SELECT * FROM subjects WHERE school_year='$subjectSchoolyear' ORDER BY subject_name ASC";
        $subjQuery = mysqli_query($connection,$subjSql);

        if($subjQuery)
        {
            while($data = mysqli_fetch_assoc($subjQuery))
            {
                 // Check if the subject school year is not equal to the current school year
                $disabledAttribute = ($subjectSchoolyear != $currentSchoolyear) ? 'disabled' : '';

                $output .='
                <tr>
                    <td class="subject_Name text-center fw-6">'.$data['subject_name'].'</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="editSubjBtn btn btn-primary btn-sm" ' . $disabledAttribute . '><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="delSubjbtn btn btn-danger btn-sm" ' . $disabledAttribute . '><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
                ';
            }

            echo $output;
        }else{

            echo 'Fetch subject Query failed';
        }


    }
?>
