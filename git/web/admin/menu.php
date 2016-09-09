<?php
session_start();
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
?>
<link href="../estilos/estilos.css" rel="stylesheet">
<nav class="navbar navbar-inverse  navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img style="border-radius: 5px; width: 70; height: 30" src="../ia.png"></img></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li  class="dropdown"><a id="test" class="dropdown-toggle" data-toggle="dropdown" href="#">Cuenta<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../sesion/salirAdmin.php">Salir</a></li>

          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </nav>
<?php
}
else{
  header("location: http://93.188.166.74/web");
}
?>
