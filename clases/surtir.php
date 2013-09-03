<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
-->
</style>
<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>

<form id="form10" name="form10" method="post" action="#">
  <h1 align="center" class="titulo"> <?php echo $TITULO; ?>Surtir</h1>
  <table width="320" border="1" align="center" class="Estilo24">
    
   <tr>
      <td width="54">&nbsp;</td>
      <td width="250"><span class="titulo">
        <label>
        <input type="text" name="folioVenta" id="folioVenta" value="folio" />
        </label>
      </span></td>
    </tr>
    <?php } ?>
    
    <tr>
      <td>&nbsp;</td>
      <td><span class="titulo">
        <label></label>
        <label>
        <input type="Submit" name="buscar" id="button" value="Buscar" />
        </label>
      </span></td>
    </tr>
  </table>
  
  
  <?php if($_POST['buscar']){ ?>
  <p align="center" class="titulo">&nbsp;</p>
  <table width="883" border="0.2" align="center">
    <tr>
      <th width="74" bgcolor="#660066" class="blanco" scope="col"><div align="left">Folio</div></th>
      <th width= "214" bgcolor="#660066" class="blanco" scope="col"><div align="left">Nombre del paciente:</div></th>
      <th width= "270" bgcolor="#660066" class="blanco" scope="col"><div align="left">Aseguradora</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Departamento</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Usuario</div></th>
	  <th bgcolor="#660066" class="style12" scope="col">E/C</th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco"><span class="style11 style13">N/V</span></div></th>
    </tr>
    <tr>
      <?php	


{
 $sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
statusCuenta='abierta'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
folioVenta!=''
order by paciente asc
 ";
 
 }
 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$nT=$myrow['keyClientesInternos'];
	  ?>
      <td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php echo $myrow['folioVenta'];
?></td>


      <td width="214" bgcolor="<?php echo $color?>" class="normal">


	  	  <?php 

$verificaCargos=new acumulados();
$verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta);
if($myrow['paciente']){	  
?>

	  <?php echo $myrow['paciente'];?>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  ?> 
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="270" bgcolor="<?php echo $color?>" class="normal"><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "Sin Seguro";
		  }
?></span></td>

<td width="184" bgcolor="<?php echo $color?>" class="normal"><?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></td>

<td width="71" bgcolor="<?php echo $color?>" class="codigos"><?php echo $myrow['usuario'];?></td>
<td width="20" bgcolor="<?php echo $color?>" class="style12">

<div align="center"><a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>')"><img src="/sima/imagenes/listado.jpg" alt="Pacientes Activos" width="12" height="12" border="0" /></a></div></td>
<td width="20" bgcolor="<?php echo $color?>" class="style12">
    <a href="javascript:ventanaSecundaria('/sima/INGRESOS HLC/caja/imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"> <img src="/sima/imagenes/printer.jpg" alt="" width="20" height="18" border="0" /></a></td>
    </tr> 
    <?php  }}}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>






  <p>&nbsp;</p>
</form>



</body>

</html>