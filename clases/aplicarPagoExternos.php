<?php 
class eCuentas{
public function eCuenta($usuario,$fecha1,$hora1,$nT,$basedatos){
include("/configuracion/funciones.php");  


if(!$_GET['nT']){
$_GET['nT']=$_GET['nt'];
}
?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

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
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
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




<?php //************************
$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$seguro=$myrow3['seguro'];
?>

<?php

if($seguro){
$_GET['tipoCliente']='aseguradora';
} else {
$_GET['tipoCliente']='particular';
}






//*****************************Verificando caja abierta**************************
$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

if($poliza=$myrowC['numeroPoliza']){ //*******************Comienzo la validación*****************
if($_POST['pagar'] AND $numeroE AND $nCuenta){
$numeroConfirmacion=rand();
$q = "UPDATE clientesInternos set 
status='cerrada',
statusDeposito='pagado'

WHERE numeroE = '".$numeroE."' and nCuenta='".$nCuenta."'";
mysql_db_query($basedatos,$q);
echo mysql_error();


$sSQL341= "Select * From catTTCaja WHERE codigoTT = 'PSExt'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$naturaleza=$myrow341['naturaleza'];
$tipoTransaccion='PSExt';

if($naturaleza=='Abono'){
$naturaleza='A';
} else if($naturaleza=='Cargo'){
$naturaleza='C';
} else if($naturaleza=='Credito'){
$naturaleza='A';
}

if($_GET['tipoCliente']=='aseguradora'){
$statusTraslado='trasladado';
$q1 = "UPDATE cargosCuentaPaciente set 
statusTraslado='trasladado',
tipoTransaccion='".$_GET['tipoTransaccion']."',
usuarioTraslado='".$usuario."',tipoCliente='".$_GET['tipoCliente']."',
numPoliza='".$poliza."'
WHERE status='cxc' and statusTraslado='standby'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
} else if($_GET['tipoCliente']=='particular'){
$statusTraslado='trasladado';
$q1 = "UPDATE cargosCuentaPaciente set 
statusTraslado='trasladado',
tipoTransaccion='".$_GET['tipoTransaccion']."',
usuarioTraslado='".$usuario."',tipoCliente='".$_GET['tipoCliente']."',
numPoliza='".$poliza."'
WHERE status='particular' and statusTraslado='standby'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
} else if($_GET['tipoCliente']=='otros'){
$statusTraslado='trasladado';
$q1 = "UPDATE cargosCuentaPaciente set 
statusTraslado='trasladado',
tipoTransaccion='".$_GET['tipoTransaccion']."',
usuarioTraslado='".$usuario."',tipoCliente='".$_GET['tipoCliente']."',
numPoliza='".$poliza."'
WHERE status='credito' and statusTraslado='standby'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,numPoliza) values ('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','1','".$tipoTransaccion."','".$hora1."',
'".$hora1."','".$naturaleza."','".$ID_EJERCICIOM."','pagado','".$numeroConfirmacion."','".$ALMACEN."','".$usuario."',
'".$_GET['cantidadRecibida']."','".$seguro."','".$statusTraslado."','".$_GET['tipoCliente']."','".$tipoPaciente."','".$poliza."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>
<script>
javascript:ventanaSecundaria6('/sima/INGRESOS%20HLC/caja/imprimeCajaExternos.php?numeroE=<?php echo $nCliente5; ?>&amp;nT=<?php echo $numeroCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;orden=<?php echo $E; ?>&amp;hora1=<?php echo $hora1; ?>');
</script>
<?php 
}
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
<BODY >

<h1 align="center">Nota de Venta <?php echo $myrow3['almacen']?></h1>
<form name="form2" id="form2" method="get" action="">
  <table width="43%" height="158" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFFFF">
      <td width="29%" class="style12">Tipo Pago/Cr&eacute;dito </td>
      <td width="71%" class="style12">
        <?php 
			if( !$_GET['tipoPago']){
			$_GET['tipoPago']='Efectivo';      
			 } ?>
        <select name="tipoPago" class="style7" id="select2" onchange="javascript:form.submit();">
          <option
				 <?php if($_GET['tipoPago']=='Efectivo' ){ ?>
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
          <option 
				<?php if($_GET['tipoPago']=='Credito'){ ?>
				 selected="selected"
				 <?php } ?>
				value="Credito">Credito</option>
      </select></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <?php if($_GET['tipoPago']=='Tarjeta de Credito'){ ?>
      <td class="style12">C&oacute;digo de Tarjeta</td>
      <td class="style12"><input name="codigo" type="text" class="style12" id="codigo" 
		 value="<?php 
		 if($_GET['nuevo']){
		 echo "0000000000";
		 } else if($myrow2['codigo']){
		 echo $myrow2['codigo']; 
		 }
		 ?>" size="10" readonly=""/>
          <a href="javascript:ventanaSecundaria3('/sima/cargos/ventanaTC.php?nombreCampo=<?php echo "codigo"; ?>&amp;descripcion=<?php echo "descripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;comision=<?php echo "comision"; ?>')"><img src="/sima/imagenes/Save.png" alt="Laboratorio Fabricante" width="15" height="15" border="0" /></a></td>
      <input name="comision" type="hidden" value="" />
    </tr>
    <tr bgcolor="#FFFFFF">
      <td bgcolor="#FFFFFF" class="style12">Banco Tarjeta</td>
      <td bgcolor="#FFFFFF" class="style12"><input name="descripcion" type="text" class="style7" value="<?php echo $_GET['descripcion'];?>"  readonly=""/></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td class="style12">&Uacute;ltimos 4 D&iacute;gitos</td>
      <td class="style12"><label>

        <input name="ultimosDigitos" type="text" class="style7" id="ultimosDigitos" size="4" maxlength="4" value="<?php echo $_GET['ultimosDigitos'];?>" onkeypress="return checkIt(event)"/>
        
</label></td>
    </tr>
    <tr bgcolor="#FFFFFF">    </tr>
    <?php } ?>
    <?php 
//descuentos pacientes internos
$sSQL18= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$numeroE."' AND nCuenta ='".$nCuenta."' and nCuenta <>null
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
  </table>
  <input name="nT" type="hidden" class="style12" id="nT" 
		  value="<?php echo $_GET['nT'];  ?>" readonly=""/>
</form>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="642" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left">N&uacute;mero de Transacci&oacute;n: </div></th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left"><?php 
		 echo $nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>
      </th>
    </tr>
    <tr>      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th width="134" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="408" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Compa&ntilde;&iacute;a: </td>
      <td class="Estilo24"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>        <?php
$sSQL212= "SELECT *
FROM
clientes
WHERE 
numCliente='".$traeSeguro."'
 ";
 $result212=mysql_db_query($basedatos,$sSQL212);
$myrow212 = mysql_fetch_array($result212);


?>
        <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>      <th class="Estilo24" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="Estilo24">N&deg; Credencial: </td>
      <td bgcolor="#FFCCFF" class="Estilo24"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
  </table>
  <p>&nbsp;</p>
  

  
  <table width="672" border="0" align="center">
    <tr>
      <th width="104" height="14" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Fecha/Hora (Cargo)</span></th>
      <th width="405" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Descripci&oacute;n</span></th>
      <th width="21" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Cant</span></th>
      <th width="59" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Importe IC </span></th>
      <th width="61" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">IVA</span></th>
    </tr>
    <tr>
      <?php //traigo agregados
	  

$sSQL81= "
SELECT 
 *,((precioVenta*cantidad)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'

 order by fecha1,hora1 asc
";






if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 
$keyCAP=$myrow81['keyCAP'];
		 $a = $a + 1;
$art = $myrow81['codProcedimiento'];
$proc=$myrow81['codProcedimiento'];
$codigo=$myrow81['codProcedimiento'];




if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}





?>




      <td height="23" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow81['fecha1']." ".$myrow81['hora1'];
	?></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><span class="style12"><span class="<?php echo $estilo;?>">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
      </span></span>        <span class="style12">
        <?php  if($myrow81['um']=='s' or $myrow81['um']=='S'){
		echo '  ( Servicio )  ';
		} 
		?>
        <?php 
		if($myrow81['status']=='cerrada'){
		echo '<blink>'."[Cerrada]".'</blink>';
		} else {
		//echo '<blink>'."[CxC]".'</blink>';
		}
	?> </span> </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <?php  
	
	
 if($_POST['tipoVista']=='Agrupado'){
 echo $cantidad=$myrow14['cantidad2'];	
 } else {
		
		echo $cantidad=$myrow81['cantidad'];
			
		}

		
		?>
      </span></td>
	
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          
      <span class="style12"><span class="<?php echo $estilo;?>">
  
       <?php $importe=new acumulados();
		$importe->importe($keyCAP,$basedatos);?>
		
      </span></span> </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <?php 
		$mostrarIVA=new articulosDetalles();
		echo $mostrarIVA->mostrarIVA($keyCAP,$basedatos);
		?>
      </span></td>
	   <?php 
		
	if($tipoTrans and !$myrow81['sumaTres']){
	//echo "$".number_format("-".$myrow81['cantidadRecibida'],2);
	 $TOTAL+="-".$myrow81['cantidadRecibida'];
	} else {
	//echo "$".number_format($costoProcedimientos[0],2);
	//$TOTAL+=$costoProcedimientos[0];
	//echo "$".number_format($myrow81['sumaTres'],2);
	}
	
	?>
    </tr>
 
	
	
    <?php }?>
  </table>
  <p>
    <input name="paso_bandera1" type="hidden" id="paso_bandera1" value="<?php echo $bandera; ?>" />
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" /><?php 
//echo "$".number_format($TOTAL,2);
	?>
  </p>
  <div align="center">
    <p>&nbsp;</p>
    
    <table width="679" border="0" align="center" class="style12">
      <tr>
        <td width="139" class="style12">&nbsp;</td>
        <td width="139" class="style12">&nbsp;</td>
        <td width="139" class="style12">&nbsp;</td>
        <td width="139" height="23" class="style12">IVA</td>
        <td width="90" class="style12"><div align="right">
            <?php $iva=new acumulados(); 
		$iva=$iva->ivaAcumulado($basedatos,$usuario,$numeroE,$nCuenta);
		echo "$".number_format($iva,2);?>
        </div></td>
      </tr>
      <tr bgcolor="#FFCCFF">
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td bgcolor="#FFFFFF" class="style12">&nbsp;</td>
        <td height="23" class="style12">Total Cargos </td>
        <td class="style12"><div align="right">
            <?php 
		$totalAcumulado=new acumulados();
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),2);?>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
	
	
	
	
	
    <p>
      <input name="pagar" type="submit" class="style7" id="pagar" value="Aplicar Pago" />
      <input name="Submit" type="submit" class="style7" value="Trasladar a Compa&ntilde;ia" />
</p>
  </div>
  <p>&nbsp;</p>
</form>
<?php } ?>
<p align="center">&nbsp;</p>
<?php if($_POST['banderaFecha']){ ?>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script>
<?php }} ?>
</body>
</html>
<?php }} ?>
