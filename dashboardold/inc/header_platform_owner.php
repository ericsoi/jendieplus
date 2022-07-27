<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <style>
    .blue-color {
    color:blue;
    }
    .green-color {
    color:green;
    }
    .teal-color {
    color:teal;
    }
    .yellow-color {
    color:yellow;
    }
    .red-color {
    color:red;
    }
    </style>
  </style>
  <title>JendiePlus | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="img/logo1.jpg">
  <!--Sweetalert Plugin --->
  <script src="bower_components/sweetalert/sweetalert.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- bootstrap timepicker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- datepicker js -->
  <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- iCheck 1.0.1 -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

  <!-- chart Js -->
  <script src="chartjs/dist/Chart.min.js"></script>
  <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/icon.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Satisfy" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
	<link href="css/icon_fonts/css/all_icons.min.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="layerslider/css/layerslider.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Dashboard</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>JendiePlus|</b>Dashboard</span>
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
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="img/logo1.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <!-- <span class="hidden-xs text-lowercase"><?php echo $_SESSION['username']; ?></span> -->
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="img/logo1.jpg" class="img-circle" alt="User Image">

                  <p class="text-lowercase">
                    <?php echo $_SESSION['username']; ?> - <?php echo $_SESSION['role']; ?>
                    <!-- <small class="text-capitalize"><?php echo $_SESSION['username']; ?></small> -->
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="misc/logout.php" class="btn btn-default btn-flat"
                    onclick="return confirm('Sign Out ?')"
                    class="btn btn-danger">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar Menu -->
        
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Menu</li>
          <li><a href="./home.php"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
          <li><a href="./product.php"><i class="fa fa-list-alt"></i> <span>Products</span></a></li>
          <li><a href="./policies.php"><i class="fa fa-umbrella"></i> <span>Policies</span></a></li>
          <li><a href=""><i class="fa fa-calendar"></i> <span>Renewals</span></a></li>    
          <li><a href="./claims.php"><i class="fa fa-handshake-o"></i> <span>Claims</span></a></li>
          <li><a href="./quotes.php"><i class="fa fa-balance-scale"></i> <span>Quotes</span></a></li>
          <li><a href="./clients.php"><i class="fa fa-users"></i> <span>Clients</span></a></li>
          <li><a href="./user.php"><i class="fa fa-archive"></i> <span>Users</span></a></li>
          <li><a href="./agent.php"><i class="fa fa-archive"></i> <span>Agents</span></a></li>
          <li><a href="./underwriters.php"><i class="fa fa-list-ul"></i> <span>Underwriters</span></a></li>
          <li><a href="./wallet.php"><i class="fa fa-bitcoin"></i> <span>Wallet</span></a></li>
          <li><a href="./category.php"><i class="fa fa-list-alt"></i> <span>Product Category</span></a></li>
          <li><a href=""><i class="fa fa-envelope"></i> <span>Notification</span></a></li>

          <!-- <li><a href=""><i class="fa fa-envelope"></i> <span>Invoice</span></a></li>
          <li><a href=""><i class="fa fa-envelope"></i> <span>Receipt</span></a></li> -->
          



        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

