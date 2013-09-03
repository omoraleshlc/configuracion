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
    
           case "devolucionNomina":
           $devolucionNomina[0]+=$myrow1a['cantidadParticular'];
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
    
        case "Cuentas por Cobrar":
        $cxc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
        case "Otros":
        $otros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
        
}





switch ($myrow1a['tipoTransaccion']){
           case  "devotr" :
           $devolucionAbonoOtros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
           break;               
               
           case "DEVABOASEG":       
           $devolucionAbonoAseguradora[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
           break;
            
           case "devxaseg":           
           $devolucionCxc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];           
           break;
       
           case "candes":           
           $devolucionDescuento[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];           
           break;
       
           case "desc":           
           $descuentoParticular[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];           
           break;
       
           case "DESCAS":           
           $descuentoAseguradora[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];           
           break;
           
		   case "abaseg":           
           $abonoAseguradoras[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];           
           break;
            
}





//*********************************************************CERRE DE OPERACIONES****************************************************
?>
