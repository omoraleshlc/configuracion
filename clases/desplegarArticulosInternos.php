<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=200,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
<?php 
//aqui estoy

if($_POST['borrar'] and $_POST['quitar']){
//*****************************************************
$quitar=$_POST['quitar'];


for($i=0;$i<=$_POST['bandera'];$i++){

if($quitar[$i]){
$sSQL= "SELECT 
codProcedimiento,keyCAP,almacen,numeroE,nCuenta
FROM cargosCuentaPaciente
WHERE keyCAP ='".$quitar[$i]."'";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$codigo=$myrow['codProcedimiento'];
$departamento=$myrow['almacen'];
$numeroPaciente=$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
//********************************************
$agrega = "INSERT INTO articulosCancelados (
codigo,fecha,hora,usuario,entidad,departamento,numeroE,nCuenta,keyCAP
) values (
'".$_GET['codigo3']."','".$fecha1."','".$hora1."',
'".$usuario."','".$entidad."','".$departamento."','".$numeroE."','".$nCuenta."','".$quitar[$i]."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}
}
}







//*********************ENVIAR********************
if($_POST['send']){ 
$keyCAP=$_POST['keyCAP'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL= "SELECT 
statusCargo,keyClientesInternos
FROM cargosCuentaPaciente
WHERE keyCAP ='".$keyCAP[$i]."'";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

if($myrow['statusCargo']=='cargadoR'){
$statusCargo='cargado';
}else {
$statusCargo='standby';
}

$actualiza = "update cargosCuentaPaciente 
set
statusCargo='".$statusCargo."'
WHERE keyCAP ='".$keyCAP[$i]."'";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();


}


}
?>


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar solicitud?')) return true;
return false;
}
-->
</script>


<?php
$convenioParticular=new acumulados(); $convenioAseguradora=new acumulados(); 
$cargosParticulares=new  acumulados();	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
  <span class="style15"><?php echo $leyenda; ?></span></p>
<form id="form1" name="form1" method="post" action="#" >


<?php	
$sSQL31= "Select  tipoPaciente From clientesInternos WHERE numeroE = '".$numeroPaciente."' and nCuenta='".$nCuenta."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($myrow31['tipoPaciente']=='interno' or $myrow31['tipoPaciente']=='urgencias'){
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
numeroE='".$numeroPaciente."'
and
nCuenta='".$nCuenta."'
and
statusCargo='standbyR'
and
almacenSolicitante='".$almacenSolicitante."'
and
status!='transaccion'
order by fecha1,hora1 ASC

";

} else {
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
numeroE='".$numeroPaciente."'
and
nCuenta='".$nCuenta."'
AND
statusCargo='cargadoR'
and
status!='transaccion'
order by fecha1,hora1 ASC

";
}

