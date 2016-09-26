<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
date_default_timezone_get('America/Tegucigalpa');
      include("../sesion/conexion.php");
  ?>
  <!doctype html>
  <html>
 <head>
          <link href="../estilos/estilos.css" rel="stylesheet">
<nav class="navbar navbar-inverse  navbar-fixed-top" style="background: #08298A;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img style="border-radius: 5px; width: 70px; height: 30px" src="../ia.png"></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li  class="dropdown"><a id="test" class="dropdown-toggle" data-toggle="dropdown" href="#"> Bienvenido, 
        <?php
        echo $_SESSION["username"] ?>
         <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../sesion/salir.php">Salir</a></li>

          </ul>
        </li>
         <li><a href="index.php">volver</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </nav>
      <script src="../js/jquery.min.js"></script>
   <script src="../js/bootstrap.js"></script>
    <script src="../js/funciones-random.js"></script>
 </head>
    <body style="  background: url('../imagenF.jpg'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; padding-top: 70px;">
 
  <div class="container">
      <div class="panel panel-info">
    <div class="panel-heading">
   Reporte de Cierre
    </div>
    <div class="panel-body">
      <?php
  $estado="";
  $stmtV=$conexion->prepare("select count(*), estado from cierreUsuario where Fecha=? and idUsuario=?");
  $stmtV->bind_param('si',date("Y-m-j"),$_SESSION['idUsuario']);
  $stmtV->execute();
  $stmtV->bind_result($filas,$estado);
  while($stmtV->fetch()){
    $estado.=$estado;
    $num=$filas;
  }


      if($estado==""){
                       $restar="-1 day";
        $fechaInicial=date('Y-m-j');
$nuevafecha = strtotime (  $restar , strtotime ( $fechaInicial ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

        $dia_anterior=$conexion->prepare("select count(*), sum(if(movimientos.MovID=1, ReciboDetalle.valor, 0)) as 'Abono',
 sum(if(movimientos.MovID=2, ReciboDetalle.valor, 0)) as 'Retiro'
 from movimientos  
 join  cuentas   on cuentas.idCuenta = movimientos.idCuenta
 join  Clientes on  cuentas.idCliente=Clientes.idCliente
 join MovimientoDetalle on movimientos.MovimientoID = MovimientoDetalle.MovimientoID 
 join ReciboDetalle on ReciboDetalle.ReciboID = MovimientoDetalle.ReciboID 
  where movimientos.Fecha=? and movimientos.idUsuario=?");
        $dia_anterior->bind_param("si",$nuevafecha,$_SESSION['idUsuario']);
        $dia_anterior->execute();
        $dia_anterior->bind_result($filas,$Abonos_dA,$Retiros_dA);
        while($dia_anterior->fetch()){
              $filas_=$filas;
              $Abonos_dA_=$Abonos_dA;
              $Retiros_dA_=$Retiros_dA;
        }

                $diaA_cierre=$conexion->prepare("select cierreDetalle.Egresos, cierreDetalle.Ingresos from cierre join cierreDetalle on cierre.CierreID = cierreDetalle.CierreID where cierre.idUsuario=? and cierre.Fecha=?");
        $diaA_cierre->bind_param("is",$_SESSION['idUsuario'],$nuevafecha);
        $diaA_cierre->execute();
        $diaA_cierre->bind_result($Egresos,$Ingresos);
        while($diaA_cierre->fetch()){
              $Egresos_=$Egresos;
              $Ingresos_=$Ingresos;
        } 




        $total_Ingresos=$Abonos_dA_+$Egresos_;
        $total_Egresos=$Retiros_dA_+$Ingresos_;


        echo "<div class='table-responsive'><table class='table'><thead><th colspan='2'>Cierre dia :".$nuevafecha."</th></thead><thead>
        <th>Ingresos</th><th>Egresos</th><thead/><tbody><tr><td>".$total_Ingresos."</td><td>".$total_Egresos."</td></tr></tbody></table></div>";



          $totalMovimientosAbono=0;
          $totalMovimientosRetiro=0;

          $Movimientos=$conexion->prepare("select cuentas.cuenta,
 if(movimientos.MovID=1, ReciboDetalle.valor, '-') as 'Abono',
 if(movimientos.MovID=2, ReciboDetalle.valor, '-') as 'Retiro'
 from cuentas  join Clientes on cuentas.idCliente=Clientes.idCliente
 join movimientos on cuentas.idCuenta = movimientos.idCuenta join
MovimientoDetalle on movimientos.MovimientoID = MovimientoDetalle.MovimientoID join
ReciboDetalle on ReciboDetalle.ReciboID = MovimientoDetalle.ReciboID where movimientos.Fecha=? and movimientos.idUsuario=?");

          $Movimientos->bind_param("si",date("Y-m-j"),$_SESSION['idUsuario']);
          $Movimientos->execute();
          $Movimientos->bind_result($cuentas,$Abono,$Retiro);
$mov.="<br><br><div class='table-responsive'><table class='table'><thead><th colspan=3>Movimientos dia: ".date("j-m-Y")."</th></thead><thead><th>Cuenta</th><th>Abonos</th><th>Retiros</th></thead><tbody>";
          while($Movimientos->fetch()){
         $mov.="<Tr><td>".$cuentas."</td><td>".$Abono."</td><td>".$Retiro."</td></tr>";
         $totalMovimientosAbono+=$Abono;
           $totalMovimientosRetiro+=$Retiro;
          }
          echo $mov."</tbody></table></div>";








          $cuentas=$conexion->prepare("select monto, cuenta from cuentas where cfecha=? and idUsuario=?");

          $cuentas->bind_param("si",date("Y-m-j"),$_SESSION['idUsuario']);
          $cuentas->execute();
          $cuentas->bind_result($monto,$cuenta);
$cc.="<br><br><div class='table-responsive'><table class='table'><thead><th colspan=2>Cuentas creadas dia: ".date("j-m-Y")."</th></thead><thead><th>Cuenta</th><th>Monto</th></thead><tbody>";
          while($cuentas->fetch()){
         $cc.="<Tr><td>".$cuenta."</td><td>".$monto."</td></tr>";
         $totalMovimientosAbono+=$monto;
          }
          echo $cc.'</tbody></table></div><br><br>
<table class="table"><tbody>
          <tr><td><label>Pagos de servicios</label>  <input type="text" onkeypress="return notext(event)" id="PagosServicios" class="form-control"></td>
         
             
           <td>  <label>Pago de remesas</label>    <input type="text" onkeypress="return notext(event)" id="PagosRemesas" class="form-control"></td></tr>
           <tr><td>
           <label>Total Ingresos:</label><label class="total">'.$totalMovimientosAbono.'</label>
             
           </td><td>  <label>Total Egresos:</label><label class="total_remesas">'.$totalMovimientosRetiro.'</label></td></tr>
         </tbody></table>

          </div><div class="panel-footer"><input type="button" id="AgregarCierre" class="btn btn-info" value="Agregar Cierre">
          <script>
          var totalIngreso='.$totalMovimientosAbono.';
          var totalEgreso='.$totalMovimientosRetiro.';
          var total=0;
          var totalRetiros=0;
          $("#PagosServicios").keyup(function(){
            if($("#PagosServicios").val()!=""){
               total=parseFloat($("#PagosServicios").val())+parseFloat(totalIngreso);
            }else {
              total=parseFloat(totalIngreso);
            }
              $(".total").html(total);
           
          });
              $("#PagosRemesas").keyup(function(){
            if($("#PagosRemesas").val()!=""){
               totalRetiros=parseFloat($("#PagosRemesas").val())+parseFloat(totalEgreso);
            }else {
              totalRetiros=parseFloat(totalEgreso);
            }
              $(".total_remesas").html(totalRetiros);
           
          });


          $("#AgregarCierre").click(function(){
            $("#AgregarCierre").prop("disabled","true");
          if($("#PagosServicios").val()!="" && $("#PagosRemesas").val()!=""){
  $.ajax({
            type: "POST",
             url: "../agregarDatos/AgregarCierre.php",
             data: {
              r: $("#PagosRemesas").val(),
              a: $("#PagosServicios").val()
             },
                success: function(res){
               if(res=="1"){
                alert("Cierre hecho");
                 location.reload();

               }
               $("#PagosRemesas").val("");
               $("#PagosServicios").val("");
                $(".total").html("");
                 $(".total_remesas").html("");
                 $("#AgregarCierre").prop("disabled",false);

          },
           error : function(xhr, status) {
        alert("Disculpe, existió un problema");
        $("#AgregarCierre").prop("disabled",false);
    }
          });
          }else{
            alert("datos en blanco");
            $("#AgregarCierre").prop("disabled",false);
          }

          });



        

          </script>
          </div></div>';



      }
      else{



        $cierre=$conexion->prepare("select count(*), sum(if(movimientos.MovID=1, ReciboDetalle.valor, 0)) as 'Abono',
 sum(if(movimientos.MovID=2, ReciboDetalle.valor, 0)) as 'Retiro'
 from movimientos  
 join  cuentas   on cuentas.idCuenta = movimientos.idCuenta
 join  Clientes on  cuentas.idCliente=Clientes.idCliente
 join MovimientoDetalle on movimientos.MovimientoID = MovimientoDetalle.MovimientoID 
 join ReciboDetalle on ReciboDetalle.ReciboID = MovimientoDetalle.ReciboID 
  where movimientos.Fecha=? and movimientos.idUsuario=?");
        $cierre->bind_param("si",date("Y-m-j"),$_SESSION['idUsuario']);
        $cierre->execute();
        $cierre->bind_result($filas,$Abonos_d,$Retiros_d);
        while($cierre->fetch()){
              $filas_=$filas;
              $Abonos_dA_=$Abonos_d;
              $Retiros_dA_=$Retiros_d;
        }

                $dia_cierre=$conexion->prepare("select sum(cierreDetalle.Egresos), sum(cierreDetalle.Ingresos) from cierre join cierreDetalle on cierre.CierreID = cierreDetalle.CierreID where cierre.idUsuario=? and cierre.Fecha=?");
        $dia_cierre->bind_param("is",$_SESSION['idUsuario'],date("Y-m-j"));
        $dia_cierre->execute();
        $dia_cierre->bind_result($Egresos,$Ingresos);
        while($dia_cierre->fetch()){
              $Egresos_=$Egresos;
              $Ingresos_=$Ingresos;
        } 
$montod_=0;
        $cuenta_monto=$conexion->prepare("select sum(monto) from cuentas where cuentas.idUsuario=? and cuentas.cfecha=?");
          $cuenta_monto->bind_param("is",$_SESSION['idUsuario'],date("Y-m-j"));
        $cuenta_monto->execute();
        $cuenta_monto->bind_result($monto_a);
        while($cuenta_monto->fetch()){
              $montod_+=$monto_a;
        }




        $total_Ingresos=$Abonos_dA_+$Ingresos_+$montod_;
        $total_Egresos=$Retiros_dA_+$Egresos_;



        echo "<div class='table-responsive'><table class='table'><thead><th colspan='2'>Cierre dia :".date("j-m-Y")."</th></thead><thead>
        <th>Ingresos</th><th>Egresos</th><thead/><tbody><tr><td>".$total_Ingresos."</td><td>".$total_Egresos."</td></tr></tbody></table></div>";

  
      }



      ?>


    </body>
  </html>

  <?php
}else{
    header("location: ../");
}
?>