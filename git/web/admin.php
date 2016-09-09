<?php
session_start();
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
header("location: ./admin/");
}
else{
?>


 <html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"">
  <!-- estilos -->
   <link href="estilos/estilos.css" rel="stylesheet">
   <link href="estilos/signin.css" rel="stylesheet">
   <script src="js/jquery.min.js"></script>
   <script src="js/admin.js"></script>


 <title>Login</title>
 </head>
<body>

<div class="container">
    <form class="form-signin">
        <h1 class="form-signin-heading">Administrador</h1>
        <input  class="form-control input-sm" type="text" placeholder="Usuario" id="usuario" name="usuario" required="">
        <input class="form-control input-sm" type="password" placeholder="Password" id="password" name="password" required="">
        <input type="button" id="boton" name="boton" value="Ingresar" class="btn btn-primary" onclick="enviar()">

      </form>
      <img src="ia.png" style="position: absolute;" class="img-responsive">

  </div>

</body>
<!-- script -->

</html>
<?php

}
  ?>
