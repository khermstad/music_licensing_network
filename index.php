<?php
session_start();
require 'database.php';
if( isset($_SESSION['user_id']) ){
$records = $conn->prepare('SELECT id,email,password FROM users WHERE id= :id');
 $records->bindParam(':id', $_SESSION['user_id']);
 $records->execute();
 $results = $records->fetch(PDO::FETCH_ASSOC);

$user = NULL;
  if(count($results) > 0){
    $user = $results;

}
}
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

<h1>MLN: Music Licensing Network</h1>

  <div class='trackDisplay'>
  <p id='about_mln'>The Music Licensing Network is a site for artists/musicians to sell licenses to their songs.  Artists will be able to provide licenses for songs they have uploaded, and the users who purchase these licenses will be able to use the songs in their own projects immediately. For instance, an advertiser who needs a song for their commercial will be able to purchase a license from the artist through the website. The advertiser will now be able to use the song according to the specified licensing rules.  </p>
</div>
  </body>
</html>
