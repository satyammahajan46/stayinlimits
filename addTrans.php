<?php  require_once  "database/database.php";
require_once  "database/validation.php";
$pdo = db_connect();
isUserLoggedIn();
validateAddTrans();
addTransaction();
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
              <h1 class="small-text left">Add a new Transaction:</h1>
                <form class="loginForm Inline" action="addTrans.php" method="post">
                    <label for="transID">Transaction ID:&nbsp;
                      <input type="text" placeholder="ID" name="transID" id="transID" required>
                      <?php error_or_message('transID') ?>
                    </label>

                    <label for="date">Date of Transaction:&nbsp;
                      <input type="text" placeholder="yyyy/mm/dd" name="date" id="date" data-validation="date" data-validation-format="yyyy/mm/dd" required>
                      <?php error_or_message('date') ?>
                    </label>

                    <label for="credit">Credit:&nbsp;
                      <input type="number" placeholder="Eg: 99" name="credit" id="credit" required>
                      <?php error_or_message('credit') ?>
                    </label>

                    <label for="debit">Debit:&nbsp;
                      <input type="number" placeholder="Eg: 99" name="debit" id="debit" required>
                      <?php error_or_message('debit') ?>
                    </label>

                    <button class="submit Inline" type="submit" name="submit">Add</button>
                </form>
          </div>
          <div class="dublicate-error">
            <?php error_or_message('dublicate') ?>
          </div>
        </div>
      </div>
        <?php require_once('commonFooter.php'); ?>
    </body>
</html>
