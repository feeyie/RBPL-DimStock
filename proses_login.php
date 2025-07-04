<?php
session_start();
include "db_connect.php";
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connect->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["username"];
            $_SESSION['loggedin'] = true;

            $role = cek_status($username);
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header("Location: admin/homeAdmin.php");
            } elseif ($role == 'pemilik') {
                header("Location: pemilik/homePemilik.php");
            } elseif ($role == 'customer') {
                header("Location: pembeli/homePembeli.php");
            } else {
                header("Location: login.php?error=4");
            }
            exit;
        } else {
            header("Location: login.php?error=2");
            exit;
        }
    } else {
        header("Location: login.php?error=3");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
