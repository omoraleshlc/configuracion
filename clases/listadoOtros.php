<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=450,height=700,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.style20 {font-size: 10px; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
<meta http-equiv="refresh" content="30" >
</head>

<body>
<?php require("/configuracion/funciones.php");//ventanasPrototype::links();

$sSQL2= "Select transacciones From almacenes WHERE almacen = '".$ALMACEN."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
<form id="form1" name="form1" method="get" action="#">
  <h1 align="center"> <?php echo $TITULO; ?></h1>
  <table width="445" border="0.2" align="center">
    <tr>
      <th width="33" bgcolor="#660066" scope="col"><div align="left" class="blanco">Folio</div></th>
      <th bgcolor="#660066"  scope="col"><div align="left" class="blanco">Nombre del paciente:</div></th>
      <th bgcolor="#660066"  scope="col"><div align="left" class="blanco">Responsable</div></th>
     
      <th bgcolor="#660066" scope="col"><div align="left" class="blanco"></div></th>
	  	  
    </tr>
    <tr>
<?php	
	  
$cierreCuentaReporte=new articulosDetalles();
 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
statusOtros='standby'
and
statusCuenta='cerrada'
ORDER BY paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$seguro=$myrow['seguro'];
$nT=$myrow['keyClientesInternos'];

$sSQL1711= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
numCliente = '".$seguro."'

";
$result1711=mysql_db_query($basedatos,$sSQL1711);
$myrow1711 = mysql_fetch_array($result1711);
$seguro=$myrow1711['nomCliente'];

if($seguro){
$tipoCliente='aseguradora';
} else {
$tipoCliente='particular';
}

if(!$seguro)$seguro='particular';




	  ?>
      <td height="24" bgcolor="<?php echo $color?>" class="normal">
	  
<?php echo $myrow['folioVenta'];
?></td>


      <td width="205" bgcolor="<?php echo $color?>" class="normal">

	  <?php echo $myrow['paciente'];
echo $cierreCuentaReporte->cierreCuentaReportes($entidad,$nT,$numeroE,$nCuenta,$basedatos);
	  ?>
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>      </td>

      <td width="139" bgcolor="<?php echo $color?>" class="normal">
	  <?php echo $myrow['responsableCuenta'];?></td>
 
      <td width="50" bgcolor="<?php echo $color?>" class="normal">




        <div align="center">
        
        
      <a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/agregarAbonosOtros.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>')"><img src="/sima/imagenes/btns/edocta.png" alt="Pacientes Activos" width="22" height="22" border="0" /></a>      </div></td>

    </tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>



<?php 
$titulo='prueba';
$url=$ventana;
$abajo=70;
$izquierda=0;
$ancho=300;
$alto=200;
//$ventanas=new ventanasPrototype();
//$ventanas->despliegaVentana($titulo,$url,$abajo,$izquierda,$anchura,$altura);?>


  <p>&nbsp;</p>
</form>
</body>
</html>