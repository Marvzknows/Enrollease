<?php
    include 'database/dbcon.php';

    $schoolyear_sql = "SELECT active_schoolyear FROM enrollment_status";
    $schoolyear_query = mysqli_query($connection,$schoolyear_sql);
    $sy_Data = mysqli_fetch_assoc($schoolyear_query);

    $current_schoolyear = $sy_Data['active_schoolyear'];

    function numOfTeachers(){
        include 'database/dbcon.php';
        
        $sql = "SELECT * FROM teacher_acc";
        $query = mysqli_query($connection,$sql);
        $num = mysqli_num_rows($query);
        echo $num;

    }

    function numOfSection($schoolyear){
        include 'database/dbcon.php';
        
        $sql = "SELECT COUNT(*) FROM sections WHERE school_year='$schoolyear' GROUP BY section";
        $query = mysqli_query($connection,$sql);
        $num = mysqli_num_rows($query);
        echo $num;

    }

    function numOfStudents($schoolyear){
        include 'database/dbcon.php';
        
        // $sql = "SELECT * FROM subjects";
        // $query = mysqli_query($connection,$sql);
        // $num = mysqli_num_rows($query);
        // echo $num;

        $studentCont_sql = "
            SELECT SUM(total_count) AS total_students
            FROM (
                SELECT COUNT(*) AS total_count FROM grade_seven WHERE school_year = '$schoolyear'
                UNION ALL
                SELECT COUNT(*) FROM grade_eight WHERE school_year = '$schoolyear'
                UNION ALL
                SELECT COUNT(*) FROM grade_nine WHERE school_year = '$schoolyear'
                UNION ALL
                SELECT COUNT(*) FROM grade_ten WHERE school_year = '$schoolyear'
            ) AS counts      
        ";

        $studentCont_Query = mysqli_query($connection,$studentCont_sql);

        if($studentCont_Query){
            if(mysqli_num_rows($studentCont_Query) > 0) 
            {
                $total_students = mysqli_fetch_assoc($studentCont_Query);
                echo $total_students['total_students'];
            }else {
                echo '0';
            }
        }else {
            echo 'Student Count Query Failed';
        }

    }
?>