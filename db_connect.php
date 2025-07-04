<?php
/**
 * db_connect.php
 * Satu-satunya file koneksi database.
 * Simpan di folder root proyek:  RBPL-DimStock/db_connect.php
 * Pastikan file ini TIDAK bisa di-download via web server (atur .htaccess kalau pakai Apache).
 */

/* ===== 1. Konfigurasi ===== */
$host = 'localhost';      // atau 127.0.0.1
$user = 'root';           // ganti sesuai user MySQL-mu
$pass = '';               // password MySQL
$db   = 'db_dimstock';  // nama database

/* ===== 2. Buat koneksi (mysqli OOP) ===== */
$connect = new mysqli($host, $user, $pass, $db);

/* ===== 3. Cek error koneksi ===== */
if ($connect->connect_errno) {
    // Jangan echo username/password; cukup info singkat
    die('Koneksi database gagal: ' . $connect->connect_error);
}

/* ===== 4. Set karakter (opsional tapi disarankan) ===== */
$connect->set_charset('utf8mb4');
?>
