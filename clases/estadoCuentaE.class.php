<?php 
class eCuentasE{
public function eCuentaE($descripcionTransaccion,$mostrar,$usuario,$entidad,$almacen,$fecha1,$hora1,$dia,$usu,$nT,$basedatos){


$estilo=new muestraEstilosV2();
$estilo->styles();


$cargosCia=new acumulados();

$sSQLCent= "Select * From entidades where codigoEntidad='".$entidad."'";
$resultCent=mysql_db_query($basedatos,$sSQLCent);
$myrowCent = mysql_fetch_array($resultCent);
if($myrowCent['rutaRecibo']!=NULL and $myrowCent['rutaReciboPaquete']!=NULL){
//**********************************CANDADO PRINCIPAL**********************
$bali=$almacen;

$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('ABRiO EL ESTADO DE CUENTA DE CAJA','".$bali."','".$ALMACEN."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$_GET['folioVenta']."',
'','')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();



$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$sSQL1= "Select usuario,folioVenta,keyT From transacciones WHERE entidad='".$entidad."' and folioVenta ='".$_GET['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();



$sSQL1d= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta ='".$_GET['folioVenta']."' ";
$result1d=mysql_db_query($basedatos,$sSQL1d);
$myrow1d = mysql_fetch_array($result1d);
echo mysql_error();


/*
$sSQL1tv= "Select * From transacciones WHERE entidad='".$entidad."' and usuario ='".$usuario."' and status='standby' ";
$result1tv=mysql_db_query($basedatos,$sSQL1tv);
$myrow1tv = mysql_fetch_array($result1tv);
echo mysql_error();
if(($myrow1tv['folioVenta']!=NULL and $myrow1tv['folioVenta']!=$_GET['folioVenta']) and $myrow1d['tipoPaciente']=='externo'){//candado?>
    <script>
window.alert("ERROR: PARA PODER CONTINUAR DEBES FINALIZAR LA TRANSACCION DEL FOLIO: <?php echo $myrow1tv['folioVenta'];?> y esta en la fecha <?php echo cambia_a_normal($myrow1tv['fecha']);?>");
window.close();
</script>

<?php
}
*/



if($myrow1d['tipoPaciente']=='externo' and $_POST['imprimir']!=NULL){


//***************C A S O 2 ******************
if($myrow1['folioVenta'] AND $myrow1['usuario']!=$usuario){ ?>
<script>
window.alert("Este proceso esta siendo utilizado por: (<?php echo $myrow1['usuario'];?>) y solo el puede terminar este proceso");
window.close();
</script>
<?php
}



//*******TRASPASO AL MODULO DE FACTURACION AUTOMATICO*******


        $sSQLef= "SELECT
             *
             FROM
             cargosCuentaPaciente
             WHERE 
             entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
             and
             gpoProducto!=''
             and 
             cantidadParticular>0
             ";



 
$resultef=mysql_db_query($basedatos,$sSQLef);
$myrowef = mysql_fetch_array($resultef);

if($myrowef['cantidadParticular']>0){

if($myrow1d['statusDevolucion']!='si'){
//GENERO LA SOLICITUD
$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorFacturas
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}
//asigno valor
$_GET['numSolicitud']=$n;

$agrega = "INSERT INTO contadorFacturas (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




//ACTUALIZAR ENCABEZA
$actualiza = "UPDATE facturaGrupos
set
numFactura='".$_POST['numFactura']."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
//mysql_db_query($basedatos,$actualiza);
echo mysql_error();
//CIERRA ACTUALIZA
    
  
$sSQL2= "Select * From RFC WHERE RFC like '%$rfc%'   ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

$sSQL2a= "Select * From datosfacturacion WHERE entidad='".$entidad."' and numSolicitud='".$_GET['numSolicitud']."'  ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

if(!$myrow2a['numSolicitud'] ){
 $sql0 = "INSERT INTO datosfacturacion
(razonSocial,
		calle,
	 	colonia,
	 	ciudad,
	 	estado,
	 	cp,
	 	delegacion,
	 	pais,
	 	entidad,
	 	rfc,
	 	calle1,
	 	numFactura,numSolicitud
                )
values
(
'".$myrow2['razonSocial']."',
'".$myrow2['calle']."','".$myrow2['colonia']."',
    '".$myrow2['ciudad']."','".$myrow2['estado']."',
    '".$myrow2['cp']."','".$myrow2['delegacion']."',
        '".$myrow2['pais']."','".$entidad."','".$myrow2['RFC']."',
            '".$myrow2['calle1']."','".$_POST['numFactura']."','".$_GET['numSolicitud']."')

";

mysql_db_query($basedatos,$sql0);
echo mysql_error();
}

    
    
    
    
    
    
    
$_POST['flag1']=1;    
    
         
             $sSQL= "SELECT
             *
             FROM
             cargosCuentaPaciente
             WHERE 
             entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
             and
             gpoProducto!=''
             
             ";



 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){   
     $sql5da= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
folioVenta='".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."'
    and
    keyCAP='".$myrow['keyCAP']."'

";
$result5da=mysql_db_query($basedatos,$sql5da);
$myrow5da= mysql_fetch_array($result5da);    
    






$agrega = "INSERT INTO facturasAplicadas (
numSolicitud,folioVenta,cantidad,
importe,iva,gpoProducto,descripcionArticulo,
descripcionGrupo,entidad,status,fecha,hora,numFactura,
codigo,naturaleza,keyCAP,usuario

)
values 
(

'".$_GET['numSolicitud']."','".$_GET['folioVenta']."','".$myrow['cantidad']."',
'".$myrow['cantidadParticular']."','".$myrow['ivaParticular']."','".$myrow['gpoProducto']."',
    '".$myrow['descripcionArticulo']."','".$myrow['descripcionGrupoProducto']."',
        '".$entidad."','request','".$fecha1."','".$hora1."','',
            '".$myrow['codProcedimiento']."','".$myrow['naturaleza']."',
                '".$myrow['keyCAP']."','".$usuario."'
        
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron Folios de Venta';

} //cierra while




//TERMINA DE AGREGAR A FACTURAS APLICADAS

$sSQLab= "SELECT * FROM entidades where codigoEntidad='".$entidad."' ";
    $resultab=mysql_db_query($basedatos,$sSQLab);
    $myrowab = mysql_fetch_array($resultab); 
if($myrowab['digitosFactura']>0){
   
    $sSQLaa= "SELECT contador from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."'   and tipoFactura='efectivo' ";
    $resultaa=mysql_db_query($basedatos,$sSQLaa);
    $myrowaa = mysql_fetch_array($resultaa);          
    
    
 if(!$myrowaa['contador']){
    //GENERAR FACTURA
    $q4 = "

    INSERT INTO contadorSeriesFacturas(contador, usuario,entidad,numSolicitud,tipoFactura)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorSeriesFacturas where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$_GET['numSolicitud']."','efectivo'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
    
    

    
    
    $sSQLac= "SELECT contador as topeMaximo from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."' and tipoFactura='efectivo'   ";
    $resultac=mysql_db_query($basedatos,$sSQLac);
    $myrowac = mysql_fetch_array($resultac); 
    //echo $myrowac['topeMaximo'];
    //echo '<br>';
    $digitos= strlen($myrowac['topeMaximo']);
    $totalDigitos=$myrowab['digitosFactura']-$digitos;
    $totalDigitos='%0'.$totalDigitos.'s';
    $digtosCompilados = sprintf($totalDigitos, $var); 
    
    $numFactura= $myrowab['prefijoEfectivo'].$digtosCompilados.$myrowac['topeMaximo'];
    
    
    
   $actualiza = "UPDATE facturaGrupos
set
status='facturado',numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

 $actualiza1 = "UPDATE facturasAplicadas
set
status='facturado',numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza1);
echo mysql_error();


 $actualiza2 = "UPDATE datosfacturacion
set

numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza2);
echo mysql_error();

//echo '<script>';
//echo 'window.alert("SE GENERO LA FACTURA: '.$numFactura.'");';
//echo '</script>';
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='FOLIO(s) FACTURADOS..';

    //****GENERAR TICKET******
    $qTi = "

    INSERT INTO contadorTicket(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorTicket where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$myrow1d['keyClientesInternos']."'

    ";
    mysql_db_query($basedatos,$qTi);
    echo mysql_error();

    //************************
    
    $sSQLT= "SELECT contador as topeMaximo from contadorTicket where entidad='".$entidad."' and usuario='".$usuario."'order by keyCExt DESC   ";
    $resultT=mysql_db_query($basedatos,$sSQLT);
    $myrowT = mysql_fetch_array($resultT);
    $ticket= $myrowT['topeMaximo'];
    $tipoFacturacion='Auto';
    require("/configuracion/clases/generarFacturaElectronica.php");    
    
    
    
    
}else{
     echo '<script>window.alert("YA SE GENERO LA FACTURA!");</script>';
}

}else{
     echo '<script>window.alert("FAVOR  DE CONFIGURAR LA ENTIDAD PARA FACTURAR CORRECTAMENTE!");</script>';
}

}//solo entra aqui si no es devolucion
}//solo entra aqui si trae cantidad particular







//*******CIERRA MODULO DE FACTURACION********


























$actualiza1 = "update faltantes
set
status='venta'

WHERE entidad='".$entidad."'
and
keyClientesInternos='".$nT."'
and
gpoProducto!=''
";
mysql_db_query($basedatos,$actualiza1);
echo mysql_error();


$agrega4 = "
    
UPDATE clientesInternos set
numeroFactura='".$numFactura."',
ticket='".$ticket."',    
tipoCuenta='H',
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."',
statusCaja='pagado'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();

$agrega = "UPDATE cargosCuentaPaciente set 
statusCuenta='cerrada',statusCaja='pagado',fechaCierre='".$fecha1."',fecha1='".$fecha1."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

$sSQLCaR= "Select numRecibo,codigoCaja From cargosCuentaPaciente where entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' 
and
tipoTransaccion!=''
and
numRecibo>0
";


$resultCaR=mysql_db_query($basedatos,$sSQLCaR);
$myrowCaR = mysql_fetch_array($resultCaR);

$agregado = "UPDATE cargosCuentaPaciente set 
    numRecibo='".$myrowCaR['numRecibo']."',codigoCaja='".$myrowCaR['codigoCaja']."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
    and tipoTransaccion!=''
    and
    numRecibo=''
";

mysql_db_query($basedatos,$agregado);
echo mysql_error();

//*********************************************







//************CASO 1 **********************
$sSQL1t= "Select status,usuario,folioVenta From transacciones WHERE entidad='".$entidad."' and usuario='".$usuario."'  order by keyT DESC ";
$result1t=mysql_db_query($basedatos,$sSQL1t);
$myrow1t = mysql_fetch_array($result1t);
echo mysql_error();
//echo $_GET['folioVenta'];

//echo $myrow1t['status'].' '.$myrow1t['folioVenta'];

if($myrow1t['status']=='standby' and $myrow1t['folioVenta']!=$_GET['folioVenta']){ 
//echo "Debes terminar de  completar la transaccion: ".$myrow1t['folioVenta'];
?>
<script>
window.alert("Estimado: <?php echo $myrow1t['usuario'];?>, debes de completar la transaccion del folio: <?php echo $myrow1t['folioVenta'];?> ");
window.close();
</script>
<?php }  
}//solo externos
//************************************CANDADO DE USUARIO*****************************************
?>






<?php




if($_POST['cerrar']){ 

$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];











//*******TRASPASO AL MODULO DE FACTURACION AUTOMATICO*******


