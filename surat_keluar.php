<h1 class="h3 mb-3" align="center"><strong>Surat Keluar</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">

			<?php
			if (!empty($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] == 'superadmin') {
			?>
				<div class="card-header">
					<button data-bs-toggle="modal" data-bs-target="#tambahsuratkeluar" class="btn btn-success btn-sm">+ Tambah Surat Keluar</button>

				</div>
			<?php
			}
			?>

			<div class="card-body">
				<table class="table table-bordered table-striped table-hover cell-border" id="surat_keluar">
					<thead>
						<tr>
							<th>No</th>
							<th>No Surat</th>
							<th>Sifat Surat</th>
							<th>Pengirim</th>
							<th>Tujuan</th>
							<th>Perihal</th>
							<th>Tanggal Surat</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$no = 1;
						$id = $_SESSION['user']['id_unit_kerja'];
						if (!empty($_SESSION) && $_SESSION['user']['hak_akses'] != 'superadmin') {
							$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE surat_keluar.id_unit_kerja='$id'");
						} else {
							$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja");
						}
						while ($data = mysqli_fetch_array($query)) {

						?>

							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['no_surat_keluar']; ?></td>
								<td><?php echo $data['sifat']; ?></td>
								<td><?php echo $data['nama_unit_kerja']; ?></td>
								<td><?php echo $data['tujuan']; ?></td>
								<td><?php echo $data['perihal']; ?></td>
								<td><?php echo date('d-m-Y', strtotime($data['tanggal_surat_keluar'])); ?></td>
								<td>
									<a href="?page=detail_surat_keluar&id=<?php echo $data['id_surat_keluar'] ?>" class="btn btn-primary btn-sm rounded"><i data-feather="folder"></i></a>
									<?php
									if (!empty($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] == 'superadmin') {
									?>
										<button data-bs-toggle="modal" data-bs-target="#editsuratkeluar<?php echo $data['id_surat_keluar']; ?>" class="btn btn-secondary btn-sm rounded"><i data-feather="edit"></i></button>
										<button data-bs-toggle="modal" data-bs-target="#hapussuratkeluar<?php echo $data['id_surat_keluar'];  ?>" class="btn btn-secondary btn-sm rounded"><i data-feather="trash-2"></i></button>
									<?php
									}
									?>
								</td>
							</tr>

							<!-- Modal Edit -->
							<div class="modal fade" id="editsuratkeluar<?php echo $data['id_surat_keluar'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<div class="col-12">
												<div class="text-center">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Surat Keluar</h1>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form action="control/surat_keluar.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="mb-3">
													<input type="hidden" name="id_surat_keluar" value="<?php echo $data['id_surat_keluar'] ?>">
													<label class="form-label">No Surat Keluar</label>
													<div>
														<input type="text" name="no_surat_keluar" class="form-control" value="<?php echo $data['no_surat_keluar'] ?>">
													</div>
												</div>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label class="form-label">Perihal</label>
													<div>
														<input type="text" name="perihal" class="form-control" value="<?php echo $data['perihal'] ?>">
													</div>
												</div>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label class="form-label">Pengirim</label>
													<div><select name="pengirim" class="form-select">
															<?php
															$query1 = mysqli_query($koneksi, "SELECT * FROM unit_kerja");
															while ($data1 = mysqli_fetch_array($query1)) {
															?>
																<option value="<?php echo $data1['id_unit_kerja']; ?>" <?php echo ($data['id_unit_kerja'] == $data1['id_unit_kerja'] ? 'selected' : '') ?>><?php echo $data1['nama_unit_kerja']; ?></option>
															<?php
															}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label class="form-label">Sifat Surat</label>
													<div>
														<select name="sifat_surat" class="form-select">
															<option hidden><?php echo $data['sifat'] ?></option>
															<option>Rahasia</option>
															<option>Biasa</option>
															<option>Segera</option>
														</select>
													</div>
												</div>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label class="form-label">Tujuan</label>
													<div>
														<input type="text" name="tujuan" class="form-control" value="<?php echo $data['tujuan']; ?>">
													</div>
												</div>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label class="form-label">Isi Surat</label>
													<div>
														<textarea name="isi_surat" cols="55" rows="10"><?php echo $data['isi_surat_keluar'] ?></textarea>
													</div>
												</div>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label class="form-label">Lampiran</label>
													<div>
														<input type="file" name="lampiran" class="form-control" value="<?php echo $data['lampiran'] ?>">
													</div>
												</div>
											</div>
											<div class="modal-body">
												<div class="mb-3">
													<label class="form-label">Tanggal Surat</label>
													<div>
														<input type="date" name="tanggal_surat" class="form-control" value="<?php echo $data['tanggal_surat_keluar'] ?>">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<div class="col-12">
													<div class="text-center">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="editsuratkeluar">Simpan</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- Modal Hapus -->
							<div class="modal fade" id="hapussuratkeluar<?php echo $data['id_surat_keluar'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<div class="col-12">
												<div class="text-center">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Surat</h1>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form action="control/surat_keluar.php" method="post">
											<div class="modal-body">
												<div class="mb-3">
													<input type="hidden" name="id_surat_keluar" value="<?php echo $data['id_surat_keluar'] ?>">
													<div class="text-center">
														<span>Yakin Hapus Surat ?</span><br>
														<span class="text-danger">No Surat - <span><?php echo $data['no_surat_keluar'] ?></span></span>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<div class="col-12">
													<div class="text-center">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="hapussuratkeluar">Hapus</button>
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
<div class="modal fade" id="tambahsuratkeluar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="col-12">
					<div class="text-center">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Surat Keluar</h1>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="control/surat_keluar.php" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">No Surat</label>
						<div>
							<input type="text" name="no_surat" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Pengirim</label>
						<div>
							<select name="pengirim" class="form-select" required>
								<?php
								$query1 = mysqli_query($koneksi, "SELECT * FROM unit_kerja");
								while ($data = mysqli_fetch_array($query1)) {
								?>
									<option hidden></option>
									<option value="<?php echo $data['id_unit_kerja']; ?>"> <?php echo $data['nama_unit_kerja']; ?></option>

								<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Sifat Surat</label>
						<div>
							<select name="sifat_surat" class="form-select" required>
								<option hidden></option>
								<option>Rahasia</option>
								<option>Biasa</option>
								<option>Segera</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Tujuan</label>
						<div>
							<input type="text" name="tujuan" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Lampiran</label>
						<div>
							<input type="file" name="lampiran" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Tanggal Surat</label>
						<div>
							<input type="date" name="tanggal_surat" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Perihal</label>
						<div>
							<input type="text" name="perihal" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Isi Surat</label>
					</div>
					<div>
						<textarea name="isi_surat" cols="55" rows="10"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-12">
						<div class="text-center">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="tambahsuratkeluar">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let table = new DataTable('#surat_keluar');
</script>