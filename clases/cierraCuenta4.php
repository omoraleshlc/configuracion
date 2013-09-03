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

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************


if($_POST['escoje']){
$keyCAP=$_POST['keyCAP'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($keyCAP[$i]){
 $sql = "UPDATE cargosCuentaPaciente set 

statusFactura='solicita',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."'

where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}
$_GET['inactiva']='activa';
}







if($_GET['inactiva']=='inactiva'){
$keyCAP=$_GET['keyCAP'];


if($keyCAP){
$agrega = "UPDATE cargosCuentaPaciente set 

statusFactura='standby',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."'

where
keyCAP='".$keyCAP."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
$_GET['inactiva']=='activa';

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
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
-->
</style>


</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
-->
</style>




<BODY  >

<h1 align="center">Solicitar servicios/art&iacute;culos Facturaci&oacute;n </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="413" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left">Transacci&oacute;n: </div></th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left"><?php 
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
  </table>
  <p align="center" class="style7"><em>(nota: Puedes escojer varios para el proceso de cierre) </em></p>



 

    


  <table width="764" height="0" border="0" align="center" class="style7">
    <tr>
      <th width="62" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">#MOV </span></div></th>
      <th width="100" height="14" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Fecha/Hora </span></div></th>
      <th width="282" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="59" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Importe</span></div></th>
      <th width="43" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Facturado</span></div></th>
      <th width="45" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Standby</span></div></th>
      <th width="45" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Quitar</span></div></th>
      <th width="45" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Escojer</span></th>
      <th width="45" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Status</span></div></th>
    </tr>
	
<?php //traigo agregados
	  


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

$statFactura[$a]=$myrow81['statusFactura'];

if($statFactura[$a]=='solicita'){
$statFactura[$a]='solicita';

} else if($statFactura[$a]=='standby'){
$statFactura[$a]='standby';

}
?>	

	
	
    <tr>
<td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><?php echo $myrow81['keyCAP'];?></span></div></td>





      <td height="21" bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
      <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><span class="style12">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        </span>        <span class="style12">
          
          <?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 
		?>
          
      </span> </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
        
        <span class="style12">
          
        <?php 
		
		
		if($myrow81['naturaleza']=='A'){
		$suma[0]=($myrow81['precioVenta']);
		$sumaImporte+=$suma[0];
		echo "$".number_format($suma[0],2);
		}else{
		echo 'N/A';
		}
		?>
        </span> </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
	    <?php 
$sSQL341= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE nT='".$_GET['nT']."' and tipoCliente='".$myrow81['tipoCliente']."' ";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
  echo "$".number_format($myrow341[0],2);
  $sumaFacturado+=$myrow341[0];
  ?>
	  
	  &nbsp;</td>
     
	 
	  <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
	  <div align="center">
        <?php 
		if($statFactura[$a]=='standby'){  ?>
<input name="keyCAP[]" type="radio" id="keyCAP[]" value="<?php echo $myrow81['keyCAP'];?>" checked="checked"  />
        <?php } else { echo '---'; } ?>
      </div></td>
	  
	   
  
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
	  
	  <?php 
		if($statFactura[$a]=='solicita'){ $dork+=1;?>
	  <a href="<?php echo $_SERVER['PHP_SELF'];?>?nT=<?php echo $_GET['nT']; ?>&keyCAP=<?php echo $myrow81['keyCAP'];?>&seguro=<?php echo $_POST['seguro']; ?>&inactiva=<?php echo'inactiva'; ?>&tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&codigo=<?php echo $C; ?>"><img src="/sima/imagenes/iconosSima/delete_icon.jpg" alt="Quitar" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar la solicitud de factura para este registro?') == false){return false;}" /></a>
	  <?php } else { echo '---';}?>	  </td>
	  
	  
	  
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><div align="center">
	  
	  <?php $diferencia[0]=number_format(ltrim($myrow81['precioVenta'])-ltrim($myrow341[0]),2);
	  if($diferencia[0]!='0.00'){?>
	  
	  
	  <?php if($myrow81['tipoCliente']=='particular' and $statFactura[$a]=='solicita'){ ?>
	  <a href="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/cxc/subCuentas.php?nRequisicion=<?php echo $requisicion; ?>&almacen=<?php echo $ALMACEN; ?>&nT=<?php echo $_GET['nT']; ?>&keyCAP=<?php echo $myrow81['keyCAP'];?>&aseguradora=<?php echo $_GET['aseguradora']; ?>&entidad=<?php echo $entidad; ?>&particular=<?php echo $_GET['particular']; ?>&referido=<?php echo $_GET['referido']; ?>&gpoProducto=<?php echo $gpoProducto; ?>&tipoCliente=<?php echo $myrow81['tipoCliente']; ?>&codigo=<?php echo $C; ?>&almacenes=<?php echo $Cd; ?>')"><img src="/sima/imagenes/agregar.gif" alt="Modificar Precios" width="12" height="12" border="0" /></a>
	  <?php } else if($myrow81['tipoCliente']=='aseguradora' and $statFactura[$a]=='solicita'){ ?>
	    <a href="" onClick="javascript:ventanaSecundaria6('applyInvoiceEnterprise.php?nT=<?php echo $keyClientesInternos;?>&tipoFacturacion=<?php echo $tipoFacturacion;?>')">
	  <img src="/sima/imagenes/agregar.gif" alt="Modificar Precios" width="12" height="12" border="0" /></a>
	  
	  
	  
	  <?php } else if($myrow81['tipoCliente']=='coaseguro' and $statFactura[$a]=='solicita'){ ?>
	    <a href="" onClick="javascript:ventanaSecundaria6('applyInvoiceCoaseguro.php?nT=<?php echo $keyClientesInternos;?>&tipoFacturacion=<?php echo $tipoFacturacion;?>')">
	  <img src="/sima/imagenes/agregar.gif" alt="Modificar Precios" width="12" height="12" border="0" /></a>
	  <?php } else { 
	  echo '---';
	  }
	  ?>
	  <?php } else {  echo '---';}?>
	  
	  </div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
        <div align="left">
          <?php 
		if($statFactura[$a]=='solicita'){ ?>
          
          <img src="/sima/imagenes/letraS.jpg" alt="Solicita Factura" width="12" height="12" border="0" />
          
          <?php } else if($statFactura[$a]=='cargado'){ ?>
          
          <img src="/sima/imagenes/letraF.jpg" alt="Solicita Factura" width="12" height="12" border="0" />
          <?php } else { echo '---';
		
		}?>
          </div></td></tr>
 
	
	
    <?php }?>
  </table>

  <p>&nbsp;</p>
  <p align="center">
    <?php if( $dork>0){ $maguila=1;}else{$maguila==NULL;}?>
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" /><?php 
//echo "$".number_format($TOTAL,2);
	?>

      <label>
      <input name="escoje" type="submit" class="style7" id="escoje" value="Escojer Elementos" />
      </label>
      <label></label>
    <label></label>
  </p>
 
<input name="bandera" type="hidden" value="<?php echo $a;?>" />
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

