<?php 
$NUMEROE=$_GET['numeroE'];
class internar {
public function internarPaciente($fecha1,$hora1,$entidad,$ALMACEN,$usuario,$NUMEROE,$basedatos){ 
if(!$almacen)$almacen=$ALMACEN=$_GET['almacen'];
require("/configuracion/clases/generaFolioVenta.php");
?>
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
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el dep�sito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el m�dico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el l�mite que desees asignar!")   
                return false   
        }   
}   
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=400,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
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
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Est� Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>

<?php




 


if($_POST['almacenDestino2'] and (is_numeric($NUMEROE) and !$_POST['S'] and !$_POST['M'] and !$_POST['C'] and $_POST['acepta'] )){
$_POST['cuarto']=trim($_POST['cuarto']);





$sSQL31= "Select  * From clientesInternos WHERE entidad='".$entidad."' AND numeroE = '".$NUMEROE."' and  tipoPaciente='interno' and statusCuenta='abierta'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$keyCI=$myrow31['keyClientesInternos'];
if(!$myrow31['numeroE'] ){
if(!$_POST['nombrePaciente']){
$_POST['nombrePaciente']=$_POST['nombrePaciente1'];
}


//***********************************IMPRIMIR FOLIO DE VENTA
//***************GENERAR FOLIO DE VENTA**********
$generaFolio=new folioVenta();
$FV=$myrow333['folioVentas']=$generaFolio-> generarFolioVenta(NULL,$usuario,"interno",$entidad,$tipoFolio,$basedatos);

//*****************************************************************




if($_POST['seguro'] or $_POST['deposito']<0){
$S='activa';
$ST='pagado';
$_POST['tipoTransaccion']="";
} else {
$S='activa';
$ST='pagado';
//$S='standby';
//$ST='pendiente';
}


//*********************PARTIDA DOBLE EN CASO DE HABER DEPOSITO Y SEGURO*************************************

if($_POST['deposito']){

$sSQL317= "Select * From catTTCaja WHERE entidad='".$entidad."' and banderaAPxI = 'si'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);	
$naturaleza=$myrow317['naturaleza'];

if($naturaleza=='Aviso'){
$naturaleza='-';
} else {
echo '<script>
window.alert("NO EXISTE EL TIPO DE TRANSACCION");
</script>';
exit();

}
}


//**********************************************************************************************************
//*****************************cargo clientePrincipal
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
//****************************************************************

$sSQL455i= "Select especialidad from medicos where entidad='".$entidad."' and numMedico='".$_POST['medico']."'";
$result455i=mysql_db_query($basedatos,$sSQL455i);
$myrow455i = mysql_fetch_array($result455i);

if($myrow455i['especialidad']){
$_POST['especialidad']=$myrow455i['especialidad'];
}



//**************************************************
//VERIFICAR SI ES DE BENEFICENCIA
                $sSQLa= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$NUMEROE."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$ALMACEN."' ";
                $resultsa = mysql_query($sSQLa);
                $rowa = mysql_fetch_array($resultsa);
                if($rowa['fecha'] and $rowa['fecha']==$fecha){
                     $beneficencia='si';
                }else{
                     $beneficencia=NULL;
                }

//*************************************************



//******************LOGS DEL PACIENTE*********************
$descripcion='Internamiento';
$as='HADM';
$ad=$_POST['almacenDestino2'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$FV."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************





$agrega2 = "INSERT INTO clientesInternos (
numeroE,medico,paciente,seguro,autoriza,credencial,fecha,hora,nCuenta,numExtensiones,
deposito,cuarto,statusCuenta,almacen,status,
tipoResponsable,limiteCredito,medicoForaneo,especialidad,dx,
nombreResponsable,apaternoResponsable,amaternoResponsable,direccionResponsable,
telefonoResponsable,ocupacionResponsable,statusDeposito,tipoTransaccion,parentescoResponsable,tipoPaciente,edad,entidad,folioVenta,clientePrincipal,beneficencia
) values (
'".$NUMEROE."',
'".$_POST['medico']."',
'".strtoupper($_POST['nombrePaciente'])."',
'".$_POST['seguro']."',
'".$usuario."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$nCuenta."',
'".$_POST['numExtensiones']."',
'".$_POST['deposito']."',


'".$_POST['cuarto']."',
'abierta',
'".$_POST['almacenDestino2']."','".$S."',
'".$_POST['tipoResponsable']."','".$_POST['limiteCredito']."','".strtoupper($_POST['medicoForaneo'])."',
'".strtoupper($_POST['especialidad'])."','".strtoupper($_POST['dx'])."','".strtoupper($_POST['nombreResponsable'])."',
'".strtoupper($_POST['apaternoResponsable'])."','".strtoupper($_POST['amaternoResponsable'])."','".strtoupper($_POST['direccionResponsable'])."',
'".$_POST['telefonoResponsable']."','".strtoupper($_POST['ocupacionResponsable'])."','".$ST."','".$_POST['tipoTransaccion']."',
'".strtoupper($_POST['parentescoResponsable'])."','interno','".$_POST['edad']."','".$entidad."','".$myrow333['folioVentas']."',
    '".$myrow455['clientePrincipal']."',
 '".$beneficencia."')";
mysql_db_query($basedatos,$agrega2);
echo mysql_error();



$sSQL9= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$myrow333['folioVentas']."' and statusCuenta='abierta'";
$result9=mysql_db_query($basedatos,$sSQL9);
$myrow9 = mysql_fetch_array($result9);

$numeroE=$myrow9['numeroE'];
$nCuenta=$myrow9['nCuenta'];


//************************************CARGO***********************************************		
if($_POST['deposito']){

$sSQL317= "Select * From catTTCaja WHERE entidad='".$entidad."' and banderaAPxI = 'si'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);	
$naturaleza=$myrow317['naturaleza'];

if($naturaleza=='Aviso'){
$naturaleza='-';
} else {
echo '<script>
window.alert("NO EXISTE EL TIPO DE TRANSACCION");
</script>';
exit();

}


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenSolicitante,almacenDestino,keyClientesInternos,statusCaja,descripcion,statusFactura,iva,horaSolicitud,fechaSolicitud,clientePrincipal,
folioVenta,codigoCaja,numRecibo,numCorte,ventasDirectas) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$myrow317['codigoTT']."','".$hora1."',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$almacen."','".$usuario."',
'".$_POST['deposito']."','".$seguro."','standby','particular','interno',
'".$cantidadParticular."','".$cantidadAseguradora."','".$entidad."','".$_POST['tipoPago']."','standby'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$_POST['almacenDestino']."','".$_POST['almacenDestino1']."','".$myrow9['keyClientesInternos']."','pagado','".$_POST['descripcion']."','standby','".$iva."','".$hora1."','".$fecha1."','".$myrow455['clientePrincipal']."','".$_POST['edadPaciente']."',
'".$myrow333['folioVentas']."','".$myrowC['keyCatC']."','".$myrowC['numRecibo']."','".$numCorte."','si')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//**************************************************************************************



$leyenda="(SE ACTIVO LA CUENTA DEL PACIENTE #".$FV.": ".$_POST['nombrePaciente']." )";

//**********************PONGO EL STATUS**************************************
$agregarBanderas=new articulosDetalles();
$agregarBanderas->agregarBanderas($ALMACEN,$fecha1,$hora1,$usuario,$myrow9['keyClientesInternos'],$entidad,$NUMEROE,$nCuenta,$basedatos);
//**************************************

?>
<script >
window.alert( "SE ACTIVO LA CUENTA DEL PACIENTE, FOLIO DE VENTA: <?php echo  "#".$FV." ".$_POST['nombrePaciente'];?> ");
window.opener.document.forms["form1"].submit();
</script>
<span >
<?php 




$q = "UPDATE cuartos set 
status='ocupado' ,
numeroE='".$NUMEROE."',
usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."'
WHERE 

codigoCuarto='".$_POST['cuarto']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}else{ 
echo 'YA ACTIVASTE LA CUENTA DEL PACIENTE';
?>
</span>
<script>
window.alert( "YA ACTIVASTE LA CUENTA DEL PACIENTE: <?php echo $_POST['nombrePaciente']." # ".$FV;?> ");
</script>
<?php 

}
}


 $sSQL32= "Select * From pacientes WHERE entidad='".$entidad."' and numCliente = '".$NUMEROE."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);

$nombrePaciente = $myrow32['nombre1']." ".$myrow32['nombre2']." ".$myrow32['apellido1']." ".
$myrow32['apellido2']." ".$myrow32['apellido3'];

if($myrow9['folioVenta']){
$ss=$myrow9['folioVenta'];
}elseif($myrow31['folioVenta']){
$ss=$myrow31['folioVenta'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>

<body>
<h1 align="center" ><span ><?php echo $leyenda; 


?></span></h1>
<form id="form1" name="form1" method="post" action="#" >
  <p><span >Paciente a Internar: </span><span ><?php echo $nombrePaciente; 


?></span></p>
<table width="641" class="table-forma" >

      <tr valign="middle" >
        <td colspan="2"><div align="center" >Datos del Dep&oacute;sito </div></td>
      </tr>
	  
	   <?php if($NUMEROE){ ?>
      <tr >
        <td width="119"  >L&iacute;mite de Cr&eacute;dito</td>
        <td width="571"  >
          <input name="limiteCredito" type="text"  id="limiteCredito" size="9" 
		value="<?php echo $_POST['limiteCredito'];?>"/>
        </span></td>
      </tr>
      <tr  >
        <td colspan="2" ><div align="center" >Dx</div></td>
      </tr>
      <tr valign="middle" >
        <td  ><div align="left"><span >
        </span></div>          <span ><label></label>
          </label>
          <label> <span >
          <div align="left" >M&eacute;dico For&aacute;neo </div>
        </label>
        </span></td>
        <td ><div align="left">
          <input name="medicoForaneo" type="text"  id="medicoForaneo"
		   value="<?php 
		  if($_POST['medicoForaneo']){
		  echo $_POST['medicoForaneo'];
		  } else if($myrow3['medicoForaneo']){
		  echo $myrow3['medicoForaneo']; 
		  }
		  ?>" size="60" />
        </div></td>
      </tr>
      <tr valign="middle" >
        <td ><div align="left" >Especialidad</div></td>
        <td ><div align="left">
          <?php 
include('/configuracion/componentes/comboEspecialidades.php');
$listaEsp=new especialidades();
$listaEsp->listaEspecialidadesMedicas($entidad,'style12',$myrow['especialidad'],$_POST['especialidad'],$basedatos);
?>
        </div></td>
      </tr>
      <tr valign="middle" >
        <td ><div align="left" >Diagn&oacute;stico Entrada </div></td>
        <td ><textarea name="dx" cols="60"  id="dx"><?php echo $_POST['dx']; ?></textarea></td>
      </tr>
      <tr valign="middle"  >
        <td colspan="2"><div align="center" >Asignaci&oacute;n de Cuarto</div></td>
      </tr>
      <tr valign="middle"  >
        <td >Departamento</td>
        <td><?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->almacenesCuartos($entidad,'style7',$almacen,$almacenDestino,$basedatos);
?></td>
      </tr>
      
      
      

      <tr  >
        <td ><label></label>
            </label>
            <label>
            <span >
            <div align="left" >M&eacute;dico de Internamiento </div>
          </label></td>
        <td ><span >
          <label>
          <div align="left">
            <input name="medico" type="hidden"  id="medico"  value="<?php echo $_POST['medico'];?>" readonly=""/>
            <a href="javascript:ventanaSecundaria2(
		'/sima/cargos/listaMedicos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>')"></a>
            <input name="despliegaMedico" type="text"  readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaMedico']){ echo $_POST['despliegaMedico'];} else { echo "";}?>"/>
          <a href="javascript:ventanaSecundaria2(
		'/sima/cargos/listaMedicos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>&almacen=<?php echo $_POST['almacenDestino2'];?>')"><img src="/sima/imagenes/Save.png" alt="M&eacute;dico de Internamiento" width="19" height="19" border="0" /></a></div>
          </label>
          <div align="left"></div>
        </span></td>
      </tr>
      <tr valign="middle"  >
        <td >Cuarto</td>
        <td>
                  
        
          <input name="descripcionCuarto" type="text"  id="descripcionCuarto" 
		value="<?php if($_POST['descripcionCuarto']){ echo $_POST['descripcionCuarto'];} else { echo "";}?>" readonly=""/>
        
        <a href="javascript:ventanaSecundaria2(
		'agregaCuarto.php?campoDespliega=<?php echo "descripcionCuarto"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoCuarto=<?php echo "cuarto"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacenInternamiento=<?php echo $_POST['almacenDestino2']; ?>')"><img src="/sima/imagenes/Save.png" alt="Cuarto" width="19" height="19" border="0" /></a>        <span >
        <input name="cuarto" type="hidden"  id="cuarto"   readonly=""
		value="<?php if($_POST['cuarto']){ echo $_POST['cuarto'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></td>
      </tr>

      
      
      
      
      
      
      
      
      <tr valign="middle"  >
        <td colspan="2"><div align="center" >Responsables</div></td>
      </tr>
      <tr valign="middle"  >
        <td >Tipo de Responsable</td>
        <td><label>
          <select name="tipoResponsable"  id="tipoResponsable" onChange="javascript:submit();">
		 <option>Escoje</option>
		    <option 
			<?php if($_POST['tipoResponsable']=='Familiar'){ ?>
			selected="selected" 
			<?php } ?>
			 value="Familiar">Familiar</option>
            <option 
			<?php if($_POST['tipoResponsable']=='Empresa'){ ?>
			selected="selected" 
			 <?php } ?>
			value="Empresa">Empresa</option>
        </select>
          <span >
          <input name="campoDespliega2" type="hidden"  id="campoDespliega2" value="<?php echo $_POST['campoDespliega2']; ?>" size="50" 
	
		   readonly=""/>
          </span></label></td>
      </tr>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <?php if($_POST['tipoResponsable']=='Familiar'){ ?>
      <tr valign="middle"  >
        <td colspan="2"><div align="center" >Datos Familiar Responsable</div></td>
      </tr>
      <tr valign="middle" >
        <td  >Parentesco </td>
        <td ><input name="parentescoResponsable" type="text"  id="parentescoResponsable" size="60" 
		value="<?php echo $_POST['parentescoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Nombre</td>
        <td ><input name="nombreResponsable" type="text"  id="nombreResponsable" size="60" 
		value="<?php echo $_POST['nombreResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Apellido Paterno</td>
        <td ><input name="apaternoResponsable" type="text"  id="apaternoResponsable" size="60" 
		value="<?php echo $_POST['apaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Apellido Materno</td>
        <td ><input name="amaternoResponsable" type="text"  id="amaternoResponsable" size="60" 
		value="<?php echo $_POST['amaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Direcci&oacute;n</td>
        <td ><textarea name="direccionResponsable" cols="50"   id="direccionResponsable"><?php echo $_POST['direccionResponsable'];?></textarea></td>
      </tr>
      <tr valign="middle" >
        <td  >Tel&eacute;fono</td>
        <td ><input name="telefonoResponsable" type="text"  id="telefonoResponsable" size="60" 
		value="<?php echo $_POST['telefonoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Ocupaci&oacute;n</td>
        <td ><input name="ocupacionResponsable" type="text"  id="ocupacionResponsable" size="60" 
		value="<?php echo $_POST['ocupacionResponsable'];?>"/></td>
      </tr>
	  <?php } ?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	   <?php if($_POST['tipoResponsable']=='Empresa'){ ?>
      <tr valign="middle"  >
        <td colspan="2"><div align="center" >Datos de la Empresa</div></td>
      </tr>
      <tr valign="middle"  >
        <td >Empresa/Seguro </td>
        <td><p><span >
          <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
		
		
          <a href="javascript:ventanaSecundaria3('/sima/cargos/agregarSeguros.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span>
            <input name="nomSeguro" type="text"  id="nomSeguro" size="80"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        </p>        </td>
      </tr>
      <tr valign="middle"  >
        <td >Credencial</td>
        <td><input name="credencial" type="text"  id="credencial" size="60" 
		value="<?php echo $_POST['credencial'];?>"/></td>
      </tr>
	    <?php } ?>
	 
</table>

<table width="642" >
  <tr valign="middle" >
    <td colspan="2">
      <div align="center">
        <input name="acepta" type="submit"  id="acepta" value="Internar Paciente" />
        <br />
        <?php if($myrow333['folioVentas']){ ?>
        <a href="javascript:ventanaSecundaria7(
           'impresionInternamiento.php?entidad=<?php echo $entidad; ?>&campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoCuarto=<?php echo "cuarto"; ?>&amp;nT=<?php echo $myrow9['keyClientesInternos']; ?>&edadPaciente=<?php echo $_POST['edadPaciente']?>&descripcionCuarto=<?php echo $_POST['descripcionCuarto']?>&medico=<?php echo $_POST['medico']?>&anomSeguro=<?php echo $_POST['seguro']?>&especialidad=<?php echo $_POST['especialidad']?>&folioVenta=<?php echo $myrow9['folioVenta'];?>')"><img src="/sima/imagenes/impresora.jpg" alt="Imprimir solicitud de Internamiento <?php echo $nombrePaciente; ?>" width="87" height="49" border="0" /></a>
        <?php } ?>
        <br />
        </label>
        </div></td>
    <?php } ?>
  </tr>
</table>
	<input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" value="<?php echo $nombrePaciente;?>"/>
</form>

<script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesSoloInternosx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
<?php 
} //cierra funcion
}//cierra clase
?>