<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  include("../sesion/conexion.php");
date_default_timezone_set('America/Tegucigalpa');
  $RetiroCuenta=$_POST['RetiroCuenta'];
  $RetiroValor=$_POST['RetiroValor'];
  $RetiroLibreta=$_POST['RetiroLibreta'];

  if($RetiroCuenta!="" && $RetiroValor!="" && $RetiroLibreta!=""){
    $query="select Clientes.Nombre, Clientes.Apellido, Clientes.Cedula, cuentas.cuenta, libretas.libreta from cuentas inner join
    libretas on cuentas.idCuenta=libretas.idCuenta inner join 
     Clientes on cuentas.idCliente=Clientes.idCliente
    where cuentas.Cuenta='".$RetiroCuenta."' and libretas.libreta='".$RetiroLibreta."'";
    $resultado=mysqli_query($conexion,$query);
    while($lineas=mysqli_fetch_array($resultado)){
      $texx=$lineas['Nombre']."+";
      $texx.=$lineas['Apellido']."+";
      $texx.=$lineas['Cedula']."+";
 
    }
    $contar=mysqli_num_rows($resultado);
    $monto;
    if($contar==1){
      $query1="select idCuenta, monto from cuentas where cuenta='".$RetiroCuenta."'";
      $resultado2=mysqli_query($conexion,$query1);
      $dato="";
      while($line=mysqli_fetch_array($resultado2)){
        $dato=$line['idCuenta'];
        $monto=$line['monto'];
      }
      $monto=(float)$monto;
      $RetiroValor=(float)$RetiroValor;
      $saldo=$monto-$RetiroValor;
    $query2="insert into abonosRetiros (idCuenta,fecha,abono,retiro,saldos,impreso,idUsuario) values(".$dato.",'".date('Y/m/j')."',0,".$RetiroValor.",".$saldo.",0,".$_SESSION['idUsuario'].")";
    if(mysqli_query($conexion,$query2)){
      $id=mysqli_insert_id($conexion);
      $queryActualizar="update cuentas set monto=".$saldo." where cuenta='".$RetiroCuenta."'";
     if(mysqli_query($conexion,$queryActualizar)){
       $texx.= $_SESSION['rtn']."+";
      $texx.=$_SESSION['nombre']."+";
      $texx.=$id;
         echo "1*".$texx;
        
     }else{  echo "0-0-0";}


    }else{
      echo "0-0".$_SESSION['idUsuario'];
    }
    }
    else{
     echo "0-1";
    }

}
  else{
   echo "0-2";
  }
}
  else
  {
    # code..
    header("location: http://93.188.166.74/web");
  }
?>
