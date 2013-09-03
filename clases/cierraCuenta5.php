<?php 
class eCuentas{
public function eCuenta($tipoFacturacion,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){

include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();




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
   window.open(URL,"ventana6","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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
  <script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
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




<?php //************************ACTUALIZO **********************
//********************Llenado de datos


//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************


if($_POST['aplicarFactura'] and is_numeric($_POST['folioFactura'])){
$keyCAP=$_POST['keyCAP'];
$importe=$_POST['importe'];
for($i=0;$i<=$_POST['bandera'];$i++){


$sSQL37= "Select statusFactura From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result37=mysql_db_query($basedatos,$sSQL3);
$myrow37 = mysql_fetch_array($result37);

if($myrow37['statusFactura']!='facturado' and $keyCAP[$i]){





$sql = "UPDATE cargosFacturados set 

status='facturado'
where
status='standby'
and
numFactura='".$_POST['folioFactura']."'
and
nT='".$keyCAP[$i]."' and keyClientesInternos='".$_POST['keyClientesInternos']."'
";

mysql_db_query($basedatos,$sql);
echo mysql_error();


$sql = "UPDATE cargosCuentaPaciente set 
folioFactura='".$_POST['folioFactura']."',
statusFactura='facturado'
where
status='transaccion'
and
keyCAP='".$keyCAP[$i]."' and folioVenta='".$_GET['folioVenta']."'
";

mysql_db_query($basedatos,$sql);
echo mysql_error();




//****************************************************
//compruebo si todavia sigue vigente la factura, si queda algo por facturar
$sSQL14= "
SELECT 
(cargosCuentaPaciente.precioVenta-sum(cantidadFacturada)) as cantidadF
FROM
cargosCuentaPaciente,cargosFacturados
WHERE 
cargosCuentaPaciente.keyCAP='".$keyCAP[$i]."' and
cargosCuentaPaciente.keyCAP=cargosFacturados.nT
and
cargosFacturados.numFactura='".$_POST['folioFactura']."'
and
cargosFacturados.status='facturado'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);












if($myrow3['statusFactura']!='facturado' and !$myrow14['cantidad'] and $_POST['disponible']==$_POST['importe'] or ($_POST['disponible'] and !$_POST['solicita'])){
//echo 'meto todo';


if($_POST['disponible'] and !$_POST['solicita']){
$_POST['importe']=$_POST['disponible'];


$agrega = "INSERT INTO cargosFacturados (numFactura,cantidadFacturada,porcentaje,usuario,fecha,tipoCliente,seguro,nt,keyClientesInternos,status,statusImpresion) values('".$_POST['folioFactura']."','".$_POST['importe']."','".$porcentaje."','".$usuario."','".$fecha1."','aseguradora','".$myrow3['seguro']."','".$keyCAP[$i]."','".$_POST['keyClientesInternos']."','facturado','standby')";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
}



}//cierra validacion del IF

//************************lo facturado == importe ***************************
  $sSQL13= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE numFactura='".$_POST['folioFactura']."' and
nT='".$keyCAP[$i]."' and status='facturado'";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);



if(round($myrow13['cantidadF'],2)==$importe){
$sql = "UPDATE clientesInternos set 
numeroFactura='".$_POST['folioFactura']."',
statusFactura='facturado'
where
folioVenta='".$_GET['folioVenta']."'
";

mysql_db_query($basedatos,$sql);
echo mysql_error();
}
//**************************************************************************


//******************************************************
}



}
$_GET['inactiva']='activa';

$sqla = "UPDATE clientes set 
rfc='".$_POST['rfc']."',
razonSocial='".$_POST['razonSocial']."',
calle='".$_POST['calle']."',
colonia='".$_POST['colonia']."',
ciudad='".$_POST['ciudad']."',
estado='".$_POST['estado']."',
cp='".$_POST['cp']."',
pais='".$_POST['pais']."'
where
numCliente='".$myrow3['seguro']."'
";

mysql_db_query($basedatos,$sqla);
echo mysql_error();
?>
 <script language="JavaScript" type="text/javascript">
javascript:ventanaSecundaria2('/sima/cargos/printDetailsInvoice.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>'); 
window.opener.document.forms["form1"].submit();
window.location = 'ctaTransferidas.php'
self.close();
</script> 
<?php






}









if($_POST['escoje'] and $_POST['escojer']){

$keyCAP=$_POST['escojer'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyCAP[$i]){
$sql = "UPDATE cargosCuentaPaciente set 

statusFactura='request',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."',
folioFactura='".$_POST['folioFactura']."'

where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}

}







if($_POST['quitar2'] and $_POST['quitar']){
$keyCAP=$_POST['quitar'];

for($i=0;$i<=$_GET['bandera'];$i++){
if($keyCAP){
$agrega = "UPDATE cargosCuentaPaciente set 

statusFactura='standby',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."',
folioFactura=''
where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
}

}
}

?>








<?php


$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
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


<head>
<?php
$estilo= new muestraEstilos();
$estilo->styles();
?>

<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF;
          background:#000066;

}
 
-->
</style>

</head>

<BODY  >

<h1 align="center" class="titulos">Solicitar servicios/art&iacute;culos Facturaci&oacute;n </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="413" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Transacci&oacute;n: </div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left"><?php 
		 echo $keyClientesInternos=$nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th width="134" bgcolor="#FFCCFF" class="normal" scope="col"><div align="left"><strong>Paciente</strong></div></th>
      <th width="408" bgcolor="#FFCCFF" class="normal" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td class="normal">Folio de Venta</td>
      <td class="normal"><label><?php echo $myrow3['folioVenta'];?></label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="697" border="3" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo1">
    <tr>
      <th class="blanco" scope="col"><div align="left">Fecha</div></th>
      <th class="blanco" scope="col"><div align="left">
          <?php  echo cambia_a_normal($myrow3['fecha1']);
		  ?>
      </div></th>
      <th bgcolor="#660066" class="blanco"  scope="col"></th>
      <th  scope="col" class="blanco"></th>
      <th  scope="col"></th>
    </tr>
    <tr>
      <th class="blanco" scope="col"><div align="left"><strong>Paciente </strong></div></th>
      <th class="blanco" scope="col"><div align="left">
          <?php  $keyClientesInternos=$nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <?php echo $myrow3['paciente']; ?>
          <input name="numeroE2" type="hidden" class="Estilo24" id="numeroE2" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
      </div></th>
      <th bgcolor="#660066" class="blanco"  scope="col">&nbsp;</th>
      <th  scope="col" class="blanco"><div align="left">Compa&ntilde;&iacute;a</div></th>
      <th  scope="col"><div align="left"><span class="blanco">
          <?php $traeSeguro=$myrow3['seguro']; ?>
          <?php
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$myrow3['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
echo $myrow455['nomCliente'];
?>
          <input name="seguro" type="hidden" id="seguro" value="<?php echo $traeSeguro; ?>" />
      </span></div></th>
    </tr>
    <tr>
      <th colspan="5" class="blanco" scope="col"> <div align="center"># Factura
        <input autocomplete="off" name="folioFactura" type="text" <?php if($_POST['folioFactura']){ echo 'class="normal"';}?> id="folioFactura" value="<?php echo $_POST['folioFactura'];?>"  />
        </div>
          <div align="left"></div>
        <div align="left"></div></th>
    </tr>
  </table>
  <p align="center" class="style7">&nbsp;</p>



 

    

<?php if($myrow3['statusFactura']!='facturado' ){ ?>
  <table width="880" height="0" border="0" align="center" class="style7">
    <tr>
      <th width="45" bgcolor="#660066" class="blanco" scope="col"><div align="left">#Folio </div></th>
      <th width="103" height="14" bgcolor="#660066" class="blanco" scope="col"><div align="left">Fecha/Hora </div></th>
      <th width="260" bgcolor="#660066" class="blanco" scope="col"><div align="left">Descripci&oacute;n/Concepto</div></th>
      <th width="69" bgcolor="#660066" class="blanco" scope="col"><div align="left">Importe</div></th>
      <th width="60" bgcolor="#660066" class="blanco" scope="col"><div align="left">Solicita</div></th>
      <th width="67" bgcolor="#660066" class="blanco" scope="col"><div align="left">Facturado</div></th>
      <th width="71" bgcolor="#660066" class="blanco" scope="col"><div align="left">Disponible</div></th>
      <th width="61" bgcolor="#660066" class="blanco" scope="col"><div align="left">Escojer</div></th>
      <th width="60" bgcolor="#660066" class="blanco" scope="col"><div align="left">Quitar</div></th>
      <th width="42" bgcolor="#660066" class="blanco" scope="col"><div align="left"></div></th>
    </tr>
	
<?php //traigo agregados
	  


$sSQL81= "
SELECT 
*
FROM
cargosCuentaPaciente 
 WHERE 
folioVenta='".$_GET['folioVenta']."'
 and
 naturaleza='A'

 order by hora1 asc
";






if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];




$sSQL14= "
SELECT 
statusFactura
FROM
cargosCuentaPaciente
WHERE 
keyCAP='".$keyCAP."'


";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);


?>	

	
	
    <tr>
<td bgcolor="<?php echo $color;?>" class="codigos"><div align="left"><?php echo $myrow81['keyCAP'];?>
  <input name="keyCAP[]" type="hidden" id="keyCAP" value="<?php echo $keyCAP;?>" />
</div></td>

      <td height="21" bgcolor="<?php echo $color;?>" class="normal"><div align="left">
      <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="left">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
                  
          <?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 
		?>
          
 </div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="left">
       

        <?php 
		
		
		if($myrow81['naturaleza']=='A'){
		$suma[0]=($myrow81['precioVenta']);
		$sumaImporte[0]+=$suma[0];
		echo "$".number_format($suma[0],2);
		}else{
		echo 'N/A';
		}
		?>

          
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><?php 
 $sSQL341= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE numFactura='".$_POST['folioFactura']."' and
nT='".$myrow81['keyCAP']."' and status='standby'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
$solicita[0]+=$myrow341['cantidadF'];
echo "$".number_format($myrow341['cantidadF'],2);
 
  ?></td>
  

  

  
  
      <td bgcolor="<?php echo $color;?>" class="normal">
	  <?php 
 $sSQL321= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE numFactura='".$_POST['folioFactura']."' and
nT='".$myrow81['keyCAP']."' and status='facturado'";
$result321=mysql_db_query($basedatos,$sSQL321);
$myrow321 = mysql_fetch_array($result321);
$myrow321['cantidadF']=round($myrow321['cantidadF'],2);

	  $facturado[0]+=$suma[0]-$myrow321['cantidadF'];
	  
	  echo "$".number_format($myrow321['cantidadF'],2);
	  ?></td>
     
	 
	  <td bgcolor="<?php echo $color;?>" class="normal"><?php 
	  $disponible[0]+=$suma[0]-$myrow321['cantidadF'];
	  echo "$".number_format($suma[0]-$myrow321['cantidadF'],2);
	  
	  
	  ?></td>
	  <td bgcolor="<?php echo $color;?>" class="normal">
	  
	  
	 
	  
	  <div align="left">
	  <?php if($myrow81['statusFactura']=='standby' and $myrow81['tipoCobro']=='Cuentas por Cobrar'){ ?>
        <input name="escojer[]" type="checkbox" id="escojer[]" value="<?php echo $myrow81['keyCAP'];?>" />
		<?php } else { echo $escojer='---';} ?>
		
		
      </div>
	  
	 
	  </td>
	  
	  

	  <td bgcolor="<?php echo $color;?>" class="normal">
	
	 
	 
	    <div align="left">
		 <?php if($myrow81['statusFactura']=='request'){ $quitar+=1;?>
          <input name="quitar[]" type="checkbox" id="quitar[]" value="<?php echo $myrow81['keyCAP'];?>" />
		  	<?php } else { echo $quitar='---';} ?>
        </div>	
		
		</td>
		
		
		
	  <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
	  
	 
	  <a href="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/cxc/subCuentasParticular.php?nRequisicion=<?php echo $requisicion; ?>&almacen=<?php echo $ALMACEN; ?>&nT=<?php echo $_GET['nT']; ?>&keyCAP=<?php echo $myrow81['keyCAP'];?>&aseguradora=<?php echo $_GET['aseguradora']; ?>&entidad=<?php echo $entidad; ?>&particular=<?php echo $_GET['particular']; ?>&referido=<?php echo $_GET['referido']; ?>&gpoProducto=<?php echo $gpoProducto; ?>&tipoCliente=<?php echo $myrow81['tipoCliente']; ?>&codigo=<?php echo $C; ?>&almacenes=<?php echo $Cd; ?>')">
	  <label></label>
	  </a>
	  
	  
	 
	  
	  <?php 
	  $diferiencia=$suma[0]-$myrow341['cantidadF'];
	  if($_POST['folioFactura'] and $diferiencia!='0' and $myrow81['statusFactura']=='request'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria8('ventanaCambiaImporte.php?keyCAP=<?php echo $myrow81['keyCAP']; ?>
&seguro=<?php echo $myrow3['seguro']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>')"><img src="/sima/imagenes/modificascl.png" width="12" height="12" border="0" /></a>
      <?php } ?>
</div></td>
      </tr>
 
	
	
    <?php }  ?>
  </table>
<?php } ?>


