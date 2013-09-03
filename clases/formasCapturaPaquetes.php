<?php 
//clase 3
class solicitarPaquetes{
public function solicitaPaquete($entidad,$almacenSolicitante,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){
$almacenPrincipal='HALM';//necesitamos definirlo desde el cat�logo de almacenes
$paquete='si';
$random= rand(10000, 1000000);
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
                alert("Por Favor, escoje el art�culo o servicio para solicitar!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
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
$sSQL3115= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."'";
$fV=$_GET['keyClientesInternos'];
$result3115=mysql_db_query($basedatos,$sSQL3115);
$myrow3115 = mysql_fetch_array($result3115);
$numeroPaciente=$myrow3115['numeroE'];
$nCuenta=$myrow3115['nCuenta'];
$numeroE=$numeroPaciente;
$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenioS=new validaConvenios();
$traeConvenio=new validaConvenios();
$vConvenio=new validaConvenios();

$verificaSaldos1=new verificaSeguro1();
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
$almacenDestino=$_POST['almacenDestino'];
$keyEs=$_POST['keyEs'];

for($i=0; $i<=$_POST['bandera'];$i++){ //********************FOR
$b+=1;
$codigo[$i]=$codigoBeta[$i];



$grupoProducto=new articulosDetalles();
$gpoProducto=$grupoProducto->grupoProducto($entidad,$codigo[$i],$basedatos);
  
$costoHospital=costoHospital($codigo[$i],$basedatos);
$ctaContable=centroCosto($medico,$basedatos);
$centroCostoAlmacen=centroCostoAlmacen($almacen,$basedatos);
$medico=devuelveMedico::regresaMedico($entidad,$codigo[$i],$basedatos);


 $seguro=$traeSeguro->traeSeguro($_GET['keyClientesInternos'],$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($_POST['codigoPaquete'],$_POST['generico'],$cantidad[$i],$numeroE,$nCuenta,$codigo[$i],$almacen,$basedatos);





$leyenda="Se agregaron articulos";




if( $cantidad[$i] and $codigo[$i]){

$um=new articulosDetalles();
$um=$um->um($codigo[$i],$basedatos);  


$cargoAuto=new articulosDetalles();
$cargoAuto=$cargoAuto->cargoAuto($entidad,$codigo[$i],$basedatos);

$ajusteExistencias=new existencias();
$error=$ajusteExistencias->ajusteExistencias($entidad,$gpoProducto,$cantidad[$i],$codigo[$i],$almacen,$usuario,$fecha1,$error,$basedatos);

$informacionExistencias=new existencias();
$existenciasAjuste=$informacionExistencias->informacionExistencias($myrow3115['tipoPaciente'],$entidad,$codigo[$i],$almacen,$usuario,$fecha,$basedatos);

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


if($tipoConvenio=='cantidad'){
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora*$cantidad[$i];
$iva=new articulosDetalles();
$iva=$iva->iva($entidad,$cantidad[$i],$codigo[$i],$cantidadAseguradora,$basedatos);
} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$cantidadAseguradora-(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]));
} else if($tipoConvenio=='global'){
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;
} else {
$cantidadParticular=NULL;
$cantidadAseguradora=NULL;
}


if($seguro){
$status='cxc';
$statusAlta='standby';
$tipoCliente='aseguradora';
} else {
$status='particular';
$statusAlta='standby';
$tipoCliente='particular';
}

$sSQL3115= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."'";
$result3115=mysql_db_query($basedatos,$sSQL3115);
$myrow3115 = mysql_fetch_array($result3115);
echo mysql_error();









$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
echo mysql_error();






//***************************************COMPRUEBA CANTIDAD*************************************
$sSQL361a= "Select cantidad From cargosCuentaPaciente WHERE 
keyE='".$codigo[$i]."' and
folioVenta='".$_GET['keyClientesInternos']."' ";
$result361a=mysql_db_query($basedatos,$sSQL361a);
$myrow361a = mysql_fetch_array($result361a);
echo mysql_error();



if($myrow361a['cantidad']==1){

 $qaa = "
UPDATE 
cargosCuentaPaciente 
set 
statusCargo='cargado',
random='".$random."'
WHERE 
folioVenta='".$_GET['folioVenta']."'
and 
keyE='".$codigo[$i]."' 
";
mysql_db_query($basedatos,$qaa);
echo mysql_error();


} else {

  $qaa = "
UPDATE 
cargosCuentaPaciente 
set 
statusCargo='cargadoR',
cantidad=cantidad-1,
random='".$random."'
WHERE 
folioVenta='".$_GET['folioVenta']."'
and 
keyE='".$codigo[$i]."' 
";
mysql_db_query($basedatos,$qaa);
echo mysql_error();

}

//********************************************************************************

//****************SI NO HAY YA cargosCuentaPaciente CARGO STANDBY QUITO EL ALMACEN*************
$sSQL361= "Select status From cargosCuentaPaciente WHERE 
folioVenta='".$_GET['keyClientesInternos']."' 
and
statusCargo='cargadoR'
and
almacenDestino='".$_GET['almacen']."'
";
 $result361=mysql_db_query($basedatos,$sSQL361);
$myrow361 = mysql_fetch_array($result361); 
echo mysql_error();


if(!$myrow361['status']){
$qAb = "UPDATE almacenesPaquetes set 
status='cargado'
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."' 
and
id_almacen='".$_GET['almacen']."'
";
mysql_db_query($basedatos,$qAb);
echo mysql_error();
echo '<script>';
echo 'close();';
echo '</script>';
}





//********************************************






//*********************************agregar faltantes**********************
$agrega1 = "INSERT INTO faltantes (





codigo,
cantidad,
usuario,
fecha1,
hora1,
almacen,
ejercicio,
dia,
status,entidad
) values (

'".$codigoBeta[$i]."',
'".$cantidad[$i]."',
'".$usuario."',
'".$fecha1."',
'".$hora1."',
'".$almacen."',
'".$ID_EJERCICIOM."',
'".$dia."',
'sinsurtir','".$entidad."'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();


//****************saco la cuenta contable de la forma en que ingresa*****************
//insertarRegistros($agregarA[$i],$almacen,$cantidad[$i],$fecha1,$ID_EJERCICIOM,$usuario,$basedatos);














} 
}else {

$leyenda="Se hicieron cargos..";
}//validacion de seguros



} //validacion de seguros
//*****************************************************CIERRO ALMA**************************************************



} //cierro buscar 

