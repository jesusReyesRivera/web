<?php

session_start();
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
include("../sesion/conexion.php");

$id=$_POST['id'];
$estado=$_POST['estado'];

if($estado==0){
	$estado='1';
}else if($estado==1){
 $estado='0';
}

$query="update usuarios set estado=? where idUsuario=?";

$stmt=$conexion->prepare($query);
$stmt->bind_param('si',$estado,$id);
if($stmt->execute()){
	echo "hecho";
}else{
	echo "error";
}

}
else{
    header("location: ../admin");
}

?>