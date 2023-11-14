<?php 
include '../koneksi.php';

if (isset($_POST['tambahsuratmasuk'])) {
	$no_surat = $_POST['no_surat'];
	$tanggal_surat = $_POST['tanggal_surat'];
	$sifat_surat = $_POST['sifat_surat'];
	$pengirim = $_POST['pengirim'];
	$isi_surat = $_POST['isi_surat'];
	$perihal = $_POST['perihal'];
    $lampiran = $_FILES['lampiran']['name'];
    $lampiran_tmp = $_FILES['lampiran']['tmp_name'];

	$lampiranbaru = rand() . '_' . $lampiran;

    $path = "../lampiran/" . $lampiranbaru;

	if (move_uploaded_file($lampiran_tmp, $path)) {
        $query1 = mysqli_query($koneksi, "INSERT INTO surat_masuk (no_surat_masuk,perihal,isi_surat,lampiran,sifat_surat,pengirim,tanggal_surat_masuk) VALUES ('$no_surat','$perihal','$isi_surat','$lampiranbaru','$sifat_surat','$pengirim','$tanggal_surat')");

        if ($query1) {
            echo '<script>alert("Tambah Data Berhasil");location.href="../?page=surat_masuk";</script>';
        }
    }else{
       $query = mysqli_query($koneksi, "INSERT INTO surat_masuk (no_surat_masuk,perihal,isi_surat,sifat_surat,pengirim,tanggal_surat_masuk) VALUES ('$no_surat','$perihal','$isi_surat','$sifat_surat','$pengirim','$tanggal_surat')");

        if ($query) {
            echo '<script>alert("Tambah Data Berhasil");location.href="../?page=surat_masuk";</script>';
        }
    }
}

if (isset($_POST['editsuratmasuk'])) {
	$no_surat = $_POST['no_surat_masuk'];
	$tanggal_surat = $_POST['tanggal_surat'];
	$sifat_surat = $_POST['sifat_surat'];
	$pengirim = $_POST['pengirim'];
	$isi_surat = $_POST['isi_surat'];
	$perihal = $_POST['perihal'];
	$id_surat_masuk = $_POST['id_surat_masuk'];
	
	$query_data = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE id_surat_masuk='$id_surat_masuk'");
	$data = mysqli_fetch_array($query_data);

	if (isset($_FILES['lampiran'])) {
		$lampiran = $_FILES['lampiran']['name'];
		$lampiran_tmp = $_FILES['lampiran']['tmp_name'];

		$lampiranbaru = rand() . '_' . $lampiran;

		$path = "../lampiran/" . $lampiranbaru;

		if (move_uploaded_file($lampiran_tmp, $path)) {
			if(is_file("../lampiran/" . $data['lampiran']))
			unlink("../lampiran/" . $data['lampiran']);

			$query_edit = mysqli_query($koneksi, "UPDATE surat_masuk SET no_surat_masuk='$no_surat', perihal='$perihal', isi_surat='$isi_surat', lampiran='$lampiranbaru', sifat_surat='$sifat_surat', pengirim='$pengirim', tanggal_surat_masuk='$tanggal_surat' WHERE id_surat_masuk='$id_surat_masuk'");
			
			if ($query_edit) {
				echo '<script>alert("Edit Surat Berhasil");location.href="../?page=surat_masuk";</script>';

			}
		}
	}

	$query_edit1 = mysqli_query($koneksi, "UPDATE surat_masuk SET no_surat_masuk='$no_surat', perihal='$perihal', isi_surat='$isi_surat', sifat_surat='$sifat_surat', pengirim='$pengirim', tanggal_surat_masuk='$tanggal_surat' WHERE id_surat_masuk='$id_surat_masuk'");
	
	if ($query_edit1) {
		echo '<script>alert("Edit Surat Berhasil");location.href="../?page=surat_masuk";</script>';

	}
}

if (isset($_POST['hapussuratmasuk'])) {
    $id_surat_masuk = $_POST['id_surat_masuk'];

    $query_hapus = mysqli_query($koneksi, "DELETE FROM surat_masuk WHERE id_surat_masuk='$id_surat_masuk'");

    if ($query_hapus) {
        echo '<script>alert("Hapus Surat Berhasil");location.href="../?page=surat_masuk";</script>';
    }
}

if (isset($_POST['tambahdisposisi'])) {
	$id_surat_masuk = $_POST['id_surat_masuk'];
	$id_unit_kerja = $_POST['id_unit_kerja'];
	$isi_disposisi = $_POST['isi_diposisi'];

	$query_disposisi = mysqli_query($koneksi, "INSERT INTO disposisi (id_surat_masuk,id_unit_kerja,isi_disposisi) VALUES ('$id_surat_masuk','$id_unit_kerja','$isi_disposisi')");

	if ($query_disposisi) {
        echo '<script>alert("Disposisi Surat Berhasil");location.href="../?page=surat_masuk";</script>';
    }
}

if (isset($_POST['ubahdisposisi'])) {
	$id_surat_masuk = $_POST['id_surat_masuk'];
	$id_unit_kerja = $_POST['id_unit_kerja'];
	$isi_disposisi = $_POST['isi_disposisi'];

	$query_ubah_dis = mysqli_query($koneksi, "UPDATE surat_masuk SET id_unit_kerja='$id_surat_masuk', isi_disposisi='$isi_disposisi'");

	if ($query_ubah_dis) {
		echo '<script>alert("Ubah Disposisi Berhasil");location.href="../?page=detail_surat_masuk"</script>';
	}
}
?>

