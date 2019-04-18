<?php  require_once  "database/database.php";
require_once  "database/validation.php";
$pdo = db_connect();
contactUser();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <?php require_once('required_files.php'); ?>
    </head>
    <body>
        <?php require_once('commonHeader.php'); ?>
        <div class="wrapper">
            <div class="login">
              <h1 class="medium-text center">Contact Us:</h1>
                <form class="loginForm" action="contact.php" method="post">
                  <label for="fname">First Name:&nbsp;
                      <input type="text" placeholder="First Name" name="fname" id="fname" required>
                  </label>
                  <label for="lname">Last Name:&nbsp;
                      <input type="text" placeholder="Last Name" name="lname" id="lname" required>
                  </label>
                    <label for="email">Email:&nbsp;
                        <input type="email" placeholder="example@example.com" data-validation="email" name="email" id="email">
                    </label>
                    <label for="text">Comments:&nbsp;
                      <textarea id='text' placeholder="Enter text here" name="message" rows="5" cols="30" required></textarea>
                    </label>
                    <button class="submit" type="submit" name="submit">Submit</button>
                </form>
                <?php
                  if(isset($_GET["d"])&& $_GET['d']==1){
                    echo "<p style = 'text-align:center; color:red;'>Got it! Thanks</p>";
                  }
                  if(isset($_GET["d"])&& $_GET['d']==0){
                    echo "<p style = 'text-align:center; color:red;'>Error</p>";
                  }
                 ?>
            </div>
            <div class="banner">
                <h1>Available on following</h1>
                <ul>
                    <li>Android</li>
                </ul>
            </div>
        </div>
        <?php require_once('commonFooter.php'); ?>
    </body>
</html>
