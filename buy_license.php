<?php
  session_start();

  if (!isset($_SESSION['buyer'])){
    header("Location: login.php");
  }

 ?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div id='navBar'>
  <ul>
    <li><a class="active" href="#home">MLN</a></li>
    <li><a href="index.php">Home</a><li>
    <li><a href="catalog_1.php">Catalog</a></li>
    <li><a href="register.php">Register</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="user_portal.php">My Portal</a><li>
  </ul>
  </div>
  <div class='trackDisplay'>
  <?php
    $trackTitle = $_POST['trackTitle'];
    echo "<h1>Invoice:</h1>";
    echo "</br>Track Title: ".$_POST['trackTitle'];
    echo "</br>License Price: ".$_POST['trackPrice'];
    echo "</br>Track Owner: ".$_POST['trackUser'];
    $price = $_POST['trackPrice'] * 100;
    $track = $_POST['trackId'];

    $_SESSION['trackId'] = $track;
    $_SESSION['trackPrice'] = $_POST['trackPrice'];
    $_SESSION['seller'] = $_POST['trackUser'];
    $_SESSION['buyer'] = $_SESSION['username'];
    $_SESSION['track_title'] = $trackTitle;
  ?>
  <form action="/mln/post_payment.php" method="POST">
      <input type="text" value="<?php $track; ?>" name="trackId" hidden>
    <script
      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
      data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
      data-amount="<?php echo $price; ?>"
      data-name="Stripe.com"
      data-description="Widget"
      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
      data-locale="auto"
      data-zip-code="true">
    </script>
  </form>
</div>
</body>
</html>
