<?php

//clase 1

class loadArticulos{

public function cargarArticulos($fechaSolicitud,$horaSolicitud,$entidad,$banderaCXC,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){















//**************VERIFICO QUE NO ESTE PAGADO***************

$sSQL15= "Select statusCaja,tipoPaciente From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";

$result15=mysql_db_query($basedatos,$sSQL15);

$myrow15 = mysql_fetch_array($result15);

if($myrow15['statusCaja']=='pagado' and $myrow15['tipoPaciente']=='externo'){ ?>

<script>

window.alert("Imposible seguir haciendo cargos");

window.close();

</script>

<?php 

}

//********************************************************



















//************INSTANCIAMIENTOS******************

$convenios= new validaConvenios();

$global= new validaConvenios();

$tipoConvenioS=new validaConvenios();

$traeSeguro=new verificaSeguro1();

$verificaSaldos1=new verificaSeguro1();

$verificaSaldosInternos=new verificaSeguro1();

$validaJubilados=new validaConvenios();

$porcentajeJubilados=new validaConvenios();

$ivaAseguradora=new ivaCierre();

$ivaParticular=new ivaCierre();

$pagoEfectivo=new ivaCierre();

$descripcion=new articulosDetalles();

$random=rand(10000,10000000000000);

$porcentajeIVA=new articulosDetalles();

$descripcionGrupoProducto=new articulosDetalles();

//***********ALMACEN PRINCIPAL***************/

 $sSQL6="SELECT almacen

FROM

almacenes

WHERE

entidad='".$entidad."' 



and centroDistribucion='si'";

  $result6=mysql_db_query($basedatos,$sSQL6);

  $myrow6 = mysql_fetch_array($result6);

  

$almacenPrincipal=$myrow6['almacen'];//necesitamos definirlo desde el cat�logo de almacenes

if(!$almacenPrincipal){ ?>

<script>

window.alert("No existe almacen principal definido");

</script>

<?php }

?>





<script language=javascript> 

function ventanaSecundaria1 (URL){ 

   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 

} 

</script> 



<script language=javascript> 

function ventanaSecundaria5 (URL){ 

   window.open(URL,"ventana5","width=50,height=250,scrollbars=YES") 

} 

</script>

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

           

        if( vacio(F.escoje.value) == null ) {   

                alert("Por Favor, escoje como quieres agregar art�culos!")   

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

<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>



<?php 



$almacen=$_POST['almacenDestino'];

  if($_POST['almacenDestino1']){

	  $almacen=$_POST['almacenDestino1'];

	  } else {

	  $almacen=$_POST['almacenDestino'];

	  }

//$seguro=$_POST['seguro']='EC100048';

//$credencial=$_POST['credencial']='20-ovidio';

















if(!$_POST['buscar'] and $_POST['insertarArticulos'] or is_numeric($_POST['nomArticulo'])){ 

/* $filtro=verificaSeguro::verificaSaldos($dia,$fecha1,$hora1,$seguro,$credencial,$basedatos);

if($filtro!=null) */











if($_POST['insertarArticulos'] or is_numeric($_POST['nomArticulo'])){ //*************************PRESIONO INSERTAR ARTICULOS******************



$aux=traeAuxiliar::auxiliar($fecha1,$hora1,$almacen,$basedatos,$ID_EJERCICIOM,$db_conn);



$iva=new articulosDetalles();





if($_POST['cargo']){

$status="cxc";

} else {

$status="pendiente";

} 









$codigo=$_POST['codigoArt'];





if(is_numeric($_POST['nomArticulo'])){

$_POST['bandera']=0;

}





$descripcionDescuentoGlobal=$_POST['descripcionDescuentoGlobal'];

$statusDescuentoGlobal=$_POST['statusDescuentoGlobal'];

$cantidad=$_POST['cantidad'];

$agregarA=$_POST['agregarA'];

$codigoBeta=$_POST['codigoBeta'];

$laboratorioReferido=$_POST['laboratorioReferido'];

$um=$_POST['um'];



for($i=0; $i<=$_POST['bandera'];$i++){ //********************FOR

$b+=1;









if(is_numeric($_POST['nomArticulo'])){

$sSQL6="SELECT codigo

FROM

articulos

WHERE



entidad='".$entidad."' 

and 

cbarra='".$_POST['nomArticulo']."'    ";

  $result6=mysql_db_query($basedatos,$sSQL6);

  $myrow6 = mysql_fetch_array($result6);

  $codigo[$i]=$myrow6['codigo'];

  $cantidad[$i]=1;

  $leyenda="Se Agregaron Articulos";

  if(!$myrow6['codigo']){

  echo '<script>';

  echo 'window.alert("No se encontro el articulo");';

  echo '</script>';

  $codigo[$i]=NULL;

  $cantidad[$i]=NULL;

  $leyenda="No se encontro el articulo";

  } 

  

  

  

}else{

$leyenda="Se Agregaron Articulos";

$codigo[$i]=$codigoBeta[$i];

}





$grupoProducto=new articulosDetalles();

$gpoProducto=$grupoProducto->grupoProducto($entidad,$codigo[$i],$basedatos);

$descripcionGP=$descripcionGrupoProducto->descripcionGrupoProducto($entidad,$gpoProducto,$basedatos);

$costoHospital=costoHospital($codigo[$i],$basedatos);

$ctaContable=centroCosto($medico,$basedatos);



$medico=devuelveMedico::regresaMedico($entidad,$codigo[$i],$basedatos);

$seguro=$traeSeguro->traeSeguro($_GET['keyClientesInternos'],$basedatos);

//$priceLevel=$convenios->validacionConvenios($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$priceLevel=new articulosDetalles();

$priceLevel=$priceLevel->precioVenta($paquete,$_POST['generico'],$cantidad[$i],$numeroPaciente,$_GET['keyClientesInternos'],$codigo[$i],$almacen,$basedatos);















if( $cantidad[$i] ){





$cargoAuto=new articulosDetalles();

$cargoAuto=$cargoAuto->cargoAuto($entidad,$codigo[$i],$basedatos);



$cLlave=new articulosDetalles();

$keyPA=$cLlave->codigollave($entidad,$codigo[$i],$basedatos);



$antibiotico=new articulosDetalles();









$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);







if($error!='faked' ){

$iva=new articulosDetalles();

$iva=$iva->iva($entidad,$cantidad[$i],$codigo[$i],$priceLevel,$basedatos);  



if($acumuladoGlobal>$priceLevel){

//$acumulado=$acumuladoGlobal-$priceLevel;

$acumulado=$priceLevel;

} else {



$acumulado=$priceLevel;

}







// son jubilados y trae seguro?









$precioOriginal=$priceLevel;

$ivaOriginal=$iva;













if($seguro){ 



if($tipoConvenio!='No' or $validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){







if($validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){ 



$percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos);

$percent*=0.01;





$cantidadAseguradora=$priceLevel*$percent;

$cantidadParticular=$priceLevel-$cantidadAseguradora;

//$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);



} else {

if($tipoConvenio=='cantidad'){

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo

$acumulado=$cantidadAseguradora;

$priceLevel=$acumulado;

 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$priceLevel,$basedatos); 

} else if($tipoConvenio=='grupoProducto'){



$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$cantidadAseguradora-$priceLevel;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);

} else if($tipoConvenio=='global'){  

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$priceLevel-$cantidadAseguradora;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);

} else if($tipoConvenio=='precioEspecial'){ 

//puede afectar el precio base

if($pagoEfectivo->pagoEfectivo($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos)=='si'){



$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadAseguradora=NULL;

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);

$ivaAseguradorat=$iva;



} else{



$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);

$cantidadParticular=NULL;

$ivaParticular=NULL;



}

}

}









} else { 

$cantidadParticular=NULL;

$ivaParticulart=NULL;

$cantidadAseguradora=$priceLevel;

$ivaAseguradorat=$iva;

}

} else{

$cantidadParticular=$priceLevel;

$ivaParticulart=$iva;

$cantidadAseguradora=NULL;

$ivaAseguradorat=NULL;

}































$sSQL3115= "Select folioVenta,status,beneficencia,primeraVez From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";

$result3115=mysql_db_query($basedatos,$sSQL3115);

$myrow3115 = mysql_fetch_array($result3115);










$sSQL3115y = "Select pagoEfectivo From clientes WHERE entidad='".$entidad."' and numCliente='".$seguro."' ";

$result3115y=mysql_db_query($basedatos,$sSQL3115y);

$myrow3115y = mysql_fetch_array($result3115y);





if($myrow3115['status']=='cortesia'){ //valido si es cortes�a

$status='cortesia';

$tipoCliente='cortesia';

} else { //no es cortes�a









	if($myrow3115y['pagoEfectivo']=='si'){

	

	

	

		$status='particular';

		$statusAlta='standby';

		$tipoCliente='particular';

		

	$cantidadAseguradora=NULL;

	$ivaAseguradorat=NULL;

	$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

	$ivaParticular=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

	

	}else{ //no se paga en efectivo ese seguro

		

if($seguro){ 

	

		$status='cxc';

		$statusAlta='standby';

		$tipoCliente='aseguradora';



			

		} else {

		$status='particular';

		$statusAlta='standby';

		$tipoCliente='particular';

		}

} //termina si son cargos directos

}//termina cortes�a



$statusCargo='cargadoR';





//*****************************

//no trae ni hora ni fecha

if(!$_POST['horaSolicitud'])$_POST['horaSolicitud']=$hora1;

if(!$_POST['fechaSolicitud'])$_POST['fechaSolicitud']=$fecha1;

//*****************************cargo clientePrincipal

$sSQL455= "Select clientePrincipal,baseParticular from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";

$result455=mysql_db_query($basedatos,$sSQL455);

$myrow455 = mysql_fetch_array($result455);

$sSQL455a= "Select nomCliente from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";

$result455a=mysql_db_query($basedatos,$sSQL455a);

$myrow455a = mysql_fetch_array($result455a);

//****************************************************************



//*****************************almacenes TEMP,solo consulta externa********************

