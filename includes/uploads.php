<?php
  session_start();
  if (isset($_POST['upload']))
  {
    require 'dbh.php';

    $songname = $_POST['songname'];
    $genre = $_POST['genre'];
    switch ($genre) {
      case "Country":
        $genre = 1;
        break;
      case "Hip Hop":
        $genre = 2;
        break;
      case "Jazz":
        $genre = 3;
        break;
      case "Pop":
        $genre = 4;
        break;
      case "Rock":
        $genre = 5;
        break;
      default:
        $genre = 0;
    }
    $imageName = mysqli_real_escape_string($conn, $_FILES["image"]["name"]);
    $imageData = mysqli_real_escape_string($conn, file_get_contents($_FILES["image"]["tmp_name"]));

    //echo $imageData;

    $imageType = mysqli_real_escape_string($conn, $_FILES["image"]["type"]);
    if (substr($imageType,0,5) == "image")
    {
      // Insert New Artist
      $id =$_SESSION['userId'];
      $result = mysqli_query($conn, "SELECT idusers FROM artist WHERE idusers = $id");
      if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO artist (artistname,	idusers) values (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../addmusicadmin.php?error=sqlerror");
          exit();
        }
        else {

          mysqli_stmt_bind_param($stmt, "si",$_SESSION['userUId'], $_SESSION['userId'] );
          mysqli_stmt_execute($stmt);

          }
      }
      // Add Song
      $id =$_SESSION['userId'];
      $result = mysqli_query($conn, "SELECT * FROM artist WHERE idusers = $id");
      $row = mysqli_fetch_assoc($result);
      $artistid = $row['artistid'];

      mysqli_query($conn, "INSERT INTO songs (songid,	artistid,	genreid,	songName,	name,	image,	namesong,	song) VALUES ('', $artistid, '$genre', '$songname', '$imageName', '$imageData', 'ss', 'ss')");

       // Add Song
       $id =$_SESSION['userId'];
       $result = mysqli_query($conn, "SELECT * FROM songs LEFT JOIN artist on artist.artistid=songs.artistid WHERE artist.artistid = $artistid");
      while($row = mysqli_fetch_assoc($result)){
        //echo '<img style="width:50%"src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
        echo '
        <div class="row">
          <div class="col-lg-6">
            <img style="width:50%"src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>
          </div>
        </div>';

      }
    }
    else
    {
      echo "Only images are allowed!";
    }
  }
 ?>

 <p>hello</p>
 <img src="showimage.php?artistid=13">
