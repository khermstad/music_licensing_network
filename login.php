<?php 
session_start();
require 'database.php';
if( isset($_SESSION['user_id']) ){
  header("Location: /mln/user_portal.php");
}

if(!empty($_POST['email'])  && !empty($_POST['password'])):
    $records = $conn->prepare("SELECT id,email,password,username FROM users WHERE email= :email");
$records->bindParam(':email', $_POST['email']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$message = '';
if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ) {
    $_SESSION['user_id'] = $results['id'];
	$_SESSION['username'] = $results['username'];
    header("Location: /mln/user_portal.php");
} else{
   $message = 'Sorry, those credentials do not match';
}
endif;
?>

<!DOCKTYPE html>
<html>
<head>
 <title>Login Below </title>
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
