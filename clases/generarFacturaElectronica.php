<?php  
$idSucursal='106136';








$digitosTarjeta='';


//$tipoPago='Efectivo';








/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
$myFile = "/tmp/factura.fxt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "Bobby Bopper\n";
fwrite($fh, $stringData);
$stringData = "Tracy Tanner\n";
fwrite($fh, $stringData);
fclose($fh);
 */





$sSQL455= "Select * from datosfacturacion where entidad='".$entidad."' and numSolicitud='".$_GET['numSolicitud']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);


$sSQL455e= "Select seguro from facturasAplicadas where entidad='".$entidad."' 
    and 
    numSolicitud='".$_GET['numSolicitud']."'
group by seguro    
";
$result455e=mysql_db_query($basedatos,$sSQL455e);
$myrow455e = mysql_fetch_array($result455e);


$sSQL455ef= "Select * from tipoPagoClientes where entidad='".$entidad."' 
    and 
    clientePrincipal='".$myrow455e['seguro']."'
 
";
$result455ef=mysql_db_query($basedatos,$sSQL455ef);
$myrow455ef = mysql_fetch_array($result455ef);




if($tipoFacturacion=='Auto'){
 $sSQLtf="


SELECT
*
FROM
cargosCuentaPaciente
WHERE

entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
(tipoPago='Transferencia' or tipoPago='Cheque' or tipoPago='Tarjeta de Credito')
group by tipoPago
 ";
 
  	$resulttf=mysql_db_query($basedatos,$sSQLtf);
  While(	$myrowtf = mysql_fetch_array($resulttf)){
      $ar+=1;
      $tpa=$myrowtf['tipoPago'];
  }
  
  if($ar>1){
      if($tpa=='Transferencia'){
       $tipoPago=$tpa;
       $digitosCuenta=$myrowtf['numeroTransferencia'];
      }
      
      if($tpa=='Cheque'){
       $tipoPago=$tpa;
       $digitosCuenta=$myrowtf['numeroCheque'];
      }
       
      if($tpa=='Tarjeta de Credito'){
       $tipoPago=$tpa;
       $digitosCuenta=$myrowtf['ultimosDigitos'];
      }
  }else{
      $tipoPago='No Identificado';
    $digitosCuenta=NULL;    
  }
        
        
}else{
if($myrow455ef['tipoPago']!=''){
    $tipoPago=$myrow455ef['tipoPago'];
    $digitosCuenta=$myrow455ef['cuenta'];
}else{
    $tipoPago='No Identificado';
    $digitosCuenta=NULL;
}}


$sSQL455ho= "Select * From 
 datosFiscalesEntidades 
 where
 entidad='".$entidad."' 
 ";
$result455ho=mysql_db_query($basedatos,$sSQL455ho);
$myrow455ho = mysql_fetch_array($result455ho);


if(!$myrow455ho['RFC']){
    echo '<script>';
    echo 'window.alert("ERROR EN DATOS FISCALES!");';
    echo 'window.close();';
    echo '</script>';    
}



























$cadena1=
'rfcEmisor|idSucursal|fechaYhora|importe|noTicket|propina|concepto|RFCRecpetor|idTransaccion|cc';

//ACTUALIZACION
  $sSQL7="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  naturaleza='C'
  and
  tipoTransaccion=''
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numSolicitud='".$_GET['numSolicitud']."'
and

  naturaleza='A'
  and
  tipoTransaccion=''
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
  $totalVenta=  ($myrow7['acumulado']+$myrow7['ivaa'])-($myrow7d['acumulado']+$myrow7d['ivaa']);
  
  
  
  
  //ACTUALIZACION
  $sSQL7iva="SELECT 
 sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  naturaleza='C'
  and
  iva>0
  and
  tipoTransaccion=''
  ";
 
  $result7iva=mysql_db_query($basedatos,$sSQL7iva);
  $myrow7iva = mysql_fetch_array($result7iva);




 $sSQL7diva="SELECT 
 sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numSolicitud='".$_GET['numSolicitud']."'
and

  naturaleza='A'
  and
  iva>0
  and
  tipoTransaccion=''
  ";
 
  $result7diva=mysql_db_query($basedatos,$sSQL7diva);
  $myrow7diva = mysql_fetch_array($result7diva);
  $tIVA=$myrow7iva['ivaa']-$myrow7diva['ivaa'];
  
  
  
  
  
  
  
  
  



