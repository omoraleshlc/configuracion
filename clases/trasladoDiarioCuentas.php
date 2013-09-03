<?php 
class Diarios{
public function trasladoDiarioCuentas($entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){

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
if(!$bali){
$bali=$_GET['almacenFuente'];
}

 $sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************

if($_POST['actualizar']){



$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];
for($i=0;$i<=$_POST['bandera2'];$i++){

if($aseguradora[$i]){
$status='efectivo';
$keyCAP[]=$aseguradora[$i];
} else {

$status='cxc';
$keyCAP[]=$particular[$i];
}


$agrega = "UPDATE cargosCuentaPaciente set 
statusAlta='".$status."',
usuarioAlta='".$usuario."',
fechaAlta='".$fecha1."',
horaAlta='".$hora1."'

where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();




} //cierra for
} //cierra actualizar






$cargosParticulares=new  acumulados();
$totalxSurtir=new  acumulados();
$cargosAseguradora= new acumulados();
$otros= new acumulados();


if($_POST['cerrar'] AND $cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta)==NULL 
  AND 
  $totalxSurtir->totalxSurtir($basedatos,$usuario,$numeroE,$nCuenta)==NULL
  AND
  $otros->otros($basedatos,$usuario,$numeroE,$nCuenta)==NULL
  AND
  $cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta)==NULL
  ){
$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];
for($i=0;$i<=$_POST['bandera2'];$i++){
$agrega = "UPDATE cargosCuentaPaciente set 
status='cerrada',
usuarioAlta='".$usuario."',
fechaAlta='".$fecha1."',
horaAlta='".$hora1."'

where
numeroE='".$numeroE."' 
and
nCuenta='".$nCuenta."'
and statusAlta='efectivo'
";

//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//cierro cuenta
 $agrega = "UPDATE clientesInternos set 
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."'

where
keyClientesInternos='".$_GET['nT']."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

//cierro cuarto a sucio
$agrega = "UPDATE cuartos set 
status='sucio',
usuarioSalida='".$usuario."',
fechaSalida='".$fecha1."',
horaSalida='".$hora1."'

where
codigoCuarto='".$cuarto."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

$leyenda='Se cerró la cuenta';
?>
<script type="text/vbscript">
msgbox "LA CUENTA <?php echo $_GET['nT']?> ESTA CERRADA!"
</script>';

<script>
javascript:ventanaSecundaria6('/sima/INGRESOS%20HLC/caja/imprimirCierreCuenta.php?numeroE=<?php echo $nCliente5; ?>&amp;nT=<?php echo $numeroCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;orden=<?php echo $E; ?>&amp;hora1=<?php echo $hora1; ?>');
</script>

<script>
close();
   </script>
   <script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
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
<?php ventanasPrototype::links();?>
<h1 align="center">Reporte Diario de Cuentas </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="642" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td width="134" class="Estilo24">Fecha</td>
      <td width="408" class="Estilo24"><span class="style12">
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
  </table>
  <p>&nbsp;</p>



  
  
    <table width="847" border="0" align="center">
    <tr>
      <th width="60" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">#MOV </span></div></th>
      <th width="96" height="14" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Fecha/Hora </span></div></th>
      <th width="300" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="21" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Cant</span></div></th>
      <th width="55" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Importe</span></div></th>
      <th width="33" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">IVA</span></div></th>
      <th width="27" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Status</span></div></th>
      <th width="47" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">D Solicita</span></div></th>
      <th width="52" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">D Cargo.</span></div></th>
      <th width="72" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Tipo P </span></div></th>
      <th width="38" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">N </span></div></th>
    </tr>
	
      <?php //traigo agregados
	  
if($_POST['tipoVista']=='Agrupado' and $_POST['banderaFecha']){	  
$sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza
FROM
cargosCuentaPaciente 
 WHERE numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'
  and (status!='standby' and statusCargo!='standby' and status!='cxc' AND status!='cancelado')
  and
(fecha1 between'".$_POST['fecha']."' and '".$_POST['fecha2']."')


 
 group by codProcedimiento 
 order by fecha1,hora1 asc
";
} else if($_POST['tipoVista']=='Detalle' and $_POST['banderaFecha']){

$sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'
 
 and (status!='standby' and statusCargo!='standby' and status!='cxc' AND status!='cancelado')
   and 
 (fecha1 between'".$_POST['fecha']."' and '".$_POST['fecha2']."')

 order by hora1 asc
";

} else if($_POST['tipoVista']=='Agrupado' and !$_POST['banderaFecha'] ){	

$sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza
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
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza
FROM
cargosCuentaPaciente 
 WHERE 
 numeroE = '".$numeroE."'
 
 and nCuenta='".$nCuenta."'

and 
status!='cancelado'
 
 
 
  order by fecha1,hora1 asc
";

}




if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];

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
	
	
	
    <tr>
<td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><?php echo $myrow81['keyCAP'];?></span></div></td>





      <td height="21" bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
      <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><span class="style12"><span class="style7">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        </span></span>        <span class="style12">
          
          <?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 
		?>
          
      </span> </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
        <?php  
	
	
 if($_POST['tipoVista']=='Agrupado'){
 echo $cantidad=$myrow14['cantidad2'];	
 } else {
		
		echo $cantidad=$myrow81['cantidad'];
			
		}

		
		?>
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
        
        <span class="style12"><span class="style7">
          
          <?php $importe=new acumulados();
		echo $importe->importe($keyCAP,$basedatos);
		?>
          
        </span></span> </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><div align="left"><span class="style7">
        <?php $mostrarIVA=new articulosDetalles();
		echo $mostrarIVA->mostrarIVA($keyCAP,$basedatos);
		?>
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><div align="left"><span class="style7">
        
        
        
        <span class="style12">
          <?php 
$status=new acumulados();
echo $status->status($keyCAP,$basedatos,$usuario,$numeroE,$nCuenta);
	?>
        </span></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><div align="left"><span class="style7"><span class="style12">
      <?php echo $myrow81['almacenSolicitante'];
	?></span></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><div align="left"><span class="style7"><span class="style12"><?php echo $myrow81['almacenDestino'];
	?></span></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><span class="Estilo24"><?php echo $myrow81['tipoCliente'];
	?></span></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
	
        <div align="left"><span class="style7"><span class="style12">
          <?php echo $myrow81['naturaleza'];
	?></span>
        </span></div></td>
      <?php if($myrow811['statusAlta']=='cxc'){ $flagCxC='activa';?>
	  <?php } else if($myrow811['status']=='pagado' ) { $flagCxC='inactiva'; ?>
	  <?php } else { $flagCxC='inactiva';?>
		<?php } ?>
		
		
		

	  	  <?php if(($myrow811['statusAlta']=='efectivo' or !$myrow811['statusAlta']) and $myrow811['status']!='pagado'){ ?>
	  <?php } else if($myrow811['status']=='pagado') { ?>
		<?php }  ?>
	</tr>
 
	
	
    <?php }}} }?>
  </table>


</form>
</body>
</html>
<?php  ?>

