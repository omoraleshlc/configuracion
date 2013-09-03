<?php class hacerDevolucion{
public function articulos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos){
$ventana='cambiarPrecio.php';
$UserType=new tipoUsuario();
$UserType=$UserType->tipoDeUsuario($usuario,$basedatos,$ALMACEN);
?>


<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=400,height=200,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
<?php 
$numeroE=$numeroPaciente;
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
//mysql_db_query($basedatos,$agrega);
echo mysql_error();


$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$quitar[$i]."'";
//mysql_db_query($basedatos,$borrame);
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
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style15 {color: #0000FF}
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
  <span class="style15"><?php echo $leyenda; ?></span></p>
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);">
  <div align="center"><span class="Estilo24"><span class="style7">
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
    </div>
    <p align="center">
      <label><span class="Estilo24">Escoje el Art&iacute;culo</span> 
      <input name="articulo" type="text" class="Estilo24" id="articulo" size="60" />
      </label>
      <label>
       <input name="search" type="submit" class="Estilo24" id="search" value="&gt;" />
      </label>
    </p>
    <table width="601" border="0" align="center" class="style7">
	<tr bgcolor="#FFFFFF" class="style7">
	  <th scope="col">&nbsp;</th>
      <th scope="col"><div align="left">Paciente: </div></th>
      <th scope="col"><div align="left"><?php echo $paciente; ?></div></th>
      <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
    </tr>
      <tr>
        <th width="62" bgcolor="#660066" scope="col"><div align="left"><span class="style11"># Movto. </span></div></th>
<th width="98" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Hora/Fecha</span></div></th>
        <th width="257" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripci&oacute;n</span></div></th>
      

        <th width="51" bgcolor="#660066" scope="col"><div align="left"><span class="style11"> Solicita </span></div></th>
        <th width="47" bgcolor="#660066" scope="col"><div align="left"><span class="style11"> Destino </span></div></th>
        <th width="29" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Cant</span></div></th>
        <th width="27" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Status</span></div></th>
      </tr>
	  
	  
	 <?php	
$sSQL31= "Select * From clientesInternos WHERE numeroE = '".$numeroPaciente."' and nCuenta='".$nCuenta."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);


$articulo=$_POST['articulo'];

if($myrow31['tipoPaciente']=='interno' or $myrow31['tipoPaciente']=='urgencias'){
  $sSQL= "SELECT 
*,cargosCuentaPaciente.laboratorioReferido as laboratorioR 
FROM cargosCuentaPaciente,articulos
WHERE

articulos.descripcion like '%$articulo%'
and
cargosCuentaPaciente.codProcedimiento=articulos.codigo
AND
cargosCuentaPaciente.numeroE='".$numeroPaciente."'
and
cargosCuentaPaciente.nCuenta='".$nCuenta."'
and


cargosCuentaPaciente.statusCargo='cargado'
and
cargosCuentaPaciente.status!='transaccion'

order by fecha1,hora1 ASC

";

} else {
$sSQL= "SELECT 
*
FROM cargosCuentaPaciente
WHERE
cargosCuentaPaciente.numeroE='".$numeroPaciente."'
and
cargosCuentaPaciente.nCuenta='".$nCuenta."'
AND
cargosCuentaPaciente.statusCargo='cargado'
and


cargosCuentaPaciente.status!='transaccion'
and
cargosCuentaPaciente.um!='s'
order by fecha1,hora1 ASC

";
}


if($articulo){
if($numeroPaciente){
if($result=mysql_db_query($basedatos,$sSQL)){


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




$sSQL341= "Select descripcion From articulos WHERE codigo='".$myrow['codProcedimiento']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
?>

 <tr>
     <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
		            echo $myrow['keyCAP'];
					
					?></td>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24">
          <label></label>

		 <?php if($myrow['fecha1']){ 
		            echo $myrow['hora1']." ".cambia_a_normal($myrow['fecha1']); 
					}
					?>
					
				
		  
		  
		  
		  
		  <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />        </td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24">
	
			<?php 
								$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
			
			if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>		</td>
		
     
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="Estilo28"><span class="Estilo27"><span class="Estilo29"><span class="Estilo26"><?php echo $myrow['almacenSolicitante']; ?></span></span></span></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="Estilo27"><span class="Estilo26">
		
		<?php
		if($myrow['laboratorioReferido']=='si'){
		echo $myrow['laboratorioR'];
		} else {
		echo $myrow['almacenDestino']; 
		}
		?></span></span></td>
	
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><label><?php if($myrow['cantidad']){
echo $myrow['cantidad'];
} else {
echo "N/A";
}?></label></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
          <div align="center"><span class="">
		  
		  <?php if($myrow['statusDevolucion']=='no'){ ?>
		  <a href="javascript:ventanaSecundaria8('ventanaAplicarDevolucion.php?keyCAP=<?php echo $keyCAP; ?>&;seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>')"><img src="/sima/imagenes/iconosSima/active_icon.jpg" alt="" width="12" height="12" border="0" /></a> 
		  <?php } else { ?>
		  <img src="/sima/imagenes/iconosSima/delete_icon.jpg" alt="" width="12" height="12" border="0" />
		  <?php } ?>
		  </span>            </div>
        </label></td>
      </tr>
      <?php }}?>
  </table>

    <div align="center">
      <?php 
	
	
	}} ?>
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