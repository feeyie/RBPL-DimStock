<!-- Header Start -->
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Beth+Ellen&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    header {
        height: 60px;
        width: 100%;
        background: #F6D6A9;
        color: #A21D22;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        width: 100%;
        align-items: center;
        margin: 0 15px;
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
        list-style: none;
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
    }
</style>

<header>
    <div class="navbar">
        <a href="homePembeli.php" class="logo">
            <img src="../img/logo.png" alt="" width="150" height="100">
        </a>
        <nav>
            <ul class="nav-list">
                <li><a href="homePembeli.php">Home</a></li>
                <li><a href="productPembeli.php">Product</a></li>
                <li><a href="checkoutPembeli.php">Checkout</a></li>
                <li><a href="historyPembeli.php">History</a></li>
                <li><a href="../index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                        <path fill-rule="evenodd"
                              d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                </a></li>
            </ul>
        </nav>
    </div>
</header>
<!-- Header End -->
