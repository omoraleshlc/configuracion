<?php include("/configuracion/operacioneshospitalariasmenu/compras/menucompras.php"); ?>
<?php include("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=730,height=500,scrollbars=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=500,height=500,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventanaSecundaria3","width=500,height=500,scrollbars=YES") 
} 
</script> 



<?php 
if($_POST['send'] and $_POST['keyR'] and $_POST['pasoBandera']){
$keyR=$_POST['keyR'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($keyR[$i]){ 

$q = "UPDATE requisiciones set 

	statusCompras='standby'
		WHERE keyR='".$keyR[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		
		
		


}				
}	
}



?>

<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-system.css" title="win2k-cold-1" />
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
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<h1 align="center" class="titulos">Lista  de Requisiciones </h1>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="191" border="0" align="center">
    <tr valign="middle" class="style71">
      <th width="49" class="negro" scope="col"><span class="Estilo25">
        <input name="button" type="image"  id="lanzador" value="fecha"  src="/sima/imagenes/btns/fechadate.png"/>
      </span></th>
      <th width="283" scope="col"><div align="left">
          <input name="fechaSolicitud" type="text" class="camposmid" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $fecha2=$_POST['fechaSolicitud'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" onChange="javascript:this.form.submit();"/>
      </div></th>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="582" height="24" />
  <table width="582" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="68" bgcolor="#FFFF00" scope="col"><div align="left" class="none">
        <div align="left">Req.</div>
      </div></th>
      <th width="354" bgcolor="#FFFF00" scope="col"><div align="left"><span class="none">Departamento</span></div></th>
      <th width="46" bgcolor="#FFFF00" scope="col"><span class="none">StatusP.</span></th>
      <th width="46" bgcolor="#FFFF00" scope="col"><div align="left"><span class="none">Lista</span></div></th>
      <th width="46" bgcolor="#FFFF00" scope="col"><div align="left" class="none">
        <div align="left"></div>
      </div></th>
    </tr>
    <tr>
<?php	


$sSQL18= "
SELECT 
*
FROM
requisiciones
where
fecha='".$fecha2."'
and
statusCompras=''

";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];
$b+='1';
$a+='1';
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];

$requisicion=$myrow18['id_requisicion'];
$id_almacen=$myrow18['id_almacen'];
$id_proveedor=$myrow18['id_proveedor'];
if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL8= "Select descripcion From almacenes WHERE almacen='".$myrow18['id_almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

/* $sSQL2= "Select * From articulos WHERE codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2); */
$bandera1+=1;
?>
      <td height="24" bgcolor="<?php echo $color?>" class="negromid">
        <label><?php echo $myrow18['id_requisicion'];?></label></span></td>
      <td bgcolor="<?php echo $color?>" class="negromid"><?php echo $myrow8['descripcion'];?></td>
      <td bgcolor="<?php echo $color?>" class="negromid"><?php 
	  if($myrow18['statusProveedor']=='standby'){
	  echo $myrow18['statusProveedor'];
	  } else {
	  echo '---';
	  }
	  ?></td>
      <td bgcolor="<?php echo $color?>" class="negromid">
	  
	  
	  <a href="listaMaterialesSolicitados.php?keyR=<?php echo $myrow18['keyR']; ?>&amp;id_proveedor=<?php echo $id_proveedor; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>">
	  <img src="../../imagenes/btns/printbtn.png" alt="Imprimir " width="22" height="20" border="0" />	  </a>	  </td>
      <td bgcolor="<?php echo $color?>" class="negromid"></span>
        <label>
		<?php 
	  if($myrow18['statusProveedor']=='standby'){ ?>
        <input type="checkbox" name="keyR[]" value="<?php echo $myrow18['keyR']; ?>" />
		<?php } else { echo '---';}?>
		
      </label></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="582" height="24" />
  <div align="center" class="codigos">
<p><strong><br />
        <label>
        <?php if($bandera1>0){ ?>
        <input name="send" type="image" src="../../imagenes/btns/sendsolicitud.png" id="send" value="Enviar Solicitud" onclick="if(confirm('&iquest;Est&aacute;s seguro que deseas enviar la solicitud?') == false){return false;}" />
        </label>
        <label>
        <?php } ?>
        </label>
    </strong></p>
</div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>
    <input name="id_almacen" type="hidden" id="id_almacen" value="<?php echo $_POST['id_almacen']; ?>" />
    <span class="Estilo24">
    <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
  </span><strong>
  <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?>
  </strong></p>
  <p align="center"><a href="javascript:ventanaSecundaria('listadoOrdenesImpresion.php?id_requisicion=<?php echo $myrow1['numeroE']; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a><a href="javascript:ventanaSecundaria('listadoOrdenesImpresion.php?id_requisicion=<?php echo $_POST['nRequisicion']; ?>&amp;id_proveedor=<?php echo $id_proveedor; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a></p>
</form>


      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</body>

</html>