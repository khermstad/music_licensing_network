<?php
  session_start();

  $trackId = $_POST['trackId'];

  require('db.php');
  // query for inserting new file info
  $query = "UPDATE `tracks` SET `isApproved`=2 where `id`='$trackId';";


  // process query
  $result = mysqli_query($con, $query);

  header("Location: user_portal.php");

 ?>
