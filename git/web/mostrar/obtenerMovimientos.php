<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
	include("../sesion/conexion.php");
$id=$_POST['id'];
$cuenta=$_POST['cuenta'];
		$fecha_="";
		$valor_=0;
		$cuenta_="";
		$movimiento_="";
		$reciboID_=0;
if($id!=""){

$stmt=$conexion->prepare("select movimientos.fecha,  ReciboDetalle.valor, cuentas.cuenta, movimientos.MovID, 
 ReciboDetalle.ReciboID 
 from cuentas  join Clientes on cuentas.idCliente=Clientes.idCliente
 join movimientos on cuentas.idCuenta = movimientos.idCuenta join
MovimientoDetalle on movimientos.MovimientoID = MovimientoDetalle.MovimientoID join
ReciboDetalle on ReciboDetalle.ReciboID = MovimientoDetalle.ReciboID where movimientos.MovimientoID=?");

$stmt->bind_param("i",$id);

if($stmt->execute()){

	$stmt->bind_result($fecha,$valor,$cuenta,$movimiento,$reciboID);
	while($stmt->fetch()){
		$fecha_=$fecha;
		$valor_=$valor;
		$cuenta_=$cuenta;
		$movimiento_=$movimiento;
         $reciboID_=$reciboID;
		
	}
$stmt2=$conexion->prepare("select  concat_ws(' ', Clientes.Nombre, Clientes.Apellido) as nombre, Clientes.Cedula, cuentas.monto as 'Monto_inicial',
 sum(if(movimientos.MovID=1, ReciboDetalle.valor, 0)) as 'Abono',
 sum(if(movimientos.MovID=2, ReciboDetalle.valor, 0)) as 'Retiro',
 sum(if(movimientos.MovID=3, ReciboDetalle.valor, 0)) as 'Interes'
 from cuentas  join Clientes on cuentas.idCliente=Clientes.idCliente
 join movimientos on cuentas.idCuenta = movimientos.idCuenta join
MovimientoDetalle on movimientos.MovimientoID = MovimientoDetalle.MovimientoID join
ReciboDetalle on ReciboDetalle.ReciboID = MovimientoDetalle.ReciboID where cuentas.cuenta=?");
$stmt2->bind_param("s",$cuenta_);

if($stmt2->execute()){
		$stmt2->bind_result($nombre,$cedula,$Monto_inicial,$abono,$retiro,$interes);
	while($stmt2->fetch()){
		$nombre_=$nombre;
		$cedula_=$cedula;
		$Monto_inicial=$Monto_inicial;
		$abono_=$abono;
		$retiro_=$retiro;
		$interes_=$interes;
	}

	$monto=$Monto_inicial+$abono_+$interes_-$retiro_;

	if($movimiento_==1){
     $tipo_movimiento="Abonada";
	}
	if($movimiento_==2){
     $tipo_movimiento="Retirada";
	}

	echo $nombre_."+".$cedula_."+".$cuenta_."+".$valor_."+".$monto."+".$fecha_."+".$tipo_movimiento."+".$id."+".$reciboID_;

}

	

}else{
echo "ha ocurrido un error";
}


}else{

	header("location: ../");
}

}
else{
	header("location: ../");
}

?>