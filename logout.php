<?php
session_start();
$_SESSION["UEmail"]=null;
session_destroy();
header("location:login.php?lg=1");
?>
