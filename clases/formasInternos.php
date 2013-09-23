<?php 
//clase 3
class solicitar{
public function solicitaArticulos($entidad,$almacenSolicitante,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){

//QUIEN ES CENTRO DE DISTRIBUCION DE ESTA ENTIDAD    
$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);   
$almacenPrincipal=$centroDistribucion;//necesitamos definirlo desde el cat�logo de almacenes
?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el departamento!")   
                return false   
        } else if( vacio(F.tipoUM.value) == false ) {   
                alert("Por Favor, escoje si es un servicio o si son art�culos lo que vas a cargar!")   
                return false   
        } else if( vacio(F.nomArticulo.value) == false ) {   
                alert("Por Favor, escoje el articulo o servicio para solicitar!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>


<?php 

   if($_POST['entidades']){
	   $entidad=$_POST['entidades'];
	   } else {
	   $_POST['entidades']=$entidad;
	   }




if(!$_POST['buscar'] and $_POST['insertarArticulos']){


if($_POST['insertarArticulos'] ){ 

$numeroE=$numeroPaciente;
$keyClientesInternos=$_GET['keyClientesInternos'];
$nCuenta=$nCuenta;


$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenioS=new validaConvenios();
$traeConvenio=new validaConvenios();
$vConvenio=new validaConvenios();
$ivaAseguradora=new ivaCierre();
$ivaParticular=new ivaCierre();
$tipoVenta=new tipoVentaArticulo();
$tipoVentaIVA=new tipoVentaArticulo();
$ventaPieza=new tipoVentaArticulo();
$verificaSaldos1=new verificaSeguro1();
$descripcion=new articulosDetalles();
$random=rand(10000,10000000000000);
$porcentajeIVA=new articulosDetalles();
$validaJubilados=new validaConvenios();
$porcentajeJubilados=new validaConvenios();
$grupoProducto=new articulosDetalles();
$descripcionGrupoProducto=new articulosDetalles();
$beneficenciaT6=new articulosDetalles();

if($_POST['almacenDestino1']){
$almacen=$_POST['almacenDestino1'];
} else {
$almacen=$_POST['almacenDestino'];
}
$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();

//*************************PRESIONO INSERTAR ARTICULOS******************
$aux=traeAuxiliar::auxiliar($fecha1,$hora1,$almacen,$basedatos,$ID_EJERCICIOM,$db_conn);
$codigo=$_POST['codigoArt'];
$cantidad=$_POST['cantidad'];
$agregarA=$_POST['agregarA'];
$codigoBeta=$_POST['codigoBeta'];
$laboratorioReferido=$_POST['laboratorioReferido'];


for($i=0; $i<=$_POST['bandera'];$i++){ //********************FOR
$b+=1;

$codigo[$i]=$codigoBeta[$i];





$gpoProducto=trim($grupoProducto->grupoProducto($entidad,$codigo[$i],$basedatos));
$descripcionGP=$descripcionGrupoProducto->descripcionGrupoProducto($entidad,$gpoProducto,$basedatos);
$costoHospital=costoHospital($entidad,$codigo[$i],$basedatos);
$ctaContable=centroCosto($medico,$basedatos);
$centroCostoAlmacen=centroCostoAlmacen($almacen,$basedatos);
//$medico=devuelveMedico::regresaMedico($entidad,$codigo[$i],$basedatos);




$cLlave=new articulosDetalles();
$keyPA=$cLlave->codigollave($entidad,$codigo[$i],$basedatos);

$precioEspecial=new articulosDetalles();
$precioEspecial->preciosEspeciales($entidad,$gpoProducto,$keyPA,$codigo[$i],$almacen,$basedatos);

$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($entidad,$paquete,$_POST['generico'],$cantidad[$i],$numeroE,$_GET['keyClientesInternos'],$codigo[$i],$almacen,$basedatos);


$benT6=$beneficenciaT6->beneficenciaT6($entidad,$paquete,$myrow['generico'],"1",$numeroPaciente,$_GET['keyClientesInternos'],$codigo[$i],$almacen,$basedatos);

if($benT6>0){
    $dB='si';
    $caso=6;
}











//*************************CONFIGURACIONES DE VENTAS*********************
$modoventa=new articulosDetalles();
$priceLevel=$modoventa->modoventa($almacen,$priceLevel,$codigo[$i],$entidad,$keyPA,$basedatos);
$tventa=new articulosDetalles();
$tipoVenta=$tventa->tventa($almacen,$priceLevel,$codigo[$i],$entidad,$keyPA,$basedatos);
$cantidadReal=new articulosDetalles();
$cantidadReal=$cantidadReal->cantidadReal($almacen,$priceLevel,$codigo[$i],$entidad,$keyPA,$basedatos);
//**********************************************************************************
















$antibiotico=new articulosDetalles();



if( $cantidad[$i]>0 ){ 









$cargoAuto=new articulosDetalles();
$cargoAuto=$cargoAuto->cargoAuto($entidad,$codigo[$i],$basedatos);





$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);
$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);
//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);
$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);
//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);




if($error!='faked' ){ 


//aqui voy a meter como se vende por cantidad***********
//***********la forma en que se venden los medicamentos********************

$iva=new articulosDetalles();
$iva=$iva->iva($entidad,$cantidad[$i],$codigo[$i],$priceLevel,$basedatos); 

//if($ventaPieza->ventaPieza($almacen,$keyPA,$precioVenta,$iva,$cantidad[$i],$entidad,$basedatos)=='si'){
//if($tipoVenta->vendoX($almacen,$keyPA,$priceLevel,$iva,$cantidad[$i],$entidad,$basedatos)!=NULL){
//$priceLevel=$tipoVentaArticulos=$tipoVenta->vendoX($almacen,$keyPA,$priceLevel,$iva,$cantidad[$i],$entidad,$basedatos);
//}
//$iva=$tipoVentaIVA->vendoXIVA($almacen,$keyPA,$priceLevel,$iva,$cantidad[$i],$entidad,$basedatos);
//} 
//********************************************




$precioOriginal=$priceLevel;
$ivaOriginal=$iva;






if($traeSeguro->traeSeguro($keyClientesInternos,$basedatos) and $tipoConvenio=='No'){ //no es necesario la entidad



if($validaJubilados->validacionJubilados($_GET['numeroE'],$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$entidad,$basedatos)=='si'){ //no es necesario entidad
$percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$entidad,$basedatos);
$percent*=0.01;
$porcentajeParticular= (100-($percent*100))*0.01;


$ivaParticulart=$iva*$porcentajeParticular;
$ivaAseguradorat=$iva*$percent;

$cantidadAseguradora=$priceLevel*$percent;
$cantidadParticular=$priceLevel-$cantidadAseguradora;
//$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;

} else { //no es jubilado y por tanto verifico si trae algun convenio
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$iva;
}



}else{






if($tipoConvenio=='cantidad'){ 
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora;
 $priceLevel=$acumulado;
 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$priceLevel,$basedatos); 
} else if($tipoConvenio=='grupoProducto'){  

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);
$cantidadParticular=$cantidadAseguradora-$priceLevel;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='global'){  
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);

$cantidadParticular=$priceLevel-$cantidadAseguradora;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='precioEspecial'){ 


$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);
$cantidadAseguradora=NULL;
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);
$ivaAseguradorat=NULL;
} else { 

$cantidadParticular=$priceLevel;
$ivaParticulart=$iva;
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
}
}





