<?php

    require '../database/dbcon.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lrn = $_POST['searchLrn'];

        $output = '';
        $sql = "
            SELECT 'grade_seven' as source_table, lrn, grade_level FROM grade_seven WHERE lrn LIKE '".$lrn."%'
            UNION ALL
            SELECT 'grade_eight', lrn, grade_level FROM grade_eight WHERE lrn LIKE '".$lrn."%'
            UNION ALL
            SELECT 'grade_nine', lrn, grade_level FROM grade_nine WHERE lrn LIKE '".$lrn."%'
            UNION ALL
            SELECT 'grade_ten', lrn, grade_level FROM grade_ten WHERE lrn LIKE '".$lrn."%'
            GROUP BY LRN LIMIT 5 
        ";


        $query = mysqli_query($connection,$sql);

        $output .= '<ul class="list-group position-absolute">';

        if(mysqli_num_rows($query) > 0) {
            while($data = mysqli_fetch_assoc($query)) {
                $output .='
                <li class="lrnOutput list-group-item list-group-item-secondary">'.$data['lrn'].'</li>
                ';
            }
        }else {
            $output .= '<li class="list-group-item list-group-item-danger">No LRN found</li>';
        }
        $output .= '</ul>';
        echo $output;

    }

?>