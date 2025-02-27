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
            <h1 class="m-0">Admin List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin List</li>
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
            
            <!-- /.card -->

            <!-- DIRECT CHAT -->

            <!--/.direct-chat -->

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
                } elseif (!empty($_SESSION['success'])) {
                    echo '<div class="alert alert-success fade show" role="alert">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="alert-text"><strong>Successfully Added!</strong></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            </div>';
                    unset($_SESSION['success']);
                }
            ?>

             <!-- CARD HEADER  -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">NIBT - LAS PINAS Admin List:</h3>
              </div>
              <!-- /.card-header -->
                <!-- CARD BODY -->
                <div class="card-body pad table-responsive">
                    <table class="table table-bordered text-center" id="myTable">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Fullname</th>
                          <th>Email</th>
                          <th>Username</th>
                          <th>Actions</th>    
                      </tr>
                    </thead>
                      
                      
                      <?php
                          $get_user = mysqli_query($conn, "SELECT *, CONCAT(tbl_admins.firstname, ' ', tbl_admins.lastname) AS fullname FROM tbl_admins");
                          while ($row = mysqli_fetch_array($get_user)) {
                              $id = $row['admin_id'];
                      ?>
                      <tbody>
                          <tr>
                              <td>
                                <?php if (!empty($row['admin_img'])): ?>
                                  <img class="img-fluid img-circle" src="data:image/jpeg;base64, <?php echo base64_encode($row['admin_image']); ?>" alt="image" style="height: 50px; width: 50px">
                                  
                                <?php else: ?>                            
                                  <span class="badge badge-secondary">No Image</span>
                                  
                                <?php endif; ?>
                              </td>
                              <td><?php echo $row['fullname'] ?></td>
                              <td><?php echo $row['email'] ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td>
                                  <a href="edit-admin.php<?php echo '?admin_id=' . $id; ?>" type="button" class="btn btn-info mx-1" title="Update Admin Account">
                                      <i class="fa fa-edit"></i> 
                                  </a>

                                  <!-- Button trigger modal -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $id; ?>" title="Delete Admin Account">
                                      <i class="fa fa-trash"></i>
                                  </button>

                                  <!-- Delete Modal Window -->
                                  <div class="modal fade" id="deleteModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header btn-danger">
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
                                                  <a class="btn btn-secondary" href="user-data/user-del-admin.php?admin_id=<?php echo $id; ?>">Delete</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </td>
                          </tr>
                      <?php
                          }
                      ?>
                    </table>
                    </div>
                <!-- /.card-body -->

                <!-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
            <!-- /.card -->
          </section>
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

<!-- jQuery -->
<?php include '../../includes/script.php'; ?>

</body>
</html>