if($traeSeguro->traeSeguro($keyClientesInternos,$basedatos)){
$status='cxc';
$statusAlta='standby';
$tipoCliente='aseguradora';
} else {
$status='particular';
$statusAlta='standby';
$tipoCliente='particular';
}




$statusCargo='standbyR';


if($acumuladoGlobal>$priceLevel){
//$acumulado=$acumuladoGlobal-$priceLevel;
$acumulado=$priceLevel;
} else {
$acumulado=$priceLevel;
}


if($tipoVentaArticulos){ 
$formaVenta='unidad';
} else {
$formaVenta='normal';
}


$traeSeguro->traeSeguro($keyClientesInternos,$basedatos);

//*****************************cargo clientePrincipal
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$sSQL455a= "Select nomCliente from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";

$result455a=mysql_db_query($basedatos,$sSQL455a);

$myrow455a = mysql_fetch_array($result455a);
//****************************************************************


$sSQL3115= "Select folioVenta,status,beneficencia From clientesInternos WHERE keyClientesInternos='".$keyClientesInternos."'";
$result3115=mysql_db_query($basedatos,$sSQL3115);
$myrow3115 = mysql_fetch_array($result3115);


$sSQL3115y = "Select pagoEfectivo From clientes WHERE numCliente='".$seguro."' and entidad='".$entidad."'";
$result3115y=mysql_db_query($basedatos,$sSQL3115y);
$myrow3115y = mysql_fetch_array($result3115y);



if($myrow3115y['pagoEfectivo']=='si'){
$tipoCliente='particular';
$status='particular';
}











//****************************DESCUENTOS AUTOMATICOS**********
$sSQL7ada= "Select * From descuentosAutomaticos where entidad='".$entidad."' and departamento='".$_GET['almacen']."' and seguro='".$myrow455['clientePrincipal']."' and
(fechaInicial>='".$fecha1."' and fechaFinal<='".$fecha1."')
and
(tipoPaciente='interno' or tipoPaciente='ambos')
";
$result7ada=mysql_db_query($basedatos,$sSQL7ada); 
$myrow7ada = mysql_fetch_array($result7ada);
echo mysql_error();

if($myrow7ada['gpoProducto']=='*' || $myrow7ada['gpoProducto']==$gpoProducto){
$descuentoP=$cantidadParticular*($myrow7ada['porcentaje']*0.01);
$cantidadParticular-=$descuentoP;
$descuentoIvaP=$ivaParticulart*($myrow7ada['porcentaje']*0.01);
$ivaParticulart-=$descuentoIvaP;

$descuentoA=$cantidadAseguradora*($myrow7ada['porcentaje']*0.01);
$cantidadAseguradora-=$descuentoA;
$descuentoIvaA=$ivaAseguradorat*($myrow7ada['porcentaje']*0.01);
$ivaAseguradorat-=$descuentoIvaA;




}
//******************************************************************