$sSQL38a= "
SELECT codTASA FROM TASA WHERE codTASA>0";
$result38a=mysql_db_query($basedatos,$sSQL38a);
$myrow38a = mysql_fetch_array($result38a);

 $gravado=$myrow38a['codTASA'];


  
  
  
  
  
  
  
  
  
  
  
  
  
  

  
//*******************************DESCUENTOS**************************
$sSQL7fac="SELECT folioVenta,seguro
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
    numSolicitud='".$_GET['numSolicitud']."'
        and
  tipoTransaccion=''
group by folioVenta
";
 
  $result7fac=mysql_db_query($basedatos,$sSQL7fac);
  while($myrow7fac = mysql_fetch_array($result7fac)){
 


if($myrow7fac['folioVenta']!=''){	

    
    
    
    
    
    
    
    
    
    
    
//DESCUENTOS A ASEGURADORAS O A PARTICULARES    
$sSQL7f1="


SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as descuentoAseguradora,
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as descuentoParticular
FROM
cargosCuentaPaciente
WHERE

entidad='".$entidad."'
and
folioVenta='".$myrow7fac['folioVenta']."'
and
gpoProducto=''
and
statusDescuento='si'
and
naturaleza='A'
 ";
 
  	$result7f1=mysql_db_query($basedatos,$sSQL7f1);
  	$myrow7f1 = mysql_fetch_array($result7f1);
   
        
$sSQL7f1d="


SELECT
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as devAseguradora,
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as devParticular
FROM
cargosCuentaPaciente
WHERE

entidad='".$entidad."'
and
folioVenta='".$myrow7fac['folioVenta']."'
and
gpoProducto=''
and
statusDescuento='si'
and
naturaleza='C'
 ";
 
  	$result7f1d=mysql_db_query($basedatos,$sSQL7f1d);
  	$myrow7f1d = mysql_fetch_array($result7f1d);  
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
//DESCUENTO - DEVOLUCION DE DESCUENTO  
if($vFac=='divideAseguradoras'){        
$descuento[0]+=($myrow7f1['descuentoAseguradora']-$myrow7f1d['devAseguradora']);        
 $totalDescuento=($myrow7f1['descuentoAseguradora']-$myrow7f1d['devAseguradora']); 
}else{
 $descuento[0]+=($myrow7f1['descuentoParticular']-$myrow7f1d['devParticular']);        
$totalDescuento=($myrow7f1['descuentoParticular']-$myrow7f1d['devParticular']);    
}




$porcentajeDescuento=($descuento[0]/$totalVenta);          
        
        if($tIVA>0){
 //$descuento[0]= ($descuento[0]-($descuento[0]*($gravado*0.01)));
$IVADes[0]+= ($descuento[0]*($gravado*0.01));
}else{
   $IVADes[0]='0.00';
}
	//$descuento[0]+$ivades

  }
	
	
	
	


}//cierra el while que busca


$ivades=$IVADes[0];

//*******************************************************************































//******************************************************************************



//VERIFICAR SI EXISTEN COSAEGUROS/DEDUCIBLES
//$pdf->Ln(4); //salto de linea
$sSQL7fab="SELECT folioVenta,seguro
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
    numSolicitud='".$_GET['numSolicitud']."'
        
group by folioVenta
";
 
  $result7fab=mysql_db_query($basedatos,$sSQL7fab);
  while($myrow7fab = mysql_fetch_array($result7fab)){
$r+=1;
//*******************************COASEGUROS**************************
$sSQL7f="SELECT folioVenta
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$myrow7fab['folioVenta']."'
and
 (tipoTransaccion='pcoa1' or tipoTransaccion='pcoa2' or tipoTransaccion='pdedu1' or tipoTransaccion='pdedu2')
and
naturaleza='A'
group by folioVenta
";
 
  $result7f=mysql_db_query($basedatos,$sSQL7f);
  $myrow7f = mysql_fetch_array($result7f);
  $foliosVenta[$r]=$myrow7f['folioVenta'];
  if($myrow7fab['seguro']!=''){
  $seg[0]+=1;
  }
  }


//print_r($foliosVenta[$r]);

