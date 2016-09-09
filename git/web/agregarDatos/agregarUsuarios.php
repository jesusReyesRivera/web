<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
      include("../sesion/conexion.php");
$nombre=$_POST['nombre'];
$dire=$_POST['dire'];
$tele=$_POST['tele'];
$edad=$_POST['edad'];
$us=$_POST['us'];
$pass=$_POST['pass'];
$tipo=$_POST['tipo'];
$tipoC=$_POST['tipoCC'];
 $query="insert into cajeros (nombre,direccion,fechaN,ingreso,telefono) values('".$nombre."','".$dire."','".$edad."','".date('Y/m/j')."','".$tele."')";
$resultado=mysqli_query($conexion,$query);

if($resultado){
$id = mysqli_insert_id($conexion);
 $query2="insert into usuarios (idCajero,usuario,pass,tipo,cooperativaID) values('".$id."','".$us."','".$pass."','".$tipo."',".$tipoC.")";
$resultado2=mysqli_query($conexion,$query2);
if($resultado2){
echo "1";
}else{
    echo "hubo un error_1";
}
}else
 {
  echo "Hubo en error_2";
}



}
else{
    header("location: htt://93.188.166.74/web/admin.php");
}
