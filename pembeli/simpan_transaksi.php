<?php
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = mysqli_real_escape_string($conn, $_POST['nama_pembeli']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
    $saus = mysqli_real_escape_string($conn, $_POST['saus']);
    $delivery = mysqli_real_escape_string($conn, $_POST['delivery_option']);
    $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);

    $produk_ids = $_POST['produk_id'];
    $jumlahs = $_POST['jumlah'];

    $total_semua = 0;
    $produk_terpilih = [];

    foreach ($produk_ids as $id) {
        $id = (int)$id;
        $jumlah = (int)$jumlahs[$id];

        $query = "SELECT * FROM produk WHERE id_produk = $id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $total = $row['harga'] * $jumlah;
            $produk_terpilih[] = [
                'id_produk' => $id,
                'jumlah' => $jumlah,
                'harga' => $row['harga'],
                'total' => $total
            ];
            $total_semua += $total;
        }
    }

    // Upload bukti transfer jika perlu
    $filename = null;
    if ($metode_pembayaran != 'Cash on Delivery' && !empty($_FILES['bukti_transfer']['name'])) {
        $target_dir = "../bukti_transfer/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $filename = uniqid() . "_" . basename($_FILES["bukti_transfer"]["name"]);
        $target_file = $target_dir . $filename;
        move_uploaded_file($_FILES["bukti_transfer"]["tmp_name"], $target_file);
    }

    // Simpan ke tabel transaksi
    $insert_transaksi = "INSERT INTO transaksi 
    (nama_pembeli, alamat, catatan, saus, delivery_option, metode_pembayaran, bukti_transfer, total_harga, tanggal)
    VALUES 
    ('$nama_pembeli', '$alamat', '$catatan', '$saus', '$delivery', '$metode_pembayaran', '$filename', $total_semua, NOW())";
    mysqli_query($conn, $insert_transaksi);

    $id_transaksi = mysqli_insert_id($conn);

    // Simpan detail transaksi + kurangi stok
    foreach ($produk_terpilih as $item) {
        $id_produk = $item['id_produk'];
        $jumlah = $item['jumlah'];
        $harga = $item['harga'];
        $total = $item['total'];

        // Simpan detail
        $insert_detail = "INSERT INTO transaksi_detail (id_transaksi, id_produk, jumlah, harga_satuan, total_harga)
                          VALUES ($id_transaksi, $id_produk, $jumlah, $harga, $total)";
        mysqli_query($conn, $insert_detail);

        // Kurangi stok
        mysqli_query($conn, "UPDATE produk SET stok = stok - $jumlah WHERE id_produk = $id_produk");
    }

    header("Location: purchase_success.php?id=$id_transaksi");
    exit;

} else {
    echo "Metode tidak diizinkan.";
}
?>
