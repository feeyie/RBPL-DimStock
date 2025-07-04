<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Koneksi database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_dimstock';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data produk
$result = mysqli_query($conn, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <title>Kelola Produk</title>
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
        }
        table {
            background-color: white;
            color: #000;
        }
        th {
            background-color: #F6D6A9;
            color: #A21D22;
        }
        td a {
            margin: 0 5px;
            text-decoration: none;
            font-weight: bold;
        }
        td a:first-child {
            color: #0d6efd;
        }
        td a:last-child {
            color: red;
        }
        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            /* Tambahan untuk visual jika gambar gagal dimuat */
            background-color: #eee;
            display: block; /* Memastikan dimensi diterapkan */
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
    <div style="background-color: #F6D6A9; padding: 30px; border-radius: 15px; text-align: center;">
        <h3 style="color: #A21D22; font-weight: bold;">Edit Product</h3>
        <a href="add_productAdmin.php" class="btn btn-danger mt-3 mb-4">Add Product</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="text-center">
                            <?php
                            // Menggabungkan path relatif dengan nama file gambar dari database
                            $imagePath = "../img/" . htmlspecialchars($row['gambar']);
                            
                            // Menambahkan pemeriksaan file_exists untuk debugging (opsional, bisa dihapus setelah fix)
                            // if (!empty($row['gambar']) && file_exists($imagePath)) {
                            //     echo "<p style='color:green;'>Path OK</p>";
                            // } else {
                            //     echo "<p style='color:red;'>Path Not Found: " . $imagePath . "</p>";
                            //     echo "<p style='color:red;'>DB Value: " . htmlspecialchars($row['gambar']) . "</p>";
                            // }
                            ?>

                            <?php if (!empty($row['gambar'])): ?>
                                <img src="<?= $imagePath; ?>" class="product-img" alt="Gambar Produk">
                            <?php else: ?>
                                <span class="text-muted">Tidak Ada Gambar</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                        <td><?= htmlspecialchars($row['harga']); ?></td>
                        <td><?= htmlspecialchars($row['stok']); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="text-center">
                        <a href="edit_productAdmin.php?id=<?= $row['id_produk']; ?>" class="text-primary me-2">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                         <a href="hapus_productAdmin.php?id=<?= $row['id_produk']; ?>" onclick="return confirm('Yakin ingin hapus?');" class="text-danger">
                             <i class="bi bi-trash-fill"></i>
                         </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>