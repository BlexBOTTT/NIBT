<?php
require '../../../includes/conn.php';


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
