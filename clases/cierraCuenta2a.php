<?php 
class eCuentas{
public function eCuenta($bali,$transacciones,$TITULO,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){

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




//********************CIERRO STATUS CUENTA***********************
$agrega = "UPDATE cargosCuentaPaciente set 
statusCuenta='cerrada'


where
numeroE='".$numeroE."' 
and
nCuenta='".$nCuenta."'

";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*********************************************



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

   
   
<?php 
}






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
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>



<BODY  >
<?php //ventanasPrototype::links();?>
<h1 align="center"><?php echo $TITULO;?></h1>
<form id="form1" name="form1" method="post" action="">
  <table width="549" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="normal">
    <tr>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left">N&uacute;mero de Transacci&oacute;n: </div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left"><?php 
		 echo $nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="normal" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="134" bgcolor="#FFCCFF" class="normal" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="408" bgcolor="#FFCCFF" class="normal" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td class="normal">Compa&ntilde;&iacute;a: </td>
      <td class="normal"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="normal">N&deg; Credencial: </td>
      <td bgcolor="#FFCCFF" class="normal"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <td class="normal">Fecha</td>
      <td class="normal"><span class="normal">
        <label>
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
      <th class="normal" scope="col"><div align="left"><strong>M&eacute;dico: </strong></div></th>
      <th class="normal" scope="col"><div align="left">
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
      <td bgcolor="#FFCCFF" class="normal">Tipo de Vista: </td>
      <td bgcolor="#FFCCFF" class="normal"><label>
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
  
  
  
  
  
  
  
  
  
  
  <?php //compruebo el proceso de alta
$sSQL32= "Select * From procesoAlta WHERE (status='request' or status='cargado')
and
keyClientesInternos='".$_GET['nT']."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);
  
  ?>
  
  
  