        $sSQLef= "SELECT
             *
             FROM
             cargosCuentaPaciente
             WHERE 
             entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
             and
             gpoProducto!=''
             and 
             cantidadParticular>0
             ";



 
$resultef=mysql_db_query($basedatos,$sSQLef);
$myrowef = mysql_fetch_array($resultef);

if($myrowef['cantidadParticular']>0){//solamente entra si tiene cantidad particular

if($myrow1d['statusDevolucion']!='si'){
//GENERO LA SOLICITUD
$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorFacturas
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}
//asigno valor
$_GET['numSolicitud']=$n;

$agrega = "INSERT INTO contadorFacturas (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




//ACTUALIZAR ENCABEZA
$actualiza = "UPDATE facturaGrupos
set
numFactura='".$_POST['numFactura']."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
//mysql_db_query($basedatos,$actualiza);
echo mysql_error();
//CIERRA ACTUALIZA
    
  
$sSQL2= "Select * From RFC WHERE RFC like '%$rfc%'   ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

$sSQL2a= "Select * From datosfacturacion WHERE entidad='".$entidad."' and numSolicitud='".$_GET['numSolicitud']."'  ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

if(!$myrow2a['numSolicitud'] ){
 $sql0 = "INSERT INTO datosfacturacion
(razonSocial,
		calle,
	 	colonia,
	 	ciudad,
	 	estado,
	 	cp,
	 	delegacion,
	 	pais,
	 	entidad,
	 	rfc,
	 	calle1,
	 	numFactura,numSolicitud
                )
values
(
'".$myrow2['razonSocial']."',
'".$myrow2['calle']."','".$myrow2['colonia']."',
    '".$myrow2['ciudad']."','".$myrow2['estado']."',
    '".$myrow2['cp']."','".$myrow2['delegacion']."',
        '".$myrow2['pais']."','".$entidad."','".$myrow2['RFC']."',
            '".$myrow2['calle1']."','".$_POST['numFactura']."','".$_GET['numSolicitud']."')

";

mysql_db_query($basedatos,$sql0);
echo mysql_error();
}

    
    
    
    
    
    
    
$_POST['flag1']=1;    
    
         
             $sSQL= "SELECT
             *
             FROM
             cargosCuentaPaciente
             WHERE 
             entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
             and
             gpoProducto!=''
             
             ";



 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){   
     $sql5da= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
folioVenta='".$_GET['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."'
    and
    keyCAP='".$myrow['keyCAP']."'

";
$result5da=mysql_db_query($basedatos,$sql5da);
$myrow5da= mysql_fetch_array($result5da);    
    






$agrega = "INSERT INTO facturasAplicadas (
numSolicitud,folioVenta,cantidad,
importe,iva,gpoProducto,descripcionArticulo,
descripcionGrupo,entidad,status,fecha,hora,numFactura,
codigo,naturaleza,keyCAP,usuario

)
values 
(

'".$_GET['numSolicitud']."','".$_GET['folioVenta']."','".$myrow['cantidad']."',
'".$myrow['cantidadParticular']."','".$myrow['ivaParticular']."','".$myrow['gpoProducto']."',
    '".$myrow['descripcionArticulo']."','".$myrow['descripcionGrupoProducto']."',
        '".$entidad."','request','".$fecha1."','".$hora1."','',
            '".$myrow['codProcedimiento']."','".$myrow['naturaleza']."',
                '".$myrow['keyCAP']."','".$usuario."'
        
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron Folios de Venta';

} //cierra while




//TERMINA DE AGREGAR A FACTURAS APLICADAS

$sSQLab= "SELECT * FROM entidades where codigoEntidad='".$entidad."' ";
    $resultab=mysql_db_query($basedatos,$sSQLab);
    $myrowab = mysql_fetch_array($resultab); 
if($myrowab['digitosFactura']>0){
   
    $sSQLaa= "SELECT contador from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."'   and tipoFactura='efectivo' ";
    $resultaa=mysql_db_query($basedatos,$sSQLaa);
    $myrowaa = mysql_fetch_array($resultaa);          
    
    
 if(!$myrowaa['contador']){
    //GENERAR FACTURA
    $q4 = "

    INSERT INTO contadorSeriesFacturas(contador, usuario,entidad,numSolicitud,tipoFactura)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorSeriesFacturas where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$_GET['numSolicitud']."','efectivo'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
    
    

    
    
    $sSQLac= "SELECT contador as topeMaximo from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."' and tipoFactura='efectivo'   ";
    $resultac=mysql_db_query($basedatos,$sSQLac);
    $myrowac = mysql_fetch_array($resultac); 
    //echo $myrowac['topeMaximo'];
    //echo '<br>';
    $digitos= strlen($myrowac['topeMaximo']);
    $totalDigitos=$myrowab['digitosFactura']-$digitos;
    $totalDigitos='%0'.$totalDigitos.'s';
    $digtosCompilados = sprintf($totalDigitos, $var); 
    
    $numFactura= $myrowab['prefijoEfectivo'].$digtosCompilados.$myrowac['topeMaximo'];
    
    
    
   $actualiza = "UPDATE facturaGrupos
set
status='facturado',numFactura='".$numFactura."' $

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

 $actualiza1 = "UPDATE facturasAplicadas
set
status='facturado',numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza1);
echo mysql_error();


 $actualiza2 = "UPDATE datosfacturacion
set

numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza2);
echo mysql_error();

//echo '<script>';
//echo 'window.alert("SE GENERO LA FACTURA: '.$numFactura.'");';
//echo '</script>';
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='FOLIO(s) FACTURADOS..';

    //****GENERAR TICKET******
    $qTi = "

    INSERT INTO contadorTicket(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorTicket where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$myrow1d['keyClientesInternos']."'

    ";
    mysql_db_query($basedatos,$qTi);
    echo mysql_error();

    //************************
    
    $sSQLT= "SELECT contador as topeMaximo from contadorTicket where entidad='".$entidad."' and usuario='".$usuario."'order by keyCExt DESC   ";
    $resultT=mysql_db_query($basedatos,$sSQLT);
    $myrowT = mysql_fetch_array($resultT);
    $ticket= $myrowT['topeMaximo'];
    $tipoFacturacion='Auto';
    require("/configuracion/clases/generarFacturaElectronica.php");    
    
    
    
    
}else{
     echo '<script>window.alert("YA SE GENERO LA FACTURA!");</script>';
}

}else{
     echo '<script>window.alert("FAVOR  DE CONFIGURAR LA ENTIDAD PARA FACTURAR CORRECTAMENTE!");</script>';
}

}//solo entra aqui si no es devolucion
}//solo entra aqui si trae cantidad particular







//*******CIERRA MODULO DE FACTURACION********






















if($myrow1d['tipoPaciente']=='externo'){
    $agregado = "UPDATE cargosCuentaPaciente set 
    numRecibo='".$myrow1d['numRecibo']."',codigoCaja='".$myrow1d['codigoCaja']."',numCorte='".$myrow1d['numCorte']."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
    and
    gpoProducto=''
    and
    numRecibo=''
";

//mysql_db_query($basedatos,$agregado);
echo mysql_error();
}







 $q = "UPDATE antibioticos set
status='pagado'

WHERE
entidad='".$entidad."'
    and
keyClientesInternos='".trim($_GET['nT'])."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();


//cierro cuenta
$agrega4 = "UPDATE clientesInternos set
ticket='".$ticket."',
    numSolicitud='".$_GET['numSolicitud']."',
statusEstudio='cargado',    
tipoCuenta='H',
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."',
statusCaja='pagado'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();




$agrega4a = "UPDATE cargosCuentaPaciente set
tipoCuenta='H',
status='cerrada',
statusCuenta='cerrada',

fechaCierre='".$fecha1."',

statusCaja='pagado'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega4a);
echo mysql_error();






//cierro cuarto a sucio
if($myrow3['cuarto']){
$agregad = "UPDATE cuartos set 
status='sucio',
usuarioSalida='".$usuario."',
fechaSalida='".$fecha1."',
horaSalida='".$hora1."'

where
entidad='".$entidad."'
and
codigoCuarto='".$myrow3['cuarto']."' 
";

//mysql_db_query($basedatos,$agregad);
echo mysql_error();
}
$leyenda='Cuenta Cerrada!';



  $sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."'  and folioVenta = '".$_GET['folioVenta']."'
  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$agrega5 = "UPDATE porcentajeBeneficencias set
status='cargado'
where
entidad='".$entidad."'
and
numeroE='".$myrow3['numeroE']."'
and
status='standby'
and
departamento='".$myrow3['almacen']."'
";

