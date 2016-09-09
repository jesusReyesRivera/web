<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");
  $nombre=$_POST['nombre'];
  $apellido=$_POST['apellido'];
  $direccion=$_POST['direccion'];
  $cedula=$_POST['cedula'];
  $Nacionalidad=$_POST['Nacionalidad'];
  $EstadoCivil=$_POST['EstadoCivil'];
  $Nhijos=$_POST['Nhijos'];
  $NDepen=$_POST['NDepen'];
  $NivelEdu=$_POST['NivelEdu'];
  $Ocupacion=$_POST['Ocupacion'];
  $ciudad=$_POST['ciudad'];
  $telefono=$_POST['telefono'];
  $telefonoCelular=$_POST['telefonoCelular'];
  $TipoVivienda=$_POST['TipoVivienda'];
  $codigoCuenta=$_POST['cuenta'];

  $queryIdCliente="select idCliente from cuentas where cuenta='".$codigoCuenta."'";
  $resultado=mysqli_query($conexion,$queryIdCliente);
  if($resultado){
    $idCliente="";
    while($lineas=mysqli_fetch_array($resultado)){
  $idCliente=$lineas['idCliente'];
    }


    if($nombre!="" && $apellido!="" && $direccion!="" && $cedula!="" && $Nacionalidad!="" && $EstadoCivil!="" && $NivelEdu!="" && $Ocupacion!="" && $ciudad!="" && $telefono!="" && $telefonoCelular!="" && $TipoVivienda!=""){
   $query="Update Clientes set Nombre='".$nombre."', Apellido='".$apellido."', Direccion='".$direccion."',Cedula='".$cedula."', Nacionalidad='".$Nacionalidad."', EstadoCivil='".$EstadoCivil."', NumerosHijos=".$Nhijos.", NumerosDependientes=".$NDepen.",NivelEduca='".$NivelEdu."', Ocupacion='".$Ocupacion."',Ciudad='".$ciudad."',TelefonoRe='".$telefono."',TelefonoCelu='".$telefonoCelular."',TipoVivienda='".$TipoVivienda."' where idCliente=".$idCliente;

  if(mysqli_query($conexion,$query)){
  echo "1";
  }
  else
  {
    echo"0-1";
  }


    }
    else
    {
      echo "0-2";
    }
  }else{
  echo  "0-3";
  }


}
else
{
  # code..
  header("location: http://93.188.166.74/web");
}
?>