//***************************************************
//Clientes que facturan a otros
$sSQL3y = "Select * From clientesGrupos WHERE entidad='".$entidad."' and seguro='".$myrow455['clientePrincipal']."' and gpoProducto='".$gpoProducto."'";
$result3y=mysql_db_query($basedatos,$sSQL3y);
$myrow3y = mysql_fetch_array($result3y);

if($myrow3y['seguro']){
$seguro2=$seguro;
$seguro=$myrow3y['seguro'];
$myrow455['clientePrincipal']=$seguro;
}else{
$seguro2=NULL;
}

//***************************************************



if($seguro){
$sSQL3113c= "Select * From clientes WHERE  entidad='".$entidad."' and numCliente='".$seguro."'  ";
$result3113c=mysql_db_query($basedatos,$sSQL3113c);
$myrow3113c = mysql_fetch_array($result3113c);


if($myrow3113c['pagoEfectivo']=='si'){
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$ivaParticular=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);
}
}



//****************************

$pi= $porcentajeIVA-> porcentajeIVA($entidad,$cantidad[$i],$codigo[$i],$precioVenta,$basedatos);
if($cantidadParticular>0){
$pp= $cantidadParticular/($cantidadParticular+$cantidadAseguradora);
}

if($cantidadAseguradora>0){
$pa= $cantidadAseguradora/($cantidadParticular+$cantidadAseguradora); 
}

if($ivaParticulart>0){
$pip= $ivaParticulart/($ivaParticulart+$ivaAseguradorat);
}

if($ivaAseguradorat>0){
$pia= $ivaAseguradorat/($ivaParticulart+$ivaAseguradorat); 
}

//***************************



//*****************DATOS ACTA DE NACIMIENTO
$sSQLfi = "Select * From OC WHERE entidad='".$entidad."' and keyPA='".$keyPA."'   ";
$resultfi=mysql_db_query($basedatos,$sSQLfi);
$myrowfi = mysql_fetch_array($resultfi);






$aIngreso=new almacenesIngreso();
if( $aIngreso->almacenIngreso($gpoProducto,$entidad,$basedatos)=='almacenSolicitante'){
$almacenIngreso=$almacenSolicitante;
}else if($aIngreso->almacenIngreso($gpoProducto,$entidad,$basedatos)=='almacenDestino'){
$almacenIngreso=$almacen;
}

//****************
$sSQL6ab="SELECT almacenPadre,descripcion
FROM
almacenes
WHERE

entidad='".$entidad."' 
and
almacen='".$almacenIngreso."'
  ";
  $result6ab=mysql_db_query($basedatos,$sSQL6ab);
  $myrow6ab = mysql_fetch_array($result6ab);
  $almacenIngreso=$myrow6ab['almacenPadre'];
//****************



//*****************************cargo clientePrincipal
$sSQLbeni= "Select * from porcentajeBeneficencias where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."' 
    and
    departamento='".$_GET['almacen']."'
        and
        (gpoProducto='*' or gpoProducto='".$gpoProducto."' )
            and
            status='standby'
order by keyPB DESC    
";
$resultbeni=mysql_db_query($basedatos,$sSQLbeni);
$myrowbeni = mysql_fetch_array($resultbeni);
//****************************************************************  
  
  
//BENEFICENCIAS AQUI EN TRA EL PORCENTAJE DE AYUDA
if($myrow3115['beneficencia']=='si' and !$myrow455['clientePrincipal']){ 

                $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' ";
                $result10a=mysql_db_query($basedatos,$sSQL10a);
                $myrow10a = mysql_fetch_array($result10a);
$P=100-$myrow10a['porcentaje'];


if($myrow10a['numeroE']!=NULL){ 

$cantidadParticularOriginal=$cantidadParticular;

$ivaOriginalParticular=$ivaParticulart;

$descuentoP=$cantidadParticular*($P*0.01);

$cantidadParticular=$descuentoP;

$descuentoIvaP=$ivaParticulart*($P*0.01);

$ivaParticulart=$descuentoIvaP;

$cantidadAseguradora=$cantidadParticularOriginal-$cantidadParticular;

$ivaAseguradorat=$ivaOriginalParticular-$descuentoIvaP;
}

} elseif($myrowbeni['numeroE']!=NULL){

$cantidadBeneficencia=$cantidadParticular*($myrowbeni['porcentaje']*0.01);
$cantidadParticular=$cantidadParticular-$cantidadBeneficencia;
$ivaBeneficenciat= $ivaParticularT*($myrowbeni['porcentaje']*0.01);
$ivaBeneficenciaT=$ivaParticuarT-$ivaBeneficenciat;

}
//CIERRO BENEFICENCIAS







//******************************************************
$diaNumerico=date("d");
$year=date("Y");
$mes=date("m");
//******************************************************



//****************

$sSQL6abc="SELECT medico,descripcion,id_medico,stock
FROM
almacenes
WHERE

entidad='".$entidad."'
and
almacen='".$almacen."'
  ";
  $result6abc=mysql_db_query($basedatos,$sSQL6abc);
  $myrow6abc = mysql_fetch_array($result6abc);

