<?php
require '../../../includes/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    if (empty($student_id)) die("Error: Student ID is missing!");

    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
    $fields = ['certificate_img' => 'birth_cert_img', 'diploma_tor_img' => 'diploma_tor_img'];
    $update_values = [];

    foreach ($fields as $input_name => $db_column) {
        if (!empty($_FILES[$input_name]['tmp_name']) && is_uploaded_file($_FILES[$input_name]['tmp_name'])) {
            if (in_array($_FILES[$input_name]['type'], $allowed_types)) {
                $update_values[$db_column] = addslashes(file_get_contents($_FILES[$input_name]['tmp_name']));
            } else {
                die("Error: Invalid file type for $db_column.");
            }
        }
    }

    if (!empty($update_values)) {
        $query = "INSERT INTO tbl_student_requirements (stud_id, " . implode(", ", array_keys($update_values)) . ") 
                  VALUES ('$student_id', '" . implode("', '", $update_values) . "')
                  ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($col) => "$col = VALUES($col)", array_keys($update_values)));

        if (mysqli_query($conn, $query)) {
            $_SESSION['success-edit'] = true;
            header("location: ../submit-req-scholar.php?stud_id=$student_id");
            exit();
        } else {
            die("Database Error: " . mysqli_error($conn));
        }
    } else {
        die("No new images uploaded.");
    }
}

// DELETE IMAGE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    $file_type = mysqli_real_escape_string($conn, $_POST['file_type']);

    if (empty($student_id) || empty($file_type)) {
        die("Error: Missing parameters.");
    }

    // Set the file column to NULL (delete the file)
    $query = "UPDATE tbl_student_requirements SET $file_type = NULL WHERE stud_id = '$student_id'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['success-delete'] = true;
        header("location: ../submit-req-scholar.php?stud_id=$student_id");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}
?>
