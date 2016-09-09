<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
include("../sesion/conexion.php");
$idRecibo=$_POST['recibo'];
$stmt=$conexion->prepare(" SELECT Clientes.Nombre,Clientes.Apellido, cuentas.cuenta, DePlaFi.fechaA, DePlaFi.plazo, ReciboDetalle.valor,DePlaFi.DepositoID,cuentas.monto, recibos.estado from cuentas inner join
Clientes on cuentas.idCliente = Clientes.idCliente join
DePlaFi on cuentas.idCuenta = DePlaFi.idCuenta join 
DePlaFiDetalle on DePlaFiDetalle.DepositoID = DePlaFi.DepositoID join 
recibos on recibos.ReciboID = DePlaFiDetalle.ReciboID join 
ReciboDetalle on recibos.ReciboID = ReciboDetalle.ReciboID where recibos.ReciboID=?");
$stmt->bind_param('i',$idRecibo);
if($stmt->execute()){
$stmt->bind_result($nombre,$apellido,$Cuenta,$fechaI,$plazo,$valor,$depoID,$montoo,$estado);
  while ($stmt->fetch()) {
    $nombreCompleto=$nombre." ".$apellido;
    $cuentaR=$Cuenta;
    $fechaA=$fechaI;
    $plazoR=$plazo;
    $valorR=$valor;
    $depoIDR=$depoID;
    $montoR=$montoo;
    $estadoR=$estado;
  }
if($estadoR=="1"){
  $stmt2=$conexion->prepare("update recibos set estado=0 where reciboID=?");
  $interes=0.05;
/*if($plazoR==90){
$interes=0.05;
}else if($plazoR==180)
{
	$interes=0.055;
}else if($plazoR==360){
$interes=0.6;
}
*/
  $calculo=(float)$valorR*((float)1+((float)$interes*((float)90/(float)360)));
$total=(float)$calculo-(float)$valorR;
$retencion=(float)$total*(float)0.1;
$totalInteres=(float)$total-(float)$retencion;
$totalRecibido=(float)$valorR+(float)$totalInteres;
  $stmt2->bind_param('i',$idRecibo);
  if($stmt2->execute()){
  	$montoR=(float)$montoR+(float)$totalRecibido;
  	$queryActualizar="update cuentas set monto=? where cuenta=?";
  	$stmt3=$conexion->prepare($queryActualizar);
  	$stmt3->bind_param('ds',$montoR,$cuentaR);
  	if($stmt3->execute()){
  		 	echo "<table border=1><thead><tr><thead>Recibo de deposito a plazo fijo</thead></tr></thead><tr><td>Cliente: ".$nombreCompleto."</td></tr><tr><td>Cuenta: ".$cuentaR."</td></tr><tr><td>Monto Inicio: ".$valorR."</td></tr><tr><td>Monto Final: ".$totalRecibido."</td></tr><tr><td>Fecha de inicio: ".$fechaA."</td></tr><tr><td>plazo: ".$plazoR."</td></tr><tr><td># de recibo: ".$idRecibo."</td></tr><tr><td># de Certificado de deposito a plazo: ".$depoIDR."</td></tr></table>";
  	}
 
  }
}else{
	echo "recibo ya cancelado";
}


}else{
	echo "0-1";
}

}
    else
  {
    # code..
    header("location: http://93.188.166.74/web");
  }
?>