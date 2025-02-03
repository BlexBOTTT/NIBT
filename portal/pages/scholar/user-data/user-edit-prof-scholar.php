<?php
require '../../../includes/conn.php';


if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {


    // Personal Info
    $student_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
   



    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $birthplace = mysqli_real_escape_string($conn, $_POST['birthplace']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);
    $citizenship = mysqli_real_escape_string($conn, $_POST['citizenship']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $landline = mysqli_real_escape_string($conn, $_POST['landline']);


    

    // Family Background: Guardian
    $glastname = mysqli_real_escape_string($conn, $_POST['glastname']);
    $gfirstname = mysqli_real_escape_string($conn, $_POST['gfirstname']);
    $gmiddlename = mysqli_real_escape_string($conn, $_POST['gmiddlename']);
    $gage = mysqli_real_escape_string($conn, $_POST['gage']);
    $gbirthdate = mysqli_real_escape_string($conn, $_POST['gbirthdate']);
    $relationship = mysqli_real_escape_string($conn, $_POST['relationship']);
    $gcitizenship = mysqli_real_escape_string($conn, $_POST['gcitizenship']);
    $gaddress = mysqli_real_escape_string($conn, $_POST['gaddress']);
    $geducation = mysqli_real_escape_string($conn, $_POST['geducation']);
    $gcell_no = mysqli_real_escape_string($conn, $_POST['gcell_no']);
    $gtel_no = mysqli_real_escape_string($conn, $_POST['gtel_no']);
    $goccupation = mysqli_real_escape_string($conn, $_POST['goccupation']);

    // Family Background: Number of Siblings

    // Educational Background   
    $elem = mysqli_real_escape_string($conn, $_POST['elem']);
    $elemSY = mysqli_real_escape_string($conn, $_POST['elemSY']);
    $jhs = mysqli_real_escape_string($conn, $_POST['jhs']);
    $jhsSY = mysqli_real_escape_string($conn, $_POST['elemSY']);
    $shs = mysqli_real_escape_string($conn, $_POST['shs']);
    $shsSY = mysqli_real_escape_string($conn, $_POST['shsSY']);
    $voc = mysqli_real_escape_string($conn, $_POST['voc']);
    $vocSY = mysqli_real_escape_string($conn, $_POST['vocSY']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $collegeSY = mysqli_real_escape_string($conn, $_POST['collegeSY']);

    // Voluntary Work/Athletic Affiliation 
 

    // Student's Life Information
    $marital = mysqli_real_escape_string($conn, $_POST['marital']);
    $finances = mysqli_real_escape_string($conn, $_POST['finances']);
    $allowance = mysqli_real_escape_string($conn, $_POST['allowance']);
    $income = mysqli_real_escape_string($conn, $_POST['income']);
    $residence = mysqli_real_escape_string($conn, $_POST['residence']);

    // Health: A. Physical
    $vision = mysqli_real_escape_string($conn, $_POST['vision']);
    $hearing = mysqli_real_escape_string($conn, $_POST['hearing']);
    $speech = mysqli_real_escape_string($conn, $_POST['speech']);
    $gen_health = mysqli_real_escape_string($conn, $_POST['gen_health']);

    $vision_spec = mysqli_real_escape_string($conn, $_POST['vision_spec']);
    $hearing_spec = mysqli_real_escape_string($conn, $_POST['hearing_spec']);
    $speech_spec = mysqli_real_escape_string($conn, $_POST['speech_spec']);
    $gen_health_spec = mysqli_real_escape_string($conn, $_POST['gen_health_spec']);
   

    // Interest and Hobbies
    $acad_sub = mysqli_real_escape_string($conn, $_POST['course_sub']);
    $curri_org = mysqli_real_escape_string($conn, $_POST['curri_org']);    
    $pos_org = mysqli_real_escape_string($conn, $_POST['pos_org']); 

    $curri_org_spec = mysqli_real_escape_string($conn, $_POST['curri_org_spec']);

    // Update section
    $query = "UPDATE tbl_students SET 

        /* Personal Info */
        stud_no = '$stud_no',
        gender_id = '$gender',
        firstname = '$firstname',
        middlename = '$middlename',
        lastname = '$lastname',
        address = '$address',
        birthdate = '$birthdate',
        birthplace = '$birthplace',
        age = '$age',
        civilstatus = '$civilstatus',
        citizenship = '$citizenship',
        email = '$email',
        contact = '$contact',
        landline = '$landline',


        /* Family Background: Guardian */
        glastname = '$glastname',
        gfirstname = '$gfirstname',
        gmiddlename = '$gmiddlename',
        gage = '$gage',
        gbirthdate = '$gbirthdate',
        relationship = '$relationship',
        gcitizenship = '$gcitizenship',
        gaddress = '$gaddress',
        geducation = '$geducation',
        gcell_no = '$gcell_no',
        gtel_no = '$gtel_no',
        goccupation = '$goccupation',

        /* Family Background: Number of Siblings */
        sib1_name = '$sib1_name',
        sib1_occ = '$sib1_occ',
        sib1_contact = '$sib1_contact',
        sib2_name = '$sib2_name',
        sib2_occ = '$sib2_occ',
        sib2_contact = '$sib2_contact',
        sib3_name = '$sib3_name',
        sib3_occ = '$sib3_occ',
        sib3_contact = '$sib3_contact',
        sib4_name = '$sib4_name',
        sib4_occ = '$sib4_occ',
        sib4_contact = '$sib4_contact',
        sib5_name = '$sib5_name',
        sib5_occ = '$sib5_occ',
        sib5_contact = '$sib5_contact',

        /* Educational Background  */
        elem = '$elem',
        elemSY = '$elemSY',
        jhs = '$jhs',
        jhsSY = '$jhsSY',
        shs = '$shs',
        shsSY = '$shsSY',
        voc = '$voc',
        vocSY = '$vocSY',
        college = '$college',
        collegeSY = '$collegeSY',

        /* Voluntary Work/Athletic Affiliation  */
        org1 = '$org1',
        org1_serv = '$org1_serv',
        org1_date = '$org1_date',
        org2 = '$org2',
        org2_serv = '$org2_serv',
        org2_date = '$org2_date',
        org3 = '$org3',
        org3_serv = '$org3_serv',
        org3_date = '$org3_date',
        org4 = '$org4',
        org4_serv = '$org4_serv',
        org4_date = '$org4_date',
        org5 = '$org5',
        org5_serv = '$org5_serv',
        org5_date = '$org5_date',

        /* Student's Life Information */
        marital_id = '$marital',
        fin_id = '$finances',
        allowance_id = '$allowance',
        income_id = '$income',
        residence_id = '$residence',
        

        /* Health: A. Physical */
        vision = '$vision',
        hearing = '$hearing',
        speech = '$speech',
        gen_health = '$gen_health',

        vision_spec = '$vision_spec',
        hearing_spec = '$hearing_spec',
        speech_spec = '$speech_spec',
        gen_health_spec = '$gen_health_spec',

        /* Health: B. Socio-Physical */
        psychiatrist = '$psychiatrist',
        psychiatrist_when = '$psychiatrist_when',
        psychiatrist_what = '$psychiatrist_what',

        psychologist = '$psychologist',
        psychologist_when = '$psychologist_when',
        psychologist_what = '$psychologist_what',

        counselor = '$counselor',
        counselor_when = '$counselor_when',
        counselor_what = '$counselor_what',

        /* Interest and Hobbies */
        acad_sub_id = '$acad_sub',
        curri_org_id = '$curri_org',
        pos_org = '$pos_org',

        curri_org_spec = '$curri_org_spec'

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