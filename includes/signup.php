<?php
  if (isset($_POST['signup-submit'])) {
    session_start();
    require 'dbh.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $role = $_POST['role'];

    // Error Checking Signup Form
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat) || empty($role)) {
      header("Location: ../signuppage.php?error=emptyfields&uid=" .$username."&mail=".$email);
      exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*/", $username)) {
      header("Location: ../signuppage.php?error=invalidmailuid");
      exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signuppage.php?error=invalidmail&uid=" .$username);
      exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
      header("Location: ../signuppage.php?error=invaliduid&mail=" .$email);
      exit();
    }
    elseif ($password !== $passwordRepeat) {
      header("Location: ../signuppage.php?error=passwordcheck&uid=" .$username."&mail=".$email);
      exit();
    }
    else {

      $sql = "SELECT uidusers FROM users WHERE uidusers=? OR emailUsers=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signuppage.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          header("Location: ../signuppage.php?error=usertaken");
          exit();
        }
        else {
            $sql = "INSERT INTO users (uidusers, emailUsers, pwdUsers, userType) values (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../signuppage.php?error=sqlerror");
              exit();
            }
            else {
              $hashpwd = password_hash($password, PASSWORD_DEFAULT); //hash password for more security

              mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashpwd, $role);
              mysqli_stmt_execute($stmt);

            }
          }
        }
      }
    }
    else {
      header("Location: ../signuppage.php");
      exit();
    }
?>
