<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../web-page/contact.html" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 
      <li class="nav-item d-none d-sm-inline-block">
          <a href="../../../index.html" class="nav-link">Back to Main Webpage</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          
          <!-- database navbar img -->
          <?php
              // Check if the image path exists
              if ($_SESSION['role'] == "Super Admin") {
                  // Display a default image if logged in as super admin (no image as default)
                  echo '<img class="user-image img-circle elevation-2" src="../../dist/img/user2-160x160.jpg" alt="User Image">';    
                  //    <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> 

              } else {
                  // Display the image if the role has image
                  echo '<img class="user-image  img-circle elevation-2" src="data:image/jpeg;base64,' . base64_encode($user_img) . '" alt="User Image">';
                  // Base code reference: 
              }
            ?>

          <span class="d-none d-md-inline"><?php echo $user_fullname; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-dark">
            <?php
              // Check if the image path exists
              if ($_SESSION['role'] == "Super Admin") {
                  // Display a default image if logged in as super admin (no image as default)
                  echo '<img class="img-circle elevation-2" src="../../dist/img/user2-160x160.jpg" alt="User Image">';    
                  //    <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> 

              } else {
                  // Display the image if the role has image
                  echo '<img class="img-circle elevation-2" src="data:image/jpeg;base64,' . base64_encode($user_img) . '" alt="User Image">';
                  // Base code reference: 
              }
            ?>


            <p>
            <?php echo $user_fullname; ?>
              <small><i><?php echo $_SESSION['role'];?></i></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-6 text-center">
              <?php if ($_SESSION['role'] == "Super Admin") { ?>

              <?php } elseif ($_SESSION['role'] == "Administrator") {?>
                <a href="../admin/edit-admin.php?admin_id=<?php echo $_SESSION['admin_id'] ?>" class="btn btn-default btn-flat float-left">Profile</a>

              <?php } elseif ($_SESSION['role'] == "Student") { ?>
                <a href="../scholar/view-prof-scholar.php?stud_id=<?php echo $_SESSION['stud_id'] ?>" class="btn btn-default btn-flat float-left">Profile</a>

              <?php } else {
                
              } ?>
              </div>
              <div class="col-6 text-center">
                <a href="../login/user-data/user-logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <!-- <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
            <a href="#" class="btn btn-default btn-flat float-right">Sign out</a>
          </li> -->
        </ul>
      </li>
    </ul>
  </nav>