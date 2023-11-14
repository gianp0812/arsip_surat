<h1 class="h3 mb-3" align="center"><strong>Surat Masuk</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<?php
			if (!empty($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] == 'superadmin') {
			?>
				<div class="card-header">
					<button data-bs-toggle="modal" data-bs-target="#tambahsuratmasuk" class="btn btn-success btn-sm">+ Tambah Surat Masuk</button>

				</div>

			<?php
			}
			?>
			<div class="card-body">
				<table class="table table-bordered table-striped table-hover cell-border" id="surat_masuk">
					<thead>
						<tr>
							<th>No</th>
							<th>No Surat</th>
							<th>Perihal</th>
							<th>Pengirim</th>
							<?php
							if (!empty($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] == 'superadmin') {
							?>
								<th>Disposisi</th>
							<?php
							}
							?>
							<th>Tanggal Surat</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						if (!empty($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] == 'superadmin') {
							$query = mysqli_query($koneksi, "SELECT*FROM surat_masuk");
						} else {
							$id = $_SESSION['user']['id_unit_kerja'];
							$query = mysqli_query($koneksi, "SELECT*FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk WHERE disposisi.id_unit_kerja='$id'");
						}
						while ($data = mysqli_fetch_array($query)) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $data['no_surat_masuk']; ?></td>
								<td><?php echo $data['perihal']; ?></td>
								<td><?php echo $data['pengirim']; ?></td>
								<?php
								if (!empty($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] == 'superadmin') {
								?>
									<td>
										<?php
										$id_surat_masuk1 = $data['id_surat_masuk'];

										$query_cek = mysqli_query($koneksi, "SELECT id_surat_masuk FROM disposisi WHERE id_surat_masuk='$id_surat_masuk1'");
										$cek_dis = mysqli_fetch_array($query_cek);

										if (empty($cek_dis)) {

										?>
											<button data-bs-toggle="modal" data-bs-target="#tambahdisposisi<?php echo $data['id_surat_masuk'] ?>" class="btn btn-primary btn-sm rounded"><i data-feather="plus"></i></button> Tambah Disposisi
										<?php
										} else {
										?>
											<button data-bs-toggle="modal" data-bs-target="#detaildisposisi<?php echo $data['id_surat_masuk'] ?>" class="btn btn-primary btn-sm rounded"><i data-feather="eye"></i></button> Detail
										<?php
										}
										?>
									</td>
								<?php
								}
								?>
								<td><?php echo date('d-m-Y', strtotime($data['tanggal_surat_masuk'])); ?></td>
								<td>
									<a href="?page=detail_surat_masuk&id=<?php echo $data['id_surat_masuk'] ?>" class="btn btn-primary btn-sm rounded"><i data-feather="folder"></i></a>
									<?php
									if (!empty($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] == 'superadmin') {
									?>
										<button data-bs-toggle="modal" data-bs-target="#editsuratmasuk<?php echo $data['id_surat_masuk'] ?>" class="btn btn-secondary btn-sm rounded"><i data-feather="edit"></i></button>
										<button data-bs-toggle="modal" data-bs-target="#hapussuratmasuk<?php echo $data['id_surat_masuk'] ?>" class="btn btn-secondary btn-sm rounded"><i data-feather="trash-2"></i></button>

									<?php
									}
									?>

								</td>
							</tr>

							<?php
							// Query untuk mengambil data disposisi berdasarkan id_surat_masuk
							$disposisi_query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja");

							while ($disposisi = mysqli_fetch_assoc($disposisi_query)) {
							?>
								<!-- Modal Detail Disposisi -->
								<div class="modal fade" id="detaildisposisi<?php echo $disposisi['id_surat_masuk'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<div class="col-12">
													<div class="text-center">
														<h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Disposisi</h1>
													</div>
												</div>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>

											<form action="control/surat_masuk.php" method="post" enctype="multipart/form-data">
												<div class="modal-body">
													<div class="mb-3">
														<label class="form-label"><strong>No Surat Masuk</strong></label>
														<div>
															<p style="border: dashed 2px #eceff5; padding: 15px;
													 margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $disposisi['no_surat_masuk'] ?></p>
														</div>
													</div>
												</div>
												<div class="modal-body">
													<div class="mb-3">
														<label class="form-label"><strong>Perihal</strong></label>
														<div>
															<p style="border: dashed 2px #eceff5; padding: 15px;
													 margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $disposisi['perihal'] ?></p>
														</div>
													</div>
												</div>
												<div class="modal-body">
													<div class="mb-3">
														<label class="form-label">Tujuan Disposisi</label>
														<div>
															<p style="border: dashed 2px #eceff5; padding: 15px;
													 margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $disposisi['nama_unit_kerja'] ?></p>
														</div>

													</div>
												</div>
												<div class="modal-body">
													<div class="mb-3">
														<label class="form-label"><strong>Isi Disposisi</strong></label>
														<div>
															<p style="border: dashed 2px #eceff5; padding: 15px;
													 margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $disposisi['isi_disposisi'] ?></p>
														</div>
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

		<!-- Modal Edit -->
		<div class="modal fade" id="editsuratmasuk<?php echo $data['id_surat_masuk'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="col-12">
							<div class="text-center">
								<h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Surat Masuk</h1>
							</div>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="control/surat_masuk.php" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="id_surat_masuk" value="<?php echo $data['id_surat_masuk'] ?>">
								<label class="form-label">No Surat Masuk</label>
								<div>
									<input type="text" name="no_surat_masuk" class="form-control" value="<?php echo $data['no_surat_masuk'] ?>">
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
								<div>
									<input type="text" name="pengirim" class="form-control" value="<?php echo $data['pengirim'] ?>">
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Sifat Surat</label>
								<div>
									<select name="sifat_surat" class="form-select">
										<option hidden value="<?php echo $data['sifat_surat'] ?>"><?php echo $data['sifat_surat'] ?></option>
										<option>Rahasia</option>
										<option>Biasa</option>
										<option>Segera</option>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Isi Surat</label>
								<div>
									<textarea name="isi_surat" cols="55" rows="10"><?php echo $data['isi_surat'] ?></textarea>
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
									<input type="date" name="tanggal_surat" class="form-control" value="<?php echo $data['tanggal_surat_masuk'] ?>">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="col-12">
								<div class="text-center">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="editsuratmasuk">Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>


		<!-- Modal Hapus -->
		<div class="modal fade" id="hapussuratmasuk<?php echo $data['id_surat_masuk'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
					<form action="control/surat_masuk.php" method="post">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="id_surat_masuk" value="<?php echo $data['id_surat_masuk'] ?>">
								<div class="text-center">
									<span>Yakin Hapus Surat ?</span><br>
									<span class="text-danger">No Surat - <span><?php echo $data['no_surat_masuk'] ?></span></span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="col-12">
								<div class="text-center">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="hapussuratmasuk">Hapus</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal Disposisi -->
		<div class="modal fade" id="tambahdisposisi<?php echo $data['id_surat_masuk'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="col-12">
							<div class="text-center">
								<h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Disposisi</h1>
							</div>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="control/surat_masuk.php" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="id_surat_masuk" value="<?php echo $data['id_surat_masuk'] ?>">
								<label class="form-label"><strong>No Surat Masuk</strong></label>
								<div>
									<p style="border: dashed 2px #eceff5; padding: 15px;
													 margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $data['no_surat_masuk'] ?></p>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label"><strong>Perihal</strong></label>
								<div>
									<p style="border: dashed 2px #eceff5; padding: 15px;
													 margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $data['perihal'] ?></p>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Tujuan Disposisi</label>
								<div>
									<select name="id_unit_kerja" class="form-select">
										<?php
										$query1 = mysqli_query($koneksi, "SELECT * FROM unit_kerja INNER JOIN user ON unit_kerja.id_unit_kerja=user.id_unit_kerja WHERE user.hak_akses='admin'");
										while ($data = mysqli_fetch_array($query1)) {
										?>
											<option hidden></option>
											<option value="<?php echo $data['id_unit_kerja']; ?>"><?php echo $data['nama_unit_kerja']; ?></option>

										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label"><strong>Isi Disposisi</strong></label>
								<div>
									<textarea name="isi_diposisi" cols="55" rows="10"></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="col-12">
								<div class="text-center">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="tambahdisposisi">Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal Edit Disposisi -->
		<div class="modal fade" id="ubahdisposisi<?php echo $data['id_surat_masuk'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="col-12">
							<div class="text-center">
								<h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Disposisi</h1>
							</div>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="control/surat_masuk.php" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="mb-3">
								<input type="hidden" name="id_surat_masuk" value="<?php echo $data['id_surat_masuk'] ?>">
								<label class="form-label"><strong>No Surat Masuk</strong></label>
								<div>
									<p style="border: dashed 2px #eceff5; padding: 15px;
									margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $data['no_surat_masuk'] ?></p>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label"><strong>Perihal</strong></label>
								<div>
									<p style="border: dashed 2px #eceff5; padding: 15px;
									margin: 0; text-align: justify; line-height: 23px; color: #1a356e; font-size: 18px"><?php echo $data['perihal'] ?></p>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Tujuan Disposisi</label>
								<div>
									<select name="id_unit_kerja" class="form-select">
										<?php
										$query1 = mysqli_query($koneksi, "SELECT * FROM unit_kerja INNER JOIN user ON unit_kerja.id_unit_kerja=user.id_unit_kerja WHERE user.hak_akses='admin'");
										while ($data1 = mysqli_fetch_array($query1)) {
										?>
											<option value="<?php echo $data1['id_unit_kerja']; ?>" <?php echo ($data1['id_unit_kerja'] == $data1['id_unit_kerja'] ? 'selected' : '') ?>><?php echo $data['nama_unit_kerja']; ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label"><strong>Isi Disposisi</strong></label>
								<div>
									<textarea name="isi_diposisi" cols="55" rows="10"></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="col-12">
								<div class="text-center">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="tambahdisposisi">Simpan</button>
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
<div class="modal fade" id="tambahsuratmasuk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="col-12">
					<div class="text-center">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Surat Masuk</h1>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="control/surat_masuk.php" method="post" enctype="multipart/form-data">
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
						<label class="form-label">Perihal</label>
						<div>
							<input type="text" name="perihal" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Pengirim</label>
						<div>
							<input type="text" name="pengirim" class="form-control" required>
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
						<label class="form-label">Isi Surat</label>
						<div>
							<textarea name="isi_surat" cols="55" rows="10"></textarea>
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
				<div class="modal-footer">
					<div class="col-12">
						<div class="text-center">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="tambahsuratmasuk">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let table = new DataTable('#surat_masuk');
</script>