<?php
define('user','root');
define('password','SistemasOperativos');
define('host','localhost');
define('DB','web');
$conexion=mysqli_connect(host,user,password);
mysqli_select_db($conexion,DB);
?>
