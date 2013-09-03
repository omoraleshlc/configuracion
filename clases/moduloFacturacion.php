<?php 
class facturacion{
public function facturaDirecta($tipoFacturacion,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){

include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();

?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

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




<?php //************************ACTUALIZO **********************
//********************Llenado de datos
if(!$_GET['nT']){
$_GET['nT']=$nT;
}

//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' or keyClientesInternos='".$_GET['nT1']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$seguro=$myrow3['seguro'];
//***************aplicar pago**********************


if($_GET['facturar'] and $_GET['numFactura'] and $_GET['flag']=='standby'){

$keyCAP=$_GET['keyCAP'];

for($i=0;$i<=$_GET['bandera'];$i++){

if($keyCAP[$i]){

//**********************
 $sSQL31= "Select statusFactura From cargosCuentaPaciente WHERE keyCAP = '".$keyCAP[$i]."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
//verifico q ya esta facturado

if($myrow31['statusFactura']=='solicita'){
 $agrega = "UPDATE cargosCuentaPaciente set 
folioFactura='".$_GET['numFactura']."',
statusFactura='facturado',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."'

where
keyCAP='".$keyCAP[$i]."'";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda='Se facturó con El número de Factura es el '.$_GET['numFactura'];

} else {
$leyenda='registros ya facturados!';

}


}
}
echo $leyenda;
 echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
self.close();
  // -->
</script>';
$flag='load';
} else {
$flag='standby';
}














if($_GET['quitar']){
$keyCAP=$_GET['keyCAP1'];

for($i=0;$i<=$_GET['bandera'];$i++){
if($keyCAP[$i]){
$agrega = "UPDATE cargosCuentaPaciente set 

statusFactura='standby',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."'

where
keyCAP='".$keyCAP[$i]."' 
";

//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
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
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>
<head>






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




<BODY  >

<h1 align="center">FACTURACION</h1>
<form id="form1" name="form1" method="get" action="">
  <table width="413" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left">Transacci&oacute;n: </div></th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left"><?php 
		 echo $nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_GET['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
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
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


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
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left"># de Factura </div></th>
      <th class="Estilo24" scope="col"><div align="left">
        <label>

      <input name="numFactura" type="text" class="style7" id="numFactura" value="<?php if($_GET['numFactura']){ 
	  echo $_GET['numFactura'];
	  }
	  ?>" <?php if($_GET['numFactura']){ 
	  echo 'disabled=""';
	  }
	  ?>/>

        </label>
      </div></th>
    </tr>
  </table>
  <p  style="border:thin" align="center"><?php //echo 'Vas a Facturar el '.$_GET['porcentaje'];?></p>



 

    


  <table width="550" border="0" align="center">
    <tr>
      <th width="62" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">#MOV </span></div></th>
      <th width="100" height="14" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Fecha/Hora </span></div></th>
      <th width="282" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="25" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Cant</span></div></th>
      <th width="59" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Importe</span></div></th>
    </tr>
	
      <?php //traigo agregados





if($seguro){
 $sSQL81= "
SELECT 
*
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'
 
and
status='transaccion'
and
statusFactura='solicita'



 order by hora1 asc
";
} else {
$sSQL81= "
SELECT 
*
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'
 
 and
status!='transaccion'
   
and
tipoCliente='particular'
 order by hora1 asc
";
}





if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];
$keyCAP1[]=$myrow81['keyCAP'];
$fecha1=$myrow81['fecha1'];
$fecha2=$myrow81['fecha1'];

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



//****
 $sSQL= "
SELECT sum(precioVenta*cantidad) as precioVentas
from 
cargosCuentaPaciente
WHERE 
gpoProducto= '".$myrow81['gpoProducto']."'
and
keyCAP='".$keyCAP."'
";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);



  
$sSQL31= "Select statusFactura From cargosCuentaPaciente WHERE keyCAP = '".$keyCAP."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>	
	
	
	
    <tr>


<td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><?php echo $myrow81['keyCAP'];?></span>
  <input name="keyCAP[]" type="hidden" id="keyCAP[]" value="<?php 
		 echo $myrow81['keyCAP'];
		  ?>" />
</div></td>





      <td height="21" bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
      <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><span class="style12"><span class="style7">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);

		?>
        </span></span>        <span class="style12">
          
          <?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 
				if($myrow31['statusFactura']=='cargado'){
		echo '<blink>'. '[REGISTRO FACTURADO] '.'</blink>';
		}
		?>
          
      </span> </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">

      </span><span class="<?php echo $estilo;?>"><?php echo $myrow81['cantidad'];?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
        
        <span class="style12"><span class="style7">
          	<?php 
	
 $sSQL17= "
	SELECT 
  sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
AND
status!='transaccion'
AND
numeroE = '".$numeroE."'
 and
 nCuenta='".$nCuenta."'
and
statusCargo='cargado'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 $porcentaje=$importes[0]/$myrow17['sumaCargos'];
$porcentaje=$_GET['porcentaje'];
$pP=$porcentaje;

$pV= $myrow17['sumaCargos']-($myrow17['sumaCargos']*$porcentaje);


$cantidadRegistros+=1;
$importes[0]+=$myrow81['precioVenta'];

echo "$".number_format($myrow81['precioVenta'],2);
$cantidadTransaccion[0]+=$myrow81['precioVenta'];

?>
          
        </span></span> </span></div></td>
    </tr>
 
	
	
    <?php 
	$FECHA[$a]=$myrow81['fecha1'];
	
	}?>
  </table>

