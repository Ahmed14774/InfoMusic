
<?php
  if (isset($_SESSION['userId'])) {
    require 'includes/usernav.php';
  }
  else {
    //Include Header
    require "header.php";

    //Page Content
    echo '<div class="intro-section"><h1 class="title-text"><strong>Music and Rythm find their way into the secret places of the soul <br> -Plato</strong></h1></div>';
    echo'  <section id="features">
    <div class="row">
      <div class="feature-content col-lg-4">
        <span class="font-icon"><i class="fas fa-music fa-4x"></i></span>
        <h3 class="feature-title">Listen To Music</h3>
        <p>Enjoy listening to your favorite songs!</p>
      </div>
      <div class=" feature-content col-lg-4">
        <span class="font-icon"><i class="fas fa-upload fa-4x"></i></span>
        <h3 class="feature-title">Upload Music</h3>
        <p>Share your music with the world!</p>
      </div>
      <div class="feature-content col-lg-4">
        <span class="font-icon"><i class="fas fa-share-alt fa-4x"></i></span>
        <h3 class="feature-title">Share</h3>
        <p>Proud of your work? Share with your Family and Friends</p>
      </div>
    </div>
  </section>';
    //End Page Content

    //Include Footer
    require "footer.php";

  }
 ?>
