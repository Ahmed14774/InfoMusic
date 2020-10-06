<?php
  session_start();
  if (isset($_POST['uploads'])) {

    require 'dbh.php';
    $songname = $_POST['songname'];
    $genre = $_POST['genre'];

    $imageName = mysqli_real_escape_string($conn, $_FILES["coverart"]["name"]);
    $imageData = mysqli_real_escape_string($conn,file_get_contents($_FILES["coverart"]["tmp_name"]));
    $imageType = mysqli_real_escape_string($conn,$_FILES["coverart"]["type"]);
    $imageName2 = mysqli_real_escape_string($conn,$_FILES["song"]["name"]);
    $imageData2 = mysqli_real_escape_string($conn, file_get_contents($_FILES["song"]["tmp_name"]));
    $imageType2 = mysqli_real_escape_string($conn,$_FILES["song"]["type"]);

    // Error Checking Signup Form
    if (empty($songname) || empty($genre)) {
      header("Location: addmusicadmin.php?error=emptyfields&genre=" .$genre."&songname=".$songname);
      exit();
    }
    else {
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
        $result = mysqli_query($conn, "SELECT * FROM artist WHERE idusers = $id");
        $row = mysqli_fetch_row($result);
        //echo "$row[0]";
        if (substr($imageType,0,5) =="image") {
          $sql = "INSERT INTO songs (artistid,	genreid,	songName,	name, image, namesong,	song	) values (?, ?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../addmusicadmin.php?error=sqlerror");
            exit();
          }
          else {
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
            move_uploaded_file($_FILES['coverart']['tmp_name'],"customerphoto.img");
            $read_customerphoto = fopen("customerphoto.img","rb");
            $photo = addslashes(fread($read_customerphoto,filesize("customerphoto.img")));

            mysqli_stmt_bind_param($stmt, "iissssb", $row[0], $genre, $songname, $imageName, $photo, $imageName2, $imageData2);
            mysqli_stmt_execute($stmt);
            $results = mysqli_query($conn, "SELECT * FROM songs WHERE artistid = $row[0]");
            //$data = mysqli_fetch_array($results);
            $rows = mysqli_fetch_array($results);

            echo '<img src="data:image/jpeg;base64,'.base64_encode( $photo).'"/>';
            //printf ("%s \n",$rows[5]);

            //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';


            exit();
        }
      }
      else {
        //echo 'substr($imageType,0,5) =="image"';
        //header("Location: ../addmusicadmin.php?error=onlyimages");
        exit();
      }
         // $allowTypes = array('jpg','png','jpeg','gif');
         // if (in_array($fileType, $allowTypes)) {
        //   $image = $_FILES['coverart']['tmp_name'];
        //   $coverart = addslashes(file_get_contents($image));

        //   if ($sql) {
        //     echo "failed";
        //   }
        //   else {
        //     echo "success";
        //   }
        // }
        // $sql = "INSERT INTO songs (artistid,	genreid,	songName,	coverimg,	song	) values (?, ?, ?, ?, ?)";
        // $stmt = mysqli_stmt_init($conn);
        // if (!mysqli_stmt_prepare($stmt, $sql)) {
        //   header("Location: ../addmusicadmin.php?error=sqlerror");
        //   exit();
        // }
        // else {
        //   switch ($genre) {
        //     case "Country":
        //       $genre = 1;
        //       break;
        //     case "Hip Hop":
        //       $genre = 2;
        //       break;
        //     case "Jazz":
        //       $genre = 3;
        //       break;
        //     case "Pop":
        //       $genre = 4;
        //       break;
        //     case "Rock":
        //       $genre = 5;
        //       break;
        //     default:
        //       $genre = 0;
        //   }
        //   mysqli_stmt_bind_param($stmt, "iisbb", $row[0], $genre, $songname, $coverart, $song);
        //   mysqli_stmt_execute($stmt);
        //   echo "$song";
        }

      }
