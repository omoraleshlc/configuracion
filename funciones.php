<?php

class entradas{
	//******conversion a unidades***********
    
    
    
public function entradaListaInventarios($costo,$numSolicitud,$codigoInv,$flag,$almacen,$fecha1,$hora1,$factura,$usuario,$entidad,$basedatos){
$sSQL3ae= "
	SELECT 
almacen
FROM
almacenes
where
entidad='".$entidad."'
    and
    centroDistribucion='si'  ";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);

if(!$almacen){
	$almacen=$myrow3ae['almacen'];
}

	
$sSQLy= "
SELECT * 
FROM
entradaArticulos
WHERE
entidad='".$entidad."'
and
usuario='".$usuario."'
and
status='standby'

";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){

	for($i=0;$i<$myrowy['cantidad'];$i++){
if($myrowy['tipoMov']=='entrada'){$stat='standby';}
if($myrowy['codigo']!=NULL){
    

$sSQL13= "
SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);      	   

if($costo>0){
$c=$costo;   
}   else{
$c=$myrow13['costo'];
} 



$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,costo,nOrden,numSolicitud)
values
('".$myrowy['codigo']."','".$myrowy['keyPA']."','".$myrowy['gpoProducto']."',1,'".$myrowy['tipoVenta']."','".$entidad."','".$myrowy['tipoMov']."',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrowy['almacen']."','".$factura."','".$myrowy['tipo']."','".$stat."','".$myrow13['costo']."',
'".$myrowy['nOrden']."','".$myrowy['numSolicitud']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//actualizar registros

if($flag=='si'){
//AFECTO KARDEX  *******************************************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    




/*
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad;
}
*/



$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

//******************CUANTO HABIA EN EXISTENCIAS***********
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
//***********************CIERRO EXISTENCIAS***************

  $q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrowy['codigo']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow8ac['keyPA']."','".$almacen."',
        '".$almacen."',
        '".$c."',
        1,1,'".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow8acd['descripcion']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','ENTRADA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX************************************************

}      
}
}


$q1a = "UPDATE entradaArticulos set 
status='registrado'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();

}
	
}    
    
    
    
    
    
    
    
    
    
    
    
    
public function entradaInventarios($costo,$numSolicitud,$codigoInv,$flag,$almacen,$fecha1,$hora1,$factura,$usuario,$entidad,$basedatos){
$sSQL3ae= "
	SELECT 
almacen
FROM
almacenes
where
entidad='".$entidad."'
    and
    centroDistribucion='si'  ";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);

if(!$almacen){
	$almacen=$myrow3ae['almacen'];
}

	
$sSQLy= "
SELECT * 
FROM
entradaArticulos
WHERE
entidad='".$entidad."'
and
usuario='".$usuario."'
and
status='standby'

";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){

	for($i=0;$i<$myrowy['cantidad'];$i++){
if($myrowy['tipoMov']=='entrada'){$stat='ready';}
if($myrowy['codigo']!=NULL){
    

$sSQL13= "
SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);      	   

if($costo>0){
$c=$costo;   
}   else{
$c=$myrow13['costo'];
} 



$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,costo,nOrden,numSolicitud)
values
('".$myrowy['codigo']."','".$myrowy['keyPA']."','".$myrowy['gpoProducto']."',1,'".$myrowy['tipoVenta']."','".$entidad."','".$myrowy['tipoMov']."',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrowy['almacen']."','".$factura."','".$myrowy['tipo']."','".$stat."','".$myrow13['costo']."',
'".$myrowy['nOrden']."','".$myrowy['numSolicitud']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//actualizar registros

if($flag=='si'){
//AFECTO KARDEX  *******************************************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    




/*
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad;
}
*/



$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

//******************CUANTO HABIA EN EXISTENCIAS***********
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
//***********************CIERRO EXISTENCIAS***************


####DEPRECATED#####
  $q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrowy['codigo']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow8ac['keyPA']."','".$almacen."',
        '".$almacen."',
        '".$c."',
        1,1,'".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow8acd['descripcion']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','ENTRADA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

//mysql_db_query($basedatos,$q1ab);
echo mysql_error();

//CIERRO AFECTACION DE KARDEX************************************************

}      
}
}


$q1a = "UPDATE entradaArticulos set 
status='registrado'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();

}
	
}


























}



class ActualizaKardex{
public function updateKardex($usuario,$entidad,$basedatos){
    
    
    
    
    
    
    
    
    
    
$sSQLy2= "
SELECT * 
FROM
kardex
WHERE
entidad='".$entidad."'
and
usuario='".$usuario."'
and
status='standby'  ";


$resulty2=mysql_db_query($basedatos,$sSQLy2);
while($myrowy2 = mysql_fetch_array($resulty2)){    
     $sSQLy= "
SELECT sum(cantidad) as entradas 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy2['kc']."'
    and
tipoMov='entrada' 
and
status='ready'
";


$resulty=mysql_db_query($basedatos,$sSQLy);
$myrowy = mysql_fetch_array($resulty);
    

$sSQLys= "
SELECT sum(cantidad) as salidas 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy2['kc']."'
    and
status='sold'  ";


$resultys=mysql_db_query($basedatos,$sSQLys);
$myrowys = mysql_fetch_array($resultys);
$exis=$myrowy['entradas']-$myrowys['salidas'];

$q1a = "UPDATE kardex set 
existencia='".$exis."',
    status='final'

WHERE

kk='".$myrowy2['kk']."'

";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();
}
}
}


class kardex{    
    public function movimientoskardex($numSolicitud,$io,$cantidad,$descripcionmov,$tipomov,$usuario,$fecha1,$hora1,$almacendestino,$almacensolicitante,$keypa,$codigo,$entidad,$basedatos){

        
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
(keyPA='".$keypa."' or codigo='".$codigo."')
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
if(!$codigo){
    $codigo=$myrow8ac['codigo'];
}



/*
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad;
}
*/



$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

tipoMovimiento='".$tipomov."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);





if(!$myrow8acd['entidad']){
echo '<script>window.alert("NO EXISTEN CONCEPTOS DE INVENTARIOS,FAVOR DE COMUNICAR A SISTEMAS");window.close();</script>';
    
}




$sSQL13= "
SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$codigo."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);

$s="SELECT * 
FROM
gpoProductos
WHERE
codigoGP='".$myrow8ac['gpoProducto']."'
";
$res=mysql_db_query($basedatos,$s);
$mrow = mysql_fetch_array($res);





$sSQLk= "
SELECT almacenConsumo
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$almacensolicitante."'  ";
$resultk=mysql_db_query($basedatos,$sSQLk);
$myrowk = mysql_fetch_array($resultk);



if($mrow['afectaExistencias']=='si'){
    
    
    
    
    
$q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$codigo."','".$myrow8acd['codigo']."','".$myrow8acd['descripcion']."',
    '".$descripcionmov."','".$myrow8acd['naturaleza']."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keypa."','".$almacensolicitante."' ,'".$almacendestino."' ,'".$myrow13['costo']."',
        '".$cantidad."','".$ct."','".$myrow8ac['descripcion']."','','".$myrow8ac1['cantidadTotal']."',
        '".$myrow8acd['otro']."','".$mrow['codigoGP']."','".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','".$io."','".$myrow8ac['cajaCon']."','standby','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
}

    }
    
}





class generarExpedientes{
public function generaExpediente($reservado1,$reservado,$usuario,$entidad,$basedatos){

//$sSQL2= "Select max(numCliente+1) as tope From pacientes where entidad='".$entidad."'  ";
//$result2=mysql_db_query($basedatos,$sSQL2);
//$myrow2 = mysql_fetch_array($result2);
//$torpe = $myrow2['tope'];

$q4 = "
    INSERT INTO contadorExpedientes(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorExpedientes where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'
";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
    
    $sSQL= "SELECT
    contador
    FROM contadorExpedientes
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

if($myrow['contador']){
    return $myrow['contador'];
}else{
    return 1;
}
}
}























class cambiarResponsable{ 
    
    public function recalcularCuenta($tipoPago,$seguro,$usuario,$fecha1,$hora1,$entidad,$keyClientesInternos,$basedatos){

if($tipoPago=='particular'){
    $seguro=NULL;
}
$seguroBack=$seguro;        
        
        //*******************paso 1
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$keyClientesInternos."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);




$q1 = "UPDATE clientesInternos set 
statusCaja='pagado',statusDevolucion='si',
status='cerrada',statusCuenta='cerrada',fechaCierre='".$fecha1."',
    usuarioCierre='".$usuario."',horaCierre='".$hora1."'

WHERE 
 keyClientesInternos='".$keyClientesInternos."'
";

mysql_db_query($basedatos,$q1);
echo mysql_error();






$folioVenta=$myrow3['folioVenta'];
$almacenCierreCuenta=$myrow3['almacen'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************


$keyCAP=$_POST['keyCAP'];
$cantidad=$_POST['cantidad'];


//*********************************************

$sSQL333= "SELECT 
MAX(numSolicitud)+1 as NS
FROM solicitudes
WHERE entidad='".$entidad."'";

$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333); 

if(!$myrow333['NS']){
$myrow333['NS']=1;
}

//********************************SE INCREMENTA EN 1*****************************
$agrega = "INSERT INTO solicitudes (
numSolicitud,usuario,fecha,entidad,keyClientesInternos
) values (
'".$myrow333['NS']."','".$usuario."','".$fecha1."','".$entidad."','".$keyClientesInternos."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//**********************************************












//MODULO II
//MANDe TODO A DeVOLUCIOn
//GENErAR FOLIO DDE VENTA
switch($myrow3['tipoPaciente']){
    case "externo":
    $q4 = "

    INSERT INTO contadorExternos(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorExternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT
    contador
    FROM contadorExternos
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'E'.$myrow['contador'];
    break;



//********************************************************************************************************************************
    case "urgencias":

//contador

$q4 = "
    INSERT INTO contadorInternos(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorInternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'
";
mysql_db_query($basedatos,$q4);
echo mysql_error();

     $sSQL= "SELECT
    contador
    FROM contadorInternos
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'I'.$myrow['contador'];
//******************************
        break;





    case "interno":

//contador

$q4 = "
    INSERT INTO contadorInternos(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorInternos where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'
";
mysql_db_query($basedatos,$q4);
echo mysql_error();

     $sSQL= "SELECT
    contador
    FROM contadorInternos
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $FV= 'I'.$myrow['contador'];
//******************************
        break;
}





    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
$agrega2 = "INSERT INTO clientesInternos (
numeroE,medico,paciente,seguro,autoriza,credencial,fecha,hora,nCuenta,numExtensiones,
deposito,cuarto,statusCuenta,almacen,status,
tipoResponsable,limiteCredito,medicoForaneo,especialidad,dx,
nombreResponsable,apaternoResponsable,amaternoResponsable,direccionResponsable,
telefonoResponsable,ocupacionResponsable,tipoTransaccion,parentescoResponsable,
tipoPaciente,statusDeposito,entidad,usuario,fecha1,
enfermera,
quirurgico,
tipoAccidente,
fechaAccidente,
horaAccidente,
lugarAccidente,
llegoHospital,
ministerio,
motivoConsulta,
alergiaT,
alergiaP,
alergiaR,
alergiaPA,folioVenta,edad,expediente,clientePrincipal,beneficencia
) values (
'".$myrow3['numeroE']."',
'".$_POST['medico']."',
'".strtoupper($myrow3['paciente'])."',
'".$myrow3['seguro']."',
'".$usuario."',
'".$myrow3['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$nCuenta."',
'".$myrow3['numExtensiones']."',
'".$myrow3['deposito']."',


'".$myrow3['cuarto']."',
'revision',
'".$myrow3['almacen']."','abierta',
'".$myrow3['tipoResponsable']."','".$myrow3['limiteCredito']."','".strtoupper($myrow3['medicoForaneo'])."',
'".strtoupper($myrow3['especialidad'])."','".strtoupper($myrow3['dx'])."','".strtoupper($myrow3['nombreResponsable'])."',
'".strtoupper($myrow3['apaternoResponsable'])."','".strtoupper($myrow3['amaternoResponsable'])."','".strtoupper($myrow3['direccionResponsable'])."',
'".$myrow3['telefonoResponsable']."','".strtoupper($myrow3['ocupacionResponsable'])."','".$myrow3['tipoTransaccion']."',
'".strtoupper($myrow3['parentescoResponsable'])."','".$myrow3['tipoPaciente']."','".$$myrow3['statusDeposito']."','".$entidad."','".$usuario."','".$fecha1."',
'".$myrow3['enfermera']."',
'".$myrow3['quirurgico']."',
'".$myrow3['tipoAccidente']."',
'".$myrow3['fechaAccidente']."',
'".$myrow3['horaAccidente']."',
'".$myrow3['lugarAccidente']."',
'".$myrow3['llegoHospital']."',
'".$myrow3['ministerio']."',
'".$myrow3['motivoConsulta']."',
'".$myrow3['alergiaT']."',
'".$myrow3['alergiaP']."',
'".$myrow3['alergiaR']."',
'".$myrow3['alergiaPA']."',
'".$FV."','".$myrow3['edad']."','".$myrow3['expediente']."','".$myrow3['clientePrincipal']."','".$myrow3['beneficencia']."'


)";
mysql_db_query($basedatos,$agrega2);
echo mysql_error();
        
























//**************INSERTO  A COMO ESTABA****************
$sSQL1= "Select * From cargosCuentaPaciente WHERE 
    keyClientesInternos='".$keyClientesInternos."' and gpoProducto!='' ";
$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){ 
$keyCAP[$i]=$myrow1['keyCAP'];
$cantidad[$i]=$myrow1['cantidad'];



 $agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,iva,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,
statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,
almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,
fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,
numeroTransferencia,banderaPC,statusPC,
clientePrincipal,

folioVenta,codigoCaja,numRecibo,numCorte,

statusDevolucion,
keyE,keyPA,numeroConfirmacion,
ivaParticular,ivaAseguradora,tipoVentaArticulos,usuarioFactura,
precioOriginal,ivaOriginal,usuarioDescuento,fechaDescuento,cargoModificable,
gpoProducto,folioDevolucion,numSolicitud,tipoCuenta,numMovimiento,
descripcionArticulo,fechaCargo,horaCargo,usuarioCargo,almacenIngreso,descripcionGrupoProducto,
descripcionClientePrincipal,descripcionMedico,almacenTraspaso,
statusCuenta,cantidadBeneficencia,ivaBeneficencia)
values 
('".$myrow1['numeroE']."','".$myrow1['nCuenta']."','',
'".$usuario."','".$fecha1."','".$dia1."','".$myrow1['cantidad']."','".$myrow1['tipoTransaccion']."',
    '".$myrow1['codProcedimiento']."',
'".$hora1."','".$myrow1['naturaleza']."','".$ID_EJERCICIOM."','','".$myrow1['almacen']."',
    '".$myrow1['usuario']."',
'".$myrow1['precioVenta']."','".$myrow1['iva']."','".$myrow1['seguro']."','".$myrow1['statusTraslado']."',
    '".$myrow1['tipoCliente']."','".$myrow1['tipoPaciente']."',
'".$myrow1['cantidadParticular']."','".$myrow1['cantidadAseguradora']."',
    '".$myrow1['entidad']."','".$myrow1['tipoCobro']."','".$myrow1['statusAuditoria']."'
,'".$myrow1['tipoPago']."','".$myrow1['statusCargo']."','".$myrow1['porcentajeVariable']."',
    '".$myrow1['cargosHospitalarios']."',
    '".$myrow1['almacenSolicitante']."','".$myrow1['almacenDestino']."',
        '',
        'pagado','".$myrow1['descripcion']."','',
        '".$hora1."','".$fecha1."','".$fecha1."','".$myrow1['codigoTarjeta']."',
            '".$myrow1['codigoAutorizacion']."','".$myrow1['numeroCheque']."',
            '".$myrow1['bancoTransferencia']."','".$myrow1['bancoCheque']."',
'".$myrow1['numeroTransferencia']."','".$myrow1['banderaPC']."',
    '".$myrow1['statusPC']."',
    '".$myrow1['clientePrincipal']."',
        '".$FV."',
    '".$myrow1['codigoCaja']."',
        '".$myrow1['numRecibo']."',
            '".$myrow1['numCorte']."',
                '',
                '".$myrow1['keyE']."',
                    '".$myrow1['keyPA']."',
        '".$myrow1['numeroConfirmacion']."','".$myrow1['ivaParticular']."',
            '".$myrow1['ivaAseguradora']."','".$myrow1['tipoVentaArticulos']."',
            '".$myrow1['usuarioFactura']."',
'".$myrow1['precioOriginal']."','".$myrow1['ivaOriginal']."',
    '".$myrow1['usuarioDescuento']."',
    '".$myrow1['fechaDescuento']."','".$myrow1['cargoModificable']."',
        '".$myrow1['gpoProducto']."',
        '',
        '".$myrow333['NS']."' ,'','".$myrow333a['CVI']."' ,
            '".$myrow1['descripcionArticulo']."' ,
'".$fecha1."','".$hora1."','".$usuario."',
    '".$myrow1['almacenIngreso']."','".$myrow1['descripcionGrupoProducto']."',
        '".$myrow1['descripcionClientePrincipal']."',
            '".$myrow1['descripcionMedico']."','".$myrow1['almacenTraspaso']."',
                '".$myrow1['statusCuenta']."',
            '".$myrow1['cantidadBeneficencia']."','".$myrow1['ivaBeneficencia']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*******************************************************************************

}
























$sSQL1= "Select * From cargosCuentaPaciente WHERE keyClientesInternos='".$keyClientesInternos."' and gpoProducto!='' ";
$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){ 
$keyCAP[$i]=$myrow1['keyCAP'];
$cantidad[$i]=$myrow1['cantidad'];

$sSQL8a= "
SELECT *
FROM
faltantes
WHERE
entidad='".$entidad."'
    and

   folioVenta='".$folioVenta."'
       and
       keyPA='".$myrow1['keyPA']."'

";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);
$res=$myrow8a['cantidad']-$cantidad[$i];
//
//
//
//if($myrow8a['status']=='venta' or $myrow8a['status']=='pendiente'){
//**************
//ACTUALIZO EXISTENCIAS Y FALTANTES


$sSQL455s= "Select stock,medicamentosSueltos from almacenes where 
    entidad='".$entidad."' 
        and almacen='".$myrow1['almacenDestino']."' 
            and centroDistribucion!='si'           
";
$result455s=mysql_db_query($basedatos,$sSQL455s);
$myrow455s = mysql_fetch_array($result455s);

if($myrow455s['stock']=='si'){ 

 $q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora."', 
existencia=existencia+'".$cantidad[$i]."',
    cantidadTotal='".$ct."',
razon='".$razon[$i]."'
WHERE 
entidad='".$entidad."'
    AND
keyPA='".$myrow1['keyPA']."' 
AND 
almacen = '".$myrow1['almacenDestino']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();



if($myrow8a['status']=='venta' and ($res<1 or $res>0)){
 $actualiza10 = "DELETE FROM faltantes

WHERE
entidad='".$entidad."'
    and
   folioVenta='".$folioVenta."' 
and
keyPA='".$myrow1['keyPA']."'
and
almacenSolicitante='".$myrow1['almacenDestino']."'

";
mysql_db_query($basedatos,$actualiza10);
echo mysql_error();
}else{
    $actualiza10 = "update faltantes
set
cantidad=cantidad-'".$cantidad[$i]."'

WHERE
entidad='".$entidad."'
    and
   folioVenta='".$folioVenta."' 
and
keyPA='".$myrow1['keyPA']."'
and
almacenSolicitante='".$myrow1['almacenDestino']."'

";
mysql_db_query($basedatos,$actualiza10);
echo mysql_error();
}
}
//**********************************





if($myrow1['statusDevolucion']!='si'){
$agrega = "UPDATE cargosCuentaPaciente set 
status='devolucion',

statusDevolucion='si',
folioDevolucion='".$keyCAP[$i]."'
where
keyCAP='".$keyCAP[$i]."' 
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//*****************************************************************************INSERTAR
//*****************VERIFICA SI ES CARGO DIRECTO***********************
$sSQL3115= "Select cargosDirectos From almacenes WHERE entidad='".$entidad."'
and
almacen='".$myrow1['almacenDestino']."' and almacenPadre='".$myrow1['almacen']."'";
$result3115=mysql_db_query($basedatos,$sSQL3115);
$myrow3115 = mysql_fetch_array($result3115);

if($myrow3115['cargosDirectos']=='si' or $myrow['statusCargo']=='cargadoR'){
$statusCargo='cargado';
}else {
$statusCargo='standby';
}






//*************************GENERAR NUMERO DE TRANSACCION***********************

$sSQL333a= "SELECT 
MAX(keyCVI)+1 as CVI
FROM contadorVentasInternas
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a); 

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}

//********************************SE INCREMENTA EN 1*****************************
$agrega = "INSERT INTO contadorVentasInternas (
usuario,entidad
) values (
'".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega1 = "INSERT INTO transaccionesVentas (
numTransaccion,keyCAP,cantidad,descripcionArticulo,precioVenta,iva,cantidadParticular,ivaParticular,cantidadAseguradora,ivaAseguradora,usuario,hora,fecha,entidad,keyClientesInternos,folioVenta,almacen,status
) values (
'".$myrow333a['CVI']."','".$myrow1['keyCAP']."','".$myrow1['cantidad']."','".$myrow1['descripcionArticulo']."','".$myrow1['precioVenta']."','".$myrow1['iva']."','".$myrow1['cantidadParticular']."',
'".$myrow1['ivaParticular']."','".$myrow1['cantidadAseguradora']."','".$myrow1['ivaAseguradora']."','".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow1['keyClientesInternos']."',
'".$myrow1['folioVenta']."','".$myrow1['almacen']."','standby'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
//***************************************************



$karticulos=new kardex();
$karticulos-> movimientoskardex($myrow1['cantidad'],'DEVOLUCION POR RECALCULAR CUENTA','devolucion',$usuario,$fecha1,$hora1,$myrow1['almacenSolicitante'],$myrow1['almacenDestino'],$myrow1['keyPA'],$myrow1['codProcedimimento'],$entidad,$basedatos);









 $agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,iva,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,
statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,
almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,horaSolicitud,
fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,bancoCheque,
numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,numRecibo,numCorte,
statusDevolucion,keyE,keyPA,numeroConfirmacion,
ivaParticular,ivaAseguradora,tipoVentaArticulos,usuarioFactura,
precioOriginal,ivaOriginal,usuarioDescuento,fechaDescuento,cargoModificable,gpoProducto,folioDevolucion,numSolicitud,tipoCuenta,numMovimiento,
descripcionArticulo,fechaCargo,horaCargo,usuarioCargo,almacenIngreso,descripcionGrupoProducto,descripcionClientePrincipal,descripcionMedico,almacenTraspaso,
statusCuenta,cantidadBeneficencia,ivaBeneficencia,fechaCierre)
values 
('".$myrow1['numeroE']."','".$myrow1['nCuenta']."','devolucion',
'".$usuario."','".$fecha1."','".$dia1."','".$cantidad[$i]."','".$myrow1['tipoTransaccion']."','".$myrow1['codProcedimiento']."',
'".$hora1."','A','".$ID_EJERCICIOM."','','".$myrow1['almacen']."','".$usuario."',
'".$myrow1['precioVenta']."','".$myrow1['iva']."','".$myrow1['seguro']."','standby','".$myrow1['tipoCliente']."','".$myrow1['tipoPaciente']."',
'".$myrow1['cantidadParticular']."','".$myrow1['cantidadAseguradora']."','".$myrow1['entidad']."','".$myrow1['tipoCobro']."','".$myrow1['statusAuditoria']."'
,'".$myrow1['tipoPago']."','cargado','".$myrow1['porcentajeVariable']."','".$myrow1['cargosHospitalarios']."',
    '".$myrow1['almacenSolicitante']."','".$myrow1['almacenDestino']."','".$myrow1['keyClientesInternos']."','pagado','".$myrow1['descripcion']."','',
        '".$hora1."','".$fecha1."','".$fecha1."','".$myrow1['codigoTarjeta']."','".$myrow1['codigoAutorizacion']."','".$myrow1['numeroCheque']."',
            '".$myrow1['bancoTransferencia']."','".$myrow1['bancoCheque']."',
'".$myrow1['numeroTransferencia']."','".$myrow1['banderaPC']."','".$myrow1['statusPC']."','".$myrow1['clientePrincipal']."','".$myrow1['folioVenta']."',
    '".$myrow1['codigoCaja']."','".$myrow1['numRecibo']."','".$myrow1['numCorte']."','si','".$myrow1['keyE']."','".$myrow1['keyPA']."',
        '".$myrow1['numeroConfirmacion']."','".$myrow1['ivaParticular']."','".$myrow1['ivaAseguradora']."','".$myrow1['tipoVentaArticulos']."',
            '".$myrow1['usuarioFactura']."',
'".$myrow1['precioOriginal']."','".$myrow1['ivaOriginal']."','".$myrow1['usuarioDescuento']."',
    '".$myrow1['fechaDescuento']."','".$myrow1['cargoModificable']."','".$myrow1['gpoProducto']."',
        '".$myrow1['keyCAP']."','".$myrow333['NS']."' ,'H','".$myrow333a['CVI']."' ,'".$myrow1['descripcionArticulo']."' ,
'".$fecha1."','".$hora1."','".$usuario."',
    '".$myrow1['almacenIngreso']."','".$myrow1['descripcionGrupoProducto']."',
        '".$myrow1['descripcionClientePrincipal']."','".$myrow1['descripcionMedico']."','".$myrow1['almacenTraspaso']."','cerrada',
            '".$myrow1['cantidadBeneficencia']."','".$myrow1['ivaBeneficencia']."','".$fecha1."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*******************************************************************************
//}cierro faltantes
}

}//cierra while
//**********************************************************************




































$seguro=$seguroBack;

$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$FV."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();



//ACtuaLIZAR MOVIMIENTOS****************
$q1a = "UPDATE cargosCuentaPaciente set 
folioVenta='".$FV."',
    keyClientesInternos='".$myrow1['keyClientesInternos']."'
WHERE 
keyClientesInternos='".$keyClientesInternos."'  ";
mysql_db_query($basedatos,$q1a);
echo mysql_error();
//****************************************







//ACTUALIZO KEYCLIENTESINTERNOS EN CARGOSCUENTAPCIENTE
//$q = "UPDATE cargosCuentaPaciente set 
//keyClientesInternos
//WHERE 
//entidad='".$entidad."'
//    and
//    folioVenta='".$FV."'
//        and
//keyCAP='".$myrow1['keyCAP']."'  ";
//
////***********ACTUALIZA SCRIPT CCP*************
//mysql_db_query($basedatos,$q);
//echo mysql_error();
//******************************************************


//***********PRIMERAS BANDERAS*********
$numeroE=       $myrow1['numeroE'];
$nCuenta=       $myrow1['nCuenta'];
//*************************************





//************DECLARAMOS CLASES*********
$iva=new articulosDetalles();
$ivaParticular=new ivaCierre();
$ivaAseguradora=new ivaCierre();
$formaVenta=new ivaCierre();
$precioVenta=new articulosDetalles();
$convenios=      new validaConvenios();
$global=         new validaConvenios();
$tipoConvenioS=  new validaConvenios();
$traeConvenio=   new validaConvenios();
$vConvenio=      new validaConvenios();
$verificaSaldos1=new verificaSeguro1();
$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();
$validaJubilados=new validaConvenios();
$porcentajeJubilados=new validaConvenios();
$ivaAseguradora=new ivaCierre();
$ivaParticular=new ivaCierre();
//**************************************

//*****************ACTUALIZO ENCABEZADOS PRIMERO********************
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($seguro){
  $q1 = "UPDATE clientesInternos set 
statusCuenta='abierta',status='activa',
seguro='".$seguro."',
clientePrincipal='".trim($myrow455['clientePrincipal'])."',
tipoResponsable='Empresa'

WHERE 
entidad='".$entidad."'
    and
 folioVenta='".$FV."'
";

mysql_db_query($basedatos,$q1);
echo mysql_error();
}else{

$q1 = "UPDATE clientesInternos set 
statusCuenta='abierta',status='activa',
seguro='',
clientePrincipal='',
tipoResponsable='Familiar'

WHERE 
entidad='".$entidad."'
    and
 folioVenta='".$FV."'
";



mysql_db_query($basedatos,$q1);
echo mysql_error();


}

//******************************************************************























$sSQL1c= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$FV."'";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);
echo mysql_error();
$seguro=$myrow1c['seguro'];

