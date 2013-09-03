<?php 
require('/configuracion/funciones.php');

if($_POST['cargos']){ //validacion de vigencia de credenciales
if($_POST['eFisico']){
$exp='si';
$fechaSol=$fecha1;
}

$sSQL4f= "Select credenciales from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result4f=mysql_db_query($basedatos,$sSQL4f);
$myrow4f = mysql_fetch_array($result4f);

if($myrow4f['credenciales']=='si'){ //checo que el cliente tenga credenciales activado


$sSQL45z= "Select usuario,fechaInicial,fechaFinal,keyCredencial from pacientesCredenciales where entidad='".$entidad."' and (numeroE='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."' and status='A')
AND
fechaFinal >= '".$fecha1."'
and
fechaInicial <= '".$fecha1."' 
";
$re=mysql_db_query($basedatos,$sSQL45z);
$si = mysql_fetch_array($re);


if(!$si['usuario']){ 

$sSQL45z1= "Select usuario,fechaInicial,fechaFinal,keyCredencial from pacientesCredenciales where entidad='".$entidad."' 
and numeroE='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."' 
";
$re1=mysql_db_query($basedatos,$sSQL45z1);
$si1 = mysql_fetch_array($re1)
?>
<script>
window.alert("La credencial: #<?php echo $si1['keyCredencial'];?> expiró en: <?php echo cambia_a_normal($si1['fechaFinal']);?>, por lo cual está bloqueada o cancelada..!");
window.close();
</script>
<?php }
}
}



if($_GET['almacen']){
$ALMACEN=$_GET['almacen'];
} else {
$_GET['almacen']=$ALMACEN;
}
?>

