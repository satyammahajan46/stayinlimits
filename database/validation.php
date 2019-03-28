<?php
$valid = false;
$messages = array();

function validateLogin(){
  global $valid;
  global $messages;
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['email'])){
         $pattern = '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
         $input = $_POST['email'];
         if(preg_match($pattern, $input)){
             $valid = true;
         }
         else{
           $messages['email'] = "Email is not in correct format";
           $valid = false;
         }
     }
  }
}

function validateRegistration(){
  global $valid;
  global $messages;
  $subValid = false;
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Name field must not be Empty
    if(isset($_POST['fname'])){
      if(empty($_POST['fname'])){
        $valid = false;
        $messages["fname"] = "Required First Name";
      }
    }
    if(isset($_POST['lname'])){
      if(empty($_POST['lname'])){
        $valid = false;
        $messages["lname"] = "Required Last Name";
      }
    }
    //Email Checking
    if(isset($_POST['email'])){
         $pattern = '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
         $input = $_POST['email'];
         if(preg_match($pattern, $input)){
             $valid = true;
         }
         else{
           $messages['email'] = "Email is not in correct format";
           $valid = false;
         }
     }
     //Pasword Checking
     if(isset($_POST['password']) && isset($_POST['cPassword'])){
       if(empty($_POST['password'])){
         $subValid = false;
         $messages['password'] = "Required field password";
       }
       else if(empty($_POST['cPassword'])){
         $subValid = false;
         $messages['cPassword'] = "Required field Confirm password";
       }
       else if($_POST['password'] === $_POST['cPassword']){
         $subValid = true;
         $messages['mismatch'] = "";
       }
       else{
         $subValid = false;
         $messages['mismatch'] = "Password and Confirm Password must match";
       }
       if($subValid && $valid){
         $valid = true;
       }
       else{
         $valid = false;
       }
     }
    //Radio Checking Gender
    if(isset($_POST['gender'])){
      $subValid = true;
      if($subValid && $valid){
        $valid = true;
      }
    }
    else{
      $valid = false;
      $messages['gender'] = "Gender must be selected";
    }
    if(isset($_POST['account'])){
      $subValid = true;
      if($subValid && $valid){
        $valid = true;
      }
    }
    else{
      $valid = false;
      $messages['account'] = "Account Type must be selected";
    }
  }
}

function error_or_message($value){
  global $messages;
  if(isset($messages[$value])){
    echo "<p class='two-column center' style='color:red'>". $messages[$value] ."</p>";
  }
}

function validateAddTrans(){
  global $valid;
  global $messages;
  $subValid = false;
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Name field must not be Empty
    if(isset($_POST['transID'])){
      if(empty($_POST['transID'])){
        $valid = false;
        $messages["transID"] = "Required Transaction ID";
      }
      else{
        $valid = true;
      }
    }
    if(isset($_POST['date'])){
      if(empty($_POST['date'])){
        $valid = false;
        $messages["date"] = "Required Date";
      }
    }
    //Date and time are in format
    if(isset($_POST['date'])){
         $pattern = '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#';
         $input = $_POST['date'];
         if(preg_match($pattern, $input)){
             $subValid = true;
         }
         else{
           $messages['date'] = "Date is not format: yyyy/mm/dd";
           $subValid = false;
         }
         if($valid && $subValid){
           $valid = true;
         }
     }

     if(isset($_POST['credit'])){
       $zero = '0';
       if(empty($_POST['credit']) && $_POST['credit'] !== $zero){
         $messages['credit'] = "Required Credit Field";
         $subValid = false;
       }
       else if(is_numeric($_POST['credit'])){
         $subValid = true;
       }
       else{
         $messages['credit'] = "Must be a number";
         $subValid = false;
       }
       if($valid && $subValid){
         $valid = true;
       }
     }

     if(isset($_POST['debit'])){
       $zero = '0';
       if(empty($_POST['debit']) && $_POST['debit'] !== $zero){
         $messages['debit'] = "Required Debit Field";
         $subValid = false;
       }
       else if(is_numeric($_POST['debit'])){
         $subValid = true;
       }
       else{
         $messages['debit'] = "Must be a number";
         $subValid = false;
       }
       if($valid && $subValid){
         $valid = true;
       }
     }
  }
}

 ?>
