<?php

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


if ($password !== $confirm_password) {
    echo "Password dan Konfirmasi Password tidak sama!";
    exit;
}


$sql_check = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "Username sudah digunakan. Silakan pilih yang lain.";
    exit;
}


$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Registrasi berhasil. Silakan login.";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
