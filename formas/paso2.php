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


$sSQL4c= "Select * from pacientes where entidad='".$entidad."' and numCliente='".$_POST['numCliente']."'";
$result4c=mysql_db_query($basedatos,$sSQL4c);
$myrow4c = mysql_fetch_array($result4c);
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
<h1 align="center" class="titulos">Venta al P&uacute;blico</h1>




<div>
<form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>">
    <table width="811" border="0" align="center" class="style7">
      <tr>
        <th width="1" class="Estilo24" scope="col">&nbsp;</th>
        <th colspan="3" bgcolor="#660066" class="blancomid" scope="col"><?php echo '[ '.$myrow39['descripcion'].' ]'; ?></th>
      </tr>
     
      
     
      <tr>
        <th class="Estilo24" scope="col"><div align="left"></div></th>
        <th bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"></div></th>
        <th width="657" colspan="2" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">
		
		
		<?php if($myrow4['numeroE']){ ?>
		          <input name="numeroEx" type="hidden" class="Estilo24" id="numeroEx" value="<?php echo $myrow4['numeroE'];?>" readonly="" />
		
		<?php } else { ?>
          <input name="numeroEx" type="hidden" class="Estilo24" id="numeroEx" value="<?php if($_POST['numeroEx'] and !$_POST['nuevo']){ echo $_POST['numeroEx'];}?>" readonly="" />
		  <?php } ?>
		  
		 
		  
          <input name="edad" type="hidden" class="Estilo24" id="edad" value="<?php 
		  if($_POST['edad'] and !$_POST['nuevo']){
		  echo $_POST['edad'];
		  } else if($myrow33['edad'] and !$_POST['nuevo']){
		  echo $myrow33['edad']; 
		  }
		  ?>" size="2" maxlength="2" onKeyPress="return checkIt(event)"/>
          <label>
          <input name="fechaNac" type="hidden" class="style7" id="fechaNac" size="10"  readonly="" value="<?php 
		  if($_POST['fechaNac'] and !$_POST['fechaNac']){
		  echo $_POST['fechaNac'];
		  } 
		  ?>"/>
          </label>
</div></th>
      </tr>

      <tr>
        <th width="1" class="Estilo24" scope="col">&nbsp;</th>
        <th width="139" valign="middle" bgcolor="#FFCCFF"  scope="col"><div align="left" class="negromid"><strong>Nombre Completo</strong></div></th>
        <th colspan="2" valign="top" bgcolor="#FFCCFF" class="negro" scope="col"><div align="left"><strong>
  

          <?php 
		echo $myrow4c['nombreCompleto'];
		  ?>

      </tr>
      
     
      <tr valign="middle">
        <th width="1" class="negro" scope="col">&nbsp;</th>
        <th scope="col"><div align="left" class="negromid"><strong>Compa&ntilde;&iacute;a</strong>
          <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </div></th>
        <th colspan="2" valign="top" scope="col">
        <div align="left">
        <div id="lista">
        
        <input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="78"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        
          (Exclusivo Aseguradoras)</div>
        </div>
        </th>
      </tr>
   
     
    
    
            

            
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFCCFF" class="negromid">Empleado        </td>
        <td colspan="2" bgcolor="#FFCCFF" ><input name="empleado" type="text" class="camposmid" id="empleado" 
	value="<?php 
	if($_POST['empleado'] and !$_POST['nuevo']){
	echo $_POST['credencial'];
	} else if($myrow33['credencial']){
	echo $myrow33['credencial']; 
	}
	?>" size="60" /></td>
      </tr>
      <tr>
        <th width="1" class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFCCFF" class="negromid">N&deg; Credencial/N&oacute;mina: </td>
        <td colspan="2" bgcolor="#FFCCFF" ><input name="credencial" type="text" class="camposmid" id="credencial" 
	value="<?php 
	if($_POST['credencial'] and !$_POST['nuevo']){
	echo $_POST['credencial'];
	} else if($myrow33['credencial']){
	echo $myrow33['credencial']; 
	}
	?>" size="60" />        </td>
      </tr>
   
  
    
    
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid">Status Paciente</td>
        <td colspan="2" class="Estilo24"><label>
          <select name="statusPaciente" id="statusPaciente">
          <option value="">---</option>
            <option
            <?php if($_POST['statusPaciente']=='DH')echo 'selected=""';?>
             value="DH">DH</option>
            <option
            <?php if($_POST['statusPaciente']=='BE')echo 'selected=""';?>
             value="BE">BE</option>
            <option
            <?php if($_POST['statusPaciente']=='BH')echo 'selected=""';?>
             value="BH">BH</option>
            <option
            <?php if($_POST['statusPaciente']=='BI')echo 'selected=""';?>
             value="BI">BI</option>
          </select>
          
        </label></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid">Expediente</td>
        <td colspan="2" class="Estilo24"><input name="eFisico" type="checkbox" id="eFisico" value="si" <?php if($myrow33['cortesia']=='si'){echo 'checked=""'; }?>/>
          (En caso de solicitar expediente fisico)</td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid">Cortesia</td>
        <td colspan="2" class="Estilo24"><label>
