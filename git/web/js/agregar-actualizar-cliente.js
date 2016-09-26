$('document').ready(function(){
   var cantidadRegistros=0;
   var ids_b="";
 $('#agregar').click(function(){

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
     $('#TipoVivienda').val()!="" && obtenerDatos()!=""){
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
     C_B: obtenerDatos(),
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




$('#Actualizar').click(function(){
alert(obtenerDatos()+" ---- "+cantidadRegistros+"-----"+ids_b);
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
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
      cuenta: $('#CodCuenta').val(),
      DatosBeneficiarios: obtenerDatos(),
      actu_cantidad: cantidadRegistros,
      ids: ids_b
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
cantidadRegistros=0;
  $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
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
      cantidadRegistros=informacion_cliente[22];
      ids_b=informacion_cliente[23];
      

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

});

function obtenerDatos(){
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
          return textoBeneficiario;
}