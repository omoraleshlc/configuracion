<?php 

//*********************************************************CERRE DE OPERACIONES****************************************************

//DEBEN ESTAR TODAS LAS TRANSACCIONES, LA NATURALEZA NO DEBE SER -
//LA TABLA ES CATTCAJA
if($myrow1a['naturaleza']=='A' or $myrow1a['naturaleza']=='C'){
switch($myrow1a['tipoTransaccion']){
    
    
    
    //HABER
    //PAGOS EN EFECTIVO
    case "Pxge"://PAGO EN EFECTIVO, TARJETA DE CREDITO, CHEQUE   A-efectivo
        $cash[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        
        break;
    
    case "pgxp"://PAGO DE GASTOS PARTICULARES 	A
       $gastosparticulares[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
   
     case "pcoa1"://PAGO DE COASEGURO 1 	A
       $coa1[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "pcoa2"://PAGO DE COASEGURO 2 	A
       $coa2[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "pdedu1"://PAGO DE DEDUCIBLE 1 	A
       $deducible1[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "pdedu2"://PAGO DE DEDUCIBLE 2 	A
        $deducible2[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "pefectivo"://PAGO EN EFECTIVO 	A
        $pagocash[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
    
        case "pcheq"://PAGO CON CHEQUE 	A
        $pagocheque[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
        case "PTELECTRO"://PAGO TRANSACCION ELECTRONICA 	A
        $pagotransfer[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
        case  "ptarjeta"://PAGO CON TARJETA DE CREDITO 	A
        $pagotc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    

    
    //*****************CIErRA BANCOS*******************
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //HABER
    case "pxab"://ABONOS A CUENTA 	A
       $abonos[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;    
    
        case "abaseg"://ABONOS DE ASEGURADORAS 	A
        $abonoaseguradora[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;

	case "abotros"://ABONOS OTROS 	A
       $abonosotros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;  
    
    
    
    
    
    
    
    
    
    
    
    
//DEBE    
//TRASLADOS    
    case "taseg"://TRASLADO A ASEGURADORA 	A
        $trasladocxc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;   
       
    case "tnom"://	TRASLADO A NOMINA 	A
        $nomina[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    
     case "totros"://TRASLADO A OTROS 	A
        $trasladootros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
        case "APLCORT"://CORTESIA 	A
        $trasladocortesia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    

    //CIERRO TRASLADOS
    
    
    
    
    
    
    
    
    
    //VENTAS DIRECTAS
    case "vdirC"://ABONO POR UNA VENTA DIRECTA 	A
        $vdirectaa[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "vdira"://VENTA DIRECTA 	A
        $vdirectac[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
    //*********************
    
    
    
    
    
    
    
    
    //HABER
    //REGRESOS*******
    case "devAseg"://REGRESO ASEGURADORA 	C
        $regresoaseguradora[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
    
    
    case "devEfe"://REGRESO DE EFECTIVO 	C
       $regefectivo[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad']; 
	break;
    //***CIERRO REGRESOS
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 	//HABER
	//*********DEVOLUCIONES**************
	case "devxef"://DEVOLUCION EFECTIVO 	C
        $devcash[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;

	case "devxaseg"://DEV.  TRASLADO ASEGURADORA 	C
        $devtrasladoaseg[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
        //************************************
    	
  
  
    
    
    
    
    
    
    
    
        //DEBE
        //*****DESCUENTOS**************
        case "desc"://DESCUENTO PARTICULARES 	A
        $descuentoparticulares[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
        case "DESCAS"://DESCUENTO A ASEGURADORAS 	A
        $descuentoaseguradoras[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
        //***********************************
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    //HABER
    //DEVOLUCION EFECTIVO
    //*************DEVOLUCIONES******************
    case "devxtc"://DEVOLUCION TARJETA DE CREDITO 	C
       $devoluciontc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "devxch"://DEVOLUCION CHEQUES 	C
       $devcheques[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "devxtel"://DEVOLUCION TRANSFERENCIA ELECTRONICA 	C
       $devte[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "devxnom"://DEVOLUCION NOMINA 	C
        $devnomina[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    
    case "DEVXB"://	DEVOLUCION BENEFICENCIA 	C
        $devbeneficencia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        break;
    

    
    case "devotr"://DEVOLUCION DE TRASLADO A OTROS 	C
        $devotros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
    
       case "devtotros"://DEVOLUCION DE TRASLADO A OTROS 	C
        $devtotros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
    
    case "DEVxVD"://DEVOLUCION POR UNA VENTA DIRECTA 	C
        $devventadirecta[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;

 	case "devxco"://DEVOLUCION DE UNA CORTESIA 	C
        $devcortesia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;

	case "DEVABOASEG"://DEVOLUCION ABONOS ASEGURADORA 	C
        $devolucionAbonoAseguradorasT[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
    //****************************************************
    
    
    
    
    
    //*********CANCELACIONES
    
    //HABER
    //DEVOLUCION DE ABONO DE ASEGURADORA
    case "candes"://CANCELACION DESCUENTO 	C
         $devolucionDescuento[0]+=(float) $myrow1a['precioVenta']*$myrow1a['cantidad'];
	break;
    
    
    
        case "txbene"://BENEFICENCIA INTERNOS	A
            if($myrow1a['tipoPaciente']=='interno' or $myrow1a['tipoPaciente']=='urgencias'){
            $beneficenciaInternos[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];   
            
            }else{
            $beneficenciaExternos[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
           
            
            }
        break;
    
    
}




//BOOT
$e=NULL;
$cxc[0]=NULL;
$otros[0]=NULL;
$descuentos=NULL;
$cortesias[0]=NULL;
$beneficencia[0]=NULL;


//DEVOLUCIONES
$devolucionAbonoAseguradoras[0]=NULL;
$devolucionBeneficencia[0]=NULL;

$devolucionCortesia[0]=NULL;
$devolucionNomina[0]=NULL;
$devoluciones=NULL;
$devCxC=NULL;




//REGRESO
$regresoefectivo[0]=NULL;

//REGRESO ASEGURADORA
$regresoAseguradora[0]=NULL;

//TRASLADO ASEGURADORA
$taas=NULL;

//TRASLADO OTROS
$tOtros=NULL;
//DEVOLUCION
$devO=NULL;


//ABONOS INTERNOS
$aInternos=NULL;









//EFECTIVO
$e=
        $cash[0]+$gastosparticulares[0]+
        $coa1[0]+$coa2[0]+$deducible1[0]+$deducible2[0]+
        $pagocash[0]+$pagocheque[0]+$pagotransfer[0]+
        $pagotc[0]+$abonos[0]+$abonoaseguradora[0]+
        $abonosotros[0]+$vdirectaa[0]
;
           


//TRASLADOS
$cxc[0]=$trasladocxc[0];
$otros[0]=$trasladootros[0];
$nomina[0]=$nomina[0];


//DESCUENTOS
$descuentos=$descuentoparticulares[0]+$descuentoaseguradoras[0];
        
//CORTESIAS
$cortesias[0]=$trasladocortesia[0];


//BENEFICENCIAS
$beneficencia[0]+=$beneficenciaInternos[0]+$beneficenciaExternos[0];



//**************DEVOLUCIONES***************
//BENEFICENCIA
$devolucionBeneficencia[0]=$devbeneficencia[0];






//EFECTIVO
$devoluciones=
$devcash[0]+
$devoluciontc[0]+
$devcheques[0]+
$devte[0]+
$devventadirecta[0]+
$devolucionAbonoAseguradorasT[0]
;





//TRASLADO ASEGURADORA
$devCxC=$devtrasladoaseg[0];


//CORTESIA
$devolucionCortesia[0]=$devcortesia[0];

//NOMINA
$devolucionNomina[0]=$devnomina[0];

//ABONO ASEGURADORAS
$devolucionAbonoAseguradoras[0]=$devolucionAbonoAseguradorasT[0];




//REGRESO EFECTIVO
$regresoefectivo[0]=$regefectivo[0];

//REGRESO ASEGURADORA
$regresoAseguradora[0]=$regresoaseguradora[0];


//PAGOS DE ASEGURADORAS
$taas=$abonoaseguradora[0];


//PAGO Y DEVOLUCION OTRoS
//PAGO
$tOtros=$abonosotros[0];



//ABONOS INTERNOS
$aInternos=$abonos[0];
}
?>