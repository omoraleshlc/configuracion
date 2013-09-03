<?php 
if($_GET['almacen']){
$ALMACEN=$_GET['almacen'];
} else {
$_GET['almacen']=$ALMACEN;
}

?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
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




 <?php include("/configuracion/funciones.php"); ?>

<?php 
$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenio=new validaConvenios();
$verificaSaldos=new verificaSeguro();

$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();

$seguro=$traeSeguro->traeSeguro($numeroPaciente,$nCuenta,$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);

if($_POST['cargos']){
if(verificaSeguro1::verificaSaldos1($cantidad,$iva,$priceLevel,$dia,$fecha1,$hora1,$_POST['seguro'],$_POST['credencial'],$leyenda,$basedatos)==TRUE){
//$verificaSaldos->verificaSaldos($dia,$fecha1,$hora1,$_POST['seguro'],$_POST['credencial'],$basedatos);

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
$q = "UPDATE clientesInternos set 
statusCaja='pagado',
expediente='si',
medico='".$_POST['medico']."',
seguro='".$_POST['seguro']."',
autoriza='".$usuario."',
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
telefono='".$_POST['telefono']."'
WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error(); 
}


?>

<script language="JavaScript" type="text/javascript">
javascript:ventanaSecundaria20('/sima/cargos/agregaArticulos.php?almacen=<?php echo $_GET['almacen']; ?>&numeroE=<?php echo $_POST['numeroEx']; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $_GET['almacen']; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>');

opener.location.reload(true);
self.close();

</script>
<?php





} else {
if($_POST['cargos'] AND $_POST['numeroEx'] AND $_POST['paciente']){
$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono
) values (
'".$_POST['numeroEx']."','".$nCuenta."',
'".$_POST['medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_POST['seguro']."',
'".$_POST['autoriza']."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$status."',
'".$_POST['cita']."',
'".$ALMACEN."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".strtoupper($_POST['observaciones'])."','".$_POST['edad']."','externo',
'".$nOrden."','request','".$_POST['dependencia']."','".$entidad."','".$_POST['diagnostico']."','".$_POST['telefono']."'

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
$leyenda='SE GENERO LA ORDEN #'.$myrow1['keyClientesInternos'];
?>


<script type="text/vbscript">
msgbox "SE GENERO LA ORDEN # <?php echo $myrow1['keyClientesInternos']; ?>!"
</script>



<script>
javascript:ventanaSecundaria20('/sima/cargos/agregaArticulos.php?numeroE=<?php echo $myrow1['numeroE']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacen=<?php echo $ALMACEN; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow1['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>');
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








<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.Estilo24 {font-size: 12px}
-->
</style>

<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style15 {font-size: 10px}
.style15 {font-size: 10px}
-->
</style>
<head>
<style type="text/css" media="screen">
			body {
				font: 11px arial;
			}
			.suggest_link {
				background-color: #FFFFFF;
				padding: 2px 6px 2px 6px;
			}
			.suggest_link_over {
				background-color: #3366CC;
				padding: 2px 6px 2px 6px;
			}
			#search_suggest {
	position: absolute;
	background-color: #FFFFFF;
	text-align: left;
	border: 1px solid #000000;
	left: 748px;
	top: 60px;
			}
			.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}		
		.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
</style>






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
<h1 align="center">Venta al P&uacute;blico</h1>





<form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>">
    <table width="811" border="0" align="center" class="style7">
      <tr>
        <th width="7" class="Estilo24" scope="col">+</th>
        <th colspan="3" bgcolor="#660066" class="style14" scope="col"><?php echo '[ '.$myrow39['descripcion'].' ]'; ?></th>
      </tr>
     
      
     
      <tr>
        <th class="Estilo24" scope="col"><div align="left"></div></th>
        <th bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"></div></th>
        <th width="643" colspan="2" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">
		
		
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
        <th width="7" class="Estilo24" scope="col">&nbsp;</th>
        <th width="137" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>NOMBRE COMPLETO </strong></div></th>
        <th colspan="2" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>
            <label> </label>
            </strong>
			
			
			 <?php if($myrow4['numeroE']){ ?>
			            <input name="paciente" type="text" class="style121" id="paciente" value="<?php 
		echo $myrow4['paciente'];
		  ?>" size="60"  />   
			 <?php } else { ?>
            <input name="paciente" type="text" class="style121" id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="60"   />                
          <span class="style12">
          <input name="M2" type="button" class="style12" id="M2"  onclick="javascript:ventanaSecundaria6(
		'/sima/cargos/ventanaBuscaExpediente.php?campoDespliega=<?php echo "paciente"; ?>&forma=<?php echo "form1"; ?>&campo=<?php echo "numeroEx"; ?>&fechaNac=<?php echo "fechaNac"; ?>&edad=<?php echo "edad"; ?>')" value="E" />
          <span class="Estilo25"><span class="style121"><a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span> </span><span class="style15">
          <input name="M22" type="button" class="style15" id="M22"  onclick="javascript:ventanaSecundaria6(
		'/sima/cargos/listaPacientesPrepago.php?campoDespliega=<?php echo "paciente"; ?>&forma=<?php echo "form1"; ?>&campo=<?php echo "numeroEx"; ?>&fechaNac=<?php echo "keyClientesInternos"; ?>&edad=<?php echo "edad"; ?>')" value="PP" />
          </span><span class="style15">
          <input name="paquete" type="submit" class="style15" id="paquete"  onclick="javascript:ventanaSecundaria6(
		'/sima/cargos/ventanaCargaArticulosPaquetes.php?campoDespliega=<?php echo "paciente"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "numeroEx"; ?>&amp;fechaNac=<?php echo "fechaNac"; ?>&amp;edad=<?php echo "edad"; ?>')" value="EPAQ" />
          </span></div></th>
		  <?php } ?>
      </tr>
      
     
      <tr>
        <th width="7" class="Estilo24" scope="col">&nbsp;</th>
        <th scope="col"><div align="left"><strong>Compa&ntilde;&iacute;a</strong></div></th>
        <th colspan="2" scope="col"><div align="left">
            <div id="lista">
              <input name="seguro" type="hidden" class="Estilo24" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
              <input name="agregarCargos3" type="button" class="Estilo24" id="agregarCargos3"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/agregarSeguros.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="S" />
              <input name="nomSeguro" type="text" class="Estilo24" id="nomSeguro" size="80" readonly="" 
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
            </div>
        </div></th>
      </tr>
   
     
    
      <tr>
        <th width="7" class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFCCFF" class="Estilo24">N&deg; Credencial/N&oacute;mina: </td>
        <td colspan="2" bgcolor="#FFCCFF" class="Estilo24"><input name="credencial" type="text" class="Estilo24" id="credencial" 
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
        <td class="Estilo24">Cortesia</td>
        <td colspan="2" class="Estilo24"><label>
