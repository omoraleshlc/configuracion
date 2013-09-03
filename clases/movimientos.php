<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo4 {color: #FFFFFF; font-size: 12px; }
.Estilo5 {font-size: 12px}
-->
</style>
</head>

<body>
<p align="center">
  <?php 
$sSQL2= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_POST['folioVenta']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>
</p>
<table width="422" border="0" align="center">
  <tr>
    <th width="33" height="19" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="Estilo1">
      <div align="left" class="blanco">
        <div align="left">#</div>
      </div>
    </div></th>
    <th width="253" bgcolor="#660066" class="Estilo4" scope="col"><div align="left">
      <div align="center" class="Estilo1">
        <div align="left" class="blanco">
          <div align="left">Concepto</div>
        </div>
      </div>
    </div></th>
    <th width="62" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="Estilo1">
      <div align="left" class="blanco">
        <div align="left">Importe</div>
      </div>
    </div></th>
    <th width="56" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="blanco Estilo1 Estilo5">
      <div align="left">Agregar</div>
    </div></th>
  </tr>
  <?php	
$sSQL= " 
SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."' AND
folioVenta='".$_POST['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}





 
?>
  <tr>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
    <td height="21" bgcolor="<?php echo $color;?>" class="normal"><?php echo $bandera; ?></td>
    <td bgcolor="<?php echo $color;?>" class="abonos"><span class="normal"><?php echo $myrow['descripcionArticulo'];?></span></td>
    <td bgcolor="<?php echo $color;?>" class="abonos"><span class="normal"><?php echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2); ?></span></td>
    <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center">
      <label>
        <input name="keyCAP[]" type="checkbox" id="keyCAP[]" value="<?php echo $myrow['keyCAP'];?>" />
        </label>
    </div></td>
  </tr>
  <?php }
	
	  ?>
</table>
</body>
</html>
