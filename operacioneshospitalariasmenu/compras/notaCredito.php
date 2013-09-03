<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
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
//***********************CAMBIAR ALMACEN****************************
if($_POST['almacen']){
$sSQL17= "Select * From sesionesAlmacen WHERE usuario = '".$usuario."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$ali=$myrow17['almacen'];
if(!$myrow17['usuario']){

$agrega = "INSERT INTO sesionesAlmacen ( usuario,almacen
) values (
'".$usuario."',
'".$_POST['almacen']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

} else {

$q1 = "UPDATE sesionesAlmacen set 
almacen='".$_POST['almacen']."'
WHERE usuario = '".$usuario."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//paciente_actualizado();
}
}
//**********************CIERRO CAMBIAR ALMACEN******************************




if($_POST['solicitar'] AND $_POST['request'] and $_POST['cantidad']){
$codigo=$_POST['request'];
$cantidad=$_POST['cantidad'];
$code1=$_POST['codigoAlfa'];
$banderaCantidad=$_POST['banderaCantidad'];
for($i=0;$i<=$_POST['pasoBandera'];$i++){

$s=$banderaCantidad[$i]+1;
//echo $code1[$i].$cantidad[$i].'<br>';

if( $id_almacen=$_POST['id_almacen'] and $cantidad[$i] ){


if($code1[$i] and $cantidad[$i]){
$sSQL17= "Select * From OC WHERE codigo= '".$code1[$i]."' and id_almacen='".$_POST['almacen']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
if(!$myrow17['codigo']){
 $agregaSaldo = "INSERT INTO OC ( codigo,almacen,usuario,fecha,hora,ID_EJERCICIO,cantidad
) values ('".$code1[$i]."','".$_POST['id_almacen']."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$cantidad[$i]."')";
//mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
} else {
$q1 = "UPDATE OC set 
cantidad='".$cantidad[$i]."'
WHERE codigo = '".$code1[$i]."'
and
almacen='".$_POST['almacen']."'
";
//mysql_db_query($basedatos,$q1);
}
}
}}

}


if($_POST['quitar'] AND $_POST['remover']){
$codigo=$_POST['remover'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){
$remover = "DELETE From OC where codigo='".$codigo[$i]."' and almacen ='".$_POST['almacen']."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();


}
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
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
.style16 {color: #000000; font-size: 10px; font-weight: bold; }
.style13 {color: #000000}
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


$sSQL17= "Select * From proveedores WHERE id_proveedor='".$_GET['id_proveedor']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
?>
<h1 align="center">Nota de Cr&eacute;dito al Proveedor </h1>
<table width="580" border="0" align="center" class="style7">
  <tr>
    <th width="199" bgcolor="#CCCCCC" scope="col"><div align="left">Proveedor</div></th>
    <th width="365" bgcolor="#CCCCCC" scope="col"><div align="left"><?php echo $myrow17['razonSocial'];?></div></th>
  </tr>
  <tr>
    <td><div align="left">Usuario Responsable:</div></td>
    <td><div align="left"><?php echo $usuario.":".$nombre." ".$apaterno; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="left">Fecha:</div></td>
    <td bgcolor="#CCCCCC"><div align="left"><?php echo $fecha1;?></div></td>
  </tr>
  <tr>
    <td><div align="left">Hora:</div></td>
    <td><div align="left"><?php echo $hora1;?></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="left"># de Requisici&oacute;n</div></td>
    <td bgcolor="#CCCCCC"><div align="left"><strong><?php echo $_GET['id_requisicion'];?></strong></div></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="641" border="0" align="center">
    <tr>
      <th width="59" bgcolor="#CCCCCC" scope="col"><span class="style16">C&oacute;digo</span></th>
      <th width="359" bgcolor="#CCCCCC" scope="col"><span class="style16">Descripci&oacute;n</span></th>
      <th width="47" bgcolor="#CCCCCC" scope="col"><span class="style16">UM</span></th>
      <th width="72" bgcolor="#CCCCCC" scope="col"><span class="style16">Cantidad</span></th>
      <th width="70" bgcolor="#CCCCCC" scope="col"><span class="style16">Iva</span></th>
      <th width="70" bgcolor="#CCCCCC" scope="col"><span class="style16">Costo</span></th>
    </tr>
    <tr>
<?php	


 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
id_requisicion='".$_GET['id_requisicion']."' and 
id_proveedor='".$_GET['id_proveedor']."' 
and
cantidadComprar<>cantidadRecibida
order by fechaCompras ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];
$b+='1';
$a+='1';
if($col){
$color = '#CCCCCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$code1=$myrow18['codigo'];
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

$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$sSQL8= "Select * From precioArticulos WHERE codigo= '".$code1."' ";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$gpoProducto=gpoProducto($code1,$basedatos);
$iva=iva($gpoProducto,$myrow2['costo'],$basedatos);
?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label><?php echo $code1?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow7['descripcion']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
 
       
<?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="style7"><?php echo $cantidadComprar=$myrow18['cantidadComprar']; ?></span></label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php
	 echo "$".number_format($iva,2);
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	$subTotal[0]+=$myrow8['costo'];
			echo "$".number_format($myrow8['costo'],2);

	  
	  
	  ?>
      </span></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <p align="center" class="style7">Totales: </p>
  <table width="299" border="0" align="center" class="style13">
    <tr>
      <th width="82" bgcolor="#CCCCCC" class="style13" scope="col"><div align="center">Subtotal</div></th>
      <th width="74" bgcolor="#CCCCCC" class="style13" scope="col"><div align="center">IVA</div></th>
      <th width="68" bgcolor="#CCCCCC" class="style13" scope="col"><div align="center"><strong>Total</strong></div></th>
      <th width="57" bgcolor="#CCCCCC" class="style13" scope="col"><div align="center"><strong>N. C </strong></div></th>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style13"><div align="center">
          <?php 
$subTotal[0]=$sumaCosto[0];
			echo "$".number_format($subTotal[0],2);

	  
	  
	  ?>
      </div></td>
      <td bgcolor="#FFFFFF" class="style13"><div align="center">
          <?php 
		
$gpoProducto=gpoProducto($code1,$basedatos);
$iva=iva($gpoProducto,$myrow2['costo'],$basedatos);
			echo "$".number_format($iva,2);

	  
	  
	  ?>
      </div></td>
      <td bgcolor="#FFFFFF" class="style13"><div align="center"><strong>
          <?php 
$Total=$subTotal[0]+$iva;
			echo "$".number_format($Total,2);

	  
	  
	  ?>
      </strong></div></td>
      <td bgcolor="#FFFFFF" class="style13"><div align="center"><?php echo $TOTAL= "$".number_format($myrow3['importeFactura']-$Total,2);?>&nbsp;</div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style13">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style13">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style13">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="style13">&nbsp;</td>
    </tr>
  </table>
  <p align="center">&nbsp; </p>
  <div align="center"></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>
    <input name="id_almacen" type="hidden" id="id_almacen" value="<?php echo $_POST['id_almacen']; ?>" />
    <span class="Estilo24">
    <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
  </span></p>
  <p align="center">&nbsp;</p>
</form>
</body>
</html>