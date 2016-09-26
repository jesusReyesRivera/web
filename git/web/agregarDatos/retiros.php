<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");
date_default_timezone_set('America/Tegucigalpa');
  $RetiroCuenta=$_POST['RetiroCuenta'];
  $RetiroValor=$_POST['RetiroValor'];
  $RetiroLibreta=$_POST['RetiroLibreta'];

  if($RetiroCuenta!="" && $RetiroValor!="" && $RetiroLibreta!=""){
    $query="select Clientes.Nombre, Clientes.Apellido, Clientes.Cedula,cuentas.idCuenta from cuentas inner join
    libretas on cuentas.idCuenta=libretas.idCuenta inner join 
     Clientes on cuentas.idCliente=Clientes.idCliente
    where cuentas.Cuenta=? and libretas.libreta=?";

    $stmt=$conexion->prepare($query);
    $stmt->bind_param("ss",$RetiroCuenta,$RetiroLibreta);
    if($stmt->execute()){
      $stmt->bind_result($nombre,$apellido,$cedula,$idCuenta);
       while($stmt->fetch()){
      $texx=$nombre."+";
      $texx.=$apellido."+";
      $texx.=$cedula."+";
      $CuentaID=$idCuenta;

    }

      $estado="0";
      $observacion="Retiro de dinero de la cuenta#".$RetiroCuenta;


    $query_AgMov="insert into movimientos(idCuenta,Fecha,idUsuario,MovID) values(?,?,?,?)";
    $stmt_Agregar_Movimiento=$conexion->prepare($query_AgMov);
    $tipo=2;
    $stmt_Agregar_Movimiento->bind_param("isii",$CuentaID,date('Y/m/j'),$_SESSION['idUsuario'],$tipo);
    if($stmt_Agregar_Movimiento->execute()){
      $MovimientoID=mysqli_insert_id($conexion);
      $query_AgRecibo="insert into recibos (fecha,estado,observacion) values(?,?,?)";
      $stmt_Agregar_Recibo=$conexion->prepare($query_AgRecibo);
      $stmt_Agregar_Recibo->bind_param("sss",date('Y/m/j'),$estado,$observacion);
      $stmt_Agregar_Recibo->execute();
      $ReciboID=mysqli_insert_id($conexion);
      $query_AgReciboDeta="insert into ReciboDetalle (valor,ReciboID) values(?,?)";
      $stmt_Agregar_ReciboDetalle=$conexion->prepare($query_AgReciboDeta);
      $stmt_Agregar_ReciboDetalle->bind_param("di",$RetiroValor,$ReciboID);
      $stmt_Agregar_ReciboDetalle->execute();
      $query_AgMovDeta="insert into MovimientoDetalle (MovimientoID,ReciboID) values(?,?)";
      $stmt_Agregar_MovDetalle=$conexion->prepare($query_AgMovDeta);
      $stmt_Agregar_MovDetalle->bind_param("ii",$MovimientoID,$ReciboID);
      $stmt_Agregar_MovDetalle->execute();


       $texx.= $_SESSION['rtn']."+";
      $texx.=$_SESSION['nombre']."+";
      $texx.=$MovimientoID;
         echo "1*".$texx;
}else{
      echo "0-0";
    }

    }
    else{
       echo "0-0";
    }
    }
    else{
       echo "0-0";
    }
}
  else
  {
    # code..
    header("location: ../");
  }

?>
