<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  require_once("../dompdf/dompdf_config.inc.php");
  include("../sesion/conexion.php");


  $textt="<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/></head><body style='font-size: 12'><p align='justify'>CONTRATO PARA CUENTA DE AHORRO ORDINARIA PERSONA NATURAL</p>
<p align='justify'>  
Nosotros Entidad de AHORRO Y CREDITO con domicilio en el departamento de Intibucá: Inscrita en el TOMO  X  FOLIO 268 del libro que para efecto lleva la oficina de desarrollo del sector social  de la economía (O.D.S) como una empresa de economía social y financiamiento de primer grado a través de la solicitud No. 528-2013 fue APROBADA mediante resolución favorable  No 647-2013 de conformidad al artículo No. 4  del reglamento social de sector de la economía  (acuerdo ejecutivo 254-97); y__________________________ quien es mayor de edad con domicilio en ___________________________ con documento de identidad numero__________________________ <br>A quien en lo sucesivo se denominará el CLIENTE hemos convenido en celebrar el presente contrato de apertura de cuenta de ahorro ordinaria #_______________________________
De acuerdo a las siguientes clausulas</p><br>
<p>
<ol type='1' start='1'>
<li><p  align='justify'> MINIMO DE APERTURAS: La apertura de la cuenta de ahorro ordinario requerirá del depósito de la cantidad mínima vigente en la tabla de “Tarifas, intereses, cargos, comisiones mínimos y cobros por servicios financieros” misma que será entregada al cliente y formará parte del presente contrato, adicionalmente la caja entidad de ahorro y crédito mantendrá las tablas de costo a disposición en las sucursales, reservándose el derecho de no entregar al CLIEENTE nuevas libretas.
</p></li><li><p align='justify'> INTERESES Y FORMA DE CALCULO:  Los depósitos de ahorro devengaran intereses o cualquier otro rendimiento. La tasa de interés será determinada en virtud de la moneda del depósito en correspondencia con el saldo mantenido en la cuenta en el día de su generación tal como establezca en la tabla de “Tarifas, intereses, cargos, comisiones por servicios financieros” mismo que será entregada al cliente y formará parte del presente contrato, adicionalmente la caja entidad de ahorro y crédito mantendrá las tablas de costo a disposición en las sucursales.
Los intereses se devengarán a partir de la fecha de confirmación de los fondos y hasta el día anterior al cierre de la cuenta. Los intereses se acumularán diariamente y serán capitalízales mensualmente acreditándose a la cuenta.
</p></li><li><p align='justify'> LIBRETAS: Para efectuar retiros de su cuenta en las ventanillas de la caja de ahorro y crédito será necesaria la presentación de la libreta que para tal efecto la entidad de ahorro y crédito suministrará al EL CLIENTE en el momento de suscripción del contrato. La libreta será el único documento impreso en que se registrará los créditos, débitos y saldos de la cuenta.
En el caso de pérdida de la libreta EL CLIENTE deberá notificarlo inmediatamente a la caja de ahorro y crédito debiendo presentarse a la sucursal en un plazo no mayor de a doce horas a llenar el formato correspondiente para la reposición asumiendo EL CLIENTE los costos que se generen. Los que serán debitados de la cuenta del CLIENTE.  LA CAJA DE AHORRO Y CRÉDITO no asume ninguna responsabilidad por retiros de fondos con libretas extraviadas dentro del término prescrito.
</p><li><p align='justify'> RESPONSABILIDADES Y OBLIGACIONES: La custodia de las libretas de ahorro será responsabilidad exclusiva del CLIENTE debiendo observar las precauciones para evitar su extravió o sustracción quedando a caja de ahorro y crédito exento de responsabilidad por el mal uso que de ellas pudiera hacerse. EL CLIIENTE deberá presentar a la caja de ahorro y crédito la información necesaria para determinar y comprobar el origen de los fondos y activos a manejarse, el propósito y naturaleza de la relación y el volumen de la actividad esperada mensualmente de la cuenta.
</p><br><li><p align='justify'>RESPONSABILIDADES DE LA CAJA DE AHORRO Y CREDITO: Extenderá por todo deposito que perciba el comprobante que imprima el sistema de cómputo que la caja de ahorro utiliza para el control de cuentas.

<li> <p align='justify'> CUENTAS INACTIVAS: Si durante doce (12) meses consecutivos la cuenta no ha tenido ningún movimiento, esta será trasladada automáticamente a INACTIVA y podrá recibir depósitos únicamente hasta tanto el CLIENTE no se presente a la caja de ahorro y crédito para reactivarla.

<li> <p align='justify'> DECLARACION Y RECONCIMIENTO DE FIRMA: El CLIENTE hace constar que a firma al pie del presente contrato es la que utiliza para firmar cualquier gestión financiera, bancaria, administrativa o judicial y es a cuál registro ante la caja de ahorro y crédito y se da por entendido y acepa que los documentos refrendados con ella no requerirán requerimiento judicial alguno.
</ol>
En fe de lo cual aceptamos y suscribimos el presente contrato en la ciudad de________________________, el día de, _________de_________del 20_____________
</p>
<br><br>
<center><p>________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________</p></center>    
<center><p>FIRMA DEL CLIENTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRMA AUTORIZADA</p></center>
</body></html>";
  $dompdf=new DOMPDF();

  $dompdf->load_html($textt,"utf-8");
  ini_set("memory_limit","128M");
  $dompdf->render();
  $pdf = $dompdf->output();
  file_put_contents("imprimirAbono.pdf", $pdf);

}
?>
