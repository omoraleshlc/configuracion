<?php require("/configuracion/clases/generaFolioVenta.php");
//**************VERIFICO QUE NO ESTE PAGADO***************




$sSQL15= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result15=mysql_db_query($basedatos,$sSQL15);
$myrow15 = mysql_fetch_array($result15);
if($myrow15['statusCaja']=='pagado' and $myrow15['tipoPaciente']=='externo'){ ?>
<script>
window.alert("Imposible seguir haciendo cargos");
window.close();
</script>
<?php 
}
//******************************
?>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=600,height=330,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript>
function ventanaSecundaria8a (URL){
   window.open(URL,"ventanaSecundaria8a","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria8a2 (URL){
   window.open(URL,"ventanaSecundaria8a2","width=1100,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
<?php 
//aqui estoy

if($_POST['borrar'] and $_POST['quitar']){
//*****************************************************
$quitar=$_POST['quitar'];


for($i=0;$i<=$_POST['bandera'];$i++){

if($quitar[$i]){
$sSQL= "SELECT 
codProcedimiento,keyCAP,almacen,numeroE,nCuenta,random,folioVenta,keyPA,descripcionArticulo
FROM cargosCuentaPaciente
WHERE entidad='".$entidad."' and keyClientesInternos='".$_GET['keyClientesInternos']."' and keyPA ='".$quitar[$i]."'  and almacenSolicitante='".$_GET['almacen']."' and 
    

(statusCargo='standbyR' or statusCargo='cargadoR') ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$sSQL3= "SELECT 
keyPA
FROM faltantes
WHERE 
folioVenta='".$myrow['folioVenta']."'
and
keyPA='".$myrow['keyPA']."'
and
random ='".$myrow['random']."'";

$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$codigo=$myrow['codProcedimiento'];
$departamento=$myrow['almacen'];
$numeroPaciente=$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
//********************************************
$agrega = "INSERT INTO articulosCancelados (
codigo,fecha,hora,usuario,entidad,departamento,numeroE,nCuenta,keyCAP
) values (
'".$_GET['codigo3']."','".$fecha1."','".$hora1."',
'".$usuario."','".$entidad."','".$departamento."','".$numeroE."','".$nCuenta."','".$quitar[$i]."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



//LOGS
$descripcion='Eliminando el articulo: '.$myrow['descripcionArticulo'].', del paciente: '.$myrow15['paciente'].',codigo: '.$myrow15['keyClientesInternos'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$departamento."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




$borrame = "DELETE FROM cargosCuentaPaciente WHERE entidad='".$entidad."' and keyPA ='".$quitar[$i]."'  and almacenSolicitante='".$_GET['almacen']."' 
    and statusCargo!='cargado'
    and
(statusCargo='standbyR' or statusCargo='cargadoR') 
";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

$borrame4 = "DELETE FROM antibioticos WHERE keyCAP ='".$myrow['keyCAP']."'  ";
mysql_db_query($basedatos,$borrame4);
echo mysql_error();

if($myrow3['keyPA']){
$borrame1 = "DELETE FROM faltantes WHERE folioVenta ='".$myrow['folioVenta']."' and keyPA='".$myrow['keyPA']."' and random='".$myrow['random']."'";
mysql_db_query($basedatos,$borrame1);
echo mysql_error();

}


}
}
}
?>

























<?php
//NUEVO DESPLEGAR
//SI ENTRA AQUI QUIERE DECIR QUE SI HAY EXISTENCIAS
if($_POST['send']!=NULL){

    
//******VERIFICO SI EXISTE EL FOLIO DE VENTA******    
$sSQL3115s= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result3115s=mysql_db_query($basedatos,$sSQL3115s);
$myrow3115s = mysql_fetch_array($result3115s);    

if($myrow3115s['tipoPaciente']=='interno' or $myrow3115s['tipoPaciente']=='urgencias'){
$FV=$myrow3115s['folioVenta'];    
}else{ 
$generaFolio=new folioVenta();
$FV=$generaFolio-> generarFolioVenta($_GET['keyClientesInternos'],$usuario,"externo",$entidad,$tipoFolio,$basedatos);
$f='si';
}
//******************************************    
    
    
    
    
//**********GENERO EL NUMERO DE SOLICITUD ************//
    
        $q = "

    INSERT INTO solicitudes(numSolicitud,usuario,fecha,entidad,keyClientesInternos,hora)
    SELECT(IFNULL((SELECT MAX(numSolicitud)+1 from solicitudes where entidad='".$entidad."'), 1)), '".$usuario."',
    '".$fecha1."','".$entidad."','".$_GET['keyClientesInternos']."','".$hora1."' ";
    mysql_db_query($basedatos,$q);
    echo mysql_error();
    
    
    $sSQL333= "SELECT
    numSolicitud
    FROM solicitudes
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by keySolicitudes DESC
    ";

    $result333=mysql_db_query($basedatos,$sSQL333);
    $myrow333 = mysql_fetch_array($result333);
    $myrow333['NS']=$myrow333['numSolicitud'];
    if(!$myrow333['NS']){
    $myrow333['NS']=1;
    }
    
    

        $q4 = "

    INSERT INTO contadorTransaccionesKardex(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorTransaccionesKardex where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT max(contador) as topeMaximo from contadorTransaccionesKardex where entidad='".$entidad."' and usuario='".$usuario."'";
    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $numSolicitud=$myrow['topeMaximo'];

    
    
    //************************************


//QUIEN ES CENTRO DE DISTRIBUCION DE ESTA ENTIDAD    
$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);  


    
$sSQL= "SELECT
*
FROM cargosCuentaPaciente
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'
    and
    almacenSolicitante='".$_GET['almacen']."'
    and
    (statusCargo='standbyR' or statusCargo='cargadoR')
    and 
    usuario='".$usuario."'
";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
//**************CARGOS STANDBY*************/
    
    
    

    
    
    
    //SOLICITAR A OTRO ALMACEN
    if($_GET['almacen']!=$myrow['almacen']){ 
    $ns=$myrow333['NS'];    
    $statusCargo='standby';
    $fechaCargo=NULL;
    $horaCargo=NULL;
    $usuarioCargo=NULL;
    }elseif($myrow['almacenDestino']==$centroDistribucion){
    $ns=$myrow333['NS'];    
    $statusCargo='standby';
    $fechaCargo=NULL;
    $horaCargo=NULL;
    $usuarioCargo=NULL;
    }else{
    $ns=$myrow333['NS']; 
    $statusCargo='cargado';
    $fechaCargo=$fecha1;
    $horaCargo=$hora1;
    $usuarioCargo=$usuario;
    }
    
    //echo $_GET['almacen'].'  '.$myrow['almacen'];
//    echo $_GET['almacen'].'  '.$myrow['almacen'];
//    echo '<br>';
//    echo $statusCargo;
//    echo '<br>';
    
if($myrow['tipoPaciente']=='externo'){ 





#############DEPRECATED#####################
//$karticulos=new kardex();
//$karticulos-> movimientoskardex($numSolicitud,'salida',$myrow['cantidad'],'SALIDA POR VENTA','venta',$usuario,$fecha1,$hora1,$myrow['almacenSolicitante'],$myrow['almacenDestino'],$myrow['keyPA'],$myrow['codProcedimiento'],$entidad,$basedatos);
//********************************










###########AJUSTE MANUAL DE KARDEX#############
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codProcedimiento']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='02'
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
codigo='".$myrow['codProcedimiento']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();

    $sSQL8acb= "
SELECT * 
FROM
precioArticulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codProcedimiento']."'
    order by keyC DESC
";
$result8acb=mysql_db_query($basedatos,$sSQL8acb);
$myrow8acb = mysql_fetch_array($result8acb);


  $q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrow['codProcedimiento']."','".$myrow8acd['codigo']."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow['keyPA']."','".$myrow['almacenSolicitante']."',
        '".$myrow['almacenDestino']."',
        '".$myrow8acb['costo']."',
        '".$myrow['cantidad']."','".$myrow['cantidad']."','".$myrow['descripcionArticulo']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow['gpoProducto']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','SALIDA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX*******












//*************KARDEX*************
$ajusteExistencias=new existencias();
$ajusteExistencias->ajusteExistencias($f,'02',$myrow333['NS'],$FV,$_GET['keyClientesInternos'],$_GET['almacen'],$myrow['keyCAP'],$entidad,$myrow['gpoProducto'],$myrow['cantidad'],$myrow['codProcedimiento'],$myrow['almacenDestino'],$usuario,$fecha1,$error,$basedatos);
//ajusteExistencias($flag,$codigoInv,$numSolicitud,$folioVenta,$keyClientesInternos,$almacenSolicitante,$keyCAP,$entidad,$gpoProducto,$cantidad,$codigo,$almacen,$usuario,$fecha,$error,$basedatos){




     $sSQL29pa= "SELECT *
FROM
gpoProductos
where
codigoGP='".$myrow['gpoProducto']."'

";
$result29pa=mysql_db_query($basedatos,$sSQL29pa);
$myrow29pa = mysql_fetch_array($result29pa);



if($myrow29pa['afectaExistencias']=='si'){
//AQUI SE REGISTRA LA REPOSICION POR VENTA
$agrega1 = "INSERT INTO articulosSolicitudes (
codigo,keyPA,keyCAP,descripcion,almacenSolicitante,almacenDestino,cantidad,tipoVenta,usuario,fecha,hora,entidad,status,
gpoProducto,descripcionGrupoProducto,folioVenta,keyClientesInternos,nOrden
) values (

'".$myrow['codProcedimiento']."',

'".$myrow['keyPA']."',

'".$myrow['keyCAP']."',

'".$myrow['descripcionArticulo']."',

'".$myrow['almacenSolicitante']."',

'".$myrow['almacenDestino']."',

'".$myrow['cantidad']."',

'".$myrow['cajaCon']."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."','venta',

'".$myrow['gpoProducto']."','".$myrow['descripcionGrupoProducto']."',

'','".$myrow['keyClientesInternos']."','".$ns."'
)";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();
}


}else {



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



$sSQL29pa= "SELECT *
FROM
gpoProductos
where
codigoGP='".$myrow['gpoProducto']."'

";
$result29pa=mysql_db_query($basedatos,$sSQL29pa);
$myrow29pa = mysql_fetch_array($result29pa);
//*************************	
	//echo $myrow['almacenDestino'].'  '.$myrow29p['almacen'];
	 
	if($myrow['almacenDestino']!=$myrow29p['almacen']){//solamente entra cuando no es solicitud directa a cendis



if($myrow29pa['afectaExistencias']=='si'){ 

$ajusteExistencias=new existencias();
$ajusteExistencias->ajusteExistencias($f,'02',$myrow333['NS'],$FV,$_GET['keyClientesInternos'],$_GET['almacen'],$myrow['keyCAP'],$entidad,$myrow['gpoProducto'],$myrow['cantidad'],$myrow['codProcedimiento'],$myrow['almacenDestino'],$usuario,$fecha1,$error,$basedatos);
    
    

	
//AQUI SE REGISTRA LA REPOSICION POR VENTA 
$agrega1 = "INSERT INTO articulosSolicitudes (
codigo,keyPA,keyCAP,descripcion,almacenSolicitante,almacenDestino,cantidad,tipoVenta,usuario,fecha,hora,entidad,status,
gpoProducto,descripcionGrupoProducto,folioVenta,keyClientesInternos,nOrden
) values (

'".$myrow['codProcedimiento']."',

'".$myrow['keyPA']."',

'".$myrow['keyCAP']."',

'".$myrow['descripcionArticulo']."',

'".$myrow['almacenSolicitante']."',

'".$myrow['almacenDestino']."',

'".$myrow['cantidad']."',

'".$myrow['cajaCon']."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."','venta',

'".$myrow['gpoProducto']."','".$myrow['descripcionGrupoProducto']."',
    
'','".$myrow['keyClientesInternos']."','".$ns."'
)";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();
$karticulos=new kardex();
$karticulos-> movimientoskardex($myrow333['NS'],'salida',$myrow['cantidad'],'SALIDA POR VENTA','venta',$usuario,$fecha1,$hora1,$myrow['almacenSolicitante'],$myrow['almacenDestino'],$myrow['keyPA'],$myrow['codProcedimiento'],$entidad,$basedatos);

}


}	
}

    
//******GENERO EL FOLIO Y ASIGNO EL NUMERO DE SOLICITUD***
$actualiza = "update cargosCuentaPaciente
set
folioVenta='".$FV."',
numSolicitud='".$ns."',
fechaCargo='".$fechaCargo."',horaCargo='".$horaCargo."',usuarioCargo='".$usuarioCargo."',
statusCargo='".$statusCargo."'
WHERE keyCAP ='".$myrow['keyCAP']."'";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();  

}//CIERRA WHILE























    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
###DESCUENTOS SOBRE CONVENIOS  APLICA A INTERNOS Y EXTERNOS, ES GLOBAL  
if($myrow3['tipoPaciente']=='externo'){
if($_POST['descuentoSobreConvenio']>0){
$dsc='si';   
    


$descripcion='La cuenta tiene un descuento sobre convenio';
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$_GET['almacen']."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();    
 
$s= "Select * From catTTCaja WHERE  aplicarDescuentoAseguradoras='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,
tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,
descripcionArticulo,statusDescuento,keyClientesInternos,folioVenta,clientePrincipal) 
values 
('".$myrow3115s['numeroE']."','".$myrow3115s['nCuenta']."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$my['codigoTT']."','".$hora1."',
'".$hora1."','".$my['naturaleza']."','".$ID_EJERCICIOM."','','".$numeroConfirmacion."','".$ALMACEN."','".$usuario."',
'".$_POST['descuentoSobreConvenio']."','".$myrow3115s['seguro']."','standby','descuentoConvenio','".$myrow3115s['tipoPaciente']."',
'".$cantidadParticular."','".$_POST['descuentoSobreConvenio']."', '".$numCorte."','".$entidad."','".$tp."','standby'
,'".$_GET['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$ALMACEN."' , '".$my['descripcion']."' ,'si',
'".$_GET['keyClientesInternos']."','".$FV."','".$myrow3115s['clientePrincipal']."'  )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}//entra si es externo solamente
###CERRAR VALIDACION DE DESCUENTOS SOBRE CONVENIOS







//********VERIFICAR SI HAY DESCUENTOS NORMALES *******


if($myrow3115s['descuento']=='si' and $dsc==null){ 

        $descripcion='El paciente tiene un descuento: '.$myrow3115s['paciente'].',codigo: '.$_GET['keyClientesInternos'];
        $agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$departamento."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
    
    
    
$sSQL3a= "Select * From descuentosAutomaticos WHERE entidad='".$entidad."' and departamento = '".$myrow3115s['almacen']."'  and statusCupon='si'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
$descuentoTotal=$_POST['totalCargos']*($myrow3a['porcentaje']*0.01);
if($myrow3115s['seguro'] ){

$cantidadAseguradora=$descuentoTotal;
$s= "Select * From catTTCaja WHERE  aplicarDescuentoAseguradoras='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

}else{

$cantidadParticular=$descuentoTotal;
$s= "Select * From catTTCaja WHERE  aplicarDescuentoParticulares='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
}
$codigoTT=$my['codigoTT'];
$descripcionArticulo='Descuento de promocion del: '.$myrow3a['porcentaje'].'%';


if($myrow3a['porcentaje']){
?>

<script>
window.alert("Se aplico el <?php echo $myrow3a['porcentaje'];?>% de descuento...");
</script>

<?php 
 $agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,descripcionArticulo,statusDescuento,keyClientesInternos,folioVenta) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','".$hora1."',
'".$hora1."','".$my['naturaleza']."','".$ID_EJERCICIOM."','','".$numeroConfirmacion."','".$ALMACEN."','".$usuario."',
'".$descuentoTotal."','".$seguro."','standby','coaseguro','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."', '".$numCorte."','".$entidad."','".$tp."','standby'
,'".$_GET['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$ALMACEN."' , '".$descripcionArticulo."' ,'si',
'".$_GET['keyClientesInternos']."','".$FV."'  )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{ ?>
<script>
window.alert("No hay codigos de promocion en este momento...");
</script>

<?php 
}
}
 
//***VERIFICAR SI EL CENTRO DE COSTO TIENE PUNTO DE VENTA
$sSQL3a= "Select puntoVenta From almacenes WHERE entidad='".$entidad."' and almacen = '".$_GET['almacen']."'   ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
//***************************************************************************

if($myrow3115s['tipoPaciente']=='externo'){?>


<?php if($myrow3a['puntoVenta']!=NULL){?>
<script>
window.alert("SE GENERO EL FOLIO DE VENTA <?php echo $FV;?>"); 
ventanaSecundaria2('/sima/INGRESOS HLC/caja/estadoCuentaE.php?numeroE=<?php echo $myrow15['numeroE']; ?>&nCuenta=<?php echo $myrow15['keyClientesInternos']; ?>&almacenSolicitante=<?php echo $_GET['almacen']; ?>&nT=<?php echo $myrow15['keyClientesInternos']; ?>&folioVenta=<?php echo $FV;?>&tipoVenta=<?php echo 'externo';?>&devolucion=<?php echo $myrow15['statusDevolucion'];?>&descripcionTransaccion=externos&warehouse=<?php echo $_GET['warehouse'];?>#final','ventana1','1024','1000','yes');
window.close();
</script>
<?php }else{ ?>

<script>
window.alert("SE GENERO EL FOLIO DE VENTA <?php echo $FV;?>"); 
window.close();
</script>

<?php } ?>


<?php
}else{

echo '<script>';
echo 'window.alert("ARTICULOS CARGADOS CORRECTAMENTE!");';    
echo 'window.close();';
echo '</script>';  
    
}







//ACTUALIZO NUMERO DE REGISTROS
    $sSQLf= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
keyClientesInternos='".$_GET['keyClientesInternos']."'

";
$resultf=mysql_db_query($basedatos,$sSQLf);
$rows = mysql_num_rows($resultf);

if($rows>0){
$actualiza = "update clientesInternos
set
rows='".$rows."'
WHERE

keyClientesInternos='".$_GET['keyClientesInternos']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();  
}
//**********ACTUALIZA KARDEX**************
$actualizaK=new ActualizaKardex();
$actualizaK=$actualizaK-> updateKardex($usuario,$entidad,$basedatos);
//*******CIERRA ACTUALIZAR KARDEX*********s
}
?>






























