<h1 class="h3 mb-3" align="center"><strong>Dashboard</strong></h1>
<div class="row">
	<div class="col-12">
		<div class="w-100">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Jumlah Surat Masuk</h5>
								</div>
								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="corner-up-left"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">
								<?php
								if (!empty($_SESSION['user']) && $_SESSION['user']['hak_akses'] != 'superadmin') {
									$id = $_SESSION['user']['id_unit_kerja'];
									$query_mas = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM disposisi WHERE id_unit_kerja='$id'");
								} else {
									$query_mas = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM surat_masuk");
								}
								$data_mas = mysqli_fetch_assoc($query_mas);
								echo $data_mas['total'];
								?>
							</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Jumlah Surat Keluar</h5>
								</div>

								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="corner-up-right"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">
								<?php
								if (!empty($_SESSION['user']) && $_SESSION['user']['hak_akses'] != 'superadmin') {
									$id = $_SESSION['user']['id_unit_kerja'];
									$query_kel = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM surat_keluar WHERE id_unit_kerja='$id'");
								} else {
									$query_kel = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM surat_keluar");
								}
								$data_kel = mysqli_fetch_assoc($query_kel);
								echo $data_kel['total'];
								?>
							</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Jumlah Unit Kerja</h5>
								</div>

								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="users"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">
								<?php
								$query_uk = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM unit_kerja");

								$data_uk = mysqli_fetch_assoc($query_uk);
								echo $data_uk['total'];
								?>
							</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Riwayat Disposisi</h5>
								</div>

								<div class="col-auto">
									<div class="stat text-primary">
										<i class="align-middle" data-feather="user"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">
								<?php
								if (!empty($_SESSION['user']) && $_SESSION['user']['hak_akses'] != 'superadmin') {
									$id = $_SESSION['user']['id_unit_kerja'];
									$query_dis = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM disposisi WHERE id_unit_kerja='$id'");
								} else {
									$query_dis = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM disposisi");
								}
								$data_dis = mysqli_fetch_assoc($query_dis);
								echo $data_dis['total'];
								?>
							</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>