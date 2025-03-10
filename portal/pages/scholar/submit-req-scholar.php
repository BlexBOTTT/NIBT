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
                
                <?php 
                    // Fixed SQL query (removed extra comma)
                    $sql = "
                    SELECT 
                        tbl_students.*, 
                        tbl_student_requirements.*
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


                    <div class="row justify-content-center">

                        <!-- Birth Cert -->
                        <div class="col-md-4">
                            <?php if ($row['birth_cert_status'] == 'approved'): ?>
                                <div class="card collapsed-card">
                                <?php else: ?>
                                    <div class="card">
                                <?php endif; ?>
                                <!-- Document Label -->
                                <div class="card-header bg-info">
                                    <h3 class="card-title">
                                        <label class="form-label">
                                            <?php if ($row['birth_cert_status'] == 'approved'): ?>
                                                ✅ Approved PSA B.C./Marriage Cert.
                                            <?php elseif ($row['birth_cert_status'] == 'pending'): ?>
                                                ⚠️ Pending PSA B.C./Marriage Cert.
                                            <?php elseif ($row['birth_cert_status'] == 'rejected'): ?>
                                                ❌ Rejected PSA B.C./Marriage Cert. (Upload Again)
                                            <?php else: ?>
                                                ⚠️ Please upload PSA / Birth Certificate (Required)
                                            <?php endif; ?>
                                        </label>
                                    </h3>
                                    <div class="card-tools">
                                    <!-- Collapse Button -->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                            <!-- /.card-header -->
                                <div class="card-body">

                                    
                                        <!-- Hidden Student ID -->
                                    <input type="text" class="form-control" name="stud_id" value="<?php echo htmlspecialchars($row['stud_id']); ?>" hidden>

                                                <!-- Birth Certificate Upload -->                                                                       
                                                   
                                                <!-- File Upload Input -->
                                                <div class="custom-file mb-2">

                                                    <?php if ($row['birth_cert_status'] == 'approved'): ?>
                                                        <div class="text-center">
                                                            <div class="justifty-content-center">
                                                            <!-- View Button -->
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-birth-cert-approved-<?php echo $row['stud_id']; ?>">
                                                                <i class="fa fa-eye"></i> View PSA / Marriage
                                                            </button>           
                                                            </div>
                                                            <span class="badge badge-success mt-2">Success, Validated by an Admin</span>                      
                                                        </div>
                                                        <!-- Uploaded Badge -->
                                                        

                                                        <!-- Modal for Viewing Uploaded Image -->
                                                        <div class="modal fade" id="modal-birth-cert-approved-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-success">
                                                                        <h4 class="modal-title">Approved Diploma / ToR Image</h4>
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
                                                                    <div class="modal-footer">
                                                                        <p>Approved by: <b>ADMIN NAME</b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    <?php elseif ($row['birth_cert_status'] == 'pending'): ?>
                                                        <div class="text-center">
                                                            <div class="justifty-content-center">
                                                                <!-- View Button -->
                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-birth-cert-warning-<?php echo $row['stud_id']; ?>">
                                                                    <i class="fa fa-eye"></i> View PSA / Marriage
                                                                </button>                                 
                                                            </div>
                                                        <!-- Uploaded Badge -->
                                                            <span class="badge badge-warning mt-2">Uploaded, Waiting Validation from an Admin</span>
                                                        </div>

                                                        <!-- Modal for Viewing Uploaded Image -->
                                                        <div class="modal fade" id="modal-birth-cert-warning-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-warning">
                                                                        <h4 class="modal-title">Approved Diploma / ToR Image</h4>
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
                                                                    <div class="modal-footer">
                                                                        <p>Awaiting validation from any available admin</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php elseif ($row['birth_cert_status'] == 'rejected'): ?>
                                                        <div class="mt-3">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="birth_cert_img"> <!-- Set file type dynamically -->
                                                                <input type="file" class="custom-file-input" name="file_upload" accept="image/jpeg, image/png, application/pdf" required>
                                                                <label class="custom-file-label">Choose file</label>

                                                                <br>
                                                                <div class="text-center">
                                                                    <button class="btn btn-danger" type="submit" name="submit">Upload Image</button>      
                                                                    <br>
                                                                    <button type="button" class="btn btn-warning mt-3" data-toggle="modal" data-target="#modal-birth-cert-<?php echo $row['stud_id']; ?>">
                                                                    <i class="fa fa-eye"></i> View Reason of Rejection
                                                                </button>
                                                                </div>
                                                            </form>

                                                              
                                                            <div class="text-center">
                                                                
                                                            </div> 
                                                        </div>

                                                        
                                                        <!-- Modal for Viewing Rejection -->
                                                        <div class="modal fade" id="modal-birth-cert-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-warning">
                                                                        <h4 class="modal-title">Reason of Rejection </h4>
                                                                        <button type="button" class="close" data-dismiss="modal">
                                                                            <span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">                                                  
                                                                            <p><?php echo $row['birth_cert_reject_reason']?></p>
                                                                    </div>
                                                                    <div class="modal-footer">                                                  
                                                                            <p>Rejected by admin: <b>ADMIN NAME</b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                    <?php else: ?>             
                                                        <div class="mt-3">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="birth_cert_img"> <!-- Set file type dynamically -->
                                                                <input type="file" class="custom-file-input" name="file_upload" accept="image/jpeg, image/png, application/pdf" required>
                                                                <label class="custom-file-label">Choose file</label>

                                                                <br>
                                                                <div class="text-center">
                                                                    <button class="btn btn-danger" type="submit" name="submit">Upload Image</button>                                                                  
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    <?php endif; ?>
                                                </div>
                                                             
                                            
                                            <!-- button for submission -->
                                            <?php if ($row['birth_cert_status'] == 'approved'): ?>
                                            
                                            <?php elseif ($row['birth_cert_status'] == 'pending'): ?>
                                                
                                            <?php else: ?>  
                                                
                                            <?php endif; ?>
                                    
                                        <div class="my-3 text-center">
                                        <!-- Delete Buttons-->  
                                        <?php if ($row['birth_cert_status'] == 'approved'): ?>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del-cert-modal<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-trash"></i> Delete PSA-BC/Marriage Cert.
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
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No, Close</button>
                                                                <button type="submit " class="btn btn-secondary" name="delete">
                                                                    <i class="fa fa-trash"></i> Yes, Delete Image
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                              
                                        <?php  endif; ?> 
                                </div>
                                <!-- /.card-body -->
                                <!-- <div class="card-footer">
                                    
                                </div> -->
                            </div>
                            <!-- /.card -->                                                                                       
                            </div>    
                        </div>

                        <!-- Diploma / ToR -->
                        <div class="col-md-4">
                            <?php if ($row['diploma_tor_status'] == 'approved'): ?>
                                <div class="card collapsed-card">
                            <?php else: ?>
                                <div class="card">
                            <?php endif; ?>                           
                                <!-- Document Label -->
                                <div class="card-header bg-info">
                                    <h3 class="card-title">
                                        <label class="form-label">
                                            
                                            <?php if ($row['diploma_tor_status'] == 'approved'): ?>
                                                ✅ Approved Diploma / ToR
                                            <?php elseif ($row['diploma_tor_status'] == 'pending'): ?>
                                                ⚠️ Pending Diploma / ToR
                                            <?php elseif ($row['diploma_tor_status'] == 'rejected'): ?>
                                                ❌ Rejected Diploma / ToR (Upload Again)
                                            <?php else: ?>
                                                ⚠️ Please upload PSA / Birth Certificate (Required)
                                            <?php endif; ?>
                                        </label>
                                    </h3>
                                    <div class="card-tools">
                                    <!-- Collapse Button -->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                            <!-- /.card-header -->
                                <div class="card-body">

                                    
                                        <!-- Hidden Student ID -->
                                    <input type="text" class="form-control" name="stud_id" value="<?php echo htmlspecialchars($row['stud_id']); ?>" hidden>

                                                <!-- Birth Certificate Upload -->                                                                       
                                                   
                                                <!-- File Upload Input -->
                                                <div class="custom-file mb-2">

                                                    <?php if ($row['diploma_tor_status'] == 'approved'): ?>
                                                        <div class="text-center">
                                                            <div class="justifty-content-center">
                                                            <!-- View Button -->
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-diploma-tor-approved-<?php echo $row['stud_id']; ?>">
                                                                <i class="fa fa-eye"></i> View PSA / Marriage
                                                            </button>           
                                                            </div>
                                                            <span class="badge badge-success mt-2">Success, Validated by an Admin</span>                      
                                                        </div>
                                                        <!-- Uploaded Badge -->
                                                        

                                                        <!-- Modal for Viewing Uploaded Image -->
                                                        <div class="modal fade" id="modal-diploma-tor-approved-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-success">
                                                                        <h4 class="modal-title">Approved Diploma / ToR Image</h4>
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
                                                                    <div class="modal-footer">
                                                                        <p>Approved by: <b>ADMIN NAME</b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    <?php elseif ($row['diploma_tor_status'] == 'pending'): ?>
                                                        <div class="text-center">
                                                            <div class="justifty-content-center">
                                                                <!-- View Button -->
                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-diploma-tor-warning-<?php echo $row['stud_id']; ?>">
                                                                    <i class="fa fa-eye"></i> View PSA / Marriage
                                                                </button>                                 
                                                            </div>
                                                        <!-- Uploaded Badge -->
                                                            <span class="badge badge-warning mt-2">Uploaded, Waiting Validation from an Admin</span>
                                                        </div>

                                                        <!-- Modal for Viewing Uploaded Image -->
                                                        <div class="modal fade" id="modal-diploma-tor-warning-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-warning">
                                                                        <h4 class="modal-title">Approved Diploma / ToR Image</h4>
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
                                                                    <div class="modal-footer">
                                                                        <p>Awaiting validation from any available admin</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php elseif ($row['diploma_tor_status'] == 'rejected'): ?>
                                                        <div class="mt-3">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="diploma_tor_img"> <!-- Set file type dynamically -->
                                                                <input type="file" class="custom-file-input" name="file_upload" accept="image/jpeg, image/png, application/pdf" required>
                                                                <label class="custom-file-label">Choose file</label>

                                                                <br>
                                                                <div class="text-center">
                                                                    <button class="btn btn-danger" type="submit" name="submit">Upload Image</button>      
                                                                    <br>
                                                                    <button type="button" class="btn btn-warning mt-3" data-toggle="modal" data-target="#modal-birth-cert-reject-<?php echo $row['stud_id']; ?>">
                                                                    <i class="fa fa-eye"></i> View Reason of Rejection
                                                                </button>
                                                                </div>
                                                            </form>

                                                              
                                                            <div class="text-center">
                                                                
                                                            </div> 
                                                        </div>

                                                        
                                                        <!-- Modal for Viewing Rejection -->
                                                        <div class="modal fade" id="modal-birth-cert-reject-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-warning">
                                                                        <h4 class="modal-title">Reason of Rejection </h4>
                                                                        <button type="button" class="close" data-dismiss="modal">
                                                                            <span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">                                                  
                                                                            <p><?php echo $row['diploma_tor_reject_reason']?></p>
                                                                    </div>
                                                                    <div class="modal-footer">                                                  
                                                                            <p>Rejected by admin: <b>ADMIN NAME</b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                    <?php else: ?>             
                                                        <div class="mt-3">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="diploma_tor_img"> <!-- Set file type dynamically -->
                                                                <input type="file" class="custom-file-input" name="file_upload" accept="image/jpeg, image/png, application/pdf" required>
                                                                <label class="custom-file-label">Choose file</label>

                                                                <br>
                                                                <div class="text-center">
                                                                    <button class="btn btn-danger" type="submit" name="submit">Upload Image</button>                                                                  
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    <?php endif; ?>
                                                </div>
                                                             
                                            
                                            <!-- button for submission -->
                                            <?php if ($row['diploma_tor_status'] == 'approved'): ?>
                                            
                                            <?php elseif ($row['diploma_tor_status'] == 'pending'): ?>
                                                
                                            <?php else: ?>  
                                                
                                            <?php endif; ?>
                                    
                                        <div class="my-3 text-center">
                                        <!-- Delete Buttons-->  
                                        <?php if ($row['diploma_tor_status'] == 'approved'): ?>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del-diploma-tor-modal<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-trash"></i> Delete Diploma / ToR
                                            </button>
                                                        
                                            <!-- Delete Modal Window -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="del-diploma-tor-modal<?php echo $row['stud_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Diploma / ToR</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete Delete Diploma / ToR for Scholar <strong><?php echo $user_fullname; ?></strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="diploma_tor_img">

                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No, Close</button>

                                                                <button type="submit " class="btn btn-secondary" name="delete">
                                                                    <i class="fa fa-trash"></i> Yes, Delete Diploma / ToR
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                              
                                        <?php  endif; ?> 
                                </div>
                                <!-- /.card-body -->
                                <!-- <div class="card-footer">
                                    
                                </div> -->
                            </div>
                            <!-- /.card -->                                                                                       
                            </div>    
                        </div>

                        <!-- 1x1 Image -->
                        <div class="col-md-4">
                            <?php if ($row['1x1_status'] == 'approved'): ?>
                                <div class="card collapsed-card">
                            <?php else: ?>
                                <div class="card">
                            <?php endif; ?>
                                <!-- Document Label -->
                                <div class="card-header bg-info">
                                    <h3 class="card-title">
                                        <label class="form-label">
                                            <?php if ($row['1x1_status'] == 'approved'): ?>
                                                ✅ Approved 1x1 Image
                                            <?php elseif ($row['1x1_status'] == 'pending'): ?>
                                                ⚠️ Pending 1x1 Image
                                            <?php elseif ($row['1x1_status'] == 'rejected'): ?>
                                                ❌ Rejected 1x1 Image (Upload Again)
                                            <?php else: ?>
                                                ⚠️ Please upload 1x1 Image (Required)
                                            <?php endif; ?>
                                        </label>
                                    </h3>
                                    <div class="card-tools">
                                    <!-- Collapse Button -->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                            <!-- /.card-header -->
                                <div class="card-body">

                                    
                                        <!-- Hidden Student ID -->
                                    <input type="text" class="form-control" name="stud_id" value="<?php echo htmlspecialchars($row['stud_id']); ?>" hidden>

                                                <!-- Birth Certificate Upload -->                                                                       
                                                   
                                                <!-- File Upload Input -->
                                                <div class="custom-file mb-2">

                                                    <?php if ($row['1x1_status'] == 'approved'): ?>
                                                        <div class="text-center">
                                                            <div class="justifty-content-center">
                                                            <!-- View Button -->
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-1x1-approved-<?php echo $row['stud_id']; ?>">
                                                                <i class="fa fa-eye"></i> View PSA / Marriage
                                                            </button>           
                                                            </div>
                                                            <span class="badge badge-success mt-2">Success, Validated by an Admin</span>                      
                                                        </div>
                                                        <!-- Uploaded Badge -->
                                                        

                                                        <!-- Modal for Viewing Uploaded Image -->
                                                        <div class="modal fade" id="modal-1x1-approved-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-success">
                                                                        <h4 class="modal-title">Approved 1x1 Image</h4>
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
                                                                    <div class="modal-footer">
                                                                        <p>Approved by: <b>ADMIN NAME</b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    <?php elseif ($row['1x1_status'] == 'pending'): ?>
                                                        <div class="text-center">
                                                            <div class="justifty-content-center">
                                                                <!-- View Button -->
                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-1x1-warning-<?php echo $row['stud_id']; ?>">
                                                                    <i class="fa fa-eye"></i> View PSA / Marriage
                                                                </button>                                 
                                                            </div>
                                                        <!-- Uploaded Badge -->
                                                            <span class="badge badge-warning mt-2">Uploaded, Waiting Validation from an Admin</span>
                                                        </div>

                                                        <!-- Modal for Viewing Uploaded Image -->
                                                        <div class="modal fade" id="modal-1x1-warning-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-warning">
                                                                        <h4 class="modal-title">Approved 1x1 Image</h4>
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
                                                                    <div class="modal-footer">
                                                                        <p>Awaiting validation from any available admin</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php elseif ($row['1x1_status'] == 'rejected'): ?>
                                                        <div class="mt-3">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="1x1_img"> <!-- Set file type dynamically -->
                                                                <input type="file" class="custom-file-input" name="file_upload" accept="image/jpeg, image/png, application/pdf" required>
                                                                <label class="custom-file-label">Choose file</label>

                                                                <br>
                                                                <div class="text-center">
                                                                    <button class="btn btn-danger" type="submit" name="submit">Upload Image</button>      
                                                                    <br>
                                                                    <button type="button" class="btn btn-warning mt-3" data-toggle="modal" data-target="#modal-1x1-reject-<?php echo $row['stud_id']; ?>">
                                                                    <i class="fa fa-eye"></i> View Reason of Rejection
                                                                </button>
                                                                </div>
                                                            </form>

                                                              
                                                            <div class="text-center">
                                                                
                                                            </div> 
                                                        </div>

                                                        
                                                        <!-- Modal for Viewing Rejection -->
                                                        <div class="modal fade" id="modal-1x1-reject-<?php echo $row['stud_id']; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header btn-warning">
                                                                        <h4 class="modal-title">Reason of Rejection </h4>
                                                                        <button type="button" class="close" data-dismiss="modal">
                                                                            <span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">                                                  
                                                                            <p><?php echo $row['1x1_reject_reason']?></p>
                                                                    </div>
                                                                    <div class="modal-footer">                                                  
                                                                            <p>Rejected by admin: <b>ADMIN NAME</b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                    <?php else: ?>             
                                                        <div class="mt-3">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="1x1_img"> <!-- Set file type dynamically -->

                                                                <input type="file" class="custom-file-input" name="file_upload" accept="image/jpeg, image/png, application/pdf" required>
                                                                <label class="custom-file-label">Choose file</label>

                                                                <br>
                                                                <div class="text-center">
                                                                    <button class="btn btn-danger" type="submit" name="submit">Upload Image</button>                                                                  
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    <?php endif; ?>
                                                </div>
                                                             
                                            
                                            <!-- button for submission -->
                                            <?php if ($row['1x1_status'] == 'approved'): ?>
                                            
                                            <?php elseif ($row['1x1_status'] == 'pending'): ?>
                                                
                                            <?php else: ?>  
                                                
                                            <?php endif; ?>
                                    
                                        <div class="my-3 text-center">
                                        <!-- Delete Buttons-->  
                                        <?php if ($row['1x1_status'] == 'approved'): ?>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del-1x1-modal<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-trash"></i> Delete PSA-BC/Marriage Cert.
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
                                                            Are you sure you want to delete Delete PSA/Live Birth Certificate for Scholar <strong><?php echo $user_fullname; ?></strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="user-data/user-submit-req-scholar.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                                                <input type="hidden" name="file_type" value="1x1_img">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No, Close</button>
                                                                <button type="submit " class="btn btn-secondary" name="delete">
                                                                    <i class="fa fa-trash"></i> Yes, Delete Image
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                              
                                        <?php  endif; ?> 
                                </div>
                                <!-- /.card-body -->
                                <!-- <div class="card-footer">
                                    
                                </div> -->
                            </div>
                            <!-- /.card -->                                                                                       
                            </div>    
                        </div>

                    </div>

                    
               
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
