<!-- Include Header -->
<?php
  require "header.php";
?>
<!-- Page Content -->
  <main>
    <div class="container-fluid signup-div">
      <section class="signup-section">
        <h1>Create Account</h1>
        <?php
          if(isset($_GET['error'])){
            if ($_GET['error'] == 'emptyfields') {
              echo '<p style="color:red;">Enter in all Fields!</p>';
            }
            elseif ($_GET['error'] == 'invalidmailuid') {
              echo '<p style="color:red;">Enter in valid email and username!</p>';
            }
            elseif ($_GET['error'] == 'invalidmail&uid') {
              echo '<p style="color:red;">Enter in valid email!</p>';
            }
            elseif ($_GET['error'] == 'invaliduid&mail') {
              echo '<p style="color:red;">Enter in valid username!</p>';
            }
            elseif ($_GET['error'] == 'usertaken') {
              echo '<p style="color:red;">User already exists!</p>';
            }
            elseif ($_GET['error'] == 'passwordcheck') {
              echo '<p style="color:red;">Passwords dont match!</p>';

            }
          }
          elseif(isset($_GET['signup']) == 'success'){
            echo '<p style="color:green;">You have successfully created an account!</p>';
          }
         ?>
        <form class="signup-form" action="includes/signup.php" method="post">
          <input class= "input-box" type="text" name="uid" placeholder="Username">
          <br>
          <input class= "input-box" type="email" name="mail" placeholder="Enter E-mail">
          <br>
          <input class= "input-box" type="password" name="pwd" placeholder="Enter Password">
          <br>
          <input class= "input-box" type="password" name="pwd-repeat" placeholder="Repeat Password">
          <br>
          <h4>Select Role</h4>
          <label for="Artist"> Artist</label>
          <input type="radio" name="role" value="Artist">
          <label for="Customer">Customer</label>
          <input type="radio" name="role" value="Customer">
          <button type="submit" name="signup-submit" class="signupbtn">Sign Up</button>
        </form>
      </section>
    </div>
  </main>
<!-- End Page Content -->

<!-- Include Footer -->
<?php
  require "footer.php";
?>
