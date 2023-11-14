-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 03:50 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_surat_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  `id_unit_kerja` int(11) NOT NULL,
  `isi_disposisi` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `id_surat_masuk`, `id_unit_kerja`, `isi_disposisi`) VALUES
(5, 1, 6, 'DAW'),
(7, 5, 8, 'A'),
(8, 9, 6, 'WAWAWAWA'),
(9, 11, 8, 'Manyu aja');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `no_surat_keluar` varchar(128) NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `tujuan` varchar(128) NOT NULL,
  `id_unit_kerja` int(11) NOT NULL,
  `sifat` varchar(128) NOT NULL,
  `isi_surat_keluar` varchar(256) NOT NULL,
  `lampiran` varchar(128) NOT NULL,
  `tanggal_surat_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat_keluar`, `no_surat_keluar`, `perihal`, `tujuan`, `id_unit_kerja`, `sifat`, `isi_surat_keluar`, `lampiran`, `tanggal_surat_keluar`) VALUES
(1, '090/RI/WIR', 'Silaturahmi', 'Saya', 1, 'Biasa', 'Abc', '', '2023-09-07'),
(15, '080/RI/WIRI', 'Perihal', 'Anda', 6, 'Biasa', 'a', '', '2023-09-05'),
(16, '016/Gi/Mi', 'Contoh', 'Anda', 8, 'Segera', 'Contoh', '1457822686_Lampiran pdf 1.pdf', '2023-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `no_surat_masuk` varchar(128) NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `isi_surat` varchar(256) NOT NULL,
  `lampiran` varchar(128) NOT NULL,
  `sifat_surat` varchar(128) NOT NULL,
  `pengirim` varchar(128) NOT NULL,
  `tanggal_surat_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `no_surat_masuk`, `perihal`, `isi_surat`, `lampiran`, `sifat_surat`, `pengirim`, `tanggal_surat_masuk`) VALUES
(1, '090/RI/WIR', 'Silaturahmi', 'A', '1542872364_Lampiran pdf 1.pdf', 'Rahasia', 'Saya', '2023-09-07'),
(5, '080/RI/WIRI', 'Perihal', 'A', '', 'Biasa', 'A', '2023-09-11'),
(6, '070/RI/WIRA', 'Perihal', 'B', '', 'Biasa', 'Hamba', '2023-09-13'),
(8, '016/Gi/Mi', 'Ra', 'SA', '1405654172_Lampiran 1.docx', 'Segera', 'SA', '2023-09-16'),
(9, '016/Gi/Mi2', 'test', 'Contoh pdr', '2135978742_Lampiran pdf 1.pdf', 'Biasa', 'A', '2023-09-16'),
(11, '016/Gi/Mi4', 'Silaturahmi', 'manyu', '79590000_Backup of SOAL ATS SENI KELAS 1.wbk', 'Rahasia', 'Manyu', '2023-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` int(11) NOT NULL,
  `nama_unit_kerja` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `nama_unit_kerja`) VALUES
(1, 'Pimpinan'),
(6, 'Bendahara'),
(8, 'Sekretaris');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `hak_akses` varchar(128) NOT NULL,
  `id_unit_kerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `photo`, `nama_lengkap`, `username`, `password`, `hak_akses`, `id_unit_kerja`) VALUES
(2, '163385148_77045517_p0.jpg', 'Gian Pambela', 'Gianp', '81dc9bdb52d04dc20036dbd8313ed055', 'superadmin', 1),
(3, '1247294253_WhatsApp Image 2022-10-01 at 11.31.50.jpeg', 'Damar', 'damar', '202cb962ac59075b964b07152d234b70', 'admin', 8),
(5, '1667763887_77045517_p1.jpg', 'Agos', 'agos', '202cb962ac59075b964b07152d234b70', 'admin', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD UNIQUE KEY `id_surat_masuk` (`id_surat_masuk`),
  ADD KEY `id_surat_masuk_2` (`id_surat_masuk`,`id_unit_kerja`),
  ADD KEY `id_unit_kerja` (`id_unit_kerja`) USING BTREE;

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`),
  ADD KEY `id_unit_kerja` (`id_unit_kerja`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_unit_kerja` (`id_unit_kerja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id_unit_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_unit_kerja`) REFERENCES `unit_kerja` (`id_unit_kerja`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_ibfk_2` FOREIGN KEY (`id_surat_masuk`) REFERENCES `surat_masuk` (`id_surat_masuk`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_ibfk_1` FOREIGN KEY (`id_unit_kerja`) REFERENCES `unit_kerja` (`id_unit_kerja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_unit_kerja`) REFERENCES `unit_kerja` (`id_unit_kerja`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
