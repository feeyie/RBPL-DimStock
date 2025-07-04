<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

require '../functions.php'; // Pastikan path ke functions.php benar

// Validasi ID dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID produk tidak valid.");
}
$id = (int)$_GET['id'];
$data = query("SELECT * FROM produk WHERE id_produk = $id");

if (empty($data)) {
    die("Produk tidak ditemukan.");
}
$data = $data[0]; // Ambil baris pertama dari hasil query

if (isset($_POST["submit"])) {
    $_POST['id_produk'] = $id; // Menambahkan ID ke dalam data POST
    if (ubah($_POST) > 0) {
        echo "<script>alert('Data berhasil diupdate!');window.location.href='productAdmin.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data atau tidak ada perubahan!');</script>";
        // Anda bisa tambahkan echo mysqli_error($conn); di functions.php untuk debugging
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #A21D22; color: #fff; }
        header { height: 60px; background: #F6D6A9; color: #A21D22; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; }
        .navbar { display: flex; justify-content: space-between; width: 100%; }
        .nav-list { list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; }
        .nav-list a { text-decoration: none; color: #A21D22; font-weight: 550; }
        .logo img { width: 150px; height: 100px; }
        .container { margin-top: 40px; max-width: 600px; }
        .form-container { background-color: #F6D6A9; padding: 30px; border-radius: 15px; color: #A21D22; }
        .form-container h1 { text-align: center; font-weight: bold; margin-bottom: 25px; }
        .form-control { border-radius: 8px; padding: 10px 12px; font-weight: 500; }
        .btn-custom { background-color: #A21D22; color: #fff; font-weight: 600; border-radius: 8px; padding: 10px 0; transition: background-color 0.3s ease; }
        .btn-custom:hover { background-color: #6f1216; color: #fff; }
        .img-preview { max-width: 150px; max-height: 150px; border-radius: 8px; margin-bottom: 15px; object-fit: cover; border: 2px solid #A21D22; }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <a href="homeAdmin.php" class="logo"><img src="../img/logo.png" alt="Logo" /></a>
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
    <div class="form-container">
        <h1>Edit Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?= htmlspecialchars($data['gambar']); ?>">
            
            <label for="nama_produk" class="form-label"><strong>Nama Produk:</strong></label>
            <input type="text" name="nama_produk" class="form-control mb-3" value="<?= htmlspecialchars($data['nama_produk']); ?>" required>
            
            <label for="deskripsi" class="form-label"><strong>Deskripsi:</strong></label>
            <textarea name="deskripsi" class="form-control mb-3" rows="3" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
            
            <label for="harga" class="form-label"><strong>Harga:</strong></label>
            <input type="number" name="harga" class="form-control mb-3" value="<?= htmlspecialchars($data['harga']); ?>" step="0.01" required>
            
            <label for="stok" class="form-label"><strong>Stok:</strong></label>
            <input type="number" name="stok" class="form-control mb-3" value="<?= htmlspecialchars($data['stok']); ?>" required>

            <label>Gambar Saat Ini:</label><br>
            <?php
            // Pastikan path untuk pengecekan file_exists juga benar
            $currentImagePath = "../img/" . htmlspecialchars($data['gambar']);
            ?>
            <?php if (!empty($data['gambar']) && file_exists($currentImagePath)): ?>
                <img src="<?= $currentImagePath; ?>" class="img-preview">
            <?php else: ?>
                <p><em>Tidak ada gambar yang dipilih atau gambar tidak ditemukan.</em></p>
            <?php endif; ?>

            <label for="gambar" class="form-label"><strong>Ganti Gambar (opsional):</strong></label>
            <input type="file" name="gambar" class="form-control mb-4" accept=".jpg,.jpeg,.png,.gif">
            
            <button type="submit" name="submit" class="btn btn-custom w-100">Update Produk</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>