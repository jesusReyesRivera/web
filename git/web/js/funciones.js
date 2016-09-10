
$('document').ready(function(){
var saldo=0;

  $('#texto0').html(`<div class="panel panel-default"><div class="panel-heading">Clientes</div><div class="panel-body"><div class="row">
  <div class="col-xs-6">
  <input type="text" class="form-control input-md" placeholder="identidad" id="identidadB" name="identidadB">
  </div>
      <div class="col-xs-6">
      <input type="button" data-type="zoomin"  class="btn btn-default" id="buscarCedula" value="buscar">
      </div>
      </div></div>`).hide();

        $('#divAbono').html(`<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<div class="panel panel-default">
<div class="panel-heading">Abono</div>
<div class="panel-body">
<div class="row">

  <div class="col-xs-3">
  <label>Cuenta</label><input id="AbonoCuenta" name="AbonoCuenta" type="text" placeholder="" class="form-control input-md" required="">
  </div>
  <div class="col-xs-2">
    <label>Saldo Actual</label><div id="saldos"></div>
  </div>
  <div class="col-xs-3">
    <label>Cliente</label><div id="ClienteAbono"></div>
  </div>
   <div class="col-xs-2">
    <label>Numero de Cedula</label><div id="numCedulaAbono"></div>
  </div>
</div>
<br>
<div class="row">

  <div class="col-xs-6">
  <label>Valor </label> <input id="valor" onkeypress="return notext(event)" name="valor" type="text" placeholder="" class="form-control input-md" required="" disabled="true">
  </div>

  <div class="col-xs-6">
  <label># de libreta</label><input id="libreta" name="libreta" type="text" placeholder="" class="form-control input-md" required="" disabled="true">

  </div>
</div>
</div>
  <div class="panel-footer"><div class="form-group">
    <label class="col-md-4 control-label" for="ok"></label>
    <div class="col-md-8">
      <input type="button" id="AbonoAceptar" name="AbonoAceptar" class="btn btn-success" value="Aceptar" disabled>

    </div>
  </div></div></div>



</fieldset>
</form>`).hide();


      $('#texto').html(`<div class="panel panel-default">
<div class="panel-heading">Reporte</div>
<div class="panel-body">
        <div class="row">
        <div class="col-xs-6">
        <input id="codigo" name="codigo" class="form-control" type='text' placeholder='Codigo de Cuenta'>
        </div>
        <div class="col-xs-1">
          <input id="buscar" name="buscar" class="btn btn-default" type='button' value='buscar'>
        </div>

        </div></div></div>`).hide();

        $('#divRetiro').html(`<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<div class="panel panel-default"><div class="panel-heading">Retiros</div>
<div class="panel-body">
<div class="row">

  <div class="col-xs-3">
  <label>Cuenta</label><input id="CuentaRetiro" name="CuentaRetiro"  type="text" placeholder="" class="form-control input-md" required="">
  </div>
  <div class="col-xs-2">
    <label>Saldo Actual</label><div id="saldos2"></div>
  </div>
  <div class="col-xs-3">
    <label>Cliente</label><div id="ClienteR"></div>
  </div>
   <div class="col-xs-2">
    <label>Numero de Cedula</label><div id="NumCedula"></div>
  </div>
</div>
<br>
<div class="row">

  <div class="col-xs-6">
  <label>Valor </label> <input  id="valorRetiro" name="valorRetiro" type="text" onkeypress="return notext(event);"  placeholder="" class="form-control input-md" required="" disabled="true">
  </div>

  <div class="col-xs-6">
  <label># de libreta</label><input id="libretaRetiro" name="libretaRetiro" type="text" placeholder="" class="form-control input-md" required="" disabled="true">

  </div>
</div>
</div>
  <div class="panel-footer"><div class="form-group">
    <label class="col-md-4 control-label" for="ok"></label>
    <div class="col-md-8">
      <input type="button" id="RetiroAceptar" name="RetiroAceptar" class="btn btn-success" value="Aceptar" disabled>

    </div>
  </div></div>


</fieldset>
</form>`).hide();

    $('#texto2').html(`
    <form class="form-horizontal">
    <fieldset>
    <!-- Form Name -->

    <br>
    <div class="panel panel-default">
    <div class="panel-heading">
    <span class="label label-info">Información personal</span>
    </div>
    <div class="panel-body">

    <div class="row">
    <div class="col-xs-6">
    <label>Nombres</label><input id="Nombre" name="Nombre" type="text" placeholder="Nombre" class="form-control input-md" required="">
    </div>
    <div class="col-xs-6">
    <label>Apellidos</label><input id="apellido" name="apellido" type="text" placeholder="Apellido" class="form-control input-md" required="">
    </div>
    </div>
    <br><br>
<legend></legend>
<br>
    <div class="row">
    <div class="col-xs-4">
    <label>identificacion</label><input id="cedula" name="cedula" type="text" placeholder="numero de identificacion" class="form-control input-md" required="">
    </div>
    <div class="col-xs-4">
    <label>Nacionalidad</label><input id="Nacionalidad" name="Nacionalidad" type="text" placeholder="Nacionalidad" class="form-control input-md" required="">
    </div>
    <div class="col-xs-4">
    <label>Fecha de nacimiento</label><input id="edad" name="edad" type="text" placeholder="fecha de nacimiento" class="form-control input-md" required="" readonly>
    </div>
    </div>
    <br><br>
<legend></legend>
<br>
    <div class="row">
    <div class="col-xs-4">
    <label>Ciudad de nacimiento</label><input id="CiudadN" name="CiudadN" type="text" placeholder="Ciudad de nacimiento" class="form-control input-md" required="">
    </div>
    <div class="col-xs-4">
  <label>Sexo</label> <select id="tipoDeSexo" class="form-control">
    <option value="M">M</option>
    <option value="F">F</option>
    </select>
    </div>
    <div class="col-xs-4">
  <label>Estado Civil</label> <select id="EstadoCivil" class="form-control">
    <option value="Soltero">Soltero</option>
    <option value="Casado">Casado</option>
    <option value="Divorciado">Divorciado</option>
    <option value="viudo">viudo</option>
    <option value="Union libre">Union libre</option>
    </select>
    </div>
    </div>
<Br><br>
    <legend></legend>
    <br>
    <div class="row">
    <div class="col-xs-3">
      <label>No. de Hijos</label><input onkeypress="return notext(event)" id="Nhijos" name="Nhijos" type="text" placeholder="No. de hijos" class="form-control input-md" required="">
    </div>
    <div class="col-xs-3">
      <label>No. de dependientes</label><input onkeypress="return notext(event)" id="NDepen" name="NDepen" type="text" placeholder="No. de dependientes" class="form-control input-md" required="">
    </div>
    <div class="col-xs-3">
    <label>Nivel Educativo</label><select id="NivelEdu" name="NivelEdu" class="form-control">

         <option value="Ninguno">Ninguno</option>
         <option value="Secundaria">Secundaria</option>
         <option value="PostGrado">PostGrado</option>
         <option value="Universidad">Universidad</option>
       </select>
    </div>
    <div class="col-xs-3">
    <label>Ocupaci&oacute;n</label><select id="Ocupacion" name="Ocupacion" class="form-control">
         <option value="Empleado empresa privada">Empleado empresa privada</option>
         <option value="Independiente">Independiente</option>
         <option value="Jubilado">Jubilado</option>
         <option value="Estudiante">Estudiante</option>
         <option value="Ama de casa">Ama de casa</option>
         <option value="Otros">Otros</option>
       </select>
    </div>
    </div>
    <br>
    </div>
    </div>
    <br>
    <div class="panel panel-default">
    <div class="panel-heading">
    <span class="label label-info">Datos de ubicaci&oacute;n</span>
    </div>
    <div class="panel-body">
    <div class="row">
    <div class="col-xs-12">
    <label>Direcci&oacute;n de residencia</label><input id="direccion" name="direccion" type="text" placeholder="direccion" class="form-control input-md" required="">
    </div>
    </div>
    <br><br>
    <legend></legend>
    <br>
    <div class="row">
   <div class="col-xs-3">
   <label>Ciudad</label><input id="ciudad" name="ciudad" type="text" placeholder="ciudad" class="form-control input-md" required="">
   </div>
   <div class="col-xs-3">
   <label>Telefono de residencia</label><input id="telefono" name="telefono" type="text" placeholder="telefono" class="form-control input-md" required="">
   </div>
   <div class="col-xs-3">
   <label>Telefono celular</label><input id="telefonoCelular" name="telefonoCelular" type="text" placeholder="telefono celular" class="form-control input-md" required="">
   </div>
   <div class="col-xs-3">
   <label>Tipo de vivienda</label>
   <select id="TipoVivienda" name="TipoVivienda" class="form-control">
        <option value="Propia">Propia</option>
        <option value="Familiar">Familiar</option>
        <option value="Alquilada">Alquilada</option>
      </select>
   </div>
    </div>
    <br><br>
    </div>
    </div>
 
    <div class="panel panel-default">
    <div class="panel-heading">
    Beneficiarios
    </div>
    <div class="bTabla panel-body" id="tablaB">

    <table  class="table">
<thead>
  <th>Nombres</th>
  <th>Apellidos</th>
  <th>direccion</th>
  <th>porcentaje</th>
  <th></th>
  <th></th>
</thead>
<tbody>

  <tr class="hide">
   <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true" onkeypress="return notext_bn(event,this)"></td>
    <td><input value="-" type="button" id="eliminar" class="removerfila btn btn-danger"></td>
  </tr>

</tbody>


</table>
    </div>
    <div class="panel-footer">
    <input type="button" id="mas" value="+" class="agregarfila btn btn-info">
   

    </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-heading">
    <span class="label label-info">Cuenta</span>
    </div>
    <div class="panel-body">
    <div class="row">
     <div class="col-xs-6">
     <label>Monto inicial</label>
     <input id="monto" onkeypress="return notext(event)" name="monto" type="text" placeholder="Monto Inicial" class="form-control input-md" required="">
     </div>
       <div class="col-xs-6">
       <label>Tipo de moneda</label>
       <div id="monedaTexto">
         
         </div>
   
     </div>
     </div>
     </div>
     </div>
    </div>
     </fieldset>
     </form>
      <!--<legend>Clientes</legend>
    <div id="clientes_registrados"></div>
     <input class="btn btn-success" type="button" id="exportar" value="exportar clientes a pdf"><br><br><br>-->
   `).hide();

//--------------------------codigo que muestra la informacion del cliente cuando se busca por cuenta---------------------------------------------------------------------------------------------------------------------------------------------------

   $('#buscarCliente').html(`<br>
     <div class="panel panel-default">
     <div class="panel-heading">Informacion personal</div>
     <div class="panel panel-body">
     <div class="row">
     <div class="col-xs-6">
    <label class="col-md-4 control-label">Nombre</label>
    <input type="text" class="form-control input-md" id="nombre" name="nombre" placeholder="Nombre" readonly>
     </div>
     <div class="col-xs-6">
     <label class="col-md-4 control-label">Apellido</label>
     <input type="text" id="Apellido" class="form-control input-md" name="Apellido" placeholder="Apellido" readonly>
     </div>
     </div>
     <br>
     <div class="row">
     <div class="col-xs-3">
      <label class="col-md-4 control-label">Cedula</label>
     <input type="text" id="ced" name="ced" class="form-control input-md"  placeholder="# de Cedula" readonly>
     </div>
     <div class="col-xs-6"> <label class="col-md-4 control-label">Fecha de ingreso</label>
     <input type="text" id="fecha" name="fecha" class="form-control input-md" placeholder="fecha de Crecacion de la cuenta" readonly>
     </div>
      <div class="col-xs-3"> <label class="col-md-4 control-label">Monto</label>
     <input type="text" id="montoR" name="montoR" class="form-control input-md" placeholder="monto" readonly>
     </div>
     </div>
     </div></div>
     `).hide();

//-----------------------------------codigo que muestra el codigo de cuenta y de libreta------------------------------------------------------------------------------------------------------------------------------------------

     $('#CuentaYlibreta').html(`  <div class="panel panel-default">
       <div class="panel-heading">
       <span class="label label-info">Cuenta</span>
       </div>
       <div class="panel-body">
       <div class="row">
       <div class="col-xs-6">
       <label>Codigo de Libreta</label><input id="CodLibreta" name="CodLibreta" type="text" placeholder="Codigo Libreta" class="form-control input-md" required="">
       </div>
       <div class="col-xs-6">
      <label>Codigo de Cuenta</label> <input id="CodCuenta" name="CodCuenta" type="text" placeholder="Codigo Cuenta" class="form-control input-md" required="">
       </div>
       </div>
       <br><br>
       <div class="row">
       <div class="col-xs-3">
       <input id="Actualizar" name="Actualizar" type="button"  class="btn btn-success" value="Actualizar Informacion">
       </div>
       </div>
        </div>
        </div>`).hide();

        //----------------------------------------------codigo que se muestra al agregar un nuevo cliente-------------------------------------------------------------------------------------------------------------------------------

        $("#agregarCliente").html(`
          <input type="button" id="agregar" name="agregar" class="btn btn-default" value="agregar"><br><br>`).hide();



//--------------------codigo para mostrar un reporte por medio del codigo de cuenta----
 $('#aparecer').click(function(){
   $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
        $('#buscarCliente').hide();
        $('#depositoAplazo').hide();
        $('#RectificarRecibo').hide();
 $('#reportes').hide();
 $('#texto0').hide();
 $('#texto2').hide();
 $('#codigo').val('');
 $('#divAbono').hide();
 $('#divRetiro').hide();
 $('#CuentaYlibreta').hide();
   $("#agregarCliente").hide();
 $('#texto').fadeIn(100);
 });



//codigo que se ejecuta al hacer click en el menu "clientes"
  $('#aparecer2').click(function(){
      $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
    limpiarcajas();
     $("#mas").prop("disabled",false);
    $('#depositoAplazo').hide();
     $('#RectificarRecibo').hide();
    $('#texto').hide();
      $('#texto2').hide();
    $('#reportes').hide();
    $('#buscarCliente').hide();
     $('#divAbono').hide();
     $('#divRetiro').hide();
     $("#cedula").mask("9999-9999-99999");
     $("#identidadB").mask("9999-9999-99999");
     $("#telefono").mask("+999-9999-9999");
     $("#telefonoCelular").mask("+999-9999-9999");
     $('#CuentaYlibreta').hide();
     $("#agregarCliente").hide();
    $('#texto0').fadeIn(100);
  });

$('#edad').datepicker({
  format: "yyyy/mm/dd"
});


$('#buscar').click(function(){
  $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });

  if($('#codigo').val()!=""){
    $('#reportes').fadeOut();
    $('#buscarCliente').fadeOut();
    $.ajax({
      type: "POST",
      url: "../mostrar/clientes.php",
      data:{
        dato: "buscar_dato_especifico",
        codigo: $('#codigo').val()
      }
    }).done(function(res){

      if(res=="error"){
alert("Cuenta erronea");

      }else{

        var informacion=res.split("<esto_es_una_barra_separadora>");
        var informacion_cliente=informacion[0].split("+");
        $('#nombre').val(informacion_cliente[0]);
        $('#Apellido').val(informacion_cliente[1]);
        $('#ced').val(informacion_cliente[2]);
        $('#fecha').val(informacion_cliente[3]);
        $('#montoR').val(informacion_cliente[4]);
        $('#buscarCliente').fadeIn(300);

      $('#reportes').html(informacion[1]).fadeIn(300);



      }

    });
  }else{
    alert("datos en blanco");
  }
});




$('#obtenerOpcion').click(function(){

if(($("input[name='opciones']:checked").val())=="opcion1"){
ObtenerMonedas();
 $('#texto2').fadeIn(300);
 $("#agregarCliente").fadeIn(300);
     $('#monto').prop("disabled","");
     $('#tipoDeSexo').prop("disabled","");
     $('#Nombre').focus();
}else{
  $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
}
});

});




