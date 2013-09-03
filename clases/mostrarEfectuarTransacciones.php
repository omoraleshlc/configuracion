<?php 
$descripcionTransaccion=$_GET['descripcionTransaccion'];
//******ULTIMO TIRON**************

if($_GET['descripcionTransaccion']=='altaPacientes'){
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}else{
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nCuenta']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}
//***********************************

?>
<p>&nbsp;</p>

<a name="final">
    </a>

<table width="590" border="0" align="center" cellpadding="4" cellspacing="0" class="table table-striped" style="border: 1px solid #CCC;">
  <tr>
    <th colspan="2" ><b >Particular</b></th>
    <th width="75" >&nbsp;</th>
     <th colspan="2" ><b >Beneficencia</b></th>
    <th width="75" >&nbsp;</th>
    <th colspan="2" ><b >Aseguradora</b></th>
  </tr>
  <tr>
    <td width="137" ><span >Cargos</span></td>
    <td width="75"><span >
      <?php 
	  
$sSQLpartc= "Select sum(cantidadParticular*cantidad) as totalParticular, sum(ivaParticular*cantidad) as totalIVA From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
 ";
$resultpartc=mysql_db_query($basedatos,$sSQLpartc);
$myrowpartc = mysql_fetch_array($resultpartc);	  
	  
	  
$sSQLparta= "Select sum(cantidadParticular*cantidad) as totalParticular, sum(ivaParticular*cantidad) as totalIVA From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
 ";
$resultparta=mysql_db_query($basedatos,$sSQLparta);
$myrowparta = mysql_fetch_array($resultparta);


echo  '$'.number_format($myrowpartc['totalParticular']-$myrowparta['totalParticular'],2);
?>
    </span></td>
    <td>&nbsp;</td>
    
    
        <td width="137" ><span >Cargos</span></td>
    <td width="75"><span >
      <?php 
	  
$sSQLbenec= "Select sum(cantidadBeneficencia*cantidad) as totalParticular, sum(ivaBeneficencia*cantidad) as totalIVA From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
 ";
$resultbenec=mysql_db_query($basedatos,$sSQLbenec);
$myrowbenec = mysql_fetch_array($resultbenec);	  
	  
	  
$sSQLbenea= "Select sum(cantidadBeneficencia*cantidad) as totalParticular, sum(ivaBeneficencia*cantidad) as totalIVA From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
 ";
$resultbenea=mysql_db_query($basedatos,$sSQLbenea);
$myrowbenea = mysql_fetch_array($resultbenea);



echo  '$'.number_format($myrowbenec['totalParticular']-$myrowbenea['totalParticular'],2);
?>
    </span></td>
    <td>&nbsp;</td>
    
    
    
    
    
    
    
    
    
    
    
    
    <td width="116"><span >Cargos</span></td>
    <td width="153"><span >
      <?php 
	  
$sSQLasegc= "Select sum(cantidadAseguradora*cantidad) as totalAseguradora, sum(ivaAseguradora*cantidad) as totalIVA From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='C'
and
gpoProducto!=''
 ";
$resultasegc=mysql_db_query($basedatos,$sSQLasegc);
$myrowasegc = mysql_fetch_array($resultasegc);	  
	  
$sSQLasega= "Select sum(cantidadAseguradora*cantidad) as totalAseguradora, sum(ivaAseguradora*cantidad) as totalIVA 
    From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
naturaleza='A'
and
gpoProducto!=''
 ";
$resultasega=mysql_db_query($basedatos,$sSQLasega);
$myrowasega = mysql_fetch_array($resultasega);



echo  '$'.number_format($myrowasegc['totalAseguradora']-$myrowasega['totalAseguradora'],2);
?>
    </span></td>
    
    
    
    
  </tr>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowpartc['totalIVA']-$myrowparta['totalIVA'],2);?></span></td>
    <td>&nbsp;</td>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowbenec['totalIVA']-$myrowbenea['totalIVA'],2);?></span></td>
    <td>&nbsp;</td>
    <td><span >IVA</span></td>
    <td><span ><?php echo  '$'.number_format($myrowasegc['totalIVA']-$myrowasega['totalIVA'],2);?></span></td>
  </tr>
  
  
  
  
  
  <tr>
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowpartc['totalParticular']+$myrowpartc['totalIVA'])-($myrowparta['totalParticular']+$myrowparta['totalIVA']),2);?></span></td>
    <td>&nbsp;</td>
    
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowbenec['totalParticular']+$myrowbenec['totalIVA'])-($myrowbenea['totalParticular']+$myrowbenea['totalIVA']),2);?></span></td>
    <td>&nbsp;</td>
    
    
    
    <td><span >Total</span></td>
    <td><span ><?php echo  '$'.number_format(($myrowasegc['totalAseguradora']+$myrowasegc['totalIVA'])-($myrowasega['totalAseguradora']+$myrowasega['totalIVA']),2);?></span></td>
  </tr>
</table>