	$sSQL455z= "Select * from almacenesTemp 

where

fecha='".$fecha1."'

and

almacen='".$_GET['almacenDestino']."'

and

almacenPrincipal='".$_GET['almacen']."'

order by keyAT DESC



";

//$result455z=mysql_db_query($basedatos,$sSQL455z);

//$myrow455z = mysql_fetch_array($result455z);



  if($myrow455z['keyAT']){

	  $desc=$myrow455z['descripcion'];

	  }else{

	  $desc=$myrowj2['descripcion'];

	  }

//****************************************************************

















//****************************DESCUENTOS AUTOMATICOS**********

//if($usuario=='omorales')echo $myrow455['baseParticular'];

if(!$seguro or $myrow455['baseParticular']=='si' ){

$sSQL7ada= "Select * From descuentosAutomaticos where entidad='".$entidad."' and 

departamento='".$_GET['almacen']."' 

and

gpoProducto='".$gpoProducto."'

and

(tipoPaciente='externo' or tipoPaciente='ambos')

";

$result7ada=mysql_db_query($basedatos,$sSQL7ada); 

$myrow7ada = mysql_fetch_array($result7ada);

echo mysql_error();







if((!$seguro or $myrow455['baseParticular']=='si') and ($myrow7ada['gpoProducto']=='*' || $myrow7ada['gpoProducto']==$gpoProducto)){ 



$descuentoP=$cantidadParticular*($myrow7ada['porcentaje']*0.01);

$cantidadParticular-=$descuentoP;

$descuentoIvaP=$ivaParticulart*($myrow7ada['porcentaje']*0.01);

$ivaParticulart-=$descuentoIvaP;



$descuentoA=$cantidadAseguradora*($myrow7ada['porcentaje']*0.01);

$cantidadAseguradora-=$descuentoA;

$descuentoIvaA=$ivaAseguradorat*($myrow7ada['porcentaje']*0.01);

$ivaAseguradorat-=$descuentoIvaA;

}

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

  //****************


 
$sSQL6abc="SELECT medico,descripcion
FROM
almacenes
WHERE

entidad='".$entidad."'
and
almacen='".$almacen."'
  ";
  $result6abc=mysql_db_query($basedatos,$sSQL6abc);
  $myrow6abc = mysql_fetch_array($result6abc);

  if($myrow6abc['medico']=='si'){
  $descripcionMedico=$myrow6abc['descripcion'];
  }
//****************



//BENEFICENCIAS AQUI EN TRA EL PORCENTAJE DE AYUDA
if($myrow3115['beneficencia']=='si' and !$myrow455['clientePrincipal']){

                $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['almacen']."'";
                $result10a=mysql_db_query($basedatos,$sSQL10a);
                $myrow10a = mysql_fetch_array($result10a);
                
$P=$myrow10a['porcentaje'];

$cantidadParticularOriginal=$cantidadParticular;

$ivaOriginalParticular=$ivaParticulart;

$descuentoP=$cantidadParticular*($P*0.01);

$cantidadParticular=$descuentoP;

$descuentoIvaP=$ivaParticulart*($P*0.01);

$ivaParticulart=$descuentoIvaP;



$cantidadAseguradora=$cantidadParticularOriginal-$cantidadParticular;

$ivaAseguradorat=$ivaOriginalParticular-$descuentoIvaP;


}
//CIERRO BENEFICENCIAS




















//******************************************************
$diaNumerico=date("d");
$year=date("Y");
$mes=date("m");
//******************************************************




















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

credencial,statusCargo,tipoCliente,naturaleza,

statusTraslado,almacenSolicitante,almacenDestino,statusEstudio,statusCaja,

tipoConvenio,cantidadParticular,cantidadAseguradora,entidad,cargoAuto,gpoProducto,

statusFactura,keyClientesinternos,statusDevolucion,folioVenta,clientePrincipal,keyPA,ivaParticular,

ivaAseguradora,usuarioCargo,horaCargo,fechaCargo,descripcionArticulo,random,clienteFacturacion,

porcentajeIVA,

porcentajeParticular,

porcentajeAseguradora,

porcentajeIVAParticular,

porcentajeIVAAseguradora,statusDescuentoGlobal,descripcionDescuentoGlobal,antibiotico,

precioOriginal,ivaOriginal,tipoCuenta,almacenIngreso,descripcionAlmacen,

descripcionGrupoProducto,statusBeneficencia,

diaNumerico,year,mes,

descripcionClientePrincipal,descripcionMedico,primeraVez

) values (

'".$_GET['numeroE']."',

'".$_GET['nCuenta']."',

'".$codigo[$i]."',

'".$cantidad[$i]."',

'".$usuario."',

'".$fecha1."',



'".$status."',

'".$_GET['almacen']."',

'".$cantidadParticular."'+'".$cantidadAseguradora."',



'".$ctaMayor."',

'".$centroCostoAlmacen."',

'".$aux."',

'".$ID_EJERCICIOM."',

'".$seguro."','".$ivaParticulart."'+'".$ivaAseguradorat."','".$dia."','".$costoHospital."','".$hora1."','".$existenciasAjuste."','".$um."',

'".$medico."','externo','".$_POST['prioridad']."',

'".$_POST['horaSolicitud']."','".$_POST['fechaSolicitud']."','".$laboratorioReferido[$i]."','".$credencial."',

'".$statusCargo."','".$tipoCliente."','C',

'standby',

'".$_GET['almacen']."','".$almacen."','standby','standby',

'".$tipoConvenio."','".$cantidadParticular."','".$cantidadAseguradora."','".$entidad."','".$cargoAuto."',

'".trim($gpoProducto)."','standby','".$_GET['keyClientesInternos']."','no','".$myrow3115['folioVenta']."',
    
    '".trim($myrow455['clientePrincipal'])."','".$keyPA."',

'".$ivaParticulart."','".$ivaAseguradorat."','".$usuario."','".$hora1."','".$fecha1."',

    '".$descripcion->descripcionArticulo($keyCAP,$numeroE,$nCuenta,$codigo[$i],$basedatos)."',

'".$random."','".$seguro2."',



'".$pi."',

'".$pp."',

'".$pa."',

'".$pip."',

'".$pia."',

'".$statusDescuentoGlobal[$i]."',

'".$descripcionDescuentoGlobal[$i]."',

'".$antibiotico->mostrarAntibiotico($entidad,$codigo[$i],$basedatos)."','".$precioOriginal."','".$ivaOriginal."','D','".$almacenIngreso."',

'".$myrow6ab['descripcion']."','".$descripcionGP."','".$myrow3115['beneficencia']."',

'".$diaNumerico."','".$year."','".$mes."',

'".$myrow455a['nomCliente']."','".$descripcionMedico."','".$myrow3115['primeraVez']."'

)";

mysql_db_query($basedatos,$agrega1);

echo mysql_error();




//*********************************agregar faltantes**********************

















$sSQL455s= "Select stock from almacenes where entidad='".$entidad."' and almacen='".$almacen."' and centroDistribucion!='si'";

$result455s=mysql_db_query($basedatos,$sSQL455s);

$myrow455s = mysql_fetch_array($result455s);

if($myrow455s['stock']=='si'){


//*************VERIFICO SI ES CON CAJA*************
$sSQL29a= "SELECT cajaCon
FROM
articulos
where
entidad='".$entidad."'
and
codigo='".$codigo[$i]."'

";
$result29a=mysql_db_query($basedatos,$sSQL29a);
$myrow29a = mysql_fetch_array($result29a);

if($myrow29a['cajaCon']>1){
    $cantidadTotal=$myrow29a['cajaCon']*$cantidad[$i];
}
//*************************************************




$agrega1 = "INSERT INTO faltantes (



codigo,

cantidad,

usuario,

fecha1,

hora1,

almacen,

ejercicio,

dia,

status,entidad,almacenSolicitante,folioVenta,keyPA,gpoProducto,naturaleza,descripcion,random,keyClientesInternos,cantidadTotal

) values (



'".$codigo[$i]."',

'".$cantidad[$i]."',

'".$usuario."',

'".$fecha1."',

'".$hora1."',

'".$_GET['almacen']."',

'".$ID_EJERCICIOM."',

'".$dia."',

'','".$entidad."','".$almacen."','".$myrow3115['folioVenta']."','".$keyPA."','".trim($gpoProducto)."','C',
    '".$descripcion->descripcionArticulo($keyCAP,$numeroE,$nCuenta,$codigo[$i],$basedatos)."','".$random."','".$_GET['keyClientesInternos']."',
        '".$cantidadTotal."')";

mysql_db_query($basedatos,$agrega1);

echo mysql_error();

}



