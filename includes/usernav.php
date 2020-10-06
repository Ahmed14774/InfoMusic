<?php
  session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="../Styles/usernav.css">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/bbd15fe17b.js" crossorigin="anonymous"></script>
  <link rel="icon" href="Images/favicon.ico">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <title>InfoMusic</title>
</head>

<body>
  <div class="sidenav">
    <span class="headphone">
      <i class="fas fa-headphones-alt"></i>
    </span>
    <br>
    <?php
      echo "<p class='sessionstyle'>Welcome, <span class='spanclass'>" .$_SESSION['userUId']. "</span></p>";
     ?>
     <br>
     <p class="subtitle">Browse</p>
     <a href="#">All Songs</a>
     <br>
     <p class="subtitle">Genre</p>
     <a href="country.php">Country</a>
     <a href="hiphop.php">Hip Hop</a>
     <a href="jazz.php">Jazz</a>
     <a href="pop.php">Pop</a>
     <a href="rock.php">Rock</a>
     <br>
    <p class="subtitle">Library</p>
    <a href="#">Playlist</a>
    <br>
    <p class="subtitle">Controls</p>
    <a href="#">Add Personal Music</a>
    <a href="#">Remove Personal Music</a>
    <br>
    <br>
    <form class="logoutbtn"action="logout.php" method="post">
      <button type="submit"class="btn  btn-outline-light" name="logout-submit">Logout</button>
    </form>
  </div>

  <!-- Page content -->
  <div class="main">
    <div class="searchbar-box">
      <form action="search.php" method="get">
        <input class="searchbar" type="text" name="search">
        <button type="submit" name="submit-btn" class="btn btn-outline-primary submitbtn">Submit</button>
      </form>
    </div>
  </div>
