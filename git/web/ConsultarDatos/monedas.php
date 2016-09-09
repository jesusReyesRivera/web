<?php

session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
include("../sesion/conexion.php");
$query="select TipoMonedaID, tipo from TipoMoneda";

$resultado=mysqli_query($conexion,$query);

$texto.='<select id="moneda" class="form-control">';
while($line=mysqli_fetch_array($resultado)){
$texto.='<option value="'.$line['TipoMonedaID'].'">'.$line['tipo']."</option>";
}
$texto.="</select>";


echo $texto;
}else{
    header("location: ../");
}
?>