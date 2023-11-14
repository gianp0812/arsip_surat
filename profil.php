<?php
$id = $_SESSION['user']['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['nama'])) {
	$id = $_SESSION['user']['id_user'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];

	if (isset($_FILES['foto'])) {
		$foto = $_FILES['foto']['name'];
		$foto_temp = $_FILES['foto']['tmp_name'];

		$fotobaru = rand() . '_' . $foto;

		$path = "photo/" . $fotobaru;

		if (move_uploaded_file($foto_temp, $path)) {
			if (is_file("photo/" . $data['photo']))
				unlink("photo/" . $data['photo']);

			$query = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama', username='$username', photo='$fotobaru' WHERE id_user='$id'");
			$session = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");

			if ($query) {
				$_SESSION['user'] = mysqli_fetch_array($session);
				echo '<script>alert("Profil berhasil diupdate");location.href="?page=profil";</script>';
			}
		}
	}


	$query = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama', username='$username' WHERE id_user='$id'");
	$session = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");

	if ($query) {
		$_SESSION['user'] = mysqli_fetch_array($session);
		echo '<script>alert("Profil berhasil diupdate");location.href="?page=profil";</script>';
	}
}

if (isset($_POST['password_lama'])) {
	$username = $_SESSION['user']['username'];
	$password_lama = md5($_POST['password_lama']);
	$password_baru = md5($_POST['password_baru']);
	$konfirmasi_password_baru = md5($_POST['konfirmasi_password_baru']);

	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password_lama'");
	$data = mysqli_num_rows($query);

	if ($data == 0) {
		echo '<script>alert("Password Lama Tidak Sesuai");location.href="?page=profil";</script>';
	} elseif ($_POST['password_baru'] != $_POST['konfirmasi_password_baru']) {
		echo '<script>alert("Konfirmasi Password Tidak Sesuai");location.href="?page=profil";</script>';
	} else {
		$query = mysqli_query($koneksi, "UPDATE user SET password='$password_baru' WHERE username='$username'");
		if ($query) {
			echo '<script>alert("Password Berhasil Diganti");location.href="?page=profil";</script>';
		}
	}
}
?>

<!-- Informasi Foto Profil Dan Lain-lain -->
<div class="mb-3" align="center">
	<h1 class="h3 d-inline align-middle">Profil User</h1>
</div>
<div class="row">
	<div class="col-md-4 col-xl-3">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="card-title mb-0" align="center">Foto Profil</h5>
			</div>
			<div class="card-body text-center">
				<img src="photo/<?php echo $_SESSION['user']['photo'] ?>" alt="<?php echo $_SESSION['user']['nama_lengkap']; ?>" class="img-fluid rounded-circle mb-2" width="128" height="128" />
				<h5 class="card-title mb-0"><?php echo $_SESSION['user']['nama_lengkap']; ?></h5>
				<?php
				$query_unit = mysqli_query($koneksi, "SELECT * FROM user INNER JOIN unit_kerja ON user.id_unit_kerja=unit_kerja.id_unit_kerja WHERE id_user='$id'");
				while ($unit = mysqli_fetch_array($query_unit)) {
				?><div class="mt-3">
						<h5 class="card-title">Posisi : <?php echo $unit['nama_unit_kerja'] ?></h5>
					</div>
				<?php
				}
				?>
			</div>

		</div>
	</div>

	<!-- Edit Username Dan Foto Profil -->
	<div class="col-5">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0 text-center">Edit Profil</h5>
			</div>

			<div class="card-body h-100">
				<form action="" method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label class="form-label">Nama Lengkap</label>
						<input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['user']['nama_lengkap']; ?>">
					</div>

					<div class="mb-3">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control" value="<?php echo $_SESSION['user']['username']; ?>">
					</div>

					<div class="mb-3">
						<label class="form-label">Foto</label>
						<input type="file" name="foto" class="form-control">
					</div>

					<div class="mb-3 text-center">
						<button class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>



	<!-- Edit Password -->
	<div class="col-4">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0 text-center">Edit Password</h5>
			</div>


			<div class="card-body h-100">
				<form action="" method="post">
					<div class="mb-3">
						<label class="form-label">Password Lama</label>
						<input type="password" name="password_lama" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Password Baru</label>
						<input type="password" name="password_baru" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Konfimasi Password Baru</label>
						<input type="password" name="konfirmasi_password_baru" class="form-control" required>
					</div>
					<div class="mb-3 text-center">
						<button class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>