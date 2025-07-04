<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: url('img/bg_login.avif') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      width: 300px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      color: white;
      text-align: center;
    }

    .form-container h2 {
      margin-bottom: 20px;
    }

    .form-container input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: none;
      background-color: rgba(255, 255, 255, 0.8);
      font-size: 14px;
    }

    .form-container button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 6px;
      background-color: #fff;
      color: #000;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
    }

    .form-container .login-link {
      margin-top: 15px;
      font-size: 12px;
    }

    .form-container .login-link a {
      color: #fff;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Registrasi</h2>

  <?php
  if (isset($_GET['error'])) {
      if ($_GET['error'] == "password_mismatch") {
          echo "<p style='color: red;'>Password dan konfirmasi tidak cocok!</p>";
      } elseif ($_GET['error'] == "failed") {
          echo "<p style='color: red;'>Registrasi gagal. Coba lagi!</p>";
      }
  }
  ?>

  <form action="proses_registrasi.php" method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required><br>
    <select name="role" required>
    <option value="Customer">Customer</option>
    </select><br><br>
    <button type="submit">Daftar</button>
  </form>
  <p><a href="login.php">Sudah punya akun?</a></p>
</body>
</html>

