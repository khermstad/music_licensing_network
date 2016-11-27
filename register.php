<?php 
session_start();
$message = '';
$radio_value = $_POST['customerType'];

require 'database.php';
/*if( isset($_SESSION['user_id']) ){
  header("Location: /mln");
}*/
if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])): 
//enter new user in the database

$sql = "INSERT INTO users (username, email, password, isArtist) VALUES (:username, :email, :password, :isArtist)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
$stmt->bindParam(':username', ($_POST['username']));
$stmt->bindParam(':isArtist', ($radio_value));

if($stmt->execute() ):
   $message = 'Successfully created new user';
   
else:
  $message = 'Sorry there seems to be an error creating your account';
endif;
endif;
?>
<!DOCKTYPE html>
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
<?php if(!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>
 <h1>Register</h1>
  
<form action="register.php" method="POST">
	<fieldset>
	 <legend>Personal Information:</legend>
	 Username:<br>
<input type="text" placeholder="Enter username" name="username">
<br>
     Email:<br>
<input type="text" placeholder="Enter your email" name="email">
<br>
      Password:<br>
<input type="password" placeholder="and password" name="password">
<br>
      Confirm Password:<br>
<input type="password" placeholder="confirm password" name="confirm_password">
<br>
<input type="radio" name="customerType" value="1">Artist<br>
<input type="radio" name="customerType" value="0">Customer<br>
<br>
<input type="submit">
</fieldset>
</form>
 </body>
 </html>