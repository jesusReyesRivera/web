<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo'<div class="container">
      <div class="panel panel-primary">
       <div class="panel-heading">
           Rectificar Recibo
       </div>
       <div class="panel-body">
          <div class="row">
            <div class="col-xs-3">
              <input type="text" class="form-control" onkeypress="return notext(event);" placeholder="digite el numero de movimiento" id="idMovimiento" name="idMovimiento">
            </div>  
            <div class="col-xs-3">
              <input type="text" class="form-control" onkeypress="return notext(event);" placeholder="numero de cuenta" id="NUmCuenta" name="NUmCuenta">
            </div>
            <div class="col-xs-3">
              <input type="button" class="btn btn-primary" name="buscarMovimiento" id="buscarMovimiento" value="buscar">
            </div>
          </div>
        </div>
     </div>
     <div id="informacionMovimiento">
       
      </div>
      <script>
      $("#buscarMovimiento").click(function(){
        $("#buscarMovimiento").prop("disabled","true");
       var id=$("#idMovimiento").val();
        var cuenta=$("#NUmCuenta").val();
       if(id!="" && cuenta!=""){
        $.ajax({
         type: "POST",
         url: "../mostrar/obtenerMovimientos",
         data: {
          id: id,
          cuenta: cuenta
         },
         success: function(res){
             $("#buscarMovimiento").prop("disabled",false);
          var campos=res.split("+");
          var texto="";
          if(campos[5]=="retiro"){
            texto="retirada";
          }
          if(campos[5]=="abono"){
            texto="abonada";
          }
          $("#informacionMovimiento").html(`
          <div class="panel panel-info">
            <div class="panel-heading">
            Tipo de movimiento realizado: `+campos[5]+`
            </div>
            <div class="panel-body">
            <legend>Datos personales</legend>
            <div class="row">
               <div class="col-lg-4">
                 <div class="form-group">
                 <label class="control-label">Nombre completo: `+campos[0]+" "+campos[1]+`</label>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group">
                  <label class="control-label">No. de cedula: `+campos[2]+`</label>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group">
                   <label class="control-label">No. de cuenta: `+campos[3]+`</label>
                 </div>
               </div>
            </div>

               <legend>Movimiento</legend>
            <div class="row">
               <div class="col-lg-4">
                 <div class="form-group">
                   <label class="control-label">Cantidad `+texto+`: L`+number_format(campos[4],2)+`</label>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group">
                   <label class="control-label">Saldo actual: L`+number_format(campos[6],2)+`</label>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="form-group">
                   <label class="control-label">Fecha: `+campos[7]+`</label>
                 </div>
               </div>
            </div>
          </div>
          <div class="panel-footer">
          <form class="form-horizontal">
<fieldset>


<legend>Actualizar</legend>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Nueva Cantidad</label>  
  <div class="col-md-4">
  <input id="cantidadRectificada" name="cantidadRectificada" onkeypress="return notext(event);" type="text" placeholder="nueva cantidad" class="form-control input-md">

  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Observacion</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="observacion" name="observacion"></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <button type="button" id="button1id" name="button1id" class="btn btn-success">modificar</button>
    <button type="button" id="button2id" name="button2id" class="btn btn-danger">cancelar</button>
  </div>
</div>

</fieldset>
</form>
          
          </div>

           


          `);

      $("#button2id").click(function(){
location.reload(true);
      });


      $("#button1id").click(function(){

      var cantidadN=$("#cantidadRectificada").val();
      var observacion=$("#observacion").val();
      if(cantidadN!="" && observacion!=""){
        $.ajax({
          type: "POST",
          url: "../agregarDatos/AgregarRectificado",
          data: {
            idcuenta: campos[10],
            id: campos[9],
            cantidadN: cantidadN,
            cantidadV: campos[4],
            tipo: texto,
            saldoA: campos[6],
            saldoM: campos[11],
            observacion: observacion

          },
          success: function(res){
            if(res=="1"){
              alert("cambio exitoso!");
              $("#informacionMovimiento").html("");
            }
          }
        });
      }else{
        alert("cantidad vacia!!");
      }
      });


         }
        });

       }else{
        alert("caja en blanco");
             $("#buscarMovimiento").prop("disabled",false);
       }

      });

      </script>
';
}else{
  header("location: http://93.188.166.74/web");
}
?>