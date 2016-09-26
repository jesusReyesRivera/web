<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
include("../sesion/conexion.php");
date_default_timezone_set('America/Tegucigalpa');
$cuenta=$_POST['cuenta'];
$plazo=$_POST['plazo'];
$interes=$_POST['interes'];
$monto=$_POST['monto'];
$stmt = $conexion->prepare("SELECT Clientes.Nombre, Clientes.Apellido, cuentas.idCuenta FROM cuentas inner join Clientes on Clientes.idCliente = cuentas.idCliente where cuentas.cuenta=?");
$stmt->bind_param('s', $cuenta);
if($stmt->execute()){
$idC="";
$nombreS="";
 $stmt->bind_result($nombre,$apellido,$idCuenta);
  while ($stmt->fetch()) {
    $idC=$idCuenta;
    $nombreS=$nombre+" "+$apellido;
  } 
  $stmt2=$conexion->prepare("INSERT into DePlaFi (idCuenta,estado,fechaA,plazo) values(?,?,?,?)");
   $stmt2->bind_param('issd', $idC,$estado,$fecha,$plazo);
$fecha=date('Y/m/j');
$estado="1";

if($stmt2->execute()){
$idDAF = mysqli_insert_id($conexion);
 $stmt3=$conexion->prepare("INSERT into recibos (fecha,estado) values(?,?)");
$stmt3->bind_param('ss', $fecha,$estado);

if($stmt3->execute()){
$idRecibo = mysqli_insert_id($conexion);
 $stmt4=$conexion->prepare("INSERT into ReciboDetalle (valor,ReciboID) values(?,?)");
$stmt4->bind_param('di',$monto,$idRecibo);

if($stmt4->execute()){
   $stmt5=$conexion->prepare("INSERT into DePlaFiDetalle (DepositoID,ReciboID) values(?,?)");
$stmt5->bind_param('ii',$idDAF,$idRecibo);

if($stmt5->execute()){
        $sumar="+".$plazo." day";
        $fechaInicial=date('j-m-Y');
$nuevafecha = strtotime ( $sumar , strtotime ( $fechaInicial ) ) ;
$nuevafecha = date ( 'j-m-Y' , $nuevafecha );
$cal=(float)$interes*(float)100;
  echo '
<!doctype html>
<html>
<meta charset="utf-8">
<head>
<style type="text/css">
div.relative{
position: absolute;
left: 1000px;

}
p.absolute{
position: absolute;
left: 150px;
text-align: justify;
font-size: 24px;
width: 800px
}

h3.right{
position: absolute;
left: 250px;
text-align: justify;
font-size: 18px
}
h3.left{
position: absolute;
left: 750px;
text-align: justify;
font-size: 18px;
}

u.pos{
size: 400px
}
p.absolute_parrafo_2{
position: absolute;
left: 200px;
text-align: justify;
font-size: 24px;
width: 900px
}


</style>
</head>
<body>
              <div class="relative"><h2>No<u>'.$idDAF.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></h2></div><br><br>
  <center><h1><strong>CERTIFICADO DE DEPOSITO A PLAZO FIJO</strong></h1>
  <br>
<h2><strong>ENTIDAD DE AHORRO Y CREDITO</strong></h2>
<br>
<h3>
RTN 10029016845078
</h3>

<h3 class="right">NO NEGOCIABLE</h3><h3 class="left"> CUENTA A PLAZO FIJO</h3></center><br><br>
<p class="absolute">ESTA ENTIDAD DE AHORRO Y CREDITO CERTIFICA: Que en esta fecha ha abonado a favor de <u>'.$nombreS.'</u>
En cuenta de DEPOSITO A PLAZO FIJO la suma de <u>'.number_format($monto,2).'</u>Lempiras que devengará el interés del  <u>'.$cal.'</u> por ciento anual, por un plazo de  <u>'.$plazo.'</u> dias que vencerá el <u>'.$nuevafecha.'</u> prorrogado por tiempos iguales.</p><br><br><br><br><br><br><Br><br><br><br>
<p class="absolute_parrafo_2">
ESTE DEPOSITO ESTA SUJETO A LAS CONDICIONES SIGUIENTES
</p>
<br><br><br>
<table style="position: absolute; left: 100px">
<tr>
<td style="position: abosulte; width: 900px; text-align: justify; font-size: 24px">
<ol>
<li>Es pagadero el día de su vencimiento o el de sus prorrogas mediante la entrega de este certificado.<br>

<li>Si este certificado no fuera presentado para su cancelación a la fecha de su vencimiento automáticamente se prorrogará el plazo por periodos iguales a la tasa de interés vigente establecida en la tabla de intereses a plazo fijo el depositante cuenta con quince días posteriores a la fecha de vencimiento para su cancelación, lapso durante el cual no devengara intereses.<br>

<li> Los intereses devengados por el presente certificado se pagarán de forma y frecuencia siguiente<br>
</ol>
</td>
</tr>
</table>
<div style="position: relative; top: 400px">
<h3 class="right"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;</u></h3><h3 class="left"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;</u></h3><br>
<h3 class="right">FIRMA AUTORIZADA</h3><h3 class="left">LUGAR Y FECHA</h3>
</div>





  </body>
</html>
  ';
}else{
  echo "0-4";
}
}else{
    echo "0-3";
}
}else{
  echo "0-2";
}
}
else{
  echo "0-1";
}
}else{
  echo "0-0";
}


}
    else
  {
    # code..
    header("location: ../");
  }
?>