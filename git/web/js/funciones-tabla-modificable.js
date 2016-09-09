
$('document').ready(function(){
  //mostrar clientes
  /* $('#clientes_registrados').ready(function(){
     $.ajax({
       type: "POST",
       url: "../mostrar/clientes.php"
     }).done(function(res){
       $('#clientes_registrados').html(res);
     });
   });
   */
jQuery.fn.shift = [].shift;

  $(".agregarfila").click(function(){
var contadorFIlas=0;
    $('#tablaB').find('tr:not(:hidden)').each(function(){
  contadorFIlas++;
    });

    if(contadorFIlas<=3){
        var $clonar=$('#tablaB').find('tr.hide').clone(true).removeClass('hide table-line');
    $('#tablaB').find('table').append($clonar);
    }else{
      alert("solo se permiten 3 beneficiarios o menos");
    }

  });

$(".removerfila").click(function(){
  $(this).parents("tr").detach();
});

$(".obtenerTexto").click(function(){

  var rows=$("#tablaB").find('tr:not(:hidden)');
var contador=[];
  $(rows.shift()).find("th:not(:empty)").each(function(){
    contador.push($(this).text());

  });

var texto="";
var contadorCamposVacios=0;
    rows.each(function(){

          var td= $(this).find('td');
        
          contador.forEach(function(contador, i){
               if(td.eq(i).text()==""){
               contadorCamposVacios++;
              }
                   
              texto=texto+td.eq(i).text()+"+";

          });

         texto=texto+"/";
    });
     if(contadorCamposVacios>0){
            alert("campos vacios");
          }
alert(texto);
});


  
});