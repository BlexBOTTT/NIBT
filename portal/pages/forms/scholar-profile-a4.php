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
        

        $pdf->Image('../../assets/img/tesda-logo.png', 18, 11, 13, 13);
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

        // LEARNER MANPOWER PROFILE START
        $pdf->Ln(6);
        $pdf->Rect($margin, 82, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell($margin, 5, '2. Learner/Manpower Profile', 0, 1, 'L');
        
        $pdf->Ln(3);
        $pdf->Rect($margin, 82, $usable_width, 56);
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
        // LEARNER MANPOWER PROFILE END

        // PERSONAL INFO START
        $pdf->Ln(6);
        $pdf->Rect($margin, 138, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell($margin, 5, '3. Personal Information', 0, 1, 'L');

        $pdf->Ln(3);
        $pdf->Rect($margin, 138, $usable_width, 43);

        $pdf->Rect($margin, 145, 63, 36);
        $pdf->Rect($margin, 145, 126, 36);
        $pdf->Rect($margin, 145, 190, 36);

        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(63, 5, '3.1 Sex', 0, 0, 'L');
        $pdf->Cell(63, 5, '3.2 Civil Status', 0, 0, 'L');
        $pdf->Cell(29, 5, '3.3 Employment status (before the training)', 0, 0, 'L');

        $pdf->Rect(25, 155, 3, 3);
        $pdf->Rect(25, 160, 3, 3);

        $pdf->Rect(85, 155, 3, 3);
        $pdf->Rect(85, 160, 3, 3);
        $pdf->Rect(85, 165, 3, 3);
        $pdf->Rect(85, 170, 3, 3);
        $pdf->Rect(85, 175, 3, 3);

        $pdf->Rect(145, 155, 3, 3);
        $pdf->Rect(145, 160, 3, 3);

        $pdf->Ln(7);
        
        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(60, 5, 'Male', 0, 0, 'L');
        $pdf->Cell(60, 5, 'Single', 0, 0, 'L');
        $pdf->Cell(60, 5, 'Employed', 0, 1, 'L');

        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(60, 5, 'Female', 0, 0, 'L');
        $pdf->Cell(60, 5, 'Married', 0, 0, 'L');
        $pdf->Cell(60, 5, 'Unmployed', 0, 1, 'L');

        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(60, 5, '', 0, 0, 'L');
        $pdf->Cell(60, 5, 'Widow/er', 0, 0, 'L');
        $pdf->Cell(60, 5, '', 0, 1, 'L');

        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(60, 5, '', 0, 0, 'L');
        $pdf->Cell(60, 5, 'Separated', 0, 0, 'L');
        $pdf->Cell(60, 5, '', 0, 1, 'L');

        $pdf->Cell(20, 5, '', 0, 0, 'C');
        $pdf->Cell(60, 5, '', 0, 0, 'L');
        $pdf->Cell(60, 5, 'Solo Parent', 0, 0, 'L');
        $pdf->Cell(60, 5, '', 0, 1, 'L');

        // PERSONAL INFO EMD

        // BIRTH DATE START
        $pdf->Ln(8);
        $pdf->Rect($margin, 181, $usable_width, 18);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell($margin, 4, '4. Birth Date', 0, 0, 'L');
        
        $pdf->Rect(60, 185, 30, 7);
        $pdf->Rect(95, 185, 30, 7);
        $pdf->Rect(130, 185, 30, 7);
        $pdf->Rect(165, 185, 30, 7);
        
        $pdf->Cell(40, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(35, 3, $row['birthdate'], 0, 0, 'L');
        $pdf->Cell(35, 3, $row['birthdate'], 0, 0, 'L');
        $pdf->Cell(35, 3, $row['birthdate'], 0, 0, 'L');
        $pdf->Cell(35, 3, "MISSING AGE", 0, 1, 'L');

        $pdf->Ln(3);
        $pdf->Cell(54, 3, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(36, 3, 'Month of Birth', 0, 0, 'L');
        $pdf->Cell(34, 3, 'Day of Birth', 0, 0, 'L');
        $pdf->Cell(42, 3, 'Year of Birth', 0, 0, 'L');
        $pdf->Cell(38, 3, 'Age', 0, 0, 'L');

        // BIRTH DATE START
        $pdf->Ln(8);
        $pdf->Rect($margin, 199, $usable_width, 18);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell($margin, 12, '5. Birth Place', 0, 0, 'L');
        
        $pdf->Ln(3);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(55, 5, $row['bpmunicity'], 0, 0, 'L');
        $pdf->Cell(55, 5, $row['bpprovince'], 0, 0, 'L');
        $pdf->Cell(50, 5, "MISSING BP-REGION", 0, 1, 'L');

        $pdf->Rect(39, 203, 50, 7);
        $pdf->Rect(94, 203, 50, 7);
        $pdf->Rect(149, 203, 50, 7);
        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->Cell(55, 5, 'City/Municipality', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Province', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Region', 0, 0, 'L');

        $pdf->Ln(8);
        $pdf->Rect($margin, 217, $usable_width, 7);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell($margin, 5, '3.6 Educational Attainment Before the Training (Trainee)', 0, 1, 'L');

        $pdf->Rect($margin, 224, 47.5, 30);
        $pdf->Rect($margin, 224, 95, 30);
        $pdf->Rect($margin, 224, 142.5, 30);
        $pdf->Rect($margin, 224, 190, 30);

        $pdf->Rect($margin, 234, $usable_width, 10);

        $pdf->Rect(12, 227, 3, 3);
        $pdf->Rect(12, 237, 3, 3);
        $pdf->Rect(12, 247, 3, 3);

        $pdf->Rect(59, 227, 3, 3);
        $pdf->Rect(59, 237, 3, 3);
        $pdf->Rect(59, 247, 3, 3);

        $pdf->Rect(107, 227, 3, 3);
        $pdf->Rect(107, 237, 3, 3);
        $pdf->Rect(107, 247, 3, 3);

        $pdf->Rect(154, 227, 3, 3);
        $pdf->Rect(154, 237, 3, 3);
        $pdf->Rect(154, 247, 3, 3);
        
        $pdf->Ln(3);

        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(47, 5, 'No Grade Completed', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Pre-School (Nursery/Kinder/Prep)', 0, 0, 'L');
        $pdf->Cell(48, 5, 'High School Undergraduate', 0, 0, 'L');
        $pdf->Cell(47, 5, 'High School Graduate', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(47, 5, 'Elementary Undergraduate', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Post Secondary Undergradate', 0, 0, 'L');
        $pdf->Cell(48, 5, 'College Undergraduate', 0, 0, 'L');
        $pdf->Cell(47, 5, 'College Graduate or Higher', 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(47, 5, 'Elementary Graduate', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Post Secondary Gradate', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Junior High Graduate', 0, 0, 'L');
        $pdf->Cell(47, 5, 'Senior High Graduate', 0, 1, 'L');


        // BIRTH DATE START END



        // tapos na boi
        $pdf->Output();


    } else {
        echo "No student found.";
    }

} else{
    echo "The student ID is invalid";
    
}
