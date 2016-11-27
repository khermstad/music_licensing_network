<?php
session_start();
if( isset($_SESSION['username']) ){
  header("Location: user_portal.php");
}
require 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
 <title>Login Below </title>
<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
<div class="header">
<a href="/mln">Home</a>
<span>or <a href="register.php">Register Here</a></span>
</div>
<?php if(!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>

 <h1>Login</h1>

<form action="login.php" method="POST">
<fieldset>
	<legend>Login Information:</legend>
	Email:<br>
<input type="text" placeholder="Enter your email" name="email">
<br>
    Password:<br>
<input type="password" placeholder="and password" name="password">
<br><br>
<input type="submit">
</fieldset>
</form>

 </body>
 </html>
