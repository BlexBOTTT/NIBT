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
                    <h1 class="m-0">View Class</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Class Configuration</li>
                        <li class="breadcrumb-item active">Class List</li>
                        <li class="breadcrumb-item active">View Class: ####</li>

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

                            <!-- <form action="user-data/user-add-course.php" method="POST" enctype="multipart/form-data"> -->

                                <?php
                                    $get_batch = $conn->query("SELECT 
                                                                tbl_classes.*,
                                                                tbl_course_name.course_name,
                                                                tbl_trainor.trainor_name     
                                                                FROM tbl_classes
                                                                LEFT JOIN tbl_course_name ON tbl_course_name.course_name_id = tbl_classes.course_name_id
                                                                LEFT JOIN tbl_trainor ON tbl_trainor.trainor_id = tbl_classes.trainor_id
                                                                WHERE class_id = '$_GET[class_id]'");
                                    $res_count = $get_batch->num_rows;
                                    if ($res_count == 0) {
                                        // error code
                                    }   
                                    $row = $get_batch->fetch_array();

                                ?>

                                <div class="row mx-auto">
                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <label class="form-label">Select Course Name</label> <p><?php echo $row['course_name']; ?></p>                                
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="my-3">
                                            <label class="form-label">Batch Number</label>
                                            <p><?php echo $row['batch_number']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="my-3">
                                            <label class="form-label">Year</label>
                                            <p><?php echo $row['year']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mx-auto">                                   
                                    <div class="col-md-3">
                                        <div class="my-3">
                                            <label class="form-label">RQM Code (Regional Qualification Map)</label>
                                            <p><?php echo isset($row['rqm']) && !empty($row['rqm']) ? $row['rqm'] : 'RQM unavailable'; ?></p>

                                        </div>
                                    </div>   
                                </div>

                                <div class="row mx-auto">                                   
                                    <div class="col-md-2">
                                        <div class="my-3">
                                            <label class="form-label">Start Date</label>
                                            <p><?php echo $row['start_date']; ?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="my-3">
                                                <label class="form-label">End Date</label>
                                                <p><?php echo $row['end_date']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-auto">                                   
                                    <div class="col-md-2">
                                        <div class="my-3">
                                            <label class="form-label">Course Trainor</label>
                                            <p><?php echo $row['trainor_name']; ?></p>                                       
                                        </div>
                                    </div>   
                                </div>

                                <div class="row mx-auto">                                   
                                    <div class="col-md-6">
                                        <div class="my-3">
                                            <label class="form-label">Remarks</label>
                                            <p><?php echo $row['remarks']; ?></p>   
                                        </div>
                                    </div>   
                                </div>
                                
                               

                                <div class="row mx-auto">
                                    <div class="col-md-4">
                                        <a class="btn btn-secondary" href="assign-course.php">Go Back</a>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                                            Add Scholars to this class
                                        </button>
                                    </div>

                                    <div class="modal fade" id="modal-info">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                        <h4 class="modal-title">Info                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             Modal</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">

                                        <!-- <p>One fine body&hellip;</p> -->
                                        
                                            <form action="user-add-scholar-class.php" method="POST" enctype="multipart/form-data">

                                                <!-- <div class="form-group">
                                                <label for="subject">Select Subject</label>
                                                <select name="scholars" id="scholars" multiple multiselect-search="true" multiselect-select-all="true" required class="select form-control">
                                                    <option>English</option>
                                                    <option>Math</option>
                                                    <option>Hindi</option>
                                                    <option>Science</option>
                                                    <option>Computer</option>
                                                    </select>
                                                </div> -->

                                                <div class="col-md-12">
                <div class="form-group">
                  <label>Multiple</label>
                  <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                    <option>Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                <!-- /.form-group -->
                
                                            </form>
                                            

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-info   ">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                    </div>  
                                    
                                </div>

                            <!-- </form> -->

                            <table class="table justify-content-center" id="myTable" style="width:100%">
                                <thead>
                                    <tr> 
                                        <th>RQM</th>                     
                                        <th>Course Name</th>     
                                        <th>Batch</th>          
                                        <th>Year</th>
                                        <th>Student Count</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <!-- <th>Remarks</th> -->
                                        <th>Actions</th>
                                    </tr>  
                                </thead>                                             
                                <tbody>
                                    <?php                       
                                    while ($row = $get_batch->fetch_array()):                                      
                                    ?>
                                        <tr>
                                            <td><?php echo $row['rqm']; ?></td>                  
                                            <td><?php echo $row['course_name']; ?></td>
                                            <td><?php echo $row['batch_number']; ?></td>
                                            <td><?php echo $row['year']; ?></td>
                                            <td><?php echo $row['student_count']; ?></td>
                                            <td><?php echo $row['start_date']; ?></td>
                                            <td><?php echo $row['end_date']; ?></td>
                                            <!-- <td><?php echo $row['remarks']; ?></td> -->
                                            <td>
                                            <a href="view-course.php<?php echo '?batch_id=' . $row['batch_id']; ?>" type="button" class="btn btn-info mx-1" target="_blank" 
                                            title="View Scholar Profile">
                                            <i class="fa fa-eye"></i> <i class="fa fa-user"></i> 
                                            </a>  
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>    
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