//******************************************************************



$tipoMensaje='registrosAgregados';
$encabezado='Exito!';
$texto='Se hicieron Cargos...';



$actualiza1 = "update clientesInternos 

set

status='pendiente',statusExpediente='request'

WHERE keyClientesInternos ='".$_GET['keyClientesInternos']."'

AND

status!='cortesia'

";

mysql_db_query($basedatos,$actualiza1);

echo mysql_error();

} else {//cantidad

 $leyenda[0]= "No se hicieron Cargos, favor de revisar!";

}















//****************saco la cuenta contable de la forma en que ingresa*****************

//?????   insertarRegistros($agregarA[$i],$almacen,$cantidad[$i],$fecha1,$ID_EJERCICIOM,$usuario,$basedatos);

} 

}







//*****************************************************CIERRO ALMA**************************************************





} //cierro buscar 



/* <script language="JavaScript" type="text/javascript">

javascript:ventanaSecundaria1('/sima/cargos/imprimirCargosPA.php?keyClientesInternos=<?php echo $_GET['keyClientesInternos'];?>&amp;nCuenta=<?php echo $_GET['nCuenta'];?>');



self.close();

</script> */

?>





<?php 

}











//verificaSeguro::verificaSaldos($dia,$fecha1,$hora1,$seguro,$credencial,$basedatos);

