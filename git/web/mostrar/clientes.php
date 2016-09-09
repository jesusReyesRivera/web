<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
include("../sesion/conexion.php");
$dato=$_POST['dato'];
if($dato=="buscar_dato_especifico"){
  $codigo=$_POST['codigo'];
  $query="select idCliente,idCuenta, monto from cuentas where cuenta='".$codigo."'";
  $resultado=mysqli_query($conexion,$query);
  $contar=mysqli_num_rows($resultado);
  $monto="";
  if($contar==1){
    $result=mysqli_query($conexion,$query);
    $idCliente="";

    while($dato=mysqli_fetch_array($result)){
    $idCliente=$dato['idCliente'];
      $monto=$dato['monto'];
    }
    $query2="select Clientes.Nombre, Clientes.Apellido, Clientes.Cedula, Clientes.fechaIngreso, cuentas.monto from cuentas
inner join Clientes on Clientes.idCliente=cuentas.idCliente  where Clientes.idCliente=".$idCliente;
    $result2=mysqli_query($conexion,$query2);
    $info="";
    while($dato2=mysqli_fetch_array($result2)){
       $info.=$dato2['Nombre']."+";
      $info.=$dato2['Apellido']."+";
      $info.=$dato2['Cedula']."+";
      $info.=$dato2['fechaIngreso']."+";
      $info.=number_format($dato2['monto'],2)."<esto_es_una_barra_separadora>";
    }
  $ObtenerIdCuenta="";
    while($idC=mysqli_fetch_array($resultado)){
$ObtenerIdCuenta=$idC['idCuenta'];
    }

    $query3="select abono,retiro,fecha,saldos,interes,idUsuario from abonosRetiros where idCuenta=".$ObtenerIdCuenta." order by id";
    $result3=mysqli_query($conexion,$query3);
    $info2="<br><br><div class='panel panel-default'><div class='panel-heading'>Movimientos</div><div class='panel-body'><table class='table'> <thead><tr><th align=left' width='120'>Fecha</th><th  align=left' width='120'>Retiros</th><th align=left' width='120'>Depositos</th><th   align=left' width='120'>Interes</th><th  align=left' width='120'>Saldos</th><th  align=left' width='120'>Usuario</th></tr></thead></table><div style='overflow:scroll; height:400px;'><table class='table'><tbody>";

    while($dato3=mysqli_fetch_array($result3)){
      $info2.="<tr><td align=left' width='120'>".$dato3['fecha']."</td>";
      $info2.= "<td align='left' width='120'>".number_format ($dato3['retiro'],2)."</td>";
      $info2.="<td align='left' width='120'>".number_format ($dato3['abono'],2)."</td>";
      $info2.="<td align='left' width='120'>".number_format ($dato3['interes'],2)."</td>";
      $info2.="<td align='left' width='120'>".number_format ($dato3['saldos'],2)."</td>";
      $info2.="<td align='left' width='120'>".$dato3['idUsuario']."</td></tr>";
    }
    $info2.='</tbody></table></div></div><div class="panel-footer">
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

    echo $info.$info2;
  }else{echo "error";}

}
else{
  $query="select nombre, apellido, direccion from usuarios";
  $result=mysqli_query($conexion,$query);
  $texto="";
  while($dato=mysqli_fetch_array($result)){
    $texto.='<div class="panel panel-default"><div class="panel-heading">Cliente: '.$dato['nombre'].' '.$dato['apellido'].'</div>
    <div class="panel-body">Direccion: '.$dato['direccion'].'</div></div><br>';
  }
  echo $texto;
}

}
?>