mysql_db_query($basedatos,$agrega5);
echo mysql_error();


if($myrow3['status']=='cerrada' and $myrow3['statusCuenta']=='cerrada'){?>
<script>
//window.opener.document.forms["form1"].submit();
//window.alert("Cuenta Cerrada");
//window.close();
</script>
<?php 
}else { ?>

<script>
window.opener.document.forms["form1"].submit();
window.alert("Hay un problema con la cuenta");
//window.close();
</script>


<?php 
}

}
?>



<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>








<?php //************************ACTUALIZO **********************
//Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE 

keyClientesInternos = '".$_GET['nT']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$seguroT=ltrim($myrow3['seguro']);
//***************aplicar pago**********************


?>



<?php 
$sSQL3ae= "
	SELECT 
imprimeTicket
FROM
almacenes
where
entidad='".$entidad."'
    and
almacen='".$_GET['almacenSolicitante']."'

";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);
?>




<?php if($_POST['imprimir']){ 



//********************verificar diferencia de centavos*************
$diferencia= number_format($_POST['totalAbono']-$_POST['totalCargo'],2);


/*
if($diferencia>0){
$sSQL3c= "Select keyCAP,cantidadParticular,cantidadAseguradora,ivaParticular,ivaAseguradora From cargosCuentaPaciente WHERE 
entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
and
gpoProducto=''
and
naturaleza='A' order by keyCAP DESC

 ";
$result3c=mysql_db_query($basedatos,$sSQL3c);
$myrow3c = mysql_fetch_array($result3c);

if($myrow3c['cantidadParticular']>0){

$agrega4 = "UPDATE cargosCuentaPaciente set 
cantidadParticular=cantidadParticular-'".$diferencia."',
precioVenta=cantidadParticular+cantidadAseguradora
where
keyCAP='".$myrow3c['keyCAP']."' ";
mysql_db_query($basedatos,$agrega4);
echo mysql_error();

}else if($myrow3c['cantidadAseguradora']>0){
$agrega4 = "UPDATE cargosCuentaPaciente set 
cantidadAseguradora=cantidadAseguradora-'".$diferencia."',
precioVenta=cantidadParticular+cantidadAseguradora
where
keyCAP='".$myrow3c['keyCAP']."'  ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();

}
}
//*******************************************
*/




//********************TODOS SUS MOVIMIENTOS DEBEN ESTAR PAGADOS***********************
$agrega4 = "UPDATE clientesInternos set 
tipoCuenta='H',
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."',
statusCaja='pagado'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();





if($myrow3['tipoPaciente']=='externo'){
$qd = "UPDATE transacciones
set
status='done'
where

status='standby'
and
usuario='".$usuario."' 
 ";

mysql_db_query($basedatos,$qd);
echo mysql_error();

$sSQL1d= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta ='".$_GET['folioVenta']."' ";
$result1d=mysql_db_query($basedatos,$sSQL1d);
$myrow1d = mysql_fetch_array($result1d);
echo mysql_error();

#SI NO TIENE EL RECIBO HAY QUE PONERSELO EN CASO DE CORTESIAS
if(!$myrow1d['numRecibo']){
    
  $sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

 $q = "UPDATE statusCaja set
numRecibo= numRecibo+1
where

keySTC='".$myrowC['keySTC']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();


//***********************ASIGNARA NUMERO DE RECIBO

$sSQLCa= "Select numRecibo From statusCaja where keySTC='".$myrowC['keySTC']."'";
$resultCa=mysql_db_query($basedatos,$sSQLCa);
$myrowCa = mysql_fetch_array($resultCa);
$RECIBO=$myrowCa['numRecibo'];
$numCorte=$myrowC['numCorte'];

$q4 = "UPDATE clientesInternos set numRecibo='".$RECIBO."',numCorte='".$numCorte."',codigoCaja='".$myrowC['keyCatC']."',
autoriza='".$usuario."',statusOtros='standby',responsableCuenta='".$_GET['responsableCuenta']."',
fechaVencimiento='".$_GET['fechaVencimiento']."',
statusDeposito='pagado',usuario='".$usuario."',fecha1='".$fecha1."'
WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();



    $agregado = "UPDATE cargosCuentaPaciente set 
    numRecibo='".$RECIBO."',codigoCaja='".$myrowC['keyCatC']."',numCorte='".$numCorte."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
    and
    gpoProducto=''
    and
    numRecibo=''
";

mysql_db_query($basedatos,$agregado);
echo mysql_error();
}
}

//**************************cierro 

    

    
?>
<?php if($_GET['paquete']=='si'){ ?>
<script language="javascript">
nueva('<?php echo $myrowCent['rutaReciboPaquetes'];?>?numeroE=<?php echo $myrow3['numeroE']; ?>&nCuenta=<?php echo $myrow3['nCuenta']; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&codigoPaquete=<?php echo $myrow3['codigoPaquete'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&paciente=<?php echo $_POST['paciente'];?>&cantidadRecibida=<?php echo $_POST['cantidadRecibida'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&fechaSolicitud=<?php print $_POST['variable_php'];?>','ventana7','800','600','yes');
window.opener.document.form10["form10"].submit();
//window.alert("sandra");
window.close();
</script>
<?php } else { ?>







<?php 


    
if($myrow3ae['imprimeTicket']=='si'){?>
<script>
nueva('imprimeTicket.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&fechaSolicitud=<?php print $_POST['variable_php'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&entidad=<?php echo $entidad;?>','ventana7','800','600','yes');
window.opener.document.form10["form"].submit();
	
window.close();
</script>
    <?php }else{ ?>
<script>
nueva('<?php echo $myrowCent['rutaRecibo'];?>?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&fechaSolicitud=<?php print $_POST['variable_php'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&entidad=<?php echo $entidad;?>','ventana7','800','600','yes');
window.opener.document.form10["form"].submit();
	
window.close();
</script>


<?php 
    }
?>
    
    
    <?php }?>

<?php } ?>









<?php  
$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//***************aplicar pago**********************  