<p>&nbsp;</p>
<table width="900" class="table table-striped" style="border: 1px solid #CCC;">

  <tr >
    <th width="76"  ><div align="center">Part</div></th>
    <th width="76"  ><div align="center">Aseg</div></th>
    <th width="111"  ><div align="center">Regreso Aseg</div></th>
    <th width="104"  ><div align="center">Regreso Part </div></th>
    <th width="89"  ><div align="center">C1</div></th>
    <th width="100"  ><div align="center">C2</div></th>
    <th width="95"  ><div align="center">D1</div></th>
    <th width="88"  ><div align="center">D2</div></th>
    <th width="77"  ><div align="center">Desc Part </div></th>
    <th width="84"  ><div align="center">Desc Aseg </div></th>
    <th width="84"  ><div align="center">Beneficencia</div></th>
  </tr>
  <tr  >
    <td height="48"  ><div align="center"><span >
<?php  





//************************PARTICULARES**********************************************************************
//CARGOS PARTICULARES REFERENCIAS 
/* if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
} */
//******************************************************************************************

/* //*************CARGOS*************
$sPc="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as cargoParticular
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rPc=mysql_db_query($basedatos,$sPc);
$mPc = mysql_fetch_array($rPc);
//**************************************

//****************ABONOS************

$sPa="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as abonoParticular
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'  ";
$rPa=mysql_db_query($basedatos,$sPa);
$mPa = mysql_fetch_array($rPa);
//*************************************


//*******************DEVOLUCIONES**************
$sPd="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as devolucionParticular
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A' 
and
statusDevolucion='si'
 ";
$rPd=mysql_db_query($basedatos,$sPd);
$mPd = mysql_fetch_array($rPd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sPr="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as regresoParticular
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  
and
statusRegreso='si'
";
$rPr=mysql_db_query($basedatos,$sPr);
$mPr = mysql_fetch_array($rPr);
//**************************************************


//*****************REGRESO*********************  
$sPdes="SELECT 
sum((cantidadParticular*cantidad) +(ivaParticular*cantidad) as descuentoParticular
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  
and
statusDescuento='si'
";
$rPdes=mysql_db_query($basedatos,$sPdes);
$mPdes = mysql_fetch_array($rPdes);
//**************************************************


  
 $totalParticular= $mPc['cargoParticular']-$mPa['abonoParticular']-$mPd['devolucionParticular']-$mPr['regresoParticular']-$mPdes['descuentoParticular'];
//***********************************************  ****************************************************************************** */
  
  
  
  
  

  

  
  

  
  
  
if( $totalParticular>=1 ||  ($myrow3['statusDevolucion']=='si' and  $descuentoP<1 and $descuentoA<1 )){ 




if($myrow3['statusCortesia']=='si'){

$tipoPago='Cortesia';


}else{	
if($myrow3['tipoPaciente']=='externo' or (($myrow3['tipoPaciente']=='interno' or $myrow3['tipoPaciente']=='urgencias') and $myrow3['statusDevolucion']=='si')){ 
if($devolucionParticular[0]>0 and $myrow3['statusDevolucion']=='si'){	
$tipoDevolucion='';
$tipoPago='';
if($totalParticular<0){ 
$totalParticular*=-1;
}
}else{
$s= "Select codigoTT From catTTCaja WHERE  pagoEfectivo='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}


}elseif($myrow3['activaBeneficencia']=='si'){
 $s= "Select codigoTT From catTTCaja WHERE  trasladoBeneficencia='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Beneficencia';
$caso=1;
}else{
$s= "Select codigoTT From catTTCaja WHERE  gastosParticulares='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}
}



?>
      <?php if($mostrar==TRUE){ ?>


<?php if($totalParticular>0 and $totalParticular>-1){ ?>
<a  href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionParticular';}else{ echo 'efectivo';} ?>&amp;tipoTransaccion=particular&amp;tipoPago=<?php echo $tipoPago;?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>&statusCortesia=<?php echo $myrow3['statusCortesia'];?>&tipoDevolucion=<?php echo $tipoDevolucion;?>&beneficencia=<?php
if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&statusBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&activaBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&caso=<?php echo $caso;?>','ventana7','680','380','yes');">
<?php 
echo '$'.number_format($totalParticular,2);
?>
</a>
<?php } else{       
echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';}?>



      <?php } else { echo '$'.number_format($totalParticular,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    <td  ><div align="center"><span >






<?php 
//********************************cANTIDAD ASEGURADORA****************************************

//*********************REFERENCIA*****************/
/* //CARGOS ASEGURADORA 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}
 */


/* 
//*************CARGOS*************
$sAc="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as cargoAseguradora
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  ";
$rAc=mysql_db_query($basedatos,$sAc);
$mAc = mysql_fetch_array($rAc);
//**************************************

//****************ABONOS************

$sAa="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as abonoAseguradora
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'  ";
$rAa=mysql_db_query($basedatos,$sAa);
$mAa = mysql_fetch_array($rAa);
//*************************************


//*******************DEVOLUCIONES**************
$sAd="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as devolucionAseguradora
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A' 
and
statusDevolucion='si'
 ";
$rAd=mysql_db_query($basedatos,$sAd);
$mAd = mysql_fetch_array($rAd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sAr="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as regresoAseguradora
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='C'  
and
statusRegreso='si'
";
$rAr=mysql_db_query($basedatos,$sAr);
$mAr = mysql_fetch_array($rAr);
//**************************************************


//*****************REGRESO*********************  
$sdes="SELECT 
sum((cantidadAseguradora*cantidad) +(ivaAseguradora*cantidad) as descuentoAseguradora
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''
and
naturaleza='A'  
and
statusDescuento='si'
";
$rPdes=mysql_db_query($basedatos,$sPdes);
$mPdes = mysql_fetch_array($rPdes);
//**************************************************


  
 $totalParticular= $mPc['cargoParticular']-$mPa['abonoParticular']-$mPd['devolucionParticular']-$mPr['regresoParticular']-$mPdes['descuentoParticular'];
//***********************************************  ******************************************************************************
 */


//**************************************************************************************************



if( $totalAseguradora>=1 || $myrow3['statusDevolucion']=='si'){ 

if($devolucionAseguradora[0]>0 and $myrow3['statusDevolucion']=='si'){ 
$s= "Select codigoTT From catTTCaja WHERE  devolucionAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

if($totalAseguradora<0){ 
$totalAseguradora*=-1;
}
$tipoPago='';

}else{
$s= "Select codigoTT From catTTCaja WHERE  trasladoAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Cuentas por Cobrar';
}
?>







      <?php  if($totalCoaseguro1<1 and $totalCoaseguro2<1 and $totalDeducible1<1 and $totalDeducible2<1 and $descuentoP<1 and $descuentoA<1){ ?>
      <?php if($mostrar==TRUE){ ?>
	  
	  
	  
	  <?php if($totalAseguradora>=-1 and $totalAseguradora>0){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;precioVenta=<?php echo $totalAseguradora;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionAseguradora';}else{ echo 'cxc';} ?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;tipoTransaccion=aseguradora&amp;tipoPago=<?php echo $tipoPago;?>&amp;devolucion=<?php echo $_GET['devolucion'];?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','800','380','yes');"> <?php echo '$'.number_format($totalAseguradora,2);?></a>
      <?php } else { echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';}?>





      <?php } else { echo '$'.number_format($totalAseguradora,2);}?>
      <?php } else{?>
      <?php echo '$'.number_format($totalAseguradora,2);?>
      <?php } ?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>

















  
<td  >
<div align="center"><span >
<?php 
if($totalAseguradora<-1  and $devolucionAseguradora[0]<1){ 
$tA=$totalAseguradora*-1;
?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tA;?>&amp;modoPago=regresoAseguradora&amp;tipoTransaccion=particular&amp;tipoPago=regresoAseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"> </a></span></div>      <span ><a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tA;?>&amp;modoPago=regresoAseguradora&amp;tipoTransaccion=particular&amp;tipoPago=regresoAseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"><blink> 
      <div align="center"><?php echo '$'.number_format($tA,2);?> </div>
      </blink></a>
      <div align="center">
        <?php } else { echo '$'.number_format($tA,2);}?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
        <?php } ?>
      </div>
</span>
</td>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <td  ><div align="center"><span >
      <?php
 if($totalParticular<-1){  
$tP=$totalParticular*-1;
?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"></a></span></div>     
        <span >
            
<a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"><blink>
     <div align="center">
     <?php echo '$'.number_format($tP,2);?>
     </div>
      </blink></a>
            
            
      <div align="center">
        <?php } else { echo '$'.number_format($tP,2);}?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
        <?php } ?>
      </div>
    </span></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro1>=1){ 	?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro1;?>&amp;precioVenta=<?php echo $totalCoaseguro1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro1,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro1,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro2>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro2;?>&amp;precioVenta=<?php echo $totalCoaseguro2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro2,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro2,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible1>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible1;?>&amp;precioVenta=<?php echo $totalDeducible1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible1,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible1,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible2>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible2;?>&amp;precioVenta=<?php echo $totalDeducible2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible2,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible2,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  >
        <div align="center">
            <span >
      <?php if($descuentoP>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoParticular;?>&amp;precioVenta=<?php echo $descuentoP;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=particular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoP,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoP,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($descuentoA>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoAseguradora;?>&amp;precioVenta=<?php echo $descuentoA;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=aseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoA,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoA,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>




    
    
    
    
<?php 
//*******************BENEFICENCIA
if($ben!=NULL and $ben<0){ 
$mp='devolucionBeneficencia';
$ben=$ben*-1;
$tpb='devolucionBeneficencia';

}else{$mp='Beneficencia';$tpb='Beneficencia';}?>



     <td  ><div align="center"><span >
      <?php if($ben!=NULL){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $transB;?>&amp;precioVenta=<?php echo $ben;?>&amp;modoPago=<?php echo $mp;?>&amp;tipoPago=<?php echo $tpb;?>&descripcionTransaccion=beneficencia&status=<?php echo $myrow3['status'];?>&beneficencia=si&statusBeneficencia=si','ventana7','480','380','yes');"> <?php echo '$'.number_format($ben,2);?></a>
      <?php } else { echo '$'.number_format($ben,2);}?>
      <?php } else{?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
  </tr>

</table>
<p>&nbsp;</p>
