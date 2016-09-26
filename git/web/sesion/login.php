<?php
session_start();

  include("conexion.php");
$usuario = $_POST['usuario'];
$password = $_POST['password'];
if($usuario!="" && $password!=""){
$query="select cooperativas.nombre, cooperativas.rtn, usuarios.usuario, usuarios.idUsuario, 
usuarios.pass, usuarios.tipo, usuarios.estado from usuarios inner join 
cooperativas on usuarios.cooperativaID=cooperativas.cooperativaID
 where usuarios.usuario='".$usuario."' and usuarios.pass='".$password."'";
$resultado=mysqli_query($conexion,$query);
$contar=mysqli_num_rows($resultado);
$tipo="";
$id="";
while($lista=mysqli_fetch_array($resultado)){
$tipo=$lista['tipo'];
$id=$lista['idUsuario'];
$rtn=$lista['rtn'];
$nombre=$lista['nombre'];
$estado=$lista['estado'];
}
if($contar==1){

if($estado){
  $_SESSION['loggedin']=true;
  $_SESSION['start']=time();
  $_SESSION['username']=$usuario;
  $_SESSION['tipo']=$tipo;
  $_SESSION['idUsuario']=$id;
  $_SESSION['rtn']=$rtn;
  $_SESSION['nombre']=$nombre;
  echo "0";
}else{
  echo "0-0";
}

}
}else{
  header("location: ../");
}





?>
