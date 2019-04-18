<?php
require_once 'config.php';
// Should return a PDO
function db_connect() {

  try {
    // try to open database connection using constants set in config.php
    $connectionString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    $user = DBUSER;
    $pass = DBPASS;
    $pdo = new PDO($connectionString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }
}

//Register User into the database
function registerUser(){
  global $valid;
  global $pdo;
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $query = "INSERT INTO users (fname, lname, email, password, gender, account) VALUES (:fname, :lname, :email, :password, :gender, :account);";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':fname',$_POST['fname']);
    $statement->bindValue(':lname',$_POST['lname']);
    $statement->bindValue(':email',$_POST['email']);
    $hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $statement->bindValue(':password', $hashed);
    $statement->bindValue(':gender', $_POST['gender']);
    $statement->bindValue(':account', $_POST['account']);
    if($statement->execute()){
      header("location:register.php?succ=1#suc");
    }
    else{
      header("location:register.php?succ=0#suc");
    }
  }
}
//Add a new record into contact table
function contactUser(){
  global $pdo;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = "INSERT INTO contact (fname, lname, email, message) VALUES (:fname, :lname, :email, :message);";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':fname',$_POST['fname']);
    $statement->bindValue(':lname',$_POST['lname']);
    $statement->bindValue(':email',$_POST['email']);
    $statement->bindValue(':message', $_POST['message']);
    if($statement->execute()){
      header("location:contact.php?d=1");
    }
    else{
      header("location:contact.php?d=0");
    }
  }
}
//Add a new record into transaction table
function addTransaction(){
  global $valid;
  global $pdo;
  global $messages;
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $dubCheck = "SELECT transID from transactions WHERE email = ? AND transID = ?;";
    $dubStatement = $pdo->prepare($dubCheck);
    $result = $dubStatement->execute(array($_SESSION['email'], $_POST['transID']));
    if($result && $dubStatement->fetch()){
      $messages['dublicate'] = "This Transaction ID already exists";
      $valid = false;
    }
    else{
      $query = "INSERT INTO transactions (transID, date, email, credit, debit) VALUES (:ID, :date, :email, :credit, :debit);";
      $statement = $pdo->prepare($query);
      $statement->bindValue(':ID',$_POST['transID']);
      $statement->bindValue(':date',$_POST['date']);
      $statement->bindValue(':email',$_SESSION['email']);
      $statement->bindValue(':credit',$_POST['credit']);
      $statement->bindValue(':debit', $_POST['debit']);
      if($statement->execute()){
        $messages['addTrans'] = "Transaction has been Added";
      }
      else{
        $messages['addTrans'] = "Error Occured";
      }
    }
  }
}
//Update a given transaction based on transaction id
function updateTransaction(){
  global $valid;
  global $pdo;
  global $messages;
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $dubCheck = "SELECT transID from transactions WHERE email = ? AND transID = ?;";
    $dubStatement = $pdo->prepare($dubCheck);
    $result = $dubStatement->execute(array($_SESSION['email'], $_POST['transID']));
    if($result && $dubStatement->fetch()){
      $query = "UPDATE transactions SET date = :date, credit=:credit, debit=:debit WHERE email = :email AND transID =:ID";
      $statement = $pdo->prepare($query);
      $statement->bindValue(':ID',$_POST['transID']);
      $statement->bindValue(':date',$_POST['date']);
      $statement->bindValue(':email',$_SESSION['email']);
      $statement->bindValue(':credit',$_POST['credit']);
      $statement->bindValue(':debit', $_POST['debit']);
      if($statement->execute()){
        $messages['dublicate'] = "Transaction has been updated";
      }
      else{
        $messages['addTrans'] = "Error Occured";
      }
    }
    else{
      $messages['dublicate'] = "This Transaction ID doesn't exists";
      $valid = false;
    }
  }
}
//Check if user is logged in or not
function isUserLoggedIn(){
  session_start();
  if(is_null($_SESSION["email"])){
    header("location:login.php?lg=0");
  }
}

//Function to log user in his account
function loginUser(){
  global $valid;
  global $pdo;
  validateLogin();
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $query = "SELECT email, password from users WHERE email=?;";
    $statement = $pdo->prepare($query);
    $result = $statement->execute(array($_POST['email']));
    if($result && $row=$statement->fetch()){
      if(password_verify($_POST['password'], $row['password'])){
        session_start();
        $_SESSION['email'] = $_POST['email'];
        header("location:main.php");
      }
      else{
        header("location:login.php?wep=1");
      }
    }
    else{
      header("location:login.php?wep=1");
    }
  }
}
//Get the current user name who is logged into the system
function get_name(){
  global $pdo;
  $query = "SELECT fname, lname from users WHERE email=?;";
  $statement = $pdo->prepare($query);
  $result = ($statement->execute(array($_SESSION['email'])));
  $result = $statement->fetch();
  $name = $result[0]. " " . $result[1];
  return $name;
}
//function to get the Transaction table
function get_table(){
  global $pdo;
  $query = "SELECT * from transactions WHERE email=? ORDER BY date DESC;";
  $statement = $pdo->prepare($query);
  $result = $statement->execute(array($_SESSION['email']));
  if($result && $statement->rowCount()){
      echo "<table class='table border-dashed'>";
      echo "<thead id='tHead'>";
      echo "<tr>";
      echo "<th class='center border small-padding'>Transaction ID</th>";
      echo "<th class='center border small-padding'>Date</th>";
      echo "<th class='center border small-padding'>Credit</th>";
      echo "<th class='center border small-padding'>Debit</th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody id='tBody' class='medium-padding'>";
      while($row = $statement->fetch()){
        echo "<tr class='row-border'>";
        echo "<td class='center'>" . $row['transID'] . "</td>";
        echo "<td class='center border-left'>" . $row['date'] . "</td>";
        echo "<td class='center border-left'>" . $row['credit'] . "</td>";
        echo "<td class='center border-left'>" . $row['debit'] . "</td>";
        echo "</tr>";
        echo "<tr><td class='space' colspan='4'></td></tr>";
      }
      echo "</tbody>";
      echo "</table>";
  }
  else{
    echo "<table class='table border-dashed'>";
    echo "<thead id='tHead'>";
    echo "<tr class='row-border'><td class='center'>No transactions available</td></tr>";
    echo "</thead>";
    echo "</table>";
  }
}
//Function to get the data required for user information bar
function getSumData(){
  global $pdo;
  $query = "SELECT sum(credit) AS tcredit, sum(debit) AS tdebit from transactions WHERE email=? GROUP BY email";
  $statement = $pdo->prepare($query);
  $result = $statement->execute(array($_SESSION['email']));
  $row = $statement->fetch();
  $tcredit = $row['tcredit'];
  $tdebit = $row['tdebit'];
  echo "<h3>Total Credit: ". (empty($tcredit)?0:$tcredit) . "</h3>";
  echo "<h3>Total Debit: ". (empty($tdebit)?0:$tdebit) . "</h3>";
  if($row['tcredit'] > $row['tdebit']){
    $ans = $row['tcredit'] - (double)$row['tdebit'];
    echo "<h3>Savings: ". $ans . "</h3>";
  }
  else{
    $ans = $row['tdebit'] - $row['tcredit'];
    echo "<h3>Loss: ". $ans . "</h3>";
  }
}
