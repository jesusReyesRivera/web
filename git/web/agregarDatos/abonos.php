<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  date_default_timezone_set('America/Tegucigalpa');
  include("../sesion/conexion.php");
  $AbonoCuenta=$_POST['AbonoCuenta'];
  $AbonoValor=$_POST['AbonoValor'];
  $AbonoLibreta=$_POST['AbonoLibreta'];
  if($AbonoCuenta!="" && $AbonoValor!="" && $AbonoLibreta!=""){
    $query="select Clientes.Nombre, Clientes.Apellido, Clientes.Cedula, cuentas.cuenta, libretas.libreta from cuentas inner join libretas on cuentas.idCuenta=libretas.idCuenta inner join Clientes on cuentas.idCliente=Clientes.idCliente where cuentas.Cuenta='".$AbonoCuenta."' and libretas.libreta='".$AbonoLibreta."'";
    $resultado=mysqli_query($conexion,$query);
    $contar=mysqli_num_rows($resultado);
    while($lineas=mysqli_fetch_array($resultado)){
      $texx=$lineas['Nombre']."+";
      $texx.=$lineas['Apellido']."+";
      $texx.=$lineas['Cedula']."+";
    }
    $monto=0;
    if($contar==1){
      $query1="select idCuenta, monto from cuentas where cuenta='".$AbonoCuenta."'";
      $resultado2=mysqli_query($conexion,$query1);
      $dato="";
      while($line=mysqli_fetch_array($resultado2)){
        $dato=$line['idCuenta'];
        $monto=$line['monto'];
      }
      $saldos=$monto+$AbonoValor;
    $query2="insert into abonosRetiros (idCuenta,fecha,abono,retiro,saldos,impreso,idUsuario) values(".$dato.",'".date('Y/m/j')."',".$AbonoValor.",0,".$saldos.",0,".$_SESSION['idUsuario'].")";
    if(mysqli_query($conexion,$query2)){
      $id=mysqli_insert_id($conexion);

    $queryActualizar="update cuentas set monto=".$saldos."  where cuenta='".$AbonoCuenta."'";
    if(mysqli_query($conexion,$queryActualizar)){
       $texx.= $_SESSION['rtn']."+";
      $texx.=$_SESSION['nombre']."+";
      $texx.=$id;
      echo "1*".$texx;
    }else{
      echo "0-1";
    }


    }else{
      echo "0-2";
    }
    }
    else{
     echo "0-3";
    }

}
  else{
   echo "0-4";
  }
}
  else
  {
    # code..
    header("location: http://93.188.166.74/web");
  }
?>
