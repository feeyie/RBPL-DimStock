<?php
require '../functions.php';

if (!isset($_POST['produk_id']) || !isset($_POST['jumlah'])) {
    echo "Data tidak tersedia.";
    exit;
}

$produk_ids = $_POST['produk_id'];
$jumlahs = $_POST['jumlah'];

$produk_terpilih = [];

$total_semua = 0;

foreach ($produk_ids as $id) {
    if (isset($jumlahs[$id]) && $jumlahs[$id] > 0) {
        $id = (int) $id;
        $query = "SELECT * FROM produk WHERE id_produk = $id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $row['jumlah'] = $jumlahs[$id];
            $row['total'] = $row['harga'] * $jumlahs[$id];
            $produk_terpilih[] = $row;
            $total_semua += $row['total'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Purchase</title>
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
            border-radius: 15px;
            padding: 20px;
            max-width: 800px;
            margin: 30px;
        }

        .container h1{
            color: #A21D22;
            text-align: center;
            padding: 30px;
            font-family: "poppins"'
        }

        .produk {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .produk .produk-info h4, p {
            color: #A21D22;
        }

        .produk img {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }

        .produk-info {
            flex: 1;
        }

        .form-pembeli {
            margin-top: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background: #A21D22;
            color: #F6D6A9;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #A21D22;
        }

        .form-pembeli h2{
            color: #A21D22;
            text-align: center;
        }
    </style>
</head>
<body style="background-color: #A21D22;">
    <!-- Navigation -->
        <?php include 'navbarPembeli.php'; ?>
    <!-- Navigation -->
     
    <div class="container">
        <h1><strong>Detail Pesanan Anda</strong></h1>

        <?php if (empty($produk_terpilih)) : ?>
            <p>Tidak ada produk yang dipilih.</p>
        <?php else : ?>
            <?php foreach ($produk_terpilih as $produk) : ?>
                <div class="produk">
                    <img src="../img/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
                    <div class="produk-info">
                        <h4><?= htmlspecialchars($produk['nama_produk']) ?></h4>
                        <p>Harga: Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                        <p>Jumlah: <?= $produk['jumlah'] ?></p>
                        <p>Total: <strong>Rp <?= number_format($produk['total'], 0, ',', '.') ?></strong></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="total">
                Total Seluruh Pesanan: Rp <?= number_format($total_semua, 0, ',', '.') ?>
            </div>

            <form action="simpan_transaksi.php" method="POST" enctype="multipart/form-data">
                <?php foreach ($produk_terpilih as $produk): ?>
                    <input type="hidden" name="produk_id[]" value="<?= $produk['id_produk']; ?>">
                    <input type="hidden" name="jumlah[<?= $produk['id_produk']; ?>]" value="<?= $produk['jumlah']; ?>">
                <?php endforeach; ?>

                <!-- Data Pembeli -->
                <label>Nama:</label>
                <input type="text" name="nama_pembeli" required><br>

                <label>Alamat:</label>
                <textarea name="alamat" required></textarea><br>

                <label>Catatan:</label>
                <textarea name="catatan"></textarea><br>

                <!-- Pilihan Saus -->
                <label>Choose Sauce:</label>
                <select name="saus" required>
                    <option value="">-- Pilih Saus --</option>
                    <option value="Saus Asam Manis">Saus Asam Manis</option>
                    <option value="Saus Barbeque">Saus Barbeque</option>
                    <option value="Saus Keju">Saus Keju</option>
                    <option value="Saus Lada Hitam">Saus Lada Hitam</option>
                </select><br>

                <!-- Delivery Options -->
                <label>Delivery Options:</label>
                <select name="delivery_option" required>
                    <option value="">-- Pilih Pengiriman --</option>
                    <option value="Express">Express</option>
                    <option value="Standard">Standard</option>
                    <option value="Saver">Saver</option>
                </select><br>

                <!-- Metode Pembayaran -->
                <label>Metode Pembayaran:</label>
                <select name="metode_pembayaran" id="metode_pembayaran" onchange="tampilkanInstruksi()" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select><br>

                <!-- Keterangan Transfer -->
                <div id="instruksi_transfer" style="display:none; border:1px solid #ccc; padding:10px; margin:10px 0;">
                    <p><strong>Instruksi Pembayaran:</strong></p>
                    <div id="info_bank" style="display:none;">
                        <p>Silakan transfer ke rekening berikut:</p>
                        <ul>
                            <li>BCA: 1234567890 a.n. PT. Dimstock</li>
                            <li>Mandiri: 9876543210 a.n. PT. Dimstock</li>
                        </ul>
                    </div>
                    <div id="info_ewallet" style="display:none;">
                        <p>Silakan transfer ke E-Wallet berikut:</p>
                        <ul>
                            <li>OVO: 081234567890</li>
                            <li>DANA: 081234567891</li>
                            <li>GoPay: 081234567892</li>
                        </ul>
                    </div>

                    <label>Upload Bukti Transfer (JPG/PNG):</label>
                    <input type="file" name="bukti_transfer" accept="image/*"><br>
                </div>

                <button type="submit">Checkout</button>
            </form>

            <script>
            function tampilkanInstruksi() {
                const metode = document.getElementById("metode_pembayaran").value;
                const instruksi = document.getElementById("instruksi_transfer");
                const bank = document.getElementById("info_bank");
                const ewallet = document.getElementById("info_ewallet");

                instruksi.style.display = (metode === "Transfer Bank" || metode === "E-Wallet") ? "block" : "none";
                bank.style.display = metode === "Transfer Bank" ? "block" : "none";
                ewallet.style.display = metode === "E-Wallet" ? "block" : "none";
            }
            </script>


        <?php endif; ?>
    </div>
</body>
</html>
