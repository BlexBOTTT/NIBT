<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

<?php include '../../includes/links.php'; ?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->

  <?php include '../../includes/navbar.php'; ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include '../../includes/sidebar.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Upload Excel File</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- body -->
                
                <?php
                    require '../../vendor/autoload.php';

                    use PhpOffice\PhpSpreadsheet\IOFactory;

                    if (!isset($_GET['file'])) {
                        die('No file specified.');
                    }

                    $file = 'uploads/' . $_GET['file'];

                    if (!file_exists($file)) {
                        die('File not found.');
                    }

                    try {
                        // Load the Excel file
                        $spreadsheet = IOFactory::load($file);
                        $worksheet = $spreadsheet->getActiveSheet();
                        $rows = $worksheet->toArray();

                        echo '<h1>Excel File Contents</h1>';
                        echo '<table id="example2 "class="table table-bordered table-hover">';
                        foreach ($rows as $row) {
                            echo '<tr>';
                            foreach ($row as $cell) {
                                echo '<td>' . htmlspecialchars($cell) . '</td>';
                            }
                            echo '</tr>';
                        }
                        echo '</table>';
                    } catch (Exception $e) {
                        die('Error reading file: ' . $e->getMessage());
                    }
                    ?>
                <!-- body -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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