<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar solicitud?')) return true;
return false;
}
-->
</script>










<?php
$convenioParticular=new acumulados(); $convenioAseguradora=new acumulados(); 
$cargosParticulares=new  acumulados();	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<p align="center">
 
  <span ><?php echo $leyenda; ?></span></p>




<form id="form1" name="form1" method="post"  >



<?php	
$informacionExistencias=new existencias();    
$sSQL31= "Select  tipoPaciente From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);



$sSQLr= "SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."' 
and
almacen='".$almacenSolicitante."'";

$resultr=mysql_db_query($basedatos,$sSQLr);
$myrowr = mysql_fetch_array($resultr);

if($myrowr['almacenCargo']){

$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
keyClientesInternos='".$_GET['keyClientesInternos']."'
AND
statusCargo='cargadoR'
and
status!='transaccion'
and
usuario='".$usuario."'
group by keyPA
order by almacen,descripcionArticulo ASC

";



}else{ //nmo trae
if($myrow31['tipoPaciente']=='interno' or $myrow31['tipoPaciente']=='urgencias'){


$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
keyClientesInternos='".$_GET['keyClientesInternos']."'
and
statusCargo='standbyR'
and
almacenSolicitante='".$almacenSolicitante."'
and
status!='transaccion'
and
usuario='".$usuario."'
group by keyPA
order by almacen,descripcionArticulo ASC

";

} else {
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
keyClientesInternos='".$_GET['keyClientesInternos']."'
AND
statusCargo='cargadoR'
and
status!='transaccion'
and
usuario='".$usuario."'
group by keyPA
order by fecha1,hora1 ASC

";
}
}


