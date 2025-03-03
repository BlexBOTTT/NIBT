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
    <?php


    // Query to count the number of students
    $sql_total = "SELECT COUNT(*) AS total_scholar FROM tbl_students";
    $result_total = $conn->query($sql_total);
    $totalStudents = ($result_total->num_rows > 0) ? $result_total->fetch_assoc()['total_scholar'] : 0;

    // Query to count approved students
    $sql_approved = "SELECT COUNT(*) AS total_students FROM tbl_students WHERE enroll_status_id = 1";
    $result_approved = $conn->query($sql_approved);
    $totalApproved = ($result_approved) ? $result_approved->fetch_assoc()['total_students'] : 0;

    // Query to count pending students
    $sql_pending = "SELECT COUNT(*) AS total_students FROM tbl_students WHERE enroll_status_id = 0";
    $result_pending = $conn->query($sql_pending);
    $totalPending = ($result_pending) ? $result_pending->fetch_assoc()['total_students'] : 0;

    ?>

    <!-- Define role-based content -->
    <?php if ($_SESSION['role'] == "Super Admin" || $_SESSION['role'] == "Administrator") { ?>
        
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Scholars Count -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $totalStudents; ?> Scholars</h3>
                                <p>Scholars Count</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="../scholar/list-scholar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Approved Scholars -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $totalApproved; ?></h3>
                                <p>Approved Scholars</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Scholars -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $totalPending; ?></h3>
                                <p>Pending Scholars</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Dropped Scholars (Placeholder) -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>##?</h3>
                                <p>Dropped Scholars</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="col-lg-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">NIBT - LAS PINAS Quick Links:</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body pad table-responsive">
                <table class="table table-bordered text-center">
                  <tr>
                    <th>Google Drive</th>
                    <th>Attendance Sheet</th>
                    <th>Excel Files (G-drive)</th>
                    <th>E-learning Website</code></th>
                    <th>NIBT Facebook Branches</th>
                  </tr>
                  <tr>
                    <td>
                      <a class="btn btn-block btn-primary" href="https://drive.google.com/drive/my-drive" role="button" target="_blank">NIBT Google Drive Link</a>
                    </td>
                    <td>
                    
                      <a class="btn btn-block btn-primary" href="https://docs.google.com/spreadsheets/d/10DY53wbcYCAq-rvr9k7u0yUFP0e_7cscFm4Uk68s21s/edit?usp=drive_link" role="button" target="_blank">Attendance 2024-2025</a>
                    </td>
                    <td>
                    <a class="btn btn-block btn-primary" href="https://docs.google.com/spreadsheets/d/1OswlsYNi1qOnEeL2KZDz4RFaWR4EAYcW/edit?usp=sharing&ouid=106820933000369545915&rtpof=true&sd=true" role="button" target="_blank">Webinar Schedules <br> RPG - COBOL</a>
                    <a class="btn btn-block btn-primary" href="https://docs.google.com/spreadsheets/d/1LECezySBSAz5JAYzK7t5WT6YHOdWl03y/edit?usp=sharing&ouid=106820933000369545915&rtpof=true&sd=true" role="button" target="_blank">RPG - COBOL Schedules</a>
                    <a class="btn btn-block btn-primary" href="https://drive.google.com/file/d/1UYEeMZZmZAOB1ItLxqqz1JES_2oclI5H/view?usp=drive_link" role="button" target="_blank">Training Schedule</a>
                    <a class="btn btn-block btn-primary" href="https://drive.google.com/drive/my-drive" role="button" target="_blank">Link</a>
                    </td>
                    <td>      
                      <a class="btn btn-block btn-primary" href="https://nibtlaspinas2025.gnomio.com/login/index.php" role="button" target="_blank">E-learning Website</a>
                    </td>
                    <td>
                    <a class="btn btn-block btn-primary" href="https://www.facebook.com/nibtlaspinas" role="button" target="_blank">E-learning Website</a>
                      
                    </td>
                  </tr> 
                </table>
        </section>
 

        <?php
    } elseif ($_SESSION['role'] == "Student") {
        ?>

          <div class="row justify-content-around">
            <section class="col-lg-5">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Navigation</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body pad table-responsive">
                    <div>
                        
                    </div>
                </div>
              </div>
            </section>
            <section class="col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Navigation</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body pad table-responsive">
                      <div>
                          
                      </div>
                  </div>
                </div>
            </section>
            <section class="col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Navigation</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body pad table-responsive">
                      <div>
                          
                      </div>
                  </div>
                </div>
            </section>
          </div>
        

        
        <?php
    }
    ?>

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
