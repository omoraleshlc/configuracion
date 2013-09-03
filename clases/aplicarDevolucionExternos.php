<?php class devE{
public function devolucionExternos($usuario,$folioVenta,$entidad,$basedatos){ require("/configuracion/clases/generaFolioVenta.php");?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
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
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>




<?php //************************ACTUALIZO **********************
//********************Llenado de datos
if(!$_GET['nT']){
$_GET['nT']=$nT;
}
if(!$bali){
$bali=$_GET['almacenFuente'];
}



$cendis=new whoisCendis();
$dia1= date("l");
$hora1= date("H:i a");
$fecha1=date("Y-m-d");

$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$almacenCierreCuenta=$myrow3['almacen'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];



//***************aplicar pago**********************

if($_POST['aplicar']){
$keyCAP=$_POST['keyCAP'];
$cantidad=$_POST['cantidad'];









    
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
    
    //************************************










//**********************GENERAR FOLIO DE VENTA DEVOLUCION*************

$generaFolio=new folioVenta();
$FV=$generaFolio-> generarFolioVenta(NULL,$usuario,"externo",$entidad,$tipoFolio,$basedatos);

//***********************VERIFICO QUE NO SE DUPLIQUE EL FOLIO********************************
$sSQL3a= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$FV."' ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
if($myrow3a['keyClientesInternos']){
echo '<script>
window.alert("Oops! hay un problema de cache! favor de reportarlo a sistemas");
window.close();
echo </script>';
}
//**********************************************************************************************



//***********************VERIFICO QUE NO SE DUPLIQUE EL FOLIO********************************
$sSQL3a= "Select status From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$FV."' ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
if($myrow3a['status'] =='cancelado'){
echo '<script>
window.alert("Oops! este folio esta cancelado!");
window.close();
echo </script>';
}
//**********************************************************************************************



$q4 = "UPDATE clientesInternos set 
statusCargoDevolucion='main',
folioDevolucion='".$FV."',
statusDevolucion='si',tipoCuenta='D'
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$q4);
echo mysql_error();




$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,folioVenta,clientePrincipal,statusPaciente,
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
alergiaPA,
tiposAlergias,
peso,dx,empleado,statusCuenta,statusCargoDevolucion,tipoCuenta,statusDevolucion,statusCaja,folioDevolucion,usuarioDevolucion,horaDevolucion,fechaDevolucion
) values (
'".$myrow3['numeroE']."',
'".$myrow3['nCuenta']."',
'".$myrow3['medico']."',
'".$myrow3['paciente']."',
'".$myrow3['seguro']."',
'".$myrow3['autoriza']."',
'".$myrow3['credencial']."',
'".$fecha1."',
'".$hora1."',
'activa',
'".$myrow3['cita']."',
'".$myrow3['almacen']."',
'".$myrow3['usuario']."',
'".$ip."',
'".$fecha1."',
'".$myrow3['tipoConsulta']."',
'".$myrow3['medicoForaneo']."',
'".$myrow3['observaciones']."',
'".$myrow3['edad']."',
'".$myrow3['tipoPaciente']."',
'".$nOrden."',
'".$myrow3['statusExpediente']."',
'".$myrow3['dependencia']."',
'".$entidad."',
'".$myrow3['diagnostico']."',
'".$myrow3['telefono']."',
'".$FV."',
'".$myrow3['clientePrincipal']."',
'".$myrow3['statusPaciente']."',
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
'".$myrow3['tipoAlergias']."',
'".$myrow3['peso']."',
'".$myrow3['dx']."',
'".$myrow3['empleado']."','caja','standby','H','si','standby','".$FV."','".$usuario."','".$hora1."','".$fecha1."' 
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$sSQL3a= "Select keyClientesInternos From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$FV."' ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
//****************************************************************************************************






$sSQL1= "Select * From cargosCuentaPaciente WHERE 
    (entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and naturaleza!='-') or  (entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and naturaleza!='-') 

";
$result1=mysql_db_query($basedatos,$sSQL1);

while($myrow1 = mysql_fetch_array($result1)){ //insertar








if($myrow1['gpoProducto']==''){

    
    
    
    
    
$sSQL317= "Select * From catTTCaja WHERE codigoTT='".$myrow1['tipoTransaccion']."' ";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);



if($myrow317['codigoTTDevolucion']!=''){
$sSQL317= "Select * From catTTCaja WHERE codigoTT='".$myrow317['codigoTTDevolucion']."'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);

$tipoTransaccion=$myrow317['codigoTT'];echo '<br>';
$myrow1['descripcionArticulo']=$myrow317['descripcion'];echo '<br>';
$naturaleza=$myrow317['naturaleza'];echo '<br>';
$tipoCuenta='D';
$sigue='si';
}else{
 $sigue='no';   
}

if($myrow3a['clientePrincipal']!=''){
$myrow1['cantidadAseguradora']=$myrow1['precioVenta']*$myrow1['cantidad'];
$myrow1['cantidadParticular']='';
}else{
$myrow1['cantidadParticular']=$myrow1['precioVenta']*$myrow1['cantidad'];
$myrow1['cantidadAseguradora']='';
}




}else{
$naturaleza='A';
$tipoCuenta='H';
$sigue='si';
}



if($sigue=='si'){
    
    
    
    
    
    
     $sSQL29pa= "SELECT *
FROM
gpoProductos
where
codigoGP='".$myrow1['gpoProducto']."'

";
$result29pa=mysql_db_query($basedatos,$sSQL29pa);
$myrow29pa = mysql_fetch_array($result29pa);



if($myrow29pa['afectaExistencias']=='si'){
    $statusCargo='standby';
    
//debe regresar a cendis todas las devoluciones

$centroDistribucion=$cendis->cendis($entidad,$basedatos);      
}    else{
    $statusCargo='cargado';
//debe regresar a cendis todas las devoluciones

$centroDistribucion=$myrow1['descripcionArticulo'];      
}
    




   
    
    
    
    
 $agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,iva,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,entidad,
tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,
almacenSolicitante,almacenDestino,keyClientesInternos,descripcion,statusFactura,horaSolicitud,
fechaSolicitud,codigoTarjeta,ultimosDigitos,codigoAutorizacion,numeroCheque,bancoTransferencia,
bancoCheque,numeroTransferencia,banderaPC,statusPC,clientePrincipal,folioVenta,codigoCaja,
numRecibo,numCorte,statusDevolucion,keyE,keyPA,numeroConfirmacion,
ivaParticular,ivaAseguradora,tipoVentaArticulos,usuarioFactura,
precioOriginal,ivaOriginal,usuarioDescuento,fechaDescuento,cargoModificable,gpoProducto,numSolicitud,folioDevolucion,descripcionArticulo,
tipoCuenta,
notaCredito,fechaCargo,usuarioCargo,
descripcionGrupoProducto,descripcionAlmacen,almacenIngreso,

statusBeneficencia,

diaNumerico,year,mes,

descripcionClientePrincipal,descripcionMedico,primeraVez,statusDescuento,cantidadBeneficencia,ivaBeneficencia,medico
)
values 
('".$myrow1['numeroE']."',
'".$myrow1['nCuenta']."',
'".$myrow1['status']." ',
'".$usuario."',
'".$fecha1."',
'".$dia1."',
'".$myrow1['cantidad']."',
'".$tipoTransaccion."',
'".$myrow1['codProcedimiento']."',
'".$hora1."',
'".$naturaleza."',
'".$ID_EJERCICIOM."',
'',
'".$myrow1['almacen']."',
'".$usuario."',
'".$myrow1['precioVenta']."',
'".$myrow1['iva']."'
,'".$myrow1['seguro']."',
'".$myrow1['statusTraslado']."',
'',
'".$myrow1['tipoPaciente']."',
'".$myrow1['cantidadParticular']."',
'".$myrow1['cantidadAseguradora']."',
'".$myrow1['entidad']."',
'".$myrow1['tipoCobro']."',
'".$myrow1['statusAuditoria']."'
,'".$myrow1['tipoPago']."',
'".$statusCargo."',
'".$myrow1['porcentajeVariable']."',
'".$myrow1['cargosHospitalarios']."',
'".$centroDistribucion."',
'".$centroDistribucion."',

'".$myrow3a['keyClientesInternos']."',


'".$myrow1['descripcion']."',
'',
'".$hora1."',
'".$fecha1."',
'".$fecha1."',
'',
'',
'',
'',
'',
'',
'".$myrow1['banderaPC']."',
'".$myrow1['statusPC']."',
'".$myrow1['clientePrincipal']."',
'".$FV."',
'',
'',
'',
'si',
'".$myrow1['keyE']."',
'".$myrow1['keyPA']."',
'".$myrow1['numeroConfirmacion']."',
'".$myrow1['ivaParticular']."',
'".$myrow1['ivaAseguradora']."',
'".$myrow1['tipoVentaArticulos']."',
'".$myrow1['usuarioFactura']."',
'".$myrow1['precioOriginal']."',
'".$myrow1['ivaOriginal']."',
'".$myrow1['usuarioDescuento']."',
'".$myrow1['fechaDescuento']."',
'".$myrow1['cargoModificable']."',
'".$myrow1['gpoProducto']."',

'".$myrow333['NS']."','".$myrow1['keyCAP']."' ,'".$myrow1['descripcionArticulo']."','".$tipoCuenta."',
'si','".$fecha1."',
'".$usuario."',
'".$myrow1['descripcionGrupoProducto']."','".$myrow1['descripcionAlmacen']."','".$myrow1['almacenIngreso']."',

'".$myrow1['statusBeneficencia']."','".$myrow1['diaNumerico']."','".$myrow1['year']."','".$myrow1['mes']."',

'".$myrow1['descripcionClientePrincipal']."','".$myrow1['descripcionMedico']."','".$myrow1['primeraVez']."','".$myrow1['statusDescuento']."',
    
'".$myrow1['cantidadBeneficencia']."','".$myrow1['ivaBeneficencia']."','".$myrow1['medico']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



//DEPRECATED
//$karticulos=new kardex();
//$karticulos-> movimientoskardex('entrada',$myrow1['cantidad'],'ENTRADA POR DEVOLUCION','devolucionVenta',$usuario,$fecha1,$hora1,$myrow1['almacenSolicitante'],$myrow1['almacenDestino'],$myrow1['keyPA'],$myrow1['codProcedimiento'],$entidad,$basedatos);







//DEPRECATED
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status)
values
('".$myrow1['codProcedimiento']."','".$myrow1['keyPA']."','".$myrow1['gpoProducto']."','".$myrow1['cantidad']."','".$myrow1['tipoVenta']."','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrow1['almacenDestino']."','".$_GET['id_factura']."','".$tipoEntrada[$i]."','standby')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();    
}
} //cierra for
?>