if($myrow3['statusCuenta']=='cerrada' and $myrow3['status']=='cerrada'){ 
  echo "LA CUENTA DEL PACIENTE ".$myrow3['paciente']." ESTA CERRADA...";

$agrega5 = "UPDATE porcentajeBeneficencias set
status='cargado'
where
entidad='".$entidad."'
and
numeroE='".$myrow3['numeroE']."'
and
status='standby'
and
departamento='".$myrow3['almacen']."'
";

mysql_db_query($basedatos,$agrega5);
echo mysql_error();
  ?>


<input name="print" type="button" class="normal" id="print" value="Imprimir EC" onClick="nueva('<?php echo $myrowCent['rutaRecibo'];?>?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&fechaSolicitud=<?php print $_POST['variable_php'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&entidad=<?php echo $entidad;?>','ventana7','800','600','yes');">

 
   
   <?php 
    } else{
  ?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
    <html>
<head>

</head>




  


 




<?php if(!$folioVenta){
$folioVenta=$_GET['folioVenta'];
}
?>


	
  
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
  <header >
  <div class="container">   

      
      <div class="list-group">
          
<a href="#" class="list-group-item active">
    ESTADO DE CUENTA
  </a>          
          
      </div>      
      

      
      
      
      

      
      
      
      
      
 
      
      
      
      
      
      


<form id="form1" name="form1" method="post" action="#">
<?php 


$sSQL= "SELECT *
FROM
clientesInternos 
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'

 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$entidad=$myrow['entidad'];
$mmt=$myrow['credencial'];
$keyClientesInternos=$myrow['keyClientesInternos'];
$folioVENTA=$myrow['folioVenta'];
$tipoPACIENTE=$myrow['tipoPaciente'];
$limiteSEGURO=$myrow['limiteSeguro'];
$SEGURO=$myrow['seguro'];

?>




  
    
    
    

  <table class="table table-responsive" >

    <tr >
      <td  align="left" ><small>FOLIO: </small></td>
      <td  align="left" ><small>PACIENTE: <?php echo $myrow['paciente']; ?></small></td>
      <td  align="left" ><small>DEPTO - CUARTO: </small></td>
    </tr>
	
	<?php if($myrow['statusCortesia']=='si'){ ?>
    <tr>
      <td ><small><blink>*****EL PACIENTE ES DE CORTESIA****</blink></small></td>
    </tr>
    <?php } ?>
	
	<tr>
      
            
            
       <td ><small ><?php echo $myrow['folioVenta']; ?></small></td>
      
      
      
      <td >
          <small>Seguro: 
        <?php 
		
	$segur= $myrow['seguro'];
	
	if ($segur!='') {
	$sSQL4= "Select nomCliente From clientes WHERE entidad='".$entidad."' and numCliente='".$segur."';
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	 
	echo $myrow4['nomCliente'];
} else {
echo particular;
}
?>
        - <?php echo $myrow['credencial']; ?></small>
      </td>
      
      
      
      
      <td><small >
        <?php $id_almacen=$myrow['almacen']; 
	  $sSQL1= "SELECT almacen,descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$id_almacen."'
 ";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['descripcion'];
	  ?>
        - <?php echo $myrow['cuarto']; ?></small></td>
       
       
    </tr>
      
      
      
      
      
    <tr>
      <td  ><small>Fecha/Hora de Inter.: <?php echo $myrow['fecha']." / ".$myrow['hora']; ?></small></td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
       
    </tr>
      
      
      
      
      
    <tr>
      <td  ><small>M&eacute;dico de Inter.: 
        <?php 

	if ($myrow['medico']) {
	 $medico1=$myrow['medico'];
	$sSQL3= "SELECT nombre1,apellido1,apellido2
	FROM
	medicos 
	where
	entidad='".$entidad."'
	and
	numMedico='".$medico1."'";
	
	$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
	 
	 echo $myrow3['nombre1']." ".$myrow3['apellido1']." ".$myrow3['apellido2']; 
     }
     else{
		 echo $myrow['medicoForaneo'];    
	 }
?>
      </small></td>
        
        
        
      <td>&nbsp;</td>
       <td>&nbsp;</td>
      
    </tr>
      
      
      
      
    <tr>
      
        <td ><small>Diagn&oacute;stico: <?php echo $myrow['dx']; ?></small></td>
       <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
      
      
      
      
    <tr>
      <td ><small>Fecha/Hora de Alta: <?php echo $myrow['fechaCierre']." / ".$myrow['horaCierre']; ?></small></td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
	
	<?php if($myrow['numeroFactura']){ ?>
    <tr>
      <td ><small>Numero Factura:  <span class="normalmid"><?php echo $myrow['numeroFactura']; ?></small></td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
	<?php } ?>
  </table>
    
    
    


    
    
    
    
    
    


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  <p align="center">
  <?php 
  
 	$sSQLnc= "SELECT *
	FROM
	clientesInternos 
	where
	entidad='".$entidad."'
	and
	folioVenta='".$myrow['folioDevolucion']."' and statusCuenta='cerrada' ";
	
	$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
//echo $myrow3i['folioVenta'];
    ?>
	
	
	<?php if($myrownc['folioVenta']){ ?>
<h1 align="center" class="titulos"> 
   <a href="javascript:nueva('/sima/cargos/despliegaCargos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow['folioDevolucion'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucion';}else{ echo 'efectivo';} ?>&amp;tipoTransaccion=particular&amp;devolucion=<?php echo $_GET['devolucion'];?>&tipoPago=Efectivo','ventana7','800','600','yes');">
NOTA DE CREDITO
</a>
<?php } ?>
	
  </p>

    
<?php
//CIERRA ENCABEZADO
?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    

  <?php 
  //require('/configuracion/clases/operacionesGlobales.php');
  
  ?>
  
<?php 
//*******************************OPERACION GLOBAL*****************************
//CARGOS
//$subTotalDescuentos=sprintf("%01.2f", $operaciones); 


if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargo[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){ 
$abono[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucion[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES CARGOS
if($myrow['naturaleza']=='C' and $myrow['statusDevolucion']=='si'){
$devolucionCargos[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}



//REGRESOS
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regreso[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}
//*******************************************************************************







//CARGOS PARTICULARES 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
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
   $cargosBeneficencia[0]+=sprintf("%01.2f", $myrow['cantidadBeneficencia']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){//devolucion de cargo beneficencia
$devolucionBeneficencia[0]+=sprintf("%01.2f", $myrow['cantidadBeneficencia']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['tipoTransaccion']=='DEVXB'){ 
$dtBeneficencia[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}






if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){//abonos
$abonosBeneficencia[0]+=sprintf("%01.2f", $myrow['cantidadBeneficencia']*$myrow['cantidad']);
}


if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}




//IVA
if($myrow['naturaleza']=='C'){
$ivaCargos[0]+=sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}elseif($myrow['naturaleza']=='A'){
$ivaAbonos[0]+=sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
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
$totalCargoCoaseguro1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my2['codigoTT']){
$coaseguro2=$my2['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
} 


if($myrow['tipoTransaccion']==$my3['codigoTT']){
$deducible1=$my3['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
} 

if($myrow['tipoTransaccion']==$my4['codigoTT']){
$deducible2=$my4['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
}

//*******************CIERRO COASEGURO Y DEDUCIBLE


//****************APlicar descuentos**********
if($myrow['tipoTransaccion']==$my5['codigoTT'] || $myrow['tipoTransaccion']==$my5a['codigoTT']){ 
$descuentoParticular=$my5a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoParticularAplicado[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad']);
}else{
$descuentosParticulares[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my6['codigoTT'] || $myrow['tipoTransaccion']==$my6a['codigoTT']){
$descuentoAseguradora=$my6a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoAseguradoraAplicado[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad']);
}else{
$descuentosAseguradoras[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad']);
}
}



if($myrow['tipoTransaccion']==$my7['codigoTT'] || $myrow['tipoTransaccion']==$my7a['codigoTT']){
$transB=$my7['codigoTT'];
}
//*********************************************
?>  
    
  <?php
  //CIERRA OPERACIONES GLOBALES
  ?>
    
    
    
    
    
    
    
    
    
    
  <?php 
  
  //require('/configuracion/clases/mostrarDatosCuenta.php');
  //MOSTRAR DATOS CUENTA
  ?>
  
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<div align="center">

      <?php   $sSQL7= "Select gpoProducto From cargosCuentaPaciente
          where entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
                 and
                 gpoProducto!=''
      group by gpoProducto";

$result7=mysql_db_query($basedatos,$sSQL7);
echo mysql_error();
	  ?>
    
    
          <select name="gpoProducto1"  class="form-control" onChange="this.form.submit();" >
		  <option value="">GRUPOS DE PRODUCTO</option>
            <?php
		   while($myrow7 = mysql_fetch_array($result7)){

                       $sSQL78="SELECT *
                            FROM
                                gpoProductos
                                WHERE
                                    entidad = '".$entidad."'
                                    and
                                codigoGP='".$myrow7['gpoProducto']."'
                                ";
                            $result78=mysql_db_query($basedatos,$sSQL78);
                            $myrow78 = mysql_fetch_array($result78);
                       ?>

            <option
		    <?php 		if($_POST['gpoProducto1']==$myrow7['gpoProducto'])echo 'selected'; ?>
		   value="<?php echo $myrow7['gpoProducto']; ?>"><?php echo $myrow78['descripcionGP'] ?></option>
            <?php }

		?>
          </select>
    
<p></p>



<div class="table-responsive">
    <table  class="table"  >

    <tr >
      <th ><div align="left"><small>#</small></div></th>
      <th><div align="left"><small># Reg</small></div></th>
      <th ><div align="left"><small>Fecha</small></div></th>
      <th ><div align="left"><small>C</small></div></th>
      <th ><div align="left"><small>Descripcion</small></div></th>
      <th ><div align="left"><small>Totales</small></div></th>
      <th ><div align="left"><small>N</small></div></th>
      <th ><div align="left"><small>Part</small></div></th>
      <th ><div align="left"><small>Benef</small></div></th>
      <th  ><div align="left"><small>Aseg</small></div></th>
    </tr>
        
        
        
        
    <tr>



<?php	

$q = "DELETE FROM reportesTemporales
where
entidad='".$entidad."'
and
usuario='".$usuario."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();

if ($_POST['gpoProducto1']==null){
 $sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'


";}

else {
$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
    and
    gpoProducto='".$_POST['gpoProducto1']."'


";
}


if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$a+=1;
$nT=$myrow['keyClientesInternos'];
if($myrow['naturaleza']=='A'){
$signo='-';
}else{
$signo=NULL;
}



//   
?>


 <tr  >
      <td  ><small><?php print $a;?></small></td>
      <td align="center"><small><?php
	echo $myrow['keyCAP'];
	   ?></small></td>
      
      
      <td ><small><?php
	echo cambia_a_normal($myrow['fecha1']);

        
        
	   ?></small></td>
      
      
      <td  >
          <div align="center">
          <small>    
        <?php
	echo round($myrow['cantidad'],3);
	//echo $myrow['cantidad'];
        ?>
          </small>      
      </div></td>
      
      
      
      <td   ><small><?php
		
		echo '<span >';
       echo $myrow['descripcionArticulo'];
	   echo '</span>';
	   if($myrow['tipoPaciente']!='externo'){
	   if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){
echo '</br><div >'.'Devolucion, folio: '.$myrow['folioDevolucion'].'</div>';

}
}


        if($myrow['fechaSolicitud']!=''){
            echo '<br>';
            echo 'Fecha Solicitud: '.cambia_a_normal($myrow['fechaSolicitud']);
            
        }



if($myrow['gpoProducto']!=''){
	   if($myrow['statusCargo']=='cargado' ){
echo '</br><div >'.'[ '.$myrow['statusCargo'].']'.' a las '.'[ '.$myrow['horaCargo'].']'.' </div>Solicitado por: '.'[ '.$myrow['usuario'].']';
	}else{
	echo '</br><div ><blink>'.'*************** FAVOR DE SURTIR ********'.'</blink></div>';
	}
	}else{
	echo '</br><div >'.'[ Transaccion]'.'</div>';
	}
	
			   $sSQL341c= "Select descripcionGP From gpoProductos WHERE  entidad='".$entidad."' and codigoGP='".$myrow['gpoProducto']."'";
$result341c=mysql_db_query($basedatos,$sSQL341c);
$myrow341c = mysql_fetch_array($result341c);   
echo '</br>';
	   echo '- '.$myrow341c['descripcionGP'].' -';
echo '</br>';	
	
if($myrow['statusDescuentoGlobal']=='si'){
echo '</br><span >'.' ['.$myrow['descripcionDescuentoGlobal'].']'.'</span>';
}

if($myrow['facturacionEspecial']=='si'){
echo '</br><span >'.' ['.$myrow['descripcionSeguroFacturacion'].']'.'</span>';
}



//***********************************ALMACENES**********************************
$sSQL341cs= "Select * From almacenes WHERE  entidad='".$entidad."' and almacen='".$myrow['almacenSolicitante']."'";
$result341cs=mysql_db_query($basedatos,$sSQL341cs);
$myrow341cs = mysql_fetch_array($result341cs);  


$sSQL341ca= "Select * From almacenes WHERE  entidad='".$entidad."' and almacen='".$myrow['almacenDestino']."'";
$result341ca=mysql_db_query($basedatos,$sSQL341ca);
$myrow341ca = mysql_fetch_array($result341ca);  

if($myrow['gpoProducto']!=''){
echo '</br><span >'.' ['.$myrow341cs['descripcion'].'  >  '.$myrow341ca['descripcion'].'] '.'</span>';
}
//********************************************************************************************



if($myrow['numRecibo']){ ?>
</br><span > Recibo: </span>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

<?php 
}
	
	

if($myrow['numRecibo']>0){ ?>
      </br>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

<?php 
}
	



	
	
	
	
	
if($myrow['gpoProducto']!=''  and $usuario){
$sSQLa= "
SELECT *
FROM
reportesTemporales
WHERE 
entidad='".$entidad."' 
and
usuario='".$usuario."'  
and
codigoGP='".$myrow['gpoProducto']."'   ";
 
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);



  $agrega = "INSERT INTO reportesTemporales (
gpoProducto,importe,entidad,usuario,random,codigoGP,naturaleza,folioVenta
) values (
'".$myrow341c['descripcionGP']."',
'".$myrow['precioVenta']*$myrow['cantidad']."',
'".$entidad."','".$usuario."','".$random."','".$myrow['gpoProducto']."','".$myrow['naturaleza']."','".$_GET['folioVenta']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

}	
	   ?>



<?php /*if($myrow['naturaleza']=='-'){ ?>
</br><span > 
	  <a href="javascript:ventanaSecundaria10('/sima/cargos/ventanaEditar.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','500','200','yes');">
Editar</a>
<?php } */?>

          </small>
	   <hr />
      </td>
      
      
      
      

      <td   >
          <div align="center">
              <small>
<?php
echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);
?></small>
      </div>
      </td>
      
      
      
      <td  >
          <div align="center">
              <small>
        <?php
echo $myrow['naturaleza'];

?></small>
      </div></td>
      
      
      
      
      <td   ><div align="center">

<small>
<?php

$triggerParticular=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);

?>
</small>
      </div></td>
      
      
           <td  ><div align="center">

  <small>
<?php

$triggerBeneficencia=sprintf("%01.2f", $myrow['cantidadBeneficencia']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaBeneficencia']*$myrow['cantidad']);
echo '$'.number_format(($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']),2);

?>
</small>
      </div></td> 
      
      
      
      

<td   >
    <div align="center">
  <small >
  <?php
$triggerAseguradora=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);  
  
echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
?>
</small>


</div></td>
      
</tr> 
        
        
        

<?php //require('/configuracion/clases/operacionesGlobales.php');
//ABRE OPERACIONES GLOBALES
?>


<?php 
//*******************************OPERACION GLOBAL*****************************
//CARGOS

if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargo[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){ 
$abono[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucion[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}


//DEVOLUCIONES CARGOS
if($myrow['naturaleza']=='C' and $myrow['statusDevolucion']=='si'){
$devolucionCargos[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}



//REGRESOS
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regreso[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}
//*******************************************************************************







//CARGOS PARTICULARES 
if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){ 
$cargoParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){
$devolucionParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
}

//REGRESO DE EFECTIVO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){ 
$regresoParticular[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaParticular']*$myrow['cantidad']);
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
   $cargosBeneficencia[0]+=sprintf("%01.2f", $myrow['cantidadBeneficencia']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){//devolucion de cargo beneficencia
$devolucionBeneficencia[0]+=sprintf("%01.2f", $myrow['cantidadBeneficencia']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaBeneficencia']*$myrow['cantidad']);
}

if($myrow['tipoTransaccion']=='DEVXB'){ 
$dtBeneficencia[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}






if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){//abonos
$abonosBeneficencia[0]+=sprintf("%01.2f", $myrow['cantidadBeneficencia']*$myrow['cantidad']);
}


if($myrow['naturaleza']=='C'  and $myrow['statusRegreso']!='si'){
$cargoAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}

//ABONOS
if($myrow['naturaleza']=='A' and $myrow['gpoProducto']==''){
$abonoAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}


//DEVOLUCIONES
if($myrow['naturaleza']=='A' and $myrow['statusDevolucion']=='si'){ 
$devolucionAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}

//REGRESO DE TRASLADO
if($myrow['naturaleza']=='C' and $myrow['statusRegreso']=='si'){
$regresoAseguradora[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad'])+sprintf("%01.2f", $myrow['ivaAseguradora']*$myrow['cantidad']);
}




//IVA
if($myrow['naturaleza']=='C'){
$ivaCargos[0]+=sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
}elseif($myrow['naturaleza']=='A'){
$ivaAbonos[0]+=sprintf("%01.2f", $myrow['iva']*$myrow['cantidad']);
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
$totalCargoCoaseguro1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my2['codigoTT']){
$coaseguro2=$my2['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoCoaseguro2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
} 


if($myrow['tipoTransaccion']==$my3['codigoTT']){
$deducible1=$my3['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible1[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
} 

if($myrow['tipoTransaccion']==$my4['codigoTT']){
$deducible2=$my4['codigoTT'];
if($myrow['naturaleza']=='-'){
$totalCargoDeducible2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}else{
$totalAbonoDeducible2[0]+=sprintf("%01.2f", $myrow['precioVenta']*$myrow['cantidad']);
}
}

//*******************CIERRO COASEGURO Y DEDUCIBLE


//****************APlicar descuentos**********
if($myrow['tipoTransaccion']==$my5['codigoTT'] || $myrow['tipoTransaccion']==$my5a['codigoTT']){ 
$descuentoParticular=$my5a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoParticularAplicado[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad']);
}else{
$descuentosParticulares[0]+=sprintf("%01.2f", $myrow['cantidadParticular']*$myrow['cantidad']);
}
}


if($myrow['tipoTransaccion']==$my6['codigoTT'] || $myrow['tipoTransaccion']==$my6a['codigoTT']){
$descuentoAseguradora=$my6a['codigoTT'];
if($myrow['naturaleza']=='-'){
$descuentoAseguradoraAplicado[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad']);
}else{
$descuentosAseguradoras[0]+=sprintf("%01.2f", $myrow['cantidadAseguradora']*$myrow['cantidad']);
}
}



if($myrow['tipoTransaccion']==$my7['codigoTT'] || $myrow['tipoTransaccion']==$my7a['codigoTT']){
$transB=$my7['codigoTT'];
}
//*********************************************
?>

<?php //CIERRA OPERACIONES GLOBALES=?>



    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
</div>   
    
    
	</p>	
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <p>
 <?php 
 //require('/configuracion/clases/mostrarTotalesEC.php');
 
 //MOSTRAR TOTALES EC
 ?> 
      
      
      
<?php 
  //OPERACIONES GLOBALES

/*
echo '('.$cargoParticular[0].' - '.$abonoParticular[0].'  ) -  ('.$devolucionParticular[0].' - '.$regresoParticular[0].')';
echo '<br>';
echo 'Cargos: '.($cargoParticular[0]-$devolucionParticular[0]);
echo '<br>';
echo 'Abonos: '.($abonoParticular[0]);
*/

  $totalCargo=sprintf("%01.2f", $cargo[0])-sprintf("%01.2f", $devolucion[0]);
  $totalAbono=sprintf("%01.2f", $abono[0])-sprintf("%01.2f", $regreso[0])+sprintf("%01.2f", $descuentos[0]);
  
  $totalParticular=sprintf("%01.2f", $cargoParticular[0]-$abonoParticular[0])-sprintf($devolucionParticular[0]-$regresoParticular[0]);
   $totalBeneficencia=sprintf("%01.2f", $cargosBeneficencia[0]-($abonosBeneficencia[0]-$dtBeneficencia[0]))-sprintf($devolucionBeneficencia[0]-$regresoBeneficencia[0]);
  $totalAseguradora=sprintf("%01.2f", $cargoAseguradora[0]-$abonoAseguradora[0])-sprintf($devolucionAseguradora[0]-$regresoAseguradora[0]);

//echo $cargosBeneficencia[0].'-1- '.$abonosBeneficencia[0].'-2- '.$devolucionBeneficencia[0].' -3- '.$regresoBeneficencia[0];
  //REDONDEO GLOBALES****/

  $TOTAL=sprintf("%01.2f", $totalCargo)-sprintf("%01.2f",$totalAbono);
  //if($TOTAL>-1 and $TOTAL<1){
  //$TOTAL='0.00';
  //}
  //**************************
  
  //******TOTAL PARTICULAR
  $totalParticular= sprintf("%01.2f", $totalParticular);

  
  if($totalParticular>-1 and $totalParticular<1){
   $totalParticular='0.00';
  }
  //*********************
  
  //****************TOTAL IVA
  $ivaTotal=sprintf("%01.2f", $ivaCargos[0]-$ivaAbonos[0]);
  //**************************
  
  
    //******TOTAL ASEGURADORA
  if($totalAseguradora>-1 and $totalAseguradora<1){
  $totalAseguradora='0.00';
  }
  //*********************
  
  
  //**********COASEGUROS DEDUCIBLES**************
  $totalCoaseguro1=sprintf("%01.2f", $totalCargoCoaseguro1[0]-$totalAbonoCoaseguro1[0]);
  $totalCoaseguro2=sprintf("%01.2f", $totalCargoCoaseguro2[0]-$totalAbonoCoaseguro2[0]);
  $totalDeducible1=sprintf("%01.2f", $totalCargoDeducible1[0]-$totalAbonoDeducible1[0]);
  $totalDeducible2=sprintf("%01.2f", $totalCargoDeducible2[0]-$totalAbonoDeducible2[0]);
  //***************************************************
  
  //*****************DESCUENTOS*********
$descuentoP=sprintf("%01.2f", $descuentoParticularAplicado[0]-$descuentosParticulares[0]);
$descuentoA=sprintf("%01.2f", $descuentoAseguradoraAplicado[0]-$descuentosAseguradoras[0]);  
  //***************************************



//****************BENEFICENCIAS********
$ben=sprintf("%01.2f", $cargosBeneficencia[0]-$devolucionBeneficencia[0])-(($abonosBeneficencia[0]-$dtBeneficencia[0])-$pagoDevBeneficencia[0]);
//*************************************
?>      
      
      
      
<?php
//CIERRA TOTALES EC
?>
      
  </p>
  
    
    
    
    <div class="container"> 
  <table width="312" class="table table-striped"  >
    <tr>
      <th width="212"   scope="col"><div align="left"><small>Descripci&oacute;n</small></div></th>
      <th width="62"   scope="col"><div align="right"><small>Importe</small></div></th>

    </tr>
    
      
      
      
      
      <tr>
<?php





$sSQL= "
SELECT gpoProducto
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and gpoProducto!=''
group by gpoProducto
 ";





if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];
$i+=1;



$sSQLac= "
SELECT sum(importe) as cargo
FROM
reportesTemporales
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
codigoGP='".$myrow['gpoProducto']."'
and
naturaleza='C'

  ";

$resultac=mysql_db_query($basedatos,$sSQLac);
$myrowac = mysql_fetch_array($resultac);
$sSQLaa= "
SELECT sum(importe) as abono
FROM
reportesTemporales
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
codigoGP='".$myrow['gpoProducto']."'
and
naturaleza='A'
 ";

$resultaa=mysql_db_query($basedatos,$sSQLaa);
$myrowaa = mysql_fetch_array($resultaa);

$sSQLaa1= "
SELECT *
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and codigoGP='".$myrow['gpoProducto']."'
order by descripcionGP ASC
 ";

$resultaa1=mysql_db_query($basedatos,$sSQLaa1);
$myrowaa1 = mysql_fetch_array($resultaa1);
?>
      
      <td   ><div align="left"><small > <?php echo $myrowaa1['descripcionGP']; ?></small></div></td>
      <td   align="right" ><small><?php

          echo "$".number_format($myrowac['cargo']-$myrowaa['abono'],2);
           ?></small></td>
  </tr>
    <?php }}?>

         
      
        
      
      <tr>
          
          <td></td>
         <td  align="right" ><small>
                IVA:
                <?php
                  echo "$".number_format($ivaTotal,2);
           ?></small></td>
      </tr>
          
          
  </table>
  </div>

  






    <p align="center">





 <input type="hidden" name="variable_php" id="variable_php" />

</form>

<p align="center">&nbsp;</p>
<script languaje="JavaScript">            
              document.form1.variable_php.value=varjs;
</script>
<?php
//***************SOLO MOSTRAR

$q = "DELETE FROM reportesTemporales
where
entidad='".$entidad."'
and
usuario='".$usuario."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
 ?>
  <?php //MOSSTRAR DATOS CUENTA
  ?>


   
    
    </table>

</div>
  

  
  




   <?php 
//MOSTRAR DATOS EC
//   require('/configuracion/clases/mostrarDatosEC.php');
//
?>

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
      
  <div class="container">       
<table class="table table-striped">
    <tr >
      
      <th  ><small>Cargos</small></th>
      <th ><small>Abonos</small></th>
      <th ><small><div align="right">Total Cuenta</div></small></th>
    </tr>
    
    
    <tr >
   <td>
      <small>
	  <?php 

	  echo '$'.number_format($totalCargo,2);
	  
	  ?></small></td>
      <td ><small><?php echo '$'.number_format($totalAbono,2);?></small></td>
      <td><small><div align="right"><?php echo '$'.number_format($TOTAL,2);?></div></small></td>
    </tr>
	

	


  </table>
  </div>
























<?php 
###COMPROBACIONES OBLIGATORIAS 1Oct2013 si no son devoluciones
                  $sql5car= "
                    SELECT *
                    FROM
                    convenios
                    WHERE
                    entidad='".$entidad."'
                        and
                    numCliente =  '".$myrow1d['clientePrincipal']."'
                    AND
                    (departamento='".$myrow1d['almacen']."' or departamento='*')
                    AND
                    tipoConvenio='descuentoConvenio'
                    and
                    ('".$fecha1."'>=fechaInicial and '".$fecha1."'<=fechaFinal)
                    ";
                    $result5car=mysql_db_query($basedatos,$sql5car);
                    $myrow5car= mysql_fetch_array($result5car);
                    
                    if($myrow5car['costo']>0){ 
if($myrow1d['statusDevolucion']!='si'){

                    $sSQL3a= "
                    SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as totales 
                    From cargosCuentaPaciente 
                    WHERE  entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
                    and tipoTransaccion='".$my6a['codigoTT']."'";
                    $result3a=mysql_db_query($basedatos,$sSQL3a);
                    $myrow3a = mysql_fetch_array($result3a);    
                    if($myrow3a['totales']>0){$descuentoHecho=$myrow3a['totales'];}
                    
                    //echo $totalAseguradora.'  '.$cantidadDescuento.'  '.$descuentoHecho;
                    $descripcionTransaccion=$my6a['descripcion'];
                    //$descuentoAseguradora=$myrow5['costo'];
                    //$totalAseguradora;
                    $cantidadDescuento=($myrow5car['costo']*0.01)*$totalAseguradora;
                    //$candadoA=($totalAseguradora-$cantidadDescuento)-$descuentoHecho;
                    if($descuentoHecho<1){
                    $candadoA=$cantidadDescuento;
                    $descuentoA=$cantidadDescuento;
                    }
                    
                    }
}



?>  







<?php 




 $saldos=new acumulados();








 if( $limiteSEGURO>0 and $SEGURO!=NULL){
//doble if
$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$SEGURO."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);

$acumulado=sprintf("%01.2f", $myrow7ab['cantidad'])-sprintf("%01.2f", $saldos-> verificarSaldos($myrow3['seguro'],$entidad,$fecha1,$basedatos,$myrow3['numeroE'],$mmt));



if($TOTAL<=$acumulado){
//MOSTRAR EFECTUAR TRANSACCIONES    ?>

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






  <div class="container"> 
<table class="table table-striped" >
  <tr>
    <th colspan="2" ><small>Particular</small></th>
    <th width="75" >&nbsp;</th>
     <th colspan="2" ><small>Beneficencia</small></th>
    <th width="75" >&nbsp;</th>
    <th colspan="2" ><small>Aseguradora</small></b></th>
  </tr>
  <tr>
    <td width="137" ><small >Cargos</small></td>
    <td width="75"><small >
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
    </small></td>
    <td>&nbsp;</td>
    
    
        <td width="137" ><small >Cargos</small></td>
    <td width="75"><small >
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
    </small></td>
    <td>&nbsp;</td>
    
    
    
    
    
    
    
    
    
    
    
    
    <td width="116"><small >Cargos</small></td>
    <td width="153"><small >
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
    </small></td>
    
    
    
    
  </tr>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td><small >IVA</small></td>
    <td><small ><?php echo  '$'.number_format($myrowpartc['totalIVA']-$myrowparta['totalIVA'],2);?></small></td>
    <td>&nbsp;</td>
    <td><small >IVA</small></td>
    <td><small ><?php echo  '$'.number_format($myrowbenec['totalIVA']-$myrowbenea['totalIVA'],2);?></small></td>
    <td>&nbsp;</td>
    <td><small >IVA</small></td>
    <td><small ><?php echo  '$'.number_format($myrowasegc['totalIVA']-$myrowasega['totalIVA'],2);?></small></td>
  </tr>
  
  
  
  
  
  <tr>
    <td><small >Total</small></td>
    <td><small ><?php echo  '$'.number_format(($myrowpartc['totalParticular']+$myrowpartc['totalIVA'])-($myrowparta['totalParticular']+$myrowparta['totalIVA']),2);?></small></td>
    <td>&nbsp;</td>
    
    <td><small >Total</small></td>
    <td><small ><?php echo  '$'.number_format(($myrowbenec['totalParticular']+$myrowbenec['totalIVA'])-($myrowbenea['totalParticular']+$myrowbenea['totalIVA']),2);?></small></td>
    <td>&nbsp;</td>
    
    
    
    <td><small >Total</small></td>
    <td><small ><?php echo  '$'.number_format(($myrowasegc['totalAseguradora']+$myrowasegc['totalIVA'])-($myrowasega['totalAseguradora']+$myrowasega['totalIVA']),2);?></small></td>
  </tr>
</table>
  </div>
<p>&nbsp;</p>






 



  <div class="container"> 
<!--AQUI VA LA TABLA-->
<table width="900" class="table table-striped" >

  <tr >
    <th  ><div align="center"><small>Part</small></div></th>
    <th ><div align="center"><small>Aseg</small></div></th>
    <th  ><div align="center"><small>Regreso Aseg</small></div></th>
    <th><div align="center"><small>Regreso Part</small></div></th>
    <th   ><div align="center"><small>C1</small></div></th>
    <th  ><div align="center"><small>C2</small></div></th>
    <th   ><div align="center"><small>D1</small></div></th>
    <th   ><div align="center"><small>D2</small></div></th>
    <th   ><div align="center"><small>Desc Part</small></div></th>
    <th  ><div align="center"><small>Desc Aseg</small></div></th>
    <th   ><div align="center"><small>Beneficencia</small></div></th>
  </tr>
  <tr  >
    
      
      
      
      
      
      
      
      
      
      
      
<td  ><div align="center"><span >
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


<?php if($totalParticular>0 and $totalParticular>-1){ 
    
##CANDADOS 11oct2013    

    
if($u4<1 or $u9<1 or $u11<1){    
?>
<a  href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionParticular';}else{ echo 'efectivo';} ?>&amp;tipoTransaccion=particular&amp;tipoPago=<?php echo $tipoPago;?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>&statusCortesia=<?php echo $myrow3['statusCortesia'];?>&tipoDevolucion=<?php echo $tipoDevolucion;?>&beneficencia=<?php
if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&statusBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&activaBeneficencia=<?php if($myrow3['activaBeneficencia']=='si'){ echo 'si';}?>&caso=<?php echo $caso;?>','ventana7','680','380','yes');">
<?php 
echo '$'.number_format($totalParticular,2);
?>
</a>
<?php } ?>
<?php } else{  $u1=1;     
//echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';
}
?>



      <?php } else { echo '$'.number_format($totalParticular,2);}?>
      <?php } else{$u1=1;?>
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
	  
	  
                  
                  
             
	  
	  <?php if($totalAseguradora>-1 and $totalAseguradora>0){ ?>
<?php             
##CANDADOS 11oct2013    

    
if($u3<1 or $u5<1 or $u6<1 or $u7<1 or $u8<1 or $u10<1){   ?>                 
<a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;precioVenta=<?php echo $totalAseguradora;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionAseguradora';}else{ echo 'cxc';} ?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;tipoTransaccion=aseguradora&amp;tipoPago=<?php echo $tipoPago;?>&amp;devolucion=<?php echo $_GET['devolucion'];?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','800','380','yes');"> 
<?php    echo '$'.number_format($totalAseguradora,2); ?>
</a>
    <?php }else{
    echo '$'.number_format($totalAseguradora,2);    
    } ?>                 
                  
      <?php } else {$u1=2; echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';}?>





      <?php } else { echo '$'.number_format($totalAseguradora,2);}?>
      <?php } else{?>
      <?php echo '$'.number_format($totalAseguradora,2);?>
      <?php } ?>
      <?php } else{ $u2=1;?>
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
        <?php } else{$u3=1;?>
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
        <?php } else{$u4=1;?>
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
      <?php } else{$u5=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro2>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro2;?>&amp;precioVenta=<?php echo $totalCoaseguro2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro2,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro2,2);}?>
      <?php } else{$u6=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible1>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible1;?>&amp;precioVenta=<?php echo $totalDeducible1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible1,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible1,2);}?>
      <?php } else{$u7=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible2>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible2;?>&amp;precioVenta=<?php echo $totalDeducible2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible2,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible2,2);}?>
      <?php } else{$u8=1;?>
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
      <?php } else{$u9=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php
      ##ACTUALIZADO EN 1oct2013 LAS DEVOLUCIONES ESTAN PROHIBIDAS
      ###DESCUENTO SOBRE CONVENIO
      ###FUNCIONA CON LOS EXTERNO
                    //echo $myrow1d['tipoPaciente'];
if($myrow1d['statusDevolucion']!='si'){                    
                    $sql5= "
                    SELECT *
                    FROM
                    convenios
                    WHERE
                    entidad='".$entidad."'
                        and
                    numCliente =  '".$myrow1d['clientePrincipal']."'
                    AND
                    (departamento='".$myrow1d['almacen']."' or departamento='*')
                    AND
                    tipoConvenio='descuentoConvenio'
                    and
                    ('".$fecha1."'>=fechaInicial and '".$fecha1."'<=fechaFinal)
                    ";
                    $result5=mysql_db_query($basedatos,$sql5);
                    $myrow5= mysql_fetch_array($result5);
                    
                    if($myrow5['costo']>0){
                    //$tA total de aseguradora
                    //echo $myrow5['costo'].'  '.$tA;  
                    
                    $s6a= "Select * From catTTCaja WHERE  descuentoAseguradoras='si'  ";
                    $rs6a=mysql_db_query($basedatos,$s6a);
                    $my6a = mysql_fetch_array($rs6a); 
                    
                    
                    $sSQL3a= "
                    SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as totales 
                    From cargosCuentaPaciente 
                    WHERE  entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
                    and tipoTransaccion='".$my6a['codigoTT']."'";
                    $result3a=mysql_db_query($basedatos,$sSQL3a);
                    $myrow3a = mysql_fetch_array($result3a);    
                    if($myrow3a['totales']>0){$descuentoHecho=$myrow3a['totales'];}                    
                    
                    $descripcionTransaccion=$my6a['descripcion'];
                    $descuentoAseguradora=$my6a['codigoTT'];
                    
                    
                    $cantidadDescuento=($myrow5['costo']*0.01)*$totalAseguradora;
                    //$descuentoA=($totalAseguradora-$cantidadDescuento)-$descuentoHecho;
                    $descuentoA=$cantidadDescuento-$descuentoHecho;
                    
}}
      ##############
      ?>
                
                
                
      <?php if($descuentoA>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoAseguradora;?>&amp;precioVenta=<?php echo $descuentoA;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=aseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoA,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoA,2);}?>
      <?php } else{$u10=1;?>
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
      <?php } else{$u11=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
  </tr>

</table>
  </div>



<p>&nbsp;</p>



 
 <?php
 //CIERRA MOSTRAR EFECTUAR TRANSACCIONES
   }else{
echo '<br>';
   echo '<span class="codigos">ERROR: <blink>'.'Imposible hacer movimientos en esta cuenta, ya supero su limite de credito!'.'</blink>'.' tienes cargos por: '. '$'.number_format($saldos-> verificarSaldos($myrow3['seguro'],$entidad,$fecha1,$basedatos,$myrow3['numeroE'],$matricula),2).'!!'.'</span>';
   }

}else{ //no tiene limites?>

<?php 
//MOSTRAR EFECTUAR TRANSACCIONESheight="48" 
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




























  <div class="container"> 
<table width="590" border="0" align="center" cellpadding="4" cellspacing="0" class="table table-striped" style="border: 1px solid #CCC;">
  <tr>
    <th colspan="2" ><b ><small>Particular</small></b></th>
    <th width="75" >&nbsp;</th>
     <th colspan="2" ><b ><small>Beneficencia</small></b></th>
    <th width="75" >&nbsp;</th>
    <th colspan="2" ><b ><small>Aseguradora</small></b></th>
  </tr>
  <tr>
    <td width="137" ><small >Cargos</small></td>
    <td width="75"><small >
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
    </small></td>
    <td>&nbsp;</td>
    
    
        <td width="137" ><small >Cargos</small></td>
    <td width="75"><small >
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
    </small></td>
    <td>&nbsp;</td>
    
    
    
    
    
    
    
    
    
    
    
    
    <td width="116"><small >Cargos</small></td>
    <td width="153"><small >
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
    </small></td>
    
    
    
    
  </tr>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td><small >IVA</small></td>
    <td><small ><?php echo  '$'.number_format($myrowpartc['totalIVA']-$myrowparta['totalIVA'],2);?></small></td>
    <td>&nbsp;</td>
    <td><small >IVA</small></td>
    <td><small ><?php echo  '$'.number_format($myrowbenec['totalIVA']-$myrowbenea['totalIVA'],2);?></small></td>
    <td>&nbsp;</td>
    <td><small >IVA</small></td>
    <td><small ><?php echo  '$'.number_format($myrowasegc['totalIVA']-$myrowasega['totalIVA'],2);?></small></td>
  </tr>
  
  
  
  
  
  <tr>
    <td><small >Total</small></td>
    <td><small ><?php echo  '$'.number_format(($myrowpartc['totalParticular']+$myrowpartc['totalIVA'])-($myrowparta['totalParticular']+$myrowparta['totalIVA']),2);?></small></td>
    <td>&nbsp;</td>
    
    <td><small >Total</small></td>
    <td><small ><?php echo  '$'.number_format(($myrowbenec['totalParticular']+$myrowbenec['totalIVA'])-($myrowbenea['totalParticular']+$myrowbenea['totalIVA']),2);?></small></td>
    <td>&nbsp;</td>
    
    
    
    <td><small >Total</small></td>
    <td><small ><?php echo  '$'.number_format(($myrowasegc['totalAseguradora']+$myrowasegc['totalIVA'])-($myrowasega['totalAseguradora']+$myrowasega['totalIVA']),2);?></small></td>
  </tr>
</table>
  </div>






<p>&nbsp;</p>


  <div class="container"> 
<table width="900" class="table table-striped" style="border: 1px solid #CCC;">

  <tr >
    <th width="76"  ><div align="center"><small>Part</small></div></th>
    <th width="76"  ><div align="center"><small>Aseg</small></div></th>
    <th width="111"  ><div align="center"><small>Regreso Aseg</small></div></th>
    <th width="104"  ><div align="center"><small>Regreso Part</small></div></th>
    <th width="89"  ><div align="center"><small>C1</small></div></th>
    <th width="100"  ><div align="center"><small>C2</small></div></th>
    <th width="95"  ><div align="center"><small>D1</small></div></th>
    <th width="88"  ><div align="center"><small>D2</small></div></th>
    <th width="77"  ><div align="center"><small>Desc Part</small></div></th>
    <th width="84"  ><div align="center"><small>Desc Aseg</small></div></th>
    <th width="84"  ><div align="center"><small>Beneficencia</small></div></th>
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
##CANDADOS 11oct2013    

    
if($u4<1 or $u9<1 or $u11<1){   
echo '$'.number_format($totalParticular,2);
}
?>
</a>
<?php } else{ $u1=1;      
echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';} ?>



      <?php } else { echo '$'.number_format($totalParticular,2);}?>
      <?php } else{$u1=1;?>
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
	  
	  
                  
                  
<?php 
###COMPROBACIONES OBLIGATORIAS 1Oct2013 si no son devoluciones
                  $sql5car= "
                    SELECT *
                    FROM
                    convenios
                    WHERE
                    entidad='".$entidad."'
                        and
                    numCliente =  '".$myrow1d['clientePrincipal']."'
                    AND
                    (departamento='".$myrow1d['almacen']."' or departamento='*')
                    AND
                    tipoConvenio='descuentoConvenio'
                    and
                    ('".$fecha1."'>=fechaInicial and '".$fecha1."'<=fechaFinal)
                    ";
                    $result5car=mysql_db_query($basedatos,$sql5car);
                    $myrow5car= mysql_fetch_array($result5car);
                    
                    if($myrow5car['costo']>0){
if($myrow1d['statusDevolucion']!='si'){

                    $sSQL3a= "
                    SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as totales 
                    From cargosCuentaPaciente 
                    WHERE  entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
                    and tipoTransaccion='".$my6a['codigoTT']."'";
                    $result3a=mysql_db_query($basedatos,$sSQL3a);
                    $myrow3a = mysql_fetch_array($result3a);    
                    if($myrow3a['totales']>0){$descuentoHecho=$myrow3a['totales'];}
                    
                    //echo $totalAseguradora.'  '.$cantidadDescuento.'  '.$descuentoHecho;
                    $descripcionTransaccion=$my6a['descripcion'];
                    $descuentoAseguradora=$my6a['codigoTT'];
                    $cantidadDescuento=($myrow5['costo']*0.01)*$totalAseguradora;
                    //$candadoA=($totalAseguradora-$cantidadDescuento)-$descuentoHecho;
                    $candadoA=$descuentoAseguradora-$descuentoHecho;
                    }
}



?>                  
	  
	  <?php if($totalAseguradora>-1 and $totalAseguradora>0){ ?>
  
            
<?php             
##CANDADOS 11oct2013    

    
if($u3<1 or $u5<1 or $u6<1 or $u7<1 or $u8<1 or $u10<1){   ?>            
<a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;precioVenta=<?php echo $totalAseguradora;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucionAseguradora';}else{ echo 'cxc';} ?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;tipoTransaccion=aseguradora&amp;tipoPago=<?php echo $tipoPago;?>&amp;devolucion=<?php echo $_GET['devolucion'];?>&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','800','380','yes');"> 
<?php    echo '$'.number_format($totalAseguradora,2); ?>
</a>
    <?php }else{
    echo '$'.number_format($totalAseguradora,2);    
    } ?>                 
                  
      <?php } else { $u2=1;  //echo '<img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />';
      }?>





      <?php } else { echo '$'.number_format($totalAseguradora,2);}?>
      <?php } else{?>
      <?php echo '$'.number_format($totalAseguradora,2);?>
      <?php } ?>
      <?php } else{ $u2=1;?>
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
        <?php } else{$u3=1;?>
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
                
                
                
<?php 

##CANDADOS 11oct2013    

    
if($u4<1 or $u9<1 or $u11<1){   ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"></a></span></div>     
        <span >
            
<a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=regreso&amp;precioVenta=<?php echo $tP;?>&amp;modoPago=regresoParticular&amp;tipoTransaccion=particular&amp;tipoPago=regresoParticular&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','400','800','yes');"><blink>
     <div align="center">
     <?php echo '$'.number_format($tP,2);?>
     </div>
      </blink></a>
<?php } ?>        
            
            
      <div align="center">
        <?php } else { echo '$'.number_format($tP,2);}?>
        <?php } else{$u4=1;?>
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
      <?php } else{$u5=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalCoaseguro2>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $coaseguro2;?>&amp;precioVenta=<?php echo $totalCoaseguro2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalCoaseguro2,2);?></a>
      <?php } else { echo '$'.number_format($totalCoaseguro2,2);}?>
      <?php } else{$u6=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible1>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible1;?>&amp;precioVenta=<?php echo $totalDeducible1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg1&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible1,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible1,2);}?>
      <?php } else{$u7=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php if($totalDeducible2>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $deducible2;?>&amp;precioVenta=<?php echo $totalDeducible2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg2&amp;tipoPago=Efectivo&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> <?php echo '$'.number_format($totalDeducible2,2);?></a>
      <?php } else { echo '$'.number_format($totalDeducible2,2);}?>
      <?php } else{$u8=1;?>
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
      <?php } else{$u9=1;?>
      <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />
      <?php } ?>
    </span></div></td>
    
    
    
    
    
    
    <td  ><div align="center"><span >
      <?php
      ##ACTUALIZADO EN 1oct2013 LAS DEVOLUCIONES ESTAN PROHIBIDAS
      ###DESCUENTO SOBRE CONVENIO
      ###FUNCIONA CON LOS EXTERNO
                    //echo $myrow1d['tipoPaciente'];
