    <?php
session_start();
if ($_SESSION['role'] != 'pemilik') {
    header("Location: ../login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik</title>

    <!-- Style CSS Link -->
    <link rel="stylesheet" href="style.css" type="text/css">
    <!-- Style CSS Link --></body>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap CDN -->

    <link href="https://fonts.googleapis.com/css2?family=Beth+Ellen&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body{
            width: 100%;
            min-height: 100vh;
            background: #A21D22;
        }

        .logo{
            font-size: 24px;
            color: white;
        }

        header{
            height: 60px;
            width: 100%;
            background: #F6D6A9;
            color: #A21D22;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px; 
            font: poppins;
        }

        .container{
            width: 90%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;     
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
            margin: 0 15px;
        }

        nav ul li{
            list-style: none;
            display: inline;
            margin-right: 20px;
            font-weight: 550;
        }

        .nav-list {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-list li {
            margin: 0 15px;
        }

        .nav-list a {
            color: #A21D22;
            text-decoration: none;
            font-weight: 550;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            text-decoration: none;
            color: white;
        }

        .center-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 20px;
        }

        /*Team*/
        .team{
            width: 100%;
            height: 90vh;
            background-image: url(image/bg1.jpg);
            background-size: cover;
            background-position: center;
        }

        .team h1{
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            margin-bottom: 30px;
            color: #fff;
        }

        .team h1 span{
            color: #F6D6A9;
            margin-left: 15px;
            font-family: mv boli;
        }

        .team h1 span::after{
            content: '';
            width: 100%;
            height: 2px;
            background: #F6D6A9;
            display: block;
            position: relative;
            bottom: 15px;
        }

        .team .team_box{
            width: 95%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            top: 13%;
        }

        .team .team_box .profile{
            width: 320px;
            height: 320px;
            border-radius: 50%;
            margin: 0 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 0 8px rgba(0,0,0,0.5);
            transition: 0.4s;
            background-color: #fff;
        }

        .team .team_box .profile:hover{
            border-radius: 20px;
            height: 320px;
        }

        .team .team_box .profile img{
            width: 250px;
            height: 250px;
            object-fit: cover;
            object-position: center;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 8px rgba(0,0,0,0.5);
            z-index: 2;
            transition: 0.4s;
        }

        .team .team_box .profile:hover img{
            border-radius: 20px;
            margin-top: -230px;
        }

        .team .team_box .profile .info{
            position: absolute;
            text-align: center;
            top: 25%;
            transition: 0.4s;
        }

        .team .team_box .profile:hover .info{
            top: 60%;
        }

        .team .team_box .profile .info .name{
            color: red;
            margin-bottom: 15px;
        }

        .team .team_box .profile .info .bio{
            width: 70%;
            text-align: center;
            margin: 0 auto 10px auto;
        }

        .team .team_box .profile .info .team_icon i{
            margin: 10px 5px 5px 0;
            cursor: pointer;
            transition: 0.3s;
        }

        .team .team_box .profile .info .team_icon i:hover{
            color: red;
        }

        section .main{
            display: flex;
            align-items: center;
            justify-content: space-around;
            position: relative;
            top: 55px;
        }

        section .main .men_text h1{
            font-size: 48px;
            position: relative;
            top: -50px;
            color: #fff;
            font-family: poppins;
            left: 100px;
            bottom: 120px;
        }

        section .main .men_text h1 span{
            margin-left: 15px;
            color: #F6D6A9;
            font-family: 'beth ellen', cursive;
            line-height: 22px;
            font-size: 48px;
        }

        section .main .main_image img{
            width: 700px;
            position: relative;
            left: 70px;
        }

        section p{
            width: 650px;
            line-height: 1.8;
            color: #fff;
            text-align: justify;
            position: relative;
            left: 123px;
            bottom: 120px;
            line-height: 22px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <header>
    <div class="navbar">
            <a href="homePemilik.php" class="logo">
                <img src="../img/logo.png" alt="" width="150" height="100">
            </a>
            <nav>
                <ul class="nav-list">
                    <li><a href="homePemilik.php">Home</a></li>
                    <li><a href="reportPemilik.php">Report</a></li>
                    <li><a href="../index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Navigation -->

    <section id="Home" data-aos="fade-up" data-aos-anchor-placement="top-center">
        <div class="main">
            <div class="men_text">
                <h1>Welcome to<span>DimStock</span><br>dashboard!</h1>
            </div>
            <div class="main_image">
                <img src="../img/dashboardDimsum.png">
            </div>
        </div>
        <p>
            Welcome to DimStock, the management system for Koalisi 
            Dimsum! This platform is designed to streamline menu 
            management, order processing, and business performance 
            tracking. Whether you're handling tracking orders or 
            overseeing operations, DimStock ensures Koalisi Dimsum 
            delivers top-quality dimsum and exceptional service to all customers.
        </p>
    </section>

    <br>
    <span></span>

    <!--Team-->

    <div class="team" data-aos="fade-up" data-aos-anchor-placement="top-center">
        <h1>Our<span>Team</span></h1>

        <div class="team_box">
            <div class="profile">
                <img src="../img/owner1.jpeg">

                <div class="info">
                    <h2 class="name">Owner 1</h2>
                    <p class="bio">Adrian Mahendra</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="../img/owner3.webp">

                <div class="info">
                    <h2 class="name">Owner 2</h2>
                    <p class="bio">Bayu Pratama</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="../img/staff1.webp">

                <div class="info">
                    <h2 class="name">Staff 1</h2>
                    <p class="bio">Dimas Saputra</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="../img/staff2.webp">

                <div class="info">
                    <h2 class="name">Staff 2</h2>
                    <p class="bio">Rizky Maulana</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Link JS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>AOS.init();</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Link JS -->

</body>
</html>