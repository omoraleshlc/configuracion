<?php  class despliegaPx{ 
public function pxHora($entidad,$almacen,$usuario,$numeroE,$basedatos){ 
?>




<script type="text/javascript">
	function regresar(expediente,paciente,fechaNac,edad){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = expediente;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = paciente;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoFechaNac;?>.value = fechaNac;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoEdad;?>.value = edad;
		close();
	}
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 
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
<h1 align="center">Pacientes para <?php echo cambia_a_normal($_GET['fechaSolicitud']); ?>
</h1>
<form id="form1" name="form1" method="post" action="#" >
  <p>
  <?php


$sSQL= "
SELECT *,clientesInternos.status as statusCI,clientesInternos.keyClientesInternos as kCI FROM 
clientesInternos,cargosCuentaPaciente 
where 
clientesInternos.entidad='".$entidad."'
and
cargosCuentaPaciente.almacenDestino='".$almacen."'
and

cargosCuentaPaciente.fechaSolicitud='".$_GET['fechaSolicitud']."'
and
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos
and
(cargosCuentaPaciente.statusCargo='standby' or cargosCuentaPaciente.statusCargo='cargado' )
group by cargosCuentaPaciente.keyClientesInternos
order by 
cargosCuentaPaciente.horaSolicitud,clientesInternos.paciente ASC
";



$result=mysql_db_query($basedatos,$sSQL);

?></p>


    <table width="635" class="table table-striped">
    <tr>
      <th width="49"  scope="col"><span ># Folio </span></th>
        <th width="49" height="19"  scope="col"><span > Hora </span></th>
        <th width="178"  scope="col"><span >Paciente</span></th>
        <th width="302"  scope="col"><span >Servicio</span></th>
        <th width="35"  scope="col"><span >status</span></th>
    </tr>
      <tr>
       
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']." ".$myrow['apellido1']." ".
$myrow['apellido2']." ".$myrow['apellido3'];
$bandera+="1";


//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$NUMEROE."' and statusCuenta='abierta'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
 if($myrow31['numeroE']){
 $interno=' [Paciente Interno]';
 } else {
 $interno='';
 }
 
$size=strlen($myrow['fechaNacimiento']);

if($size>8){
$fNac= substr($myrow['fechaNacimiento'],6,8);
$aActual=date("Y");
$edad=$aActual-$fNac;
} else {
$fNac= substr($myrow['fechaNacimiento'],6,6);
$aActual=date("Y");
$edad=$aActual-$fNac;
$edad=substr($edad,2,4);
}
?>

 <td bgcolor="<?php echo $color;?>" ><span >
          <?php 
			echo $myrow['kCI'];
		
		  ?>
        </span></td>
        <td height="24" bgcolor="<?php echo $color;?>" >
        <?php 
		if($myrow['horaSolicitud']){
			echo $myrow['horaSolicitud'];
			} else {
		echo 'Sin Asignar';
		 }
		  ?>		   </td>
		  
		  <td bgcolor="<?php echo $color;?>" ><span ><?php echo $myrow['paciente']." ".$interno;?></span></td>
		  <td bgcolor="<?php echo $color;?>" ><span >
		<?php 
$sSQL3= "SELECT 
descripcion
FROM articulos

WHERE 
entidad='".$entidad."'
and
codigo ='".$myrow['codProcedimiento']."'";

$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
echo $myrow3['descripcion'];?>
		
		
		 
		<span ></span> </span></td>
        <td bgcolor="<?php echo $color;?>" ><span >
		
		<?php echo $myrow['statusCI']; ?>
	
		</span></td>
    </tr>

      <?php }?>
    </table>
	<p>&nbsp;    </p>
	<p>
	  <input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    </p>
</form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>
