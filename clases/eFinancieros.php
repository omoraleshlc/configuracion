<?PHP class desplegarDepartamentos{
public function eFinanciero($random,$basedatos){ 
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
$sSQL7e="SELECT paciente
FROM
clientesInternos
WHERE
folioVenta='".$FV."'

";
$result7e=mysql_db_query($basedatos,$sSQL7e);
$myrow7e = mysql_fetch_array($result7e);
?>
<body>
 <h1 align="center"><?php //print $FV.' '.$myrow7e['paciente']; ?></h1>
    <p align="center"><br />
    </p>
<form id="form2" name="form2" method="post" action="">
  <div align="center">
   
 <?php   
 $sSQL= "Select * From reportesFinancieros 
 where random='138552966' group by almacen";
$result=mysql_db_query($basedatos,$sSQL); 

?>
  </div>
  <table width="578" border="0" align="center">
     <tr>
       <th width="75" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Solicitante</span></div></th>
       <th width="251" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Descripcion</span></div></th>
       <th width="60" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Solicita</span></div></th>
       <th width="60" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Destino</span></div></th>
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






if($myrow['tipoReporte']=='almacenDestino'){






$sSQL7="SELECT  sum(precioVenta*cantidad) as efectivo,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE
folioVenta='".$FV."'
and
almacenDestino='".$myrow['almacen']."'
and
naturaleza='C'
and
statusCuenta='cerrada'
and
(statusDevolucion='no' or statusDevolucion='')
and

statusCargo='cargado'
and
(status!='transaccion' or status!='devolucion')
and
cantidad>0
and
precioVenta>0
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$despliega='detallesCargosMCCDestino';







$sSQL7s="SELECT sum(precioVenta*cantidad) as cashDev,sum(iva*cantidad) as taxDev

FROM
cargosCuentaPaciente
WHERE
folioVenta='".$FV."'
and
almacenDestino='".$myrow['almacen']."'
and
naturaleza='C'
and
statusCuenta='cerrada'
and
(statusDevolucion='si' or statusDevolucion='Si')
and
status!='transaccion'
and
cantidad>0
and
precioVenta>0

";
$result7s=mysql_db_query($basedatos,$sSQL7s);
$myrow7s = mysql_fetch_array($result7s);


}else{ 


//****************************




//*********************************


$sSQL7="SELECT sum(precioVenta*cantidad) as efectivo,sum(iva*cantidad) as ivar

FROM
cargosCuentaPaciente
WHERE

folioVenta='".$FV."'
and
almacenSolicitante='".$myrow['almacen']."'
and
naturaleza='C'
and
statusCuenta='cerrada'
and
(statusDevolucion='no' or statusDevolucion='')
and
(status!='transaccion' or status!='devolucion')
and
cantidad>0
and
precioVenta>0

";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$despliega='detallesCargosMCCSolicitante';




$sSQL7s="SELECT sum(precioVenta*cantidad) as cashDev,sum(iva*cantidad) as taxDev

FROM
cargosCuentaPaciente
WHERE

folioVenta='".$FV."'
and
almacenSolicitante='".$myrow['almacen']."'
and
naturaleza='C'
and
statusCuenta='cerrada'
and
(statusDevolucion='si' or statusDevolucion='Si')
and
status!='transaccion'
and
cantidad>0
and
precioVenta>0

";
$result7s=mysql_db_query($basedatos,$sSQL7s);
$myrow7s = mysql_fetch_array($result7s);
}





$efectivo[0]+=$myrow7['efectivo'];
$ivar[0]+=$myrow7['efectivo']*0.16;

$efectivor[0]+=$myrow7r['efectivo'];
$ivarr[0]+=$myrow7r['ivar'];








$sSQLu1= "Select descripcion From articulos where entidad='".$entidad."' and codigo='".$myrow['codProcedimiento']."'";
$resultu1=mysql_db_query($basedatos,$sSQLu1); 
$myrowu1 = mysql_fetch_array($resultu1);



$dev[0]+=$myrow7s['cashDev'];


$sSQLu= "Select descripcion From almacenes where almacen='".$myrow['almacenDestino']."'";
$resultu=mysql_db_query($basedatos,$sSQLu); 
$myrowu = mysql_fetch_array($resultu);
?>


       <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow['almacen'];?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <span class="style71">
	   <?php 

	   print $myrowu['descripcion'];

	   ?>	   </span>	
       <?php 
	   if($myrow7s['cashDev']){
	   print '</br>'.'Devoluciones: '.'$'.number_format($dev[0],2);
	   }
	   ?>          </td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo "$".number_format($myrow7r['efectivo'],2); ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo "$".number_format($myrow7['efectivo'],2); ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo "$".number_format($myrow7['efectivo']*0.16,2); ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><div align="center">
         <?php if($myrow7['efectivo']){ ?>
         <a href="#" 
onclick="javascript:ventanaSecundaria1('<?php echo $despliega;?>.php?fecha=<?php echo $_POST['fecha']; ?>&amp;gpoProducto=<?php echo $myrow['codigoGP']; ?>&amp;almacen=<?php echo $almacen; ?>&amp;almacenFuente=<?php echo $myrow['almacenSolicitante']; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;fechaInicial=<?php echo $fechaInicial;?>&amp;fechaFinal=<?php echo $fechaFinal;?>')"><img src="../../imagenes/btns/detailsbtn.png" width="18" height="18" border="0" /></a>
         <?php } else { 
		echo '---';
		}
		?>
       </div></td>
     </tr>
     <?php }//cierra while?>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1" align="center">
    <tr>
      <th colspan="2" scope="col">Subtotales Deptos.</th>
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
  
  

  <p><hr /></p>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>
<?php 
} 
}
?>