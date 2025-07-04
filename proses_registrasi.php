<?php
session_start();
include "db_connect.php";

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

if ($password !== $confirm_password) {
    header("location:registrasi.php?error=password_mismatch");
    exit;
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$sql = $connect->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
$sql->bind_param("sss", $username, $hashed_password, $role);

if ($sql->execute()) {
    header("location:login.php");
    exit;
} else {
    header("location:registrasi.php?error=failed");
    exit;
}
?>
