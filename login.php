<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: url('img/bg_login.avif') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(68, 68, 68, 0.6);
            backdrop-filter: blur(20px);
            padding: 40px 30px;
            border-radius: 25px;
            width: 330px;
            text-align: center;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .login-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            background-color: #fff;
            color: #333;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 999px;
            background-color: #fff;
            color: #000;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #e0e0e0;
        }

        .login-container p {
            margin-top: 20px;
            font-size: 13px;
        }

        .login-container a {
            color: #fff;
            text-decoration: underline;
        }

        .login-container a:hover {
            color: #ddd;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 2) {
                echo "<p style='color: red;'>Password salah!</p>";
            } elseif ($_GET['error'] == 3) {
                echo "<p style='color: red;'>Username tidak ditemukan!</p>";
            }
        }
        ?>
        <form action="proses_login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="registrasi.php">Daftar</a></p>
    </div>
</body>
</html>
