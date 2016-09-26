<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   date_default_timezone_set('America/Tegucigalpa');
      include("../sesion/conexion.php");
	$abono=$_POST['a'];
	$retiros=$_POST['r'];

	if($abono!="" && $retiros!=""){
   
		$query="insert into cierre (idUsuario,Fecha) values(?,?)";
		$stmt=$conexion->prepare($query);
		$stmt->bind_param("is",$_SESSION['idUsuario'],date("Y-m-j"));
	   $resultado=$stmt->execute();
	   if($resultado){
            $id=mysqli_insert_id($conexion);
		    $query_2="insert into cierreDetalle (CierreID,Ingresos,Egresos) values(?,?,?)";
		    $stmt_2=$conexion->prepare($query_2);
		    $stmt_2->bind_param("idd",$id,$abono,$retiros);
	        $resultado_2= $stmt_2->execute();
              if($resultado_2){
              	$estado="1";
                   $agregar="insert into cierreUsuario (idUsuario,Fecha,Estado) values (?,?,?)";
		    $cierreUsuario=$conexion->prepare($agregar);
		    $cierreUsuario->bind_param("iss",$_SESSION['idUsuario'],date("Y-m-j"),$estado);
	        if($cierreUsuario->execute()){
	        	 echo "1";
	        	}else{
	        		echo "error";
	        	}
	        
              }
              else{
              	echo "error";
              }
	   }else{
	   	echo "error";
	   }
    
	}else{
		echo "error";
	}

}else{
	header("location ../");
}

?>