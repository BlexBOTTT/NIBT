<?php
require '../../../includes/conn.php';

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    $failed = 0;

    if (empty($_FILES['prof_img']['tmp_name'])) {
        $error_img = '<li> The <strong>upload prof_img</strong> is required.</li>';
        $failed++;
    }
    if (empty($username)) {
        $error_uname = '<li> The <strong>username field</strong> is required.</li>';
        $failed++;
    }
    if ($password != $password2) {
        $error_pass = '<li> The <strong>confirm password field</strong> does not match.</li>';
        $failed++;
    } elseif (empty($password)) {
        $error_empty_pass = '<li> The <strong>password field</strong> is required.</li>';
        $failed++;
    }

    if ($failed != 0) {
        $_SESSION['prev_data'] = array($firstname, $middlename, $lastname, $email, $stud_no, $username);
        $_SESSION['errors'] = array($error_img, $error_uname, $error_pass, $error_empty_pass);
        header('location: ../add-scholar.php');
        exit();
    } else {

        // Generate the timestamp for creation
        $create_datetime = date('Y-m-d H:i:s'); // Current datetime

        $image = (!empty($_FILES['prof_img']['tmp_name'])) ? addslashes(file_get_contents($_FILES['prof_img']['tmp_name'])) : null;
        $hashpwd = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into tbl_students
        $insertUser = mysqli_query($conn, "INSERT INTO tbl_students (create_datetime, img, firstname, lastname, email, username, password) 
                                           VALUES ('$create_datetime', '$image', '$firstname', '$lastname', '$email', '$username', '$hashpwd')")
                     or die(mysqli_error($conn));

        // Get the last inserted ID (stud_id)
        $stud_id = mysqli_insert_id($conn);

        // Insert a row into tbl_student_requirements with the retrieved stud_id, keeping other columns NULL
        $insertRequirements = mysqli_query($conn, "INSERT INTO tbl_student_requirements (stud_id) VALUES ('$stud_id')")
                             or die(mysqli_error($conn));

        $_SESSION['success'] = true;
        header('location: ../add-scholar.php');
        exit();
    }
}