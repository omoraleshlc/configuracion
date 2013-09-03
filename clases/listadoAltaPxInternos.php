<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=450,height=200,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
<meta http-equiv="refresh" content="130" >


<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){

LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>

</head>

<body>
<?php 

$sSQL2= "Select transacciones From almacenes WHERE almacen = '".$ALMACEN."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
<form id="form1" name="form1" method="POST" >
  <h1 align="center" class="titulos"><br />
  Alta de Pacientes Internos</h1>
  <p align="center" >(Para dar Cerrar la Cuenta, presiona sobre el nombre del Paciente)</p>
  <table width="500" class="table table-striped">

    <tr >
      <th width="50" >FolioV</th>
      <th width="280" >Datos del Paciente</th>
      <th width="296" >Aseguradora</th>
      <th width="64" >Enviar a</th>
    </tr>
<?php	
	  
$cierreCuentaReporte=new articulosDetalles();
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCuenta = 'caja'
and
status !='cerrada'

ORDER BY paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 



if($myrow['seguro']){
$sSQL40= "SELECT nomCliente
FROM
clientes
where 
numCliente='".$myrow['seguro']."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
}else{
$myrow40['nomCliente']='Particular';
}


	  ?>    
    
    
    <tr  >
      <td height="49" ><?php echo $myrow['folioVenta'];
?></td>
      <td >
	        <a href="javascript:nueva('/sima/cargos/cierraCuenta2.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>&devolucion=<?php echo $myrow['statusDevolucion'];?>&descripcionTransaccion=altaPacientes#final','ventanaNueva','1024','1000','yes')">
      <?php echo $myrow['paciente'];	  ?>
	  </a>
	  <?php 
	  if($myrow['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '<span ><blink>'.'[Solicita Devolucion]'.'</blink></span>';
	  }
	  ?>
	  

	  
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>   
        </br>  
       <span > Departamento: </span><span > 
	   <?php 
$sSQL42= "SELECT descripcion
FROM
almacenes
where 
almacen='".$myrow['almacen']."'";

$result42=mysql_db_query($basedatos,$sSQL42);
$myrow42 = mysql_fetch_array($result42);

 echo $myrow42['descripcion'];?></span> </br>
       <span > Enviada por:</span><span >  <?php echo $myrow['autoriza'];?>
      </span><span >
      el </span><span ><?php echo cambia_a_normal($myrow['fecha']);?></span>
      </td>
      <td ><?php echo $myrow40['nomCliente'];?><br />
     <span > Cuarto: </span><span ><?php 
	  if($myrow['cuarto']){
	  echo $myrow['cuarto'];
	  }else{
	  echo '---';
	  }
?> </span></td>
      <td > <?php 
	  if($myrow['statusDevolucion']!='si'){ $dev='';?>
	  <a href="#" onClick="javascript:ventanaSecundaria111('/sima/cargos/enviarA.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;ali=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')">Envia a: </a>
		<?php }else{ 
		$dev='si';
		echo '---';
		}
		?></td>
    </tr><?php  }}?>

  </table>

  
</form>
</body>
</html>