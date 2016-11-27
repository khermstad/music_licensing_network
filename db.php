<?php
$con = mysqli_connect("107.180.4.111","mln_admin", "mln_admin", "mln_db");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
