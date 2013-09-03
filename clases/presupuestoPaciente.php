
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
                alert("Por Favor, escribe el depósito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el médico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el límite que desees asignar!")   
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
        status = "Este campo sólo acepta números."
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
var agree=confirm("Está Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>

<?php



//***********************************IMPRIMIR FOLIO DE VENTA
$sSQL333= "SELECT 
MAX(contador)+1 as contador
FROM contadorInternos
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333); 


if(!$myrow333['contador']){
$myrow333['contador']=1;
}
$myrow333['folioVentas']='I'.$myrow333['contador'];
//*****************************************************************




$agrega2 = "INSERT INTO presupuesto (
keyPre,entidad,usuarios,fecha,tipoPaciente,seguro,clientePrincipal,procedimiento,nombrePaciente,honDescripcion,honPrecio,cuartoDescripcion,
cuartoPrecio,anesDescripcion,anesPrecio,farmaDescripcion,farmaPrecio,labDescripcion,labPrecio,rxDescripcion,rxPrecio,qxDescripcion,qxPrecio,
otroDescripcion,otrosPrecio
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
'".strtoupper($_POST['parentescoResponsable'])."','interno','".$_POST['edad']."','".$entidad."','".$myrow333['folioVentas']."','".$myrow455['clientePrincipal']."')";
mysql_db_query($basedatos,$agrega2);
echo mysql_error();


//**************************************************************************************



$leyenda="(SE GENERO EL PRESUPUESTO #".$myrow9['folioVenta'].": ".$_POST['nombrePaciente']." )";