$medico=$myrow6abc['id_medico'];
  $descripcionMedico=$myrow6abc['descripcion'];

//****************
//
//
//
//





























$agrega1 = "INSERT INTO cargosCuentaPaciente (
numeroE,
nCuenta,
codProcedimiento,
cantidad,
usuario,
fecha1,

status,
almacen,
precioVenta,

ctaMayor,
ctoCosto,
auxiliar,

ejercicio,
seguro,iva,dia,costoHospital,hora1,existencias,um,
medico,tipoPaciente,prioridad,horaSolicitud,fechaSolicitud,laboratorioReferido,
credencial,statusCargo,almacenDestino,almacenSolicitante,naturaleza,statusTraslado,tipoCliente,
statusEstudio,entidad,gpoProducto,statusFactura,keyClientesInternos,statusDevolucion,keyPA,folioVenta,
cantidadParticular,cantidadAseguradora,ivaParticular,ivaAseguradora,tipoVentaArticulos,clientePrincipal,descripcionArticulo,random,clienteFacturacion,
porcentajeIVA,
porcentajeParticular,
porcentajeAseguradora,
porcentajeIVAParticular,
porcentajeIVAAseguradora,antibiotico,precioOriginal,ivaOriginal,tipoCuenta,almacenIngreso,descripcionAlmacen,descripcionGrupoProducto,

diaNumerico,year,mes,descripcionClientePrincipal,descripcionMedico,cantidadBeneficencia,ivaBeneficencia
) values (
'".$numeroPaciente."',
'".$nCuenta."',
'".$codigo[$i]."',
'".$cantidad[$i]."',
'".$usuario."',
'".$fecha1."',

'".$status."',
'".$_POST['almacenDestino']."',
'".$cantidadParticular."'+'".$cantidadAseguradora."',

'".$ctaMayor."',
'".$centroCostoAlmacen."',
'".$aux."',

'".$ID_EJERCICIOM."',
'".$traeSeguro->traeSeguro($keyClientesInternos,$basedatos)."','".$ivaParticulart."'+'".$ivaAseguradorat."',
    '".$dia."','".$costoHospital."','".$hora1."','".$existenciasAjuste."','".$um."',
'".$medico."','interno','".$_POST['prioridad']."',
'".$hora1."','".$fecha1."','".$laboratorioReferido[$i]."','".$credencial."',
'standbyR','".$almacen."','".$almacenSolicitante."','C','standby','".$tipoCliente."','standby',
    '".$entidad."','".trim($gpoProducto)."','standby','".$keyClientesInternos."','no','".$keyPA."','".$myrow3115['folioVenta']."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$ivaParticulart."','".$ivaAseguradorat."',
'".$formaVenta."','".trim($myrow455['clientePrincipal'])."',

'".$descripcion->descripcionArticulo($entidad,$keyCAP,$numeroE,$nCuenta,$codigo[$i],$basedatos)."','".$random."','".$seguro2."',
'".$pi."',
'".$pp."',
'".$pa."',
'".$pip."',
'".$pia."' ,

'".$antibiotico->mostrarAntibiotico($entidad,$codigo[$i],$basedatos)."' ,
'".$precioOriginal."',
'".$ivaOriginal."','D','".$almacenIngreso."','".$myrow6ab['descripcion']."','".$descripcionGP."',
    '".$diaNumerico."','".$year."','".$mes."',
        '".$myrow455a['nomCliente']."','".$descripcionMedico."','".$cantidadBeneficencia."','".$ivaBeneficencia."'
)";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();






//************************VERIFICACION DE STOCK*************************
 $sSQL455s= "Select stock,medicamentosSueltos from almacenes where entidad='".$entidad."' and almacen='".$almacen."' and centroDistribucion!='si'";

$result455s=mysql_db_query($basedatos,$sSQL455s);

$myrow455s = mysql_fetch_array($result455s);



if($myrow455s['stock']=='si' ){ 

    if($cantidadReal<1){
       $cantidadReal=1;
    }

$agrega1 = "INSERT INTO faltantes (

codigo,
cantidad,
usuario,
fecha1,
hora1,
almacen,
ejercicio,
dia,
status,entidad,almacenSolicitante,folioVenta,keyPA,gpoProducto,
usuarioSolicitante,naturaleza,descripcion,random,
keyClientesInternos,cantidadTotal,ventaGranel,tipoVenta
) values (

'".$codigo[$i]."',
'".$cantidad[$i]."'*'".$cantidadReal."',
'".$usuario."',
'".$fecha1."',
'".$hora1."',
'".$_POST['almacenDestino']."',
'".$ID_EJERCICIOM."',
'".$dia."',
'','".$entidad."','".$almacen."','".$myrow3115['folioVenta']."',
    '".$keyPA."','".trim($gpoProducto)."',
    '".$usuario."','C',
'".$descripcion->descripcionArticulo($entidad,$keyCAP,$numeroE,$nCuenta,$codigo[$i],$basedatos)."',
        '".$random."',' ".$keyClientesInternos." ',
            '".$cantidadTotal."','".$vg."','".$tipoVenta."'
)";
//mysql_db_query($basedatos,$agrega1);
echo mysql_error();
}


