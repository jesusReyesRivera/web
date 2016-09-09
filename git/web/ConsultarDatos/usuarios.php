<?php

session_start();
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
include("../sesion/conexion.php");
$query="select cajeros.nombre, usuarios.usuario, usuarios.tipo, usuarios.estado, usuarios.idUsuario from cajeros inner join
 usuarios on cajeros.idCajero=usuarios.idCajero";

$resultado=mysqli_query($conexion,$query);
$texto='
<div class="panel panel-default">
 
  <div class="panel-heading"><span class="label label-info">Listado de usuarios</span></div>
    <div class="table-responsive"> 
    <table class="table" style="font-size: 12px">
  <thead>
  <Th>Nombre</th><th>Usuario</th><th>Tipo</th><th>Estado</th><th>Cambiar estado</th></thead><tbody>
  ';

while($line=mysqli_fetch_array($resultado)){
$texto.='<tr><td>'.$line['nombre']."</td>";
$texto.='<td>'.$line['usuario']."</td>";
if($line['tipo']=="1"){
    $tipo="Administrador";
}else if($line['tipo']=="2"){
    $tipo="Normal";
}
$texto.='<td>'.$tipo."</td>";
if($line['estado']==0){
	$texto.="<td>inactivo</td><td><input type='button' id='usuario_".$line['idUsuario']."' class='btn btn-info' value='Activar' style='width: 150px'></td></tr>";
}else if($line['estado']==1){
$texto.="<td>activo</td><td><input type='button' id='usuario_".$line['idUsuario']."' class='btn btn-info' value='Desactivar' style='width: 150px'></td></tr>";
}

$texto.="  <script>
                  $('#usuario_".$line['idUsuario']."').click(function(){
                   var estado='".$line['estado']."';
                   var id='".$line['idUsuario']."';
                   $.ajax({
                     type: 'POST',
                     url: '../ModificarDatos/usuarios.php',
                     data: {
                     	id: id,
                     	estado: estado
                     },
                     success: function(res){
                      alert(res);
                      $.ajax({
  type: 'POST',
  url: '../ConsultarDatos/usuarios.php'
}).done(function(res){
$('#usuarios').html(res);
});
                     }

                   });
                  });

                  </script>";

}
   $texto.='
 </tbody></table></div>
</div>


';

echo $texto;
}else{
    header("location: ../");
}
?>
