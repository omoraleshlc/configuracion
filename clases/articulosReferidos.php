<?php class referirArticulos{
public function articulosReferidos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){
$ventana='cambiarPrecio.php';
$UserType=new tipoUsuario();
$UserType=$UserType->tipoDeUsuario($usuario,$basedatos,$ALMACEN);
?>


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



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
  <span ><?php echo $leyenda; ?></span></p>
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);"><?php	
$sSQL31= "Select  tipoPaciente From clientesInternos WHERE numeroE = '".$numeroPaciente."' and nCuenta='".$nCuenta."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($myrow31['tipoPaciente']=='interno' or $myrow31['tipoPaciente']=='urgencias'){
 $sSQL= "SELECT 
*,cargosCuentaPaciente.laboratorioReferido as laboratorioR 
FROM cargosCuentaPaciente,articulos
WHERE

cargosCuentaPaciente.numeroE='".$numeroPaciente."'
and
cargosCuentaPaciente.nCuenta='".$nCuenta."'
and
cargosCuentaPaciente.almacenSolicitante='".$almacenSolicitante."'
and
cargosCuentaPaciente.codProcedimiento=articulos.codigo
and
articulos.laboratorioReferido='si'
and
cargosCuentaPaciente.status!='transaccion'
order by fecha1,hora1 ASC

";

} else {
$sSQL= "SELECT 
*,cargosCuentaPaciente.laboratorioReferido as laboratorioR 
FROM cargosCuentaPaciente,articulos
WHERE
cargosCuentaPaciente.numeroE='".$numeroPaciente."'
and
cargosCuentaPaciente.nCuenta='".$nCuenta."'
AND
cargosCuentaPaciente.statusCargo='cargado'
and
cargosCuentaPaciente.codProcedimiento=articulos.codigo
and
articulos.laboratorioReferido='si'
and
cargosCuentaPaciente.status!='transaccion'
order by fecha1,hora1 ASC

";
}

if($numeroPaciente){
if($result=mysql_db_query($basedatos,$sSQL)){

?>
    <div align="center"><span ><span >
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
      <span ><?php echo $leyenda; ?></span>
	  <?php 

$sSQL31= "Select paciente From clientesInternos WHERE numeroE = '".$numeroPaciente."' and nCuenta='".$nCuenta."'";



$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$paciente=$myrow31['paciente'];
?>
      <strong>    Escoje el laboratorio Referido    </strong></div>
    <table width="580" class="table table-striped" >
	<tr  >
      <th scope="col"><div align="left">Paciente: </div></th>
      <th scope="col"><div align="left"><?php echo $paciente; ?></div></th>
      <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
    </tr>
      <tr>
<th width="95" height="19"  scope="col"><div align="left"><span >Hora/Fecha</span></div></th>
        <th width="334"  scope="col"><div align="left"><span >Descripci&oacute;n</span></div></th>
      

        <th width="35"  scope="col"><div align="left"><span > Solicita </span></div></th>
        <th width="35"  scope="col"><div align="left"><span > Destino </span></div></th>
        <th width="21"  scope="col"><div align="left"><span >Cant</span></div></th>
        <th width="34"  scope="col"><div align="left"><span >Quitar</span></div></th>
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
        <td height="24" bgcolor="<?php echo $color;?>" >
          <label></label>

		 <?php if($myrow['fecha']){ 
		            echo $myrow['hora']." ".cambia_a_normal($myrow['fecha']); 
					}
					?>
					
				
		  
		  
		  
		  
		  <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
		  
        </td>
        <td bgcolor="<?php echo $color;?>" ><?php 
		if($myrow['tipoTransaccion'] and !$myrow11['descripcion']){
		echo "Depósito ó Movimiento de Caja" ;
		} else {
		
		
		if($myrow['laboratorioReferido']=='si'){ ?>
		   <a href="javascript:ventanaSecundaria8('ventanCambiaLaboratorioReferido.php?keyCAP=<?php echo $myrow['keyCAP']; ?>&almacenDestino=<?php echo $myrow['almacenDestino']; ?>&expediente=<?php echo 'no'; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&numeroExpediente=<?php echo $myrow112['numeroE']; ?>&seguro=<?php echo $_POST['seguro']; ?>&firstTime=<?php echo $firstTime;?>')">
			<?php echo $myrow['descripcion'];?>
		</a>
		<?php } else { 
			echo $myrow['descripcion'];
		}
		
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
		
     
        <td bgcolor="<?php echo $color;?>" ><span ><span ><span ><span ><?php echo $myrow['almacenSolicitante']; ?></span></span></span></span></td>
        <td bgcolor="<?php echo $color;?>" ><span ><span >
		
		<?php
		if($myrow['laboratorioReferido']=='si'){
		echo $myrow['laboratorioR'];
		} else {
		echo $myrow['almacenDestino']; 
		}
		?></span></span></td>
	
        <td bgcolor="<?php echo $color;?>" ><label><?php if($myrow['cantidad']){
echo $myrow['cantidad'];
} else {
echo "N/A";
}?></label></td>
        <td bgcolor="<?php echo $color;?>" ><label>
		
		<input name="quitar[]" type="checkbox" value="<?php echo $myrow['keyCAP'];?>" />
		  		
        </label></td>
      </tr>
      <?php }}?>
  </table>

    <div align="center">
      <?php 
	
	
	} ?>
      <input name="borrar" type="submit"  id="numPaciente2" value="Borrar/Eliminar" />
      <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
      <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
      <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
      <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
      <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
      <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
    </div>
</form>
  <p></p>
  
  
</body>
</html>


<?php }} ?>