//********************ABRO IMPRESIONES*****************
?>
<script>
//javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosPaq.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $_GET['keyClientesInternos'];?>&entidad=<?php echo $entidad;?>&usuario=<?php echo $usuario;?>&keyCAP=<?php echo $myrow333['keyCAP'];?>&random=<?php echo $random;?>&departamento=<?php echo $_GET['almacen'];?>&codigoPaquete=<?php echo $_POST['codigoPaquete'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>');
//window.opener.document.forms["form1"].submit();
</script>
<?php 
//*****************************************************
}





//verificaSeguro::verificaSaldos($dia,$fecha1,$hora1,$seguro,$credencial,$basedatos);
?>



<?php 






$sSQL311= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);


$sSQL31= "Select  * From paquetesPacientes WHERE keyClientesInternos = '".$myrow311['keyClientesInternos']."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$codePackage=$myrow31['codigoPaquete'];

$paciente=$myrow31['nombre1']." ".$myrow31['nombre2']." ".$myrow31['apellido1']." ".$myrow31['apellido2']." ".$myrow31['apellido3'];

if($myrow311['paciente']){
$paciente=$myrow311['paciente'];
}


$precioVenta=new articulosDetalles();












if($_POST['cerrar'] and $_POST['codigoPaquete']){
$q = "UPDATE paquetesPacientes set 
status='disabled',
fechaCierre='".$fecha1."',
usuarioCierre='".$usuario."',
horaCierre='".$hora1."'

WHERE 
codigoPaquete='".$_POST['codigoPaquete']."'";
mysql_db_query($basedatos,$q);
echo mysql_error(); 
echo '<script language="JavaScript" type="text/javascript">
self.close();
</script>';
}
?>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script>
function cerrarVentana(){
close();
}
</script>


<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/

function Disable(cb,but){
 var cbs=document.getElementsByName(cb.name);
 but=cbs[0].form[but]
 but.setAttribute('disabled','disabled');
 for (var zxc0=0;zxc0<cbs.length;zxc0++){
  if (cbs[zxc0].checked){
   but.removeAttribute('disabled');
   break;
  }
 }

}
/*]]>*/
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$estilos=new muestraEstilos();
$estilos-> styles();
?>


</head>

<body>


  <label></label>
  <form id="form2" name="form2" method="post" action="" >
  <table width="546" class="table-forma">

    <tr>
      <td colspan="2"  scope="col"><div align="center" >
        <table width="200">
          <tr>
            <td><div align="center">
