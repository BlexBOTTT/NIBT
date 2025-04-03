<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php include '../../includes/links.php'; ?>

  
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
            <h1 class="m-0">Course Config</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
              <li class="breadcrumb-item active">Course Config</li>
              <li class="breadcrumb-item active">Assign Course/Batches</li>
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
                        } elseif (!empty(   $_SESSION['success-del'])) {
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Course Configuration</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- card-body -->
              <div class="card-body pad table-responsive">  
                
                <?php
                    $stud_id = isset($_GET['stud_id']) ? intval($_GET['stud_id']) : 0;

                    // Prepare the query
                    $sql = "SELECT 
                            tbl_students.*,
                            tbl_student_requirements.*,
                            tbl_genders.gender_name                            
                        FROM tbl_students
                        LEFT JOIN tbl_genders ON tbl_students.gender_id = tbl_genders.gender_id
                        LEFT JOIN tbl_student_requirements ON tbl_students.stud_id = tbl_student_requirements.stud_id
                        ";

                    if ($stud_id > 0) {
                        $sql .= " WHERE tbl_students.stud_id = $stud_id";
                    }

                    // Execute the query
                    $get_stud = $conn->query($sql);

                    // Check if query executed successfully
                    if (!$get_stud) {
                        die("Query Error: " . $conn->error);
                    }

                    // Check if a student is selected to show the back button
                    if ($stud_id > 0) {
                        echo '<div class="row justify-content-center text-center">
                            <a href="list-req-scholar.php" class="btn btn-primary mx-1">
                                Click Me to See All Students
                            </a>
                        </div>';
                    }
                ?>

                <div class="row mx-auto justify-content-center text-center">
                    <div class="col-md-4 my-4">
                        <a href="add-course.php" type="button" class="btn btn-secondary mx-1">
                        <i class="fa fa-plus"></i> Add Course-Batch
                        </a>
                    </div>
                </div>

                <table class="table table-bordered text-center" id="myTable">
                    <thead>
                        <tr> 
                            <th>Course</th>                     
                            <th>Batch</th>     
                            <th>Start Date</th>          
                            <th>End Date</th>
                            <th>Actions</th>
                            
                            
                            
                        </tr>  
                    </thead>                                             
                    <tbody>
                        <?php while ($row = $get_stud->fetch_array()): ?>
                            <tr>
                                <td> </td>                  
                                <td><?php echo $row['']; ?></td>
                                <td><?php echo $row['']; ?></td>
                                <td><?php echo $row['']; ?></td>
                                <td><?php echo $row['']; ?></td>
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