  <p align="center">
    <?php 
	
	$sSQL74="SELECT SUM(precioVenta*cantidad) as acumuladoPrincipal
FROM
cargosCuentaPaciente
WHERE

(numeroE='".$numeroE."' and nCuenta='".$nCuenta."')
 and  statusCargo='cargado'
  ";
  $result74=mysql_db_query($basedatos,$sSQL74);
  $myrow74 = mysql_fetch_array($result74);
  


$porcentaje=number_format($cantidadTransaccion[0]/$myrow74[0],2);
 
	?>
<label>
      <input name="facturar" type="submit" class="style7" value="Facturar"  />
    </label>
      <label>

	  
	  </label>
  </p>
  
  
   
  <?php 
  	if($myrow31['statusFactura']=='solicita'){ ?>
		
		
  
<p align="center" class="style71">
<a href="#" onClick="javascript:ventanaSecundaria('printInvoice.php?numeroE=<?php echo $numeroE; ?>
&nCuenta=<?php echo $nCuenta; ?>&entidad=<?php echo $entidad; ?>&nT=<?php echo $nT; ?>&numFactura=<?php echo $_GET['numFactura'];?>&porcentaje=<?php echo $_GET['porcentaje'];?>&tipoCliente=<?php echo $_GET['tipoCliente'];?>')">
	Imprimir Factura 
	</a>
   
   
<---->  
<a href="#" onClick="javascript:ventanaSecundaria('printDetailsInvoice.php?numeroE=<?php echo $numeroE; ?>
&nCuenta=<?php echo $nCuenta; ?>&almacenSolicitante=<?php echo $ALMACEN; ?>&entidad=<?php echo $entidad; ?>&numFactura=<?php echo $_GET['numFactura'];?>')">
   Imprimir Detalles 
   </a>
  </p>
<?php } ?>
  
  
  
  <div align="center">
    <p align="left">
	

<table width="384" border="0" align="left" cellpadding="1" cellspacing="1" class="style7">
        <tr>
          <th width="216" bgcolor="#FFCCFF" class="<?php echo $estilo;?>" scope="col"><div align="left">Descripci&oacute;n</div></th>
          <th width="76" bgcolor="#FFCCFF" class="<?php echo $estilo;?>" scope="col"><div align="left">Importe</div></th>
          <th width="78" bgcolor="#FFCCFF" class="<?php echo $estilo;?>" scope="col"><div align="left">% Importe aPagar </div></th>
        </tr>
        <tr>
<?php
 $sSQL71="SELECT sum(precioVenta) as sumaAbonos
FROM
cargosCuentaPaciente
WHERE
(numeroE='".$numeroE."' and nCuenta='".$nCuenta."')
and
tipoCobro='Efectivo'
and
status='transaccion'
and
naturaleza='A'";

 
  $result71=mysql_db_query($basedatos,$sSQL71);
  $myrow71 = mysql_fetch_array($result71);

	
		  
