<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  date_default_timezone_set('America/Tegucigalpa');
  include("../sesion/conexion.php");
  
  $idMovimiento=$_POST['id'];
  $cantidadN=$_POST['cantidadN'];
  $cantidadN=(float)$cantidadN;
  $observacion=$_POST['observacion'];
  $valor_anterior=$_POST['valor_anterior'];
  $reciboID=$_POST['ReciboID'];
  $fecha=date("Y-m-j");

  if($idMovimiento!="" && $cantidadN!="" &&    $observacion!="" && $valor_anterior!=""){
  
  $query="insert into Correcciones(MovimientoID,fecha) values(?,?)";
  $stmt=$conexion->prepare($query);
  $stmt->bind_param("is",$idMovimiento,$fecha);
  if($stmt->execute()){
  $idCorreccion=mysqli_insert_id($conexion);
  $query2="insert into CorreccionesDetalle(correccionesID,valor_anterior,Observacion) values(?,?,?)";
  $stmt2=$conexion->prepare($query2);
  $stmt2->bind_param("ids",$idCorreccion,$valor_anterior,$observacion);
  if($stmt2->execute()){
  
  $stmt3=$conexion->prepare("update ReciboDetalle set valor=? where  reciboID=?");
  $stmt3->bind_param("di",$cantidadN,$reciboID);
  if($stmt3->execute()){
    echo "1";
  }

  }
else{
  echo "error";
}
  }else{
    echo "hubo un error_2";
  }
  }else{
    echo "hubo un error_3";
  }
}else{

    header("location: ../");
  }

?>
