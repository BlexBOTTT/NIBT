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
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>### Scholars</h3>
                <p>Scholars Count</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="../scholars/list-scholars.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

            <!-- DIRECT CHAT -->

            <!--/.direct-chat -->

            <!-- TO DO List -->
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
                  <!-- <div class="row">
                    <div class="col-2">
                      <label for="exampleInputEmail1">Email address</label>
                      <button type="button" class="btn btn-block btn-primary">Default</button>
                    </div>
                    <div class="col-4">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="text" class="form-control" placeholder=".col-4">
                      <button type="button" class="btn btn-block btn-primary">Default</button>
                    </div>
                    <div class="col-5">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="text" class="form-control" placeholder=".col-5">
                      <button type="button" class="btn btn-block btn-primary">Default</button>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    <button type="button" class="btn btn-block btn-primary">Default</button>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div> -->
                <!-- /.card-body -->

                <!-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
              </form>
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