if($seg[0]>0 && $foliosVenta[$r]!=''){
		
foreach ($foliosVenta as &$folios) {	
$sSQL7f1="


SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as coaseguro
FROM
cargosCuentaPaciente
WHERE

entidad='".$entidad."'
and
folioVenta='".$folios."'
and
 (tipoTransaccion='pcoa1' or tipoTransaccion='pcoa2' or tipoTransaccion='pdedu1' or tipoTransaccion='pdedu2')
 and
 numRecibo>0
  ";
 
  $result7f1=mysql_db_query($basedatos,$sSQL7f1);
  $myrow7f1 = mysql_fetch_array($result7f1);
  $sumaCoaseguro[0]+=$myrow7f1['coaseguro'];
$coaseguro[0]+=$myrow7f1['coaseguro'];
}



//AQUI AFECTA
//$totalF=$tasaCero[0]+$tasaIVA[0]+$tasaExento[0]+$sumaIVAS[0];



$totalCoaseguro= $totalF1*($gravado*0.01);
//***********************************************


//$pdf->Ln(10); //salto de linea

}








//echo $coaseguro[0].' -> '.$subTotales[0].' -> '.$iva[0];
//Si el cliente pide mostrar coaseguro
//$coaseguro[0]=NULL;
//echo $coaseguro[0].''.$subTotales[0].'*'.$iva[0];



if($coaseguro[0]>0){
$pCOA= $coaseguro[0]/$totalVenta;
}


if($descuento[0]>0){
$pDES= $descuento[0]/$totalVenta;
}



if($coaseguro[0]>0){
//$pdf->SetX(22);
//$pdf->Cell(0,0,'('.'Coaseguro'.')',0,0,L);print
//$pdf->SetX('185');
//$pdf->Cell(0,0, '-$'.number_format($myrow7f1['coaseguro']-$ivaCOA,2),0,0,R);print
//$pdf->Ln(3); //salto de linea

if($coaseguro[0]>0 and $tasaIVA[0]>0){
//$pdf->Ln(3); //salto de linea
//$pdf->SetX(22);

//$pdf->Cell(0,0,"(IVA Coaseguro"."  $".number_format($ivaCOA,2).' )',0,0,M);print
}
//$pdf->Ln(4); //salto de linea
}
//*******************************************************************

 $operaciones=($descuento[0])+($coaseguro[0]);
//******************************************************************************







//********************************************************************
$importe=  ($myrow7['acumulado']+$myrow7['ivaa'])-($myrow7d['acumulado']+$myrow7d['ivaa']);
 $cadena1=
'TR|rfcEmisor|idSucursal|fechaYHora|importe|noTicket|propina|concepto|RFCRecpetor|idTransaccion|cc|metodoPago| 
digitosTarjeta|idMoneda|tipoCambio|tipoCFDI|observaciones|idComplementos
CN|Cantidad|Unidad|Concepto|PrecioUnitario|Descuento|Importe|ImporteImpuesto
TI|Tipo|Importe|impuesto|Tasa';
 
$r= eregi_replace('-', '', $myrow455['rfc']);


//$importe=  noRound($importe,2);

$propina=0;
$propina=sprintf("%01.2f", $propina); 
$operaciones=sprintf("%01.2f", $operaciones); 
$subTotalDescuentos=sprintf("%01.2f", $operaciones); 


if($operaciones>0){  
$importe=$importe-$operaciones;
}


$importe=sprintf("%01.2f", $importe); 

$cadena1=
'TR'.'|'.utf8_encode(trim($myrow455ho['RFC'])).'|'.$idSucursal.'|'.$fecha1.'T'.date("H:m:s").'|'.$importe.'|'.utf8_encode($ticket).'|'.$propina.'|'.
utf8_encode('Ventas').'||'.utf8_encode($ticket).'||'.utf8_encode($tipoPago).'|'.$digitosCuenta.'||||'.utf8_encode($numFactura).' '.$_POST['observaciones'];

$importe=NULL;





//PARTIDAS

$sSQL= "
SELECT * FROM facturasAplicadas
WHERE 
entidad='".$entidad."'
and
numSolicitud='".$_GET['numSolicitud']."'
and
  tipoTransaccion=''
group by gpoProducto";


