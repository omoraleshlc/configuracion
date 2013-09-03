<?php   
$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$s1= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and coaseguro1='si'  ";
$rs1=mysql_db_query($basedatos,$s1);
$my1 = mysql_fetch_array($rs1);
$coaseguro1=$my1['codigoTT'];

$s2= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and coaseguro2='si'  ";
$rs2=mysql_db_query($basedatos,$s2);
$my2 = mysql_fetch_array($rs2);
$coaseguro2=$my2['codigoTT'];

$s3= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and deducible1='si'  ";
$rs3=mysql_db_query($basedatos,$s3);
$my3 = mysql_fetch_array($rs3);
$deducible1=$my3['codigoTT'];

$s4= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and deducible2='si'  ";
$rs4=mysql_db_query($basedatos,$s4);
$my4 = mysql_fetch_array($rs4);
$deducible2=$my4['codigoTT'];


$totalCoaseguro1=$totalCargoCoaseguro1[0]-$totalAbonoCoaseguro1[0];
$totalCoaseguro2=$totalCargoCoaseguro2[0]-$totalAbonoCoaseguro2[0];
$totalDeducible1=$totalCargoDeducible1[0]-$totalAbonoDeducible1[0];
$totalDeducible2=$totalCargoDeducible2[0]-$totalAbonoDeducible2[0];
?>
<table width="616" border="1" align="center" class="normal">
    <tr>
      <td width="198"><div align="center">Transaccion Particular </div></td>
      <td width="198"><div align="center">Transaccion Aseguradora </div></td>
      <td width="198" height="25"><div align="center">Abonar a Cuenta Paciente </div></td>
    </tr>
    <tr>
	
	
      
	  
<?php
$s= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and devolucionEfectivo='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
?>

	  <td><a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;modoPago=devolucionParticular&amp;tipoTransaccion=particular&amp;descripcionTransaccion=devolucionParticular','ventana7','800','800','yes');">
        <div class="codigos">
          <div align="center">Devolucion </div>
        </div>
      </a></td>
	  
	  
	  
<?php
$s= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and devolucionAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
?>
	  
      <td><a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;modoPago=devolucionAseguradora&amp;tipoTransaccion=particular&amp;descripcionTransaccion=devolucionAseguradora','ventana7','800','800','yes');">
        <div class="codigos">
          <div align="center">Devolucion </div>
        </div>
      </a></td>









<td>
<?php
$s= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and abono='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
?>
	  
	        <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;modoPago=efectivo&amp;tipoTransaccion=particular&abono=si&descripcionTransaccion=abonos','ventana7','800','800','yes');"> <div class="codigos">
	          <div align="center"><blink>Presiona Aqui...</blink></div>
	        </div>
	        </a>	  </td>
    </tr>
</table>
<p>&nbsp;</p>
