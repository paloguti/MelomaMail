<?php 
  session_start();
  unset($_SESSION["log"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow //**session_unset();**
  if(isset($_SESSION['admin'])){
  	unset($_SESSION['admin']);
  }
  header("Location: ../index.php");
?>
