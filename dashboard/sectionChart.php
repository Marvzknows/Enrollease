<?php

require '../database/dbcon.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $sql = "";

    if (isset($_POST['gradeLevel']) && !empty($_POST['gradeLevel']) && isset($_POST['schoolyear']) && !empty($_POST['schoolyear'])) {

        $schoolYear = $_POST['schoolyear'];
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

        $sql .= "SELECT section as sectionName, COUNT(*) as numberOfStudents FROM $databaseTable WHERE school_year = '$schoolYear' GROUP BY section";
    }

    $query = mysqli_query($connection, $sql);

    if ($query) {
        $sectionName = [];
        $studentsCount = [];
        $totalStudents = 0;

        while ($output = mysqli_fetch_assoc($query)) {
            $sectionName[] = $output['sectionName'];
            $studentsCount[] = $output['numberOfStudents'];
            $totalStudents += $output['numberOfStudents'];
        }

        // Calculate and store the percentage for each section
        $percentages = [];
        foreach ($studentsCount as $count) {
            $percentage = ($count / $totalStudents) * 100;
            $percentages[] = round($percentage, 2);
        }

        // Return the data as JSON, including percentages
        $response = [
            'sectionName' => $sectionName,
            'studentsCount' => $studentsCount,
            'percentages' => $percentages,
        ];

        echo json_encode($response);
    }
}

?>
