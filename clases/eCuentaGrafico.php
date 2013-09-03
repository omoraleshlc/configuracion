<?php 
class eCuentas{
public function eCuenta($nT,$basedatos){
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




<?php //************************ACTUALIZO PRECIOS**********************


//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
//***************aplicar pago**********************
if(!$_POST['tipoVista']){
$_POST['tipoVista']='Detalle';
}
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
      <td class="Estilo24">Compa&ntilde;&iacute;a: </td>
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
		  <?php if($_POST['tipoVista']=='Detalle'){ ?>
		  selected="selected"
		  <?php } ?>
		   value="Detalle">Detalle</option>
        </select>
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  
    <?php if($_POST['tipoVista']){ ?>
  
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
	  
if($_POST['tipoVista']=='Agrupado' and $_POST['banderaFecha']){	  
$sSQL81= "
SELECT 
  *,((precioVenta*cantidad)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'
  and (status!='standby' and statusCargo!='standby')
  and
(fecha1 between'".$_POST['fecha']."' and '".$_POST['fecha2']."')


 
 group by codProcedimiento 
 order by fecha1,hora1 asc
";
} else if($_POST['tipoVista']=='Detalle' and $_POST['banderaFecha']){

$sSQL81= "
SELECT 
  *,((precioVenta*cantidad)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'
 
 and (status!='standby' and statusCargo!='standby')
   and 
 (fecha1 between'".$_POST['fecha']."' and '".$_POST['fecha2']."')

 order by fecha1,hora1 asc
";

} else if($_POST['tipoVista']=='Agrupado' and !$_POST['banderaFecha'] ){	

$sSQL81= "
SELECT 
  *,((precioVenta*cantidad)+iva) as sumaTres
FROM
cargosCuentaPaciente 
 WHERE 
numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'


 
 group by codProcedimiento 
 order by fecha1,hora1 asc
";
} else if($_POST['tipoVista']=='Detalle' and !$_POST['banderaFecha'] ){

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

}




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

 if($_POST['tipoVista']=='Agrupado'){
$sSQL14= "
SELECT 
sum(cantidad) as cantidad2
FROM
cargosCuentaPaciente
WHERE 
codProcedimiento = '".$proc."' and  numeroE = '".$numeroE."'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
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
		echo $importe->importe($keyCAP,$basedatos);
		?>
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
  </p>
  <div align="center">
    <p>&nbsp;</p>
    
    <table width="239" border="0" align="left" class="style12">
      <tr>
        <td width="139" height="23" bgcolor="#FFCCFF" class="style12">Medicamentos</td>
        <td width="90" bgcolor="#FFCCFF" class="style12"><div align="right"><?php echo $Tmedicamentos;?> </div></td>
      </tr>
      <tr>
        <td height="23" class="style12">Material Quir&uacute;rgico </td>
        <td class="style12"><div align="right"><?php echo $TPAT;?> </div></td>
      </tr>
      <tr bgcolor="#FFCCFF">
        <td height="23" class="style12">Servicios Hospitalarios </td>
        <td class="style12"><div align="right"><?php echo "$".number_format( $servicios[0],2);?> </div></td>
      </tr>
      <tr>
        <td height="23" class="style12">IVA</td>
        <td class="style12"><div align="right">
            <?php $iva=new acumulados(); 
		$iva=$iva->ivaAcumulado($basedatos,$usuario,$numeroE,$nCuenta);
		echo "$".number_format($iva,2);?>
        </div></td>
      </tr>
      <tr bgcolor="#FFCCFF">
        <td height="23" class="style12">Total Cargos </td>
        <td class="style12"><div align="right">
            <?php 
		$totalAcumulado=new acumulados();
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),2);?>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
	
	
	
	
	
    <table width="239" border="0" align="center" class="style12">
      <tr bgcolor="#FFCCFF">
        <td width="141" height="23" bgcolor="#FFCCFF" class="style12"><span class="style7">Total Abonos</span></td>
        <td width="88" class="style12">
          <div align="right">
            <?php 		 
		$abonos=new acumulados();
		echo "$".number_format($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta),2); ?>
        </div></td>
      </tr>
      <tr>
        <td height="23" class="style12">Saldo Actual </td>
        <td class="style12"><div align="right">
            <?php 
		$totalCargos=new acumulados();
		$totalCargos=$totalCargos->total($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),$abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta),$numeroE1,$nCuenta1);
		echo "$".number_format($totalCargos,2);
		?>
        </div></td>
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
