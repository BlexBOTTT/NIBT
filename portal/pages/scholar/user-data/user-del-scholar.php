<?php require '../../../includes/conn.php';


$get_user = $_GET['stud_id'];


// Code below, both deletion of tbl_students and tbl_student_requirements

// First, delete from tbl_student_requirements
mysqli_query($conn, "DELETE FROM tbl_student_requirements WHERE stud_id = '$get_user'") or die(mysqli_error($conn));

// Then, delete from tbl_students
mysqli_query($conn, "DELETE FROM tbl_students WHERE stud_id = '$get_user'") or die(mysqli_error($conn));


$_SESSION['success-del'] = true;
header('location: ../list-scholar.php');
exit();