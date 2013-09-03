<?php 



//***************************************************COMIENZO DE OPERACIONES************************************


                //REGRESOS
                if($myrow1a['statusRegreso']=='si'){ 
                switch ($myrow1a['tipoPago']){
                        case "regresoParticular":
                        $regresoEfectivo[0]+=$myrow1a['cantidadParticular']*$myrow1a['cantidad'];
                        break;
                    
                    
                        case "regresoAseguradora":
                        $regresoAseguradora[0]+=$myrow1a['cantidadAseguradora']*$myrow1a['cantidad'];
                        break;

                }
                }















//DEVOLUCIONES********
if($myrow1a['statusDevolucion']=='si'){ 
        switch($myrow1a['tipoPago']){
    
           case "devolucionEfectivo":
           $devolucionEfectivo[0]+=$myrow1a['cantidadParticular']; 
           break;
        
           case "devolucionTC":
           $devolucionTarjetaCredito[0]+=$myrow1a['cantidadParticular'];
           break;

           case "devolucionCH":
           $devolucionCheque[0]+=$myrow1a['cantidadParticular'];
           break;    

           case "devolucionTE":
           $devolucionTransferenciaElectronica[0]+=$myrow1a['cantidadParticular'];
           break;
    
           case "devolucionAseguradora":
                if($myrow1a['abonosCxC']!='si'){
                $devolucionCxc[0]+=$myrow1a['cantidadAseguradora'];   
           }
           break;

           case "devolucionOtros":
           $devolucionOtros[0]+=$myrow1a['cantidadParticular'];
           break;

           case "devolucionNomina":
           $devolucionNomina[0]+=$myrow1a['cantidadParticular'];
           break;
    
           case "devolucionAseguradora":
           if($myrow1a['abonosCxC']=='si'){
           $devolucionAbonoAseguradora[0]+=$myrow1a['cantidadParticular'];    
           }
           break;
        
        
           case "devolucionAbonoOtros":
           $devolucionAbonoOtros[0]+=$myrow1a['cantidadParticular'];
           break;

           case "devolucionCortesia":
           $devolucionCortesia[0]+=$myrow1a['cantidadParticular'];
           break;

           case "devolucionVentaDirecta":
           $devolucionVentasVarias[0]+=$myrow1a['cantidadParticular'];
           break;
       
        }            
}
//********************












//
//if($myrow1a['tipoTransaccion']=='candes'){
//$devolucionDescuento[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
//}



//*********************DESCUENTOS****************
if($myrow1a['statusDescuento']=='si' and $myrow1a['cantidadParticular']>0 and $myrow1a['naturaleza']=='A'){
$descuentoParticular[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];

}

if($myrow1a['statusDescuento']=='si' and $myrow1a['cantidadAseguradora']>0 and $myrow1a['naturaleza']=='A'){
$descuentoAseguradora[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];

}

//*************************************************









//TIPOS DE PAGO INDEPENDIENTES


switch($myrow1a['tipoPago']){
    
        case "Efectivo":
        $efectivo[0]+=$myrow1a['cantidadParticular']*$myrow1a['cantidad'];
	if($myrow1a['tipoCliente']=='coaseguro'){
	$efectivoCoaseguro[0]+=$myrow1a['cantidadAseguradora']*$myrow1a['cantidad'];
	}
        break;

        //DEVOLUCION INDEPENDIENTE
        case "devolucionBeneficencia":
        $devolucionBeneficencia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
        
        case "Tarjeta de Credito":
        if($myrow1a['tipoCliente']=='coaseguro'){
	$tarjetaCreditoCoaseguro[0]+=$myrow1a['cantidadAseguradora']*$myrow1a['cantidad'];
	}
        $tarjetaCredito[0]+=$myrow1a['cantidadParticular']*$myrow1a['cantidad'];
        break;
        
        case "Cheque":
        if($myrow1a['tipoCliente']=='coaseguro'){
	$chequeCoaseguro[0]+=$myrow1a['cantidadAseguradora']*$myrow1a['cantidad'];
	}
        $cheque[0]+=$myrow1a['cantidadParticular']*$myrow1a['cantidad'];
        break;
        
        case "Transferencia Electronica":
        if($myrow1a['tipoCliente']=='coaseguro'){
	$transferenciaElectronicaCoaseguro[0]+=$myrow1a['cantidadAseguradora']*$myrow1a['cantidad'];
	}
        $transferenciaElectronica[0]+=$myrow1a['cantidadParticular']*$myrow1a['cantidad'];
        break;
        
        case "Beneficencia":
        $beneficencia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];    
        break;    
        
        case "Nomina":
        $nomina[0]+=$myrow1a['cantidadParticular']*$myrow1a['cantidad'];
        break;
    
        case "Cortesia":
        $cortesias[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
        
}









                    if($myrow1a['tipoPago']=='Cuentas por Cobrar' ||  ($myrow1a['tipoPago']=='Otros' and $myrow1a['clientePrincipal']!=NULL )){

                    //son otros pero tienen un traslado a aseguradoras
                    //if($myrow1a['tipoPago']=='Otros' and $myrow1a['clientePrincipal']!=NULL ){ 
                    $cxc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
                    //}else{
                    //$cxc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
                    //}


                    } 
                    else if($myrow1a['tipoPago']=='Otros' and $myrow1a['clientePrincipal']==NULL ){
                    $otros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];//estaba en aseguradora
                
                
}

//*********************************************************CERRE DE OPERACIONES****************************************************
?>