if($_GET['keyClientesInternos']){
if($result=mysql_db_query($basedatos,$sSQL)){

?>
    <p>
      <span ><span >
      <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
      </span></span>
      <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />
      
      <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
      <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
      <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
      <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
      <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
      <span ><?php echo $leyenda; ?></span>
      <?php 

$sSQL31= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$lSeguro=$myrow31['limiteSeguro'];
$paciente=$myrow31['paciente'];
$clienteP=  $myrow31['clientePrincipal'];
?>
  </p>

    
<?php
//echo 'descuento';
?>
    
  <table width="700" class="table table-striped">
    <tr>
      <th colspan="700" >
          <p align="center" >Paciente: <?php echo $paciente; ?></p></th>
    </tr>
    
    <tr>
      <td height="24" colspan="7" align="center" >Limite: <?php echo '$'.number_format($myrow31['limiteSeguro'],2); ?></td>
    </tr>
    <tr >
       <th width="10"  align="center">#</th> 
      <th width="10"  align="center">Hora/Fecha</th>
      <th width="100" >Descripcion</th>
          <th width="10" align="center" >Antibiotico/Especial</th>
      <th width="5" align="center" >Cant</th>
      <th width="10" align="right" >Part</th>
      <th width="10" align="right" >Benef</th>
      <th width="10" align="right" >Aseg</th>
      <th width="50" align="center" >Almacen</th>
      <th width="5" align="center" >Quitar</th>
  
    </tr>
    <?php 
while($myrow = mysql_fetch_array($result)){ 
$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}



$sSQL14n= "
SELECT 
sum(cantidad) as c
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
keyClientesInternos='".$_GET['keyClientesInternos']."'
and
keyPA='".$myrow['keyPA']."'
    and
    (statusCargo='standbyR' or statusCargo='cargadoR')
    and
    usuario='".$usuario."'
";
$result14n=mysql_db_query($basedatos,$sSQL14n);
$myrow14n = mysql_fetch_array($result14n);

?>
    <tr  >
        <td height="55"  align="center">
            <?php echo $bandera;?>
        </td>  
        
        
      <td height="55"  align="center">
      <?php 
		  if($myrow['um']='s'  ){ ?>
		  	        <a href="javascript:ventanaSecundaria8('ventanCambiaFecha.php?keyCAP=<?php echo $myrow['keyCAP']; ?>&almacenDestino=<?php echo $myrow['almacenDestino']; ?>&expediente=<?php echo 'no'; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&numeroExpediente=<?php echo $myrow112['numeroE']; ?>&seguro=<?php echo $_POST['seguro']; ?>&firstTime=<?php echo $firstTime;?>')">
					
					
          <?php 
		  if($myrow['horaSolicitud'] and $myrow['fechaSolicitud']){
		  echo $myrow['horaSolicitud']." ".$myrow['fechaSolicitud']; 
		 }else {
		 echo $myrow['hora1']." ".$myrow['fecha1'];
		 }
		  ?>          
		  
		  <?php } else { ?>
		 
		            <?php  echo $myrow['hora1']." ".$myrow['fecha1'];  ?>          
					
					<?php } ?></a>
		  
		  
		  
		  
		  <input name="codigoArt[]" type="hidden"  value="<?php  echo $myrow['codProcedimiento']; ?>" />        
      
      </td>
      <td >
      <?php 
		if($myrow['tipoTransaccion'] and !$myrow11['descripcion']){
		echo "Deposito o Movimiento de Caja" ;
		} else {
			$descripcion=new articulosDetalles();
			
			
$sSQL31c= "Select * From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow['almacenIngreso']."' ";
$result31c=mysql_db_query($basedatos,$sSQL31c);
$myrow31c = mysql_fetch_array($result31c);

if($myrow31c['modificarPrecios']=='si'){ ?>

<a   href="javascript:ventanaSecundaria8('ventanCambiaLaboratorioReferido.php?keyCAP=<?php echo $keyCAP; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&keyClientesInternos=<?php echo $_GET['keyClientesInternos'];?>')">

<?php
if($myrow['descripcionArticulo']){
echo $myrow['descripcionArticulo'];
} else {
$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
}
?>
</a>
<?php 
						} else {

					$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
	}	
		
		}
		?>
		<?php if($myrow['status']=='cancelado'){ ?>
		  <span class="Estilo25"><blink><?php echo '(Articulo Cancelado por '.$myrow['usuarioCancela'].')';?></blink></span>
		<?php } ?>
		
		<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>		
        <?php echo '</br>'.'usuario solicita: ['.$myrow['usuario'].']';?>        
        </br>
        <span class="negro">Movto N&deg;: <?php echo $myrow['keyCAP'];?></span>
		<?php if($myrow['statusDescuentoGlobal']=='si'){
		echo '</br><span class="precio1">'.' ['.$myrow['descripcionDescuentoGlobal'].']'.'</span>';
		}
		?>
  
  <?php 
  
  
$sSQL29pa= "SELECT *
FROM
gpoProductos
where
codigoGP='".$myrow['gpoProducto']."'

";
$result29pa=mysql_db_query($basedatos,$sSQL29pa);
$myrow29pa = mysql_fetch_array($result29pa);  
if($myrow29pa['afectaExistencias']=='si'){  
//echo '<br>';
//$es=$informacionExistencias->informacionExistencias($myrow31['tipoPaciente'],$entidad,$myrow['codProcedimiento'],$myrow['almacenDestino'],$usuario,$fecha,$basedatos);
//echo 'status/Existencias: '.$es;
//

//$solicitudAjusteExistencias=new existencias();
//$error=$solicitudAjusteExistencias->solicitudAjusteExistencias($entidad,$myrow['gpoProducto'],$myrow['cantidad'],$myrow['codProcedimiento'],$myrow['almacenDestino'],$usuario,$fecha1,$error,$basedatos);

  
  
  
  
  
  
  
  
  
  
///VERIFICAR EXISTENCIAS
$sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$myrow['almacenDestino']."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){
    
    $almacenEx=$myrow29p['almacenExistencias'];
    
}else{
    $almacenEx=$myrow['almacenDestino'];
}







///VERIFICAR EXISTENCIAS AUTOMATICAS
$sSQL29pae= "SELECT statusExistencias
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacenEx."' 

";
$result29pae=mysql_db_query($basedatos,$sSQL29pae);
$myrow29pae = mysql_fetch_array($result29pae);








$sSQL29pe= "SELECT *
FROM
entidades
where
codigoEntidad='".$entidad."'

";
$result29pe=mysql_db_query($basedatos,$sSQL29pe);
$myrow29pe = mysql_fetch_array($result29pe);


if(    $myrow29['statusExistencias']!='A' ){//verifico que la entidad no traiga el cargo infinito

if($myrow29pae['statusExistencias']!='A'){//verifico que el almacen no traiga el cargo infinito
    



$sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codProcedimiento']."'
    and
    almacen='".$almacenEx."'
and
status='ready'
        
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);





 $existencia=$myrow8ac1e['entrada'];

 
if($existencia<$myrow14n['c']){//SI SE PUEDe CARGAr DEVUELVO NULL
$error='faked';
$array[]= '<div class="error">NO HAY EXISTENCIAS DE '.$myrow['descripcionArticulo'].', existencia: '.$existencia.'</div>';
$r+=1;
}
}//hago bypass si las existencias son automaticas almacenes
//clave: en4nt36ec24tyeb4a
}  //hago bypass si las existencias son automaticas entidades
}





