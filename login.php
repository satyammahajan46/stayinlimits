<?php  require_once  "database/database.php";
require_once  "database/validation.php";
$pdo = db_connect();
loginUser();
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
              <h1 class="medium-text center">Login:</h1>
                <form class="loginForm" action="login.php" method="post">
                    <label for="email">Email:&nbsp;
                        <input type="text" placeholder="example@example.com" data-validation="email" name="email" id="email" required>
                    </label>
                    <?php error_or_message('email') ?>
                    <label for="password">Password:&nbsp;
                        <input type="password" placeholder="Password" name="password" id="password" required>
                    </label>
                    <button class="submit" type="submit" name="submit">Submit</button>
                </form>
                <?php
                  if(isset($_GET["lg"])&& $_GET['lg']==1){
                    echo "<p style = 'text-align:center; color:red;'>Logged Out</p>";
                  }
                  if(isset($_GET["lg"])&& $_GET['lg']==0){
                    echo "<p style = 'text-align:center; color:red;'>Credentials Required</p>";
                  }
                  if(isset($_GET["wep"])){
                    echo "<p style = 'text-align:center; color:red;'>Wrong Email or Password</p>";
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
