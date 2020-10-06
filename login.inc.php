<main>
  <div class="container-fluid signup-div">
    <section class="signup-section">
      <h1>Member Login</h1>
       <?php
        if(isset($_GET['error'])){
          if ($_GET['error'] == 'emptyfields') {
            echo '<p style="color:red;">Enter all fields!</p>';
          }
          elseif ($_GET['error'] == 'nouser') {
            echo '<p style="color:red;">Incorrect username or Password!</p>';
          }
          elseif ($_GET['error'] == 'wrongpwd') {
            echo '<p style="color:red;">Incorrect Password!</p>';
          }
        }
        ?>
      <form class="signup-form" action="includes/login.php" method="post">
        <input class= "input-box" type="text" name="mailuid" placeholder="Username">
        <br>
        <input class= "input-box" type="password" name="pwd" placeholder="Enter Password">
        <br>
        <button type="submit" name="login-submit" class="signupbtn" style="position:relative; right:10px;">Login</button>
      </form>
    </section>
  </div>
</main>
