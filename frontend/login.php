<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
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
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            text-align: center;
            width: 300px;
        }

        .login-container h2 {
            color: white;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background-color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .login-container p {
            margin-top: 15px;
            color: white;
        }

        .login-container a {
            color: #ffffff;
            text-decoration: underline;

        .login-container button:hover {
    background-color: #eee;
}

        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="proses_login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="registrasi.php">Daftar</a></p>
    </div>
</body>
</html>

