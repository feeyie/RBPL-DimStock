<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pemilik') {
    header("Location: ../login.php");
    exit;
}

require_once '../db_connect.php';

$tanggalFilter = isset($_GET['tanggal']) ? mysqli_real_escape_string($connect, $_GET['tanggal']) : '';

$query = "
    SELECT ls.*, p.nama_produk, p.harga, p.deskripsi 
    FROM log_stok ls 
    JOIN produk p ON ls.id_produk = p.id_produk 
";

if (!empty($tanggalFilter)) {
    $query .= " WHERE DATE(ls.tanggal) = '$tanggalFilter' ";
}

$query .= " ORDER BY ls.tanggal DESC";

$result = $connect->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Pemilik • DimStock</title>

    <!-- Local stylesheet (optional) -->
    <link rel="stylesheet" href="style.css" type="text/css" />

    <!-- Google Fonts & CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

    <style>
        * {
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
        
        header {
            height: 60px;
            width: 100%;
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
            align-items: center;
            margin: 0 15px;
        }
        .nav-list {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav-list li {
            margin: 0 15px;
        }
        .nav-list a {
            color: #A21D22;
            text-decoration: none;
            font-weight: 550;
        }
        .nav-list a.active {
            text-decoration: underline;
        }
        .logo img {
            max-height: 95px;
        }
        /* === PAGE CONTENT === */
        .container-report {
            max-width: 1000px;
            margin: 30px auto;
            background: #F6D6A9;
            border-radius: 10px;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #A21D22;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        th {
            background: #A21D22;
            color: #fff;
            padding: 12px 15px;
            text-align: left;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ccc;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <header>
        <div class="navbar">
            <a href="homePemilik.php" class="logo">
                <img src="../img/logo.png" alt="DimStock Logo" />
            </a>
            <nav>
                <ul class="nav-list">
                    <li><a href="homePemilik.php">Home</a></li>
                    <li><a href="reportPemilik.php">Report</a></li>
                    <li>
                        <a href="../index.php" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- REPORT CONTENT -->
    <div class="container-report" data-aos="fade-up" data-aos-anchor-placement="top-center">
        <h1><strong>Laporan Stok dan Penjualan</strong></h1>
        <form method="GET" style="margin-bottom: 20px;">
        <label for="tanggal">Pilih Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ?>">
        <button type="submit">Cari</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Stok Awal</th>
                    <th>Stok Akhir</th>
                    <th>Satuan</th>
                    <th>Pendapatan</th>
                    <th>Tgl Pencatatan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = $result->fetch_assoc()) :
                    $selisih    = $row['stok_awal'] - $row['stok_akhir'];
                    $pendapatan = ($selisih > 0) ? $selisih * $row['harga'] : 0;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                    <td><?= $row['stok_awal'] ?></td>
                    <td><?= $row['stok_akhir'] ?></td>
                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                    <td>Rp <?= number_format($pendapatan, 0, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