<script>
window.alert("Se genero el folio de devolucion: <?php echo $FV;?>");
window.opener.document.forms["form1"].submit();
window.close();
</script>



<?php 
} //cierra actualizar



/*
//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($costo,$numSolicitud,$codigoInv,$flag,$myrow3['almacen'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);
*/



//*******************************************************************************

$cargosParticulares=new  acumulados();
$totalxSurtir=new  acumulados();
$cargosAseguradora= new acumulados();
$otros= new acumulados();
?>




























<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librer�a principal del calendario --> 
<script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<style type="text/css">
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
-->
</style>
<head>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>



<BODY  >
<?php //ventanasPrototype::links();?>
<h2 align="center" >Devoluciones</h2>
<h1 align="center" >&nbsp;</h1>





<form id="form1" name="form1" method="post" action="">
  <table width="412" border="0" align="center" cellpadding="1" cellspacing="1" >
    <tr>
      <th ><div align="left">Transacci&oacute;n</div></th>
      <th ><div align="left"><?php echo $_GET['folioVenta'];

		  ?>
          <input name="numeroE" type="hidden" class="normal" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="157" ><div align="left">Paciente</div></th>
      <th width="385" >
      <div align="left">
<?php echo $myrow3['paciente']; ?> 
      </div></th>
    </tr>
    <tr >
      <td ><div align="left">Compa&ntilde;&iacute;a</div></td>
