<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=900,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
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
  <table width="590" border="0.2" align="center">
    <tr>
      <th width="33" bgcolor="#660066" scope="col"><div align="left" class="blanco">Folio</div></th>
      <th bgcolor="#660066"  scope="col"><div align="left" class="blanco">Nombre del paciente:</div></th>
      <th bgcolor="#660066"  scope="col"><div align="left" class="blanco">Seguro</div></th>
      <th bgcolor="#660066"  scope="col"><div align="left" class="blanco">Depto.</div></th>
      <th bgcolor="#660066"  scope="col"><div align="left" class="blanco">Cuarto</div></th>
      <?php if($myrow2['transacciones']=='si'){ ?>
      <th bgcolor="#660066" scope="col"><div align="left" class="blanco"></div></th>
	  	  <?php }?>
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
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
status = 'activa'

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
	  <?php echo $seguro;?></td>
      <td width="91" bgcolor="<?php echo $color?>" class="normal">
      
      
	  <?php 
 $sSQL1711s= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad = '".$entidad."'
and
almacen='".$myrow['almacen']."'

";
$result1711s=mysql_db_query($basedatos,$sSQL1711s);
$myrow1711s = mysql_fetch_array($result1711s);
	  
	  echo $myrow1711s['descripcion'];?></span></span></td>
      <td width="46" bgcolor="<?php echo $color?>" class="normal"><?php 
	  if($myrow['cuarto']){
	  echo $myrow['cuarto'];
	  }else{
	  print '---';
	  }
?></td>

      <td width="50" bgcolor="<?php echo $color?>" class="normal">




        <div align="center"><a href="#" 
onclick="javascript:ventanaSecundaria111('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&almacen=<?php echo $ALMACEN; ?>&almacenFuente=<?php echo $ALMACEN; ?>&nT=<?php echo $nT; ?>&tipoCliente=<?php echo $tipoCliente;?>&tipoMovimiento=<?php echo 'transaccion';?>&tipoPaciente=<?php echo 'interno';?>&abono=si&random=<?php echo rand(5000,500000);?>&folioVenta=<?php echo $myrow['folioVenta'];?>')">
          <img src="/sima/imagenes/agregar.gif" alt="" width="12" height="12" border="0" /></a></div></td>

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