<input name="cortesia" type="checkbox" id="cortesia" value="si" <?php if($myrow33['cortesia']=='si'){echo 'checked=""'; }?>/>
        </label></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFCCFF" class="negromid">Observaciones</td>
        <td colspan="2" bgcolor="#FFCCFF" ><textarea name="observaciones" cols="60" rows="3" wrap="virtual" class="camposmid" id="observaciones"></textarea></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid">Dependencia </td>
        <td colspan="2" class="Estilo24"><input name="dependencia" type="text" class="camposmid" id="dependencia" 
	value="<?php 
	if($_POST['dependendia'] and !$_POST['nuevo']){
	echo $_POST['dependendia'];
	} else if($myrow33['dependendia']){
	echo $myrow33['dependendia']; 
	}
	?>" size="60" /></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid">&nbsp;</td>
        <td colspan="2" class="Estilo24">&nbsp;</td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid">&nbsp;</td>
        <td colspan="2" class="Estilo24"><div align="left"><span class="negromid">Exclusivo para Seguros</span></div></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid"># P&oacute;liza</td>
        <td colspan="2" class="Estilo24"><label>
          <input type="text" name="numPoliza" id="numPoliza" />
        </label></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="negromid"># Siniestro</td>
        <td colspan="2" class="Estilo24"><input type="text" name="numSiniestro" id="numSiniestro" /></td>
      </tr>

   
	  
	  
	  
      <tr>
        <th height="36" colspan="5" class="Estilo24" scope="col"><label>
