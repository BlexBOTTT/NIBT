<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <?php include '../../includes/links.php'; 
  
    // fetch student_id
    
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
                    $get_stud = $conn->query("
                    SELECT 
                        tbl_students.*, 
                        tbl_genders.gender_name, 
                        tbl_student_requirements.birth_cert_img, 
                        tbl_student_requirements.diploma_tor_img 
                    FROM tbl_students
                    LEFT JOIN tbl_genders ON tbl_students.gender_id = tbl_genders.gender_id
                    LEFT JOIN tbl_student_requirements ON tbl_students.stud_id = tbl_student_requirements.stud_id
                    ");
            
                    if ($get_stud->num_rows == 0) {
                        echo "<p class='text-center text-danger'>No records found.</p>";
                    }
                ?>
            
                <div class="row justify-content-center text-center">                    
                    <h3><b>Scholar Requirement Checker</b></h3>                       
                </div>
            
                <table class="table table-bordered text-center" id="myTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Fullname</th>
                            <th>Gender</th>    
                            <th>PSA Birth Certificate or Marriage Certificate (for females)</th>                     
                            <th>Diploma/TOR</th>               
                            <th>Scholar Profile Filled?</th>
                            <th>Enrollment Status</th> 
                        </tr>  
                    </thead>                                             
                    <tbody>
                        <?php while ($row = $get_stud->fetch_array()): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row['img'])): ?>
                                        <img class="img-fluid" src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" alt="image" style="height: 50px; width: 50px">
                                    <?php else: ?>
                                        <span class="badge badge-secondary">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo "{$row['lastname']}, {$row['firstname']} {$row['middlename']}"; ?></td>
                                <td><?php echo $row['gender_name']; ?></td>
            
                                <!-- PSA/Marriage Certificate -->
                                <td>
                                    <?php if (!empty($row['birth_cert_img'])): ?>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cert-<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-eye"></i> View PSA
                                        </button>
                                        <br>
                                        <span class="badge badge-success">Uploaded</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Unavailable</span>
                                    <?php endif; ?>
            
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
                                </td>
            
                                <!-- Diploma/TOR -->
                                <td>
                                    <?php if (!empty($row['diploma_tor_img'])): ?>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-diploma-<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-eye"></i> View Diploma/TOR
                                        </button>
                                        <br>
                                        <span class="badge badge-success">Uploaded</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Unavailable</span>
                                    <?php endif; ?>
            
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
                                </td>
            
                                <!-- Scholar Profile Status -->
                                <td>
                                  <?php 
                                      // Define required fields (must not be empty)
                                      $required_fields = ['lastname','firstname', 'middlename', 'middleinitial', 'num_street', 'barangay', 'district', 'addmunicity', 'province', 'region', 'email', 'contact', 'nationality', 'age', 'bpmunicity', 'bpprovince', 'bpregion', 'cfullname', 'ccell_no', 'caddress', 'relationship', 'username', 'password']; 

                                      // Define fields that should not be '0' (meaning they must be updated)
                                      $non_zero_fields = ['gender_id', 'civilstatus', 'employment_id', 'attainment_id', 'classification_id', 'course_id', 'scholar_package_id', 'disclaimer']; 

                                      // Define required image fields
                                      $image_fields = ['img']; 
                                      
                                      // Define fields where '0' is acceptable
                                      $zero_allowed_fields = ['type_disability_id', 'cause_disability_id']; 

                                      // Check if required fields are empty
                                      $profile_complete = true; 
                                      foreach ($required_fields as $field) {
                                          if (empty($row[$field])) {
                                              $profile_complete = false;
                                              break;
                                          }
                                      }

                                      // Check if fields that should not be '0' are still '0'
                                      if ($profile_complete) { 
                                          foreach ($non_zero_fields as $field) {
                                              if (isset($row[$field]) && $row[$field] == 0) {
                                                  $profile_complete = false;
                                                  break;
                                              }
                                          }
                                      }

                                      // Check if birthdates are NULL, empty, or '0000-00-00'
                                      if ($profile_complete) {
                                          $invalid_birthdates = ['0000-00-00', '', null];
                                          if (in_array($row['birthdate'], $invalid_birthdates) || in_array($row['cbirthdate'], $invalid_birthdates)) {
                                              $profile_complete = false;
                                          }
                                      }

                                      // Check if required images are empty
                                      if ($profile_complete) {
                                          foreach ($image_fields as $field) {
                                              if (empty($row[$field])) {
                                                  $profile_complete = false;
                                                  break;
                                              }
                                          }
                                      }

                                      // Output result
                                      echo $profile_complete ? '<span class="badge badge-success">YES</span>' : '<span class="badge badge-danger">NO</span>';
                                  ?>
                              </td>

            
                                <!-- Enrollment Status -->
                                <td>
                                    <?php 
                                        switch ($row['enroll_status_id']) {
                                            case 0:
                                                echo '<span class="badge badge-warning">PENDING</span>';                                            
                                                break;
                                            case 1:
                                                echo '<span class="badge badge-success">ENROLLED</span>';
                                                break;
                                            case 2:
                                                echo '<span class="badge badge-danger">REJECTED</span>'; 
                                                break;
                                            default:
                                                echo '<span class="badge badge-secondary">UNKNOWN</span>';
                                                break;
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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
