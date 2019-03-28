<?php  require_once  "database/database.php";
require_once  "database/validation.php";
$pdo = db_connect();
isUserLoggedIn();
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
            <div class="info-bar">
              <?php getSumData(); ?>
            </div>

            <h2 class="small-text center">Here is your transactions history</h2>
            <div>
              <?php get_table(); ?>
            </div>
          </div>
        </div>
        <?php require_once('commonFooter.php'); ?>
    </body>
</html>
