<?php

//clase 1

class loadArticulos{

public function cargarArticulos($fechaSolicitud,$horaSolicitud,$entidad,$banderaCXC,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){







        






//**************VERIFICO QUE NO ESTE PAGADO***************

 $sSQL15= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";

$result15=mysql_db_query($basedatos,$sSQL15);

$myrow15 = mysql_fetch_array($result15);



if($myrow15['statusCortesia']=='si'){
$courtesy='si';
}else{
  $courtesy=NULL;  
}


$tipoBeneficencia=$myrow15['tipoBeneficencia'];


                $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$myrow15['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['almacen']."'";
                $result10a=mysql_db_query($basedatos,$sSQL10a);
                $myrow10a = mysql_fetch_array($result10a);



                $sSQLa2= "Select * From catalogoBD
                where
                entidad='".$entidad."'
                    and
                (departamento='".$_GET['almacen']."' or departamento='".$_POST['almacenDestino1']."')";
                $resultsa2 = mysql_query($sSQLa2);
                $rowa2 = mysql_fetch_array($resultsa2);

                
                //caso 1, el paciente trae la beneficencia del 100%
                if($myrow15['activaBeneficencia']=='si'){
                            $b=100;
                            $dB='si';
                            $ppb=100;
                            $ppbI=$ppb;
                            $ppb=$ppb*0.01;
                            $gpb='*';         
                $caso=1;
                //caso 2, el paciente trae su beneficencia configurada, pero con un grupo de producto definido
                }elseif($myrow10a['porcentaje']>0){
                $ppbI=$myrow10a['porcentaje'];
                   $dB='si';           
                 $caso=2;           
                 //caso 3,  el paciente trae su beneficencia configurada, pero para todos los grupos de producto            
                 }elseif($rowa2['porcentaje']>0 ){ 

                    
                     if($rowa2['gpoProducto']=='*'){
                            $ppb=$rowa2['porcentaje'];
                            $ppbI=$ppb;
                            $ppb=$ppb*0.01;
                            $gpb='*';
                     }
                      $dB='si';      
                  $caso=3;
                 }



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

$ventaPieza=new tipoVentaArticulo();

$beneficenciaT6=new articulosDetalles();




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

if(!$almacenPrincipal){ 
    $tipoMensaje='error';
$encabezado='ERROR!';
$texto='NO EXISTE EL ALMACEN...!';
}

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




$noma=$_POST['nomArticulo'];
$descripcionDescuentoGlobal=$_POST['descripcionDescuentoGlobal'];

$statusDescuentoGlobal=$_POST['statusDescuentoGlobal'];

$cantidad=$_POST['cantidad'];

$agregarA=$_POST['agregarA'];

$codigoBeta=$_POST['codigoBeta'];

$laboratorioReferido=$_POST['laboratorioReferido'];

$um=$_POST['um'];



for($i=0; $i<=$_POST['bandera'];$i++){ //********************FOR

$b+=1;









if(is_numeric($_POST['nomArticulo']) and $_POST['buscar']!=NULL){

 $sSQL6="SELECT codigo

FROM

articulos

WHERE



entidad='".$entidad."' 

and 

(cbarra='".$_POST['nomArticulo']."'  or descripcion like '%$noma%') ";

  $result6=mysql_db_query($basedatos,$sSQL6);

  $myrow6 = mysql_fetch_array($result6);

  $codigo[$i]=$myrow6['codigo'];

  $cantidad[$i]=1;

  $leyenda="Se Agregaron Articulos";

  if(!$myrow6['codigo'] ){

  echo '<script>';

  echo 'window.alert("No se encontro el articulo");';

  echo '</script>';

  $codigo[$i]=NULL;

  $cantidad[$i]=NULL;

$tipoMensaje='error';
$encabezado='ERROR!';
$texto='NO SE ENCONTRO EL ARTICULO...!';

  } 

  

  

  

}elseif(!$_POST['buscar']){

$leyenda="Se Agregaron Articulos";

$codigo[$i]=$codigoBeta[$i];

}





$grupoProducto=new articulosDetalles();

$gpoProducto=$grupoProducto->grupoProducto($entidad,$codigo[$i],$basedatos);

$descripcionGP=$descripcionGrupoProducto->descripcionGrupoProducto($entidad,$gpoProducto,$basedatos);

$costoHospital=costoHospital($entidad,$codigo[$i],$basedatos);

$ctaContable=centroCosto($medico,$basedatos);



$medico=devuelveMedico::regresaMedico($entidad,$codigo[$i],$basedatos);

$seguro=$traeSeguro->traeSeguro($_GET['keyClientesInternos'],$basedatos);

//$priceLevel=$convenios->validacionConvenios($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$priceLevel=new articulosDetalles();

$priceLevel=$priceLevel->precioVenta($entidad,$paquete,$_POST['generico'],$cantidad[$i],$numeroPaciente,$_GET['keyClientesInternos'],$codigo[$i],$almacen,$basedatos);

$benT6=$beneficenciaT6->beneficenciaT6($entidad,$paquete,$myrow['generico'],"1",$numeroPaciente,$_GET['keyClientesInternos'],$codigo[$i],$almacen,$basedatos);

if($benT6>0 and $myrow15['tipoBeneficencia']=='si'){
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
$sSQL29ppE= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$_GET['almacen']."' 

";
$result29ppE=mysql_db_query($basedatos,$sSQL29ppE);
$myrow29ppE = mysql_fetch_array($result29ppE);

 //SI EL ALMACEN TIENE PRECIO ESPECIAL Y PORCENTAJE AQUI ENTRA, DESPUES DE LA HORA DEFINIDA
if( $myrow29ppE['porcentajePE']>0){
$priceLevel= round($myrow29ppE['porcentajePE']*($priceLevel/100))+$priceLevel;
}





//cortesia
$iva=new articulosDetalles();
$iva=$iva->iva($entidad,$cantidad[$i],$codigo[$i],$priceLevel,$basedatos);  


if($courtesy=='si'){
    $iva=NULL;
}










//EL ALMACEN ES DE BENEFICENCIA
if($dB=='si' ){
switch ($caso) {

   case "1" : 
        
        $cantidadBeneficencia=($priceLevel*$ppb);
        $priceLevel=$priceLevel-$cantidadBeneficencia;
        $ivaBeneficencia=($iva*$ppb);
        $iva=$iva-$ivaBeneficencia;
   break;

   case "2" :
              
               $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['almacen']."'";
                $result10a=mysql_db_query($basedatos,$sSQL10a);
                $myrow10a = mysql_fetch_array($result10a);


                            $dB='si';
                            $ppb=$myrow10a['porcentaje'];
                            $ppbI=$ppb;
                            $ppb=$ppb*0.01;
                            $gpb=$myrow10a['gpoProducto'];
                            
                            if($gpb=='*' || $gpb==$gpoProducto){//todos l os grupos
                            $cantidadBeneficencia=($priceLevel*$ppb);
                            $priceLevel=$priceLevel-$cantidadBeneficencia;
                            $ivaBeneficencia=($iva*$ppb);
                            $iva=$iva-$ivaBeneficencia;
                           
                            }else{
                              $cantidadBeneficencia=NULL;  
                              $ivaBeneficencia=NULL;
                            }

   break;

   case "3" ://todos los grupos
               //TIPO A
                $sSQLa2a= "Select * From catalogoBD
                where
                entidad='".$entidad."'
                and
                departamento='".$almacen."'
                
                ";
                $resultsa2a = mysql_query($sSQLa2a);
                $rowa2a = mysql_fetch_array($resultsa2a);
                
                //TIPO B
                $sSQLa2ab= "Select * From catalogoBD
                where
                entidad='".$entidad."'
                and
                departamento='".$almacen."'
                and
                gpoProducto='".$gpoProducto."'
                ";
                $resultsa2ab = mysql_query($sSQLa2ab);
                $rowa2ab = mysql_fetch_array($resultsa2ab);
                
                
                
                
                if($rowa2a['gpoProducto']=='*'){ 
                $ppb=$rowa2a['porcentaje'];
                $ppb=$ppb*0.01;
                $cantidadBeneficencia=($priceLevel*$ppb);
                $priceLevel=$priceLevel-$cantidadBeneficencia;
                $ivaBeneficencia=($iva*$ppb);
                $iva=$iva-$ivaBeneficencia;
                }elseif($rowa2ab['gpoProducto']!=NULL){
                $ppb=$rowa2ab['porcentaje'];
                $ppb=$ppb*0.01;
                $cantidadBeneficencia=($priceLevel*$ppb);
                $priceLevel=$priceLevel-$cantidadBeneficencia;
                $ivaBeneficencia=($iva*$ppb);
                $iva=$iva-$ivaBeneficencia;
                
                }else{
                        $cantidadBeneficencia=NULL;
                        $ivaBeneficencia=NULL;
                }
                
                
   break;


   
      case "6" : 
         $TP=6;
        $cantidadBeneficencia=$benT6;
        //$priceLevel=$priceLevel-$benT6;
        $myrow3115['beneficencia']='si';
        if( $myrow29ppE['porcentajePE']>0){
        $cantidadBeneficencia= round($myrow29ppE['porcentajePE']*($cantidadBeneficencia/100))+$cantidadBeneficencia;
        }
        if($iva>0){
        //$ivaBeneficencia=($iva*$ppb);
        //$iva=$iva-$ivaBeneficencia;
        }
   break;   
   
   
   
   
   
   
    


                        default :
                        $cantidadBeneficencia=NULL;
                        $ivaBeneficencia=NULL;
   break;
}
}
//CIERRO BENEFICENCIA





















if( $cantidad[$i]>0 ){





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
$dA=FALSE;
} else if($tipoConvenio=='grupoProducto'){



$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$cantidadAseguradora-$priceLevel;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);
$dA=TRUE;
} else if($tipoConvenio=='global'){  

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$priceLevel-$cantidadAseguradora;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad[$i],$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);
$dA=TRUE;
} else if($tipoConvenio=='precioEspecial'){ 

//puede afectar el precio base

if($pagoEfectivo->pagoEfectivo($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos)=='si'){



$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadAseguradora=NULL;

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad[$i],$keyPA,$cantidadParticular,$basedatos);

$ivaAseguradorat=$iva;


$dA=FALSE;
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
$dA=TRUE;
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

















//*****************DESCUENTOS AUTOMATICOS***************

//if($usuario=='omorales')echo $myrow455['baseParticular'];



$sSQL7ada= "Select * From descuentosAutomaticos where 
    (entidad='".$entidad."' 

and departamento='".$_GET['almacen']."' and codigo='".$codigo[$i]."'
and
'".$fecha1."'>=fechaInicial and '".$fecha1."' <=fechaFinal 
    and
    gpoProducto=''
)
    OR
(entidad='".$entidad."' 

and departamento='".$_GET['almacen']."' and gpoProducto='".$gpoProducto."'
and
'".$fecha1."'>=fechaInicial and '".$fecha1."' <=fechaFinal   
) 

";

$result7ada=mysql_db_query($basedatos,$sSQL7ada); 

$myrow7ada = mysql_fetch_array($result7ada);

echo mysql_error();






if($dA==TRUE AND $myrow7ada['tipoDescuento']!=NULL){//si es TRUE pasa


if($myrow7ada['tipoDescuento']=='aseguradora'){
    if($myrow455['baseParticular']=='si'){
       $aDes=TRUE; 
    }else{
        $aDes=FALSE;
    }
}elseif($myrow7ada['tipoDescuento']=='particular'){
  if(!$seguro){
    $aDes=TRUE;
    }else{
        $aDes=FALSE;
    }
}elseif($myrow7ada['tipoDescuento']=='ambos'){
    if($myrow455['baseParticular']=='si' or !$seguro){
       $aDes=TRUE; 
    }else{
       $aDes=FALSE;
    }
}








if($aDes==TRUE AND $myrow7ada['porcentaje']>0){ 



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
$sSQL6abf="SELECT descripcion
FROM
almacenes
WHERE

entidad='".$entidad."'
and
almacen='".$almacenIngreso."'
  ";
  $result6abf=mysql_db_query($basedatos,$sSQL6abf);
  $myrow6abf = mysql_fetch_array($result6abf);

//****************



 
$sSQL6abc="SELECT medico,descripcion,id_medico
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



//BENEFICENCIAS AQUI EN TRA EL PORCENTAJE DE AYUDA
//if($myrow3115['beneficencia']=='si' and !$myrow455['clientePrincipal']){
//
//                $sSQL10a= "Select * From porcentajeBeneficencias
//                where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."'
//                and
//                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['almacen']."'";
//                $result10a=mysql_db_query($basedatos,$sSQL10a);
//                $myrow10a = mysql_fetch_array($result10a);
//                
//                
//            $sSQLa2= "Select * From almacenes
//                where  almacen='".$_GET['almacen']."'
//                
//                
//                ";
//                $resultsa2 = mysql_query($sSQLa2);
//                $rowa2 = mysql_fetch_array($resultsa2);
//                if(!$myrow10a['numeroE'] and $rowa2['beneficencia']=='si'){
//                        $dB='si';
//                 }
//                
//                
//$P=100-$myrow10a['porcentaje'];
//
//$cantidadParticularOriginal=$cantidadParticular;
//
//$ivaOriginalParticular=$ivaParticulart;
//
//$descuentoP=$cantidadParticular*($P*0.01);
//
//$cantidadParticular=$descuentoP;
//
//$descuentoIvaP=$ivaParticulart*($P*0.01);
//
//$ivaParticulart=$descuentoIvaP;
//
//
//
//$cantidadAseguradora=$cantidadParticularOriginal-$cantidadParticular;
//
//$ivaAseguradorat=$ivaOriginalParticular-$descuentoIvaP;


//}
//CIERRO BENEFICENCIAS
















//******************************************************
$diaNumerico=date("d");
$year=date("Y");
$mes=date("m");
//******************************************************








//AQUI ENTRA LA BENEFICENCIA 6
if($dB=='si'){
    switch($TP){


case "6":

    
    //entra aqui catalogo de almacenes beneficencia especial...
    $cantidadParticular.$cantidadBeneficencia;
    
    $cantidadBeneficencia=$cantidadParticular-$cantidadBeneficencia;
    $cantidadParticular=$cantidadParticular-$cantidadBeneficencia;
    
    break;



    }
}









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

descripcionClientePrincipal,descripcionMedico,primeraVez,cantidadBeneficencia,ivaBeneficencia

) values (

'".$_GET['numeroE']."',

'".$_GET['nCuenta']."',

'".$codigo[$i]."',

'".$cantidad[$i]."',

'".$usuario."',

'".$fecha1."',



'".$status."',

'".$_GET['almacen']."',

'".$cantidadParticular."'+'".$cantidadAseguradora."'+'".$cantidadBeneficencia."',



'".$ctaMayor."',

'".$centroCostoAlmacen."',

'".$aux."',

'".$ID_EJERCICIOM."',

'".$seguro."','".$ivaParticulart."'+'".$ivaAseguradorat."'+'".$ivaBeneficencia."','".$dia."',
    
'".$costoHospital."','".$hora1."','".$existenciasAjuste."','".$um."',

'".$medico."','externo','".$_POST['prioridad']."',

'".$_POST['horaSolicitud']."','".$_POST['fechaSolicitud']."','".$laboratorioReferido[$i]."','".$credencial."',

'".$statusCargo."','".$tipoCliente."','C',

'standby',

'".$_GET['almacen']."','".$almacen."','standby','standby',

'".$tipoConvenio."','".$cantidadParticular."','".$cantidadAseguradora."','".$entidad."','".$cargoAuto."',

'".trim($gpoProducto)."','standby','".$_GET['keyClientesInternos']."','no','".$myrow3115['folioVenta']."',
    
    '".trim($myrow455['clientePrincipal'])."','".$keyPA."',

'".$ivaParticulart."','".$ivaAseguradorat."','".$usuario."','".$hora1."','".$fecha1."',

    '".$descripcion->descripcionArticulo($entidad,$keyCAP,$numeroE,$nCuenta,$codigo[$i],$basedatos)."',

'".$random."','".$seguro2."',



'".$pi."',

'".$pp."',

'".$pa."',

'".$pip."',

'".$pia."',

'".$statusDescuentoGlobal[$i]."',

'".$descripcionDescuentoGlobal[$i]."',

'".$antibiotico->mostrarAntibiotico($entidad,$codigo[$i],$basedatos)."','".$precioOriginal."','".$ivaOriginal."','D','".$almacenIngreso."',

'".$myrow6abf['descripcion']."','".$descripcionGP."','".$myrow3115['beneficencia']."',

'".$diaNumerico."','".$year."','".$mes."',

'".$myrow455a['nomCliente']."','".$descripcionMedico."','".$myrow3115['primeraVez']."','".$cantidadBeneficencia."','".$ivaBeneficencia."'

)";

mysql_db_query($basedatos,$agrega1);

echo mysql_error();




//*********************************agregar faltantes**********************

















$sSQL455s= "Select stock from almacenes where entidad='".$entidad."' and almacen='".$almacen."' and centroDistribucion!='si'";

$result455s=mysql_db_query($basedatos,$sSQL455s);

$myrow455s = mysql_fetch_array($result455s);

if($myrow455s['stock']=='si'){







$agrega1 = "INSERT INTO faltantes (



codigo,

cantidad,

usuario,

fecha1,

hora1,

almacen,

ejercicio,

dia,

status,entidad,almacenSolicitante,folioVenta,keyPA,gpoProducto,naturaleza,descripcion,random,keyClientesInternos,cantidadTotal,ventaGranel,tipoVenta

) values (



'".$codigo[$i]."',

'".$cantidad[$i]."'*'".$cantidadReal."',

'".$usuario."',

'".$fecha1."',

'".$hora1."',

'".$_GET['almacen']."',

'".$ID_EJERCICIOM."',

'".$dia."',

'','".$entidad."','".$almacen."','".$myrow3115['folioVenta']."','".$keyPA."','".trim($gpoProducto)."','C',
    '".$descripcion->descripcionArticulo($entidad,$keyCAP,$numeroE,$nCuenta,$codigo[$i],$basedatos)."','".$random."','".$_GET['keyClientesInternos']."',
        '".$cantidadTotal."','".$vg."','".$tipoVenta."')";

//mysql_db_query($basedatos,$agrega1);

echo mysql_error();

}



//******************************************************************



$tipoMensaje='success';
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







</head>



<body  onLoad="document.getElementById('nomArticulo').focus();">






  
    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
    
    </br>

<br />

<form id="form2" name="form2" method="post" >

  <table width="792" class="table-forma">



    <tr >

      <th colspan="12" align="center" >Paciente <span ><?php echo $paciente; ?></span></th>

 


      
    </tr>
    

    
    
    <?php 
    if($ppbI>0){//beneficencia activada?>
        <tr >

      <td colspan="12" align="center" >
          <span >
        <?php echo 'El paciente tiene beneficencia del '.$ppbI.'%'; ?>
          </span></td>

    </tr>
    <?php }?>
    
    
    

    <tr>


<?php if($seguro!=NULL){?>
      <td colspan="4"  >Seguro<span >:  

        <?php 

	  

	  $sSQL3113= "Select nomCliente,clientePrincipal From clientes WHERE  entidad='".$entidad."' and numCliente='".$seguro."' ";

$result3113=mysql_db_query($basedatos,$sSQL3113);

$myrow3113 = mysql_fetch_array($result3113);






$sSQL311= "Select cantidad From segurosLimites WHERE  entidad='".$entidad."' and seguro='".$seguro."' ";

$result311=mysql_db_query($basedatos,$sSQL311);

$myrow311 = mysql_fetch_array($result311);



	  echo $myrow3113['nomCliente'];
          
          
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
if($myrow18['tipoConvenio']!=NULL){
    echo '<br>';
        echo 'Tipo de Convenio: '.$myrow18['tipoConvenio'];  
}
          ?>

      </span></td>
<?php }else{?>
      
      
      <td colspan="4"  >Cliente Particular<span >

      

      </span></td>
      
      
      
<?php }?>      
      
      
      
      
      
      
      
      
      <td colspan="2" align="center"  >Limite de Credito</td>

      <td colspan="2" align="center"  >Credito Disponible</td>
 <td width="4" >&nbsp;</td>

    </tr>

    <tr>
      <td width="4" >&nbsp;</td>

      <td width="4" height="28" >&nbsp;</td>
                 



  <?php if($db=='si'){     ?>
  <td width="429"  >
      El paciente es de beneficencia, paga solo el 
      <span >
      <?php echo $P=100-$myrow10a['porcentaje']; ?>%
      </span></td>
  <?php } else{?>
  <td width="429"  ><span >

      </span></td>
      <?php }?>
      
      
      
      <td width="39" colspan="5" ><span ><?php echo "$".number_format($myrow311['cantidad'],2); ?></span></td>

      <td align="center" ><span ><?php echo "$".number_format($myrow321['limiteSeguro'],2); ?></span></td>
      <td align="center" colspan="2" >&nbsp;</td>

    </tr>

    <tr>

      <td colspan="12" align="center">ALMACEN A SOLICITAR</td>

    </tr>

    <tr>


      <td colspan="2" >&nbsp;</td>

      <td colspan="2" ><span >Almacen

        

      </span></td>

      <td colspan="5" ><span >MiniAlmacen

        

          

      </span></td>
		<td colspan="3">&nbsp;</td>      

    </tr>

    <tr>
      <td colspan="2">&nbsp;</td>



      <td ><span >

        <?php require("/configuracion/componentes/comboAlmacen.php"); 



$comboAlmacen=new comboAlmacen();

$comboAlmacen->despliegaAlmacenExternos($entidad,'select',$almacenSolicitante,$almacenDestino,$basedatos);



?>

      </span></td>

      <td colspan="8"  ><?php 



$comboAlmacen1=new comboAlmacen();



if($myrow321['almacenSolicitud'] and $myrow321['tipoPaciente']=='externo'){



$almacenDestino=$myrow321['almacenSolicitud'];

} else if(!$almacenDestino){



$almacenDestino=$almacenSolicitante;

} 



$comboAlmacen1->despliegaMiniAlmacen($entidad,'select',$almacenDestino,$almacenDestino,$basedatos);



?></td>

    </tr>

    <tr >

      <td colspan="12" align="center" >ARTICULO A CARGAR</td>

    </tr>

    <tr>

      <td height="27" colspan="12" align="center" > 
          <input  name="nomArticulo" type="text"  id="nomArticulo" size="60" autocomplete="off"  />
      </td>

    </tr>

    <tr>

      <td colspan="12"  align="center">

       <input name="buscar" type="submit"  id="buscar" value="Buscar Articulo o Servicio" src="../imagenes/btns/new_busca.png" />

          <?php if($_POST['buscar']){  ?>

      

      </td>

    </tr>

    <tr >

      <td height="23" colspan="12" >
          
          <div align="center">
      ______________________________________________________
          </div>
          
      </td>

    </tr>

    <tr>

      <td height="39" colspan="12" align="center"  valign="middle">

        <input name="insertarArticulos" type="submit" id="insertarArticulos" value="Agregar Art&iacute;culos o Servicios" src="../imagenes/btns/new_agregaarticulo.png" />

        <?php } ?>

      </td>

    </tr>

    <tr >

      <td colspan="12">

                      <?php	

	

	     if($_POST['almacenDestino1']){

	  $almacenDestinoB=$_POST['almacenDestino1'];

	  } else {

	  $almacenDestinoB=$_POST['almacenDestino'];

	  }

	  $articulo=$_POST['nomArticulo'];

   $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacenDestinoB."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){
    
 $almacenDestinoB=$myrow29p['almacenExistencias'];
    
}




$unidadMedida=new articulosDetalles();















if($_POST['paquete']=="si"){

 $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion,articulos.antibiotico,

articulos.descripcion1,articulos.sustancia


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

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion,

existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.antibiotico,

articulos.descripcion1,articulos.sustancia

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )




AND



articulos.gpoProducto!=''

AND



(articulos.cbarra='".$articulo."' or articulos.descripcion LIKE '%$articulo%')

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

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion,

existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

AND

articulos.gpoProducto!=''

AND



articulos.activo='A' and

(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')

AND

articulos.codigo=existencias.codigo and

existencias.almacen='".$almacenDestinoB."'

order by articulos.descripcion ASC

";



}



}







if(!$articulo and $_POST['buscar']){ 



$sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,
articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion,

existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

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

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,
convenios.keyConvenios,convenios.keyPA as simulacion,articulos.descripcion,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

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

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,
articulos.keyPA,convenios.keyConvenios,convenios.keyPA as simulacion,articulos.descripcion,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

FROM articulos,convenios

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

and

articulos.gpoProducto!=''



AND

articulos.activo='A' and

(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')

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

  <span >

  <?php 

	

	echo $leyenda;

	?>

	</span><?php if($horaSolicitud AND $fechaSolicitud){ ?>

		

		

	    <input name="fechaSolicitud" type="hidden"   value="<?php echo $fechaSolicitud;?>"/>

<input name="horaSolicitud" type="hidden"  value="<?php echo $horaSolicitud;?>" size="10"/>

 

   <?php }  ?>

      

      

      </td>

    </tr>

    
    <?php    $sSQL29ppE= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacenSolicitante."' 

";
$result29ppE=mysql_db_query($basedatos,$sSQL29ppE);
$myrow29ppE = mysql_fetch_array($result29ppE);

if( $myrow29ppE['porcentajePE']>0){
?>
            <tr >
      <td colspan="12" align="center" >

          Precio especial del <?php echo round($myrow29ppE['porcentajePE']);?> despues de las: <?php echo round($myrow29ppE['horaPE']);?>
          <span ></span></td>
    </tr>
   <?php }?> 
    
    
    <tr >


      <th colspan="7" align="left" >DESCRIPCION</th>
      
       <?php 
       
       if($myrow29p['stock']=='si'){
       //echo '<th width="52" align="right" >Anaquel</th>';
       }
      ?>
      
      

      <?php       

$sSQL7ada1= "Select actualizaPrecios From almacenes where entidad='".$entidad."' and almacen='".$_GET['almacen']."'  ";

$result7ada1=mysql_db_query($basedatos,$sSQL7ada1); 

$myrow7ada1 = mysql_fetch_array($result7ada1);

echo mysql_error();

?>



      <th width="52" align="right" >P. Part</th>
      
      

       <th width="52" align="right" >Benef.</th>

       
       
      <th width="56" align="right" >P. Aseg</th>

      <th width="31" align="right" >Cant</th>
        

      
    </tr>



    <?php 


while($myrow = mysql_fetch_array($result)){ 

$almacen=$almacenDestino;

$bandera+="1";



$sSQL3113cd= "Select * From gpoProductos WHERE  codigoGP='".$myrow['gpoProductos']."'  ";

$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);

$myrow3113cd = mysql_fetch_array($result3113cd);



//$gpoProducto=$myrow3113cd['descripcionGP'];

$gpoProducto=$myrow['gpoProductos'];







$code1=$myrow['codigo'];

$codigo=$myrow['codigo'];

$keyPA=$myrow['keyPA'];



//*************************************CONVENIOS********************************************





$ctaMayor=$myrow12['ctaContable'];

$costoHospital=costoHospital($entidad,$code1,$basedatos);













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

$ventaPieza=new tipoVentaArticulo();

$beneficenciaT6=new articulosDetalles();




$priceLevel=$priceLevel->precioVenta($entidad,$paquete,$myrow['generico'],"1",$numeroPaciente,$_GET['keyClientesInternos'],$codigo,$almacen,$basedatos);
$precioNormal=$priceLevel;
$benT6=$beneficenciaT6->beneficenciaT6($entidad,$paquete,$myrow['generico'],"1",$numeroPaciente,$_GET['keyClientesInternos'],$codigo,$almacen,$basedatos);
if($benT6>0 and $myrow321['tipoBeneficencia']=='si'){
$dB='si';
$caso=6;
}


//*************************CONFIGURACIONES DE VENTAS*********************


//COMPROBAR EN CUENTA MAYOR
$sSQL29p3= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacenExistencias='".$almacenDestinoB."'

";
$result29p3=mysql_db_query($basedatos,$sSQL29p3);
$myrow29p3 = mysql_fetch_array($result29p3);

if($myrow29p3['almacen']!=NULL){
$almacen=$myrow29p3['almacen'];
}


//COMPROBAR EN CENTRO DE COSTO
$sSQL29p3a= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino1']."'

";
$result29p3a=mysql_db_query($basedatos,$sSQL29p3a);
$myrow29p3a = mysql_fetch_array($result29p3a);

if($myrow29p3a['almacen']!=NULL){
$almacen=$myrow29p3a['almacen'];
}


$modoventa=new articulosDetalles();
$priceLevel=$modoventa->modoventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos);
$tventa=new articulosDetalles();
$tipoVenta=$tventa->tventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos);
//**********************************************************************************


//SI EL ALMACEN TIENE PRECIO ESPECIAL Y PORCENTAJE AQUI ENTRA, DESPUES DE LA HORA DEFINIDA
if( $myrow29ppE['porcentajePE']>0){
$priceLevel= round($myrow29ppE['porcentajePE']*($priceLevel/100))+$priceLevel;
}



if($courtesy!='si'){
$iva=new articulosDetalles();
$ivaNormal=new articulosDetalles();
$iva=$iva->iva($entidad,"1",$codigo,$priceLevel,$basedatos);  
$ivaNormal=$ivaNormal->iva($entidad,"1",$codigo,$precioNormal,$basedatos); 
}


//EL ALMACEN ES DE BENEFICENCIA
if($dB=='si' ){ 
switch ($caso) {

   case "1" :    
        $cantidadBeneficencia=($priceLevel*$ppb);
        $priceLevel=$priceLevel-$cantidadBeneficencia;
        $ivaBeneficencia=($iva*$ppb);
        $iva=$iva-$ivaBeneficencia;
   break;

   case "2" : 
               
                $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$_GET['almacen']."'";
                $result10a=mysql_db_query($basedatos,$sSQL10a);
                $myrow10a = mysql_fetch_array($result10a);


                            $dB='si';
                            $ppb=$myrow10a['porcentaje'];
                            $ppbI=$ppb;
                            $ppb=$ppb*0.01;
                            $gpb=$myrow10a['gpoProducto'];
                            
                            if($gpb=='*' || $gpb==$gpoProducto){//todos l os grupos
                            $cantidadBeneficencia=($priceLevel*$ppb);
                            $priceLevel=$priceLevel-$cantidadBeneficencia;
                            $ivaBeneficencia=($iva*$ppb);
                            $iva=$iva-$ivaBeneficencia;
                           
                            }else{
                              $cantidadBeneficencia=NULL;  
                              $ivaBeneficencia=NULL;
                            }

   break;

   case "3" ://todos los grupos
				
                //TIPO A
                $sSQLa2a= "Select * From catalogoBD
                where
                entidad='".$entidad."'
                and
                departamento='".$almacen."'
                
                ";
                $resultsa2a = mysql_query($sSQLa2a);
                $rowa2a = mysql_fetch_array($resultsa2a);
                
                //TIPO B
                $sSQLa2ab= "Select * From catalogoBD
                where
                entidad='".$entidad."'
                and
                departamento='".$almacen."'
                and
                gpoProducto='".$gpoProducto."'
                ";
                $resultsa2ab = mysql_query($sSQLa2ab);
                $rowa2ab = mysql_fetch_array($resultsa2ab);
                
                
                
                
                if($rowa2a['gpoProducto']=='*'){ 
                $ppb=$rowa2a['porcentaje'];
                $ppb=$ppb*0.01;
                $cantidadBeneficencia=($priceLevel*$ppb);
                $priceLevel=$priceLevel-$cantidadBeneficencia;
                $ivaBeneficencia=($iva*$ppb);
                $iva=$iva-$ivaBeneficencia;
                }elseif($rowa2ab['gpoProducto']!=NULL){
                $ppb=$rowa2ab['porcentaje'];
                $ppb=$ppb*0.01;
                $cantidadBeneficencia=($priceLevel*$ppb);
                $priceLevel=$priceLevel-$cantidadBeneficencia;
                $ivaBeneficencia=($iva*$ppb);
                $iva=$iva-$ivaBeneficencia;
                
                }else{
                        $cantidadBeneficencia=NULL;
                        $ivaBeneficencia=NULL;
                }

                   break;
                
                
   case "6" :   
       $TP=6;
        $cantidadBeneficencia=$benT6;
        //SI EL ALMACEN TIENE PRECIO ESPECIAL Y PORCENTAJE AQUI ENTRA, DESPUES DE LA HORA DEFINIDA
if( $myrow29ppE['porcentajePE']>0){
        $cantidadBeneficencia= round($myrow29ppE['porcentajePE']*($cantidadBeneficencia/100))+$cantidadBeneficencia;
}



        if($iva>0){
        //$ivaBeneficencia=($iva*$ppb);
        //$iva=$iva-$ivaBeneficencia;
        }
   break;      
                
                
                
                
                



    


   default :
   
   break;
}
}
//CIERRO BENEFICENCIA 


















$um=new articulosDetalles();

$um=$um->um($codigo,$basedatos);  



$cargoAuto=new articulosDetalles();

$cargoAuto=$cargoAuto->cargoAuto($entidad,$codigo,$basedatos);







$informacionExistencias=new existencias();

//$existenciasAjuste=$informacionExistencias->informacionExistencias($myrow321['tipoPaciente'],$entidad,$codigo,$almacen,$usuario,$fecha1,$basedatos);



$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);













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
$dA=FALSE;
} else if($tipoConvenio=='grupoProducto'){



$cantidadAseguradora=$convenios->validacionConvenios($entidad, "1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$cantidadAseguradora-$priceLevel;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);
$dA=TRUE;
} else if($tipoConvenio=='global'){  





$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$priceLevel-$cantidadAseguradora;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

$dA=TRUE;
} else if($tipoConvenio=='precioEspecial'){





if($pagoEfectivo->pagoEfectivo($entidad,$seguro,"1",$keyPA,$almacen,$basedatos)=='si'){ 

$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

$cantidadAseguradora=NULL;

$ivaAseguradorat=NULL;


$dA=FALSE;
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
$dA=TRUE;
}





			} //termina validacion dejubiliados













} else {//trae seguro pero no convenio


	
$cantidadAseguradora=$priceLevel;

$ivaAseguradorat=$iva;

}

}else{

$cantidadParticular=$priceLevel;

$ivaParticulart=$iva;


$dA=TRUE;
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








  
//************************ANAQUEL********************
$sSQLana= "Select anaquel From existencias WHERE entidad='".$entidad."' and codigo='".$codigo."' and almacen='".$almacenDestinoB."'";

$resultana=mysql_db_query($basedatos,$sSQLana);

$myrowana = mysql_fetch_array($resultana);
//******************************************************




if($dB=='si'){
    switch($TP){


case "6":
//entra aqui catalogo de almacenes beneficencia especial...
    $cantidadParticular.$cantidadBeneficencia;
    
    $cantidadBeneficencia=$cantidadParticular-$cantidadBeneficencia;
    $cantidadParticular=$cantidadParticular-$cantidadBeneficencia;
   break;



    }
}





?>



    <tr  bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >




    



      <td colspan="7" >

      <?php 

echo $myrow['descripcion'];
                                        if($myrow3113cd['afectaExistencias']=='si' and $myrow['sustancia']!=NULL){
                                        echo '</br>';   
                                        echo '<span >'. 'Sustancia: '.$myrow['sustancia'].'</span>';		
                                        }



		    	echo '<span class="">'.$aviso.'</span>';

				

				?>

                

                

	<?php 

		if( $myrow['laboratorioReferido']=='si'){

		echo '<span class="success">'.'Estudio Referido'.'</span>';

		}

		

if($gpoProducto){

$sSQL3113cd= "Select * From gpoProductos WHERE  codigoGP='".$gpoProducto."'  ";

$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);

$myrow3113cd = mysql_fetch_array($result3113cd);

		echo  '<span class="gpoProducto">'.'[ '.$myrow3113cd['descripcionGP'].' ]'.'</span>';

} else {

		

			echo '<span class="error">'. 'No tiene Grupo de Producto Definido'.'</span>';

		}

		if( $myrow['antibiotico']=='si'){
                        echo '<br>';
		echo '<span >'.'--ANTIBIOTICO--'.'</span>';

		}