//****************saco la cuenta contable de la forma en que ingresa*****************
//insertarRegistros($agregarA[$i],$almacen,$cantidad[$i],$fecha1,$ID_EJERCICIOM,$usuario,$basedatos);
} 
}else {

$tipoMensaje='success';
$encabezado='Exito!';
$texto='Se hicieron Cargos...';
}//validacion de seguros


}

//*****************************************************CIERRO ALMA**************************************************



} //cierro buscar 

}

?>



<?php 

$sSQL311= "Select  * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$paciente=$myrow31['nombre1']." ".$myrow31['nombre2']." ".$myrow31['apellido1']." ".$myrow31['apellido2']." ".$myrow31['apellido3'];
$nuE=$myrow31['numeroE'];
if($myrow311['paciente']){
$paciente=$myrow311['paciente'];
}

?>









<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=50,height=10,scrollbars=YES") 
} 
</script>

<script language="javascript">

function enableField()
{
document.form2.insertarArticulos.disabled=false;
}

</script>


















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>


</head>

<body>

<?php 
$sSQL31= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$numeroPaciente."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>

    
    <p>
        <label>
            <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
    </label>
    </p> 
    
    
  <form id="form2" name="form2" method="post" action="" >
  <p><span  align="center">Solicitudes a Otros Departamentos</span></p>
  <table width="600" class="table-forma">
    <tr>
      <th colspan="7"  ><p align="center" >Paciente: <?php echo $paciente; ?></p></th>
    </tr>
    <tr>
      <td width="39" height="24" >&nbsp;</td>
      <td colspan="3"  >Seguro: <span ><?php $company=$myrow311['seguro'];
$sSQL31a= "Select nomCliente From clientes WHERE entidad='".$entidad."' AND numCliente = '".$myrow311['seguro']."' ";
$result31a=mysql_db_query($basedatos,$sSQL31a);
$myrow31a = mysql_fetch_array($result31a);
		if ($myrow31a['nomCliente']!='') {
		echo  $myrow31a['nomCliente'];
        } else {
			echo 'PARTICULAR';
		}
        ?></span>
      </td>
      <td colspan="2"  >Cuarto: <span ><?php echo $myrow311['cuarto']; ?></span></td>
      <td width="58" >&nbsp;</td>
    </tr>
    <tr >
      <th colspan="7" ><p align="center">ALMACEN A SOLICITAR</p></th>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td  >Almac&eacute;n</td>
      <td colspan="5"  >Mini Almacen</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
     
      
      
      <td ><?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenAAV($entidad,'select',$almacenSolicitante,$almacenDestino,$basedatos);
?></td>
     
      
      
      
      
      <td colspan="5" ><?php 
$comboAlmacen1=new comboAlmacen();
if(!$almacenDestino){
$almacenDestino=$almacenSolicitante;
}
$comboAlmacen1->despliegaMiniAlmacen($entidad,'select',$almacenDestino,$almacenDestino,$basedatos);
?></td>
      
      
      
    </tr>
    <tr>
      <td height="31" >&nbsp;</td>
      <td colspan="2"  >Mostrar Todo (*)
      <input name="todo" type="checkbox" id="todo" value="todo" /></td>
      <td colspan="4"  >Prioridad: 
        <select name="prioridad"  id="select">
          <option
			 <?php if($_POST['prioridad']=='baja'){ ?>
			 selected="selected"
			 <?php } ?>
			 value="baja">baja</option>
          <option
			 <?php if($_POST['prioridad']=='alta'){ ?>
			 selected="selected"
			 <?php } ?>
			 value="alta">alta</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="7"   align="center">ARTICULO A SOLICITAR</td>
    </tr>
    <tr>
      <td colspan="7"  align="center"><input name="nomArticulo" type="text"  id="nomArticulo" size="60" value="<?php if($_POST['nomArticulo']) //echo $_POST['nomArticulo']; ?>" autocomplete="off"/></td>
    </tr>
    <tr>
      <td height="38" colspan="7" align="center" ><input name="buscar" type="submit"  id="buscar" value="Buscar" /></td>
    </tr>
    <tr>
      <td height="25" colspan="7" align="center" ><?php echo $leyenda; ?></td>
    </tr>
    <tr>
      <td height="42" colspan="7" align="center"  valign="middle">
          <input name="insertarArticulos" type="submit"  id="insertarArticulos" value="Agregar Articulo/Servicio" /></td>
    </tr>
    
    
    
    
    
    
    <tr >
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

      <?php	


if($_POST['almacenDestino1']){
$almacen=	  $_POST['almacenDestino1'];
} else {
$almacen=$_POST['almacenDestino'];
}



//*********************NUCLEO***********************