<td class="normal"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr >
      <td ><div align="left">N&deg; Credencial</div></td>
      <td class="normal"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr >
      <th ><div align="left">
        <div align="left"><strong>M&eacute;dico</strong></div>
      </div></th>
      <th ><div align="left">
          <label> <?php echo $medico=$myrow3['medico']; ?> </label>
          <label> </label>
          <?php 
$sSQL18= "Select * From medicos WHERE entidad='".$entidad."' and numMedico ='".$medico."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php  $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?> </div></th>
    </tr>
  </table>
  <p align="center" class="success"><em>*Presiona Cargar Devolucion...</em> <br />
    <input type="submit"  name="aplicar" id="button" value="Aplicar Devolucion"  />
  </p>
  
  
  
  
  
  
  
  
  
  
  <table width="776" border="0" align="center">
    <tr >
      <th width="40" ><div align="center">Ref</div></th>
     
      <th width="82" ><div align="center">Fecha/Hora </div></th>
      <th width="264" ><div align="center">Descripci&oacute;n/Concepto</div></th>
     
      <th width="42"  ><div align="center">Status</div></th>
      <th width="28"  ><div align="center">N</div></th>
      <th width="51"  ><div align="center">Tipo P</div></th>
      <th width="21"  ><div align="center">C</div></th>
      <th width="66"  ><div align="center">P.Unit</th>
      <th width="57"  ><div align="center">CargosP</div></th>
      <th width="59"  ><div align="center">CargosA</div></th>
      <th width="52"  ><div align="center">IVA</div></th>
      <th width="50"  ><div align="center">Abonos</div></th>
    </tr>
	
      <?php //traigo agregados
	  

