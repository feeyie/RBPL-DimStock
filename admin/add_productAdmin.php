<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

require '../functions.php';

// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambahkan!');window.location.href='productAdmin.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <title>Add Product - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #A21D22;
            color: #fff;
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
            align-items: center;
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
            max-width: 600px;
        }
        .form-container {
            background-color: #F6D6A9;
            padding: 30px;
            border-radius: 15px;
            color: #A21D22;
        }
        .form-container h1 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
            font-weight: 500;
        }
        .btn-custom {
            background-color: #A21D22;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 0;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #6f1216;
            color: #fff;
        }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <a href="homePembeli.php" class="logo">
            <img src="../img/logo.png" alt="Logo">
        </a>
        <nav>
            <ul class="nav-list">
                <li><a href="homeAdmin.php">Home</a></li>
                <li><a href="update_productAdmin.php">Update</a></li>
                <li><a href="productAdmin.php">Edit</a></li>
                <li><a href="konfirmasi_pesananAdmin.php">Order</a></li>
                <li><a href="historyAdmin.php">History</a></li>
                <li><a href="../index.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <div class="form-container">
        <h1>Add Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nama_produk" class="form-label"><strong>Nama Produk:</strong></label>
            <input type="text" name="nama_produk" class="form-control mb-3" placeholder="Nama Produk" required>
            <label for="deskripsi" class="form-label"><strong>Deskripsi:</strong></label>
            <input type="text" name="deskripsi" class="form-control mb-3" placeholder="Deskripsi" required>
            <label for="harga" class="form-label"><strong>Harga:</strong></label>
            <input type="number" name="harga" class="form-control mb-3" placeholder="Harga" required>
            <label for="stok" class="form-label"><strong>Stok:</strong></label>
            <input type="number" name="stok" class="form-control mb-3" placeholder="Stok" required>
            <input type="file" name="gambar" class="form-control mb-4" required>
            <button type="submit" name="submit" class="btn btn-custom w-100">Tambah</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