  <?php if($myrow32['numeroE']) {?>
  <table width="471" border="0" align="center">
    <tr>
      <th width="420" height="15" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Departamento </span></div></th>
      <th width="58" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Fecha</span></div></th>
      <th width="76" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Hora</span></div></th>
      <th width="37" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Usuario</span></div></th>
      <th width="56" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Status </span></div></th>
    </tr>
    <tr>
      <?php   


  $sSQL= "Select * From almacenes WHERE entidad='".$entidad."'
  and
altaPaciente='si'
order by descripcion ASC
";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['almacen'];



$sSQL661= "Select * From procesoAlta 
WHERE
entidad='".$entidad."'
and
status='cargado'
and
almacen='".$A."'
and
keyClientesInternos='".$_GET['nT']."'";
$result661=mysql_db_query($basedatos,$sSQL661); 
$myrow661 = mysql_fetch_array($result661);

?>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="style71"><?php 
	  if($myrow661['status']){
	  echo $myrow['descripcion'];
	  } else {
	  echo $myrow['descripcion'].' [No se ha completado el proceso de Cierre]';
	  }
	  ?></span></td>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="style71"><?php 
	  if($myrow661['fecha'])
	  echo cambia_a_normal($myrow661['fecha']);?></span></td>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="style71"><?php echo $myrow661['hora'];?></span></td>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="style71"><?php echo $myrow661['usuario'];?></span></td>
      <td bgcolor="<?php echo $color?>" class="normal"><span class="style71"><?php 
	  if( !$myrow661['status']){
	  echo '<img src="/sima/imagenes/candado.png" alt="LA CUENTA ESTA EN REVISION" width="12" height="12" border="0">';
	  } else {
	  echo '<img src="/sima/imagenes/solicitado.png" alt="LA CUENTA ESTA EN REVISION" width="12" height="12" border="0">';
	  }
	  ?>
      <span class="normal"></span></span></td>
    </tr>
    <?php }}?>
  </table>
  <?php } ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <p>
    <?php if($_POST['tipoVista']){ ?>
  </p>



  
  
    <table width="847" border="0" align="center">
    <tr>
     
      <th width="96" height="14" bgcolor="#660066" class="blanco" scope="col"><div align="left"><span class="blanco ">Fecha/Hora </span></div></th>
      <th width="300" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="21" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">Cant</span></div></th>
      <th width="55" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">P.U.</span></div></th>
      <th width="55" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">Importe</span></div></th>
      <th width="33" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">IVA</span></div></th>
      <th width="27" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">Status</span></div></th>
      <th width="47" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">D Solicita</span></div></th>
      <th width="52" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">D Cargo.</span></div></th>
      <th width="72" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">Tipo P </span></div></th>
      <th width="38" bgcolor="#660066"  scope="col"><div align="left"><span class="blanco ">N </span></div></th>
    </tr>
	
      <?php //traigo agregados
	  
if($_POST['tipoVista']=='Agrupado' and $_POST['banderaFecha']){	  
$sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza,tipoTransaccion,porcentajeVariable,cargosHospitalarios,descripcion,status,almacen,statusDevolucion
FROM
cargosCuentaPaciente 
 WHERE keyClientesInternos='".$_GET['nT']."'
  
  and
(fecha1 between'".$_POST['fecha']."' and '".$_POST['fecha2']."')


 
 group by codProcedimiento 
 order by fecha1,hora1 asc
";
} else if($_POST['tipoVista']=='Detalle' and $_POST['banderaFecha']){

 $sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza,tipoTransaccion,porcentajeVariable,cargosHospitalarios,descripcion,status,almacen,statusDevolucion
FROM
cargosCuentaPaciente 
 WHERE 
keyClientesInternos='".$_GET['nT']."'
 
 and 
 (fecha1 between '".$_POST['fecha']."' AND '".$_POST['fecha2']."')
 
 order by hora1 asc
";

} else if($_POST['tipoVista']=='Agrupado' and !$_POST['banderaFecha'] ){	

$sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza,tipoTransaccion,porcentajeVariable,cargosHospitalarios,descripcion,status,almacen,statusDevolucion
FROM
cargosCuentaPaciente 
 WHERE 
keyClientesInternos='".$_GET['nT']."'
 
 group by codProcedimiento 
 order by fecha1,hora1 asc
";
} else if($_POST['tipoVista']=='Detalle' and !$_POST['banderaFecha'] ){

 $sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,gpoProducto,naturaleza,tipoTransaccion,porcentajeVariable,cargosHospitalarios,descripcion,status,almacen,statusDevolucion
FROM
cargosCuentaPaciente 
 WHERE 
keyClientesInternos='".$_GET['nT']."'
and 
status!='cancelado'
 
 
 
  order by fecha1,hora1 asc
";

}




if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


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





	$style='normal';
	
?>	
	
	
	
    <tr>






      <td height="21" bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div align="left"><span class="<?php echo $estilo;?>">
      <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></div></td>
	

	
	
      <td bgcolor="<?php echo $color;?>">
	  <div align="left">
	  
	  <span class="<?php echo $style;?>">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
if($myrow81['status']!='transaccion'){
				$nombreMed=new nombreMedico();
				
				//echo " ".$myrow81['descripcion'].$nombreMed->nombreMed($myrow81['almacen'],$basedatos);
				}
				
		?>
		
  
          
          <?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 
		?>
       </span>	   </div></td>
	   
	   
      <td bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div align="left">
        <?php  
	
	
 if($_POST['tipoVista']=='Agrupado'){
 echo $cantidad=$myrow14['cantidad2'];	
 } else {
		
		echo $cantidad=$myrow81['cantidad'];
			
		}

		
		?>
     </div></td>
	  
	  
	  
      <td bgcolor="<?php echo $color;?>" ><?php
	  if($myrow81['naturaleza']=='C'){
	  echo '$'.number_format($myrow81['precioVenta'],2);
	  } else {
	  echo '---';
	  }
	  ?></td>
      <td bgcolor="<?php echo $color;?>" ><div align="left"><span class="<?php echo $style;?>">
        <?php
		 
		if($myrow81['cargosHospitalarios']){
		$tipoTransaccion= $myrow81['tipoTransaccion']; 
		$sSQL6= "
	SELECT 
variable
FROM
catTTCaja
WHERE 
codigoTT = '".$tipoTransaccion."'
and
variable='si'
";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
		

		
	if($myrow6['variable']){

		if($myrow81['cargosHospitalarios']=='si'){ 	
		$banderaPM=new acumulados();
$precioVentaC=$banderaPM->banderaPorcentajeMedicamentos($entidad,$basedatos,$usuario,$numeroE,$nCuenta);
$precioVentaC=porcentaje($precioVentaC,$myrow81['porcentajeVariable'],$a);
} else {
$cargosAseguradora=new acumulados();
$precioVentaC=$cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta);
$precioVentaC=porcentaje($precioVentaC,$myrow81['porcentajeVariable'],$a);
}


//Actualiza
$q1 = "UPDATE cargosCuentaPaciente set 
precioVenta='".$precioVentaC."'
WHERE 
keyCAP='".$keyCAP."'";
//mysql_db_query($basedatos,$q1);
echo mysql_error();

		}}
		?>
      
          
          <?php $importe=new acumulados();
		  
		  
		
		echo $importe->importe($keyCAP,$basedatos);
		
		?>
          
     
		
		</span></div></td>
		
		
      <td bgcolor="<?php echo $color;?>" >
	  <div align="left">
	  <span class="<?php echo $style;?>">
        <?php $mostrarIVA=new articulosDetalles();
		echo $mostrarIVA->mostrarIVA($keyCAP,$basedatos);
		?>
      </span></div></td>
	  
	  
	  
	  
      <td bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div align="left">
        
        
        
    
          <?php 
