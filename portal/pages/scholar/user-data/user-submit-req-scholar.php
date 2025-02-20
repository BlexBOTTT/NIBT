<?php
require '../../../includes/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    // Validate Student ID
    if (empty($student_id)) {
        die("Error: Student ID is missing!");
    }

    // Initialize image variables
    $cert_img = null;
    $dipl_tor_img = null;

    // Allowed file types
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
    
    // Process Birth Certificate Image
    if (!empty($_FILES['certificate_img']['tmp_name']) && is_uploaded_file($_FILES['certificate_img']['tmp_name'])) {
        if (in_array($_FILES['certificate_img']['type'], $allowed_types)) {
            $cert_img = addslashes(file_get_contents($_FILES['certificate_img']['tmp_name']));
        } else {
            die("Error: Invalid file type for birth certificate.");
        }
    }

    // Process Diploma or ToR Image
    if (!empty($_FILES['diploma_tor_img']['tmp_name']) && is_uploaded_file($_FILES['diploma_tor_img']['tmp_name'])) {
        if (in_array($_FILES['diploma_tor_img']['type'], $allowed_types)) {
            $dipl_tor_img = addslashes(file_get_contents($_FILES['diploma_tor_img']['tmp_name']));
        } else {
            die("Error: Invalid file type for diploma/ToR.");
        }
    }

    // Insert or Update Query
    $query = "INSERT INTO tbl_student_requirements (stud_id, birth_cert_img, diploma_tor_img)
              VALUES ('$student_id', " . ($cert_img ? "'$cert_img'" : "NULL") . ", " . ($dipl_tor_img ? "'$dipl_tor_img'" : "NULL") . ")
              ON DUPLICATE KEY UPDATE 
                  birth_cert_img = VALUES(birth_cert_img),
                  diploma_tor_img = VALUES(diploma_tor_img)";

    // Execute Query
    if (mysqli_query($conn, $query)) {
        $_SESSION['success-edit'] = true;
        header('location: ../submit-req-scholar.php?stud_id=' . $student_id);
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}
?>