if($_POST['todo']=='todo'){

 $sSQL= "SELECT 
articulos.codigo,articulos.gpoProducto,articulos.laboratorioReferido,articulos.ventaPieza,
existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.cajaCon,existencias.cantidadIndividual,
existencias.existencia,articulos.descripcion1,articulos.sustancia
FROM articulos,existencias
WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )
AND
articulos.activo='A'
and
articulos.codigo=existencias.codigo and
existencias.almacen='".$almacen."'
and
articulos.paquete='no'
order by articulos.descripcion ASC
";
$_POST['nomArticulo']='todo';
} else if(($_POST['buscar']) OR ($_POST['nomArticulo'] OR $_POST['cbarra'])){
$articulo=$_POST['nomArticulo'];



 $sSQL= "SELECT
articulos.codigo,articulos.gpoProducto,articulos.laboratorioReferido,articulos.keyPA,articulos.ventaPieza,
existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.cajaCon,existencias.cantidadIndividual,
existencias.existencia,articulos.descripcion1,articulos.sustancia


FROM articulos,existencias
WHERE
(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )
AND
articulos.activo='A' and

         (articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')

and
articulos.codigo=existencias.codigo and
existencias.almacen='".$almacen."'
and
articulos.paquete='no'
";

}
//****************CIERRA NUCLEO****************



if($_POST['nomArticulo'] ){

if($result=mysql_db_query($basedatos,$sSQL)){

?><td>&nbsp;</td>














<?php  
$sSQLbeni3= "Select * from porcentajeBeneficencias where entidad='".$entidad."' and numeroE='".$numeroPaciente."' 
    and
    departamento='".$_GET['almacen']."'
         and
            status='standby'
order by keyPB DESC    
";
$resultbeni3=mysql_db_query($basedatos,$sSQLbeni3);
$myrowbeni3 = mysql_fetch_array($resultbeni3);
?>




      <th width="100" >Descripcion</th>


      <th width="51"  align="right">Part</th>
      <?php if($myrowbeni3['numeroE']!=NULL){ echo '<td width="59"  align="right">Ben</td>';}?>
      <th width="59"  align="right">Aseg</th>
      <th width="78"  align="center">Cant</th>
      <th align="center" >Status</th>
    

    </tr>
<?php 

while($myrow = mysql_fetch_array($result)){ 

if(!$seguro){
$seguro= $company;
}
//*********************************INSTANCIAS

$unidadMedida=new articulosDetalles();
$statusExistencias=new articulosDetalles();
$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenioS=new validaConvenios();$tipoConvenio=new validaConvenios();
$traeConvenio=new validaConvenios();
$vConvenio=new validaConvenios();
$um=new articulosDetalles();
$traeSeguro=new verificaSeguro1();
$priceLevel=new articulosDetalles();
$verificaSaldosInternos=new verificaSeguro1();
$iva=new articulosDetalles();
$descripcion=new articulosDetalles();
$tipoVenta=new tipoVentaArticulo();
$tipoVentaIVA=new tipoVentaArticulo();
$aMS=new tipoVentaArticulo();


$ivaAseguradora=new ivaCierre();
$ivaParticular=new ivaCierre();

$ventaPieza=new tipoVentaArticulo();

//**********************************CONVENIOS


$beneficenciaT6=new articulosDetalles();
$verificaSaldos1=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();
$validaJubilados=new validaConvenios();
$porcentajeJubilados=new validaConvenios();
//*******************************CIERRA INSTANCIAS
$bandera+="1";
$i+=1;
$code1=$myrow['codigo'];
$codigo=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$keyPA=$myrow['keyPA'];


//cierro descuento

if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

//*******************************CONVENIOS*******************************
$numeroE=$numeroPaciente=$myrow311['numeroE'];
$nCuenta=$myrow311['nCuenta'];



$um=$um->um($codigo,$basedatos);  
$cantidad=1;


//$priceLevel=$convenios->validacionConvenios($precioLevel,$codigo[$i],$almacen,$gpoProducto,$traeSeguro->traeSeguro($keyClientesInternos,$basedatos),$basedatos);

$tipoConvenio=$tipoConvenio->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=$priceLevel->precioVenta($entidad,$paquete,$_POST['generico'],$cantidad,$numeroE,$_GET['keyClientesInternos'],$codigo,$almacen,$basedatos);
$precioNormal=$priceLevel;
$ivaNormal=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos); 



$benT6=$beneficenciaT6->beneficenciaT6($entidad,$paquete,$myrow['generico'],"1",$numeroPaciente,$_GET['keyClientesInternos'],$codigo[$i],$almacen,$basedatos);

if($benT6>0){
    $dB='si';
    $caso=6;
}



//*************************CONFIGURACIONES DE VENTAS*********************
//entra

$modoventa=new articulosDetalles();
$priceLevel=$modoventa->modoventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos);


$tventa=new articulosDetalles();
$tipoVenta=$tventa->tventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos);



//**********************************************************************************





//IVA
$iva=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos); 












