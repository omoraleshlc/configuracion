<?PHP class desplegarACC{
public function eACC($fechaInicial,$fechaFinal,$entidad,$almacenSolicitante,$basedatos){ 


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
almacen='".$almacenSolicitante."'

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

$sSQL= "Select gpoProducto From cargosCuentaPaciente where 
entidad='".$entidad."'
and
tipoPaciente='externo'
and
gpoProducto!=''
and
almacenSolicitante='".$almacenSolicitante."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
and
ventasDirectas!='si'
and
gpoProducto!='HONMED'
group by gpoProducto
order by almacen
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









//************************EFECTIVOS******************
$sSQL7="SELECT sum(precioVenta*cantidad) as efectivos,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
and
tipoPaciente='externo'
and
almacenSolicitante='".$almacenSolicitante."'
and
gpoProducto='".$myrow['gpoProducto']."'
and
statusCaja='pagado'
and
naturaleza='C'
and
ventasDirectas!='si'
and
gpoProducto!='HONMED'

  ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


$sSQL7d="SELECT  sum(precioVenta*cantidad) as efectivos,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
and
tipoPaciente='externo'
and
almacenSolicitante='".$almacenSolicitante."'
and
gpoProducto='".$myrow['gpoProducto']."'
and
statusCaja='pagado'
and
naturaleza='A'

and
ventasDirectas!='si'
and
gpoProducto!='HONMED'
";
$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);
//***********************************************************





$efectivos[0]+=($myrow7['efectivos']-$myrow7d['efectivos']);
$ivars[0]+=($myrow7['ivar']-$myrow7d['ivar']);


$sSQL7ss="SELECT descripcionGP

FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'";
$result7ss=mysql_db_query($basedatos,$sSQL7ss);
$myrow7ss = mysql_fetch_array($result7ss);
?>
       <td bgcolor="<?php echo $color?>" class="normalmid"><span class="style7">
       
         <label>
         <?php echo $myrow['gpoProducto'];?>         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <span class="style71">
	   <?php echo $myrow7ss['descripcionGP'];?>	   </span>	

          </td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <?php //echo $myrow7['efectivos'].' '.$myrow7d['efectivos'].'<br>';
	   echo "$".number_format($myrow7['efectivos']-$myrow7d['efectivos'],2); 
	   ?>
       </td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   
	   <?php //echo ($myrow7['efectivos']*$myrow['porcentaje']).' '.($myrow7d['efectivos']*$myrow['porcentaje']).'<br>';
	   echo "$".number_format($myrow7['ivar']-$myrow7d['ivar'],2); 
	   ?>
       
       
       </td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><div align="center">
         <?php if($myrow7['efectivos']){ ?>
         <a href="#" 
onclick="javascript:ventanaSecundaria1('reportexGPOAD.php?fecha=<?php echo $_POST['fecha']; ?>&amp;gpoProducto=<?php echo $myrow['gpoProducto']; ?>&amp;almacen=<?php echo $almacen; ?>&amp;almacenFuente=<?php echo $myrow['almacenSolicitante']; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;fechaInicial=<?php echo $_GET['fechaInicial'];?>&amp;fechaFinal=<?php echo $_GET['fechaFinal'];?>&folioVenta=<?php echo $FV;?>&random=<?php echo $_GET['random'];?>')"><img src="../../imagenes/btns/detailsbtn.png" width="18" height="18" border="0" /></a>
         <?php } else { 
		echo '---';
		}
		?>
       </div></td>
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
	 	  print '$'.number_format($efectivos[0]+$ivars[0],2);?></div></td>
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