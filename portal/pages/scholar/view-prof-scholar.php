<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <?php include '../../includes/links.php'; 

    $stud_id = $_GET['stud_id']
  ?>

  
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
            <h1 class="m-0">Scholar Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
              <li class="breadcrumb-item active">Scholar Config</li>
              <li class="breadcrumb-item active">Scholar Lists</li>
              <li class="breadcrumb-item active">View Scholar Profile: <b><?php echo $user_fullname;?></b></li>
            </ol>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Fetch scholar profile -->
    <?php
        $get_admin = $conn->query("SELECT * 
        FROM tbl_students WHERE stud_id = '$_GET[stud_id]'");
        $res_count = $get_admin->num_rows;
        if ($res_count == 0) {
            // error code
        }
        $row = $get_admin->fetch_array();

    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="data:image/jpeg;base64, <?php echo base64_encode($row['img'] ?? ''); ?>" alt="User profile picture" style="width: 128px; height: 128px;">
                </div>

                <h3 class="profile-username text-center"><?php echo $user_fullname;?></h3>

                <!-- <p class="text-muted text-center">Software Engineer</p> -->

                <!-- <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul> -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Scholar Enrollment Information:</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Course</strong>

                <p class="text-muted">
                  <b>COURSE NAME</b>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Batch</strong>

                <p class="text-muted"><b>##</b></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i>RQM</strong>

                <p class="text-muted">placeholder RQM-RQM-RQM</p>
                <!-- <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-info">Node.js</span>
                </p> -->

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i>Remarks</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills"> 
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Scholar Info</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Documents</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Enrollment Info</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Address</h3>
                                <!-- <div class="card-tools">
                                    Buttons, labels, and many other things can be placed here!
                                    Here is a label for example
                                    <span class="badge badge-info">Label</span>
                                </div> -->
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong>House</strong>
                                <p class="text-muted">COURSE NAME</p>

                                <strong>Course:</strong>
                                <p class="text-muted">COURSE NAME</p>
                            </div>
                            <!-- /.card-body -->
                            <!-- <div class="card-footer">
                                The footer of the card
                            </div> -->
                        <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                      <!-- /.user-block -->
                      
                      <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Emergency Contact</h3>
                                <!-- <div class="card-tools">
                                    Buttons, labels, and many other things can be placed here!
                                    Here is a label for example
                                    <span class="badge badge-info">Label</span>
                                </div> -->
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong>Person</strong>
                                <p class="text-muted">NAME</p>

                                <strong>Relationship with scholar:</strong>
                                <p class="text-muted">relationship</p>

                                <strong>Number</strong>
                                <p class="text-muted">1234567890</p>
                            </div>
                            <!-- /.card-body -->
                            <!-- <div class="card-footer">
                                The footer of the card
                            </div> -->
                        <!-- /.card-footer -->
                        </div>
        
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                      
                      
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      
                      
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            </div>
                        <!-- /.col -->
                        </div>
                      <!-- /.row -->   

                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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


<script>
    const fileInput = document.getElementById('prof_img');
    const fileLabel = document.querySelector('label.custom-file-label');
    const profileImg = document.getElementById('profile-img');  // Reference to the image element
    const MAX_FILENAME_LENGTH = 20;

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            let fileName = this.files[0].name;
            const fileExtension = fileName.split('.').pop();
            const fileNameWithoutExtension = fileName.substring(0, fileName.length - fileExtension.length - 1);

            if (fileNameWithoutExtension.length > MAX_FILENAME_LENGTH) {
                const truncatedStart = fileNameWithoutExtension.substring(0, Math.floor(MAX_FILENAME_LENGTH / 2) - 2);
                const truncatedEnd = fileNameWithoutExtension.substring(fileNameWithoutExtension.length - 5);
                fileName = truncatedStart + '...' + truncatedEnd + '.' + fileExtension;
            }

            fileLabel.textContent = fileName;

            // Update the profile picture preview
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                profileImg.src = e.target.result; // Set the image source to the selected file
            };

            reader.readAsDataURL(file);
        } else {
            fileLabel.textContent = 'Choose file';
            profileImg.src = "data:image/jpeg;base64, <?php echo base64_encode($row['admin_image'] ?? $row['img'] ?? ''); ?>"; // Reset to default image
        }
    });
</script>

</body>
</html>