if($company){ 



//****************************JUBILADOS***********
if($validaJubilados->validacionJubilados($_GET['numeroE'],$company,$entidad,$basedatos)=='si'){

$percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$company,$entidad,$basedatos);
$percent*=0.01;


$cantidadAseguradora=$priceLevel*$percent;
$cantidadParticular=$priceLevel-$cantidadAseguradora;
//$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;

} else { //no es jubilado y por tanto verifico si trae algun convenio













//*******************************CONVENIOS**************************************
if($tipoConvenio=='cantidad'){ 
$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$company,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora;
$priceLevel=$acumulado;
 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$priceLevel,$basedatos); 
} else if($tipoConvenio=='grupoProducto'){ 

$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$company,$basedatos);
$cantidadParticular=$cantidadAseguradora-$priceLevel;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='global'){  
$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$company,$basedatos);
$cantidadParticular=$priceLevel-$cantidadAseguradora;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='precioEspecial'){


$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$company,$basedatos);
$cantidadAseguradora=NULL;
$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);
} else { 
//no trae convenio pero si seguro

$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$iva;
}// cierro convenios
}//cierro jubilados
//*******************************************************************CIERRO CONVENIOS
} else {//solamente abre cuando trae seguro

$cantidadParticular=$priceLevel;
$ivaParticulart=$iva;
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
}



//**********************************************************************************************************

$sSQL3113cd= "Select * From gpoProductos WHERE  codigoGP='".$myrow['gpoProducto']."'  ";
$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);
$myrow3113cd = mysql_fetch_array($result3113cd);
$gpoProducto=$myrow3113cd['descripcionGP'];
$gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE  codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);





//**********************TIPO PAGO CLIENTES*******************************
if($seguro){
$sSQL3113c= "Select * From clientes WHERE  entidad='".$entidad."' and numCliente='".$seguro."'  ";
$result3113c=mysql_db_query($basedatos,$sSQL3113c);
$myrow3113c = mysql_fetch_array($result3113c);

if($myrow3113c['convenioExclusivo']=='si'){
$sSQL3113cd= "SELECT 
keyPA
FROM convenios
WHERE
keyPA='".$myrow['keyPA']."'
and
departamento='".$almacenDestinoB."'";
$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);
$myrow3113cd = mysql_fetch_array($result3113cd);

if(!$myrow3113cd['keyPA']){
$aviso='Requiere autorizacion medica!';
}

}else{
$aviso='';
}


if($myrow3113c['pagoEfectivo']=='si'){
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$ivaParticular=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);
}
}
//******************************************************************************



$informacionExistencias=new existencias();












//*****************************cargo clientePrincipal
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
//****************************************************************




//****************************DESCUENTOS AUTOMATICOS**********
$sSQL7ada= "Select * From descuentosAutomaticos where entidad='".$entidad."' and departamento='".$_GET['almacen']."' and seguro='".$myrow455['clientePrincipal']."' and
(fechaInicial>='".$fecha1."' and fechaFinal<='".$fecha1."')
and
(tipoPaciente='interno' or tipoPaciente='ambos')
";
$result7ada=mysql_db_query($basedatos,$sSQL7ada); 
$myrow7ada = mysql_fetch_array($result7ada);
echo mysql_error();

if($myrow7ada['gpoProducto']=='*' || $myrow7ada['gpoProducto']==$gpoProducto){
$descuentoP=$cantidadParticular*($myrow7ada['porcentaje']*0.01);
$cantidadParticular-=$descuentoP;
$descuentoIvaP=$ivaParticulart*($myrow7ada['porcentaje']*0.01);
$ivaParticulart-=$descuentoIvaP;

$descuentoA=$cantidadAseguradora*($myrow7ada['porcentaje']*0.01);
$cantidadAseguradora-=$descuentoA;
$descuentoIvaA=$ivaAseguradorat*($myrow7ada['porcentaje']*0.01);
$ivaAseguradorat-=$descuentoIvaA;
echo 'Descuento Activo';
}
//******************************************************************


//*****************************cargo clientePrincipal
$sSQLbeni= "Select * from porcentajeBeneficencias where entidad='".$entidad."' and numeroE='".$numeroE."' 
    and
    departamento='".$_GET['almacen']."'
        and
        (gpoProducto='*' or gpoProducto='".$gpoProducto."' )
            and
            status='standby'
order by keyPB DESC    
";
$resultbeni=mysql_db_query($basedatos,$sSQLbeni);
$myrowbeni = mysql_fetch_array($resultbeni);
//****************************************************************


