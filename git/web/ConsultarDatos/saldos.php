<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");

$cuenta=$_POST['cuenta'];
$query="select cuentas.monto, concat_ws(' ', Clientes.Nombre, Clientes.Apellido) as nombre, Clientes.Cedula from cuentas inner join Clientes on cuentas.idCliente=Clientes.idCliente where cuentas.cuenta='".$cuenta."'";
$resultado=mysqli_query($conexion,$query);
if(mysqli_num_rows($resultado)==1){
while($line=mysqli_fetch_array($resultado)){
  $monto=$line['monto'];
  $nombre=$line['nombre'];
  $cedula=$line['Cedula'];
}
echo $monto."+".$nombre."+".$cedula;

}else
{echo "error";
}

}
else
{
  # code..
  header("location: http://93.188.166.74/web");
}
?>
