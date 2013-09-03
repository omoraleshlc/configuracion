<?php 
class subCuentas{
public function subCuenta($ID_EJERCICIO,$folioFactura,$bali,$tipoCliente,$TITULO,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){

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
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>







<?php //************************ACTUALIZO **********************
//********************Llenado de datos
if(!$_GET['nT']){
$_GET['nT']=$nT;
}
if(!$bali){
$bali=$_GET['almacenFuente'];
}

 $sSQL3= "Select * From RFC WHERE entidad='".$entidad."' and RFC = '".$_GET['rfc']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



//***************aplicar pago**********************

if($_POST['escoje']){

$keyCAP=$_POST['keyCAP'];
$solicita=$_POST['solicita'];
$solicita1=$_POST['solicita1'];
for($i=0;$i<=$_POST['bandera'];$i++){

$sSQL34= "Select statusFactura From cargosCuentaPaciente WHERE keyCAP='".$solicita[$i]."'  ";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);

if($solicita[$i]){



if($myrow34['statusFactura']=='solicita'){
$agrega = "UPDATE cargosCuentaPaciente set 

statusFactura='standby'
where
keyCAP='".$solicita[$i]."' 
";
} 
mysql_db_query($basedatos,$agrega);
echo mysql_error();
} 



} //cierra for
} //cierra actualizar






?>




<?php 

/*
echo '<script language="JavaScript" type="text/javascript">
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>';*/

if($_POST['facturar']){ 

if($_POST['cantidadSolicitada']){

if( $_POST['cantidadSolicitada']<=$_POST['cantidadActual']){

$porcentaje=$_POST['cantidadSolicitada']/$_POST['cantidadActual'];
 $agrega = "INSERT INTO cargosFacturados (numFactura,cantidadFacturada,porcentaje,usuario,fecha,tipoCliente,seguro,nT) values('".$_GET['folioFactura']."','".$_POST['cantidadSolicitada']."','".$porcentaje."','".$usuario."','".$fecha."','".$_GET['tipoCliente']."','".$myrow3['seguro']."','".$_GET['nT']."')";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
 echo '<script language="JavaScript" type="text/javascript">
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>';



} else {
 $leyenda= 'La cantidad no debe ser mayor a la q existe!';
}
} else {
 $leyenda='Escribe la cantidad!';
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
.style72 {font-size: 10px}
.style72 {font-size: 10px}
.style1 {color: #FF0000}
.style73 {color: #FF0000}
.style73 {color: #FF0000;font-size: 9px}
.style74 {color: #FF0000}
.style74 {color: #FF0000;font-size: 9px}
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
.style1 {color: #FF0000;font-size: 9px}
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
<h1 align="center"><?php echo $TITULO;?></h1>
<form id="form1" name="form1" method="post" action="">
  <table width="264" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="134" bgcolor="#660066" class="style14" scope="col"><div align="left">Factura </div></th>
      <th width="408" bgcolor="#660066" class="style14" scope="col">
	
          <div align="left">
            <input name="folioFactura" type="hidden" class="Estilo24" id="folioFactura" 
		  value="<?php echo $_GET['folioFactura'];?>" readonly=""/>
          <?php echo $_GET['folioFactura'];?>          </div></th>
    </tr>
  </table>
  <p>
    <label></label><?php 
$sSQL341= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE numFactura='".$_GET['folioFactura']."'  ";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
  
  ?>
  </p>
  <p align="center">&nbsp;</p>
  <table width="607" border="0" align="center">
    <tr>
      <th width="54" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 "># Registro </span></div></th>
      <th width="87" height="14" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Fecha/Hora </span></div></th>
      <th width="246" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="56" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Cant</span></div></th>
      <th width="53" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Importe</span></div></th>
      <th width="85" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Importe</span>Facturado</div></th>
    </tr>
	
      <?php //traigo agregados
	  

$sSQL81= "
SELECT 
* FROM
cargosCuentaPaciente 
 WHERE 
 entidad='".$entidad."'
 and
 folioFactura='".$_GET['folioFactura']."'
 
 
  order by fecha1,hora1 asc
";




$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];






 


?>	
	
	
	
    <tr>
<td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><?php echo $myrow81['keyCAP'];?></span> 
  <label>
  <input name="keyCAP[]" type="hidden" id="keyCAP[]" value="<?php echo $keyCAP;?>"  />
  </label>
</div></td>





      <td height="21" bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
      <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><span class="style12"><span class="style7">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
if($myrow81['status']!='transaccion'){
				$nombreMed=new nombreMedico();
				echo " ".$myrow81['descripcion'].$nombreMed->nombreMed($medico,$basedatos);
				}
				
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
        <span class="style12"><span class="style7">
      
          <?php 
  $sSQL31= "Select sum(cantidadFacturada) as sumaFacturada From cargosFacturados WHERE numFactura = '".$_GET['folioFactura']."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
		  
		$cantidadActual[0]+=($myrow81['precioVenta']*$myrow81['cantidad'])+($myrow81['iva']*$myrow81['cantidad']);
		echo "$".number_format($cantidadActual[0]-$myrow31['sumaFacturada'],2);
		?>
          
        </span></span> 
		
		</span></div></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">	  </td>
    </tr>
 
	
	
    <?php }?>
  </table>


		  <table width="606" border="0" align="center" cellpadding="1" cellspacing="1">
            <tr>
              <th width="92" scope="col">&nbsp;</th>
              <th width="92" scope="col">&nbsp;</th>
              <th width="92" scope="col">&nbsp;</th>
              <th width="170" scope="col">&nbsp;</th>
              <th width="57" scope="col">&nbsp;</th>
              <th width="84" scope="col"><div align="left"><span class="style71">
                <?php 
	  echo "$".number_format($myrow341['cantidadF'],2);
	  ?>
              </span></div></th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
		  <p>&nbsp;</p>
		  <table width="53%" border="3" align="center" cellpadding="1" cellspacing="1" class="style71">
            <tr>
              <th width="18%" scope="col"><span class="style72">Cantidad</span></th>
              <th width="23%" scope="col">

			  
<input name="cantidadSolicitada" type="text" class="style71" id="cantidadSolicitada" value="<?php echo $cantidadActual[0]-$myrow31['sumaFacturada'];?>"></th>
              <th width="59%" scope="col"> <span class="style74"><blink><?php echo $leyenda;?></blink></span></th>
            </tr>
          </table>
		  <p align="center">&nbsp;		  </p>
		  <p align="center">
		  <?php 
if($myrow341['cantidadF']){
echo 'Tienes disponible para facturar: '.'$'.number_format(ltrim($cantidadActual[0])-ltrim($myrow31['sumaFacturada']),2);
$cActual=number_format(ltrim($cantidadActual[0])-ltrim($myrow31['sumaFacturada']),2);

} else {
$cActual= $cantidadActual[0]+$cantidadIva[0];


}		  ?>
		  &nbsp;</p>
  <p align="center">
		    <label>
		    <input name="tipoCliente" type="hidden" id="tipoCliente" value="<?php echo $_GET['tipoCliente'];?>" />
		    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>">
		    
		    </label>
		  </p>
		  <p align="center">
	
		  
		    <input name="facturar" type="submit" class="style71" id="nuevo" value="Solicitar Facturar" <?php if(!$cActual) echo 'disabled=""';?>/>
		
			
<input name="cantidadActual" type="hidden" id="cantidadActual" value="<?php echo $cActual;?>" />
		
		  </p>
</form>
<p align="center">&nbsp;</p>
</body>
</html>
<?php }} ?>

