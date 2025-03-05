<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


<?php
  include '../../includes/links.php'; 

  // Fetch student_id safely
  $stud_id = isset($_GET['stud_id']) ? intval($_GET['stud_id']) : 0;
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
            <h1 class="m-0">Scholar Config</h1>
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
                <h3 class="card-title">Scholar Requirement Checker</h3>
                
              </div>
              <!-- /.card-header -->
       
              
                <div class="card-body pad table-responsive">  
                
                <?php 
                    // Fixed SQL query (removed extra comma)
                    $sql = "
                    SELECT 
                        tbl_students.*, 
                        tbl_student_requirements.birth_cert_img,
                        tbl_student_requirements.diploma_tor_img,
                        tbl_student_requirements.1x1_img
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
                                            ✅ PSA / Birth Certificate (Uploaded)
                                        <?php else: ?>
                                            ⚠️ Please upload PSA / Birth Certificate (Required)
                                        <?php endif; ?>
                                    </label>

                                    <!-- File Upload Input -->
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" name="certificate_img" accept="image/jpeg, image/png, application/pdf">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>

                                    <div class="">
                                        <!-- If Uploaded: Show Action Buttons -->
                                        <?php if (!empty($row['birth_cert_img'])): ?>
                                            <div class="d-flex gap-2">
                                                <!-- View Button -->
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-birth-cert-<?php echo $row['stud_id']; ?>">
                                                    <i class="fa fa-eye"></i> View PSA / Marriage
                                                </button>                                 
                                            </div>
                                            <!-- Uploaded Badge -->
                                            <span class="badge badge-success mt-2">Uploaded</span>
                                        <?php endif; ?>
                                    </div>
                                  
                                </div>

                              <!-- Modal for Viewing Uploaded Image -->
                                <div class="modal fade" id="modal-birth-cert-<?php echo $row['stud_id']; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Diploma / ToR Image</h4>
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
                                            ✅ Diploma or ToR (Uploaded)
                                        <?php else: ?>
                                            ⚠️ Please upload Diploma or ToR (Required)
                                        <?php endif; ?>
                                    </label>

                                    <!-- File Upload Input -->
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" name="diploma_tor_img" accept="image/jpeg, image/png, application/pdf">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>

                                    <div class="">
                                        <!-- If Uploaded: Show Action Buttons -->
                                        <?php if (!empty($row['diploma_tor_img'])): ?>
                                            <div class="d-flex gap-2">
                                                <!-- View Button -->
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-diploma-tor-<?php echo $row['stud_id']; ?>">
                                                    <i class="fa fa-eye"></i> View Diploma / ToR
                                                </button>                                 
                                            </div>
                                            <!-- Uploaded Badge -->
                                            <span class="badge badge-success mt-2">Uploaded</span>
                                        <?php endif; ?>
                                    </div>
                                  
                                </div>

                              <!-- Modal for Viewing Uploaded Image -->
                                <div class="modal fade" id="modal-diploma-tor-<?php echo $row['stud_id']; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Diploma / ToR Image</h4>
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

                            <!-- 1x1 Upload -->
                            <div class="col-md-3">
                                <div class="my-3">
                                    <!-- Document Label -->
                                    <label class="form-label">
                                        <?php if (!empty($row['1x1_img'])): ?>
                                            ✅ 1x1 Picture (Uploaded)
                                        <?php else: ?>
                                            ⚠️ No 1x1 Picture (Required)
                                        <?php endif; ?>
                                    </label>

                                    <!-- File Upload Input -->
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" name="1x1_img" accept="image/jpeg, image/png, application/pdf">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>

                                    <div class="">
                                        <!-- If Uploaded: Show Action Buttons -->
                                        <?php if (!empty($row['1x1_img'])): ?>
                                            <div class="d-flex gap-2">
                                                <!-- View Button -->
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-1x1-<?php echo $row['stud_id']; ?>">
                                                    <i class="fa fa-eye"></i> View 1x1
                                                </button>                                 
                                            </div>
                                            <!-- Uploaded Badge -->
                                            <span class="badge badge-success mt-2">Uploaded</span>
                                        <?php endif; ?>
                                    </div>
                                  
                                </div>

                              <!-- Modal for Viewing Uploaded Image -->
                                <div class="modal fade" id="modal-1x1-<?php echo $row['stud_id']; ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">1x1 Image   </h4>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <?php if (!empty($row['1x1_img'])): ?>
                                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['1x1_img']); ?>" class="img-fluid">
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
                                    <button class="btn btn-danger" type="submit" name="submit">Upload Image(s)</button>
                                </div>
                            </div>
                        </div>                              

                    </form>
                          
                    <!-- Delete Buttons-->                                    
                    <div class="row justify-content-center">

                        <div class="col-md-3">
                            <div class="my-3 text-center">
                                <?php if (!empty($row['birth_cert_img'])): {?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del-cert-modal<?php echo $row['stud_id']; ?>">
                                    <i class="fa fa-trash"></i> Delete PSA/Live Birth Certificate
                                    </button>
                                                     
                                    <!-- Delete Modal Window -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="del-cert-modal<?php echo $row['stud_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Birth Certificate</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete Delete PSA/Live Birth Certificate for Scholar <strong><?php echo $user_fullname; ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                        <input type="hidden" name="file_type" value="birth_cert_img">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit " class="btn btn-secondary" name="delete">
                                                            <i class="fa fa-trash"></i> Delete Image
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } endif; ?>  
                                
                                <!-- <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                    <input type="hidden" name="file_type" value="birth_cert_img">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete PSA-CERT
                                    </button>
                                </form> -->
                            </div>                           
                        </div>
                            
                        <div class="col-md-3">
                            <div class="my-3 text-center">
                                <?php if (!empty($row['diploma_tor_img'])): {?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#diploma-tor-modal<?php echo $row['stud_id']; ?>">
                                    <i class="fa fa-trash"></i> Delete Diploma/ToR
                                    </button>
                                                     
                                    <!-- Delete Modal Window -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="diploma-tor-modal<?php echo $row['stud_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Diploma / ToR</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete Diploma/ToR for Scholar <strong><?php echo $user_fullname; ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                        <input type="hidden" name="file_type" value="diploma_tor_img">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-secondary" name="delete">
                                                            <i class="fa fa-trash"></i> Delete Image
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                             
                                <?php } endif; ?>  
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="my-3 text-center">
                                <?php if (!empty($row['1x1_img'])): {?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del-1x1-modal<?php echo $row['stud_id']; ?>">
                                    <i class="fa fa-trash"></i> Delete 1x1 Image
                                    </button>
                                                     
                                    <!-- Delete Modal Window -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="del-1x1-modal<?php echo $row['stud_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Birth Certificate</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete Delete 1x1 Image for Scholar <strong><?php echo $user_fullname; ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                        <input type="hidden" name="file_type" value="1x1_img">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit " class="btn btn-secondary" name="delete">
                                                            <i class="fa fa-trash"></i> Delete Image
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } endif; ?>                                            
                            </div>                           
                        </div>
                                
                    </div>            
                  
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
