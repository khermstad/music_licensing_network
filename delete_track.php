<?php
  session_start();

  $trackId = $_POST['trackId'];
  require('db.php');
  // delete this file_id from thje mysql database
  $fileIdToRemove = $_POST['trackId'];

  // unlink this file path via php
  $fileToUnlink = $_POST['filePath'];

  $mysqli = new mysqli("107.180.4.111","mln_admin", "mln_admin", "mln_db");
  $deleteQuery = "DELETE FROM `mln_db`.`tracks` WHERE `tracks`.`id` = '$trackId'";

  $result = $mysqli->query($deleteQuery);

  unlink($fileToUnlink);
  echo "File Deleted. </br>";
  echo "</br><a href='user_landing_page.php'>Back to User Portal</a>";

  header("Location: user_portal.php");

 ?>