echo '<br>';
echo 'Precio: '.'$'.number_format($precioNormal+$ivaNormal,2);



		?>


        

        <input name="codigoArt[]" type="hidden"  value="<?php  echo $myrow['codigo']; ?>" />

        <input name="codigoBeta[]" type="hidden"  value="<?php  echo $myrow['codigo']; ?>" />

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









//*****************DESCUENTOS AUTOMATICOS**********

$sSQL7ada= "Select * From descuentosAutomaticos where (entidad='".$entidad."' 

and departamento='".$_GET['almacen']."' and codigo='".$codigo."' and gpoProducto=''
and
'".$fecha1."'>=fechaInicial and '".$fecha1."' <=fechaFinal
)
    OR
(entidad='".$entidad."' 

and departamento='".$_GET['almacen']."' and gpoProducto='".$gpoProducto."'
and
'".$fecha1."'>=fechaInicial and '".$fecha1."' <=fechaFinal   
)    

";

$result7ada=mysql_db_query($basedatos,$sSQL7ada); 

$myrow7ada = mysql_fetch_array($result7ada);

echo mysql_error();




//VALIDACION DE DESCUENTOS AUTOMATICOS
if($dA==TRUE AND $myrow7ada['tipoDescuento']!=NULL){//si es TRUE pasa


if($myrow7ada['tipoDescuento']=='aseguradora'){
    if($myrow455['baseParticular']=='si'){
       $aDes=TRUE; 
    }else{
        $aDes=FALSE;
    }
}elseif($myrow7ada['tipoDescuento']=='particular'){
    if(!$seguro){
    $aDes=TRUE;
    }else{
        $aDes=FALSE;
    }
    
}elseif($myrow7ada['tipoDescuento']=='ambos'){
     
    if($myrow455['baseParticular']=='si' or !$seguro){
       $aDes=TRUE; 
    }else{
       $aDes=FALSE;
    }
}




//ENTRA A DESCUENTOS AUTOMATICOS
 if($aDes==TRUE AND $myrow7ada['porcentaje']>0){ 


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
echo '<br>';

if($myrow7ada['fechaInicial']!=NULL){
echo '<div class="codigos">Valido desde: '.cambia_a_normal($myrow7ada['fechaInicial']).', hasta el: '.cambia_a_normal($myrow7ada['fechaFinal']);
}

    if($myrowana['anaquel']!=NULL){
        echo '</br>';
    echo 'Anaquel: '.$myrowana['anaquel'];}
?>

          <input name="statusDescuentoGlobal[]" type="hidden" id="statusDescuentoGlobal" value="si" />

          <input name="descripcionDescuentoGlobal[]" type="hidden" id="numPaciente2" value="<?php echo $descripcionDescuentoGlobal; ?>" />



<?php 
 }
}

