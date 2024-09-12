<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $output = '';
        $sql = "SELECT * FROM sections GROUP BY section ORDER BY grade_level ASC";
        $query = mysqli_query($connection,$sql);

        if($query){
            if(mysqli_num_rows($query) > 0)
            {
                while($data = mysqli_fetch_assoc($query))
                {
                    $output .='
                        <tr>
                            <td class="text-center">'.$data['grade_level'].'</td>
                            <td class="text-center">'.$data['section'].'</td>
                        </tr>
                        ';
                }
                
            }else{
                $output .='
                    <tr>
                        <td class="text-center">No Data found</td>
                        <td class="text-center">No Data found</td>
                    </tr>
                    ';
            }

        }else{
            echo 'Query Failed';
            exit();
        }

        //Output
        echo $output;
    }

?>

