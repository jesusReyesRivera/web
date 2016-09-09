<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  require_once("../dompdf/dompdf_config.inc.php");
  include("../sesion/conexion.php");

  $query=("select nombre, apellido, direccion from usuarios");
$resultado=mysqli_query($conexion,$query);
$textt="";
$textt="<html>
        <head><h1><strong>Usuarios</strong></h1></head><body><table>
        <tr><td>Nombre</td><td>Apellido</td><td>Direccion</td>
        ";
  while($list=mysqli_fetch_array($resultado)){

    $textt.="<tr><td>".$list['nombre']."</td>";
    $textt.="<td>".$list['apellido']."</td>";
    $textt.="<td>".$list['direccion']."</td></tr>";

  }
  $textt.="</table></body></html>";
  $dompdf=new DOMPDF();

  $dompdf->load_html($textt);
  ini_set("memory_limit","128M");
  $dompdf->render();
  $pdf = $dompdf->output();
  file_put_contents("usuarios.pdf", $pdf);

}
?>
