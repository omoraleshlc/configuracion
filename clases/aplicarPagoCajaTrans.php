<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=360,height=250,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=350,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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
           
        if( vacio(F.tipoTransaccion.value) == false ) {   
                alert("Escoje el Tipo de Transacción que desees hacer!")   
                return false   
        }  else if( vacio(F.cantidadRecibida.value) == false ) {   
                alert("Escribe la cantidad!")   
                return false   
        }                     
		
		
}   
  
</script> 
<?php 
$TOTAL=$_GET['TOTAL'];
$iva=$_GET['iva'];
$numeroCuenta=$_GET['nCuenta'];
$descuento=$_GET['descuento'];
$depositos=$_GET['depositos'];
$devolucion=$_GET['cantidadRecibida']-$TOTAL;
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE1=$myrow3['numeroE'];
$nCuenta1=$myrow3['nCuenta'];
$tipoPaciente=$myrow3['tipoPaciente'];
$tipoTrans=$myrow3['tipoTransaccion'];

?>

<?php if(($tipoPaciente=='externo' || $tipoPaciente=='urgencias') AND !$_POST['aplicarPago']){  ?>
<script>
javascript:ventanaSecundaria6('/sima/INGRESOS%20HLC/caja/imprimeCajaExternos.php?numeroE=<?php echo $nCliente5; ?>&amp;nT=<?php echo $numeroCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;orden=<?php echo $E; ?>&amp;hora1=<?php echo $hora1; ?>');
</script>

<?php }?>



<?php //************************ACTUALIZO PRECIOS**********************
$ID_LIBROM='20';
//***********************************************************************



//***********************************Bajar variables
$hoy = date("Y-m-d");
$hora = date("H:i a");
$nPaciente=$_GET['numeroE'];



if($_GET['almacen']){
$al = $_GET['almacen'];
} else if($_GET['almacen1']){
$al = $_GET['almacen1'];
} else if($_GET['almacen2']){
 $al = $_GET['almacen2'];
} else if($_GET['almacen3']){
$al = $_GET['almacen3'];
} 
//***********************Cierro validaciones de almacén************************

//*********************************CREAR FUNCIONES******************************************
function saca_por($can,$por){
$can=($can/100)*$por;
$tPor=$can+$cant;
return $can;
}
function saca_pormas($can,$por){
$can=($can/100)*$por;
$tPor=$can-$cant;
return $can;
}
function saca_iva($can,$por){
$cant=$can;
$can=($can/100)*$por;
$can+=$cant;
return $can;
}
//****************************Cierro funciones************************************
//********************************VERIFICA EL ULTIMO MOVIMIENTO*******************
//********traigo centro de costos y libro*********
//$cmdstr1 = "select * from MATEO.CONT_FOLIO where LOGIN = '".$usuario."' ";
$cmdstr1 = "select * from MATEO.CONT_FOLIO where LOGIN = '".$usuario."' 
AND ID_EJERCICIO='".$ID_EJERCICIOM."'
AND
ID_LIBRO='".$ID_LIBROM."'
";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 

for ($i = 0; $i < $nrows1; $i++ ){
$ID_LIBRO = $results1['ID_LIBRO'][$i];
$ID_EJERCICIO = $results1['ID_EJERCICIO'][$i];
} 
//***********************************************************************************

//*****************************Verificando caja abierta**************************
$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

