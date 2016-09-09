<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");
$cedula=$_POST['numero_cedula'];
$cuentaObteni=$_POST['cuenta'];
$query="select Clientes.Apellido, Clientes.Cedula,Clientes.Ciudad,Clientes.CiudadN,
Clientes.Direccion,Clientes.EstadoCivil,Clientes.FechaN,
Clientes.Nacionalidad,Clientes.NumerosDependientes,Clientes.NumerosHijos,Clientes.Ocupacion,
Clientes.Sexo,Clientes.TelefonoCelu,Clientes.TelefonoRe,Clientes.TipoDeIden,Clientes.TipoVivienda,
Clientes.NivelEduca, Clientes.Nombre, cuentas.cuenta, cuentas.monto,libretas.libreta  from Clientes inner join
 cuentas on Clientes.idCliente=cuentas.idCliente inner join
 libretas on cuentas.idCuenta=libretas.idCuenta where Clientes.Cedula='".$cedula."' and cuentas.cuenta='1002".$cuentaObteni."'";
$resultado=mysqli_query($conexion,$query);
$contar=mysqli_num_rows($resultado);
if($contar==1){
echo "1";

}
else{echo "0";}

}
?>
