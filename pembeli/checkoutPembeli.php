<?php
session_start();
require '../functions.php'; // Pastikan file ini benar-benar memuat koneksi ke $conn

// Cek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data produk
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout - Dimstock</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background: #A21D22;
        }

        .checkout-wrapper {
        display: flex;
        justify-content: center;
        padding: 40px 20px;
        }

        .checkout-box {
        background-color: #fce0b4;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 100%;
        }

        .checkout-box h2 {
        border-bottom: 3px solid #a81717;
        padding-bottom: 10px;
        color: #a81717;
        }

        .checkout-box img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
        }

        .quantity-box {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        }

        .quantity-box input {
        width: 60px;
        text-align: center;
        font-size: 16px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        }

        .quantity-box .icon {
        margin-left: 10px;
        font-size: 20px;
        }

        .purchase-btn {
        background-color: #a81717;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        }

        .purchase-btn:hover {
        background-color: #8c1313;
        }

    .checkout-wrapper {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 40px 20px;
      gap: 20px;
    }

    .checkout-box {
      background-color: #fce0b4;
      padding: 30px;
      border-radius: 10px;
      text-align: center;
      width: 300px;
    }

    .checkout-box h2 {
      color: #a81717;
      border-bottom: 2px solid #a81717;
      margin-bottom: 10px;
    }

    .checkout-box img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
    }

    .quantity-box input {
      width: 60px;
      text-align: center;
      font-size: 16px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .purchase-btn {
      background-color: #a81717;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      margin-top: 10px;
    }
  </style>
</head>
<body style="background-color: #A21D22;">
  <!-- Navigation -->
    <?php include 'navbarPembeli.php'; ?>
  <!-- Navigation -->

  <h1 style="text-align: center; color: #fce0b4; padding: 30px;"><strong>Checkout Produk</strong></h1>

  <form action="purchase.php" method="post">
    <div class="checkout-wrapper">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="checkout-box">
          <h2><?= htmlspecialchars($row['nama_produk']) ?></h2>
          <img src="../img/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= $row['nama_produk'] ?>">
          <p>Harga: Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
          <input type="hidden" name="produk_id[]" value="<?= $row['id_produk'] ?>">
          <input type="number" name="jumlah[<?= $row['id_produk'] ?>]" min="0" value="0">
        </div>
      <?php endwhile; ?>
    </div>
    <div style="text-align: center; padding: 30px; color: #F6D6A9;">
      <button type="submit" class="purchase-btn">🛒 Checkout</button>
    </div>
  </form>
</body>
</html>