//********************ACTUALIZO PRECIOS********************
//trae todos los movimientos
$sSQL1= "Select * From cargosCuentaPaciente WHERE 
    entidad='".$entidad."'
        and
folioVenta='".$FV."' and gpoProducto!='' ";

//$sSQL1="select * from cargosCuentaPaciente where keyCAP='52804'";
//$sSQL1= "Select * From cargosCuentaPaciente WHERE keyCAP='103586'";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

//******LISTADO DE BANDERAS*******************************************************
$cLlave=new articulosDetalles();                                               //*
$keyPA=$cLlave->codigollave($entidad,$myrow1['codProcedimiento'],$basedatos);  //*  
$codigo=     $myrow1['codProcedimiento'];                                      //*
$almacen=    $myrow1['almacen'];                                               //*
$cantidad=   $myrow1['cantidad'];                                              //*
//********************************************************************************
$sSQL40= "
SELECT gpoProducto
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


$sSQL40b= "
SELECT descripcion
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'";
$result40b=mysql_db_query($basedatos,$sSQL40b);
$myrow40b = mysql_fetch_array($result40b);
$descripcionArticulo=$myrow40b['descripcion'];

$gpoProducto=$myrow40['gpoProducto'];

//***********actualiza******************
$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($paquete,$_POST['generico'],$cantidad[$i],$numeroE,$myrow1c['keyClientesInternos'],$codigo,$almacen,$basedatos);



if($myrow1['cargoModificable']=='si'){

$priceLevel=$myrow1['precioVenta'];
}




$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);



// son jubilados y trae seguro?
if($seguro){ 
if($validaJubilados->validacionJubilados($numeroE,$seguro,$entidad,$basedatos)=='si'){

 $percent=$porcentajeJubilados->porcentajeJubilados($numeroE,$seguro,$entidad,$basedatos);
$percent*=0.01;

if($percent){
$cantidadAseguradora=$priceLevel*$percent;
$cantidadParticular=$priceLevel-$cantidadAseguradora;
$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
}else{
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);

}
//$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;

} else {

if($tipoConvenio=='cantidad'){  
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora;
$priceLevel=$acumulado;
 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$priceLevel,$basedatos); 
} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$cantidadAseguradora-$priceLevel;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='global'){ 
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$priceLevel-$cantidadAseguradora;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='precioEspecial'){


$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadAseguradora=NULL;
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else { 
$cantidadParticular=NULL;
$ivaParticulart=NULL;
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos);  //iva total
}

}
} else {//solamente abre cuando trae seguro
$cantidadParticular=$priceLevel;
$ivaParticulart=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos);  //iva total
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
}




if($acumuladoGlobal>$priceLevel){
$acumulado=$priceLevel;
} else {
$acumulado=$priceLevel;
}





$formaVenta->formaVenta($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos);
if($myrow1['cargoModificable']!='si'){ 
if($seguro){
$q = "UPDATE cargosCuentaPaciente set 
gpoProducto='".$gpoProducto."',
tipoCliente='aseguradora',
precioVenta='".$cantidadAseguradora."'+'".$cantidadParticular."',
seguro='".$seguro."',
iva='".$ivaAseguradorat."'+'".$ivaParticulart."',
cantidadParticular='".$cantidadParticular."',
cantidadAseguradora='".$cantidadAseguradora."',
ivaParticular='".$ivaParticulart."',
ivaAseguradora='".$ivaAseguradorat."',
clientePrincipal='".trim($myrow455['clientePrincipal'])."',
descripcionArticulo='".$descripcionArticulo."'
WHERE 
keyCAP='".$myrow1['keyCAP']."'


";

} else {
$q = "UPDATE cargosCuentaPaciente set 
descripcionArticulo='".$descripcionArticulo."',
gpoProducto='".$gpoProducto."',
precioVenta='".$priceLevel."',
seguro='".$seguro."',
iva='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."',
tipoCliente='particular',
cantidadParticular='".$priceLevel."',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
clientePrincipal=NULL,
ivaParticular='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."'
WHERE 
keyCAP='".$myrow1['keyCAP']."'

";
//echo '<br>'.$q;

}

















} else{//----------comparo el precio modificable
if($seguro){
$q = "UPDATE cargosCuentaPaciente set 
gpoProducto='".$gpoProducto."',
tipoCliente='aseguradora',
precioVenta='".$cantidadAseguradora."'+'".$cantidadParticular."',
seguro='".$seguro."',
iva='".$ivaAseguradorat."'+'".$ivaParticulart."',
cantidadParticular='".$cantidadParticular."',
cantidadAseguradora='".$cantidadAseguradora."',
ivaParticular='".$ivaParticulart."',
ivaAseguradora='".$ivaAseguradorat."',
clientePrincipal='".$myrow455['clientePrincipal']."'

WHERE 
keyCAP='".$myrow1['keyCAP']."'


";

} else {
$q = "UPDATE cargosCuentaPaciente set 
gpoProducto='".$gpoProducto."',
precioVenta='".$priceLevel."',
seguro='".$seguro."',
iva='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."',
tipoCliente='particular',
cantidadParticular='".$priceLevel."',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
clientePrincipal=NULL,
ivaParticular='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."'
WHERE 
keyCAP='".$myrow1['keyCAP']."'  ";

}

}



//***********ACTUALIZA SCRIPT CCP*************
mysql_db_query($basedatos,$q);
echo mysql_error();
//********************************************


}//cierra while



































    }
}






























class whoisCendis{
public function cendis($entidad,$basedatos){

$sSQL40= "SELECT almacen
FROM
almacenes
where 
entidad='".$entidad."'
and
centroDistribucion='si'  ";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
//return $myrow40['maquilado'];
return $myrow40['almacen'];

}

}









class almacenesIngreso{


public function almacenIngreso($gpoProducto,$entidad,$basedatos){

$sSQL40= "SELECT tipoReporte
FROM
gpoProductos
where 
codigoGP='".$gpoProducto."'  ";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
//return $myrow40['maquilado'];
return $myrow40['tipoReporte'];

}

}









function cantidadUM($um,$basedatos){
if($um!="pz" and $um!="PZ"){
$sSQL29= "Select distinct * From umVentas,unidadMedida 
 where
unidadMedida.codigoUM='".$um."' and
 unidadMedida.codigoUM=umVentas.id_um

";
$result29=mysql_db_query($basedatos,$sSQL29);
$myrow29 = mysql_fetch_array($result29);
return $myrow29['unidades']='pz';
}
}



function porcentaje($cantidad,$porciento,$decimales){
return $cantidad*$porciento/100;
}





function insertarRegistros($codigo,$id_almacen,$cantidad,$fecha1,$ID_EJERCICIOM,$usuario,$basedatos){
$sSQL21= "Select * From razones WHERE codRazon ='9B'";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);
$ctaContable=$myrow21['cuentaContable'];
$conceptoRazon=$myrow21['tipoCuenta'];

//inserto el registro del tipo de movimientos entre almacenes (LOGS)

if($ctaContable){
$agregaSaldo = "INSERT INTO registrosAlmacenes ( codigo,concepto,id_razon,ctaContable,ID_EJERCICIO,usuario,fecha,id_almacen,naturaleza,cantidad,tipo_transaccion,cargo
) values ('".$codigo."','cargo','".$ctaContable."','".$ctaContable."','".$ID_EJERCICIOM."',
'".$usuario."','".$fecha1."','".$id_almacen."','C','".$cantidad."','salida','cxp'
)";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
} else {
echo "no se pudo insertar el registro correspondiente";
}
}










function centroCostoAlmacen($almacen,$basedatos){
$sSQL18= "
SELECT *
FROM
almacenes
WHERE

almacen='".$almacen."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
return $myrow18['ID_CCOSTO'];
}
 
function centroCosto($medico,$basedatos){
$sSQL18= "
SELECT *
FROM
medicos
WHERE
numMedico='".$medico."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
return $ctoCosto=$myrow18['ctaContable'];
}

function ctaMayor($code,$basedatos){
$sSQL8= "
SELECT *
FROM
articulos
WHERE
codigo='".$code."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
return $ctaMayor=$myrow8['ctaMayor'];
}





function costoHospital($entidad,$codigo,$basedatos){
$sSQL13= "
SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$codigo."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);

return $myrow13['costo'];
}










function porcentajeCXC($porcentajeCXC,$code,$almacen,$gpoProducto,$seguro,$basedatos){

//********************Empiezan validaciones***********

$sSQL9= "
SELECT *
FROM
articulos
WHERE
codigo='".$code."'
";
$result9=mysql_db_query($basedatos,$sSQL9);
$myrow9 = mysql_fetch_array($result9);

$grupo=$myrow9['gpoProducto'];


$sSQL13= "
SELECT *
FROM
articulosPrecioNivel
WHERE
codigo='".$code."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
$nivel3=$myrow13['nivel3'];
echo mysql_error();

if($seguro){

//************************cierro precio level*************Si trae seguro siempre necesitamos que las fechas coincidan
$sSQL19= "
SELECT *
FROM
conveniosxPorcentaje
WHERE
numCliente='".$seguro."' and
gpoProducto='".$gpoProducto."' 
and
(almacen='".$almacen."' or almacen='*')

";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19 = mysql_fetch_array($result19);//fechasssssssssssss
//$fechaI9=$myrow19['fechaInicial'];
//$fechaF9=$myrow19['fechaFinal'];
$sSQL18= "
SELECT *
FROM
conveniosxCantidad
WHERE
numCliente='".$seguro."' and
codigo='".$code."' 
and
(almacen='".$almacen."' or almacen='*')

";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
//$fechaI='2006-01-07';
//$fechaF='2009-01-07';

//$fechaI8=$myrow18['fechaInicial'];
//$fechaF8=$myrow18['fechaFinal'];

if($myrow19['fechaInicial'] AND $myrow19['fechaInicial']){
$fechaI=$myrow19['fechaInicial'];
$fechaF=$myrow19['fechaFinal'];
} else if($myrow18['fechaInicial'] AND $myrow18['fechaInicial']){
$fechaI=$myrow18['fechaInicial'];
$fechaF=$myrow18['fechaFinal'];
} 

//********************************Saco fechas******************

$sSQL15= "
SELECT *
FROM
conveniosxCantidad,clientes
WHERE
conveniosxCantidad.codigo='".$code."' and
conveniosxCantidad.numCliente='".$seguro."' and
conveniosxCantidad.numCliente=clientes.numCliente
and
conveniosxCantidad.fechaFinal <= '".$fechaF."'
and
conveniosxCantidad.fechaInicial >= '".$fechaI."' and
(conveniosxCantidad.almacen='".$almacen."' or conveniosxCantidad.almacen='*')
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas
$cantidad=$myrow15['cantidad'];
echo mysql_error();




if($cantidad){
return $precioLevel-$cantidad;
} else if($porcentaje){
$porcentajeCXC=$porcentaje= $nivel3*$porcentaje;

return $porcentajeCXC;


} else {
//return $precioLevel=$myrow13['nivel3'];
}
} else {
	//no trae seguro

	// return $precioLevel=$myrow13['nivel1'];

	}

}//cierra funcion














//////////////////////////////////////////////////// 
//Convierte fecha de mysql a normal 
//////////////////////////////////////////////////// 
function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 

//////////////////////////////////////////////////// 
//Convierte fecha de normal a mysql 
//////////////////////////////////////////////////// 

function cambia_a_mysql($fecha){ 
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    return $lafecha; 
}



function cambia_a_medicos($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[1]."-".$mifecha[3]."-".$mifecha[2]; 
    return $lafecha; 
}











//***************************comienzan clases**************
class rutaReportes{
public function sacoRuta($numeroE,$keyCAP,$departamento,$ruta,$basedatos){ 
if($ruta){
if($departamento=='HCEX' or $departamento=='hcex'){
$i='0';
} else if($departamento=='HLAB' or $departamento=='hlab'){
$i='1';
} else if($departamento=='HRX' or $departamento=='hrx'){
$i='2';
}

switch ($i) {
    case 0:
        $pagina=$ruta;
        break;
    case 1:
        $pagina=$ruta;
        break;
	case 2:
        $pagina=$ruta;
        break;

}

?>

<a href="#" onClick="javascript:ventanaSecundaria('<?php echo $pagina;?>?numeroExpediente=<?php echo $numeroE; ?>
&amp;departamento=<?php echo $departamento; ?>&amp;keyCAP=<?php echo $keyCAP; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>')">
<?php echo $departamento;?>
</a>		
<?php 
} else {
echo '---';
}
}
}

?>


<?php 
class existencias{


public function informacionExistencias($tipoPaciente,$entidad,$codigo,$almacen,$usuario,$fecha,$basedatos){
//EL ALMACEN PUEDE TENER SUS EXISTENCIAS EN OTRO LUGAR
    

    if($almacen!=NULL){
    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacen."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){    
 $almacen=$myrow29p['almacenExistencias'];    
}













    
//ENtRADAS
  $sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    almacen='".$almacen."'
and
status='ready'
";
  
  
  
  
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

//SALIDAS DEPRECATED
/*
  $sSQL8ac1s= "
SELECT sum(cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    status='sold'
    and
    almacen='".$almacen."'

";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
*/

$existencia=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];















if($myrow29p['stock']=='si'){

//aqui va reorden
    if(($existencia)>0){
    
    
    return $myrow8ac1e['entrada']-$myrow8ac1s['salida'];
    
    }else{

        
        
    if($existencia==0){
    echo '</br>';

    echo '<style>';
    echo '.informativo {text-decoration: blink; text-align: center}';
    echo '</style>';
    echo '<blink>';
    echo '<span class="informativo"><br>Error: No hay existencias '.'</br>'.$myrow29a['descripcion'].'</span>';
    echo '</blink>';
    echo '<br>';
    return FALSE;
    }else{
          echo '</br>';

    echo '<style>';
    echo '.informativo {text-decoration: blink; text-align: center}';
    echo '</style>';
    echo '<blink>';
    echo '<span class="informativo"><br>Error: La cantidad es menor, favor de ajustar!: '.'</br>'.$existencia.'</span>';
    echo '</blink>';
    echo '<br>';  
    }
    }



}else{
return 'exento';
}
    }else{
         echo '<style>';
    echo '.informativo {text-decoration: blink; text-align: center}';
    echo '</style>';
    echo '<blink>';
    echo '<span class="informativo"><br>Error: No esta definido el almacen...</span>';
    echo '</blink>';
    echo '<br>';
    return FALSE;
    }

}





































public function informacionExistenciasCantidad($entidad,$codigo,$almacen,$usuario,$fecha,$basedatos){
    
    
        $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacen."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){
    
 $almacen=$myrow29p['almacenExistencias'];

    
}
    
    
    $sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    almacen='".$almacen."'
    and
status='ready'
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

//SALIDAS DEPRECATED
/*
    $sSQL8ac1s= "
SELECT sum(cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    status='sold'
    and
    almacen='".$almacen."'

";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
 * */

$existencia=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];


if($existencia>0){
return $existencia;
}
}









public function solicitudAjusteExistencias($entidad,$gpoProducto,$cantidad,$codigo,$almacen,$usuario,$fecha,$error,$basedatos){
$fecha1=date("Y-m-d");
$hora1=date("H:i:s");
if($codigo!=NULL){





    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacen."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){
    
    $almacen=$myrow29p['almacenExistencias'];
    
}





if($myrow29p['stock']=='si'){
    
    
//VERIFICAR SI ES A GRANEL    
    $sSQLy3= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
and
almacen='".$almacen."'

";


$resulty3=mysql_db_query($basedatos,$sSQLy3);
$myrowy3 = mysql_fetch_array($resulty3);

if($myrowy3['ventaGranel']=='si' and $myrowy3['cantidadSurtir']>0){
   //ENtRADAS
    $sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and

    almacen='".$almacen."'
     and
status='ready'
        
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

//SALIDAS DEPRECATED
/*
    $sSQL8ac1s= "
SELECT sum(cantidad) as salida
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    status='sold'
    and
    almacen='".$almacen."'

";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s); 
*/
}else{
//ENtRADAS
    $sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    almacen='".$almacen."'
     and
status='ready'
        
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

//SALIDAS DEPRECATED
/*
    $sSQL8ac1s= "
SELECT sum(cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    status='sold'
    and
    almacen='".$almacen."'

";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
 * 
 */
}

 $sSQL29= "SELECT descripcion,keyPA,gpoProducto
FROM
articulos
where
entidad='".$entidad."'
and
codigo='".$codigo."'

";
$result29=mysql_db_query($basedatos,$sSQL29);
$myrow29 = mysql_fetch_array($result29);

$existencia=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];




if($existencia>=$cantidad){//SI SE PUEDe CARGAr DEVUELVO NULL
//$agrega = "INSERT INTO articulosExistencias (
//codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen)
//values
//('".$codigo."','".$myrow29['keyPA']."','".$myrow29['gpoProducto']."','".$cantidad."','','".$entidad."','salida',
//    '".$fecha1."','".$hora1."','".$usuario."','".$almacen."')";
//mysql_db_query($basedatos,$agrega);
//echo mysql_error();
} else {
$error='faked';



echo '<style>';
echo '.informativo {text-decoration: blink; text-align: center}';
echo '</style>';
echo '<blink>';
echo '<span class="informativo">Error: No hay existencias  del'.'</br>'.$myrow29['descripcion'].'</span>';
echo '</blink>';
return $error;
}
}
}//validacion de codigo
}










public function ajusteExistencias($flag,$codigoInv,$numSolicitud,$folioVenta,$keyClientesInternos,$almacenSolicitante,$keyCAP,$entidad,$gpoProducto,$cantidad,$codigo,$almacen,$usuario,$fecha,$error,$basedatos){
$fecha1=date("Y-m-d");
$hora1=date("H:i:s");





if($codigo!=NULL){
//********************************    

    
    $sSQL29= "SELECT *
FROM
articulos
where
entidad='".$entidad."'
and
codigo='".$codigo."'

";
$result29=mysql_db_query($basedatos,$sSQL29);
$myrow29 = mysql_fetch_array($result29);
$keypa=$myrow29['keyPA'];
 $sSQL29g= "SELECT *
FROM
gpoProductos
where
codigoGP='".$gpoProducto."'

";
$result29g=mysql_db_query($basedatos,$sSQL29g);
$myrow29g = mysql_fetch_array($result29g);
//*****************************************

    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacen."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);
$almacenOrigen=$almacen;

if($myrow29p['almacenExistencias']!=NULL){ 
  
    $almacen=$myrow29p['almacenExistencias'];    
}


//**************
//quien es el centro de distribucion?
    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
centroDistribucion='si'

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

//**************
//quien es el centro de distribucion?
    $sSQL29ps= "SELECT almacen
FROM
almacenes
where
entidad='".$entidad."'
and
farmacia='si'

";
$result29ps=mysql_db_query($basedatos,$sSQL29ps);
$myrow29ps = mysql_fetch_array($result29ps);
$alFarmacia=$myrow29ps['almacen'];

//*************************






if($almacen!=$myrow29p['almacen'] or $almacenOrigen==$alFarmacia){




if($myrow29g['afectaExistencias']=='si'){


    
    
    
    //VERIFICAR SI ES A GRANEL    
 $sSQLy3= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
and
almacen='".$almacen."'

";


$resulty3=mysql_db_query($basedatos,$sSQLy3);
$myrowy3 = mysql_fetch_array($resulty3);

//ENtRADAS
    $sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and

    almacen='".$almacen."'
        and
        status='ready'

";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

//SALIDAS DEPRECATED
/*
$sSQL8ac1s= "
SELECT sum(cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
    and
    status='sold'
    and
    almacen='".$almacen."'
      
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
 * 
 */








$existencia=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];



if($existencia>=$cantidad){
	
//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$codigo."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);			
		
	

//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA***********
//QUIEN SALE?
  
  
  
    
 $sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
and

    
    almacen='".$almacen."'
    and
status='ready' 
order by keyAE ASC";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$i+=1;				
			
		
	



if($i<=$cantidad){
    

    
if($flag=='si'){    
//AFECTO KARDEX  *******************************************
    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
if(!$codigo){
    $codigo=$myrow8ac['codigo'];
}




if($myrow8ac['cajaCon']>0){
    $ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad;
}




$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

//******************CUANTO HABIA EN EXISTENCIAS***********
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
//***********************CIERRO EXISTENCIAS***************

#######DEPRECATED
$q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrowy['codigo']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow8ac['keyPA']."','".$almacen."',
        '".$almacen."',
        '".$myrowy['costo']."',
        '".$cantidad."','".$ct."','".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$mrow['codigoGP']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','salida',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

//mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX************************************************    
}    
    
$q1a = "UPDATE articulosExistencias set 
status='sold',numSolicitud='".$numSolicitud."',keyCAP='".$keyCAP."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	

//DEPRECATED
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,
keyClientesInternos,folioVenta,costo,keyAEVenta,tipo,factura,status)
values
('".$codigo."','".$myrow29['keyPA']."','".$gpoProducto."','1','".$myrow['tipoVenta']."','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$almacen."','".$keyClientesInternos."',
        '".$folioVenta."','".$myrow3ac['costo']."','".$myrowy['keyAE']."','".$myrowy['tipo']."',
'".$myrowy['factura']."','sold'	)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();


/*
//AFECTO EL KARDEX DEPRECATED
$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE
tipoMovimiento='".$myrowy['tipo']."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);



if(!$myrow8acd['naturaleza'])$myrow8acd['naturaleza']='A';
if(!$myrow8acd['descripcion'])$myrow8acd['descripcion']='SALIDA';
if(!$myrow8acd['codigo'])$myrow8acd['codigo']='02';
if(!$myrow8acd['descripcionEvento'])$myrow8acd['descripcionEvento']='SALIDA POR VENTA';
if(!$myrowy['tipo'])$myrowy['tipo']='Normal';


$q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,almacenConsumo,io,cajaCon,status)
values
('".$myrowy['codigo']."','".$myrow8acd['codigo']."','".$myrow8acd['descripcion']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keypa."','".$almacenSolicitante."' ,'".$almacenOrigen."' ,'".$myrow3ac['costo']."',
        '1','".$ct."','".$myrow29['descripcion']."','".$existencia."','".$myrow8ac1['cantidadTotal']."',
        '".$myrow8acd['otro']."','".$myrow29['gpoProducto']."','".$myrowy['tipo']."','".$myrowk['almacenConsumo']."','salida','".$myrow29['cajaCon']."',
            'standby'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//*******************CIERRA KARDEX********************
*/
}
}

//***************************************************






} else {
$error='faked';
//echo $leyenda="No tienes suficiente stock para cargar la cantidad que solicitas..."; 


echo '<style>';
echo '.normal {text-decoration: blink; text-align: center}';
echo '</style>';
echo '<blink>';
echo '<span class="informativo">Error: No hay existencias '.'</br>'.$myrow29['descripcion'].'</span>';
echo '</blink>';
return $error;
}
}
}else{
//HAY AJUSTE DE EXISTENCIAS EN CENDIS			
	
//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA***********
//QUIEN SALE?
 $sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
and
   
    almacen='".$myrow29p['almacen']."'
    and
status='ready' 


order by keyAE ASC
 ";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$i+=1;				
			
		
	



if($i<=$cantidad){
if($flag=='si'){    
//AFECTO KARDEX  *******************************************
    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    





if($myrow8ac['cajaCon']>0){
    $ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad;
}




$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

//******************CUANTO HABIA EN EXISTENCIAS***********
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
//***********************CIERRO EXISTENCIAS***************

####DEPRECATED
$q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrowy['codigo']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$keypa."','".$almacen."',
        '".$almacen."',
        '".$myrowy['costo']."',
        '".$cantidad."','".$ct."','".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$mrow['codigoGP']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','salida',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

//mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX************************************************    
}        
    
    
    
$q1a = "UPDATE articulosExistencias set 
status='sold',numSolicitud='".$numSolicitud."',keyCAP='".$keyCAP."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	



/*
//AFECTO EL KARDEX
$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE
tipoMovimiento='".$myrowy['tipo']."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);


if(!$myrow8acd['naturaleza'])$myrow8acd['naturaleza']='A';
if(!$myrow8acd['descripcion'])$myrow8acd['descripcion']='SALIDA';
if(!$myrow8acd['codigo'])$myrow8acd['codigo']='02';
if(!$myrow8acd['descripcionEvento'])$myrow8acd['descripcionEvento']='SALIDA POR VENTA';
if(!$myrowy['tipo'])$myrowy['tipo']='Normal';


$q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,almacenConsumo,io)
values
('".$myrowy['codigo']."','".$myrow8acd['codigo']."','".$myrow8acd['descripcion']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keypa."','".$almacenSolicitante."' ,'".$almacenOrigen."' ,'".$myrow3ac['costo']."',
        '1','".$ct."','".$myrow29['descripcion']."','".$existencia."','".$myrow8ac1['cantidadTotal']."',
        '".$myrow8acd['otro']."','".$myrow29['gpoProducto']."','".$myrowy['tipo']."','".$myrowk['almacenConsumo']."','salida'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();*/
//*******************CIERRA KARDEX********************


//DEPRECATED
$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,keyClientesInternos,folioVenta,costo,keyAEVenta,tipo,factura,status)
values
('".$codigo."','".$myrow29['keyPA']."','".$gpoProducto."','1','".$myrow['tipoVenta']."','".$entidad."','salida',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow29p['almacen']."','".$keyClientesInternos."','".$folioVenta."','".$myrow3ac['costo']."','".$myrowy['keyAE']."','".$myrowy['tipo']."',
'".$myrowy['factura']."','sold')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();	
	}//cierra i
	}//cierra while
	}//cierra validacion de almacen de HALM
}
}
}



