if($poliza=$myrowC['numeroPoliza']){ //*******************Comienzo la validación*****************
//********************Llenado de datos
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$numeroCuenta."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$numeroE1=$myrow3['numeroE'];
$nCuenta1=$myrow3['nCuenta'];
//***************aplicar pago**********************



if($_GET['aplicarPago'] AND $_GET['cantidadRecibida'] AND $_GET['tipoTransaccion']){
$numeroConfirmacion=rand();
$q = "UPDATE clientesInternos set 
status='activa',
statusDeposito='pagado',
statusCuenta='abierta'
WHERE numeroE = '".$numeroE1."' and nCuenta='".$nCuenta1."'";
mysql_db_query($basedatos,$q);
echo mysql_error();


$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$_GET['tipoTransaccion']."'
	";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$naturaleza=$myrow341['naturaleza'];


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,cantidadRecibida,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen) values ('".$numeroE1."','".$nCuenta1."','pagado',
'".$usuario."','".$fecha1."','".$_GET['cantidadRecibida']."','1','".$_GET['tipoTransaccion']."','".$hora1."',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$numeroConfirmacion."','".$ALMACEN."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



if($myrow3['tipoPaciente']=='externo'){
$q1 = "UPDATE cargosCuentaPaciente set 
status='pagado',statusAlta='pagado',
tipoTransaccion='".$_GET['tipoTransaccion']."',

numPoliza='".$poliza."'
WHERE numeroE = '".$numeroE1."' and nCuenta='".$nCuenta1."' and status='cargado'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}

$q1 = "UPDATE descuentos set 
status='usado'
WHERE numeroE = '".$_GET['numeroE']."' and status='activo'";
//mysql_db_query($basedatos,$q1);
echo mysql_error();
//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$sSQL2= "Select max(consecutivo) as tope From aperturaCaja ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$numMovto=$myrow2['tope']+'1';
$q = "UPDATE aperturaCaja set 
consecutivo = '".$numMovto."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE HIZO UN MOVIMIENTO!"
</script>';
$leyenda='Se hizo un Movimiento';
?>




<?php if($myrow3['tipoPaciente']=='externo' AND $_GET['tipoTransaccion']==''){?>
<script>
javascript:ventanaSecundaria2('/sima/INGRESOS%20HLC/caja/imprimeCaja2.php?numeroE=<?php echo $numeroE1; ?>&amp;nCuenta=<?php echo $nCuenta1; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>');
</script>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<script type="text/javascript">
	

		close();
	
</script>
<?php } else { ?>
<script>
javascript:ventanaSecundaria2('/sima/INGRESOS%20HLC/caja/imprimeCaja3.php?numeroE=<?php echo $numeroE1; ?>&amp;nCuenta=<?php echo $nCuenta1; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>');
</script>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<script type="text/javascript">
	

		close();
	
</script>
<?php }?>







<?php 
}
//*************************************************
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style7 {font-size: 9px}
.style8 {
	color: #0000FF;
	font-weight: bold;
}
.style12 {font-size: 10px}
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<form id="form1" name="form1" method="get" action="" onSubmit="return valida(this);">
  <table width="442" height="337" border="1" align="center" cellpadding="0" cellspacing="0" class="Estilo24">
    <tr bgcolor="#990033" align="center">
      <td><b><font color="#FFFFFF">Totales</font></b></td>
    </tr>
    <tr bgcolor="#990033">
      <td><table width="100%" height="320" border="0" cellpadding="4" cellspacing="0">
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">Tipo de Pago: </td>
            <td class="Estilo24">
			<select name="tipoPago" class="style7" id="tipoPago" onChange="javascript:form.submit();">
             
                <option
				 <?php if($_GET['tipoPago']=='Efectivo'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Efectivo">Efectivo</option>
                <option
				 <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Tarjeta de Credito">Tarjeta de Credito</option>
				<option
				<?php if($_GET['tipoPago']=='Cheque'){ ?>
				 selected="selected"
				  <?php } ?>
				 value="Cheque">Cheque</option>
            </select></td>
          </tr>
          <tr bgcolor="#FFFFFF">
		  
		  
		  <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
            <td class="Estilo24">C&oacute;digo de Tarjeta: </td>
            <td class="Estilo24"><input name="codigo" type="text" class="Estilo24" id="codigo" 
		 value="<?php 
		 if($_GET['nuevo']){
		 echo "0000000000";
		 } else if($myrow2['codigo']){
		 echo $myrow2['codigo']; 
		 }
		 ?>" size="10" readonly=""/>
              <a href="javascript:ventanaSecundaria3('/sima/cargos/ventanaTC.php?nombreCampo=<?php echo "codigo"; ?>&amp;descripcion=<?php echo "descripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;comision=<?php echo "comision"; ?>')"><img src="/sima/imagenes/Save.png" alt="Laboratorio Fabricante" width="15" height="15" border="0" /></a></td>
         
		  <input name="comision" type="hidden" value="">
		  </tr>
          <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF" class="Estilo24">Banco Tarjeta :</td>
            <td bgcolor="#FFFFFF" class="Estilo24"><input name="descripcion" type="text" class="style7" value="<?php echo $_GET['descripcion'];?>"  readonly=""/></td>
          </tr>
	
		  
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">&Uacute;ltimos 4 D&iacute;gitos: </td>
            <td class="Estilo24"><label>
              <input name="ultimosDigitos" type="text" class="style7" id="ultimosDigitos" size="4" maxlength="4" value="<?php echo $_GET['ultimosDigitos'];?>" onKeyPress="return checkIt(event)"/>
            </label></td>
          </tr>	 
		  
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">C&oacute;digo de Aut. </td>
            <td class="Estilo24"><label>
              <input name="codigoAutTC" type="text" class="style7" id="codigoAutTC" value="<?php echo $_GET['codigoAutTC']; ?>" />
            </label></td>
          </tr>
		    <?php } ?>
			
			
			
			
			
			
			
			
			
			
			
			<?php if($tipoPaciente=='interno'){ ?>
            <tr bgcolor="#FFFFFF">
              <td class="Estilo24">Tipo de Transacci&oacute;n </td>
              <td class="Estilo24"><label>
			  
			  <?php



$sSQL31= "Select * From catTTCaja WHERE codigoTT = '".$tipoTrans."'
	";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);


			  ?>
                <input name="campoDespliega" type="text" class="Estilo24" id="campoDespliega" size="50" 
	value=""
		   readonly=""/>
              </label>
                <label>
				<a href="javascript:ventanaSecundaria1(
		'ventanaTT.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "tipoTransaccion"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Tipo de Transacci&oacute;n" width="20" height="20" border="0" /></a><a href="javascript:ventanaSecundaria1(
		'ventanaTT.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "tipoTransaccion"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">
                
				
				<input name="tipoTransaccion" type="hidden" class="Estilo24" id="tipoTransaccion" 
				value=""   readonly="" />
              </a></label></td>
			  <?php } else {?>
			  <input name="tipoTransaccion" type="hidden" class="Estilo24" id="tipoTransaccion" 
				value="CCaja"   readonly="" />
			  <?php }?>
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
            </tr>
            <tr bgcolor="#FFFFFF">
              <td class="Estilo24">Compa&ntilde;&iacute;a</td>
              <td class="Estilo24"><span class="style12">
                <?php 
			$despliegaAseguradora=new acumulados();
echo "$".number_format($despliegaAseguradora->acumuladoAseguradora($basedatos,$usuario,$numeroE1,$nCuenta1),2);

	?>
              </span></td>
            </tr>
          <tr bgcolor="#FFFFFF">
		  <?php $despliegaTotal=new  acumulados();
			if($despliegaTotal->acumulado($basedatos,$usuario,$numeroE1,$nCuenta1)>0){
			$mostrar='Total Cargos';
			} else if($despliegaTotal->acumulado($basedatos,$usuario,$numeroE1,$nCuenta1)<0){
			$mostrar='Saldo a Favor';
			} else {
			$mostrar='Sin Cargos..';
			}
			?>
		  
            <td width="22%" class="Estilo24"><?php echo $mostrar; ?></td>
            <td width="78%" class="Estilo24"><?php 
			
echo "$".number_format($despliegaTotal->acumulado($basedatos,$usuario,$numeroE1,$nCuenta1),2);

	?> </td>
          </tr>
          <?php 
//descuentos pacientes internos
$sSQL18= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$numeroE1."' AND nCuenta ='".$nCuenta1."' and nCuenta <>null
and 
status='activo' and
fechaFinal <= '".$fecha1."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18= mysql_fetch_array($result18);
echo mysql_error();
//descuentos pacientes ambulatorios
$sSQL19= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$nCliente."' 
and status='activo' and
fechaFinal <= '".$fecha1."'
 ";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19= mysql_fetch_array($result19);
//******************
if($myrow19['cantidad']){

$descuento=$myrow19['cantidad'];
} else if($myrow19['descuento']){

		$TOTAL1=($myrow19['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}
		
		
if($myrow18['cantidad']){
$descuento=$myrow18['cantidad'];
} else if($myrow18['descuento']) { 
		$TOTAL1=($myrow18['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}	
		
	$TOTAL-=$descuento;
		?>
          <?php 
		if($descuento){ ?>
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">Descuento: </td>
            <td class="Estilo24"><?php
		echo "$".number_format($descuento,2); 
		 
		?>            </td>
          </tr>
          <?php } ?>
		  
		  
        
          <tr bgcolor="#FFFFFF">
            <td class="Estilo24">Cantidad Recibida </td>
            <td class="Estilo24"><input name="cantidadRecibida" type="text" class="style7" id="cantidadRecibida" value="<?php
			if($myrow3['deposito'] and $myrow3['status']=='standby'){ 
			 echo $myrow3['deposito'];
				}
			 
			 ?>" autocomplete="off"/>
			<input name="TOTAL" type="hidden" class="style7" id="cantidadRecibida" value="<?php echo $TOTAL;?>"/>	<input name="numeroE" type="hidden" class="style7" id="TOTAL" value="<?php echo $_GET['numeroE'];?>"/>
			<input name="naturaleza" type="hidden" class="style7" id="naturaleza" value="<?php echo $myrow31['naturaleza'];?>"/></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <label>
    <div align="center">
      <span class="Estilo24">
      <input name="depositos" type="hidden" class="style7" id="depositos" value="<?php echo $depositos; ?>"/>
      </span>
      <span class="Estilo24">
      <input name="nCuenta" type="hidden" class="style7" id="nCuenta" value="<?php echo $numeroCuenta; ?>"/>
      </span>
      <div align="center">
        <p>
		<?php if(!$_GET['aplicarPago']){ ?>
          <input name="aplicarPago" type="submit" class="Estilo24" id="aplicarPago" value="Aplicar Pago" 
		
	/> <?php } ?>
        </p>
        <p>
		<?php if($_GET['aplicarPago']){ ?>
          <label> <br />
          <br />
          <input name="Submit" type="submit" class="style7" value="Cerrar (X)" 	onclick="javascript:cerrar();" />
          </label>
</p>
        <?php } ?>
  </div>
  </label>
    <p align="center"><span class="style8">
      <?php if($_GET['cantidadRecibida'] and $myrow2['statusDeposito']=='pagado'){  //onclick="javascript:cerrar();"?>
    Devolver: </span><span class="style8"><?php echo "$ ".number_format($devolucion,2);?></span>
      <?php } ?>
    <span class="Estilo24">    </span></p>
</form>
<p>&nbsp;</p>
</body>
</html>
  <?php } else {
echo '<script type="text/vbscript">
msgbox "LA CAJA ESTA CERRADA!"
</script>';
}
?>