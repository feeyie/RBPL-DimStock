<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "db_dimstock");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses aksi konfirmasi atau pembatalan
if (isset($_GET['id']) && isset($_GET['aksi'])) {
    $id = intval($_GET['id']); // Menghindari SQL Injection
    $aksi = $_GET['aksi'];

    if ($aksi == 'diproses') {
        $query = "UPDATE transaksi SET status = 'Diproses' WHERE id_transaksi = $id";
    } elseif ($aksi == 'konfirmasi') {
        $query = "UPDATE transaksi SET status = 'Dikirim' WHERE id_transaksi = $id";
    } elseif ($aksi == 'batal') {
        $query = "UPDATE transaksi SET status = 'Dibatalkan' WHERE id_transaksi = $id";
    } else {
        header("Location: konfirmasi_pesananAdmin.php");
        exit;
    }

    if (mysqli_query($conn, $query)) {
        header("Location: konfirmasi_pesananAdmin.php?message=success");
    } else {
        header("Location: konfirmasi_pesananAdmin.php?message=error");
    }
    exit;
}

// Ambil data pesanan dari tabel transaksi
$data = mysqli_query($conn, "SELECT id_transaksi, nama_pembeli, tanggal, status, total_harga FROM transaksi ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pemesanan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #A21D22;
            color: #A21D22;
        }
        header {
            height: 60px;
            background: #F6D6A9;
            color: #A21D22;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .nav-list {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }
        .nav-list a {
            text-decoration: none;
            color: #A21D22;
            font-weight: 550;
        }
        .logo img {
            width: 150px;
            height: 100px;
        }

        .container {
            margin-top: 40px;
        }

        .table-container {
            background-color: #F6D6A9;
            padding: 30px;
            border-radius: 15px;
        }

        h1 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
            color: #F6D6A9;
        }

        table thead {
            background-color: #A21D22;
            color: #fff;
        }

        table tbody tr:hover {
            background-color: #f1c98b;
        }

        .btn-icon {
            font-size: 20px;
            margin: 0 5px;
            text-decoration: none;
        }

        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <a href="homeAdmin.php" class="logo"><img src="../img/logo.png" alt="Logo"></a>
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
        <h1>Konfirmasi Pemesanan</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($data) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($data)): ?>
                            <tr>
                                <td><?= $row['id_transaksi']; ?></td>
                                <td><?= htmlspecialchars($row['nama_pembeli']); ?></td>
                                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])); ?></td>
                                <td><?= htmlspecialchars($row['status']); ?></td>
                                <td>Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="?id=<?= $row['id_transaksi']; ?>&aksi=diproses" class="btn-icon text-warning" title="Diproses">🔄</a>
                                    <a href="?id=<?= $row['id_transaksi']; ?>&aksi=konfirmasi" class="btn-icon text-success" title="Konfirmasi">✅</a>
                                    <a href="?id=<?= $row['id_transaksi']; ?>&aksi=batal" class="btn-icon text-danger" title="Batalkan">❌</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">Tidak ada data pemesanan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>