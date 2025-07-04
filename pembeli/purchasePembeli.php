<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Purchase - Dimstock</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #a81717;
    }

    header {
      background-color: #f6d6a9;
      color: #a21d22;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav-list a {
      margin: 0 15px;
      text-decoration: none;
      color: #a21d22;
      font-weight: bold;
    }

    .container {
      background-color: #fce0b4;
      width: 90%;
      max-width: 1000px;
      margin: 30px auto;
      padding: 30px;
      border-radius: 10px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .left, .right {
      flex: 1;
      min-width: 300px;
      margin: 10px;
    }

    .left img {
      width: 100px;
      border-radius: 8px;
      margin-right: 10px;
    }

    .product-details {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .qty-input {
      width: 60px;
      padding: 5px;
      margin-left: 10px;
      text-align: center;
    }

    h2 {
      margin-bottom: 10px;
      color: #a21d22;
    }

    label {
      display: block;
      margin-top: 10px;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      border: none;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .option-group {
      margin-bottom: 15px;
    }

    .option-group input {
      margin-right: 5px;
    }

    .summary {
      background-color: #fff3e0;
      padding: 20px;
      border-radius: 8px;
    }

    .place-order {
      background-color: #a21d22;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
      width: 100%;
    }

    .place-order:hover {
      background-color: #8c1313;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="../img/logo.png" alt="Logo" height="50">
    </div>
    <nav>
      <div class="nav-list">
        <a href="homePembeli.php">Home</a>
        <a href="productPembeli.php">Product</a>
        <li><a href="checkoutPembeli.php">Checkout</a></li>
        <li><a href="purchasePembeli.php">Purchase</a></li>
        <a href="historyPembeli.php">History</a>
      </div>
    </nav>
  </header>

  <form class="container" action="place_order.php" method="post">
    <div class="left">
      <div class="product-details">
        <img src="img/dimsum.jpg" alt="Dimsum Premium">
        <div>
          <h3>Dimsum Premium</h3>
          <p>Rp 4.000</p>
          <label for="qty">Jumlah</label>
          <input class="qty-input" type="number" id="qty" name="qty" value="10" min="1">
        </div>
      </div>

      <div class="option-group">
        <h4>Choose sauce:</h4>
        <label><input type="radio" name="sauce" value="sambal">Saus sambal</label>
        <label><input type="radio" name="sauce" value="kecap">Saus kecap</label>
        <label><input type="radio" name="sauce" value="mayonnaise">Mayonnaise</label>
        <label><input type="radio" name="sauce" value="tidak">Tidak ada saus</label>
      </div>

      <label for="alamat">Alamat Pengiriman</label>
      <input type="text" name="jalan" placeholder="Nama Jalan">
      <input type="text" name="kota" placeholder="Kota / Kecamatan">
      <input type="text" name="kodepos" placeholder="Kode Pos">

      <div class="option-group">
        <h4>Delivery Options</h4>
        <label><input type="radio" name="delivery" value="gojek">Gojek</label>
        <label><input type="radio" name="delivery" value="grab">Grab</label>
        <label><input type="radio" name="delivery" value="kurir">Kurir</label>
      </div>
    </div>

    <div class="right">
      <div class="summary">
        <h3>Ringkasan Pesanan</h3>
        <p>Total Harga: Rp 40.000</p>

        <div class="option-group">
          <h4>Metode Pembayaran</h4>
          <label><input type="radio" name="payment" value="transfer">Transfer Bank</label>
          <label><input type="radio" name="payment" value="ewallet">E-Wallet</label>
          <label><input type="radio" name="payment" value="cod">Cash on Delivery</label>
        </div>

        <button type="submit" class="place-order">Place Order</button>
      </div>
    </div>
  </form>
</body>
</html>
