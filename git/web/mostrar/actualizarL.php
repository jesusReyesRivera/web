<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
include("../sesion/conexion.php");
$cc=$_POST["cuenta"];
$ll=$_POST["libreta"];
if($cc!="" && $ll!=""){
$stmt = $conexion->prepare("SELECT abonosRetiros.fecha, abonosRetiros.abono, abonosRetiros.retiro,abonosRetiros.interes,abonosRetiros.saldos,abonosRetiros.idUsuario FROM 
abonosRetiros inner join cuentas on cuentas.idCuenta=abonosRetiros.idCuenta inner join 
libretas on libretas.idCuenta=cuentas.idCuenta where cuentas.cuenta =? and 
libretas.libreta=? and abonosRetiros.impreso=0 order by abonosRetiros.id");
$stmt->bind_param('ss', $cuenta,$libreta);
// Establecer parámetros y ejecutar
$cuenta=$cc;
$libreta=$ll;

$stmt->execute();
$contador=0;
$texto="<table style='font-size: 9px'><tbody>";
 $stmt->bind_result($fecha, $abono,$retiro,$interes,$saldo,$usuario);
  while ($stmt->fetch()) {
  	$texto.= "<tr><td>".$fecha."</td>";
  	$texto.= "<td>".number_format ($retiro, 2)."</td>";
  	$texto.= "<td>".number_format ($abono,2)."</td>";
  	$texto.= "<td>".number_format ($interes, 2)."</td>";
  	$texto.= "<td>".number_format ($saldo, 2)."</td>";
    $texto.= "<td>".$usuario."</td></tr>";
  	   $contador=$contador+1;
  }
  if($contador>0){
  	$stmt2 = $conexion->prepare("UPDATE abonosRetiros T1 INNER JOIN cuentas T2 ON T1.idCuenta = T2.idCuenta 
INNER JOIN libretas T3 ON T3.idCuenta = T2.idCuenta 
SET T1.impreso = 1 WHERE T2.cuenta = ? AND T3.libreta  = ?");
  	$stmt2->bind_param('ss', $cuenta2,$libreta2);
// Establecer parámetros y ejecutar
$cuenta2=$cc;
$libreta2=$ll;
$stmt2->execute();
    echo $contador."+".$texto.="</tbody></table>";
  }

}else{
		header("location: http://93.188.166.74/web");
}
}else{
	header("location: http://93.188.166.74/web");
}
?>
