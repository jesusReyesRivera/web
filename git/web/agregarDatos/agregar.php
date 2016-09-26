<?php
session_start();
date_default_timezone_set('America/Tegucigalpa');
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");
  $nombre=$_POST['nombre'];
  $apellido=$_POST['apellido'];
  $direccion=$_POST['direccion'];
  $cedula=$_POST['cedula'];
  $CodCuenta="1002";
  $CodCuenta.=$_POST['codigo'];
  $monto=$_POST['monto'];
  $edad=$_POST['edad'];
  $Nacionalidad=$_POST['Nacionalidad'];
  $CiudadN=$_POST['CiudadN'];
  $tipoDeSexo=$_POST['tipoDeSexo'];
  $EstadoCivil=$_POST['EstadoCivil'];
  $Nhijos=$_POST['Nhijos'];
  $NDepen=$_POST['NDepen'];
  $NivelEdu=$_POST['NivelEdu'];
  $Ocupacion=$_POST['Ocupacion'];
  $ciudad=$_POST['ciudad'];
  $telefono=$_POST['telefono'];
  $telefonoCelular=$_POST['telefonoCelular'];
  $TipoVivienda=$_POST['TipoVivienda'];
  $monedaID=$_POST['moneda'];
  $beneficiarios=$_POST['C_B'];


  $rows=explode("/", $beneficiarios);



  if($nombre!="" && $apellido!="" && $direccion!="" && $cedula!="" && $CodCuenta!="" && $monto!="" && $edad!="" && $Nacionalidad!="" && $CiudadN!="" && $tipoDeSexo!="" && $EstadoCivil!="" && $NivelEdu!="" && $Ocupacion!="" && $ciudad!="" && $telefono!="" && $telefonoCelular!="" && $TipoVivienda!=""){

 $query="insert into Clientes (Nombre,Apellido,Direccion,Cedula,FechaN,fechaIngreso,Nacionalidad,CiudadN,Sexo,EstadoCivil,NumerosHijos,NumerosDependientes,NivelEduca,Ocupacion,Ciudad,TelefonoRe,TelefonoCelu,TipoVivienda,TipoMonedaID) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

 $stmt=$conexion->prepare($query);
 $stmt->bind_param('ssssssssssiissssssi',$nombre,$apellido,$direccion,$cedula,$edad,date('Y/m/j'),$Nacionalidad,$CiudadN,$tipoDeSexo,$EstadoCivil,$Nhijos,$NDepen,$NivelEdu,$Ocupacion,$ciudad,$telefono,$telefonoCelular,$TipoVivienda,$monedaID);

if($stmt->execute()){
  $id = mysqli_insert_id($conexion);
   $query3="insert into cuentas (idCliente,cuenta,monto,Cfecha,idUsuario) values(?,?,?,?,?)";

 $stmt2=$conexion->prepare($query3);
 $stmt2->bind_param('isdsi',$id,$CodCuenta,$monto,date('Y/m/j'),$_SESSION['idUsuario']);
 $stmt2->execute();

    $idCuenta=mysqli_insert_id($conexion);
    $libretaCodigo="1001-";
    $libretaCodigo.=$idCuenta;
      $query5="insert into libretas (idCuenta,libreta,fecha) values(".$idCuenta.",'".$libretaCodigo."','".date('Y/m/j')."')";
       if(mysqli_query($conexion,$query5)){




        $stmtBeneficiarios=$conexion->prepare("insert into beneficiarios(Nombre,Apellido,Direccion,porcentaje,idCliente) values(?,?,?,?,?)");

        for($i=0;$i<count($rows);$i++){
          $datos=explode("+", $rows[$i]);
          $stmtBeneficiarios->bind_param("sssii",$datos[0],$datos[1],$datos[2],$datos[3],$id);
          $stmtBeneficiarios->execute();
        }

         echo  "1*".$CodCuenta."*".$libretaCodigo;
         mysqli_close();
       }

  mysqli_close($conexion);
}
else
{
  echo"0";
}

}

else
{
  echo"0";
}




}
else
{
  # code..
  header("location: ../");
}
?>
