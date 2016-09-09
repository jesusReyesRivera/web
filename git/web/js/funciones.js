
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


 


 function limpiarcajas(){
   $('#identidadB').val("")
   $('#Nombre').val("");
   $('#apellido').val("");
   $('#direccion').val("");
   $('#cedula').val("");
   $('#CodCuenta').val("");
   $('#CodLibreta').val("");
   $('#edad').val("");
   $('#monto').val("");
   //-----
   
   $('#Nacionalidad').val("");
   $('#CiudadN').val("");
   $('#tipoDeSexo').val("");
   $('#EstadoCivil').val("");
   $('#Nhijos').val("");
   $('#NDepen').val("");
   $('#NivelEdu').val("");
   $('#Ocupacion').val("");
   $('#ciudad').val("");
   $('#telefono').val("");
   $('#telefonoCelular').val("");
   $('#TipoVivienda').val("");
       $("#CuentaYlibreta").hide();
    $('#texto2').hide();
    $("#agregarCliente").hide();

 }


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

//agregar un nuevo cliente......
 $('#agregar').click(function(){



  var rows=$("#tablaB").find('tr:not(:hidden)');
var contador=[];
  $(rows.shift()).find("th:not(:empty)").each(function(){
    contador.push($(this).text());

  });

var textoBeneficiario="";
var contadorCamposVacios=0;
    rows.each(function(){

          var td= $(this).find('td');
        
          contador.forEach(function(contador, i){
               if(td.eq(i).text()==""){
               contadorCamposVacios++;
              }
                   
              textoBeneficiario=textoBeneficiario+td.eq(i).text()+"+";

          });
textoBeneficiario=textoBeneficiario+"/";
         
    });
     if(contadorCamposVacios>0){
            
            textoBeneficiario="";
          }

   if($('#monto').val()!="" && $('#edad').val()!="" &&
    $('#Nombre').val()!="" && $('#apellido').val()!="" && $('#direccion').val()!="" && $('#cedula').val()!="" &&

     
     $('#Nacionalidad').val()!="" &&
     $('#CiudadN').val()!="" &&
     $('#tipoDeSexo').val()!="" &&
     $('#EstadoCivil').val()!="" &&
     $('#NivelEdu').val()!="" &&
     $('#Ocupacion').val()!="" &&
     $('#ciudad').val()!="" &&
     $('#telefono').val()!="" &&
     $('#telefonoCelular').val() &&
     $('#TipoVivienda').val()!="" && textoBeneficiario!=""){
      var CodigoCedula=  $('#cedula').val().split("-");
       $.ajax({
       type: "POST",
       url: "../mostrar/buscarCedula.php",
       data: {
         numero_cedula: $('#cedula').val(),
         cuenta:  CodigoCedula[2]
       }
      }).done(function(res){
       if(res=="0"){
    var codigoC =  $('#cedula').val().split("-");
 $.ajax({
   type: "POST",
   url: "../agregarDatos/agregar.php",
   data: {
     nombre: $('#Nombre').val(),
     apellido: $('#apellido').val(),
     direccion: $('#direccion').val(),
     cedula: $('#cedula').val(),
     monto: $('#monto').val(),
     edad: $('#edad').val(),
     C_B: textoBeneficiario,
     Nacionalidad: $('#Nacionalidad').val(),
    CiudadN: $('#CiudadN').val(),
    tipoDeSexo: $('#tipoDeSexo').val(),
    EstadoCivil: $('#EstadoCivil').val(),
    Nhijos: $('#Nhijos').val(),
    NDepen: $('#NDepen').val(),
    NivelEdu: $('#NivelEdu').val(),
    Ocupacion: $('#Ocupacion').val(),
    ciudad: $('#ciudad').val(),
    telefono: $('#telefono').val(),
    telefonoCelular: $('#telefonoCelular').val(),
    TipoVivienda: $('#TipoVivienda').val(),
     codigo: codigoC[2],
     moneda: $("#moneda").val()

   }
 }).done(function(res)
 {

   var ObtenerDatosDeAgregar=res.split("*");
   if(ObtenerDatosDeAgregar[0]=="1")
   {
  var mostrarTexto="cliente agregado Correctamente!! su numero de cuenta es: "+ObtenerDatosDeAgregar[1]+" su numero de libreta es: "+ObtenerDatosDeAgregar[2];
     alert(mostrarTexto);
     $.ajax({
      type: "post",
      url: "../agregarDatos/contratos.php",
      data: {
        identidad: $('#cedula').val(),
           nombre: $('#Nombre').val(),
         apellido: $('#apellido').val(),
         ciudad: $('#ciudad').val(),
         direccion: $('#direccion').val(),
         cuenta: ObtenerDatosDeAgregar[1]
      }
     }).done(function(res){
        limpiarcajas();
        var mywindow = window.open('', 'contrato', 'height=400,width=600');
        mywindow.document.write("<html><head><body>");   
         mywindow.document.write(res);
        mywindow.document.write("</body></html>"); 
 mywindow.document.close(); // necessary for IE >= 10
 mywindow.focus(); // necessary for IE >= 10

 mywindow.print();
 mywindow.close();
 return true;

     });
   }
   else if(res=="0")
   {
     alert("hubo un error!!");
   }
 });
 }else{
 alert("un problema extranio...la cedula esta ligada a una cuenta!!");
 }
 });
 }
 else{
   alert("datos en blanco!!");
 }
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


$('#AbonoCuenta').keydown(function(evt){
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
  $( "#libreta" ).prop( "disabled", true );
  $( "#valor" ).prop( "disabled", true );
  $( "#AbonoAceptar" ).prop( "disabled", true );
$('#saldos').html('');
$('#ClienteAbono').html('');
$('#numCedulaAbono').html('');
  if($('#AbonoCuenta').val()!=""){
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;


  if (charCode==13) {
  $.ajax({
type: "POST",
url: "../ConsultarDatos/saldos.php",
data: {
  cuenta: $('#AbonoCuenta').val()
}

  }).done(function(res){

    if(res=="error"){
      alert("cuenta erronea");
    }
    else{
      var rres=res.split("+");
$('#saldos').html(number_format(rres[0], 2));
$('#ClienteAbono').html(rres[1]);
$('#numCedulaAbono').html(rres[2]);
if(rres[0]>-1){
$( "#libreta" ).prop( "disabled", false );
$( "#valor" ).prop( "disabled", false );
$( "#AbonoAceptar" ).prop( "disabled", false );
}
    }

  });
  }
}
});

$('#CuentaRetiro').keydown(function(evt){
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
  $( "#libretaRetiro" ).prop( "disabled", true );
  $( "#valorRetiro" ).prop( "disabled", true );
  $( "#RetiroAceptar" ).prop( "disabled", true );
  $('#saldos2').html(''); $('#ClienteR').html('');$('#NumCedula').html('');
  if($('#CuentaRetiro').val()!=""){
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;


  if (charCode==13) {
  $.ajax({
type: "POST",
url: "../ConsultarDatos/saldos.php",
data: {
  cuenta: $('#CuentaRetiro').val()
}

  }).done(function(res){

    if(res=="error"){
      alert("cuenta erronea");
    }
    else{
var rres=res.split("+");
$('#saldos2').html(number_format(rres[0], 2));
$('#ClienteR').html(rres[1]);
$('#NumCedula').html(rres[2]);

if(rres[0]>-1){
$( "#libretaRetiro" ).prop( "disabled", false );
$( "#valorRetiro" ).prop( "disabled", false );
$( "#RetiroAceptar" ).prop( "disabled", false );
}
    }

  });
  }
}
});


$('#Actualizar').click(function(){
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
  if($('#Nombre').val()!="" && $('#apellido').val()!="" && $('#direccion').val()!="" && $('#cedula').val()!="" &&
    
    $('#Nacionalidad').val()!="" &&
    $('#EstadoCivil').val()!="" &&
    $('#NivelEdu').val()!="" &&
    $('#Ocupacion').val()!="" &&
    $('#ciudad').val()!="" &&
    $('#telefono').val()!="" &&
    $('#telefonoCelular').val()!="" &&
    $('#TipoVivienda').val()!=""){

   $.ajax({
     type: "POST",
     url: "../ModificarDatos/ModificarDatos.php",
     data: {
       nombre: $('#Nombre').val(),
       apellido: $('#apellido').val(),
       direccion: $('#direccion').val(),
       cedula: $('#cedula').val(),
       Nacionalidad: $('#Nacionalidad').val(),
      EstadoCivil: $('#EstadoCivil').val(),
      Nhijos: $('#Nhijos').val(),
      NDepen: $('#NDepen').val(),
      NivelEdu: $('#NivelEdu').val(),
      Ocupacion: $('#Ocupacion').val(),
      ciudad: $('#ciudad').val(),
      telefono: $('#telefono').val(),
      telefonoCelular: $('#telefonoCelular').val(),
      TipoVivienda: $('#TipoVivienda').val(),
      cuenta: $('#CodCuenta').val()
    }
   }).done(function(res){
     if(res==1){
       alert("datos actualizados");
     }
     else{
       alert("error");
     }

   });

 }else{
   alert("datos en blanco");
 }

});




$('#buscarCedula').click(function(){

  $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
  if($('#identidadB').val()!=""){
    var Codi=$('#identidadB').val().split("-");
 $.ajax({
 type: "POST",
 url: "../mostrar/buscarCedula.php",
 data: {
   numero_cedula: $('#identidadB').val(),
   cuenta: Codi[2]
 }
}).done(function(res){
  if(res!="0"){

    alert("cedula encontrada en la base de datos!!");
    
    var informacion_cliente=res.split("<>");
      $('#Nombre').val(informacion_cliente[0]);
      $('#apellido').val(informacion_cliente[1]);
      $('#direccion').val(informacion_cliente[2]);
      $('#cedula').val(informacion_cliente[3]);
      $('#edad').val(informacion_cliente[4]);
      $('#CodCuenta').val(informacion_cliente[5]).prop("disabled","true");
      $('#monto').val(informacion_cliente[6]).prop("disabled","true");
      $('#CodLibreta').val(informacion_cliente[7]).prop("disabled","true");
      
      $('#Nacionalidad').val(informacion_cliente[8]);
      $('#CiudadN').val(informacion_cliente[9]);
      $('#tipoDeSexo').val(informacion_cliente[10]).prop("disabled","true");
      $('#EstadoCivil').val(informacion_cliente[11]);
      $('#Nhijos').val(informacion_cliente[12]);
      $('#NDepen').val(informacion_cliente[13]);
      $('#NivelEdu').val(informacion_cliente[14]);
      $('#Ocupacion').val(informacion_cliente[15]);
      $('#ciudad').val(informacion_cliente[16]);
      $('#telefono').val(informacion_cliente[17]);
      $('#telefonoCelular').val(informacion_cliente[18]);
      $('#TipoVivienda').val(informacion_cliente[19]);
      $('#monedaTexto').html(informacion_cliente[20]);
      $(".table").find("tbody").html(informacion_cliente[21]);  
    $('#CuentaYlibreta').fadeIn(300);
     $('#texto2').fadeIn(300);
       $("#agregarCliente").hide();
  }else if(res=="0"){
    limpiarcajas();
 
$("#myModal").modal('show');
}
});
}else{
  alert('caja vacia!!');
}
});

$('#obtenerOpcion').click(function(){

if(($("input[name='opciones']:checked").val())=="opcion1"){
  $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
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




