<?php //traigo agregados
class eCuentaT{

public function ECUENTA($entidad,$eCuenta,$nT,$basedatos){
 $sSQL141= "
	SELECT 
  *
FROM
clientesInternos
WHERE 
keyClientesInternos = '".$nT."'
";
$result141=mysql_db_query($basedatos,$sSQL141);
$myrow141 = mysql_fetch_array($result141);

$nCliente5=$myrow141['numeroE'];
$nCuenta5=$myrow141['nCuenta'];

$sSQL81= "
SELECT 
  *
FROM
cargosCuentaPaciente 
 WHERE
 entidad='".$entidad."' AND
 numeroE = '".$nCliente5."'
 
 and nCuenta='".$nCuenta5."'
 and
 (status='cargado' or statusCargo='cargado' or status='pendiente' or status='cxc')
 group by codProcedimiento 
 
";

if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a = $a + 1;
$art = $myrow81['codProcedimiento'];
$proc=$myrow81['codProcedimiento'];



$sSQL141= "
	SELECT 
  *
FROM
articulos
WHERE entidad='".$entidad."' AND
codigo = '".$proc."'
";
$result141=mysql_db_query($basedatos,$sSQL141);
$myrow141 = mysql_fetch_array($result141);
$sSQL151= "
	SELECT 
  *
FROM
 medicosPrecios
WHERE entidad='".$entidad."' AND
codMedico = '".$medico."' AND codProcedimiento = '".$proc."'
";
$result151=mysql_db_query($basedatos,$sSQL151);
$myrow151 = mysql_fetch_array($result151);
echo mysql_error();
//cierro descuento




$sSQL14= "
SELECT 
sum(cantidad) as cantidad2
FROM
cargosCuentaPaciente
WHERE entidad='".$entidad."' AND
codProcedimiento = '".$proc."' and  numeroE = '".$nCliente5."'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
?>
 
        <?php  if($myrow14['cantidad2']=='1'){
		$cantidad=$myrow81['cantidad'];
		} else {
		$cantidad=$myrow14['cantidad2'];		
		}
		?>
   
        <?php  if($myrow141['descripcion']){
		$myrow141['descripcion'];
		}
		?>
  


    
        <?php 
	
    // echo "$ ".number_format($myrow81['costo'],2);
	 //$costoProcedimientos[0]+=$myrow81['costo'];
	$costoProcedimientos[0]=$cantidad*$myrow81['costo'];

	?>

        <?php 
	
	//echo "$".number_format($costoProcedimientos[0],2);
	$TOTAL+=$costoProcedimientos[0];
	?>
 
    <?php }}?>

	
	
	
	
	
	
	
	


	  <?php 
//descuentos pacientes internos

$sSQL18= "SELECT *
FROM
descuentos
WHERE entidad='".$entidad."' AND
numeroE='".$nCliente."' AND nCuenta ='".$nCuenta."' and nCuenta <>null
and 
status='activo' and
fechaFinal <= '".$fecha1."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18= mysql_fetch_array($result18);
echo mysql_error();
//descuentos pacientes ambulatorios
$sSQL19= "SELECT *
FROM
descuentos
WHERE entidad='".$entidad."' AND
numeroE='".$nCliente."' 
and status='activo' and
fechaFinal <= '".$fecha1."'
 ";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19= mysql_fetch_array($result19);
