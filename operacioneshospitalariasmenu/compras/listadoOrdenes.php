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
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<h1 align="center">Ordenes de Compra </h1>
<p align="center"><span class="Estilo24"><span class="style7">
  <?php 
 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
id_requisicion='".$_POST['nRequisicion']."' 

";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
$id_proveedor=$myrow18['id_proveedor'];
 $sSQL17= "Select * From proveedores WHERE id_proveedor='".$id_proveedor."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	  echo "Proveedor: ".$myrow17['razonSocial'];
	  ?>
</span></span></p>
<form id="form1" name="form1" method="post" action="">
  <table width="376" border="0" align="center">
    <tr>
      <th width="50" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="239" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="18" bgcolor="#660066" scope="col"><span class="style11">UM</span></th>
      <th width="41" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
    </tr>
    <tr>
<?php	


 $sSQL18= "
SELECT 
*
FROM
OC
WHERE 
id_requisicion='".$_POST['nRequisicion']."' and
statusCompras='comprar'
order by fechaCompras ASC
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

$sSQL8= "Select * From existencias WHERE codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

/* $sSQL2= "Select * From articulos WHERE codigo= '".$code1."' and almacen='".$_POST['id_almacen']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2); */

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
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <div align="center"><strong>
    <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>
    <input name="id_almacen" type="hidden" id="id_almacen" value="<?php echo $_POST['id_almacen']; ?>" />
    <span class="Estilo24">
    <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
  </span></p>
  <p align="center"><a href="javascript:ventanaSecundaria('listadoOrdenesImpresion.php?id_requisicion=<?php echo $myrow1['numeroE']; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a><a href="javascript:ventanaSecundaria('listadoOrdenesImpresion.php?id_requisicion=<?php echo $_POST['nRequisicion']; ?>&amp;id_proveedor=<?php echo $id_proveedor; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"><img src="/sima/cargos/printer.jpg" alt="Imprimir " width="43" height="43" border="0" /></a></p>
</form>
</body>
</html>