<?php
require '../../../includes/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stud_id = $_POST['stud_id'] ?? null;
    $file_type = $_POST['file_type'] ?? null;

    // Validate file_type
    $allowed_types = ['birth_cert', 'diploma_tor', '1x1'];
    if (!$stud_id || !$file_type || !in_array($file_type, $allowed_types)) {
        die("Invalid document type.");
    }

    $img_column = $file_type . '_img';
    $status_column = $file_type . '_status';
    $reject_reason_column = $file_type . '_reject_reason';

    if (isset($_FILES['certificate_img']) && $_FILES['certificate_img']['error'] == 0) {
        // Read file content
        $file_tmp = $_FILES['certificate_img']['tmp_name'];
        $file_content = file_get_contents($file_tmp); // Read binary data

        // Insert into the database as MEDIUMBLOB
        $update_query = "UPDATE tbl_student_requirements SET $img_column = ?, $status_column = 'pending', $reject_reason_column = NULL WHERE stud_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("bs", $file_content, $stud_id); // "b" for blob data

        if ($stmt->execute()) {
            echo "<script>alert('File uploaded successfully. Waiting for admin validation.'); window.location.href='../submit-req-scholar.php?stud_id=$stud_id';</script>";
        } else {
            echo "<script>alert('Error uploading file.'); window.location.href='../submit-req-scholar.php?stud_id=$stud_id';</script>";
        }
    } else {
        echo "<script>alert('No file selected or upload error.'); window.location.href='../submit-req-scholar.php?stud_id=$stud_id';</script>";
    }
}



// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

//     // Check if a file was uploaded
//     if (isset($_FILES['certificate_img']) && $_FILES['certificate_img']['error'] == 0) {
//         $file_tmp = $_FILES['certificate_img']['tmp_name'];
//         $file_size = $_FILES['certificate_img']['size'];
//         $file_type = $_FILES['certificate_img']['type'];

//         // Allowed file types
//         $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];

//         if (in_array($file_type, $allowed_types) && $file_size <= 5 * 1024 * 1024) { // Max size: 5MB
//             $file_content = file_get_contents($file_tmp); // Read file into a variable

//             // ✅ Correct way to store image in the database (BLOB)
//             $stmt = $conn->prepare("UPDATE tbl_student_requirements SET birth_cert_img = ?, birth_cert_status = 'pending' WHERE stud_id = ?");

//             // Bind parameters
//             $stmt->bind_param("bi", $null, $stud_id);
//             $stmt->send_long_data(0, $file_content); // Store the image securely

//             // Execute query
//             if ($stmt->execute()) {
//                 echo "File uploaded successfully!";
//                 header("location: ../submit-req-scholar.php?stud_id=$stud_id");
//                 exit();
//             } else {
//                 echo "Error updating record: " . $stmt->error;
//             }

//             $stmt->close();
//         } else {
//             echo "Invalid file type or size exceeded (max 5MB).";
//         }
//     } else {
//         echo "No file uploaded.";
//     }

//     $conn->close();
// }

// // DELETE IMAGE
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
//     $stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
//     $file_type = mysqli_real_escape_string($conn, $_POST['file_type']);

//     if (empty($stud_id) || empty($file_type)) {
//         die("Error: Missing parameters.");
//     }

//     // Set the file column to NULL (delete the file)
//     $query = "UPDATE tbl_student_requirements 
//     SET 
//     birth_cert_status = NULL,
//     birth_cert_reject_reason = NULL,
//     $file_type = NULL 
//     WHERE stud_id = '$stud_id'";
//     if (mysqli_query($conn, $query)) {
//         $_SESSION['success-delete'] = true;
//         header("location: ../submit-req-scholar.php?stud_id=$stud_id");
//         exit();
//     } else {
//         die("Database Error: " . mysqli_error($conn));
//     }
// }


?>