?>







<?php 

$sSQL321= "Select  * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";

$result321=mysql_db_query($basedatos,$sSQL321);

$myrow321 = mysql_fetch_array($result321); 

/* 

$sSQL31= "Select  * From clientesInternos WHERE  entidad='".$entidad."' AND numeroE = '".$numeroPaciente."' ";

$result31=mysql_db_query($basedatos,$sSQL31);

$myrow31 = mysql_fetch_array($result31);

*/

/*

$sSQL311= "Select  * From clientesInternos WHERE  entidad='".$entidad."' AND numeroE = '".$numeroPaciente."' and status='activa'";

$result311=mysql_db_query($basedatos,$sSQL311);

$myrow311 = mysql_fetch_array($result311); */



/* $paciente=$myrow31['nombre1']." ".$myrow31['nombre2']." ".$myrow31['apellido1']." ".$myrow31['apellido2']." ".$myrow31['apellido3']; */



if($myrow321['paciente']){

$paciente=$myrow321['paciente'];

}

?>







<script language=javascript> 

function ventanaSecundaria (URL){ 

   window.open(URL,"ventanaSecundaria","width=350,height=189,scrollbars=YES") 

} 

</script> 











<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<head>

<?php 

$estilo= new muestraEstilos();

$estilo->styles();

?>

<style type="text/css">

<!--

.gpoProducto {

	font-size: 10px;

	color: #0000FF;

}

.boton {
	font-family: Verdana, sans-serif;
	font-size: 12px;
	color: #03F;
	border: 1px #666666 solid;
	background-color: #f2f2f2;
	font-weight: bold;
	background-position: left;
	background-attachment: fixed;
}


-->

</style>





</head>



