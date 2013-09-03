<?php 
class acumuladoAlmacenes {

public function acumuladosAlmacenes($fecha2,$fecha1,$hora1,$entidad,$basedatos){
?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
.style13 {color: #FFFFFF}
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <p align="center"><span class="style12">Departamentos: 
    </span>
    <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style7',$almacenSolicitante,$almacenDestino,$basedatos);
?>
  </p>
  <table width="317" border="0" align="center" class="style121">
    <tr>
      <td width="95" bgcolor="#660066"><div align="left" class="style13">Fecha Inicial </div></td>
      <td width="190"><div align="left">
          <label>
          <input name="fecha" type="text" class="style71" id="campo_fecha" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fecha']){
		 echo $_POST['fecha'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  onchange="javascript:this.form.submit();"/>
          </label>
          <input name="button" type="button" class="style121" id="lanzador" value="..." />
      </div></td>
    </tr>
  </table>
  <?php if($_POST['fecha'] and $_POST['fecha']<$fecha1){	?>
  <table width="441" border="0" align="center" class="style71">
    <tr>
      <th width="51" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">C&oacute;digo</div></th>
      <th width="212" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">Descripci&oacute;n</div></th>
      <th width="62" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">Importe</div></th>
      <th width="49" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">IVA</div></th>
      <th width="45" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">% IVA </div></th>
    </tr>
    <tr>
      <?php
 $sSQL= "
SELECT * FROM gpoProductos
WHERE 
entidad='".$entidad."' 
and
activo='activo'
";
 






if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$C=$myrow['codigoGP'];
$sSQL7="SELECT SUM(precioVenta) as acumulado,sum(iva) as iva
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 
and
cargosCuentaPaciente.gpoProducto='".$C."'
and
cargosCuentaPaciente.fecha1='".$_POST['fecha']."'
and
cargosCuentaPaciente.status!='transaccion'
and
cargosCuentaPaciente.almacen='".$_POST['almacenDestino']."'
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


?>
      <td bgcolor="<?php echo $color;?>" ><label> <?php echo $C?> </label>      </td>
      <td  bgcolor="<?php echo $color;?>" ><div align="left"><span class=""> <?php echo $myrow['descripcionGP']; ?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	   $cargos[0]+=$myrow7['acumulado'];
	  echo "$".number_format($myrow7['acumulado'],2);	  
	   ?></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	   $iva[0]+=$myrow7['iva'];
	  echo "$".number_format($myrow7['iva'],2);	  
	   ?></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	   if($cargos[0]!=NULL){
		$porcentajeIVA=($abonos/$cargos[0])*100;
        echo "$ ".number_format($porcentajeIVA,6);
	   }
	   ?></td>
    </tr>
    <?php }}}?>
  </table>
  <p>&nbsp;</p>
  <table width="513" border="0" align="center" class="style121">
    <tr>
      <td bgcolor="#660066" class="style11"><div align="center"><span class="style71"> Cargos </span></div></td>
      <td height="14" bgcolor="#660066" class="style11"><div align="center"><span class="style71"> Abonos</span></div></td>
      <td bgcolor="#660066" class="style11"><div align="center">IVA</div></td>
      <td bgcolor="#660066" class="style11">% Percentage </td>
      <td bgcolor="#660066" class="style11"><div align="center">IVA x Pagar </div></td>
    </tr>
    <tr>
      <td width="97" class="style121"><div align="center">
          <?php 
	
		echo "$ ".number_format($cargos[0],2);?>
      </div></td>
      <td width="106" height="23" class="style121"><div align="center"><span class="style71">
          <?php 		 
$sSQL71="SELECT SUM(precioVenta) as abonos
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 

and
cargosCuentaPaciente.fecha1='".$_POST['fecha']."'
and
status='transaccion'

  ";
  $result71=mysql_db_query($basedatos,$sSQL71);
  $myrow71 = mysql_fetch_array($result71);
$abonos=  $myrow71['abonos'];
		echo "$ ".number_format($myrow71['abonos'],2); 
		?>
      </span></div></td>
      <td width="96" class="style121"><div align="center"><span class="style71">
          <?php 		 
$sSQL711="SELECT SUM(iva) as ivaAcumulado
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 

and
cargosCuentaPaciente.fecha1='".$_POST['fecha']."'


  ";
  $result711=mysql_db_query($basedatos,$sSQL711);
  $myrow711 = mysql_fetch_array($result711);
$ivaAcumulado=  $myrow711['ivaAcumulado'];
		echo "$ ".number_format($myrow711['ivaAcumulado'],2); 
		?>
      </span></div></td>
      <td width="96" class="style121"><div align="center">
          <?php 
	   if($cargos[0]!=NULL){
		$porcentajeIVA=($abonos/$cargos[0])*100;
        echo "$ ".number_format($porcentajeIVA,6);
	   }
	   ?>
      </div></td>
      <td width="96" class="style121"><div align="center">
          <?php 
	   echo "$ ".number_format($ivaAcumulado*$porcentajeIVA,4);
	   ?>
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>
<?php 
}
}
?>