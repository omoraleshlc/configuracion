
<?php 
//*******************************OPERACION GLOBAL*****************************
//CARGOS

if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargo[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){ 
$abono[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucion[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES CARGOS
if($myrow['naturaleza']=='C' and $myrow['statusDevolucion']=='si'){
$devolucionCargos[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}



//REGRESOS
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regreso[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}
//*******************************************************************************







//CARGOS PARTICULARES 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
}
//******************************************************************************************







//CARGOS ASEGURADORA
//ES BENEFICENCIA



// if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==NULL){//devolucion transacciones
// $abonosBeneficencia[0]+=$myrow['cantidadAseguradora']*$myrow['cantidad'];
// }elseif($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){//cargos al paciente
//  $devolucionBeneficencia[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);//devolucion articulos
// }else if($myrow['naturaleza']=='C' ){//cargos al paciente
// $cargosBeneficencia[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
// }else if($myrow['naturaleza']=='C' and $myrow['gpoProducto']==''){//cargos al paciente
// $pagoDevBeneficencia[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
// }
 

if($myrow['naturaleza']=='C' and $myrow['gpoProducto']!=''){//cargos al paciente
   $cargosBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){//devolucion de cargo beneficencia
$devolucionBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['tipoTransaccion']=='DEVXB'){ 
$dtBeneficencia[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}






if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){//abonos
$abonosBeneficencia[0]+=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad']);
}


if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
}




//IVA
if($myrow['naturaleza']=='C'){
$ivaCargos[0]+=(float) ($myrow['iva']*$myrow['cantidad']);
}elseif($myrow['naturaleza']=='A'){
$ivaAbonos[0]+=(float) ($myrow['iva']*$myrow['cantidad']);
}
//******************************************************************************************
?>















<?php

//****************************COASEGURO / DEDUCIBLE **********************************


$s1= "Select codigoTT From catTTCaja WHERE  coaseguro1='si'  ";
$rs1=mysql_db_query($basedatos,$s1);
$my1 = mysql_fetch_array($rs1);

$s2= "Select codigoTT From catTTCaja WHERE  coaseguro2='si'  ";
$rs2=mysql_db_query($basedatos,$s2);
$my2 = mysql_fetch_array($rs2);

$s3= "Select codigoTT From catTTCaja WHERE  deducible1='si'  ";
$rs3=mysql_db_query($basedatos,$s3);
$my3 = mysql_fetch_array($rs3);

$s4= "Select codigoTT From catTTCaja WHERE  deducible2='si'  ";
$rs4=mysql_db_query($basedatos,$s4);
$my4 = mysql_fetch_array($rs4);

$s5= "Select codigoTT From catTTCaja WHERE  aplicarDescuentoParticulares='si'  ";
$rs5=mysql_db_query($basedatos,$s5);
$my5 = mysql_fetch_array($rs5);

$s5a= "Select codigoTT From catTTCaja WHERE  descuentoParticulares='si'  ";
$rs5a=mysql_db_query($basedatos,$s5a);
$my5a = mysql_fetch_array($rs5a);

$s6= "Select codigoTT From catTTCaja WHERE  aplicarDescuentoAseguradoras='si'  ";
$rs6=mysql_db_query($basedatos,$s6);
$my6 = mysql_fetch_array($rs6);

$s6a= "Select codigoTT From catTTCaja WHERE  descuentoAseguradoras='si'  ";
$rs6a=mysql_db_query($basedatos,$s6a);
$my6a = mysql_fetch_array($rs6a);

$s7= "Select codigoTT From catTTCaja WHERE  trasladoBeneficencia='si'  ";
$rs7=mysql_db_query($basedatos,$s7);
$my7 = mysql_fetch_array($rs7);
//*************************************************************************************



if($myrow['tipoTransaccion']==$my1['codigoTT']){ 
$coaseguro1=$my1['codigoTT'];
if($myrow['naturaleza']=='-'){ 
$totalCargoCoaseguro1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my2['codigoTT']){
$coaseguro2=$my2['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
} 


if($myrow['tipoTransaccion']==$my3['codigoTT']){
$deducible1=$my3['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible1[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
} 

if($myrow['tipoTransaccion']==$my4['codigoTT']){
$deducible2=$my4['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible2[0]+=(float) ($myrow['precioVenta']*$myrow['cantidad']);
}
}

//*******************CIERRO COASEGURO Y DEDUCIBLE


//****************APlicar descuentos**********
if($myrow['tipoTransaccion']==$my5['codigoTT'] || $myrow['tipoTransaccion']==$my5a['codigoTT']){ 
$descuentoParticular=$my5a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoParticularAplicado[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad']);
}else{
$descuentosParticulares[0]+=(float) ($myrow['cantidadParticular']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my6['codigoTT'] || $myrow['tipoTransaccion']==$my6a['codigoTT']){
$descuentoAseguradora=$my6a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoAseguradoraAplicado[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad']);
}else{
$descuentosAseguradoras[0]+=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad']);
}
}



if($myrow['tipoTransaccion']==$my7['codigoTT'] || $myrow['tipoTransaccion']==$my7a['codigoTT']){
$transB=$my7['codigoTT'];
}
//*********************************************
?>