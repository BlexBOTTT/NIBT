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
        <!-- <?php include '../../includes/preloader.php'; ?> -->

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
                    <h1 class="m-0">Scholar List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Course Config</li>
                        <li class="breadcrumb-item active">Add New Course-Batch</li>

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
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add new Course-Batch</h3>
                    </div>
                    <!-- /.card-header -->
                        <!-- CARD BODY -->
                        <div class="card-body pad table-responsive">

                            <form action="user-data/user-add-course.php" method="POST" enctype="multipart/form-data">

                                <div class="row mx-auto">
                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <label class="form-label">Select Course Name</label>
                                            <select class="form-control" id="courses" name="courses" required>
                                                <option value="" selected disabled>Select Choice...</option>                                            
                                                <?php 
                                                $query_courses = mysqli_query($conn, "SELECT * FROM tbl_course_name WHERE course_name_id != 0");
                                                while ($row_courses = mysqli_fetch_array($query_courses)) {
                                                    $selected_courses = ($row['course_name_id'] == $row_courses['course_name_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_courses['course_name_id'] . '" ' . $selected_courses . '>' . $row_courses['course_name'] . '</option>';
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="my-3">
                                            <label class="form-label">Batch Number</label>
                                                <input type="number" id="batch" name="batch" min="1" max="100" step="1" class="form-control" placeholder="Enter Batch Number"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="my-3">
                                            <label class="form-label">Year</label>
                                                <input type="number" id="year" name="year" min="2000" max="2099" step="1" class="form-control" placeholder="Enter YYYY"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mx-auto">                                   
                                    <div class="col-md-3">
                                        <div class="my-3">
                                            <label class="form-label">RQM Code (Regional Qualification Map)</label>
                                                <input type="text" id="rqm" name="rqm" class="form-control" placeholder="Example: RQM###-YYYY-TWSP-####-####"
                                                required>
                                        </div>
                                    </div>   
                                </div>

                                <div class="row mx-auto">                                   
                                    <div class="col-md-2">
                                        <div class="my-3">
                                            <label class="form-label">Start Date</label>
                                                <input type="date" id="start_date" name="start_date" min="1900" max="2099" step="1" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="my-3">
                                                <label class="form-label">End Date</label>
                                                <input type="date" id="end_date" name="end_date" min="1900" max="2099" step="1" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-auto">                                   
                                    <div class="col-md-2">
                                        <div class="my-3">
                                            <label class="form-label">Course Trainor</label>
                                            <select class="form-control" id="trainor" name="trainor" placeholder="Select your answer" required>
                                                <option value="" selected disabled>Select Choice...</option>
                                                <?php 
                                                    $query_trainor = mysqli_query($conn, "SELECT * FROM tbl_trainor");
                                                    while ($row_trainor = mysqli_fetch_array($query_trainor)) {
                                                    $selected_trainor = ($row['trainor_id'] == $row_trainor['trainor_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row_trainor['trainor_id'] . '" ' . $selected_trainor . '>' . $row_trainor['trainor_name'] . '</option>';
                                                }
                                                ?>
                                            </select>   
                                        </div>
                                    </div>   
                                </div>

                                <div class="row mx-auto">                                   
                                    <div class="col-md-6">
                                        <div class="my-3">
                                            <label class="form-label">Remarks</label>
                                            <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Any remarks/comments in this particular course-batch">   
                                        </div>
                                    </div>   
                                </div>
                                
                               

                                <div class="row mx-auto">
                                    <div class="col-md-4">
                                        <a class="btn btn-secondary" href="list-scholar.php">Go Back</a>
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