<script language=javascript> 
function ventanaSecundaria100 (URL){ 
   window.open(URL,"ventana100","width=600,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=150,height=200,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 



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
           
        if( vacio(F.numeroEx.value) == false ) {   
                alert("Por Favor, ingresa el expediente!")   
                return false   
        }            
}   
  
</script> 

<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 






<?php 

if(!$_POST['nomSeguro']){
$_POST['seguro']='';
}



$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenio=new validaConvenios();
$verificaSaldos=new verificaSeguro();

$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();

$seguro=$traeSeguro->traeSeguro($_POST['keyClientesInternos'],$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);

if($_POST['cargos']){






if($_POST['nomSeguro']){
$sSQL455= "Select nomCliente,clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
if(!$myrow455['clientePrincipal']){
echo '<script>';
echo 'window.alert("Oops! hay un problema con el seguro, revisa bien y vuelve a llenar datos!");';
echo 'window.close();';
echo '</script>';
}
}





if(verificaSeguro1::verificaSaldos1($cantidad,$iva,$priceLevel,$dia,$fecha1,$hora1,$_POST['seguro'],$_POST['credencial'],$leyenda,$basedatos)==TRUE){














$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' AND numeroE = '".$_POST['PACIENTE']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numeritoE=$_POST['numeroPaciente'];
if($_POST['nuevo']){
$_POST['paciente']="";
}














$sSQL4= "Select * from clientesInternos where entidad='".$entidad."' AND numeroE='".$_POST['numeroEx']."' order by keyClientesInternos DESC";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$nCuenta = $myrow4['nCuenta']+1; 


if($_POST['cortesia']=='si'){
$status='cortesia';

}else{
$status='request';

}

//*************genero orden aleatoria*********
$nOrden=rand(0,100000);
if($nOrden1){
$nOrdenT=$nOrden1;
} else {
$nOrdenT=$nOrden;
}
 
 
 
$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'  order by keyClientesInternos DESC";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33); 

if(!$_POST['numeroEx']){
$_POST['numeroEx']=$nOrden;
$nCuenta='99999';
}




//*****************cierro orden*****************


$sSQL45= "Select * from clientesInternos where keyClientesInternos ='".$_POST['keyClientesInternos']."'";
$result45=mysql_db_query($basedatos,$sSQL45);
$myrow45 = mysql_fetch_array($result45);



if($myrow45['numeroE']){


if($_POST['edad']=='prepago'){

echo 'El paciente es de prepago';

} else {

$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['clientePrincipal']){
$cP=trim($myrow455['clientePrincipal']);
}else{
$cP='';
}


$q = "UPDATE clientesInternos set 

medico='".$_POST['medico']."',
seguro='".$_POST['seguro']."',
credencial='".$_POST['credencial']."',
fecha='".$fecha1."',
hora='".$hora1."',
status='".$status."',
tipoPaciente='externo',
dependencia='".$_POST['dependencia']."',
entidad='".$entidad."',
statusExpediente='request',
edad='".$_POST['edad']."',
diagnostico='".$_POST['diagnostico']."',
telefono='".$_POST['telefono']."',
folioVenta='".$myrow333['numeroFolio']."',
clientePrincipal='".$cP."',
statusPaciente='".$_POST['statusPaciente']."',
empleado='".$_POST['empleado']."'
WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error(); 
}


?>

<script language="JavaScript" type="text/javascript">
javascript:ventanaSecundaria20('/sima/cargos/agregaArticulos.php?almacen=<?php echo $_GET['almacen']; ?>&numeroE=<?php echo $_POST['numeroEx']; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $_GET['almacen']; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>&folioVenta=<?php echo $myrow333['numeroFolio']; ?>');

//opener.location.reload(true); aqui?
close();

</script>
<?php





} else {
if($_POST['cargos'] AND $_POST['numeroEx'] AND $_POST['paciente']){
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['clientePrincipal']){
$cP=trim($myrow455['clientePrincipal']);
}else{
$cP='';
}

$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,credencial,
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
peso,dx,empleado,expediente,fechaSolicitud
) values (
'".$_POST['numeroEx']."','".$nCuenta."',
'".$_POST['medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_POST['seguro']."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$status."',
'".$_POST['cita']."',
'".$ALMACEN."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".strtoupper($_POST['observaciones'])."','".$_POST['edad']."','externo',
'".$nOrden."','request','".$_POST['dependencia']."','".$entidad."','".$_POST['diagnostico']."','".$_POST['telefono']."','',
'".$cP."','".$_POST['statusPaciente']."',
'".$_POST['tipoAccidente']."',
'".$_POST['fechaAccidente']."',
'".$_POST['horaAccidente']."',
'".$_POST['lugarAccidente']."',
'".$_POST['llegoHospital']."',
'".$_POST['ministerio']."',
'".$_POST['motivoConsulta']."',
'".$_POST['alergiaT']."',
'".$_POST['alergiaP']."',
'".$_POST['alergiaR']."',
'".$_POST['alergiaPA']."',
'".$_POST['tiposAlergias']."',
'".$_POST['peso']."',
'".$_POST['dx']."',
'".$_POST['empleado']."','".$exp."','".$fechaSol."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$sSQL1= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); 
$keyClientesI=$myrow1['keyClientesInternos'];
$leyenda='SE GENERO LA ORDEN #'.$myrow1['folioVenta'];




?>


<script type="text/vbscript">
msgbox "SE GENERO LA ORDEN # <?php echo $myrow1['folioVenta']; ?>!"
</script>



<script>
javascript:ventanaSecundaria20('/sima/cargos/agregaArticulos.php?numeroE=<?php echo $myrow1['numeroE']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacen=<?php echo $ALMACEN; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow1['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>&folioVenta=<?php echo $myrow1['folioVenta']; ?>');
close();
</script>
<?php 
} else {
//echo "YA DISTE DE ALTA ESA NOTA DE CARGO, ESCOJE EL EXPEDIENTE NUEVO";
}
}//cierro actualizar nota de venta

//**********************CIERRO CLIENTES AMBULATORIOS A FARMACIA*********************

}
}
?>


<?php 

