<?php

// Include the database connection and session
require('../../includes/session.php');
require('../fpdf/fpdf.php');

// Create a new PDF instance
$pdf = new FPDF('L', 'mm', 'Legal'); // Landscape, Legal Paper
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

// Column widths (sum = 277mm to fit within margins)
$widths = [25, 35, 35, 35, 90, 20, 37]; // Adjusted to keep the right border aligned

$pdf->Cell(102, 9, 'NORTHRIDGE INSTITUTE OF BUSINESS AND TECHNOLOGY', 0, 1, 'C');
$pdf->SetFont('times', '', 10);  // Regular Arial, size 10
$pdf->Cell(100, 9, '211 Venus Street, Moonwalk Village Phase 2, Barangay Talon Singko, Las Pinas City 1747', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$headers = ['Student ID', 'Last Name', 'First Name', 'Middle Name', 'Email', 'Enrolled', 'Remarks'];

// Set header background color
$pdf->SetFillColor(200, 200, 200); // Gray background for headers

// Print the table headers
foreach ($headers as $i => $header) {
    $pdf->Cell($widths[$i], 8, $header, 1, 0, 'C', true);
}
$pdf->Ln(); // New line after headers

$pdf->SetFont('Arial', '', 10);



// Query to fetch student data
$query = "SELECT stud_id, lastname, firstname, middlename, email FROM tbl_students";
$result = mysqli_query($conn, $query);

// Check if the query was successful and if there are results
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Print each student's data
        $pdf->Cell($widths[0], 8, $row['stud_id'], 1, 0, 'C');
        $pdf->Cell($widths[1], 8, $row['lastname'], 1, 0, 'C');
        $pdf->Cell($widths[2], 8, $row['firstname'], 1, 0, 'C');
        $pdf->Cell($widths[3], 8, $row['middlename'], 1, 0, 'C');
        $pdf->Cell($widths[4], 8, $row['email'], 1, 0, 'C');
        $pdf->Ln(); // New line for next student
    }
} else {
    // If the query fails, output an error message
    $pdf->Cell(0, 8, 'Error fetching student data.', 1, 0, 'C');
}

// Output the PDF
$pdf->Output();
?>
