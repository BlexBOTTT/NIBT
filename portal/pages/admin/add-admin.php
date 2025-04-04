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
            <h1 class="m-0">Admin List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Admin</li>
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
                    echo ' <div class="alert alert-success fade show" role="alert">
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
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

            <!-- DIRECT CHAT -->

            <!--/.direct-chat -->

             <!-- CARD HEADER  -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Add new NIBT-LP Admin</h3>
              </div>
              <!-- /.card-header -->
                <!-- CARD BODY -->
                <div class="card-body pad table-responsive">

                    <form action="user-data/user-add-admin.php" method="POST" enctype="multipart/form-data">

                        <div class="row mx-auto justify-content-center">
                            <div class="col-md-4 my-4">
                                <div class="custom-file">
                                    <div class="text-center mb-4">
                                        <!-- <img class="img-fluid img-circle" src="../../../portal/docs/assets/img/AdminLTELogo.png"
                                            alt="User profile picture" style="width: 100px; height: 100px;"> -->
                                            <img class="img-fluid img-circle" id="profile-img" src="../../../portal/docs/assets/img/AdminLTELogo.png" alt="User profile picture" style="width: 100px; height: 100px;">

                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-12">                                                                  
                                            <div class="input-group">
                                                <div class="custom-file">
                                                <input type="file" class="form-control" name="prof_img" id="prof_img" required>
                                                <label for="prof_img" class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto">
                            <div class="col-md-4">
                                <div class="my-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="firstname" class="form-control" autocomplete="off"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" autocomplete="off"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-3">
                                <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" autocomplete="off"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-auto">
                            <div class="col-md-4">
                                <div class="my-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" autocomplete="off"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" autocomplete="off"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="my-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password2" class="form-control" autocomplete="off"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-auto">
                        <div class="col-md-4">
                                <a class="btn btn-secondary" href="list.admin.php">Go Back</a>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 ">
                                <div class="input-group input-group-outline my-3 justify-content-end">
                                    <button class="btn btn-danger" type="submit" name="submit">
                                            Submit
                                        </button>
                                </div>
                            </div>
                        </div>

                    </form>

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

<!-- Script for custom file input label with selected filename -->
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
            profileImg.src = "../../../portal/docs/assets/img/AdminLTELogo.png"; // Reset to default image
        }
    });
</script>

</body>
</html>
