<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>DS</b> BD</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>DSB</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['admin_name'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="categories.php"><i class="fa fa-circle-o"></i> Categories</a></li>
                <li><a href="business.php"><i class="fa fa-circle-o"></i> Business</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Users</a></li>
                
              </ul>
            </li>
            
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Business</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="add-business.php"><i class="fa fa-circle-o"></i>Add Business</a></li>
                <li><a href="business.php"><i class="fa fa-circle-o"></i>View All Business</a></li>
              </ul>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="pro-types.php"><i class="fa fa-circle-o"></i>Product Types</a></li>
                
              </ul>
            </li>
            <li><a href="reviews.php"><i class="fa fa-book"></i> <span>Reviews</span></a></li>
            <li><a href="featureds.php"><i class="fa fa-book"></i><span>Featured Selections</span></a></li>
            <li><a href="logout.php">Log out</a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
