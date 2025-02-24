<?php

    // Include the database connection and session
    require('../../includes/session.php');
    require('../fpdf/fpdf.php');

    // Create a new PDF instance
    $pdf = new FPDF('L', 'mm', 'Legal'); // Landscape, Legal Paper
    $pdf->AddPage();

    // READ ME FIRST:
    // - up to 337mm


    // NIBT HEADER START

    // NIBT LOGO
    $pdf->Image('../../assets/img/nibt-transparent.png', 55, 7, 20, 20, 'PNG');

    // TESDA LOGO
    $pdf->Image('../../assets/img/tesda-logo.png', 285, 7, 20, 20, 'PNG');

    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(118, 8, 11);
    $pdf->Cell(340, 5, 'NORTHRIDGE INSTITUTE OF BUSINESS AND TECHNOLOGY', 0, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(340, 5, 'LAS PINAS CAMPUS', 0, 1, 'C');

    $pdf->Cell(340, 5, '211 Venus Street, Moonwalk Village Phase 2, Barangay Talon Singko, Las Pinas City 1747', 0, 1, 'C');
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(340, 5, '', 0, 1, 'C');  // spacing

    $pdf->Cell(112, 5, 'TEXT: NIBT-LPCNIBT-LPC', 0, 0, 'C');
    $pdf->Cell(112, 5, 'TEXT: NIBT-LPCNIBT-LPC', 0, 0, 'C');
    $pdf->Cell(112, 5, 'TEXT: NIBT-LPCNIBT-LPC', 0, 1, 'C');

    $pdf->Cell(112, 5, 'TEXT: NIBT-LPCNIBT-LPC', 0, 0, 'C');
    $pdf->Cell(112, 5, 'TEXT: NIBT-LPCNIBT-LPC', 0, 0, 'C');
    $pdf->Cell(112, 5, 'TEXT: NIBT-LPCNIBT-LPC', 0, 1, 'C');

    $pdf->SetFont('times', 'B', 11);
    $pdf->Cell(340, 5, '', 0, 1, 'C');  // spacing
    $pdf->Cell(340, 5, 'LIST OF SCHOLARS', 0, 1, 'C');
    $pdf->Cell(340, 5, '', 0, 1, 'C');  // spacing
    $pdf->Cell(340, 5, 'Note: TABLE HEADERS ARE NOT FINAL', 0, 1, 'C');


    // TABLE START
    // Column widths for table (A4 sum = 277mm to fit within margins)

    $widths = [8, 35, 90, 40, 23, 23, 23, 60, 34]; // Adjusted to keep the right border aligned
    $pdf->SetFont('Arial', 'B', 8);
    // $pdf->SetTextColor(255, 255, 255);
    // TABLE HEADER
    $headers = ['No.', 'Full Name', 'Address', 'Email', 'Contact', 'FB', 'Messenger', 'Enrolled', 'Timestamp'];

    // Set header background color
    $pdf->SetFillColor(255, 255, 255); // Gray background for headers

    // Print the table headers
    foreach ($headers as $i => $header) {
        $pdf->Cell($widths[$i], 8, $header, 1, 0, 'C', true);
    }
    $pdf->Ln(); // New line after headers
    $pdf->SetFont('Arial', '', 8);

    // nibt database Query to fetch student data
    $query = "SELECT create_datetime, stud_id, lastname, firstname, middleinitial, email, contact, fb_account, fb_mess, num_street, barangay, district, addmunicity FROM tbl_students WHERE enroll_status_id = '1'";
    $result = mysqli_query($conn, $query);
                            
    // Check if the query was successful and if there are results
    if ($result) {
        $counter = 1;
        $cellWidth = 8;
        $cellHeight = 4;

 

        while ($row = mysqli_fetch_assoc($result)) {
            
            // Print the sequential number in the first cell
            $pdf->Cell($widths[0], 4, $counter, 1, 0, 'C');
            // Print each student's data
            // $pdf->Cell($widths[0], 4, $row['stud_id'], 1, 0, 'C');
            $pdf->Cell($widths[1], 4, $row['lastname'] . ', ' . $row['firstname'] . ', ' . $row['middleinitial'], 1, 0, 'C');
            $pdf->Cell($widths[2], 4, $row['num_street']. ', ' . $row['barangay'] . ', '. $row['addmunicity'], 1, 0, 'C');
            $pdf->Cell($widths[3], 4, $row['email'], 1, 0, 'C');
            $pdf->Cell($widths[4], 4, $row['contact'], 1, 0, 'C');
            $pdf->Cell($widths[5], 4, $row['fb_account'], 1, 0, 'C');
            $pdf->Cell($widths[6], 4, $row['fb_mess'], 1, 0, 'C');
            $pdf->Cell($widths[7], 4, "test 1", 1, 0, 'C');
            $pdf->Cell($widths[8], 4, $row['create_datetime'], 1, 0, 'C');
            $pdf->Ln(); // New line for next student

            // Increment the counter
            $counter++;
        }

        
    } 

    // Force move as footer
    $pdf->SetY(175); 
    
    $pdf->Cell(336, 5, '', 0, 1, 'C'); // spacing
    $pdf->Cell(112, 5, '____________________________', 0, 0, 'C');
    $pdf->Cell(112, 5, '____________________________', 0, 0, 'C'); 
    $pdf->Cell(112, 5, '____________________________', 0, 1, 'C');

    $pdf->SetFont('times', 'UB', 11);
    $pdf->Cell(112, 5, 'FIRST NAME, MIDDLE NAME, M.I', 0, 0, 'C');
    $pdf->Cell(112, 5, 'FIRST NAME, MIDDLE NAME, M.I', 0, 0, 'C');
    $pdf->Cell(112, 5, 'FIRST NAME, MIDDLE NAME, M.I', 0, 1, 'C');
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(112, 5, 'Trainor, M.I', 0, 0, 'C');
    $pdf->Cell(112, 5, 'School Admin?', 0, 0, 'C');
    $pdf->Cell(112, 5, '"School Title"', 0, 0, 'C');


    // $pdf->Rect(16, 69, 182, 10); // box

    // $pdf->AddPage();

    // Output the PDF
    $pdf->Output();

?>