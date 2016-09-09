<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");
$cedula=$_POST['numero_cedula'];
$cuentaObteni=$_POST['cuenta'];
$idCliente="";
$query="select Clientes.idCliente, TipoMoneda.tipo, Clientes.Apellido, Clientes.Cedula,Clientes.Ciudad,Clientes.CiudadN,
Clientes.Direccion,Clientes.EstadoCivil,Clientes.FechaN,
Clientes.Nacionalidad,Clientes.NumerosDependientes,Clientes.NumerosHijos,Clientes.Ocupacion,
Clientes.Sexo,Clientes.TelefonoCelu,Clientes.TelefonoRe,Clientes.TipoVivienda,
Clientes.NivelEduca, Clientes.Nombre, cuentas.cuenta, cuentas.monto,libretas.libreta  from Clientes inner join
 cuentas on Clientes.idCliente=cuentas.idCliente inner join
 libretas on cuentas.idCuenta=libretas.idCuenta inner join 
TipoMoneda on Clientes.TipoMonedaID = TipoMoneda.TipoMonedaID where Clientes.Cedula='".$cedula."' and cuentas.cuenta='1002".$cuentaObteni."'";
$resultado=mysqli_query($conexion,$query);
$contar=mysqli_num_rows($resultado);
if($contar==1){
  $informacion="";
  $idCliente="";
while($linea=mysqli_fetch_array($resultado)){
$informacion.=$linea['Nombre']."<>";
$informacion.=$linea['Apellido']."<>";
$informacion.=$linea['Direccion']."<>";
$informacion.=$linea['Cedula']."<>";
$informacion.=$linea['FechaN']."<>";
$informacion.=$linea['cuenta']."<>";
$informacion.=$linea['monto']."<>";
$informacion.=$linea['libreta']."<>";
$informacion.=$linea['Nacionalidad']."<>";
$informacion.=$linea['CiudadN']."<>";
$informacion.=$linea['Sexo']."<>";
$informacion.=$linea['EstadoCivil']."<>";
$informacion.=$linea['NumerosHijos']."<>";
$informacion.=$linea['NumerosDependientes']."<>";
$informacion.=$linea['NivelEduca']."<>";
$informacion.=$linea['Ocupacion']."<>";
$informacion.=$linea['Ciudad']."<>";
$informacion.=$linea['TelefonoRe']."<>";
$informacion.=$linea['TelefonoCelu']."<>";
$informacion.=$linea['TipoVivienda']."<>";
$informacion.=$linea['tipo']."<>";
$idCliente=$linea['idCliente'];


}

$stmt=$conexion->prepare("select beneficiarios.Nombre, beneficiarios.Apellido, beneficiarios.Direccion, 
beneficiarios.porcentaje
from beneficiarios inner join
 Clientes on Clientes.idCliente=beneficiarios.idCliente
  where  Clientes.idCliente=?");
  $stmt->bind_param("i",$idCliente);
  $stmt->execute();
  $stmt->bind_result($nombre,$apellido,$Direccion,$porcentaje);
$contador=0;
  while ($stmt->fetch()) {
  	$texto.="<tr><td contenteditable='true'>".$nombre."</td><td contenteditable='true'>".$apellido."</td><td contenteditable='true'>".$Direccion."</td><td contenteditable='true'  onkeypress='return notext_bn(event,this)'>".$porcentaje.'</td></tr>';
    $contador++;
  }

  $texto.=' <tr class="hide">
   <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true" onkeypress="return notext_bn(event,this)"></td>
    <td><input value="-" type="button" id="eliminar" class="removerfila btn btn-danger"></td>
  </tr>
  <script>
$(".removerfila").click(function(){
  $(this).parents("tr").detach();
});
</script>
  ';

echo $informacion.$texto;
}
else{echo "0";}

}
?>
