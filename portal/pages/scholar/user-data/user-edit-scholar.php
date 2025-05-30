<?php
require '../../../includes/conn.php';


if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $student_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    $failed = 0;

    if (empty($_FILES['prof_img']['tmp_name'])) {
        $error_img = '<li> The <strong>upload profile</strong> is required.</li>';
        $failed = $failed + 1;
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
        $_SESSION['prev_data'] = array($firstname, $middlename, $lastname, $email, $username);
        $_SESSION['errors'] = array($error_img, $error_uname, $error_pass, $error_empty_pass);
        header('location: ../edit-scholar.php?stud_id=' . $student_id);
    } else {
        $image = (!empty($_FILES['prof_img']['tmp_name'])) ? addslashes(file_get_contents($_FILES['prof_img']['tmp_name'])) : null;
        $hashpwd = password_hash($password, PASSWORD_BCRYPT);
        $insertUser = mysqli_query($conn, "UPDATE tbl_students SET
         img = '$image',
          firstname = '$firstname',
           middlename = '$middlename',
            lastname = '$lastname',
             email = '$email',
               username = '$username',
                password = '$hashpwd' WHERE stud_id = '$student_id'") or die(mysqli_error($conn));
        $_SESSION['success-edit'] = true;
        header('location: ../edit-scholar.php?stud_id=' . $student_id);
    }
}