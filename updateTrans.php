<?php  require_once  "database/database.php";
require_once  "database/validation.php";
$pdo = db_connect();
isUserLoggedIn();
validateAddTrans();
updateTransaction();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <?php require_once('required_files.php'); ?>
    </head>
    <body>
        <?php require_once('mainHeader.php'); ?>
        <div class="wrapper-main">
          <h2 class="small-text">Welcome: <?php echo get_name(); ?></h2>
          <div>
            <div class="login">
              <h1 class="small-text left">Update a Transaction:</h1>
                <form class="loginForm Inline" action="updateTrans.php" method="post">
                    <label for="transID">Transaction ID:&nbsp;
                      <input type="text" name="transID" id="transID">
                      <?php error_or_message('transID') ?>
                    </label>

                    <label for="date">Date of Transaction:&nbsp;
                      <input type="datetime" name="date" id="date">
                      <?php error_or_message('date') ?>
                    </label>

                    <label for="credit">Credit:&nbsp;
                      <input type="number" name="credit" id="credit">
                      <?php error_or_message('credit') ?>
                    </label>

                    <label for="debit">Debit:&nbsp;
                      <input type="number" name="debit" id="debit">
                      <?php error_or_message('debit') ?>
                    </label>

                    <button class="submit Inline" type="submit" name="submit">Update</button>
                </form>
          </div>
          <div class="dublicate-error">
            <?php error_or_message('dublicate') ?>
          </div>
        </div>
        <?php require_once('commonFooter.php'); ?>
    </body>
</html>
