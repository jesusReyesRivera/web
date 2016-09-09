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

   <script src="../js/jquery.min.js"></script>
   <script src="../js/bootstrap.js"></script>
   <script src="../js/funciones.js"></script>
   <script src="../js/mascara.js"></script>
   <link href="../estilos/demo.css" rel="stylesheet">



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
     <br>
     <div class="overlay-container"  style="overflow:hidden;">
       <div class="window-container zoomin">
         <div class="page-header">
           <h4>
             <small>Datos no encontrados, desea crear una Cuenta?</small>
           </h4>
         </div>
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
 <div clas="row">
   <div class="col-xs-3">
   </div>
   <div class="col-xs-4">
   </div>
   <div class="col-xs-5">
         <input type="button" class="btn btn-success" value="OK" id="obtenerOpcion" name="obtenerOpcion">
       </div>
       </div>
       </div>
     </div>

     <div id="depositoAplazo">
       
     </div>
     <div id="RectificarRecibo">
       
     </div>
</div>
   </body>
   <script src="../js/demo.js"></script>
   <script src="../js/datepicker.js"></script>
   <link href="../estilos/date.css" rel="stylesheet">

   </html>
   <?php

 }
 else
{
  header("location: http://93.188.166.74/web");
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
