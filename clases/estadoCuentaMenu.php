<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<h1 align="center" class="titulos">Nota de Venta </h1>
  <?php
  $sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//***************aplicar pago**********************  


  ?>
<form id="form1" name="form1" method="post" action="#">
  <table width="484" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr bgcolor="#330099">
      <th class="blanco" scope="col"><div align="left" class="blanco">Folio de Venta</div></th>
      <th class="blanco" scope="col"><div align="left" class="blanco"><?php 
		 echo $nCliente=$myrow3['folioVenta'];
		  ?>
          <input name="numeroE" type="hidden" class="blanco" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="134" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blanco">Paciente: </div></th>
      <th width="343" bgcolor="#FFFFFF"  scope="col"><div align="left" class="normal"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blanco">Compa&ntilde;&iacute;a: </td>
      <td bgcolor="#FFFFFF" class="normal">
        <label> <?php echo $traeSeguro=$myrow3['seguro']; ?>

            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
        </label>      </td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blanco">N&deg; Credencial: </td>
      <td bgcolor="#FFFFFF" class="normal"><?php echo $myrow3['credencial']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blanco">Fecha</td>
      <td bgcolor="#FFFFFF" class="normal"><?php echo cambia_a_normal($myrow3['fecha']); ?></td>
    </tr>
  </table>
  <p align="center">
  <?php if($_GET['codigoPaquete']){ 
  echo 'Paquete: '.$_GET['codigoPaquete'];
  
  }?></p>
  

  
  
<a href="#" 
onclick="javascript:ventanaSecundaria7('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow3['folioVenta'];?>')">
  <p align="center">Ver Estado de Cuenta</p>
  </a><div align="center">
    <p>&nbsp;</p>
    <table width="981" border="0.2" align="center">
      <tr>
        <th width="37" bgcolor="#660066" class="blanco" scope="col"><div align="center">#</div></th>
        <th width= "67" bgcolor="#660066" class="blanco" scope="col"><div align="center">Mov.</div></th>
        <th width= "345" bgcolor="#660066" class="blanco" scope="col"><div align="center">Descripcion</div></th>
        <th width= "64" bgcolor="#660066" class="blanco" scope="col"><div align="center">Totales</div></th>
        <th width= "26" bgcolor="#660066" class="blanco" scope="col"><div align="center">N</div></th>
        <th width= "77" bgcolor="#660066" class="blanco" scope="col"><div align="center">Particular</div></th>
		
        <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Aseguradora</div></th>
        <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Coaseguro1</div></th>
        <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Coaseguro2</div></th>
        <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Deducible1</div></th>
        <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Deducible2</div></th>
      </tr>
      <tr>
<?php	
$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
folioVenta='".$_GET['folioVenta']."'";
 

 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$a+=1;
$nT=$myrow['keyClientesInternos'];
if($myrow['naturaleza']=='A'){
$signo='-';
}else{
$signo=NULL;
}
?>
        <td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php print $a;?></td>
        <td width="67" bgcolor="<?php echo $color?>" class="normal"><?php
	echo $myrow['keyCAP'];
	   ?></td>
        <td width="345" bgcolor="<?php echo $color?>" class="normal"><?php
	  if($myrow['gpoProducto']){
	   if($myrow['descripcionArticulo']){
	   echo $myrow['descripcionArticulo'];
if($myrow['naturaleza']=='A'){
echo '</br>'.'Devolucion, folio: '.$myrow['folioDevolucion'];
}
	   }else{
$sSQL341= "Select descripcion From articulos WHERE  keyPA='".$myrow['keyPA']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
echo $myrow341['descripcion'];
if($myrow['naturaleza']=='A'){
echo '</br><div class="codigos">'.'Devolucion, folio: '.$myrow['folioDevolucion'].'</div>';
}

	   }
	   }else if($myrow['tipoTransaccion']){
$sSQL341= "Select * From catTTCaja WHERE  codigoTT='".$myrow['tipoTransaccion']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
echo $myrow341['descripcion'];
	   }else{
	   echo 'Operacion de Caja';
	   }
	   ?></td>
        <td width="64" bgcolor="<?php echo $color?>" class="normal"><div align="center">
            <?php
echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);
?>
        </div></td>
        <td width="26" bgcolor="<?php echo $color?>" class="normal"><div align="center">
            <?php
echo $myrow['naturaleza'];

?>
        </div></td>
        <td width="77" bgcolor="<?php echo $color?>" class="normal"><div align="center">
            <?php
echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);

?>
        </div></td>
        <td width="93" bgcolor="<?php echo $color?>" class="normal"><div align="center">
            <?php
echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
?>
        </div></td>
        <td width="84" bgcolor="<?php echo $color?>" class="codigos"><div align="center">
            <?php
if($myrow['tipoTransaccion']=='PCoaS1'){ 
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '---';
}
?>
        </div></td>
        <td width="84" bgcolor="<?php echo $color?>" class="codigos"><div align="center">
            <?php
if($myrow['tipoTransaccion']=='PCoaS2'){
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '---';
}
?>
        </div></td>
        <td width="78" bgcolor="<?php echo $color?>" class="codigos"><?php
if($myrow['tipoTransaccion']=='PDeduSeg1'){
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '---';
}
?></td>
        <td width="83" bgcolor="<?php echo $color?>" class="codigos"><?php
if($myrow['tipoTransaccion']=='PDeduSeg2'){
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '---';
}
?></td>
      </tr>
      <?php 
//**************************TOTALES*************************

if($myrow['naturaleza']=='C'){
$pVC[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaC[0]+=$myrow['iva']*$myrow['cantidad'];
}else{
$pVA[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaA[0]+=$myrow['iva']*$myrow['cantidad'];
}
//**********************************************************



//***********************PARTICULAR***********************

if($myrow['naturaleza']=='C'){
$cantidadParticularCargo[0]+=$myrow['cantidadParticular']*$myrow['cantidad'];
$ivaParticularCargo[0]+=$myrow['ivaParticular']*$myrow['cantidad'];
}else if($myrow['naturaleza']=='A'){
$cantidadParticularAbono[0]+=$myrow['cantidadParticular']*$myrow['cantidad'];
$ivaParticularAbono[0]+=$myrow['ivaParticular']*$myrow['cantidad'];
}

//**********************************************************






//***************************ASEGURADORA*******************


if($myrow['naturaleza']=='C'){
$cantidadAseguradoraCargo[0]+=$myrow['cantidadAseguradora']*$myrow['cantidad'];
$ivaAseguradoraCargo[0]+=$myrow['ivaAseguradora']*$myrow['cantidad'];
}else if($myrow['naturaleza']=='A'){
$cantidadAseguradoraAbono[0]+=$myrow['cantidadAseguradora']*$myrow['cantidad'];
$ivaAseguradoraAbono[0]+=$myrow['ivaAseguradora']*$myrow['cantidad'];
}



//********************************************************



//**********************COASEGURO1****************************


if($myrow['tipoTransaccion']=='PCoaS1'){ 
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro1[0]+=$myrow['precioVenta'];
}else{
$totalAbonoCoaseguro1[0]+=$myrow['precioVenta'];
}
}


if($myrow['tipoTransaccion']=='PCoaS2'){
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro2[0]+=$myrow['precioVenta'];
}else{
$totalAbonoCoaseguro2[0]+=$myrow['precioVenta'];
}
}


if($myrow['tipoTransaccion']=='PDeduSeg1'){ 
if($myrow['naturaleza']=='-'){
$totalCargoDeducible1[0]+=$myrow['precioVenta'];
}else{
$totalAbonoDeducible1[0]+=$myrow['precioVenta'];
}
}


