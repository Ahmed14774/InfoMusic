<?php
  session_start();
  require 'dbh.php';

  if (isset($_GET['artistid']))
  {
    $id = mysqli_real_escape_string($conn, $_GET['artistid']);
    $query = mysqli_query($conn, "SELECT * FROM songs LEFT JOIN artist on artist.artistid=songs.artistid WHERE artist.artistid = $id");
    while ($row = mysqli_fetch_assoc($conn, $query))
    {
      $imageData = $row["image"];
    }
    header("content-type: image/jpeg");
    echo $imageData;
  }
  else {
    echo "Error!";
  }

 ?>
