<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../dashboard/index.php" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">NIBT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
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

        </div>
        <div class="info">
          <?php 
            if ($_SESSION['role'] == "Student") {  
                echo '<a href="../scholar/view-prof-scholar.php?stud_id=' . $_SESSION['stud_id'] . '" class="d-block">' . $user_fullname . '</a>';  
            } else {
              echo '<a href="" class="d-block">' . $user_fullname . '</a>';
            }
          ?>

          
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <?php 
                  if ($_SESSION['role'] == "Super Admin") {
                    echo '
                      <li class="nav-item">
                        <a href="../dashboard/index.php" class="nav-link">
                          <p>Home</p>
                        </a>
                      </li>                          

                      <li class="nav-header">Admins config</li>

                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <p>
                            Admin Options:
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                          <a href="../admin/list-admin.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Admin List</p>
                            </a>
                          </li>                   
                          <li class="nav-item">
                            <a href="../admin/add-admin.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>Admin Add</p>
                            </a>
                          </li>
                        </ul>
                      </li>


                      <li class="nav-header">Scholars config</li>
    
                      <li class="nav-item">
                            <a href="../scholar/list-scholar.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>Scholar/Student List</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="../scholar/add-scholar.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>Scholar/Student Add</p>
                            </a>
                          </li>
                      
                      <li class="nav-header">Other Functions</li>

                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <p>
                            Excel Upload-View
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">                    
                            <a href="../functions/upload-xlsx.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>
                                Excel Upload
                              </p>
                            </a>
                          </li>
                          <li class="nav-item">                        
                            <a href="../functions/view-xlsx.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>
                                Excel View
                              </p>
                            </a>
                          </li>
                        </ul>
                      </li>

                    ';
                  } elseif ($_SESSION['role'] == "Administrator") {
                    echo '
                    
                      <li class="nav-item">
                        <a href="../dashboard/index.php" class="nav-link">
                          <p>Home</p>
                        </a>
                      </li>                          

                      <li class="nav-header">Scholars config</li>
    
                      <li class="nav-item">
                            <a href="../scholar/list-scholar.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>Scholar/Student List</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="../scholar/add-scholar.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>Scholar/Student Add</p>
                            </a>
                          </li>
                      
                      <li class="nav-header">Other Functions</li>

                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <p>
                            Excel Upload-View
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">                    
                            <a href="../functions/upload-xlsx.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>
                                Excel Upload
                              </p>
                            </a>
                          </li>
                          <li class="nav-item">                        
                            <a href="../functions/view-xlsx.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                              <p>
                                Excel View
                              </p>
                            </a>
                          </li>
                        </ul>
                      </li>
                    ';
                  } elseif ($_SESSION['role'] == "Student") { 
                    echo '
                        <li class="nav-item">
                            <a href="../dashboard/index.php" class="nav-link">
                                <p>Home</p>
                            </a>
                        </li>                          
                
                        <li class="nav-header">Scholar:</li>
                        
                        <li class="nav-item">
                            <a href="../scholar/view-prof-scholar.php?stud_id=' . $_SESSION['stud_id'] . '" class="nav-link">
                                <p>View Profile</p>
                            </a>
                        </li>  
                    ';
                } else {
                    echo '
                      <li class="nav-item">
                        <a href="../dashboard/index.php" class="nav-link">
                          <p>Home</p>
                        </a>
                      </li> 
                      <li class="nav-header">Functions</li>
                    ';
                  } 
                ?>
          </ul>
        </nav>


      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>