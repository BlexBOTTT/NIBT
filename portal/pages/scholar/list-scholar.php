<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <?php include '../../includes/links.php'; ?>

  
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
                  <table class="table table-bordered text-center" id="myTable">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Fullname</th>
                        <th>Email</th>                     
                        <th>Contact #</th>
                        <th>Facebook & Messenger</th>
                        <th>Username</th>
                        <th>Actions</th>
                      </tr>  
                    </thead>                                             
                    <tbody>
                      <?php
                          if (isset($_GET['look'])) {

                          $_GET['search'] = addslashes($_GET['search']);
                          $_SESSION['search'] = $_GET['search'];

                          $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_students.lastname, ', ', tbl_students.firstname, ' ', tbl_students.middlename) AS fullname 
                          FROM tbl_students
                          LEFT JOIN tbl_genders ON tbl_genders.gender_id = tbl_students.gender_id
                          WHERE (firstname LIKE '%$_GET[search]%' 
                          OR middlename LIKE '%$_GET[search]%'
                          OR lastname  LIKE '%$_GET[search]%' 
                          -- OR stud_no LIKE '%$_GET[search]%'
                          -- OR yearlevel LIKE '%$_GET[search]%'
                          )                         
                          ORDER BY stud_id DESC
                          ") or die(mysqli_error($conn));
                              while ($row = mysqli_fetch_array($get_user)) {
                                  $id = $row['stud_id'];
                                  // $_SESSION['stud_no'] = $row['stud_no'];

                          ?>
                        
                          <tr>
                              <td><img class="img-fluid"
                                              src="data:image/jpeg;base64, <?php echo base64_encode($row['img']); ?>"
                                              alt="image" style="height: 50px; width: 50px"></td>
                              <td><?php echo $row['lastname'] ?>, <?php echo $row['firstname'] ?>, <?php echo $row['middlename'] . '' ?></td>
                              <td><?php echo $row['email'] ?></td>
                              <td><?php echo $row['contact'] ?></td>                          
                              <td>Facebook: <b><?php echo $row['fb_account'] ?></b> <br> Messenger: <b><?php echo $row['fb_mess'] ?></b></td>
                              <td><?php echo $row['username'] ?></td>
                              <td>
                                  <a href="../forms/scholar-profile-a4.php<?php echo '?stud_id=' . $id; ?>" type="button" class="btn btn-primary mx-1" target="_blank">
                                  <i class="fa fa-print"></i> Scholar Profile
                                  </a>                                   
                                  
                                  <a href="prof-scholar.php<?php echo '?stud_id=' . $id; ?>" type="button" class="btn btn-secondary mx-1" target="_blank">
                                  <i class="fa fa-address-card"></i> Edit Scholar Profile
                                  </a>
                                                                             
                                  <a href="edit-scholar.php<?php echo '?stud_id=' . $id; ?>" type="button" class="btn btn-info mx-1" target="_blank">
                                  <i class="fa fa-edit"></i> Update
                                  </a>
                                  
                                  <!-- Button trigger modal -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $id; ?>">
                                          <i class="fa fa-trash"></i> Delete
                                      </button>

                                  <!-- Delete Modal Window -->
                                  <div class="modal fade" id="deleteModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <p>Are you sure you want to delete
                                                      <strong class="font-weight-bold"><?php echo $row['fullname'] ?></strong>?
                                                  </p>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                  <a class="btn btn-secondary" href="user-data/user-del-scholar.php?stud_id=<?php echo $id; ?>">Delete</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div> 
                              </td>
                          </tr>
                          <?php }
                          } ?>
                      </tbody>
                  </table>
                  
                  <a href="../forms/scholar-online-registration.php" type="button" class="btn btn-primary mx-1" target="_blank">
                                  <i class="fa fa-print"></i> Online Register Responses
                                  </a>  
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
