<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");

$cuenta=$_POST['cuenta'];
$query="select concat_ws(' ', Clientes.Nombre, Clientes.Apellido) as nombre, Clientes.Cedula, cuentas.monto as 'Monto_inicial',
 sum(if(movimientos.MovID=1, ReciboDetalle.valor, 0)) as 'Abono',
 sum(if(movimientos.MovID=2, ReciboDetalle.valor, 0)) as 'Retiro',
 sum(if(movimientos.MovID=3, ReciboDetalle.valor, 0)) as 'Interes'
 from cuentas left outer  join Clientes on cuentas.idCliente=Clientes.idCliente
 left outer  join movimientos on cuentas.idCuenta = movimientos.idCuenta left outer  join
MovimientoDetalle on movimientos.MovimientoID = MovimientoDetalle.MovimientoID left outer  join
ReciboDetalle on ReciboDetalle.ReciboID = MovimientoDetalle.ReciboID where cuentas.cuenta='".$cuenta."'";
$resultado=mysqli_query($conexion,$query);
if(mysqli_num_rows($resultado)==1){
while($line=mysqli_fetch_array($resultado)){
  $montoInicial=$line['Monto_inicial'];
  $abono=$line['Abono'];
  $retiro=$line['Retiro'];
  $Interes=$line['Interes'];
  $nombre=$line['nombre'];
  $cedula=$line['Cedula'];
}

$total=$montoInicial+$abono+$Interes-$retiro;
echo $total."+".$nombre."+".$cedula;

}else
{echo "error";
}

}
else
{
  # code..
  header("location: ../");
}
?>
