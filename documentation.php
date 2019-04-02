<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once('required_files.php'); ?>
  </head>
  <body>
  <?php
  session_start();
  if(isset($_SESSION['email']) && !is_null($_SESSION['email'])){
    require_once('mainHeader.php');
  }
  else{
    require_once("commonHeader.php");
  }
  ?>
    <div class="wrapper-main">
      <div class="content">
        <h1>How to use my site</h1>
        <ul class="">
          <li>Register to get started, click <a href="register.php">here</a> to register</li>
          <li>Login to see account details, click <a href="Login.php">here</a> to Login</li>
          <li>Already logged in want to add a transaction, click <a href="addTrans.php">here</a></li>
          <li>Already logged in want to update a transaction, click <a href="updateTrans.php">here</a></li>
        </ul>
        <h1>Features</h1>
        <ul>
          <li>Easy to use</li>
          <li>Compatible on cell phones</li>
          <li>Keyboard Accessibility</li>
          <li>Tested and Free from error, screenshots are provided below</li>
          <li>Security measures to prevent malicious activity</li>
        </ul>
      </div>
    </div>
    <?php require_once('commonFooter.php'); ?>
  </body>
</html>
