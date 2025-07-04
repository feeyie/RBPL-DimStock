<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_dimstock';

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = intval($_POST['id_produk']);
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $stok_awal = intval($_POST['stok_awal']);
    $stok_akhir = intval($_POST['stok_akhir']);
    $tanggal = $_POST['tanggal'];

    $query_check = "SELECT * FROM produk WHERE id_produk = $id_produk";
    $result_check = $conn->query($query_check);

    if ($result_check->num_rows > 0) {
        $query_update = "UPDATE produk SET 
                            nama_produk = '$nama_produk', 
                            stok = $stok_akhir 
                         WHERE id_produk = $id_produk";

        $query_log = "INSERT INTO log_stok (id_produk, nama_produk, stok_awal, stok_akhir, tanggal)
                      VALUES ('$id_produk', '$nama_produk', $stok_awal, $stok_akhir, '$tanggal')";

        if ($conn->query($query_update) && $conn->query($query_log)) {
            $message = "✅ Stok produk berhasil diperbarui dan dicatat ke log!";
        } else {
            $message = "❌ Error saat update atau log: " . $conn->error;
        }
    } else {
        $message = "❌ ID produk tidak ditemukan!";
    }
}

$riwayat = [];
$query_riwayat = "SELECT * FROM log_stok ORDER BY tanggal DESC LIMIT 10";
$result_riwayat = $conn->query($query_riwayat);
if ($result_riwayat && $result_riwayat->num_rows > 0) {
    while ($row = $result_riwayat->fetch_assoc()) {
        $riwayat[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Stok Produk</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: #A21D22;
            color: #333;
        }

      
        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #F6D6A9;
            padding: 0px 30px;
            height: 60px;
        }

        .navbar .logo img {
            height: 90px;
        }

        .nav-list {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-list li a {
            text-decoration: none;
            color: #A21D22;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s;
        }

        .nav-list li a:hover {
            color: #891819;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #F6D6A9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1, h2 {
            text-align: center;
            color: #A21D22;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        label {
            font-weight: bold;
            color: #A21D22;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            grid-column: span 2;
            padding: 10px;
            background-color: #A21D22;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #891819;
        }

        .history {
            margin-top: 30px;
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
        }

        .history p {
            margin: 5px 0;
            padding: 6px;
            border-bottom: 1px solid #ddd;
        }

        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="../img/logo.png" alt="Logo DIMSTOCK">
            </div>
            <nav>
                <ul class="nav-list">
                    <li><a href="homeAdmin.php">Home</a></li>
                    <li><a href="update_productAdmin.php">Update</a></li>
                    <li><a href="productAdmin.php">Edit</a></li>
                    <li><a href="konfirmasi_pesananAdmin.php">Order</a></li>
                    <li><a href="historyAdmin.php">History</a></li>
                    <li><a href="../index.php" title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#A21D22" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                    </a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Update Stok Produk</h1>

        <?php if (!empty($message)) : ?>
            <p class="message <?= strpos($message, '❌') !== false ? 'error' : '' ?>">
                <?= $message ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="id_produk">ID Produk:</label>
            <input type="number" name="id_produk" id="id_produk" required>

            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" id="nama_produk" required>

            <label for="stok_awal">Stok Awal:</label>
            <input type="number" name="stok_awal" id="stok_awal" required>

            <label for="stok_akhir">Stok Akhir:</label>
            <input type="number" name="stok_akhir" id="stok_akhir" required>

            <label for="tanggal">Tanggal Pencatatan:</label>
            <input type="datetime-local" name="tanggal" id="tanggal" required>

            <button type="submit">Update</button>
        </form>

        <div class="history">
            <h2>Riwayat Perubahan</h2>
            <?php if (count($riwayat) > 0): ?>
                <?php foreach ($riwayat as $log): ?>
                    <p>📦 <?= $log['tanggal'] ?> | <?= $log['id_produk'] ?> - <?= $log['nama_produk'] ?> (Stok Awal: <?= $log['stok_awal'] ?> → Akhir: <?= $log['stok_akhir'] ?>)</p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada perubahan stok.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
