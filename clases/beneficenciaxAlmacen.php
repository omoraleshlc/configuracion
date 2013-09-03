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
 <h1 align="center">
 <?php //print $myrow7e['descripcion']; ?>
 
  <?php print $myrow7e['descripcion']; ?>
 </h1>
    <p align="center"><br />
    </p>
<form id="form2" name="form2" method="post" action="">
  <div align="center">
   
<?php   

$sSQL= "Select * From reportesFinancieros where 
random='".$random."'
and
beneficencia='si'
and
almacenPrincipal='".$almacen."'

";
$result=mysql_db_query($basedatos,$sSQL); 
?>

</div>
  <table width="398" border="0" align="center">
     <tr>
       <th width="37" bgcolor="#660066" scope="col"><div align="left"><span class="blanco"># </span></div></th>
       <th width="281" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Descripci&oacute;n</span></div></th>
       <th width="66" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Ingresos</span></div></th>
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













//************************EFECTIVOS******************


$sSQL7d="SELECT  sum(efectivo) as efectivos,sum(efectivo*porcentaje) as ivar

FROM
reportesFinancieros
WHERE
random='".$random."'
and
almacenPrincipal='".$almacen."'
and
gpoProducto='".$myrow['gpoProducto']."'
and
usuario='".$usuario."'
and
naturaleza='A'
";
$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);
//***********************************************************




$efectivos[0]+=($myrow7d['efectivos']);



$sSQL7ss="SELECT descripcionGP

FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'";
$result7ss=mysql_db_query($basedatos,$sSQL7ss);
$myrow7ss = mysql_fetch_array($result7ss);

$bandera+=1;
?>
       <td bgcolor="<?php echo $color?>" class="normalmid"><span class="style7">
       
         <label>
         <?php echo $bandera;?>         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <span class="style71">
	   <?php echo $myrow['descripcionArticulo'];?>	   </span>          </td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <?php //echo $myrow7['efectivos'].' '.$myrow7d['efectivos'].'<br>';
	   echo "$".number_format($myrow['efectivo'],2); 
	   ?>       </td>
     </tr>
     
    
<?php 

	}//cierra while
	
?>
  </table>
  
  
  
  
  <p>&nbsp;</p>
  
  
  
  
  
  
  
  
  <table width="200" border="1" align="center">
    <tr>
      <th colspan="2" scope="col">Subtotales</th>
    </tr>
    <tr>
      <th width="97" scope="col"><div align="left">SubTotal</div></th>
      <th width="87" scope="col"><div align="left"><?php 
	  
	  print '$'.number_format($efectivos[0],2);
      
	  ?></div></th>
    </tr>
    <tr>
      <th scope="col"><div align="left">IVA</div></th>
      <th scope="col"><div align="left">
	  <?php 
	  print '$'. number_format($ivars[0], 2);
	  //print '$'. number_format($ivarD[0], 2);
	  ?></div></th>
    </tr>
    <tr>
      <td><div align="left">TOTAL</div></td>
      <td><div align="left">
	  <?php 
	 	  print '$'.number_format($efectivos[0],2);?></div></td>
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