-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2025 at 03:17 PM
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

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_detail`, `id_pemesanan`, `id_produk`, `jumlah`, `harga_satuan`) VALUES
(1, 12, 5, 4, 2000.00),
(2, 11, 8, 3, 3000.00),
(3, 6, 9, 5, 4000.00),
(4, 5, 10, 10, 10000.00),
(5, 4, 11, 2, 12000.00),
(6, 3, 12, 3, 3000.00),
(7, 2, 13, 7, 10000.00);

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

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `jumlah`, `tanggal_ditambahkan`) VALUES
(1, 7, 5, 2, '2025-07-01 03:00:00'),
(2, 1, 8, 1, '2025-07-01 03:05:00'),
(3, 6, 9, 3, '2025-07-01 03:10:00'),
(4, 4, 10, 1, '2025-07-01 03:15:00'),
(5, 3, 11, 2, '2025-07-01 03:20:00'),
(6, 2, 12, 4, '2025-07-01 03:25:00'),
(7, 5, 13, 1, '2025-07-01 03:30:00'),
(8, 7, 10, 2, '2025-07-01 03:35:00');

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
(2, 10, 'Koalisi Besar', 40, 20, '2025-06-15'),
(3, 11, 'Koalisi Kecil', 50, 30, '2025-06-15'),
(4, 12, 'Koalisi Pas Terbatas', 35, 25, '2025-06-15'),
(5, 13, 'Dimsum Original (L)', 60, 50, '2025-06-15'),
(6, 5, 'Dimsum Original (s)', 45, 25, '2025-06-15'),
(7, 8, 'Dimsum Premium', 70, 60, '2025-06-15'),
(8, 9, 'Dimsum Premium Udang', 55, 35, '2025-06-15');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_produk`, `jumlah`, `nama_penerima`, `alamat`, `telepon`, `saus`, `kurir`, `tanggal_order`, `metode_pembayaran`) VALUES
(1, 101, 2, 'Nesa', 'Jl. Mawar No. 5', '081234567890', 'Asam Manis', 'JNE', '2025-06-15 13:29:00', 'Transfer Bank'),
(2, 102, 1, 'Aldo', 'Jl. Melati No. 12', '082345678901', 'BBQ', 'J&T', '2025-06-15 13:17:00', 'COD'),
(3, 103, 3, 'Fera', 'Jl. Kenanga No. 8', '083456789012', 'Lada Hitam', 'SiCepat', '2025-06-14 17:18:00', 'Transfer Bank'),
(4, 104, 1, 'Sasa', 'Jl. Anggrek No. 3', '084567890123', 'Keju', 'AnterAja', '2025-06-14 16:42:00', 'E-Wallet'),
(5, 105, 2, 'Ana', 'Jl. Dahlia No. 14', '085678901234', 'Asam Manis', 'JNE', '2025-06-14 16:40:00', 'COD'),
(6, 106, 4, 'Nana', 'Jl. Teratai No. 21', '086789012345', 'BBQ', 'J&T', '2025-06-13 21:37:00', 'E-Wallet'),
(7, 107, 1, 'Eca', 'Jl. Sakura No. 7', '087890123456', 'Lada Hitam', 'SiCepat', '2025-06-13 16:26:00', 'Transfer Bank'),
(8, 103, 2, 'Fera', 'Jl. Kenanga No. 8', '083456789012', 'Keju', 'JNE', '2025-06-13 16:19:00', 'COD');

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

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_user`, `tanggal_pesan`, `total_harga`, `status`) VALUES
(1, 7, '2025-06-13 16:19:00', 22000.00, 'dibatalkan'),
(2, 4, '2025-06-13 16:26:00', 25000.00, 'diproses'),
(3, 13, '2025-06-13 21:37:00', 110000.00, 'dikirim'),
(4, 12, '2025-06-14 16:40:00', 50000.00, 'diproses'),
(5, 11, '2025-06-14 16:42:00', 45000.00, 'dikirim'),
(6, 7, '2025-06-14 17:18:00', 50000.00, 'diproses'),
(11, 10, '2025-06-15 13:17:00', 90000.00, 'diproses'),
(12, 9, '2025-06-15 13:29:00', 80000.00, 'dikirim');

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
(11, 'Dimsum Original (s)', 'PCS: Rp 2.000', 2000.00, 70, '684d4b4a03b3a.jpeg'),
(12, 'Dimsum Premium', 'PCS: Rp 4.000', 4000.00, 20, '684d4bae17891.jpg'),
(13, 'Dimsum Premium Udang', 'PCS: Rp 4.000', 4000.00, 50, '684d4bd9cdc3e.jpeg');

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
(1, 'Fera', 'TB 2, Yogyakarta', '-', 22000, '2025-06-13 16:19:46', 'Saos Saori', 'Standard', 'COD', 'bukti1.jpg', 'Dibatalkan'),
(2, 'Eca', 'Gang Anggrek, Sleman', '-', 25000, '2025-06-13 16:26:39', 'Saos Cuka', 'Standard', 'E-Wallet', 'bukti2.jpg', 'Diproses'),
(3, 'Nana', 'Jl. Merpati No. 3', '-', 110000, '2025-06-13 21:37:47', 'BBQ', 'Express', 'Transfer Bank', 'bukti3.jpg', 'Dikirim'),
(4, 'Ana', 'Jl. Melati No. 4', '-', 50000, '2025-06-14 16:40:24', 'Lada Hitam', 'Standard', 'E-Wallet', 'bukti4.jpg', 'Diproses'),
(5, 'Sasa', 'Tambakbayan 2 No. 20', 'Saus BBQ', 45000, '2025-06-14 16:42:00', 'BBQ', 'Standard', 'Transfer Bank', 'bukti5.jpg', 'Dikirim'),
(6, 'Fera', 'Jl. Bunga No. 9', '-', 50000, '2025-06-14 17:18:56', 'Lada Hitam', 'Standard', 'E-Wallet', 'bukti6.jpg', 'Diproses'),
(11, 'Aldo', 'Jl. Sakura No. 8', '-', 90000, '2025-06-15 13:17:42', 'Lada Hitam', 'Standard', 'COD', 'bukti7.jpg', 'Diproses'),
(12, 'Nesa', 'Jl. Seikera', '-', 80000, '2025-06-15 13:29:31', 'Lada Hitam', 'Standard', 'Transfer Bank', 'bukti8.webp', 'Dikirim');

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
(1, 1, 5, 2, 10000, 20000),
(2, 2, 5, 5, 10000, 50000),
(3, 3, 8, 10, 10000, 100000),
(4, 4, 9, 10, 12000, 120000),
(5, 5, 10, 10, 3000, 30000),
(6, 6, 11, 5, 3000, 15000),
(7, 6, 12, 10, 4000, 40000),
(8, 11, 13, 45, 4000, 180000),
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
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail`);

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
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

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
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log_stok`
--
ALTER TABLE `log_stok`
  MODIFY `id_log` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
