<?php 
class acumuladoEfectivo {

public function acumuladosEfectivo($fecha2,$fecha1,$hora1,$entidad,$basedatos){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 13px}
.style11 {color: #000; font-size: 13px; font-weight: normal; }
.style12 {font-size: 13px}
.style7 {font-size: 13px}
.style71 {font-size: 13px}
.style71 {font-size: 13px}
.style71 {font-size: 13px}
-->
</style>
</head>

<body>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="get" action="">
  <p align="center"><span class="Estilo24">Escoje el tipo 
      <select name="tipoPago" class="style71" id="tipoPago" onchange="javascript:form.submit();">
      <option value="">Escoje el tipo</option>
	  <option
				 <?php if($_GET['tipoPago']=='Efectivo' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Efectivo">Efectivo</option>
      <option
				 <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Tarjeta de Credito">Tarjeta de Credito</option>
      <option
				<?php if($_GET['tipoPago']=='Cheque'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Cheque">Cheque</option>
      <option 
				<?php if($_GET['tipoPago']=='Credito'){ ?>
				 selected="selected"
				 <?php } ?>
				value="Credito">Credito</option>
    </select>
  </span></p>
  <table width="496" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th width="63" height="15" scope="col"><div align="left"><span class="style11">C&oacute;digo </span></div></th>
      <th width="420" scope="col"><div align="left"><span class="style11">Transacciones</span></div></th>
      <th width="56" scope="col"><div align="left"><span class="style11">Cajero</span></div></th>
      <th width="56" scope="col"><div align="left"><span class="style11">#Corte</span></div></th>
      <th width="56" scope="col"><div align="left"><span class="style11">Importe</span></div></th>
    </tr>
    <tr>
      <?php   

  $sSQL= "Select * From cargosCuentaPaciente 
where
entidad='".$entidad."'
and
status='transaccion'
and
tipoPago='".$_GET['tipoPago']."'
AND
fecha1='".$fecha1."'
order by fecha1 ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){



if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$tipoTransaccion=$myrow['tipoTransaccion'];


 $sSQL81= "
SELECT 
  *
FROM
catTTCaja
 WHERE 
 entidad='".$entidad."' 
and
codigoTT='".$tipoTransaccion."'

";

$result81=mysql_db_query($basedatos,$sSQL81);
$myrow81 = mysql_fetch_array($result81);


?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style71"> <?php echo $tipoTransaccion?> </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style71">
	  <?php echo $myrow81['descripcion'];?>
            </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style71">
        <?php 
		
		 echo $myrow['usuario'];
		
		 ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style71">
        <?php 
		
		 echo $myrow['numCorte'];
		
		 ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style71">
        <?php 
		
		 echo "$".number_format($myrow['precioVenta'],2);
		
		 ?>
      </span></span></td>
    </tr>
    <?php }}?>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>