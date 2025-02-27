<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <?php include '../../includes/links.php'; 

    $stud_id = $_GET['stud_id']
  ?>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php include '../../includes/preloader.php'; ?>

  <!-- Navbar -->
  <?php include '../../includes/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include '../../includes/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Scholars</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">

                    <?php
                        if (!empty($_SESSION['errors'])) {
                            echo '<div class="alert alert-danger fade show" role="alert">
                                    <div class="d-flex justify-content-between align-items-center">';
                                        echo '<div>';
                                            foreach ($_SESSION['errors'] as $error) {
                                                echo '<div class="mb-2">' . $error . '</div>';
                                            }
                                        echo '</div>';
                                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                        </div>';                              
                            unset($_SESSION['errors']);
                        } elseif (!empty($_SESSION['success-edit'])) {
                            echo ' <div class="alert alert-success fade show" role="alert">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="alert-text"><strong>Successfully Updated!</strong></span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                        </div>';
                            unset($_SESSION['success-edit']);
                        }
                    ?>

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">View Scholar Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- <div class="row justify-content-center">
                  <div class="col-md-3 mb-3 mt-4">
                      <form method="GET">
                          <div class="input-group">
                              <input disabled type="search" class="form-control"
                                  placeholder="Search for (Student no. or Name)" name="search">
                              <div class="input-group-append">
                                  <button type="submit" name="look" class="btn bg-navy"
                                      data-toggle="tooltip" data-placement="bottom" title="Search">
                                      <i class="fa fa-search"></i>
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div> -->

                <div class="card-body pad table-responsive">
                
                    <!-- Start Inputs -->
                    <form action="user-data/user-edit-prof-scholar.php" method="POST" enctype="multipart/form-data">
                                <?php
                                    $get_admin = $conn->query("SELECT * FROM tbl_students WHERE stud_id = '$_GET[stud_id]'");
                                    $res_count = $get_admin->num_rows;
                                    if ($res_count == 0) {
                                        // error code
                                    }
                                    $row = $get_admin->fetch_array();

                                ?>
                                
                                <input disabled class="form-control" type="text" name="stud_id" value="<?php echo $row['stud_id']; ?>" hidden>
                                
                                        
                                <div class="row mx-auto justify-content-center text-center">
                                    <div class="col-md-4 my-4">
                                        <a href="prof-scholar.php<?php echo '?stud_id=' . $stud_id; ?>" type="button" class="btn btn-secondary mx-1">
                                        <i class="fa fa-address-card"></i> Edit Scholar Profile
                                        </a>
                                    </div>
                                </div>

                                <div class="row mx-auto justify-content-center">
                                    <div class="col-md-4 my-4">
                                        <div class="custom-file">
                                            <div class="text-center mb-4">
                                                <img class="img-fluid img-circle" id="profile-img" src="data:image/jpeg;base64, <?php echo base64_encode($row['img'] ?? ''); ?>" alt="User profile picture" style="width: 150px; height: 150px;">
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="form-group col-md-12">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="form-control" name="prof_img" id="prof_img" required>
                                                            <label for="prof_img" class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Personal Data-->
                                <div> 
                                    
                                    
                                    <div class="row mx-auto">
                                        <div class="col">
                                        <h2 class="text-center"><b>Learner/Manpower Profile</b></h2> 
                                        </div>
                                    </div>
                                    
                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Name</b></h4>
                                        </div>
                                    </div>

                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Last Name</label>
                                                <input disabled type="text" name="lastname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['lastname']; ?>" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>First Name</label>
                                                <input disabled type="text" name="firstname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['firstname']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Middle Name</label>
                                                <input disabled type="text" name="middlename" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['middlename']; ?>"
                                                    placeholder="Middle name">
                                            </div>
                                        </div>
                                        
                                    </div>

                                

                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                                <div class="my-3">
                                                <label>Middle Initial</label>
                                                    <input disabled type="text" name="middleinitial" class="form-control" autocomplete="off"
                                                            value="<?php echo $row['middleinitial']; ?>"
                                                        placeholder="Ex. B.">
                                                </div>
                                            </div>           
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Extension Name (e.g. Jr. Sr.)</label>
                                                <select disabled class="form-control" id="extname" name="extname">                                                
                                                    <?php 
                                                    $query_ext_name = mysqli_query($conn, "SELECT * FROM tbl_extension_name");
                                                    while ($row_ext_name = mysqli_fetch_array($query_ext_name)) {
                                                        $selected_ext_name = ($row['ext_name_id'] == $row_ext_name['ext_name_id']) ? 'selected' : ''; // Fix variable reference
                                                        echo '<option value="' . $row_ext_name['ext_name_id'] . '" ' . $selected_ext_name . '>' . $row_ext_name['ext_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Address</b></h4>
                                        </div>
                                    </div>
                                 
                                    
                                    
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Number & Street</label>
                                                <input disabled type="text" name="numstreet" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['num_street']; ?>"
                                                    placeholder="Enter your block number and street">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Barangay</label>
                                                <input disabled type="text" name="barangay" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['barangay']; ?>"
                                                    placeholder="Ex. Barangay 123">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Congressional District</label>
                                                <input disabled type="text" name="district" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['district']; ?>"
                                                    placeholder="Ex. District IV">
                                            </div>
                                        </div>                                     
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Municipality/City</label>
                                                <input disabled type="text" name="addmunicity" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['addmunicity']; ?>" placeholder="Ex. Tacloban City">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Province</label>
                                                <input disabled type="text" name="province" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['province']; ?>"
                                                    placeholder="Ex. Manila">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Region</label>
                                                <input disabled type="text" name="region" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['region']; ?>" placeholder="Ex. NCR">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                    <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Email Address</label>
                                                <input disabled type="email" name="email" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['email']; ?>"
                                                    placeholder="example@gmail.com">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Mobile Contact Number</label>
                                                <input disabled type="text" name="contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['contact']; ?>"
                                                    placeholder="Contact Number">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Nationality</label>
                                                <input disabled type="text" name="nationality" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['nationality']; ?>"
                                                    placeholder="Enter Nationality">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                            <label>Facebook</label>
                                            <input disabled type="text" name="fb_account" class="form-control" autocomplete="off" placeholder="Ex. FB: Juan Dela Cruz"
                                                value="<?php echo $row['fb_account']; ?>">
                                            </div>
                                        </div>   
                                        <div class="col-md-3">
                                            <div class="my-3">
                                            <label>FB Messenger</label>                                       
                                            <input disabled type="text" name="fb_mess" class="form-control" autocomplete="off" placeholder="Ex. FBM: Juan Dela Cruz"
                                            value="<?php echo $row['fb_mess']; ?>" >                                             
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                                                          
                                    <div class="row mx-auto">
                                        <div class="col">
                                        <h2 class="text-center"><b>Personal Information</b></h2> 
                                        </div>                                 
                                    </div>
                                                     
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Gender/Sex</label>                                       
                                                <select disabled class="form-control" id="gender" name="gender" placeholder="Select Gender">                                            
                                                    <?php 
                                                    $query1 = mysqli_query($conn, "SELECT * FROM tbl_genders");
                                                    while ($row_gender = mysqli_fetch_array($query1)) {
                                                        $selected = ($row['gender_id'] == $row_gender['gender_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_gender['gender_id'] . '" ' . $selected . '>' . $row_gender['gender_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>                                              
                                            </div>                                                                                                                      
                                        </div>

                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Civil Status</label>
                                                
                                                <select disabled class="form-control" id="civilstatus" name="civilstatus" placeholder="Select civilstatus">                                            
                                                    <?php 
                                                    $query_civil_status = mysqli_query($conn, "SELECT * FROM tbl_civil_status");
                                                    while ($row_civil_status = mysqli_fetch_array($query_civil_status)) {
                                                        $selected = ($row['civil_status_id'] == $row_civil_status['civil_status_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_civil_status['civil_status_id'] . '" ' . $selected . '>' . $row_civil_status['civil_status_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>    
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Employment Status</label>
                                                <select disabled class="form-control" id="employment" name="employment" placeholder="Select your answer">                                            
                                                    <?php 
                                                    $query_employment = mysqli_query($conn, "SELECT * FROM tbl_employment");
                                                    while ($row_employment = mysqli_fetch_array($query_employment)) {
                                                        $selected_employment = ($row['employment_id'] == $row_employment['employment_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_employment['employment_id'] . '" ' . $selected_employment . '>' . $row_employment['employment_status'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Birth Date</b></h4>
                                        </div>                                 
                                    </div>  

                                    <div class="row mx-auto justify-content-around">                              
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Year of birth</label>
                                                <input disabled type="date" name="birthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['birthdate']; ?>"
                                                    placeholder="Enter your birthdate">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Age</label>
                                                <input disabled type="text" name="age" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['age']; ?>"
                                                    placeholder="Enter Age Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Birth Place</b></h4>
                                        </div>                                 
                                    </div>

                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Birth Place (Province)</label>
                                                <input disabled type="text" name="bpprovince" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['bpprovince']; ?>"
                                                    placeholder="Ex. Metro Manila">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Birth Place (Municipality/City)</label>
                                                <input disabled type="text" name="bpmunicity" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['bpmunicity']; ?>"
                                                    placeholder="Ex. Manila">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Birth Place (Region)</label>
                                                <input disabled type="text" name="bpregion" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['bpregion']; ?>"
                                                    placeholder="Ex. Manila">
                                            </div>
                                        </div>                                                                    
                                    </div>

                                    <div class="row mx-auto">
                                        <div class="col-md-3">                        
                                            <h4><b>Educational Attainment</b></h4>
                                        </div>                                 
                                    </div>
                                    
                                    <div class="row mx-auto">
                                        <div class="col-md-3 mx-auto">
                                            <div class="my-3">
                                                <label>Educational Attainment Before The Training (Trainee)</label>
                                                <select disabled class="form-control" id="attainment" name="attainment" placeholder="Select your answer">                                            
                                                <?php 
                                                $query_attainment = mysqli_query($conn, "SELECT * FROM tbl_attainment");
                                                while ($row_attainment = mysqli_fetch_array($query_attainment)) {
                                                    $selected_attainment = ($row['attainment_id'] == $row_attainment['attainment_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_attainment['attainment_id'] . '" ' . $selected_attainment . '>' . $row_attainment['attainment_name'] . '</option>';
                                                }
                                                ?>
                                                </select>                                               
                                            </div>
                                        </div>  
                                    </div>
                                    
                                    <div class="row mx-auto">
                                        <div class="col-md-3">                                       
                                                <h4><b>Parent/Guardian</b></h4>                                                                                      
                                        </div>                                 
                                    </div>


                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Full Name</label>
                                                <input disabled type="text" name="cfullname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['cfullname']; ?>" placeholder="Ex. Juanita Dela Cruz">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Cell No.</label>
                                                <input disabled type="text" name="ccell_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['ccell_no']; ?>" placeholder="09123456789">
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Birthdate</label>
                                                <input disabled type="date" name="cbirthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['cbirthdate']; ?>" placeholder="First name">
                                            </div>
                                        </div>                                        
                                    </div>
                                    
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-6">
                                            <div class="my-3">
                                                <label>Parent/Guardian's Complete Mailing Address</label>
                                                <input disabled type="text" name="caddress" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['caddress']; ?>"
                                                    placeholder="Enter your Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Relationship to the scholar</label>
                                                <input disabled type="text" name="relationship" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['relationship']; ?>"
                                                    placeholder="Ex. Mother/Father">
                                            </div>
                                        </div>                 
                                    </div>

                                    <br>
                                    <h2 class="text-center"><b>NIBT Scholar Info</b></h2>       

                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Learner/Trainee/Student (Clients) Classification</b></h4>
                                        </div>                                 
                                    </div>

                                    <div class="row mx-auto justify-content-around">               
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Choose Which one fits you the best:</label>                                       
                                                <select disabled class="form-control" id="classification" name="classification" placeholder="Select your classification">                                            
                                                    <?php 
                                                    $query1 = mysqli_query($conn, "SELECT * FROM tbl_classifications");
                                                    while ($row_classification = mysqli_fetch_array($query1)) {
                                                        $selected = ($row['classification_id'] == $row_classification['classification_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_classification['classification_id'] . '" ' . $selected . '>' . $row_classification['classification_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>                                              
                                            </div>                                                                                                                      
                                        </div>
                                    </div>

                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Type of Disability</b></h4>
                                        </div>                                 
                                    </div>

                                    <div class="row mx-auto">                                       
                                        <div class="col-md-3 mx-auto">
                                            <div class="my-3">
                                                <label>Type of Disability (For Persons With Disability [PWDs] only)</label>

                                                <select disabled class="form-control" id="type_disability" name="type_disability" placeholder="Select your answer">                                            
                                                <?php 
                                                $query_type_disability = mysqli_query($conn, "SELECT * FROM tbl_type_disability");
                                                while ($row_type_disability = mysqli_fetch_array($query_type_disability)) {
                                                    $selected_type_disability = ($row['type_disability_id'] == $row_type_disability['type_disability_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_type_disability['type_disability_id'] . '" ' . $selected_type_disability . '>' . $row_type_disability['type_disability_name'] . '</option>';
                                                }
                                                ?>
                                                </select>   
                                            </div>                                         
                                        </div>                                      
                                    </div>

                                    <div class="row mx-auto">                                       
                                        <div class="col-md-3 mx-auto">
                                            <div class="my-3">
                                                <label>Cause of Disability (For Persons With Disability [PWDs] only)</label>

                                                <select disabled class="form-control" id="cause_disability" name="cause_disability" placeholder="Select your answer">                                            
                                                <?php 
                                                $query_cause_disability = mysqli_query($conn, "SELECT * FROM tbl_cause_disability");
                                                while ($row_cause_disability = mysqli_fetch_array($query_cause_disability)) {
                                                    $selected_cause_disability = ($row['cause_disability_id'] == $row_cause_disability['cause_disability_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_cause_disability['cause_disability_id'] . '" ' . $selected_cause_disability . '>' . $row_cause_disability['cause_disability_name'] . '</option>';
                                                }
                                                ?>
                                                </select>   
                                            </div>                                         
                                        </div>                                      
                                    </div>

                                    <div class="row mx-auto">
                                        <div class="col-md-3 mx-auto">
                                            <div class="my-3">
                                                <label>Name of Course/Qualification:</label>

                                                <select disabled class="form-control" id="courses" name="courses" placeholder="Select your answer">                                            
                                                <?php 
                                                $query_courses = mysqli_query($conn, "SELECT * FROM tbl_courses");
                                                while ($row_courses = mysqli_fetch_array($query_courses)) {
                                                    $selected_courses = ($row['course_id'] == $row_courses['course_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_courses['course_id'] . '" ' . $selected_courses . '>' . $row_courses['course_name'] . '</option>';
                                                }
                                                ?>
                                                </select> 
                                            </div>
                                        </div>                                                                        
                                    </div>
                                    
                                    <div class="row mx-auto">
                                        <div class="col-md-3 mx-auto">
                                            <div class="my-3">
                                                <label>Type of Scholarship Package:</label>

                                                <select disabled class="form-control" id="scholar_package" name="scholar_package" placeholder="Select your answer">                                            
                                                <?php 
                                                $query_scholar_package = mysqli_query($conn, "SELECT * FROM tbl_scholar_package");
                                                while ($row_scholar_package = mysqli_fetch_array($query_scholar_package)) {
                                                    $selected_scholar_package = ($row['scholar_package_id'] == $row_scholar_package['scholar_package_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_scholar_package['scholar_package_id'] . '" ' . $selected_scholar_package . '>' . $row_scholar_package['scholar_package_name'] . '</option>';
                                                }
                                                ?>
                                                </select> 
                                            </div>
                                        </div>                                                                        
                                    </div>

                                    <h2 class="text-center"><b>Disclaimer</b></h2>    

                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-9">
                                            <div class="my-3">
                                                <p>
                                                    <b>I hereby allow TESDA to use/post my contact details, name, email, cellphone/landline nos. and other information provided which may be used for processing my scholarship application, employment opportunities, and TESDA program surveys.</b>
                                                </p>                                                
                                            </div>
                                        </div>                                                                                                                                                          
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col-md-9">
                                            <div class="my-3 text-center">
                                                <?php 
                                                    // Set the 'checked' status based on the value in the database (0 for Disagree, 1 for Agree)
                                                    $checked_agree = (isset($_POST['disclaimer']) && $_POST['disclaimer'] == 1) || ($row['disclaimer'] == 1) ? 'checked' : ''; 
                                                    $checked_disagree = (isset($_POST['disclaimer']) && $_POST['disclaimer'] == 0) || ($row['disclaimer'] == 0) ? 'checked' : '';
                                                ?>
                                                <label>
                                                    <input disabled type="radio" name="disclaimer" value="1" <?php echo $checked_agree; ?>> I Agree
                                                </label>
                                                <label class="mx-3">
                                                    <input disabled type="radio" name="disclaimer" value="0" <?php echo $checked_disagree; ?>> I Disagree
                                                </label>
                                            </div>
                                        </div>                                                                                                                                                           
                                    </div>



                                     <!-- <div class="row mx-auto">                                  
                                        <div class="col-md-3 mx-auto">
                                            <div class="my-3">
                                                <label>Learners ID/ULI No. (For those who have already taken up any TESDA Course before)</label>
                                                <input disabled type="text" name="learneriduli" class="form-control" 
                                                autocomplete="off"  value="learner_iduli'" placeholder="Skip this section if first time taking a tesda course">
                                            </div>
                                        </div>                                
                                    </div> -->
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="input-group input-group-outline my-3">                                          
                                            <?php 
                                                if ($_SESSION['role'] == "Administrator") {
                                                    echo '<a class="btn btn-secondary" href="list.students.php">Go Back</a>';
                                                } elseif ($_SESSION['role'] == "Student") {
                                                    echo '<a class="btn btn-secondary" href="../dashboard/index.php">Go Back</a>';
                                                }  
                                            ?>                                                                                              
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-outline my-3 justify-content-end">
                                                <?php
                                                    if ($_SESSION['role'] !== "Student") {
                                                    echo '<button class="btn btn-danger" type="submit" name="submit">Submit</button>';
                                                    }  
                                                ?>
                                            
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                            </div>   
                                <!-- End -->
                                                                                                  
                    
                            <!-- End Inputs -->

                                
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    
            
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->

   
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include '../../includes/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include '../../includes/script.php'; ?> 

<script>
  $(document).ready(function () {
    $('#dataTable').DataTable();
  });
</script>


<script>
    const fileInput = document.getElementById('prof_img');
    const fileLabel = document.querySelector('label.custom-file-label');
    const profileImg = document.getElementById('profile-img');  // Reference to the image element
    const MAX_FILENAME_LENGTH = 20;

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            let fileName = this.files[0].name;
            const fileExtension = fileName.split('.').pop();
            const fileNameWithoutExtension = fileName.substring(0, fileName.length - fileExtension.length - 1);

            if (fileNameWithoutExtension.length > MAX_FILENAME_LENGTH) {
                const truncatedStart = fileNameWithoutExtension.substring(0, Math.floor(MAX_FILENAME_LENGTH / 2) - 2);
                const truncatedEnd = fileNameWithoutExtension.substring(fileNameWithoutExtension.length - 5);
                fileName = truncatedStart + '...' + truncatedEnd + '.' + fileExtension;
            }

            fileLabel.textContent = fileName;

            // Update the profile picture preview
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                profileImg.src = e.target.result; // Set the image source to the selected file
            };

            reader.readAsDataURL(file);
        } else {
            fileLabel.textContent = 'Choose file';
            profileImg.src = "data:image/jpeg;base64, <?php echo base64_encode($row['admin_image'] ?? $row['img'] ?? ''); ?>"; // Reset to default image
        }
    });
</script>

</body>
</html>