?>
<script >
window.alert( "SE ACTIVO LA CUENTA DEL PACIENTE: <?php echo  "#".$myrow31['keyClientesInternos']." ".$_POST['nombrePaciente'];?> ");
window.opener.document.forms["form1"].submit();
</script>
<span class="titulomedio">
<?php 


//******************************** 
//contador
$q4 = "INSERT INTO contadorInternos (contador,usuario,entidad) values ('".$myrow333['contador']."','".$usuario."','".$entidad."')";
mysql_db_query($basedatos,$q4);
echo mysql_error();

//******************************

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
<h1 ><?php echo $leyenda; 


?></h1>
<p align="center">Presupuesto</p>
<form id="form1" name="form1" method="post" action="#" >
  <p>&nbsp;</p>
  <table width="606" >

      <tr >
        <th colspan="3"><div align="center" >Datos del Paciente</div></th>
      </tr>
	  
	   <?php if($NUMEROE){ ?>
      <tr >
         <td  >Nombre del Paciente</td>
         <td colspan="2"  ><input name="limiteCredito" type="text"  id="limiteCredito" size="40" 
		value="<?php echo $_POST['nombrePaciente'];?>"/></td>
    </tr>
      <tr >
        <td height="26"  >Seguro</td>
        <td colspan="2"  ><span >
          <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span>          <input name="nomSeguro" type="text"  id="nomSeguro" size="80"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
      </tr>
      <tr >
        <td width="104"  >Procedimiento</td>
        <td colspan="2"  ><textarea name="procedimiento" cols="60"  id="dx"><?php echo $_POST['procedimiento']; ?></textarea></td>
      </tr>
      <tr  >
        <td colspan="3" ><div align="center" >Descripcion y Precios</div></td>
      </tr>
      <tr valign="middle" >
        <td  >Honorarios</td>
        <td width="379" ><span >
          <textarea name="honDescripcion" cols="60"  id="procedimiento"><?php echo $myrow['honDescripcion']; ?></textarea>
        </span></td>
        <td width="121" ><span >
          <input name="honPrecio" type="text"  id="honPrecio" size="15" 
		value="<?php echo $myrow['honPrecio'];?>"/>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td ><div align="left" >Cuarto</div></td>
        <td ><div align="left"><span >
          <textarea name="cuartoDescripcion" cols="60"  id="procedimiento2"><?php echo $myrow['cuartoDescripcion']; ?></textarea>
        </span></div></td>
        <td ><span >
          <input name="cuartoPrecio" type="text"  id="cuartoPrecio" size="15" 
		value="<?php echo $myrow['cuartoPrecio'];?>"/>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td >Anestesi&oacute;logo</td>
        <td ><span >
          <textarea name="anesDescripcion" cols="60"  id="anesDescripcion"><?php echo $myrow['anesDescripcion']; ?></textarea>
        </span></td>
        <td ><span >
          <input name="anesPrecio" type="text"  id="anesPrecio" size="15" 
		value="<?php echo $myrow['anesPrecio'];?>"/>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td >Farmacia</td>
        <td ><span >
          <textarea name="farmaDescripcion" cols="60"  id="procedimiento4"><?php echo $myrow['farmaDescripcion']; ?></textarea>
        </span></td>
        <td ><span >
          <input name="limiteCredito5" type="text"  id="limiteCredito5" size="15" 
		value="<?php echo $_POST['nombrePaciente'];?>"/>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td >Laboratorio</td>
        <td ><span >
          <textarea name="labDescripcion" cols="60"  id="procedimiento5"><?php echo $myrow['labDescripcion']; ?></textarea>
        </span></td>
        <td ><span >
          <input name="limiteCredito6" type="text"  id="limiteCredito6" size="15" 
		value="<?php echo $_POST['nombrePaciente'];?>"/>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td >Rayos X</td>
        <td ><span >
          <textarea name="rxDescripcion" cols="60"  id="procedimiento6"><?php echo $myrow['rxDescripcion']; ?></textarea>
        </span></td>
        <td ><span >
          <input name="limiteCredito7" type="text"  id="limiteCredito7" size="15" 
		value="<?php echo $_POST['nombrePaciente'];?>"/>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td >CEYE y Quir&oacute;fano</td>
        <td ><span >
          <textarea name="qxDescripcion" cols="60"  id="procedimiento7"><?php echo $myrow['qxDescripcion']; ?></textarea>
        </span></td>
        <td ><span >
          <input name="limiteCredito8" type="text"  id="limiteCredito8" size="15" 
		value="<?php echo $_POST['nombrePaciente'];?>"/>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td >Otros</td>
        <td ><span >
          <textarea name="otrosDescripcion" cols="60"  id="procedimiento8"><?php echo $myrow['otrosDescripcion']; ?></textarea>
        </span></td>
        
      </tr>
      <tr valign="middle"  >
        <td colspan="3"><div align="center" >Total Presupuesto</div></td>
      </tr>
	  
	  
	  
     <tr valign="middle"  >
        <td >&nbsp;</td>
        <td colspan="2"><p><span ><a href="javascript:ventanaSecundaria3('/sima/cargos/agregarSeguros.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></p>        </td>
      </tr>
      <tr valign="middle"  >
        <td >&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
	    <?php } ?>
	  
	  
	  
	  
	
</table>
<br />

      <div align="center">
        <input name="acepta" type="submit"  id="acepta" value="Generar Presupuesto" />
        <br />
        <?php if($myrow9['keyClientesInternos']){ ?>
        <a href="javascript:ventanaSecundaria7(
		'impresionInternamiento.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoCuarto=<?php echo "cuarto"; ?>&amp;nT=<?php echo $myrow9['keyClientesInternos']; ?>&edadPaciente=<?php echo $_POST['edadPaciente']?>&descripcionCuarto=<?php echo $_POST['descripcionCuarto']?>&medico=<?php echo $_POST['medico']?>&anomSeguro=<?php echo $_POST['seguro']?>&especialidad=<?php echo $_POST['especialidad']?>')"><img src="/sima/imagenes/impresora.jpg" alt="Imprimir solicitud de Internamiento <?php echo $nombrePaciente; ?>" width="87" height="49" border="0" /></a>
        <?php } ?>
        <br />
        </label>
        </div><br />
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
			return "/sima/cargos/clientesSoloInternosx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
<?php 
 //cierra funcion
//cierra clase
?>