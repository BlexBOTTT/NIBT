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
            <h1 class="m-0">User Profile</h1>
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
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

            <!-- DIRECT CHAT -->

            <!--/.direct-chat -->

            <!-- TO DO List -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Profile</h3>
                        <!-- <i class="ion ion-clipboard mr-1"></i> -->
                        <!-- To Do List -->
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control" placeholder="Alexander">
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1">Middle Name</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control" placeholder="Pierce">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" placeholder="********">
                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" class="form-control" placeholder="********">
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->
            </div>
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