$sSQL81= "
SELECT 
*,cargosCuentaPaciente.descripcion as descripcionGeneral
FROM
cargosCuentaPaciente
 WHERE 
cargosCuentaPaciente.folioVenta='".$_GET['folioVenta']."'
and 
cargosCuentaPaciente.status!='cancelado'
and
status!='transaccion'
order by fecha1 DESC
 ";

$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 



$a+=1;
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];



$style='normal';







?>	
	
	
	

      
      <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td ><?php echo $myrow81['keyCAP'];?>
      <input type="hidden" name="keyCAP[]" id="keyCAP[]" value="<?php echo $myrow81['keyCAP'];?>"/>      </td>






      <td ><div align="center"><span class="<?php echo $estilo;?>">
        <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></div></td>
	

	
	
      <td >
	  <div align="left">
	  
	 
        <?php 
echo $myrow81['descripcionAlmacen'].' / '.$myrow81['descripcionMedico'];
		?>
		
  
          
          <?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 		  
		?>

	  <?php //echo $myrow81['statusCargo'];
	  if($myrow81['statusDevolucion'] and $myrow81['statusDevolucion']!=''){
	  echo '</br>';
	  if($myrow81['statusDevolucion']=='si' and $myrow81['naturaleza']=='C'){
	  echo '   [Hizo el cargo: '.$myrow81['usuario'].']';
	  }else if($myrow81['statusDevolucion']=='si' and $myrow81['naturaleza']=='A'){
	  echo '   [Solicito Devolucion: '.$myrow81['usuario'].', Transaccion: '.$myrow81['folioDevolucion'] .']';
	  }
	  
	  }
	  ?>
 </div></td>
	   
	   
     
      <td >
        
        
        
    
        <div align="center">
          <?php 
if($myrow81['statusCargo']=='standbyR'){
echo 'Sin enviar';
}else if($myrow81['statusCargo']=='standby'){
echo 'pendiente surtir';
} else if($myrow81['statusCargo']=='cargado'){
echo $myrow81['statusCargo'];
}
	?>
        </div></td>
		
      <td > <div align="center"><?php echo $myrow81['naturaleza'];
	?></div></td>
      <td ><div align="center"><?php echo $myrow81['tipoCliente'];
	?></div></td>
<td ><div align="center"><?php print $myrow81['cantidad']; ?></div></td>
      <td  ><?php //cargos
	  if($myrow81['naturaleza']=='C'){
	  echo '$'.number_format($myrow81['precioVenta'],2);
	  } else {
	  echo '*';
	  }
	  ?></td>
      <td  align="right">
	  <?php //cargos
	  if($myrow81['naturaleza']=='C'){
	  echo '$'.number_format($myrow81['cantidadParticular']*$myrow81['cantidad'],2);
	  } else {
	  echo '*';
	  }
	  ?></td>
      <td  ><?php //cargos
	  if($myrow81['naturaleza']=='C'){
	  echo '$'.number_format($myrow81['cantidadAseguradora']*$myrow81['cantidad'],2);
	  } else {
	  echo '*';
	  }
	  ?></td>
      
	  
	  
	  <td >
          <?php 
		  if($myrow81['naturaleza']=='C'){
		  $sumaIVAS[0]+=($myrow81['ivaAseguradora']+$myrow81['ivaParticular'])*$myrow81['cantidad'];
		echo '$'.number_format(($myrow81['ivaAseguradora']+$myrow81['ivaParticular'])*$myrow81['cantidad'],2);
		}else{
   	    echo '*';
		}
		?>
      </span></div></td>
	  
	  
	  
      <td  >
        <div align="right">
          <?php
	  if($myrow81['naturaleza']=='A'){
	  echo '$'.number_format($myrow81['precioVenta']*$myrow81['cantidad'],2);
	  }
	  ?>
        </div></td>
      </tr>
 
	
	
    <?php }?>
  </table>


  <p>
    <label></label>
    <input name="bandera" type="hidden" id="recibo" value="<?php echo $a;?>" />
  </p>
<div align="center">
            <div align="left">
              <p>&nbsp;</p>
            </div>
  </div>
          <p align="center">
    <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $myrow3['keyClientesInternos']; ?>" />
  </p>
</form>

</body>
</html>
<?php
}
}
?>