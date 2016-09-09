<?php
    include("../sesion/conexion.php");

    $query="select monto, idCuenta from cuentas;";
$texto="";
$resultado=mysqli_query($conexion,$query);
while($linea=mysqli_fetch_array($resultado)){

if($linea['monto']>=150 && $linea['monto']<=1000){
$proceso=$linea['monto']*0.0085;
$saldo=$linea['monto']+$proceso;
   $query="insert into abonosRetiros (idCuenta,abono,retiro,saldos,interes,fecha) values(".$linea['idCuenta'].",0,0,".$saldo.",".$proceso.",'".date('Y/m/j')."')";
mysqli_query($conexion,$query);
$query2="update cuentas set monto=".$saldo." where idCuenta=".$linea['idCuenta'];
mysqli_query($conexion,$query2);
}
else if($linea['monto']>=1001 && $linea['monto']<=10000){
$proceso=$linea['monto']*0.02;
$saldo=$linea['monto']+$proceso;
   $query="insert into abonosRetiros (idCuenta,abono,retiro,saldos,interes,fecha) values(".$linea['idCuenta'].",0,0,".$saldo.",".$proceso.",'".date('Y/m/j')."')";
mysqli_query($conexion,$query);
$query2="update cuentas set monto=".$saldo." where idCuenta=".$linea['idCuenta'];
mysqli_query($conexion,$query2);
}
else if($linea['monto']>=10001 && $linea['monto']<=20000){
$proceso=$linea['monto']*0.025;
$saldo=$linea['monto']+$proceso;
   $query="insert into abonosRetiros (idCuenta,abono,retiro,saldos,interes,fecha) values(".$linea['idCuenta'].",0,0,".$saldo.",".$proceso.",'".date('Y/m/j')."')";
mysqli_query($conexion,$query);
$query2="update cuentas set monto=".$saldo." where idCuenta=".$linea['idCuenta'];
mysqli_query($conexion,$query2);
}
else if($linea['monto']>=20001 && $linea['monto']<=60000){
$proceso=$linea['monto']*0.03;
$saldo=$linea['monto']+$proceso;
   $query="insert into abonosRetiros (idCuenta,abono,retiro,saldos,interes,fecha) values(".$linea['idCuenta'].",0,0,".$saldo.",".$proceso.",'".date('Y/m/j')."')";
mysqli_query($conexion,$query);
$query2="update cuentas set monto=".$saldo." where idCuenta=".$linea['idCuenta'];
mysqli_query($conexion,$query2);
}
else if($linea['monto']>=60001 && $linea['monto']<=120000){
$proceso=$linea['monto']*0.035;
$saldo=$linea['monto']+$proceso;
   $query="insert into abonosRetiros (idCuenta,abono,retiro,saldos,interes,fecha) values(".$linea['idCuenta'].",0,0,".$saldo.",".$proceso.",'".date('Y/m/j')."')";
mysqli_query($conexion,$query);
$query2="update cuentas set monto=".$saldo." where idCuenta=".$linea['idCuenta'];
mysqli_query($conexion,$query2);
}
else if($linea['monto']>=120001 && $linea['monto']<=250000){
$proceso=$linea['monto']*0.04;
$saldo=$linea['monto']+$proceso;
   $query="insert into abonosRetiros (idCuenta,abono,retiro,saldos,interes,fecha) values(".$linea['idCuenta'].",0,0,".$saldo.",".$proceso.",'".date('Y/m/j')."')";
mysqli_query($conexion,$query);
$query2="update cuentas set monto=".$saldo." where idCuenta=".$linea['idCuenta'];
mysqli_query($conexion,$query2);
}
else if($linea['monto']>250000){
$proceso=$linea['monto']*0.045;
$saldo=$linea['monto']+$proceso;
   $query="insert into abonosRetiros (idCuenta,abono,retiro,saldos,interes,fecha) values(".$linea['idCuenta'].",0,0,".$saldo.",".$proceso.",'".date('Y/m/j')."')";
mysqli_query($conexion,$query);
$query2="update cuentas set monto=".$saldo." where idCuenta=".$linea['idCuenta'];
mysqli_query($conexion,$query2);
}


}

?>



