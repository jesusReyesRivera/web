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

  function notext(evt) {

      evt = (evt) ? evt : window.event;

      var charCode = (evt.which) ? evt.which : evt.keyCode;

      if (charCode>31 && (charCode<46 || charCode>57)) {
          if(charCode==47){
          status = "This field accepts numbers only.";

          return false;
}
  return false;
      }


      return true;

  }

  function notext_bn(evt,texto) {

    if($(texto).text()>10){
      alert("el porcentaje no debe de pasar de 100");
      return false;
    }

      evt = (evt) ? evt : window.event;

      var charCode = (evt.which) ? evt.which : evt.keyCode;

      if (charCode>31 && (charCode<46 || charCode>57)) {
          if(charCode==47){
          status = "This field accepts numbers only.";

          return false;
}
  return false;
      }


      return true;

  }


  function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function ObtenerMonedas(){
  $.ajax({
   type: "POST",
   url: "../ConsultarDatos/monedas.php",
   success: function(res){
   $("#monedaTexto").html(res);
   }  
  });
}

sumaFecha = function(d, fecha)
{
 var Fecha = new Date();
 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
 var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
 var aFecha = sFecha.split(sep);
 var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
 fecha= new Date(fecha);
 fecha.setDate(fecha.getDate()+parseInt(d));
 var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 mes = (mes < 10) ? ("0" + mes) : mes;
 dia = (dia < 10) ? ("0" + dia) : dia;
 var fechaFinal = dia+sep+mes+sep+anno;
 return (fechaFinal);
 }