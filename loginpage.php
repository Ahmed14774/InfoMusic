<?php
  if(isset($_SESSION['userId'])){
    require 'includes/usernav.php';
  }
  else{
      // Include Header
      require "header.php";

        // Page Content

      require "login.inc.php";

      // End Page Content

      // Include Footer
      require "footer.php";
  }

?>
