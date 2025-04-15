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
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    if (empty($stud_id) || empty($status)) {
        die("Error: Missing parameters.");
    }

    // Define valid columns for security
    $valid_columns = [
        "birth_cert",
        "diploma_tor",
        "1x1"
    ];

    if (!in_array($status, $valid_columns)) {
        die("Error: Invalid requirement.");
    }

    // Dynamic column names
    $status_column = "{$status}_status";
    $reason_column = "{$status}_reject_reason";

    // Update the correct columns dynamically
    $query = "UPDATE tbl_student_requirements 
              SET $status_column = 'approved', 
                  $reason_column = NULL 
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enroll'])) {
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

// drop a scholar

if (isset($_POST['drop']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the student ID
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    // Update the student's enrollment status
    $query = "UPDATE tbl_students SET enroll_status_id = 2 WHERE stud_id = $stud_id";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect back to the page after successful update
        header("Location: ../list-req-scholar.php?stud_id=$stud_id");
        exit();
    } else {
        // Show error message if the query fails
        die("Database Error: " . mysqli_error($conn));
    }
}
?>