$result=mysql_db_query($basedatos,$sSQL);
while ($myrow = mysql_fetch_array($result)){
    $totalR+=1;
    $C=$myrow['gpoProducto'];
    $sSQL38= "
SELECT 
tasaGP,descripcionGP,separadoAlmacen,impresionFactura,descripcionImpresion
FROM
gpoProductos
WHERE 
codigoGP='".$C."'";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);
$concepto=$myrow38['descripcionGP'];

//*************************OPERACIONES*****************************

  $sSQL7="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa,sum(importe*cantidad) as importe
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  gpoProducto='".$C."'   
  and
  naturaleza='C'
  and
  tipoTransaccion=''
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa,sum(importe*cantidad) as importe
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numSolicitud='".$_GET['numSolicitud']."'
and
  gpoProducto='".$C."'   
    and
  naturaleza='A'
  and
  tipoTransaccion=''
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
//********************************************************************
$importe=  ($myrow7['acumulado'])-($myrow7d['acumulado']);



if($myrow7['ivaa']>0){
   $i= $myrow7['ivaa']-$myrow7d['ivaa'];

}else{
    $i='0.00';
}



if($pCOA>0){
    
if($myrow7['ivaa']>0){
$sumaIVACOA[0]+=$importe*$pCOA;   
}else{
  $sumaIVACOASI[0]+=$importe*$pCOA;  
}
}



if($descuento[0]){
$sumaDescuento[0]+=($importe*$pDES);
$descuent=NULL;
$des=($importe*$pDES);

if($myrow7['ivaa']>0){
$sumaIVADescuento[0]+= ($des*($gravado*0.01));
}
}


$precioUnitario=$myrow7['acumulado']-$myrow7d['acumulado'];
$importe=$myrow7['importe']-$myrow7d['importe'];
$c= $myrow7['c']-$myrow7d['c'];
$iva[0]+=($myrow7['ivaa']-$myrow7d['ivaa']);







/*
$cadena2[]=
$myrow455e['RFC'].'|'.$_GET['entidad'].'|'.date("d/M/Y H:m:s").'|'.$importe.'|'.$myrow['folioVenta'].'|'.'0'.'|'.$concepto.'|'.$myrow455['rfc'].'|'.$_GET['numFactura'].'|'.$_GET['email'];
*/






//-----------------------EJEMPLOS-----------------------------
/*
TR|rfcEmisor|idSucursal|fechaYHora|importe|noTicket|propina|concepto|RFCRecpetor|idTransaccion|cc|metodoPago| 
digitosTarjeta|idMoneda|tipoCambio|tipoCFDI|observaciones|idComplementos
CN|Cantidad|Unidad|Concepto|PrecioUnitario|Descuento|Importe| ImporteImpuesto
TI|Tipo|Importe|impuesto|Tasa


Método de Pago Efectivo – Tipo Moneda Pesos Mexicanos - CFDI
TR|COAS08031980AM|1489|207/09/2011 14:25:00|500.00|00012875|10.00|Consumo|TOMM08051980AM2|00012875|cliente@hotmail.com|Efectivo|
|1|1|1|CFDI de Prueba||
CN|1|Pieza|Descripción Producto|1.00|0|5.0|0.16
CN|2|KG|Descripción Producto|3.00|0|1.0|0.48
CN|2|Metros|Descripción Producto|8.00|0|6.0|1.28
TI|T|IVA|0.16|16
        
        
Método de Pago Electrónico - Tipo Moneda Dólar - CFDI
TR|COAS08031980AM|1489|207/09/2011 14:25:00|500.00|00012875|10.00|Consumo|TOMM08051980AM2|00012875|cliente@hotmail.com|Tarjeta 
Credito|01235986452|2|14.50|1|CFDI de Prueba||
CN|1|Pieza|Descripción Producto|1.00|0|5.0|0.16
CN|2|KG|Descripción Producto|3.00|0|1.0|0.48
CN|2|Metros|Descripción Producto|8.00|0|6.0|1.28
TI|T|IVA|0.16|16
  
 
Método de Pago Efectivo – Tipo Moneda Pesos Mexicanos – CFDI – Complemento Donatarias
TR|COAS08031980AM|1489|207/09/2011 14:25:00|500.00|00012875|10.00|Consumo|TOMM08051980AM2|00012875|cliente@hotmail.com|Efectivo|
|1|1|1|CFDI de Prueba|1
CN|1|Pieza|Descripción Producto|1.00|0|5.0|0.16
CN|2|KG|Descripción Producto|3.00|0|1.0|0.48
CN|2|Metros|Descripción Producto|8.00|0|6.0|1.28
TI|T|IVA|0.16|16
 * 
 * 
 * 
 * 
*/
//--------------------------------------------------------------










//VERIFICAR SI HAY DESCUENTO








/*
//$precioUnitario=noRound($precioUnitario,2);
$precioUnitario=(float) $precioUnitario;

$i=noRound($i,2);
$i=(float) $i;
*/

//LINEA DEFAULT **NO SE MUEVE !
$precioUnitario=sprintf("%01.2f", $precioUnitario); 
$i=sprintf("%01.2f", $i); 

$pi=($precioUnitario+$i);
$pi=sprintf("%01.2f", $pi); 

/*
$cadena2[]=
utf8_encode('CN').'|'.'1'.'|'.'NO APLICA'.'|'.utf8_encode($concepto).'|'. $precioUnitario.'|' . $descuent.'|'.$pi.'|'.$i;
 *  */


//modificacion segun sima
$cadena2[]=
utf8_encode('CN').'|'.'1'.'|'.'NO APLICA'.'|'.utf8_encode($concepto).'|'. $precioUnitario.'|' . $descuent.'|'.$precioUnitario.'|'.$i;


$mT[0]+=sprintf("%01.2f", $importe);

}//TERMINA WHILE












