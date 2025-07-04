<?php
$conn = mysqli_connect("localhost", "root", "", "db_dimstock");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi ke db_dimstock berhasil!";
?>
