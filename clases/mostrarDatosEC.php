<?php 
//*******************REFERENCIA*******************

/* //*******************************OPERACION GLOBAL*****************************
//CARGOS

if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargo[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){ 
$abono[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucion[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regreso[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}
//******************************************************************************* */

//*************************************************

/* 
//*************CARGOS*************
$sc="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as cargos
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
$rc=mysql_db_query($basedatos,$sc);
$mc = mysql_fetch_array($rc);
//**************************************

//****************ABONOS************

$sa="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as abonos
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
$ra=mysql_db_query($basedatos,$sa);
$ma = mysql_fetch_array($ra);
//*************************************


//*******************DEVOLUCIONES**************
$sd="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as devolucion
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
$rd=mysql_db_query($basedatos,$sd);
$md = mysql_fetch_array($rd);
//*************************************************************	  
  
  
  
//*****************REGRESO*********************  
$sr="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as regreso
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
$rr=mysql_db_query($basedatos,$sr);
$mr = mysql_fetch_array($rr);
//**************************************************


//*****************REGRESO*********************  
$sdes="SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as descuento
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
$rdes=mysql_db_query($basedatos,$sdes);
$mdes = mysql_fetch_array($rdes);
//**************************************************

  
$totalCargo= $mc['cargos']-$md['devolucion']-$mr['regreso']-$mdes['descuento'];
$totalAbono=$ma['abonos']; */
?>
<table width="380" border="0" align="center"  cellspacing="0" style="border: 1px solid #CCC;">
    <tr >
      <td width="25" height="25" >&nbsp;</td>
      <td width="113" >Cargos</td>
      <td width="36"  >
	  <?php 

	  echo '$'.number_format($totalCargo,2);
	  
	  ?>
	  </td>
    </tr>
    <tr >
      <td height="26">&nbsp;</td>
      <td >Abonos</td>
      <td ><?php echo '$'.number_format($totalAbono,2);?></td>
    </tr>
	
	
	
    <tr >
      <td height="26" >&nbsp;</td>
      <td  >Total</td>
      <td  ><?php echo '$'.number_format($TOTAL,2);?></td>    </tr>
	


  </table>