  <p>
  <p>&nbsp;</p>
  <label>
    <div align="center">
      <div align="center">
	
	<input name="importe" type="hidden" class="style71" id="importe" value="<?php echo $sumaImporte[0];?>" />
	<input name="disponible" type="hidden" class="style71" id="disponible" value="<?php echo $disponible[0];?>" />
	<input name="solicita" type="hidden" class="style71" id="solicita" value="<?php echo $solicita[0];?>" />
	<input name="facturado" type="hidden" class="style71" id="facturado" value="<?php echo $facturado[0];?>" />
	
        <?php if(!$myrow31['sumaFacturada']){ ?>
        <input name="escoje" type="submit" class="style71" id="escoje" value="Escojer Elementos" />
        <input name="quitar2" type="submit" class="style71" id="quitar" value="Quitar Elementos" />
          <?php } ?>
		        
  </div>
  </label>
  <p align="center">
    <label>
	
	  
	<?php 
	
 $sSQL331= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE numFactura='".$_POST['folioFactura']."' and
nT='".$myrow81['keyCAP']."' and status='standby'";
$result331=mysql_db_query($basedatos,$sSQL331);
$myrow331 = mysql_fetch_array($result331);



	if(!$solicita[0] and $_POST['folioFactura']){ ?>
    <input name="aplicarFactura" type="submit" class="style7" id="aplicarFactura" value="Facturar" onClick="if(confirm('Estas seguro que deseas facturar <?php echo "$".number_format($disponible[0],2);?> pesos?') == false){return false;}" />

<?php } else { ?>
    <input name="aplicarFactura" type="submit" class="style7" id="aplicarFactura" value="Facturar" onClick="if(confirm('Estas seguro que deseas facturar <?php echo "$".number_format($solicita[0],2);?> pesos?') == false){return false;}" />
	<?php } ?>
	
	

    </label>
  </p>
 
<input name="bandera" type="hidden" value="<?php echo $a;?>" />

<input name="keyClientesInternos" type="hidden" value="<?php echo $myrow3['keyClientesInternos'];?>" />
</form>
<?php } ?>

	<?php 
	if($myrow3['statusFactura']=='facturado'){ 
	echo 'Registros ya Facturados';
	}
	?>

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