 $sSQL= "
SELECT codigoGP,descripcionGP FROM gpoProductos
WHERE 
entidad='".$entidad."' 
and
activo='activo'
";
 






if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$C=$myrow['codigoGP'];



$sSQL7="SELECT SUM(precioVenta*cantidad) as acumulado,SUM(iva*cantidad) as sumaIVA
FROM
cargosCuentaPaciente
WHERE
gpoProducto='".$C."'
and


(numeroE='".$numeroE."' and nCuenta='".$nCuenta."')
 and (status!='standby' and statusCargo!='standby'  AND status!='cancelado')
 and
 status='cxc'
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);

$sumarIVA[0]+=$myrow7['sumaIVA'];
$acumulado[0]+=$myrow7['acumulado'];


?>
          <td  bgcolor="<?php echo $color;?>" ><div align="left"><span class=""> <?php echo $myrow['descripcionGP']; ?></span></div></td>
		  
		  
		
          <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><?php 
	 

	  echo "$".number_format($myrow7['acumulado'],2);	  

	   ?></td>
          <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
		  <?php 
		  if($myrow7[0]){
		  $porcentaje=$_GET['porcentaje'];
		  $importePorcentaje=$myrow7[0]*$porcentaje;
		  $importeP[0]+=$importePorcentaje;
		  echo "$".number_format($importePorcentaje,2);
		  } else {
		  echo '$'.'0.00';
		  }
		  ?>
		  &nbsp;</td>
        </tr>
        <?php }}?>
    </table>
	
	
	 </p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <table width="384" height="0" border="0" align="left" cellpadding="0" cellspacing="1" class="style7">
      <tr>
        <td bgcolor="#660066" class="style14"><span class="Estilo24">IVA (Acumulado) </span></td>
        <td bgcolor="#660066" class="style14">
		<?php echo "$".number_format($sumarIVA[0],2); ?>
		&nbsp;</td>
        <td bgcolor="#660066" class="style14"><span class="style71">
          <?php
		
$sSQL74="SELECT SUM(iva*cantidad) as sumaIVA
FROM
cargosCuentaPaciente
WHERE
(numeroE='".$numeroE."' and nCuenta='".$nCuenta."')
and
status!='transaccion'

 and (status!='standby' and statusCargo!='standby'  AND status!='cancelado')
  ";
  $result74=mysql_db_query($basedatos,$sSQL74);
  $myrow74 = mysql_fetch_array($result74);
  $sumaIVA=$myrow74['sumaIVA']*$_GET['porcentaje'];
		echo "$".number_format($sumaIVA,2);
		?>
        </span></td>
      </tr>
      <tr>
        <td width="46%" bgcolor="#660066" class="style14"><div align="left">TOTALES</div></td>
		
<td width="17%" bgcolor="#660066" class="style14"><span class="style71"><?php echo "$".number_format( $acumulado[0]+$sumarIVA[0],2); ?></span></td>
        <td width="16%" bgcolor="#660066" class="style14"><span class="style71"><?php echo "$".number_format($importeP[0]+$sumaIVA,2);?></span></td>
      </tr>
      <tr>
        <td class="style71">
		<?php 
		

		?>
		&nbsp;</td>
        <td class="style71">&nbsp;</td>
        <td class="style71">&nbsp;</td>
      </tr>
    </table>

	
	
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>

   <input name="bandera" type="hidden" value="<?php echo $a;?>" />
   <input name="flag" type="hidden" value="<?php echo $flag;?>" />
   <input name="nT1" type="hidden" id="nT1" value="<?php echo $_GET['nT'];?>" />
   <input name="nT" type="hidden" id="nT" value="<?php echo $_GET['nT'];?>" />
   <input name="tipoCliente" type="hidden" id="tipoCliente" value="<?php echo $_GET['tipoCliente'];?>" />
</form>
<?php } ?>
<p align="center">&nbsp;</p>
<?php if($_GET['banderaFecha']){ ?>
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

