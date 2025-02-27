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

    $province = mysqli_real_escape_string($conn, $_POST['province']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $bpregion = mysqli_real_escape_string($conn, $_POST['bpregion']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);

    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);

    $courses = mysqli_real_escape_string($conn, $_POST['courses']);

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

    $attainment = mysqli_real_escape_string($conn, $_POST['attainment']);

    // institutional requirements (checkbox)

    $employment = mysqli_real_escape_string($conn, $_POST['employment']);
    $type_disability = mysqli_real_escape_string($conn, $_POST['type_disability']);
    $cause_disability = mysqli_real_escape_string($conn, $_POST['cause_disability']);
    $scholar_package = mysqli_real_escape_string($conn, $_POST['scholar_package']);

    $classification = mysqli_real_escape_string($conn, $_POST['classification']);

    $fbacc = mysqli_real_escape_string($conn, $_POST['fb_account']);
    $fbmess = mysqli_real_escape_string($conn, $_POST['fb_mess']);

    // CONTACT PERSON

    $cfullname = mysqli_real_escape_string($conn, $_POST['cfullname']); // contact person full name
    $ccell_no = mysqli_real_escape_string($conn, $_POST['ccell_no']); // contact number
    $cbirthdate = mysqli_real_escape_string($conn, $_POST['cbirthdate']); // contact date of birth
    $caddress = mysqli_real_escape_string($conn, $_POST['caddress']);// contact complete mailing address
    $relationship = mysqli_real_escape_string($conn, $_POST['relationship']); // relationship to scholar

    $disclaimer = isset($_POST['disclaimer']) ? $_POST['disclaimer'] : 0;


    // Update section
    $image = (!empty($_FILES['prof_img']['tmp_name'])) ? addslashes(file_get_contents($_FILES['prof_img']['tmp_name'])) : null;

    $query = "UPDATE tbl_students SET 

        /* Personal Info */
        img = '$image',
        lastname = '$lastname',
        firstname = '$firstname',
        middlename = '$middlename',
        middleinitial = '$middleinitial',
        ext_name_id = '$extname',

        bpprovince = '$bpprovince',
        bpmunicity = '$bpmunicity',
        birthdate = '$birthdate',
        gender_id = '$gender',
        -- civilstatus = '$civilstatus',

        course_id = '$courses',
        civil_status_id = '$civilstatus',
        province = '$province',
        age = '$age',
        bpregion = '$bpregion',
        nationality = '$nationality',
        
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
        attainment_id = '$attainment',
        -- institutional requirements CHECKBOX
        employment_id = '$employment',
        type_disability_id = '$type_disability',
        cause_disability_id = '$cause_disability',

        scholar_package_id = '$scholar_package',
        classification_id = '$classification',
        -- CONTACT PERSON

        cfullname = '$cfullname',
        ccell_no = '$ccell_no',
        cbirthdate = '$cbirthdate',
        caddress = '$caddress',
        relationship = '$relationship',

        disclaimer = '$disclaimer'


        WHERE stud_id = '$student_id'";

    $updateUser = mysqli_query($conn, $query);
    if (!$updateUser) {
        $_SESSION['errors'] = true;
        echo "Failed to update data: " . mysqli_error($conn);
    } else {
        
        $_SESSION['success-edit'] = true;
        header('location: ../edit-prof-scholar.php?stud_id=' . $student_id);
    }
}