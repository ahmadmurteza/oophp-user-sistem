<?php 

session_start();
if (!isset($_SESSION['username'])) {
	header('location: index.php');
	die;
}

include 'admin-db.php';

$admin = new Admin();
$name = $_SESSION['username'];
$title = ucfirst(explode('-', basename($_SERVER['PHP_SELF'], '.php'))[1]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= $title; ?> | Admin Panel</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	    <!-- Left navbar links -->
	    <ul class="navbar-nav">
	    	<li class="nav-item">
	    		<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
	    	</li>
	    </ul>
  	</nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
	    <!-- Brand Logo -->
	    <a href="" class="brand-link">
	      <i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;
	      <span class="brand-text font-weight-light">AdminLTE 3</span>
	    </a>

	    <!-- Sidebar -->
	    <div class="sidebar">
	      <!-- Sidebar user panel (optional) -->
	      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="info">
	          	<a href="" class="d-block"><?= $name; ?></a>
	        </div>
	      </div>

      	<!-- Sidebar Menu -->
	  	<nav class="mt-2">
		    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		      	<!-- Add icons to the links using the .nav-icon class
		           with font-awesome or any other icon font library -->
			    <li class="nav-item">
		        	<a href="admin-dashboard.php" class="nav-link <?= ($title == 'Dashboard') ? 'active' : '' ; ?>">
				        <i class="nav-icon fas fa-tachometer-alt"></i>
				        <p>
				            Dashboard
				        </p>
			        </a>
		      	</li>
		      	<li class="nav-item">
		        	<a href="admin-users.php" class="nav-link <?= ($title == 'Users') ? 'active' : '' ; ?>">
				        <i class="nav-icon fas fa-users"></i>
				        <p>
				            Users
				        </p>
			        </a>
		      	</li>
		      	<li class="nav-item">
		        	<a href="admin-notes.php" class="nav-link <?= ($title == 'Notes') ? 'active' : '' ; ?>">
				        <i class="nav-icon fas fa-sticky-note"></i>
				        <p>
				            Notes
				        </p>
			        </a>
		      	</li>
		      	<li class="nav-item">
		        	<a href="admin-feedback.php" class="nav-link  <?= ($title == 'Feedback') ? 'active' : '' ; ?>">
				        <i class="nav-icon fas fa-comment"></i>
				        <p>
				            Feedback
				        </p>
			        </a>
		      	</li>
		      	<li class="nav-item">
		        	<a href="admin-deleteduser.php" class="nav-link  <?= ($title == 'Deleteduser') ? 'active' : '' ; ?>">
				        <i class="nav-icon fas fa-user-slash"></i>
				        <p>
				            Deleted Users
				        </p>
			        </a>
		      	</li>
		      	<li class="nav-item">
		        	<a href="assets/php/admin-action.php?export=excel" class="nav-link">
				        <i class="nav-icon fas fa-file-excel"></i>
				        <p>
				            Export Users
				        </p>
			        </a>
		      	</li>
		      	<li class="nav-item">
		        	<a href="assets/php/logout.php" class="nav-link text-danger font-weight-bold">
				        <i class="nav-icon fas fa-sign-out-alt"></i>
				        <p>
				            Log-Out
				        </p>
			        </a>
		      	</li>
		    </ul>
	  	</nav>
      	<!-- /.sidebar-menu -->
	    </div>
    <!-- /.sidebar -->
  	</aside>