if($error!=NULL){//si se cargo
        $ex[0]+=1;
}
?>

  </td>




      <?php 
      $sSQL3115= "Select farmacia From almacenes WHERE entidad='".$entidad."' and
farmacia='si'  ";
$result3115=mysql_db_query($basedatos,$sSQL3115);
$myrow3115 = mysql_fetch_array($result3115);

$sSQLal= "Select llenadoEspecial From almacenes WHERE entidad='".$entidad."' and
almacen='".$_GET['almacen']."'  ";
$resultal=mysql_db_query($basedatos,$sSQLal);
$myrowal = mysql_fetch_array($resultal);

 ?>



    <td  align="center">
<?php 

if($myrow['antibiotico']=='si' and $myrow['tipoPaciente']=='externo'){?>
        <?php
          $sSQL1e= "Select * From antibioticos WHERE entidad='".$entidad."' and keyClientesInternos='".$_GET['keyClientesInternos']."' and keyPA='".$myrow['keyPA']."'";
$result1e=mysql_db_query($basedatos,$sSQL1e);
$myrow1e = mysql_fetch_array($result1e);?>


<?php if($myrow1e['keyClientesInternos']==NULL){ $anti+=1;  }?>
        <a href="javascript:ventanaSecundaria8a('catalogoantibiotico.php?keyCAP=<?php echo $myrow['keyCAP']; ?>
           &almacenDestino=<?php echo $myrow['almacenDestino']; ?>
           &expediente=<?php echo 'no'; ?>
           &keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>
           &keyCAP=<?php echo $myrow['keyCAP']; ?>
           &seguro=<?php echo $_POST['seguro']; ?>
           &cantidadpiezas=<?php echo $myrow14n['c'];?>
&descripcion=<?php echo $myrow['descripcionArticulo'];?>
&paciente=<?php echo $paciente;?>
&numeroE=<?php echo $myrow31['numeroE'];?>
&keyPA=<?php echo $myrow['keyPA'];?>
&almacen=<?php echo $_GET['almacen'];?>
')">
<?php if($myrow1e['keyanti']!=NULL){
    echo '#'.$myrow1e['keyanti'];
}else{
    echo 'Edit';
}
    ?>
        </a>
      


<?php }elseif($myrowal['llenadoEspecial']!=NULL){

?>
        
        
<?php 




if($myrow31['statusEstudio']==NULL){ $anti+=1;  }?>
<a href="javascript:ventanaSecundaria8a2('../ventanas/<?php echo $myrowr['llenadoEspecial'];?>?keyCAP=<?php echo $myrow['keyCAP']; ?>&almacenDestino=<?php echo $myrow['almacenDestino']; ?>&expediente=<?php echo 'no'; ?>
&keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>
&keyCAP=<?php echo $myrow['keyCAP']; ?>
&seguro=<?php echo $_POST['seguro']; ?>
&cantidadpiezas=<?php echo $myrow14n['c'];?>
&descripcion=<?php echo $myrow['descripcionArticulo'];?>
&paciente=<?php echo $paciente;?>
&numeroE=<?php echo $myrow31['numeroE'];?>
&keyPA=<?php echo $myrow['keyPA'];?>
&almacen=<?php echo $_GET['almacen'];?>
&codigo=<?php echo $myrow['codProcedimiento'];?>
')">
<?php if($myrow1e['keyanti']!=NULL){
    echo '#'.$myrow1e['keyanti'];
}else{
    echo 'Edit';
}
    ?>
</a>        
<?php }else{
echo '---';
}
    ?>
        
    
      </td>














      <td  align="center">
      <?php if($myrow14n['c']>0){
$myrow['cantidad']=$myrow14n['c'];
echo $myrow14n['c'];
} else {
echo "N/A";
}




