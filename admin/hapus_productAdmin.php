<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "db_dimstock");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi ID produk
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID produk tidak valid.");
}
$id = (int)$_GET['id'];

// Ambil data produk untuk cek dan hapus gambar
$stmt = $conn->prepare("SELECT gambar FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    die("Produk tidak ditemukan.");
}

// Hapus gambar jika ada
$upload_dir = "../img/produk/";
if (!empty($data['foto']) && file_exists($upload_dir . $data['foto'])) {
    unlink($upload_dir . $data['foto']);
}

// Hapus produk dari database
$stmt = $conn->prepare("DELETE FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: productAdmin.php?msg=Produk berhasil dihapus");
    exit;
} else {
    echo "Gagal menghapus produk: " . $stmt->error;
    $stmt->close();
}
?>
