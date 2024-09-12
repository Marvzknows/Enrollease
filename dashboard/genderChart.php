<?php

    require '../database/dbcon.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $sql = "";

        if(isset($_POST['schoolyear']) && isset($_POST['gradeLevel']) && !empty($_POST['schoolyear']) && !empty($_POST['gradeLevel'])) {
            
            $schoolyear = $_POST['schoolyear'];
            $gradeLevel = $_POST['gradeLevel'];

            if ($gradeLevel == '7') {
                $databaseTable = 'grade_seven';
            } elseif ($gradeLevel == '8') {
                $databaseTable = 'grade_eight';
            } elseif ($gradeLevel == '9') {
                $databaseTable = 'grade_nine';
            } elseif ($gradeLevel == '10') {
                $databaseTable = 'grade_ten';
            }

            // $sql .= "SELECT section as sectionName,gender, COUNT(*) as count FROM $databaseTable WHERE school_year='$schoolyear' GROUP BY gender";
        
            $sql .="SELECT 
            section as sectionName,
            SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as maleCount,
            SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as femaleCount
            FROM $databaseTable
            WHERE school_year = '$schoolyear'
            GROUP BY section";
            $query = mysqli_query($connection,$sql);

            if ($query) {
                $sectionName = [];
                $maleCount = [];
                $femaleCount = [];
                $totalMaleStudents = 0;

                while ($output = mysqli_fetch_assoc($query)) {
                    $sectionName[] = $output['sectionName'];
                    $maleCount[] = $output['maleCount'];
                    $femaleCount[] = $output['femaleCount'];
                    $totalMaleStudents += $output['maleCount'];
                }

                // Calculate and store the percentage for each section
                $male_percentages = [];
                foreach ($maleCount as $malePercentageCount) {
                    $percentage = ($malePercentageCount / $totalMaleStudents) * 100;
                    $male_percentages[] = round($percentage, 2);
                }

                // Return the data as JSON
                $response = [
                    'sectionName' => $sectionName,
                    'maleCount' => $maleCount,
                    'femaleCount' => $femaleCount,
                    'male_percentages' => $male_percentages,
                ];

                echo json_encode($response);
            }
        }
    }

?>