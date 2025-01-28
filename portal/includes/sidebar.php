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
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../user/user-profile.php" class="d-block">Alexander Pierce</a>
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
          <li class="nav-item">
                <a href="../dashboard/index.php" class="nav-link active">
                  <p>Home</p>
                </a>
              </li>
          <li class="nav-header">Functions</li>
          <li class="nav-item">
            <a href="../scholars/list-scholars.php" class="nav-link">
              <p>
                Scholar List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href=".php" class="nav-link">
              <p>
                Training Schedule 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <a href="../admin/list-admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../admin/add-admin.php" class="nav-link">
                  <p>Admin Add</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Excel</li>
          <li class="nav-item">
            <a href="../functions/upload-xlsx.php" class="nav-link">
              <p>
                Excel View
              </p>
            </a>
          </li>
          <li class="nav-header">View</li>
          <li class="nav-item">
            <a href="../functions/view-xlsx.php" class="nav-link">
              <p>
                View Excel
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>