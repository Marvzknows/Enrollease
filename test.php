<?php

include 'database/dbcon.php';

// $query = "SELECT MAX(id)-1 as id FROM school_year";
// $result = mysqli_query($connection, $query);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $last_id = $row['id'];

//     $lastSySql = "SELECT school_year FROM school_year WHERE id='$last_id'";
//     $lastSyQuery = mysqli_query($connection, $lastSySql);

//     if ($lastSyQuery) {
//         $lastSyRow = mysqli_fetch_assoc($lastSyQuery);
//         echo $lastSyRow['school_year'];
//     }
// } else {
//     echo "Error: " . $query . "<br>" . mysqli_error($connection);
// }
date_default_timezone_set("Asia/Manila");
$currentDate = date("Y-m-d"); // This will give you the date in the format "YYYY-MM-DD" in the Philippines timezone
echo "Current Date in the Philippines: " . $currentDate;

?>

<!-- GET THE LAST SCHOOL YEAR BEFORE THE CURRENT ACTIVE SCHOOL YEAR -->
<div class="input-group input-group-sm mb-3">
    <span class="input-group-text fw-semibold" id="activeSchoolYear">School Year :</span>
    <?php
    $activeSySql = "SELECT MAX(id)-1 as id FROM school_year";
    $activeSyQuery = mysqli_query($connection, $activeSySql);
    if ($activeSyQuery) {
        $activeSyData = mysqli_fetch_assoc($activeSyQuery);
        $activeSchoolYear = $activeSyData['id'];

        $lastSy = "SELECT school_year FROM school_year WHERE id='$activeSchoolYear'";
        $lastSyQuery = mysqli_query($connection, $lastSy);

        if ($lastSyQuery) {
            $schoolyearData = mysqli_fetch_assoc($lastSyQuery);
            $sy = $schoolyearData['school_year'];
        }
    } else {
        echo ' activeSyQuery Failed';
    }
    ?>
    <input type="text" class="form-control fst-italic fw-bold" id="lastSchoolYear" value="<?php echo $sy; ?>" aria-label="Sizing example input" aria-describedby="activeSchoolYear" readonly>

</div>