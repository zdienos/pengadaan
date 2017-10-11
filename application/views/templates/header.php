<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>SPK PENGADAAN BARANG</title>
	<link rel="icon" type="images/x-icon" href="..\..\pengadaan\assets\img\circle.ico">
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
	<link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">
	
	<style>
		.dataTables_wrapper {
			min-height: 500px
		}

		.dataTables_processing {
			position: absolute;
			top: 50%;
			left: 50%;
			width: 100%;
			margin-left: -50%;
			margin-top: -25px;
			padding-top: 20px;
			text-align: center;
			font-size: 1.2em;
			color:grey;
		}
	</style>
</head>
<body>
	
	<!-- Main Menu -->
	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background: #3c8dbc">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" style="color: #ffffff; font-size: 20px" href="<?php echo site_url('home'); ?>"><img src="..\..\pengadaan\assets\img\circle.png" width="30" height="30"/> SISTEM PENDUKUNG KEPUTUSAN PENGADAAN BARANG</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="color: #ffffff">
						<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="<?php echo site_url('login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Keluar</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-light sidebar" style="background-color: #ffffff" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">

						<?php if($this->session->userdata('stat')=="Peserta Lelang"){?>
						<li>
							<a href="http://[::1]/pengadaan/pengumuman"><i class="fa fa-bullhorn fa-fw"></i><span class="label label-danger pull-right"><?php echo $this->session->userdata('jumlah'); ?></span> Pengumuman Pelelangan</a>
						</li><li>
						<a href="http://[::1]/pengadaan/perusahaan"><i class="fa fa-building fa-fw"></i> Data Perusahaan</a>
						</li><li>
							<a href="http://[::1]/pengadaan/downup"><i class="fa fa-file-zip-o fa-fw"></i> Kelengkapan Kualifikasi</a>
						</li><li>
							<a href="http://[::1]/pengadaan/barang"><i class="fa fa-tags fa-fw" ></i> Data Barang</a>
						</li><li>
							<a href="http://[::1]/pengadaan/nilai"><i class="fa fa-gavel fa-fw" ></i> Calon Pemenang</a>
						</li>
						<?php

						}else if($this->session->userdata('stat')=="Staff Pengadaan"){?>
						<li>
							<a href="http://[::1]/pengadaan/pengumuman"><i class="fa fa-bullhorn fa-fw"></i> Pengumuman Pelelangan</a>
						</li><li>
							<a href="http://[::1]/pengadaan/perusahaan"><i class="fa fa-building fa-fw"></i> Data Perusahaan</a>
						</li><li>
							<a href="http://[::1]/pengadaan/downup"><i class="fa fa-file-zip-o fa-fw"></i> Kelengkapan Kualifikasi</a>
						</li><li>
							<a href="http://[::1]/pengadaan/barang"><i class="fa fa-tags fa-fw"></i> Data Barang</a>
						</li><li>
							<a href="http://[::1]/pengadaan/kriteria"><i class="fa fa-gavel fa-fw"></i> Proses SAW</a>
						</li>
						<?php }else{ ?>
						<li>
							<a href="http://[::1]/pengadaan/pengumuman"><i class="fa fa-bullhorn fa-fw"></i> Pengumuman Pelelangan</a>
						</li><li>
						<a href="http://[::1]/pengadaan/perusahaan"><i class="fa fa-building fa-fw"></i> Data Perusahaan</a>
						</li><li>
							<a href="http://[::1]/pengadaan/downup"><i class="fa fa-file-zip-o fa-fw"></i> Kelengkapan Kualifikasi</a>
						</li><li>
							<a href="http://[::1]/pengadaan/barang"><i class="fa fa-tags fa-fw"></i> Data Barang</a>
						</li><li>
							<a href="http://[::1]/pengadaan/kriteria"><i class="fa fa-gavel fa-fw"></i> Proses SAW</a>
						</li><li>
							<a href="http://[::1]/pengadaan/user"><i class="fa fa-users fa-fw"></i> Data User</a>
						</li>				
			<?php } ?>
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
<!-- Main Menu -->
<div id="page-wrapper">