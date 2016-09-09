<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
?>
<link href="../estilos/estilos.css" rel="stylesheet">
<link href="../../tienda/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<nav class="navbar navbar-inverse  navbar-fixed-top" style="background: #08298A;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img style="border-radius: 5px; width: 70px; height: 30px" src="../ia.png"></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li  class="dropdown"><a id="test" class="dropdown-toggle" data-toggle="dropdown" href="#"> Bienvenido, 
        <?php
        echo $_SESSION["username"] ?>
         <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../sesion/salir.php">Salir</a></li>

          </ul>
        </li>
       
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Movimientos
            <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a  id="Re">retiros</a></li>
            <li><a id="Ab">Abonos</a></li>
             <li><a id="DepositosAPlazoFijo">Depositos a plazo fijo</a></li>
              <li><a id="rectificar">rectificar Recibo</a></li>
          </ul>
        </li>
         <?php
        if($_SESSION['tipo']=="1"){
        ?>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            Registros <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a id="aparecer">Reportes</a></li>
            <li><a id="aparecer2">Clientes</a></li>
         </ul>
       </li>
       <li><a href="remesas.php">Remesas</a></li>

       <?php
        }
       ?>
      </ul>
    </div><!--/.nav-collapse -->
  </nav>
<?php
}
else{
  header("location: http://93.188.166.74/web");
}
?>
