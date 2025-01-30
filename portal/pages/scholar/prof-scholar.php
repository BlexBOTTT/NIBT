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
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="row justify-content-center">
                  <div class="col-md-5 mb-3 mt-4">
                      <form method="GET">
                          <div class="input-group">
                              <input type="search" class="form-control"
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
              </div>

                <div class="card-body pad table-responsive">
                
                    <!-- Start Inputs -->
                    <form action="userData/user.edit.prof.students.php" method="POST" enctype="multipart/form-data">
                                <?php
                                    $get_admin = $conn->query("SELECT * FROM tbl_students WHERE stud_id = '$_GET[stud_id]'");
                                    $res_count = $get_admin->num_rows;
                                    if ($res_count == 0) {
                                        // error code
                                    }
                                    $row = $get_admin->fetch_array();

                                ?>
                                
                                <input class="form-control" type="text" name="stud_id" value="<?php echo $row['stud_id']; ?>" hidden>
                                
                                        

                                <div class="row mx-auto justify-content-center">
                                    <div class="col-md-4 my-4">
                                        <div class="custom-file">
                                            <div class="text-center mb-4">
                                                <img id="profile-picture" class="img-fluid img-circle" src="data:image/jpeg;base64, <?php echo base64_encode($row['img']); ?>"
                                                    alt="User profile picture" style="width: 100px; height: 100px;">
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="form-group col-md-8">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <label class="custom-file-label" for="prof_img">Choose file</label>
                                                            <input type="file" class="custom-file-input" name="prof_img" id="prof_img" onchange="readURL(this);">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Personal Data-->
                                <div> 
                                    <br>
                                    <h2 class="text-center"><b>Personal Data</b></h2> 
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                            <label>Student No.</label>
                                            <input type="text" name="stud_no" class="form-control" autocomplete="off" placeholder="Student No."
                                                value="<?php echo $row['stud_no']; ?>" >
                                            </div>
                                        </div>   
                                        <div class="col-md-4">
                                            <div class="my-3">
                                            <label>Gender</label>                                       
                                                <select class="form-control" id="gender" name="gender" placeholder="Select Gender">                                            
                                                    <?php 
                                                    $query1 = mysqli_query($conn, "SELECT * FROM tbl_genders");
                                                    while ($row_gender = mysqli_fetch_array($query1)) {
                                                        $selected = ($row['gender_id'] == $row_gender['gender_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_gender['gender_id'] . '" ' . $selected . '>' . $row_gender['gender'] . '</option>';
                                                    }
                                                    ?>
                                                </select>                                              
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Last Name</label>
                                                <input type="text" name="lastname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['lastname']; ?>" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>First Name</label>
                                                <input type="text" name="firstname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['firstname']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Middle Name</label>
                                                <input type="text" name="middlename" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['middlename']; ?>"
                                                    placeholder="Middle name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-12">
                                            <div class="my-3">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['address']; ?>"
                                                    placeholder="Enter your Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Date of birth</label>
                                                <input type="date" name="birthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['birthdate']; ?>"
                                                    placeholder="Enter your birthdate">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Place of Birth</label>
                                                <input type="text" name="birthplace" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['birthplace']; ?>"
                                                    placeholder="Enter your Place of Birth">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Age</label>
                                                <input type="text" name="age" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['age']; ?>" placeholder="Enter your Age">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Civil Status</label>
                                                <input type="text" name="civilstatus" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['civilstatus']; ?>"
                                                    placeholder="Ex. Single/Married">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Citizenship</label>
                                                <input type="text" name="citizenship" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['citizenship']; ?>"
                                                    placeholder="Ex. Filipino">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Religion</label>
                                                <input type="text" name="religion" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['religion']; ?>" placeholder="Ex. Catholic">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Email Address</label>
                                                <input type="email" name="email" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['email']; ?>"
                                                    placeholder="example@gmail.com">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Contact Number</label>
                                                <input type="text" name="contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['contact']; ?>"
                                                    placeholder="Contact Number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Landline</label>
                                                <input type="text" name="landline" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['landline']; ?>"
                                                    placeholder="Landline Number">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <!-- Family Background -->
                                <div>
                                    <br>
                                    <h2 class="text-center"><b>Family Background</b></h2>
                                    <!-- Father  -->
                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Father</b></h4>
                                        </div>
                                    </div>
                                                
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Last Name</label>
                                                <input type="text" name="flastname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['flastname']; ?>"
                                                    placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>First name</label>
                                                <input type="text" name="ffirstname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['ffirstname']; ?>" 
                                                    placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Middle name</label>
                                                <input type="text" name="fmiddlename" class="form-control" autocomplete="off"
                                                    value="<?php echo $row['fmiddlename']; ?>"
                                                    placeholder="Middle Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Age</label>
                                                <input type="text" name="fage" class="form-control" autocomplete="off"
                                                    value="<?php echo $row['fage']; ?>" placeholder="00 yrs old">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Birthdate</label>
                                                <input type="date" name="fbirthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['fbirthdate']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Citizenship</label>
                                                <input type="text" name="fcitizenship" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['fcitizenship']; ?>"
                                                    placeholder="Ex. Filipino">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Home Address</label>
                                                <input type="text" name="faddress" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['faddress']; ?>" placeholder="Home Address">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Tel No.</label>
                                                <input type="text" name="ftel_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['ftel_no']; ?>" placeholder="0123-4567">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Cell No.</label>
                                                <input type="text" name="fcell_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['fcell_no']; ?>" placeholder="09123456789">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Education Attained</label>
                                                <input type="text" name="feducation" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['feducation']; ?>"
                                                    placeholder="Education Attained">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Occupation</label>
                                                <input type="text" name="foccupation" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['foccupation']; ?>"
                                                    placeholder="Occupation">
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <!-- Mother -->
                                    <br>
                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Mother</b></h4>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Last Name</label>
                                                <input type="text" name="mlastname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['mlastname']; ?>" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>First name</label>
                                                <input type="text" name="mfirstname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['mfirstname']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Middle name</label>
                                                <input type="text" name="mmiddlename" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['mmiddlename']; ?>"
                                                    placeholder="Middle name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Age</label>
                                                <input type="text" name="mage" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['mage']; ?>" placeholder="00 yrs old">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Birthdate</label>
                                                <input type="date" name="mbirthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['mbirthdate']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Citizenship</label>
                                                <input type="text" name="mcitizenship" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['mcitizenship']; ?>"
                                                    placeholder="Ex. Filipino">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Home Address</label>
                                                <input type="text" name="maddress" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['maddress']; ?>" placeholder="Home Address">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Tel No.</label>
                                                <input type="text" name="mtel_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['mtel_no']; ?>" placeholder="0123-4567">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Cell No.</label>
                                                <input type="text" name="mcell_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['mcell_no']; ?>" placeholder="09123456789">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Education Attained</label>
                                                <input type="text" name="meducation" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['meducation']; ?>"
                                                    placeholder="Education Attained">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Occupation</label>
                                                <input type="text" name="moccupation" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['moccupation']; ?>"
                                                    placeholder="Occupation">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Guardian -->
                                    <br>
                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Guardian</b></h4>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Last Name</label>
                                                <input type="text" name="glastname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['glastname']; ?>" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>First name</label>
                                                <input type="text" name="gfirstname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gfirstname']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Middle name</label>
                                                <input type="text" name="gmiddlename" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gmiddlename']; ?>"
                                                    placeholder="Middle name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Age</label>
                                                <input type="text" name="gage" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['gage']; ?>" placeholder="00 yrs old">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Birthdate</label>
                                                <input type="date" name="gbirthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gbirthdate']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Relationship</label>
                                                <input type="text" name="relationship" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['relationship']; ?>"
                                                    placeholder="Ex. Mother/Father">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Citizenship</label>
                                                <input type="text" name="gcitizenship" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gcitizenship']; ?>"
                                                    placeholder="Ex. Filipino">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Home Address</label>
                                                <input type="text" name="gaddress" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gaddress']; ?>" placeholder="Home Address">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Education Attained</label>
                                                <input type="text" name="geducation" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['geducation']; ?>"
                                                    placeholder="Education Attained">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Cell No.</label>
                                                <input type="text" name="gcell_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gcell_no']; ?>" placeholder="09123456789">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Tel No.</label>
                                                <input type="text" name="gtel_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gtel_no']; ?>" placeholder="0123-4567">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Occupation</label>
                                                <input type="text" name="goccupation" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['goccupation']; ?>"
                                                    placeholder="Occupation">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- Number of Siblings -->
                                    <br>
                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h2 class="text-center"><b>No. of Siblings</b></h2>
                                            <h6 class="text-center">(from first to last child)</h6>
                                        </div>
                                    </div>        
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <label>Full name</label>
                                                <input type="text" name="sib1_name" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib1_name']; ?>" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <label>Occupation</label>
                                                <input type="text" name="sib1_occ" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib1_occ']; ?>" placeholder="Occupation">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <label>Contact Number</label>
                                                <input type="text" name="sib1_contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib1_contact']; ?>"
                                                    placeholder="09123456789">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib2_name" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib2_name']; ?>" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib2_occ" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib2_occ']; ?>" placeholder="Occupation">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib2_contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib2_contact']; ?>"
                                                    placeholder="09123456789">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib3_name" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib3_name']; ?>" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib3_occ" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib3_occ']; ?>" placeholder="Occupation">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib3_contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib3_contact']; ?>"
                                                    placeholder="09123456789">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib4_name" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib4_name']; ?>" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib4_occ" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib4_occ']; ?>" placeholder="Occupation">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib4_contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib4_contact']; ?>"
                                                    placeholder="09123456789">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib5_name" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib5_name']; ?>" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib5_occ" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib5_occ']; ?>" placeholder="Occupation">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="sib5_contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['sib5_contact']; ?>"
                                                    placeholder="09123456789">
                                            </div>
                                        </div>
                                    </div>
                                </div>                
                                
                                <!-- Educational Background -->
                                <div>
                                    <br>
                                    <h2 class="text-center"><b>Educational Background</b></h2>                                            
                                    <div class="row mx-auto">
                                        <div class="col-md-2 mx-auto d-flex align-items-center">
                                            <div class="my-3">
                                                <span class="mt-3">College</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>School name</label>
                                                <input type="text" name="college" class="form-control" autocomplete="off"  value="<?php echo $row['college']; ?>" placeholder="School name">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Year Graduated</label>
                                                <input type="text" name="collegeSY" class="form-control" autocomplete="off"  value="<?php echo $row['collegeSY']; ?>" placeholder="Year Graduated">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-2 mx-auto d-flex align-items-center">
                                            <div class="my-3">
                                                <span class="mt-3">Vocational</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>School name</label>
                                                <input type="text" name="voc" class="form-control" autocomplete="off"  value="<?php echo $row['voc']; ?>" placeholder="School name">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Year Graduated</label>
                                                <input type="text" name="vocSY" class="form-control" autocomplete="off"  value="<?php echo $row['vocSY']; ?>" placeholder="Year Graduated">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-2 mx-auto d-flex align-items-center">
                                            <div class="my-3">
                                                <span class="mt-3">Senior High School</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>School name</label>
                                                <input type="text" name="shs" class="form-control" autocomplete="off"  value="<?php echo $row['shs']; ?>" placeholder="School name">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Year Graduated</label>
                                                <input type="text" name="shsSY" class="form-control" autocomplete="off"  value="<?php echo $row['shsSY']; ?>" placeholder="Year Graduated">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-2 mx-auto d-flex align-items-center">
                                            <div class="my-3">
                                                <span class="mt-3">Junior High School</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>School name</label>
                                                <input type="text" name="jhs" class="form-control" autocomplete="off"  value="<?php echo $row['jhs']; ?>" placeholder="School name">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Year Graduated</label>
                                                <input type="text" name="jhsSY" class="form-control" autocomplete="off"  value="<?php echo $row['jhsSY']; ?>" placeholder="Year Graduated">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-2 mx-auto d-flex align-items-center">
                                            <div class="my-3">
                                                <span class="mt-3">Grade School</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>School name</label>
                                                <input type="text" name="elem" class="form-control" autocomplete="off"  value="<?php echo $row['elem']; ?>" placeholder="School name">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Year Graduated</label>
                                                <input type="text" name="elemSY" class="form-control" autocomplete="off"  value="<?php echo $row['elemSY']; ?>" placeholder="Year Graduated">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Voluntary Work/Athletic Affiliation -->
                                <div>
                                    <br>
                                    <h2 class="text-center"><b>Voluntary Work/Athletic Affiliation</b></h2>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <label>Organizations/Athletics</label>
                                                <input type="text" name="org1" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['org1']; ?>" placeholder="Enter Org. name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <label>Service Rendered</label>
                                                <input type="text" name="org1_serv" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org1_serv']; ?>"
                                                    placeholder="Services Rendered">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <label>Date of Affiliation/Membership</label>
                                                <input type="text" name="org1_date" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org1_date']; ?>"
                                                    placeholder="Date of Affiliation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org2" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['org2']; ?>" placeholder="Enter Org. name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org2_serv" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org2_serv']; ?>"
                                                    placeholder="Services Rendered">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org2_date" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org2_date']; ?>"
                                                    placeholder="Date of Affiliation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org3" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['org3']; ?>" placeholder="Enter Org. name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org3_serv" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org3_serv']; ?>"
                                                    placeholder="Services Rendered">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org3_date" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org3_date']; ?>"
                                                    placeholder="Date of Affiliation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org4" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['org4']; ?>" placeholder="Enter Org. name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org4_serv" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org4_serv']; ?>"
                                                    placeholder="Services Rendered">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org4_date" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org4_date']; ?>"
                                                    placeholder="Date of Affiliation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org5" class="form-control" autocomplete="off" 
                                                    value="<?php echo $row['org5']; ?>" placeholder="Enter Org. name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org5_serv" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org5_serv']; ?>"
                                                    placeholder="Services Rendered">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="my-1">
                                                <input type="text" name="org5_date" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['org5_date']; ?>"
                                                    placeholder="Date of Affiliation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Student's Life Information -->
                                <div>
                                    <br>
                                    <h2 class="text-center"><b>Student's Life Information</b></h2>
                                    <div class="row mx-auto justify-content-center">
                                        <div class="col-md-2">
                                            <div class="my-3">
                                                <span class="mt-1">1. Parent's Marital Status</span>

                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="my-3">
                                                <select class="form-control" id="marital" name="marital" placeholder="Select your answer">                                            
                                                    <?php 
                                                    $query_marital = mysqli_query($conn, "SELECT * FROM tbl_marital");
                                                    while ($row_marital = mysqli_fetch_array($query_marital)) {
                                                        $selected_marital = ($row['marital_id'] == $row_marital['marital_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_marital['marital_id'] . '" ' . $selected_marital . '>' . $row_marital['marital_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-center">
                                        <div class="col-md-2">
                                            <div class="my-3">
                                                <span class="mt-1">2. Who finances your schooling</span>                                                                 
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="my-3">
                                                <select class="form-control" id="finances" name="finances" placeholder="Select your answer">                                            
                                                    <?php 
                                                    $query_fin = mysqli_query($conn, "SELECT * FROM tbl_finances");
                                                    while ($row_fin = mysqli_fetch_array($query_fin)) {
                                                        $selected_fin = ($row['fin_id'] == $row_fin['fin_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_fin['fin_id'] . '" ' . $selected_fin . '>' . $row_fin['fin_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-center">
                                        <div class="col-md-2">
                                            <div class="my-3">
                                                <span class="mt-1">3. How much is your daily allowance</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="my-3">
                                                <select class="form-control" id="allowance" name="allowance" placeholder="Select your answer">                                            
                                                    <?php 
                                                    $query_allowance = mysqli_query($conn, "SELECT * FROM tbl_allowance");
                                                    while ($row_allowance = mysqli_fetch_array($query_allowance)) {
                                                        $selected_allowance = ($row['allowance_id'] == $row_allowance['allowance_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_allowance['allowance_id'] . '" ' . $selected_allowance . '>' . $row_allowance['allowance_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-center">
                                        <div class="col-md-2">
                                            <div class="my-3">
                                                <span class="mt-1">4. Family Income (Monthly)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="my-3">
                                                <select class="form-control" id="income" name="income" placeholder="Select your answer">                                            
                                                    <?php 
                                                    $query_income = mysqli_query($conn, "SELECT * FROM tbl_income");
                                                    while ($row_income = mysqli_fetch_array($query_income)) {
                                                        $selected_income = ($row['income_id'] == $row_income['income_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_income['income_id'] . '" ' . $selected_income . '>' . $row_income['income_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-center">
                                        <div class="col-md-2">
                                            <div class="my-3">
                                                <span class="mt-1">5. Nature of Residence</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="my-3">
                                                <select class="form-control" id="residence" name="residence" placeholder="Select your answer">                                            
                                                    <?php 
                                                    $query_residence = mysqli_query($conn, "SELECT * FROM tbl_residence");
                                                    while ($row_residence = mysqli_fetch_array($query_residence)) {
                                                        $selected_income = ($row['residence_id'] == $row_residence['residence_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_residence['residence_id'] . '" ' . $selected_income . '>' . $row_residence['residence_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Health -->
                                <div>
                                    <br>
                                    <h2 class="text-center"><b>Health</b></h2>
                                    <!-- A. Physical -->
                                    <div>
                                        <div class="row mx-auto">
                                            <div class="col">
                                                <h5 class="">A. Physical</h5>
                                                <h6>Do you have problems with your physical body?</h6>
                                            </div>
                                        </div>     
                                        <div class="row mx-auto justify-content-center">                                          
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-3">Your vision</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                <select class="form-control" id="vision" name="vision" autocomplete="off" placeholder="Select your answer">
                                                    <option value="Yes" <?php if ($row['vision'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                    <option value="No" <?php if ($row['vision'] == 'No') { echo 'selected'; } ?>>No</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mt-3">
                                                    <input type="text" name="vision_spec" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['vision_spec']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-1">Your hearing</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <select class="form-control" id="hearing" name="hearing" autocomplete="off" placeholder="Select your answer">
                                                        <option value="Yes" <?php if ($row['hearing'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php if ($row['hearing'] == 'No') { echo 'selected'; } ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mt-3">
                                                    <input type="text" name="hearing_spec" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['hearing_spec']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-1">Your speech</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <select class="form-control" id="speech" name="speech" autocomplete="off" placeholder="Select your answer">
                                                        <option value="Yes" <?php if ($row['speech'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php if ($row['speech'] == 'No') { echo 'selected'; } ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mt-3">
                                                    <input type="text" name="speech_spec" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['speech_spec']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-1">Your general health</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <select class="form-control" id="gen_health" name="gen_health" autocomplete="off" placeholder="Select your answer">                                                          
                                                        <option value="Yes" <?php if ($row['gen_health'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php if ($row['gen_health'] == 'No') { echo 'selected'; } ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mt-3">
                                                    <input type="text" name="gen_health_spec" class="form-control" autocomplete="off"  placeholder="If yes, please specify:"
                                                    value="<?php echo $row['gen_health_spec']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- B. Socio-psychological -->                
                                    <div>
                                        <div class="row mx-auto">
                                            <div class="col">
                                                <h5 class="">B. Socio-psychological</h5>
                                            </div>
                                        </div>  
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                        
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="m-3">Yes / No</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="m-3">When</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="m-3">For what</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-3">Psychiatrist</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    
                                                    <select class="form-control" id="psychiatrist" name="psychiatrist" autocomplete="off" placeholder="Select your answer">                                                          
                                                        <option value="Yes" <?php if ($row['psychiatrist'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php if ($row['psychiatrist'] == 'No') { echo 'selected'; } ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    
                                                    <input type="text" name="psychiatrist_when" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['psychiatrist_when']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">                                          
                                                    <input type="text" name="psychiatrist_what" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['psychiatrist_what']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-3">Psychologist</span>

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <select class="form-control" id="psychologist" name="psychologist" autocomplete="off" placeholder="Select your answer">                                                          
                                                        <option value="Yes" <?php if ($row['psychologist'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php if ($row['psychologist'] == 'No') { echo 'selected'; } ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    
                                                    <input type="text" name="psychologist_when" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['psychologist_when']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">                                          
                                                    <input type="text" name="psychologist_what" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['psychologist_what']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-3">Counselor</span>

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <select class="form-control" id="counselor" name="counselor" autocomplete="off" placeholder="Select your answer">                                                          
                                                        <option value="Yes" <?php if ($row['counselor'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php if ($row['counselor'] == 'No') { echo 'selected'; } ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    
                                                    <input type="text" name="counselor_when" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['counselor_when']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="my-3">                                          
                                                    <input type="text" name="counselor_what" class="form-control" autocomplete="off" placeholder="If yes, please specify:"
                                                    value="<?php echo $row['counselor_what']?>">
                                                </div>
                                            </div>
                                        </div>

                                
                                    </div>
                                </div>

                                <!-- Interest and Hobbies -->
                                <div>
                                    <br>
                                    <h2 class="text-center my-3"><b>Interest and Hobbies</b></h2>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-3">1. Favorite Academic Subjects</span>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="my-3">
                                                    <select class="form-control" id="acad_sub" name="acad_sub" placeholder="Select your answer">                                       
                                                        <?php 
                                                        $query_acad_sub = mysqli_query($conn, "SELECT * FROM tbl_acad_subjects");
                                                        while ($row_acad_sub = mysqli_fetch_array($query_acad_sub)) {
                                                            $selected_acad_sub = ($row['acad_sub_id'] == $row_acad_sub['acad_sub_id']) ? 'selected' : '';
                                                            echo '<option value="' . $row_acad_sub['acad_sub_id'] . '" ' . $selected_acad_sub . '>' . $row_acad_sub['acad_sub_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>                   
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mt-3">     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="my-3">
                                                    <span class="mt-3">2. Extra - Curricular and Organizations</span>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="my-3">
                                                    <select class="form-control" id="curri_org" name="curri_org" placeholder="Select your answer">                                       
                                                        <?php 
                                                        $query_curri_org = mysqli_query($conn, "SELECT * FROM tbl_curri_org");
                                                        while ($row_curri_org = mysqli_fetch_array($query_curri_org)) {
                                                            $selected_curri_org = ($row['curri_org_id'] == $row_curri_org['curri_org_id']) ? 'selected' : '';
                                                            echo '<option value="' . $row_curri_org['curri_org_id'] . '" ' . $selected_curri_org . '>' . $row_curri_org['curri_org_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mt-3">
                                                <input type="text" id="curri_org_spec" name="curri_org_spec" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['curri_org_spec']; ?>"
                                                    placeholder="If others, pleace specify">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-2">
                                                <div class="input-group input-group-static my-3">
                                                    <span class="mt-3">3. Position in Organization</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group input-group-static my-3">
                                                    <select class="form-control" id="pos_org" name="pos_org" autocomplete="off" placeholder="Select your answer">                                                          
                                                        <option value="Officer" <?php if ($row['pos_org'] == 'Officer') { echo 'selected'; } ?>>Officer</option>
                                                        <option value="Member" <?php if ($row['pos_org'] == 'Member') { echo 'selected'; } ?>>Member</option>
                                                    </select>
                                                </div>  
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group input-group-static mt-3">
                                                </div>
                                            </div>
                                        </div>                    
                                </div>
                                
                                <!-- Display student evaluation and note if logged as admin role -->
                                <?php
                                    if ($_SESSION['role'] == "Administrator") {
                                        echo '
                                        <!-- Testing and Student Evaluation -->
                                        <div>
                                            <h2 class="text-center my-3"><b>Testing and Student Evaluation</b></h2>
                                            <h5 class="text-center my-3">(to be filled up by a psychometrician)</h5>
                                            <div class="table-responsive p-0 mx-3">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr class="light">
                                                            <th>Date of Assessment</th>
                                                            <th>Nature of Exam</th>
                                                            <th>Name of Test</th>
                                                            <th>Key Result</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                        $get_eval = mysqli_query($conn, "SELECT * FROM tbl_evaluation WHERE stud_id = '" . $_GET['stud_id'] . "'");
                                        while ($row = mysqli_fetch_array($get_eval)) {
                                            $id = $row['stud_id'];
                                            echo '
                                                        <tr>
                                                            <td>' . $row['date'] . '</td>
                                                            <td>' . $row['exam'] . '</td>
                                                            <td>' . $row['test'] . '</td>
                                                            <td>' . $row['result'] . '</td>
                                                            <td>' . $row['description'] . '</td>
                                                        </tr>';
                                        }

                                        echo '
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Significant Notes -->
                                        <div>
                                            <h2 class="text-center my-3"><b>Significant Notes</b></h2>
                                            <h5 class="text-center my-3">(to be filled up by the school counselor)</h5>
                                            <div class="table-responsive p-0 mx-3">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr class="light">
                                                            <th>Date</th>
                                                            <th>Incident</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                        $get_notes = mysqli_query($conn, "SELECT * FROM tbl_notes WHERE stud_id = '" . $_GET['stud_id'] . "'");
                                        while ($row = mysqli_fetch_array($get_notes)) {
                                            $id = $row['stud_id'];
                                            echo '
                                                        <tr>
                                                            <td>' . $row['date'] . '</td>
                                                            <td>' . $row['incident'] . '</td>
                                                            <td>' . $row['remarks'] . '</td>
                                                        </tr>';
                                        }

                                        echo '
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>';
                                    }
                                ?>
                    
                            <!-- End Inputs -->

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
                                    <div class="col-md-4 ">
                                        <div class="input-group input-group-outline my-3 justify-content-end">
                                            <button class="btn btn-danger" type="submit" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
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

</body>
</html>
