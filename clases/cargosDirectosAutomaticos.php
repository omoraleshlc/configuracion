<?php class cargosDirectos{
public function aplicarCargosAutomaticos($usuario,$fecha1,$hora1,$dia,$cuarto,$entidad,$basedatos){

if($cuarto){
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' AND
statusCuenta = 'abierta'
and
status='activa'
and
cuarto='".$cuarto."'
";
} else {
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' AND
statusCuenta = 'abierta'
and
status='activa'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
 ";
}

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];$nCuenta=$myrow['nCuenta'];
$tipoPaciente=$myrow['tipoPaciente'];
$_POST['seguro']=$myrow['seguro'];
$_POST['almacenDestino2']=$myrow['almacen'];
$_POST['cuarto']=$myrow['cuarto'];



//**************ACTIVAR  CARGO AUTOMATICO A CUARTOS**************

if($_POST['seguro']){
$statu='cxc';
$tipoCliente='aseguradora';
} else {
$tipoCliente='particular';
$statu='particular';
}


$sSQL31= "Select  * From articulos WHERE entidad='".$entidad."' AND id_cuarto = '".$_POST['cuarto']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$codigo=$myrow31['codigo'];

$sSQL311= "Select  * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_POST['almacenDestino2']."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$centroCosto=$myrow311['ID_CCOSTO'];


$grupoProducto=new articulosDetalles();
$gpoProducto=$grupoProducto->grupoProducto($codigo,$basedatos);
$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($paquete,$_POST['generico'],'1',$numeroE,$nCuenta,$codigo,$_POST['almacenDestino2'],$basedatos);
$iva=new articulosDetalles();
$iva=$iva->iva('1',$codigo,$priceLevel,$basedatos);  

if($codigo){
$agrega1="INSERT INTO cargosCuentaPaciente ( numeroE, nCuenta, codProcedimiento, cantidad, usuario, fecha1, ip, status, almacen, precioVenta, ctaMayor, ctoCosto, auxiliar, ejercicio, seguro,iva,dia,costoHospital,hora1,existencias,um, medico,tipoPaciente,prioridad,horaSolicitud,fechaSolicitud,laboratorioReferido, credencial,banderaCXC,statusCargo,almacenDestino,almacenSolicitante,naturaleza,statusTraslado,tipoCliente, statusEstudio,entidad,
gpoProducto,fechaCargo,horaCargo,cargoAuto ) values ( 
'".$numeroE."', '".$nCuenta."', '".$codigo."', '1', '".$usuario."', '".$fecha1."', '', '".$statu."', '".$_POST['almacenDestino2']."', '".$priceLevel."', '', '".$centroCosto."', '0000000', '".$ID_EJERCICIOM."', '".$_POST['seguro']."','".$iva."','".$dia."','0','".$hora1."','0','s', '".$_POST['medico']."','".$tipoPaciente."','baja', '','".$fecha1."','','', '','cargado','".$_POST['almacenDestino2']."','".$_POST['almacenDestino2']."','C','standby','".$tipoCliente."','cargado','".$entidad."',
'".$gpoProducto."','".$fecha1."','".$hora1."','si')"; 
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
}
//**************CERRAR CARGOA AUTOMATICO A CUARTOS***************

}
}

}//cierra funcion
}//cierra clase
?>