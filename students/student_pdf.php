<?php

// 190 TOTAL WIDTH, KASAMA NA DEFAULT MARGIN
    require '../database/dbcon.php';
    require '../fpdf/fpdf.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $studentId = $_GET['data_id'];
        $school_year = $_GET['school_year'];
        $gradeLevel = $_GET['gradeLevel'];
        $section = $_GET['section'];

        if($gradeLevel == '7'){
            $databaseTable = 'grade_seven';
        }elseif($gradeLevel == '8'){
            $databaseTable = 'grade_eight';
        }elseif($gradeLevel == '9'){
            $databaseTable = 'grade_nine';
        }elseif($gradeLevel == '10'){
            $databaseTable = 'grade_ten';
        }

        $sql = "SELECT * FROM $databaseTable WHERE id='$studentId'";
        $query = mysqli_query($connection,$sql);

        if($query) {

            if (mysqli_num_rows($query) > 0) {

                $data = mysqli_fetch_assoc($query);

                $studentType = $data['student_type'];
                $lrn = $data['lrn'];
                $dateEnrolled = $data['date_enrolled'];
                $school_year = $data['school_year'];
                $grade_level = $data['grade_level'];
                $student_Section = $data['section'];
                $name = $data['stud_fname'] . ', ' . $data['stud_lname'] . ' ' . $data['stud_mname'];
                $gender = $data['gender'];
                $age = $data['age'];
                $bday = $data['birth_date'];
                $birthPlace = $data['place_of_birth'];
                $mother_tongue = $data['mother_tongue'];
                // Address
                $region = $data['region'];
                $province = $data['province'];
                $city = $data['city'];
                $barangay = $data['barangay'];
                // father fullname
                $father_name = $data['father_fname'] . ', ' . $data['father_lname'] . ' ' . $data['father_mname'];
                $father_number = $data['father_number'];
                // mother fullname
                $mother_name = $data['mother_fname'] . ', ' . $data['mother_lname'] . ' ' . $data['mother_mname'];
                $mother_number = $data['mother_number'];
                // legal guardian full name
                $legal_guardian = $data['guardian_lname'] . ', ' . $data['guardian_fname'] . ' ' . $data['guardian_mname'];
                $guardian_number = $data['guardian_number'];
                // FPDF CODES
                $pdf = new FPDF();

                // pdf size
                $pdf->AddPage('P','A4');
                // font
                $pdf->SetFont('Courier','B',18);
                // background image
                $pdf->Image('../img/pdfbg.png',50,80,120,120);

                // Layout (HEADER)
                $pdf->Image('../img/mainlogo.png',10,8,30,30);
                $pdf->Cell(0,6,'',0,1);
                $pdf->Cell(0,13,'KAPITANGAN NATIONAL HIGHSCHOOL',0,1,'C');
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(0,0,'082 Purok 3, Kapitangan, Paombong, Bulacan',0,1,'C');

                $pdf->SetFont('Courier','B',18);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->MultiCell(20,20,'',0,'C',false);
                $pdf->MultiCell(0,15,'Sutdent Information',1,'C',true);

                // LRN and DATE ENROLLED
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(15, 8, 'LRN: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(100, 8, $lrn, '', 0, 'L');
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(43, 8, 'Date Enrolled: ', '', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $dateEnrolled, 'R', 1, 'L');

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(43, 8, 'Student type: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $studentType, 'R', 1, 'L');
                
                // Second Row SUTDENT NAME and GENDER
                $pdf->SetFont('Courier', 'B', 13); // Set the font style to bold for "Student Name"
                $pdf->Cell(15, 8, 'Name: ', 'L', 0, 'L'); // Display "Student Name" in bold and specify a width
                $pdf->SetFont('Courier', '', 13); // Reset the font style to regular
                $pdf->Cell(135, 8, $name, '', 0, 'L'); // Display $name in regular font and go to the next line
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(20, 8, 'GENDER: ', '', 0, 'L');
                $pdf->SetFont('Courier', '', 13); 
                $pdf->Cell(20, 8, $gender, 'R', 1, 'L');

                // GRADE LEVEL AND SECTION
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(68, 8, 'Grade Level and Section: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $grade_level.' - '.$student_Section, 'R', 1, 'L'); 

                // BIRTHDAY AND AGE
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(30, 8, 'Birth Date: ', 'LTB', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(80, 8, $bday, 'TB', 0, 'L'); 
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(13, 8, 'AGE: ', 'TB', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $age, 'TBR', 1, 'L');
                
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(44, 8, 'Place of Birth: ', 'TBL', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(50, 8, $birthPlace, 'TBR', 0, 'L');

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(44, 8, 'Mother Tongue: ', 'TBL', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $mother_tongue, 'TBR', 1, 'L');

                // ADDRESS
                $pdf->SetFont('Courier','B',18);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->MultiCell(20,0,'',0,'C',false);
                $pdf->MultiCell(0,15,'Address',1,'C',true);

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(30, 8, 'Region: ', 'TL', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $region, 'TR', 1, 'L');

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(30, 8, 'Province: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $province, 'R', 1, 'L');

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(30, 8, 'City: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $city, 'R', 1, 'L');

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(30, 8, 'Barangay: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $barangay, 'R', 1, 'L');

                // Parent's and Guardian
                $pdf->SetFont('Courier','B',18);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->MultiCell(20,0,'',0,'C',false);
                $pdf->MultiCell(0,15,"Parent's and Legal Guardian information",1,'C',true);

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(35, 8, 'Mother Name: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(103, 8, $mother_name, '', 0, 'L');
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(20, 8, 'Number: ', '', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $mother_number, 'R', 1, 'L');

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(35, 8, 'Father Name: ', 'L', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(103, 8, $father_name, '', 0, 'L');
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(20, 8, 'Number: ', '', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $father_number, 'R', 1, 'L');

                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(54, 8, 'Legal Guardian Name:', 'LB', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(84, 8, $legal_guardian, 'B', 0, 'L');
                $pdf->SetFont('Courier', 'B', 13); 
                $pdf->Cell(20, 8, 'Number: ', 'B', 0, 'L'); 
                $pdf->SetFont('Courier', '', 13);
                $pdf->Cell(0, 8, $guardian_number, 'RB', 1, 'L');

                // IF RETURNEE OR TRANSFEREE
                if($studentType == 'Returning' || $studentType == 'Transferee') {
                    $pdf->SetFont('Courier','B',18);
                    $pdf->SetFillColor(153, 215, 240);
                    $pdf->MultiCell(20,0,'',0,'C',false);
                    $pdf->MultiCell(0,15,"Transferee / Returnee Information",1,'C',true);

                    $pdf->SetFont('Courier', 'B', 13); 
                    $pdf->Cell(80, 8, 'Last grade level completed: ', 'LB', 0, 'L'); 
                    $pdf->SetFont('Courier', '', 13);
                    $pdf->Cell(0, 8, $data['last_grade_level'], 'BR', 1, 'L');
                    $pdf->SetFont('Courier', 'B', 13); 

                    $pdf->Cell(80, 8, 'Last school year completed: ', 'LB', 0, 'L'); 
                    $pdf->SetFont('Courier', '', 13);
                    $pdf->Cell(0, 8, $data['last_School_year'], 'BR', 1, 'L');
                    $pdf->SetFont('Courier', 'B', 13); 

                    $pdf->Cell(60, 8, 'Last school attended: ', 'LB', 0, 'L'); 
                    $pdf->SetFont('Courier', '', 13);
                    $pdf->Cell(0, 8, $data['last_school'], 'BR', 1, 'L');



                }

            }else {
                // PAG ERROR OR WALA NAHANAP
                echo 'bads';
            }

            // OUTPUT
            $pdf->Output();

        }

    }

?>