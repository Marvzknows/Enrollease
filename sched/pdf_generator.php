<?php
// schedule_pdf.php
include '../fpdf/fpdf.php';
include '../database/dbcon.php';

// NOTE : PAG DI KASYA ANG IADJUST NALANG SIZE NG MGA DATA (TIME,SECTION,SUBJECT) OR GAWING TLE NALANG YUNG TECH LIVELIHOOD

// Check if both data_id and school_year are set in the URL parameters
if (isset($_GET['data_id']) && isset($_GET['school_year'])) {
    // Retrieve the teacher_id and school_year from the URL parameters
    $teacher_id = $_GET['data_id'];
    $school_year = $_GET['school_year'];

    // Getting Teacher's Name Query
    $sql_teacher = "SELECT * FROM teacher_acc WHERE teacher_id ='$teacher_id'";
    $query_teacher = mysqli_query($connection, $sql_teacher);

    // Check Data that passed from URL, (pag minanipulate sa URL yung data itong code ang validation)
    if ($checkData = mysqli_num_rows($query_teacher) > 0) {

        $data = mysqli_fetch_assoc($query_teacher);
        $teacher_name = $data['first_name'] . ' ' . $data['last_name'];

        // Getting Data Query
        $sql_monday = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Monday' ORDER BY start_time  ASC";
        $query_monday = mysqli_query($connection, $sql_monday);

        $sql_tue = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Tuesday' ORDER BY start_time  ASC";
        $query_tuesday = mysqli_query($connection, $sql_tue);

        $sql_wed = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Wednesday' ORDER BY start_time  ASC";
        $query_wednesday = mysqli_query($connection, $sql_wed);

        $sql_thurs = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Thursday' ORDER BY start_time  ASC";
        $query_thursday = mysqli_query($connection, $sql_thurs);

        $sql_fri = "SELECT * FROM teacher_schedule WHERE teacher_id ='$teacher_id' AND school_year='$school_year' AND day='Friday' ORDER BY start_time  ASC";
        $query_friday = mysqli_query($connection, $sql_fri);

        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage('L', 'A3');
        $pdf->SetFont('Arial', 'B', 20);

        $pdf->Image('../img/mainlogo.png', 25, 8, 45, 45);
        $pdf->Cell(0, 6, '', 0, 1);
        $pdf->Cell(0, 13, 'KAPITANGAN NATIONAL HIGHSCHOOL', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 0, '082 Purok 3, Kapitangan, Paombong, Bulacan', 0, 1, 'C');
        $pdf->Cell(0, 10, 'School year: ' . $school_year, 0, 1, 'C');
        $pdf->Cell(0, 20, '', 0, 1);

        // teacher id
        $pdf->SetFont('Arial', '', 20);
        $pdf->Cell(40, 10, "Teacher ID : ", 0, 0, 'L', false);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->MultiCell(0, 10, "$teacher_id", '', 1, false);
        // teacher name
        $pdf->SetFont('Arial', '', 20);
        $pdf->Cell(55, 10, "Teacher Name : ", 0, 0, 'L', false);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 10, "$teacher_name", 0, 1, false);

        if (mysqli_num_rows($query_monday) > 0 || mysqli_num_rows($query_tuesday) > 0 || mysqli_num_rows($query_wednesday) > 0 || mysqli_num_rows($query_thursday) > 0 || mysqli_num_rows($query_friday) > 0) {
            // MAIN CONTAINER
            // $pdf->Cell(0,500,'test','LRTB',0,false);
            // MONDAY
            if (mysqli_num_rows($query_monday) > 0) {
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'MONDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'Time', 'LTRB', 'L', true);
                $pdf->SetXY(30, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(60, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);

                while ($monday = mysqli_fetch_assoc($query_monday)) {

                    // Convert start_time to 12-hour format
                    $start_time_12h = date("h:i A", strtotime($monday['start_time']));

                    // Convert end_time to 12-hour format
                    $end_time_12h = date("h:i A", strtotime($monday['end_time']));

                    $pdf->SetFont('Arial', '', 13);
                    $pdf->MultiCell(78, 10, $start_time_12h . ' - ' . $end_time_12h .
                        '   /   ' . $monday['subject'] .
                        '   /   ' . $monday['section'], 1, false);
                }
            } else {
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'MONDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'Time', 'LTRB', 'L', true);
                $pdf->SetXY(30, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(60, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);
                // 
                // $pdf->SetXY(88, 93);
                $pdf->MultiCell(78, 160, 'NO SCHEDULE', '', 'C', false);
            }

            // TUESDAY
            if (mysqli_num_rows($query_tuesday) > 0) {
                // SETTING TUESDAY OUT PUT BESIDE MONDAY OUTPUT
                $pdf->SetXY(88, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'TUESDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(88, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(108, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(138, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);

                while ($tuesday = mysqli_fetch_assoc($query_tuesday)) {

                    // Convert start_time to 12-hour format
                    $start_time_12h = date("h:i A", strtotime($tuesday['start_time']));

                    // Convert end_time to 12-hour format
                    $end_time_12h = date("h:i A", strtotime($tuesday['end_time']));
                    $pdf->SetX(88);
                    // $pdf->SetXY(88,93);
                    $pdf->SetFont('Arial', '', 13);
                    $pdf->MultiCell(78, 10, $start_time_12h . ' - ' . $end_time_12h .
                        '   /   ' . $tuesday['subject'] .
                        '   /   ' . $tuesday['section'], 1, false);
                }
            } else {
                $pdf->SetXY(88, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'TUESDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(88, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(108, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(138, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);
                // 
                $pdf->SetXY(88, 93);
                $pdf->MultiCell(78, 160, 'NO SCHEDULE', '', 'C', false);
            }

            // WENDESDAY
            if (mysqli_num_rows($query_wednesday) > 0) {
                // SETTING TUESDAY OUT PUT BESIDE MONDAY OUTPUT
                $pdf->SetXY(166, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'WEDNESDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(166, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(186, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(216, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);

                while ($wednesday = mysqli_fetch_assoc($query_wednesday)) {

                    // Convert start_time to 12-hour format
                    $start_time_12h = date("h:i A", strtotime($wednesday['start_time']));

                    // Convert end_time to 12-hour format
                    $end_time_12h = date("h:i A", strtotime($wednesday['end_time']));
                    $pdf->SetX(166);
                    // $pdf->SetXY(166,93);
                    $pdf->SetFont('Arial', '', 13);
                    $pdf->MultiCell(78, 10, $start_time_12h . ' - ' . $end_time_12h .
                        '   /   ' . $wednesday['subject'] .
                        '   /   ' . $wednesday['section'], 1, false);
                }
            } else {
                $pdf->SetXY(166, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'WEDNESDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(166, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(186, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(216, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);
                // 
                $pdf->SetXY(166, 93);
                $pdf->MultiCell(78, 160, 'NO SCHEDULE', '', 'C', false);
            }

            // THURSDAY
            if (mysqli_num_rows($query_thursday) > 0) {
                // SETTING TUESDAY OUT PUT BESIDE MONDAY OUTPUT
                $pdf->SetXY(244, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'THURSDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(244, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(264, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(294, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);

                while ($thursday = mysqli_fetch_assoc($query_thursday)) {

                    // Convert start_time to 12-hour format
                    $start_time_12h = date("h:i A", strtotime($thursday['start_time']));

                    // Convert end_time to 12-hour format
                    $end_time_12h = date("h:i A", strtotime($thursday['end_time']));
                    $pdf->SetX(244);
                    // $pdf->SetXY(244,93);
                    $pdf->SetFont('Arial', '', 13);
                    $pdf->MultiCell(78, 10, $start_time_12h . ' - ' . $end_time_12h .
                        '   /   ' . $thursday['subject'] .
                        '   /   ' . $thursday['section'], 1, false);
                }
            } else {
                $pdf->SetXY(244, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'THURSDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(244, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(264, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(294, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);
                // 
                $pdf->SetXY(244, 93);
                $pdf->MultiCell(78, 160, 'NO SCHEDULE', '', 'C', false);
            }

            // FRIDAY
            if (mysqli_num_rows($query_friday) > 0) {
                // SETTING TUESDAY OUT PUT BESIDE MONDAY OUTPUT
                $pdf->SetXY(322, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'FRIDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(322, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(342, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(372, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);

                while ($friday = mysqli_fetch_assoc($query_friday)) {

                    // Convert start_time to 12-hour format
                    $start_time_12h = date("h:i A", strtotime($friday['start_time']));

                    // Convert end_time to 12-hour format
                    $end_time_12h = date("h:i A", strtotime($friday['end_time']));
                    $pdf->SetX(322);
                    // $pdf->SetXY(322, 93);
                    $pdf->SetFont('Arial', '', 13);
                    $pdf->MultiCell(78, 10, $start_time_12h . ' - ' . $end_time_12h .
                        '   /   ' . $friday['subject'] .
                        '   /   ' . $friday['section'], 1, false);
                }
            } else {
                $pdf->SetXY(322, 79);

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetFillColor(153, 215, 240);
                $pdf->Cell(78, 10, 'FRIDAY', 1, 1, 'L', true);
                // HEADER
                $pdf->SetXY(322, 89);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetFillColor(211, 211, 211);
                $pdf->MultiCell(20, 4, 'TIME', 'LTRB', 'L', true);
                $pdf->SetXY(342, 89);
                $pdf->MultiCell(30, 4, 'SUBJECT', 'LTRB', 'L', true);
                $pdf->SetXY(372, 89);
                $pdf->MultiCell(28, 4, 'SECTION', 'LTRB', 'L', true);
                // 
                $pdf->SetXY(322, 93);
                $pdf->MultiCell(78, 160, 'NO SCHEDULE', '', 'C', false);
            }
        } else {
            $pdf->Cell(0, 10, 'EMPTY SCHEDULE', 1, 1, 'C');
        }

        $pdf->Output();
    } else {
        echo 'DATA NOT FOUND';
    }
} else {
    echo "Error: Missing data_id or school_year parameter.";
}
