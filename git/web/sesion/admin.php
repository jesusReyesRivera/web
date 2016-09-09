<?php
session_start();
include("conexion.php");
$usuario = $_POST['usuario'];
$password = $_POST['password'];
if($usuario!="" && $password!=""){
$query="select usuario, pass from admin where usuario='".$usuario."' and pass='".$password."'";
$resultado=mysqli_query($conexion,$query);
$contar=mysqli_num_rows($resultado);
if($contar==1){
  $_SESSION['Sesion']=true;
  $_SESSION['inicio']=time();
  $_SESSION['usuario']=$nombre;
  echo "1";
}
}else{
  header("location: http://93.188.166.74/web/admin.php");
}



?>