<?php 
$sSQL1= "Select * From clientesInternos WHERE usuario = '".$usuario."' order by keyClientesInternos DESC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
	<input name="fechaSolicitud" type="hidden" class="style7" id="nuevo" value="<?php echo $_GET['fechaSolicitud'];?>" />
	<input name="horaSolicitud" type="hidden" class="style7" id="nuevo" value="<?php echo $_GET['horaSolicitud'];?>" />
	<div align="center"></div>
          </label>
          <div align="center"></div></th>
      </tr>
	  
	  
	  
	  
	  
	  
	  
	  <?php //Abrir campos almacenes 
	  
	  $sSQL1= "Select keyC From camposAlmacenes where 
 id_almacen='".$ALMACEN."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  ?>
	  
	  <?php //cierra campos almacenes ?>
	  
	  
	  
	  
      <tr>
        <th height="36" colspan="5" class="Estilo24" scope="col"><label>

          </label>
          <label>


			</label>          
			

			
			
		  <div align="center"><strong>
            <input name="almacenImporte" type="hidden" id="almacenImporte" value="<?php echo $_POST['almacenImporte']; ?>"/>
            </strong>
            <input name="ali" type="hidden" id="ali" value="<?php echo $ali; ?>"/>
            <input name="pacientes" type="hidden" id="pacientes" value="<?php echo $_POST['paciente']; ?>" />
            <input name="PACIENTED" type="hidden" id="PACIENTED" value="<?php echo $_POST['paciente']; ?>" />
            <input name="FOLIOD" type="hidden" id="PACIENTED" value="<?php echo $Folio[0]; ?>" />
            <input name="keyClientesI" type="hidden" id="FOLIOD" value="<?php echo $keyClientesI; ?>" />
            <input name="pagina" type="hidden" id="keyClientesI" value="<?php echo $pagina; ?>" />
            <input name="nOrden" type="hidden" id="pagina" value="<?php echo $nOrden; ?>" />
		    <input name="keyClientesInternos" type="hidden" id="nOrden" value="<?php echo $_GET['keyClientesInternos']; ?>" />
		  </div>
          <div align="center"></div></th></tr>
  </table>

  
  <p>
    <?php //Abrir campos almacenes 
 $sSQL14= "Select codigoCampo From campos,camposAlmacenes where 
 camposAlmacenes.id_almacen='".$ALMACEN."' 
 and
 campos.keyC=camposAlmacenes.keyC";
 $result14=mysql_db_query($basedatos,$sSQL14); 
 while($myrow14 = mysql_fetch_array($result14)){
 $codigoCampo[]=$myrow14['codigoCampo'];
 }
	  ?>
  </p>
	
	
	
	
	<?php if($codigoCampo[0]){ ?>
	
 <table width="811" border="3" align="center" class="style7">


<?php if($codigoCampo[0]=='cedad'){ ?>
      <tr>
        <th height="21" colspan="2" class="Estilo24" scope="col"><div align="center">Departamento: <?php echo $ALMACEN;?></div></th>
      </tr>
      <tr>
	  
        <th height="21" bgcolor="#FFCCFF" class="Estilo24" scope="col">
		
		<div align="left">Edad</div></th>
        <th width="598" height="21" bgcolor="#FFCCFF" class="Estilo24" scope="col"> 
            <div align="left">
              <input name="edad" type="text" class="Estilo24" id="edad" 
	value="<?php 

	if($_POST['edad'] and !$_POST['nuevo']){
	echo $_POST['credencial'];
	} else if($myrow33['edad']){
	echo $myrow33['edad']; 
	}
	?>" size="3" />
            </div>		</th>
      </tr>
	   <?php } ?>
	  
<?php if($codigoCampo[1]=='cmedico'){ ?>
      <tr>
	 
        <th height="21" class="Estilo24" scope="col"><div align="left">M&eacute;dico</div></th>
        <th height="21" class="Estilo24" scope="col"><div align="left">
          <input name="medico" type="text" class="Estilo24" id="medico" 
	value="<?php 
	if($_POST['medico'] and !$_POST['nuevo']){
	echo $_POST['medico'];
	} else if($myrow33['medico']){
	echo $myrow33['medico']; 
	}
	?>" />
        </div></th>
	  </tr>
	  <?php } ?>
	  
	  
	  <?php if($codigoCampo[2]=='cdiagnostico'){ ?>
      <tr>
        <th height="36" bgcolor="#FFCCFF" class="Estilo24" scope="col">
	
		<div align="left">Diagn&oacute;stico</div></th>
        <th height="36" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">
          <textarea name="diagnostico" cols="60" wrap="off" class="Estilo24" id="diagnostico"><?php 
	if($_POST['diagnostico'] and !$_POST['nuevo']){
	echo $_POST['diagnostico'];
	} else if($myrow33['diagnostico']){
	echo $myrow33['diagnostico']; 
	}
	?>
          </textarea>
        </div></th>
      </tr>
	  <?php } ?>
	  
	  
	   <?php if($codigoCampo[3]=='ctelefono'){ ?>
      <tr>
        <th height="21" class="Estilo24" scope="col"><div align="left">Tel&eacute;fono</div></th>
        <th height="21" class="Estilo24" scope="col"><div align="left">
          <input name="telefono" type="text" class="Estilo24" id="telefono" 
	value="<?php 
	if($_POST['telefono'] and !$_POST['nuevo']){
	echo $_POST['telefono'];
	} else if($myrow33['telefono']){
	echo $myrow33['telefono']; 
	}
	?>" />
        </div></th>
      </tr>
	<?php } ?>
	  
	  
      <tr>
        <th height="17" class="Estilo24" scope="col"><div align="left"></div></th>
        <th height="17" class="Estilo24" scope="col"><div align="left"></div></th>
      </tr>
    </table>
	 
	   <p>&nbsp;</p>
	   <p>&nbsp;</p>
       
       
        <?php } ?>
       
       
       
       
       
       
       
       	  <?php //Abrir campos almacenes 
	  
  $sSQL1a= "Select registroUrgencias From almacenes where entidad='".$entidad."'
	  and
 almacen='".$ALMACEN."' 
