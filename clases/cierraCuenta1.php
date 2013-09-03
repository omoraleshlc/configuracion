<?php 
class eCuentas{
public function eCuenta($nT,$basedatos){
include("/configuracion/funciones.php"); 
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




<?php //************************ACTUALIZO PRECIOS**********************


//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$nCliente5=$myrow3['numeroE'];
$nCuenta5=$myrow3['nCuenta'];
//***************aplicar pago**********************


?>
<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
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

<h1 align="center">Estado de Cuenta </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="642" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
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
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left"><strong>M&eacute;dico: </strong></div></th>
      <th class="Estilo24" scope="col"><div align="left">
          <label> <?php echo $medico=$myrow3['medico']; ?> </label>
          <label> </label>
          <?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$medico."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?> </div></th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th width="134" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="408" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Seguro </td>
      <td class="Estilo24"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
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
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="Estilo24">N&deg; Credencial: </td>
      <td bgcolor="#FFCCFF" class="Estilo24"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Fecha</td>
      <td class="Estilo24"><span class="style12">
        <label>
        <input type="checkbox" name="banderaFecha" value="checkbox" onClick="javascript:this.form.submit();" 
		<?php if($_POST['banderaFecha']) echo 'checked="checked"'; ?>
		/>
        </label>
		
		
		<?php if($_POST['banderaFecha']){ ?>
        <input name="fecha" type="text" class="style12" id="campo_fecha"
	  value="<?php 
	  if($_POST['fecha']){
	  echo $_POST['fecha'];
	  } else {
	  if($myrow3['hoy']){
	  echo $myrow3['hoy'];
	  } else {
	  echo $fecha1; }} ?>" size="9" readonly="" />
        <label>
        <input name="button" type="button" class="style12" id="lanzador" value="..." />
        Entre </label>
      <input name="fecha2" type="text" class="style12" id="campo_fecha1"
	  value="<?php 
	  if($_POST['fecha2']){
	  echo $_POST['fecha2'];
	  } else {
	  if($myrow3['hoy']){
	  echo $myrow3['hoy'];
	  } else {
	  echo $fecha1; }} ?>" size="9" readonly="" />
        <label>
        <input name="button2" type="button" class="style12" id="lanzador1" value="..." />
        <input name="show" type="submit" class="style7" id="show" value="&gt;" />
        
        <?php } else { ?>
        <input name="fecha3" type="hidden" class="style12" id="fecha2" value="<?php echo 'all'; ?>"/>
		<?php } ?>
</label>
</span></td>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="Estilo24">Tipo de Vista: </td>
      <td bgcolor="#FFCCFF" class="Estilo24"><label>
        <select name="tipoVista" class="style7" id="tipoVista" onChange="javascript:form1.submit();">
          <option>Escoje la Opci&oacute;n</option>
          <option
		  <?php if($_POST['tipoVista']=='Agrupado'){ ?>
		  selected="selected"
		  <?php } ?>
		   value="Agrupado">Agrupado</option>
          
		  
		  <option
		  <?php if($_POST['tipoVista']=='Detalle' ){ ?>
		  selected="selected"
		  <?php } ?>
		   value="Detalle">Detalle</option>
        </select>
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  
    <?php if($_POST['tipoVista']){ ?>
  
  <table width="850" border="0" align="center">
    <tr>
      <th width="104" height="14" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Fecha/Hora (Cargo)</span></th>
      <th width="405" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Descripci&oacute;n</span></th>
      <th width="21" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Cant</span></th>
      <th width="59" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Costo U. </span></th>
      <th width="61" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">IVA</span></th>
      <th width="61" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">Total</span></th>
      <th width="54" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24"><span class="style12 ">Depto</span></span></th>
      <th width="51" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24"><span class="style12 ">Usuario</span></span></th>
    </tr>
    <tr>
      <?php //traigo agregados
	  
if($_POST['tipoVista']=='Agrupado' and $_POST['banderaFecha']){	  
$sSQL81= "
SELECT 
  *,((cantidad*costo)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE numeroE = '".$nCliente5."'
 
 and nCuenta='".$nCuenta5."'
  and (status!='standby' and statusCargo!='standby')
  and
(fecha1 between'".$_POST['fecha']."' and '".$_POST['fecha2']."')


 
 group by codProcedimiento 
 order by fecha1,hora1 asc
";
} else if($_POST['tipoVista']=='Detalle' and $_POST['banderaFecha']){

$sSQL81= "
SELECT 
  *,((cantidad*costo)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$nCliente5."'
 
 and nCuenta='".$nCuenta5."'
 
 and (status!='standby' and statusCargo!='standby')
   and 
 (fecha1 between'".$_POST['fecha']."' and '".$_POST['fecha2']."')
 
 order by fecha1,hora1 asc
";

} else if($_POST['tipoVista']=='Agrupado' and !$_POST['banderaFecha']){	

$sSQL81= "
SELECT 
  *,((cantidad*costo)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE 
numeroE = '".$nCliente5."'
 
 and nCuenta='".$nCuenta5."'
  and (status!='standby' and statusCargo!='standby')

 
 group by codProcedimiento 
 order by fecha1,hora1 asc
";
} else if($_POST['tipoVista']=='Detalle' and !$_POST['banderaFecha']){

$sSQL81= "
SELECT 
 *,((cantidad*costo)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$nCliente5."'
 
 and nCuenta='".$nCuenta5."'
  and (status!='standby' and statusCargo!='standby')
 
 
 
 
 order by fecha1,hora1 asc
";

}




if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a = $a + 1;
$art = $myrow81['codProcedimiento'];
$proc=$myrow81['codProcedimiento'];



$sSQL141= "
	SELECT 
  *
FROM
articulos
WHERE 
codigo = '".$proc."'
";
$result141=mysql_db_query($basedatos,$sSQL141);
$myrow141 = mysql_fetch_array($result141);
$sSQL151= "
	SELECT 
  *
FROM
 medicosPrecios
WHERE 
codMedico = '".$medico."' AND codProcedimiento = '".$proc."'
";
$result151=mysql_db_query($basedatos,$sSQL151);
$myrow151 = mysql_fetch_array($result151);
echo mysql_error();
//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

 if($_POST['tipoVista']=='Agrupado'){
$sSQL14= "
SELECT 
sum(cantidad) as cantidad2
FROM
cargosCuentaPaciente
WHERE 
codProcedimiento = '".$proc."' and  numeroE = '".$nCliente5."'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
}




$tipoTrans=$myrow81['tipoTransaccion'];
$sSQL6= "
	SELECT 
  *
FROM
catTTCaja
WHERE 
codigoTT = '".$tipoTrans."'
";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
?>




      <td height="23" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow81['fecha1']." ".$myrow81['hora1'];
	?></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <?php  if($myrow141['descripcion']){
		echo $myrow141['descripcion'];
		} else {
		echo $myrow6['descripcion'];
		}
		?>
        <span class="style12">
        <?php  if($myrow81['um']=='s' or $myrow81['um']=='S'){
		echo '  ( Servicio )  ';
		} 
		?>
      </span> </span></td>
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
        <?php 
	
     echo "$ ".number_format($myrow81['costo'],2);
	 //$costoProcedimientos[0]+=$myrow81['costo'];
	$costoProcedimientos[0]=$cantidad*$myrow81['costo'];
	if($myrow81['um']=='s' or $myrow81['um']=='S'){
$servicios[0]+=$costoProcedimientos[0];
}
	?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php  
	  if($myrow81['iva']){
	   echo "$ ".number_format($myrow81['iva'],2);
	   } else {
	   echo "0.00";
	   }
	   ?>&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <?php 
		
	if($tipoTrans and !$myrow81['sumaTres']){
	echo "$".number_format("-".$myrow81['cantidadRecibida'],2);
	 $TOTAL+="-".$myrow81['cantidadRecibida'];
	} else {
	//echo "$".number_format($costoProcedimientos[0],2);
	//$TOTAL+=$costoProcedimientos[0];
	echo "$".number_format($myrow81['sumaTres'],2);
	}
	
	?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php
	  if($myrow81['almacenDestino']){
	   echo $myrow81['almacenDestino'];
	   } else {
	   echo "---";
	   }
	?></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow81['usuario'];
	?></span></td>
    </tr>
 
	
	
    <?php }}?>
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
	  <?php 
//descuentos pacientes internos
$sSQL18= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$nCliente."' AND nCuenta ='".$nCuenta."' and nCuenta <>null
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
	
		
	<?php
//	echo "$".number_format($descuento,2); 
		 
		?>		
	  <?php } ?>
  
          <?php 
	 $sSQL13= "
	SELECT 
  sum(iva) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$nCliente5."'
 and
 nCuenta='".$nCuenta5."'
 and
(status!='standby' and statusCargo!='standby')
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $iva=$myrow13['sumaiva'];
		//echo "$".number_format($iva,2);
?>
  <?php 
 $sSQL17= "
	SELECT 
  sum(costo*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$nCliente5."'
 and
 nCuenta='".$nCuenta5."'
and 
(status!='standby' and statusCargo!='standby')
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	  $Tcargos=$myrow17['sumaCargos'];
		//echo "$".number_format($iva,2);
?>
      <?php 
		  $sSQL13= "
	SELECT 
  count(*) as Tmedicamentos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$nCliente5."'
 and
 nCuenta='".$nCuenta5."'
and
(um='S' or um='s')
and 
(status!='standby' and statusCargo!='standby')
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $Tservicios=$myrow13['Tmedicamentos'];
		//echo "$".number_format($iva,2);
?>
  </p>
  <div align="center">
    <p>&nbsp;</p>
    
    <table width="239" border="0" align="center" class="style12">
      <tr>
        <td width="139" height="23" bgcolor="#FFCCFF" class="Estilo24">Medicamentos</td>
        <td width="90" bgcolor="#FFCCFF" class="Estilo24"><?php echo $Tmedicamentos;?></td>
      </tr>
      <tr>
        <td height="23" class="Estilo24">Material Quir&uacute;rgico </td>
		<?php 
$sSQL16= "
	SELECT 
  sum(cantidadRecibida) as Tabonos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$nCliente5."'
 and
 nCuenta='".$nCuenta5."'
 and status='pagado'
";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
		  $Tabonos=$myrow16['Tabonos'];
		//echo "$".number_format($iva,2);
?>	
        <td class="Estilo24"><?php echo $TPAT;?></td>
      </tr>
      <tr>
        <td height="23" bgcolor="#FFCCFF" class="Estilo24">Servicios Hospitalarios </td>
        <td bgcolor="#FFCCFF" class="Estilo24"><?php echo "$".number_format( $servicios[0],2);?></td>
      </tr>
      <tr>
        <td height="23" class="Estilo24">IVA</td>
        <td class="Estilo24"><?php echo "$".number_format($iva,2);?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="307" border="0">
      <tr>
        <th width="88" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">Total Cargos </span></th>
        <th width="99" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">Total Abonos</span></th>
        <th width="98" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">
          <?php 
		$TT=$t1-$t2;
		if(($Tcargos-$Tabonos)<0){
		$informa='Saldo a Favor: ';
		} else {
		$informa='Total a Pagar: ';
		}
		echo $informa;
	?>
        </span></th>
      </tr>
      <tr>
        <td><div align="center"><span class="Estilo24"><?php echo "$".number_format($Tcargos,2);?></span></div></td>
        <td><div align="center"><span class="Estilo24"> <?php echo "$".number_format( $Tabonos,2);
	  $t1=$TOTAL+$Tiva;?>
            <?php //echo "$".number_format($deposito[0],2);
	  
	  $t2=$Tabonos;?>
        </span></div></td>
        <td><div align="center"><span class="Estilo24"><?php echo "$".number_format($Tcargos-$Tabonos,2);
	  
	  ?></span></div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
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
<?php } ?>
</body>
</html>
<?php }} ?>
