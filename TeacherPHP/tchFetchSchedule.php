<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $schoolyear = $_POST['schoolYear'];
        $output = '';
        
        $fetchSql = "SELECT * FROM teachers WHERE school_year='$schoolyear'";
        $fetchQuery = mysqli_query($connection,$fetchSql);

        if($fetchQuery){
            foreach($fetchQuery as $data)
            {
                $output .='
                    <tr>
                        <td>'.$data['teacher_id'].'</td>
                        <td>'.$data['school_year'].'</td>
                        <td>'.$data['first_name'].' '.$data['last_name'].'</td>
                        <td class="text-center">             
                            <a href="../schedule/pdf_generator.php?data_id=' . $data['teacher_id'] . '&school_year=' . $data['school_year'] . '" class="btn btn-sm btn-primary border-2 fw-semibold" target="_blank"><i class="fa-solid fa-print"></i>Print Schedule</a>
                        </td>
                    </tr>
                    ';
            }
        }

        // Output
        echo $output;

    }else{
        echo 'ERROR: REQUEST METHOD DOES NOT MATCH';
    }

?>