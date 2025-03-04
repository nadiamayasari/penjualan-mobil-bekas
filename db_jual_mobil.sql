-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 11:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jual_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin', 'adminku');

-- --------------------------------------------------------

--
-- Table structure for table `detail_produk`
--

CREATE TABLE `detail_produk` (
  `no_plat` varchar(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga_telah_diskon` int(11) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `transmisi` varchar(20) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `foto_produk` text NOT NULL,
  `stok_produk` text NOT NULL,
  `foto_depan` text NOT NULL,
  `foto_belakang` text NOT NULL,
  `foto_dalam` text NOT NULL,
  `foto_spido` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_produk`
--

INSERT INTO `detail_produk` (`no_plat`, `id_produk`, `tahun`, `harga`, `diskon`, `harga_telah_diskon`, `lokasi`, `transmisi`, `warna`, `foto_produk`, `stok_produk`, `foto_depan`, `foto_belakang`, `foto_dalam`, `foto_spido`, `keterangan`) VALUES
('B 2345 ADD', 33, '2018', 150000000, 10, 135000000, 'Bandung', 'Otomatis', 'Kuning', 'jazz.png', '1', 'beras.jpg', '5013256.jpg', '9142.jpg', 'cabe.jpg', 'keterangan yang diisi'),
('BA 5667 DD', 34, '2018', 170000000, 5, 161500000, 'Bandung', 'Manual', 'merah', 'back.jpg', '1', '', '', '', '', ''),
('BA 5960 PP', 35, '2019', 200000000, 10, 180000000, 'Padang', 'Otomatis', 'Putih', 'ertiga.jpg', '0', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `no_plat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `alamat`, `email`, `no_hp`) VALUES
(1, 'Jalan Lubuak Bagaluang No 12', 'raffamotors@gmail.com', '0812736475637');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id_merek` int(11) NOT NULL,
  `merek` varchar(20) NOT NULL,
  `foto_merek` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id_merek`, `merek`, `foto_merek`) VALUES
(1, 'Toyota', '1739538614_toyota.jpeg'),
(2, 'Honda', '1739539619_logo-honda.jpg'),
(3, 'Suzuki', '1739539639_logosuzuki.jpg'),
(4, 'Nissan', '1739539662_nissan.jpg'),
(5, 'Mitsubisi', '1739539680_mitsubisi.png'),
(6, 'Daihatsu', '1739539700_daihatsu.png');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kota`, `tarif`) VALUES
(9, 'Padang', 500000),
(10, 'Pesisir Selatan', 300000),
(11, 'Luar Kota', 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `password_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `telepon_pelanggan` varchar(15) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(10, 'wirawan@gmail.com', '123', 'Wirawan', '083167689012', 'pesisir selatan'),
(11, 'Dedisuyanto@gmail.com', '123', 'Dedi Suyanto', '083167688580', 'Jambi'),
(12, 'doniyuliandi@gmail.com', '123', 'Doni Yulianto', '082268709087', 'painan'),
(13, 'nadiamayasari2711@gmail.com', 'nadia123', 'Nadia Mayasari', '083181594047', 'Padang');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_penjualan` int(7) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `jumlah_transfer` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `resi_pengiriman` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_penjualan`, `nama`, `bank`, `jumlah_transfer`, `tanggal_pembayaran`, `bukti`, `keterangan`, `resi_pengiriman`) VALUES
(21, 6, 'Rangga', 'BRI', 180500000, '2025-02-22', '20250222162146tiga sapi.jpg', 'Nilai anda sudah bagus, silahkan pertahankan lagi agar tidak menurun di semester berikut nya', '346456567567');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `id_ongkir` int(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_beli` int(11) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `status_penjualan` varchar(20) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `alamat_pembeli` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_produk`, `id_pelanggan`, `id_ongkir`, `harga`, `total_beli`, `metode_bayar`, `status_penjualan`, `tanggal_penjualan`, `alamat_pembeli`) VALUES
(6, 35, 12, 9, 200000000, 180500000, 'Transfer', 'Dikirim', '2025-02-22', 'padang');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_merek` int(11) NOT NULL,
  `nama_mobil` varchar(30) NOT NULL,
  `kilometer` int(11) NOT NULL,
  `bahan_bakar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_merek`, `nama_mobil`, `kilometer`, `bahan_bakar`) VALUES
(33, 2, 'Jazz', 30000, 'Bensin'),
(34, 2, 'Brio', 4000, 'Bensin'),
(35, 3, 'Ertiga', 70000, 'Bensin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
