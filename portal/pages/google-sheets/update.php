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

<!-- <!-- 

1/2/2025 16:36:36
1/2/2025 16:43:54
1/2/2025 16:38:31
1/2/2025 16:37:03
1/2/2025 16:33:09
1/2/2025 16:39:37
1/2/2025 16:40:36
1/2/2025 16:36:07
1/2/2025 16:35:49
1/2/2025 16:31:19
1/2/2025 16:33:22
1/2/2025 16:35:43
1/2/2025 16:40:25
1/2/2025 16:38:04
1/2/2025 16:34:03
1/2/2025 16:40:23
1/2/2025 16:34:42
1/2/2025 16:33:38
1/2/2025 16:33:13
1/2/2025 16:37:13
1/2/2025 16:37:23
1/2/2025 16:40:51
1/2/2025 16:33:34
1/2/2025 16:31:02
1/2/2025 16:32:04

01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024
01/28/2024

 -->