class pacientes{

public function devuelveCuarto($numeroE,$nCuenta,$basedatos){
$SQL= "SELECT cuarto
FROM
clientesInternos
where 
numeroE='".$numeroE."' and nCuenta='".$nCuenta."' 
";
$result=mysql_db_query($basedatos,$SQL);
$myrow = mysql_fetch_array($result);
return $myrow['cuarto'];
}

public function devuelveNombrePx($numeroE,$nCuenta,$basedatos){
$SQL= "SELECT paciente
FROM
clientesInternos
where 
numeroE='".$numeroE."' and nCuenta='".$nCuenta."' 
";
$result=mysql_db_query($basedatos,$SQL);
$myrow = mysql_fetch_array($result);
return $myrow['paciente'];
}
}











class articulosDetalles{

   public function cantidadReal($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos){

$sSQL8a= "
SELECT cantidadIndividual
FROM
existencias
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'
and
codigo='".$codigo."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);
return $myrow8a['cantidadIndividual'];
   }
    
    
    

public function tventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos){


$sSQL8b1= "
SELECT  almacenExistencias
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'";
$result8b1=mysql_db_query($basedatos,$sSQL8b1);
$myrow8b1 = mysql_fetch_array($result8b1);
if($myrow8b1['almacenExistencias']!=NULL){
//$almacen=$myrow8b1['almacenExistencias'];
}



$sSQL8a= "
SELECT cantidadSurtir,tipoVenta,modoventa
FROM
existencias
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'
and
codigo='".$codigo."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);

//    $costoU= $myrow8a['cantidadSurtir']/$myrow8a['tipoVenta'];
//    $tipoVenta='suelto';
//    $priceLevel/=$costoU;


switch ($myrow8a['modoventa']) {

   case "Suelto" :
   return "Suelto";
   break;

   case "Granel" :
  
   return "Granel";

   break;

   default :
   return "Normal";
   break;

   }
}    
    
    
public function modoventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos){
    
//QUIEN ES CENTRO DE DISTRIBUCION DE ESTA ENTIDAD    
$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);     
    
###ACTUALIZADO EL 3OCT2013
//if($centroDistribucion!=$almacen){
#LAS CAJAS SON EXCLUSIVA DE CENDIS
$sSQL8b1= "
SELECT  almacenExistencias
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'";
$result8b1=mysql_db_query($basedatos,$sSQL8b1);
$myrow8b1 = mysql_fetch_array($result8b1);
if($myrow8b1['almacenExistencias']!=NULL){
//$almacen=$myrow8b1['almacenExistencias'];
}



$sSQL8a= "
SELECT cantidadSurtir,tipoVenta,modoventa,cantidadTotal,totalUnidades,cantidadIndividual
FROM
existencias
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'
and
codigo='".$codigo."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);


//if($myrow8a['cantidadSurtir']){
//
//
//} elseif($myrow8a['tipoVenta']>1){
//    $costoU= $myrow8a['cantidadSurtir']/$myrow8a['tipoVenta'];
//    $tipoVenta='suelto';
//    $priceLevel/=$costoU;
//}

$sSQL8b= "
SELECT medicamentosSueltos
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'";
$result8b=mysql_db_query($basedatos,$sSQL8b);
$myrow8b = mysql_fetch_array($result8b);


$sSQL8= "
SELECT cajaCon
FROM
articulos
WHERE
entidad='".$entidad."'

and
codigo='".$codigo."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);


if($myrow8b['medicamentosSueltos']=='si'){
    
if(  $myrow8['cajaCon']>0 and $myrow8a['cantidadSurtir']>0){//tiene caja con mas a granel
   
     $priceLevel/=$myrow8a['cantidadSurtir'];
     $priceLevel/=$myrow8['cajaCon'];
}elseif($myrow8a['cantidadSurtir']>0){ //tiene solo granel
$priceLevel/=$myrow8a['cantidadSurtir'];      
}elseif($myrow8['cajaCon']>0){ //tiene solo caja con
   
$priceLevel/=$myrow8['cajaCon'];  
}//cierra medicamentos sueltos
}
//}//solo botiquines pueden cargar cajas con






   return $priceLevel;    

}
    
    

public function articuloMaquilado($entidad,$keyPA,$basedatos){

$sSQL40= "SELECT maquilado
FROM
articulos
where 
keyPA='".$keyPA."'


";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
return $myrow40['maquilado'];
}


public function mostrarAntibiotico($entidad,$codigo,$basedatos){

$sSQL40= "SELECT antibiotico
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'


";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
return $myrow40['antibiotico'];
}



public function cierreCuentaReportes($entidad,$nT,$numeroE,$nCuenta,$basedatos){

$sSQL40= "SELECT status
FROM
procesoAlta
where 
keyClientesInternos='".$nT."'
and
entidad='".$entidad."'
and
(status='request' or status='cargado')


";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
if($myrow40['status']){

return ' [La Cuenta est� en proceso de cierre!]';
} else if($myrow40['status']=='cargado'){
return ' [La Cuenta est� lista para el cierre!]';
}
}


public function agregarBanderas($ALMACEN,$fecha1,$hora1,$usuario,$keyClientesInternos,$entidad,$numeroE,$nCuenta,$basedatos){

$sSQL4= "Select * From almacenes WHERE entidad='".$entidad."'
and
altaPaciente='si'
order by descripcion ASC
";
$result4=mysql_db_query($basedatos,$sSQL4); 
while($myrow4 = mysql_fetch_array($result4)){

$agrega1="
INSERT INTO procesoAlta ( numeroE, nCuenta, almacen, status, nPaso, fecha, hora, usuario,keyClientesInternos,entidad
) values ( 
'".$numeroE."', '".$nCuenta."', '".$myrow4['almacen']."', 'standby', '".$paso."', '".$fecha1."', '".$hora1."','".$usuario."',
'".$keyClientesInternos."','".$entidad."' )"; mysql_db_query($basedatos,$agrega1);
echo mysql_error();
	 
}
}

public function almacenesCierreCuenta($almacen,$fecha1,$hora1,$usuario,$keyClientesInternos,$entidad,$numeroE,$nCuenta,$basedatos){

$sSQL40= "SELECT status
FROM
procesoAlta
where entidad='".$entidad."'
and
almacen='".$almacen."'
and
keyClientesInternos='".$keyClientesInternos."'
";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
if($myrow40['status']){
return $myrow40['status'];
}
}



public function keyClientesInternos($numeroE,$nCuenta,$basedatos){

$sSQL40= "SELECT keyClientesInternos
FROM
clientesInternos
where 
numeroE='".$numeroE."' and nCuenta='".$nCuenta."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);

return $myrow40['keyClientesInternos'];

}




public function codigollave($entidad,$codigo,$basedatos){

$sSQL40= "SELECT keyPA
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);

return $myrow40['keyPA'];

}



public function devuelveMedico($medico,$basedatos){
$sSQL18= "
SELECT *
FROM
medicos
WHERE
numMedico='".$medico."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
echo $myrow18['nombre1']." ".$myrow18['apellido1']." ".$myrow18['apellido2'];
}

public function imagenMedico($medico,$basedatos){
$sSQL18= "
SELECT ruta
FROM
medicos
WHERE
numMedico='".$medico."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
echo '/sima/OPERACIONESHOSPITALARIAS/admisiones/medicos/'.$myrow18['ruta'];
}



public function mostrarIVA($keyCAP,$basedatos){

$sSQL40= "SELECT (iva*cantidad) as totalIVA
FROM
cargosCuentaPaciente
where 
keyCAP='".$keyCAP."'
";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
echo "$".number_format($myrow40['totalIVA'],2);
}




public function iva($entidad,$cantidad,$codigo,$precioVenta,$basedatos){

$sSQL40= "SELECT gpoProducto
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$gpoProducto=$myrow40['gpoProducto'];
$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' and activo='activo'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){

$iva*='0.01';

return $precioVenta*$iva;
} else {
return 0;
}
}




public function ivaGPO($entidad,$cantidad,$gpoProducto,$precioVenta,$basedatos){


$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' 
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){

$iva*='0.01';

return $precioVenta*$iva;
} else {
return 0;
}
}




//***************************************************************
//PORCENTAJES


public function porcentajeIVA($entidad,$cantidad,$codigo,$precioVenta,$basedatos){

$sSQL40= "SELECT gpoProducto
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$gpoProducto=$myrow40['gpoProducto'];
$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' and activo='activo'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){

$iva*='0.01';

return $iva;
} else {
return 0;
}
}














//*****************************************************************








public function ivaDirecto($entidad,$gpoProducto,$precioVenta,$basedatos){


$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' and activo='activo'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){
$iva*='0.01';

return $precioVenta*$iva;
} else {
return 0;
}
}


public function cargoAuto($entidad,$codigo,$basedatos){
$sSQL8= "
SELECT cargoAuto
FROM
articulos
WHERE
entidad='".$entidad."' AND
codigo='".$codigo."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
if($myrow8['cargoAuto']=='si'){
return 'si';
} else {
return 'no';
}
}


public function um($codigo,$basedatos){
$sSQL8= "
SELECT um
FROM
articulos
WHERE
codigo='".$codigo."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
return $myrow8['um'];
}


public function grupoProducto($entidad,$codigo,$basedatos){
$sSQL8= "
SELECT gpoProducto
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$codigo."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
return $grupoProducto=$myrow8['gpoProducto'];
}



public function descripcionGrupoProducto($entidad,$gpoProducto,$basedatos){
$sSQL8= "
SELECT descripcionGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
return $myrow8['descripcionGP'];
}



public function cargosDirectos($almacen,$gpoProducto,$entidad,$codigo,$basedatos){

$sSQL8= "
SELECT cargosDirectos
FROM
articulos
WHERE
codigo='".$codigo."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);


$sSQL28= "
SELECT cargosDirectos
FROM
gpoProductos
WHERE
codigoGP='".$gpoProducto."'
";
$result28=mysql_db_query($basedatos,$sSQL28);
$myrow28 = mysql_fetch_array($result28);

$sSQL18= "
SELECT cargosDirectos
FROM
almacenes
WHERE
almacen='".$almacen."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);



if($myrow28['cargosDirectos']=='si' or $myrow18['cargosDirectos']=='si' or $myrow8['cargosDirectos']=='si'){

return TRUE;
}else{
return FALSE;
} 
}


public function precioVentaDirecto($seguro,$paquete,$generico,$cantidad,$numeroE,$nCuenta,$codigo,$almacen,$basedatos){



$sSQL13= "
SELECT precioPaquete1,precioPaquete3,nivel1,nivel3
FROM
articulosPrecioNivel
WHERE
codigo='".$codigo."'
and
almacen='".$almacen."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
if($seguro){ 
if($paquete){
return $myrow13['precioPaquete1'];
} else {
return $myrow13['nivel3'];
}

} else {

if($paquete){
return $myrow13['precioPaquete3'];
} else 
return $myrow13['nivel1'];
}
}













public function preciosEspeciales($entidad,$gpoProducto,$keyPA,$codigo,$almacen,$basedatos){
$sSQL39d= "
SELECT 
tipoVentaEspecial
FROM
preciosEspeciales
WHERE 
entidad='".$entidad."'
and

gpoProducto='".$_GET['gpoProducto']."'";
$result39d=mysql_db_query($basedatos,$sSQL39d);
$myrow39d = mysql_fetch_array($result39d);
}







public function beneficenciaT6($entidad,$paquete,$generico,$cantidad,$numeroE,$nCuenta,$codigo,$almacen,$basedatos){
$sSQL13= "
SELECT beneficencia
FROM
articulosPrecioNivel
WHERE
entidad='".$entidad."'
    and
codigo='".$codigo."'
and
almacen='".$almacen."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);   
  if($myrow13['beneficencia']>0){
      return $myrow13['beneficencia'];
  }  
}














public function precioVenta($entidad,$paquete,$generico,$cantidad,$numeroE,$nCuenta,$codigo,$almacen,$basedatos){

    
    
$sSQL3ae= "
SELECT 
almacenExistencias
FROM
almacenes
where
entidad='".$entidad."'
    and
    almacen='".$almacen."'  ";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);



if($myrow3ae['almacenExistencias']!=''){
	$almacen=$myrow3ae['almacenExistencias'];
}   
    
    
    

$sSQL40= "SELECT seguro,entidad
FROM
clientesInternos
where 
keyClientesInternos='".$nCuenta."'
";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$seguro=$myrow40['seguro'];






if($paquete){

$sSQL40= "SELECT precioPaquete1
FROM
articulosPaquetes
where
entidad='".$entidad."'
    and
codigoPaquete='".$paquete."' and codigo='".$codigo."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
return $myrow40['precioPaquete1'];


} else { 








$sSQL181= "
SELECT costo
FROM
convenios
WHERE
entidad='".$entidad."'
    and
numCliente='".$seguro."' 

and
(departamento='".$almacen."' or departamento='*')
and
tipoConvenio='descuentoConvenio'
";
$result181=mysql_db_query($basedatos,$sSQL181);
$myrow181 = mysql_fetch_array($result181);


$sSQL40= "SELECT baseParticular
FROM
clientes
where 
numCliente='".$myrow40['seguro']."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);



$sSQL13a= "
SELECT gpoProducto
FROM
articulos
WHERE
codigo='".$codigo."'
and
entidad='".$entidad."'";
$result13a=mysql_db_query($basedatos,$sSQL13a);
$myrow13a = mysql_fetch_array($result13a);

$sSQL13ab= "
SELECT precioPorAlmacen
FROM
gpoProductos
WHERE
codigoGP='".$myrow13a['gpoProducto']."'

";
$result13ab=mysql_db_query($basedatos,$sSQL13ab);
$myrow13ab = mysql_fetch_array($result13ab);

//echo $myrow13a['gpoProducto'];
//echo $codigo.'-'.$myrow13a['gpoProducto'].'</br>';





$sSQL13= "
SELECT nivel1,nivel3,precioSugerido
FROM
articulosPrecioNivel
WHERE
codigo='".$codigo."'
and
entidad='".$entidad."'
and
almacen='".$almacen."'
";

$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);




if($myrow13['precioSugerido']){ //si trae precio sugerido lo pone 

$myrow13['nivel1']=$myrow13['precioSugerido'];
}







        
        



if($myrow40['baseParticular']=='si'){ 


if($myrow181['costo']){ 
$porcentaje=$myrow181['costo']*0.01;
$priceLevel=$myrow13['nivel1']*$porcentaje;
return $myrow13['nivel1']-$priceLevel;
}else{

return $myrow13['nivel1'];
}



} else {
//****************NO TRAE SEGURO
if($myrow13['precioSugerido']){ //si trae precio sugerido lo pone 
$myrow13['nivel3']=$myrow13['precioSugerido'];
}




if($seguro){ 

if($myrow181['costo']){
$porcentaje=$myrow181['costo']*0.01;
$priceLevel=$myrow13['nivel3']*$porcentaje;
return $myrow13['nivel3']-$priceLevel;
}else{
return $myrow13['nivel3'];
}


} else {


if($myrow181['costo']){
$porcentaje=$myrow181['costo']*0.01;
$priceLevel=$myrow13['nivel1']*$porcentaje;
return $myrow13['nivel1']-$priceLevel;

}else{

return $myrow13['nivel1'];
}


}
}//cierra validacion base particular
}//cierra paquete

}//cierro clase





public function precioVentaPresupuestos($seguro,$entidad,$paquete,$generico,$cantidad,$numeroE,$nCuenta,$codigo,$almacen,$basedatos){





if($paquete){

$sSQL40= "SELECT precioPaquete1
FROM
articulosPaquetes
where 
codigoPaquete='".$paquete."' and codigo='".$codigo."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
return $myrow40['precioPaquete1'];


} else { 
$sSQL40= "SELECT seguro,entidad
FROM
clientesInternos
where 
keyClientesInternos='".$nCuenta."'
";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);







$sSQL181= "
SELECT costo
FROM
convenios
WHERE
entidad='".$entidad."'
and
numCliente='".$seguro."' 

and
(departamento='".$almacen."' or departamento='*')
and
tipoConvenio='descuentoConvenio'
";
$result181=mysql_db_query($basedatos,$sSQL181);
$myrow181 = mysql_fetch_array($result181);


$sSQL40= "SELECT baseParticular
FROM
clientes
where 
numCliente='".$seguro."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);



$sSQL13a= "
SELECT gpoProducto
FROM
articulos
WHERE
codigo='".$codigo."'
and
entidad='".$entidad."'";
$result13a=mysql_db_query($basedatos,$sSQL13a);
$myrow13a = mysql_fetch_array($result13a);

$sSQL13ab= "
SELECT precioPorAlmacen
FROM
gpoProductos
WHERE
codigoGP='".$myrow13a['gpoProducto']."'
and
entidad='".$entidad."'";
$result13ab=mysql_db_query($basedatos,$sSQL13ab);
$myrow13ab = mysql_fetch_array($result13ab);

//echo $myrow13a['gpoProducto'];
//echo $codigo.'-'.$myrow13a['gpoProducto'].'</br>';




if($myrow13ab['precioPorAlmacen']=='si'){


$sSQL13= "
SELECT nivel1,nivel3,precioSugerido
FROM
articulosPrecioNivel
WHERE
codigo='".$codigo."'
and
almacen='".$almacen."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);

	if(!$myrow13['nivel1']){
	$sSQL13= "
	SELECT nivel1,nivel3,precioSugerido
	FROM
	articulosPrecioNivel
	WHERE
	codigo='".$codigo."'
	and
	entidad='".$entidad."'";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
	}



}else{

$sSQL13= "
SELECT nivel1,nivel3,precioSugerido
FROM
articulosPrecioNivel
WHERE
codigo='".$codigo."'
and
entidad='".$entidad."'

";

$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
}



if($myrow13['precioSugerido']){ //si trae precio sugerido lo pone 

$myrow13['nivel1']=$myrow13['precioSugerido'];
}



if($myrow40['baseParticular']=='si'){ 


if($myrow181['costo']){ 
$porcentaje=$myrow181['costo']*0.01;
$priceLevel=$myrow13['nivel1']*$porcentaje;
return $myrow13['nivel1']-$priceLevel;
}else{

return $myrow13['nivel1'];
}



} else {
//****************NO TRAE SEGURO
if($myrow13['precioSugerido']){ //si trae precio sugerido lo pone 
$myrow13['nivel3']=$myrow13['precioSugerido'];
}




if($seguro){ 

if($myrow181['costo']){
$porcentaje=$myrow181['costo']*0.01;
 $priceLevel=$myrow13['nivel3']*$porcentaje;
return $myrow13['nivel3']-$priceLevel;
}else{
    
return $myrow13['nivel3'];
}


} else {


if($myrow181['costo']){
$porcentaje=$myrow181['costo']*0.01;
$priceLevel=$myrow13['nivel1']*$porcentaje;
return $myrow13['nivel1']-$priceLevel;

}else{

return $myrow13['nivel1'];
}


}
}//cierra validacion base particular
}//cierra paquete

}//cierro clase






public function statusExistencias($entidad,$servicio,$almacen,$codigo,$basedatos){


$sSQL11= "
	SELECT 
  gpoProducto
FROM
 articulos
WHERE 
entidad='".$entidad."'
and
codigo = '".$codigo."'
";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

$sSQL11a= "
	SELECT 
  afectaExistencias
FROM
 gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP = '".$myrow11['gpoProducto']."'
";
$result11a=mysql_db_query($basedatos,$sSQL11a);
$myrow11a = mysql_fetch_array($result11a);

if($myrow11a['afectaExistencias']=='si'){




 $sSQL4= "
SELECT 
existencia
FROM
existencias
WHERE 
entidad='".$entidad."' 
and
codigo = '".$codigo."'
and 
almacen='".$almacen."'
and
existencia >'0'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

if($servicio=='no'){
if(!$myrow4['existencia']){
return 'readonly';
}
}
}


}


public function unidadMedida($codigo,$basedatos){

 $sSQL40= "SELECT um
FROM
articulos
where 
codigo='".$codigo."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
if($myrow40['um']){
return $myrow40['um'];
} else {
return false;
}
}



public function descripcionDescuentos($keyCAP,$numeroE,$nCuenta,$code,$basedatos){

$sSQL40= "SELECT status,tipoTransaccion
FROM
cargosCuentaPaciente
where 
(keyCAP='".$keyCAP."' or keyClientesInternos='".$keyCAP."')
and
status='transaccion'
";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$tipoTransaccion= $myrow40['tipoTransaccion'];



if($myrow40['status']=='transaccion'){

$sSQL6= "
	SELECT 
descripcion
FROM
catTTCaja
WHERE 
codigoTT = '".$tipoTransaccion."'
";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);

echo $myrow6['descripcion'];
} else {
 $sSQL8= "
SELECT descripcion
FROM
articulos
WHERE
codigo='".$code."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

if(!$myrow8['descripcion']){
echo 'No se encontro el articulo';
} else {
echo $myrow8['descripcion'];
}

}
}



public function descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$code,$basedatos){

$sSQL40= "SELECT status,tipoTransaccion,descripcion,entidad
FROM
cargosCuentaPaciente
where 
keyCAP='".$keyCAP."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);

$tipoTransaccion= $myrow40['tipoTransaccion'];


if($myrow40['descripcion']){

echo $myrow40['descripcion'];

}else{
if($myrow40['status']=='transaccion'){

$sSQL6= "
	SELECT 
descripcion
FROM
catTTCaja
WHERE 
entidad='".$entidad."'
and
codigoTT = '".$tipoTransaccion."'
";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
echo $myrow6['descripcion'];
} else {
 $sSQL8= "
SELECT descripcion
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$code."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

if(!$myrow8['descripcion']){
echo 'No se encontr� el art�culo';
} else {
echo $myrow8['descripcion'];
}
}
}

}




public function descripcionArticulo($entidad,$keyCAP,$numeroE,$nCuenta,$code,$basedatos){

$sSQL40= "SELECT entidad,status,tipoTransaccion,descripcion
FROM
cargosCuentaPaciente
where 
keyCAP='".$keyCAP."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$tipoTransaccion= $myrow40['tipoTransaccion'];


if($myrow40['descripcion']){

return $myrow40['descripcion'];

}else{
if($myrow40['status']=='transaccion'){

$sSQL6= "
	SELECT 
descripcion
FROM
catTTCaja
WHERE 
codigoTT = '".$tipoTransaccion."'
";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
return $myrow6['descripcion'];
} else {
 $sSQL8= "
SELECT descripcion
FROM
articulos
WHERE
entidad='".$entidad."'
    and
codigo='".$code."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

if(!$myrow8['descripcion']){
return 'No se encontro el articulo!';
} else {
return $myrow8['descripcion'];
}
}
}

}




}//cierra clase articulos detalles
