<input name="M"  type="image"  id="M"  onclick="javascript:ventanaSecundaria6('/sima/cargos/ventanaCargaPaquetesPersonalizado.php?campoDespliega=<?php echo "despliegaArticulo"; ?>&forma=<?php echo "form2"; ?>&campo=<?php echo "codigoPaquete"; ?>&almacen=<?php echo $_POST['almacenDestino'];?>&numeroE=<?php echo $myrow311['numeroE'];?>&keyClientesInternos=<?php echo $myrow311['keyClientesInternos'];?>')" value="Cargar" />
            </div></td>
            <td><div align="center">
              <input name="close" type="image" src="/sima/imagenes/btns/close.png" id="close" value="Cerrar Ventana (x)" onClick="cerrarVentana()" />
            </div></td>
            <td><div align="center">
              <input name="mostrar" type="image"  id="mostrar2" value="Mostrar" />
            </div></td>
          </tr>
        </table>
        <p>Cargos a Pacientes con Paquetes <br />
            <br />
          </p>
        </div></td>
    </tr>

      	  <tr  >
      <td width="101" scope="col"><div align="left" >FOLIO </div></td>
      <td width="435"  scope="col"><div align="left" ><?php echo $_GET['folioVenta']; ?>
      </div></td>
    </tr>



	  <tr  >
      <td width="101" scope="col"><div align="left" >Paciente: </div></td>
      <td width="435"  scope="col"><div align="left" ><?php echo $paciente; ?>
      </div></td>
    </tr>


            	  <tr  >
      <td width="101" scope="col"><div align="left" >Recibo Caja: </div></td>
      <td width="435"  scope="col"><div align="left" ><?php echo $myrow311['numRecibo']; ?>
      </div></td>
    </tr>



    <tr>
      <td  scope="col"><div align="left" >Paquete</div></td>
      <td  scope="col"><div align="left" id="mostrar"><strong> </strong>




          <input name="codigoPaquete" type="hidden"  id="medico"  value="<?php 
			 if($_POST['codigoPaquete']){
			  echo $_POST['codigoPaquete'];
			  } else {
			  echo $myrow31['codigoPaquete'];
			  }
			  			  ?>" readonly=""/>
              <input name="despliegaArticulo" type="text"   size="60" readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaArticulo']){ echo $_POST['despliegaArticulo'];} else { echo $myrow311['codigoPaquete'];}?>"/>
          <!-- div que mostrara la lista de coincidencias -->
          <label></label>
      </div></td>
    </tr>
  </table>
  <p align="center"><span ><span >
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
    <span class="style15"><?php echo $leyenda; ?></span>  </p>
	
	
	

    <table width="733" class="table table-striped">
      <tr>
        <th width="66" height="19"  scope="col"><div align="left" >C&oacute;digo </div></th>
        <th width="39"  scope="col"><div align="left" >Cant.</div></th>
        <th width="361"  scope="col"><div align="left" >Descripci&oacute;n</div></th>
        <th width="51"  scope="col"><div align="left" >Normal</div></th>
        <th width="49"  scope="col"><div align="left" >Precio</div></th>
        <th width="45"  scope="col"><div align="left" >Iva</div></th>
      
        <th width="20"  scope="col"><div align="left" >C</div></th>
        <th width="17"  scope="col"><div align="left" >D</div></th>
        <th width="47"  scope="col"><div align="left" >Status</div></th>
      </tr>
	  

	  
      <tr>
<?php 
if(!$_GET['almacenSolicitud']){
$_GET['almacenSolicitud']=$_GET['almacenDestino'];
}



if(($_POST['mostrar'] and $_POST['despliegaArticulo']) || $myrow311['folioVenta']){


$sSQL= "Select * From articulosPaquetes WHERE 
codigoPaquete='".$codePackage."'
and
almacen='".$_GET['almacenSolicitud']."'
";




$sSQL= "Select * From cargosCuentaPaciente WHERE 
folioVenta='".$myrow311['folioVenta']."'
and
almacenSolicitante='".$_GET['almacenSolicitud']."' 
";




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

$almacen=$myrow['almacen'];
$bandera+="1";
$code1=$myrow['codProcedimiento'];
$codigo=$myrow['codProcedimiento'];
//*************************************CONVENIOS********************************************



//cierro descuento

if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;

}


$sSQL31= "Select nivel1 From articulosPrecioNivel WHERE 
entidad='".$entidad."'
and
codigo = '".$codigo."' 
and
almacen='".$_GET['almacenSolicitante']."'
";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31); 


$sSQL3145= "Select status,cantidad From articulosPaquetesPacientes WHERE 
keyE='".$myrow['keyE']."'
and
keyClientesInternos='".$myrow311['keyClientesInternos']."' 


";
$result3145=mysql_db_query($basedatos,$sSQL3145);
$myrow3145 = mysql_fetch_array($result3145); 

