<?php 
$devs=$devolucionEfectivo[0]+$devolucionTarjetaCredito[0]+$devolucionCheque[0]+$devolucionTransferenciaElectronica[0]+$devolucionCxc[0]+$devolucionOtros[0]+$devolucionNomina[0]+$devolucionAbonoAseguradoras[0]+$devolucionAbonoOtros[0]+$devolucionVentasVarias[0];




$pdf->Cell(0,0,'Efectivo',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($efectivo['0']+$efectivoCoaseguro[0],2),0,0,M);

//*******************************************************





$pdf->Ln(4); //salto de linea

//************************************

  $pdf->Cell(0,0,'Tarjeta de Credito',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($tarjetaCredito[0]+$tarjetaCreditoCoaseguro[0],2),0,0,M);
  //******************************************
  
  
  
  
  

  
$pdf->Ln(4); //salto de linea

//************************************

$pdf->Cell(0,0,'Cheques',0,0,M);
$pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($cheque[0]+$chequeCoaseguro[0],2),0,0,M);
//************************************






$pdf->Ln(4); //salto de lineas

//************************************
$pdf->Cell(0,0,'Transferencia Electronica',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($transferenciaElectronica[0],2),0,0,M);
//************************************




//************************************

$pdf->Ln(6); //saltso de linea
$pdf->Cell(0,0,'SubTotal: ',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format(($efectivo[0]+$efectivoCoaseguro[0])+($tarjetaCredito[0]+$tarjetaCreditoCoaseguro[0])+($cheque[0]+$chequeCoaseguro[0])+($transferenciaElectronica[0]+$transferenciaElectronicaCoaseguro[0]),2),0,0,M);
$pdf->Ln(6); //salto de linea











//************************************
$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Regreso Efectivo',0,0,M);