if($numeroPaciente){
if($result=mysql_db_query($basedatos,$sSQL)){

?>
    <span class="Estilo24"><span class="style7">
    <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
    </span></span>
    <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />


    <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
    <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
    <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
    <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
    <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
    <span class="style15"><?php echo $leyenda; ?></span>
	  <?php 

$sSQL31= "Select paciente From clientesInternos WHERE numeroE = '".$numeroPaciente."' and nCuenta='".$nCuenta."'";



$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$paciente=$myrow31['paciente'];
?>
    <table width="580" border="0" align="center" >
	<tr bgcolor="#FFFFFF" class="negro">
      <th scope="col"><div align="left">Paciente: </div></th>
      <th scope="col"><div align="left" class=""><?php echo $paciente; ?></div></th>
      <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
    </tr>
      <tr>
<th width="95" height="19" bgcolor="#660066" scope="col"><div align="left" class="blanco">Hora/Fecha</div></th>
        <th width="334" bgcolor="#660066" scope="col"><div align="left" class="blanco">Descripci&oacute;n</div></th>
      

        <th width="35" bgcolor="#660066" scope="col"><div align="left" class="blanco">Precio</div></th>
        <th width="35" bgcolor="#660066" scope="col"><div align="left" class="blanco">Almacen</div></th>
        <th width="21" bgcolor="#660066" scope="col"><div align="center" class="blanco">Cant</div></th>
        <th width="34" bgcolor="#660066" scope="col"><div align="left" class="blanco">Quitar</div></th>
      </tr>
	  
	  
	  
	  
	  
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}





?>
        <td height="24" bgcolor="<?php echo $color;?>" class="codigos">
          <label></label>
		  <?php 
		  if($myrow['um']=='s'  ){ ?>
		  	        <a href="javascript:ventanaSecundaria8('ventanCambiaFecha.php?keyCAP=<?php echo $myrow['keyCAP']; ?>&almacenDestino=<?php echo $myrow['almacenDestino']; ?>&expediente=<?php echo 'no'; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&numeroExpediente=<?php echo $myrow112['numeroE']; ?>&seguro=<?php echo $_POST['seguro']; ?>&firstTime=<?php echo $firstTime;?>')">
					
					
          <?php 
		  if($myrow['horaSolicitud'] and $myrow['fechaSolicitud']){
		  echo $myrow['horaSolicitud']." ".$myrow['fechaSolicitud']; 
		 }else {
		 echo $myrow['hora1']." ".$myrow['fecha1'];
		 }
		  ?>          
		  </a>
		  <?php } else { ?>
		 
		            <?php  echo $myrow['hora1']." ".$myrow['fecha1'];  ?>          
					
					<?php } ?>
		  
		  
		  
		  
		  <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
		  
        </td>
        <td bgcolor="<?php echo $color;?>" class="normal"><?php 
		if($myrow['tipoTransaccion'] and !$myrow11['descripcion']){
		echo "Depósito ó Movimiento de Caja" ;
		} else {
			
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		
		}
		?>
		<?php if($myrow['status']=='cancelado'){ ?>
		  <span class="Estilo25"><blink><?php echo '(Artículo Cancelado por '.$myrow['usuarioCancela'].')';?></blink></span>
		<?php } ?>
		
			<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>		
		
		
		
		</td>
		
     

        <td bgcolor="<?php echo $color;?>" class="cargos"><?php $total[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
		echo "$".number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2); ?></td>
        <td bgcolor="<?php echo $color;?>" class="normal" align="center"><?php echo $myrow['almacenDestino']; ?></td>
	
        <td bgcolor="<?php echo $color;?>" class="normal" align="center"><label><?php if($myrow['cantidad']){
echo $myrow['cantidad'];
} else {
echo "N/A";
}?></label></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
		
		<input name="quitar[]" type="checkbox" value="<?php echo $myrow['keyCAP'];?>" />
	
		  		<input name="keyCAP[]" type="hidden" value="<?php echo $myrow['keyCAP'];?>" />
        </label></td>
      </tr>
      <?php }}?>
  </table>

 
        <?php 
	
	
	} ?>
        
        <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
        <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
        <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
        <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
        <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
        <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
        <?php if($bandera>0){ ?>
      </p>
	  
  
	   <div align="center">
      <p><strong class="titulos">Total de Cargos </strong></p>

      <table width="200" border="0" class="tablita">
        
        <tr>

          <th colspan="2" scope="col" class="precio2"><?php echo "$".number_format($total[0],2); ?></th>
        </tr>
      </table>
	  <p><strong></strong></p>
      <table width="332" border="0">
        <tr valign="middle">
          <td width="143"><div align="center">
            <input name="send" type="image" src="/sima/imagenes/btns/sendsolicitud.png" id="enviar" value="Enviar Solicitud" onClick="return comprueba();" />
          </div></td>
          <td width="46"><div align="center"></div></td>
          <td width="129"><div align="center">
            <input name="borrar" type="image" src="/sima/imagenes/btns/delete2button.png" id="numPaciente" value="Borrar/Eliminar" />
           <p class="negro"> <?php } else { echo 'No hay Registros';}?></p>
          </div></td>
        </tr>
      </table>
      <p>
	  
      <label></label>
  </div>
</form>
  <p></p>
  
  
</body>
</html>