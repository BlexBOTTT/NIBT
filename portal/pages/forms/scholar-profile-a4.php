<?php

require('../fpdf/fpdf.php');
require '../../includes/conn.php';

// Get student ID from the URL
$stud_id = isset($_GET['stud_id']) ? intval($_GET['stud_id']) : 0;

if ($stud_id > 0) {
    // Fetch student data from the database
    $query = "SELECT tbl_students.*, 
                 tbl_extension_name.ext_name,
                 tbl_courses.course_name
          FROM tbl_students
          LEFT JOIN tbl_extension_name ON tbl_students.ext_name_id = tbl_extension_name.ext_name_id
            LEFT JOIN tbl_courses ON tbl_students.course_id = tbl_courses.course_id
          WHERE tbl_students.stud_id = '$stud_id'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        class PDF extends FPDF {
            function SetDash($black=null, $white=null) {
                if($black!==null)
                    $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
                else
                    $s='[] 0 d';
                $this->_out($s);
            }
        }

        $pdf = new PDF('P', 'mm', 'A4');
        //left top right
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
        

        $pdf->SetLineWidth(0.1);
        $pdf->SetDash(1,3); //5mm on, 5mm off
        $pdf->Line(105, 0, 105, 297); // Draws a vertical line down the center of an A4 page
        $pdf->Line(0, 148.5, 210, 148.5); // Horizontal center line (Y = 148.5)
        
        $pdf->SetDash(); // restores no dash and default to line
        $pdf->SetLineWidth(0); // default line thickness



        // Logo(x axis, y axis, height, width)
        // $pdf->Image('../../img/SFAC-logo1.jpg', 45, 8, 15, 15);
        // text color
        $pdf->SetTextColor(0, 0, 0);
        // font(font type,style,font size)
        // Dummy cell
        $pdf->Cell(50);


        $pdf->Ln(3);
        $pdf->SetTextColor(0, 0, 0);

  

        $margin = 10; // 0.5 inch in mm
        $page_width = 210;
        $page_height = 297;
        
        
        $usable_width = $page_width - ($margin * 2);
        $usable_height = $page_height - ($margin * 2);
        
        $pdf->Rect($margin, $margin, $usable_width, $usable_height); // Full-height box with 0.5-inch margins
        
        // header tesda top divider
        $pdf->Rect($margin, $margin, $usable_width, 15);
        //cell(width,height,text,border,end line,[align])
        
        $pdf->Rect($margin, $margin, 30, 15);
        

        $pdf->Cell(63.33, 5, '', 0, 0, 'C');    // tesda logo
        $pdf->SetFont('times', 'B', 11);

        $pdf->Cell(63.33, 5, 'Technical Education and Skills Development Authority', 0, 0, 'C');
        $pdf->Cell(58.33, 5, 'MIS 03-01', 0, 1, 'R');

        $pdf->Rect(170, $margin, 30, 15);

        $pdf->Cell(63.33, 5, '', 0, 0, 'C');    // tesda logo
        $pdf->SetFont('times', '', 11);
        $pdf->Cell(63.33, 5, 'Pangasiwaan sa Edukasyong Teknikal at Pagpapaunlad ng Kasanayan', 0, 0, 'C');
        $pdf->SetFont('times', 'B', 11);
        $pdf->Cell(60.33, 5, 'Version 2020', 0, 1, 'R');

        // header tesda top divider
        $pdf->Ln(5);
        $pdf->Rect($margin, 25, $usable_width, 11);
        $pdf->SetFont('arial', 'B', 20);
        $pdf->Cell(190, 5, 'REGISTRATION FORM', 0, 0, 'C');


        $pdf->Ln(20);
        $pdf->SetFont('arial', 'B', 15);
        $pdf->Cell(150, 5, 'LEARNERS PROFILE FORM', 0, 0, 'C');
        $pdf->SetFont('arial', '', 11);
        $pdf->Cell(30, 5, '1x1 ID Picture', 0, 1, 'R');

        // Convert BLOB to an actual image file
        $imageData = $row['img']; // Assuming this is binary BLOB data from DB
        $tempFile = tempnam(sys_get_temp_dir(), 'img_') . '.jpg'; // Create temp file
        file_put_contents($tempFile, $imageData); // Save binary data as a file
        // Set the specific X and Y position
        $x = 160;  // Adjust for horizontal position
        $y = 38;   // Adjust for vertical position
        $width = 35;  // Force width (ID picture size)
        $height = 26; // Force height (ID picture size)
        // Insert image into PDF at the exact (X, Y) position with forced width & height
        $pdf->Image($tempFile, $x, $y, $width, $height); // X, Y, Width, Height
        unlink($tempFile); // Delete temp file after use
        // Draw the bounding box for ID picture
        $pdf->Rect(160, 38, $width, $height); // Ensures image is within the box
        
        $pdf->Ln(14);
        $pdf->Rect($margin, 66, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell($margin, 5, '1. T2MIS Auto Generated', 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(55, 2, '1.1. Unique Learner Identifier', 0, 1, 'C');

        $pdf->SetFont('arial', '', 7);
        $pdf->Cell(100, 5, '                (ULI Number)', 0, 0, 'L');
        
        $pdf->Rect(70, 73, 5, 9);
        $pdf->Rect(75, 73, 5, 9);
        $pdf->Rect(80, 73, 5, 9);
        $pdf->Rect(85, 73, 5, 9);
        $pdf->Rect(90, 73, 5, 9);
        $pdf->Rect(95, 73, 5, 9);
        $pdf->Rect(100, 73, 5, 9);
        $pdf->Rect(105, 73, 5, 9);
        $pdf->Rect(110, 73, 5, 9);
        $pdf->Rect(105, 73, 5, 9);
        $pdf->Rect(110, 73, 5, 9);
        $pdf->Rect(115, 73, 5, 9);
        $pdf->Rect(120, 73, 5, 9);
        $pdf->Rect(125, 73, 5, 9);
        $pdf->Rect(130, 73, 5, 9);
        $pdf->Rect(135, 73, 5, 9);
        

        $pdf->Rect(160, 74, 35, 7);
        $pdf->Cell(50, 1, 'Entry Date:', 0, 0, 'R');
        $pdf->Cell(24, 1, 'mm/dd/yyyy', 0, 0, 'R');

        $pdf->Ln(6);
        $pdf->Rect($margin, 82, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell($margin, 5, '2. Learner/Manpower Profile', 0, 1, 'L');

       
        $pdf->Ln(3);
        $pdf->Rect($margin, 82, $usable_width, 55);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '2.1 Name', 0, 0, 'L');

        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(55, 5, $row['lastname'] . '          ' . $row['ext_name'], 0, 0, 'L');
        $pdf->Cell(55, 5, $row['firstname'], 0, 0, 'L');
        $pdf->Cell(50, 5, $row['middlename'], 0, 1, 'L');
        $pdf->Rect(39, 90, 50, 7);
        $pdf->Rect(94, 90, 50, 7);
        $pdf->Rect(149, 90, 50, 7);
        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Last Name, Extension Name', 0, 0, 'L');
        $pdf->Cell(55, 5, 'First Name', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Middle Name', 0, 1, 'L');
        
        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '2.2 Address', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(55, 5, $row['num_street'], 0, 0, 'L');
        $pdf->Cell(55, 5, $row['barangay'], 0, 0, 'L');
        $pdf->Cell(50, 5, $row['district'], 0, 1, 'L');
        $pdf->Rect(39, 102, 50, 7);
        $pdf->Rect(94, 102, 50, 7);
        $pdf->Rect(149, 102, 50, 7);
        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Number & Street', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Barangay', 0, 0, 'L');
        $pdf->Cell(50, 5, 'District', 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(55, 5, $row['addmunicity'], 0, 0, 'L');
        $pdf->Cell(55, 5, 'MISSING PROVINCE', 0, 0, 'L');
        $pdf->Cell(50, 5, $row['region'], 0, 1, 'L');
        $pdf->Rect(39, 114, 50, 7);
        $pdf->Rect(94, 114, 50, 7);
        $pdf->Rect(149, 114, 50, 7);
        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->Cell(55, 5, 'City/Municipality', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Province', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Region', 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(55, 5, $row['email'], 0, 0, 'L');
        $pdf->Cell(55, 5, $row['contact'], 0, 0, 'L');
        $pdf->Cell(50, 5, 'MISSING NATIONALITY', 0, 1, 'L');
        $pdf->Rect(39, 126, 50, 7);
        $pdf->Rect(94, 126, 50, 7);
        $pdf->Rect(149, 126, 50, 7);
        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Email Address/FB', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Contact', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Nationality', 0, 0, 'L');




        


    

        // tapos na boi
        $pdf->Output();


    } else {
        echo "No student found.";
    }

} else{
    echo "The student ID is invalid";
    
}
