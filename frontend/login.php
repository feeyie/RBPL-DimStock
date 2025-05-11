<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - DimStock</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="login-container">
    <form action="proses_login.php" method="POST">
      <h2>Login</h2>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <p>Belum Punya Akun? <a href="#">Daftar</a></p>
    </form>
  </div>
</body>
</html>
