<?php
include '../koneksi.php';
if (isset($_POST['tambahuser'])) {
    $nama_user = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $hak_akses = $_POST['hak_akses'];
    $id_unit_kerja = $_POST['id_unit_kerja'];
    $foto = $_FILES['photo']['name'];
    $foto_tmp = $_FILES['photo']['tmp_name'];

    $fotobaru = rand() . '_' . $foto;

    $path = "../photo/" . $fotobaru;

    if (move_uploaded_file($foto_tmp, $path)) {
        $query1 = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap,username,password,hak_akses,id_unit_kerja,photo) VALUES ('$nama_user','$username','$password','$hak_akses','$id_unit_kerja','$fotobaru')");

        if ($query1) {
            echo '<script>alert("Tambah Data Berhasil");location.href="../?page=daftar_user";</script>';
        }
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap,username,password,hak_akses,id_unit_kerja) VALUES ('$nama_user','$username','$password','$hak_akses','$id_unit_kerja')");

        if ($query) {
            echo '<script>alert("Tambah Data Berhasil");location.href="../?page=daftar_user";</script>';
        }
    }
}

if (isset($_POST['edit-user'])) {
    $nama_user = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $id_unit_kerja = $_POST['id_unit_kerja'];
    $id_user = $_POST['id_user'];
    $password = md5($_POST['password']);

    $query_cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
    $data_cek = mysqli_fetch_array($query_cek);

    if (isset($_FILES['photo'])) {
        $foto = $_FILES['photo']['name'];
        $foto_temp = $_FILES['photo']['tmp_name'];

        $fotobaru = rand() . '_' . $foto;

        $path = "../photo/" . $fotobaru;

        if (move_uploaded_file($foto_temp, $path)) {
            if (is_file("../photo/" . $data_cek['photo']))
                unlink("../photo/" . $data_cek['photo']);

            if ($_POST['password'] != "") {
                $query = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_user', username='$username', password='$password', photo='$fotobaru', id_unit_kerja='$id_unit_kerja' WHERE id_user='$id_user'");
            } else {
                $query = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_user', username='$username', photo='$fotobaru', id_unit_kerja='$id_unit_kerja' WHERE id_user='$id_user'");
            }

            $session = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");

            if ($query) {
                $_SESSION['user'] = mysqli_fetch_array($session);
                echo '<script>alert("Profil berhasil diupdate");location.href="../?page=daftar_user";</script>';
            }
        }
    }
    if ($_POST['password'] != "") {
        $query = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_user', username='$username', password='$password', id_unit_kerja='$id_unit_kerja' WHERE id_user='$id_user'");
    } else {
        $query = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_user', username='$username', id_unit_kerja='$id_unit_kerja' WHERE id_user='$id_user'");
    }
    if ($query) {
        echo '<script>alert("Profil berhasil diupdate");location.href="../?page=daftar_user";</script>';
    }
}

if (isset($_POST['hapususer'])) {
    $id_user = $_POST['id_user'];

    $query_hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");

    if ($query_hapus) {
        echo '<script>alert("Hapus User Berhasil");location.href="../?page=daftar_user";</script>';
    }
}
