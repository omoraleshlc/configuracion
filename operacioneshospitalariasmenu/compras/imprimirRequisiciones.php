<?php include("/configuracion/ventanasEmergentes.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.style14 {color: #000000}
-->
</style>
</head>

<body>

<table width="481" border="1" align="center">
  <tr>
    <th class="style11" scope="col"><span class="style11 style14">C&oacute;digo</span></th>
    <th class="style11" scope="col"><span class="style11 style14">Descripci&oacute;n</span></th>
    <th class="Estilo24" scope="col">Cantidad</th>
  </tr>
  <tr>
    <?php	

$sSQL= "Select * From requisiciones WHERE status='comprar' ";

 
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$codigo=$myrow['codigo'];
$sSQL141= "
	SELECT 
  *
FROM
articulos
WHERE 
codigo = '".$codigo."'
";
$result141=mysql_db_query($basedatos,$sSQL141);
$myrow141 = mysql_fetch_array($result141);

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
    <td width="43" height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow['codigo'];?></span></td>
    <td width="364" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow141['descripcion'];?>
          <input name="DESCRIPCION" type="hidden" id="DESCRIPCION" value="<?php echo $myrow141['descripcion']; ?>" />
    </span></td>
    <td width="52" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow['cantidad'];?></span></td>
  </tr>
  <?php  
	 $importe[0]+=$myrow['IMPORTE'];
	}}?>
  <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
</table>
<p>&nbsp;</p>
</body>
</html>
