<?php
session_start();

// $currentUser = $_SESSION['username'];
$currentUser = $_SESSION['username'];
// target directory with username
$target_directory = "files/".$_SESSION['username']."/";

// check if directory exists for user
$isDir = is_dir($target_directory);

// if directory doesn't exist, then create it
if (!$isDir){
  mkdir($target_directory, 0777);
}


$target_file = $target_directory . basename($_FILES["trackToUpload"]["name"]);
$target_file_type = pathinfo($target_file, PATHINFO_EXTENSION);

// start as valid
$valid_upload = true;
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

  <?php

// check file size. if greater than 5mb, set false;
if ($_FILES["trackToUpload"]["size"] > 10000000000){
  echo "File Is Too Large";
  $valid_upload = false;
}



if ($valid_upload == false){
  echo "Invalid File. Try Again.";
}
else{
  if (move_uploaded_file($_FILES["trackToUpload"]["tmp_name"], $target_file)){
    echo "Your track has been submitted for approval.";
    echo "</br><a href='user_portal.php'>Back to User Portal</a>";

    // INSERT FILE INFO TO DATABASE NOW
    $user = $_SESSION['username'];
    $trackTitle = $_POST['trackTitle'];
    $trackGenre = $_POST['trackGenre'];
    $trackDescription = $_POST['trackDescription'];
    $licensePrice = $_POST['licensePrice'];
    $path = $target_file;

    require('db.php');
    // query for inserting new file info
    $query = "INSERT INTO `mln_db`.`tracks` (`id`, `username`, `track_title`, `description`, `genre`, `price`, `filepath`, `isApproved`) VALUES (NULL, '$user', '$trackTitle', '$trackDescription', '$trackGenre', '$licensePrice', '$path', 0);";


    // process query
    $result = mysqli_query($con, $query);

  }
  else{
    echo "</br>Sorry, there was an error uploading your file. <a href='upload_track.html'>Try Again.</a>";
  }
}

?>
</body>
</html>
