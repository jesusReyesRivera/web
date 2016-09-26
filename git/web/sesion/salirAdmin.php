
<?php
  session_start(); 
  unset( $_SESSION["Sesion"] );  
  unset( $_SESSION["inicio"] );  
  unset( $_SESSION["usuario"] );  

  header("Location: ../admin");
  exit;
?>
