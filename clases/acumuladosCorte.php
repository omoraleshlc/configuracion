<?php 



//***************************************************COMIENZO DE OPERACIONES************************************


                //REGRESOS
                if($myrow1a['statusRegreso']=='si'){ 
                switch ($myrow1a['tipoPago']){
                        case "regresoParticular":
                        $regresoEfectivo[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']*$myrow1a['cantidad']);
                        break;
                    
                    
                        case "regresoAseguradora":
                        $regresoAseguradora[0]+=sprintf("%01.2f",$myrow1a['cantidadAseguradora']*$myrow1a['cantidad']);
                        break;

                }
                }















//DEVOLUCIONES********
if($myrow1a['statusDevolucion']=='si'){ 
        switch($myrow1a['tipoPago']){
    
           case "devolucionEfectivo":
           $devolucionEfectivo[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']); 
           break;
        
           case "devolucionTC":
           $devolucionTarjetaCredito[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']);
           break;

    

           case "devolucionTE":
           $devolucionTransferenciaElectronica[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']);
           break;
    
           case "devolucionAseguradora":
                if($myrow1a['abonosCxC']!='si'){
                $devolucionCxc[0]+=sprintf("%01.2f",$myrow1a['cantidadAseguradora']);   
           }
           break;

           case "devolucionOtros":
           $devolucionOtros[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']);
           break;

           case "devolucionNomina":
           $devolucionNomina[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']);
           break;
    

        
        
           case "devolucionAbonoOtros":
           $devolucionAbonoOtros[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']);
           break;

           case "Cortesia":
           $devolucionCortesia[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']);
           break;

           case "devolucionVentaDirecta":
           $devolucionVentasVarias[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']);
           break;
       
        }            
}
//********************



















//TIPOS DE PAGO INDEPENDIENTES
//echo $myrow1a['tipoPago'].'  '.$myrow1a['statusDevolucion'].' '.$myrow1a['tipoTransaccion'];
//echo '<br>';

###ACTUALIZANDO CORTESIAS SOLO ENTRA AQUI SI NO ES DEVOLUCION
if($myrow1a['statusDevolucion']!='si'){ 
switch($myrow1a['tipoPago']){
    
        case "Efectivo":
            
        $efectivo[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']*$myrow1a['cantidad']);
	if($myrow1a['tipoCliente']=='coaseguro'){
	$efectivoCoaseguro[0]+=sprintf("%01.2f",$myrow1a['cantidadAseguradora']*$myrow1a['cantidad']);
	}
        break;

        //DEVOLUCION INDEPENDIENTE
        case "devolucionBeneficencia":
        $devolucionBeneficencia[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
        break;
        
        case "Tarjeta de Credito":
        if($myrow1a['tipoCliente']=='coaseguro'){
	$tarjetaCreditoCoaseguro[0]+=sprintf("%01.2f",$myrow1a['cantidadAseguradora']*$myrow1a['cantidad']);
	}
        $tarjetaCredito[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']*$myrow1a['cantidad']);
        break;
        
        case "Cheque":
        if($myrow1a['tipoCliente']=='coaseguro'){
	$chequeCoaseguro[0]+=sprintf("%01.2f",$myrow1a['cantidadAseguradora']*$myrow1a['cantidad']);
	}
        $cheque[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']*$myrow1a['cantidad']);
        break;
        
        case "Transferencia Electronica":
        if($myrow1a['tipoCliente']=='coaseguro'){
	$transferenciaElectronicaCoaseguro[0]+=sprintf("%01.2f",$myrow1a['cantidadAseguradora']*$myrow1a['cantidad']);
	}
        $transferenciaElectronica[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']*$myrow1a['cantidad']);
        break;
        
        case "Beneficencia":
        $beneficencia[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);    
        break;    
        
        case "Nomina":
        $nomina[0]+=sprintf("%01.2f",$myrow1a['cantidadParticular']*$myrow1a['cantidad']);
        break;
    
        case "Cortesia":
        $cortesias[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
        break;
}       
}












    
    switch($myrow1a['tipoTransaccion']){
        //*****DESCUENTOS**************
        case "desc"://DESCUENTO PARTICULARES 	
        $descuentoParticular[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
        break;
    
        case "DESCAS"://DESCUENTO A ASEGURADORAS 	
        $descuentoAseguradora[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
        break;
    
    
        case "taseg"://TRASLADO A ASEGURADORA 	A
        $cxc[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
        break; 
    
        case "totros"://TRASLADO A OTROS 	A
        $otros[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
        break;
    
        case "candes"://TRASLADO A OTROS 	A
        $devolucionDescuento[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
        break;
    
        case "DEVABOASEG"://DEVOLUCION ABONOS ASEGURADORA 	C
        $devolucionAbonoAseguradoras[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
	break;
    
        case "abaseg"://DEVOLUCION ABONOS ASEGURADORA 	C
        $AbonoAseguradoras[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
	break;
    
        case "devxch"://DEVOLUCION DE CHEQUES 	C
        $devolucionCheque[0]+=sprintf("%01.2f",$myrow1a['precioVenta']*$myrow1a['cantidad']);
	break;
    
        //***********************************
    }
?>