<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   $contador=0;
	require "../../tienda/password.php";
   include("../../tienda/send/conexion/conexion.php");
   $conexion->set_charset("utf8");
   $clave=$_POST['recibo'];
   $query="UPDATE recibosDetalle
set recibosDetalle.estado=1 where recibosDetalle.ReciboID=?";
$stmt=$conexion->prepare($query);
$stmt->bind_param("i",$clave);
if($stmt->execute()){
echo "hecho!";
}else{
  die();
}


	}else{

	  header("location: ../");
}
?>