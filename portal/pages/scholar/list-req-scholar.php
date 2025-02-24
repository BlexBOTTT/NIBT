<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <?php include '../../includes/links.php'; 
  
    // fetch student_id
    
  ?>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

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
            <h1 class="m-0">List of Scholars</h1>
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
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
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
                        } elseif (!empty($_SESSION['success-del'])) {
                          echo ' <div class="alert alert-success fade show" role="alert">
                                      <div class="d-flex justify-content-between align-items-center">
                                          <span class="alert-text"><strong>Successfully Deleted!</strong></span>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                  </div>';
                          unset($_SESSION['success-del']);
                        }
                      ?>
            <div class="card card-secondary">

              <div class="card-header">
                <h3 class="card-title">?</h3>
              </div>
              <!-- /.card-header -->
       
              
            <div class="card-body pad table-responsive">  
                
                <?php

                    $stud_id = isset($_GET['stud_id']) ? intval($_GET['stud_id']) : 0;

                    // Prepare the query
                    $sql = "
                    SELECT 
                        tbl_students.*, 
                        tbl_genders.gender_name, 
                        tbl_student_requirements.birth_cert_img, 
                        tbl_student_requirements.diploma_tor_img 
                    FROM tbl_students
                    LEFT JOIN tbl_genders ON tbl_students.gender_id = tbl_genders.gender_id
                    LEFT JOIN tbl_student_requirements ON tbl_students.stud_id = tbl_student_requirements.stud_id
                    ";

                    // If a specific student ID is provided, filter the query
                        if ($stud_id > 0) {
                        $sql .= " WHERE tbl_students.stud_id = $stud_id";
                        }

                    // Execute the query
                    $get_stud = $conn->query($sql);

                    // Check if query executed successfully
                    if (!$get_stud) {
                    die("Query Error: " . $conn->error);
                    }

                    // Display message if no records found
                    if ($get_stud->num_rows == 0) {
                    echo "<p class='text-center text-danger'>No records found.</p>";
                    }
                ?>
            
                <div class="row justify-content-center text-center">                    
                    <h3><b>Scholar Requirement Checker</b></h3>                       
                </div>
                
                <?php
                // Check if stud_id is set in the URL
                $showBackButton = isset($_GET['stud_id']);
                ?>

            


                <!-- Show the 'See all students' button only when a specific student is selected -->
                <?php if ($showBackButton): ?>
                    <div class="row justify-content-center text-center">
                        <a href="list-req-scholar.php" type="button" class="btn btn-primary mx-1">
                            Click Me to see all students
                        </a>
                    </div>
                <?php endif; ?>
                
            
                <table class="table table-bordered text-center" id="myTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Fullname</th>
                            <th>Gender</th>    
                            <th>PSA Birth Certificate or Marriage Certificate (for females)</th>                     
                            <th>Diploma/TOR</th>               
                            <th>Scholar Profile Filled?</th>
                            <th>Enrollment Status</th> 
                        </tr>  
                    </thead>                                             
                    <tbody>
                        <?php while ($row = $get_stud->fetch_array()): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row['img'])): ?>
                                        <img class="img-fluid" src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" alt="image" style="height: 50px; width: 50px">
                                    <?php else: ?>
                                        <span class="badge badge-secondary">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo "{$row['lastname']}, {$row['firstname']} {$row['middlename']}"; ?></td>
                                <td><?php echo $row['gender_name']; ?></td>
            
                                <!-- PSA/Marriage Certificate -->
                                <td>
                                    <?php if (!empty($row['birth_cert_img'])): ?>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-cert-<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-eye"></i> View PSA
                                        </button>
                                        <br>
                                        <span class="badge badge-success">Uploaded</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">No Upload</span>
                                    <?php endif; ?>
            
                                    <div class="modal fade" id="modal-cert-<?php echo $row['stud_id']; ?>">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">PSA/Marriage Certificate</h4>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <?php if (!empty($row['birth_cert_img'])): ?>
                                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['birth_cert_img']); ?>" class="img-fluid">
                                                    <?php else: ?>
                                                        <p>No image uploaded.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
            
                                <!-- Diploma/TOR -->
                                <td>
                                    <?php if (!empty($row['diploma_tor_img'])): ?>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-diploma-<?php echo $row['stud_id']; ?>">
                                            <i class="fa fa-eye"></i> View Diploma/TOR
                                        </button>
                                        <br>
                                        <span class="badge badge-success">Uploaded</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">No Upload</span>
                                    <?php endif; ?>
            
                                    <div class="modal fade" id="modal-diploma-<?php echo $row['stud_id']; ?>">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Diploma/TOR</h4>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <?php if (!empty($row['diploma_tor_img'])): ?>
                                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['diploma_tor_img']); ?>" class="img-fluid">
                                                    <?php else: ?>
                                                        <p>No image uploaded.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
            
                                <!-- Scholar Profile Status -->    
                                <td>
                                    <?php 
                                        // Define required fields (must not be empty)
                                        $required_fields = [
                                            'lastname' => 'Last Name',
                                            'firstname' => 'First Name',
                                            'middlename' => 'Middle Name',
                                            'middleinitial' => 'Middle Initial',
                                            'num_street' => 'Street Number',
                                            'barangay' => 'Barangay',
                                            'district' => 'District',
                                            'addmunicity' => 'City/Municipality',
                                            'province' => 'Province',
                                            'region' => 'Region',
                                            'email' => 'Email Address',
                                            'contact' => 'Contact Number',
                                            'nationality' => 'Nationality',
                                            'age' => 'Age',
                                            'bpmunicity' => 'Birthplace (City)',
                                            'bpprovince' => 'Birthplace (Province)',
                                            'bpregion' => 'Birthplace (Region)',
                                            'cfullname' => 'Emergency Contact Name',
                                            'ccell_no' => 'Emergency Contact Number',
                                            'caddress' => 'Emergency Contact Address',
                                            'relationship' => 'Emergency Contact Relationship',
                                            'username' => 'Username',
                                            'password' => 'Password'
                                        ]; 

                                        // Define fields that should not be '0' (must be updated)
                                        $non_zero_fields = [
                                            'gender_id' => 'Gender',
                                            'civilstatus' => 'Civil Status',
                                            'employment_id' => 'Employment Status',
                                            'attainment_id' => 'Educational Attainment',
                                            'classification_id' => 'Classification',
                                            'course_id' => 'Course',
                                            'scholar_package_id' => 'Scholarship Package',
                                            'disclaimer' => 'Disclaimer'
                                        ]; 

                                        // Define required image fields
                                        $image_fields = ['img' => 'Profile Picture']; 

                                        // Define fields where '0' is acceptable
                                        $zero_allowed_fields = ['type_disability_id', 'cause_disability_id']; 

                                        // Store missing fields
                                        $missing_fields = [];

                                        // Check if required fields are empty
                                        foreach ($required_fields as $field => $label) {
                                            if (empty($row[$field])) {
                                                $missing_fields[] = $label;
                                            }
                                        }

                                        // Check if fields that should not be '0' are still '0'
                                        foreach ($non_zero_fields as $field => $label) {
                                            if (isset($row[$field]) && $row[$field] == 0) {
                                                $missing_fields[] = $label;
                                            }
                                        }

                                        // Check if birthdates are NULL, empty, or '0000-00-00'
                                        $invalid_birthdates = ['0000-00-00', '', null];
                                        if (in_array($row['birthdate'], $invalid_birthdates)) {
                                            $missing_fields[] = 'Birthdate';
                                        }
                                        if (in_array($row['cbirthdate'], $invalid_birthdates)) {
                                            $missing_fields[] = 'Emergency Contact Birthdate';
                                        }

                                        // Check if required images are empty
                                        foreach ($image_fields as $field => $label) {
                                            if (empty($row[$field])) {
                                                $missing_fields[] = $label;
                                            }
                                        }

                                        // Generate a unique ID for each row (important for multiple rows in a table)
                                        $unique_id = uniqid('missing_');

                                        // Output result
                                        if (empty($missing_fields)) {
                                            echo '<span class="badge badge-success" style="cursor:pointer;" data-toggle="collapse" data-target="#'.$unique_id.'">YES</span>';
                                            echo '<div id="'.$unique_id.'" class="collapse mt-2">';
                                            echo '<small><strong>Completed All Fields</strong></small>';
                                            echo '</div>';
                                        } else {
                                            echo '<span class="badge badge-danger" style="cursor:pointer;" data-toggle="collapse" data-target="#'.$unique_id.'">No, Click me for more info</span>';
                                            echo '<div id="'.$unique_id.'" class="collapse mt-2">';
                                            echo '<small><strong>Missing Fields:</strong> ' . implode(", ", $missing_fields) . '</small>';
                                            echo '</div>';
                                        }
                                    ?>
                                </td>

                                <!-- Enrollment Status -->
                                <!-- Enrollment Status -->
                                <!-- Enrollment Status -->
                                <td>
                                    <?php 
                                        switch ($row['enroll_status_id']) {
                                            case 0:
                                                echo '<span class="badge badge-warning">PENDING</span>';
                                                
                                                // Show the enroll button only if everything is completed
                                                if (empty($missing_fields) && !empty($row['birth_cert_img']) && !empty($row['diploma_tor_img'])) {
                                                    echo '<br><button type="button" class="btn btn-success btn-sm mt-2" data-toggle="modal" data-target="#confirmEnroll-'.$row['stud_id'].'">Mark as Enrolled</button>';
                                                }
                                                break;
                                            case 1:
                                                echo '<span class="badge badge-success">ENROLLED</span>';
                                                break;
                                            case 2:
                                                echo '<span class="badge badge-danger">REJECTED</span>'; 
                                                break;
                                            default:
                                                echo '<span class="badge badge-secondary">UNKNOWN</span>';
                                                break;
                                        }
                                    ?>
                                </td>

                                <!-- Modal for Confirmation -->
                                <div class="modal fade" id="confirmEnroll-<?php echo $row['stud_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Enrollment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to enroll <b><?php echo "{$row['firstname']} {$row['lastname']}"; ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="user-data/user-list-req-scholar.php">
                                            <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>">
                                            <button type="submit" class="btn btn-primary">Yes, Enroll</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </div>
                                </div>
                                </div>           

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    
            
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

<?php include '../../includes/script.php'; ?> 


<!-- for Mark as enrolled when all necesary requirements are filled -->
<script>
    $(document).ready(function() {
    $(".enroll-btn").click(function() {
        var stud_id = $(this).data("id");

        if (confirm("Are you sure you want to mark this student as enrolled?")) {
            $.ajax({
                url: "user-data/user-list-req-scholar.php", // Create this file for handling the update
                type: "POST",
                data: { stud_id: stud_id },
                success: function(response) {
                    if (response === "success") {
                        alert("Student successfully enrolled!");
                        location.reload(); // Refresh the page to update the UI
                    } else {
                        alert("Error updating enrollment status.");
                    }
                },
                error: function() {
                    alert("Failed to connect to the server.");
                }
            });
        }
    });
});

</script>
</body>
</html>
