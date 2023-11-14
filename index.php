<?php
include 'koneksi.php';

if (empty($_SESSION['user'])) {
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>Arsip Surat - 
		<?php
		$page = isset($_GET['page']) ? $_GET['page'] : 'Dasboard';
		$cek = preg_replace('/-/',' ',$page);
		$title = ucwords($cek);
		echo $title;
		?>
	</title>

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
					<span class="align-middle"> <i data-feather="mail"></i> Arsip Surat</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Halaman
					</li>

					<li class="sidebar-item 
					<?php 
					if (empty($_GET['page']) || $page == 'dashboard') {
						echo 'active';
					}
					?>">
						<a class="sidebar-link" href="index.php">
							<i class="align-middle" data-feather="sliders"></i> <span
								class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item 
					<?php
					if ($page == 'surat_masuk'  || $page == 'tambah_surat_masuk' || $page == 'detail_surat_masuk') {
						echo 'active';
					}
					?>
					">
						<a class="sidebar-link" href="?page=surat_masuk">
							<i class="align-middle" data-feather="corner-up-left"></i> <span class="align-middle">Surat Masuk</span>
						</a>
					</li>

					<li class="sidebar-item 
					<?php
					if ($page == 'surat_keluar' || $page == 'tambah_surat_keluar' || $page == 'detail_surat_keluar') {
						echo 'active';
					}
					?>
					">
						<a class="sidebar-link" href="?page=surat_keluar">
							<i class="align-middle" data-feather="corner-up-right"></i> <span class="align-middle">Surat Keluar</span>
						</a>
					</li>

					<li class="sidebar-item
					<?php
					if ($page == 'unit_kerja' || $page == 'tambah_unit_kerja' || $page == 'edit_unit_kerja') {
						echo 'active';
					}
					?>
					" <?php if ($_SESSION['user']['hak_akses'] == 'admin') { ?> style="display: none;" <?php } ?>>
						<a class="sidebar-link" href="?page=unit_kerja">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Unit Kerja</span>
						</a>
					</li>
					<li class="sidebar-item
					<?php
					if ($page == 'daftar_user' || $page == 'tambah_user' || $page == 'edit_user') {
						echo 'active';
					}
					?>
					" <?php if ($_SESSION['user']['hak_akses'] == 'admin') { ?> style="display: none;" <?php } ?>>
						<a class="sidebar-link" href="?page=daftar_user">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Daftar User</span>
						</a>
					</li>
					<li class="sidebar-item
					<?php
					if ($page == 'report') {
						echo 'active';
					}
					?>
					" <?php if ($_SESSION['user']['hak_akses'] == 'admin') { ?> style="display: none;" <?php } ?>>
						<a class="sidebar-link" href="?page=report">
							<i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Laporan</span>
						</a>
					</li>
				
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
								data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
								data-bs-toggle="dropdown">
								<img src="photo/<?php echo $_SESSION['user']['photo']?>" class="avatar img-fluid rounded me-1" alt="<?php echo $_SESSION['user']['nama_lengkap']; ?>" /> <span
									class="text-dark"><?php echo $_SESSION['user']['nama_lengkap']; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="?page=profil"><i class="align-middle me-1"
										data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard' ;
                    include $page . '.php';

                    ?>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/"
									target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted"
									href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin
										Template</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>