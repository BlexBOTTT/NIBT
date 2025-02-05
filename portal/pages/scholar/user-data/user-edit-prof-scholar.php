<?php
require '../../../includes/conn.php';


if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {


    // PERSONAL DATAS
    $student_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
   
    $middleinitial = mysqli_real_escape_string($conn, $_POST['middleinitial']);
   
    $extname = mysqli_real_escape_string($conn, $_POST['extname']);

    $bpprovince = mysqli_real_escape_string($conn, $_POST['bpprovince']);                        
    $bpmunicity = mysqli_real_escape_string($conn, $_POST['bpmunicity']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);

    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);

    // ADDRESS 
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $numstreet = mysqli_real_escape_string($conn, $_POST['numstreet']);
    $barangay = mysqli_real_escape_string($conn, $_POST['barangay']); 
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $addmunicity = mysqli_real_escape_string($conn, $_POST['addmunicity']);
    $region = mysqli_real_escape_string($conn, $_POST['region']);

    // NIBT Scholar Info

    // Which qualification (checkbox)
    
    $learneriduli = mysqli_real_escape_string($conn, $_POST['learneriduli']);

    $educattain = mysqli_real_escape_string($conn, $_POST['educattain']);

    // institutional requirements (checkbox)

    $employment = mysqli_real_escape_string($conn, $_POST['employment']);
    $disability = mysqli_real_escape_string($conn, $_POST['disability']);

    $fbacc = mysqli_real_escape_string($conn, $_POST['fb_account']);
    $fbmess = mysqli_real_escape_string($conn, $_POST['fb_mess']);

    // CONTACT PERSON

    $cfullname = mysqli_real_escape_string($conn, $_POST['cfullname']); // contact person full name
    $ccell_no = mysqli_real_escape_string($conn, $_POST['ccell_no']); // contact number
    $cbirthdate = mysqli_real_escape_string($conn, $_POST['cbirthdate']); // contact date of birth
    $caddress = mysqli_real_escape_string($conn, $_POST['caddress']);// contact complete mailing address
    $relationship = mysqli_real_escape_string($conn, $_POST['relationship']); // relationship to scholar

     // Get selected courses from the form (array of course IDs)
    if (isset($_POST['courses']) && is_array($_POST['courses'])) {
        $selected_courses = $_POST['courses'];
        
        // First, remove any previously selected courses for this student
        $deleteQuery = "DELETE FROM tbl_student_courses WHERE stud_id = '$student_id'";
        $deleteResult = mysqli_query($conn, $deleteQuery);
        
        if (!$deleteResult) {
            $_SESSION['errors'] = true;
            echo "Failed to delete old courses: " . mysqli_error($conn);
            exit();
        }
        
        // Now, insert the newly selected courses
        foreach ($selected_courses as $course_id) {
            $course_id = mysqli_real_escape_string($conn, $course_id);
            $insertQuery = "INSERT INTO tbl_student_courses (stud_id, course_id) VALUES ('$student_id', '$course_id')";
            $insertResult = mysqli_query($conn, $insertQuery);
            
            if (!$insertResult) {
                $_SESSION['errors'] = true;
                echo "Failed to update courses: " . mysqli_error($conn);
                exit();
            }
        }
    }
    
    // Update section
    $query = "UPDATE tbl_students SET 

        /* Personal Info */

        lastname = '$lastname',
        firstname = '$firstname',
        middlename = '$middlename',
        middleinitial = '$middleinitial',
        ext_name_id = '$extname',

        bpprovince = '$bpprovince',
        bpmunicity = '$bpmunicity',
        birthdate = '$birthdate',
        gender_id = '$gender',
        civilstatus = '$civilstatus',

        -- ADDRESS 
        email = '$email',
        contact = '$contact',
        num_street = '$numstreet',
        barangay = '$barangay',
        district = '$district',
        addmunicity = '$addmunicity',
        region = '$region',

        fb_account = '$fbacc',
        fb_mess = '$fbmess',
     
        -- NIBT SCHOLAR INFO
        -- qualification CHECKBOX
        learner_iduli = '$learneriduli',
        educ_attain = '$educattain',
        -- institutional requirements CHECKBOX
        employment_id = '$employment',
        disability = '$disability',

        -- CONTACT PERSON

        cfullname = '$cfullname',
        ccell_no = '$ccell_no',
        cbirthdate = '$cbirthdate',
        caddress = '$caddress',
        relationship = '$relationship'


        WHERE stud_id = '$student_id'";

    $updateUser = mysqli_query($conn, $query);
    if (!$updateUser) {
        $_SESSION['errors'] = true;
        echo "Failed to update data: " . mysqli_error($conn);
    } else {
        $_SESSION['success-edit'] = true;
        header('location: ../prof-scholar.php?stud_id=' . $student_id);
    }
}