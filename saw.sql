-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2017 at 12:55 PM
-- Server version: 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(5) NOT NULL,
  `id_perusahaan` int(5) NOT NULL,
  `jenis_lelang` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `tkdn` varchar(25) NOT NULL,
  `estimasi` varchar(25) NOT NULL,
  `spesifikasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_perusahaan`, `jenis_lelang`, `harga`, `tkdn`, `estimasi`, `spesifikasi`) VALUES
(1, 101, 'Seal Pipa', '1212000000', '15', '14', '90'),
(3, 102, 'Seal Pipa', '1304000000', '24.96', '14', '100'),
(4, 103, 'Seal Pipa', '1191200000', '70.13', '14', '80'),
(5, 104, 'Seal Pipa', '990000000', '25.59', '14', '85'),
(26, 106, 'Mesin', '500000000', '60', '15', '75'),
(27, 107, 'Mesin', '550000000', '75', '15', '70');

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `jenis_lelang` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `estimasi` varchar(50) NOT NULL,
  `tkdn` varchar(50) NOT NULL,
  `spesifikasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `downup`
--

CREATE TABLE `downup` (
  `no` int(5) NOT NULL,
  `nama_file` varchar(50) NOT NULL,
  `id_perusahaan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `downup`
--

INSERT INTO `downup` (`no`, `nama_file`, `id_perusahaan`) VALUES
(8, 'PT_Dua_Angsa_(Kelengkapan).zip', 102),
(9, 'Kelengkapan_PT_Satu_Nusa.zip', 101),
(10, 'Kelengkapan_(PT_Tiga_Saudara).zip', 103),
(11, 'PT_Empat_Arah.zip', 104),
(16, 'PT_Imam_(kelengkapan_kualifikasi).zip', 106),
(17, 'PT._Delima.zip', 107);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `id_perusahaan` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `kriteria1` double NOT NULL,
  `kriteria2` double NOT NULL,
  `kriteria3` double NOT NULL,
  `kriteria4` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_perusahaan`, `id_user`, `kriteria1`, `kriteria2`, `kriteria3`, `kriteria4`) VALUES
(1, 101, 1, 1212, 14, 15, 90),
(2, 102, 1, 1304, 14, 24.96, 100),
(3, 103, 1, 1191.2, 14, 70.13, 80),
(4, 104, 1, 990, 14, 25.59, 85),
(9, 106, 1, 500, 15, 60, 75),
(10, 107, 1, 550, 15, 75, 70);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_perusahaan` int(11) NOT NULL,
  `nilai` varchar(11) NOT NULL,
  `jenis_lelang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_perusahaan`, `nilai`, `jenis_lelang`) VALUES
(101, '0.809', 'Seal Pipa'),
(102, '0.84', 'Seal Pipa'),
(103, '0.852', 'Seal Pipa'),
(104, '0.876', 'Seal Pipa'),
(106, '0.98', 'Mesin'),
(107, '0.936', 'Mesin');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_perusahaan` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `nilai` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `id_user` int(5) NOT NULL,
  `jenis_lelang` varchar(100) NOT NULL,
  `judul_pengumuman` text NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal` date NOT NULL,
  `spek_item` varchar(50) NOT NULL,
  `est_item` varchar(50) NOT NULL,
  `tkdn_item` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `id_user`, `jenis_lelang`, `judul_pengumuman`, `isi_pengumuman`, `tanggal`, `spek_item`, `est_item`, `tkdn_item`) VALUES
(3, 1, 'Seal Pipa', 'Seal Pipa', 'Membutuhkan Seal Pipa dengan rincian :\r\n- Estimasi Kedatangan Barang 14 Minggu\r\n- Tingkat Komponen Dalam Negeri diatas 15%\r\n- Kekuatan presure 80 - 100 ShoreA', '2017-10-19', '10', '14', '15'),
(5, 1, 'Mesin', 'Mesin', 'Mesin Minyak', '2017-10-03', '100', '20', '25');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `id_user`, `nama`, `alamat`, `status`, `keterangan`) VALUES
(101, 101, 'PT. Satu Nusa', 'Bangkinang', 'Valid', ''),
(102, 102, 'PT. Dua Angsa', 'Labuh Baru', 'Valid', ''),
(103, 103, 'PT. Tiga Saudara', 'Senapelan', 'Valid', ''),
(104, 104, 'PT. Empat Arah', 'Siak', 'Valid', ''),
(106, 106, 'PT. Imam', 'Rumbai', 'Data ada yang kurang', 'Surat Izin Usaha sudah kadaluwarsa'),
(107, 107, 'PT. Delima', 'Jalan Delima', 'Blacklist', '');

-- --------------------------------------------------------

--
-- Table structure for table `statusnilai`
--

CREATE TABLE `statusnilai` (
  `id_statusnilai` int(20) NOT NULL,
  `jenis_lelang` varchar(50) NOT NULL,
  `estimasi` varchar(50) NOT NULL,
  `tkdn` varchar(50) NOT NULL,
  `spesifikasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statusnilai`
--

INSERT INTO `statusnilai` (`id_statusnilai`, `jenis_lelang`, `estimasi`, `tkdn`, `spesifikasi`) VALUES
(1, 'Pipa', '14', '75', '80');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `stat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `stat`) VALUES
(1, 'admin01', 'admin01', 'Admin'),
(11, 'staff01', 'staff01', 'Staff Pengadaan'),
(101, 'pt001', 'pt001', 'Peserta Lelang'),
(102, 'pt002', 'pt002', 'Peserta Lelang'),
(103, 'pt003', 'pt003', 'Peserta Lelang'),
(104, 'pt004', 'pt004', 'Peserta Lelang'),
(106, 'imam', 'imam', 'Peserta Lelang'),
(107, 'delima', 'delima', 'Peserta Lelang'),
(109, 'damar', 'damar', 'Peserta Lelang'),
(110, 'melati', 'melati', 'Peserta Lelang'),
(111, 'mawar', 'mawar', 'Peserta Lelang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`jenis_lelang`);

--
-- Indexes for table `downup`
--
ALTER TABLE `downup`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `id_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `statusnilai`
--
ALTER TABLE `statusnilai`
  ADD PRIMARY KEY (`id_statusnilai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `downup`
--
ALTER TABLE `downup`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `statusnilai`
--
ALTER TABLE `statusnilai`
  MODIFY `id_statusnilai` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`);

--
-- Constraints for table `downup`
--
ALTER TABLE `downup`
  ADD CONSTRAINT `downup_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`);

--
-- Constraints for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD CONSTRAINT `pengadaan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `pengadaan_ibfk_2` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`),
  ADD CONSTRAINT `pengadaan_ibfk_3` FOREIGN KEY (`id_perusahaan`) REFERENCES `nilai` (`id_perusahaan`);

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD CONSTRAINT `perusahaan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
