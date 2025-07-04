<?php
$conn = mysqli_connect("localhost", "root", "", "db_dimstock");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    echo "ID pesanan tidak ditemukan.";
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM pemesanan WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data pesanan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemesanan</title>
    <style>
        body {
            background-color: #a52020;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .detail-box {
            background-color: #791c1c;
            padding: 30px;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            text-align: left;
        }
        img.product-img {
            width: 200px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .btn-back {
            display: inline-block;
            background-color: #f5d18c;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
        h3 {
            color: #f5d18c;
            text-align: center;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="detail-box">
    <h3>Detail Pemesanan</h3>
    <center><img src="uploads/<?= $data['gambar']; ?>" alt="Gambar Produk" class="product-img"></center>
    <p><strong>ID Pesanan:</strong> <?= $data['id']; ?></p>
    <p><strong>Nama Penerima:</strong> <?= $data['nama_penerima']; ?></p>
    <p><strong>Nomor HP:</strong> <?= $data['nomor_hp']; ?></p>
    <p><strong>Tanggal:</strong> <?= $data['tanggal_pesan']; ?></p>
    <p><strong>Status:</strong> <?= $data['status']; ?></p>
    <p><strong>Total Harga:</strong> Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></p>
    <p><strong>Produk:</strong> <?= $data['produk']; ?> - <?= $data['jumlah']; ?> pcs</p>
    <p><strong>Saos:</strong> <?= $data['saos']; ?></p>
    <p><strong>Metode Pembayaran:</strong> <?= $data['pembayaran']; ?></p>
    <p><strong>Alamat Pengiriman:</strong> <?= $data['alamat_pengiriman']; ?></p>
    <p><strong>Nomor Resi:</strong> <?= $data['resi']; ?></p>

    <a href="admin_history.php" class="btn-back">Close</a>
</div>
</body>
</html>