//SUMA DE LAS 2 ULTIMAS PARTIDAS
/*
echo $sumaIVACOA[0];con iva
echo '<br>';
echo $sumaIVACOASI[0]; sin iva
*/





//EN LA LINEA 2a IMPRIMO SI TRAE DEDUCIBLE O  COASEGURO 
if($coaseguro[0]>0){   
$descripcionCoaseguro='Coaseguro/Deducible';    
$iC=-$ivaCOA;

$iC= ($sumaIVACOA[0]*($gravado*0.01));
$piC=sprintf("%01.2f", $piC);
$iC=sprintf("%01.2f", $iC);
$sumaIVACOA[0]=sprintf("%01.2f", $sumaIVACOA[0]);
$descuentoC=0;
$descuentoC=sprintf("%01.2f", $descuentoC);
$sumCI=($sumaIVACOA[0]+$iC);
//$sumCI=sprintf("%01.2f", $sumCI);
$cadena2a=
//utf8_encode('CN').'|'.'1'.'|'.'No Aplica'.'|Coaseguro/Deducible con IVA|-'.$sumaIVACOA[0].'|0.00|-'.$sumCI.'|-'.$iC;//CON IVA
//$sumaIVACOASI[0]=sprintf("%01.2f", $sumaIVACOASI[0]);

/*
$cadena2a1=
utf8_encode('CN').'|'.'1'.'|'.'No Aplica'.'|Coaseguro/Deducible|-'.($sumaIVACOA[0]+$sumaIVACOASI[0]).'|0.00|-'.($sumaIVACOA[0]+$sumaIVACOASI[0]).'|0.00';//SIN IVA
*/

$cadena2a1=
utf8_encode('CN').'|'.'1'.'|'.'No Aplica'.'|Coaseguro/Deducible|-'.($coaseguro[0]-$iC).'|0.00|-'.($coaseguro[0]-$iC).'|0.00';//SIN IVA


}


//EN LA LINEA 2b SI TRAE DESCUENTO
if($descuento[0]>0){

    
$descuentoD=sprintf("%01.2f", $descuentoD);
$ivades=$sumaIVADescuento[0];
$iD=sprintf("%01.2f", $iD);
$piD=($myrow7f1['coaseguro']+$ivaCOA);
$piD=sprintf("%01.2f", $piD);
$descD=0;
$descD=sprintf("%01.2f", $descD);
$descripcionDescuento='Descuentos';
$sumaDescuento[0]=sprintf("%01.2f", $sumaDescuento[0]);
$cadena2b=
utf8_encode('CN').'|'.'1'.'|'.'No Aplica'.'|'.utf8_encode($descripcionDescuento).'|-'.$sumaDescuento[0].'|' . $descD.'|-'.$sumaDescuento[0].'|0.00';
}


























$sSQL38= "
SELECT 
*
FROM
TASA
WHERE
valorTasa>0
";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);




