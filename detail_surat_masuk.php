<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<table class="table table-striped">
				<?php
				$id = $_GET['id'];

				$query = mysqli_query($koneksi, "SELECT*FROM surat_masuk WHERE id_surat_masuk='$id'");
				while ($data = mysqli_fetch_array($query)) {

				?>
					<thead>
						<tr>
							<th>
								<h5><span class="label label-inverse pull-right"><strong># Detail Surat Masuk</strong></span></h5>
							</th>
							<th>
								<h4><?php echo $data['no_surat_masuk'] ?></h4>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Tanggal Surat</td>
							<td><?php echo $data['tanggal_surat_masuk'] ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Pengirim</td>
							<td><?php echo $data['pengirim'] ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Sifat Surat</td>
							<td><?php echo $data['sifat_surat'] ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Perihal</td>
							<td><?php echo $data['perihal'] ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Isi Surat</td>
							<td><?php echo $data['isi_surat'] ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Disposisi</td>
							<td>
								<?php
								$query_cek = mysqli_query($koneksi, "SELECT id_surat_masuk FROM disposisi WHERE id_surat_masuk='$id'");
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
							<td></td>
						</tr>
						<tr>
							<td>Lampiran</td>
							<td><?php if (!empty($data['lampiran'])) {
									echo $data['lampiran'];
								} else {
									echo "FIle Lampiran Tidak Di Upload";
								} ?> </td>
							<td><?php if (!empty($data['lampiran'])) { ?> <a href="download_sm.php?lampiran=<?= $data['lampiran'] ?>" class="btn btn-primary btn-sm rounded">Unduh File</a> <?php } ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><a href="?page=surat_masuk" class="btn btn-warning">Kembali</a></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>

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
<?php
				}
?>
</table>
	</div>
</div>
</div>