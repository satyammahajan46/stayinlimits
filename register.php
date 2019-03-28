<?php  require_once  "database/database.php";
require_once  "database/validation.php";
$pdo = db_connect();
validateRegistration();
registerUser();
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
              <h1 class="medium-text center">Register:</h1>
                <form class="loginForm" action="register.php" method="post">
                  <label for="fname">First Name:&nbsp
                      <input type="text" name="fname" id="fname">
                  </label>
                  <?php error_or_message('fname') ?>
                  <label for="lname">Last Name:&nbsp
                      <input type="text" name="lname" id="lname">
                  </label>
                  <?php error_or_message('lname') ?>
                    <label for="email">Email:&nbsp

                        <input type="text" data-validation="email" name="email" id="email">


                    </label>
                    <?php error_or_message('email') ?>
                    <label for="password">Password:&nbsp;
                        <input type="password" name="password" id="password">

                    </label>
                    <?php error_or_message('password') ?>
                    <label for="cPassword">Confirm Password:&nbsp;
                      <input type="password" name="cPassword" id="cPassword">

                    </label>
                    <?php error_or_message('cPassword') ?>
                    <?php error_or_message('mismatch') ?>
                    <div class="radio-box">
                      <h2>Gender:</h2>
                      <span>
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Male</label>
                      </span>
                      <span>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label>
                      </span>
                      <?php error_or_message('gender') ?>
                    </div>
                    <div class="radio-box">
                      <h2>Account Type:</h2>
                      <span>
                        <input type="radio" id="individual" name="account" value="0">
                        <label for="individual">Individual</label>
                      </span>
                      <span>
                        <input type="radio" id="group" name="account" value="1">
                        <label for="group">Group</label>
                      </span>
                      <?php error_or_message('account') ?>
                    </div>
                    <button class="submit" type="submit" name="submit">Submit</button>
                </form>
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
