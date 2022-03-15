<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title><?php if(!empty($judul)) echo $judul; ?> - <?= $nama_toko ?></title>
		<link href="<?= base_url('public_html/barlow.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('public_html/bootstrap.min.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('public_html/styles.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('public_html/my.css') ?>" rel="stylesheet" />
		<link href="<?= base_url('public_html/font-awesome-4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet" />
		<?php
			if(!empty($part_style)) $this->load->view($part_style);
		?>
	</head>
	<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
			<a class="navbar-brand" href="<?= base_url('admin') ?>"><?= $nama_toko ?></a>
			<button type="button" class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle"><i class="fa fa-bars"></i></button>
			<!-- Navbar Search-->
			<div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

			</div>
			<!-- Navbar-->
			<ul class="navbar-nav ml-auto ml-md-0">
				<?php
					if(!empty($warning)){
				?>
				<li class="nav-item dropdown">
					<a style="background-color: #FFA500; color: #FFFFFF; position: relative;" class="nav-link" href="<?= base_url('admin/warning') ?>">
						<i class="fa fa-warning"></i>
					</a>
				</li>
				<?php
					}
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i></a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="<?= base_url('admin/settings') ?>"><i class="fa fa-gear"></i> Pengaturan</a>
						<a class="dropdown-item" href="<?= base_url('admin/warning') ?>"><i class="fa fa-warning"></i> Peringatan</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url('admin/logout') ?>"><i class="fa fa-power-off"></i> Keluar</a>
					</div>
				</li>
			</ul>
		</nav>
		<div id="layoutSidenav">
			<div id="layoutSidenav_nav">
				<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
					<div class="sb-sidenav-menu">
						<div class="nav">
							<div class="sb-sidenav-menu-heading">Main</div>
							<a class="nav-link" href="<?= base_url('admin') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-tachometer"></i></div>
								Dashboard
							</a>
							<div class="sb-sidenav-menu-heading">Master</div>
							<a class="nav-link<?php if($this->session->userdata('user_role') != 'super') echo ' forbidden' ?>" href="<?= base_url('master_suplier') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-group"></i></div>
								Master Suplier
							</a>
							<a class="nav-link<?php if($this->session->userdata('user_role') != 'super') echo ' forbidden' ?>" href="<?= base_url('master_barang_jenis') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-shopping-basket"></i></div>
								Master Barang Jenis
							</a>
							<a class="nav-link<?php if($this->session->userdata('user_role') != 'super') echo ' forbidden' ?>" href="<?= base_url('master_barang') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-shopping-basket"></i></div>
								Master Barang
							</a>
							<div class="sb-sidenav-menu-heading">Aktifitas</div>
							<a class="nav-link<?php if($this->session->userdata('user_role') != 'super') echo ' forbidden' ?>" href="<?= base_url('pembelian') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-shopping-cart"></i></div>
								Pembelian
							</a>
							<a class="nav-link<?php if($this->session->userdata('user_role') != 'super') echo ' forbidden' ?>" href="<?= base_url('stok') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-shopping-bag"></i></div>
								Stok
							</a>
							<a class="nav-link" href="<?= base_url('penjualan') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-dollar"></i></div>
								Penjualan
							</a>
							<a class="nav-link" href="<?= base_url('laporan_pembelian') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-file-text"></i></div>
								Laporan Pembelian
							</a>
							<a class="nav-link" href="<?= base_url('laporan_penjualan') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-file-text"></i></div>
								Laporan Penjualan
							</a>
							<a class="nav-link" href="<?= base_url('laporan_retur_beli') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-file-text"></i></div>
								Laporan Retur Beli
							</a>
							<a class="nav-link<?php if($this->session->userdata('user_role') != 'super') echo ' forbidden' ?>" href="<?= base_url('lain_lain') ?>">
								<div class="sb-nav-link-icon"><i class="fa fa-smile-o"></i></div>
								Lain - lain
							</a>
						</div>
					</div>
					<div class="sb-sidenav-footer">
						<div class="small">Masuk sebagai</div>
						<?= $this->session->userdata('user_id') ?>
					</div>
				</nav>
			</div>
			<div id="layoutSidenav_content">
				<main>
					<div class="container-fluid">
						<div style="padding: 10px 0px;">
							<?php
								if(!empty($part_view)) $this->load->view($part_view);
							?>
						</div>
					</div>
				</main>
				<footer class="py-4 bg-light mt-auto">
					<div class="container-fluid">
						<div class="d-flex align-items-center justify-content-between small">
							<div class="text-muted">Copyright &copy; <?= $nama_toko ?> 2020</div>
							<div>
								<a href="#">Privacy Policy</a>
								&middot;
								<a href="#">Terms &amp; Conditions</a>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="<?= base_url('public_html/jquery-1.12.4.min.js') ?>"></script>
		<script src="<?= base_url('public_html/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('public_html/scripts.js') ?>"></script>
		<?php
			if(!empty($part_script)) $this->load->view($part_script);
		?>
		<?php
			if(!empty($sub_part_script)) $this->load->view($sub_part_script);
		?>
	</body>
</html>
