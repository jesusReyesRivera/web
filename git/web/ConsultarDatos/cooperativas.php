<?php

session_start();
if(isset($_SESSION['Sesion']) && $_SESSION['Sesion']==true){
include("../sesion/conexion.php");
$query="select nombre, cooperativaID from cooperativas";

$resultado=mysqli_query($conexion,$query);


while($line=mysqli_fetch_array($resultado)){
$texto.='<option value="'.$line['cooperativaID'].'">'.$line['nombre']."</option>";
}


echo $texto;
}else{
    header("location: ../admin");
}
?>
