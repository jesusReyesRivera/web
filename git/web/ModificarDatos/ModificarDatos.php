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
  $DatosBeneficiarios=$_POST['DatosBeneficiarios'];
  $actu_cantidad=$_POST['actu_cantidad'];
  $ids=$_POST['ids'];


  
  $stmtidCliente=$conexion->prepare("select idCliente from cuentas where cuenta=?");
  $stmtidCliente->bind_param("s",$codigoCuenta);


  if($stmtidCliente->execute()){
    $idCliente="";
    $stmtidCliente->bind_result($id);
    while($stmtidCliente->fetch()){
  $idCliente=$id;
    }


    if($nombre!="" && $apellido!="" && $direccion!="" && $cedula!="" && $Nacionalidad!="" && $EstadoCivil!="" && $NivelEdu!="" && $Ocupacion!="" && $ciudad!="" && $telefono!="" && $telefonoCelular!="" && $TipoVivienda!=""){


   /*$query="Update Clientes set Nombre='".$nombre."', Apellido='".$apellido."', Direccion='".$direccion."',Cedula='".$cedula."', Nacionalidad='".$Nacionalidad."', EstadoCivil='".$EstadoCivil."', NumerosHijos=".$Nhijos.", NumerosDependientes=".$NDepen.",NivelEduca='".$NivelEdu."', Ocupacion='".$Ocupacion."',Ciudad='".$ciudad."',TelefonoRe='".$telefono."',TelefonoCelu='".$telefonoCelular."',TipoVivienda='".$TipoVivienda."' where idCliente=".$idCliente;*/

   $query="Update Clientes set Nombre=?, Apellido=?, Direccion=?, Cedula=?, Nacionalidad=?, EstadoCivil=?, NumerosHijos=?, NumerosDependientes=?, NivelEduca=?, Ocupacion=?, Ciudad=?, TelefonoRe=?, TelefonoCelu=?, TipoVivienda=? where idCliente=?";

   $stmtActualizarCliente=$conexion->prepare($query);
   $stmtActualizarCliente->bind_param('ssssssiissssssi',$nombre,$apellido,$direccion,$cedula,$Nacionalidad,$EstadoCivil,$Nhijos,$NDepen,$NivelEdu,$Ocupacion,$ciudad,$telefono,$telefonoCelular,$TipoVivienda,$idCliente);


  if($stmtActualizarCliente->execute()){

  $rows=explode("/",$DatosBeneficiarios);
  $obtener_ids_b=explode("+", $ids);


  $stmtActualizarBeneficiarios=$conexion->prepare("update beneficiarios set Nombre=?, Apellido=?, Direccion=?, porcentaje=? where BID=?");

  for($i=0;$i<$actu_cantidad;$i++){
    $columnas=explode("+", $rows[$i]);

    $stmtActualizarBeneficiarios->bind_param("sssii",$columnas[0],$columnas[1],$columnas[2],$columnas[3],$obtener_ids_b[$i]);
    $stmtActualizarBeneficiarios->execute();
  }

  $stmtInsertarBeneficiarios=$conexion->prepare("insert into beneficiarios (Nombre,Apellido,Direccion,porcentaje,idCliente) values(?,?,?,?,?)");
    for($i=$actu_cantidad; $i<count($rows);$i++){
    $columnas=explode("+", $rows[$i]);
    $stmtInsertarBeneficiarios->bind_param("sssii",$columnas[0],$columnas[1],$columnas[2],$columnas[3],$idCliente);
   $stmtInsertarBeneficiarios->execute();
  }


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
