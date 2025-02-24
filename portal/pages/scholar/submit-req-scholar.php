<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

<?php
  include '../../includes/links.php'; 

  // Fetch student_id safely
  $stud_id = isset($_GET['stud_id']) ? intval($_GET['stud_id']) : 0;
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
                        } elseif (!empty($_SESSION['success-del'])) {
                          echo ' <div class="alert alert-success fade show" role="alert">
                                      <div class="d-flex justify-content-between align-items-center">
                                          <span class="alert-text"><strong>Successfully Deleted!</strong></span>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                  </div>';
                          unset($_SESSION['success-del']);
                        }
                      ?>
            <div class="card card-secondary">

              <div class="card-header">
                <h3 class="card-title">?</h3>
              </div>
              <!-- /.card-header -->
       
              
                <div class="card-body pad table-responsive">  
                
                <?php 
                    // Fixed SQL query (removed extra comma)
                    $sql = "
                    SELECT 
                        tbl_students.*, 
                        tbl_student_requirements.birth_cert_img,
                        tbl_student_requirements.diploma_tor_img
                    FROM tbl_students               
                    LEFT JOIN tbl_student_requirements ON tbl_students.stud_id = tbl_student_requirements.stud_id";

                    if ($stud_id > 0) {
                        $sql .= " WHERE tbl_students.stud_id = $stud_id";
                    }

                    // Execute query
                    $get_stud = $conn->query($sql);
                    $row = $get_stud->fetch_array();
                  ?>
                
                    <input class="form-control" type="text" name="stud_id" value="<?php echo $row['stud_id']; ?>" hidden>
                     
                    <div class="row justify-content-center text-center">
                        
                        <h3><b>Scholar Requirement Checker</b></h3>
                        
                    </div>

                    <div class="container d-flex justify-content-center">
                        <div class="row justify-content-center text-center">
                            <div class="col-md-2">
                                <div class="my-3">
                                    <label class="form-label">First Name</label>
                                    <input disabled type="text" name="firstname" class="form-control text-center" autocomplete="off"
                                        value="<?php echo $row['firstname']; ?>" placeholder="First name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="my-3">
                                    <label class="form-label">Middle Name</label>
                                    <input disabled type="text" name="middlename" class="form-control text-center" autocomplete="off"
                                        value="<?php echo $row['middlename']; ?>" placeholder="Middle name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="my-3">
                                    <label class="form-label">Last Name</label>
                                    <input disabled type="text" name="lastname" class="form-control text-center" autocomplete="off"
                                        value="<?php echo $row['lastname']; ?>" placeholder="Last Name">
                                </div>
                            </div>
                        </div>                      
                    </div>

                    <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                      <!-- Hidden Student ID -->
                      <input type="text" class="form-control" name="stud_id" value="<?php echo htmlspecialchars($row['stud_id']); ?>" hidden>

                      <div class="row justify-content-around">
                          <!-- Birth Certificate Upload -->
                          <div class="col-md-3">
                              <div class="my-3">
                                  <!-- Document Label -->
                                  <label class="form-label">
                                      <?php if (!empty($row['birth_cert_img'])): ?>
                                          ✅ PSA Birth Cert. or Marriage Cert. (Uploaded)
                                      <?php else: ?>
                                          ⚠️ Please upload PSA Birth Cert. or Marriage Cert. (Required)
                                      <?php endif; ?>
                                  </label>

                                  <!-- File Upload Input -->
                                  <div class="custom-file mb-2">
                                      <input type="file" class="custom-file-input" name="certificate_img" accept="image/jpeg, image/png, application/pdf">
                                      <label class="custom-file-label">Choose file</label>
                                  </div>

                                  <!-- If Uploaded: Show Action Buttons -->
                                  <?php if (!empty($row['birth_cert_img'])): ?>
                                      <div class="d-flex align-items-center gap-2">
                                          <!-- View Button -->
                                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-cert-<?php echo $row['stud_id']; ?>">
                                              <i class="fa fa-eye"></i> View PSA
                                          </button>

                                          <!-- Delete Button -->
                                          <form method="POST" style="display:inline;">
                                              <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                              <input type="hidden" name="file_type" value="birth_cert_img">
                                              <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                                  <i class="fa fa-trash"></i> Delete
                                              </button>
                                          </form>
                                      </div>

                                      <!-- Uploaded Badge -->
                                      <span class="badge badge-success mt-2">Uploaded</span>
                                  <?php endif; ?>
                              </div>

                              <!-- Modal for Viewing Uploaded Image -->
                              <div class="modal fade" id="modal-cert-<?php echo $row['stud_id']; ?>">
                                  <div class="modal-dialog modal-xl">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title">PSA/Marriage Certificate</h4>
                                              <button type="button" class="close" data-dismiss="modal">
                                                  <span>&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body text-center">
                                              <?php if (!empty($row['birth_cert_img'])): ?>
                                                  <img src="data:image/jpeg;base64,<?php echo base64_encode($row['birth_cert_img']); ?>" class="img-fluid">
                                              <?php else: ?>
                                                  <p>No image uploaded.</p>
                                              <?php endif; ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- Diploma or ToR Upload -->
                          <div class="col-md-3">
                            <div class="my-3">
                                <!-- Document Label -->
                                <label class="form-label">
                                    <?php if (!empty($row['diploma_tor_img'])): ?>
                                        ✅ Diploma/TOR (Uploaded)
                                    <?php else: ?>
                                        ⚠️ Please upload Diploma/TOR (Required)
                                    <?php endif; ?>
                                </label>

                                <!-- File Upload Input -->
                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" name="diploma_tor_img" accept="image/jpeg, image/png, application/pdf">
                                    <label class="custom-file-label">Choose file</label>
                                </div>

                                <!-- If Uploaded: Show Action Buttons -->
                                <?php if (!empty($row['diploma_tor_img'])): ?>
                                    <div class="d-flex align-items-center gap-2">
                                        <!-- View Button -->
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-diploma-<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-eye"></i> View Diploma/TOR
                                        </button>

                                        <!-- Delete Button -->
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                            <input type="hidden" name="file_type" value="diploma_tor_img">
                                            <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Uploaded Badge -->
                                    <span class="badge badge-success mt-2">Uploaded</span>
                                <?php endif; ?>
                            </div>

                            <!-- Modal for Viewing Uploaded Image -->
                            <div class="modal fade" id="modal-diploma-<?php echo $row['stud_id']; ?>">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Diploma/TOR</h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <?php if (!empty($row['diploma_tor_img'])): ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['diploma_tor_img']); ?>" class="img-fluid">
                                            <?php else: ?>
                                                <p>No image uploaded.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>

                      </div>

                      <div class="row justify-content-center">
                          <div class="col-md-3">
                              <div class="my-3 text-center">

                                  <button class="btn btn-danger" type="submit" name="submit">Upload</button>
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





</body>
</html>
