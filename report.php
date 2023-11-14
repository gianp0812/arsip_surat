<?php
if (isset($_SESSION['user']['hak_akses']) && $_SESSION['user']['hak_akses'] != 'superadmin') {
    echo '<script>location.href="alert.php";</script>';
}

?>

<h1 class="h3 mb-3" align="center"><strong>Laporan Surat</strong></h1>
<div class="row">
    <div class="col-12">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Laporan Surat Masuk</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="corner-up-left"></i>
                                    </div>
                                </div>
                            </div>
                            <form method="post">
                                <input type="hidden" name="jns_surat" value="masuk">
                                <input type="hidden" name="tampil" value="mas">
                                Tanggal Awal :
                                <input type="date" name="tanggal_awal_sm" class="form-control" value="<?php echo (!empty($_POST['tanggal_awal_sm']) ? $_POST['tanggal_awal_sm'] : '') ?>">
                                <br>
                                Tanggal Akhir :
                                <input type="date" name="tanggal_akhir_sm" class="form-control" value="<?php echo (!empty($_POST['tanggal_akhir_sm']) ? $_POST['tanggal_akhir_sm'] : '') ?>">
                                <br>
                                Unit Kerja :
                                <select name="unit_kerja" class="form-select">
                                    <option hidden>Semua Unit</option>
                                    <?php
                                    $query_0 = mysqli_query($koneksi, "SELECT * FROM unit_kerja INNER JOIN user ON unit_kerja.id_unit_kerja=user.id_unit_kerja WHERE user.hak_akses='admin'");
                                    while ($data_0 = mysqli_fetch_array($query_0)) {
                                    ?>
                                        <option value="<?php echo $data_0['id_unit_kerja']; ?>" <?php echo (!empty($_POST['unit_kerja']) && $_POST['unit_kerja'] == $data_0['id_unit_kerja'] ? 'selected' : '') ?>>
                                            <?php echo $data_0['nama_unit_kerja']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-primary btin-rounded mt-3">Tampilkan</button>
                                <button type="reset" onclick="location.href='?page=report'" class="btn btn-danger btn-rounded mt-3">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Laporan Surat Keluar</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="corner-up-right"></i>
                                    </div>
                                </div>
                            </div>
                            <form method="post">
                                <input type="hidden" name="jns_surat" value="keluar">
                                <input type="hidden" name="tampil" value="kel">
                                Tanggal Awal :
                                <input type="date" name="tanggal_awal_sk" class="form-control" value="<?php echo (!empty($_POST['tanggal_awal_sk']) ? $_POST['tanggal_awal_sk'] : '') ?>">
                                <br>
                                Tanggal Akhir :
                                <input type="date" name="tanggal_akhir_sk" class="form-control" value="<?php echo (!empty($_POST['tanggal_akhir_sk']) ? $_POST['tanggal_akhir_sk'] : '') ?>">
                                <br>
                                Unit Kerja/Pengirim :
                                <select name="unit_kerja" class="form-select">
                                    <option hidden>Semua Unit</option>
                                    <?php
                                    $query_1 = mysqli_query($koneksi, "SELECT * FROM unit_kerja ");
                                    while ($data_1 = mysqli_fetch_array($query_1)) {
                                    ?>
                                        <option value="<?php echo $data_1['id_unit_kerja']; ?>" <?php echo (!empty($_POST['unit_kerja']) && $_POST['unit_kerja'] == $data_1['id_unit_kerja'] ? 'selected' : '') ?>>
                                            <?php echo $data_1['nama_unit_kerja']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-primary btin-rounded mt-3">Tampilkan</button>
                                <button type="reset" onclick="location.href='?page=report'" class="btn btn-danger btn-rounded mt-3">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Surat Masuk-->
                <?php if (isset($_POST['jns_surat']) && $_POST['jns_surat'] == 'masuk') {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="card-header">
                                    <div align="center">
                                        <h3>Laporan Surat Masuk</h3>
                                    </div>
                                    <?php
                                    if (isset($_POST['tampil'])) {
                                        $tanggal_awal_sm = $_POST['tanggal_awal_sm'];
                                        $tanggal_akhir_sm = $_POST['tanggal_akhir_sm'];
                                        $unit_kerja = $_POST['unit_kerja'];
                                    ?>
                                        <a href="cetak_surat.php?twsm=<?php echo $tanggal_awal_sm ?>&tasm=<?php echo $tanggal_akhir_sm ?>&uk=<?php echo $unit_kerja ?>&tampil=mas" target="_blank" class="btn btn-primary btn-sm rounded"><i data-feather="printer"></i> Print</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <table class="table table-bordered table-striped table-hover cell-border" id="surat_masuk">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Surat</th>
                                            <th>Sifat Surat</th>
                                            <th>Perihal</th>
                                            <th>Pengirim</th>
                                            <th>Disposisi</th>
                                            <th>Tanggal Surat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (isset($_POST['tampil']) && $_POST['tampil'] == 'mas') {
                                            $tanggal_awal_sm = $_POST['tanggal_awal_sm'];
                                            $tanggal_akhir_sm = $_POST['tanggal_akhir_sm'];
                                            $unit_kerja = $_POST['unit_kerja'];

                                            if ($tanggal_awal_sm != "" && $tanggal_akhir_sm != "" && $unit_kerja != "Semua Unit") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja='$unit_kerja' AND surat_masuk.tanggal_surat_masuk BETWEEN '$tanggal_awal_sm' AND '$tanggal_akhir_sm'");
                                            } elseif ($unit_kerja != "Semua Unit") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja='$unit_kerja'");
                                            } elseif ($tanggal_awal_sm != "" && $tanggal_akhir_sm != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE tanggal_surat_masuk BETWEEN '$tanggal_awal_sm' AND '$tanggal_akhir_sm'");
                                            } elseif ($tanggal_awal_sm != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE tanggal_surat_masuk>='$tanggal_awal_sm'");
                                            } elseif ($tanggal_akhir_sm != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE tanggal_surat_masuk<='$tanggal_akhir_sm'");
                                            } elseif ($tanggal_awal_sm != "" && $unit_kerja != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja='$unit_kerja' AND surat_masuk.tanggal_surat_masuk>='$tanggal_awal_sm'");
                                            } elseif ($tanggal_akhir_sm != "" && $unit_kerja != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM disposisi INNER JOIN surat_masuk ON disposisi.id_surat_masuk=surat_masuk.id_surat_masuk INNER JOIN unit_kerja ON disposisi.id_unit_kerja=unit_kerja.id_unit_kerja WHERE disposisi.id_unit_kerja='$unit_kerja' AND surat_masuk.tanggal_surat_masuk<='$tanggal_akhir_sm'");
                                            } else {
                                                $query = mysqli_query($koneksi, "SELECT * FROM surat_masuk");
                                            }
                                            while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $data['no_surat_masuk']; ?></td>
                                                    <td><?php echo $data['sifat_surat']; ?></td>
                                                    <td><?php echo $data['perihal']; ?></td>
                                                    <td><?php echo $data['pengirim']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($_POST['unit_kerja'] == 'Semua Unit') {
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
                                                    <td><?php echo date('d-m-Y', strtotime($data['tanggal_surat_masuk'])); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                } elseif (isset($_POST['jns_surat']) && $_POST['jns_surat'] == 'keluar') {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="card-header">
                                    <div align="center">
                                        <h3>Laporan Surat Keluar</h3>
                                    </div>
                                    <?php
                                    if (isset($_POST['tampil'])) {
                                        $tanggal_awal_sk = $_POST['tanggal_awal_sk'];
                                        $tanggal_akhir_sk = $_POST['tanggal_akhir_sk'];
                                        $unit_kerja = $_POST['unit_kerja'];
                                    ?>
                                        <a href="cetak_surat_kel.php?twsk=<?php echo $tanggal_awal_sk ?>&task=<?php echo $tanggal_akhir_sk ?>&uk=<?php echo $unit_kerja ?>&tampil=kel" target="_blank" class="btn btn-primary btn-sm rounded"><i data-feather="printer"></i> Print</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <table class="table table-bordered table-striped table-hover cell-border" id="surat_keluar">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Surat</th>
                                            <th>Sifat Surat</th>
                                            <th>Perihal</th>
                                            <th>Pengirim</th>
                                            <th>Tujuan</th>
                                            <th>Tanggal Surat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (isset($_POST['tampil']) && $_POST['tampil'] == 'kel') {
                                            $tanggal_awal_sk = $_POST['tanggal_awal_sk'];
                                            $tanggal_akhir_sk = $_POST['tanggal_akhir_sk'];
                                            $unit_kerja = $_POST['unit_kerja'];

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
                                                    <td><?php echo $data['no_surat_keluar']; ?></td>
                                                    <td><?php echo $data['sifat']; ?></td>
                                                    <td><?php echo $data['perihal']; ?></td>
                                                    <td><?php echo $data['nama_unit_kerja']; ?></td>
                                                    <td><?php echo $data['tujuan']; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($data['tanggal_surat_keluar'])); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!-- Surat Keluar -->

            </div>
        </div>
    </div>
</div>