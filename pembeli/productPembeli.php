<?php
session_start();

// Periksa apakah pembeli telah login
if ($_SESSION['role'] != 'customer') {
    header("Location: ../login.php");
    exit;
}

// Hubungkan ke database
require '../functions.php';

// Tangkap nilai keyword dari URL jika ada (GET)
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$deskripsi = isset($_GET['deskripsi']) ? $_GET['deskripsi'] : '';

// Lakukan pencarian jika keyword atau kategori tidak kosong
if ($keyword) {
    $keyword = $conn->real_escape_string($keyword); // Menghindari SQL injection
    $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'";
} elseif ($deskripsi) {
    $deskripsi = $conn->real_escape_string($deskripsi); // Fix: harusnya ini bukan $kategori
    $sql = "SELECT * FROM produk WHERE deskripsi LIKE '%$deskripsi%'";
} else {
    $sql = "SELECT * FROM produk";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap&family=Poppins&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
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
            background-color: #A21D22;
        }

        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 100px;
        }

        .card-container h3 {
            color: #A21D22;
        }

        .card {
            width: 325px;
            background-color: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            margin: 20px;
        }

        .card img {
            width: 100%;
            height: 200px; 
            object-fit: cover; 
        }

        .card-content {
            text-align: center;
            padding: 20px;
        }

        .card-content h3 {
            font-size: 28px;
            margin-bottom: 8px;
            font-family: "poppins";
        }

        .card-content p {
            color: #666;
            font-size: 15px;
            line-height: 1.3;
        }

        .card-content .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #A21D22;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 16px;
            color: #fff;
            font-family: "poppins";
        }

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-family: "poppins";
            color: #A21D22;
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
            font: poppins;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
            margin: 0 15px;
        }

        nav ul li{
            list-style: none;
            display: inline;
            margin-right: 20px;
            font-weight: 550;
        }

        .nav-list {
            display: flex;
            justify-content: center;
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

        .center-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 20px;
        }

        .search-box {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    width: 100%;
}


        .search-box input {
            width: 70%;
            max-width: 500px;
            padding: 10px;
            outline: none;
            border: 0;
            border-radius: 5px 0 0 5px;
            font-size: 1rem;
            border: 1px solid #A21D22;
        }

        .search-box button {
    padding: 10px 20px;
    outline: none;
    border: 0;
    border-radius: 5px; /* Bisa dibulatkan semua kalau mau */
    font-size: 1rem;
    background: #A21D22;
    color: #F6D6A9;
    cursor: pointer;
    margin-left: 10px; /* Ini bikin jaraknya sekitar 1 cm */
}

        .search-box form {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 500px;
}


        .container{
            width: 90%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;     
        }

        .container .center-content h1{
            font-family: "Poppins";
            color: #fff;
        }

        .container.center-content {
            background: url(../img/bglogin1.webp) no-repeat center center;
            background-size: cover;
            color: #fff;
            padding: 20px 20px;
            border-radius: 8px;
            max-width: 1000px;
            margin: 40px auto; /* Agar posisi di tengah halaman */
        }
    </style>
</head>
<body style="background-color: #A21D22;">
    <!-- Navigation -->
        <?php include 'navbarPembeli.php'; ?>
    <!-- Navigation -->


    <div class="container center-content" data-aos="fade-up" data-aos-anchor-placement="top-center">
        <h1>Find Your Dimsum!</h1>
        <div class="search-box">
            <form action="productPembeli.php" method="get">
                <input style="background-color: #F6D6A9;" type="text" name="keyword" size="40" autofocus placeholder="Enter your search keywords..." autocomplete="off" class="form-control" value="<?= htmlspecialchars($keyword) ?>">
                <button type="submit" name="cari" class="btn btn-secondary">Search</button>
            </form>
        </div>
        <br>
    </div>

    <div class="card-container" data-aos="fade-up" data-aos-duration="3000">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <img src="../img/<?= htmlspecialchars($row["gambar"]) ?>" alt="<?= htmlspecialchars($row["nama_produk"]) ?>">
                    <div class="card-content">
                        <h3><?= htmlspecialchars($row["nama_produk"]) ?></h3>
                        <p><?= htmlspecialchars($row["deskripsi"]) ?></p>
                        <a href="checkoutPembeli.php?id=<?= $row["id_produk"] ?>" class="btn">Checkout</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No product found</p>
        <?php endif; ?>
    </div>
    <br><br><br><br><br><br><br>

    <!-- Link JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
    <!-- Link JS -->
</body>
</html>

<?php
$conn->close();
?>