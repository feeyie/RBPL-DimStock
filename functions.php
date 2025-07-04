<?php
$conn = mysqli_connect("localhost", "root", "", "db_dimstock");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi cek status user berdasarkan username
function cek_status($username) {
    global $conn;
    $query = "SELECT role FROM user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['role'];
    } else {
        return null;
    }
}

// Fungsi query umum, mengembalikan array asosiatif
// TIDAK AMAN UNTUK INPUT USER LANGSUNG! HANYA UNTUK SELECT STATIS
function query($query) {
    global $conn;
    $result = $conn->query($query);

    $rows = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    } else {
        // Tambahkan debugging jika query gagal
        // echo "Error: " . $conn->error; // Aktifkan ini jika Anda mengalami masalah query
    }
    return $rows;
}

// Fungsi pencarian produk berdasarkan keyword, mengembalikan array
function cari($keyword) {
    global $conn;
    // Menggunakan prepared statement untuk keamanan SQL Injection
    $query = "SELECT * FROM produk 
              WHERE deskripsi LIKE ? 
              OR nama_produk LIKE ? 
              OR harga LIKE ? 
              OR stok LIKE ?";
    
    $stmt = $conn->prepare($query);
    $search_keyword = "%" . $keyword . "%";
    $stmt->bind_param("ssss", $search_keyword, $search_keyword, $search_keyword, $search_keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi tambah produk
function tambah($data) {
    global $conn;

    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false; // Gagal upload gambar
    }

    // Menggunakan prepared statement untuk keamanan
    $query = "INSERT INTO produk (nama_produk, deskripsi, harga, stok, gambar)
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdis", $nama_produk, $deskripsi, $harga, $stok, $gambar);
    $stmt->execute();

    return $stmt->affected_rows;
}

// Fungsi upload gambar
function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        // echo "<script>alert('Pilih gambar terlebih dahulu!');</script>"; // Ini bisa mengganggu alur update jika tidak ada gambar baru
        return false; // Mengembalikan false jika tidak ada file diupload
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        echo "<script>alert('Yang Anda upload bukan gambar!');</script>";
        return false;
    }

    // Cek ukuran gambar (maks 1MB)
    if ($ukuranFile > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar! Maks 1MB.');</script>";
        return false;
    }

    // Generate nama file baru unik
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    
    // Path tujuan penyimpanan gambar
    // __DIR__ adalah direktori current file (functions.php)
    // '../img/' berarti naik satu level folder lalu masuk ke folder 'img'
    $uploadPath = __DIR__ . '/img/' . $namaFileBaru;

    // Pindahkan file yang diupload
    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo "<script>alert('Gagal mengupload gambar!');</script>";
        return false;
    }

    return $namaFileBaru; // Kembalikan nama file baru untuk disimpan di database
}

// Fungsi ubah produk
function ubah($data) {
    global $conn;

    $id = (int)$data["id_produk"]; // Pastikan ID adalah integer
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    $gambar = $gambarLama; // Default: gunakan gambar lama

    // Cek apakah user upload gambar baru
    if ($_FILES['gambar']['error'] !== 4) { // Error 4 berarti tidak ada file yang diupload
        $gambarBaru = upload(); // Coba upload gambar baru
        if ($gambarBaru) { // Jika upload berhasil
            $gambar = $gambarBaru; // Gunakan nama gambar baru
            // Hapus gambar lama jika upload gambar baru berhasil dan ada gambar lama
            if (!empty($gambarLama) && file_exists(__DIR__ . '/../img/' . $gambarLama)) {
                unlink(__DIR__ . '/../img/' . $gambarLama);
            }
        } else {
            return false; // Gagal upload gambar baru, hentikan proses update
        }
    }

    // Menggunakan prepared statement untuk keamanan
    $query = "UPDATE produk SET 
                nama_produk = ?,
                deskripsi = ?,
                harga = ?,
                stok = ?,
                gambar = ?
              WHERE id_produk = ?";
    
    $stmt = $conn->prepare($query);
    // Perhatikan urutan dan tipe data parameter (ssdisi: string, string, double, integer, string, integer)
    $stmt->bind_param("ssdisi", $nama_produk, $deskripsi, $harga, $stok, $gambar, $id);
    $stmt->execute();

    return $stmt->affected_rows;
}

// Fungsi hapus produk
function hapus($id) {
    global $conn;

    // Ambil nama file gambar sebelum menghapus data produk
    // Menggunakan prepared statement untuk keamanan
    $query_gambar = "SELECT gambar FROM produk WHERE id_produk = ?";
    $stmt_gambar = $conn->prepare($query_gambar);
    $stmt_gambar->bind_param("i", $id);
    $stmt_gambar->execute();
    $result_gambar = $stmt_gambar->get_result();
    $row_gambar = $result_gambar->fetch_assoc();
    $gambarProduk = $row_gambar['gambar'] ?? null; // Null coalescing operator untuk PHP 7+

    // Hapus data produk dari database
    $query = "DELETE FROM produk WHERE id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $affected_rows = $stmt->affected_rows;

    // Hapus file gambar dari server jika ada dan data berhasil dihapus
    if ($affected_rows > 0 && !empty($gambarProduk) && file_exists(__DIR__ . '/../img/' . $gambarProduk)) {
        unlink(__DIR__ . '/../img/' . $gambarProduk);
    }

    return $affected_rows;
}
?>