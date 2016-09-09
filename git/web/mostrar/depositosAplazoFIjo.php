<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo'<div class="container">
      <div class="panel panel-primary">
       <div class="panel-heading">
           Depositos a plazo fijo
       </div>
       <div class="panel-body">
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" id="cuenta" name="cuenta">
            </div>
            <div class="col-xs-3">
              <input type="button" class="btn btn-primary" name="buscar" id="buscarCuenta" value="buscar">
            </div>
          </div>
        </div>
     </div>
     <div id="informacionCLiente">
       
        </div>

<script>
$("#informacionCLiente").hide();
$("#buscarCuenta").click(function(){

         
         $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
  if($("#cuenta").val()!=""){
    $.ajax({
       type: "POST",
       url: "../mostrar/ObtenerDatos.php",
       data: {
        cuenta: $("#cuenta").val()
       }

    }).done(function(res){
      
       if(res!="0" && res!="0-1"){
        $("#informacionCLiente").html("");
        $("#informacionCLiente").html(`
         <div class="panel panel-default">
          <div class="panel-heading">
             informacion personal
          </div>
          <div class="panel-body">
          <div class="row">
            <div class="col-xs-6">
            <label>Nombre Completo</label>  <input type="text" class="form-control" id="NombreCompleto" name="NombreCompleto">
            </div>
              <div class="col-xs-6">
             <label>Cedula</label> <input type="text" class="form-control" id="CedulaO" name="CedulaO">
            </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-6">
             <label>FEcha de ingreso</label> <input type="text" class="form-control" id="fechaIngreso" name="fechaIngreso">
            </div>
             <div class="col-xs-6">
      <label>Monto Cuenta</label> <input type="text" class="form-control" id="MontoO" name="MontoO">
            </div>
            </div>
          </div>
        </div>
  
        <div class=" responsive panel panel-default">
        <div class="panel-heading"><strong>Depositos a plazo fijo generados</strong></div>
       <div class="table-responsive">
        <table class="table table-condensed" id="cuerpo">
        
        </table>
        </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
          </div>
          <div class="panel-body">
           <form class="form-inline">
             <div class="form-group">
                <div class="input-group">

                <div class="input-group-addon">$</div>
               <input type="text" onkeypress="return notext(event)" class="form-control" id="montoDepo" placeholder="Monto" name="montoDepo">
               </div>
             </div>
             <div class="form-group">
               &nbsp; &nbsp; &nbsp; <label for="montoDepo">Plazo en dias</label>
               <select class="form-control" id="plazo">
               <option value="90">90</option>
               <option value="180">180</option>
               <option value="360">360</option>
               </select>
             </div>
             <div class="form-group">
                 &nbsp; &nbsp; &nbsp;<label for="InteresAnual">Interes Anual</label>
                <input type="text" class="form-control" id="InteresAnual" name="InteresAnual" placeholder="Interes Anual">
             </div>
           <input type="button" class="btn btn-info" value="vista previa" id="vp" name="vp">
       <div id="vista">

           </div>
           </form>
           
          </div>
          <div class="panel-footer">
          <div class="row">
          <div class="col-xs-2">
          <input type="button" class="btn btn-default" value="Generar Certificado" id="Gcertificado" name="Gcertificado">
          </div>
          <div class="col-xs-1">
          <img id="imagen" width=50 height=50  src="https://www.tmdn.org/tmdsview-web/resources/images/loading-gallery.gif" style="display: none">
           </div>

          </div>
         
          </div>
          </div>

        `);
         $( "#InteresAnual" ).prop( "readonly", true );
         var interes=0;
          var plazo="";
           var datos=res.split("<barraSeparadora>");
           var datos2=datos[0].split("+");
           $("#NombreCompleto").val(datos2[0]);
           $("#CedulaO").val(datos2[1]);
           $("#fechaIngreso").val(datos2[2]);
           $("#MontoO").val(datos2[3]);
           $("#cuerpo").html(datos[1]);

           $("#informacionCLiente").fadeIn(200);
           $("#plazo").click(function(){
           $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
            if( $("#plazo").val()==90){
             $("#InteresAnual").val("5%");
             interes=(5/100);
             plazo="90";
            }
              if( $("#plazo").val()==180){
             $("#InteresAnual").val("5.5%");
             interes=(5.5/100);
             plazo="180";
            }
              if( $("#plazo").val()==360){
             $("#InteresAnual").val("6%");
             interes=(6/100);
             plazo="360";
            }
           }); 

           $("#retirar").click(function(){
               $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });


           });

  $("#Gcertificado").click(function(){
$( "#Gcertificado" ).prop( "readonly", true );
       $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
    if($("#montoDepo").val()!="" && plazo!="" && $("#montoDepo").val()!="" && interes!="") {
      $("#imagen").css("display", "block");
      $.ajax({
 type: "POST",
 url: "../agregarDatos/depAPF.php",
 data: {
  cuenta:  $("#cuenta").val(),
  plazo: plazo,
  interes: interes,
  monto: $("#montoDepo").val()
}}).done(function(res){

  if(res!="0-0" && res!="0-1" && res!="0-2" && res!="0-3" && res!="0-4"){
    actualizarTabla();
    $("#imagen").css("display", "none");
    $("#montoDepo").val("");
    $( "#InteresAnual").val("");
    $( "#Gcertificado" ).prop( "readonly", false );
    $("#vista").html("");

       var mywindow = window.open("", "my div", "height=400,width=600");
        
    mywindow.document.write(res);
 mywindow.print();
    return true;
  }
});
}else{
  alert("no has llenado todos los campos!!");
}
    


});
           $("#vp").click(function(){
               $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="http://93.188.166.74/web";
       }
     });
            if($("#montoDepo").val()!="" && $("#InteresAnual").val()!=""){

       
var calculo=$("#montoDepo").val()*(1+(interes*($("#plazo").val()/360)));
var total=calculo-$("#montoDepo").val();
var retencion=total*0.1;
var totalInteres=total-retencion;
var totalRecibido=Number($("#montoDepo").val())+Number(totalInteres);
        var fecha= new Date();
var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 var fechaa=dia+"/"+mes+"/"+anno;
 var newfecha=sumaFecha($("#plazo").val(),fechaa);
var html="<div class=\"table-responsive\"><table class=\"table\"><thead><tr><th>Monto</th><th>Tasa</th><th>Plazo</th><th>Total</th><th>Retencion de 10%</th><th>Total de intereses</th><th>Recibe al final</th><th>Fecha</th></tr></thead><tbody><tr><td>"+$("#montoDepo").val()+"</td><td>"+$("#InteresAnual").val()+"</td><td>"+$("#plazo").val()+"</td><td>"+total+"</td><td>"+retencion+"</td><td>"+totalInteres+"</td><td>"+totalRecibido+"</td><td>"+newfecha+"</td></tr></tbody></table></div>";
            $("#vista").html(html);
          



  
            }else{
              alert("datos en blanco");
            }
           });

       }else{
        alert("error");
       }
    });
   
  }
});

function actualizarTabla(){
  if($("#cuenta").val()!=""){
    $.ajax({
       type: "POST",
       url: "../mostrar/ObtenerDatos.php",
       data: {
        cuenta: $("#cuenta").val()
       }

    }).done(function(res){
       if(res!="0" && res!="0-1"){
           var datos=res.split("<barraSeparadora>");
           $("#cuerpo").html(datos[1]);

}
        
           });
  }

};


</script>
';
}else{
  header("location: http://93.188.166.74/web");
}
?>

