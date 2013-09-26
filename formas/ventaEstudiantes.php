<?php require('/configuracion/funciones.php');




if($_POST['eFisico']){
$exp='si';
$fechaSol=$fecha1;
}





if($_GET['almacen']){
$ALMACEN=$_GET['almacen'];
} else {
$_GET['almacen']=$ALMACEN;
}
?>

<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=600,height=700,scrollbars=YES") 
} 
</script> 


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

  <!-- librer?a principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librer?a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo --> 
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
   window.open(URL,"ventana20","width=900,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
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



<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
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














if($_POST['cargos']){
		
if( $_POST['paciente'] and $_POST['credencial']>0 and $_POST['seguro']!=NULL){		
		
		    $q4 = "

    INSERT INTO contadorCI(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorCI where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT
    contador
    FROM contadorCI
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $numSolicitud= $myrow['contador'];
	
		
		
	

                
                
        



//REVISANDO QUE NO ESTE BLOQUEADA LA CUENTA
$sSQL455= "Select * from pacientesCandados where (entidad='".$entidad."' and numeroEx='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."')
OR
(entidad='".$entidad."' and numeroEx='".$_POST['numeroEx']."' )
";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['numeroEx']){ ?>
<script>
window.alert("Oops! Lo sentimos, la cuenta del paciente: <?php echo $myrow455['nombreCompleto'];?> esta bloqueada! por este motivo: <?php echo $myrow455['observaciones'];?>, le sugerimos cargar a otro seguro o arreglar su situacion en admisiones!! Gracias..");
window.close();
</script>


<?php 
}



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




















//*****************cierro orden*****************


$sSQL45= "Select * from clientesInternos where keyClientesInternos ='".$_GET['keyClientesInternos']."'";
$result45=mysql_db_query($basedatos,$sSQL45);
$myrow45 = mysql_fetch_array($result45);



if($myrow7a['numMatricula']){
$sSQL7c= "Select * from alumnos where   matricula='".$_POST['credencial']."'    ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);

$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$_POST['seguro']."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);

if($myrow7ab['seguro'] and $myrow7c['matricula']){

$despliegaEC='si';
$estudiante='si';
}else{
$despliegaEC=NULL;
$estudiante=NULL;
}
}
//***************************************






$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['clientePrincipal']){
$cP=trim($myrow455['clientePrincipal']);
}else{
$cP='';
}


$d='Ingreso el paciente: '.$_POST['paciente'].', con el numero de expediente: '.$_POST['numeroEx'].', y con el seguro: '.$_POST['seguro'].', '.$_POST['nomSeguro'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$d."','".$ALMACEN."','".$ALMACEN."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

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
peso,dx,empleado,expediente,fechaSolicitud,despliegaEC,naturaleza,estudiante,descuento,statusCortesia,activaBeneficencia,porcentaje,
tipoBeneficencia,llenadoEspecial,autoriza,numSolicitud,limiteCredito
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
'".$_POST['empleado']."','".$exp."','".$fechaSol."','".$despliegaEC." ','D','".$estudiante."','".$_POST['descuento']."','".$_POST['cortesia']."',
    '".$statusBeneficencia."','".$porcentaje."','".$_POST['tipoBeneficencia']."','".$llenadoEspecial."','".$usuario."','".$numSolicitud."',
        '".$myrow7ab['cantidad']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();






$sSQL1= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
numSolicitud='".$numSolicitud."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); 
$keyClientesI=$myrow1['keyClientesInternos'];
$leyenda='SE GENERO LA ORDEN #'.$numSolicitud;




?>




<script>
javascript:nueva('/sima/cargos/agregaArticulos.php?numeroE=<?php echo $myrow1['numeroE']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacen=<?php echo $ALMACEN; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow1['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>&folioVenta=<?php echo $myrow1['folioVenta']; ?>&load=activated','ventanaSecundaria20','1000','800','yes');
close();
</script>
<?php 

//**********************CIERRO CLIENTES AMBULATORIOS A FARMACIA*********************
}else{
    echo '<script>window.alert("FAVOR DE LLENAR LOS CAMPOS!");</script>';
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


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=650,height=700,scrollbars=YES") 
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

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />


</head>













<body>
<?php 




$sSQL39= "SELECT *
FROM
almacenes
where 
entidad='".$entidad."' AND
almacen='".$ALMACEN."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

?>
    

    
<div>
  <form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>">
    <p><span  align="center">Departamento: <?php echo $myrow39['descripcion']; ?></span></p>
    <table width="635" class="table-forma">

      <tr >
        <td width="4" >&nbsp;</td>
        <td width="94" ># MATRICULA</td>
        <input name="credencial" type="hidden">
        <td colspan="3"><div align="left">
 <strong>
  
            </strong>
            <?php if($myrow4['credencial']){ ?>
            <input name="paciente" type="text"  id="paciente" value="<?php 
		echo $myrow4['paciente'];
		  ?>" size="40"  />
            <?php } else { ?>
            <input name="paciente" type="text"  id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="40"   />
            <a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a><a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a>
            <!-- 
          <input name="M22" type="button" class="style15" id="M22"  onclick="javascript:ventanaSecundaria6(
		'/sima/cargos/listaPacientesPrepago.php?campoDespliega=<?php echo "paciente"; ?>&forma=<?php echo "form1"; ?>&campo=<?php echo "numeroEx"; ?>&fechaNac=<?php echo "keyClientesInternos"; ?>&edad=<?php echo "edad"; ?>')" value="PP" />
        </div></th>-->
            <?php } ?>
            <br />
                 
        </div></td>
        
        
        
        </label></td>
      </tr>
      <tr >
        <td height="45" >&nbsp;</td>
        <td >Seguro
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></td>
        <td colspan="4"><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        <span >(Exclusivo Aseguradoras)</span></td>
      </tr>
      
      
      
      







<table width="427" border="0" align="center">
         <tr>
           <td width="166"><div align="center">
             <input name="cargos" type="submit" src="/sima/imagenes/btns/new_cargos2.png" id="hacerCargos" value="Agregar Nota de Cargo" />
           </div></td>
           <td width="93"><div align="center"></div></td>
        
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
			return "/sima/cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
    
    
    
    
  <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("credencial")[0].value = id;
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
			return "/sima/cargos/estudiantesx.php?entidad=<?php echo $entidad;?>&almacen=<?php echo $_GET['almacen'];?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>

