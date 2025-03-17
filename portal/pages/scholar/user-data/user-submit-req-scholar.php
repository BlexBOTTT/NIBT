<?php
require '../../../includes/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    $file_type = mysqli_real_escape_string($conn, $_POST['file_type']);

    // Check if file is uploaded
    if (!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] != UPLOAD_ERR_OK) {
        die("Error: No file uploaded.");
    }

    $file_tmp = $_FILES['file_upload']['tmp_name'];
    $file_data = file_get_contents($file_tmp); // Read file contents
    $file_data = mysqli_real_escape_string($conn, $file_data); // Escape for SQL

    // Dynamically create the status column name
    $status_column = str_replace("_img", "_status", $file_type);

    // Check if stud_id exists
    $query = "SELECT stud_id FROM tbl_student_requirements WHERE stud_id = '$stud_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // If exists, update the correct file column and status dynamically
        $update_query = "UPDATE tbl_student_requirements 
                         SET $file_type = '$file_data', 
                             $status_column = 'pending' 
                         WHERE stud_id = '$stud_id'";

        if (mysqli_query($conn, $update_query)) {
            $_SESSION['success-update'] = true;
        } else {
            die("Database Error: " . mysqli_error($conn));
        }
    } else {
        // If not, insert a new row with the correct status column
        $insert_query = "INSERT INTO tbl_student_requirements (stud_id, $file_type, $status_column) 
                         VALUES ('$stud_id', '$file_type', 'pending')";

        if (mysqli_query($conn, $insert_query)) {
            $_SESSION['success-insert'] = true;
        } else {
            die("Database Error: " . mysqli_error($conn));
        }
    }

    // Redirect after success
    header("location: ../submit-req-scholar.php?stud_id=$stud_id");
    exit();
}


// DELETE IMAGE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {

    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    $file_type = mysqli_real_escape_string($conn, $_POST['file_type']);

    // Validate input
    if (empty($stud_id) || empty($file_type)) {
        die("Error: Missing parameters.");
    }

    // Validate that file_type is allowed to prevent SQL injection
    $allowed_types = ['birth_cert_img', 'diploma_tor_img', '1x1_img'];
    if (!in_array($file_type, $allowed_types)) {
        die("Error: Invalid file type.");
    }

    // Determine the corresponding status and reject reason columns dynamically
    $status_column = str_replace("_img", "_status", $file_type);
    $reject_reason_column = str_replace("_img", "_reject_reason", $file_type);

    // Build the dynamic SQL query
    $query = "UPDATE tbl_student_requirements 
              SET 
              $file_type = NULL,
              $status_column = NULL,
              $reject_reason_column = NULL         
              WHERE stud_id = '$stud_id'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        $_SESSION['success-delete'] = true;
        header("location: ../submit-req-scholar.php?stud_id=$stud_id");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}

?>
