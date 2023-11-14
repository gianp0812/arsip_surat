<?php
include 'koneksi.php';
if (isset($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] != 'superadmin') {
	echo '<script>location.href="alert.php";</script>';
}
?>

<script>
	window.print();
</script>

<table border="1" width="100%" cellpadding="5" cellspacing="0">
	<tr>
		<th colspan="9">Cetak Laporan Surat Masuk</th>
	</tr>
	<tr>
		<th>Nomor</th>
		<th>Tanggal Surat</th>
		<th>No Surat</th>
		<th>Perihal</th>
		<th>Sifat Surat</th>
		<th>pengirim</th>
		<th>disposisi</th>
	</tr>
	<tbody>
		<?php
		$no = 1;
		if (isset($_GET['tampil']) && $_GET['tampil'] == 'mas') {
			$tanggal_awal_sm = $_GET['twsm'];
			$tanggal_akhir_sm = $_GET['tasm'];
			$unit_kerja = $_GET['uk'];

			if ($_GET['twsm'] != "" && $_GET['tasm'] != "" && $_GET['uk'] != "Semua Unit") {
				$query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja='$unit_kerja' AND surat_masuk.tanggal_surat_masuk BETWEEN '$tanggal_awal_sm' AND '$tanggal_akhir_sm'");
			} elseif ($_GET['uk'] != "Semua Unit") {
				$query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja='$unit_kerja'");
			} elseif ($_GET['twsm'] != "" && $_GET['tasm'] != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE tanggal_surat_masuk BETWEEN '$tanggal_awal_sm' AND '$tanggal_akhir_sm'");
			} elseif ($_GET['twsm'] != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE tanggal_surat_masuk>='$tanggal_awal_sm'");
			} elseif ($_GET['tasm'] != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE tanggal_surat_masuk<='$tanggal_akhir_sm'");
			} elseif ($_GET['twsm'] != "" && $_GET['uk'] != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja='$unit_kerja' AND surat_masuk.tanggal_surat_masuk>='$tanggal_awal_sm'");
			} elseif ($_GET['tasm'] != "" && $_GET['uk'] != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja=$unit_kerja' AND surat_masuk.tanggal_surat_masuk<='$tanggal_akhir_sm'");
			} else {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_masuk");
			}
			while ($data = mysqli_fetch_array($query)) {
		?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo date('d-m-Y', strtotime($data['tanggal_surat_masuk'])); ?></td>
					<td><?php echo $data['no_surat_masuk']; ?></td>
					<td><?php echo $data['perihal']; ?></td>
					<td><?php echo $data['sifat_surat']; ?></td>
					<td><?php echo $data['pengirim']; ?></td>
					<td>
						<?php
						if ($unit_kerja == 'Semua Unit') {
							$id = $data['id_surat_masuk'];

							$query_dis = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE id_surat_masuk='$id'");
							while ($data_dis = mysqli_fetch_array($query_dis)) {
								echo $data_dis['nama_unit_kerja'];
							}
						} else {
							echo $data['nama_unit_kerja'];
						}
						?>
					</td>
				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>