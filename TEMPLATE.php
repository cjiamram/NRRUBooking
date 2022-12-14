<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/jquery-confirm.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <span class="logo-mini"><b>WMS</b></span>
      <span class="logo-lg"><b>ENDU WMS</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>-->
            <ul class="dropdown-menu">
              <!--<li class="header">You have 4 messages</li>-->
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                    
                         <!--<img src="dist/img/chatchai 01 160.png" class="img-circle" alt="User Image">-->
                      </div>
                      <!-- Message title and timestamp -->
                      <!--<h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>-->
                      <!-- The message -->
                      <!--<p>Why not buy a new awesome theme?</p>-->
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <!--<li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>
          <!-- /.messages-menu -->

          <li class="dropdown notifications-menu">
            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>-->
            <ul class="dropdown-menu">
              <!--<li class="header">You have 10 notifications</li>-->
              <!--<li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>-->
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <li class="dropdown tasks-menu">
            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>-->
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <!-- Task title and progress text -->
                      <!--<h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>-->
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <!--<span class="sr-only">20% Complete</span>-->
                        </div>
                      </div>
                    </a>
                  </li>
                 
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/Chatchai 01 160.png" class="user-image" alt="User Image">

              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Chatchai Jiamram</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <!--<li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  Chatchai Jiamram WEB Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>-->
              <!-- Menu Body -->
              <!--<li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
          <img src="dist/img/chatchai 01 160.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Chatchai Jiamram</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <div id="dvMenu"></div>
      <!--<ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Product</a></li>
            <li><a href="#">Product Query</a></li>
          </ul>
        </li>
      </ul>-->
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

  
        <div class="box"></div>
        <div class="row">
          <div class="form-group">
             
          <div class="col-sm-12">
         
            <!--<div class="col-sm-1">??????????????????</div>-->

             <div class="col-sm-6">
               <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="txtSearchKey">
                  
                </div>
             </div>
          
             <div>

              <div  class="col-sm-4">
              </div>
          
            
          </div>
          </div>

        </div>
        <div>
        </div>
        <hr>
        <div class="row">
          <!-- --> 
       

        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <strong>Copyright &copy; 2019 <a href="#">CJAutomation</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <!--<h3 class="control-sidebar-heading">Recent Activity</h3>-->
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <!--<div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>-->
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <!--<h3 class="control-sidebar-heading">Tasks Progress</h3>-->
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <!--<h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>-->

              <!--<div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>-->
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
   <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

 

  <!--Modal Optional-->
  

  

  <!--Modal Search-->


<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="dist/js/jquery-confirm.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/component.js"></script>

</body>
</html>