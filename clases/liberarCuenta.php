<?php
class muestraInternos{
public function listaInternos($estado,$fecha1,$hora1,$usuario,$ALMACEN,$entidad,$TITULO,$ventana,$basedatos){

?>



<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<?php 
if($_GET['alta']=='activar'){
$sSQL31= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['nT']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$numeroE=$myrow31['numeroE'];
$nCuenta=$myrow31['nCuenta'];
$keyClientesInternos=$myrow31['keyClientesInternos'];




$sSQL32= "Select * From procesoAlta WHERE 
almacen='".$ALMACEN."'
and
entidad='".$entidad."'
and
keyClientesInternos='".$_GET['nT']."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);

if(!$myrow32['numeroE']){
$paso='2';
$status=$estado;
}  



if(!$myrow32['numeroE'] and $estado=='cargado'){
$agrega1="
INSERT INTO procesoAlta ( numeroE, nCuenta, almacen, status, nPaso, fecha, hora, usuario,keyClientesInternos,entidad
) values ( 
'".$numeroE."', '".$nCuenta."', '".$ALMACEN."', '".$status."', '".$paso."', '".$fecha1."', '".$hora1."','".$usuario."',
'".$keyClientesInternos."','".$entidad."' )"; mysql_db_query($basedatos,$agrega1);
echo mysql_error();
} else {
$q = "UPDATE procesoAlta set 
status='cargado',nPaso='2' 

WHERE 
almacen='".$ALMACEN."'
and
entidad='".$entidad."'
and
keyClientesInternos='".$_GET['nT']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}



$alta='desactivar';
}


if(!$alta){
$alta='activar';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<?php require("/configuracion/funciones.php");//ventanasPrototype::links();?>
<form id="form1" name="form1" method="get" action="#">
  <h1 align="center" class="titulos"> <?php echo $TITULO; ?></h1>
  <table width="739" border="0.2" align="center">
    <tr>
      <th width="50" bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco"># Folio</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco">Nombre del paciente:</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco">Seguro</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="center" class="blanco">Usuario</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="center" class="blanco">Fecha</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="center" class="blanco">Cuarto</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="center" class="blanco">Status</div></th>
    </tr>
    <tr>
      <?php	
	  $almacenesCierreCuenta=new articulosDetalles();
$cierreCuentaReporte=new articulosDetalles();
 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCuenta = 'abierta'
and
status='activa'
and 
(statusDeposito='pagado' or statusDeposito='cxc' or statusDeposito='urgencias')
ORDER BY keyClientesInternos DESC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$seguro=$myrow['seguro'];
$nT=$myrow['keyClientesInternos'];

$sSQL1711= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
numCliente = '".$seguro."'

";
$result1711=mysql_db_query($basedatos,$sSQL1711);
$myrow1711 = mysql_fetch_array($result1711);
$seguro=$myrow1711['nomCliente'];

if($seguro){
$tipoCliente='aseguradora';
} else {
$tipoCliente='particular';
}

if(!$seguro)$seguro='particular';



$sSQL11= "
	SELECT 
*
FROM
procesoAlta
WHERE 
entidad='".$entidad."' 
and
keyClientesInternos = '".$nT."'
and
almacen='".$ALMACEN."'
";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

$sSQL12= "
SELECT 
altaEspecial
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$ALMACEN."'
and
altaEspecial='si'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
?>
      <td height="24" bgcolor="<?php echo $color?>" class="codigos">
	  
	  <?php echo $myrow['keyClientesInternos'];
?></td>


      <td width="253" bgcolor="<?php echo $color?>" class="normal">

	  	  <?php echo $myrow['paciente'];
echo $cierreCuentaReporte->cierreCuentaReportes($entidad,$nT,$numeroE,$nCuenta,$basedatos);
if(	  $almacenesCierreCuenta->almacenesCierreCuenta($ALMACEN,$fecha1,$hora1,$usuario,$myrow['keyClientesInternos'],$entidad,$numeroE,$nCuenta,$basedatos)=='cargado'){
echo '<span class="style9">'.' [La Cuenta en este departamento ha sido Liberada]'.'</span>';
}
	  ?>
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>
      </span></td>

      <td width="143" bgcolor="<?php echo $color?>" class="normal">
	  <?php echo $seguro;?></td>
      <td width="61" bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow11['usuario'];
?></td>
      <td width="94" bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow11['fecha']." ".$myrow11['hora'];
?></td>
      <td width="60" bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['cuarto']
?></td>
      <td width="48" bgcolor="<?php echo $color?>" class="normal">
	  
	  
	  
	  
	  <?php
	  //alta especial 
	  if($myrow12['altaEspecial'] and $myrow11['status']=='standby'){
	  
	  ?>
	  <img src="/sima/imagenes/iconosSima/lock_icon.jpg" alt="LA CUENTA ESTA EN PROCESO" width="12" height="12" border="0" />
	  
	  
	  <?php } else { ?>
	  
	  <?php if($myrow11['status']=='request' or $myrow11['status']=='standby' )
	   { ?>
	  
	  	
	  <a href='liberarCuenta.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&alta=<?php echo $alta; ?>&nT=<?php echo $nT; ?>'"><img src="/sima/imagenes/iconosSima/lock_icon.jpg" alt="LA CUENTA YA FUE REVISADA, FALTA LIBERAR" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas liberar la cuenta del paciente <?php echo $myrow['paciente'];?>?') == false){return false;}" />	  </a>
	  
	  <?php } else if($myrow11['status']=='cargado') { ?>

	    <img src="/sima/imagenes/iconosSima/unlock_icon.jpg" alt="CUENTA REVISADA" width="12" height="12" border="0"  />
	  <?php } else {?>
	  <img src="/sima/imagenes/pendiente.png" alt="LA CUENTA FALTA POR REVISAR" width="12" height="12" border="0"  />
	  <?php }} ?>	  </td>
    </tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>



<?php 
$titulo='prueba';
$url=$ventana;
$abajo=70;
$izquierda=0;
$ancho=300;
$alto=200;
//$ventanas=new ventanasPrototype();
//$ventanas->despliegaVentana($titulo,$url,$abajo,$izquierda,$anchura,$altura);?>


  <p>&nbsp;</p>
</form>
</body>
</html>


<?php 

}//cierra funcion
}//cierra clase 
?>




























<?php
class muestraExternos{
public function listaExternos($entidad,$TITULO,$fecha1,$ventana,$basedatos){
?>
  <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsación de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">

.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}


div.htmltooltip{
position: absolute; /*leave this and next 3 values alone*/
z-index: 1000;
left: -1000px;
top: -1000px;
background: #272727;
border: 10px solid black;
color: white;
padding: 3px;
width: 250px; /*width of tooltip*/
}

</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<body>


<form id="form1" name="form1" method="get" action="#">
  <h1 align="center"> <?php echo $TITULO; ?></h1>
  <table width="584" border="0.2" align="center">
    <tr>
      <th width="51" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13"># Folio </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Aseguradora</span></th>
	  <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Departamento</span></th>
    </tr>
    <tr>
      <?php	

 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."' AND
status='pendiente' 
and 
tipoPaciente='externo'
AND
fecha1='".$fecha1."'
ORDER BY keyClientesInternos DESC
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
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['keyClientesInternos'];
?></span></td>


      <td width="257" bgcolor="<?php echo $color?>" class="style12"><span class="style7">

	  	  <?php 

$verificaCargos=new acumulados();
$verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta);
if($verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta)==TRUE){	  
?>
	  <a href="#"  onClick="javascript:ventanaSecundaria('<?php echo $ventana;?>?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
		&amp;nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&amp;almacen=<?php echo $bali; ?>&amp;nT=<?php echo $nT; ?>')">
	  <?php echo $myrow['paciente'];?></a>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  ?> 
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="138" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php 
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

<td width="120" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
*
FROM
almacenes
WHERE 
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></span></td>

    </tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>






  <p>&nbsp;</p>
</form>
</body>
</html>


<?php 

}//cierra funcion
}//cierra clase 
?>