<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<table class="table table-striped">

				<?php
				$id = $_GET['id'];

				$query = mysqli_query($koneksi, "SELECT*FROM surat_keluar INNER JOIN unit_kerja ON unit_kerja.id_unit_kerja=surat_keluar.id_unit_kerja WHERE id_surat_keluar='$id'");
				while ($data = mysqli_fetch_array($query)) {

				?>

					<thead>
						<tr>
							<th>
								<h5><span class="label label-inverse pull-right"> <strong># Detail Surat Keluar</strong> </span></h5>
							</th>
							<th>
								<h4><?php echo $data['no_surat_keluar']; ?></h4>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Tanggal Surat</td>
							<td><?php echo $data['tanggal_surat_keluar']; ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Tujuan</td>
							<td><?php echo $data['tujuan']; ?></td>
						</tr>
						<tr>
							<td>Pengirim</td>
							<td><?php echo $data['nama_unit_kerja']; ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Sifat Surat</td>
							<td><?php echo $data['sifat']; ?></td>
						</tr>
						<tr>
							<td>Perihal</td>
							<td><?php echo $data['perihal']; ?></td>
							<td></td>
						</tr>
						<tr>
							<td>Isi Surat Ringkas</td>
							<td><?php echo $data['isi_surat_keluar']; ?></td>
						</tr>
						<tr>
							<td>Lampiran</td>
							<td><?php if (!empty($data['lampiran'])) {
									echo $data['lampiran'];
								} else {
									echo "File Lampiran TIdak Di Upload";
								} ?></td>
							<td><?php if (!empty($data['lampiran'])) { ?>
									<a href="download_sk.php?lampiran=<?= $data['lampiran'] ?>" class="btn btn-primary btn-sm-rounded">Unduh File</a>
							</td>
						<?php
								} ?>
						</tr>
						<tr>
							<td><a href="?page=surat_keluar" class="btn btn-warning">Kembali</a></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				<?php
				}
				?>
			</table>
		</div>
	</div>
</div>