if($myrow1d['statusDevolucion']!='si'){                    
                    $sql5= "
                    SELECT *
                    FROM
                    convenios
                    WHERE
                    entidad='".$entidad."'
                        and
                    numCliente =  '".$myrow1d['clientePrincipal']."'
                    AND
                    (departamento='".$myrow1d['almacen']."' or departamento='*')
                    AND
                    tipoConvenio='descuentoConvenio'
                    and
                    ('".$fecha1."'>=fechaInicial and '".$fecha1."'<=fechaFinal)
                    ";
                    $result5=mysql_db_query($basedatos,$sql5);
                    $myrow5= mysql_fetch_array($result5);
                    
                    if($myrow5['costo']>0){
                    //$tA total de aseguradora
                    //echo $myrow5['costo'].'  '.$tA;  
                    
                    $s6a= "Select * From catTTCaja WHERE  descuentoAseguradoras='si'  ";
                    $rs6a=mysql_db_query($basedatos,$s6a);
                    $my6a = mysql_fetch_array($rs6a); 
                    
                    
                    $sSQL3a= "
                    SELECT sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as totales 
                    From cargosCuentaPaciente 
                    WHERE  entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' 
                    and tipoTransaccion='".$my6a['codigoTT']."'";
                    $result3a=mysql_db_query($basedatos,$sSQL3a);
                    $myrow3a = mysql_fetch_array($result3a);    
                    if($myrow3a['totales']>0){$descuentoHecho=$myrow3a['totales'];}                    
                    
                    $descripcionTransaccion=$my6a['descripcion'];
                    $descuentoAseguradora=$my6a['codigoTT'];
                    
                    
                    $cantidadDescuento=($myrow5['costo']*0.01)*$totalAseguradora;
                    //$descuentoA=($totalAseguradora-$cantidadDescuento)-$descuentoHecho;
                    $descuentoA=$cantidadDescuento-$descuentoHecho;
                    
}}
      ##############
      ?>
                
                
                
      <?php if($descuentoA>=1){ ?>
      <?php if($mostrar==TRUE){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $keyClientesInternos;?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $folioVENTA;?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $keyClientesInternos;?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $descuentoAseguradora;?>&amp;precioVenta=<?php echo $descuentoA;?>&amp;modoPago=descuentos&amp;tipoPago=descuentos&amp;descuento=aseguradora&descripcionTransaccion=<?php echo $descripcionTransaccion;?>&status=<?php echo $myrow3['status'];?>','ventana7','480','380','yes');"> 
    <?php echo '<span class="precio1"><blink>$'.number_format($descuentoA,2).'</blink></span>';?>
      </a>
      <?php } else { echo '$'.number_format($descuentoA,2);}?>
      <?php } else{$u10=1;?>
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
      <?php } else{$u11=1;?>
     
      <!--aqui va la imagen de que todo esta bien -->           
       <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18" />          
      <?php } ?>
    </span></div></td>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
  </tr>
    
    
    
    
    
    
    
    
    <!--
    <tr>
     
        <td>
            <div align="center">
                <img src="../bt/img/candado.jpeg" width="42" height="42" />
            </div>
        </td>
        
        <td>2</td>    
        
        
        <td>3
          <div align="center">
                <img src="../bt/img/candado.jpeg" width="42" height="42" />
            </div>    
        </td>    
        
        
        <td>4
          <div align="center">
                <img src="../bt/img/candado.jpeg" width="42" height="42" />
            </div>
        </td>    
       
        
        <td>5
        <div align="center">
        <img src="../bt/img/candado.jpeg" width="42" height="42" />
        </div>
        </td>    
        
        
        <td>6
        <div align="center">
        <img src="../bt/img/candado.jpeg" width="42" height="42" />
        </div>
        </td>  
        
        
        <td>7
        <div align="center">
        <img src="../bt/img/candado.jpeg" width="42" height="42" />
        </div>
        </td>    
        
        <td>8
        <div align="center">
        <img src="../bt/img/candado.jpeg" width="42" height="42" />
        </div>
        </td>    
        
        <td>9
        <div align="center">
        <img src="../bt/img/candado.jpeg" width="42" height="42" />
        </div>
        </td>
        
        <td>10
        <div align="center">
        <img src="../bt/img/candado.jpeg" width="42" height="42" />
        </div>
        </td>    
        
        <td>11
        <div align="center">
        <img src="../bt/img/candado.jpeg" width="42" height="42" />
        </div>
        </td>    
        
    </tr>    
    
    -->
    
    
    
    
    
    
    
    
    

