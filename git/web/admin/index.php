<?php
session_start();
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=0.8, user-scalable=no">
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8">
<head>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/funciones.js"></script>
<script src="../js/mascara.js"></script>

<link href="../estilos/demo.css" rel="stylesheet">
<link href="../estilos/estilos.css" rel="stylesheet">

<title>Administracion</title>
<?php
include("menu.php");
?>

</head>
<body style="padding-top: 70px"><div class="container">
<legend>Usuarios</legend>
<div class="panel panel-info">
<div class="panel-heading"><span class="label label-info">Agregar nuevo usuario</span></div>
<div class="panel-body">
<div class="row">
<div class="col-xs-12">
<label>Nombre Completo</label><input type="text" id="Nombre" name="Nombre" class="form-control input-md" placeholder="Nombre completo">
</div>
</div>
<br>
<div class="row">
<div class="col-xs-4">
<label>Direccion</label><input type="direc" id="direc" name="direc" class="form-control input-md" placeholder="direccion">
</div>
<div class="col-xs-4">
<label>Telefono</label><input type="telefono" id="telefono" name="telefono" class="form-control input-md" placeholder="telefono">
</div>
<div class="col-xs-4">
<label>Nacimiento</label><input type="edad" id="edad" name="edad" class="form-control input-md" placeholder="edad">
</div>
</div>
<br>
<div class="row">
<div class="col-xs-3">
<label>Usuario</label><input type="text" id="usuario" name="usuario" class="form-control input-md" placeholder="usuario">
</div>
<div class="col-xs-3">
<label>Contrasenia</label><input type="password" id="pass" name="pass" class="form-control input-md" placeholder="password">
</div>
<div class="col-xs-3">
<label>Tipo</label><select class="form-control" id="tipo">
<option value="1">Administrador</option>
<option value="2">Normal</option>
</select>
</div>
<div class="col-xs-3">
<label>Cooperativa</label><select class="form-control" id="tipoC">

</select>
</div>

</div>
</div>
 <div class="panel-footer">

<input type="button" id="agregarU" name="agregarU" class="btn btn-success" value="agregar">

 </div>
</div>
<br><br><div class="panel panel-info">
<div class="panel-heading"><span class="label label-info">Agregar nueva cooperativa</span></div>
<div class="panel-body">
<div class="row">
<div class="col-xs-12">
<label>Nombre Completo</label><input type="text" id="NombreCo" name="NombreCo" class="form-control input-md" placeholder="Nombre cooperativa">
</div>
</div>
<br>
<div class="row">
<div class="col-xs-12">
<label>RTN</label><input type="text" id="RTN" name="RTN" class="form-control input-md" placeholder="RTN">
</div>
</div>
</div>
 <div class="panel-footer">

<input type="button" id="agregarC" name="agregarC" class="btn btn-success" value="agregar">
 </div>
</div>
<br><br><div class="panel panel-info">
<div class="panel-heading"><span class="label label-info">Agregar nueva Moneda</span></div>
<div class="panel-body">
<div class="row">
<div class="col-xs-12">
<label>Pais origen</label><input type="text" id="origen" name="origen" class="form-control input-md" placeholder="origen">
</div>
</div>
<br>
<div class="row">
<div class="col-xs-12">
<label>Tipo</label><input type="text" id="tipoM" name="tipoM" class="form-control input-md" placeholder="tipo">
</div>
</div>
</div>
 <div class="panel-footer">

<input type="button" id="agregarM" name="agregarM" class="btn btn-success" value="agregar">
 </div>
</div>


<div>

<div id="usuarios"></div></div>
</div>
            <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ephamoney</h4>
      </div>
      <div class="modal-body" >
        <p id="textoModal"></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="mostrarMensaje" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>

   <script src="../js/demo.js"></script>
   <script src="../js/datepicker.js"></script>
   <link href="../estilos/date.css" rel="stylesheet">
<script>

$('document').ready(function(){
  $('body').ready(function(){
$.ajax({
  type: "POST",
  url: "../ConsultarDatos/usuarios.php"
}).done(function(res){
$("#usuarios").html(res);
});
cooperativas();

  });
$('#edad').datepicker({
  format: "yyyy/mm/dd"
});
$("#agregarU").click(function(){
var nombreC=$("#Nombre").val();
var dire=$("#direc").val();
var tele=$("#telefono").val();
var edad=$("#edad").val();
var us=$("#usuario").val();
var pass=$("#pass").val();
var tipo=$("#tipo").val();
var tipoC=$("#tipoC").val();

if(nombreC!="" && dire!="" && tele!="" && edad!="" && us!="" && pass!="" && tipo!="" && tipoC!=""){
$.ajax({
  type: "POST",
  url: "../agregarDatos/agregarUsuarios.php",
  data:{
    nombre: nombreC,
    dire: dire,
    tele: tele,
    edad: edad,
    us: us,
    pass: pass,
    tipo: tipo,
    tipoCC: tipoC

  }
}).done(function(res){
  alert(res);
if(res==1){
  alert("agregado Correctamente!!");
$("#Nombre").val("");
$("#direc").val("");
$("#telefono").val("");
$("#edad").val("");
$("#usuario").val("");
$("#pass").val("");

}else{
  alert("hubo un error");
}
});
}else{
  alert("No has llenado todos los campos!!!");
}
});
$("#agregarC").click(function(){
var nombreCo=$("#NombreCo").val();
var rtn=$("#RTN").val();

if(nombreCo!="" && rtn!=""){
$.ajax({
  type: "POST",
  url: "../agregarDatos/agregarCoperativas.php",
  data:{
    nombre: nombreCo,
    rt: rtn
  }
}).done(function(res){

  $("#textoModal").html(res);
  $("#myModal").modal("show");
$("#RTN").val("");
$("#NombreCo").val("");
cooperativas();

});
}else{
  alert("No has llenado todos los campos!!!");
}
});


$("#agregarM").click(function(){
var origen=$("#origen").val();
var tipoM=$("#tipoM").val();

if(origen!="" && tipoM!=""){
$.ajax({
  type: "POST",
  url: "../agregarDatos/AgregarMoneda.php",
  data:{
    o: origen,
    tm: tipoM
  }
}).done(function(res){

  $("#textoModal").html(res);
  $("#myModal").modal("show");
$("#origen").val("");
$("#tipoM").val("");


});
}else{
  alert("No has llenado todos los campos!!!");
}
});


});

function cooperativas(){
  $.ajax({
  type: "POST",
  url: "../ConsultarDatos/cooperativas.php"
}).done(function(res){
$("#tipoC").html(res);
});
}
</script>

</html>

<?php
}else {
    # code...
    header("location: http://93.188.166.74/web/admin.php");
}


?>