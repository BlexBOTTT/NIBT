<?php
require '../../../includes/conn.php';


if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {


    // Personal Info
    $student_id = mysqli_real_escape_string($conn, $_POST['stud_id']);

    $stud_no = mysqli_real_escape_string($conn, $_POST['stud_no']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $birthplace = mysqli_real_escape_string($conn, $_POST['birthplace']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $civilstatus = mysqli_real_escape_string($conn, $_POST['civilstatus']);
    $citizenship = mysqli_real_escape_string($conn, $_POST['citizenship']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $landline = mysqli_real_escape_string($conn, $_POST['landline']);

    // Family Background: Father
    $flastname = mysqli_real_escape_string($conn, $_POST['flastname']);
    $ffirstname = mysqli_real_escape_string($conn, $_POST['ffirstname']);
    $fmiddlename = mysqli_real_escape_string($conn, $_POST['fmiddlename']);
    $fage = mysqli_real_escape_string($conn, $_POST['fage']);
    $fbirthdate = mysqli_real_escape_string($conn, $_POST['fbirthdate']);
    $fcitizenship = mysqli_real_escape_string($conn, $_POST['fcitizenship']);
    $faddress = mysqli_real_escape_string($conn, $_POST['faddress']);
    $ftel_no = mysqli_real_escape_string($conn, $_POST['ftel_no']);
    $fcell_no = mysqli_real_escape_string($conn, $_POST['fcell_no']);
    $feducation = mysqli_real_escape_string($conn, $_POST['feducation']);
    $foccupation = mysqli_real_escape_string($conn, $_POST['foccupation']);

    // Family Background: Mother
    $mlastname = mysqli_real_escape_string($conn, $_POST['mlastname']);
    $mfirstname = mysqli_real_escape_string($conn, $_POST['mfirstname']);
    $mmiddlename = mysqli_real_escape_string($conn, $_POST['mmiddlename']);
    $mage = mysqli_real_escape_string($conn, $_POST['mage']);
    $mbirthdate = mysqli_real_escape_string($conn, $_POST['mbirthdate']);
    $mcitizenship = mysqli_real_escape_string($conn, $_POST['mcitizenship']);
    $maddress = mysqli_real_escape_string($conn, $_POST['maddress']);
    $mtel_no = mysqli_real_escape_string($conn, $_POST['mtel_no']);
    $mcell_no = mysqli_real_escape_string($conn, $_POST['mcell_no']);
    $meducation = mysqli_real_escape_string($conn, $_POST['meducation']);
    $moccupation = mysqli_real_escape_string($conn, $_POST['moccupation']);

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
    $sib1_name = mysqli_real_escape_string($conn, $_POST['sib1_name']);
    $sib1_occ = mysqli_real_escape_string($conn, $_POST['sib1_occ']);
    $sib1_contact = mysqli_real_escape_string($conn, $_POST['sib1_contact']);
    $sib2_name = mysqli_real_escape_string($conn, $_POST['sib2_name']);
    $sib2_occ = mysqli_real_escape_string($conn, $_POST['sib2_occ']);
    $sib2_contact = mysqli_real_escape_string($conn, $_POST['sib2_contact']);
    $sib3_name = mysqli_real_escape_string($conn, $_POST['sib3_name']);
    $sib3_occ = mysqli_real_escape_string($conn, $_POST['sib3_occ']);
    $sib3_contact = mysqli_real_escape_string($conn, $_POST['sib3_contact']);
    $sib4_name = mysqli_real_escape_string($conn, $_POST['sib4_name']);
    $sib4_occ = mysqli_real_escape_string($conn, $_POST['sib4_occ']);
    $sib4_contact = mysqli_real_escape_string($conn, $_POST['sib4_contact']);
    $sib5_name = mysqli_real_escape_string($conn, $_POST['sib5_name']);
    $sib5_occ = mysqli_real_escape_string($conn, $_POST['sib5_occ']);
    $sib5_contact = mysqli_real_escape_string($conn, $_POST['sib5_contact']);

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
    $org1 = mysqli_real_escape_string($conn, $_POST['org1']);
    $org1_serv = mysqli_real_escape_string($conn, $_POST['org1_serv']);
    $org1_date = mysqli_real_escape_string($conn, $_POST['org1_date']);
    $org2 = mysqli_real_escape_string($conn, $_POST['org2']);
    $org2_serv = mysqli_real_escape_string($conn, $_POST['org2_serv']);
    $org2_date = mysqli_real_escape_string($conn, $_POST['org2_date']);
    $org3 = mysqli_real_escape_string($conn, $_POST['org3']);
    $org3_serv = mysqli_real_escape_string($conn, $_POST['org3_serv']);
    $org3_date = mysqli_real_escape_string($conn, $_POST['org3_date']);
    $org4 = mysqli_real_escape_string($conn, $_POST['org4']);
    $org4_serv = mysqli_real_escape_string($conn, $_POST['org4_serv']);
    $org4_date = mysqli_real_escape_string($conn, $_POST['org4_date']);
    $org5 = mysqli_real_escape_string($conn, $_POST['org5']);
    $org5_serv = mysqli_real_escape_string($conn, $_POST['org5_serv']);
    $org5_date = mysqli_real_escape_string($conn, $_POST['org5_date']);

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
   

    // Health: B. Socio-Physical

    $vision_spec = mysqli_real_escape_string($conn, $_POST['vision_spec']);
    $hearing_spec = mysqli_real_escape_string($conn, $_POST['hearing_spec']);
    $speech_spec = mysqli_real_escape_string($conn, $_POST['speech_spec']);
    $gen_health_spec = mysqli_real_escape_string($conn, $_POST['gen_health_spec']);

    $psychiatrist = mysqli_real_escape_string($conn, $_POST['psychiatrist']);
    $psychiatrist_when = mysqli_real_escape_string($conn, $_POST['psychiatrist_when']);
    $psychiatrist_what = mysqli_real_escape_string($conn, $_POST['psychiatrist_what']);

    $psychologist = mysqli_real_escape_string($conn, $_POST['psychologist']);
    $psychologist_when = mysqli_real_escape_string($conn, $_POST['psychologist_when']);
    $psychologist_what = mysqli_real_escape_string($conn, $_POST['psychologist_what']);

    $counselor = mysqli_real_escape_string($conn, $_POST['counselor']);
    $counselor_when = mysqli_real_escape_string($conn, $_POST['counselor_when']);
    $counselor_what = mysqli_real_escape_string($conn, $_POST['counselor_what']);

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
        religion = '$religion',
        email = '$email',
        contact = '$contact',
        landline = '$landline',

        /* Family Background: Father */
        flastname = '$flastname',
        ffirstname = '$ffirstname',
        fmiddlename = '$fmiddlename',
        fage = '$fage',
        fbirthdate = '$fbirthdate',
        fcitizenship = '$fcitizenship',
        faddress = '$faddress',
        ftel_no = '$ftel_no',
        fcell_no = '$fcell_no',
        feducation = '$feducation',
        foccupation = '$foccupation',

        /* Family Background: Mother */
        mlastname = '$mlastname',
        mfirstname = '$mfirstname',
        mmiddlename = '$mmiddlename',
        mage = '$mage',
        mbirthdate = '$mbirthdate',
        mcitizenship = '$mcitizenship',
        maddress = '$maddress',
        mtel_no = '$mtel_no',
        mcell_no = '$mcell_no',
        meducation = '$meducation',
        moccupation = '$moccupation',

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