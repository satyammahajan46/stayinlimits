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


function registerUser(){
  global $valid;
  global $pdo;
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $query = "INSERT INTO users (fname, lname, email, password, gender, account) VALUES (:fname, lname, :email, :password, :gender, :account);";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':fname',$_POST['fname']);
    $statement->bindValue(':lname',$_POST['lname']);
    $statement->bindValue(':email',$_POST['email']);
    $statement->bindValue(':password', $_POST['password']);
    $statement->bindValue(':gender', $_POST['gender']);
    $statement->bindValue(':account', $_POST['account']);
    $statement->execute();
  }
}
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
function addTransaction(){
  global $valid;
  global $pdo;
  global $messages;
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $dubCheck = "SELECT transID from transactions WHERE transID = ?;";
    $dubStatement = $pdo->prepare($dubCheck);
    $result = $dubStatement->execute(array($_POST['transID']));
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
      $statement->execute();
    }
  }
}

function updateTransaction(){
  global $valid;
  global $pdo;
  global $messages;
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $dubCheck = "SELECT transID from transactions WHERE transID = ?;";
    $dubStatement = $pdo->prepare($dubCheck);
    $result = $dubStatement->execute(array($_POST['transID']));
    if($result && $dubStatement->fetch()){
      $query = "UPDATE transactions SET date = :date, email=:email, credit=:credit, debit=:debit WHERE transID =:ID";
      $statement = $pdo->prepare($query);
      $statement->bindValue(':ID',$_POST['transID']);
      $statement->bindValue(':date',$_POST['date']);
      $statement->bindValue(':email',$_SESSION['email']);
      $statement->bindValue(':credit',$_POST['credit']);
      $statement->bindValue(':debit', $_POST['debit']);
      if($statement->execute()){
        $messages['dublicate'] = "Transaction has been updated";
      }

    }
    else{
      $messages['dublicate'] = "This Transaction ID doesn't exists";
      $valid = false;
    }
  }
}

function isUserLoggedIn(){
  session_start();
  if(is_null($_SESSION["email"])){
    header("location:login.php?lg=0");
  }
}
function loginUser(){
  global $valid;
  global $pdo;
  validateLogin();
  if($_SERVER["REQUEST_METHOD"] == "POST" && $valid){
    $query = "SELECT email from users WHERE email=? AND password=?;";
    $statement = $pdo->prepare($query);
    $result = $statement->execute(array($_POST['email'], $_POST['password']));
    if($result && $statement->fetch()){
      session_start();
      $_SESSION['email'] = $_POST['email'];
      header("location:main.php");
    }
    else{
      header("location:login?wep=1");
    }
  }
}

function get_name(){
  global $pdo;
  $query = "SELECT fname, lname from users WHERE email=?;";
  $statement = $pdo->prepare($query);
  $result = ($statement->execute(array($_SESSION['email'])));
  $result = $statement->fetch();
  $name = $result[0]. " " . $result[1];
  return $name;
}

function get_table(){
  global $pdo;
  $query = "SELECT * from transactions WHERE email=? ORDER BY date DESC;";
  $statement = $pdo->prepare($query);
  $result = $statement->execute(array($_SESSION['email']));
  if($result){
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
        echo "<td class='space' colspan='4'></td>";
      }
      echo "</tbody>";
      echo "</table>";
  }
}

function getSumData(){
  global $pdo;
  $query = "SELECT sum(credit) AS tcredit, sum(debit) AS tdebit from transactions WHERE email=? GROUP BY email";
  $statement = $pdo->prepare($query);
  $result = $statement->execute(array($_SESSION['email']));
  $row = $statement->fetch();
  echo "<h3>Total Credit: ". $row['tcredit'] . "</h3>";
  echo "<h3>Total Debit: ". $row['tdebit'] . "</h3>";
  if($row['tcredit'] > $row['tdebit']){
    $ans = $row['tcredit'] - (double)$row['tdebit'];
    echo "<h3>Savings: ". $ans . "</h3>";
  }
  else{
    $ans = $row['tdebit'] - $row['tcredit'];
    echo "<h3>Loss: ". $ans . "</h3>";
  }
}
