<?php
require '../../../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    // Check if a file was uploaded
    if (isset($_FILES['certificate_img']) && $_FILES['certificate_img']['error'] == 0) {
        $file_tmp = $_FILES['certificate_img']['tmp_name'];
        $file_size = $_FILES['certificate_img']['size'];
        $file_type = $_FILES['certificate_img']['type'];

        // Allowed file types
        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];

        if (in_array($file_type, $allowed_types) && $file_size <= 5 * 1024 * 1024) { // Max size: 5MB
            $file_content = file_get_contents($file_tmp); // Read file into a variable

            // ✅ Correct way to store image in the database (BLOB)
            $stmt = $conn->prepare("UPDATE tbl_student_requirements SET birth_cert_img = ?, birth_cert_status = 'pending' WHERE stud_id = ?");

            // Bind parameters
            $stmt->bind_param("bi", $null, $stud_id);
            $stmt->send_long_data(0, $file_content); // Store the image securely

            // Execute query
            if ($stmt->execute()) {
                echo "File uploaded successfully!";
                header("location: ../submit-req-scholar.php?stud_id=$stud_id");
                exit();
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Invalid file type or size exceeded (max 5MB).";
        }
    } else {
        echo "No file uploaded.";
    }

    $conn->close();
}



// DELETE IMAGE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
    $file_type = mysqli_real_escape_string($conn, $_POST['file_type']);

    if (empty($stud_id) || empty($file_type)) {
        die("Error: Missing parameters.");
    }

    // Set the file column to NULL (delete the file)
    $query = "UPDATE tbl_student_requirements 
    SET 
    birth_cert_status = NULL,
    birth_cert_reject_reason = NULL,
    $file_type = NULL 
    WHERE stud_id = '$stud_id'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['success-delete'] = true;
        header("location: ../submit-req-scholar.php?stud_id=$stud_id");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}


?>
