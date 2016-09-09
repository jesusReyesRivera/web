<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  date_default_timezone_set('America/Tegucigalpa');
  include("../sesion/conexion.php");
  $idcuenta=$_POST['idcuenta'];
  $idMovimiento=$_POST['id'];
  $cantidadN=$_POST['cantidadN'];
  $cantidadN=(float)$cantidadN;
  $cantidadV=$_POST['cantidadV'];
   $saldoA=$_POST['saldoA'];
  $saldoM=$_POST['saldoM'];
  $tipo=$_POST['tipo'];
  $fecha=date('Y/m/j');
  $observacion=$_POST['observacion'];


  if($idcuenta!="" && $idMovimiento!="" &&   $cantidadN!="" && $tipo!="" && $observacion!=""){
  
  $query="insert into Correcciones(idCuenta,fecha) values(?,?)";
  $stmt=$conexion->prepare($query);
  $stmt->bind_param("is",$idcuenta,$fecha);
  if($stmt->execute()){
  $idCorreccion=mysqli_insert_id($conexion);
  $query2="insert into CorreccionesDetalle(correccionesID,MovimientosID,cantidadA,tipoM) values(?,?,?,?)";
  $stmt2=$conexion->prepare($query2);
  $stmt2->bind_param("iids",$idCorreccion,$idMovimiento,$cantidadN,$tipo);
  $actualizar="";
   $saldoModificado=0;
   $saldoModificadoTotal=0;
 
  if($stmt2->execute()){
   if($tipo=="abonada"){
    $saldoModificado=(float)$saldoM-(float)$cantidadV;
    $saldoModificado=(float)$saldoModificado+(float)$cantidadN;

    $saldoModificadoTotal=(float)$saldoA-(float)$cantidadV;
    $saldoModificadoTotal=(float)$saldoModificadoTotal+(float)$cantidadN;
   $actualizar="update abonosRetiros set abono=?, saldos=?, observacion=? where id=?";
   

   }
      if($tipo=="retirada"){
    $saldoModificado=(float)$saldoM+(float)$cantidadV;
    $saldoModificado=(float)$saldoModificado-(float)$cantidadN;

    $saldoModificadoTotal=(float)$saldoA+(float)$cantidadV;
    $saldoModificadoTotal=(float)$saldoModificadoTotal-(float)$cantidadN;
       $actualizar="update abonosRetiros set retiro=?, saldos=?, observacion=? where id=?";
       
     
   }

   $actualizarM=$conexion->prepare($actualizar);
 $actualizarM->bind_param('ddsi',$cantidadN,$saldoModificado,$observacion,$idMovimiento);

   if($actualizarM->execute()){


    $queryDatos="SELECT abono, retiro, interes, id FROM abonosRetiros where id>? and idCuenta=?";
  $actualizarDatosSiguientes=$conexion->prepare($queryDatos);
  $actualizarDatosSiguientes->bind_param("ii",$idMovimiento,$idcuenta);
  $obtenerSaldo="";
  $obtenetID="";
  if($actualizarDatosSiguientes->execute()){


     $actualizarDatosSiguientes->bind_result($cantidadA,$cantidadR,$interes,$id);
       $queryA="";
             
     while($actualizarDatosSiguientes->fetch()){
      
      if($cantidadA>0){
       $saldoModificado=(float)$saldoModificado+(float)$cantidadA;
       $obtenerSaldo.=$saldoModificado."+";
       $obtenetID.=$id."+";

      }
       if($cantidadR>0){
        $saldoModificado=(float)$saldoModificado-(float)$cantidadR;
         $obtenerSaldo.=$saldoModificado."+";
       $obtenetID.=$id."+";
      }

      if($interes!=""){
           $saldoModificado=(float)$saldoModificado+(float)$interes;
         $obtenerSaldo.=$saldoModificado."+";
       $obtenetID.=$id."+";
      }
      $cont++;
     }
     $saldos=explode("+",$obtenerSaldo);
     $ids=explode("+", $obtenetID);

     for($i=0;$i<$cont;$i++){
      $que="UPDATE abonosRetiros set saldos=? where id=?";
     $guardar=$conexion->prepare($que);
     $guardar->bind_param("di",$saldos[$i],$ids[$i]);
     $guardar->execute();


     }
     $actualizarMontoCUentas="update cuentas set monto=? where idCuenta=?";
$actualizarMontoCUenta=$conexion->prepare($actualizarMontoCUentas);
$actualizarMontoCUenta->bind_param("di",$saldoModificado,$idcuenta);
if($actualizarMontoCUenta->execute()){
  echo "1";
   }else{
    echo "hubo un error_1";
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


}
  else{
   echo "0-4";
  }
}
  else
  {
    echo "0-5";
   
  }
}else{

    header("location: http://93.188.166.74/web");
  }

?>
