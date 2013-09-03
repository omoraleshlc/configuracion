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
   window.open(URL,"ventana2","width=560,height=280,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
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


if($_GET['escoje'] and !$_GET['quitar']){

$keyCAP=$_GET['keyCAP'];
for($i=0;$i<=$_GET['bandera'];$i++){

if($keyCAP[$i]){
$sql = "UPDATE cargosCuentaPaciente set 

statusFactura='solicita',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."',
folioFactura='".$_GET['folioFactura']."'

where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}

}







if($_GET['quitar'] and !$_GET['escoje']){
$keyCAP=$_GET['quita'];

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



if($_GET['folioFactura']==''){

$sql = "UPDATE cargosCuentaPaciente set 

statusFactura='standby',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."',
folioFactura=''

where


folioFactura='".$_GET['folioFactura']."'
";

mysql_db_query($basedatos,$sql);
echo mysql_error();
}





if($_GET['facturar']){

$sql = "UPDATE cargosCuentaPaciente set 

statusFactura='facturado',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."'


where
entidad='".$entidad."'
and

folioFactura='".$_GET['folioFactura']."'
";

mysql_db_query($basedatos,$sql);
echo mysql_error();
  $agrega = "UPDATE clientesInternos
set
statusFactura='facturado',
pagoFactura='standby'
where 
keyClientesInternos='".$_GET['nT']."' 
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Se facturo el folio: '.$_GET['nT'];
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
<form id="form1" name="form1" method="GET" action="">
  <table width="413" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left">Introduce el FOLIO </div></th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left"><?php 
		// echo $keyClientesInternos=$nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_GET['numeroE'];
		  ?>" readonly=""/>
</label>
<label>
<input name="nt" type="text" class="style7" id="nt" value="<?php echo $_GET['nT'];?>" autocomplete="off" />
</label>
</div>      </th>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th class="Estilo24" scope="col"><div align="left"><strong># Factura </strong></div></th>
      <th class="Estilo24" scope="col"><div align="left">
        <label>
        <input name="folioFactura" type="text" class="style7" id="numeroFactura" value="<?php echo $_GET['folioFactura'];?>" 
		<?php 
		if($_GET['folioFactura']){ echo 'readonly=""';} ?> />
        </label>
        <label>
        <input name="numeroFactura" type="submit" class="style7" id="numeroFactura" value="&gt;" />
        </label>

	  
	  </div></th>
	        
	  <?php 
	  if($myrow3['seguro']){
	  echo '<blink>'.'Este folio es de aseguradora, y solo se admiten clientes particulares..!'.'</blink>';
	  }
	  ?>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">RFC</div></th>
      <th bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">
	<?php  
	

	  $sSQL21= "Select RFC,keyRFC 
	  From RFC where

keyRFC='".$myrow3['keyRFC']."'
";
$result21=mysql_db_query($basedatos,$sSQL21); 
$myrow21 = mysql_fetch_array($result21);
echo mysql_error();
?>
	  
        <input name="rfc" type="text" class="style71" id="folioFactura" value="<?php echo $myrow21['RFC'];?>" 
		readonly=""/>
        <a href="#" onClick="javascript:ventanaSecundaria2('/sima/cargos/ventanaFacturacionDirecta.php?folioFactura=<?php echo $_GET['folioFactura']; ?>&nT=<?php echo $_GET['nT'];?>')"><img src="/sima/imagenes/modificascl.png" alt="RFC" width="12" height="12" border="0" /></a></div></th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th width="134" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="408" class="Estilo24" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
  </table>
  <p align="center" class="style7"><em>(nota: Puedes escojer varios para el proceso de cierre) </em></p>



 <?php if(!$myrow3['seguro']){ ?>

    


  <table width="682" height="0" border="0" align="center" class="style7">
    <tr>
      <th width="62" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">#MOV </span></div></th>
      <th width="100" height="14" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Fecha/Hora </span></div></th>
      <th width="282" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="59" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Importe</span></div></th>
      <th width="59" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Facturado</span></div></th>
      <th width="45" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Escojer</span></div></th>
      <th width="45" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Quitar</span></div></th>
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
 statusCargo='cargado'
 and
 naturaleza='C'
 and
 (seguro='0' or seguro='')
 order by hora1 asc
";






if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];





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
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="<?php echo $estilo;?>">
        <?php 
		
		
		if($myrow81['naturaleza']=='C'){
		$suma[0]=(($myrow81['precioVenta']*$myrow81['cantidad'])+($myrow81['iva']*$myrow81['cantidad']));
		$sumaImporte[0]+=$suma[0];
		echo "$".number_format($suma[0],2);
		}else{
		echo 'N/A';
		}
		?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24">
	  
	  <div align="left">
<?php 
$sSQL31= "Select sum(cantidadFacturada) as sumaFacturada From cargosFacturados WHERE numFactura = '".$_GET['folioFactura']."' and
nT='".$keyCAP."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
echo "$".number_format($myrow31['sumaFacturada'],2);
$sumaFacturada[0]+=$myrow31['sumaFacturada'];
?>
	  
	  </div>
	  </td>
	  
	  
	  
	  <?php if(!$myrow31['sumaFacturada']){ ?>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
	  <div align="center">
        <?php 
		if($myrow81['statusFactura']=='standby'){  ?>
<input name="keyCAP[]" type="checkbox" id="keyCAP[]" value="<?php echo $myrow81['keyCAP'];?>"  />
        <?php } else { echo '---'; } ?>
      </div></td>
	  
	   
  
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>">
	  
	  <?php 
		if($myrow81['statusFactura']=='solicita'){ $c+=1;?>
	
	  <input name="quita[]" type="checkbox" id="quita[]" value="<?php echo $myrow81['keyCAP'];?>">
	  <?php } else { echo '---';}?>	  </td>
	  <?php } ?>
	  
	  
	  
    </tr>
 
	
	
    <?php }?>
  </table>
<?php if( $a){ ?>

<?php if($_GET['nt'] and $_GET['folioFactura']){ ?>
  <p align="center">
    <label>
    
    </label>
  </p>
  <p align="center">
         <label>
		   <?php if(!$myrow31['sumaFacturada']){ ?>
      <input name="escoje" type="submit" class="style7" id="escoje" value="Escojer Elementos" />
      <input name="quitar" type="submit" class="style71" id="quitar" value="Quitar Elementos" />
	  <?php } ?>
      </label>
      <label></label>
    <label>
	
	</label>
  </p>
 
  <div align="center">
  <input name="bandera" type="hidden" value="<?php echo $a;?>" />
  
  <?php $suma=number_format($sumaImporte[0],2)-number_format($sumaFacturada[0],2); 


if($c>=1){
  if($suma!='0' or $suma!=NULL){
   ?>
  <input name="nuevo" type="button" class="style71" id="nuevo" value="Escoje Cantidad a Facturar"
	  onclick="ventanaSecundaria1('/sima/cargos/desplegarFacturaParticular.php?folioFactura=<?php echo $_GET['folioFactura'];?>&nT=<?php echo $_GET['nT'];?>')" />
	  <?php }
	  
	  }
	   ?>
	  
	  
  </div>
  
   <div align="center">
     <?php 
	
	 if(($suma=='0' or $suma==NULL) and $_GET['rfc'] and $myrow3['statusFactura']!='facturado'){ ?>
     <input name="facturar" type="submit" class="style71" id="facturar" value="facturar" />
     <?php } ?>

	 <?php 
	 if($myrow3['statusFactura']=='facturado'){ ?>
     <input name="imprimeFactura" type="submit" class="style7" id="imprimeFactura" value="Imprimir Factura" />
	 <?php } ?>

   </div>
   
   
   <?php } ?>
    <?php }//cierra validacion de solo seguro ?>
</form>

<p align="center">&nbsp;</p>


<?php }} ?>
</body>
</html>
<?php }} ?>

