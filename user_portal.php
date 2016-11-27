<?php
  session_start();
  require('db.php');


  $currentUser = $_SESSION['username'];
  if ($currentUser == ""){
    header('Location: login.php');
  }

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
    // if user is artist
    if ($accountType == 1){
      echo "<h1>".$_SESSION['username']."'s Artist Portal:</h1>";
      echo "</br>";
      echo "<a href='upload_track.html'>Submit New Track</a></br>";
      echo "</br>";

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
          echo '<form action="delete_track.php" method="POST">';
          echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
          echo "<button type='submit'>DELETE TRACK</button>";
          echo "</form>";

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
          echo '<form action="delete_track.php" method="POST">';
          echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
          echo "<button type='submit'>DELETE TRACK</button>";
          echo "</form>";
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
          echo '<form action="delete_track.php" method="POST">';
          echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
          echo '<input type="text" value"'.$row['filepath'].'" name="filePath" hidden>';
          echo "<button type='submit'>DELETE TRACK</button>";
          echo "</form>";
          echo "</div></br>";
        }

    }

    echo "</br><h1>Licenses Sold:</h1>";

    $mysqli = new mysqli("107.180.4.111","mln_admin", "mln_admin", "mln_db");

    $current_user = $_SESSION['username'];

    $query = "SELECT * FROM `transactions` where seller='$current_user'";

    $result = $mysqli->query($query);

    while($row = $result->fetch_array())
    {
    $rows[] = $row;
    }
    foreach($rows as $row)
    {
      if ($row['seller'] == $current_user){
      echo "<div class='trackDisplay'>";
      echo "Title: ".$row['track_title'];
      echo "</br>Buyer: ".$row['buyer'];
      echo "</br>Transaction Total: ".$row['total'];
      echo "</div></br>";
      }
    }



    }


    if ($accountType == 0){
      echo "<h1>".$_SESSION['username']."'s Customer Portal:</h1> ";

      echo "</br>Licenses Purchased:";

      $mysqli = new mysqli("107.180.4.111","mln_admin", "mln_admin", "mln_db");

      $current_user = $_SESSION['username'];

      $query = "SELECT * FROM `transactions` where buyer='$current_user'";

      $result = $mysqli->query($query);

      while($row = $result->fetch_array())
      {
      $rows[] = $row;
      }
      foreach($rows as $row)
      {
        if ($row['buyer'] == $current_user){
        echo "<div class='trackDisplay'>";
        echo "Title: ".$row['track_title'];
        echo "</br>Seller: ".$row['seller'];
        echo "</br>License Price: ".$row['total'];
        echo "</br><img src='star.jpg'>";
        echo "</div></br>";
        }
      }



    }

    if ($accountType == 2){
      echo "</br><h1>ADMIN PORTAL</h1></br>";

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
                echo "Title: ".$row['track_title'];
                echo "</br>Description: ".$row['description'];
                echo "</br>Genre: ".$row['genre'];
                echo "</br>Price: ".$row['price'];
                echo "</br><a href='".$row['filepath']."'>Download</a>";
                echo "</br><audio controls>
                <source src='".$row['filepath']."' type='audio/mpeg'>
                Your browser does not support the audio element.
                </audio>";
                echo "</br>Submitted by:".$row['username'];
                echo "</br>Status: APPROVED";
                echo '<form action="pending.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>SET PENDING</button>";
                echo "</form>";
                echo '<form action="reject.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>REJECT</button>";
                echo "</form>";

                echo '<form action="delete_track.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>DELETE TRACK</button>";
                echo "</form>";


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
                  echo "</br>Submitted by:".$row['username'];
                echo "</br>Status: PENDING";
                echo '<form action="approve.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>APPROVE</button>";
                echo "</form>";
                echo '<form action="reject.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>REJECT</button>";
                echo "</form>";

                echo '<form action="delete_track.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>DELETE TRACK</button>";
                echo "</form>";


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
                  echo "</br>Submitted by:".$row['username'];
                echo "</br>Status: REJECTED";
                echo '<form action="pending.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>SET PENDING</button>";
                echo "</form>";
                echo '<form action="approve.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>APPROVE</button>";
                echo "</form>";
                echo '<form action="delete_track.php" method="POST">';
                echo '<input type="text" value="'.$row['id'].'" name="trackId" hidden>';
                echo "<button type='submit'>DELETE TRACK</button>";
                echo "</form>";

                echo "</div></br>";
              }
    }
  }

    ?>
  </body>

 </html>
