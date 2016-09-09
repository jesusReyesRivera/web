<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
	?>
	<!doctype html>
	<html>
		<head>
			<title>Ephamoney | remesas</title>
			  <meta name="viewport" content="width=device-width, initial-scale=0.8, user-scalable=no">
 <meta charset="utf-8">
 <meta http-equiv="Content-Type" content="text/html;" charset="utf-8">
		</head>
		<body style="  background: url('../imagenF.jpg'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; padding-top: 70px;">
				<link href="../estilos/estilos.css" rel="stylesheet">
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
         <li><a href="index.php">volver</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </nav>
  <div class="container">
  	  <div class="panel panel-info">
  	<div class="panel-heading">
  	Remesas	
  	</div>
  	<div class="panel-body">
  				<div class="row">
  		<div class="container">
  				<div class="col-lg-6">
  				<input type="text" id="clave" placeholder="clave" name="clave" class="form-control" required>
  			</div>
  			<div class="col-lg-2">
  				<button type="button" id="buscar" name="buscar" class="btn btn-info">buscar</button>
  			</div>
  		</div>
  		
  		</div>
  	</div>
  	<div class="panel-footer"></div>
    
  </div>
  <div id="receptor"></div>
  </div>

   <script src="../js/jquery.min.js"></script>
   <script src="../js/bootstrap.js"></script>
   <script>
   $("#buscar").click(function(){
    $("#receptor").html("");
   $.ajax({
 type: "POST",
 url: "datosRemesas.php",
 data: {
 	clave: $("#clave").val()
 }
   }).done(function(res){
$("#receptor").html(res);
   });
   });

   	
   </script>
		</body>
	</html>

  <?php
}else{
	  header("location: http://93.188.166.74/web");
}
?>