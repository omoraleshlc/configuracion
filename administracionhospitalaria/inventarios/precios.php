<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); 
include("/configuracion/clases/listadoArticulosPrecio.php");?>
<?php 
$consultarArticulos=new consultaArticulosPrecio();
$consultarArticulos->consultarArticulos($ALMACEN,$entidad,$basedatos);
?>
