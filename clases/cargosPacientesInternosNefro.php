<script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=600,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la cuenta de este paciente a admisiones? ya no podras hacer cargos, y la operaci�n es irreversible')) return true;
return false;
}
-->
</script>

<?php  
if(is_numeric($_GET['rand']) AND $_GET['cierre']=='si' ){

$sSQL31= "SELECT statusCuenta FROM
clientesInternos
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($myrow31['statusCuenta']=='abierta' or $myrow31['statusCuenta']=='revision' or $myrow31['statusCuenta']=='caja'){

if($_GET['tipoCierre']=='revision' and $myrow31['statusCuenta']=='abierta'){

//******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$descripcion='Regresar a Cuenta Abierta';
$as=$_GET['almacen'];
$ad=$myrow7['almacen'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow7['folioVenta']."',
'".$myrow7['cuarto']."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************
  $q = "UPDATE clientesInternos set 
statusCuenta='revision'

 WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' and statusCuenta!='cerrada'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
} else if($_GET['tipoCierre']=='caja' and $myrow31['statusCuenta']=='revision') {
        //******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$descripcion='Enviar a Revision o para cargar Coaseguro.';
$as=$_GET['almacen'];
$ad=$myrow7['almacen'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow7['folioVenta']."',
'".$myrow7['cuarto']."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************
 $q = "UPDATE clientesInternos set 
statusCuenta='caja'
 WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' and statusCuenta!='cerrada'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}
}
}
?>



<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventanaSecundaria20","width=500,height=240,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="100"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos">Solicitudes a Pacientes Internos</h1>
  <p align="center" class="titulos">
<select name="almacenDestino1"  id="almacenDestino1" onChange="javascript:this.form.submit();"/>        
					<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND tieneCuartos = 'si' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($result1)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino1']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
  </p>
  <p align="center" class="precio1">(Para ver el estado de cuenta y cargos que se han hecho al paciente, <br />
Presiona sobre su Nombre)</p>
  <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="6"><img src="/sima/imagenes/bordestablas/borde1.png" width="750" height="27" /></td>
    </tr>
    <tr>
      <td width="54" bgcolor="#FFFF00" class="negromid" align="center">Folio V</td>
      <td width="266" bgcolor="#FFFF00" class="negromid">Paciente</td>
      <td width="211" bgcolor="#FFFF00" class="negromid" align="center">Seguro</td>
      <td width="80" bgcolor="#FFFF00" class="negromid" align="center">Transferir</td>
      <td width="71" bgcolor="#FFFF00" class="negromid" align="center">Solicitar</td>
      <td width="68" bgcolor="#FFFF00" class="negromid" align="center">Alta de Px</td>
    </tr>
      <?php	
if(!$_POST['almacenDestino1']){
$_POST['almacenDestino1']=$ALMACEN;
}



$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
(status='activa' or status='ontransfer' )
and 
statusCuenta = 'abierta'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
almacen='".$_POST['almacenDestino1']."'

ORDER BY paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$guia+=1;


$sSQL31cd= "SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['seguro']."' 
";
$result31cd=mysql_db_query($basedatos,$sSQL31cd);
$myrow31cd = mysql_fetch_array($result31cd);
?>    
    
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor='#ffffff'" >
      <td height="59" align="center" class="precio2"><?php echo $myrow['folioVenta'];?></td>
      <td class="normalmid">
	  <a name="ec<?php echo $guia;?>" href="#ec<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta']; ?>')">
	  <?php echo $myrow['paciente'];
	  if($myrow['solicitaTransferencia']=='si'){
	  echo '</a></br><span class="codigos">'.'   [Paciente Transferido]'.'</span>';
	  }
	 ?></a><br />
       <span class="normal"> Cuarto: 
      <?php echo $myrow['cuarto']
?></span></td>
      <td class="normalmid" align="center">
        <?php 
	  if($myrow31cd['nomCliente']){
	  echo $myrow31cd['nomCliente'];
	  } else {
	  echo 'particular';
	  }
?>
   </td>
      <td class="normalmid" align="center"><a href="javascript:ventanaSecundaria20('/sima/OPERACIONESHOSPITALARIAS/urgencias/departamentoTransferencia.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;usuario=<?php echo $usuario; ?>#trans<?php echo $guia;?>')" name="trans<?php echo $guia;?>" id="trans<?php echo $guia;?>"  onclick="if(confirm('Estas seguro que deseas transferir la cuenta?') == false){return false;}">Transferir PX
      </a></td>
      <td  align="center" class="normalmid"><?php if($myrow['statusCuenta']!='revision'){ ?>
      <a href="#solicitar<?php echo $guia;?>" name="solicitar<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/solicitaArticulos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')">Solicitar</a>
        <?php } else { echo '---';}?>        </td>
      
      <td class="normalmid" align="center">
      <?php if( $myrow['statusCuenta']=='abierta'){ ?>
        <a name="status<?php echo $guia;?>" href="pacientesInternos.php?rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=revision#status<?php echo $guia;?>" onClick="return comprueba();"> Alta de PX</a>
        <?php } else if($myrow['statusCuenta']=='revision'){ ?>
        <a name="status<?php echo $guia;?>" href="pacientesInternos.php?rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=caja#status" onClick="return comprueba();"> Alta de PX</a>
        <?php } else {
		  
		  echo '---';
		  } ?>
      </td><?php  }}?>
    </tr>
    
    <tr>
      <td colspan="6"><img src="/sima/imagenes/bordestablas/borde2.png" width="750" height="25" /></td>
    </tr>
  </table>
  
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>

</form>
</body>
</html>