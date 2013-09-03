<?PHP class variosPagos{ 
public function pagosDiversos($usuario,$fecha1,$hora1,$TITULO,$entidad,$almacen,$basedatos){
 ?>



<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
		alert("Sólo Se aceptan Números!")
        return false
		
    }
    status = ""
    return true
}
</SCRIPT>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 


<?php

include("/configuracion/funciones.php"); 
//************************ACTUALIZO **********************
$ALMACEN=$_GET['almacen'];


$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$keyClientesInternos=$myrow3['keyClientesInternos'];



//esta interno? 
if(!$myrow3['numeroE']){
$sSQL311= "select sum(nCuenta+1) as nCuentas from clientesInternos where entidad='".$entidad."' AND numeroE='".$NUMEROE."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$numeroE=$_POST['numeroEx'];
$nCuenta=$myrow311['nCuentas'];
if(!$nCuenta){
$nCuenta=1;
}

}







//***************aplicar pago**********************
if( $_POST['aplicarPago'] and $_POST['cantidadRecibida'] AND $_POST['paciente'] ){



$cantidadRecibida=$_POST['cantidadRecibida'];

$sSQL31= "Select * From catTTCaja WHERE banderaPaquete='si'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);	
$naturaleza=$myrow31['naturaleza'];



//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
$numCorte=$myrowC['numCorte'];
$q = "UPDATE statusCaja set 
numRecibo= numRecibo+1
where
entidad='".$entidad."'
and
keyCatC='".$myrowC['keyCatC']."'
and
status='abierta'
order by keySTC DESC ";

mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);


$sSQL333= "SELECT 
MAX(folioVenta)+1 as folioVentas
FROM clientesInternos
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333); 



//*****************************************************************




$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos='".$_POST['keyClientesInternos']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$nCuenta=$myrow3['nCuenta'];
//**************************************************


