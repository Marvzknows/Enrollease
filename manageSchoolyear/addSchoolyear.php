<?php

// ADD SCHOOL YEAR TABLE THE VALUE OF SCHOOL YEAR RECIEVED
// ADD SECTION AND GRADE LEVEL
// USE empty() FUNCTION PATA SA SECTION KUNG NAG DAGDAG BA OR HINDE "WAG ISSET()"

require '../database/dbcon.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['newSchoolYear']) && isset($_POST['newSection']) && isset($_POST['newGradeLevel'])) {
            $newSchoolYear = $_POST['newSchoolYear'];
            $newSection = $_POST['newSection'];
            $newGradeLevel = $_POST['newGradeLevel'];

            // Insert School Year First
            $schoolYearSql = "INSERT INTO school_year (school_year) 
            VALUES ('$newSchoolYear')";

            $schoolYearQuery = mysqli_query($connection, $schoolYearSql); // School Year Table

            if ($schoolYearQuery) {

                $firstpastSySql = "SELECT * FROM sections GROUP BY section";
                $firstpastSySQuery = mysqli_query($connection,$firstpastSySql);

                if($firstpastSySQuery)
                {
                    $valuesToInsertStorage = array(); //Lalagyan ng past sections at grade level

                    while($firstPastSyData = mysqli_fetch_assoc($firstpastSySQuery))
                    {
                        // School Year is yung ngayon, kaya di na sinama dito
                        $lastLevel = $firstPastSyData['grade_level'];
                        $lastSection = $firstPastSyData['section'];
                        
                        $valuesToInsertStorage[] = "('$newSchoolYear', '$lastLevel', '$lastSection')";

                    }

                            // Inserting to database for isset Schoolyear,newadded gradelevel and section
                            //Insert muna mga past grade level and sections bago new data 
                            // Check muna kung may laman ba yung "$valuesToInsertStorage"
                            if(empty($valuesToInsertStorage)) {
                                // pag walang laman o nakuha section sa last schoolyear
                                foreach ($newGradeLevel as $key => $gradeLevel) {
                                    $section = $newSection[$key];
                
                                    // Insert Sections
                                    $sectionSql = "INSERT INTO sections (school_year, grade_level, section) 
                                    VALUES ('$newSchoolYear', '$gradeLevel', '$section')";
                                    //Update the Active school year (enrollment_status Database Table)
                                    $updateActiveSySql = "UPDATE `enrollment_status` SET `active_Schoolyear`='$newSchoolYear', `status` = 'Close'";
                                    
                                    $updateActiveSyQuery = mysqli_query($connection,$updateActiveSySql);
                                    $sectionQuery = mysqli_query($connection, $sectionSql);
                
                                    if (!$sectionQuery && !$updateActiveSyQuery) {
                                        echo 'Section/activeSy query failed: ' . mysqli_error($connection);
                                    } else {
                                        echo 'success';
                                    }
                                }
                            }else {
                                $firstPastSectionSql = "INSERT INTO sections (school_year, grade_level, section) 
                                VALUES  " . implode(',', $valuesToInsertStorage);
                                $firstPastSectionQuery = mysqli_query($connection,$firstPastSectionSql);

                                if($firstPastSectionQuery)
                                {
                                    // Pag na insert na mga past gradelvl at section, yung new sec at lvl naman na user input
                                    foreach ($newGradeLevel as $key => $gradeLevel) {
                                        $section = $newSection[$key];
                    
                                        // Insert Sections
                                        $sectionSql = "INSERT INTO sections (school_year, grade_level, section) 
                                        VALUES ('$newSchoolYear', '$gradeLevel', '$section')";
                                        // Insert Past subjects
                                        $subjectSql = "INSERT INTO subjects (school_year, subject_name) 
                                        SELECT '$newSchoolYear', subject_name
                                        FROM subjects
                                        GROUP BY subject_name";

                                        //Update the Active school year (enrollment_status Database Table)
                                        $updateActiveSySql = "UPDATE `enrollment_status` SET `active_Schoolyear`='$newSchoolYear', `status` = 'Close'";
                                        
                                        $updateActiveSyQuery = mysqli_query($connection,$updateActiveSySql);
                                        $sectionQuery = mysqli_query($connection, $sectionSql);
                                        $subjectQuery = mysqli_query($connection,$subjectSql);
                    
                                        if (!$sectionQuery && !$updateActiveSyQuery && !$subjectQuery) {
                                            echo 'Section/activeSy query failed: ' . mysqli_error($connection);
                                        } else {
                                            echo 'success';
                                        }
                                    }
                    
                                } else {
                                    echo 'School year query failed: ' . mysqli_error($connection);
                                    // exit();
                                }
                            }
                        
            
                        mysqli_close($connection);
                        }else {
                            echo $firstpastSySQuery.'Failed';
                            // exit();
                        }
                }else {
                    echo $firstpastSySql.'Failed';
                    // exit();
                }

        } else {
            // Pag School year lang ininput

            $schoolYearOnly = $_POST['newSchoolYear'];
            $valuesToInsert = array(); //Lalagyan ng past section

            $pastSySql = "SELECT * FROM sections GROUP BY section";
            $pastSyQuery = mysqli_query($connection,$pastSySql);

            if($pastSyQuery)
            {
                while($pastSyData = mysqli_fetch_assoc($pastSyQuery))
                {
                    // Sa Sy, yung New Sy na lalagay
                    $pastGradeLevel = $pastSyData['grade_level'];
                    $pastSection = $pastSyData['section'];

                    $valuesToInsert[] = "('$schoolYearOnly', '$pastGradeLevel', '$pastSection')";
                }

                if(isset($valuesToInsert) && !empty($valuesToInsert)){

                    $schoolYearOnlySql = "INSERT INTO school_year (school_year) 
                    VALUES ('$schoolYearOnly')";
                    // Insert values into the sections table
                    $insertPastSectionQuery = "INSERT INTO sections (school_year, grade_level, section) VALUES " . implode(',', $valuesToInsert);
                    //Update the Active school year (enrollment_status Database Table)
                    $setActiveSy = "UPDATE `enrollment_status` SET `active_Schoolyear`='$schoolYearOnly', `status` = 'Close'";
                    // Insert Past subjects
                    $subject_Sql = "INSERT INTO subjects (school_year, subject_name) 
                    SELECT '$schoolYearOnly', subject_name
                    FROM subjects
                    GROUP BY subject_name";

                    $setActiveSyQuery = mysqli_query($connection,$setActiveSy);
                    $schoolYearOnlyQuery = mysqli_query($connection, $schoolYearOnlySql);
                    $pastSchoolYearOnlyQuery = mysqli_query($connection, $insertPastSectionQuery);
                    $subject_Query = mysqli_query($connection, $subject_Sql);

    
                    if($schoolYearOnlyQuery && $pastSchoolYearOnlyQuery && $setActiveSyQuery && $subject_Query){
                        echo 'success';
                    }else{
                        echo 'query failed.';
                    }
                }else{
                    echo 'No Values';
                }

            }

        }
        
    }


?>