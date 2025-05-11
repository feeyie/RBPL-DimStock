<?php
session_start();
include 'db_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
} else {
    echo "<script>alert('Login gagal!'); window.location='login.php';</script>";
}
?>