//******************************************************************

?>

<?php
//BENEFICENCIAS AQUI EN TRA EL PORCENTAJE DE AYUDA
if($P>0 and !$myrow321['seguro']){


//$cantidadParticularOriginal=$cantidadParticular;
//
//
//
//
//
//$ivaOriginalParticular=$ivaParticulart;
//
//$descuentoP=$cantidadParticular*($P*0.01);
//
//$cantidadParticular=$descuentoP;
//
//$descuentoIvaP=$ivaParticulart*($P*0.01);
//
//$ivaParticulart=$descuentoIvaP;
//
//
//
//$cantidadAseguradora=$cantidadParticularOriginal-$cantidadParticular;
//
//$ivaAseguradorat=$ivaOriginalParticular-$descuentoIvaP;
//
//echo '</br>';
//
//echo $descripcionDescuentoGlobal= 'Beneficencia '. $P.'%';
}
//CIERRO BENEFICENCIAS
if($flat=='disable' OR ($cantidadParticular<0 or $cantidadBeneficencia<0 or $cantidadAseguradora<0)){
    echo '<div class="informativo">Error!</div>';
}
?>
</td>








   
     




















      <td align="right" >

<?php 

if($cantidadParticular>0){ 

echo "$".number_format($cantidadParticular+$ivaParticulart,2);

} else {

echo '---';

}

