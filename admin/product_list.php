<?php
include "../config.php";

// Ambil data produk dari database
$query = "SELECT * FROM produk";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id_produk'] . "</td>
                <td>" . $row['nama_produk'] . "</td>
                <td>" . $row['harga'] . "</td>
                <td>" . $row['stok'] . "</td>
                <td>
                    <form action='update_productAdmin.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='id_produk' value='" . $row['id_produk'] . "'>
                        <button type='submit'>Update</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada produk ditemukan!";
}
?>