if($regresoEfectivo[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,'-$'.number_format($regresoEfectivo[0],2),0,0,M);
} else {
$pdf->SetX(93);
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Regreso CxC',0,0,M);

if($regresoCxc[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,'-$'.number_format($regresoAseguradora[0],2),0,0,M);
} else {
$pdf->SetX(93);
$pdf->Cell(0,0,'*',0,0,M);
}



$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Devolucion Efectivo',0,0,M);


if($devolucionEfectivo[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,'-$'.number_format($devolucionEfectivo[0],2),0,0,M);
} else {
$pdf->SetX(93);
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Devoluciones Tarjeta Credito',0,0,M);


if($devolucionTarjetaCredito[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,$s2.'-$'.number_format($devolucionTarjetaCredito[0],2),0,0,M);
} else {
$pdf->SetX(93);
$pdf->Cell(0,0,$s2.'*',0,0,M);
}






$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Devoluciones Cheques',0,0,M);


if($devolucionCheque[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,$s3.'-$'.number_format($devolucionCheque[0],2),0,0,M);
}else{
$pdf->SetX(93);
$pdf->Cell(0,0,$s3.'*',0,0,M);
}




$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Devoluciones de Abonos Aseguradoras',0,0,M);


if($devolucionAbonoAseguradoras[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,$s3.'-$'.number_format($devolucionAbonoAseguradoras[0],2),0,0,M);
}else{
$pdf->SetX(93);
$pdf->Cell(0,0,$s3.'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Devoluciones Abonos Otros',0,0,M);


if($devolucionAbonoOtros[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,$s3.'-$'.number_format($devolucionAbonoOtros[0],2),0,0,M);
}else{
$pdf->SetX(93);
$pdf->Cell(0,0,$s3.'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->SetX(30);
$pdf->Cell(0,0,'Devoluciones Ventas Varias',0,0,M);


if($devolucionVentasVarias[0]>0){
$pdf->SetX(90);
$pdf->Cell(0,0,$s3.'-$'.number_format($devolucionVentasVarias[0],2),0,0,M);
}else{
$pdf->SetX(93);
$pdf->Cell(0,0,$s3.'*',0,0,M);
}














$subTotal=sprintf("%01.2f",($efectivo[0]+$efectivoCoaseguro[0])+($tarjetaCredito[0]+$tarjetaCreditoCoaseguro[0])+($cheque[0]+$chequeCoaseguro[0])+($transferenciaElectronica[0]+$transferenciaElectronicaCoaseguro[0]));

$coaseguroTotal=sprintf("%01.2f",$efectivoCoaseguro[0]+$tarjetaCreditoCoaseguro[0]+$chequeCoaseguro[0]+$transferenciaElectronicaCoaseguro[0]);



$regreso=sprintf("%01.2f",$regresoEfectivo[0]-$regresoAseguradora[0]);
$devoluciones=sprintf("%01.2f",$devolucionEfectivo[0]+$devolucionCheque[0]+$devolucionAbonoAseguradoras[0]+$devolucionAbonoOtros[0]+$devolucionVentasVarias[0]);
$devolucionesTotales=sprintf("%01.2f",$devolucionEfectivo[0]+$devolucionCheque[0]+
$devolucionCxc[0]+$devolucionTarjetaCredito[0]+
$devolucionNomina[0]+$devolucionOtros[0]+$devolucionAbonoAseguradora[0]+
$devolucionAbonoOtros[0]+$devolucionBeneficencia[0]+$devolucionCortesia[0]+
$devolucionVentasVarias[0]);
//************************************



$pdf->Ln(8); //salto de linea
$pdf->Cell(0,0,'TOTAL DEPOSITO AL BANCO____________________________________',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.  number_format((($efectivo[0]+$tarjetaCredito[0]+$cheque[0]+$transferenciaElectronica[0])+$coaseguroTotal)-$devoluciones-$regreso,2),0,0,M);
$pdf->Ln(10); //salto de linea





























$pdf->Ln(5); //salto de linea
$pdf->Cell(0,0,'RESUMEN DE TRANSACCIONES',0,0,M); //ENCABEZADO


$pdf->Ln(5); //salto de linea
$pdf->Cell(0,0,'Total de Pagos ',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($subTotal,2),0,0,M);
$TOTAL1= sprintf("%01.2f",$myrowa['efectivo']+$myrowb['TC']+$myrowc['Cheques']+$myrowd['Transferencia']);






$pdf->Ln(5); //salto de linea


//************************************
  $pdf->Cell(0,0,'Traslado a Cuentas por Cobrar',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($cxc[0],2),0,0,M);
  
  
  
  
  
  $pdf->Ln(5); //salto de linea


//************************************
  $pdf->Cell(0,0,'Traslado a Otros',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($otros[0],2),0,0,M);
//**********************************************************




  
  $pdf->Ln(5); //salto de linea


//************************************
  if($nomina[0]>0){
  $pdf->Cell(0,0,'Traslado a Nomina',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($nomina[0],2),0,0,M);
  }else{
  $pdf->SetX(110);
  $pdf->Cell(0,0,'*',0,0,M);    
  }
//**********************************************************



  $pdf->Ln(5); //salto de linea


//************************************
  $pdf->Cell(0,0,'Cortesias',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($cortesias[0],2),0,0,M);



  $pdf->Ln(5); //salto de linea


//************************************
  $pdf->Cell(0,0,'Descuento Particular',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($descuentoParticular[0],2),0,0,M);

  $pdf->Ln(5); //salto de linea


//************************************
  if($descuentoAseguradora[0]>0){
  $pdf->Cell(0,0,'Descuento Aseguradora',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($descuentoAseguradora[0],2),0,0,M);
  }else{
  $pdf->SetX(110);
  $pdf->Cell(0,0,'*',0,0,M);    
  }

//****************************DEVOLUCIONES Y REGRESO******************************

$pdf->Ln(5); //salto de linea
//************************************
//$pdf->SetX(40);
$pdf->Cell(0,0,'Regreso Efectivo',0,0,M);
$pdf->SetX(110);
if($regresoEfectivo[0]>0){

$pdf->Cell(0,0,'$'.number_format($regresoEfectivo[0],2),0,0,M); 
} else {

$pdf->Cell(0,0,'*',0,0,M); 
}




$pdf->Ln(4); //salto de linea

$pdf->Cell(0,0,'Regreso Aseguradora',0,0,M);

$pdf->SetX(110);
if($regresoCxc[0]){
$pdf->Cell(0,0,'$'.number_format($regresoAseguradora[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}



/* $pdf->Ln(4); //salto de linea

$pdf->Cell(0,0,'Regreso Nomina',0,0,M);

$pdf->SetX(110);
if($regresoCxc[0]){
$pdf->Cell(0,0,'$'.number_format($regresoNomina[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}
 */


$pdf->Ln(5); //salto de linea
//************************************
//$pdf->SetX(40);
$pdf->Cell(0,0,'Devoluciones Efectivo',0,0,M);
$pdf->SetX(110);
if($devolucionEfectivo[0]>0){

$pdf->Cell(0,0,'$'.number_format($devolucionEfectivo[0],2),0,0,M); 
} else {

$pdf->Cell(0,0,'*',0,0,M); 
}




$pdf->Ln(4); //salto de linea

$pdf->Cell(0,0,'Devoluciones Tarjeta Credito',0,0,M);

$pdf->SetX(110);
if($devolucionTarjetaCredito[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionTarjetaCredito[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}




$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Cheques',0,0,M);

$pdf->SetX(110);
if($devolucionCheque[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionCheque[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}



$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones CxC',0,0,M);

$pdf->SetX(110);
if($devolucionCxc[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionCxc[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Nomina',0,0,M);

$pdf->SetX(110);
if($devolucionNomina[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionNomina[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones de Abonos a Aseguradora',0,0,M);

$pdf->SetX(110);
if($devolucionAbonoAseguradoras[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionAbonoAseguradoras[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones de Abonos a Otros',0,0,M);

$pdf->SetX(110);
if($devolucionAbonoOtros[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionAbonoOtros[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}



$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Beneficencia',0,0,M);

$pdf->SetX(110);
if($devolucionBeneficencia[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionBeneficencia[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Cortesia ',0,0,M);

$pdf->SetX(110);
if($devolucionCortesia[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionCortesia[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devolucion Descuento',0,0,M);

$pdf->SetX(110);
if($devolucionDescuento[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionDescuento[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}



$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devolucion Ventas Varias ',0,0,M);

$pdf->SetX(110);
if($devolucionVentasVarias[0]>0){
$pdf->Cell(0,0,'$'.number_format($devolucionVentasVarias[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}



$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Beneficencias',0,0,M);

$pdf->SetX(110);
if($beneficencia[0]>0){
$pdf->Cell(0,0,'$'.number_format($beneficencia[0],2),0,0,M);
} else {
$pdf->Cell(0,0,'*',0,0,M);
}

//************************************


$TOTAL=sprintf("%01.2f",($subTotal+$cxc[0]+$nomina[0]+$otros[0])+$devolucionesTotales+($regresoEfectivo[0]+$regresoAseguradora[0]+$regresoNomina[0])+$beneficencia[0]+$cortesias[0]+$descuentoParticular[0]+$descuentoAseguradora[0]+$devolucionDescuento[0]);
$pdf->Ln(5); //salto de linea
$pdf->Cell(0,0,'TOTAL DE TRANSACCIONES_____________________________________',0,0,M); //ENCABEZADO
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($TOTAL,2),0,0,M);
$pdf->Ln(10); //salto de linea
?>