if($_POST['quitar']){
$codigo=$_POST['codigo'];

for($i=0;$i<$_POST['bandera'];$i++){
$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$codigo[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}

}
$nOrden1=$nOrdenT;
?>


<?php	
if($_POST['verCargos']){ 
$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
echo mysql_error();
if($myrow33['numeroE'] and !$_POST['nuevo']){
$numeroE1=$myrow33['numeroE'];
 } 
} 
 ?>



<?php 
$sSQL4= "Select * from clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
?>



<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>


<script type="text/javascript">

//window.onbeforeunload = function (e) {
  //var e = e || window.event;
     
    //if (e) {
    //e.returnValue = "No has llenado datos correctamente, ¿estas seguro que deseas salir?";
	//}

//}



  
</script>


<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

	

  


</head>


<body>

<h1 align="center" class="titulos">Buscar al Paciente </h1>




<div>
<form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>">

	
	
	
	<table width="577" border="0" align="center" class="normal">
      <tr>
        <td>&nbsp;</td>
        <td>por apellidos, matricula, numero de empleado,expediente </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="negro">
          <input name="paciente" type="text" class="camposmid" id="paciente" value="" size="60" onChange="this.form.submit();">
        </span></td>
        <td><input name="numeroEx" type="hidden" class="Estilo24" id="numeroEx" value="<?php if($_POST['numeroEx'] and !$_POST['nuevo']){ echo $_POST['numeroEx'];}?>" readonly="" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label></label></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>

</div>



  <p>
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
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesAjax.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>
  <p>&nbsp;</p>
  <form id="form2" name="form2" method="post" action="">
    <div align="center">
      <p>
        <?php 


$sSQL39= "SELECT descripcion
FROM
almacenes
where 
entidad='".$entidad."' AND
almacen='".$ALMACEN."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
?>
        <?php if($_POST['numeroEx']){
	
	$sSQL= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numeroEx']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
	 ?>
      </p>
      <table width="643" border="1" align="center" class="style12">
        <tr bgcolor="#9999FF">
          <th height="30" colspan="3"  scope="col"><div align="left" class="blancomid"> Datos Personales del Paciente
            <?php 
	$sSQL2= "Select max(numCliente)+1 as tope From pacientes ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$torpe = $myrow2['tope'];
	if(!$myrow2['tope']){
	$myrow2['tope']=1;
	}
	?>
                  <input name="numCliente" type="hidden" class="style12" id="numCliente" 
		value="<?php $expe=$myrow['numCliente'];
		$numeroExpediente=$myrow['numCliente'];
if($myrow['numCliente'] and !$_POST['nuevo']){ 
echo $myrow['numCliente']; 
} else  if($_POST['nuevo'] or !$myrow['numCliente']){
		echo $myrow2['tope']; 
}
?>"	size="10" readonly="" />
          </div></th>
        </tr>
        <tr>
          <th width="98" class="style12" scope="col"><div align="left" class="negro">Primer Nombre </div></th>
          <th width="302" class="style12" scope="col"><label>
              <div align="left">
                <input name="nombre1" type="text" class="camposmid" id="nombre1" value="<?php echo $myrow['nombre1']; ?>" size="30" />
              </div>
            </label></th>
			
		
			
          <th width="229" rowspan="12" align="center" valign="top" class="style12" scope="col"><p align="center">
              <?php if($myrow['ruta']!='images/' AND $myrow['ruta']){ ?>
            <a href="<?php 

echo '/sima/OPERACIONESHOSPITALARIAS/admisiones/'.$myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>"><img src="/sima/OPERACIONESHOSPITALARIAS/admisiones/<?php 

echo $myrow['ruta']; 

?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="169" height="152" border="0" /></a><a href="<?php 

echo $myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>"></a></p>
              <?php } else {?>


<img src="<?php echo '/sima/imagenes/siluetaHombre.jpg';?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="169" height="152" border="0" />
			  
			  
			  <?php } ?>
			  </th>
        </tr>
        <tr>
          <td class="negro">Segundo Nombre</td>
          <td class="style12"><input name="nombre2" type="text" class="camposmid" id="nombre2" value="<?php echo $myrow['nombre2']; ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="negro">Apellido Paterno</td>
          <td class="style12"><input name="apellido1" type="text" class="camposmid" id="apellido1" value="<?php echo $myrow['apellido1']; ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="negro">Apellido Materno</td>
          <td class="style12"><input name="apellido2" type="text" class="camposmid" id="apellido2" value="<?php echo $myrow['apellido2']; ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="negro">Fecha de Nacimiento</td>
          <td class="codigos"><input name="fechaNacimiento" type="text" class="camposmid" 
	  value="<?php if($myrow['fechaNacimiento']){

	  echo ltrim(cambia_a_normal($myrow['fechaNacimiento']));
	  } else {
	  echo '00/00/0000'; 
	  } ?>" size="10" />
              <label></label>
              <em><strong>Ejemplo: dd/mm/aaaa</strong></em></td>
        </tr>
        <tr>
          <td class="negro">Estado Civil Actual</td>
          <td class="style12"><select name="ecivil" class="camposmid" id="ecivil">
              <option value="<?php echo $myrow['ecivil']; ?>"><?php echo $myrow['ecivil']; ?></option>
              <option>---</option>
              <option value="menor">Menor</option>
              <option value="soltero">Soltero</option>
              <option value="casado">Casado</option>
              <option value="viudo">Viudo</option>
              <option value="Union Libre">Union Libre</option>
              <option value="otro">Otro</option>
          </select></td>
        </tr>
        <tr>
          <td class="negro">Sexo: </td>
          <td class="style12"><select name="sexo" class="camposmid" id="select">
              <option value="<?php echo $myrow['sexo']; ?>"><?php echo $myrow['sexo']; ?></option>
              <option>---</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
          </select></td>
        </tr>
        <tr>
          <td class="negro">Observaciones:</td>
          <td class="style12"><textarea name="observacionesSexo" cols="30" class="camposmid" id="observacionesSexo"><?php echo $myrow['observacionesSexo']; ?></textarea></td>
        </tr>
        <tr>
          <td class="negro">CURP</td>
          <td class="style12"><input name="curp" type="text" class="camposmid" id="curp" value="<?php echo $myrow['curp']; ?>" size="40" /></td>
        </tr>
        <tr>
          <td class="negro">Nomina</td>
          <td class="style12"><input name="numEmpleado" type="text" class="camposmid" id="ocupacion2" value="<?php echo $myrow['numEmpleado']; ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="negro">Matricula</td>
          <td class="style12"><input name="numMatricula" type="text" class="camposmid" id="ocupacion3" value="<?php echo $myrow['numMatricula']; ?>" size="30" /></td>
        </tr>
        <tr>
          <td class="negro">Es jubilado? </td>
          <td class="style12"><label><span class="negro">
            <input name="jubilado" type="checkbox" id="jubilado" value="si" <?php if($myrow['jubilado']=='si'){ echo 'checked=""';}?>/>
          </span></label></td>
        </tr>
      </table>
      <p>
        <?php } ?>
      </p>
	  
	  
	  
	  
	  <?php if($myrow['jubilado']=='si') {?>
      <table width="525" border="0" align="center" class="Estilo24">
        <tr bgcolor="#6633FF">
          <td colspan="5" bgcolor="#FFFFFF" class="normal" scope="col"><div align="center">Este paciente es Jubilado, estas son sus ayudas: </div></td>
        </tr>
        <tr bgcolor="#6633FF">
          <th width="40" class="style13" scope="col"><div align="left" class="blanco">
              <div align="center">N</div>
          </div></th>
          <th width="239" class="style13" scope="col"><div align="left" class="blanco">Seguro</div></th>
          <th width="124" class="style13" scope="col"><div align="left" class="blanco">Observaciones</div></th>
          <th width="52" class="style13" scope="col"><div align="left" class="blanco">% Part</div></th>
          <th width="48" class="style13" scope="col"><div align="left" class="blanco">% Seg</div></th>
        </tr>
        <?php   
 $sSQL= "Select distinct * From porcentajeJubilados 
 where numeroE='".$_POST['numeroEx']."'";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$alma=$myrow['almacen'];
$code=$myrow['codigo'];
$sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);


   $sSQL5="SELECT *
