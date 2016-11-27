<?php
  session_start();
  require('db.php');

  $track_id = $_SESSION['trackId'];
  $track_price = $_SESSION['trackPrice'];
  $track_buyer = $_SESSION['buyer'];
  $track_seller = $_SESSION['seller'];
  $track_title = $_SESSION['track_title'];


  $query = "INSERT INTO `mln_db`.`transactions` (`id`, `track_id`, `track_title`, `buyer`, `seller`, `total`) VALUES (NULL, '$track_id', '$track_title', '$track_buyer', '$track_seller', '$track_price');";
  // process query
  $result = mysqli_query($con, $query);



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
<h1>Receipt:</h1>
</br>
Track Title: <?php echo $track_title; ?>

</br>
Track Seller: <?php echo $track_seller; ?>

</br>
License Price: <?php echo $track_price; ?>
</br>
</br>
<img src="greencheck.png"></br>
You now own a license to use this track in commercial and non-profit works.  All purchased licenses are available in your user portal. Thanks.
</br>
</div>
</body>

</html>
