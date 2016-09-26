<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
include("../sesion/conexion.php");
$dato=$_POST['cuenta'];
$cont=0;
if($dato!=""){
    $stmt = $conexion->prepare("select Clientes.Nombre, Clientes.Apellido, Clientes.Cedula,Clientes.fechaIngreso, cuentas.monto from cuentas
inner join Clientes on Clientes.idCliente=cuentas.idCliente  where cuentas.cuenta=?");
    $stmt->bind_param('s', $dato);
    
    if($stmt->execute()){

    $stmt->bind_result($nombre,$Apellido,$Cedula,$fechaIngreso,$monto);
  while ($stmt->fetch()) {
    $texto.= $nombre." ".$Apellido."+";
    $texto.= $Cedula."+";
    $texto.= $fechaIngreso."+";
    $texto.= number_format($monto,2)."<barraSeparadora>";
    $cont=$cont+1;
  }

      $stmt2 = $conexion->prepare(" select  DePlaFi.fechaA, DePlaFi.plazo,DePlaFi.estado as 'Estadodeldeposito',  ReciboDetalle.valor, recibos.estado as 'Estadodelrecibo',recibos.ReciboID from cuentas inner join
DePlaFi on cuentas.idCuenta = DePlaFi.idCuenta join 
DePlaFiDetalle on DePlaFiDetalle.DepositoID = DePlaFi.DepositoID join 
recibos on recibos.ReciboID = DePlaFiDetalle.ReciboID join 
ReciboDetalle on recibos.ReciboID = ReciboDetalle.ReciboID where cuentas.cuenta=?");
    $stmt2->bind_param('s', $dato);
    
    if($stmt2->execute()){

    $stmt2->bind_result($fechaA,$plazo,$estadoDeposito,$valor,$estadoRecibo,$idRecibo);
     $texto.="
               <thead><tr><th>Fecha de creacion</th><th>plazo</th><th>Estado Deposito</th><th>Valor</th>
              <th>Entregado</th>
              </tr></thead><tbody>";
              $contDe=0;
  while ($stmt2->fetch()) {
    $texto.="<tr><td>".$fechaA."</td>";
    $texto.="<td>".$plazo."</td>";
    if($estadoDeposito=="1"){
      $estado="no finalizado";
    }else if($estadoDeposito=="0"){
      $estado="Certificado finalizado";
    }
    $texto.="<td>".$estado."</td>";
    $texto.="<td>".number_format($valor,2)."</td>";
      if($estadoRecibo=="1"){
        if($estadoDeposito=="0"){
          $id="retirar_".$idRecibo;
          $estadoR="<input type=\"button\" class=\"btn btn-info\" value=\"retirar\" id=".$id." name=\"  retirar\">
            <script>
           $('#".$id."').click(function(){
             var idRecibo=".$idRecibo.";
              var alerta=\"esta seguro que desea retirar el Certificado de deposito con  #\"+idRecibo+\" de recibo??\";
    if(confirm(alerta)){
    
      $.ajax({
          type: 'POST',
          url: '../mostrar/retirarRecibo.php',
          data: {
            recibo: idRecibo
          }
      }).done(function(res){
  actualizarTabla();
     var mywindow = window.open('', 'my div', 'height=400,width=600');
    mywindow.document.write(res);
 mywindow.print();
    return true;
      });
    }

           });
            </script>


          ";
        }else{
          $estadoR="no retirado";
                  }
    }else if($estadoRecibo=="0"){
      $estadoR="retirado";
    }
    $texto.="<td>".$estadoR."</td><tr>";
$contDe=$contDe+1;
  }
  if($contDe==0){
    $texto.=" <td class=\"warning\" COLSPAN=\"5\">Sin resultados</td>";
  }
  $texto.="</tbody>";
  if($cont>0){
  echo $texto;
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
}else{
  echo "0";
}
}else{
  header("location: ../");
}
  ?>
