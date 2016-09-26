$('document').ready(function(){

	//--------------------codigo para abono
 $('#Ab').click(function(){
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
       }
     });
     $('#depositoAplazo').hide();
     $('#RectificarRecibo').hide();
   $('#buscarCliente').hide();
   $('#reportes').hide();
   $('#texto0').hide();
   $('#texto2').hide();

   $('#codigo').val('');
   $('#AbonoCuenta').val('');
   $('#valor').val('').prop('disabled','true');
   $('#libreta').val('').prop('disabled','true');;
$('#saldos').html('');
$('#ClienteAbono').html('');
$('#numCedulaAbono').html('');
   $('#divRetiro').hide();
   $('#texto').hide();
    $('#CuentaYlibreta').hide();
    $("#agregarCliente").hide();

    $('#divAbono').show();
 });

 //--------------------codigo para retiro
 $('#Re').click(function(){
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
       }
     });

     $('#depositoAplazo').hide();
     $('#RectificarRecibo').hide();
   $('#buscarCliente').hide();
   $('#reportes').hide();
   $('#texto0').hide();
   $('#texto2').hide();
   $('#codigo').val('');
   $('#texto').hide();
   $('#divAbono').hide();
   $('#CuentaYlibreta').hide();
   $("#agregarCliente").hide();

   $('#CuentaRetiro').val('');
   $('#saldos2').html('');
      $('#ClienteR').html('');
      $('#NumCedula').html('');
      $( "#libretaRetiro" ).prop( "disabled",true ).val('');
   $( "#valorRetiro" ).prop( "disabled", true ).val('');
   $( "#RetiroAceptar" ).prop( "disabled",true );
    $('#divRetiro').fadeIn(100);
 });

 $('#DepositosAPlazoFijo').click(function(){
  $('#depositoAplazo').hide();
  $('#RectificarRecibo').hide();
  $("#informacionCLiente").hide();
   $('#buscarCliente').hide();
   $('#reportes').hide();
   $('#texto0').hide();
   $('#texto2').hide();

   $('#codigo').val('');
   $('#AbonoCuenta').val('');
   $('#valor').val('').prop('disabled','true');
   $('#libreta').val('').prop('disabled','true');;
$('#saldos').html('');
$('#ClienteAbono').html('');
$('#numCedulaAbono').html('');
   $('#divRetiro').hide();
   $('#texto').hide();
    $('#CuentaYlibreta').hide();
    $("#agregarCliente").hide();

    $('#divAbono').hide();
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
       }
     });
      $.ajax({
       type: "POST",
       url: "../mostrar/depositosAplazoFIjo.php"
     }).done(function(res){
       $('#depositoAplazo').html("");
      $('#depositoAplazo').html(res);
       $('#depositoAplazo').show();
     });
   

 });

  $('#rectificar').click(function(){
  $('#depositoAplazo').hide();
  $("#informacionCLiente").hide();
   $('#buscarCliente').hide();
   $('#reportes').hide();
   $('#texto0').hide();
   $('#texto2').hide();

   $('#codigo').val('');
   $('#AbonoCuenta').val('');
   $('#valor').val('').prop('disabled','true');
   $('#libreta').val('').prop('disabled','true');;
$('#saldos').html('');
$('#ClienteAbono').html('');
$('#numCedulaAbono').html('');
   $('#divRetiro').hide();
   $('#texto').hide();
    $('#CuentaYlibreta').hide();
    $("#agregarCliente").hide();

    $('#divAbono').hide();
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
       }
     });
      $.ajax({
       type: "POST",
       url: "../mostrar/RectificarRecibo.php"
     }).done(function(res){
       $('#RectificarRecibo').html("");
      $('#RectificarRecibo').html(res);
       $('#RectificarRecibo').show();
     });
 });

  $('#RetiroAceptar').click(function(){
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
       }
     });
  $('#RetiroAceptar').prop( "disabled",true);
  var cuentaRetiro=$('#CuentaRetiro').val();
  var valorRetiro=$('#valorRetiro').val();
  var libretaRetiro=$('#libretaRetiro').val();
  if(cuentaRetiro!="" && valorRetiro!="" && libretaRetiro!=""){
    $.ajax({
  type: "POST",
  url: "../ConsultarDatos/saldos.php",
  data: {
    cuenta: $('#CuentaRetiro').val()
  }

}).done(function(res){
  var saldo=0;
  var rres=res.split("+");
  if(Number(valorRetiro)<Number(rres[0])){
    var alerta="esta seguro que desea retirar "+valorRetiro+" a la cuenta:"+cuentaRetiro;
    if(confirm(alerta)){
    saldo=rres[0];
   $.ajax({
     type: "POST",
     url: "../agregarDatos/retiros.php",
     data: {
       RetiroCuenta: cuentaRetiro,
       RetiroValor: valorRetiro,
       RetiroLibreta: libretaRetiro
     }
   }).done(function(res){
     
     if(res!="0-0"){
     var texto3=res.split("*");
     var texto4=texto3[1].split("+");
     
     
     if(texto3[0]=="1"){

           saldo=saldo-$( "#valorRetiro" ).val();
       $('#CuentaRetiro').val('').focus();
       alert("Agregado!!");
     var rtn=texto4[3];
     var nom=texto4[4];
     var movimientoID=texto4[5];

       var mywindow = window.open('', 'my div', 'height=400,width=600');
    mywindow.document.write('<html><head><title>Retiro</title>');
    mywindow.document.write('<center><img style="border-radius: 5px; width: 180; height: 120" src="../ia.png"></img></center><br><h4>RTN: '+rtn+'</h4><h3> Cooperativa '+nom+'</h3><h3>Numero de movimiento: '+movimientoID+'</h3><h5>Numero de Cuenta: '+cuentaRetiro+'</h5><h5>Numero de libreta: '+libretaRetiro+'</h5>Cliente: '+texto4[0]+" "+texto4[1]+'<p>#Identidad: '+texto4[2]+'</head><body>');
     var d = new Date();
    mywindow.document.write("<p>Fecha: "+d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+", "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+"</p><p>Tipo: Retiro</p><p>Monto: "+number_format($( "#valorRetiro" ).val(), 2)+" lps</p><p>Saldo Actual: "+number_format(saldo, 2)+" lps</p><br><br><Br><center><p><hr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</hr></p><p>Firma del cliente</p></center>");

     $( "#libretaRetiro" ).prop( "disabled",true ).val('');
     $('#saldos2').html('');
     $('#ClienteR').html('');
     $('#NumCedula').html('');
     $( "#valorRetiro" ).prop( "disabled", true ).val('');
     $( "#RetiroAceptar" ).prop( "disabled",true );
    mywindow.document.write('</body></html>');
 mywindow.print();
     mywindow.setTimeout(function () {
      mywindow.focus();mywindow.close();},1000);
    return true;
     }else{

       alert("Hubo un error!!");
       $('#RetiroAceptar').prop( "disabled",false);
     }
}else{ alert("Hubo un error!!");

 $('#RetiroAceptar').prop( "disabled",false);}
   });
}
  }else{
    alert('#Cantidad excesiva!');
$('#RetiroAceptar').prop( "disabled",false);
  }

});

}
   else{
     alert("datos en blanco");
     $('#RetiroAceptar').prop( "disabled",false);
   }
 });

  

  $('#AbonoAceptar').click(function(){
  $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
       }
     });
  var cuentaAbono=$('#AbonoCuenta').val();
  var valorAbono=$('#valor').val();
  var libretaAbono=$('#libreta').val();
  if(cuentaAbono!="" && valorAbono!="" && libretaAbono!=""){
     var op="Esta seguro que desea depositar "+valorAbono+" a la cuenta "+cuentaAbono;
    if(confirm(op)){
  $.ajax({
    type: "POST",
    url: "../agregarDatos/abonos.php",
    data: {
      AbonoCuenta: cuentaAbono,
      AbonoValor: valorAbono,
      AbonoLibreta: libretaAbono
    }
  }).done(function(res){
    $( "#AbonoAceptar" ).prop( "disabled",true );
      if(res!="0-1" && res!="0-2" && res!="0-3" && res!="0-4"){
     var texto3=res.split("*");
     var texto4=texto3[1].split("+");
    if(texto3[0]=="1"){
      alert("Agregado!!");
      $.ajax({
    type: "POST",
    url: "../ConsultarDatos/saldos.php",
    data: {
      cuenta: cuentaAbono
    }
  }).done(function(respuesta){
     var rres=respuesta.split("+");
     $('#AbonoCuenta').val('').focus();
    var mywindow = window.open('', 'my div', 'height=400,width=600');
 mywindow.document.write('<html><head><title>Aportacion</title>');
  var rtnA=texto4[3];
     var nomA=texto4[4];
      var AbonoMovimiento=texto4[5];
 /*optionaltylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
 mywindow.document.write('</head><body>');
     mywindow.document.write('<center><img style="border-radius: 5px; width: 180; height: 120" src="../ia.png"></img></center><br><h4>RTN: '+rtnA+'</h4><h3>Cooperativa '+nomA+'</h3><h3>Numero de movimiento:'+AbonoMovimiento+'</h3><h5>Numero de Cuenta:'+cuentaAbono+'</h5><h5>Numero de libreta: '+libretaAbono+'</h5>Cliente: '+texto4[0]+" "+texto4[1]+'<p>#Identidad: '+texto4[2]+'</head><body>');
     var d = new Date();
    mywindow.document.write("<p>Fecha: "+d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+", "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+"</p><p>Tipo: Deposito</p><p>Monto: "+number_format($( "#valor" ).val(), 2)+" LPS</p><p>Saldo Actual: "+number_format(rres[0],2)+" lps</p> <br><br><Br><center><p><hr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</hr></p><p>Firma del cliente</p></center>");


 $('#valor').val('');
 $('#libreta').val('');
$('#saldos').html('');
$('#ClienteAbono').html('');
$('#numCedulaAbono').html('');
 $( "#libreta" ).prop( "disabled",true );
 $( "#valor" ).prop( "disabled", true );
 $( "#AbonoAceptar" ).prop( "disabled",true );
 mywindow.document.write('</body></html>');
 mywindow.print();

     mywindow.setTimeout(function () {
      mywindow.focus();mywindow.close();},1000);
 return true;
  });


    }else{
      alert("Hubo un error!");
      $( "#AbonoAceptar" ).prop( "disabled",false);
    }
  }else{
    alert("Hubo un error!");
    $( "#AbonoAceptar" ).prop( "disabled",false);
  }
  });

  }
  }else{
    alert("datos en blanco");
    $( "#AbonoAceptar" ).prop( "disabled",false );
  }
});


$('#AbonoCuenta').keydown(function(evt){
    $.ajax({
       type: "POST",
       url: "../sesion/f-t.php"
     }).done(function(res){
      
     if(res=="false"){
         window.location.href="../";
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
         window.location.href="../";
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


});