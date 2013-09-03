<?php $articulo = $_POST['nomArticulo']; ?>


<?php 
class listaServicios{

public function listadoServicios($entidad,$almacenSolicitante,$codigo,$basedatos){


if(!$_POST['almacenDestino'])$_POST['almacenDestino']=$ALMACEN;

?>


<?php 
function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=350,height=170,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script> 
<?php 
if($_GET['codigo'] AND $_GET['inactiva']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE articulos set 

		activo='I'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['codigo']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
$q = "UPDATE articulos set 

		activo='A'
		WHERE entidad='".$entidad."' AND
		codigo='".$_GET['codigo']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
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
.style7 {
	font-size: 9px;
	color: #FFFFFF;
}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style14 {color: #0000FF}
.style18 {font-size: 10px; font-style: italic; }
.Estilo24 {font-size: 10px}
.style19 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>
</head>

<body>
<h1 align="center">LISTADO DE SERVICIOS </h1>
<form id="form2" name="form2" method="post" action="">
  <table width="545" border="0" align="center">
    <tr>
      <th width="153" scope="col"><div align="left"><span class="style12">Servicios</span></div></th>
      <th width="382" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="80" 
		  
		  value="<?php if($_POST['nomArticulo']){ echo $_POST['nomArticulo']; }?>"/>
</span></div>      </th>
    </tr>
    <tr>
      <th height="43" scope="col">&nbsp;</th>
      <th scope="col"><div align="left">
        <input name="buscar" type="submit" class="Estilo24" id="buscar" value="buscar" />
        <?php if($_POST['nomArticulo']==='*'){ ?>
        <span class="style18">Este proceso puede demorar varios minutos...</span>
        <?php } ?>
      </div>
      <label>      </label></th>
    </tr>
  </table>
</form>
<p align="center" class="style14">
  <?php	

if($_POST['buscar'] AND $_POST['nomArticulo'] ){	

	  $articulo = $_POST['nomArticulo'];


if($articulo=='*'){
$sSQL= "
SELECT * FROM articulos

 WHERE 
 articulos.entidad='".$entidad."' AND
 articulos.servicio='si' AND
 
articulos.activo!='cancelado' 

 order by articulos.descripcion ASC";
 } else {

$sSQL= "
SELECT * FROM articulos
WHERE articulos.entidad='".$entidad."' AND
 articulos.servicio='si' and
articulos.descripcion like '%$articulo%'
and
articulos.activo!='cancelado'
group by articulos.codigo
 order by articulos.descripcion ASC";
 }





if($result=mysql_db_query($basedatos,$sSQL)){


?>
</p>
      <form id="form1" name="form1" method="get" action="<?php echo $modifica='modificaP.php';?>">
  <p>&nbsp;</p>
  <table width="783" border="0" align="center" class="style19">
    <tr>

      <th width="408" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left"><span class="style12">Descripci&oacute;n</span></div></th>
      <th width="116" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left"><span class="Estilo24">Fecha Mod. </span></div></th>
      <th width="44" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left"><span class="Estilo24">Precios</span></div></th>
      <th width="49" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">Modificar </div></th>
      <th width="48" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">Status </div></th>
    </tr>
    <tr>

<?php
while($myrow = mysql_fetch_array($result)){
echo mysql_error();
$codigo=$code = $myrow['codigo'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
  $sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE
codigo = '".$code."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$C=$myrow['codigo'];
 $sSQL7="SELECT *
FROM
  `clientesPrecios`
WHERE
codigo = '".$code."' and numCliente='".$_POST['seguro']."'  
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);

  
  if($myrow6['nivel1']=="1" or $myrow6['nivel3']=="1"){
  //$color='#FF0000';
  //$estilo="style11";
  }
$totalRegistros+="1";
 $sSQL15="SELECT *
FROM
  `articulos`
WHERE
codigo = '".$code."'  
  ";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);
  
  
  $sSQL51="SELECT *
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
$bali=$myrow51['almacen'];
?>
      
      <td  bgcolor="<?php echo $color;?>" ><div align="left"><span class="">
	  <?php echo $myrow15['descripcion']; ?>
        <?php 
	  if(!$bali){
	   echo '<img src="/sima/imagenes/candado.png" alt="NO TIENE ASIGNADO NINGUN PRECIO O ALMACEN" width="13" height="13" border="0" />';
	   }
	  ?>
    </span></div></td>
    
	  <td bgcolor="<?php echo $color;?>" class="style12"><?php 
	  if($myrow['fechaActualizacion']){
	  echo $myrow['usuario']." ".cambia_a_normal($myrow['fechaActualizacion'])." ".$myrow['hora'];
	  } else {
	  echo '...';
	  }
	   ?></td>
	  <td bgcolor="<?php echo $color;?>" class="style12"><div align="left"><span class=""> <a href="javascript:ventanaSecundaria2('/sima/cargos/listaAlmacenes.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow['keyPA']; ?>')"> <img src="/sima/imagenes/almacen.jpeg" alt="Almacenes" width="12" height="12" border="0" /></a> </span></div></td>
	  <td bgcolor="<?php echo $color;?>" class="style12"><div align="left"><a href="<?php echo $modifica;?>?nRequisicion=<?php echo $requisicion; ?>&amp;almacen=
		<?php echo $myrow13['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;codigo=<?php echo $codigo; ?>&amp;almacen=<?php echo $_POST['almacenDestino1']; ?>"><img src="/sima/imagenes/Save.png" alt="Modificaci&oacute;n de Art&iacute;culos, M&aacute;ximo, M&iacute;nimo, Reorden.." width="12" height="12" border="0" /> </a> </div></td>
	  <?php 
$sSQL151="SELECT articulos.codigo
FROM
articulos,articulosPaquetes
WHERE articulos.entidad='".$entidad."' AND
articulos.codigo = '".$code."'  and
articulos.codigo=articulosPaquetes.codigo
and
articulos.entidad=articulosPaquetes.entidad
group by articulos.codigo
  ";
  $result151=mysql_db_query($basedatos,$sSQL151);
  $myrow151 = mysql_fetch_array($result151);
	  if($myrow151['codigo']){
	  $ventanita='/sima/cargos/ventanitaCambiaPVyP.php';
	  } else {
	  $ventanita='/sima/ADMINHOSPITALARIAS/inventarios/ventanitaCambiaPrecio.php';
	  }
	  ?>
	  
	  
	  
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style71">
        <?php if($myrow['activo']=='A'){ ?>
      </span> <span class="Estilo24"> <a href="catalogoAlmacen.php?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>"> <img src="/sima/imagenes/surtido.png" alt="ACTIVO" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
      <?php } else { ?>
      <a href="catalogoAlmacen.php?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C?>"> <img src="/sima/imagenes/candado.png" alt="INACTIVO" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
      <?php } ?>
      </span></td>
    </tr>
    <?php }}}?>
  </table>
  <p align="center">
    <label></label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />
  </p>
</form>
<?php if($totalRegistros){ ?>
<p align="center"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
} ?>