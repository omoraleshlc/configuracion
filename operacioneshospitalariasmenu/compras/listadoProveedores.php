<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=730,height=500,scrollbars=YES") 
} 
</script> 

<?php 




if($_POST['solicitar'] and $_POST['precioUnitario']){
$id_proveedor=$_POST['id_proveedor'];
$precioUnitario=$_POST['precioUnitario'];
$keyP=$_POST['keyP'];


for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($precioUnitario[$i] && $id_proveedor[$i] ){

$sSQL17= "Select id_requisicion From requisicionesProveedores WHERE id_proveedor= '".$id_proveedor[$i]."' and id_requisicion='".$_GET['id_requisicion']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
if(!$myrow17['id_requisicion']){
 $agregaSaldo = "INSERT INTO requisicionesProveedores ( id_proveedor,id_requisicion,usuario,precioUnitario,keyP
) values ('".$id_proveedor[$i]."','".$_GET['id_requisicion']."',
'".$usuario."','".$precioUnitario[$i]."','".$keyP[$i]."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();

$q1 = "UPDATE OC set 
statusProveedor='standby'
WHERE 
keyR='".$_GET['keyR']."'
";
mysql_db_query($basedatos,$q1);
mysql_error();


$q1 = "UPDATE requisiciones set 
statusProveedor='standby'
WHERE 
id_requisicion='".$_GET['id_requisicion']."'
";
mysql_db_query($basedatos,$q1);
mysql_error();
} else {
$q1 = "UPDATE requisicionesProveedores set 
precioUnitario='".$precioUnitario[$i]."',keyP='".$keyP[$i]."'
WHERE id_proveedor = '".$id_proveedor[$i]."'
and
id_requisicion='".$_GET['id_requisicion']."'
";
mysql_db_query($basedatos,$q1);
}
}
}
?>
<script>
window.opener.document.forms["form1"].submit();
</script>
<?php 

$sSQL8= "Select * From OC WHERE id_requisicion='".$_GET['id_requisicion']."' and statusProveedor=''";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
if($myrow8['keyR']){
$q1 = "UPDATE requisiciones set 
statusCompras='standby'
WHERE 
id_requisicion='".$_GET['id_requisicion']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}


if($_POST['quitar'] AND $_POST['remover']){
$codigo=$_POST['remover'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){
$remover = "DELETE From requisiciones where codigo='".$codigo[$i]."' and almacen ='".$_POST['almacen']."'";
//mysql_db_query($basedatos,$remover);
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

<body>
<h1 align="center">Asignar Precio</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="440" border="0" align="center">
    <tr>
      <th width="59" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo</span></div></th>
      <th width="328" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Proveedor</span></div></th>
      <th width="39" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Precio U</span></div></th>
    </tr>
    <tr>
<?php	


$sSQL18= "
SELECT 
*
FROM
proveedores
WHERE
status='A'
order by razonSocial ASC
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


if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select precioUnitario From requisicionesProveedores WHERE 
id_proveedor='".$myrow18['id_proveedor']."'
and
id_requisicion='".$_GET['id_requisicion']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label><?php echo $myrow18['id_proveedor'];?>
        <input name="id_proveedor[]" type="hidden" id="codigoAlfa[]" value="<?php echo $myrow18['id_proveedor'];?>" />
        <input name="keyP[]" type="hidden" id="keyP[]" value="<?php echo $myrow18['keyP'];?>" />
      </label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow18['razonSocial']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label>
      <input name="precioUnitario[]" type="text" class="style12" id="precioUnitario" size="8" value="<?php echo $myrow17['precioUnitario'];?>" />
      </label></td>
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
    <input name="solicitar" type="submit" class="style12" id="solicitar" value="Solicitar/Actualizar" />
    </label>
    <label></label>

    <span class="Estilo24">

  </span></p>
</form>
</body>
</html>