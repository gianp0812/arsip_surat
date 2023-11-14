<?php 
include '../koneksi.php';

if (isset($_POST['tambahsuratkeluar'])) {
	$no_surat = $_POST['no_surat'];
	$tanggal_surat = $_POST['tanggal_surat'];
	$sifat_surat = $_POST['sifat_surat'];
	$pengirim = $_POST['pengirim'];
    $tujuan = $_POST['tujuan'];
	$isi_surat = $_POST['isi_surat'];
	$perihal = $_POST['perihal'];
	$lampiran = $_FILES['lampiran']['name'];
    $lampiran_tmp = $_FILES['lampiran']['tmp_name'];

	$lampiranbaru = rand() . '_' . $lampiran;

    $path = "../lampiran_kel/" . $lampiranbaru;
	

	if (move_uploaded_file($lampiran_tmp, $path)) {
        $query1 = mysqli_query($koneksi, "INSERT INTO surat_keluar (no_surat_keluar,perihal,isi_surat_keluar,lampiran,sifat,tujuan,tanggal_surat_keluar,id_unit_kerja) VALUES ('$no_surat','$perihal','$isi_surat','$lampiranbaru','$sifat_surat','$tujuan','$tanggal_surat','$pengirim')");

        if ($query1) {
            echo '<script>alert("Tambah Data Berhasil");location.href="../?page=surat_keluar";</script>';
        }
    }else{
       $query = mysqli_query($koneksi, "INSERT INTO surat_keluar (no_surat_keluar,perihal,isi_surat_keluar,sifat,tujuan,tanggal_surat_keluar,id_unit_kerja) VALUES ('$no_surat','$perihal','$isi_surat','$sifat_surat','$tujuan','$tanggal_surat','$pengirim')");

        if ($query) {
            echo '<script>alert("Tambah Data Berhasil");location.href="../?page=surat_keluar";</script>';
        }
    }
}

if (isset($_POST['editsuratkeluar'])) {
	$no_surat = $_POST['no_surat_keluar'];
	$tanggal_surat = $_POST['tanggal_surat'];
	$sifat_surat = $_POST['sifat_surat'];
	$pengirim = $_POST['pengirim'];
	$isi_surat = $_POST['isi_surat'];
	$perihal = $_POST['perihal'];
	$tujuan = $_POST['tujuan'];
	$id_surat_keluar = $_POST['id_surat_keluar'];

	$query_data = mysqli_query($koneksi, "SELECT * FROM surat_keluar WHERE id_surat_keluar='$id_surat_keluar'");
	$data = mysqli_fetch_array($query_data);


	if (isset($_FILES['lampiran'])) {
		$lampiran = $_FILES['lampiran']['name'];
		$lampiran_tmp = $_FILES['lampiran']['tmp_name'];

		$lampiranbaru = rand() . '_' . $lampiran;
		$path = "../lampiran_kel/" . $lampiranbaru;

		if (move_uploaded_file($lampiran_tmp, $path)) {
			if(is_file("../lampiran_kel/" . $data['lampiran']))
			unlink("../lampiran_kel/" . $data['lampiran']);

			$query_edit = mysqli_query($koneksi, "UPDATE surat_keluar SET no_surat_keluar='$no_surat', perihal='$perihal', isi_surat_keluar='$isi_surat', lampiran='$lampiranbaru', sifat='$sifat_surat', id_unit_kerja='$pengirim', tanggal_surat_keluar='$tanggal_surat', tujuan='$tujuan', lampiran='$lampiranbaru' WHERE id_surat_keluar='$id_surat_keluar'");

			if ($query_edit) {
				echo '<script>alert("Edit Surat Berhasil");location.href="../?page=surat_keluar";</script>';
			}
		}
		
	}

	$query_edit1 = mysqli_query($koneksi, "UPDATE surat_keluar SET no_surat_keluar='$no_surat', perihal='$perihal', isi_surat_keluar='$isi_surat', sifat='$sifat_surat', id_unit_kerja='$pengirim', tanggal_surat_keluar='$tanggal_surat', tujuan='$tujuan' WHERE id_surat_keluar='$id_surat_keluar'");
		
	if ($query_edit1) {
		echo '<script>alert("Edit Surat Berhasil");location.href="../?page=surat_keluar";</script>';
	}
}

if (isset($_POST['hapussuratkeluar'])) {
    $id_surat_keluar = $_POST['id_surat_keluar'];

    $query_hapus = mysqli_query($koneksi, "DELETE FROM surat_keluar WHERE id_surat_keluar='$id_surat_keluar'");

    if ($query_hapus) {
        echo '<script>alert("Hapus Surat Berhasil");location.href="../?page=surat_keluar";</script>';
    }
}
?>