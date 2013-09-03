<?php 
//clase 3
class aplicarPaquetes{
public function aplicaPaquete($entidad,$almacenSolicitante,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){
$almacenPrincipal='HALM';//necesitamos definirlo desde el catálogo de almacenes
?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
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
                alert("Por Favor, escoje si es un servicio o si son artículos lo que vas a cargar!")   
                return false   
        } else if( vacio(F.nomArticulo.value) == false ) {   
                alert("Por Favor, escoje el artículo o servicio para solicitar!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
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
$nCuenta=$nCuenta;
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


for($i=0; $i<=$_POST['bandera'];$i++){ //********************FOR
$b+=1;

$codigo[$i]=$codigoBeta[$i];



$grupoProducto=new articulosDetalles();
$gpoProducto=$grupoProducto->grupoProducto($codigo[$i],$basedatos);
  
$costoHospital=costoHospital($codigo[$i],$basedatos);
$ctaContable=centroCosto($medico,$basedatos);
$centroCostoAlmacen=centroCostoAlmacen($almacen,$basedatos);
$medico=devuelveMedico::regresaMedico($codigo[$i],$basedatos);


 $seguro=$traeSeguro->traeSeguro($numeroPaciente,$nCuenta,$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($paquete,$_POST['generico'],$cantidad[$i],$numeroE,$nCuenta,$codigo[$i],$almacen,$basedatos);





if($verificaSaldos1->verificaSaldos1($cantidad[$i],$iva,$priceLevel,$dia,$fecha1,$hora1,$seguro,$credencial,$leyenda,$basedatos)==true
and
$verificaSaldosInternos->verificaSaldosInternos($numeroPaciente,$nCuenta,$hora1,$seguro,$credencial,$basedatos)==true){
$leyenda="Se agregaron artículos";

if( $cantidad[$i] ){
$um=new articulosDetalles();
$um=$um->um($codigo[$i],$basedatos);  


$keyClientesInternos=new articulosDetalles();
$keyClientesInternos=$keyClientesInternos->keyClientesInternos($numeroE,$nCuenta,$basedatos);


$cargoAuto=new articulosDetalles();
$cargoAuto=$cargoAuto->cargoAuto($entidad,$codigo[$i],$basedatos);

$ajusteExistencias=new existencias();
$error=$ajusteExistencias->ajusteExistencias($um,$cantidad[$i],$codigo[$i],$almacen,$usuario,$fecha1,$error,$basedatos);

$informacionExistencias=new existencias();
$existenciasAjuste=$informacionExistencias->informacionExistencias($codigo[$i],$almacen,$usuario,$fecha,$basedatos);

$acumuladoGlobal=$global->precioGlobal($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$cargos=$convenios->validacionConveniosNivel($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$tipoConvenio=$tipoConvenioS->tipoConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);


if($error!='faked' ){



if($tipoConvenio=='cantidad'){
$cantidadAseguradora=$convenios->validacionConvenios($cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora*$cantidad[$i];
 $priceLevel=$acumulado;
} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=$cantidadParticular=$cantidadAseguradora-(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]));
} else if($tipoConvenio=='global'){
$cantidadAseguradora=$convenios->validacionConvenios($cantidad[$i],$iva,$priceLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;
} else {
$cantidadParticular=NULL;
$cantidadAseguradora=NULL;
}


$iva=new articulosDetalles();
$iva=$iva->iva($cantidad[$i],$codigo[$i],$priceLevel,$basedatos);  



if($seguro){
$status='cxc';
$statusAlta='standby';
$tipoCliente='aseguradora';
} else {
$status='particular';
$statusAlta='standby';
$tipoCliente='particular';
}

$statusCargo=new articulosDetalles();

if($statusCargo->cargosDirectos($almacen,$gpoProducto,$entidad,$codigo[$i],$basedatos)){
$statusCargo='cargado';
} else {
$statusCargo='standby';
}

if($acumuladoGlobal>$priceLevel){
//$acumulado=$acumuladoGlobal-$priceLevel;
$acumulado=$priceLevel;
} else {
$acumulado=$priceLevel;
}


$agrega1 = "INSERT INTO cargosCuentaPaciente (
numeroE,
nCuenta,
codProcedimiento,
cantidad,
usuario,
fecha1,
ip,
status,
almacen,
precioVenta,

ctaMayor,
ctoCosto,
auxiliar,

ejercicio,
seguro,iva,dia,costoHospital,hora1,existencias,um,
medico,tipoPaciente,prioridad,horaSolicitud,fechaSolicitud,laboratorioReferido,
credencial,banderaCXC,statusCargo,almacenDestino,almacenSolicitante,naturaleza,statusTraslado,tipoCliente,
statusEstudio,entidad,gpoProducto,statusFactura,keyClientesInternos

) values (
'".$numeroPaciente."',
'".$nCuenta."',
'".$codigo[$i]."',
'".$cantidad[$i]."',
'".$usuario."',
'".$fecha1."',
'".$ip."',
'".$status."',
'".$almacen."',
'".$acumulado."',

'".$ctaMayor."',
'".$centroCostoAlmacen."',
'".$aux."',

'".$ID_EJERCICIOM."',
'".$seguro."','".$iva."','".$dia."','".$costoHospital."','".$hora1."','".$existenciasAjuste."','".$um."',
'".$medico."','interno','".$_POST['prioridad']."',
'".$_POST['horaSolicitud']."','".$_POST['fechaSolicitud']."','".$laboratorioReferido[$i]."','".$credencial."',
'".$_POST['banderaCXC']."','".$statusCargo."','".$almacen."','".$almacenSolicitante."','C','standby','".$tipoCliente."','standby','".$entidad."','".$gpoProducto."','standby','".$keyClientesInternos."'

)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
//*********************************agregar faltantes**********************
$agrega1 = "INSERT INTO faltantes (




numeroE,nCuenta,
codigo,
cantidad,
usuario,
fecha1,
hora1,
almacen,
ejercicio,
dia,
status,entidad,almacenDestino
) values (
'".$numeroPaciente."','".$nCuenta."',
'".$codigoBeta[$i]."',
'".$cantidad[$i]."',
'".$usuario."',
'".$fecha1."',
'".$hora1."',
'".$almacen."',
'".$ID_EJERCICIOM."',
'".$dia."',
'sinsurtir','".$entidad."','".$almacenPrincipal."'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();



//****************saco la cuenta contable de la forma en que ingresa*****************
insertarRegistros($agregarA[$i],$almacen,$cantidad[$i],$fecha1,$ID_EJERCICIOM,$usuario,$basedatos);
} 
}else {

$leyenda="Se hicieron cargos..";
}//validacion de seguros


}
} //validacion de seguros
//*****************************************************CIERRO ALMA**************************************************



} //cierro buscar 
}





//verificaSeguro::verificaSaldos($dia,$fecha1,$hora1,$seguro,$credencial,$basedatos);
?>



<?php 

$sSQL311= "Select  * From clientesInternos WHERE numeroE = '".$numeroPaciente."' and status='activa'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$paciente=$myrow31['nombre1']." ".$myrow31['nombre2']." ".$myrow31['apellido1']." ".$myrow31['apellido2']." ".$myrow31['apellido3'];

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
<style type="text/css">
<!--
.Estilo25 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style15 {color: #0000FF}
.Estilo25 {
	color: #FF0000;
	font-weight: bold;
}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>
</head>

<body>

  <?php 
$sSQL31= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$numeroPaciente."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);




?>
<p align="center"><label></label></p>
<form id="form2" name="form2" method="post" action="" >
  <table width="546" border="0" align="center">

    <tr>
      <th colspan="2" bgcolor="#660066" scope="col"><div align="center"><span class="style11">Solicitudes a otros departamentos </span></div></th>
    </tr>
	  <tr bgcolor="#FFCCFF" class="style7">
      <th scope="col"><div align="left">Paciente: </div></th>
      <th bgcolor="#FFCCFF" scope="col"><div align="left"><?php echo $paciente; ?>
      </div></th>
    </tr>
     <tr class="style7">
       <th scope="col"><div align="left">Cuarto:</div></th>
       <th scope="col">
         <div align="left"><?php echo $myrow311['cuarto']; ?></div></th>
     </tr>

     <tr class="style7">
       <th bgcolor="#FFCCFF" scope="col"><div align="left">Departamento</div></th>
       <th bgcolor="#FFCCFF" scope="col">
         <div align="left">
           <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenAAV($entidad,'style7',$almacenSolicitante,$almacenDestino,$basedatos);
?>
       </div></th>
     </tr>
	 
	 
	
     <tr class="style7">
       <th class="style7" scope="col"><div align="left">Mini Almac&eacute;n </div></th>
       <th scope="col">
         <div align="left">
           <?php 
$comboAlmacen1=new comboAlmacen();
if(!$almacenDestino){
$almacenDestino=$almacenSolicitante;
}
$comboAlmacen1->despliegaMiniAlmacen($entidad,'style7',$almacenDestino,$almacenDestino,$basedatos);

?>
       </div></th>
     </tr>
	 

	 
    <tr>
	
      <th bgcolor="#FFCCFF" scope="col"><div align="left"><span class="Estilo24">Mostrar Todo (*) </span></div></th>
      <th bgcolor="#FFCCFF" scope="col"><div align="left">
        <label>
        <input name="todo" type="checkbox" id="todo" value="todo" />
        </label>
      </div></th>
    </tr>
    
	
	
    <tr>
      <th scope="col"><div align="left"><span class="Estilo24">Prioridad</span></div></th>
      <th scope="col"><div align="left">
        <select name="prioridad" class="style71" id="select">
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
        </select>
      </div></th>
    </tr>
	
	
	
	

	
	
	
    <tr>
      <th width="101" scope="col"><div align="left"><span class="style12">Cargar Art&iacute;culos/Serv. </span></div></th>
      <th width="435" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="60" value="<?php if($_POST['nomArticulo']) //echo $_POST['nomArticulo']; ?>"/>
      </span>
          <input name="buscar" type="submit" class="Estilo24" id="buscar" value="buscar" />
      </div></th>
    </tr>
  </table>
  <p align="center"><span class="Estilo24"><span class="style7"><input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
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
    <div align="center">
<?php	


if($_POST['almacenDestino1']){
$almacen=	  $_POST['almacenDestino1'];
} else {
$almacen=$_POST['almacenDestino'];
}



//*********************NUCLEO***********************



if($_POST['todo']=='todo'){

 $sSQL= "SELECT 
articulos.codigo,articulos.gpoProducto,articulos.laboratorioReferido
FROM articulos,existencias
WHERE
articulos.entidad='".$entidad."' AND 
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
articulos.codigo,articulos.gpoProducto,articulos.laboratorioReferido
FROM articulos,existencias
WHERE
articulos.entidad='".$entidad."' AND 
articulos.activo='A' and
articulos.descripcion like '%$articulo%'

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

?>
      
   
      
      
      
      
           
      
<table width="364" border="0" align="center" class="style71">


  <tr>
    <th width="105" bgcolor="#FFCCFF" scope="col"><div align="left"><span class="Estilo26">Hora de Estudio</span></div></th>
    <th width="249" bgcolor="#FFCCFF" scope="col"><div align="left"><span class="Estilo26">
        <label>
        <input name="horaSolicitud" type="text" class="style71"   value="<?php 
		if($_POST['horaSolicitud'])
		echo $_POST['horaSolicitud'];?>" size="10"/>
        </label>
        <input name="H2" type="button" class="style71" id="H2"  onclick="javascript:ventanaSecundaria3(
		'/sima/cargos/citas.php?numeroE=<?php echo $numeroPaciente?>&amp;forma=<?php echo "form2"; ?>
		&amp;campoDespliega=<?php echo "horaSolicitud"; ?>
		&amp;almacenSolicitante=<?php echo $_POST['almacenDestino1']; ?>
		&amp;campoDespliegaFecha=<?php echo "fechaSolicitud"; ?>
		&amp;nCuenta=<?php echo $nCuenta; ?>')" value="H" />
</span></div></th>
  </tr>
  
  
  
  
  
  <tr>
    <th scope="col"><div align="left"><span class="Estilo26">Fecha del Estudio </span></div></th>
    <th scope="col"><span class="Estilo26">
      <label></label>
      </span>
        <div align="left"><span class="Estilo26">
          <input name="fechaSolicitud" type="text" class="style71" id="fechaSolicitud"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $_POST['fechaSolicitud'];
	  } else {
	  if($myrow3['fechaSolicitud']){
	  echo $myrow3['fechaSolicitud'];
	  } else {
	  echo $fecha1; }} ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
          <input name="button2" type="button" class="style71" id="lanzador" value="..." />
      </span></div></th>
  </tr>

</table>
<p>&nbsp;</p>
  </div>
    <table width="681" border="0" align="center">
      <tr>
        <th width="65" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo </span></div></th>
        <th width="332" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
         <?php if($myrow['laboratorioReferido']=='si'){	 ?>
		<th width="145" bgcolor="#660066" scope="col"><span class="style11">Ref.</span></th>
		<?php } ?>
        <th width="17" bgcolor="#660066" scope="col"><span class="style11">UM</span></th>
        <th width="58" bgcolor="#660066" scope="col"><span class="style11">Precio sin/IVA</span></th>
      
        <th width="17" bgcolor="#660066" scope="col"><span class="style11">C</span></th>
        <th width="17" bgcolor="#660066" scope="col"><span class="style11">D</span></th>
      </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$i+=1;
$code1=$myrow['codigo'];
$codigo=$myrow['codigo'];
//*************************************CONVENIOS********************************************



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


$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenioS=new validaConvenios();
$traeConvenio=new validaConvenios();
$vConvenio=new validaConvenios();
$um=new articulosDetalles();
$um=$um->um($codigo[$i],$basedatos);  
$cantidad=1;
$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();
$seguro=$traeSeguro->traeSeguro($numeroPaciente,$nCuenta,$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($paquete,$_POST['generico'],$cantidad,$numeroE,$nCuenta,$codigo,$almacen,$basedatos);




$acumuladoGlobal=$global->precioGlobal($precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cargos=$convenios->validacionConveniosNivel($precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$tipoConvenio=$tipoConvenioS->tipoConvenio($precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);


if($tipoConvenio=='cantidad'){
$cantidadAseguradora=$convenios->validacionConvenios($cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo

$acumulado=$cantidadAseguradora*$cantidad;
 $priceLevel=$acumulado;

} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=$cantidadParticular=$cantidadAseguradora-(($priceLevel*$cantidad)+($iva*$cantidad));
} else if($tipoConvenio=='global'){
$cantidadAseguradora=$convenios->validacionConvenios($cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=$cantidadParticular=(($priceLevel*$cantidad)+($iva*$cantidad))-$cantidadAseguradora;
} else {
$cantidadParticular=NULL;
$cantidadAseguradora=NULL;
}


$iva=new articulosDetalles();
$iva=$iva->iva($cantidad,$codigo,$priceLevel,$basedatos);  
//**********************************************************************************************************


$gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);



?>		        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label><?php echo $myrow39['prefijo'].$myrow['codigo']; ?></label>

        
          <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codigo']; ?>" />
          <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php  echo $myrow['codigo']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
		<?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
		<?php 
		if($myrow['paquete']=='si'){
		echo '<img src="/sima/imagenes/p.jpeg" width="12" height="12" alt="ES UN PAQUETE" />';

		}
		
		if($myrow['gpoProducto']){
		echo '['.$myrow['gpoProducto'].']';
		}
		?>
		
              		<?php if( $myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
		
		
		
        </span>		</td>
<?php if($myrow['laboratorioReferido']=='si'){	 ?>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="Estilo241"><span class="style72">
         
        </span><span class="style72">
        <?php $aCombo= "Select distinct * From catLabRef where
activo='activo'
 ORDER BY descripcionLF ASC ";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="laboratorioReferido[]" class="style72" onChange="javascript:enableField();" />
        
       
        <option>---</option>
        
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
        <option value="<?php echo $resCombo['id_LF']; ?>"><?php echo $resCombo['descripcionLF']; ?></option>
        <?php } ?>
        </select>
        <?php 
	  $sqlNombre18= "SELECT * From catLabRef
			WHERE 
			id_LF= '".$_POST['laboratorioReferido']."'
			
			";
$resultaNombre18=mysql_db_query($basedatos,$sqlNombre18);
$rNombre18=mysql_fetch_array($resultaNombre18); 
echo $rNombre18['descripcionLF'];
	  ?>
        <?php } else {?>
        <?php //echo "---"; ?> 
		<span class="Estilo26"><span class="style71">
        <input name="laboratorioReferido[]" type="hidden" value="" />
        </span></span>
        <?php } ?>
        </span></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label>
          <label>
<?php 
$unidadMedida=new articulosDetalles();
echo $unidadMedida->unidadMedida($codigo,$basedatos); 
?>
         </label>
          </label>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
<?php 

echo "$".number_format($priceLevel,2);
?>
        </span></td>
		


<td bgcolor="<?php echo $color;?>" class="Estilo24">
		
<?php 
$statusExistencias=new articulosDetalles();
?>


<input name="cantidad[]" type="text" class="Estilo24" id="cantidad" 
onKeyPress="return checkIt(event)" size="2" maxlength="2"
autocomplete="off" <?php 
echo $statusExistencias->statusExistencias($unidadMedida->unidadMedida($codigo,$basedatos),$almacen,$codigo,$basedatos);
?>/> </td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
		
		<?php if( $myrow['gpoProducto']){ $errores1='No tiene grupo de producto';}
if($statusExistencias->statusExistencias($myrow['servicio'],$almacen,$myrow['codigo'],$basedatos)=='readonly' 
and $myrow['gpoProducto']) { 
		$errores='No hay existencias en el almacen: '.$almacen; ?>
		<a href="javascript:ventanaSecundaria20('/sima/cargos/ventanaErrores.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&error=<?php echo $errores; ?>&error1=<?php echo $errores1; ?>')">
		<img src="/sima/imagenes/pregunta.png" width="12" height="12" border="0" alt="ERRORES" /></a>		
		<?php 
		} else {
		echo '<img src="/sima/imagenes/ok.jpeg" width="12" height="12" alt="OK" />';
		}
		?>
		</label></td>
      </tr>

      <?php }}?>
    </table>
    <p>
      <?php 
 
 //*********************************************TERMINA TABLA**************************************************
 
 ?></p>
    <p>
      <label>
      <div align="center">
        <hr width="600" size="0" />
        <div align="center">
	  <input name="insertarArticulos" type="submit" class="Estilo24" id="insertarArticulos" value="Agregar" 
  <?php if($myrow['laboratorioReferido']=='si'){ echo 'disabled="disabled"';} ?>/>
          </label>
  </div>
        <p align="center">&nbsp; </p>
    <?php } ?>
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
</form>
  <p>
 
  </p>
    
 <?php 
 if($bandera>1){
 echo 'Se encontraron '.$bandera.' registros';
 }
 
 if($result ){  ?>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 

<?php } ?>

</body>
</html>


<?php 
} //cierra funcion
} //cierra clase ?>


