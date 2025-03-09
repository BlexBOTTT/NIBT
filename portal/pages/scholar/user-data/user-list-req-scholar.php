<?php
require '../../../includes/conn.php';


// Reject an image
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reject'])) {
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    $reject_reason = mysqli_real_escape_string($conn, $_POST['reject_reason']);
    $reject_field = mysqli_real_escape_string($conn, $_POST['reject_field']); // The field being rejected

    if (empty($stud_id) || empty($reject_field)) {
        die("Error: Missing parameters.");
    }

    // Allowed rejection fields to prevent SQL injection
    $allowed_fields = ["birth_cert_reject_reason", "diploma_tor_reject_reason", "1x1_reject_reason"];
    if (!in_array($reject_field, $allowed_fields)) {
        die("Error: Invalid reject field.");
    }

    // Dynamically determine the corresponding file and status columns
    $file_column = str_replace("_reject_reason", "_img", $reject_field);
    $status_column = str_replace("_reject_reason", "_status", $reject_field);

    // Update the correct file field and status field dynamically
    $query = "UPDATE tbl_student_requirements 
              SET 
              $reject_field = '$reject_reason', 
              $file_column = NULL, 
              $status_column = 'rejected'
              WHERE stud_id = '$stud_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success-delete'] = true;
        header("location: ../list-req-scholar.php?stud_id=$stud_id");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}


// Approve
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])) {
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    if (empty($stud_id)) {
        die("Error: Missing parameters.");
    }

    // Set the file column to NULL (delete the file)
    $query = "UPDATE tbl_student_requirements 
            SET
            birth_cert_status = 'approved',
            birth_cert_reject_reason = NULL 
            WHERE stud_id = '$stud_id'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success-delete'] = true;
        header("location: ../list-req-scholar.php?stud_id=$stud_id");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}


// Mark Pending Scholar as Enrolled Student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stud_id'])) {
    $stud_id = $_POST['stud_id'];

    // Update the student's enrollment status
    $update_query = "UPDATE tbl_students SET enroll_status_id = 1 WHERE stud_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $stud_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Student has been successfully enrolled.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to enroll student.";
        $_SESSION['msg_type'] = "danger";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the page
    header("Location: ../list-req-scholar.php"); // Change this to your main page
    exit();
}
?>
