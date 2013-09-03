<?php include("/configuracion/clases/listadoPacientesInternos.php") ?>
<?php 
$muestraPI=new listadoPacientesInternos();
$muestraPI->listadoPI($ALMACEN,$basedatos);
?>