$sSQL317= "Select * From catTTCaja WHERE banderaPaquete = 'si'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,
tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,descripcion,almacenSolicitante,statusCaja,numRecibo,keyClientesInternos,folioVenta,codigoCaja,
ultimosDigitos,
telefono,bancoTC,bancoTransferencia,numeroTransferencia,numeroCheque,bancoCheque

) 
values 
('".$myrow3['numeroE']."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$myrow317['codigoTT']."','".$hora1."',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','','".$almacen."','".$usuario."',
'".$cantidadRecibida."','".$_POST['seguro']."','trasladado','particular','".$tipoPaciente."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$myrowC['numCorte']."','".$entidad."','".$_POST['tipoPago']."','standby'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$almacen."','".$_POST['descripcion']."','".$almacen."','pagado','".$myrowC['numRecibo']."','".$myrow3['keyClientesInternos']."','".$myrow333['folioVentas']."','".$myrowC['keyCatC']."',
'".$_POST['ultimosDigitos']."','".$_POST['telefono']."','".$_POST['bancoTC']."','".$_POST['bancoTransferencia']."','".$_POST['numeroTransferencia']."','".$_POST['numeroCheque']."','".$_POST['bancoCheque']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
print  '<script type="text/vbscript">
msgbox "SE AGREGO UN MOVIMIENTO!" 
</script>'; 
echo $leyenda= "Se Agregó un movimiento!";
//**************ACTUALIZA STATUS DE PAQUETE****
$actualiza = "UPDATE articulosPaquetesPacientes
set
status='standby',
keyClientesInternos='".$myrow3['keyClientesInternos']."'

WHERE 
entidad='".$entidad."'
and
numeroE='".$numeroE."'
and
status='request'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();


$actualiza = "UPDATE paquetesPacientes
set
status='activo',
keyClientesInternos='".$myrow3['keyClientesInternos']."'

WHERE 
entidad='".$entidad."'
and
numeroE='".$numeroE."'
and
status='standby'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

$actualiza2 = "UPDATE almacenesPaquetes
set
status='standby'


WHERE 
keyClientesInternos='".$myrow3['keyClientesInternos']."'
";
mysql_db_query($basedatos,$actualiza2);
echo mysql_error();


$q0 = "UPDATE clientesInternos,cargosCuentaPaciente set 
clientesInternos.status='activa',statusCuenta='abierta',
clientesInternos.folioVenta='".$myrow333['folioVentas']."',
clientesInternos.numRecibo='".$myrowC['numRecibo']."',
clientesInternos.codigoCaja='".$myrowC['keyCatC']."',
clientesInternos.numCorte='".$myrowC['numCorte']."',
clientesInternos.tipoPago='".$_POST['tipoPago']."',
clientesInternos.telefono='".$_POST['telefono']."',
clientesInternos.ultimosDigitos='".$_POST['ultimosDigitos']."',
clientesInternos.bancoTC='".$_POST['bancoTC']."',
clientesInternos.bancoTransferencia='".$_POST['bancoTransferencia']."',
clientesInternos.numeroTransferencia='".$_POST['numeroTransferencia']."',
clientesInternos.numeroCheque='".$_POST['numeroCheque']."',
clientesInternos.bancoCheque='".$_POST['bancoCheque']."'

where

clientesInternos.keyClientesInternos='".$myrow3['keyClientesInternos']."'
and
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos

";

mysql_db_query($basedatos,$q0);
echo mysql_error();
//***********************************
?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirReciboPaquetes.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&codigoPaquete=<?php echo $_POST['codigoPaquete'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&paciente=<?php echo $_POST['paciente'];?>&cantidadRecibida=<?php echo $cantidadRecibida;?>&folioVenta=<?php echo $myrow333['folioVentas'];?>');
window.opener.document.forms["form1"].submit();
close();

</script>


<?php 
}


?>




<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.style122 {font-size: 10px}
.style122 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style21 {color: #FF0000}
-->
</style>
<body>
<h1 align="center">
PAGO DE PAQUETES
<?php $_POST['tipoAccion']='Paquetes';  
//$_POST['tipoPago']='Efectivo';
?>
</h1>
  <form id="form1" name="form1" method="post" action="">
    <table width="395" border="0" align="center" class="Estilo24">
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <th colspan="2" bgcolor="#990033" class="style14" scope="col">TOTALES</th>
    </tr>
	
	
	
	  	 <?php if($_POST['tipoAccion']=='Paquetes' ){ ?>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td width="90" class="Estilo24"><div align="left"><strong>Paciente: </strong></div></td>
      <td width="430" class="Estilo24"><label>
      <input name="paciente" type="text" class="style7" id="paciente" value="<?php 
		
		  echo $myrow3['paciente'];
		 
		  ?>" size="60" readonly="">
      <span class="style122"><span class="Estilo25"><span class="style121">
	  
	  <a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a>
	  <input name="keyClientesInternos" type="hidden" class="Estilo24" id="keyClientesInternos"   readonly="" value="<?php echo $_GET['keyClientesInternos'];?>" />
      </span></span></span></label></td>
    </tr>
	 <?php } ?>
	
	
	
	
	
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Transacci&oacute;n</td>
      <td class="Estilo24"><label>
        <?php



$sSQL31= "Select * From catTTCaja WHERE banderaPaquete='si'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if(!$myrow31['codigoTT']){
echo 'Activar Transaccion';
}
			  ?>
			  <?php if($_POST['tipoPago'] AND !$_POST['nuevo']){ ?>
        <input name="campoDespliega" type="text" class="Estilo24" id="campoDespliega" size="50" 
	value="<?php echo $myrow31['descripcion'];?>"
		   readonly=""/>
		   
        <a href="javascript:ventanaSecundaria1(
		'/sima/INGRESOS%20HLC/caja/ventanaTTSP.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;campo1=<?php echo "cantidadRecibida"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "tipoTransaccion"; ?>&amp;numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;tipoPago=<?php echo $_POST['tipoPago']; ?>&amp;almacenFuente=<?php echo $almacen; ?>')"></a>
<input name="tipoTransaccion" type="hidden" class="Estilo24" id="tipoTransaccion" 
value="<?php echo $myrow31['codigoTT'];?>"   readonly="" />
        </a>
		<?php } ?>
		</label></td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Paquete</td>
      <td class="Estilo24"><input name="codigoPaquete" type="text" class="Estilo24" id="codigoPaquete" value="<?php echo $_GET['codigoPaquete'];?>" size="50" readonly="" /></td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td bgcolor="#990033" class="Estilo24">&nbsp;</td>
      <td bgcolor="#990033" class="Estilo24">&nbsp;</td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
       <td width="25%" bgcolor="#FFFFFF" class="style16">Tipo Pago/Cr&eacute;dito </td>
       <td width="75%" bgcolor="#FFFFFF" class="style16"><?php 
		 ?>
           <select name="tipoPago" class="style12" id="tipoPago" onChange="javascript:form.submit();" >
		   <option value="">Escoje el tipo de Pago...</option>
             <option
				 <?php if($_POST['tipoPago']=='Efectivo' ){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Efectivo">Efectivo</option>
           
             <option
				 <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Transferencia Electronica">Transferencia Electronica</option>
             <option
				<?php if($_POST['tipoPago']=='Cheque'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Cheque">Cheque</option>
				 
				 <option
				<?php if($_POST['tipoPago']=='Tarjeta Credito'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Tarjeta Credito">Tarjeta Credito</option>
         </select></td>
     </tr>
	 
	 
	  <?php if($_POST['tipoPago']=='Tarjeta Credito'){ ?>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFFFFF" class="style16">Ultimos 4 d&iacute;gitos </td>
        <td bgcolor="#FFFFFF"><span class="style16">
          <input name="ultimosDigitos" type="text" class="Estilo24" id="ultimosDigitos" 
		 value="<?php 
		 
		 echo $myrow2['ultimosDigitos']; 
		 
		 ?>" size="10" />
          <a href="javascript:ventanaSecundaria3('/sima/cargos/ventanaTC.php?nombreCampo=<?php echo "codigo"; ?>&amp;descripcion=<?php echo "descripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;comision=<?php echo "comision"; ?>&amp;tipoPago=<?php echo $_GET['tipoPago'];?>')"><img src="/sima/imagenes/Save.png" alt="Laboratorio Fabricante" width="15" height="15" border="0" /></a></span></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFFFFF" class="style16">Tel&eacute;fono</td>
        <td bgcolor="#FFFFFF"><input name="telefono" type="text" class="style7" value="<?php echo $_GET['telefono'];?>" size="50"></td>
      </tr>
	  
	  
	  
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFFFFF" class="style16">Banco Tarjeta</td>
        <td bgcolor="#FFFFFF"><input name="bancoTC" type="text" class="style7" value="<?php 
		 
		 echo $myrow2['bancoTC']; 
		 
		 ?>" size="50"  /></td>
      </tr>
	  <?php } ?>
	  
	  
	  
	  <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
      <tr>
	        <th class="Estilo24" scope="col">&nbsp;</th>
	 	
       <td bgcolor="#FFFFFF" class="style16">Banco Transferencia </td>
       <td bgcolor="#FFFFFF"><input name="bancoTransferencia" type="text" class="style7" value="<?php echo $_GET['bancoTransferencia'];?>" size="50"  /></td>
     </tr>
	 <?php } ?>
	
	
	
		    <?php if($_POST['tipoPago']=='Transferencia Electronica'){ ?>
           <tr>
             <th class="Estilo24" scope="col">&nbsp;</th>
             <td bgcolor="#FFFFFF" class="style16"># Transferencia </td>
             <td bgcolor="#FFFFFF">
			 <input name="numeroTransferencia" type="text" class="style7" id="numeroTransferencia" value="<?php echo $_GET['numeroTransferencia'];?>" size="50">			 </td>
           </tr>
 <?php } ?>		   
		   
<?php if($_POST['tipoPago']=='Cheque'){ ?>		   
      <tr>
       <th class="Estilo24" scope="col">&nbsp;</th>
	   <td bgcolor="#FFFFFF" class="style16"> N&uacute;mero Cheque </td>
       <td bgcolor="#FFFFFF"><input name="numeroCheque" type="text" class="style7" id="numeroCheque" value="<?php echo $_POST['numeroCheque'];?>" /></td>
     </tr>
 <?php } ?>
	
	
	
	<?php if($_POST['tipoPago']=='Cheque'){ ?> 
     <tr>
       <th class="Estilo24" scope="col">&nbsp;</th>
       <td class="style16">Banco Cheque</td>
       <td class="Estilo24"><input name="bancoCheque" type="text" class="style7" id="bancoCheque" value="<?php echo $_GET['bancoCheque'];?>" size="50" /></td>
     </tr>
	  <?php } ?>
	 
    </tr>
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Importe </td>
      <td class="Estilo24"><label>
        <input name="cantidadRecibida" type="text" class="Estilo24" id="cantidadRecibida" value="<?php 
		echo $_GET['importe'];
	?>" readonly="">
      </label></td>
    </tr>

    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <td colspan="2" bgcolor="#990033" class="Estilo24">&nbsp;</td>
    </tr>
	
	
	<?php if($_POST['tipoPago'] AND !$_POST['nuevo']){ ?>
    <tr>
	     <td height="33" colspan="3"><label>
          <div align="center">
            <label></label>
            <input name="aplicarPago" type="submit" class="Estilo24" id="aplicarPago" value="Efectuar Pago" 
			<?php echo $disabled?>
			  />
            <label></label>
            <input name="almacen" type="hidden" class="Estilo24" id="almacen" 
				value="<?php echo $ALMACEN;?>"   readonly="" />
            <input name="numeroE" type="hidden" class="Estilo24" id="numeroE"   readonly="" />
          
		   <input name="folioVenta" type="hidden" class="Estilo24" id="folioVenta"   readonly="" value="<?php echo $myrow333['folioVentas'];?>" />
		  </div>
        </label></td>
    </tr>
	<?php } ?>
  </table>
</form>
<h1 align="center">&nbsp;</h1>
<p>&nbsp;</p>
  <h1 align="center">&nbsp;</h1>
  <p align="center">&nbsp;</p>
</body>
</html>
<?php
}
}
?>