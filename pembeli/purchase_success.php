<?php
require '../functions.php';

if (!isset($_GET['id'])) {
    echo "Transaksi tidak ditemukan.";
    exit;
}

$id_transaksi = (int) $_GET['id'];

// Ambil data transaksi
$query_transaksi = "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi";
$result_transaksi = mysqli_query($conn, $query_transaksi);
$transaksi = mysqli_fetch_assoc($result_transaksi);

if (!$transaksi) {
    echo "Transaksi tidak ditemukan.";
    exit;
}

// Ambil detail produk
$query_detail = "SELECT td.*, p.nama_produk, p.gambar 
                 FROM transaksi_detail td 
                 JOIN produk p ON td.id_produk = p.id_produk 
                 WHERE td.id_transaksi = $id_transaksi";
$result_detail = mysqli_query($conn, $query_detail);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembelian</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body{
            width: 100%;
            min-height: 100vh;
            background: #A21D22;
        }

        .container {
            background: #F6D6A9;
            padding: 25px;
            border-radius: 15px;
            max-width: 800px;
            margin: 30px auto;
        }

        h2 {
            text-align: center;
            color: #A21D22;
        }

        .produk {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .produk img {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .produk-info {
            flex: 1;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .print-btn {
            display: block;
            margin: 20px auto 0;
            background: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .print-btn:hover {
            background: #218838;
        }

        .container h2, h4, p{
            color: #A21D22;
        }
    </style>
</head>
<body style="background-color: #A21D22;">
    <!-- Navigation -->
    <?php include 'navbarPembeli.php'; ?>
    <!-- End Navigation -->

    <div class="container" id="invoiceArea">
        <h2><strong>Invoice Pembelian</strong></h2>
        <p><strong>Nama:</strong> <?= htmlspecialchars($transaksi['nama_pembeli']) ?></p>
        <p><strong>Alamat:</strong> <?= htmlspecialchars($transaksi['alamat']) ?></p>
        <p><strong>Catatan:</strong> <?= htmlspecialchars($transaksi['catatan']) ?></p>
        <p><strong>Saus:</strong> <?= htmlspecialchars($transaksi['saus']) ?></p>
        <p><strong>Metode Pengiriman:</strong> <?= htmlspecialchars($transaksi['delivery_option']) ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($transaksi['metode_pembayaran']) ?></p>
        <p><strong>Tanggal:</strong> <?= $transaksi['tanggal'] ?></p>
        
        <?php if (!empty($transaksi['bukti_transfer'])) : ?>
            <p><strong>Bukti Transfer:</strong></p>
            <img src="../bukti_transfer/<?= htmlspecialchars($transaksi['bukti_transfer']) ?>" alt="Bukti Transfer" width="300">
        <?php endif; ?>


        <hr><br>

        <?php while ($produk = mysqli_fetch_assoc($result_detail)) : ?>
            <div class="produk">
                <img src="../img/<?= htmlspecialchars($produk['gambar']) ?>" alt="">
                <div class="produk-info">
                    <h4><?= htmlspecialchars($produk['nama_produk']) ?></h4>
                    <p>Jumlah: <?= (int) $produk['jumlah'] ?></p>
                    <p>Harga Satuan: Rp <?= number_format($produk['harga_satuan'], 0, ',', '.') ?></p>
                    <p>Total: <strong>Rp <?= number_format($produk['total_harga'], 0, ',', '.') ?></strong></p>
                </div>
            </div>
        <?php endwhile; ?>

        <div class="total">
            Total Pembayaran: Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?>
        </div>
    </div>

    <button class="print-btn" onclick="window.print()">Cetak Invoice</button>
</body>
</html>