if($myrow['tipoTransaccion']=='PDeduSeg2'){
if($myrow['naturaleza']=='-'){
$totalCargoDeducible2[0]+=$myrow['precioVenta'];
}else{
$totalAbonoDeducible2[0]+=$myrow['precioVenta'];
}
}




//************************************************************
//********cargos
if($myrow['naturaleza']=='C'){
$ca[0]+=(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']));

}

if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$ab[0]+=(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']));
}

if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!='') {
$devoluciones[0]+=(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']));

}

//**************************************************************
?>
      <?php  }}?>
      <input name="menu" type="hidden" value="<?php echo $menu;?>" />
    </table>
    </p>
	
	
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <p>
 <?php 

$tt= ($ca[0]-$devoluciones[0])-$ab[0];

$totalCoaseguro1=$totalCargoCoaseguro1[0]-$totalAbonoCoaseguro1[0];
$totalCoaseguro2=$totalCargoCoaseguro2[0]-$totalAbonoCoaseguro2[0];
$totalDeducible1=$totalCargoDeducible1[0]-$totalAbonoDeducible1[0];
$totalDeducible2=$totalCargoDeducible2[0]-$totalAbonoDeducible2[0];




$totalesCoaseguro=$totalAbonoCoaseguro1[0]+$totalAbonoCoaseguro2[0]+$totalAbonoDeducible1[0]+$totalAbonoDeducible2[0];




$totalParticular=($cantidadParticularCargo[0]+$ivaParticularCargo[0])-($cantidadParticularAbono[0]+$ivaParticularAbono[0]);
$totalAseguradora=(($cantidadAseguradoraCargo[0]+$ivaAseguradoraCargo[0])-($cantidadAseguradoraAbono[0]+$ivaAseguradoraAbono[0]))-$totalesCoaseguro;


if($tt>=-1 and $tt<=1){
$tt=0;
}
?>
  </p>
  <table width="200" border="1" align="center" class="normal">
    <tr>
      <td>&nbsp;</td>
      <td>Cargos</td>
      <td><?php echo '$'.number_format($ca[0]-$devoluciones[0],2);?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Abonos</td>
      <td><?php echo '$'.number_format($ab[0],2);?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Total</td>
      <td><?php echo '$'.number_format($tt,2);?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1" align="center" class="normal">
    <tr>
      <td>Particular</td>
      <td>Aseguradora</td>
      <td>Coaseguro1</td>
      <td>Coaseguro2</td>
      <td>Deducible1</td>
      <td>Deducible2</td>
    </tr>
    <tr>
      <td><?php if(round($totalParticular,2)>0){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=efectivo&amp;tipoTransaccion=particular','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalParticular,2);?></a>
      <?php } else{
echo 'Ok';
} ?></td>
      <td>
	        <?php if($totalAseguradora>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;precioVenta=<?php echo $totalAseguradora;?>&amp;modoPago=cxc&amp;transaccion=aseguradora&amp;tipoTransaccion=aseguradora&tipoPago=Cuentas por Cobrar','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalAseguradora,2);?></a>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>
	  	        <?php if($totalCoaseguro1>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalCoaseguro1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS1','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalCoaseguro1,2);?></a>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>
	  	  	        <?php if($totalCoaseguro2>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalCoaseguro2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS2','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalCoaseguro2,2);?></a>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>
	  	  	  	        <?php if($totalDeducible1>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalDeducible1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg1','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalDeducible1,2);?></a>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>
	  	  	  	  	        <?php if($totalDeducible2>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalDeducible2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg2','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalDeducible2,2);?></a>
      <?php } else{
echo 'Ok';
} ?>	  </td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <p align="center">



 <input type="hidden" name="variable_php" id="variable_php" />

</form>

<p align="center">&nbsp;</p>
<script languaje="JavaScript">            
              document.form1.variable_php.value=varjs;
    </script>
</body>
</html>
