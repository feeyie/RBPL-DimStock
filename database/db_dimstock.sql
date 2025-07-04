-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 07:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dimstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_stok`
--

CREATE TABLE `log_stok` (
  `id_log` int(100) NOT NULL,
  `id_produk` int(100) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `stok_awal` int(100) NOT NULL,
  `stok_akhir` int(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_stok`
--

INSERT INTO `log_stok` (`id_log`, `id_produk`, `nama_produk`, `stok_awal`, `stok_akhir`, `tanggal`) VALUES
(1, 2, 'Koalisi Besar', 20, 15, '2025-06-11'),
(3, 2, 'Koalisi Besar', 100, 50, '2025-06-11'),
(5, 2, 'Koalisi Besar', 100, 60, '2025-06-11'),
(6, 2, 'Koalisi Besar', 100, 60, '2025-06-11'),
(7, 2, 'Koalisi Besar', 100, 60, '2025-06-11'),
(8, 2, 'Koalisi Besar', 100, 60, '2025-06-11'),
(9, 2, 'Koalisi Besar', 100, 60, '2025-06-11'),
(11, 2, 'Koalisi Besar', 100, 60, '2025-06-11'),
(12, 2, 'Koalisi Besar', 100, 60, '2025-06-11'),
(13, 2, 'Koalisi Besar', 100, 60, '2025-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_pesan` datetime DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','diproses','dikirim','selesai','dibatalkan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar`) VALUES
(2, 'Koalisi Besar', 'Paket', 10000.00, 60, '6849909f530e1.jpg'),
(3, 'Koalisi Besar', 'Paket', 10000.00, 25, '683b297531ad5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pemilik','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'lala', '$2y$10$OI0AQTYBBzCqrRfagdlt8uuuU/vwOcQju74MYalL5TvDJnTZmwovK', 'customer'),
(2, 'arvin', '$2y$10$Z7Y61Y1H3FqPwYDwXHkKpOZ1VZBwxgtcATPuSOyjcd8QBhOG8Oma6', 'pemilik'),
(3, 'eca', '$2y$10$frtgM.9O5qlO.vvdCJ1Nke81ShgBYGVbfQNSgVHMi7dhtTGpx6Rqq', 'admin'),
(4, 'eca', '$2y$10$MX88AN0UXM7pT3zt5usEIeyUvkztjJEwthZxXTQifxrs2apd7qKeu', 'admin'),
(5, 'admin', '$2y$10$jDqCPg7hRwG7soR8zJXtL.hpIql3GjQ4JXV2cvSEJ2SZr8PtMdKMi', 'admin'),
(6, 'eca21', '$2y$10$mJKh3HnbLQDUSsLbSwE1v.suuTcltMFQ/k.ehe./oyY3O/A.qlpi6', 'customer'),
(7, 'fera', '$2y$10$Jp4xmaG/zUYJpOKQkmi3e.qXzlaFc6eXB1fM.DpWxROkSgJR41RGq', 'admin'),
(8, 'pemilik', '$2y$10$9EZvBicKHbbXqUrk/Hx1sObuN0Lq7Z.yGgeJ355RRVlaayET9Xl7u', 'pemilik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_stok`
--
ALTER TABLE `log_stok`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_stok`
--
ALTER TABLE `log_stok`
  MODIFY `id_log` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