";
$result1a=mysql_db_query($basedatos,$sSQL1a); 
$myrow1a = mysql_fetch_array($result1a);
if($myrow1a['registroUrgencias']=='si'){ 
	  ?>
       	  <table width="631" align="center" cellpadding="0" cellspacing="0" class="style7" style="border: 1px solid #000000;">
            <tr valign="middle" bordercolor="#FFFFFF" bgcolor="#DFDFDF" class="catalogo">
              <td height="23" colspan="3" bgcolor="#660066"><div align="center" class="blancomid">Datos del Paciente </div></td>
            </tr>

  
            <tr valign="middle" class="catalogo">
              <td width="13" bgcolor="#FFCCFF" class="negromid">&nbsp;</td>
              <td width="109" bgcolor="#FFCCFF" class="negromid">Tipo de Accidente</td>
              <td width="501" bgcolor="#FFCCFF"><label>
                <input name="tipoAccidente" type="text" class="camposmid" id="tipoAccidente"
		   value="" size="60" />
              </label></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td>&nbsp;</td>
            
              <td>Fecha Accidente </td>
              <td><label>
                <input name="fechaAccidente" type="text" class="camposmid" id="fechaAccidente" value="" />
              </label></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td bgcolor="#FFCCFF" class="negromid">&nbsp;</td>
              <td bgcolor="#FFCCFF" class="negromid">Hora Accidente </td>
              <td bgcolor="#FFCCFF"><label>
                <input name="horaAccidente" type="text" class="camposmid" id="horaAccidente" value="" />
              </label></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td>&nbsp;</td>
              <td>Lugar Accidente </td>
              <td><label>
                <textarea name="lugarAccidente" cols="40" class="style7" id="lugarAccidente"></textarea>
              </label></td>
            </tr>
   
   
   
   
            <tr valign="middle" class="catalogo">
              <td bgcolor="#FFCCFF" class="negromid">&nbsp;</td>
              <td bgcolor="#FFCCFF" class="negromid">&iquest;C&oacute;mo lleg&oacute; al Hospital? </td>
              <td bgcolor="#FFCCFF">
<textarea name="llegoHospital" cols="40" rows="4" wrap="physical" class="camposmid" id="llegoHospital"></textarea></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td class="negromid">&nbsp;</td>
              <td class="negromid">&iquest;Avis&oacute; al Ministerio? </td>
              <td><label>
                <input name="ministerio" type="checkbox" id="ministerio" value="si" <?php 
		  if($_POST['ministerio'])echo 'checked=""';
		  ?> />
              </label></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td bgcolor="#FFCCFF" class="negromid">&nbsp;</td>
              <td bgcolor="#FFCCFF" class="negromid">Motivo Consulta </td>
              <td bgcolor="#FFCCFF"><label>
                <textarea name="motivoConsulta" cols="40" wrap="virtual" class="style7" id="motivoConsulta"></textarea>
              </label></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td class="negromid">&nbsp;</td>
              <td class="negromid">Alergias (Si Tiene) </td>
              <td><textarea name="tiposAlergias" cols="40" class="camposmid" id="tiposAlergias"></textarea></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td bgcolor="#FFCCFF">&nbsp;</td>
              <td bgcolor="#FFCCFF"><div align="center" class="negromid">
                  <div align="right">T </div>
              </div></td>
              <td bgcolor="#FFCCFF"><label>
                <input name="alergiaT" type="checkbox" id="alergiaT" value="si" <?php 
		  if($_POST['alergiaT'])echo 'checked=""';
		  ?>  />
              </label></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td>&nbsp;</td>
              <td><div align="center" class="negromid">
                  <div align="right">P</div>
              </div></td>
              <td><input name="alergiaP" type="checkbox" id="alergiaP" value="si" <?php 
		  if($_POST['alergiaP'])echo 'checked=""';
		  ?>/></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td bgcolor="#FFCCFF">&nbsp;</td>
              <td bgcolor="#FFCCFF"><div align="center" class="negromid">
                  <div align="right">R</div>
              </div></td>
              <td bgcolor="#FFCCFF"><input name="alergiaR" type="checkbox" id="alergiaR" value="si" <?php 
		  if($_POST['alergiaR'])echo 'checked=""';


		  ?>/></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td>&nbsp;</td>
              <td><div align="center" class="negromid">
                  <div align="right">PA</div>
              </div></td>
              <td><input name="alergiaPA" type="checkbox" id="alergiaPA" value="si" <?php 
		  if($_POST['alergiaPA'])echo 'checked=""';
		  ?>/></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td bgcolor="#FFCCFF">&nbsp;</td>
              <td bgcolor="#FFCCFF" class="negromid">Peso</td>
              <td bgcolor="#FFCCFF"><label>
                <input name="peso" type="text" class="camposmid" id="peso" value="<?php if($_POST['peso'])echo $_POST['peso'];?>"/>
              </label></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td>&nbsp;</td>
              <td><div align="left" class="negromid">Diagn&oacute;stico Paciente </div></td>
              <td><div align="left">
                  <textarea name="dx" cols="50" wrap="virtual" class="combosmid" id="dx"></textarea>
              </div></td>
            </tr>
            <tr valign="middle" class="catalogo">
              <td colspan="3"></label></td>
            </tr>
          </table>
       	  <?php } ?>
<p><br />
              </p>
<table width="347" border="0" align="center">
         <tr>
           <td width="150"><div align="center">
             <input name="cargos" type="image" src="/sima/imagenes/btns/agregacargos.png" id="hacerCargos" value="Agregar Nota de Cargo" />
           </div></td>
           <td width="43"><div align="center"></div></td>
           <td width="140"><div align="center">
             <?php //cierra campos almacenes ?>
             <input name="nuevo" type="image" src="/sima/imagenes/btns/cleanform.png"  id="nuevo2" value="Nuevo" />
           </div></td>
         </tr>
       </table>
	   <p>&nbsp;</p>
<div align="center"></div>
  <p>&nbsp;</p>
</form>

 </div>



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
</body>
</html>
