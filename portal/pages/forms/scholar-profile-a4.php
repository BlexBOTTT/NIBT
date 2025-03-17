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
        // fully get the all usable 10mm bottom marjin
        $pdf->SetAutoPageBreak(false); 

        $pdf->AddPage();
        

        // $pdf->SetLineWidth(0.1);
        // $pdf->SetDash(1,3); //5mm on, 5mm off
        // $pdf->Line(105, 0, 105, 297); // Draws a vertical line down the center of an A4 page
        // $pdf->Line(0, 148.5, 210, 148.5); // Horizontal center line (Y = 148.5)
        
        // $pdf->SetDash(); // restores no dash and default to line
        // $pdf->SetLineWidth(0); // default line thickness



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
        $tempFile = tempnam(sys_get_temp_dir(), 'img_');

        // Check if the image is valid and get its MIME type
        $imageInfo = @getimagesizefromstring($imageData);
        if ($imageInfo === false) {
            // Handle error or skip adding image
            $pdf->Rect(160, 38, $width, $height); // Draw bounding box without image
        } else {
            // Save the image data as a file based on its MIME type
            $mimeType = $imageInfo['mime'];
            $ext = 'jpg'; // Default extension
            
            // Set the file extension based on MIME type
            if ($mimeType === 'image/png') {
                $ext = 'png';
            } elseif ($mimeType === 'image/jpeg') {
                $ext = 'jpg';
            }

            $tempFile .= '.' . $ext;
            file_put_contents($tempFile, $imageData); // Save binary data as a file

            // Set the specific X and Y position
            $x = 160;  // Adjust for horizontal position
            $y = 38;   // Adjust for vertical position
            $width = 35;  // Force width (ID picture size)
            $height = 26; // Force height (ID picture size)

            // Insert image into PDF at the exact (X, Y) position with forced width & height
            $pdf->Image($tempFile, $x, $y, $width, $height); // X, Y, Width, Height
            unlink($tempFile); // Delete temp file after use
        }

        // Draw the bounding box for ID picture (if image is added or not)
        $pdf->Rect(160, 38, $width, $height); // Ensures image is within the box
        

        $pdf->Image('../../assets/img/tesda-logo.png', 18, 11, 13, 13);
        $pdf->Ln(14);
        $pdf->Rect($margin, 66, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell($margin, 5, '1. T2MIS Auto Generated', 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(44, 2, '1.1. Unique Learner Identifier', 0, 0, 'C');
        
        $pdf->SetFont('arial', 'B', 15);

        // QBB-02-347-13076-001
        $uli = '';
        $spaced_uli = implode(' ', str_split($uli)); // Adds two spaces between characters
        $pdf->Cell(103, 4, $spaced_uli, 0, 0, 'L');

        $pdf->SetFont('arial', '', 7);
        $pdf->Cell(17, 5, 'Entry Date:', 0, 0, 'L');

        $pdf->SetFont('arial', '', 11);
        $pdf->Cell(20, 4, date('m/d/Y', strtotime($row['create_datetime'])), 0, 1, 'L');

        $pdf->SetFont('arial', '', 7);
        $pdf->Cell(8, 1, '', 0, 0, 'L');
        $pdf->Cell(141, 1, '(ULI Number)', 0, 0, 'L');
        
        
        
        $pdf->Rect(55, 73, 5, 9);
        $pdf->Rect(60, 73, 5, 9);
        $pdf->Rect(65, 73, 5, 9);

        $pdf->Rect(70, 73, 5, 9);

        $pdf->Rect(75, 73, 5, 9);
        $pdf->Rect(80, 73, 5, 9);

        $pdf->Rect(85, 73, 5, 9);

        $pdf->Rect(90, 73, 5, 9);
        $pdf->Rect(95, 73, 5, 9);
        $pdf->Rect(100, 73, 5, 9);

        $pdf->Rect(105, 73, 5, 9);

        $pdf->Rect(110, 73, 5, 9);
        $pdf->Rect(115, 73, 5, 9);
        $pdf->Rect(120, 73, 5, 9);
        $pdf->Rect(125, 73, 5, 9);
        $pdf->Rect(130, 73, 5, 9);
        
        $pdf->Rect(135, 73, 5, 9);

        $pdf->Rect(140, 73, 5, 9);
        $pdf->Rect(145, 73, 5, 9);
        $pdf->Rect(150, 73, 5, 9);
  

        

        $pdf->Rect(174, 74, 25, 7);
        // $pdf->Cell(80, 1, 'Entry Date:', 0, 0, 'L');
        // date and time to date only
        $pdf->SetFont('arial', '', 11);


        // LEARNER MANPOWER PROFILE START
        $pdf->Ln(4);
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
        $pdf->Cell(55, 5, $row['province'], 0, 0, 'L');
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
        $pdf->Cell(50, 5, $row['nationality'], 0, 1, 'L');
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
        
        // column borders
        $pdf->Rect($margin, 145, 63, 36);
        $pdf->Rect($margin, 145, 126, 36);
        $pdf->Rect($margin, 145, 190, 36);

        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(63, 5, '3.1 Sex', 0, 0, 'L');
        $pdf->Cell(63, 5, '3.2 Civil Status', 0, 0, 'L');
        $pdf->Cell(29, 5, '3.3 Employment status (before the training)', 0, 0, 'L');

        $pdf->Rect(25, 155, 3, 3);
        $pdf->Rect(25, 160, 3, 3);

        $gender_id_fill = isset($row['gender_id']) ? intval($row['gender_id']) : null;

        if ($gender_id_fill !== null) {
            switch ($gender_id_fill) {
                case 1: $pdf->Rect(25, 155, 3, 3, 'F'); break;
                case 2: $pdf->Rect(25, 160, 3, 3, 'F'); break;
         
                default: // Do nothing if no match break;
            }
        }

        $pdf->Rect(85, 155, 3, 3);
        $pdf->Rect(85, 160, 3, 3);
        $pdf->Rect(85, 165, 3, 3);
        $pdf->Rect(85, 170, 3, 3);
        $pdf->Rect(85, 175, 3, 3);

        $civilstatus_fill = isset($row['civil_status_id']) ? intval($row['civil_status_id']) : null;

        if ($civilstatus_fill !== null) {
            switch ($civilstatus_fill) {
                case 1: $pdf->Rect(85, 155, 3, 3, 'F'); break;
                case 2: $pdf->Rect(85, 160, 3, 3, 'F'); break;
                case 3: $pdf->Rect(85, 165, 3, 3, 'F'); break;
                case 4: $pdf->Rect(85, 170, 3, 3, 'F'); break;
                case 5: $pdf->Rect(85, 175, 3, 3, 'F'); break;

                default: // Do nothing if no    match break;
            }
        }

        $pdf->Rect(145, 155, 3, 3);
        $pdf->Rect(145, 160, 3, 3);

        $employment_id_fill = isset($row['employment_id']) ? intval($row['employment_id']) : null;

        if ($employment_id_fill !== null) {
            switch ($employment_id_fill) {
                case 1: $pdf->Rect(145, 155, 3, 3, 'F'); break;
                case 2: $pdf->Rect(145, 160, 3, 3, 'F'); break;
                default: // Do nothing if no    match break;
            }
        }

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

        

        // BIRTH DATE START
        $pdf->Ln(8);
        $pdf->Rect($margin, 181, $usable_width, 18);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell($margin, 4, '4. Birth Date', 0, 0, 'L');
        
        $pdf->Rect(60, 185, 30, 7);
        $pdf->Rect(95, 185, 30, 7);
        $pdf->Rect(130, 185, 30, 7);
        $pdf->Rect(165, 185, 30, 7);
        
        
        $pdf->SetFont('arial', 'B', 9);


        $birthdate = isset($row['birthdate']) ? strtotime($row['birthdate']) : null;
        $month = $birthdate ? date('F', $birthdate) : ''; // Full month name (e.g., January)
        $day = $birthdate ? date('d', $birthdate) : '';   // Day (e.g., 05)
        $year = $birthdate ? date('Y', $birthdate) : '';  // Year (e.g., 1999)

        $pdf->Cell(45, 5, '', 0, 0, 'L');
        $pdf->Cell(41, 3, $month, 0, 0, 'L'); // Display month
        $pdf->Cell(35, 3, $day, 0, 0, 'L');   // Display day
        $pdf->Cell(35, 3, $year, 0, 0, 'L');  // Display year
        $pdf->Cell(35, 3, $row['age'], 0, 1, 'L');

        $pdf->Ln(3);
        $pdf->Cell(54, 3, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(36, 3, 'Month of Birth', 0, 0, 'L');
        $pdf->Cell(34, 3, 'Day of Birth', 0, 0, 'L');
        $pdf->Cell(42, 3, 'Year of Birth', 0, 0, 'L');
        $pdf->Cell(38, 3, 'Age', 0, 0, 'L');

        // BIRTH PLACE START
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
        $pdf->Cell(50, 5, $row['bpregion'], 0, 1, 'L');

        $pdf->Rect(39, 203, 50, 7);
        $pdf->Rect(94, 203, 50, 7);
        $pdf->Rect(149, 203, 50, 7);
        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(29, 5, '', 0, 0, 'L');
        $pdf->Cell(55, 5, 'City/Municipality', 0, 0, 'L');
        $pdf->Cell(55, 5, 'Province', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Region', 0, 0, 'L');
        // BIRTH PLACE END

        // EDUC ATAIN START
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
        $pdf->Rect(59, 227, 3, 3);
        $pdf->Rect(107, 227, 3, 3);
        $pdf->Rect(154, 227, 3, 3);
        // row 2
       $pdf->Rect(12, 237, 3, 3);
        $pdf->Rect(59, 237, 3, 3);
        $pdf->Rect(107, 237, 3, 3);
        $pdf->Rect(154, 237, 3, 3);
        // row 3
        $pdf->Rect(12, 247, 3, 3);
        $pdf->Rect(59, 247, 3, 3);
        $pdf->Rect(107, 247, 3, 3);
        $pdf->Rect(154, 247, 3, 3);

        // Fill squares above depending on which attainment_id is fetched via educ_atttain dropdown
        $attainment_id = isset($row['attainment_id']) ? intval($row['attainment_id']) : null;

        if ($attainment_id !== null) {
            switch ($attainment_id) {
                // row 1
                case 1: $pdf->Rect(12, 227, 3, 3, 'F'); break;
                case 2: $pdf->Rect(59, 227, 3, 3, 'F'); break;
                case 3: $pdf->Rect(107, 227, 3, 3, 'F'); break;
                case 4: $pdf->Rect(154, 227, 3, 3, 'F'); break;
                // row 2
                case 5: $pdf->Rect(12, 237, 3, 3, 'F'); break;
                case 6: $pdf->Rect(59, 237, 3, 3, 'F'); break;
                case 7: $pdf->Rect(107, 237, 3, 3, 'F'); break;
                case 8: $pdf->Rect(154, 237, 3, 3, 'F'); break;
                // row 3
                case 9: $pdf->Rect(12, 247, 3, 3, 'F'); break;
                case 10: $pdf->Rect(59, 247, 3, 3, 'F'); break;
                case 11: $pdf->Rect(107, 247, 3, 3, 'F'); break;
                case 12:  $pdf->Rect(154, 247, 3, 3, 'F'); break;
                
                default: break;
            }
        }
        
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
        // EDUC ATTAIN END

        // PARENT-GUARDIAN START
        $pdf->Ln(8);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell($margin, 5, '3.6 Parent/Guardian', 0, 0, 'L');

        $pdf->Cell(22, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(52, 5, $row['cfullname'], 0, 0, 'L');
        $pdf->Cell(55, 5, '', 0, 0, 'L');
        $pdf->Cell(55, 5, $row['ccell_no'], 0, 1, 'L');


        $pdf->Rect(42, 258, 102, 7);
            // $pdf->Rect(94, 258, 50, 7);
        $pdf->Rect(149, 258, 50, 7);

        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(32, 5, '', 0, 0, 'L');
        $pdf->Cell(52, 5, 'Full Name of Parent/Guardian', 0, 0, 'L');
        $pdf->Cell(55, 5, '', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Contact No.', 0, 1, 'L');

        $pdf->Rect(42, 270, 102, 7);
        // $pdf->Rect(94, 270, 50, 7);
        $pdf->Rect(149, 270, 50, 7);
        
        $pdf->Ln(1);
        $pdf->Cell(32, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 6);
        $pdf->Cell(52, 5, $row['caddress'], 0, 0, 'L');
        $pdf->Cell(55, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(55, 5, $row['relationship'], 0, 1, 'L');

        $pdf->Ln(1);
        $pdf->SetFont('arial', '', 9);

        $pdf->Cell(32, 1, '', 0, 0, 'L');
        $pdf->Cell(52, 5, 'Full Mailing Address of Parent/Guardian', 0, 0, 'L');
        $pdf->Cell(55, 5, '', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Relationship to Scholar', 0, 1, 'L');

        // PERSONAL INFO EMD

        // PAGE 2 START
        // PAGE 2 START
        // PAGE 2 START

        $pdf->AddPage();

        // $pdf->SetLineWidth(0.1);
        // $pdf->SetDash(1,3); //5mm on, 5mm off
        // $pdf->Line(105, 0, 105, 297); // Draws a vertical line down the center of an A4 page
        // $pdf->Line(0, 148.5, 210, 148.5); // Horizontal center line (Y = 148.5)
        
        $pdf->SetDash(); // restores no dash and default to line
        $pdf->SetLineWidth(0); // default line thickness



        // Logo(x axis, y axis, height, width)
        // $pdf->Image('../../img/SFAC-logo1.jpg', 45, 8, 15, 15);
        // text color
        $pdf->SetTextColor(0, 0, 0);
        // font(font type,style,font size)
        // Dummy cell
        $pdf->Cell(50);


        $pdf->Ln(2);
        $pdf->SetTextColor(0, 0, 0);

  

        $margin = 10; // 0.5 inch in mm
        $page_width = 210;
        $page_height = 297;
        
        
        $usable_width = $page_width - ($margin * 2);
        $usable_height = $page_height - ($margin * 2);
        
        $pdf->Rect($margin, $margin, $usable_width, $usable_height); // Full-height box with 0.5-inch margins
        
        
        //cell(width,height,text,border,end line,[align])
        
        // $pdf->Rect($margin, 10, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell($margin, 4, '4.0 Learner/Trainee/Student (Clients) Classification:', 0, 1, 'L');

        $pdf->Rect($margin, 17, $usable_width, 7);
        $pdf->Rect($margin, 24, $usable_width, 7);
        $pdf->Rect($margin, 31, $usable_width, 7);
        $pdf->Rect($margin, 45, $usable_width, 7);
        $pdf->Rect($margin, 52, $usable_width, 7);
        $pdf->Rect($margin, 59, $usable_width, 7);
        // $pdf->Rect($margin, 67, $usable_width, 7);
        // $pdf->Rect($margin, 84, $usable_width, 7);

        $pdf->Rect($margin, 17, 63, 57);
        $pdf->Rect($margin, 17, 126, 57);
        $pdf->Rect($margin, 17, 190, 57);
        
        // row 1
        $pdf->Rect(12, 19, 3, 3);
        $pdf->Rect(75, 19, 3, 3);
        $pdf->Rect(138, 19, 3, 3);
        // row 2
        $pdf->Rect(12, 26, 3, 3);
        $pdf->Rect(75, 26, 3, 3);
        $pdf->Rect(138, 26, 3, 3);
        // row 3
        $pdf->Rect(12, 33, 3, 3);
        $pdf->Rect(75, 33, 3, 3);
        $pdf->Rect(138, 33, 3, 3);
        // row 4
        $pdf->Rect(12, 40, 3, 3);
        $pdf->Rect(75, 40, 3, 3);
        $pdf->Rect(138, 40, 3, 3);
        // row 5
        $pdf->Rect(12, 47, 3, 3);
        $pdf->Rect(75, 47, 3, 3);
        $pdf->Rect(138, 47, 3, 3);
        // row 6
        $pdf->Rect(12, 54, 3, 3);
        $pdf->Rect(75, 54, 3, 3);
        $pdf->Rect(138, 54, 3, 3);
        // row 7
        $pdf->Rect(12, 61, 3, 3);
        $pdf->Rect(75, 61, 3, 3);
        $pdf->Rect(138, 61, 3, 3);
        // row 8
        $pdf->Rect(12, 68, 3, 3);
        $pdf->Rect(75, 68, 3, 3);
        $pdf->Rect(138, 68, 3, 3);

    
        // Fill squares above depending on which attainment_id is fetched via educ_atttain dropdown
        // $classification_id = $row['classification_id']; // Adjust this based on your DB field

        $classification_id_fill = isset($row['classification_id']) ? intval($row['classification_id']) : null;

        if ($classification_id_fill !== null) {
            switch ($classification_id_fill) {
                // Row 1
                case 1: $pdf->Rect(12, 19, 3, 3, 'F'); break;
                case 2: $pdf->Rect(75, 19, 3, 3, 'F'); break;
                case 3: $pdf->Rect(138, 19, 3, 3, 'F'); break;
                // Row 2
                case 4: $pdf->Rect(12, 26, 3, 3, 'F'); break;
                case 5: $pdf->Rect(75, 26, 3, 3, 'F'); break;
                case 6: $pdf->Rect(138, 26, 3, 3, 'F'); break;
                // Row 3
                case 7: $pdf->Rect(12, 33, 3, 3, 'F'); break;
                case 8: $pdf->Rect(75, 33, 3, 3, 'F'); break;
                case 9: $pdf->Rect(138, 33, 3, 3, 'F'); break;
                // Row 4
                case 10: $pdf->Rect(12, 40, 3, 3, 'F'); break;
                case 11: $pdf->Rect(75, 40, 3, 3, 'F'); break;
                case 12: $pdf->Rect(138, 40, 3, 3, 'F'); break;
                // Row 5
                case 13: $pdf->Rect(12, 47, 3, 3, 'F'); break;
                case 14: $pdf->Rect(75, 47, 3, 3, 'F'); break;
                case 15: $pdf->Rect(138, 47, 3, 3, 'F'); break;
                // Row 6
                case 16: $pdf->Rect(12, 54, 3, 3, 'F'); break;
                case 17: $pdf->Rect(75, 54, 3, 3, 'F'); break;
                case 18: $pdf->Rect(138, 54, 3, 3, 'F'); break;
                // Row 7
                case 19: $pdf->Rect(12, 61, 3, 3, 'F'); break;
                case 20: $pdf->Rect(75, 61, 3, 3, 'F'); break;
                case 21: $pdf->Rect(138, 61, 3, 3, 'F'); break;
                // Row 8
                case 22: $pdf->Rect(12, 68, 3, 3, 'F'); break;
                case 23: $pdf->Rect(75, 68, 3, 3, 'F'); break;
                case 24: $pdf->Rect(138, 68, 3, 3, 'F'); break;
    
                default: // Do nothing if no match break;
            }
        }

        

        $pdf->Ln(2);

        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(63, 5, '4Ps Beneficiary', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Agrarian Reform Beneficiary', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Balik Probinsya', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(63, 5, 'Displaced Worker', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Drug Dependents Surrenderes/Surrenderer', 0, 0, 'L');
        $pdf->SetFont('arial', '', 6.5);
        $pdf->Cell(48, 5, 'Family Members of AFP and PNP Killed-In-Action', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(63, 5, 'Family Members of AFP and PNP Wounded-In-Action', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(64, 5, 'Farmers and Fishermen', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Indigenous People & Cultural Communities', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(63, 5, 'Industry Worker', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Inmate and Detainees', 0, 0, 'L');
        $pdf->Cell(48, 5, 'MILF Beneficiary', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(63, 5, 'Out-of-School Youth', 0, 0, 'L');
        $pdf->SetFont('arial', '', 7);

        $pdf->Cell(64, 5, 'Overseas Filipino Workers (OFW) Dependents', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(48, 5, 'RCEF-RESP', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 7);
        $pdf->Cell(63, 5, 'Rebel Returnees/Decommissioned Combatant', 0, 0, 'L');
        $pdf->SetFont('arial', '', 6);
        $pdf->Cell(64, 5, 'Returning/Repatriated Overseas Filipino Workers (OFW)', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(48, 5, 'Student', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(63, 5, 'TESDA Alumni', 0, 0, 'L');
        $pdf->Cell(64, 5, 'TVET Trainers', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Uniformed Personnel', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(63, 5, 'Victim of Natural Disasters and Calamities', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Wounded-in-Action AFP & PNP Personel', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Others: __________________', 0, 1, 'L');

        // 5. TYPE OF DISABILITY
        $pdf->Ln(3);

        $pdf->Rect($margin, 74, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell(102, 5, '5.0 Type of Disability (for Persons with Disability only)', 0, 0, 'L');
        $pdf->SetFont('arial', 'I', 11);
        $pdf->Cell($margin, 5, 'To be filled up by the TESDA Personnel', 0, 1, 'L');
        $pdf->Rect($margin, 81, $usable_width, 7);
        $pdf->Rect($margin, 88, $usable_width, 7);
        $pdf->Rect($margin, 95, $usable_width, 7);

        $pdf->Rect($margin, 81, 63, 21);
        $pdf->Rect($margin, 81, 126, 21);
        $pdf->Rect($margin, 81, 190, 21);

        // row 1
        $pdf->Rect(12, 83, 3, 3);
        $pdf->Rect(75, 83, 3, 3);
        $pdf->Rect(138, 83, 3, 3);
        // row 2
        $pdf->Rect(12, 90, 3, 3, );
        $pdf->Rect(75, 90, 3, 3);
        $pdf->Rect(138, 90, 3, 3);
        // row 3
        $pdf->Rect(12, 97, 3, 3);
        $pdf->Rect(75, 97, 3, 3);
        $pdf->Rect(138, 97, 3, 3);

        // $type_disability_id = $row['type_disability_id']; // Adjust this based on your DB field

        $type_disability_id_fill = isset($row['type_disability_id']) ? intval($row['type_disability_id']) : null;

        if ($type_disability_id_fill !== null) {
            switch ($type_disability_id_fill) {
                case 2: $pdf->Rect(12, 83, 3, 3, 'F'); break;
                case 3: $pdf->Rect(75, 83, 3, 3, 'F'); break;
                case 4: $pdf->Rect(138, 83, 3, 3, 'F'); break;
                // Row 2
                case 5: $pdf->Rect(12, 90, 3, 3, 'F'); break;
                case 6: $pdf->Rect(75, 90, 3, 3, 'F'); break;
                case 7: $pdf->Rect(138, 90, 3, 3, 'F'); break;
                // Row 3
                case 8: $pdf->Rect(12, 97, 3, 3, 'F'); break;
                case 9: $pdf->Rect(75, 97, 3, 3, 'F'); break;
                case 10: $pdf->Rect(138, 97, 3, 3, 'F'); break;

                default: // Do nothing if no match break;
            }
        }

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(63, 5, 'Mental/Intellectual', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Visual Disability', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Orthopedic (Musculoskeletal) Disability', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(63, 5, 'Hearing Disability', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Speech Impairment', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Multiple Disabilities', 0, 1, 'L');

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(63, 5, 'Psychological Disability', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Disability Due to Chronic Illness', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Learning Disability', 0, 1, 'L');
        
        // 5 TYPE OF DISABILITY END

        // 6 CAUSES OF DISABILITY START

                
        $pdf->Ln(2);

        $pdf->Rect($margin, 74, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell(104, 5, '5.0 Cause of Disability (for Persons with Disability only)', 0, 0, 'L');
        $pdf->SetFont('arial', 'I', 11);
        $pdf->Cell($margin, 5, 'To be filled up by the TESDA Personnel', 0, 1, 'L');
        
        
        $pdf->Rect($margin, 102, $usable_width, 7);
        // $pdf->Rect($margin, 88, $usable_width, 7);
        // $pdf->Rect($margin, 95, $usable_width, 7);
     
        $pdf->Rect($margin, 109, $usable_width, 7);

        $pdf->Rect($margin, 109, 63, 7);
        $pdf->Rect($margin, 109, 126, 7);
        $pdf->Rect($margin, 109, 190, 7);

        $pdf->Rect(12, 111, 3, 3);
        $pdf->Rect(75, 111, 3, 3);
        $pdf->Rect(138, 111, 3, 3);

        $cause_disability_id_fill = isset($row['cause_disability_id']) ? intval($row['cause_disability_id']) : null;

        if ($cause_disability_id_fill !== null) {
            switch ($row['cause_disability_id']) {
                case 1: $pdf->Rect(12, 111, 3, 3, 'F'); break;
                case 2: $pdf->Rect(75, 111, 3, 3, 'F'); break;
                case 3: $pdf->Rect(138, 111, 3, 3, 'F'); break;
                default: // Do nothing if no match break;
            }
        }

        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(63, 5, 'Congenital/Inborn', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Illness', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Injury', 0, 1, 'L');


        // 6 CAUSES OF DISABILITY START

        // 7 NAME OF COURSE/QUALIFICATION START

        $pdf->Ln(2);

        $pdf->Rect($margin, 116, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell(63, 5, '7.0 Name of Course/Qualification:', 0, 0, 'L');
        $pdf->SetFont('arial', 'IU', 11);

        // if case where tbl_student's course_id is equal to 0 or not.
        if ($row['course_id'] != 0) {
        $pdf->Cell($margin, 5, $row['course_name'], 0, 1, 'L');
        } else {
            // Optionally, print a blank cell or just skip
            $pdf->Cell($margin, 5, '', 0, 1, 'L');
        }

            // Add more content to the PDF if needed...

            
        // 7 NAME OF COURSE/QUALIFICATION END


        

        // 8 If Scholar.... START
        $pdf->Ln(2);
        $pdf->Rect($margin, 123, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        // TWSP - Training for Work Scholarship Program
        // PESFA - Private Education Student Financial Assistance
        // STEP - Special Training for Employment Program
        $pdf->Cell(150, 5, '8.0 If Scholar, What Type of Scholarship Package (TWSP, PESFA, STEP, others)?', 0, 0, 'L');
        $pdf->SetFont('arial', 'I', 11);
        $pdf->Cell(50, 5, '', 0, 1, 'L');
        
        // Answer Boxes
        $pdf->Rect($margin, 130, $usable_width, 14);

        // Column Dividers
        $pdf->Rect($margin, 130, 47.5, 14);
        $pdf->Rect($margin, 130, 95, 14);
        $pdf->Rect($margin, 130, 142.5, 14);
        $pdf->Rect($margin, 130, 190, 14);

        // square boxses - horizontal
        $pdf->Rect(12, 132, 3, 3);
        $pdf->Rect(59, 132, 3, 3);
        $pdf->Rect(107, 132, 3, 3);
        $pdf->Rect(154, 132, 3, 3);


        $scholar_package_id_fill = isset($row['scholar_package_id']) ? intval($row['scholar_package_id']) : null;

        if ($scholar_package_id_fill !== null) {
            switch ($scholar_package_id_fill) {
                case 1: $pdf->Rect(12, 132, 3, 3, 'F'); break;
                case 2: $pdf->Rect(59, 132, 3, 3, 'F'); break;
                case 3: $pdf->Rect(107, 132, 3, 3, 'F'); break;
                case 4: $pdf->Rect(154, 132, 3, 3, 'F'); break;
            }
        }
        $pdf->Ln(2);

        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 8);
        $pdf->Cell(47, 5, 'TWSP', 0, 0, 'L');
        $pdf->Cell(48, 5, 'PESFA', 0, 0, 'L');
        $pdf->Cell(48, 5, 'STEP', 0, 0, 'L');
        $pdf->Cell(47, 5, 'Others:', 0, 1, 'L');

        $pdf->Cell(1, 5, '', 0, 0, 'L');
        $pdf->SetFont('arial', '', 6);
        $pdf->Cell(47, 5, 'Training for Work Scholarship Program', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Private Education Student Financial Assistance', 0, 0, 'L');
        $pdf->Cell(48, 5, 'Special Training for Employment Program', 0, 0, 'L');
        $pdf->Cell(47, 5, '_____________________________________', 0, 1, 'L');
        $pdf->Ln(2);

        // 8 If Scholar.... END

        // 9 Privacy Disclaimer START
        $pdf->Ln(2);

        $pdf->Rect($margin, 144, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell(104, 5, '9.0 Privacy Disclaimer', 0, 0, 'L');
        $pdf->Cell($margin, 5, '', 0, 1, 'L');

        // Answer Box
        $pdf->Rect($margin, 151, $usable_width, 20);

        $pdf->Ln(2);
        $pdf->SetFont('arial', 'I', 9);
        $pdf->MultiCell(190, 5, 'I hereby allow TESDA to use/post my contact details, name, email, cellphone/landline nos. and other information provided which may be used for processing of my scholarship application, for employment opportunities, and for the survey of TESDA programs', 0, 'L', false);
        $pdf->Ln(2);

        $pdf->Rect(71, 165, 3, 3); // 71.5 for accuracy
        $pdf->Rect(135, 165, 3, 3); // 143 accuracy

        $disclaimer_fill = isset($row['disclaimer']) ? intval($row['disclaimer']) : null;

        // fill boxses depending on radio box
        if ($disclaimer_fill !== null) {
            switch ($disclaimer_fill) {
                case 0: $pdf->Rect(135, 165, 3, 3, 'F'); break;
                case 1: $pdf->Rect(71, 165, 3, 3, 'F'); break;
         
                default: // Do nothing if no match break;
            }
        }

        $pdf->SetFont('arial', '', 9);
        $pdf->Cell(65, 5, '', 0, 0, 'L');
        $pdf->Cell(64, 5, 'Agree', 0, 0, 'L');
        $pdf->Cell(20, 5, 'Disagree', 0, 1, 'L');

        // 9 Privacy Disclaimer END

        // 9 Applicant Signature Start
        $pdf->Ln(3);

        $pdf->Rect($margin, 171, $usable_width, 7);
        $pdf->SetFont('arial', 'B', 11);
        $pdf->Cell(104, 5, '10.0 Applicant Signature', 0, 0, 'L');
        $pdf->Cell($margin, 5, '', 0, 1, 'L');

        // Answer Box
        // $pdf->Rect($margin, 171, $usable_width, 70);

        //
        $pdf->Ln(2);
        $pdf->SetFont('arial', 'I', 9);
        $pdf->Cell(190, 5, 'This is to certify that the information stated above is true and correct.', 0, 0, 'C');
        // 9 Applicant Signature END

        $pdf->Ln(30);

        // Boxes
            // ID picture
        $pdf->Rect(150, 200, 35, 26);
            // Right Thumbmark
        $pdf->Rect(150, 240, 35, 26);


        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(80, 5, '__________________________________________', 0, 0, 'L');
        $pdf->Cell(50, 5, '____________________', 0, 0, 'L');
        $pdf->MultiCell(35, 3, '1x1 picture taken within the last 6 months', 0, 'C', false);

        $pdf->Cell(6, 5, '', 0, 0, 'L');
        $pdf->Cell(84, 1, 'APPLICANTS SIGNATURE OVER PRINTED NAME', 0, 0, 'C');
        $pdf->Cell(10, 1, 'DATE ACCOMPLISHED', 0, 1, 'L');

        // NOTE
        $pdf->Ln(20);

        $pdf->SetFont('arial', 'B', 9);
        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(50, 5, 'Noted By:', 0, 1, 'L');

        $pdf->Ln(10);

        $pdf->Cell(10, 5, '', 0, 0, 'L');
        $pdf->Cell(80, 5, '__________________________________________', 0, 0, 'L');
        $pdf->Cell(50, 5, '____________________', 0, 1, 'L');
        

        
        $pdf->Ln(2);
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(89, 5, 'REGISTRAR/SCHOOL ADMINISTRATOR', 0, 0, 'C');
        $pdf->Cell(10, 5, 'DATE RECEIVED', 0, 1, 'L');
        $pdf->Cell(95, 2, '(Signature Over Printed Name)', 0, 0, 'C');

        $pdf->Cell(125, 5, 'Right Thumbmark', 0, 0, 'C');


        // PAGE 3: COMMITMENT OF UNDERTAKING 

        $pdf->AddPage();


        $pdf->SetMargins(10, 10, 10);
        // fully get the all usable 10mm bottom marjin
        $pdf->SetAutoPageBreak(false); 

        

        // $pdf->SetLineWidth(0.1);
        // $pdf->SetDash(1,3); //5mm on, 5mm off
        // $pdf->Line(105, 0, 105, 297); // Draws a vertical line down the center of an A4 page
        // $pdf->Line(0, 148.5, 210, 148.5); // Horizontal center line (Y = 148.5)
        
        // $pdf->SetDash(); // restores no dash and default to line
        // $pdf->SetLineWidth(0); // default line thickness



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

        $pdf->Cell(59.33, 5, '', 0, 0, 'C');
        $pdf->Cell(58.33, 5, 'Annex K', 0, 1, 'R');

        $pdf->Rect(165, $margin, 35, 15);

        $pdf->Cell(63.33, 5, '', 0, 0, 'C');    // tesda logo
        $pdf->SetFont('times', '', 11);
        $pdf->Cell(63.33, 5, '', 0, 0, 'C');
        $pdf->SetFont('times', 'B', 11);
        $pdf->Cell(62.33, 5, 'Rev No. 01 s. 2025', 0, 1, 'R');

        $pdf->SetFont('arial', 'BU', 24);

        $pdf->Ln(15);

        $pdf->Cell(190, 5, 'COMMITMENT OF UNDERTAKING', 0, 1, 'C');

        $pdf->Ln(10);
        
        



        // tapos na boi
        $pdf->Output();


    } else {
        echo "No student found.";
    }

} else{
    echo "The student ID is invalid";
    
}
