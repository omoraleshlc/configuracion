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
  <table width="669" border="0.2" align="center">
    <tr>
      <th width="37" bgcolor="#660066" class="blanco" scope="col"><div align="left"># </div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Nombre del paciente:</div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Seguro</div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Depto.</div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Cuarto</div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left">C</div></th>
	  <?php //if($myrow2['transacciones']=='si'){ ?>
      <?php //}?>
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
statusCuenta = 'abierta'
and
seguro!=''
ORDER BY paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
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
      <td height="24" bgcolor="<?php echo $color?>" class="blanco"><span class="normal">
	  
<?php echo $myrow['keyClientesInternos'];
?></span></td>


      <td width="193" bgcolor="<?php echo $color?>" class="normal">

	  <?php echo $myrow['paciente'];
echo $cierreCuentaReporte->cierreCuentaReportes($entidad,$nT,$numeroE,$nCuenta,$basedatos);
	  ?>
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>      </td>

      <td width="310" bgcolor="<?php echo $color?>" class="normal"><span class="normal"><span class="normal">
	  <?php echo $seguro;?></span></span></td>
      <td width="45" bgcolor="<?php echo $color?>" class="normal"><span class="normal"><span class="normal">
	  <?php echo $myrow['almacen'];?></span></span></td>
      <td width="46" bgcolor="<?php echo $color?>" class="normal"><span class="normal"><?php echo $myrow['cuarto']
?></span></td>
      <td width="12" bgcolor="<?php echo $color?>" class="normal">
	  
	  <a href="#" 
onClick="javascript:ventanaSecundaria11('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $ALMACEN; ?>&almacenFuente=<?php echo $ALMACEN; ?>&nT=<?php echo $nT; ?>&tipoCliente=<?php echo $tipoCliente;?>')"><img src="/sima/imagenes/listado.jpg" alt="Pacientes Activos" width="12" height="12" border="0" /></a></td>

<?php //if($myrow2['transacciones']=='si'){ ?>  
      <?php  //}//fin de transacciones?>
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




