<?php
  session_start();
  require('db.php');
 ?>

<!DOCTYPE html>
 <html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
 <body>

<ul>
  <li><a class="active" href="#home">MLN</a></li>
  <li><a href="index.php">Home</a><li>
  <li><a href="catalog_1.php">Catalog</a></li>
  <li><a href="register.php">Register</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="logout.php">Logout</a></li>
  <li><a href="user_portal.php">My Portal</a><li>
</ul>
   <h1> Current Tracks in Catalog:</h1>

   <?php
    $mysqli = new mysqli("107.180.4.111","mln_admin", "mln_admin", "mln_db");

    $query = "SELECT * FROM `tracks`";

    $result = $mysqli->query($query);

    while($row = $result->fetch_array())
    {
    $rows[] = $row;
    }
    foreach($rows as $row)
    {
      if ($row['isApproved'] == 1){
        echo "<div class='trackDisplay'>";
        echo "</br>Title: ".$row['track_title'];
        echo "</br>Description: ".$row['description'];
        echo "</br>Genre: ".$row['genre'];
        echo "</br>Uploaded by: ".$row['username'];
        echo "</br>Price: ".$row['price'];
        echo "</br><a href='".$row['filepath']."'>Download</a>";
        echo "</br><audio controls>
        <source src='".$row['filepath']."' type='audio/mpeg'>
        Your browser does not support the audio element.
        </audio>";
        echo '<form action="buy_license.php" method="POST">';
        echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
        echo '<input type="text" value="'.$row['track_title'].'" name="trackTitle" hidden>';
        echo '<input type="text" value="'.$row['price'].'" name="trackPrice" hidden>';
        echo '<input type="text" value="'.$row['username'].'" name="trackUser" hidden>';
        echo "<button type='submit'>Buy License</button>";
        echo "</form>";
        echo "</div></br>";
      }
  }
    ?>
	<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="TKU9WTEQSQKXC">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form> -->


 </body>

 </html>
