<?php include("/configuracion/operacioneshospitalariasmenu/compras/menucompras.php"); ?>
<?php include("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=730,height=500,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php

if($_POST['nRequisicion']){
$nRequisicion=$_POST['nRequisicion'];
}













//**************************************************CANTIDAD POSTERIOR

if($_POST['cPosterior'] and $_POST['articulosPosteriores']){
$articulosPosteriores=$_POST['articulosPosteriores'];
$cantidadRecibida=$_POST['cantidadRecibida'];
$cantidadFacturada=$_POST['cantidadFacturada'];
$obsequio=$_POST['obsequio'];

$code1=$_POST['codigoAlfa'];
$keyR=$_POST['keyR'];
$cost=$_POST['cost'];
for($i=0;$i<=$_POST['pasoBandera'];$i++){
$sSQL3= "Select * From OC WHERE  id_requisicion = '".$nRequisicion."' and codigo='".$code1[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$faltante=$myrow3['cantidadFacturada']-$myrow3['cantidadRecibida'];


$sSQL17= "Select * From OC WHERE  keyR = '".$keyR[$i]."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




if(!$myrow3['articulosPosteriores'] ){


if($articulosPosteriores[$i]<=$faltante and $faltante!=null){
$sSQL8= "Select * From existencias WHERE codigo= '".$code1[$i]."' and almacen='HALM'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);



if($myrow8['codigo']){

$q4 = "UPDATE existencias set 
existencia=existencia+'".$articulosPosteriores[$i]."',
usuario='".$usuario."',
fechaA='".$fecha1."',
hora='".$hora1."',
ID_EJERCICIO='".$ID_EJERCICIOM."'
WHERE codigo = '".$code1[$i]."'
and
almacen='HALM'
";
mysql_db_query($basedatos,$q4);
echo mysql_error();

} else {

$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,existencia
) values (
'".$code1[$i]."',
'HALM',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."',
'".$articulosPosteriores[$i]."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}


$q1 = "UPDATE OC set 
articulosPosteriores='".$articulosPosteriores[$i]."',
fechaFactura='".$_POST['fechaFactura']."'
WHERE keyR = '".$keyR[$i]."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();

}

}
//$leyenda="Se agregaron artículos posteriores";
}

$_POST['existencias']="";
$_POST['articulosPosteriores']="";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
.style13 {color: #000000}
.style14 {
	color: #FF0000;
	font-weight: bold;
}
.style16 {color: #FFFFFF; font-size: 12px; }
.style17 {color: #FFFFFF}
.style18 {font-size: 10px; color: #FFFFFF; }
.style19 {font-size: 12}
.style20 {color: #FFFFFF; font-size: 12; }
.style21 {
	color: #0000FF;
	font-size: 9px;
}
-->
</style>
</head>
      <?php
$cmdstr3 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$usuario."'";
$parsed3 = ociparse($db_conn, $cmdstr3);
ociexecute($parsed3);	 
$nrows3 = ocifetchstatement($parsed3,$resulta3);
for ($i = 0; $i < $nrows3; $i++ ){
$nombre = $resulta3['NOMBRE'][$i];
$apaterno= $resulta3['AP_PATERNO'][$i];
}


 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
id_requisicion='".$nRequisicion."' 

";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
$id_proveedor=$myrow18['id_proveedor'];
$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

?>
<h1 align="center">Recepci&oacute;n OC  <span class="style13"><strong><?php echo $nRequisicion;?> (Art&iacute;culos Posteriores) </strong></span></h1>
<form id="form1" name="form1" method="POST" action="">
  <table width="382" border="0" align="center" bgcolor="#FFFFFF" class="style7">
    <tr>
      <th width="121" bgcolor="#FFCCFF" scope="col"><div align="left" class="style13">Proveedor</div></th>
      <th width="243" bgcolor="#FFCCFF" scope="col"><div align="left" class="style13"><?php echo $myrow17['razonSocial'];?></div></th>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left" class="style13">Usuario Responsable:</div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $usuario.":".$nombre." ".$apaterno; ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF"><div align="left" class="style13">Fecha:</div></td>
      <td bgcolor="#FFCCFF"><div align="left" class="style13"><?php echo $fecha1;?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left" class="style13">Hora:</div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style13"><?php echo $hora1;?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF"># Factura: </td>
	  
	  <?php 
	  $sSQL3= "Select * From listaOC WHERE  nRequisicion = '".$nRequisicion."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
	  
	  ?>
	  
      <td bgcolor="#FFCCFF"><label>
        <input name="id_factura" type="text" class="style7" id="id_factura" size="10" 
		value="<?php 
		if($myrow3['id_factura']){
		echo $myrow3['id_factura'];
		} else {
		echo "0";
		}
		?>"
		 disabled="disabled"/>
      </label></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF">Remisi&oacute;n:</td>
      <td bgcolor="#FFFFFF"><input name="remision" type="text" class="style7" id="remision" size="10" 
		value="<?php 
		if(is_numeric($myrow3['remision'])){
		echo $myrow3['remision'];
		} else {
		echo "0";
		}
		?>"  disabled="disabled"/></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFCCFF"># Nota de Cr&eacute;dito: </td>
      <td bgcolor="#FFCCFF"><div align="left" class="style7">
        <input name="notaCredito" type="text" class="style7" id="notaCredito" value="<?php echo $myrow3['notaCredito'];?>" size="10" />
      </div></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF">IVA</td>
      <td bgcolor="#FFFFFF"><input name="ivaFactura" type="text" class="style7" id="ivaFactura" value="<?php echo $myrow3['ivaFactura'];?>" size="10"  disabled="disabled"/></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFCCFF">Importe de Factura: </td>
      <td bgcolor="#FFCCFF"><input name="importeFactura" type="text" class="style7" id="importeFactura" value="<?php echo $myrow3['importeFactura'];?>" size="10"  disabled="disabled"/></td>
    </tr>
    <tr>
      <td height="20">Fecha de Factura </td>
      <td><div align="left" class="style7">
        <input name="fechaFactura" type="text" class="style7" id="importeFactura2" value="<?php echo $myrow3['fechaFactura'];?>" size="10"  disabled="disabled"/>
      </div>      </td>
    </tr>
  </table>
  <p align="center" class="style14"><?php echo $leyenda;?>&nbsp;</p>
  <table width="901" border="0" align="center">
    <tr>
      <th colspan="4" bgcolor="#660066" scope="col"><span class="style11">Orden de Compra</span></th>
      <th bgcolor="#FFFFFF" scope="col">&nbsp;</th>
      <th colspan="8" bgcolor="#660066" scope="col"><span class="style11">Facturado</span></th>
    </tr>
    <tr>
      <th width="39" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="196" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="26" bgcolor="#660066" scope="col"><span class="style11">UM</span></th>
      <th width="60" bgcolor="#660066" scope="col"><span class="style11">C. Solicitada</span></th>
      <th width="27" bgcolor="#FFFFFF" scope="col"><span class="style17"></span></th>
      <th width="65" bgcolor="#660066" scope="col"><span class="style11">C. Facturada </span></th>
      <th width="69" bgcolor="#660066" scope="col"><span class="style11">C. Recibida </span></th>
      <th width="38" bgcolor="#660066" scope="col"><span class="style11"> Faltante </span></th>
      <th width="44" bgcolor="#660066" scope="col"><span class="style11">Iva</span></th>
      <th width="51" bgcolor="#660066" scope="col"><span class="style11">Costo</span></th>
      <th width="86" bgcolor="#660066" scope="col"><span class="style11">Total Facturado </span></th>
      <th width="67" bgcolor="#660066" scope="col"><span class="style11">Nota Cr&eacute;dito </span></th>
      <th width="79" bgcolor="#660066" scope="col"><span class="style11">E. Posterior </span></th>
    </tr>
    <tr>
<?php	


 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
id_requisicion='".$nRequisicion."' and
statusCompras='facturado'
order by fechaCompras ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];
$cantidadComprar=$myrow18['cantidadComprar'];
$cantidadRecibida=$myrow18['cantidadRecibida'];
$b+='1';
$a+='1';
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


if($cantidadComprar==$cantidadRecibida){
$color = '#66FF00';
$col = "";
}
$code1=$myrow18['codigo'];
$keyR=$myrow18['keyR'];
$descripcion=descripcion($code=$code1,$basedatos);
$requisicion=$myrow18['id_requisicion'];
$id_almacen=$myrow18['id_almacen'];
$id_proveedor=$myrow18['id_proveedor'];
if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

$sSQL11= "Select * From articulos WHERE codigo= '".$code1."' ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

$sSQL8= "Select * From existencias WHERE codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

$sSQL2= "Select * From precioArticulos WHERE codigo= '".$code1."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2); 


$sumaCosto[0]+=$myrow2['costo'];
$gpoProducto=gpoProducto($code1,$basedatos);
$iva=iva($gpoProducto,$myrow2['costo'],$basedatos);
$sSQL12= "Select * From OC WHERE id_requisicion='".$nRequisicion."' and codigo='".$code1."'";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12); 
if($myrow12['articulosPosteriores']){
$egap=$myrow12['articulosPosteriores'];
} else {
$egap="";
}
$tb=$myrow12['banderaEnvio'];
$EN=$myrow12['articulosPosteriores'];
	   $t=$myrow18['cantidadFacturada']-$myrow18['cantidadRecibida']; 
$sSQL7= "Select * From OC WHERE id_requisicion='".$nRequisicion."' and articulosPosteriores is not null";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7); 	   
	   
	  ?>
      <td height="26" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label><?php echo $code1?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow11['descripcion']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
 
       
<?php 
	  if($myrow11['um']){
	  echo $myrow11['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="style7">
        <?php 
	  if($myrow18['cantidadComprar']){
	  echo $myrow18['cantidadComprar'];
	  } else {
	  echo "--";
	  }
	 
		?>
	
	  </span></label></td>
      <td bgcolor="#FFFFFF" class="style18">&nbsp;</td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="Estilo24">
        <input name="cantidadFacturada[]" type="text" class="style7" id="cantidadFacturada[]"  size="3"
		 value="<?php echo $myrow18['cantidadFacturada']; ?>"  <?php
	 
	  if($tb!=null  ){
	  echo 'disabled="disabled"';
	  }
	  ?>>
	  
	  <?php  $subt1=$myrow18['cantidadFacturada']*$myrow2['costo'];
	  $subt[0]=$myrow18['cantidadFacturada']*$myrow2['costo'];
	  //$subt[0]+=$subt[0];
	  ?>
      </span></label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
	 
        <input name="cantidadRecibida[]" type="text" class="style7" id="cantidadRecibida[]"  size="3"
		 value="<?php echo $myrow18['cantidadRecibida']; ?>"  <?php
	 
	  if($tb!=null ){
	  echo 'disabled="disabled"';
	  }
	  ?>
		/>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="style7">
	  <?php
	 $banderaT[0]+=$t;
	  if($t ){
	  echo $t;
	  } else if($t=='0'){
	  echo "0";
	  } else {
	  echo "Surtido";
	  }
	  
	  ?></span></label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php
		$gpoProducto=gpoProducto($code1,$basedatos);
$iva=iva($gpoProducto,$myrow18['cantidadFacturada'],$basedatos);
 echo "$".number_format($myrow18['cantidadFacturada']*$iva,2);
 $sumaIVA[0]+=$myrow18['cantidadFacturada']*$iva;

//	
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <input name="keyR[]" type="hidden" id="keyR[]" value="<?php echo $myrow18['keyR']; ?>" />
        <input name="cost[]" type="text" class="style7" id="cost[]" size="6" value="<?php echo $myrow2['costo']; ?>"
		<?php
	 
	  if($tb!=null){
	  echo 'disabled="disabled"';
	  }
	  ?>/>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <?php 
$subTotal[0]=$subt[0];
			echo "$".number_format($subTotal[0],2);

	  $subtotal[0]+=$subTotal[0];
	  
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
      <?php 
$notaCredito[0]=$t*$myrow2['costo'];

		
		$gpoProducto=gpoProducto($code1,$basedatos);
$ivas=iva($gpoProducto,$notaCredito[0],$basedatos);
$totalNC[0]=$notaCredito[0]+$ivas;
	  	echo "$".number_format($totalNC[0],2);
	  $totalNC1[0]+=$totalNC[0];
	  if($iva){ echo " c/ Iva";}?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <input name="articulosPosteriores[]" type="text" class="style7" id="articulosPosteriores[]"  size="3"
		 value="<?php echo $myrow18['articulosPosteriores']; ?>"  <?php
	 
	  if($myrow7['articulosPosteriores']){
	 echo 'disabled="disabled"';
	  }
	  ?>>
      </span></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <div align="center">
    <p>&nbsp;</p>
    <table width="299" border="0" align="center" class="style7">
      <tr>
        <th width="82" bgcolor="#660066" class="style7" scope="col"><div align="center" class="style16 style19">Subtotal</div></th>
        <th width="74" bgcolor="#660066" class="style7" scope="col"><div align="center" class="style20">IVA</div></th>
        <th width="68" bgcolor="#660066" class="style7" scope="col"><div align="center" class="style20"><strong>Total</strong></div></th>
        <th width="57" bgcolor="#660066" class="style7" scope="col"><div align="center" class="style20"><strong>N. C </strong></div></th>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style7"><div align="center"><span class="Estilo24">
          <?php 

			echo "$".number_format($subtotal[0],2);

	  
	  
	  ?>
        </span></div></td>
        <td bgcolor="#FFFFFF" class="style7"><div align="center">
          <?php 
		

			echo "$".number_format($sumaIVA[0],2);

	  
	  
	  ?>
        </div></td>
        <td bgcolor="#FFFFFF" class="style7"><div align="center"><strong>
          <?php 
$Total=$subtotal[0]+$sumaIVA[0];
			echo "$".number_format($Total,2);

	  
	  
	  ?>
        </strong></div></td>
        <td bgcolor="#FFFFFF" class="style7"><div align="center"><?php echo $TOTAL= "$".number_format($totalNC1[0],2);?>&nbsp;</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style7">&nbsp;</td>
      </tr>
    </table>
  </div>
  <p align="center">
    <label>
    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>
    <input name="nRequisicion" type="hidden" id="nRequisicion" value="<?php echo $nRequisicion; ?>" />
    <span class="Estilo24">
    <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
  </span></p>
  <table width="200" border="0" align="center">
    <tr>
      <th class="style7" scope="col"><div align="left"><span class="Estilo24"> </span> <span class="style21">Diferencia en Importe Total: </span></div></th>
      <th class="style7" scope="col"><div align="left">
        <?php 
  $banderaFactura=$myrow3['importeFactura']-$Total;
  echo "$".number_format($myrow3['importeFactura']-$Total,2);?>
      </div></th>
    </tr>
    <tr>
      <td class="style7"><div align="left"><strong><span class="style21">Diferencia en IVA: </span></strong></div></td>
      <td class="style7"><div align="left"><strong>
        <?php 
  $banderaIVA=$myrow3['ivaFactura']-$sumaIVA[0];
  echo "$".number_format($myrow3['ivaFactura']-$sumaIVA[0],2);?>
      </strong></div></td>
    </tr>
    <tr>
      <td class="style7"><div align="left"></div></td>
      <td class="style7"><div align="left"></div></td>
    </tr>
  </table>
  <p align="center"><label></label>
  </p>
  <table width="200" border="0" align="center">
    <tr>
      <th scope="col"><input name="actualizar" type="submit" class="style7" id="actualizar" value="Actualizar Cambios" disabled="disabled" /></th>
      <th scope="col"><input name="existencias" type="submit" class="style7" id="existencias" value="Enviar Existencias a CENDIS"
	<?php 
	
	if(($banderaFactura =='0' and $banderaIVA=='0') and !$tb){
//echo "Cantidad a 0";
	} else {
		echo 'disabled="disabled"';
	}
	?> onClick="if(confirm('Esta seguro de enviar al cendis estos artículos? La operación es irreversible...') == false){return false;}" disabled="disabled"></th>
	
      <th scope="col">
	  
	  <input name="cxp" type="submit" class="style7" id="cxp" value="Generar CxP"   <?php 
	if($tb=="enviado" and $myrow3['notaCredito']!='0' and ($banderaFactura =='0' and $banderaIVA=='0')){
	
	} else {
	echo " ".'disabled="disabled"';
	}
	?> onClick="if(confirm('Esta seguro de enviar a CXP esta factura?') == false){return false;}" disabled="disabled"></th>
      <th scope="col"><label>
        <input name="cPosterior" type="submit" class="style7" id="cPosterior" value="Ajustar Cantidad Posterior" 
		<?php
		
		
		$sSQL12= "Select * From OC WHERE id_requisicion='".$nRequisicion."' and articulosPosteriores is not null";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12); 

	  if($myrow12['articulosPosteriores']){
	 echo 'disabled="disabled"';
	  } ?>
		onClick="if(confirm('Deseas continuar? La operación es irreversible...') == false){return false;}"/>
      </label></th>
    </tr>
  </table>
  <p align="center"><label></label>
    <span class="Estilo24">
    <input name="nRequisicion" type="hidden" id="nRequisicion" value="<?php echo $_POST['nRequisicion']; ?>" />
  </span></p>
  <p align="center"><a href="javascript:ventanaSecundaria('notaCredito.php?id_proveedor=<?php echo $id_proveedor; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a></p>
  <p align="center"><a href="javascript:ventanaSecundaria('notaCredito.php?id_proveedor=<?php echo $id_proveedor; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a></p>
</form>
</body>
</html>