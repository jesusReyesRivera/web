<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
include("../sesion/conexion.php");
  $codigo=$_POST['codigo'];

  $query_InfoPersonal="select cuentas.monto, Clientes.Nombre, Clientes.Apellido, Clientes.Cedula, Clientes.fechaIngreso from cuentas inner join
  Clientes on cuentas.idCliente=Clientes.idCliente where cuentas.Cuenta=?";
  $stmt=$conexion->prepare($query_InfoPersonal);
  $stmt->bind_param("s",$codigo);
  $stmt->execute();
  $stmt->bind_result($monto_c,$nombre,$apellido,$cedula,$fechaIngreso);
  while ($stmt->fetch()) {
  $nom=$nombre;
  $ape=$apellido;
  $cedu=$cedula;
  $fecha=$fechaIngreso;
  $monto+=$monto_c;
  }



  $query_movimientos="select movimientos.fecha, case movimientos.MovID  when 2 
then ReciboDetalle.valor else '-' END as 'Retiro', case movimientos.MovID  when 1 
then ReciboDetalle.valor else '-' END as 'Abono',case movimientos.MovID  when 3
then ReciboDetalle.valor else '-' END as 'Interes',movimientos.idUsuario, ReciboDetalle.valor, movimientos.MovID
 from movimientos inner join
cuentas on cuentas.idCuenta = movimientos.idCuenta join
MovimientoDetalle on movimientos.MovimientoID = MovimientoDetalle.MovimientoID join
ReciboDetalle on ReciboDetalle.ReciboID = MovimientoDetalle.ReciboID where cuentas.cuenta=?";
$stmt_mostrarMovimientos=$conexion->prepare($query_movimientos);
$stmt_mostrarMovimientos->bind_param("s",$codigo);
$stmt_mostrarMovimientos->execute();
$stmt_mostrarMovimientos->bind_result($fecha,$retiro,$abono,$interes,$usuario,$valor,$tipo);
while($stmt_mostrarMovimientos->fetch()){
  if($tipo==1){
  $monto+=$valor;
}
if($tipo==2){
  $monto-=$valor;
}
if($tipo==3){
  $monto+=$valor;
}

$movi.="<tr><td>".$fecha."</td>
<td>".$retiro."</td>
<td>".$abono."</td>
<td>".$interes."</td>
<td>".$monto."</td>
<td>".$usuario."</td></tr>";
}
    $maqueta="

 <style>


 </style>

    <div class='panel panel-info'>
              <div class='panel-heading'>
              Informacion Personal
              </div>
              <div class='panel-body'>
              <table class='table'>
               <thead><tr><th>Nombres</th>
           <th>Apellidos</th>
           <th>Cedula</th>
           <th>Fecha de Ingreso</th>
           <th>Monto</th>
           </tr></thead>
           <tbody>
           <tr>
            <td>".$nom."</td>
             <td>".$ape."</td>
              <td>".$cedu."</td>
               <td>".$fecha."</td>
                <td>".$monto."</td>
           </tr>
           </tbody>
              </table>
              </div>
              </div>
    <div class='panel panel-success'>
           <div class='panel-heading'>Movimientos</div>
           <div class='panel-body'>
           <div class='table-responsive'>
           <table class='table'>
           <thead><tr><th>Fecha</th>
           <th>Retiro</th>
           <th>Abono</th>
           <th>Interes</th>
           <th>Saldo</th>
           <th>Usuario</th>
           </tr></thead>
           <tbody>

     ".$movi;

$maqueta.='</tbody></table></div></div><div class="panel-footer">
 <div class="row">
     <div class="col-xs-6">
     <input type="button" class="btn btn-default" id="actualizarLibreta" name="actualizarLibreta" value="Actualizar Libreta">
     </div>
     </div>
    </div></div><script>$("#actualizarLibreta").click(function(){
  $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
CoCuentaA=prompt("Digite el codigo de cuenta");
CoLibreta=prompt("Digite el codigo de libreta"); 
if(CoLibreta!="" && CoCuentaA!=""){
$.ajax({
type: "POST",
url: "../mostrar/actualizarL.php",
data: {
  cuenta: CoCuentaA,
  libreta: CoLibreta
}
}).done(function(res){
  $text=res.split("+");
  if($text[0]>0){
  var mywindow = window.open("", "my div", "height=400,width=600");
    mywindow.document.write($text[1]);
 mywindow.print();
     mywindow.setTimeout(function () {
      mywindow.focus();mywindow.close();},3000);
}
else{alert("sin registros para imprimir")};
});
}
});</script>';

    echo $maqueta;
  }else{
    echo "error";
  }
?>
