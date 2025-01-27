<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Match the name in the form: <input type="file" name="excelFile">
    if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['excelFile']['name']); // Match 'excelFile'
        $targetFile = $uploadDir . $fileName;

        // Check if the file is an Excel file
        $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
        if (!in_array($fileType, ['xls', 'xlsx'])) {
            die('Invalid file type. Only Excel files are allowed.');
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES['excelFile']['tmp_name'], $targetFile)) {
            header('Location: view-xlsx.php?file=' . urlencode($fileName));
            exit;
        } else {
            die('Error uploading file.');
        }
    } else {
        die('No file uploaded or an error occurred.');
    }
}
?>