?>

      </td>









      <td align="right" >

      <?php 



if($cantidadBeneficencia>0){ 

echo "$".number_format($cantidadBeneficencia+$ivaBeneficencia,2);

} else {

echo '---';


}
?>

      

      </td>












      <td align="right" >

      <?php 



if($cantidadAseguradora>0){ 

echo "$".number_format($cantidadAseguradora+$ivaAseguradorat,2);

} else {

echo '---';

}

?>

      

      </td>














     
      
      
      
      
      
      <td align="right">

      <input  name="cantidad[]" type="text" id="cantidad"   size="3" 

<?php 

if($flat=='disable' OR ($cantidadParticular<0 or $cantidadBeneficencia<0 or $cantidadAseguradora<0)){

echo 'readonly=""';





}else{

if(!$gpoProducto or !$precioNormal){

echo 'readonly=""'; 

} else {

$statusExistencias=new articulosDetalles();

//echo $statusExistencias->statusExistencias($entidad,$unidadMedida->unidadMedida($codigo,$basedatos),$almacen,$codigo,$basedatos);

}

}

?> autocomplete="off" />

      </td>

      
      
      
  

      
      
      
      
      
      
   

    </tr>

    <?php } //cierra while?>




  </table>

 



<?php }} ?>





        <div class="notice" align="center">

		<?php if($bandera){ ?>

		 <?php 

		if(is_numeric($_POST['nomArticulo'])){

		echo "";		

		}else{
                if($articulo!=NULL){
		echo "Se encontraron $bandera registros con la palabra: $articulo...";
                }else{
                echo "Se encontraron $bandera registros...";    
                }
		}

		?>

		<?php } else { ?>

		<?php //echo "No se encontro el articulo"?>

		<?php } ?>

&nbsp;</div>



        <div align="center">

          <input name="cbflag" type="hidden" id="numPaciente2" value="<?php echo $a; ?>" />  
            
          <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />

          <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />

          <input name="alis" type="hidden" id="nombreDelPaciente2" value="<?php echo $almacen; ?>" />

          <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />

          <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />

          <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />

          

        </div>

</form>

  <p></p>

  <br>
  <br>

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