</table>
  </div>
      
      
      
<p>&nbsp;</p>
    
    
    
    
<?php     
//CIERRA MOSTRAR EFECTUAR TRANSACCIONES

}



   ?>
  <p align="center">&nbsp;</p>
  <p align="center">

	  </div>      
  </header>  
	
	
<form  method="post" >
	
	
<div align="center">
<?php 
//11 deben ser
$totalElementos= $u1+$u2+$u3+$u4+$u5+$u6+$u7+$u8+$u9+$u10+$u11;
/*
echo $totalParticular;
echo '<br>';
echo $totalAseguradora;
echo '<br>';
echo $tA+$totalAseguradora;
echo '<br>';
echo $tP;
echo '<br>';
echo $totalCoaseguro1;   
echo '<br>';
echo $totalCoaseguro2;
echo '<br>';
echo $totalDeducible1;  
echo '<br>';
echo $totalDeducible2;
echo '<br>';
echo $descuentoP;
echo '<br>';
echo $descuentoA;
echo '<br>';
echo $ben;
echo '<br>';
*/







//*********************************
$TOTAL=sprintf("%01.2f", $TOTAL);
if($tipoPACIENTE=='externo'){
$diferencia=sprintf("%01.2f", $totalParticular)-sprintf("%01.2f", $totalAseguradora);
if($totalElementos==11){ 
?>

  <input type="hidden" name="keyT" id="keyT" value="<?php echo $myrow1['keyT'];?>" />
      <input name="imprimir" type="submit"  id="imprimir" value="Finalizar Transaccion" src="../imagenes/btns/new_print.png" onClick="Disab (2)"/>
      <?php }?>
      </p>
      <?php }else{ ?>
        
      <?php
      
if($totalElementos==11){   ?>
  <input name="cerrar" type="submit" class="normal" id="cerrar" value="Cerrar Cuenta" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas cerrar la cuenta?') == false){return false;}" />
      <?php } ?>
        
      <?php } ?>
        
         <input type="hidden" name="totalCargo" value="<?php echo $totalCargo;?>" />
		          <input type="hidden" name="totalAbono" value="<?php echo $totalAbono;?>" />
      <input type="hidden" name="variable_php" id="variable_php" />
    
    </div>
</form>


      
    
      

    <br>
</body>
</html>
      <?php  }?>

<?php 
}else{//validacion del recibo de caja
    echo '<div class="error">ERROR! NO EXISTE LA RUTA DEL RECIBO DE CAJA!</div>';
    echo '<script>';
    echo 'window.alert("NO EXISTE LA RUTA DEL RECIBO!");';
    echo '</script>';
}

}

}
?>