//BENEFICENCIAS AQUI EN TRA EL PORCENTAJE DE AYUDA
if($myrow311['beneficencia']=='si' and !$myrow455['clientePrincipal']){

                $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$myrow311['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['almacen']."'";
                $result10a=mysql_db_query($basedatos,$sSQL10a);
                $myrow10a = mysql_fetch_array($result10a);
$P=100-$myrow10a['porcentaje'];

$cantidadParticularOriginal=$cantidadParticular;

$ivaOriginalParticular=$ivaParticulart;

$descuentoP=$cantidadParticular*($P*0.01);

$cantidadParticular=$descuentoP;

$descuentoIvaP=$ivaParticulart*($P*0.01);

$ivaParticulart=$descuentoIvaP;



$cantidadAseguradora=$cantidadParticularOriginal-$cantidadParticular;

$ivaAseguradorat=$ivaOriginalParticular-$descuentoIvaP;


}elseif($myrowbeni['numeroE']!=NULL){

$cantidadBeneficencia=$cantidadParticular*($myrowbeni['porcentaje']*0.01);
$cantidadParticular=$cantidadParticular-$cantidadBeneficencia;
$ivaBeneficenciat= $ivaParticularT*($myrowbeni['porcentaje']*0.01);
$ivaBeneficenciaT=$ivaParticuarT-$ivaBeneficenciat;

}
//CIERRO BENEFICENCIAS











?>
        

        
          <input name="codigoArt[]" type="hidden"  value="<?php  echo $myrow['codigo']; ?>" />
          <input name="codigoBeta[]" type="hidden"  value="<?php  echo $myrow['codigo']; ?>" />    
    
    
   <tr  bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'">
    
      <td colspan="2"><span >
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
                                        if($myrow3113cd['afectaExistencias']=='si' and $myrow['descripcion1']!=NULL){
                                        echo '</br>';   
                                        echo '<span >'. 'Sustancia: '.$myrow['sustancia'].'</span>';		
                                        }else if($myrow['descripcion1']!=NULL){
                                        echo '</br>';   
                                        echo '<span >'. 'Sustancia: '.$myrow['descripcion1'].'</span>';	    
                                        }
                                        ?>
        <?php 
		if( $myrow['laboratorioReferido']=='si'){
		echo '<span class="error">'.'Estudio Referido'.'</span>';
		}
		
if($gpoProducto){
echo '</br>';
		echo  '<span class="gpoProducto">'.'[ '.$gpoProducto.' ]'.'</span>';
} else {
		
			echo '<span class="error">'. 'No tiene Grupo de Producto Definido'.'</span>';
		}
		

		//if($informacionExistencias->informacionExistenciasCantidad($entidad,$codigo,$almacen,$usuario,$fecha,$basedatos)<2){ 
		//echo '<span class="error">'. '</br>'.'No hay existencia'.'</span>';
		//}
                
                echo '</br>';
                echo '<span >'. 'Precio Base: $'.number_format($precioNormal+$ivaNormal,2).'</span>';
		
                
                if($centroDistribucion!=$almacen){
                 if($myrow['cajaCon']>0){
                                        echo '</br>';   
                                        echo '<span class="informativo">'. 'Caja Con: '.$myrow['cajaCon'].' !</span>';		
                                        }
                }
                                        
                if($myrow['ventaGranel']=='si' and $myrow['cantidadSurtir']>0){
                                        echo '</br>';   
                                        echo '<span class="informativo">'. 'Venta Granel</span>';		
                                        }                                        
                
                ?>
      </span></td>

      
      
      
      
      
      




      <td  align="left"><?php 
if($cantidadParticular){ 
echo "$".number_format($cantidadParticular+$ivaParticulart,2);
} else {
echo '---';
}
?></td>


      
      
<?php if($myrowbeni3['numeroE']!=NULL){ ?>
<td  align="left"><?php 

if($cantidadBeneficencia){ 
echo "$".number_format($cantidadBeneficencia+$ivaBeneficenciat,2);
} else {
echo '---';
}
?></td>
<?php } ?>


      <td  align="left"><?php 

if($cantidadAseguradora){ 
echo "$".number_format($cantidadAseguradora+$ivaAseguradorat,2);
} else {
echo '---';
}
?></td>
     
      
      
      
      
      <td align="left"><input name="cantidad[]" type="text"  id="cantidad"  size="4" maxlength="10" class="normal"
autocomplete="off" <?php 
if(!$priceLevel ){
echo 'readonly=""';
} 
?>/></td>
      
      
      
      
      <td align="left">
<?php if( $myrow['gpoProducto']){ $errores1='No tiene grupo de producto';}
if($statusExistencias->statusExistencias($entidad,$myrow['servicio'],$almacen,$myrow['codigo'],$basedatos)=='readonly' 
and $myrow['gpoProducto']) { 
		$errores='No hay existencias en el almacen: '.$almacen; ?>
        <?php if(!$priceLevel){ ?>
        <a href="javascript:ventanaSecundaria20('/sima/cargos/ventanaErrores.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&error=<?php echo $errores; ?>&error1=<?php echo $errores1; ?>')"> <img src="/sima/imagenes/btns/checkbtn.png" width="24" height="24" border="0" alt="ERRORES" /></a>
        <?php } else { ?>
        <img src="/sima/imagenes/btns/stopbtn.png" width="22" height="22" alt="OK" />
        <?php } ?>
      <?php 
		} else {
		echo '<img src="/sima/imagenes/btns/checkbtn.png" width="22" height="22" alt="OK" />';
		}
		?></td>
      

      
      

      
      
    </tr><?php }}?>
    <tr>
      <td >&nbsp;</td>
      <td colspan="2" >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="3" >&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
  </table>

    <div align="center"></label>
  </div>
    <p align="center">
      <?php } ?>
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
</p>
</form>
    
    <div class="notice" align="center">    
<?php if($bandera){ ?>
		 <?php 
		if(is_numeric($_POST['nomArticulo'])){
		echo "";		
		}else{
		echo "Se encontraron $bandera articulos con la palabra: $articulo";
		}
		?>
		<?php } else { ?>
		<?php //echo "No se encontro el articulo"?>
		<?php } ?>
</div>
</body>
</html>


<?php 
} //cierra funcion
} //cierra clase ?>