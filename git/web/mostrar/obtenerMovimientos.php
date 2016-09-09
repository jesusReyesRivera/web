<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
	include("../sesion/conexion.php");
$id=$_POST['id'];
$cuenta=$_POST['cuenta'];
if($id!=""){
$stmt=$conexion->prepare("SELECT  Clientes.Nombre, Clientes.Apellido, Clientes.Cedula, cuentas.cuenta,abonosRetiros.abono,
abonosRetiros.retiro, cuentas.monto, abonosRetiros.fecha,abonosRetiros.idUsuario,abonosRetiros.id, cuentas.idCuenta,abonosRetiros.saldos from Clientes inner join
cuentas on Clientes.idCliente=cuentas.idCliente join
abonosRetiros on cuentas.idCuenta=abonosRetiros.idCuenta where 
cuentas.cuenta=? and abonosRetiros.id=?");

$stmt->bind_param("si",$cuenta,$id);
$texto="";
if($stmt->execute()){

	$stmt->bind_result($nombre,$apellido,$cedula,$cuenta,$abono,$retiro,$monto,$fecha,$us,$id,$idCuenta,$saldoM);
	while($stmt->fetch()){
		$texto.=$nombre."+";
		$texto.=$apellido."+";
		$texto.=$cedula."+";
		$texto.=$cuenta."+";
		if($abono>0){
			$texto.=$abono."+";
			$texto.="abono+";
		}
			if($retiro>0){
			$texto.=$retiro."+";
			$texto.="retiro+";
		}
		$texto.=$monto."+";
		$texto.=$fecha."+";
		$texto.=$us."+";
		$texto.=$id."+";
		$texto.=$idCuenta."+";
		$texto.=$saldoM;

	
		
		
	}
	echo $texto;

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