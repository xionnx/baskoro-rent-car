-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2024 pada 15.50
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

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
-- Struktur dari tabel `mobil`
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
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `id_type`, `merk`, `no_plat`, `warna`, `tahun`, `harga`, `denda`, `ac`, `supir`, `audio_player`, `central_lock`, `status_mobil`, `gambar`) VALUES
(1, 1, 'Suzuki Ciaz White', 'N 1985 RTF', 'Putih', '2019', 700000, 750000, 1, 1, 1, NULL, 1, 'mobil-suzuki-ciaz1.jpg'),
(2, 1, 'Suzuki Ciaz Brown', 'N 6758 AW', 'Cokelat', '2017', 600000, 650000, 1, NULL, 1, 1, 1, '85fe9b10-2-5c05.jpg'),
(3, 2, 'Suzuki Ertiga', 'N 1985 NK', 'Merah Tua', '2018', 400000, 450000, 1, NULL, NULL, 1, 1, '20180627121228hdr-8d78.jpg'),
(4, 1, 'Honda Civic', 'N 9547 HUY', 'Putih', '2014', 700000, 750000, 1, 1, 1, NULL, 1, '2014hondacivicfaceli-d56f.jpg'),
(5, 3, 'BMW M3', 'N 1456 DAG', 'Silver', '2017', 900000, 950000, 1, 1, 1, 1, 1, 'maxresdefault.jpg'),
(6, 3, 'BMW 177', 'N 1234 CAH', 'Biru', '2019', 900000, 950000, 1, 1, 1, 1, 1, 'car-2.jpg'),
(7, 3, 'BMW 577', 'N 4321 DB', 'Kuning', '2018', 700000, 750000, 1, 1, NULL, 1, 1, 'car-6.jpg'),
(8, 3, 'BMW 115', 'N 2707 GG', 'Merah', '2017', 550000, 600000, 1, NULL, 1, NULL, 1, 'car-4.jpg'),
(9, 2, 'Datsun Cross', 'N 5678 CV', 'Emas', '2017', 400000, 450000, 1, 1, 1, 1, 1, '20231226235111-8a68.jpeg'),
(10, 4, 'Toyota Avanza', 'B 1234 BJR', 'Abu-Abu', '2021', 400000, 450000, 1, NULL, 1, 1, 1, '3373053171.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
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
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user`, `subjek`, `isi_pesan`, `tgl_posting`, `status`) VALUES
(5, 9, 'Test', 'Test', '2024-04-03 06:57:43', 1),
(6, 9, 'test', 'test123', '2024-04-12 09:46:03', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
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
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_mobil`, `tanggal_sewa`, `tanggal_kembali`, `tanggal_pengembalian`, `total_sewa`, `total_denda`, `pickup`, `status`, `status_pembayaran`, `bukti_pembayaran`) VALUES
(5, 1, 4, '2020-04-01', '2020-04-16', '2020-04-16', 10500000, 0, 1, 2, 2, 'IMG-20190914-WA0007.jpeg'),
(22, 19, 10, '2024-06-01', '2024-06-03', '2024-06-04', 800000, 50000, 0, 2, 2, 'Git.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `kode_type` varchar(10) NOT NULL,
  `nama_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `type`
--

INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`) VALUES
(1, 'SD', 'Sedan'),
(2, 'HB', 'Hatchback'),
(3, 'SPR', 'Sport'),
(4, 'MPV', 'Multi Purpose Vehicle');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `alamat`, `gender`, `no_telp`, `no_ktp`, `scan_ktp`, `scan_kk`, `level`, `gambar_user`) VALUES
(1, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Malang', 'Laki-laki', '085334424941', '213123123112', 'KTP-1544523262.png', 'KK.PNG', 1, 'default-avatar.png'),
(9, 'Madit', 'madit@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Jalan Damai', 'Laki-laki', '085161107937', '2837219837123', 'image_(1).png', '65febf5c3290a2cad9a100c9V51y6Uc005.jpeg', 2, ''),
(10, 'misbah', 'misbah@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mmmsmssm', 'Laki-laki', '8888888', '888888', 'upscale.png', 'upscale1.png', 2, ''),
(11, 'xionn', 'xionn@gmail.com', '40061d9560884767b3cfffc4925f7f21', 'Jalan Damaii', 'Laki-laki', '08515121', '1231231', 'National_Train_Day_Instagram_Post_.png', 'qris_xionn.jpg', 2, ''),
(12, 'xionn1', 'xionn1@gmail.com', '40061d9560884767b3cfffc4925f7f21', '12321', 'Laki-laki', '123123', '1231231', 'qris_xionn1.jpg', 'National_Train_Day_Instagram_Post_2.png', 2, ''),
(13, 'Saber Arthoria', 'saber@gmail.com', '202cb962ac59075b964b07152d234b70', 'Jepang Barat', 'Laki-laki', '1231', '12313', 'qris_xionn2.jpg', 'National_Train_Day_Instagram_Post_3.png', 2, ''),
(14, 'Testing Nama', 'test123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Jalan Testing', 'Laki-laki', '085161107937', '613271283178371273', 'upscale.png', 'QuizAPSI.png', 2, ''),
(16, '123', 'test1@gmail.com', '202cb962ac59075b964b07152d234b70', '333', 'Laki-laki', '12312313', '123132131231', 'QuizAPSI2.png', 'upscale2.png', 2, ''),
(17, 'Dinda', 'dinda@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Jalan Damai', 'Laki-laki', '085161107937', '1320913812938', 'qris_xionn.jpg', 'National_Train_Day_Instagram_Post_.png', 2, 'default-avatar.png'),
(18, 'Dam', 'damara@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Citayem Belakang Stasiun RT 99 RW 69', 'Laki-laki', '085161107937', '23331231231', 'qris_xionn1.jpg', '375865552_2035129866848266_5583366099864375190_n.jpg', 2, 'National_Train_Day_Instagram_Post_.png'),
(19, 'bintang', 'bintang@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Margonda', 'Laki-laki', '085161107937', '12382131312312', 'LRS_Bootcamp_Revisi2.png', 'ERD_Revisi.png', 2, 'tekken-7---button-fin-1566850630249.jpg'),
(20, 'siyonn', 'siyonn@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123121312312', 'Laki-laki', '085161107937', '123193819831', 'Bootstrap.png', 'qris_xionn.jpg', 2, 'F4B9DnxakAA71mY.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `fk_id_type` (`id_type`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `fk_pesan` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_customer` (`id_user`),
  ADD KEY `fk_mobil` (`id_mobil`);

--
-- Indeks untuk tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `fk_id_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);

--
-- Ketidakleluasaan untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
