<?php
require '../../../includes/conn.php'; // Include your database connection file

if(isset($_POST['submit'])){
    // Start a transaction to ensure atomicity
    mysqli_begin_transaction($conn);

    try {
        // Sanitize input to avoid SQL Injection
        $student_count = mysqli_real_escape_string($conn, $_POST['student_count']);
        $course_name_id = mysqli_real_escape_string($conn, $_POST['courses']);
        $batch = mysqli_real_escape_string($conn, $_POST['batch']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
        $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

        // Ensure that the fields are filled
        if(empty($course_name_id) || empty($batch) || empty($year) || empty($start_date) || empty($end_date)){
            throw new Exception("All fields are required!");
        }

        // Insert query for adding the data into tbl_enrollments
        $query = "INSERT INTO tbl_enrollments (student_count, course_name_id, batch, year, start_date, end_date, remarks) 
                  VALUES ('$student_count', '$course_name_id', '$batch', '$year', '$start_date', '$end_date', '$remarks')";

        if (!mysqli_query($conn, $query)) {
            throw new Exception("Error: " . mysqli_error($conn));
        }

        // Commit the transaction if everything is successful
        mysqli_commit($conn);

        echo "Data successfully inserted!";
        // Optionally, you can redirect after successful insertion
        header("Location: ../assign-course.php"); // Adjust the URL as necessary
        exit();

    } catch (Exception $e) {
        // If any error occurs, rollback the transaction
        mysqli_rollback($conn);

        // Display the error message
        echo $e->getMessage();
    }
}
?>