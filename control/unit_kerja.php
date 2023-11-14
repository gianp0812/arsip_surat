<?php
include '../koneksi.php';
if (isset($_POST['tambahunitkerja'])) {
    $nama_unit_kerja = $_POST['nama_unit_kerja'];

    $query = mysqli_query($koneksi, "INSERT INTO unit_kerja (nama_unit_kerja) VALUES ('$nama_unit_kerja')");

    if ($query) {
        echo '<script>alert("Tambah Data Berhasil");location.href="../?page=unit_kerja";</script>';
    }
}

if (isset($_POST['editunitkerja'])) {
    $nama_unit_kerja = $_POST['nama_unit_kerja'];
    $id_unit_kerja = $_POST['id_unit_kerja'];

    $query = mysqli_query($koneksi, "UPDATE unit_kerja SET nama_unit_kerja='$nama_unit_kerja' WHERE id_unit_kerja='$id_unit_kerja'");

    if ($query) {
        echo '<script>alert("Update Data Berhasil");location.href="../?page=unit_kerja";</script>';
    }
}

if (isset($_POST['hapusunitkerja'])) {
    $id_unit_kerja = $_POST['id_unit_kerja'];

    $query = mysqli_query($koneksi, "DELETE FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'");

    if ($query) {
        echo '<script>alert("Hapus Data Berhasil");location.href="../?page=unit_kerja";</script>';
    }
}

?>