class validaConvenios{
public function vConvenio($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos){
$fecha1=date("Y-m-d");
//********************Empiezan validaciones***********

$sSQL15= "
SELECT *
FROM
convenios,clientes
WHERE
convenios.numCliente='".$seguro."' and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' 

";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas



return $myrow15['costo'];

}

public function traeConvenio($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos){
$fecha1=date("Y-m-d");
//********************Empiezan validaciones***********

$sSQL15= "
SELECT *
FROM
convenios,clientes
WHERE
convenios.numCliente='".$seguro."' and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' 

";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas

if($myrow15['tipoConvenio']){
return "Si";
}else {
return "No";
}
}


public function tipoConvenio($entidad,$precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos){
$fecha1=date("Y-m-d");
//********************Empiezan validaciones***********
//verifica si tiene un precio especial


 $sSQL15= "
SELECT tipoConvenio
FROM
convenios,clientes
WHERE
(convenios.entidad='".$entidad."' and clientes.entidad='".$entidad."' )
and
convenios.numCliente='".$seguro."' and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' 
";




$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas

if($myrow15['tipoConvenio']){
return $myrow15['tipoConvenio'];
} else {
return "No";
}

}

public function precioGlobal($entidad,$precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos){
$fecha1=date("Y-m-d");
//********************Empiezan validaciones***********
$sSQL13= "
SELECT nivel3
FROM
articulosPrecioNivel
WHERE
entidad='".$entidad."'
and
codigo='".$code."'
and
almacen='".$almacen."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
if($seguro){

return $myrow13['nivel3'];
}
}

public function validacionTipoConvenio($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos){
$fecha1=date("Y-m-d");
//********************Empiezan validaciones***********

$sSQL15= "
SELECT *
FROM
convenios,clientes
WHERE
convenios.codigo='".$code."' and
convenios.numCliente='".$seguro."' and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' and
(convenios.departamento='".$almacen."' or convenios.departamento='*')
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas
echo mysql_error();


return $myrow15['tipoConvenio'];


}


public function validacionConveniosNivel($entidad,$precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos){
$fecha1=date("Y-m-d");
//********************Empiezan validaciones***********

$sSQL13= "
SELECT nivel1,nivel3
FROM
articulosPrecioNivel
WHERE
entidad='".$entidad."'
and
codigo='".$code."'
and
almacen='".$almacen."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
if($seguro){
return $myrow13['nivel3'];
} else {
return $myrow13['nivel1'];
}
}


public function validacionJubilados($numeroE,$seguro,$entidad,$basedatos){
$SQL= "SELECT jubilado
FROM
pacientes
where 
entidad='".$entidad."'
and
numCliente='".$numeroE."' ";
$result=mysql_db_query($basedatos,$SQL);
$myrow = mysql_fetch_array($result);

if($myrow['jubilado']=='si'){
return 'si';
}
}


public function porcentajeJubilados($numeroE,$seguro,$entidad,$basedatos){
$SQL= "SELECT keyPacientes
FROM
pacientes
where 
entidad='".$entidad."'
and
numCliente='".$numeroE."' ";
$result=mysql_db_query($basedatos,$SQL);
$myrow = mysql_fetch_array($result);

$SQL= "SELECT porcentaje
FROM
porcentajeJubilados
where 
keyPacientes='".$myrow['keyPacientes']."' 
and
seguro='".$seguro."'
";
$result=mysql_db_query($basedatos,$SQL);
$myrow = mysql_fetch_array($result);

if($myrow['porcentaje']){

return $myrow['porcentaje'];
}
}














public function validacionConvenios($entidad,$cantidad,$iva,$precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos){
$fecha1=date("Y-m-d");
$gpoProducto= ltrim($gpoProducto);


//$precioLevel=($precioLevel)+($iva*$cantidad);


//********************Empiezan validaciones***********
if($seguro ){
//**********VERIFICACION PRINCIPAL, verificar que traigan un convenio por gpoProducto o Cantidad****


 $sSQL18= "
SELECT tipoConvenio,incluirReferidos
FROM
convenios
WHERE
entidad='".$entidad."'
and
numCliente='".$seguro."' 
and
(departamento='".$almacen."' or departamento='*')";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);





if($myrow18['tipoConvenio']=='cantidad'){




$sSQL15= "
SELECT costo
FROM
convenios,clientes
WHERE
(convenios.entidad='".$entidad."' and clientes.entidad='".$entidad."')
and
convenios.codigo='".$code."' and
convenios.numCliente='".$seguro."' and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' and
(convenios.departamento='".$almacen."' or convenios.departamento='*')
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas
echo mysql_error();

if($myrow15['costo']){
return $myrow15['costo'];	
} else {
return $precioLevel;
}





} else if($myrow18['tipoConvenio']=='grupoProducto'){//cierro validacion por cantidad*************************************




$sSQL15= "
SELECT numCliente
FROM
convenios,clientes
WHERE
(convenios.entidad='".$entidad."' and clientes.entidad='".$entidad."')
and
convenios.gpoProducto='".$gpoProducto."' and
convenios.numCliente='".$seguro."' and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' and
(convenios.departamento='".$almacen."' or convenios.departamento='*')
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas
echo mysql_error();


if($myrow15['numCliente']){
//trae seguro y tiene convenio


$porcentaje=$myrow15['costo']*0.01;
$porcentaje=$precioLevel*$porcentaje;
return $precioLevel=$precioLevel-$porcentaje;
		




} else {
//trae seguro pero no convenio

return $precioLevel;
}

}else if($myrow18['tipoConvenio']=='global'){//cierro filtro por grupo de producto****************************************
//******************GLOBAL******************




$sSQL15= "
SELECT convenios.numCliente as clientes,costo
FROM
convenios,clientes
WHERE
(convenios.entidad='".$entidad."' and clientes.entidad='".$entidad."')
and
convenios.numCliente='".$seguro."' and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' and
(convenios.departamento='".$almacen."' or convenios.departamento='*')
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas
echo mysql_error();




if($myrow15['clientes']){
//trae seguro y tiene convenio

$porcentaje=$myrow15['costo']*0.01;

return $porcentaje=$precioLevel*$porcentaje;


} else {
//trae seguro pero no convenio

return $precioLevel=$myrow13['nivel3'];
}








} else if($myrow18['tipoConvenio']=='precioEspecial' ){
//cierro filtro por grupo de producto***************
//******************precioEspecial******************


$sSQL15= "
SELECT convenios.numCliente as clientes,convenios.costo
FROM
convenios,clientes
WHERE
(convenios.entidad='".$entidad."' and clientes.entidad='".$entidad."')
and
convenios.numCliente='".$seguro."' 
and
convenios.gpoProducto='".$gpoProducto."'
and
convenios.numCliente=clientes.numCliente
and
convenios.fechaFinal >= '".$fecha1."'
and
convenios.fechaInicial <= '".$fecha1."' and
(convenios.departamento='".$almacen."' or convenios.departamento='*')
";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15); //valido las fechas
echo mysql_error();



if($myrow15['clientes']){
//trae seguro y tiene convenio
$porcentaje=$myrow15['costo']*0.01;
return $porcentaje=$precioLevel*$porcentaje;
}




} else {//cierro por global

return $precioLevel;
} //si trae seguro pero ningun convenio











} else {
	//no trae seguro
return  $precioLevel;

	}







}//cierra funcion





}//cierra clase






























//*******************************cclasess*********************************************************

class nombreDepartamento{
public function nombre($almacen,$basedatos){
$sSQL18= "
SELECT *
FROM
almacenes
WHERE
almacen='".$almacen."'
and
activo='A'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
print $almacen=$myrow18['descripcion'];
}
}

class nombreMedico{
public function nombreMed($almacen,$basedatos){
$sSQL18= "
SELECT descripcion
FROM
almacenes
WHERE
almacen='".$almacen."'
and
medico='si'

";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
print '( Dr(a) '.$myrow18['descripcion'];
}
}




class verificaSeguro{

static public function verificaSaldos($dia,$fecha1,$hora1,$seguro,$credencial,$basedatos){


if($seguro){
 $sSQL39= "SELECT *
FROM
segurosLimites
where 
seguro='".$seguro."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

$creditoTope=$myrow39['cantidad'];
$fechaInicial=$myrow39['fechaInicial'];
$fechaFinal=$myrow39['fechaFinal'];
$secureLoader=$myrow39['seguro'];

$sSQL40= "SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as acumulado
FROM
cargosCuentaPaciente
where 
credencial='".$credencial."' and
seguro='".$secureLoader."' and fecha1 between  '".$fechaInicial."' and '".$fechaFinal."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$totalCredito=$myrow40['acumulado'];



$creditoDisponible=$creditoTope-$totalCredito;
$acumulado=$totalCredito;

if($acumulado){
echo "El Paciente tiene un cr�dito disponible de: "."$".number_format($creditoDisponible,2)." y un acumulado de "."$".number_format($totalCredito,2).", de un cr�dito de "."$".number_format($creditoTope,2);
}




}//cierra funcion

}
}//cierra clase





class traeAuxiliar{


static public function auxiliar($fecha1,$hora1,$almacen,$basedatos,$ID_EJERCICIOM,$db_conn){
 $sSQL12= "
SELECT *
FROM
almacenes
WHERE 
almacen='".$almacen."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

$ctaMayor=$myrow12['ctaContable']; 
$ID_CCOSTO=$myrow12['ID_CCOSTO'];
$cmdstr1 = "

select DISTINCT * 
from mateo.cont_RELACION 
where 
ID_EJERCICIO='".$ID_EJERCICIOM."' AND 
ID_CCOSTO ='".$ID_CCOSTO."' AND

STATUS='A' AND
TIPO_CUENTA='R'
";
//$parsed1 = ociparse($db_conn, $cmdstr1);
//ociexecute($parsed1);	 
//$nrows1 = ocifetchstatement($parsed1, $results1); 
 for ($ir = 0; $ir < $nrows1; $ir++ ){
 
$id_auxiliar= $results1['ID_AUXILIAR'][$ir];

} 

//*******************************************CIERRO AUXILIAR*********************************************
//**********************Cierro Insertar precios con nivel afectado******************************
if($aux){
return $aux=$id_auxiliar;
} else {
return $aux='0000000';
}

} //cierra funcion
}//cierra clase
//************************************************************************************


class verificaCargoTotal{

static public function verificaCT($seguro,$basedatos){

if(isset($seguro) ){

$sSQL39= "SELECT *
FROM
clientes
where 
numCliente='".$seguro."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
if($myrow39['banderaCXCT']){
return true;
} else {
return false;

}

}
}//cierra trae seguro
}//cierra clase


class verificaSeguro1{

public function verificarAbonosCompanias($entidad,$seguro,$basedatos){

 $sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE 
entidad='".$entidad."' 
and
clientePrincipal='".$seguro."' 
and
status='transaccion'
and
naturaleza='A'
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$acumulado[0]+= $myrow['acumulado'];
return $acumulado[0];
}



public function verificarAbonosClientes($entidad,$fecha,$fecha2,$seguro,$basedatos){
if($fecha and $fecha2){
$sSQL= "Select sum(precioVenta) as acumulado From cargosCuentaPaciente
WHERE 
entidad='".$entidad."' 
and
seguro='".$seguro."' and tipoCliente='aseguradora'
and
fecha1 between '".$fecha."' AND '".$fecha2."'
and
naturaleza='A'
";
} else {
 $sSQL= "Select sum(precioVenta) as acumulado From cargosCuentaPaciente
WHERE 
entidad='".$entidad."' 
and
seguro='".$seguro."' 

and
naturaleza='A'
";

}

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
return " ".$myrow['acumulado'];
}


public function verificarAcumuladoClientes($entidad,$seguro,$basedatos){
$sSQLa= "Select numCliente from clientes
WHERE 
entidad='".$entidad."' 
and
clientePrincipal='".$seguro."' 
";
$resulta=mysql_db_query($basedatos,$sSQLa);
while($myrowa = mysql_fetch_array($resulta)){
$sSQL= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as acumulado From cargosCuentaPaciente
WHERE 
entidad='".$entidad."' 
and
seguro='".$myrowa['numCliente']."' 
and
status='cxc'
and 
statusCargo='cargado'
and
naturaleza='C'
";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$acumulado[0]+= $myrow['acumulado'];
}
return $acumulado[0];
}








public function verificaSaldosInternos($numeroE,$nCuenta,$hora1,$seguro,$credencial,$basedatos){
//verifico que aunque no tenga seguro debe de estar en el l�mite de cr�dito
$sSQL39= "SELECT *
FROM
clientesInternos
where 
numeroE='".$numeroE."'
and
nCuenta='".$nCuenta."'
";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$limiteCredito= $myrow39['limiteCredito'];

if(!$limiteCredito){
return true;
} else {
$sSQL40= "SELECT sum(precioVenta) as abonos
FROM
cargosCuentaPaciente
where 
numeroE='".$numeroE."' and nCuenta='".$nCuenta."' and naturaleza='A'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$abonos=$myrow40['abonos'];


$sSQL311= "Select sum((precioVenta*cantidad)+(cantidad*iva)) as cargos From cargosCuentaPaciente
 WHERE numeroE = '".$numeroE."' and nCuenta='".$nCuenta."' and statusCargo='cargado'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$cargos=$myrow311['cargos'];
/* if($myrow212['limiteCredito']<=$myrow311['acumulado']){
echo '<blink>'." El L�mite de Cr�dito del paciente ha sido superado ".'</blink>';
} */
 $total=$cargos-$abonos;
if($total<=$limiteCredito){
//echo "Tienes un disponible de cr�dito de $".number_format($limiteCredito-$total,2);
return true;
} else {
return false;
}
}
}



public function traeSeguro($keyClientesInternos,$basedatos){
$sSQL39= "SELECT seguro
FROM
clientesInternos
where 
keyClientesInternos='".$keyClientesInternos."'
";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
return $myrow39['seguro'];
}




public function verificaSaldos1($cantidad,$iva,$priceLevel,$dia,$fecha1,$hora1,$seguro,$credencial,$leyenda,$basedatos){

$precio= ($priceLevel*$cantidad)+($iva*$cantidad);
$sSQL39= "SELECT *
FROM
segurosLimites
where 
seguro='".$seguro."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

$creditoTope=$myrow39['cantidad'];
$fechaInicial=$myrow39['fechaInicial'];
$fechaFinal=$myrow39['fechaFinal'];
$secureLoader=$myrow39['seguro'];


if($myrow39['seguro'] and $credencial){

if($secureLoader==$seguro ){
//and fecha1 between  '".$fechaInicial."' and '".$fechaFinal."'
$sSQL40= "SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as acumulado
FROM
cargosCuentaPaciente
where 
credencial='".$credencial."' and
seguro='".$secureLoader."' and fecha1 between  '".$fechaInicial."' and '".$fechaFinal."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$totalCredito=$myrow40['acumulado']+$precio;
$totalCredito+=$Cost;
$creditoDisponible=$creditoTope-$totalCredito;
$acumulado=$totalCredito;

//echo "precio".$priceLevel;


if($totalCredito<=$creditoTope){
//echo "El Paciente tiene un cr�dito disponible de: "."$".number_format($creditoTope-$totalCredito,2)." y un acumulado de "."$".number_format($totalCredito,2).", de un cr�dito de "."$".number_format($creditoTope,2);
return true;
} else {

//echo "El Paciente tiene un cr�dito disponible de: "."$".number_format($creditoTope-$totalCredito,2)." y un acumulado de "."$".number_format($totalCredito,2).", de un cr�dito de "."$".number_format($creditoTope,2);
echo '<script>
window.alert( "YA SE SUPERO SU LIMITE DE CREDITO, O LA CANTIDAD QUE INTENTAS CARGAR SUPERA AL ACUMULADO O AL LIMITE DE CREDITO, NO PODEMOS AGREGAR CARGOS!");
</script>';

?>
<script type="text/javascript">
	

		close();
	
</script>
<?php
return false; 
}
} else {//la cantidad debe ser menor a al credito
//echo '<blink>'."El costo del art�culo no debe superar al cr�dito".'</blink>';
}
//*********************************************************
}else { 
//echo "no tiene seguro";
return true;
}

}//cierra funcion
}//cierra clase












class displaySeguro{
static public function despliegaSeguro($traeSeguro,$basedatos){
$sSQL212= "SELECT nomCliente
FROM
clientes
WHERE 
numCliente='".$traeSeguro."'
 ";
 $result212=mysql_db_query($basedatos,$sSQL212);
$myrow212 = mysql_fetch_array($result212);
echo '[ '.$myrow212['nomCliente'].' ]';
}//cierra funcion
static public function despliegaRFC($traeSeguro,$basedatos){
$sSQL212= "SELECT rfc
FROM
clientes
WHERE 
numCliente='".$traeSeguro."'
 ";
 $result212=mysql_db_query($basedatos,$sSQL212);
$myrow212 = mysql_fetch_array($result212);
echo $myrow212['rfc'];
}//cierra funcion
}//cierra clase

class creditoDisponibleC{
static public function creditoDisponible($numeroPaciente,$nCuenta,$basedatos){
$sSQL212= "SELECT *
FROM
clientesInternos
WHERE 
numeroE='".$numeroPaciente."' AND nCuenta='".$nCuenta."'
 ";
 $result212=mysql_db_query($basedatos,$sSQL212);
$myrow212 = mysql_fetch_array($result212);

$sSQL311= "Select sum((precioVenta)+iva) as acumulado From cargosCuentaPaciente
 WHERE numeroE = '".$numeroPaciente."' and nCuenta='".$nCuenta."' and statusCargo='cargado'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
//echo $myrow212['limiteCredito'];
if($myrow212['limiteCredito']<=$myrow311['acumulado']){
echo '<blink>'." El L�mite de Cr�dito del paciente ha sido superado ".'</blink>';
}


}//cierra funcion 
}//cierra class


class tipoVentaArticulo {
public function almacenMedicamentosSueltos($almacen,$keyPA,$precioVenta,$iva,$cantidad,$entidad,$basedatos){

$sSQL8a= "
SELECT medicamentosSueltos
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);
return $myrow8a['medicamentosSueltos'];
}


public function vendoX($almacen,$keyPA,$precioVenta,$iva,$cantidad,$entidad,$basedatos){

$sSQL8a= "
SELECT medicamentosSueltos
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);

if($myrow8a['medicamentosSueltos']=='si'){
$sSQL8= "
SELECT cajaCon
FROM
articulos
WHERE
keyPA='".$keyPA."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);


if($myrow8['cajaCon']){
return $precioVenta/$myrow8['cajaCon'];
}else{
return $precioVenta;
}


}

}


public function ventaPieza($almacen,$keyPA,$precioVenta,$iva,$cantidad,$entidad,$basedatos){

if($keyPA!=NULL){    
$sSQL8a= "
SELECT *
FROM
existencias
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'
and
keyPA='".$keyPA."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);
if($myrow8a['cantidadSurtir']>0 and $myrow8a['tipoVenta']>1){
$costoU= $myrow8a['cantidadSurtir']/$myrow8a['tipoVenta'];
return $precioVenta/$costoU;
}else{
    return false;
}
}else{
    return false;
}
}



public function vendoXIVA($almacen,$keyPA,$precioVenta,$iva,$cantidad,$entidad,$basedatos){

$sSQL8a= "
SELECT medicamentosSueltos
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);



if($myrow8a['medicamentosSueltos']=='si'){
$sSQL8= "
SELECT cajaCon
FROM
articulos
WHERE
keyPA='".$keyPA."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

if($myrow8['cajaCon']>0){
return $iva/$myrow8['cajaCon'];
}else{
return $iva;
}
 
}
}
}//cierra clase


class devuelveMedico {
static public function regresaMedico($entidad,$code,$basedatos){
$sSQL8= "
SELECT *
FROM
articulos
WHERE
entidad='".$entidad." '
and
codigo='".$code."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
return $myrow8['medico'];
}
}


class creditoDisponibleC1{
static public function creditoDisponible1($numeroPaciente,$nCuenta,$basedatos){
$sSQL212= "SELECT *
FROM
clientesInternos
WHERE 
numeroE='".$numeroPaciente."' AND nCuenta='".$nCuenta."'
 ";
 $result212=mysql_db_query($basedatos,$sSQL212);
$myrow212 = mysql_fetch_array($result212);

$sSQL311= "Select sum((precioVenta)+iva) as acumulado From cargosCuentaPaciente
 WHERE numeroE = '".$numeroPaciente."' and nCuenta='".$nCuenta."' and statusCargo='cargado'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
//echo $myrow212['limiteCredito'];
if($myrow212['limiteCredito']<=$myrow311['acumulado']){
echo '<blink>'." El L�mite de Cr�dito del paciente ha sido superado ".'</blink>';
}


}//cierra funcion 
}//cierra class
?>

<?php 
class acumulados {
 
  public function devuelveTipoTransaccion($basedatos){		
$sSQL317= "Select codigoTT From catTTCaja WHERE banderaPaquete = 'si'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);
return $myrow317['codigoTT'];
}
 
 
 
 
 
 
public function verificarSaldos($seguro,$entidad,$fecha1,$basedatos,$numeroE,$matricula){ 
$sSQL7n= "Select * from periodoAlumnos where entidad='".$entidad."'  and  '".$fecha1."' between fechaInicial and fechaFinal ";
$result7n=mysql_db_query($basedatos,$sSQL7n);
$myrow7n = mysql_fetch_array($result7n);

/*
$sSQL7na1= "Select numMatricula from pacientes where entidad='".$entidad."'  and numCliente='".$numeroE."'  ";
$result7na1=mysql_db_query($basedatos,$sSQL7na1);
$myrow7na1 = mysql_fetch_array($result7na1);
*/
$sSQL7na= "Select * from ALUMNOSINSCRITOS where entidad='".$entidad."'  and MATRICULA='".$matricula."'  ";
$result7na=mysql_db_query($basedatos,$sSQL7na);
$myrow7na = mysql_fetch_array($result7na);
 $sSQL= "Select * from clientesInternos where entidad='".$entidad."' and credencial='".$matricula."' and seguro='".$seguro."'

and (fecha >='".$myrow7n['fechaInicial']."' and fecha<='".$myrow7n['fechaFinal']."' ) 
and
folioVenta!=''
and
statusCuenta='cerrada'
";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$sSQL7c= "Select sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as cargos  from cargosCuentaPaciente where entidad='".$entidad."' 
and
seguro='".$seguro."'
    
and folioVenta='".$myrow['folioVenta']."' and naturaleza='A'  and gpoProducto=''  ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);



$totales[0]+=$myrow7c['cargos'];
}
return $totales[0];
}
 
 
 
 
 
 
 
 
 
 
public function convenioAseguradora($basedatos,$usuario,$keyClientesInternos){		
$sSQL17= "
SELECT 
sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as sumaCargos

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




 $sSQL= "
	SELECT 
 sum(cantidadAseguradora) as sumaAbonos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and
naturaleza='A'

";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$resta= $myrow17['sumaCargos']-$myrow['sumaAbonos'];



return $resta;
		}
 
 
 
  public function convenioAseguradoraR($basedatos,$usuario,$keyClientesInternos){		
$sSQL17= "
	SELECT 
  sum((cantidadAseguradora*cantidad)+(iva*cantidad)) as sumaCargos

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
cantidadAseguradora!=''
and
statusCargo='cargadoR' 
and naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




 $sSQL= "
	SELECT 
 sum(cantidadAseguradora) as sumaAbonos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
status='transaccion' 
and naturaleza='A'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQL2= "
	SELECT 
  sum(cantidadAseguradora) as TCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
status='transaccion'
and
naturaleza='C' 
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$TCargos=$myrow2['TCargos'];


return $Tcargos=$myrow17['sumaCargos']-$myrow['sumaAbonos']+$TCargos;
//return $Tcargos=$myrow17['sumaCargos'];

		}
 
 
  public function convenioAseguradoraR1($basedatos,$usuario,$numeroE1,$nCuenta1){		
$sSQL17= "
	SELECT 
  sum((cantidadAseguradora*cantidad)+(iva*cantidad)) as sumaCargos

FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
cantidadAseguradora!=''
and
statusCargo='standbyR' 

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




 $sSQL= "
	SELECT 
 sum(cantidadAseguradora) as sumaAbonos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion' 
and naturaleza='A'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQL2= "
	SELECT 
  sum(cantidadAseguradora) as TCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion'
and
naturaleza='C' 
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$TCargos=$myrow2['TCargos'];
$Tcargos=$myrow17['sumaCargos']-$myrow['sumaAbonos']+$TCargos;


$sSQL17a= "
	SELECT 
  sum((precioVenta*cantidad)+(iva*cantidad)) as sumaCargos

FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 

statusCargo='standbyR' 

";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);


if($TCargos){
return $Tcargos;
} else {
return $myrow17a['sumaCargos'];
}

//return $Tcargos=$myrow17['sumaCargos'];

		}
 
 
 
  public function convenioParticularR($basedatos,$usuario,$keyClientesInternos){		
    $sSQL17= "
	SELECT 
    SUM(cantidadParticular*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
WHERE 
	keyClientesInternos='".$keyClientesInternos."'
and 
(statusCargo='cargadoR' )
and naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




$sSQL= "
	SELECT 
cantidadParticular as sumaAbonos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
status='transaccion' 
and naturaleza='A'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQL2= "
	SELECT 
  sum(cantidadParticular) as TCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
status='transaccion'
and
naturaleza='C' 
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);



return $myrow17['sumaCargos']-$myrow['sumaAbonos']+$myrow2['TCargos'];
}
 
 
 

 
 
 
 
 public function convenioParticular($basedatos,$usuario,$numeroE1,$nCuenta1){		
    $sSQL17= "
	SELECT 
    SUM(cantidadParticular*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
WHERE 
	numeroE = '".$numeroE1."'
	and
	nCuenta='".$nCuenta1."'
and 
(statusCargo='cargado' )
and naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




$sSQL= "
	SELECT 
cantidadParticular as sumaAbonos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion' 
and naturaleza='A'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQL2= "
	SELECT 
  sum(cantidadParticular) as TCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion'
and
naturaleza='C' 
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);



return $myrow17['sumaCargos']-$myrow['sumaAbonos']+$myrow2['TCargos'];
}
 
 
 
 
//status 
 public function status($keyCAP,$basedatos,$usuario,$numeroE,$nCuenta){			
$sSQL17= "
	SELECT 
statusCargo
FROM
cargosCuentaPaciente
WHERE 

keyCAP='".$keyCAP."'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17); 
$pendiente='<img src=/sima/imagenes/pendiente.png width="15" height="15" />';
$surtido='<img src=/sima/imagenes/surtido.png width="15" height="15" />';
$request='<img src=/sima/imagenes/stop.png width="15" height="15" alt="No ha sido liberado desde sala" />';
 if($myrow17['statusCargo']=='standby'){ 

		return $pendiente;
		
		} else if($myrow17['statusCargo']=='request'){
		return $request;
		} else if($myrow17['statusCargo']=='cargado'){
		
		return $surtido;
		} 
		
		
 } 
 
 
 

 public function importe($keyCAP,$basedatos){		

$sSQL17= "
	SELECT 
status,naturaleza,statusCargo,precioVenta as importe
FROM
cargosCuentaPaciente
WHERE 

 keyCAP='".$keyCAP."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


if($myrow17['statusCargo']='cargado'){

if($myrow17['status']=='transaccion' AND $myrow17['naturaleza']=='A' ){
echo "-$".number_format($myrow17['importe'],2);
} else {
echo "$".number_format($myrow17['importe'],2);
}

} else {
if($myrow17['tipoPaciente']=='interno'){
echo 'Pendiente';
} else {
echo "$".number_format($myrow17['importe'],2);
}
}
}
 
 
  public function importeCuadroFacturacion($keyCAP,$basedatos){		

$sSQL17= "
	SELECT 
status,naturaleza,statusCargo,precioVenta*cantidad as importe
FROM
cargosCuentaPaciente
WHERE 

 keyCAP='".$keyCAP."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


if($myrow17['statusCargo']='cargado'){

if($myrow17['status']=='transaccion' AND $myrow17['naturaleza']=='A' ){
echo "-$".number_format($myrow17['importe'],2);
} else {
echo "$".number_format($myrow17['importe'],2);
}

} else {
if($myrow17['tipoPaciente']=='interno'){
echo 'Pendiente';
} else {
echo "$".number_format($myrow17['importe'],2);
}
}
}
 
 
 
 
 
 
 
 
 
 
//total  creditos 
public function totalCreditos($basedatos,$usuario,$numeroE1,$nCuenta1){		
$sSQL1711= "
	SELECT 
  sum(costo) as sumaCreditos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(statusTraslado='trasladado'  and tipoCliente='aseguradora' and naturaleza='CR')
";
$result1711=mysql_db_query($basedatos,$sSQL1711);
$myrow1711 = mysql_fetch_array($result1711);
return $myrow1711['sumaCreditos'];
} 
 
  
public function verificaCargos($basedatos,$usuario,$folioVenta){		
$sSQL= "
	SELECT 
numeroE
FROM
cargosCuentaPaciente
WHERE 
folioVenta='".$folioVenta."'
and 
statusCargo='cargado' 
and naturaleza='C'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

if($myrow['numeroE']){
return TRUE;
} else {
return FALSE;
}
}

 
 
 
 
