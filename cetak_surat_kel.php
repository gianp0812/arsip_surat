<?php
include 'koneksi.php';
if (isset($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] != 'superadmin') {
	echo '<script>location.href="alert.php";</script>';
}
?>

<script>
	window.print();
</script>

<table border="1" width="100%" cellpading="5" cellspacing="0">
	<tr>
		<th colspan="9">Cetak Laporan Surat Keluar</th>
	</tr>
	<tr>
		<th>Nomor</th>
		<th>Tanggal Surat</th>
		<th>No Surat</th>
		<th>Perihal</th>
		<th>Sifat Surat</th>
		<th>pengirim</th>
		<th>Tujuan</th>
	</tr>
	<tbody>
		<?php
		$no = 1;
		if (isset($_GET['tampil']) && $_GET['tampil'] == 'kel') {
			$tanggal_awal_sk = $_GET['twsk'];
			$tanggal_akhir_sk = $_GET['task'];
			$unit_kerja = $_GET['uk'];

			if ($tanggal_awal_sk != "" && $tanggal_akhir_sk != "" && $unit_kerja != "Semua Unit") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE surat_keluar.id_unit_kerja='$unit_kerja' AND tanggal_surat_keluar BETWEEN '$tanggal_awal_sk' AND '$tanggal_akhir_sk'");
			} elseif ($unit_kerja != "Semua Unit") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE surat_keluar.id_unit_kerja='$unit_kerja'");
			} elseif ($tanggal_awal_sk != "" && $tanggal_akhir_sk != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE tanggal_surat_keluar BETWEEN '$tanggal_awal_sk' AND '$tanggal_akhir_sk'");
			} elseif ($tanggal_awal_sk != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE tanggal_surat_keluar>='$tanggal_awal_sk'");
			} elseif ($tanggal_akhir_sk != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE tanggal_surat_keluar<='$tanggal_akhir_sk'");
			} elseif ($tanggal_awal_sk != "" && $unit_kerja != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE surat_keluar.id_unit_kerja='$unit_kerja' AND tanggal_surat_kelua>='$tanggal_awal_sk'");
			} elseif ($tanggal_akhir_sk != "" && $unit_kerja != "") {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja WHERE surat_keluar.id_unit_kerja='$unit_kerja' AND tanggal_surat_kelua<='$tanggal_akhir_sk'");
			} else {
				$query = mysqli_query($koneksi, "SELECT * FROM surat_keluar INNER JOIN unit_kerja ON surat_keluar.id_unit_kerja=unit_kerja.id_unit_kerja");
			}
			while ($data = mysqli_fetch_array($query)) {
		?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo date('d-m-Y', strtotime($data['tanggal_surat_keluar'])); ?></td>
					<td><?php echo $data['no_surat_keluar']; ?></td>
					<td><?php echo $data['perihal']; ?></td>
					<td><?php echo $data['sifat']; ?></td>
					<td><?php echo $data['nama_unit_kerja']; ?></td>
					<td><?php echo $data['tujuan']; ?></td>
				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>