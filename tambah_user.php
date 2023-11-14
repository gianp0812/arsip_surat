<h1 class="h3 mb-3" align="center"><strong>Tambah User</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-body">
				<form action="" method="post">
					<div class="mb-3">
						<label class="form-label">Nama Lengkap</label>
						<div>
							<input type="text" name="nama_lengkap" class="form-control">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Username</label>
						<div>
							<input type="text" name="username" class="form-control">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<div>
							<input type="password" name="password" class="form-control">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Hak Akses</label>
						<input type="text" name="hak_akses" class="form-control">
					</div>
					<div class="mb-3">
						<label class="form-label">Unit Kerja</label>
						<select name="unit_kerja" class="form-select">
							<option value="">Sekertaris</option>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Foto</label>
						<div>
							<input type="file" name="photo" class="form-control">
						</div>
					</div>

					<div class="mb-3" style="float: right;">
						<button class="btn btn-primary">Simpan</button>
						<button typy="reset" class="btn btn-danger">Reset</button>
						<a href="?page=unit_kerja" class="btn btn-warning">kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>