?>
      
      </td>
        
        
        
      <td  align="right"><?php 
		$totalP[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
		echo "$".number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2); ?></td>


 <td  align="right"><?php 
		$totalB[0]+=($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
		echo "$".number_format(($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']),2); ?></td>

        <td  align="right">
      <?php $totalA[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
		echo "$".number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2); ?>
      </td>




        <td  align="center">
      <?php 
		$sSQL31= "SELECT 
descripcion
FROM almacenes
WHERE 
entidad='".$entidad."'
and
almacen ='".$myrow['almacenDestino']."'";

$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

		echo $myrow31['descripcion']; ?>
      </td>



      <td align="center">
      <input name="quitar[]" type="checkbox" value="<?php echo $myrow['keyPA'];?>" />
          <input name="keyCAP[]" type="hidden" value="<?php echo $myrow['keyCAP'];?>" />
      </td>











    </tr>
    <?php }}?>
    
    
<tr>
<th colspan="10">
<div align="center">
<?php 
if($r>0){
for($is=0;$is<=$r;$is++){
print $array[$is];
}
}
?>
</div>
  </th>
</tr>    
    
  </table>


  <table width="500" class="table-forma">
	<tr >
      
    </tr>
      
    
    
    
    
    
  </table>

 
  <p>
    <?php 
	
	
	} ?>
    
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
    <?php if($bandera>0){ ?>
  </p>
    
    
    

  </p>

  <div align="center">
    <p>

      <br />
    </p>
              
                <table width="400" class="table-forma">
                  
                    
                  <tr>
                    <th width="85" height="23"  >Particular</th>
                    <td width="87"  align="right"><span  ><?php echo "$".number_format($totalP[0],2);?></span></td>
                  </tr>
                  
                               <tr>
                  <th  >Beneficencia</th>
                  <td  align="right"><span ><?php echo "$".number_format($totalB[0],2);?></span></td>
                  </tr>
                  
                  
                  <tr>
                  <th  >Aseguradora</th>
                  <td  align="right"><span ><?php echo "$".number_format($totalA[0],2);?></span></td>
               
                  </tr>
                  
                  
                  <?php //descuento sobre convenio 30sep2013
                    ###DESCUENTO SOBRE CONVENIO
                    $sql5= "
                    SELECT *
                    FROM
                    convenios
                    WHERE
                    entidad='".$entidad."'
                        and
                    numCliente =  '".$clienteP."'
                    AND
                    (departamento ='".$_GET['almacen']."' or departamento='*')
                    AND
                    tipoConvenio='descuentoConvenio'
                    and
                    ('".$fecha1."'>=fechaInicial and '".$fecha1."'<=fechaFinal)
                    ";
                    $result5=mysql_db_query($basedatos,$sql5);
                    $myrow5= mysql_fetch_array($result5);
                    
                    if($myrow5['costo']>0){
                 
                    $sSQL3a= "
                        Select sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as totales 
                        From cargosCuentaPaciente 
                        WHERE entidad='".$entidad."' 
                            and 
                            keyClientesInternos = '".$_GET['keyClientesInternos']."' ";
                    $result3a=mysql_db_query($basedatos,$sSQL3a);
                    $myrow3a = mysql_fetch_array($result3a);
                    
                    //echo $myrow5['costo'].'  '.$myrow3a['totales'];
                    



                    $cantidadDescuento=($myrow5['costo']*0.01)*$myrow3a['totales'];
                    $cantidadTotalDescuento=$myrow3a['totales']-$cantidadDescuento;
                  ?>
                    
                  <?php if($myrow5['costo']>0){?>
                  <tr>  
                  <th  >Descuento Aseguradora</th>
                  <td  align="right"><?php echo '-'.$myrow5['costo'].'%'.'    ';?><span ><?php echo "$".number_format($cantidadDescuento,2);?></span></td>
                  </tr>
                    
                   <tr>  
                  <th  >Total Aseguradora</th>
                  <td  align="right"><span ><?php echo "$".number_format($cantidadTotalDescuento,2);?></span></td>
                  </tr> 
                  <input name="descuentoSobreConvenio" type="hidden" id="totalCargos" value="<?php  echo $cantidadDescuento; ?>" />  
                  <?php }}?>  
                    
                  <tr>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                  </tr>
                  <tr>
                    <th colspan="2" align="center" ><p align="center">Total de Venta</p></th>
                  </tr>
                  <tr >
                    <td colspan="2" align="center"><p align="center"><?php echo '$'.number_format($totalP[0]+$totalA[0]+$totalB[0],2);?></p></td>
                  </tr>
    </table>
                
                
                
                
                
                
                
     
                
                
                
                
                
                
                
                
                
                
                
                
                
              
                <p>
                  <?php 
	  
	  $comprobacion=$totalP[0]+$totalA[0];
	  ?>
	  
                  <span >
      <input name="totalCargos" type="hidden" id="totalCargos" value="<?php  echo $totalP[0]+$totalA[0]; ?>" />
</span>                </p>
      
      
      
                
                
                
                
                
                
                
                
                
                
<?php 
                   //SI NO HAY EXISTENCIAS NO TIENE CASO SEGUIR
                   if($ex[0]>0){?>
      <span class="precio2">

      <table width="424" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                 
                    <td width="145" align="center"><input name="borrar" type="submit" class="boton2" id="numPaciente" value="Borrar/Eliminar" /></td>
                  </tr>
    </table>
         <br></br>
     <blink>Favor de Verificar Existencias...!! </blink>
 </span>
 
 
 
 <?php }   else{?>
                
                
                
      
      <?php 
     $sSQL31= "SELECT 
farmacia
FROM almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$_GET['almacen']."'  ";

$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);




//verificando limite de seguro
if($lSeguro>0 AND $lSeguro<$comprobacion ){?>

 	     <span class="precio2">

      <table width="424" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                 
                    <td width="145" align="center"><input name="borrar" type="submit" class="boton2" id="numPaciente" value="Borrar/Eliminar" /></td>
                  </tr>
    </table>
         <br></br>
     <blink><div align="right" class="error"><h1 >VERIFIQUE EL LIMITE DE CREDITO...!! </h1></div></blink>
 	

      <?php }elseif($myrow31['farmacia']=='si' or $myrow1e['llenadoEspecial']!='si'){
      if($anti<1){ ?>
      <table width="424" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td width="174" align="center"><input name="send" type="submit" class="boton1" id="enviar" value="Enviar Solicitud" onClick="return comprueba();" /></td>
                    <td width="105">&nbsp;</td>
                    <td width="145" align="center"><input name="borrar" type="submit" class="boton2" id="numPaciente" value="Borrar/Eliminar" /></td>
                  </tr>
    </table>
      <?php }else{ ?>

     <span class="precio2">

      <table width="424" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                 
                    <td width="145" align="center"><input name="borrar" type="submit" class="boton2" id="numPaciente" value="Borrar/Eliminar" /></td>
                  </tr>
    </table>
         <br></br>
     <blink>Favor de llenar datos...!! </blink>
 </span>



      <?php } ?>
 
 <?php }elseif($myrow31['limiteSeguro']>$comprobacion){	?>
 	
 	     <span class="precio2">

      <table width="424" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                 
                    <td width="145" align="center"><input name="borrar" type="submit" class="boton2" id="numPaciente" value="Borrar/Eliminar" /></td>
                  </tr>
    </table>
         <br></br>
     <blink>Favor de llenar datos...!! </blink>
 	
<?php }else{?>
            <table width="424" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td width="174" align="center">
                        
                        
                        <input name="send" type="submit" class="boton1" id="enviar" value="Enviar Solicitud" onClick="return comprueba();" /></td>
                    <td width="105">&nbsp;</td>
                    <td width="145" align="center"><input name="borrar" type="submit" class="boton2" id="numPaciente" value="Borrar/Eliminar" /></td>
                  </tr>
    </table>
          
      <?php }} ?>
 
 
 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
      <p>
        <label></label>
        <span class="negro"><span class="precio2">
      <?php } else { echo 'No hay Registros';}?>
      </span></span> </p>
  </div>
</form>
<br>
<br>
  

</body>
</html>

