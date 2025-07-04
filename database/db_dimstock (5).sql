-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 09:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, 5, 'Koalisi Besar', 40, 20, '2025-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `saus` varchar(50) DEFAULT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  `tanggal_order` datetime DEFAULT current_timestamp(),
  `metode_pembayaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 'Koalisi Besar', 'Paket 1: Rp 10.000', 10000.00, 20, '68482fa4e9045.jpg'),
(8, 'Koalisi Kecil', 'Paket 2: Rp 10.000', 10000.00, 40, '684d4a7592c7a.jpeg'),
(9, 'Koalisi Pas Terbatas', 'Paket 3: Rp 12.000', 12000.00, 20, '684d4ad5deaeb.jpeg'),
(10, 'Dimsum Original (L)', 'PCS: Rp 3.000', 3000.00, 40, '684d4b0c7221d.jpeg'),
(11, 'Dimsum Original (s)', 'PCS: Rp 2.000', 2000.00, -5, '684d4b4a03b3a.jpeg'),
(12, 'Dimsum Premium', 'PCS: Rp 4.000', 4000.00, 20, '684d4bae17891.jpg'),
(13, 'Dimsum Premium Udang', 'PCS: Rp 4.000', 4000.00, 0, '684d4bd9cdc3e.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `nama_pembeli` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `saus` varchar(50) DEFAULT NULL,
  `delivery_option` varchar(50) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `status` enum('Diproses','Dikirim','Dibatalkan') DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nama_pembeli`, `alamat`, `catatan`, `total_harga`, `tanggal`, `saus`, `delivery_option`, `metode_pembayaran`, `bukti_transfer`, `status`) VALUES
(1, 'fera', 'tb 2', 'saos saori', 22, '2025-06-13 16:19:46', NULL, NULL, NULL, NULL, 'Diproses'),
(2, 'eca', 'gang anggrek', 'saos cuka', 22, '2025-06-13 16:26:39', NULL, NULL, NULL, NULL, 'Diproses'),
(3, 'nana', 's', 's', 110, '2025-06-13 21:37:47', NULL, NULL, NULL, NULL, 'Diproses'),
(4, 'aa', 'a', 'a', 110, '2025-06-14 16:40:24', NULL, NULL, NULL, NULL, 'Diproses'),
(5, 'aas', 's', 's', 110, '2025-06-14 16:42:00', NULL, NULL, NULL, NULL, 'Diproses'),
(6, 'Fera', 'Tambakbayan 2 no 20', 'saus bbq', 50000, '2025-06-14 17:18:56', NULL, NULL, NULL, NULL, 'Diproses'),
(11, 'a', 'a', 'a', 90000, '2025-06-15 13:17:42', 'Saus Lada Hitam', 'Standard', 'Cash on Delivery', '', 'Dikirim'),
(12, 'nesa', 'seikera', '-', 80000, '2025-06-15 13:29:31', 'Saus Lada Hitam', 'Standard', 'Transfer Bank', '684e684b67382_1703651377.webp', 'Dibatalkan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga_satuan`, `total_harga`) VALUES
(1, 1, 5, 2, 11, 22),
(2, 2, 5, 2, 11, 22),
(3, 3, 5, 10, 11, 110),
(4, 4, 5, 10, 11, 110),
(5, 5, 5, 10, 11, 110),
(6, 6, 5, 1, 10000, 10000),
(7, 6, 12, 10, 4000, 40000),
(8, 11, 11, 45, 2000, 90000),
(9, 12, 13, 20, 4000, 80000);

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
(8, 'pemilik', '$2y$10$mJLDhuo9GfAYE/DlD/d1P.KPEVROq4dMf0ed1XYmYKzBH2JMT6xPS', 'pemilik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `log_stok`
--
ALTER TABLE `log_stok`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_stok`
--
ALTER TABLE `log_stok`
  MODIFY `id_log` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