if($iva[0]>0){
    $valorTasa= $myrow38['valorTasa']/100;
    $codTasa= $myrow38['valorTasa']; 
    $ir= $iva[0];
} else{ 
    $valorTasa=0;//estos no  son decimal
    $codTasa=0;//estos no  son decimal
    $ir=0;
}


if($iC>0 or $ivades>0){
 $ir.' -> '.$ivades;
    $ir=$ir-($iC+$ivades);
}

$valorTasa=sprintf("%01.2f", $valorTasa);
//$codTasa=sprintf("%01.2f", $codTasa);
$ir=sprintf("%01.2f", $ir);




//   TI|0|IVA
//$cadena3=utf8_encode('TI').'|'.utf8_encode('0').'|'.noRound($ir,2)."\n";//ANULAR SALTO DE LINEA
$cadena3=utf8_encode('TI').'|T|'.$ir.'|IVA|'.$codTasa;
//TI|T|0.16|iva|16


/* ANULADO SEGUN LO ULTIMO DE FACTURAXION 23/OCT/2012
if($totalR>1){
//   IT|20.88|IVA|16
$cadena4=utf8_encode('IT').'|'.noRound($ir,2).'|'.utf8_encode('IVA').'|'.$codTasa;
}*/
?>





<?php
//GENERAMOS EL ARCHIVO
$myFile = '/temp/entrada/t'.$numFactura.'-'.$ticket.'.fxt';
    $archivo='t'.$numFactura.'-'.$ticket.'.fxt';
$q4 = "

    INSERT INTO rutaTickets(ruta, usuario,entidad,status,ticket,hora,fecha)
    values('".$archivo."', '".$usuario."','".$entidad."','standby','".$ticket."',
'".$hora1."','".$fecha1."')


    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
//shell_exec($myFile);
//$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $cadena1;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
//fwrite($fh, $stringData);
$q4 = "

    INSERT INTO rutaDetails(ruta, usuario,entidad,status,ticket)
    values('".$stringData."', '".$usuario."','".$entidad."','standby','".$ticket."')


    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
//fputs($fh,"\n");//ANULAR SALTO DE LINEA
    
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf));     
for($i=0;$i<$totalR;$i++){
$stringData = $cadena2[$i];
//fwrite($fh, $stringData);
$q4 = "

    INSERT INTO rutaDetails(ruta, usuario,entidad,status,ticket)
    values('".$stringData."', '".$usuario."','".$entidad."','standby','".$ticket."')


    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
//fputs($fh,"\n");//ANULAR SALTO DE LINEA
}


//SOLO SI TRAE COASEGURO
if($coaseguro[0]>0){ 


$stringData = $cadena2a1;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
//fputs($fh,"\n");//ANULAR SALTO DE LINEA
//fwrite($fh, $stringData);
$q4 = "

    INSERT INTO rutaDetails(ruta, usuario,entidad,status,ticket)
    values('".$stringData."', '".$usuario."','".$entidad."','standby','".$ticket."')


    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
//fputs($fh,"\n");//ANULAR SALTO DE LINEA
}

//SOLO SI TRAE DESCUENTO
if($descuento[0]>0){
$stringData = $cadena2b;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
//fwrite($fh, $stringData);
$q4 = "

    INSERT INTO rutaDetails(ruta, usuario,entidad,status,ticket)
    values('".$stringData."', '".$usuario."','".$entidad."','standby','".$ticket."')


    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
//fputs($fh,"\n");//ANULAR SALTO DE LINEA
}



$stringData = $cadena3;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
//fwrite($fh, $stringData);
$q4 = "

    INSERT INTO rutaDetails(ruta, usuario,entidad,status,ticket)
    values('".$stringData."', '".$usuario."','".$entidad."','standby','".$ticket."')


    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();


if($totalR>1){
//$stringData = $cadena4;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
//fwrite($fh, $stringData);
}


//fclose($fh);
?>


<?php

if($tipoFacturacion!='Auto'){
if($totalR>0){
 echo '<script>';
 echo 'window.alert("ARCHIVO GENERADO CORRECTAMENTE! TICKET: '.$ticket.', RFC: '.$r.', IMPORTE: '.(($mT[0]+$iva[0])-$subTotalDescuentos).' ");';
echo 'window.close();';
 echo '</script>';
}else{
 echo '<script>';
  echo 'window.alert("HAY UN PROBLEMA!");';
   echo 'window.close();';
    echo '</script>';

}
}


?>
