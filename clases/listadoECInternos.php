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
  <table width="705" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#330099">
      <th width="42" scope="col"><div align="left" class="blanco">
          <div align="center">Folio</div>
      </div></th>
      <th  scope="col"><div align="left" class="blanco">
          <div align="center">Nombre del paciente</div>
      </div></th>
      <th  scope="col"><div align="left" class="blanco">
          <div align="center">Seguro</div>
      </div></th>
      <th  scope="col"><div align="left" class="blanco">
          <div align="center">Depto.</div>
      </div></th>
      <th  scope="col"><div align="left" class="blanco">
          <div align="center">Cuarto</div>
      </div></th>
      <?php if($myrow2['transacciones']=='si'){ ?>
      <th scope="col"><div align="left" class="blanco">
          <div align="center">Edo. Cta</div>
      </div></th>
      <?php }?>
    </tr>
    <tr bgcolor="#FFFFFF">
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

ORDER BY paciente ASC";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 



if($myrow['seguro']){
$sSQL40= "SELECT nomCliente
FROM
clientes
where 
numCliente='".$myrow['seguro']."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
}else{
$myrow40['nomCliente']='Particular';
}
	  ?>
    </tr>
    <tr bgcolor="#FFFFFF" onmouseover="bgColor='#ffff33'" onmouseout="bgColor='#ffffff'" >
      <td height="24" class="codigos"><?php echo $myrow['folioVenta'];
?></td>
      <td width="260" class="normal"><?php echo $myrow['paciente'];

	  ?>
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
          <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>
      </td>
      <td width="177" class="normal"><?php echo $myrow40['nomCliente'];?></td>
      <td width="83" class="normal"><div align="center"><?php echo $myrow['almacen'];?></span></span></div></td>
      <td width="61" class="normal" align="center"><?php 
	  if($myrow['cuarto']){
	  echo $myrow['cuarto'];
	  }else{
	  echo '---';
	  }
?></td>
      <?php if($myrow2['transacciones']=='si'){ ?>
      <td width="56" class="normal"><div align="center"><a href="#abonos<?php echo $a;?>" name="abonos<?php echo $a;?>" id="abonos<?php echo $a;?>" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/agregarAbonos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"><img src="/sima/imagenes/btns/edocta.png" alt="Pacientes Activos" width="22" height="22" border="0" /></a></div></td>
      <?php  }//fin de transacciones?>
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