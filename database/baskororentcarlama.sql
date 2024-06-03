-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 11:49 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baskororentcar`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `harga` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `ac` int(11) DEFAULT NULL,
  `supir` int(11) DEFAULT NULL,
  `audio_player` int(11) DEFAULT NULL,
  `central_lock` int(11) DEFAULT NULL,
  `status_mobil` int(11) NOT NULL COMMENT '0. kosong, 1. tersedia',
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `id_type`, `merk`, `no_plat`, `warna`, `tahun`, `harga`, `denda`, `ac`, `supir`, `audio_player`, `central_lock`, `status_mobil`, `gambar`) VALUES
(1, 1, 'Suzuki Ciaz White', 'N 1985 RTF', 'Putih', '2019', 700000, 35000, 1, 1, 1, NULL, 1, 'mobil-suzuki-ciaz1.jpg'),
(2, 1, 'Suzuki Ciaz Brown', 'N 6758 AW', 'Cokelat', '2017', 600000, 30000, 1, NULL, 1, 1, 1, '85fe9b10-2-5c05.jpg'),
(3, 2, 'Suzuki Ertiga', 'N 1985 NK', 'Merah Tua', '2018', 400000, 20000, 1, NULL, NULL, 1, 1, '20180627121228hdr-8d78.jpg'),
(4, 1, 'Honda Civic', 'N 9547 HUY', 'Putih', '2014', 700000, 35000, 1, 1, 1, NULL, 0, '2014hondacivicfaceli-d56f.jpg'),
(5, 3, 'BMW M3', 'N 1456 DAG', 'Silver', '2017', 900000, 45000, 1, 1, 1, 1, 1, 'maxresdefault.jpg'),
(6, 3, 'BMW 177', 'N 1234 CAH', 'Biru', '2019', 900000, 45000, 1, 1, 1, 1, 1, 'car-2.jpg'),
(7, 3, 'BMW 577', 'N 4321 DB', 'Kuning', '2018', 600000, 30000, 1, 1, NULL, 1, 1, 'car-6.jpg'),
(8, 3, 'BMW 115', 'N 2707 GG', 'Merah', '2017', 400000, 20000, 1, NULL, 1, NULL, 1, 'car-4.jpg'),
(9, 2, 'Datsun Cross', 'N 5678 CV', 'Emas', '2017', 800000, 40000, 1, 1, 1, 1, 1, '20231226235111-8a68.jpeg'),
(10, 4, 'Toyota Avanza', 'B 1234 BJR', 'Abu-Abu', '2021', 400000, 50000, 1, NULL, 1, 1, 1, '3373053171.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `subjek` varchar(30) DEFAULT NULL,
  `isi_pesan` longtext DEFAULT NULL,
  `tgl_posting` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL COMMENT '0. belum dibaca, 1. sudah dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user`, `subjek`, `isi_pesan`, `tgl_posting`, `status`) VALUES
(5, 9, 'Test', 'Test', '2024-04-03 06:57:43', 1),
(6, 9, 'test', 'test123', '2024-04-12 09:46:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `total_sewa` int(11) NOT NULL,
  `total_denda` int(11) NOT NULL,
  `pickup` int(11) NOT NULL COMMENT '0. ambil sendiri, 1. pickup sesuai alamat',
  `status` int(1) NOT NULL COMMENT '0. batal, 1. disewa, 2. selesai',
  `status_pembayaran` int(1) NOT NULL COMMENT '0. belum dibayar, 1. menunggu konfirmasi, 2. sudah dibayar, 3. ditolak, 4. batal',
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_mobil`, `tanggal_sewa`, `tanggal_kembali`, `tanggal_pengembalian`, `total_sewa`, `total_denda`, `pickup`, `status`, `status_pembayaran`, `bukti_pembayaran`) VALUES
(5, 1, 4, '2020-04-01', '2020-04-16', '2020-04-16', 10500000, 0, 1, 2, 2, 'IMG-20190914-WA0007.jpeg'),
(12, 9, 1, '2024-04-03', '2024-04-05', NULL, 1400000, 0, 0, 0, 3, 'shocked.jpg'),
(13, 9, 5, '2024-04-12', '2024-04-16', '2024-04-15', 3600000, 45000, 1, 2, 2, '432456522_122149177964079416_5233697593441923084_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `kode_type` varchar(10) NOT NULL,
  `nama_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`) VALUES
(1, 'SD', 'Sedan'),
(2, 'HB', 'Hatchback'),
(3, 'SPR', 'Sport'),
(4, 'MPV', 'Multi Purpose Vehicle');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `scan_ktp` varchar(255) NOT NULL,
  `scan_kk` varchar(255) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1. admin, 2. customer',
  `gambar_user` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `alamat`, `gender`, `no_telp`, `no_ktp`, `scan_ktp`, `scan_kk`, `level`, `gambar_user`) VALUES
(1, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Malang', 'Laki-laki', '085334424941', '213123123112', 'KTP-1544523262.png', 'KK.PNG', 1, 'default-avatar.png'),
(9, 'Madit', 'madit@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Jalan Damai', 'Laki-laki', '085161107937', '2837219837123', 'image_(1).png', '65febf5c3290a2cad9a100c9V51y6Uc005.jpeg', 2, 'default-avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `fk_id_type` (`id_type`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `fk_pesan` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_customer` (`id_user`),
  ADD KEY `fk_mobil` (`id_mobil`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `fk_id_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
