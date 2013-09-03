<?php 
class eCuentasE{
public function eCuentaE($entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){


include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();
?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript>
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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








<?php 


if(!$_POST['tipoVista']){
$_POST['tipoVista']='Detalle';

}
?>

<?php if($_POST['imprimir']) { ?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosInternosCC.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>');
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>

<?php } ?>












<?php //************************ACTUALIZO **********************

$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$keyClientesInternos=$myrow3['keyClientesInternos'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$entidad=$myrow3['entidad'];

if($myrow3['seguro']){
$tipoCliente='aseguradora';
$seguro=$myrow3['seguro'];
} else {
$tipoCliente='particular';
}

//***************aplicar pago**********************
?>
<?php //transaccion estatica

if($_POST['aplicar'] and is_numeric($_POST['porcentaje']) and $_POST['gpoProducto']){
$keyCAP=$_POST['keyCAP'];
$fechaDescuento=$fecha1.' '.$hora1;



if($_POST['gpoProducto']=='*'){
$sSQL7="SELECT keyCAP
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''

";
}else{
$sSQL7="SELECT keyCAP
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and 
gpoProducto='".$_POST['gpoProducto']."'
";
}

  $result7=mysql_db_query($basedatos,$sSQL7);
while(  $myrow7 = mysql_fetch_array($result7)){







if($myrow3['seguro']){
$agrega = "UPDATE cargosCuentaPaciente set 
fechaDescuento='".$fechaDescuento."',
usuarioDescuento='".$usuario."',
statusDescuento='aplicado',
precioOriginal=precioVenta,
ivaOriginal=iva,
precioVenta=precioVenta-precioVenta*('".$_POST['porcentaje']."'*0.01),
cantidadAseguradora=cantidadAseguradora-cantidadAseguradora*('".$_POST['porcentaje']."'*0.01),
ivaParticular=ivaAseguradora-ivaAseguradora*('".$_POST['porcentaje']."'*0.01),
iva=iva-iva*('".$_POST['porcentaje']."'*0.01)

where
keyCAP='".$myrow7['keyCAP']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{

$agrega = "UPDATE cargosCuentaPaciente set 
usuarioDescuento='".$usuario."',
fechaDescuento='".$fechaDescuento."',
statusDescuento='aplicado',
precioOriginal=precioVenta,
ivaOriginal=iva,
precioVenta=precioVenta-precioVenta*('".$_POST['porcentaje']."'*0.01),
cantidadParticular=cantidadParticular-cantidadParticular*('".$_POST['porcentaje']."'*0.01),
ivaParticular=ivaParticular-ivaParticular*('".$_POST['porcentaje']."'*0.01),
iva=iva-iva*('".$_POST['porcentaje']."'*0.01)

where
keyCAP='".$myrow7['keyCAP']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

}
}




$agrega = "UPDATE clientesInternos set 
descuento='si',
porcentajeDescuento='".$_POST['porcentaje']."',
usuarioDescuento='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();



$sSQL7= "Select descripcionGP From gpoProductos where entidad='".$entidad."' and codigoGP='".$_POST['gpoProducto']."'";
$result7=mysql_db_query($basedatos,$sSQL7); 
$myrow7 = mysql_fetch_array($result7);
echo mysql_error();
?>
<script>
window.alert("Se le hizo un descuento del <?php echo $_POST['porcentaje'];?>%");
window.opener.document.forms["form10"].submit();
window.close();
</script>
<?php 

}
?>














<?php
if($_POST['actualiza']){

$seguro=$_POST['seguro'];
$keyCAP=$_POST['keyCAP'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($seguro[$i]){
$agrega = "UPDATE cargosCuentaPaciente set 
seguro='".$seguro[$i]."'
where
keyCAP='".$keyCAP[$i]."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();


}
}?>
<script>
window.alert("Se actualizaron registros!");
</script>
<?php 
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
<head>
<style type="text/css">
<!--
.devolucion {color: #FFFFFF;font-size: 10px}

-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>



<BODY  >
<?php //ventanasPrototype::links();?>
<h1 align="center" class="titulos">Estado de Cuenta Informativo</h1>
<p align="center" class="negro">No v&aacute;lido para fines fiscales</p>
<form id="form1" name="form1" method="post" action="">
  <table width="582" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="normal">
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left">Folio de Venta</div></th>
      <th bgcolor="#330099" class="blanco" scope="col"><div align="left"><?php echo $_GET['folioVenta'];
		  $nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="normal" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="168" bgcolor="#330099" class="normal" scope="col"><div align="left" class="blancomid"><strong>Paciente</strong></div></th>
      <th width="407" bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Compa&ntilde;&iacute;a</td>
<td bgcolor="#FFFFFF" class="normalmid"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">N&deg; Credencial</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Fecha de Reporte</td>
      <td bgcolor="#FFFFFF" class="normalmid"><span class="normal">
        <label>
        <?php print cambia_a_normal($myrow3['fecha']);?>
        <input type="checkbox" name="banderaFecha" value="checkbox" onClick="javascript:this.form.submit();" 
		<?php if($_POST['banderaFecha']) echo 'checked="checked"'; ?>
		/>
        </label>
		
		
		<?php if($_POST['banderaFecha']){ ?>
        <input name="fecha" type="text" class="normal" id="campo_fecha"
	  value="<?php 
	  if($_POST['fecha']){
	  echo $_POST['fecha'];
	  } else {
	  if($myrow3['hoy']){
	  echo $myrow3['hoy'];
	  } else {
	  echo $fecha1; }} ?>" size="9" readonly="" />
        <label>
        <input name="button" type="button" class="normal" id="lanzador" value="..." />
        Entre </label>
      <input name="fecha2" type="text" class="normal" id="campo_fecha1"
	  value="<?php 
	  if($_POST['fecha2']){
	  echo $_POST['fecha2'];
	  } else {
	  if($myrow3['hoy']){
	  echo $myrow3['hoy'];
	  } else {
	  echo $fecha1; }} ?>" size="9" readonly="" />
        <label>
        <input name="button2" type="button" class="normal" id="lanzador1" value="..." />
        <input name="show" type="submit" class="normal" id="show" value="&gt;" />
        
        <?php } else { ?>
        <input name="fecha3" type="hidden" class="normal" id="fecha2" value="<?php echo 'all'; ?>"/>
		<?php } ?>
</label>
</span></td>
    </tr>
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left"><strong>M&eacute;dico</strong></div></th>
      <th bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left">
          <label></label>
          
          <?php 
$sSQL18= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow3['medico']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".$rNombre18['descripcion'];?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Fecha Internamiento</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print cambia_a_normal($myrow3['fecha']);?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Dx Entrada</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print $myrow3['dx'];?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Tipo de Vista</td>
      <td bgcolor="#FFFFFF" class="normalmid"><label>
        <select name="tipoVista" class="normal" id="tipoVista" onChange="javascript:form1.submit();">
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
  
  
  
  
  
  
  
  
  
  
  <p>
    <?php if($_POST['tipoVista']){ ?>
  </p>



  
  
  <table width="994" border="0.2" align="center">
    <tr bgcolor="#330099">
      <th width="42" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Ref</div>
      </div></th>
      <th width="42" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Fecha</div>
      </div></th>
      <th width="260" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Descripcion</div>
      </div></th>
      <th width="118" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Departamento/Dr</div>
      </div></th>
      <th width="159" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Tipo</div>
      </div></th>
      <th width="36" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Cant.</div>
      </div></th>
      <th width="70" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">P.Unit.</div>
      </div></th>
      <th width="70" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Part.</div>
      </div></th>
      <th width="67" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">Aseg.</div>
      </div></th>
      <th width="42" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="center">IVA</div>
      </div></th>
      <th width="42" bgcolor="#330099" class="blanco" scope="col">N</th>
    </tr>
    <tr>
      <?php 
 $sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
 gpoProducto!=''
 order by descripcionArticulo
  ASC
";		
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codProcedimiento'];
//*************************************CONVENIOS********************************************
$sSQL12= "
SELECT descripcion
FROM
  articulos
WHERE 
entidad='".$entidad."'
and
(keyPA='".$myrow['keyPA']."' or codigo='".$myrow['codProcedimiento']."')
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


//cierro descuento
if($myrow['statusDevolucion']=='si' AND $myrow['naturaleza']=='A'){
$devolucionFinal[0]+=(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']));
}

if($myrow['naturaleza']=='C'){
$cargosFinal[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}

if($myrow['statusDevolucion']!='si'){
if($myrow['naturaleza']=='A'){
$abonosFinal[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}
}
?>
    </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td bgcolor="<?php echo $color;?>" class="codigos"><?php echo $myrow['keyCAP']; ?></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><?php echo cambia_a_normal($myrow['fecha1']); ?></td>
      <td height="24" bgcolor="<?php echo $color;?>" class="normal"><?php 
		if($myrow['status']=='transaccion'){
		$sSQL341= "Select descripcion From catTTCaja WHERE entidad='".$entidad."' and codigoTT = '".$myrow['tipoTransaccion']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);

		echo $myrow341['descripcion'];
		}else{
		
		echo $myrow['descripcionArticulo'];
		}
		?>
          <?php 
		
		
		echo '</br>';
		if($myrow['statusDevolucion']=='si' and $myrow['naturaleza']=='A'){
		
		print '<span class="error">'.'[Devolucion Folio: '.$myrow['folioDevolucion'] . ']'.'</span>';
		}else{
		if($myrow['statusCargo'] == 'standbyR'){
		print '<blink><span  class="error">'.'El usuario: '.$myrow['usuario'].' no ha enviado la solicitud!'.'</span></blink>';
		}else if($myrow['statusCargo'] =='standby'){
		print '<span class="error">'.'[sin surtir]'.'</span>';
		}else if($myrow['statusCargo']=='cargado'){
		print '<span  class="codigos">'.'[cargado]'.'</span>';
		}
		}
		//echo $myrow['statusDevolucion'].$myrow['folioDevolucion'];
		?>
      </td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
          <?php 
$sSQL12a1= "
SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
 and
almacen='".$myrow['almacenDestino']."'
";
$result12a1=mysql_db_query($basedatos,$sSQL12a1);
$myrow12a1 = mysql_fetch_array($result12a1);
echo $myrow12a1['descripcion'];
?>
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
          <?php 
$sSQL12a= "
SELECT descripcionGP
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'
";
$result12a=mysql_db_query($basedatos,$sSQL12a);
$myrow12a = mysql_fetch_array($result12a);
echo $myrow12a['descripcionGP'];
?>
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><?php echo $myrow['cantidad']?></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
        <?php 
		if( $myrow['naturaleza']=='C'){
		echo '$'.number_format($myrow['precioVenta'],2);
		}
		?>
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="precionormal2">
          <?php 
		if($myrow['naturaleza']=='C'){
		$particular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
	if(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad'])){
	  echo "$".number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);
	}  else {
	echo "0.00";
	}
	} else if($myrow['naturaleza']=='A'){
	echo '-$'.number_format($myrow['precioVenta'],2);
	}
	?>
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="precionormal1">
          <?php 
		  
	if($myrow['naturaleza']=='C'){
		$aseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
	if(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad'])){
	  echo "$".number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
	}  else {
	echo "0.00";
	}
	}
	  ?>
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class="negro">
          <?php 
		if($myrow['naturaleza']=='C'){
	$isva[0]+=$myrow['iva']*$myrow['cantidad'];
	echo '$'.number_format($myrow['iva']*$myrow['cantidad'],2);
	}
	
	  ?>
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
        <?php 
		if($myrow['statusDevolucion']=='si' and $myrow['naturaleza']=='A'){
		echo 'A';
		}else{
		echo $myrow['naturaleza'];
		}
		?>
      </div></td>
    </tr>
    <?php }?>
  </table>
  <p align="center">&nbsp;</p>
  <p align="center">
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" />
  </p>
  <p>&nbsp;</p>
    <table width="279" border="0" align="center" class="normal">
      <tr>

	  
        <td width="197" height="23" class="normalmid">Total por Surtir (iva incluido ) </td>
        <td width="72" class="normalmid"><div align="right">
            <?php $totalxSurtir=new acumulados();
		echo "$".number_format($totalxSurtir->totalxSurtirFV($entidad,$basedatos,$usuario,$_GET['folioVenta']),2);?>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="left">
    <?php 
$despliegaTotales=new totales();
$despliegaTotales-> tt($entidad,$class,$estilo,$fechas1,$fechas2,$myrow3['keyClientesInternos'],$_GET['folioVenta'],$basedatos);
?>
    </p>
    
    <?php } ?>
	
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="379" border="1" align="center" class="style7">
      <tr>
        <th width="91" scope="col"><div align="left"><span class="normal">Grupo de Producto</span></div></th>
        <th width="272" scope="col"><div align="left"><span class="normal">
            <?php //*********gpoProductos

 $sSQL7= "Select * From gpoProductos where entidad='".$myrow3['entidad']."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
            <select name="gpoProducto" class="Estilo24" id="gpoProducto">
              <option value="*">TODOS LOS GRUPOS</option>
              <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
              <option 
		   <?php if($myrow7['codigoGP']==$myrow['gpoProducto']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
              <?php } 
		
		?>
            </select>
        </span></div></th>
      </tr>
      <tr>
        <td><div align="left">Porcentaje: </div></td>
        <td><label>
            <div align="left">
            
            <?php 
		
		$coaseguroN=new acumulados();
		$coa=$coaseguroN->cargosCoaseguroN($entidad,$basedatos,$usuario,$keyClientesInternos);	
		$totalAcumulado=new acumulados();
		$totalDevoluciones=new acumulados();
		$iva=new acumulados();
$ivaD=new acumulados();
$iva=$iva->ivaAcumulado($entidad,$basedatos,$usuario,$keyClientesInternos)-$ivaD->ivaAcumuladoD($entidad,$basedatos,$usuario,$keyClientesInternos);
		$cargos=(($totalAcumulado->totalAcumulado($basedatos,$usuario,$keyClientesInternos)-$totalDevoluciones->dev($entidad,$basedatos,$usuario,$folioVenta))+$iva)+$coa;
		

		

		//echo "$".number_format($cargos,2);?>
            
              <input name="porcentaje" type="text" class="style7" id="porcentaje" size="3"  value="<?php echo $_POST['porcentaje'];?>"  <?php echo $statusD?> autocomplete="off" />
<input name="totalCargos" type="hidden" class="style7" id="porcentaje" 
value="<?php echo $cargos;?>"/>
              <input name="nT" type="hidden" class="style7" id="porcentaje" value="<?php echo $_GET['nT']?>" />
              <input name="bandera" type="hidden" class="style7" id="porcentaje" value="<?php echo $a;?>" />
            </div>
          </label>
            <label></label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="aplicar" type="submit" class="style7" id="aplicar" value="Aplicar" <?php echo $statusD?> /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	
	
    <p>&nbsp;</p>
  </div>
 

  <p align="center">
    <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $myrow3['keyClientesInternos']; ?>" />
  </p>
</form>
<?php if($_POST['banderaFecha']){ ?>
<p align="center">
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
  </script> 
</p>
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



<?php 
}

}
?>

