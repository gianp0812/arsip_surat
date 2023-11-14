<?php

if ($_SESSION['user']['hak_akses'] != 'superadmin') {
	echo '<script>location.href="alert.php";</script>';
}
?>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-header">
				<button data-bs-toggle="modal" data-bs-target="#tambahunitkerja" class="btn btn-success btn-sm">+ Tambah Unit Kerja</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped table-hover cell-border" id="surat_masuk">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Unit Kerja</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$query = mysqli_query($koneksi, "SELECT*FROM unit_kerja");
						while ($data = mysqli_fetch_array($query)) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['nama_unit_kerja']; ?></td>
								<td>
									<button data-bs-toggle="modal" data-bs-target="#editunitkerja<?php echo $data['id_unit_kerja'] ?>" class="btn btn-secondary btn-sm rounded"><i data-feather="edit"></i></button>
									<button data-bs-toggle="modal" data-bs-target="#hapusunitkerja<?php echo $data['id_unit_kerja'] ?>" class="btn btn-danger btn-sm rounded"><i data-feather="trash-2"></i></button>
								</td>
							</tr>

							<!-- Modal Edit -->
							<div class="modal fade" id="editunitkerja<?php echo $data['id_unit_kerja'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<div class="col-12">
												<div class="text-center">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Unit Kerja</h1>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form action="control/unit_kerja.php" method="post">
											<div class="modal-body">
												<div class="mb-3">
													<input type="hidden" name="id_unit_kerja" value="<?php echo $data['id_unit_kerja'] ?>">
													<label class="form-label">Nama Unit Kerja</label>
													<div>
														<input type="text" name="nama_unit_kerja" class="form-control" value="<?php echo $data['nama_unit_kerja'] ?>">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<div class="col-12">
													<div class="text-center">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="editunitkerja">Simpan</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- Modal Hapus -->
							<div class="modal fade" id="hapusunitkerja<?php echo $data['id_unit_kerja'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<div class="col-12">
												<div class="text-center">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Unit Kerja</h1>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form action="control/unit_kerja.php" method="post">
											<div class="modal-body">
												<div class="mb-3">
													<input type="hidden" name="id_unit_kerja" value="<?php echo $data['id_unit_kerja'] ?>">
													<div class="text-center">
														<span>Yakin Hapus Data ?</span><br>
														<span class="text-danger">Nama Unit Kerja - <span><?php echo $data['nama_unit_kerja'] ?></span></span>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<div class="col-12">
													<div class="text-center">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="hapusunitkerja">Hapus</button>
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

<script>
	let table = new DataTable('#surat_masuk');
</script>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahunitkerja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="col-12">
					<div class="text-center">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Unit Kerja</h1>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="control/unit_kerja.php" method="post">
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Nama Unit Kerja</label>
						<div>
							<input type="text" name="nama_unit_kerja" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-12">
						<div class="text-center">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="tambahunitkerja">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>