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
                          SELECT tbl_students.*, tbl_genders.gender_name 
                          FROM tbl_students
                          LEFT JOIN tbl_genders ON tbl_students.gender_id = tbl_genders.gender_id
                      ");
                      $res_count = $get_stud->num_rows;
                      if ($res_count == 0) {
                          // error code
                      }
                      $row = $get_stud->fetch_array();

                    ?>
                
                    <input class="form-control" type="text" name="stud_id" value="<?php echo $row['stud_id']; ?>" hidden>
                    
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
                                <td><img class="img-fluid"
                                          src="data:image/jpeg;base64, <?php echo base64_encode($row['img']); ?>"
                                          alt="image" style="height: 50px; width: 50px"></td>
                                <td><?php echo $row['lastname'] ?>, <?php echo $row['firstname'] ?>, <?php echo $row['middlename'] ?></td>
                                <td><?php echo $row['gender_name'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cert">
                                      <i class="fa fa-eye"></i>Placeholder -> <?php echo $row['stud_id']; ?> to be moved
                                    </button>

                                    <div class="modal fade" id="modal-cert">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Default Modal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>One fine body modal-cert&hellip;</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                          </div>
                                        </div>
                                        <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </td>
                                <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-BSRS">
                                      <i class="fa fa-eye"></i>Placeholder -> <?php echo $row['stud_id']; ?> to be moved
                                    </button>

                                    <div class="modal fade" id="modal-BSRS">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Default Modal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>One fine body modal-BSRS&hellip;</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                          </div>
                                        </div>
                                        <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </td>                          
                                <td>                             
                                <span class="badge badge-success">YES</span>
                                <span class="badge badge-danger">NO</span>
                                </td>

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
