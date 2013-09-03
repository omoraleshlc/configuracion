<?PHP class variosPagos{ 
public function pagosDiversos($usuario,$fecha1,$hora1,$TITULO,$entidad,$almacen,$basedatos){
 ?>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
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
           
        if( vacio(F.importe.value) == false ) {   
                alert("Por Favor, escribe el importe!")   
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
		alert("Sólo Se aceptan Números!")
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
if(!$almacen){
$almacen==$_GET['almacen'];
}
if(!$_GET['nT']){
$_GET['nT']=$_POST['nT'];
}
include("/configuracion/funciones.php"); 
//************************ACTUALIZO **********************



$sSQL3= "Select * From clientesInternos WHERE numeroE = '".$_POST['numeroEx']."' and status='activa'";
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
if(($_POST['aplicarPago'] and $_POST['tipoAccion']=='Aseguradora') and $_POST['cantidadRecibida'] AND $_POST['descripcion'] ){
//ASEGURADORA
$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$_POST['tipoTransaccion']."'
	";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$naturaleza=$myrow341['naturaleza'];

if($naturaleza=='Abono'){
$naturaleza='A';
} else if($naturaleza=='Cargo'){
$naturaleza='C';
} else if($naturaleza=='Credito'){
$naturaleza='A';
}

$agrega = "INSERT INTO movimientos (
importe,descripcion,tipoTransaccion,fecha1,hora1,usuario,seguro,naturaleza,entidad) 
values 
('".$_POST['cantidadRecibida']."','".$_POST['descripcion']."','".$_POST['tipoTransaccion']."','".$fecha1."','".$hora1."',
'".$usuario."','".$_POST['seguro']."','".$naturaleza."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
print  '<script type="text/vbscript">
msgbox "SE HIZO UN MOVIMIENTO!" 
</script>'; 
echo $leyenda= "Se Hizo un Movimiento!";


} else if($_POST['tipoAccion']!='Aseguradora' and $_POST['aplicarPago'] and $_POST['cantidadRecibida'] AND $_POST['descripcion'] ){



$cantidadRecibida=$_POST['cantidadRecibida'];
		


$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,
tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,descripcion,almacenSolicitante) 
values 
('".$numeroE."','0','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$_POST['tipoTransaccion']."','".$hora1."',
'".$hora1."','C','".$ID_EJERCICIOM."','','".$numeroConfirmacion."','".$almacen."','".$usuario."',
'".$cantidadRecibida."','".$_POST['seguro']."','trasladado','particular','".$tipoPaciente."',
'".$cantidadParticular."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_POST['tipoPago']."','standby'
,'".$_POST['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$almacen."','".$_POST['descripcion']."','".$almacen."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
print  '<script type="text/vbscript">
msgbox "SE AGREGO UN CARGO!" 
</script>'; 
echo $leyenda= "Se Agregó un cargo!";
/* echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    close();
  // -->
</script>'; */ 
$disabled='disabled=""';
}

if($_POST['nuevo']){$disabled='';}
?>


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
 <?php echo $TITULO;?>
</h1>
  <form id="form1" name="form1" method="post" action="">
    <table width="731" border="0" align="center" class="Estilo24">
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <th colspan="2" bgcolor="#660066" class="style14" scope="col">&nbsp;</th>
    </tr>
	
	
	

    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td width="90" class="Estilo24"><div align="left"><strong>Paciente: </strong></div></td>
      <td width="430" class="Estilo24"><label>
      <input name="paciente" type="text" class="style7" id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="60" readonly="">
      <span class="style122">
      <input name="M2" type="button" class="style7" id="M2"  onclick="javascript:ventanaSecundaria6(
		'/sima/cargos/ventanaBuscaExpediente.php?campoDespliega=<?php echo "paciente"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "numeroEx"; ?>&amp;fechaNac=<?php echo "fechaNac"; ?>&amp;edad=<?php echo "edad"; ?>')" value="E" />
      <span class="Estilo25"><span class="style121">
	  
	  <a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="AGREGAR PACIENTE" width="19" height="19" border="0" />	  </a>
      <input name="fechaNac" type="hidden" class="style7" id="fechaNac" size="10"  readonly="" value="<?php 
		  if($_POST['fechaNac'] and !$_POST['fechaNac'] AND !$_POST['nuevo']){
		  echo $_POST['fechaNac'];
		  } 
		  ?>"/>
      <input name="numeroEx" type="hidden" class="Estilo24" id="numeroEx" value="<?php  echo $_POST['numeroEx'];?>" readonly="" />
      <input name="edad" type="hidden" class="Estilo24" id="edad" value="<?php 
		  if($_POST['edad'] and !$_POST['nuevo']){
		  echo $_POST['edad'];
		  } else if($myrow33['edad'] and !$_POST['nuevo']){
		  echo $myrow33['edad']; 
		  }
		  ?>" size="2" maxlength="2" onKeyPress="return checkIt(event)"/>
      </a></span></span></span></label></td>
    </tr>

	
	
	
	
	
	
	
	
	
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Tipo Transacci&oacute;n</td>
      <td class="Estilo24"><label>
        <?php



$sSQL31= "Select * From catTTCaja WHERE codigoTT = '".$tipoTrans."'
	";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);


			  ?>
			
        <input name="campoDespliega" type="text" class="Estilo24" id="campoDespliega" size="50" 
	value="<?php echo $_POST['campoDespliega'];?>"
		   readonly=""/>
		   
        <a href="javascript:ventanaSecundaria1(
		'/sima/INGRESOS%20HLC/caja/ventanaTT.php?campoDespliega=<?php echo "campoDespliega"; ?>&campo1=<?php echo "cantidadRecibida"; ?>&forma=<?php echo "form1"; ?>&campoSeguro=<?php echo "tipoTransaccion"; ?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPago=<?php echo 'efectivo'; ?>&almacenFuente=<?php echo $almacen; ?>')"> <img src="/sima/imagenes/expandir.gif" alt="Tipo de Transacci&oacute;n" width="12" height="12" border="0" /></a>
        <input name="tipoTransaccion" type="hidden" class="Estilo24" id="tipoTransaccion" 
				value="<?php 
				if(!$_POST['nuevo']){
				echo $_POST['tipoTransaccion'];
				}
				?>"   readonly="" />
        </a>
	
		</label></td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Descripci&oacute;n</td>
      <td class="Estilo24">
	  <textarea name="descripcion" cols="50" class="Estilo24" id="descripcion"><?php
	  if(!$_POST['nuevo']){
	   echo $_POST['descripcion'];}?></textarea></td>
    </tr>
    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Importe </td>
      <td class="Estilo24"><label>
        <input name="cantidadRecibida" type="text" class="Estilo24" id="cantidadRecibida" value="<?php 
		if(!$_POST['nuevo']){
		echo $_POST['cantidadRecibida'];}?>">
      </label></td>
    </tr>

    <tr>
      <th width="12" class="Estilo24" scope="col">&nbsp;</th>
      <td colspan="2" bgcolor="#660066" class="Estilo24">&nbsp;</td>
    </tr>
	
	
	<?php if( !$_POST['aplicarPago']){ ?>
    <tr>
	     <td height="33" colspan="3"><label>
          <div align="center">
           
            <input name="aplicarPago" type="submit" class="Estilo24" id="aplicarPago" value="Efectuar Pago" 
			<?php echo $disabled?>
			  />
            <label></label>
            <input name="imprimir" type="button" class="Estilo24" id="imprimir" value="Imprimir Recibo"   />
            <input name="almacen" type="hidden" class="Estilo24" id="almacen" 
				value="<?php echo $ALMACEN;?>"   readonly="" />
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