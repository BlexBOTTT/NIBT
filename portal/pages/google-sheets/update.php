<!-- https://cloud.google.com/storage/docs/cloud-console -->

<!-- https://docs.google.com/spreadsheets/d/1KzPAWvyoAInukruz27Js0GTb0yl3fYLX6Xkp9MnNEfc/edit?resourcekey=&pli=1&gid=560928276#gid=560928276 -->

<!-- https://www.youtube.com/watch?v=iTZyuszEkxI -->

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
  <div class="content-wrapper justify-content-center">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <section class="col-lg-4">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Google Sheets to MySQL</h3>
                    </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    <div class="card-body pad table-responsive">
                        <form method="POST">
                            <button type="submit" name="update">Update Now</button>
                        </form>
                        <?php
                        if (isset($_POST['update'])) {
                            include 'fetch_google_sheets.php';
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

 
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
