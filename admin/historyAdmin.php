<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

require '../functions.php';

// Query mengambil data dari tabel transaksi
$riwayat = query("SELECT * FROM transaksi ORDER BY tanggal DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #A21D22; color: #fff; }
        header { height: 60px; background: #F6D6A9; color: #A21D22; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; }
        .navbar { display: flex; justify-content: space-between; width: 100%; }
        .nav-list { list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; }
        .nav-list a { text-decoration: none; color: #A21D22; font-weight: 550; }
        .logo img { width: 150px; height: 100px; }

        .container { margin-top: 40px; }
        .table-container { background-color: #F6D6A9; padding: 30px; border-radius: 15px; color: #A21D22; }
        h1 { text-align: center; font-weight: bold; margin-bottom: 25px; color: #F6D6A9; }
        table thead { background-color: #A21D22; color: #fff; }
        table tbody tr:hover { background-color: #f1c98b; }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <a href="homePembeli.php" class="logo"><img src="../img/logo.png" alt="Logo" /></a>
        <nav>
            <ul class="nav-list">
                <li><a href="homeAdmin.php">Home</a></li>
                <li><a href="update_productAdmin.php">Update</a></li>
                <li><a href="productAdmin.php">Edit</a></li>
                <li><a href="konfirmasi_pesananAdmin.php">Order</a></li>
                <li><a href="historyAdmin.php">History</a></li>
                <li><a href="../index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg></a>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <div class="table-container">
        <h1>Riwayat Pemesanan</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Catatan</th>
                        <th>Saus</th>
                        <th>Metode Pengiriman</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Bukti Transfer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($riwayat) > 0): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($riwayat as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama_pembeli']); ?></td>
                                <td><?= htmlspecialchars($row['alamat']); ?></td>
                                <td><?= htmlspecialchars($row['catatan']); ?></td>
                                <td><?= htmlspecialchars($row['saus']); ?></td>
                                <td><?= htmlspecialchars($row['delivery_option']); ?></td>
                                <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal'])); ?></td>
                                <td>
                                    <?php 
                                    $bukti_transfer_path = '../bukti_transfer/' . htmlspecialchars($row['bukti_transfer']);
                                    if (!empty($row['bukti_transfer']) && file_exists($bukti_transfer_path)): ?>
                                        <img src="<?= $bukti_transfer_path; ?>" alt="Bukti Transfer" style="width: 100px; height: auto;">
                                    <?php else: ?>
                                        Tidak ada
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9" class="text-center">Tidak ada riwayat pemesanan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>