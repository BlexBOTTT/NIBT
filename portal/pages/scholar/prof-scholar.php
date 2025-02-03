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
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

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
              <!-- <div class="row justify-content-center">
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
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-4">
                                                <div class="my-3">
                                                <label>Middle Initial</label>
                                                    <input type="text" name="birthplace" class="form-control" autocomplete="off"
                                                            value="<?php echo $row['birthplace']; ?>"
                                                        placeholder="Enter your Place of Birth">
                                                </div>
                                            </div>           
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Extension Name (e.g. Jr. Sr.)</label>
                                                <select class="form-control" id="extname" name="extname" placeholder="Select your answer">                                            
                                                    <?php 
                                                    $query_ext_name = mysqli_query($conn, "SELECT * FROM tbl_extension_name");
                                                    while ($row_ext_name = mysqli_fetch_array($query_ext_name)) {
                                                        $selected_ext_name = ($row['ext_name_id'] == $row_ext_name['ext_name_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row_ext_name['ext_name_id'] . '" ' . $selected_marital . '>' . $row_ext_name['ext_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

            <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Birth Place (Province)</label>
                                                <input type="text" name="birthplace" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['birthplace']; ?>"
                                                    placeholder="Enter your Place of Birth">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Birth Place (Municipality/City)</label>
                                                <input type="text" name="birthplace" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['birthplace']; ?>"
                                                    placeholder="Enter your Place of Birth">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Date of birth</label>
                                                <input type="date" name="birthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['birthdate']; ?>"
                                                    placeholder="Enter your birthdate">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Civil Status</label>
                                                
                                                <select class="form-control" id="civilstatus" name="civilstatus" placeholder="Select your answer">                                            
                                                <?php 
                                                $query_ext_name = mysqli_query($conn, "SELECT * FROM tbl_civil_status");
                                                while ($row_ext_name = mysqli_fetch_array($query_ext_name)) {
                                                    $selected_ext_name = ($row['civil_status_id'] == $row_ext_name['civil_status_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_ext_name['civil_status_id'] . '" ' . $selected_marital . '>' . $row_ext_name['civil_status'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            </div>
                                        </div>                                
                                    </div>
                                    
                                                                      
                                </div>
                                                    

                                <div>
                                    <h2 class="text-center"><b>Contact Address</b></h2> 

                                    <div class="row mx-auto justify-content-around">
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
                                                <label>Mobile Contact Number</label>
                                                <input type="text" name="contact" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['contact']; ?>"
                                                    placeholder="Contact Number">
                                            </div>
                                        </div>
                                    </div>  
                                
                                    <div class="row mx-auto">
                                        <div class="col-md-12">
                                            <div class="my-3">
                                                <label>Number & Street</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['address']; ?>"
                                                    placeholder="Enter your Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto">
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Barangay</label>
                                                <input type="text" name="barangay" class="form-control" autocomplete="off"
                                                        value=""
                                                    placeholder="Ex. Barangay 123">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Congressional District</label>
                                                <input type="text" name="district" class="form-control" autocomplete="off"
                                                        value=""
                                                    placeholder="Ex. District IV">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Municipality/City</label>
                                                <input type="text" name="municipality-city" class="form-control" autocomplete="off"
                                                        value="" placeholder="Ex. Tacloban City">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="my-3">
                                                <label>Region</label>
                                                <input type="text" name="region" class="form-control" autocomplete="off"
                                                        value="" placeholder="Ex. NCR">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                            <label>Facebook</label>
                                            <input type="text" name="stud_no" class="form-control" autocomplete="off" placeholder="Ex. FB: Juan Dela Cruz"
                                                value="" >
                                            </div>
                                        </div>   
                                        <div class="col-md-4">
                                            <div class="my-3">
                                            <label>FB Messenger</label>                                       
                                            <input type="text" name="stud_no" class="form-control" autocomplete="off" placeholder="Ex. FBM: Juan Dela Cruz"
                                            value="" >                                             
                                            </div>
                                        </div>
                                    </div>                             
                                </div>

                                <!-- NIBT Scholar Info -->
                                <div>
                                    <br>
                                    <h2 class="text-center"><b>NIBT Scholar Info</b></h2>       
                                    <div class="row mx-auto">
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Which qualification(s) are you interested in? (You Can Select all 4 qualifications)</label> 
                                            </div>
                                        </div>                                                      
                                    </div>
                                    
                                    <div class="row mx-auto justify-content-around"> 
                                        <div class="col-md-">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="customCheckbox1" name="course" value="option1">
                                                <label class="form-check-label" for="customCheckbox1">Data Analytics</label>
                                                <br>
                                                <input class="form-check-input" type="checkbox" id="customCheckbox2" name="course" value="option2">
                                                <label class="form-check-label" for="customCheckbox2">Cyber Threat Monitoring</label>
                                                <br>
                                                <input class="form-check-input" type="checkbox" id="customCheckbox3" name="course" value="option3">
                                                <label class="form-check-label" for="customCheckbox3">RPG</label>
                                                <br>
                                                <input class="form-check-input" type="checkbox" id="customCheckbox4" name="course" value="option4">
                                                <label class="form-check-label" for="customCheckbox4">Legacy System / Cobol</label>
                                            </div>
                                        </div>                                        
                                    </div>
                                                


                                    <div class="row mx-auto">
                                     
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Learners ID/ULI No. (For those who have already taken up any TESDA Course before)</label>
                                                <input type="text" name="voc" class="form-control" autocomplete="off"  value="" placeholder="text">
                                            </div>
                                        </div>                                
                                    </div>

                                    <div class="row mx-auto">
                                     
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Educational Attainment Before The Training (Trainee)</label>
                                                <input type="text" name="voc" class="form-control" autocomplete="off"  value="" placeholder="text">
                                            </div>
                                        </div>                                
                                    </div>
                                    
                                    <div class="row mx-auto">                                       
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Institutional Requirements</label>
                                            </div>
                                            <div class="row mx-auto">                                        
                                        <div class="row mx-auto">
                                            <div class="col-md-">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="customCheckbox1" name="course" value="option1">
                                                    <label class="form-check-label" for="customCheckbox1">College Diploma</label>
                                                    <br>
                                                    
                                                    <input class="form-check-input" type="checkbox" id="customCheckbox2" name="course" value="option2">
                                                    <label class="form-check-label" for="customCheckbox2">Senior High School Diploma</label>
                                                    <br>

                                                    <input class="form-check-input" type="checkbox" id="customCheckbox2" name="course" value="option2">
                                                    <label class="form-check-label" for="customCheckbox2">High School Diploma</label>
                                                    <br>

                                                    <input class="form-check-input" type="checkbox" id="customCheckbox4" name="course" value="option4">
                                                    <label class="form-check-label" for="customCheckbox4">Live Birth / PSA</label>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row mx-auto">
                                        
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Employment Status</label>
                                                <select class="form-control" id="employment" name="employment" placeholder="Select your answer">                                            
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
                                        
                                        <div class="col-md-5 mx-auto">
                                            <div class="my-3">
                                                <label>Type of Disability (For Persons With Disability [PWDs] only)</label>
                                                <input type="text" name="elem" class="form-control" autocomplete="off"  value="" placeholder="text">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>   
                                <!-- E -->
                                <div>
                                    <br>
                                    <h2 class="text-center"><b>Emergency Contact (In case of emergency)</b></h2>
                                    
                                    <!-- Guardian -->
                                    <br>
                                    <div class="row mx-auto">
                                        <div class="col">
                                            <h4><b>Contact Person of the Scholar</b></h4>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-6">
                                            <div class="my-3">
                                                <label>Full Name</label>
                                                <input type="text" name="glastname" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['glastname']; ?>" placeholder="Ex. Juanita Dela Cruz">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Cell No.</label>
                                                <input type="text" name="gcell_no" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gcell_no']; ?>" placeholder="09123456789">
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Birthdate</label>
                                                <input type="date" name="gbirthdate" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['gbirthdate']; ?>" placeholder="First name">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-9">
                                            <div class="my-3">
                                                <label>Parent/Guardian's Complete Mailing Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['address']; ?>"
                                                    placeholder="Enter your Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-auto justify-content-around">
                                        <div class="col-md-4">
                                            <div class="my-3">
                                                <label>Relationship to the scholar</label>
                                                <input type="text" name="relationship" class="form-control" autocomplete="off"
                                                        value="<?php echo $row['relationship']; ?>"
                                                    placeholder="Ex. Mother/Father">
                                            </div>
                                        </div>                 
                                    </div>
                                </div>                                                                       
                    
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
