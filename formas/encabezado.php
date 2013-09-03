<?php
$numeroE=$_GET['numeroE'];
$paciente=$_GET['paciente'];
$sSQL12= "
	SELECT *
FROM
clientesInternos
WHERE 
numeroE='".$numeroE."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$paciente=$myrow12['paciente'];
$almacenP=$myrow12['almacen'];
$sSQL121= "
SELECT *
FROM
almacenes
WHERE 
almacen='".$almacenP."'
";
$result121=mysql_db_query($basedatos,$sSQL121);
$myrow121 = mysql_fetch_array($result121);
$nombreA=$myrow121['descripcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
-->
</style>
</head>

<body>

<table width="332" border="0" align="center" class="style7">
  <tr>
    <th width="93" scope="col"><div align="left"># de Orden </div></th>
    <th width="229" scope="col"><div align="left"><?php echo $myrow12['keyClientesInternos'];?></div></th>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Nombre del Paciente </td>
    <td bgcolor="#CCCCCC"><?php echo $paciente;?></td>
  </tr>
</table>
</body>
</html>
