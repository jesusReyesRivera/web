<?php
  session_start();
  unset($_SESSION["username"]);
   unset($_SESSION['idUsuario']);
  unset($_SESSION['tipo']);
    $_SESSION['loggedin']=false;
     
$texto="Location: http://93.188.166.74/web";
  header($texto);
  exit;
?>
