<?php
if (isset($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] != 'superadmin') {
	echo '<script>location.href="alert.php";</script>';
}
?>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-header">
				<button data-bs-toggle="modal" data-bs-target="#tambahuser" class="btn btn-success btn-sm">+ Tambah User</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped table-hover cell-border" id="daftar_user">
					<thead>
						<tr>
							<th>No</th>
							<th>Avatar</th>
							<th>Username</th>
							<th>Nama Lengkap</th>
							<th>Unit Kerja</th>
							<th>Hak Akses</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$query = mysqli_query($koneksi, "SELECT * FROM user INNER JOIN unit_kerja ON user.id_unit_kerja=unit_kerja.id_unit_kerja ");
						while ($data = mysqli_fetch_array($query)) {
						?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td>
									<img src="photo/<?php echo $data['photo'] ?>" class="avatar img-fluid rounded-circle">
								</td>
								<td><?php echo $data['username'] ?></td>
								<td><?php echo $data['nama_lengkap'] ?></td>
								<td><?php echo $data['nama_unit_kerja'] ?></td>
								<td><?php echo $data['hak_akses'] ?></td>
								<td>
									<button data-bs-toggle="modal" data-bs-target="#edit-user<?php echo $data['id_user'] ?>" class="btn btn-secondary btn-sm rounded"><i data-feather="edit"></i></button>
									<button data-bs-toggle="modal" data-bs-target="#hapususer<?php echo $data['id_user'] ?>" class="btn btn-danger btn-sm rounded"><i data-feather="trash-2"></i></button>
								</td>
							</tr>

							<!-- Modal Edit -->
							<div class="modal fade" id="edit-user<?php echo $data['id_user'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<div class="col-12">
												<div class="text-center">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form action="control/user.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="mb-3">
													<input type="hidden" name="id_user" value="<?php echo $data['id_user'] ?>">

													<label class="form-label">Nama Lengkap</label>
													<div>
														<input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap'] ?>">
													</div>
												</div>
												<div class="mb-3">
													<label class="form-label">Username</label>
													<div>
														<input type="text" name="username" class="form-control" value="<?php echo $data['username'] ?>">
													</div>
												</div>
												<div class="mb-3">
													<label class="form-label">Password</label>
													<div>
														<input type="password" name="password" class="form-control">
													</div>
												</div>
												<div class="mb-3">
													<input type="hidden" name="hak_akses" value="<?php $data['hak_akses'] ?>">
												</div>
												<div class="mb-3">
													<label class="form-label">Unit Kerja</label>
													<select name="id_unit_kerja" class="form-select">
														<?php
														$query1 = mysqli_query($koneksi, "SELECT * FROM unit_kerja");
														while ($unit_kerja = mysqli_fetch_array($query1)) {
														?>
															<option value="<?php echo $unit_kerja['id_unit_kerja'] ?>" <?php echo ($data['id_unit_kerja'] == $unit_kerja['id_unit_kerja'] ? 'selected' : '') ?>>
																<?php echo $unit_kerja['nama_unit_kerja'] ?>
															</option>
														<?php
														}
														?>
													</select>
												</div>
												<div class="mb-3">
													<label class="form-label">Foto</label>
													<div>
														<input type="file" name="photo" class="form-control">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<div class="col-12">
													<div class="text-center">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="edit-user">Simpan</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- Modal Hapus -->
							<div class="modal fade" id="hapususer<?php echo $data['id_user'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<div class="col-12">
												<div class="text-center">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus User</h1>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form action="control/user.php" method="post">
											<div class="modal-body">
												<div class="mb-3">
													<input type="hidden" name="id_user" value="<?php echo $data['id_user'] ?>">
													<div class="text-center">
														<span>Yakin Hapus Data ?</span><br>
														<span class="text-danger">Nama User - <span><?php echo $data['nama_lengkap'] ?></span></span>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<div class="col-12">
													<div class="text-center">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="hapususer">Hapus</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="col-12">
					<div class="text-center">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="control/user.php" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Nama Lengkap</label>
						<div>
							<input type="text" name="nama_lengkap" class="form-control" required>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Username</label>
						<div>
							<input type="text" name="username" class="form-control" required>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<div>
							<input type="password" name="password" class="form-control" required>
						</div>
					</div>
					<div class="mb-3">
						<input type="hidden" name="hak_akses" value="admin">
						<label class="form-label">Unit Kerja</label>
						<select name="id_unit_kerja" class="form-select" required>
							<option hidden>-Pilih-</option>
							<?php
							$query = mysqli_query($koneksi, "SELECT * FROM unit_kerja");
							while ($unit_kerja = mysqli_fetch_array($query)) {
							?>
								<option value="<?php echo $unit_kerja['id_unit_kerja'] ?>">
									<?php echo $unit_kerja['nama_unit_kerja'] ?>
								</option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Foto</label>
						<div>
							<input type="file" name="photo" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-12">
						<div class="text-center">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="tambahuser">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let table = new DataTable('#daftar_user');
</script>