$status=new acumulados();
echo $status->status($keyCAP,$basedatos,$usuario,$numeroE,$nCuenta);
	?>
        </div></td>
		
		
      <td bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div align="left">
      <?php echo $myrow81['almacenSolicitante'];
	?></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><div align="left"><?php echo $myrow81['almacenDestino'];
	?></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $style;?>"><?php echo $myrow81['tipoCliente'];
	?></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $style;?>">
	
        <div align="left">
          <?php echo $myrow81['naturaleza'];
	?></div></td>
	</tr>
 
	
	
    <?php }?>
  </table>


  <p>&nbsp;</p>
          <p>
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" />
  </p>
  <div align="center">
    <div align="left">
      <p>&nbsp;</p>
      
<?php	 
$mostrarCuadroGP=new cuadritoAcumuladoGPO();
echo $mostrarCuadroGP->mostrarCuadrito($_POST['fecha'],$_POST['fecha2'],'normal',$entidad,$numeroE,$nCuenta,$basedatos);
    ?>
        
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
    </div>
   
    
    <p>&nbsp;</p>
    <table width="239" border="0" align="center" class="normal">
      <tr>

	  
        <td width="141" height="23" class="normal">Total por Surtir (iva incluido ) </td>
        <td width="88" class="normal"><div align="right">
            <?php $totalxSurtir=new acumulados();
		echo "$".number_format($totalxSurtir->totalxSurtir($basedatos,$usuario,$numeroE,$nCuenta),2);?>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="239" border="0" align="left" class="normal">
      <tr>
        <td width="139" height="23" class="normal">IVA</td>
        <td width="90" class="normal"><div align="right">
            <?php $iva=new acumulados();
		$iva=$iva->ivaAcumulado($basedatos,$usuario,$numeroE,$nCuenta);
		echo "$".number_format($iva,2);?>
        </div></td>
      </tr>
      <tr bgcolor="#FFCCFF">
        <td height="23" class="normal">Total Cargos </td>
        <td class="normal"><div align="right">
            <?php 
		$totalAcumulado=new acumulados();
		$cargoS=$totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta);
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta)+$coaseguro,2);?>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="left">&nbsp;</p>
    <table width="239" border="0" align="left"  >
      <tr bgcolor="#FFCCFF">
        <td width="141" height="23" class="normal"><span class="normal">Total Abonos</span></td>
        <td width="88" class="normal">
		<div align="right">
		<?php 		 
		$abonos=new acumulados();
		$abonoS=$abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta); 
		echo "$".number_format($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta),2); ?>
          </div>	    </td>
      </tr>
      <tr>
        <td height="23" class="normal">Saldo Actual </td>
        <td class="normal"><div align="right">
        <?php 
		$totalCargos=new acumulados();
		$totalCargos=$totalCargos->total($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),$abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta),$numeroE1,$nCuenta1);
		
		if($abonoS<0){
		
		$abonoS*=-1;
		}
		
		$STotal=$cargoS-$abonoS;
		
		echo "$".number_format($cargoS-$abonoS,2);
		
		/* if(!$STotal and eregi('-',$STotal)){
		echo 'step';
		} */
		
	/* 	if(($cargoS-$abonoS>0){
		echo "$".number_format($cargoS-$abonoS,2);
		} else {
		echo "$".number_format(($cargoS-$abonoS)*-1,2);
		} */
		?>
          </div></td>
      </tr>
    </table>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php if($myrow3['status']!='cerrada'){ ?>
	
	
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	
	
    <table width="86%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="15%" scope="col">
		
		
		
		<table width="94" border="0" align="left">
          <tr bgcolor="#660066">
            <th class="blanco" scope="col">
			
			<span class="blanco">Particular<a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>')"> </a></span></th>
          </tr>
          <tr>
            <th width="98" bgcolor="#660066" class="blanco" scope="col"><span class="blanco"> <span class="blanco">Total a pagar </span> </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal"> <span class="normal">
                <?php  //echo "$".number_format($cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta),2);
		$cargosParticulares=new  acumulados();
		$T=$cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta);
		// $T=round($T,$ase);
		if($T and $transacciones=='si'){ ?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?almacenFuente=<?php echo $bali; ?>&numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'particular';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>&tipoPago=Efectivo')">
                <?php 	

		echo "$".number_format($cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta),2);
		?>
                </a>
                <?php 
		} else {
	
	    echo "$".number_format($cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta),2);
		}
		?>
            </span></span></div></td>
          </tr>
        </table>
		
		
		
		</th>
        <th width="2%" scope="col">&nbsp;</th>
        <th width="15%" scope="col"><table width="94" border="0" align="center">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco">Otros Clientes </span></th>
          </tr>
          <tr>
            <th width="88" bgcolor="#660066" scope="col"><span class="blanco">Total a pagar </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal">
                <?php 
		$otros=new acumulados();
		if($otros->otros($basedatos,$usuario,$numeroE,$nCuenta)>0){    ?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'otros';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>')">
                <?php 
		echo "$".number_format($otros->otros($basedatos,$usuario,$numeroE,$nCuenta),2);?>
                </a>
                <?php } else {
		
		echo "$".number_format($otros->otros($basedatos,$usuario,$numeroE,$nCuenta),2);
		}
		?>
            </span></div></td>
          </tr>
        </table></th>
        <th width="31%" scope="col">&nbsp;</th>
        <th width="2%" scope="col">&nbsp;</th>
        <th width="5%" scope="col">&nbsp;</th>
        <th width="16%" scope="col"><table width="94" border="0">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco">D.Coaseguro </span></th>
          </tr>
          <tr>
            <th width="88" bgcolor="#660066"  scope="col"><span class="blanco">Total a pagar </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal">
                <?php 
		$coaseguro=new acumulados();
		if($coaseguro->cargosCoaseguro($basedatos,$usuario,$numeroE,$nCuenta)>0){    ?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'coaseguro';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>')">
                <?php 
		echo "$".number_format($coaseguro->cargosCoaseguro($basedatos,$usuario,$numeroE,$nCuenta),2);?>
                </a>
                <?php } else {
		
		echo "$".number_format($coaseguro->cargosCoaseguro($basedatos,$usuario,$numeroE,$nCuenta),2);
		}
		?>
            </span></div></td>
          </tr>
        </table></th>
        <th width="14%" scope="col"><table width="94" border="0" align="right">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco"> Compa&ntilde;&iacute;a
                  <?php //echo "$".number_format($Tcargos,2);?>
                  <?php //echo "$".number_format( $Tabonos,2);
	  $t1=$TOTAL+$Tiva;?>
                  <?php //echo "$".number_format($deposito[0],2);
	  //echo "Pago por Otros";
	  $t2=$Tabonos;?>
            </span></th>
          </tr>
          <tr>
            <th width="172" bgcolor="#660066" class="blanco" scope="col">Saldo Cia. </th>
          </tr>
          <tr>
            <td><span class="normal">
              <?php $cargosAseguradora=new acumulados();
		if($cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta)!=null and $transacciones=='si'){ ?>
              <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>
		&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'aseguradora';?>&tipoVenta=<?php echo 'interno';?>')">
              <?php 
		
		echo "$".number_format($cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta),2);?>
              </a>
              <?php } else {
		
		echo "$".number_format($cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta),2);
		}		
		?>
            </span> </td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
  <?php  
  if(($cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta)==NULL or $cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta)==0)
  AND 
  ($totalxSurtir->totalxSurtir($basedatos,$usuario,$numeroE,$nCuenta)==NULL or $totalxSurtir->totalxSurtir($basedatos,$usuario,$numeroE,$nCuenta)==0)
  AND
  ($otros->otros($basedatos,$usuario,$numeroE,$nCuenta)==NULL or $otros->otros($basedatos,$usuario,$numeroE,$nCuenta)==0)
  AND
  ($cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta)==NULL or  $cargosAseguradora->cargosAseguradora($basedatos,$usuario,$numeroE,$nCuenta)==0)
  
  ) {?>
  <p align="center">
    
	<?php 
	if(!$myrow661['status']){ ?>
	<input name="faltan" type="submit" class="normal" id="cerrar" value="Faltan Departamentos" disabled=""/>	
	<?php } else { ?>
	<input name="cerrar" type="submit" class="normal" id="cerrar" value="Cerrar Cuenta" />
	<?php }//cierra validaciones de proceso de cierre de departamentos ?>
	
	
    <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $myrow3['keyClientesInternos']; ?>" />
  </p>
  <div align="center">
    <?php } ?>
    
    <?php } else { 
  echo "LA CUENTA DEL PACIENTE ".$myrow3['paciente']." ESTA CERRADA...";
  ?>
    <input name="imprimir" type="submit" class="normal" id="imprimir" value="Imprimir" />
    <?php }
   ?>
  </div>
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

