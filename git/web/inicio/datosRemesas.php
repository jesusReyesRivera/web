<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   $contador=0;
	require "../../tienda/password.php";
   include("../../tienda/send/conexion/conexion.php");
   $conexion->set_charset("utf8");
   $clave=$_POST['clave'];
   $query="SELECT transaccion.TransaccionHash,transaccionDetalle.TransaccionDetalleID, 
Receptor.Nombres as rn ,Receptor.Apellido as ra,Receptor.Direccion as rd, Receptor.telefono as rt ,municipios.NombreM,departamentos.Nombre,
clientes.Nombres as cn, clientes.Apellidos as ca,clientes.TelefonoR  as ctr, clientes.TelefonoM as ctm,clientes.pais,
 transaccion.fecha, recibosDetalle.estado, 
recibosDetalle.valor, recibos.ReciboID from usuarios
inner join transaccion on usuarios.UsuarioID=transaccion.UsuarioID
inner join Receptor on Receptor.ReceptorID=transaccion.ReceptorID
inner join clientes on clientes.ClienteID=usuarios.ClienteID
inner join municipios on Receptor.MuniID=municipios.MuniID 
inner join departamentos on departamentos.DeptoID=municipios.DeptoID
inner join transaccionDetalle on transaccion.TransaccionHash=transaccionDetalle.TransaccionHash
inner join  recibos on transaccionDetalle.ReciboID=recibos.ReciboID
inner join  recibosDetalle on recibos.ReciboID=recibosDetalle.ReciboID
  order by recibos.ReciboID";
   $resultado=mysqli_query($conexion,$query);

   if($resultado){
   while($linea=mysqli_fetch_array($resultado)){
   	$hash=$linea['TransaccionHash'];
	if(password_verify($clave,$hash)){
    $contador=$contador+1;
  if($linea['estado']==0){
 $texto='<div id="informacion"><div class="panel panel-info">
 <div class="panel-heading">
 informacion Receptor
 </div>
 <div class="panel-body">
 <div class="row">
 <div class="col-lg-3">
<label>Nombres: '.$linea['rn'].'</label>
</div>
 <div class="col-lg-3">
<label>Apellidos: '.$linea['ra'].'</label>
</div>
 <div class="col-lg-3">
<label>telefono: '.$linea['rt'].'</label>
</div>
 <div class="col-lg-3">
<label>Direccion: '.$linea['rd'].'</label>
</div>
 </div><br>
 <div class="row">
  <div class="col-lg-3">
<label>Municipio: '.$linea['NombreM'].'</label>
</div>
  <div class="col-lg-3">
<label>Departamento: '.$linea['Nombre'].'</label>
</div>
 </div>

 </div>

 </div>
<div class="panel panel-info">
 <div class="panel-heading">
 informacion Emisor
 </div>
 <div class="panel-body">
 <div class="row">
 <div class="col-lg-3">
<label>Nombres: '.$linea['cn'].'</label>
</div>
 <div class="col-lg-3">
<label>Apellidos: '.$linea['ca'].'</label>
</div>
 <div class="col-lg-3">
<label>telefono residencial: '.$linea['ctr'].'</label>
</div>
 <div class="col-lg-3">
<label>telefono movil: '.$linea['ctm'].'</label>
</div>
 </div><br>
 <div class="row">
  <div class="col-lg-3">
<label>pais: '.$linea['pais'].'</label>
</div>
 </div>

 </div>

 </div>
 </div>
 <div class="panel panel-info">
<div class="panel-heading">
cantidad
</div>
<div class="panel-body">
 <div class="row">
  <div class="col-lg-3">
<label>cantidad en dolares: $'.number_format($linea['valor'],2).'</label>
</div>
 <div class="col-lg-3">
<label>cantidad en lempiras: $'.number_format($linea['valor']*22.87,2).'</label>
</div>
 <div class="col-lg-3">
<label>Fecha: '.$linea['fecha'].'</label>
</div>
 </div>
</div>
<div class="panel-footer">
<div class="row">
  <div class="col-lg-2">
<button class="btn btn-info"  style="width:100px; height:35px" id="retirar" name="retirar">retirar</button>
</div>
 <div class="col-lg-3">
<button class="btn btn-warning"  style="width:100px; height:35px" id="cancelar" name="cancelar">cancelar</button>
</div>
 </div>
</div>
 </div>
 <script>
 var reciboID='.$linea['ReciboID'].';
   
          
$("#cancelar").click(function(){
 $("#receptor").html("");
});

$("#retirar").click(function(){
  $("#retirar").prop( "disabled", true );
  $.ajax({
  type: "POST",
  url: "retirarR.php",
  data:{
      recibo: reciboID
  }
  }).done(function(res){

    
          
            
             var  newWindow = window.open("","print","height=400,width=600");
                 newWindow.document.write("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">  <link href=\"../estilos/estilos.css\" rel=\"stylesheet\">"+$("#informacion").html()+ `<div class="panel panel-info">
<div class="panel-heading">
cantidad
</div>
<div class="panel-body">
 <div class="row">
  <div class="col-lg-3">
<label>cantidad en dolares: $'.number_format($linea['valor'],2).'</label>
</div>
 <div class="col-lg-3">
<label>cantidad en lempiras: $'.number_format($linea['valor']*22.87,2).'</label>
</div>
 <div class="col-lg-3">
<label>Fecha: '.$linea['fecha'].'</label>
</div>
 </div>
</div>
</div>
`);
                 setTimeout(function(){
                  
    newWindow.print();

       $("#receptor").html(""); 

}, 300);
        


  

});
});
 </script>
 ';
 echo $texto;
  
break;
  }else{
    echo '<div class="panel panel-info">
 <div class="panel-heading">
 alert
 </div>
 <div class="panel-body">
remesa ya cancelada
 </div>
 <div class="panel-footer">
 </div>
 </div>';
    break;
  }

}

   }
   if($contador<1){
  echo '<div class="panel panel-info">
 <div class="panel-heading">
 alert
 </div>
 <div class="panel-body">
Clave no existe
 </div>
 <div class="panel-footer">
 </div>
 </div>';
}

     }
   else{
   	echo '<div class="panel panel-info">
 <div class="panel-heading">
 alert
 </div>
 <div class="panel-body">
ha ocurrido un error
 </div>
 <div class="panel-footer">
 </div>
 </div>';
   }

	}else{

	  header("location: ../");
}
?>