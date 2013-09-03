<?PHP class desplegarACC{
public function eACC($usuario,$random,$entidad,$almacen,$basedatos){ 
?> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
} 
</script> 



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>



<?php 
$sSQL7e="SELECT *
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'

";
$result7e=mysql_db_query($basedatos,$sSQL7e);
$myrow7e = mysql_fetch_array($result7e);
?>
<body>
 <h1 align="center"><?php print $FV.'   '.$myrow7e['descripcion']; ?></h1>
    <p align="center"><br />
    </p>
<form id="form2" name="form2" method="post" action="">
  <div align="center">
   
<?php   
$sSQL= "Select * From reportesFinancieros where 
random='".$random."'
and

almacen='".$almacen."'
group by gpoProducto
";
$result=mysql_db_query($basedatos,$sSQL); 
?>

</div>
  <table width="514" border="0" align="center">
     <tr>
       <th width="75" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">C&oacute;digo GP</span></div></th>
       <th width="251" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Descripci&oacute;n de Productos </span></div></th>
       <th width="60" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Ingresos</span></div></th>
       <th width="45" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">IVA</span></div></th>
       <th width="61" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Detalles</span></div></th>
    </tr>
     <tr>
<?php	
while($myrow = mysql_fetch_array($result)){
	
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}






$sSQL7s="SELECT descripcionGP

FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'";


$result7s=mysql_db_query($basedatos,$sSQL7s);
$myrow7s = mysql_fetch_array($result7s);









 $sSQL7r="SELECT  sum(efectivo) as totalEfectivo,sum(iva) as totalIVA

FROM
reportesFinancieros
WHERE
random='".$random."'
and
almacen='".$almacen."'
and
gpoProducto='".$myrow['gpoProducto']."'
and
usuario='".$usuario."'
and
naturaleza='C'
";


$result7r=mysql_db_query($basedatos,$sSQL7r);
$myrow7r = mysql_fetch_array($result7r);


 $sSQL7rd="SELECT  sum(efectivo) as totalEfectivo,sum(iva) as totalIVA

FROM
reportesFinancieros
WHERE
random='".$random."'
and
almacen='".$almacen."'
and
gpoProducto='".$myrow['gpoProducto']."'
and
usuario='".$usuario."'
and
naturaleza='A'
";


$result7rd=mysql_db_query($basedatos,$sSQL7rd);
$myrow7rd = mysql_fetch_array($result7rd);
?>
       <td bgcolor="<?php echo $color?>" class="normalmid"><span class="style7">
       
         <label>
         <?php echo $myrow['gpoProducto'];?>         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <span class="style71">
	   <?php echo $myrow7s['descripcionGP'];?>	   </span>	
       <?php 
	   if($myrow7s['cashDev']){
	   print '</br>'.'Devoluciones: '.'$'.number_format($dev[0],2);
	   }
	   ?>
          </td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <?php 
	   $efectivo[0]+=($myrow7r['totalEfectivo']-$myrow7rd['totalEfectivo']);
	   $ivar[0]+=($myrow7r['totalEfectivo']-$myrow7rd['totalEfectivo'])*$myrow7['porcentaje'];
	   ?>
       <?php print '$'.number_format($myrow7r['totalEfectivo']-$myrow7rd['totalEfectivo'],2);?>
       </td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php 
	   
	   echo "$".number_format(($myrow7r['totalEfectivo']-$myrow7rd['totalEfectivo'])*$myrow7['porcentaje'],2); ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><div align="center"><a href="#" 
onclick="javascript:ventanaSecundaria1('detallesAlmacenes.php?gpoProducto=<?php echo $myrow['gpoProducto'];?>&random=<?php echo $_GET['random'];?>&fechaInicial=<?php echo $_GET['fechaInicial'];?>&fechaFinal=<?php echo $_GET['fechaFinal'];?>&almacen=<?php echo $myrow['almacen'];?>')"><img src="../../imagenes/btns/detailsbtn.png" width="18" height="18" border="0" /></a></div></td>
     </tr>
     
    
    <?php 
	
	}//cierra while?>
     
     
  </table>
  
  
  
  
  <p>&nbsp;</p>
  <table width="200" border="1" align="center">
    <tr>
      <th colspan="2" scope="col">Subtotales</th>
    </tr>
    <tr>
      <th width="97" scope="col"><div align="left">SubTotal</div></th>
      <th width="87" scope="col"><div align="left"><?php print '$'.number_format($efectivo[0],2);?></div></th>
    </tr>
    <tr>
      <th scope="col"><div align="left">IVA</div></th>
      <th scope="col"><div align="left"><?php print '$'.number_format($ivar[0],2);?></div></th>
    </tr>
    <tr>
      <td><div align="left">TOTAL</div></td>
      <td><div align="left"><?php 
	  
	  print '$'.number_format($efectivo[0]+$ivar[0],2);?></div></td>
    </tr>
  </table>
  
  

  </form>
 <p align="center">&nbsp;</p>
</body>
</html>
<?php 
} 
}
?>