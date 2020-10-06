<?php

if (isset($_POST['login-submit'])) {
  require 'dbh.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];


  if (empty($mailuid) || empty($password)) {
    header("Location: ../loginpage.php?error=emptyfields");
    exit();
  }
  else {
    $sql ="SELECT * FROM users WHERE uidusers=? OR emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../loginpage.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $mailuid ,$mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        if ($row['userType'] == "admin") {
          $pwdCheck = $password == $row['pwdUsers'];
        }
        else {
          $pwdCheck = password_verify($password, $row['pwdUsers']);
        }

        if ($pwdCheck == false) {
          header("Location: ../loginpage.php?error=wrongpwd");
          exit();
        }
        elseif ($pwdCheck== true) {
          session_start();
          $_SESSION['userId'] = $row['idusers'];
          $_SESSION['userUId'] = $row['uidusers'];
          if ($row['userType'] == "admin") {
            header("Location: adminpage.php");
            exit();
          }
          elseif ($row['userType'] == "Customer") {
            header("Location: customerpage.php");
            exit();
          }
          else {
            header("Location: usernav.php");
            exit();
          }
        }
      }
      else {
        header("Location: ../loginpage.php?error=nouser");
        exit();
      }
    }
  }
}
else {
  header("Location: ../index.php");
  exit();
}
 ?>
