<?php
  session_start();
  require('db.php');


  $currentUser = $_SESSION['username'];

  $mysqli = new mysqli("107.180.4.111","mln_admin", "mln_admin", "mln_db");

  $query = "SELECT * from users where username='$currentUser';";

  // process query
  $result = $mysqli->query($query);

  while($row = $result->fetch_array())
  {
  $rows[] = $row;
  }
  foreach($rows as $row)
  {
    $accountType =  $row['isArtist'];
  }

 ?>

 <!DOCTYPE html>

 <html>
  <head></head>

  <body>
    <style>
      .trackDisplay{
        border: 2px solid black      }
    </style>


    <?php
    // if user is artist
    if ($accountType == 1){
      echo $_SESSION['username']."'s Artist Portal:";

      $mysqli = new mysqli("107.180.4.111","mln_admin", "mln_admin", "mln_db");

      $query = "SELECT * FROM `tracks` where username='$currentUser'";

      $result = $mysqli->query($query);

      while($row = $result->fetch_array())
      {
      $rows[] = $row;
      }
      foreach($rows as $row)
      {
        if ($row['isApproved'] == 1){
          echo "<div class='trackDisplay'>";
          echo "Title: ".$row['track_title'];
          echo "</br>Description: ".$row['description'];
          echo "</br>Genre: ".$row['genre'];
          echo "</br>Price: ".$row['price'];
          echo "</br><a href='".$row['filepath']."'>Download</a>";
          echo "</br><audio controls>
          <source src='".$row['filepath']."' type='audio/mpeg'>
          Your browser does not support the audio element.
          </audio>";
          echo "</br>Status: APPROVED";
          echo "</div></br>";
        }
        if ($row['isApproved'] == 0 && $row['track_title'] != NULL){
          echo "<div class='trackDisplay'>";
          echo "Title: ".$row['track_title'];
          echo "</br>Description: ".$row['description'];
          echo "</br>Genre: ".$row['genre'];
          echo "</br>Price: ".$row['price'];
          echo "</br><a href='".$row['filepath']."'>Download</a>";
          echo "</br><audio controls>
          <source src='".$row['filepath']."' type='audio/mpeg'>
          Your browser does not support the audio element.
          </audio>";
          echo "</br>Status: PENDING";
          echo "</div></br>";
        }
        if ($row['isApproved'] == 2 && $row['track_title'] != NULL){
          echo "<div class='trackDisplay'>";
          echo "Title: ".$row['track_title'];
          echo "</br>Description: ".$row['description'];
          echo "</br>Genre: ".$row['genre'];
          echo "</br>Price: ".$row['price'];
          echo "</br><a href='".$row['filepath']."'>Download</a>";
          echo "</br><audio controls>
          <source src='".$row['filepath']."' type='audio/mpeg'>
          Your browser does not support the audio element.
          </audio>";
          echo "</br>Status: REJECTED";
          echo "</div></br>";
        }

    }

      echo "</br>";
      echo "<a href='upload_track.html'>Submit New Track</a>";
    }


    if ($accountType == 0){
      echo $_SESSION['username']."'s Customer Portal:";

      echo "</br>Licenses Purchased:";




    }

    ?>
</br>
</br>
</br>
<a href='index.php'>Home</a>
<a href="catalog_1.php">Catalog</a>
<a href="logout.php">Log Out</a>
  </body>

 </html>