FROM
clientes
WHERE entidad='".$entidad."' AND
numCliente = '".$myrow['seguro']."'
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

  
  $sSQL61="SELECT *
FROM
  existencias
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result61=mysql_db_query($basedatos,$sSQL61);
  $myrow61 = mysql_fetch_array($result61);
  if($myrow61['almacen']){
  $estilo='style13';
  $color='#0000FF';
  } else  {
  $color = '#FFFFFF';
  $estilo='style12';
  }
?>
        <tr>
          <td bgcolor="<?php echo $color?>" class="style12"><div align="center" class="normal"><?php echo $bandera;?></div></td>
          <td bgcolor="<?php echo $color?>" class="style12"><div align="left" class="normal"><?php echo $myrow5['nomCliente'];?></div>
              <span class="style7">
              <label></label>
              </span>
              <div align="center"></div></td>
          <td bgcolor="<?php echo $color?>" class="normal"><?php 
		
		echo $myrow['observaciones'];

		?>
              </span></td>
          <td bgcolor="<?php echo $color?>" class="precio1" align="center"><?php 
		echo 100-$myrow['porcentaje'];
		

		?></td>
          <td bgcolor="<?php echo $color?>" class="precio2" align="center"><?php 
		
		echo $myrow['porcentaje'];

		?></td>
        </tr>
        <?php }?>
      </table>
	  <p>
	    <?php } ?>
      </p>
	  <p>
	    <?php if($myrow['numMatricula']) {?>
</p>
	  <table width="540" border="0" align="center" class="Estilo24">
        <tr bgcolor="#6633FF">
          <td colspan="4" bgcolor="#FFFFFF" class="normal" scope="col"><div align="center">Cargos a la matricula </div></td>
        </tr>
        <tr bgcolor="#6633FF">
          <th width="34" class="style13" scope="col"><div align="left" class="blanco">
              <div align="center">N</div>
          </div></th>
          <th width="66" class="style13" scope="col"><div align="left" class="blanco">Fecha</div></th>
          <th width="319" class="style13" scope="col"><div align="left" class="blanco">Seguro</div></th>
          <th width="103" bgcolor="#6633FF" class="style13" scope="col"><div align="left" class="blanco">Importe</div>            <div align="left" class="blanco"></div></th>
        </tr>
        <?php   
 $sSQL= "Select  * From clientesInternos 
 where numeroE='".$_POST['numeroEx']."' 
 and
 statusCaja='pagado'
";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$alma=$myrow['almacen'];
$code=$myrow['codigo'];
$sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);


   $sSQL5="SELECT *