<input name="cortesia" type="checkbox" id="cortesia" value="si" <?php if($myrow33['cortesia']=='si'){echo 'checked=""'; }?>/>
        </label></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFCCFF" class="Estilo24">Observaciones</td>
        <td colspan="2" bgcolor="#FFCCFF" class="Estilo24"><textarea name="observaciones" cols="60" rows="3" class="Estilo24" id="observaciones"></textarea></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td class="Estilo24">Dependencia		</td>
        <td colspan="2" class="Estilo24"><input name="dependencia" type="text" class="Estilo24" id="dependencia" 
	value="<?php 
	if($_POST['dependendia'] and !$_POST['nuevo']){
	echo $_POST['dependendia'];
	} else if($myrow33['dependendia']){
	echo $myrow33['dependendia']; 
	}
	?>" size="60" /></td>
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
          <div align="center">

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
    <p>&nbsp;</p>
	
	
	
	
	
	
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
	   <div align="center">
	     <?php //cierra campos almacenes ?>
	     
	     
	     
	     
	     
	     
	     
	     
	     
	     
	     
	     
	     
	     
	     
	     <span class="Estilo24">
         <input name="nuevo" type="submit" class="Estilo24" id="nuevo2" value="Nuevo" />
         <input name="cargos" type="submit" class="Estilo24" id="cargos" value="Agregar Nota de Cargo" />
         </span>
  </div>
	   <p>&nbsp;</p>
</form>
  
  
 </body>
</html>