//cargos totales 
public function cargosTotales($basedatos,$usuario,$numeroE1,$nCuenta1){		
$sSQL17= "
	SELECT 
  sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(statusCargo='cargado' )
and naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




$sSQL= "
	SELECT 
 sum(precioVenta) as sumaAbonos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion' 
and naturaleza='A'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQL2= "
	SELECT 
  sum(precioVenta) as TCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion'
and
naturaleza='C' 
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$TCargos=$myrow2['TCargos'];


return $Tcargos=$myrow17['sumaCargos']-$myrow['sumaAbonos']+$TCargos;
//return $Tcargos=$myrow17['sumaCargos'];

		}
		
 
 
 
 public function totalAcumuladoAseguradoraCxC($basedatos,$usuario,$numeroE1,$nCuenta1){		
$sSQL17= "
SELECT 
tipoPaciente
FROM
clientesInternos
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$tipoPaciente=$myrow17['tipoPaciente'];


if($tipoPaciente=='interno'){
$sSQL17= "
	SELECT 
sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaAcumulado
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(statusCargo='cargado' )
and naturaleza='C' and status!='transaccion'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
} else {
$sSQL17= "
	SELECT 
  sum(precioVenta+iva)*cantidad as sumaAcumulado
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(statusCargo='cargado' )
and naturaleza='C' and status!='transaccion'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
}



$sSQL171= "
	SELECT 
  sum((precioVenta*cantidad)+iva) as devolucion
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and naturaleza='C' and status='transaccion'
";
$result171=mysql_db_query($basedatos,$sSQL171);
$myrow171 = mysql_fetch_array($result171);

return $myrow17['sumaAcumulado']+$myrow171['devolucion'];
		}
 
 
 
 
 public function totalAcumuladoTrans($basedatos,$usuario,$nT){		
$sSQL17= "
SELECT 
tipoPaciente
FROM
clientesInternos
WHERE 
keyClientesInternos='".$nT."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$tipoPaciente=$myrow17['tipoPaciente'];


if($tipoPaciente=='interno'){
 $sSQL17= "
	SELECT 
sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaAcumulado
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$nT."'
and
status='transaccion'
and
naturaleza='A'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
} else {
$sSQL17= "
	SELECT 
SUM((precioVenta*cantidad)+(iva*cantidad)) as sumaAcumulado

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$nT."'
and 
status='transaccion'
and
naturaleza='A'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
}

$sSQL171= "
	SELECT 
precioVenta as devolucion
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$nT."'
and naturaleza='C' and status='transaccion'
";
$result171=mysql_db_query($basedatos,$sSQL171);
$myrow171 = mysql_fetch_array($result171);

return round($myrow17['sumaAcumulado'],2)+round($myrow171['devolucion'],2);
		}
 


 public function totalAcumuladoPaq($basedatos,$usuario,$nT){		

$sSQL171= "
	SELECT 
SUM(precioVenta) as sumaPaquete
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$nT."'
and naturaleza='A' 
";
$result171=mysql_db_query($basedatos,$sSQL171);
$myrow171 = mysql_fetch_array($result171);

return round($myrow171['sumaPaquete'],2);
		}
  
 
public function totalAcumulado($basedatos,$usuario,$keyCI){		
$sSQL17= "
SELECT 
tipoPaciente,paquete
FROM
clientesInternos
WHERE 
keyClientesInternos='".$keyCI."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$tipoPaciente=$myrow17['tipoPaciente'];

if($myrow17['paquete']=='si'){

$sSQL17= "
	SELECT 
sum((cantidadParticular*cantidad)+(cantidadAseguradora*cantidad)+(ivaParticular*cantidad)+(ivaAseguradora*cantidad)) as sumaAcumulado
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyCI."'
and
paquete='si'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
} else {
if($tipoPaciente=='interno' or $tipoPaciente='urgencias'){
$sSQL17= "
SELECT 
sum((cantidadParticular*cantidad)+(cantidadAseguradora*cantidad)) as sumaAcumulado
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyCI."'
and 
(statusCargo='cargado' or status='paquete')
and naturaleza='C' 
and status!='transaccion'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
} else {
$sSQL17= "
	SELECT 
SUM(precioVenta*cantidad) as sumaAcumulado

FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyCI."'
and 
(statusCargo='cargado' or status='paquete')
and naturaleza='C' and status!='transaccion'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
}}



return round($myrow17['sumaAcumulado'],2);
		}

 
 

 
 
 
//abonos
public function abonos($entidad,$basedatos,$usuario,$folioVenta){
$sSQL16= "
SELECT 
sum(precioVenta*cantidad) as Tabonos
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
and
naturaleza='A'
and
statusDevolucion!='si'";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
$Tabonos=round($myrow16['Tabonos'],2);
if($Tabonos>0 or $Tabonos!=NULL){
		  return "-".$Tabonos;
		}  else {
	return $Tabonos;
	}	
}



public function dev($entidad,$basedatos,$usuario,$folioVenta){
$sSQL16= "
	SELECT 
  sum(precioVenta*cantidad) as dev
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
and
naturaleza='A' 
and
statusDevolucion='si'
";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
return $myrow16['dev'];
}


//otros
public function otros($basedatos,$usuario,$keyClientesInternos){		
$sSQL17= "
	SELECT 
  	sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
	FROM
	cargosCuentaPaciente
	WHERE 
	keyClientesInternos='".$keyClientesInternos."'
	and 
	tipoCliente='particular'
	and
	naturaleza='C'
	";
	$result17=mysql_db_query($basedatos,$sSQL17);
	$myrow17 = mysql_fetch_array($result17);
	
	  
$sSQL17s= "
	SELECT 
  	sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaAbonos
	FROM
	cargosCuentaPaciente
	WHERE 
	keyClientesInternos='".$keyClientesInternos."'
	and 
	tipoCliente='particular'
	and
	naturaleza='A'
	";
	$result17s=mysql_db_query($basedatos,$sSQL17s);
	$myrow17s = mysql_fetch_array($result17s);

return $myrow17['sumaCargos']-$myrow17['sumaAbonos'];
} //cierra otros
		
		


public function cargosCortesia($basedatos,$usuario,$keyClientesInternos){		
$sSQL17= "
SELECT 
sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and
(status='cortesia' and statusCargo='cargado' )
and naturaleza='C' 
and
tipoCliente='cortesia'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$sumaCargos= $myrow17['sumaCargos'];
$sumaCargos=round($sumaCargos,2);


$sSQL16= "
	SELECT 
  sum(precioVenta) as Tabonos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and
status='transaccion'
and
naturaleza='A' 
and
tipoCliente='particular'
";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
$Tabonos=round($myrow16['Tabonos'],2);



$sSQL2= "
	SELECT 
  sum(precioVenta) as TCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and
status='transaccion'
and
naturaleza='C' 

";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$TCargos=round($myrow2['TCargos'],2);
		  
	   

$totals=$sumaCargos-$Tabonos+$TCargos+$coaseguro;



return $totals;

}	
		
		
		
public function cargosParticulares($basedatos,$usuario,$keyClientesInternos){		
$sSQL17= "
SELECT 
sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
(status='particular' and statusCargo='cargado' )
and naturaleza='C' 
and
tipoCliente='particular'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$sumaCargos= $myrow17['sumaCargos'];
$sumaCargos=round($sumaCargos,2);


$sSQL16= "
	SELECT 
  sum(precioVenta) as Tabonos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."' and 
status='transaccion'
and
naturaleza='A' 
and
tipoCliente='particular'
";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
$Tabonos=round($myrow16['Tabonos'],2);



$sSQL2= "
	SELECT 
  sum(precioVenta) as TCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
status='transaccion'
and
naturaleza='C' 

";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$TCargos=round($myrow2['TCargos'],2);
		  
	   

$totals=$sumaCargos-$Tabonos+$TCargos+$coaseguro;



return $totals;

}
		
	
	
public function devoluciones($basedatos,$keyClientesInternos){		
$sSQL17= "
SELECT SUM(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and naturaleza='C' 

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
return round($myrow17['sumaCargos'],2);

}	
	
		
		
public function total($cargos,$abonos,$numeroE,$nCuenta){	
$abonos=$abonos*(-1);
return number_format($cargos,2)-number_format($abonos,2);
}
		
		
		
		
		

		


public function ivaAcumuladoND($basedatos,$usuario,$keyCI){			
$sSQL13= "
	SELECT 
  sum(iva*cantidad) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyCI."'
and
naturaleza='C'
and
status!='transaccion'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);



		  return $myrow13['sumaiva'];
		//echo "$".number_format($iva,2);
		}



public function ivaAcumuladoD($entidad,$basedatos,$usuario,$keyCI){			
 $sSQL13b= "
	SELECT 
  sum(iva*cantidad) as ivaAbonos
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
keyClientesInternos='".$keyCI."'
and
naturaleza='A'
and
status!='transaccion'
and
statusDevolucion='si'
";
$result13b=mysql_db_query($basedatos,$sSQL13b);
$myrow13b = mysql_fetch_array($result13b);

		  return $myrow13b['ivaAbonos'];
		
		}


public function ivaAcumulado($entidad,$basedatos,$usuario,$keyCI){			
$sSQL13= "
	SELECT 
  sum(iva*cantidad) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
keyClientesInternos='".$keyCI."'
and
naturaleza='C'
and
status!='transaccion'

";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);


		  return $myrow13['sumaiva'];
		//echo "$".number_format($iva,2);
		}
		



	 public function totalxSurtir($basedatos,$usuario,$numeroE1,$nCuenta1){			
 $sSQL13= "
	SELECT 
  sum(precioVenta+iva)*cantidad as totalxSurtir
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and
statusCargo='standby'
and
status!='transaccion'

";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  return $myrow13['totalxSurtir'];
		
		}
		



public function totalxSurtirFV($entidad,$basedatos,$usuario,$folioVenta){		
		 
$sSQL17= "
SELECT 
seguro
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	
if($myrow17['seguro'] and $myrow['seguro']!='0'){ 	
 $sSQL13= "
	SELECT 
sum(cantidadAseguradora*cantidad)+sum(ivaAseguradora*cantidad) as totalxSurtir
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
and
statusCargo!='cargado'
and
naturaleza='C'

";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
}else{
 $sSQL13= "
	SELECT 
  sum(cantidadParticular*cantidad)+sum(ivaParticular*cantidad) as totalxSurtir
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
and
statusCargo!='cargado'
and
naturaleza='C'

";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);

}
		  return $myrow13['totalxSurtir'];
		
		}	
		
		

public function banderaPorcentajeMedicamentos($entidad,$basedatos,$usuario,$folioVenta){		



$sSQL= "
SELECT  sum(cargosCuentaPaciente.precioVenta*cargosCuentaPaciente.cantidad)+sum(cargosCuentaPaciente.iva*cargosCuentaPaciente.cantidad) as sumaCargos
FROM gpoProductos,cargosCuentaPaciente
WHERE 
folioVenta='".$folioVenta."'
and
cargosCuentaPaciente.gpoProducto=gpoProductos.codigoGP
and
gpoProductos.coaseguro='si'
and
cargosCuentaPaciente.status='cxc'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);



return $myrow['sumaCargos'];
}


public function cargosGlobales($entidad,$basedatos,$usuario,$numeroE1,$nCuenta1){			
$sSQL17= "
	SELECT 
  sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
AND
status!='transaccion'
AND
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and
statusCargo='cargado'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);



return $Tcargos=$myrow17['sumaCargos'];
}


public function cargosGlobalesCoaseguro($entidad,$basedatos,$usuario,$folioVenta){			
$sSQL17= "
	SELECT 
  sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
folioVenta='".$folioVenta."'
AND
status!='transaccion'
AND
statusCargo='cargado'
and
status='cxc'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);



return $Tcargos=$myrow17['sumaCargos'];
}





public function cargosCoaseguro($entidad,$basedatos,$usuario,$keyClientesInternos){			


 $sSQL17a= "
	SELECT 
    sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
	entidad='".$entidad."'
	and
    keyClientesInternos = '".$keyClientesInternos."'
    and 
    tipoCliente='coaseguro' 
	and
	naturaleza='A'";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);

$sSQL17ab= "
	SELECT 
    sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE
	entidad='".$entidad."'
	and 
    keyClientesInternos = '".$keyClientesInternos."'
    and 
    tipoCliente='coaseguro' 
	and
	naturaleza='-'
";
$result17ab=mysql_db_query($basedatos,$sSQL17ab);
$myrow17ab = mysql_fetch_array($result17ab);

if($myrow17a['sumaCargos']){
return $myrow17a['sumaCargos']-$myrow17ab['sumaCargos'];
}else if($myrow17ab['sumaCargos'] and !$myrow17a['sumaCargos']){
return $myrow17ab['sumaCargos'];
}else{
return NULL;
}

}//cierra clase









public function cargosCoaseguroN($entidad,$basedatos,$usuario,$keyClientesInternos){			


 $sSQL17a= "
	SELECT 
    sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
	entidad='".$entidad."'
	and
    keyClientesInternos = '".$keyClientesInternos."'
    and 
    tipoCliente='coaseguro' 
	and
	naturaleza='A'
";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);



return $myrow17a['sumaCargos'];

}//cierra clase
		
public function cargosAseguradora($basedatos,$usuario,$numeroE1,$nCuenta1){		

 $sSQL117= "
	SELECT 
statusTraslado
    FROM
    cargosCuentaPaciente
    WHERE 
    numeroE = '".$numeroE1."'
    and
    nCuenta='".$nCuenta1."'
    and 
    statusTraslado='trasladado'
    ";
$result117=mysql_db_query($basedatos,$sSQL117);
$myrow117 = mysql_fetch_array($result117);
	
 $sSQL17= "
	SELECT 
    sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    numeroE = '".$numeroE1."'
    and
    nCuenta='".$nCuenta1."'
    and 
    tipoCliente='aseguradora' and statusTraslado='standby' and statusCargo='cargado'
    ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

if($myrow17['sumaCargos']>0){
if($myrow117['statusTraslado']){
    $sSQL171= "
SELECT 
    sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    numeroE = '".$numeroE1."'
    and
    nCuenta='".$nCuenta1."'
    and 
    tipoCliente='coaseguro' and statusTraslado='trasladado' and statusCargo='cargado'
    ";
	
$result171=mysql_db_query($basedatos,$sSQL171);
$myrow171 = mysql_fetch_array($result171);
} else {
  $sSQL171= "
	SELECT 
    sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    numeroE = '".$numeroE1."'
    and
    nCuenta='".$nCuenta1."'
    and 
    tipoCliente='coaseguro' and statusTraslado='standby' and statusCargo='cargado'
    ";
$result171=mysql_db_query($basedatos,$sSQL171);
$myrow171 = mysql_fetch_array($result171);
}
}

return $Tcargos=$myrow17['sumaCargos']-$myrow171['sumaCargos'];
}
}//cierra clase


class avisos{
public function despliegaAvisoCoaseguro($entidad,$numeroE,$nCuenta,$basedatos){
$sSQL31= "Select * From avisos WHERE entidad='".$entidad."' AND numeroE = '".$numeroE."' AND nCuenta='".$nCuenta."'
and statusAviso='standby'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
if($myrow31['statusAviso']=='standby'){
return 'Favor de Realizar la transacci�n de pago de coaseguro, est� pendiente.. GRACIAS!';
} else {
return false;
}
}
}



class ventanasPrototype{

public function links(){
?>
<script type="text/javascript" src="/sima/js/window/javascripts/prototype-1.6.0.3.js"> </script> 
<script type="text/javascript" src="/sima/js/window/javascripts/window.js"> </script> 
<script type="text/javascript" src="/sima/js/window/javascripts/window_ext.js"> </script> 
<script type="text/javascript" src="/sima/js/window/javascripts/effects.js"> </script> 
<script type="text/javascript" src="/sima/js/window/javascripts/debug.js"> </script> 
<script type="text/javascript" src="/sima/js/window/javascripts/tooltip.js"> </script> 

	<link href="/sima/js/window/themes/default.css" rel="stylesheet" type="text/css" >	 </link>
	<link href="/sima/js/window/themes/theme1.css" rel="stylesheet" type="text/css" >	 </link>
	<link href="/sima/js/window/themes/mac_os_x.css" rel="stylesheet" type="text/css" >	 </link>
	<link href="/sima/js/window/themes/alphacube.css" rel="stylesheet" type="text/css" >	 </link>
	<link href="/sima/js/window/themes/darkX.css" rel="stylesheet" type="text/css" >	 </link>
	<link href="/sima/js/window/themes/spread.css" rel="stylesheet" type="text/css" >	 </link>
	<link href="/sima/js/window/themes/alert.css" rel="stylesheet" type="text/css" >	 </link>
	<link href="/sima/js/window/themes/alert_lite.css" rel="stylesheet" type="text/css" >	 </link>
<?php 
}

public function despliegaVentana($titulo,$url,$abajo,$izquierda,$anchura,$altura){ ?>
<script>
	
	// Windows with an URL as content
	
	win2 = new Window('dialog2', {title: "<?php echo $titulo;?>", 
							 bottom:<?php echo $abajo;?>, left:<?php echo $izquierda;?>, width:<?php echo $anchura;?>, height:<?php echo $altura;?>, 
								  resizable: true, url: "<?php echo $url;?>", showEffectOptions: {duration:3}})
	win2.show();
	win2.setDestroyOnClose();

</script>
<?php }

public function despliegaMensaje($mensaje){ ?>
    <script type="text/javascript">
	function openAlertDialog() {
		Dialog.alert("<?php echo $mensaje;?>", 
				        {windowParameters: {className: "alphacube", width:300, height:100}, okLabel: "OK", 
						    ok:function(win) {debug("validate alert panel"); return true}
						    });
	
	}


  openAlertDialog();

  </script><?php 
}  

}







class sterr{
    
static public function step($desEntidad,$cadena1,$usuario,$entidad){require('/configuracion/clases/dialog.php');    
$cadena1= base64_decode($cadena);

return  '<div id="taskbar">
	<div id="container">

<div class="block-left">
    <div class="btns">		
  
        '.$cadena1.'
           	 
</div>
      </div>
      


        <div class="block-center">
       
       	  <div class="btns">
 
 
Usuario: '.$usuario.',
Modulo: Principal
</img>              
</div>
      </div>
		


<div class="block-right">   
      <div class="btns">Entidad: '.$desEntidad.'</div>
    </div>
    

    </div>
</div>';
}
}









class submit{

public function submitSinBoton($url,$variable1,$valorVariable1,$forma,$imagen){ ?>

<a href="<?php echo $url;?>?<?php echo $variable1;?>=<?php echo $valorVariable1;?>" 
onclick="javascript:document.<?php echo $forma;?>.submit();">
<img src="/sima/imagenes/expandir.gif" width="12" height="12" border="0">
<?php echo $valorVariable1;?>
</a>
<?php 
}
}
?>




<?php
class cuadritoAcumuladoGPO{
public function mostrarCuadrito($fecha1,$fecha2,$estilo,$entidad,$folioVenta,$basedatos){
?>
<table width="284" border="0" align="left" class="<?php echo $estilo;?>">
        <tr>
          <th width="212" bgcolor="#FFCCFF" class="<?php echo $estilo;?>" scope="col"><div align="left">Descripci&oacute;n</div></th>
          <th width="62" bgcolor="#FFCCFF" class="<?php echo $estilo;?>" scope="col"><div align="left">Importe</div></th>
        </tr>
        <tr>
          <?php
		  
$sSQL14a= "
SELECT 
seguro
FROM
clientesInternos
WHERE 
folioVenta='".$folioVenta."'
";
$result14a=mysql_db_query($basedatos,$sSQL14a);
$myrow14a = mysql_fetch_array($result14a);

		  
		  
		  
$sSQL= "
SELECT codigoGP,descripcionGP FROM gpoProductos
WHERE 
entidad='".$entidad."' 
and
activo='activo'
";
 






if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$C=$myrow['codigoGP'];



$sSQL7D="SELECT SUM((cantidadAseguradora*cantidad)+(cantidadParticular*cantidad)) as acumulado
FROM
cargosCuentaPaciente
WHERE
gpoProducto='".$C."'
and
folioVenta='".$folioVenta."'
 and 
 statusCargo='cargado'
 and
 naturaleza='A'
 and
 status!='transaccion'  
 and
 statusDevolucion='si'";
 
  $result7D=mysql_db_query($basedatos,$sSQL7D);
  $myrow7D = mysql_fetch_array($result7D);




if($fecha1 and $fecha2){



//***************************

  $sSQL7="SELECT SUM((cantidadAseguradora*cantidad)+(cantidadParticular*cantidad)) as acumulado
FROM
cargosCuentaPaciente
WHERE
gpoProducto='".$C."'
and
folioVenta='".$folioVenta."'
 and
 statusCargo='cargado'
  and 
 (fecha1 between'".$fecha1."' and '".$fecha2."')
  and
 naturaleza='C'
  and
 status!='transaccion'

 ";

 
 
 
 
 
 
} else {






//*****************************

$sSQL7="SELECT SUM((cantidadAseguradora*cantidad)+(cantidadParticular*cantidad)) as acumulado
FROM
cargosCuentaPaciente
WHERE
gpoProducto='".$C."'
and
folioVenta='".$folioVenta."'
 and 
 statusCargo='cargado'
 and
 naturaleza='C'
 and
 status!='transaccion'  ";

  
  
  
  
 } 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


?>
          <td  bgcolor="<?php echo $color;?>" ><div align="left"><span class=""> <?php echo $myrow['descripcionGP']; ?></span></div></td>
          <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><?php 
	   $cargos[0]+=($myrow7['acumulado']-$myrow7D['acumulado']);
	  echo "$".number_format($myrow7['acumulado']-$myrow7D['acumulado'],2);	  
	   ?></td>
        </tr>
        <?php }}?>
</table>
	  <?php
	  }
	  }
	  ?>





<?php
class cuadritoAcumuladoF{
public function mostrarCuadritoFacturacion($fecha1,$fecha2,$estilo,$entidad,$numeroE,$nCuenta,$basedatos){

?>
<table width="284" border="0" align="left" class="<?php echo $estilo;?>">
        <tr>
          <th width="212" bgcolor="#FFCCFF" class="<?php echo $estilo;?>" scope="col"><div align="left">Descripci&oacute;n</div></th>
          <th width="62" bgcolor="#FFCCFF" class="<?php echo $estilo;?>" scope="col"><div align="left">Importe</div></th>
		  
        </tr>
        <tr>
          <?php
	
$sSQL71="SELECT sum(precioVenta) as sumaAbonos
FROM
cargosCuentaPaciente
WHERE

folioVenta='".$folioVenta."'
and
tipoCobro='Efectivo'
and
status='transaccion'
and
naturaleza='A'
  ";
 
  $result71=mysql_db_query($basedatos,$sSQL71);
  $myrow71 = mysql_fetch_array($result71);

	
		  
 $sSQL= "
SELECT codigoGP,descripcionGP FROM gpoProductos
WHERE 
entidad='".$entidad."' 
and
activo='activo'
";
 






if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$C=$myrow['codigoGP'];



$sSQL7="SELECT SUM(precioVenta) as acumulado,SUM(iva) as sumaIVA
FROM
cargosCuentaPaciente
WHERE
gpoProducto='".$C."'
and
folioVenta='".$folioVenta."'
 and (status!='standby' and statusCargo!='standby'  AND status!='cancelado')
 and
 statusDevolucion!='si'
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


?>
          <td  bgcolor="<?php echo $color;?>" ><div align="left"><span class=""> <?php echo $myrow['descripcionGP']; ?></span></div></td>
		  
		  
		
          <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><?php 
	 $acumulado[0]+=$myrow7['acumulado'];

	  echo "$".number_format($myrow7['acumulado'],2);	  

	   ?></td>
	   
	   
        </tr>
        <?php }}?>
		
		  
		 
</table>
	
	  <?php
	  }
	  }
	  ?>


<?php 

class ivaCierre{


public function ivaAseguradoraGP($entidad,$cantidad,$gpoProducto,$precioVenta,$basedatos){		

$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' and activo='activo'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){
$iva*='0.01';

return $precioVenta*$iva;
} else {
return 0;
}
}


public function keyPA($codigo,$entidad,$basedatos){		
$sSQL40= "SELECT keyPA
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$codigo."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
return $myrow40['keyPA'];
}



public function ivaAseguradora($entidad,$cantidad,$keyPA,$precioVenta,$basedatos){		

$sSQL40= "SELECT gpoProducto
FROM
articulos
where 
keyPA='".$keyPA."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$gpoProducto=$myrow40['gpoProducto'];
$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' and activo='activo'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){
$iva*='0.01';

return $precioVenta*$iva;
} else {
return 0;
}
}


public function pagoEfectivo($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos){
$sSQL40= "SELECT pagoEfectivo
FROM
clientes
where 
numCliente='".$seguro."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


return $myrow40['pagoEfectivo'];
}



public function formaVenta($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos){





$sSQL40= "SELECT baseParticular
FROM
clientes
where 
numCliente='".$seguro."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


$sSQL13= "
SELECT nivel1,nivel3
FROM
articulosPrecioNivel
WHERE
keyPA='".$keyPA."'
and
almacen='".$almacen."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);

if($myrow40['baseParticular']=='si'){
return $myrow13['nivel1'];
}else{
return $myrow13['nivel3'];
}


}









public function ivaParticularGP($entidad,$cantidad,$gpoProducto,$precioVenta,$basedatos){			

$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' and activo='activo'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){
$iva*='0.01';
return $precioVenta*$iva;
} else {
return 0;
}
}




public function ivaParticular($entidad,$cantidad,$keyPA,$precioVenta,$basedatos){			

 $sSQL40= "SELECT gpoProducto
FROM
articulos
where 
keyPA='".$keyPA."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$gpoProducto=$myrow40['gpoProducto'];
$sSQL8= "
SELECT tasaGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."' and activo='activo'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);
$iva= $myrow8['tasaGP'];

if(is_numeric($iva)){
$iva*='0.01';
return $precioVenta*$iva;
} else {
return 0;
}
}





}

?>





<?php
class cierraCuenta{