FROM
clientes
WHERE entidad='".$entidad."' AND
numCliente = '".$myrow['seguro']."'
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

  
  $sSQL61="SELECT *
FROM
  existencias
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result61=mysql_db_query($basedatos,$sSQL61);
  $myrow61 = mysql_fetch_array($result61);
  if($myrow61['almacen']){
  $estilo='style13';
  $color='#0000FF';
  } else  {
  $color = '#FFFFFF';
  $estilo='style12';
  }
?>
        <tr>
          <td bgcolor="<?php echo $color?>" class="style12"><div align="center" class="normal"><?php echo $bandera;?></div></td>
          <td bgcolor="<?php echo $color?>" class="style12"><span class="normal"><?php echo cambia_a_normal($myrow['fecha']);?></span></td>
          <td bgcolor="<?php echo $color?>" class="style12"><div align="left" class="normal"><?php echo $myrow5['nomCliente'];?></div>
              <span class="style7">
              <label></label>
              </span>
              <div align="center"></div></td>
          <td bgcolor="<?php echo $color?>" class="normal"><?php 
		echo 100-$myrow['porcentaje'];
		

		?></td>
        </tr>
        <?php }?>
      </table>
	  <?php } ?>
<p>
        <label>
        <input name="continue" type="submit" id="continue" value="Continuar" />
        </label>      
        </p>
    </div>
    </form>
  <p>
    
    
    
    
    <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/pacientesx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
      </p>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
