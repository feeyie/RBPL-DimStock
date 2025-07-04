<?php
require '../functions.php';

// Ambil data dari tabel transaksi
$query = "SELECT id_transaksi, tanggal, status, total_harga FROM transaksi ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>History Pembelian</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fce0b4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background-color: #fff0e1;
            border-radius: 10px;
            padding: 20px;
        }

        h1 {
            color:  #fce0b4;
            text-align: center;
            padding: 30px;
            font-family: "poppins";
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #A21D22;
            color: #F6D6A9;
            text-align: center !important;
            vertical-align: middle !important;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }


        tr:nth-child(even) {
            background-color: #ffd2b3;
        }

        .btn-detail {
            background-color: #A21D22;
            color: #ffd2b3;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .search-bar {
            text-align: right;
            margin-bottom: 10px;
        }

        .search-bar input[type="text"] {
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-bar button {
            padding: 6px 12px;
            background-color: #A21D22;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body style="background-color: #A21D22;">
    <!-- Navigation -->
        <?php include 'navbarPembeli.php'; ?>
    <!-- Navigation -->
     
    <div class="header">
        <h1>History Pembelian</h1>
    </div>
    <div class="container">
        <div class="search-bar">
            <form method="GET">
                <label>Cari ID Pesanan:</label>
                <input type="text" name="search_id" placeholder="Masukkan ID Pesanan">
                <button type="submit">Cari</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) : 
                        // Filter berdasarkan ID Pesanan jika ada pencarian
                        if (isset($_GET['search_id']) && $_GET['search_id'] !== '') {
                            if (stripos($row['id_transaksi'], $_GET['search_id']) === false) {
                                continue;
                            }
                        }
                ?>
                    <tr>
                        <td><?= htmlspecialchars(str_pad($row['id_transaksi'], 3, '0', STR_PAD_LEFT)); ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d', strtotime($row['tanggal']))); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="purchase_success.php?id=<?= $row['id_transaksi']; ?>">
                                <button class="btn-detail">Lihat Detail</button>
                            </a>
                        </td>
                    </tr>
                <?php 
                    endwhile;
                } else { 
                ?>
                    <tr><td colspan="5" class="text-center">Tidak ada data pembelian.</td></tr>
                <?php 
                } 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>