


<h1 class="h3 mb-3" align="center"><strong>Tambah Surat Keluar</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-body">
				<form action="" method="post">
					<div class="mb-3">
						<label class="form-label">No Surat</label>
						<div>
							<input type="text" name="no_surat" class="form-control">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Tanggal Surat</label>
						<div>
							<input type="date" name="tanggal_surat" class="form-control">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Sifat Surat</label>
						<div>
							<select name="sifat_surat" class="form-select">
								<option>Rahasia</option>
								<option>Biasa</option>
								<option>Segera</option>
							</select>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Pengirim</label>
						<input type="text" name="pengirim" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Tujuan</label>
						<div>
							<select name="tujuan" class="form-select">
								<?php
								$query1 = mysqli_query($koneksi, "SELECT * FROM unit_kerja");
								while ($data = mysqli_fetch_array($query1)) {                         
								?>

								<option value="<?php echo $data['id_unit_kerja']; ?>"> <?php echo $data['nama_unit_kerja']; ?></option>
								
								<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Lampiran</label>
						<input type="file" name="lampiran" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Perihal</label>
						<div>
							<input type="text" name="perihal" class="form-control">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Isi Surat</label>
						<div>
							<textarea name="isi_surat" cols="158" rows="10"></textarea>
						</div>
					</div>

					<div class="mb-3" style="float: right;">
						<button class="btn btn-primary">Simpan</button>
						<button typy="reset" class="btn btn-danger">Reset</button>
						<a href="?page=surat_keluar" class="btn btn-warning"> kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>