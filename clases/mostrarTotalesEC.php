<?php 
  //OPERACIONES GLOBALES


  $totalCargo=(float) ($cargo[0]-$devolucion[0]);
  $totalAbono=(float) ($abono[0]-$regreso[0]+$descuentos[0]);
  
  $totalParticular=(float) ($cargoParticular[0]-$abonoParticular[0])-($devolucionParticular[0]-$regresoParticular[0]);
   $totalBeneficencia=(float) ($cargosBeneficencia[0]-($abonosBeneficencia[0]-$dtBeneficencia[0]))-($devolucionBeneficencia[0]-$regresoBeneficencia[0]);
  $totalAseguradora=(float) ($cargoAseguradora[0]-$abonoAseguradora[0])-($devolucionAseguradora[0]-$regresoAseguradora[0]);

//echo $cargosBeneficencia[0].'-1- '.$abonosBeneficencia[0].'-2- '.$devolucionBeneficencia[0].' -3- '.$regresoBeneficencia[0];
  //REDONDEO GLOBALES****/
  $TOTAL=(float) ($totalCargo-$totalAbono);
  if($TOTAL>-1 and $TOTAL<1){
  $TOTAL='0.00';
  }
  //**************************
  
  //******TOTAL PARTICULAR
  $totalParticular= (float) $totalParticular;

  
  if($totalParticular>-1 and $totalParticular<1){
   $totalParticular='0.00';
  }
  //*********************
  
  //****************TOTAL IVA
  $ivaTotal=(float) ($ivaCargos[0]-$ivaAbonos[0]);
  //**************************
  
  
    //******TOTAL ASEGURADORA
  if($totalAseguradora>-1 and $totalAseguradora<1){
  $totalAseguradora='0.00';
  }
  //*********************
  
  
  //**********COASEGUROS DEDUCIBLES**************
  $totalCoaseguro1=(float) ($totalCargoCoaseguro1[0]-$totalAbonoCoaseguro1[0]);
  $totalCoaseguro2=(float) ($totalCargoCoaseguro2[0]-$totalAbonoCoaseguro2[0]);
  $totalDeducible1=(float) ($totalCargoDeducible1[0]-$totalAbonoDeducible1[0]);
  $totalDeducible2=(float) ($totalCargoDeducible2[0]-$totalAbonoDeducible2[0]);
  //***************************************************
  
  //*****************DESCUENTOS*********
$descuentoP=(float) ($descuentoParticularAplicado[0]-$descuentosParticulares[0]);
$descuentoA=(float) ($descuentoAseguradoraAplicado[0]-$descuentosAseguradoras[0]);  
  //***************************************



//****************BENEFICENCIAS********
$ben=(float) ($cargosBeneficencia[0]-$devolucionBeneficencia[0])-(($abonosBeneficencia[0]-$dtBeneficencia[0])-$pagoDevBeneficencia[0]);
//*************************************
?>