//******************
if($myrow19['cantidad']){

$descuento=$myrow19['cantidad'];
} else if($myrow19['descuento']){

		$TOTAL1=($myrow19['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}
		
		
if($myrow18['cantidad']){
$descuento=$myrow18['cantidad'];
} else if($myrow18['descuento']) { 
		$TOTAL1=($myrow18['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}	
		
	$TOTAL-=$descuento;
		?>
      	<?php 
		if($descuento){ ?>
	
		
	<?php
//	echo "$".number_format($descuento,2); 
		 
		?>		
	  <?php } ?>
  
          <?php 
		  $sSQL13= "
	SELECT 
  sum(iva) as sumaiva
FROM
cargosCuentaPaciente
WHERE entidad='".$entidad."' AND
numeroE = '".$nCliente."'
 
 and status='pendiente'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $iva=$myrow13['sumaiva'];
		//echo "$".number_format($iva,2);
?>












  
        <?php //traigo agregados



$sSQL141= "
	SELECT 
count( *) as Tmedicamentos
FROM
cargosCuentaPaciente

WHERE entidad='".$entidad."' AND numeroE='".$nCliente5."' and
nCuenta='".$nCuenta5."'
and
um='MAT'
";
$result141=mysql_db_query($basedatos,$sSQL141);
$myrow141 = mysql_fetch_array($result141);
$Tmedicamentos=$myrow141['Tmedicamentos'];





$sSQL14= "
	SELECT 
count( *) as TPAT
FROM
cargosCuentaPaciente

WHERE entidad='".$entidad."' AND
numeroE='".$nCliente5."' and
nCuenta='".$nCuenta5."'
and
um='PAT'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
$TPAT=$myrow14['TPAT'];



$sSQL1= "
	SELECT 
count( *) as Tservicios
FROM
cargosCuentaPaciente

WHERE entidad='".$entidad."' AND
numeroE='".$nCliente5."' and
nCuenta='".$nCuenta5."'
and
(um='s' or um='S')
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$Tservicios=$myrow1['Tservicios'];

$sSQL2= "
	SELECT 
sum(iva) as Tiva
FROM
cargosCuentaPaciente

WHERE entidad='".$entidad."' AND numeroE='".$nCliente5."' and
nCuenta='".$nCuenta5."'

";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$Tiva=$myrow2['Tiva'];

$sSQL1= "
	SELECT 
count( *) as Tcargos
FROM
cargosCuentaPaciente

WHERE entidad='".$entidad."' AND numeroE='".$nCliente5."' and
nCuenta='".$nCuenta5."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$Tcargos=$myrow1['Tcargos'];

$sSQL1= "
	SELECT 
sum( cantidad) as Tcantidad
FROM
cargosCuentaPaciente

WHERE entidad='".$entidad."' AND numeroE='".$nCliente5."' and
nCuenta='".$nCuenta5."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$Tcantidad=$myrow1['Tcantidad'];


$sSQL3= "
Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."'

";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

?>

<?php

	  $t1=$TOTAL+$Tiva;


	  
	  $t2=$myrow3['deposito'];?>


      <?php return $eCuenta=$t1-$t2;
	  }
	  
	  }
	  ?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	<?php
class muestraInternosUrgencias{
public function listaInternosUrgencias($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
require('/configuracion/clases/listadoPxUrgencias.php');
}//cierra funcion
}//cierra clase 
?>  
	  

<?php
class muestraInternos{
public function listaInternos($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
require('/configuracion/clases/listadoECInternos.php');
}//cierra funcion
}//cierra clase 
?>


<?php
class dividirCuentas{
public function dC($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
require('/configuracion/clases/dividirCuentas.php');
}//cierra funcion
}//cierra clase 
?>



<?php
class trasladoOtros{
public function otros($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
require('/configuracion/clases/listadoOtros.php');
}//cierra funcion
}//cierra clase 
?>



<?php
class muestraInternosAlta{
public function listaInternos($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
require('/configuracion/clases/cierreCuenta1.php');
}//cierra funcion
}//cierra clase 
?>












<?php
class muestraInternosCxC{
public function listaInternosCxC($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
require ('/configuracion/clases/listaAplicarCoaseguro.php');
}//cierra funcion
}//cierra clase 
?>






<?php
class muestraExternosDescuentos{
public function listaExternosDescuentos($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
require ('/configuracion/clases/listaExternosDescuentos.php');
}//cierra funcion
}//cierra clase 
?>





<?php
class muestraExternos{
public function listaExternos($usuario,$ALMACEN,$entidad,$TITULO,$fecha1,$ventana,$basedatos){
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta' ){ //*******************Comienzo la validaci�n*****************
?>







<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 13px}
-->
</style>
<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
<meta http-equiv="refresh" content="30" >
</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>

<form id="form10" name="form10" method="get" action="#">
  <h1 align="center" class="titulo"> <?php echo $TITULO; ?></h1>
  <p align="center" class="titulo">
    <label>
    <input onChange="this.form.submit();" name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 echo $date;
		 ?>"/>
    </label>
    <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
</p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="864" height="24" />
  <table width="864" border="0.2" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th width="85" class="blanco" scope="col"><div align="left">Referencia</div></th>
      <th width= "195" class="blanco" scope="col"><div align="left">Nombre del paciente:</div></th>
      <th width= "260" class="blanco" scope="col"><div align="left">Aseguradora</div></th>
	  <th class="blanco" scope="col"><div align="left">Departamento</div></th>
	  <th class="blanco" scope="col"><div align="left">Usuario</div></th>
	  <th class="blanco" scope="col">Aplicar</th>
    </tr>
    <tr>
      <?php	



$sSQL= "SELECT *
FROM
clientesInternos,cargosCuentaPaciente
WHERE 
clientesInternos.entidad='".$entidad."' AND
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos
AND
cargosCuentaPaciente.statusCargo='cargado'
AND
clientesInternos.status='activa' 
and 
clientesInternos.tipoPaciente='interno'
AND
((clientesInternos.almacenSolicitud!='' and clientesInternos.fechaSolicitud='".$date."' ) 
or
(clientesInternos.fecha1='".$date."' )) 
group by clientesInternos.keyClientesInternos
ORDER BY clientesInternos.nomCliente DESC
 ";

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


      <td width="195" bgcolor="<?php echo $color?>" class="normal">

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

      <td width="260" bgcolor="<?php echo $color?>" class="normal"><?php 
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

<td width="179" bgcolor="<?php echo $color?>" class="normal"><?php
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

<td width="70" bgcolor="<?php echo $color?>" class="codigos"><?php
echo $myrow['usuario'];
?></td>
<td width="49" bgcolor="<?php echo $color?>" class="normal" align="center"><label>


  <a href="javascript:nueva('estadoCuentaE.php?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
&nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&almacenSolicitante=<?php echo $ALMACEN; ?>&nT=<?php echo $nT; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&tipoVenta=<?php echo 'externo';?>','ventana1','800','600','yes')"><img src="/sima/imagenes/btns/aplybtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="30" height="24" border="0"/>
  </a>
  
</label></td>

    </tr> 
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
  <img src="../imagenes/bordestablas/borde2.png" width="864" height="24" />
<p>&nbsp;</p>
</form>

    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 

</body>
</html>



<?php
} else {
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje('LA CAJA ESTA CERRADA');
}
?>

<?php 

}//cierra funcion
}//cierra clase 
?>