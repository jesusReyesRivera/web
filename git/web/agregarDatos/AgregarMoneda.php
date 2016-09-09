<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
      include("../sesion/conexion.php");
$o=$_POST['o'];
$tm=$_POST['tm'];


 $query="insert into TipoMoneda (tipo,origen) values(?,?)";
$resultado=$conexion->prepare($query);
$resultado->bind_param("ss",$tm,$o);

if($resultado->execute()){
echo "hecho!!";
}else
 {
  echo "Hubo en error_2";
}



}
else{
    header("location: htt://93.188.166.74/web/admin.php");
}