<body  onLoad="document.getElementById('nomArticulo').focus();">





<span class="titulos2" align="center">
    <h1>
    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?></h1></span></br>

<br />

<form id="form2" name="form2" method="post" action="" >

  <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">

    <tr>

      <td colspan="8"><img src="/sima/imagenes/bordestablas/borde1.png" width="620" height="28" /></td>

    </tr>

    <tr bgcolor="#FFFF00">

      <td colspan="8" align="center" class="negromid">Paciente: <span class="titulomedio"><?php echo $paciente; ?></span></td>

 


      
    </tr>

    <tr>

     






      <td colspan="3" bgcolor="#CCCCCC" class="negromid">Seguro<span class="normalmid">:  

        <?php 

	  

	  $sSQL3113= "Select nomCliente,clientePrincipal From clientes WHERE  entidad='".$entidad."' and numCliente='".$seguro."' ";

$result3113=mysql_db_query($basedatos,$sSQL3113);

$myrow3113 = mysql_fetch_array($result3113);





$sSQL311= "Select cantidad From segurosLimites WHERE  entidad='".$entidad."' and seguro='".$seguro."' ";

$result311=mysql_db_query($basedatos,$sSQL311);

$myrow311 = mysql_fetch_array($result311);



	  echo $myrow3113['nomCliente'];?>

      </span></td>


      <td colspan="2" align="center" bgcolor="#CCCCCC" class="negromid">Limite de Cr&eacute;dito</td>

      <td colspan="2" align="center" bgcolor="#CCCCCC" class="negromid">Cr&eacute;dito Disponible</td>

    </tr>

    <tr>

      <td height="28" bgcolor="#CCCCCC">&nbsp;</td>
                 <?php if($myrow321['beneficencia']=='si'){
                $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$myrow321['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['almacen']."'";
$result10a=mysql_db_query($basedatos,$sSQL10a);
$myrow10a = mysql_fetch_array($result10a);

     ?>
  <td width="300" bgcolor="#CCCCCC" class="negromid">El paciente es de beneficencia, paga solo el <span class="titulomedio">
     <?php echo $P=$myrow10a['porcentaje']; ?>%
      </span></td>
  <?php } ?>

      <td width="313" bgcolor="#CCCCCC">&nbsp;</td>

      <td colspan="2" bgcolor="#CCCCCC">&nbsp;</td>

      <td colspan="2" align="center" bgcolor="#CCCCCC"><span class="precionormal1"><?php echo "$".number_format($myrow311['cantidad'],2); ?></span></td>

      <td colspan="2" align="center" bgcolor="#CCCCCC"><span class="precionormal2"><?php echo "$".number_format($myrow321['limiteSeguro'],2); ?></span></td>

    </tr>

    <tr>

      <td colspan="8" bgcolor="#FFFF66" class="negromid" align="center">ALMACEN A SOLICITAR</td>

    </tr>

    <tr>

      <td bgcolor="#CCCCCC">&nbsp;</td>

      <td colspan="2" bgcolor="#CCCCCC"><span class="negromid">Almacen

        

      </span></td>

      <td colspan="5" bgcolor="#CCCCCC"><span class="negromid">MiniAlmacen

        

          

      </span></td>

    </tr>

    <tr>

      <td height="19" bgcolor="#CCCCCC">&nbsp;</td>

      <td bgcolor="#CCCCCC"><span class="normalmid">

        <?php require("/configuracion/componentes/comboAlmacen.php"); 



$comboAlmacen=new comboAlmacen();

$comboAlmacen->despliegaAlmacenAAV($entidad,'style7',$almacenSolicitante,$almacenDestino,$basedatos);



?>

      </span></td>

      <td colspan="6" bgcolor="#CCCCCC" class="normalmid"><?php 



$comboAlmacen1=new comboAlmacen();



if($myrow321['almacenSolicitud'] and $myrow321['tipoPaciente']=='externo'){



$almacenDestino=$myrow321['almacenSolicitud'];

} else if(!$almacenDestino){



$almacenDestino=$almacenSolicitante;

} 



$comboAlmacen1->despliegaMiniAlmacen($entidad,'combos',$almacenDestino,$almacenDestino,$basedatos);



?></td>

    </tr>

    <tr bgcolor="#FFFF66">

      <td colspan="8" align="center" class="negromid">ARTICULO A CARGAR</td>

    </tr>

    <tr>

      <td height="27" colspan="8" align="center" bgcolor="#CCCCCC"><input  name="nomArticulo" type="text" class="camposmid" id="nomArticulo" size="60" autocomplete="off" 

<?php   

/* echo     $sSQL3113c= "Select numCliente From clientes WHERE  entidad='".$entidad."' and numCliente='".$seguro."' and convenioExclusivo='si' ";

$result3113c=mysql_db_query($basedatos,$sSQL3113c);

$myrow3113c = mysql_fetch_array($result3113c);

if($myrow3113c['numCliente']){

//echo 'disabled=""';

} */

?> /></td>

    </tr>

    <tr>

      <td colspan="8" bgcolor="#CCCCCC" align="center">

       <input name="buscar" type="submit"  id="buscar" value="Buscar Articulo o Servicio" class="boton" src="/sima/imagenes/btns/new_busca.png" />

          <?php if($_POST['buscar']){  ?>

      

      </td>

    </tr>

    <tr bgcolor="#FFFFFF">

      <td height="23" colspan="8">&nbsp;</td>

    </tr>

    <tr>

      <td height="39" colspan="8" align="center" bgcolor="#CCCCCC" valign="middle">

        <input name="insertarArticulos" type="submit" id="insertarArticulos" value="Agregar Art&iacute;culos o Servicios" src="/sima/imagenes/btns/new_agregaarticulo.png" />

        <?php } ?>

      </td>

    </tr>

    <tr bgcolor="#FFFF00">

      <td colspan="8">

                      <?php	

	

	     if($_POST['almacenDestino1']){

	  $almacenDestinoB=$_POST['almacenDestino1'];

	  } else {

	  $almacenDestinoB=$_POST['almacenDestino'];

	  }

	  $articulo=$_POST['nomArticulo'];







$unidadMedida=new articulosDetalles();















if($_POST['paquete']=="si"){

 $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

AND



articulos.gpoProducto!=''

AND



articulos.cbarra='".$articulo."'

AND

articulos.activo='A' 

AND

articulos.codigo=existencias.codigo 

and

existencias.almacen='".$almacenDestinoB."'

and

articulos.paquete='si'

order by articulos.descripcion ASC

";  

}else {



if($articulo){



if(is_numeric($articulo)){

$sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

AND



articulos.gpoProducto!=''

AND



articulos.cbarra='".$articulo."'

AND

articulos.activo='A' 

AND

articulos.codigo=existencias.codigo 

and

existencias.almacen='".$almacenDestinoB."'

order by articulos.descripcion ASC

";  

	  } else {

 $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

AND

articulos.gpoProducto!=''

AND



articulos.activo='A' and

(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%')

AND

articulos.codigo=existencias.codigo and

existencias.almacen='".$almacenDestinoB."'

order by articulos.descripcion ASC

";



}



}







if(!$articulo and $_POST['buscar']){ 



$sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

and

existencias.almacen='".$almacenDestinoB."'

and

articulos.gpoProducto!=''

AND



articulos.activo='A' 

and

existencias.keyPA=articulos.keyPA

order by articulos.descripcion ASC



";

} 











//********************CONVENIO EXCLUSIVO************************





if(!$articulo and $myrow3113c['numCliente']){

if($myrow3113c['numCliente']){

 $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,convenios.keyConvenios,convenios.keyPA as simulacion,articulos.descripcion

FROM articulos,convenios

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

and

convenios.departamento='".$almacenDestinoB."'

and

articulos.gpoProducto!=''

AND



articulos.activo='A' 

and

convenios.keyPA=articulos.keyPA

order by articulos.descripcion ASC

group by convenios.keyPA



";

}else{

 $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,convenios.keyConvenios,convenios.keyPA as simulacion,articulos.descripcion

FROM articulos,convenios

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

and

articulos.gpoProducto!=''



AND

articulos.activo='A' and

(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%')

AND

articulos.codigo=convenios.codigo and

convenios.almacen='".$almacenDestinoB."'

group by convenios.keyPA

order by articulos.descripcion ASC

";



}

}









//**************************************************************













if($result=mysql_db_query($basedatos,$sSQL)){

$almacenDestino=$almacenDestinoB;

?>

</div>

        <p align="center"> 

  <span class="style15">

  <?php 

	

	echo $leyenda;

	?>

	</span><?php if($horaSolicitud AND $fechaSolicitud){ ?>

		

		

	    <input name="fechaSolicitud" type="hidden" class="style7"  value="<?php echo $fechaSolicitud;?>"/>

<input name="horaSolicitud" type="hidden" class="style7" value="<?php echo $horaSolicitud;?>" size="10"/>

 

   <?php }  ?>

      

      

      </td>

    </tr>

    <tr bgcolor="#FFFF00">

      <td bgcolor="#FFFF00">



      

      

      

      </td>

      <td colspan="3" align="center" class="negromid">Descripcion</td>

      <?php       

$sSQL7ada1= "Select actualizaPrecios From almacenes where entidad='".$entidad."' and almacen='".$_GET['almacen']."'  ";

$result7ada1=mysql_db_query($basedatos,$sSQL7ada1); 

$myrow7ada1 = mysql_fetch_array($result7ada1);

echo mysql_error();

?>



<?php if($myrow7ada1['actualizaPrecios']=='si') {?>

      

      <td width="75" align="right" class="negromid">V Publico</td>

      <?php } ?>

      <td width="58" align="right" class="negromid">P Part</td>

      <td width="77" align="right" class="negromid">P Aseg</td>

      <td width="77" align="center" class="negromid">Cant</td>

    </tr>



    <?php 



while($myrow = mysql_fetch_array($result)){ 

$almacen=$almacenDestino;

$bandera+="1";



$sSQL3113cd= "Select descripcionGP From gpoProductos WHERE entidad='".$entidad."' and codigoGP='".$myrow['gpoProductos']."'  ";

$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);

$myrow3113cd = mysql_fetch_array($result3113cd);



//$gpoProducto=$myrow3113cd['descripcionGP'];

$gpoProducto=$myrow['gpoProductos'];







$code1=$myrow['codigo'];

$codigo=$myrow['codigo'];

$keyPA=$myrow['keyPA'];



//*************************************CONVENIOS********************************************





$ctaMayor=$myrow12['ctaContable'];

$costoHospital=costoHospital($code1,$basedatos);













$codigoUM=$myrow12['um'];

$seguro=$traeSeguro->traeSeguro($_GET['keyClientesInternos'],$basedatos);



//**********************************CONVENIOS

$convenios= new validaConvenios();

$global= new validaConvenios();

$tipoConvenioS=new validaConvenios();

$traeSeguro=new verificaSeguro1();

$verificaSaldos1=new verificaSeguro1();

$verificaSaldosInternos=new verificaSeguro1();

$validaJubilados=new validaConvenios();

$porcentajeJubilados=new validaConvenios();

$ivaParticular=new ivaCierre();

$priceLevel=new articulosDetalles();

$priceLevel=$priceLevel->precioVenta($paquete,$myrow['generico'],"1",$numeroPaciente,$_GET['keyClientesInternos'],$codigo,$almacen,$basedatos);

$precioNormal=$priceLevel;











$um=new articulosDetalles();

$um=$um->um($codigo,$basedatos);  



$cargoAuto=new articulosDetalles();

$cargoAuto=$cargoAuto->cargoAuto($entidad,$codigo,$basedatos);







$informacionExistencias=new existencias();

$existenciasAjuste=$informacionExistencias->informacionExistencias($entidad,$codigo,$almacen,$usuario,$fecha1,$basedatos);



$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);









$iva=new articulosDetalles();

$iva=$iva->iva($entidad,"1",$codigo,$priceLevel,$basedatos);  



//***************PRECIO PUBLICO*******************/

$ventaPublico=$precioNormal+$iva;



//*************************************************/





if($acumuladoGlobal>$priceLevel){

//$acumulado=$acumuladoGlobal-$priceLevel;

$acumulado=$priceLevel;

} else {

$acumulado=$priceLevel;

}















if($seguro ){ 







if( $tipoConvenio!='No' or $validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){ 







		if($validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){ 


		  $percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos);

			$percent*=0.01;





			$cantidadAseguradora=$priceLevel*$percent;

			$cantidadParticular=$priceLevel-$cantidadAseguradora;

			



			} else { //no son jubilados





if($tipoConvenio=='cantidad'){



$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo

$acumulado=$cantidadAseguradora;

$priceLevel=$acumulado;

 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$priceLevel,$basedatos); 

} else if($tipoConvenio=='grupoProducto'){



$cantidadAseguradora=$convenios->validacionConvenios($entidad, "1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$cantidadAseguradora-$priceLevel;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

} else if($tipoConvenio=='global'){  


			


$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$priceLevel-$cantidadAseguradora;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

} else if($tipoConvenio=='precioEspecial'){





if($pagoEfectivo->pagoEfectivo($entidad,$seguro,"1",$keyPA,$almacen,$basedatos)=='si'){

$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

$cantidadAseguradora=NULL;

$ivaAseguradorat=NULL;



} else{



$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$cantidadParticular=NULL;

$ivaParticulart=NULL;



}









} else { 

$cantidadParticular=$priceLevel;

$ivaParticulart=$iva;

$cantidadAseguradora=NULL;

}





			} //termina validacion dejubiliados













} else {//trae seguro pero no convenio



$cantidadAseguradora=$priceLevel;

$ivaAseguradorat=$iva;

}

}else{

$cantidadParticular=$priceLevel;

$ivaParticulart=$iva;



}



















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







  



?>

    

    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >

      <td height="26">&nbsp;</td>

      <td colspan="3" class="negromid">

      <?php 

echo $myrow['descripcion'];

					echo '</br>';

		    	echo '<span class="">'. $aviso.'</span>';

				

				?>

                

                

	<?php 

		if( $myrow['laboratorioReferido']=='si'){

		echo '<span class="codigos">'.'Estudio Referido'.'</span>';

		}

		

if($gpoProducto){

$sSQL3113cd= "Select * From gpoProductos WHERE  entidad='".$entidad."' and codigoGP='".$gpoProducto."'  ";

$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);

$myrow3113cd = mysql_fetch_array($result3113cd);

		echo  '<span class="gpoProducto">'.'[ '.$myrow3113cd['descripcionGP'].' ]'.'</span>';

} else {

		

			echo '<span class="error">'. 'No tiene Grupo de Producto Definido'.'</span>';

		}

		

		?>

        </span><span class="codigos">

        <input name="codigoArt[]2" type="hidden" id="codigoArt[]2" value="<?php  echo $myrow['codigo']; ?>" />

        <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php  echo $myrow['codigo']; ?>" />

<?php 

$sSQL15a="

SELECT fechaFinal

FROM

convenios

WHERE

entidad='".$entidad."'

and

keyPA='".$myrow['keyPA']."'

and

numCliente='".$_GET['seguro']."'

and

fechaFinal<='".$fecha1."'

";

$result15a=mysql_db_query($basedatos,$sSQL15a);

$myrow15a = mysql_fetch_array($result15a); //valido las fechas



if($myrow15a['fechaFinal']){

$flat='disable';

echo '</br>';

echo '<blink>'.'Convenio Vencido el '.cambia_a_normal($myrow15a['fechaFinal']).''.'</blink>';

}else{

$flat=NULL;

}

























//*****************************cargo clientePrincipal

$sSQL455= "Select clientePrincipal,baseParticular from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";

$result455=mysql_db_query($basedatos,$sSQL455);

$myrow455 = mysql_fetch_array($result455);

//****************************************************************









//****************************DESCUENTOS AUTOMATICOS**********

$sSQL7ada= "Select * From descuentosAutomaticos where entidad='".$entidad."' 

and departamento='".$_GET['almacen']."' 

and

gpoProducto='".$gpoProducto."'

and (tipoPaciente='externo' or tipoPaciente='ambos') ";

$result7ada=mysql_db_query($basedatos,$sSQL7ada); 

$myrow7ada = mysql_fetch_array($result7ada);

echo mysql_error();







if((!$seguro or $myrow455['baseParticular']=='si') and ($myrow7ada['gpoProducto']=='*' || $myrow7ada['gpoProducto']==$gpoProducto)){ 



$cantidadParticularOriginal=$cantidadParticular;

$ivaOriginalParticular=$ivaParticulart;

$cantidadAseguradoraOriginal=$cantidadAseguradora;

$ivaOriginalAseguradora=$ivaAseguradorat;



$descuentoP=$cantidadParticular*($myrow7ada['porcentaje']*0.01);

$cantidadParticular-=$descuentoP;

$descuentoIvaP=$ivaParticulart*($myrow7ada['porcentaje']*0.01);

$ivaParticulart-=$descuentoIvaP;



$descuentoA=$cantidadAseguradora*($myrow7ada['porcentaje']*0.01);

$cantidadAseguradora-=$descuentoA;

$descuentoIvaA=$ivaAseguradorat*($myrow7ada['porcentaje']*0.01);

$ivaAseguradorat-=$descuentoIvaA;

echo '</br>';

echo $descripcionDescuentoGlobal= 'Descuento '. $myrow7ada['porcentaje'].'%';

?>

          <input name="statusDescuentoGlobal[]" type="hidden" id="statusDescuentoGlobal" value="si" />

          <input name="descripcionDescuentoGlobal[]" type="hidden" id="numPaciente2" value="<?php echo $descripcionDescuentoGlobal; ?>" />



<?php 

}

//******************************************************************

?>

<?php
//BENEFICENCIAS AQUI EN TRA EL PORCENTAJE DE AYUDA
if($P>0 and !$myrow321['seguro']){
$cantidadParticularOriginal=$cantidadParticular;
$ivaOriginalParticular=$ivaParticulart;

$descuentoP=$cantidadParticular*($P*0.01);

$cantidadParticular=$descuentoP;

$descuentoIvaP=$ivaParticulart*($P*0.01);

$ivaParticulart=$descuentoIvaP;



$cantidadAseguradora=$cantidadParticularOriginal-$cantidadParticular;

$ivaAseguradorat=$ivaOriginalParticular-$descuentoIvaP;

echo '</br>';

echo $descripcionDescuentoGlobal= 'Descuento '. $P.'%';
}
//CIERRO BENEFICENCIAS
?>

      

      </td><?php if($myrow7ada1['actualizaPrecios']=='si') {  ?>

      <td class="normalmid" align="right">

      <a  href="javascript:ventanaSecundaria('/sima/ADMINHOSPITALARIAS/inventarios/ventanitaCambiaPrecioFormas.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow['keyPA']; ?>')"><?php echo '$'.number_format($ventaPublico,2);?></a>



      </td>

      <?php } ?>

      <td align="right" class="precio2">

<?php 

if($cantidadParticular){ 

echo "$".number_format($cantidadParticular+$ivaParticulart,2);

} else {

echo '---';

}

?>

      </td>

      <td align="right" class="precio1">

      <?php 



if($cantidadAseguradora){ 

echo "$".number_format($cantidadAseguradora+$ivaAseguradorat,2);

} else {

echo '---';

}

?>

      

      </td>

      <td align="center">

      <input  name="cantidad[]" type="text" id="cantidad" class="camposmid" onKeyPress="return checkIt(event)" size="3" 

<?php 

if($flat=='disable'){

echo 'readonly=""';





}else{

if(!$gpoProducto or !$precioNormal){

echo 'readonly=""'; 

} else {

$statusExistencias=new articulosDetalles();

echo $statusExistencias->statusExistencias($entidad,$unidadMedida->unidadMedida($codigo,$basedatos),$almacen,$codigo,$basedatos);

}

}

?> autocomplete="off" />

      </td>

      

      <?php 

$mouseOver='onmouseover';

$mouseOut='onMouseOut';

?>

    </tr>

    <?php } //cierra while?>

    <tr>

      <td bgcolor="#FFFFFF">&nbsp;</td>

      <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>

      <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

      <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>

    </tr>

    <tr>

      <td colspan="8"><img src="/sima/imagenes/bordestablas/borde2.png" width="620" height="28" /></td>

    </tr>

  </table>

 



<div align="center" class="normal"><?php }} ?>



</div>

        <p align="center">

		<?php if($bandera){ ?>

		<span class="precredmid"> <?php 

		if(is_numeric($_POST['nomArticulo'])){

		echo "";		

		}else{

		echo "Se encontraron $bandera articulos con la palabra: $articulo";

		}

		?>

		<?php } else { ?>

		<?php //echo "No se encontro el articulo"?>

		<?php } ?>

&nbsp;</p>



        <div align="center">

          <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />

          <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />

          <input name="alis" type="hidden" id="nombreDelPaciente2" value="<?php echo $almacen; ?>" />

          <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />

          <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />

          <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />

          

        </div>

</form>

  <p></p>



</body>

</html>

<?php 









}//cierra funcion

} //cierra clase



?>







<?php 

//clase 2

class displayArticulos{

public function despliegaArticulos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){

$ventana='cambiarPrecio.php';

$UserType=new tipoUsuario();

$UserType=$UserType->tipoDeUsuario($usuario,$basedatos,$ALMACEN);

 include('/configuracion/clases/desplegarArticulosSolicitados.php');

 }} ?>