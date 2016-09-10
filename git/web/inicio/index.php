<?php 
session_start();
ob_start('comprimir_pagina'); 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
 ?>
 <!DOCTYPE html>
 <html>
  <meta name="viewport" content="width=device-width, initial-scale=0.8, user-scalable=no">
 <meta charset="utf-8">
 <meta http-equiv="Content-Type" content="text/html;" charset="utf-8">

 <head>
   <?php include('menu.php');?>
 </head>
 <body style="  background: url('../imagenF.jpg'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; padding-top: 70px;">
   <div class="container">
     <div id="texto0">
     </div>
     <div id="texto">
     </div>
     <div id="texto2">
     </div>
     <div id="buscarCliente">
     </div>
     <div id="reportes">
   </div>
   <div id="divAbono"></div>
     <div id="divRetiro"></div>
     <div id="CuentaYlibreta"></div>
     <div id="agregarCliente"></div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
          
             <small>Datos no encontrados, desea crear una Cuenta?</small>
           
        <div class="row">
          <div class="col-xs-2">
         <div class="radio">
     <label>
       <input type="radio" name="opciones" id="opciones1" value="opcion1" checked>
       si
     </label>
   </div>
 </div>
   <div class="col-xs-2">
   <div class="radio">
     <label>
       <input type="radio" name="opciones" id="opciones2" value="opcion2">
       no
     </label>
   </div>
 </div>
 </div>
      </div>
      <div class="modal-footer">
       <input type="button" class="btn btn-success"  data-dismiss="modal" value="OK" id="obtenerOpcion" name="obtenerOpcion">
       

      </div>
    </div>

  </div>
</div>
<div id="depositoAplazo">
</div>
<div id="RectificarRecibo">
</div>
</div>


   <script src="../js/jquery.min.js"></script>
   <script src="../js/bootstrap.js"></script>
   <script src="../js/funciones.js"></script>
   <script src="../js/agregar-actualizar-cliente.js"></script>
   <script src="../js/abonos-retiros.js"></script>
   <script src="../js/funciones-tabla-modificable.js"></script>
   
   
   <script src="../js/datepicker.js"></script>
        <script src="../js/mascara.js"></script>
        <script src="../js/funciones-random.js"></script>
   <link href="../estilos/date.css" rel="stylesheet">
   </body>
  


   </html>
   <?php

 }
 else
{
  header("location: ../");
}
   // Una vez que el búfer almacena nuestro contenido utilizamos "ob_end_flush" para usarlo y deshabilitar el búfer
ob_end_flush(); 
// Función para eliminar todos los espacios en blanco
function comprimir_pagina($buffer) { 
    $busca = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'); 
    $reemplaza = array('>','<','\\1'); 
    return preg_replace($busca, $reemplaza, $buffer); 
}
?>