?>	
<input name="keyEs[]" type="hidden" id="keyEs[]" value="<?php echo $myrow['keyE']; ?>" />
	        <td height="24" bgcolor="<?php echo $color;?>" >
          <label><?php echo $myrow['codProcedimiento']; ?></label>

        
          <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
          
          <input name="almacenDestino[]" type="hidden" id="almacenDestino[]" value="<?php  echo $myrow['almacen']; ?>" />
        </td>
        <td bgcolor="<?php echo $color;?>"  align="center"><?php echo $myrow['cantidad']; ?></td>
        <td bgcolor="<?php echo $color;?>"  >
		<?php 
		
		$sSQL314= "Select almacenPadre,descripcion From almacenes WHERE almacen = '".$myrow['almacen']."'  and medico='si'";
$result314=mysql_db_query($basedatos,$sSQL314);
$myrow314 = mysql_fetch_array($result314);
if($myrow314['descripcion']){
echo $myrow314['descripcion'];
} else {
					echo $myrow['descripcionArticulo'];
		}
		?>
		<?php 
		
		if($myrow31['ventaPaquete']=='si'){
		echo "<span class='style1'>".' [Articulo Cargado]'.'</span>';
$pVC[0]+=$precioVenta->precioVenta($paquete,$_POST['generico'],$cantidad,$numeroPaciente,$nCuenta,$myrow['codigo'],$almacen,$basedatos);	
		} 
		?>
		
		
              		<?php if( $myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
		
		<?php if( $myrow3145['status']=='cargado'){echo '<span class="Estilo25">'.' [Articulo Cargado]'.'</span>';}?>
		
        </span>		<span >
        <input name="cantidad[]" type="hidden" id="cantidad[]" value="<?php  echo $myrow['cantidad']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="cargos">
          <?php 


echo "$".number_format($myrow31['nivel1'],2);

?>
        </td>
        <td bgcolor="<?php echo $color;?>" class="abonos">
          <?php 


echo "$".number_format($myrow['precioPaquete1'],2);
$pV[0]+=$myrow['precioPaquete1'];
?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" >
<?php 
echo "$".number_format($myrow['ivaPrecioPaquete1'],2);
$ivas[0]+=$myrow['ivaPrecioPaquete1'];
?>
        </span></td>
		
<?php 
$statusExistencias=new articulosDetalles();
$statusExistencias->statusExistencias($entidad,$myrow['servicio'],$almacen,$myrow['codigo'],$basedatos);
?>


        <td bgcolor="<?php echo $color;?>" ><div align="left">
          <input name="codigoBeta[]" type="checkbox"  id="cantidad"value="<?php  echo $myrow['keyE']; ?>" <?php 
		if($myrow['statusCargo']=='cargado'){ echo 'disabled=""';}?>  onclick="Disable(this,'insertarArticulos')" /> 
        </div></td>
        <td bgcolor="<?php echo $color;?>" ><?php 
		if($statusExistencias->statusExistencias($entidad,$myrow['servicio'],$almacen,$myrow['codigo'],$basedatos)=='disabled') {
		$banderaDisabled='disabled';
		echo '<img src="/sima/imagenes/pregunta.png" width="12" height="12" alt="NO HAY EXISTENCIAS" />';
		} else {
		echo '<img src="/sima/imagenes/ok.jpeg" width="12" height="12" alt="OK" />';
		}
		?></td>
        <td bgcolor="<?php echo $color;?>" >
		<label>
		<?php 
		if($myrow['statusCargo']=='cargado'){
		echo $myrow['statusCargo'];
		$incrementa+=1;
		} else {
		echo '---';
		}
		?>
		</label>		</td>
      </tr>
<input name="mostrar" type="hidden"  id="mostrar" value="<?php echo $incrementa;?>" />
<input name="desplegarArticulo" type="hidden"  id="mostrar" value="<?php echo $_POST['desplegarArticulo'];?>" />
      <?php }?>
    </table>




    
       
      
    <p align="center">
<?php if($bandera>=1 and $bandera!=$incrementa){ 

?>
      <input name="insertarArticulos" type="submit" src="/sima/imagenes/btns/addarticles.png" id="insertarArticulos" class="boton1"
	  value="Agregar Articulos" />
	  <?php }} ?>
    
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
   
   
   
   <?php 
   if($_POST['mostrar']){ ?>
    <input name="despliegaArticulo" type="hidden"   size="60" readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaArticulo']){ echo $_POST['despliegaArticulo'];} else { echo "";}?>"/>

          <input name="mostrar" type="hidden"  id="mostrar" value="&gt;" />
		 <?php }?>
  </form>

     
</body>
</html>


<?php 
} //cierra funcion
} //cierra clase ?>