 public function convenioParticularCC($basedatos,$usuario,$keyClientesInternos){		
 $sSQL17= "
	SELECT 
    SUM((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
WHERE 
	keyClientesInternos='".$keyClientesInternos."'
and 
statusCargo='cargado' 
and naturaleza='C'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




$sSQL= "
	SELECT 
cantidadParticular as sumaAbonos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
status='transaccion' 
and naturaleza='A'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQL2= "
	SELECT 
SUM((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as TCargos
FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$keyClientesInternos."'
and 
status='transaccion'
and
naturaleza='C' 
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
return round($myrow17['sumaCargos']-($myrow['sumaAbonos']+$myrow2['TCargos']),2);
}



public function cargosParticularesFV($basedatos,$usuario,$fv){		
$sSQL17= "
	SELECT 
    sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    folioVenta='".$fv."'
    and 

    statusCargo='cargado'
	and
	naturaleza='C'
    ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);



$t=round($myrow17['sumaCargos']);
if($t<0 or $t>1){
return $t;
}else {
return 0;
}
}	



public function cargosAseguradoraDiscrimina($basedatos,$usuario,$kk){		
	$sSQL17= "
	SELECT 
    sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    keyClientesInternos='".$kk."'
    and 
	
    statusCargo='cargado'
	and
	naturaleza='C'
	and
	statusDevolucion!='si'
	and
	gpoProducto!=''
    ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
return $myrow17['sumaCargos'];
}

public function cargosParticularesDiscrimina($basedatos,$usuario,$kk){		
	$sSQL17= "
	SELECT 
    sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    keyClientesInternos='".$kk."'
    and 
	
    statusCargo='cargado'
	and
	naturaleza='C'
	and
	statusDevolucion!='si'
	and
	gpoProducto!=''
    ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
return $myrow17['sumaCargos'];
}





public function cargosParticularesCCCD($basedatos,$usuario,$kk){		
	$sSQL17= "
	SELECT 
    sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    keyClientesInternos='".$kk."'
    and 
    statusCargo='cargado'
	and
	naturaleza='C'
	and
	statusDevolucion!='si'
    ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


    $sSQL17a= "
	SELECT 
    sum((precioVenta*cantidad)+(iva*cantidad)) as sumaAbonos
    FROM
    cargosCuentaPaciente
    WHERE 
    keyClientesInternos='".$kk."'
    and 
	(tipoCliente='particular' or tipoPago='Nomina')
	and
    naturaleza='A'
	and
	statusDevolucion!='si'
    ";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);




    //***********************DEVOLUCIONES***************************
    $sSQL17ad= "
	SELECT 
    sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaDevoluciones
    FROM
    cargosCuentaPaciente
    WHERE 
    keyClientesInternos='".$kk."'
	and 
    statusCargo='cargado'
    and 
    naturaleza='A'
    and
	statusDevolucion='si'
	";
$result17ad=mysql_db_query($basedatos,$sSQL17ad);
$myrow17ad = mysql_fetch_array($result17ad);

//*************************************************************
return ($myrow17['sumaCargos']-$myrow17a['sumaAbonos'])-$myrow17ad['sumaDevoluciones'];
}	





public function cargosParticularesCC($entidad,$basedatos,$usuario,$kk){		
	$sSQL17= "
	SELECT 
    sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
	entidad='".$entidad."'
	and
    keyClientesInternos='".$kk."'
    and 
    statusCargo='cargado'
	and
	naturaleza='C'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


    $sSQL17a= "
	SELECT 
    sum((precioVenta*cantidad)+(iva*cantidad)) as sumaAbonos
    FROM
    cargosCuentaPaciente
    WHERE 
	entidad='".$entidad."'
	and
    keyClientesInternos='".$kk."'
    and 
	(tipoCliente='particular' or tipoPago='Nomina')
	and
    naturaleza='A'
	and
	statusDevolucion!='si'
    ";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);




//***********************DEVOLUCIONES***************************
//deben estar en el cargo
    $sSQL17ad= "
	SELECT 
    sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as sumaDevoluciones
    FROM
    cargosCuentaPaciente
    WHERE 
	entidad='".$entidad."'
	and
    keyClientesInternos='".$kk."'
    and 
    naturaleza='A'
    and
	statusDevolucion='si'
	";
$result17ad=mysql_db_query($basedatos,$sSQL17ad);
$myrow17ad = mysql_fetch_array($result17ad);

//*************************************************************
return ($myrow17['sumaCargos']-$myrow17a['sumaAbonos'])-$myrow17ad['sumaDevoluciones'];
}		














public function cargosAseguradoraCC($entidad,$basedatos,$usuario,$kk){		

  $sSQL17= "
	SELECT 
    sum((cantidadAseguradora*cantidad)+ (ivaAseguradora*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
	entidad='".$entidad."'
	and
    keyClientesInternos='".$kk."'

    and 
    statusCargo='cargado'
	and
	naturaleza='C'

    ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

    $sSQL17a= "
	SELECT 
    sum((cantidadAseguradora*cantidad)+ (ivaAseguradora*cantidad)) as sumaAbonos
    FROM
    cargosCuentaPaciente
    WHERE 
		entidad='".$entidad."'
	and
    keyClientesInternos='".$kk."'
    and 

    naturaleza='A'
	    and 
	tipoCliente='aseguradora'
	and
	statusDevolucion!='si'
    ";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);

//devoluciones


    $sSQL17c= "
	SELECT 
    sum(precioVenta*cantidad) as coa
    FROM
    cargosCuentaPaciente
    WHERE 
		entidad='".$entidad."'
	and
    keyClientesInternos='".$kk."'
    and 
	tipoCliente='coaseguro'
	and
    naturaleza='A' ";
$result17c=mysql_db_query($basedatos,$sSQL17c);
$myrow17c = mysql_fetch_array($result17c);

 $sSQL17b= "
	SELECT 
    sum((cantidadAseguradora*cantidad)+ (ivaAseguradora*cantidad)) as sumaDevoluciones
    FROM
    cargosCuentaPaciente
    WHERE 
		entidad='".$entidad."'
	and
    keyClientesInternos='".$kk."'
    and
    naturaleza='A'
	and
	statusDevolucion='si'
    ";
$result17b=mysql_db_query($basedatos,$sSQL17b);
$myrow17b = mysql_fetch_array($result17b);


$t=(($myrow17['sumaCargos']-$myrow17a['sumaAbonos'])-$myrow17c['coa'])-$myrow17b['sumaDevoluciones'];
if($t<0 or $t>1){
return $t;
}else {
return 0;
}
}			



public function cargosAseguradoraCCFV ($basedatos,$usuario,$kk){		

    $sSQL17= "
	SELECT 
    sum((cantidadAseguradora*cantidad)+ (ivaAseguradora*cantidad)) as sumaCargos
    FROM
    cargosCuentaPaciente
    WHERE 
    folioVenta='".$kk."'
    and 
	tipoCliente='aseguradora'
    and 
    statusCargo='cargado'
	and
	naturaleza='C'
    ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);



return $myrow17['sumaCargos'];
}			


}
?>











<?php 
class ventanasCentro{
public function despliegaVentanaCentro($background,$opacidad,$ancho,$altura,$anchoFrame,$alturaFrame,$anchoDiv,$alturaDiv){?>
<script type="text/javascript" src="/sima/js/window/javascripts/prototype-1.6.0.3.js"> </script> 
<script type="text/javascript">
	var theWidth = <?php echo $ancho;?>, theHeigth = <?php echo $altura;?>;

	function inicio(){
		if (window.parent.innerWidth){
		  theWidth = window.parent.innerWidth
		  theHeight = window.parent.innerHeight
		}
		else if (parent.document.documentElement && parent.document.documentElement.clientWidth){
		  theWidth = parent.document.documentElement.clientWidth
		  theHeight = parent.document.documentElement.clientHeight
		}
		else if (parent.document.body){
		  theWidth = parent.document.body.clientWidth
		  theHeight = parent.document.body.clientHeight
		}
	}

	function muestraFondo(){
		$(document.body).insert({
			bottom: '<div id="fondo" style="position: fixed; z-index: 10;"></div>'
		});
		var div = $("fondo");
		div.setStyle({
			top: '0px',
			left: '0px',
			backgroundColor: '<?php echo $background;?>',
			opacity: <?php echo $opacidad;?>,
			width: ''
		});
		div.style.width = (theWidth)+"px";
		div.style.height = (theHeight)+"px";
	}
	
	function quitaFondo(){
		if($("fondo"))
			$("fondo").remove();
	}
	
	function muestraVentana(url){
		cierraVentana();
		muestraFondo();
		$(document.body).insert({
			bottom: '<div id="ventana" align="center" style="position: fixed; z-index: 20;">'+
						'<iframe src="'+url+'" id="iframe"></iframe>'+
						'<input type="button" value="cancelar" onclick="cierraVentana();" />'+
					'</div>'
		});
		
		var iframe = $("iframe");
		iframe.setStyle({
			width: '<?php echo $anchoFrame;?>px',
			height: '<?php echo $alturaFrame;?>px',
			border: 'solid 1px black'
		});
		
		var div = $("ventana");
		div.setStyle({
			width: '<?php echo $anchoDiv;?>px',
			height: '<?php echo $alturaDiv;?>px'
		});
		
		div.style.left = ((theWidth/2)-(div.getWidth()/2))+"px";
		div.style.top = ((theHeight/2)-(div.getHeight()/2))+"px";
	}
	
	function cierraVentana(){
		if($("ventana"))
			$("ventana").remove();
		quitaFondo();
	}
	<?php 
	/*function ejemploAjax(){
		var url= "busca.jsp?Accion=1&dato1=hola";
		
		new Ajax.Request(url, {
			method: "get",
			onSuccess: function (req){
				div.innerHTML = req.responseText;
			},
			onFailure: function (req){
				alert("no pudo conectarse a la pagina. Reportelo a sistemas");
			},
			onCreate: function (req){
				muestraCargand();
			},
			onComplete: function (req){
				ocultaCargando();
			}
		});
	}*/?>
</script>
<?php 
}
}
?>






<?php 
class totales{
public function tt($entidad,$class,$estilo,$fechas1,$fechas2,$keyClientesInternos,$folioVenta,$basedatos){?>
<div align="center">
    <div align="left">
      <p>&nbsp;</p>
     <table width="312" border="0" align="left" class="normal">
        <tr>
          <th width="212" bgcolor="#FFFF00" class="negromid" scope="col"><div align="left">Descripci&oacute;n</div></th>
          <th width="62" bgcolor="#FFFF00" class="negromid" scope="col"><div align="left">Importe</div></th>
       </tr>
        <tr>
          <?php
		  
$sSQL14a= "
SELECT 
seguro
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
";
$result14a=mysql_db_query($basedatos,$sSQL14a);
$myrow14a = mysql_fetch_array($result14a);

		  
		  
		  
$sSQL= "
SELECT codigoGP,descripcionGP FROM gpoProductos
WHERE 
entidad='".$entidad."' 
and
activo='activo'
";
 






if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];


$C=$myrow['codigoGP'];



$sSQL7D="SELECT SUM((cantidadAseguradora*cantidad)+(cantidadParticular*cantidad)) as acumulado
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto='".$C."'
and
folioVenta='".$folioVenta."'
 and 
 statusCargo='cargado'
 and
 naturaleza='A'
 and
 status!='transaccion'  
 and
 statusDevolucion='si'";
 
  $result7D=mysql_db_query($basedatos,$sSQL7D);
  $myrow7D = mysql_fetch_array($result7D);




if($fecha1 and $fecha2){



//***************************

  $sSQL7="SELECT SUM((cantidadAseguradora*cantidad)+(cantidadParticular*cantidad)) as acumulado
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto='".$C."'
and
folioVenta='".$folioVenta."'
 and
 statusCargo='cargado'
  and 
 (fecha1 between'".$fechas1."' and '".$fechas2."')
  and
 naturaleza='C'
  and
 status!='transaccion'

 ";

 
 
 
 
 
 
} else {






//*****************************

$sSQL7="SELECT SUM((cantidadAseguradora*cantidad)+(cantidadParticular*cantidad)) as acumulado
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto='".$C."'
and
folioVenta='".$folioVenta."'
 and 
 statusCargo='cargado'
 and
 naturaleza='C'
 and
 status!='transaccion'  ";

  
  
  
  
 } 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


?>
          <td  bgcolor="<?php echo $color;?>" ><div align="left"><span class="normalmid"> <?php echo $myrow['descripcionGP']; ?></span></div></td>
          <td bgcolor="<?php echo $color;?>"  align="right" class="precio1"><?php 
	   $cargos[0]+=($myrow7['acumulado']-$myrow7D['acumulado']);
	  echo "$".number_format($myrow7['acumulado']-$myrow7D['acumulado'],2);	  
	   ?></td>
        </tr>
        <?php }}?>
</table>

      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>

      <table width="292" border="0" align="left" class="normal">
        <tr>
          <td width="153" height="23" align="center" class="normalmid">IVA</td>
          <td width="129" class="negromid"><div align="right">
            <?php $iva=new acumulados();
$ivaD=new acumulados();
$iva=$iva->ivaAcumulado($entidad,$basedatos,$usuario,$keyClientesInternos)-$ivaD->ivaAcumuladoD($entidad,$basedatos,$usuario,$keyClientesInternos);
	
		echo "$".number_format($iva,2);
		?>
          </div></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <table width="292" border="0" align="left" class="normal">

        <tr bgcolor="#FFCCFF">
          <td width="158" height="23" bgcolor="#FFFF00" class="negromid">Cargos</td>
          <td width="124" bgcolor="#FFFF00" class="precio1"><div align="right">
            <?php 
		
		$coaseguroN=new acumulados();
		$coa=$coaseguroN->cargosCoaseguroN($entidad,$basedatos,$usuario,$keyClientesInternos);	
		$totalAcumulado=new acumulados();
		$totalDevoluciones=new acumulados();


$cargos=(($totalAcumulado->totalAcumulado($basedatos,$usuario,$keyClientesInternos)-$totalDevoluciones->dev($entidad,$basedatos,		$usuario,$folioVenta))+$iva);
		

		

		echo "$".number_format($cargos,2);?>
          </div></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <table width="293" border="0" align="left"  >
        <tr bgcolor="#FFCCFF">
          <td width="158" height="23" bgcolor="#CCCCCC" class="normal"><span class="negromid">Total Abonos</span></td>
          <td width="125" bgcolor="#CCCCCC" class="precio2"><div align="right">
              <?php 		 
		$abonos=new acumulados();
		$abonoS=$abonos->abonos($entidad,$basedatos,$usuario,$folioVenta); 
		echo "$".number_format($abonos->abonos($entidad,$basedatos,$usuario,$folioVenta),2); ?>
          </div></td>
        </tr>
        <tr>
          <td height="23" class="negromid">Saldo Actual </td>
      <td class="titulomedio"><div align="right">
              <?php
			  if($abonoS<0){
		$STotal=$cargos+$abonoS;
		}else{
		$STotal=$cargos-$abonoS;
		}
		echo "$".number_format($STotal,2);
		?>
          </div></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
    <p>&nbsp;</p>
    <table width="279" border="0" align="center" class="normal">
      <tr>
        <td width="197" height="23" class="error2">Total por Surtir (iva incluido ) </td>
        <td width="72" class="precio2"><div align="right">
            <?php $totalxSurtir=new acumulados();
		echo "$".number_format($totalxSurtir->totalxSurtirFV($entidad,$basedatos,$usuario,$folioVenta),2);?>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
</div>
  <?php
  }
  }
  ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <?php 
class contenidos{
public function desplegarContenidos($entidad,$class,$estilo,$fechas1,$fechas2,$keyClientesInternos,$folioVenta,$basedatos){?>


  


  <table width="1081" height="53" border="0.2" align="center" >
    <tr bgcolor="#330099">

        
        
      <th width="39" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Ref</div>
      </div></th>
      <th width="41" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Fecha</div>
      </div></th>
      <th width="192" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Descripcion</div>
      </div></th>
      <th width="174" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Departamento/Dr</div>
      </div></th>
      <th width="127" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Seguro</div>
      </div></th>
      <th width="127" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Tipo</div>
      </div></th>
      <th width="36" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Cant.</div>
      </div></th>
      <th width="66" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">P.Unit.</div>
      </div></th>
      <th width="76" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Part.</div>
      </div></th>
      <th width="63" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">Aseg.</div>
      </div></th>
      <th width="73" bgcolor="#FFFF00" class="none" scope="col"><div align="left" class="none">
        <div align="center">IVA</div>
      </div></th>
      <th width="17" bgcolor="#FFFF00" class="none" scope="col">N</th>
    </tr>
      <tr>
      
      
        <?php 
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
and
 (naturaleza='C' or naturaleza='A')
order by fecha1 ASC
";		
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codProcedimiento'];
//*************************************CONVENIOS********************************************
$sSQL12= "
SELECT descripcion
FROM
  articulos
WHERE 
entidad='".$entidad."'
and
(keyPA='".$myrow['keyPA']."' or codigo='".$myrow['codProcedimiento']."')
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


//cierro descuento
if($myrow['statusDevolucion']=='si' AND $myrow['naturaleza']=='A'){
$devolucionFinal[0]+=(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']));
}

if($myrow['naturaleza']=='C'){
$cargosFinal[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}

if($myrow['statusDevolucion']!='si'){
if($myrow['naturaleza']=='A'){
$abonosFinal[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}
}













if($myrow['statusCargo']!='cargado' and status!='transaccion'){
$sC+=1;

}
?>
<tr bgcolor="#FFFFFF" onMouseOver="bgColor='#FFFFFF'" onMouseOut="bgColor='#ffffff'" >   
  <td bgcolor="<?php echo $color;?>" class="codigos"><span class="normalmid"><?php echo $myrow['keyCAP']; ?></span></td>
		  <td bgcolor="<?php echo $color;?>" class="normal"><span class="normalmid"><?php echo cambia_a_normal($myrow['fecha1']); ?></span></td>
        <td height="24" bgcolor="<?php echo $color;?>" class="normal"><span class="normalmid">
		<?php 
		if($myrow['status']=='transaccion'){
		$sSQL341= "Select descripcion From catTTCaja WHERE entidad='".$entidad."' and codigoTT = '".$myrow['tipoTransaccion']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);

		echo $myrow341['descripcion'];
		}else{
		if($myrow['descripcion']){
		echo $myrow['descripcion']; 
		}else{
		echo $myrow12['descripcion'];
		}}
		?>
        <?php 
		
		
		echo '</br>';
		if($myrow['statusDevolucion']=='si' and $myrow['naturaleza']=='A'){
		
		print '<span class="error">'.'[Devolucion Folio: '.$myrow['folioDevolucion'] . ']'.'</span>';
		print '<br>';
		if($myrow['statusCargo'] == 'standbyR'){
		print '<blink><span  class="error">'.'El usuario: '.$myrow['usuario'].' no ha enviado la solicitud!'.'</span></blink>';
		}else if($myrow['statusCargo'] =='standby'){
		print '<span class="error">'.'[sin surtir]'.'</span>';
		}else if($myrow['statusCargo']=='cargado'){
		print '<span  class="codigos">'.'[cargado]'.'</span>';
		}
		}else{
		if($myrow['statusCargo'] == 'standbyR'){
		print '<blink><span  class="error">'.'El usuario: '.$myrow['usuario'].' no ha enviado la solicitud!'.'</span></blink>';
		}else if($myrow['statusCargo'] =='standby'){
		print '<span class="error">'.'[sin surtir]'.'</span>';
		}else if($myrow['statusCargo']=='cargado'){
		print '<span  class="codigos">'.'[cargado]'.'</span>';
		}
		}
		//echo $myrow['statusDevolucion'].$myrow['folioDevolucion'];
		?>
        </span></td>
        
        
<td bgcolor="<?php echo $color;?>" class="normalmid"><div align="center">
  <?php 
$sSQL12a1= "
SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacenDestino']."'
";
$result12a1=mysql_db_query($basedatos,$sSQL12a1);
$myrow12a1 = mysql_fetch_array($result12a1);
if($myrow12a1['descripcion']){
echo $myrow12a1['descripcion'];
}else if($myrow['status']=='transaccion'){
print 'Transaccion';

} else{
echo '---';
}
?>
</div></td>




        <td bgcolor="<?php echo $color;?>" class="normalmid"><div align="center">
          <?php 
$sSQL12a= "
SELECT nomCliente
FROM
clientes
WHERE
entidad='".$entidad."'
and 
numCliente='".$myrow['seguro']."'
";
$result12a=mysql_db_query($basedatos,$sSQL12a);
$myrow12a = mysql_fetch_array($result12a);
if($myrow['seguro']){
echo $myrow12a['nomCliente'];
}else {
print 'Particular';
}
?>
        </div></td>
        <td bgcolor="<?php echo $color;?>" class="normalmid">
          <div align="center">
            <?php 
$sSQL12a= "
SELECT descripcionGP
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'
";
$result12a=mysql_db_query($basedatos,$sSQL12a);
$myrow12a = mysql_fetch_array($result12a);
if($myrow12a['descripcionGP']){
echo $myrow12a['descripcionGP'];
}else if($myrow['status']=='transaccion'){
print 'Transaccion';

} else{
echo '---';
}
?>        
      </div></td>
        <td bgcolor="<?php echo $color;?>" class="normalmid"><div align="center"><?php echo $myrow['cantidad']?></div></td>
        <td bgcolor="<?php echo $color;?>" class="normalmid">
      <div align="right">
        <?php 
		
		echo '$'.number_format($myrow['precioVenta'],2);
		
		?>
      </div><div align="right"></div></td>
        <td bgcolor="<?php echo $color;?>" class="normal"><div align="right"><span class="precbluemid">
          <?php 
		
		
	if($myrow['cantidadParticular']){
	echo "$".number_format($myrow['cantidadParticular']*$myrow['cantidad'],2);
	}  else {
	echo "0.00";
	}
	
	
	?>
        </span></div></td>
        <td bgcolor="<?php echo $color;?>"><div align="right"><span class="precredmid">
          <?php 
		  
	if($myrow['cantidadAseguradora']){
	echo "$".number_format($myrow['cantidadAseguradora']*$myrow['cantidad'],2);
	}  else {
	echo "0.00";
	}

	  ?>
        </span></div></td>
        <td bgcolor="<?php echo $color;?>" class="negromid"><div align="right">
          <?php 
		
	echo '$'.number_format($myrow['iva']*$myrow['cantidad'],2);
	
	
	  ?>
        </span></div></td>
        <td bgcolor="<?php echo $color;?>" class="normalmid"><div align="center"><?php 
		if($myrow['statusDevolucion']=='si' and $myrow['naturaleza']=='A'){
		echo '-';
		}else{
		echo $myrow['naturaleza'];
		}
		?></div></td>
    </tr>
 </td>
    </tr>
    <?php }?>
  </table>
  

     

  
  <?php 
  }
  }
  ?>

<?php
  // Funciona edad (formato: a�o/mes/dia)

function edad($edad){
list($anio,$mes,$dia) = explode("-",$edad);
$anio_dif = date("Y") - $anio;
$mes_dif = date("m") - $mes;
$dia_dif = date("d") - $dia;
if ($dia_dif < 0 || $mes_dif < 0)
$anio_dif--;
echo $anio_dif;
}

?>




























<?php 
class menus{  
    
    
    
    
    
    
    
public function principalMenu($reservado1,$reservado2,$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos){
    
//************TESTING****************
  
    
/*  
//TODOS LOS MODULOS PRINCIPALES
$sSQLmp= "Select * From usersmodules WHERE (entidad='".$entidad."' and usuario='".$usuario."'
    and
extension>0  
)
or
(usuario='".$usuario."'
    and
    global='si'
)
group by main  ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
while($myrowmp = mysql_fetch_array($resultmp)){
    
    //TRAES EL USUARIO, ASIGNA MODULOS; AHORA DIME LA RUTA
    if($myrowmp['global']=='si'){
    $sSQLmu1= "Select * From mainmodules WHERE name='".$myrowmp['main']."'";
    $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
    $myrowmu1 = mysql_fetch_array($resultmu1);    
    }else{    
    $sSQLmu1= "Select * From mainmodules WHERE entidad='".$entidad."' AND name='".$myrowmp['main']."'";
    $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
    $myrowmu1 = mysql_fetch_array($resultmu1);
    }
    
    
    
    if($myrowmp['usuario']!=NULL){

//$myrowmu1['name'].trim($myrowmu1['ruta']).$myrowmp['main'];//termina ciclo
        
        
//COMIENZA MENU PRINCIPAL        

                



                
                
                print '<span>'.$myrowmu1['name'].'</span></a>';
                


                //SUBMENUS NIVEL 1************************
                print '<ul>';
                
                
                
                //SUBMENUS NIVEL2
                
                //print '<li><a href="#"><span>INVENTARIOS</span></a>';
                $sSQLmu1= "Select menuname From primarymodules WHERE entidad='".$entidad."' AND mainmenu='".$myrowmu1['name']."' 
                group by menuname
                order by mainmenu ASC";
                $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
                while($myrowmu1 = mysql_fetch_array($resultmu1)){
                $mainmodulename=$myrowmu1['menuname'];    
                print '<li><a href="#"><span>'.$myrowmu1['menuname'].'</span></a>';
                
                



                //SUBMENUS NIVEL3
                print '<ul>';
                $sSQLmp1= "Select secondary From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."' 
                and
                primario='".$myrowmu1['menuname']."' 
                and
                extension>0 
                group by secondary    
                ";
                $resultmp1=mysql_db_query($basedatos,$sSQLmp1);
                while($myrowmp1 = mysql_fetch_array($resultmp1)){
                echo '<li><a href="#"><span>'.$myrowmp1['secondary'].'</span></a>';
                
                
                
                
                
                
                //SUBMENUS NIVEL 4
                $sSQLmpv2= "Select * From extensionmodules WHERE entidad='".$entidad."'  
                and mainmodulename='".$mainmodulename."'
                and
                mainmodule='".$myrowmp1['secondary']."'";
                $resultmpv2=mysql_db_query($basedatos,$sSQLmpv2);
                while($myrowmpv2 = mysql_fetch_array($resultmpv2)){
                print '<ul>';
        	print '<li><a href="'.$myrowmpv2['ruta'].'">'.$myrowmpv2['name'].'</a></li>';				
    		print '</ul></li>';
                
                }
                //CIERRA NIVEL 4
                
                
                
                
                
                
                
                
                
                
                
                }//cierra while nivel 3
                print '</ul>';
                //CIERRO NIVEL 3
                
                
                
                }//cierra while nivel2

                
                
                
                
                
                print '</li>';
                
                //SUBMENU NIVEL2
                
                
                
                
                
                print '</ul>';
                 //TERMINA SUBMENUS NIVEL 1****************
                
                
                
                //TERMINA MENU PRINCIPAL
	        print '</ul></li>';
               
                        
    }
}//cierra while nivel 1    
    
*/    
//**********CIERRA TESTING***********    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 echo '<link type="text/css" rel="stylesheet" href="/sima/js/taskbar.css" />';
echo '<style type="text/css">
<!--
pre{
	width:600px;
	border:1px dashed #CCCCCC;
	overflow:auto;
}
-->
</style>';  
    
echo '<style type="text/css">
<!--
A.ssmItems:link		{color:black;text-decoration:none;}
A.ssmItems:hover	{color:black;text-decoration:none;}
A.ssmItems:active	{color:black;text-decoration:none;}
A.ssmItems:visited	{color:black;text-decoration:none;}
//-->
</style>';   
    
    
print '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="css.css" type="text/css">
	<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="index_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<!-- End css3menu.com HEAD section -->      ';

     

 //TODOS LOS MODULOS PRINCIPALES
$sSQLmp= "Select * From usersmodules WHERE (entidad='".$entidad."' and usuario='".$usuario."'
    and
extension>0  
)
or
(usuario='".$usuario."'
    and
    global='si'
)
group by main  ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
while($myrowmp = mysql_fetch_array($resultmp)){
    
    //TRAES EL USUARIO, ASIGNA MODULOS; AHORA DIME LA RUTA
    if($myrowmp['global']=='si'){
    $sSQLmu1= "Select * From mainmodules WHERE name='".$myrowmp['main']."'";
    $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
    $myrowmu1 = mysql_fetch_array($resultmu1);    
    }else{    
    $sSQLmu1= "Select * From mainmodules WHERE entidad='".$entidad."' AND name='".$myrowmp['main']."'";
    $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
    $myrowmu1 = mysql_fetch_array($resultmu1);
    }
    
    
    
    if($myrowmp['usuario']!=NULL){

//$myrowmu1['name'].trim($myrowmu1['ruta']).$myrowmp['main'];//termina ciclo
        
        
//COMIENZA MENU PRINCIPAL        
echo '<ul id="css3menu1" class="topmenu">';
echo '<li class="topfirst"><a href="#" style="height:21px;line-height:21px;">';
                



                
                
                print '<span>'.$myrowmu1['name'].'</span></a>';
                


                //SUBMENUS NIVEL 1************************
                print '<ul>';
                
                
                
                //SUBMENUS NIVEL2
                
                //print '<li><a href="#"><span>INVENTARIOS</span></a>';
                $sSQLmu1= "Select menuname From primarymodules WHERE entidad='".$entidad."' AND mainmenu='".$myrowmu1['name']."' 
                group by menuname
                order by mainmenu ASC";
                $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
                while($myrowmu1 = mysql_fetch_array($resultmu1)){
                $mainmodulename=$myrowmu1['menuname'];    
                print '<li><a href="#"><span>'.$myrowmu1['menuname'].'</span></a>';
                
                



                //SUBMENUS NIVEL3
                print '<ul>';
                $sSQLmp1a= "Select secondary From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."' 
                and
                primario='".$myrowmu1['menuname']."' 
                and
                extension>0 
                group by secondary    
                ";
                $resultmp1a=mysql_db_query($basedatos,$sSQLmp1a);
                while($myrowmp1a = mysql_fetch_array($resultmp1a)){
                echo '<li><a href="#"><span>'.$myrowmp1a['secondary'].'</span></a>';
                
                
                
                
                
                
                //SUBMENUS NIVEL 4
                $sSQLmpv2c= "Select * From extensionmodules WHERE entidad='".$entidad."'  
                and mainmodulename='".$mainmodulename."'
                and
                mainmodule='".$myrowmp1a['secondary']."'";
                $resultmpv2c=mysql_db_query($basedatos,$sSQLmpv2c);
                while($myrowmpv2c = mysql_fetch_array($resultmpv2c)){
                print '<ul>';
        	print '<li><a href="'.$myrowmpv2c['ruta'].'">'.$myrowmpv2c['name'].'</a></li>';
               
                //print '<li><a href="#">SURTIR DEVOLUCIONES</a></li>';
                print '</ul>';
                print '</li>';
                
                }
                //CIERRA NIVEL 4
                
                
                
                
                
                
                
                
                
                
                
                }//cierra while nivel 3
                print '</ul>';
                //CIERRO NIVEL 3
                
                
                
                }//cierra while nivel2

                
                
                
                
                
                print '</li>';
                
                //SUBMENU NIVEL2
                
                
                
                
                
                print '</ul>';
                 //TERMINA SUBMENUS NIVEL 1****************
                
                
                
                //TERMINA MENU PRINCIPAL
	        print '</ul></li>';
               
                        
    }
}//cierra while nivel 1

echo '<ul id="css3menu1" class="topmenu">';
print '
<li class="toplast"><a href="#" style="height:21px;line-height:21px;">SALIR DEL SISTEMA</a></li>
</ul><p class="_css3m"></p>';
  
  
  
//NO AFECTA ENTIDADeS
$sSQL1E= "Select * From entidades WHERE codigoEntidad='".$entidad."' ";
$result1E=mysql_db_query($basedatos,$sSQL1E);
$myrow1E = mysql_fetch_array($result1E);


//DEMAS DATOS DEL USUARIO
$sSQL1Ec= "Select * From usuarios WHERE usuario='".$usuario."' ";
$result1Ec=mysql_db_query($basedatos,$sSQL1Ec);
$myrow1Ec = mysql_fetch_array($result1Ec);

//$classS=new sterr();menu
//print $classS->step($myrow1E['descripcionEntidad'],$cadena,$usuario,$entidad);
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
public function mainmenu($reservado1,$reservado2,$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos){

    
echo '<link type="text/css" rel="stylesheet" href="/sima/js/taskbar.css" />';
echo '<style type="text/css">
<!--
pre{
	width:600px;
	border:1px dashed #CCCCCC;
	overflow:auto;
}
-->
</style>';  
    
echo '<style type="text/css">
<!--
A.ssmItems:link		{color:black;text-decoration:none;}
A.ssmItems:hover	{color:black;text-decoration:none;}
A.ssmItems:active	{color:black;text-decoration:none;}
A.ssmItems:visited	{color:black;text-decoration:none;}
//-->
</style>';

echo '<SCRIPT SRC="/sima/js/ssm.js" language="JavaScript1.2"></SCRIPT>';
require("../sima/js/utilerias.php");    
  
    
echo '<script type="text/javascript"  src="/sima/js/new/stmenu.js"></script>';
//encabezado
print '<script type="text/javascript">';

print 'stm_bm(["menu3ba5",900,"","/sima/imagenes/blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","",0,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,5,0,0,100,"",-2,"",-2,50,0,0,"#999999","#E6EFF9","/sima/imagenes/bg_02.png",3,0,0,"#000000","",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_03.png",37,3,0,"#FFFFF7","",3,"",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_01.png",37,3,0,"#FFFFF7","",3,"","","","",20,20,20,20,20,20,20,20]);';

 //TODOS LOS MODULOS PRINCIPALES
$sSQLmp= "Select * From usersmodules WHERE (entidad='".$entidad."' and usuario='".$usuario."'
    and
extension>0  
)
or
(usuario='".$usuario."'
    and
    global='si'
)
group by main  ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
//$resultmp=mysql_real_escape_string($resultmp);
while($myrowmp = mysql_fetch_array($resultmp)){
    
    //TRAES EL USUARIO, ASIGNA MODULOS; AHORA DIME LA RUTA
    if($myrowmp['global']=='si'){
    $sSQLmu1= "Select * From mainmodules WHERE name='".$myrowmp['main']."'";
    $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
    $myrowmu1 = mysql_fetch_array($resultmu1);    
    }else{    
    $sSQLmu1= "Select * From mainmodules WHERE entidad='".$entidad."' AND name='".$myrowmp['main']."'";
    $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
    $myrowmu1 = mysql_fetch_array($resultmu1);
    }
    
    
    
    if($myrowmp['usuario']!=NULL){
    print '
<!------------INICIO PROGRAMAS----------------------
stm_aix("p0i1","p0i0",[0,"'.$myrowmu1['name'].'","","",-1,-1,0,"'.trim($myrowmu1['ruta']).'?main='.$myrowmp['main'].'","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"","4545454.gif",3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#434142","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#29ABE2","#29ABE2","",3,1,1,"#29ABE2"]);
stm_ep();
//---------------FIN DE PROGRAMAS------------------>
';//termina ciclo
    }
}







//***FOOTER***
print '<!------------INICIO SALIR----------------------
stm_aix("p0i1","p0i0",[0,"SALIR","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"",,3,0,0,0,"#E6EFF9","#000000","#ea765a","#434142","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-64,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#29ABE2","#6bb5d5","",3,1,1,"#6bb5d5"]);




stm_aix("p1i0","p0i1",[0,"Salir del Sistema","","",-1,-1,0,"/sima/salir.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#808080","#FFFFFF","#434142"],165,20);

stm_ep();
//---------------FIN --------------->
stm_ep();

stm_em();';

print '</script>';




//NO AFECTA ENTIDADeS
$sSQL1E= "Select * From entidades WHERE codigoEntidad='".$entidad."' ";
$result1E=mysql_db_query($basedatos,$sSQL1E);
$myrow1E = mysql_fetch_array($result1E);


//DEMAS DATOS DEL USUARIO
$sSQL1Ec= "Select * From usuarios WHERE usuario='".$usuario."' ";
$result1Ec=mysql_db_query($basedatos,$sSQL1Ec);
$myrow1Ec = mysql_fetch_array($result1Ec);

$classS=new sterr();
print $classS->step($myrow1E['descripcionEntidad'],$cadena,$usuario,$entidad);
}













public function menuOperaciones($mainmenu,$reservado2,$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos){

echo '<link type="text/css" rel="stylesheet" href="/sima/js/taskbar.css" />';
echo '<style type="text/css">
<!--
pre{
	width:600px;
	border:1px dashed #CCCCCC;
	overflow:auto;
}
-->
</style>';      

echo '<style type="text/css">
<!--
A.ssmItems:link		{color:black;text-decoration:none;}
A.ssmItems:hover	{color:black;text-decoration:none;}
A.ssmItems:active	{color:black;text-decoration:none;}
A.ssmItems:visited	{color:black;text-decoration:none;}
//-->
</style>';

echo '<SCRIPT SRC="/sima/js/ssm.js" language="JavaScript1.2"></SCRIPT>';
require("../js/utilerias.php");    

//VALIDACIONES
$sSQLmp= "Select * From usersmodules WHERE (entidad='".$entidad."' and usuario='".$usuario."'  and main='".$mainmenu."'
    and
extension>0)
or
(
usuario='".$usuario."'  and main='".$mainmenu."' and global='si'
)

";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
$myrowmp = mysql_fetch_array($resultmp);
if($myrowmp[0]!=NULL){

echo '<script type="text/javascript"  src="/sima/js/new/stmenu.js"></script>';
echo '<script type="text/javascript">';
//encabezado
print '


stm_bm(["menu3ba5",900,"","/sima/imagenes/blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","",0,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,5,0,0,100,"",-2,"",-2,50,0,0,"#999999","#E6EFF9","/sima/imagenes/bg_02.png",3,0,0,"#000000","",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_03.png",37,3,0,"#FFFFF7","",3,"",-1,-1,0,"#FFFFF7","",3,"/sima/imagenes/bg_01.png",37,3,0,"#FFFFF7","",3,"","","","",20,20,20,20,20,20,20,20]);
stm_aix("p0i1","p0i0",[0,"'.$_GET['main'].'","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"",,3,0,0,0,"#E6EFF9","#000000","#FFFFFF","#434142","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#000000","#6bb5d5","",3,1,1,"#6bb5d5"]);
';

 //TODOS LOS MODULOS PRINCIPALES
$sSQLmp= "Select * From usersmodules WHERE (entidad='".$entidad."' and usuario='".$usuario."' and main='".$mainmenu."' 
    and
extension>0)
or
(

 usuario='".$usuario."' and main='".$mainmenu."' and global='si'

)
group by primario order by primario ASC ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);

while($myrowmp = mysql_fetch_array($resultmp)){
    
    //TRAES EL USUARIO, ASIGNA MODULOS; AHORA DIME LA RUTA
    if($myrowmp['global']=='si'){
    $myrowmu1['menuname']=$mainmenu;$myrowmp['primario']=$mainmenu;    
    }else{
    $sSQLmu1= "Select * From primarymodules WHERE entidad='".$entidad."' AND menuname='".$myrowmp['primario']."' order by mainmenu ASC";
    $resultmu1=mysql_db_query($basedatos,$sSQLmu1);
    $myrowmu1 = mysql_fetch_array($resultmu1);
    }
    
    
    
    if($myrowmu1['menuname']==$myrowmp['primario']){
print '
<!------------INICIO PROGRAMAS----------------------
stm_aix("p1i0","p0i1",[0,"'.$myrowmu1['menuname'].'","","",-1,-1,0,"menuOperaciones.php?main='.$_GET['main'].'&warehouse='.$myrowmu1['menuname'].'&datawarehouse='.$myrowmu1['almacen'].'","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#434142"],165,20);
//---------------FIN DE PROGRAMAS------------------>
';

//termina ciclo
    }
}
echo 'stm_ep();';






//***FOOTER***
print '<!------------INICIO SALIR----------------------
stm_aix("p0i1","p0i0",[0,"SALIR","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"",,3,0,0,0,"#E6EFF9","#000000","#ea765a","#434142","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#5a8fbb","#6bb5d5","",3,1,1,"#6bb5d5"]);


stm_aix("p1i0","p0i1",[0,"Menu Principal","","",-1,-1,0,"/sima/MenuIndex.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#808080","#FFFFFF","#434142"],120,20);

stm_aix("p1i0","p0i1",[0,"Salir del Sistema","","",-1,-1,0,"/sima/salir.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#808080","#FFFFFF","#434142"],120,20);

stm_ep();
//---------------FIN --------------->
stm_ep();

stm_em();
//-->
</script>';




$sSQL1E= "Select * From entidades WHERE codigoEntidad='".$entidad."' ";
$result1E=mysql_db_query($basedatos,$sSQL1E);
$myrow1E = mysql_fetch_array($result1E);
$classS=new sterr();
print $classS->step($myrow1E['descripcionEntidad'],$cadena,$usuario,$entidad);


}else{?>
<script type="text/javascript">
window.alert("NO TIENES PERMISOS PARA ESTAR EN ESTE LUGAR");    
window.location = "/sima/MenuIndex.php";
</script>
<?php 





}



}










        
        
        
        
        
        
        
        
        
        
public function menuOperacionesBoot($rutaPrincipal,$tituloMenuPrincipal,$mainmenu,$primario,$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos){
    $fecha1=date("Y-m-d");
    $hora1=date("H:i:s");

    
    
    
/*    
<div class="bs-example">
      <ul class="nav nav-pills">
        <li class="active">
        <a href="#">Menu Principal</a></li>
        <li class="dropdown">
          <a id="drop4" role="button" data-toggle="dropdown" href="#">Extras <b class="caret"></b></a>
          <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Another action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Something else here</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Separated link</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a id="drop5" role="button" data-toggle="dropdown" href="#">Reportes  <b class="caret"></b></a>
          <ul id="menu2" class="dropdown-menu" role="menu" aria-labelledby="drop5">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Another action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Something else here</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Separated link</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a id="drop6" role="button" data-toggle="dropdown" href="#">Transacciones <b class="caret"></b></a>
          <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop6">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Another action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Something else here</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Separated link</a></li>
          </ul>
        </li>
      </ul> <!-- /tabs -->
    </div> <!-- /example -->      
    */
    
echo '<div class="bs-example">
      <ul class="nav nav-pills">
        <li class="active">';

print '<a href="'.$rutaPrincipal.'">'.$tituloMenuPrincipal.'</a></li>';

/*
echo '<li class="dropdown">
          <a id="drop4" role="button" data-toggle="dropdown" href="#">Extras <b class="caret"></b></a>
          <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Another action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Something else here</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://twitter.com/fat">Separated link</a></li>
          </ul>
        </li>';
*/

    
    
//   
$sSQLmp= "Select * From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."'  and main='".$mainmenu."' order by secondary ASC ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
$myrowmp = mysql_fetch_array($resultmp);


if($myrowmp[0]!=NULL){


$sSQLmp= "Select * From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."'  and primario='".$primario."' 
    and
extension>0    
group by secondary order by secondary ASC ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
while($myrowmp = mysql_fetch_array($resultmp)){

//AQUI TRAIGO LOS ENCABEZADOS DE LOS MENUS
//print 'stm_aix("p0i1","p0i0",[0,"'.$myrowmp['secondary'].'","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"",,3,0,0,0,"#E6EFF9","#434142","#FFFFFF","#434142","bold 8pt Verdana","bold 8pt Verdana"],100,33);
//stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#6bb5d5","#6bb5d5","",3,1,1,"#6bb5d5"]);';
    
            




//EL PRIMERO
echo '<li class="dropdown">';
echo '<a id="drop4" role="button" data-toggle="dropdown" href="#"><small>'.  $myrowmp['secondary'].'<b class="caret"></b></small></a>';
          
          
          
        
//AQUI VAN LOS SUBMENUS


echo '<ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop6">';
 $sSQLmp1= "Select * From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."' 
and
main='".$myrowmp['main']."'
        
and primario='".$myrowmp['primario']."' 
        and
        secondary='".$myrowmp['secondary']."' 
                and
extension>0 
group by extension    
";
$resultmp1=mysql_db_query($basedatos,$sSQLmp1);
while($myrowmp1 = mysql_fetch_array($resultmp1)){
$sSQLmpv2= "Select * From extensionmodules WHERE keyEM='".$myrowmp1['extension']."'";
$resultmpv2=mysql_db_query($basedatos,$sSQLmpv2);
$myrowmpv2 = mysql_fetch_array($resultmpv2); 

if($myrowmpv2['keyEM']==$myrowmp1['extension']){
//print 'stm_aix("p1i0","p0i1",[0,"'.$myrowmpv2['name'].'","","",-1,-1,0,"'.trim($myrowmpv2['ruta']).'?main='.$_GET['main'].'&warehouse='.$_GET['warehouse'].'&datawarehouse='.$primario.'","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#434142"],165,20);';

//DEBEN IR LOS UL DENTRO DEL WHILE    
            //MENU SECUNDARIO
            
            echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="'.trim($myrowmpv2['ruta']).'?main='.$_GET['main'].'&warehouse='.$_GET['warehouse'].'&datawarehouse='.$primario.'"><small>'.strtolower($myrowmpv2['name']).'</small></a></li>';
           
          
    
    $descripcion='Accesando a: '.$_GET['warehouse'].', ruta: '.$myrowmpv2['ruta'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$primario."','".$_GET['warehouse']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{
    $actualiza10 = "DELETE FROM usersmodules

WHERE

keyum='".$myrowmp1['keyum']."'


";
mysql_db_query($basedatos,$actualiza10);
echo mysql_error(); //elimina la basura que queda en los modulos, si exxiste
}
}
/*
*/


echo '</ul>';
echo '</li>';//TERMINA EL LI PRINCIPAL

}//DEBEN IR DESPUES DEL WHILE

echo   '</ul>
        </li>';








print '
      </ul>
    </div>
';



}else{?>
<script type="text/javascript">
//window.alert("NO TIENES PERMISOS PARA ESTAR EN ESTE LUGAR");    
//window.location = "/sima/MenuIndex.php";
</script>
<?php 
}
/*
$sSQL1E= "Select * From entidades WHERE codigoEntidad='".$entidad."' ";
$result1E=mysql_db_query($basedatos,$sSQL1E);
$myrow1E = mysql_fetch_array($result1E);

$classS=new sterr();
print $classS->step($myrow1E['descripcionEntidad'],$cadena,$usuario,$entidad);*/
}//cierra funcion        
        
        
        
        
        
        
        
        



public function menuOperacionesF($mainmenu,$primario,$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos){
    $fecha1=date("Y-m-d");
    $hora1=date("H:i:s");

echo '<link type="text/css" rel="stylesheet" href="/sima/js/taskbar.css" />';
echo '<style type="text/css">
<!--
pre{
	width:600px;
	border:1px dashed #CCCCCC;
	overflow:auto;
}
-->
</style>';  
    





echo '<style type="text/css">
<!--
A.ssmItems:link		{color:black;text-decoration:none;}
A.ssmItems:hover	{color:black;text-decoration:none;}
A.ssmItems:active	{color:black;text-decoration:none;}
A.ssmItems:visited	{color:black;text-decoration:none;}
//-->
</style>';

echo '<SCRIPT SRC="../js/ssm.js" language="JavaScript1.2"></SCRIPT>';
require("../js/utilerias.php");    
 
    
    
//VALIDACIONES    
$sSQLmp= "Select * From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."'  and primario='".$mainmenu."' order by secondary ASC ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
$myrowmp = mysql_fetch_array($resultmp);
if($myrowmp[0]!=NULL){

echo '<script type="text/javascript"  src="/sima/js/new/stmenu.js"></script>';
echo '<script>


stm_bm(["menu3ba5",900,"","/sima/imagenes/blank.gif",0,"","",1,0,250,0,1000,1,0,0,"","",0,0,1,2,"default","hand","",1,25],this);
stm_bp("p0",[0,4,0,0,0,5,0,0,100,"",-2,"",-2,50,0,0,"#999999","#E6EFF9","/sima/imagenes/bg_02.png",3,0,0,"#000000","",-1,-1,0,"#FFFFF7","",3,"",37,3,0,"#FFFFF7","",3,"",-1,-1,0,"#FFFFF7","",3,,37,3,0,"#FFFFF7","",3,"","","","",20,20,20,20,20,20,20,20]);
stm_ai("p0i0",[0,"Ir Atras","","",-1,-1,0,"javascript:history.go(-1)","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#E6EFF9",1,"","",3,3,0,0,"#E6EFF9","#434142","#FFFFFF","#434142","bold 8pt Verdana","bold 8pt Verdana",0,0,"","","","",0,0,0],150,33);';

$sSQLmp= "Select * From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."'  and primario='".$mainmenu."' 
    and
extension>0    
group by secondary order by secondary ASC ";
$resultmp=mysql_db_query($basedatos,$sSQLmp);
while($myrowmp = mysql_fetch_array($resultmp)){

//AQUI TRAIGO LOS ENCABEZADOS DE LOS MENUS
print 'stm_aix("p0i1","p0i0",[0,"'.$myrowmp['secondary'].'","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"",,3,0,0,0,"#E6EFF9","#434142","#FFFFFF","#434142","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#6bb5d5","#6bb5d5","",3,1,1,"#6bb5d5"]);';
    


//AQUI VAN LOS SUBMENUS



 $sSQLmp1= "Select * From usersmodules WHERE entidad='".$entidad."' and usuario='".$usuario."' 
and
main='".$myrowmp['main']."'
        
and primario='".$myrowmp['primario']."' 
        and
        secondary='".$myrowmp['secondary']."' 
                and
extension>0 
group by extension    
";
$resultmp1=mysql_db_query($basedatos,$sSQLmp1);
while($myrowmp1 = mysql_fetch_array($resultmp1)){
$sSQLmpv2= "Select * From extensionmodules WHERE keyEM='".$myrowmp1['extension']."'";
$resultmpv2=mysql_db_query($basedatos,$sSQLmpv2);
$myrowmpv2 = mysql_fetch_array($resultmpv2); 

if($myrowmpv2['keyEM']==$myrowmp1['extension']){
print 'stm_aix("p1i0","p0i1",[0,"'.$myrowmpv2['name'].'","","",-1,-1,0,"'.trim($myrowmpv2['ruta']).'?main='.$_GET['main'].'&warehouse='.$_GET['warehouse'].'&datawarehouse='.$primario.'","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#000000","#FFFFFF","#434142"],165,20);';
$descripcion='Accesando a: '.$_GET['warehouse'].', ruta: '.$myrowmpv2['ruta'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$primario."','".$_GET['warehouse']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{
    $actualiza10 = "DELETE FROM usersmodules

WHERE

keyum='".$myrowmp1['keyum']."'


";
mysql_db_query($basedatos,$actualiza10);
echo mysql_error(); //elimina la basura que queda en los modulos, si exxiste
}

}//TERMINAN LOS SUBMENUS CON SUS RUTAS
echo 'stm_ep();';
}






print 'stm_aix("p0i1","p0i0",[0,"Salir","","",-1,-1,0,"","_self","","","","",0,0,0,"","",0,0,0,1,1,"#E6EFF9",1,"#E6EFF9",1,"",,3,0,0,0,"#E6EFF9","#FFFFFF","#ea765a","#434142","bold 8pt Verdana","bold 8pt Verdana"],100,33);
stm_bp("p1",[1,4,-20,2,0,5,0,0,100,"",-2,"",-2,50,2,3,"#6bb5d5","#6bb5d5","",3,1,1,"#6bb5d5"]);



stm_aix("p1i0","p0i1",[0,"Menu Principal","","",-1,-1,0,"/sima/MenuIndex.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#29ABE2","#FFFFFF","#434142"],120,20);


stm_aix("p1i0","p0i1",[0,"Salir del Sistema","","",-1,-1,0,"/sima/salir.php","_self","","","","",0,0,0,"","",0,0,0,0,1,"#E6EFF9",1,"#6bb5d5",0,"","",3,3,0,0,"#E6EFF9","#29ABE2","#FFFFFF","#434142"],120,20);

stm_ep();
//---------------FIN ESTUDIOS------------------>
stm_ep();

stm_em();
</script>
';



}else{?>
<script type="text/javascript">
window.alert("NO TIENES PERMISOS PARA ESTAR EN ESTE LUGAR");    
window.location = "/sima/MenuIndex.php";
</script>
<?php 
}

$sSQL1E= "Select * From entidades WHERE codigoEntidad='".$entidad."' ";
$result1E=mysql_db_query($basedatos,$sSQL1E);
$myrow1E = mysql_fetch_array($result1E);

$classS=new sterr();
print $classS->step($myrow1E['descripcionEntidad'],$cadena,$usuario,$entidad);
}//cierra funcion



public function menuTemplate($mainmenu,$primario,$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos){
    if (isset($_GET['main'])) {
        $mp = $_GET['main'];        
    }
    if (isset($_GET['warehouse'])) {
        $ms = $_GET['warehouse'];        
    }
    if (isset($_GET['datawarehouse'])) {
        $primario = $_GET['datawarehouse'];        
    }
    $encabezado="HOME";
    if (isset($_GET['encabezado'])) {
        $encabezado = $_GET['encabezado'];        
    }else{
        $encabezado=$mp.' / '.$ms;
    }
    $submenu="";
    if(isset($_GET['click'])){
        //echo '-'.$_GET['click'].'-';
        if($_GET['click']=='1'){
        $_SESSION['main'] = $_GET['main'];
        $_SESSION['warehouse'] = $_GET['warehouse'];
        $_SESSION['datawarehouse'] = $_GET['datawarehouse'];
        $_SESSION['submenu'] = $_GET['submenu'];
        }
    }
    
    /*
    echo " ".$_SESSION['main']." ";
    echo " ".$_SESSION['warehouse']." ";
    echo " ".$_SESSION['datawarehouse']." ";
    echo " ".$_SESSION['submenu']." ";    
    */
    if(!isset($_GET['click'])){
        if($_GET['click']!='1'){
            //echo "algo salio mal... hay que arreglarlo";
            $_GET['main']=$_SESSION['main'];
            $mp=$_SESSION['main'];            
            
            $_GET['warehouse']=$_SESSION['warehouse'];
            $ms=$_SESSION['warehouse'];
            
            $_GET['datawarehouse']=$_SESSION['datawarehouse'];
            $primario=$_SESSION['datawarehouse'];
            
            $_GET['submenu']=$_SESSION['submenu'];
            $submenu=$_SESSION['submenu'];
        }
    }
        
    print '<html>';
        print '<head>';
            print '<title>SIMA</title>';
            print '<meta charset="UTF-8" />';
            print '<link rel="stylesheet" type="text/css" href="/sima/style/reset.css" />';
            print '<link rel="stylesheet" type="text/css" href="/sima/style/superfish.css" />';
            print '<link rel="stylesheet" type="text/css" href="/sima/style/fancybox/jquery.fancybox.css" />';
            print '<link rel="stylesheet" type="text/css" href="/sima/style/jquery.qtip.css" />';
            print '<link rel="stylesheet" type="text/css" href="/sima/style/jquery-ui-1.9.2.custom.css" />';
            print '<link rel="stylesheet" type="text/css" href="/sima/style/style.css" />';
            print '<link rel="stylesheet" type="text/css" href="/sima/style/responsive.css" />';
            print '<script src="/sima/js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>';
            print '<script src="/sima/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript" charset="utf-8"></script>';
        print '<script type="text/javascript" charset="utf-8">';
            print '$(function() {';
                print 'var $j = jQuery.noConflict();';
                print '$j(\'#menuLateral\').accordion({ autoHeight: false ,active:false,collapsible:true});';
            print '});';
        print '</script>';
        print '</head>';
        print '<body>';
            //print '<div class="site_container"'; echo ($_COOKIE['mc_layout'] == "boxed" ? ' boxed' : ''); print '>';
            print '<div class="site_container" >';
                print '<div class="header_container">';
                    print '<div class="header clearfix">';
                        print '<div class="header_left">';
                            print '<a href="/sima/MenuIndex.php?main=index&warehouse=&datawarehouse=&submenu=&click=" title="HLC">';
                                print '<img src="/sima/images/logo.png" alt="logo"/>';
                            print '</a>';
                       print '</div>';
            $ruta = "";
                                      
            
             //TRAER MENUS PRINCIPALES                  
                       
                       
                       //TRAE LOS PRINCIPALES DEL USUARIO por main
            $sSQLmp = "Select * From usersmodules WHERE (entidad='" . $entidad . "' and usuario='" . $usuario . "'
            and
            extension>0  
            )
            or
            (usuario='" . $usuario . "'
            and
            global='si'
            ) group by main  ";
            $resultmp = mysql_db_query($basedatos, $sSQLmp);            
            
            $arregloModulos;
            $arregloMAgrupado;
            //trae los principales por primario
            $sSQLmp22 = "Select * From usersmodules WHERE (entidad='" . $entidad . "' and usuario='" . $usuario . "'
            and
            extension>0  
            )
            or
            (usuario='" . $usuario . "'
            and
            global='si'
            ) group by primario  ";
            
            $resultmp22 = mysql_db_query($basedatos, $sSQLmp22);
            $contador2=0;
            while($myrow222=  mysql_fetch_array($resultmp22)){
                $arregloModulos[$myrow222['primario']]=$myrow222;
                //echo '-'.$arregloMAgrupado[$myrow222['main']].'-'.$myrow222['main'];
                if(isset($arregloMAgrupado[$myrow222['main']])){
                    $arregloMAgrupado[$myrow222['main']]=$arregloMAgrupado[$myrow222['main']]+1;
                }else{
                    $arregloMAgrupado[$myrow222['main']]=1;
                }
            }
            //echo '+'.$arregloMAgrupado['OPERACIONES'].'+';
            //$resultmp=mysql_real_escape_string($resultmp);
            $numMenus=mysql_num_rows($resultmp);
            //$selected=$_GET['main'];
            $selected=$mp;
            print '<ul class="sf-menu header_right">';            
                if($numMenus<4){
                    if($selected=='index'){
                        print '<li class="bottom selected">';                        
                    }else{
                        print '<li class="bottom">';                        
                    }
                }else{
                    if($selected=='index'){
                        print '<li class="selected">';                        
                    }else{
                        print '<li>';                        
                    }
                }
                            print '<a href="/sima/MenuIndex.php?main=index&warehouse=&datawarehouse=&submenu=&click=" title="HOME">';
                                print 'HOME';
                            print '</a>';
                       print '</li>';  
            while ($myrowmp = mysql_fetch_array($resultmp)) {
            //PINTA LOS MODULOS
                if ($myrowmp['global'] == 'si') {
                    $sSQLmu1 = "Select * From mainmodules WHERE name='" . $myrowmp['main'] . "'";
                    $resultmu1 = mysql_db_query($basedatos, $sSQLmu1);
                    $myrowmu1 = mysql_fetch_array($resultmu1);
                } else {
                    $sSQLmu1 = "Select * From mainmodules WHERE entidad='" . $entidad . "' AND name='" . $myrowmp['main'] . "'";
                    $resultmu1 = mysql_db_query($basedatos, $sSQLmu1);
                    $myrowmu1 = mysql_fetch_array($resultmu1);
                }
                
            $mainRuta=$myrowmu1['ruta'];
            //$mainmenu = $myrowmp['main'];
            
            
            #PINTA EL SUBMENU
                   $sSQLmu1 = "Select * From primarymodules WHERE entidad='" . $entidad . "' AND mainmenu='" . $myrowmu1['name'] . "'            
                    group by menuname
                    order by mainmenu ASC";             
            $resultmu1 = mysql_db_query($basedatos, $sSQLmu1);
            //$numRows = mysql_num_rows($resultmu1);
             $numRows= $arregloMAgrupado[$myrowmu1['name']];
            
            //$selected_n2=$_GET['warehouse'];
            $selected_n2=$ms;
            print "<li ";
            if ($numRows > 0) {
                print 'class="submenu';
                if ($numRows > 15) {
                    print ' wide ';
                }
                if($numMenus<4){
                    print ' bottom ';
                }
                if($selected==$myrowmp['main']){
                    print ' selected ';                    
                }
            print '"';
            }
            print ">";
                print '<a href="#" title="';
                echo $myrowmp['main'];
                echo '" >';
                    echo $myrowmp['main'];
                print '</a>';
                if ($myrowmp['usuario'] != NULL) {
                    if ($numRows > 0) {
                        print '<ul>';
                        while ($myrowmu1 = mysql_fetch_array($resultmu1)) {
                        if(isset($arregloModulos[$myrowmu1['menuname']])){
                            if($selected_n2==$myrowmu1['menuname']){
                                //print '<li class="selected"><a href="?main=' . $myrowmp['main'] . '&warehouse=' . $myrowmu1['menuname'] . '&datawarehouse='.$myrowmu1['almacen'].'&ruta=' . $mainRuta . '&actualizar=0&encabezado='.$encabezado.'&click=0" title="' . $myrowmu1['menuname'] . '"><span>' . $myrowmu1['menuname'] . '</span></a>';
                                print '<li class="selected"><a href="/sima/MenuIndex.php?main=' . $myrowmp['main'] . '&warehouse=' . $myrowmu1['menuname'] . '&datawarehouse='.$myrowmu1['almacen'].'&ruta=' . $mainRuta . '&actualizar=0&encabezado='.$encabezado.'&click=0" title="' . $myrowmu1['menuname'] . '"><span>' . $myrowmu1['menuname'] . '</span></a>';
                            }else{
                                //print '<li><a href="?main=' . $myrowmp['main'] . '&warehouse=' . $myrowmu1['menuname'] . '&datawarehouse='.$myrowmu1['almacen'].'&ruta=' . $mainRuta . '&actualizar=0&encabezado='.$encabezado.'&click=0" title="' . $myrowmu1['menuname'] . '"><span>' . $myrowmu1['menuname'] . '</span></a>';
                                print '<li><a href="/sima/MenuIndex.php?main=' . $myrowmp['main'] . '&warehouse=' . $myrowmu1['menuname'] . '&datawarehouse='.$myrowmu1['almacen'].'&ruta=' . $mainRuta . '&actualizar=0&encabezado='.$encabezado.'&click=0" title="' . $myrowmu1['menuname'] . '"><span>' . $myrowmu1['menuname'] . '</span></a>';
                            }
                        }    
                        //$mainmodulename = $myrowmu1['menuname'];
                            
                    }
                    print '</ul>';
                }
            }
            print "</li>";           
            
            
            
          }       
          
          
          
          //MENU LATERAL---
          $arregloResult;
          if(isset($_GET['actualizar'])){
              $actualizar=$_GET['actualizar'];
              if($actualizar=="0"){
                if (isset($_GET['ruta'])) {
                $rutaSeparada=  split('/', $_GET['ruta']);
                $ruta=$rutaSeparada[2].'/';
                }  
              }else{
                  $ruta=$_GET['ruta'];
                  //$encabezado=$mp.' / '.$ms;
                  if(isset($_GET['submenu'])){
                      $submenu=$_GET['submenu'];
                  }
              }
          }          
//            if (isset($_GET['main'])) {
//                $mp = $_GET['main'];
//            }
//            if (isset($_GET['warehouse'])) {
//                $ms = $_GET['warehouse'];
//            }
//            if (isset($_GET['ruta'])) {
//                $rutaSeparada=  split('/', $_GET['ruta']);
//                $ruta=$rutaSeparada[2].'/';
//            }
            //echo "+++".$basedatos." +++ ".$usuario." +++ ".$mp." +++ ".$ms. " +++ ".$entidad;
            //$arregloResult = ejecutaLateral($basedatos, $usuario, $mp, $ms, $entidad);
            $sSQLmp1a = "Select secondary From usersmodules WHERE entidad='" . $entidad . "' and usuario='" . $usuario . "' 
                and
                primario='" . $ms . "' 
                and
                extension>0 
                group by secondary    
                ";
            $resultmp1a = mysql_db_query($basedatos, $sSQLmp1a);
            $arregloResult= $resultmp1a;
        
                   
        
        if($numMenus<4){        
            print "<li class=\"bottom\">";
        }else{            
            print "<li>";
        }
            print "<a href='/sima/salir.php'>SALIR</a>";
        print "</li>";
        print "</ul>";
   print "</div>";
print "</div>";
print '<div class="page relative noborder">';
    print '<div class="page_layout page_margin_top_section clearfix">';
        print '<div class="page_left">';
            //print '<div class="sidebar_box first">';
            print '<div class="sidebar_box">';
        //print '<div class=\'page_left page_margin_top\'>
          //          <div class="aviso_ubicacion">';
            
            
            /*
            if(trim($encabezado)!='/'){
      print'<div class="aviso_ubicacion">';
             print 'Usted esta en: ';
             $cadena=$encabezado;
             if(strcmp($cadena,' / ')==0){
                $cadena='HOME';                
             }
            print $cadena;
            print '</div>';
            }
            */
            
            
        print '<ul id = "menuLateral" class="accordion menu-lateral">';
            //print '<li>';
                //print '<div id="accordion-nivel-uno">';
                //print '<h3><a href = "#"> UTILERIA</a></h3>';
                //print '</div>';
                //print '<ul>';
                  //  print '<li>';
                    //    print '<a href = "/sima/SEGURIDADSIMA/cambiarPassword.php">Cambiar Password</a>';
                    //print '</li>';
                     //print '<li>';
                       // print '<a href = "/sima/SEGURIDADSIMA/pruebaMenu.php">Prueba Menu</a>';
                    //print '</li>';
                //print '</ul>';
            //print '</li>';
            if (isset($arregloResult)) {
            $contador = 1;
            //echo $arregloResult;
            while ($myrowmp1a = mysql_fetch_array($arregloResult)) {
                $contador = $contador + 1;
                if($submenu==$myrowmp1a['secondary']){
                    print '<li><div id="accordion-nivel-' . $contador . '" class="ui-accordion-header-active ui-state-active"><h3><a href="#">' . $myrowmp1a['secondary'] . '</a></h3></div>';    
                }else{                    
                    print '<li><div id="accordion-nivel-' . $contador . '"><h3><a href="#">' . $myrowmp1a['secondary'] . '</a></h3></div>';
                }
                //print '<li><div id="accordion-nivel-'.$contador.'"><h3>' . $myrowmp1a['secondary'] . '</h3></div>';
                $sSQLmpv2c = "Select * From extensionmodules WHERE entidad='" . $entidad . "'  
                and mainmodulename='" . $ms . "'
                and
                mainmodule='" . $myrowmp1a['secondary'] . "'";
                $resultmpv2c = mysql_db_query($basedatos, $sSQLmpv2c);
                print '<ul>';
                while ($myrowmpv2c = mysql_fetch_array($resultmpv2c)) {
                    //print '<li><a href="' . $mp . '/' . $myrowmpv2c['ruta'] . '">' . $myrowmpv2c['name'] . '</a></li>';
                    //print '<li><a href="/sima/' . $ruta .''.$myrowmpv2c['ruta'].'?main='.$ms.'&warehouse='.$ms.'">' . $myrowmpv2c['name'] . '</a></li>';
                    //echo trim($myrowmpv2c['prefijo']);
                    //echo '--'.trim($ruta);
                    //print '<li><a href="/sima/' . $ruta .''.trim($myrowmpv2c['ruta']).'?main='.$mp.'&warehouse='.$ms.'&datawarehouse='.$primario.'&submenu='.$myrowmp1a['secondary'].'&ruta='.$ruta.'&actualizar=1" >' . $myrowmpv2c['name'] . '</a></li>';
                    print '<li><a href="/sima/' . trim($myrowmpv2c['prefijo']).''.trim($myrowmpv2c['ruta']).'?main='.$mp.'&warehouse='.$ms.'&datawarehouse='.$primario.'&submenu='.$myrowmp1a['secondary'].'&ruta='.$ruta.'&actualizar=1&click=1" >' . $myrowmpv2c['name'] . '</a></li>';
                }
                print '</ul>';
            print '</li>';
            }
        }
        print '</ul>';        
        //print '</div>';
        print '</div>';
    print '</div>';
        
                }

public function footerTemplate($usuario,$entidad,$basedatos){
    $sSQL1E= "Select * From entidades WHERE codigoEntidad='".$entidad."' ";
    $result1E=mysql_db_query($basedatos,$sSQL1E);
    $myrow1E = mysql_fetch_array($result1E);
                print '</div>';
            print '</div>';
        print '</div>';
    print '</div>';
    print '<div class="site_container">';
        print '<div class="footer_container">';
            print '<div class="footer">';
                print '<div class="copyright_area clearfix">';
                    print '<div class="copyright_left">';
                        print '© Copyright - Departamento de Sistemas Hospital La Carlota';
                    print '</div>';
                    print '<div class="copyright_center">';                   
                        print ' Usuario: '.$usuario;
                        print ' - Entidad: '.$myrow1E['descripcionEntidad'];
                    print '</div>';
                    print '<!--<div class="copyright_left">';
                    print '© Copyright - <a href="http://themeforest.net/item/medicenter-responsive-medical-health-template/4000598?ref=QuanticaLabs" title="MediCenter Template" target="_blank">MediCenter Template</a> by <a href="http://quanticalabs.com" title="QuanticaLabs" target="_blank">QuanticaLabs</a>';
                    print '</div>-->';
                        print '<div class="copyright_right">';
                            print '<a class="scroll_top icon_small_arrow top_white" href="#top" title="Scroll to top">Top</a>';
                        print '</div>';
                    print '</div>';
                print '</div>';
            print '</div>';
        print '</div>';
    print '</div>';
    print '</body>';
    print '</html>';
    
}

}//termina clase

























class windowCenter{    
public function mainmenu(){
return "<script>
<!--
function wopen(url, name, w, h)
{
  // Fudge factors for window decoration space.
  // In my tests these work well on all platforms & browsers.
  w += 32;
  h += 96;
  wleft = (screen.width - w) / 2;
  wtop = (screen.height - h) / 2;
  // IE5 and other old browsers might allow a window that is
  // partially offscreen or wider than the screen. Fix that.
  // (Newer browsers fix this for us, but let's be thorough.)
  if (wleft < 0) {
    w = screen.width;
    wleft = 0;
  }
  if (wtop < 0) {
    h = screen.height;
    wtop = 0;
  }
  var win = window.open(url,
    name,
    'width=' + w + ', height=' + h + ', ' +
    'left=' + wleft + ', top=' + wtop + ', ' +
    'location=no, menubar=no, ' +
    'status=no, toolbar=no, scrollbars=no, resizable=no');
  // Just in case width and height are ignored
  win.resizeTo(w, h);
  // Just in case left and top are ignored
  win.moveTo(wleft, wtop);
  win.focus();
}
// -->
</script>";
}
}
?>
























<?php
class catalogos{
    
public function crearTabla($reservado1,$reservado2,$reservado3,$limiteRegistros,$nombreTabla,$webPage,$titulo,$entidad,$basedatos){

##EJEMPLO##
/*require("/configuracion/ventanasEmergentes.php");
#########CONFIGURACION DE LA TABLA##############
require("/configuracion/funciones.php");
$nombreTabla='anuncioss';
$limiteRegistros=30;
$titulo='Catalogo de Sotfware';

//DIBUJA TABLA
$catSoftware=new catalogos();    
$catSoftware-> crearTabla($limiteRegistros,$nombreTabla,$webPage,$titulo,$entidad,$basedatos);
##############################################
 */    
    
    
    
############RETRIEVE CAMPO LLAVE############
$sSQL= 'SHOW COLUMNS FROM '.$nombreTabla;
$result=mysql_db_query($basedatos,$sSQL);        
$myrow = mysql_fetch_array($result);
$cantidadCampos=mysql_num_rows($result);
$campoLlave=$myrow[0];  
$anchoTabla=$cantidadCampos*100;
###################################
    
    
if($campoLlave!=NULL){

    
if($_GET['add']==yes and count($_POST['campos'])>0){    
$fields=$_POST['campos'];    
for($a=0;$a<=count($_POST['campos']);$a++){
    $posts.=$fields[$a].',';
    $postQuery.='"'.$_POST[$fields[$a]].'"'.",";
    if($_POST[$fields[$a]]!=''){
        $rec=TRUE;
    }
}    

$longPosts= strlen($posts)-1;
$posts=substr($posts,0, $longPosts); 



$sSQL= 'SHOW COLUMNS FROM '.$nombreTabla;
$result=mysql_db_query($basedatos,$sSQL);        
while($myrow = mysql_fetch_array($result)){
$rr+=1;
 
if($rr>1){
 $query.= $myrow["Field"].',';
}
}



$lenghtPQ=strlen($postQuery)-4;
$postQuery=substr($postQuery, 0, $lenghtPQ); 


$long= strlen($query)-1;
$query=substr($query, 0, $long); 




#SI SON DIFERENTES DE NULL SE INSERTA SINO ERROR
if($rec==TRUE){
$insert="INSERT INTO ".$nombreTabla." (
".$query."    
)
values
($postQuery
)
";
 mysql_db_query($basedatos,$insert);
echo mysql_error(); 
echo '<h3><div style="position:absolute; top:10px; left:50px; width:500px; color:green">
AGREGADO!
</div></h3>';
}else{
echo '<h3><div style="position:absolute; top:10px; left:50px; width:500px; color:red">
TE FALTAN CAMPOS POR LLENAR!
</div></h3>';     
}
}        
        
        
    
    
    


if($campoLlave!=NULL AND ($_GET['key']>0 and $_GET['del']=='yes')){

$k=$_GET['key'];

$q2 = 'DELETE FROM '.$nombreTabla.'
		
		WHERE '.$campoLlave.'='.$k;


mysql_db_query($basedatos,$q2);
		echo mysql_error();

echo '<h3><div style="position:absolute; top:10px; left:50px; width:500px; color:red">
ELIMINADO!
</div></h3>';                
}
 

#Encabezados
print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
print '<html xmlns="http://www.w3.org/1999/xhtml">';
print '<head>';
print '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
print '</head>';

print '<body>';
print '<p align="center">';
print '<label>&nbsp;</label>';
print '</p>';
$estilos= new muestraEstilos();
$estilos-> styles();

    
    
#Iniciar la forma    
print '<div class="table-template">';
print '<form name="form1" method="post" >';
//print '<h3><p align="center">'.utf8_decode($titulo).'</p></h3>';
print '<h1><p align="center">'.utf8_decode($titulo).'</p></h1>';
//print '<div id="divContainer">';
print '<table width="'.$anchoTabla.'" class="formatHTML5">';


#numeracion
print '<tbody>';
print '<tr class="separator">';
print '<td width="5%">#</td>';
$sSQL= 'SHOW COLUMNS FROM '.$nombreTabla;
$result=mysql_db_query($basedatos,$sSQL);        
while($myrow = mysql_fetch_array($result)){
$c+=1;
if($c>1){
 echo '<td>'.strtoupper($myrow["Field"]).'</td>';
 $nombreCampos[]=$myrow["Field"];
 $col+=1;
}
}
print '<td></td>';
print '</tr>'; 
print '</tbody>';





print '<tr>';

if($_GET['edit']!=NULL or $_GET['add']!=NULL){
$v=1;
}

if($limiteRegistros>0){
$sSQL= "Select * From ".$nombreTabla.' limit 0,'. $limiteRegistros;
}else{
$sSQL= "Select * From ".$nombreTabla;   
}



$result=mysql_db_query($basedatos,$sSQL);       
while($myrow = mysql_fetch_array($result)){
$a+=1;





print '<td>'.$a.'</th>';


for($i=1;$i<=$col;$i++){ 
print '<td>';
print $myrow[$i];
print '</td>';
}    
       
print '<td ><a href="'.$webPage.'?del=yes&key='.$myrow[0].'" onClick="this.form.submit();">X</a></td>';
print '</tr>';
print '<input type="hidden" name="keySW[]" value="'.$myrow['keySW'].'"></input>';
}




print '<tr>';
print '<td >';            

          
if(!$_POST['update'] AND $_GET['add']=='yes'){ 
$sSQL= 'SHOW COLUMNS FROM '.$nombreTabla;
$result=mysql_db_query($basedatos,$sSQL);        
while($myrow = mysql_fetch_array($result)){ 
    $r[0]+=1;

if($r[0]>1){ 
print '<td  ><input type="text" name="'.$myrow["Field"].'" ></input></td>';
print '<input type="hidden" name="campos[]" value="'.$myrow["Field"].'"></input>';
$fields[].=$myrow["Field"];

}
}
}//CIERRA IF
print '</td>';

        for($s=0;$s<=($cantidadCampos-1);$s++){
        echo '<td></td>';
        }

print '</tr>';
print '<tr>';
 
        
        for($s=0;$s<=($cantidadCampos-1);$s++){
        echo '<td></td>';
        }
print '<td >';
print '<div align="left">';
print '<a href="'.$webPage.'?main='.$_GET['ADMINHOSPITALARIA'].'&warehouse='.$_GET['warehouse'].'&datawarehouse='.$_GET['datawarehouse'].'&add=yes&key=" onClick="this.form.submit();">';
print '+';
print '</a>';
print '</div>';
print '</td>';
print '</tr>';
print '</table>';
//print '</div>';

   
   
   

        if($v>0 AND ($a>0 or $_GET['add']=='yes')){
            if(!$_POST['update'] ){
            print '<br>';
            print '<br>';
            print '<br>';
            print '<div id="divContainer">';
            print '<table width="'.$anchoTabla.'" class="formatHTML5">';
   
        print '<div align="center">';      
        print '<input type="hidden" name="flag"  value="'.$a.'"></input>';    
        
        
        print '<input type="submit" name="update"  value="Grabar"></input>';
        
           print '</div>';
           print '</table>'; 
           print '</div>';
           }
        } 
       

   
   
   

   
    
print '</form>';
print '</div>';
print '</body>';
print '</html>';

        

}else{
    echo '<div class="error">NO EXISTE LA TABLA, FAVOR DE VERIFICAR!</div>';
}


    }
    
    
    
    
}





class encabezadoFechas{
    
    public function headDate($fecha1){?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 

        <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading"></div>     
     

  
  
  
  
  
  
  
  
  
  
  
  <table class="table"> 
    
    <th><div class="col-lg-6"><small>Fecha Inicial</small></div></th>    
    <th><div class="col-lg-6"><small>Fecha Final</small></div></th>
    
    
<tr> 
    
<td>    


  <div class="col-lg-6">
  <div class="input-group">
      <input  type="text" name="fechaInicial" id="campo_fecha1" value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" class="form-control" ></input>
         <span class="input-group-btn">
<button class="btn btn-default btn-link btn-lg" type="button" id="lanzador1"><span class="glyphicon glyphicon-calendar"></span></button>
         </span>
  </div>
   
  </div><!-- /.col-lg-6 -->
 
</td>  

  
    

<td> 
    
 
  <div class="col-lg-6">
       <div class="input-group">
       <input id="campo_fecha2" name="fechaFinal" type="text" value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" class="form-control" >
        <span class="input-group-btn">
        <button class="btn btn-default btn-link btn-lg" type="button" id="lanzador2"><span class="glyphicon glyphicon-calendar"></span></button>
      </span> 
       </div>
  </div>



</td>




<td>
   <div class="col-lg-6">            
<input data-loading-text="Cargando..." class="btn btn-primary" type="submit" name="generarReporte"  value="Generar Reporte" />
</div>
</td>

</tr>
    
    
   
     
</table>     
</div>

 
  
<?php
    }
    
    
}