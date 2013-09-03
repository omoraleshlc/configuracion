<?php 
class consultaArticulosPrecio{
public function consultarVarios($gpoProducto,$almacen,$entidad,$basedatos){
$ALMACEN=$almacen;

?>

<?php  
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE articulos set 

		activo='I'
		WHERE entidad='".$entidad."' AND
		codigo='".$_GET['codigo']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else if($_GET['activa']=="activa"){
 $q = "UPDATE articulos set 

		activo='A'
		WHERE entidad='".$entidad."' AND
		codigo='".$_GET['codigo']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=350,height=189,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=450,height=170,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=450,height=170,scrollbars=YES") 
} 
</script> 

<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_GET['actualizar']){
$keyPA=$_GET['keyPA'];
$gpoProducto=$_GET['gpoProducto'];
for($i=0;$i<=$_GET['bandera'];$i++){
if($keyPA[$i]!=NULL){
$q1 = "UPDATE articulos set 

gpoProducto='".$gpoProducto[$i]."',

fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}
echo 'Se hicieron cambios en el sistema...';
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
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style14 {color: #0000FF}
.Estilo24 {font-size: 10px}
.style19 {color: #FFFFFF}
.style20 {font-size: 10px; color: #FFFFFF; }
.style7 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style72 {font-size: 10px}
.style72 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center"><?php echo $gpoProducto;?></h1>
<?php 
function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
?>


<form action="precios.php" method="get">
  <p align="center"><span class="Estilo24">Introduce el texto a buscar:</span>
    <input name="criterio" type="text" class="Estilo24" size="22" maxlength="150">
    <input type="submit" class="Estilo24" value="Buscar"> 
    <span class="Estilo24">Mostrar Registros</span>
    <label>
    <input name="registros" type="text" class="Estilo24" id="registros" value="<?php if($_GET['registros']==NULL){ echo '30';} else { echo $_GET['registros'];}?>" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
    </label>
</p>
  <table width="834" border="0" align="center">
    <tr>
      <th width="80" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo</span></div></th>
      <th width="227" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripci&oacute;n</span></div></th>
      <th width="190" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Sustancia</span></div></th>
      <th bgcolor="#660066" scope="col"><div align="left"><span class="style11">GRUPO</span></div>
          <div align="left"></div></th>
      <th width="30" bgcolor="#660066" scope="col"><div align="left"><span class="style11">UM</span></div></th>
      <th width="45" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Precios</span></div></th>
      <th width="23" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Mod </span></div></th>
      <th width="35" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Status </span></div></th>
    </tr>
	
<?php 	
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";
if ($_GET["criterio"]!="" and $_GET["criterio"]!='*'){
	$txt_criterio = $_GET["criterio"];
	$criterio = " where articulos.entidad='".$entidad."'
	AND
	existencias.almacen='".$ALMACEN."'
	AND
	articulos.codigo=existencias.codigo
	AND
	articulos.gpoProducto='".$gpoProducto."' 
	AND
	(articulos.descripcion like '%" . $txt_criterio . "%' or articulos.descripcion1 like '%" . $txt_criterio . "%') order by articulos.descripcion ASC";
} else if($_GET["criterio"]=='*'){
$criterio = "order by articulos.descripcion ASC";
}



if($_GET['criterio']){
$ssql = "select * from articulos,existencias " . $criterio;
} else {
$ssql = "select * from articulos,existencias where 

	existencias.almacen='".$ALMACEN."'
	AND
	articulos.codigo=existencias.codigo
	AND
articulos.entidad='".$entidad."' and articulos.gpoProducto='".$gpoProducto."' order by articulos.descripcion ASC";
}

$result = mysql_db_query($basedatos,$ssql);
$num_total_registros = mysql_num_rows($result);

//Limito la busqueda
if($_GET['registros']==NULL){
$TAMANO_PAGINA = 30;
} else {
$TAMANO_PAGINA=$_GET['registros'];
}
//examino la página a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
		$inicio = 0;
		$pagina=1;
}
else {
	$inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

//miro a ver el número total de campos que hay en la tabla con esa búsqueda

//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

if($_GET['criterio']){
$ssql = "select * from articulos,existencias " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
} else {
$ssql = "select * from articulos,existencias 
where
articulos.entidad='".$entidad."'
and
articulos.codigo=existencias.codigo
and
existencias.almacen='".$ALMACEN."'
and
articulos.gpoProducto='".$gpoProducto."'
order by articulos.descripcion ASC limit " . $inicio . "," . $TAMANO_PAGINA;
}

$result = mysql_db_query($basedatos,$ssql);
?>
	
	
    <tr>
      <?php
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];
$sSQL52="SELECT count(*) as totalRegedit
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
  
$i=$myrow52['totalRegedit'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

$sSQL51="SELECT *
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
$bali=$myrow51['almacen'];

  
  $sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE entidad='".$entidad."' AND
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
articulosPrecioNivel
WHERE entidad='".$entidad."' AND
codigo = '".$code."' 
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  


?>
      <td bgcolor="<?php echo $color;?>" height="24" class="style71"><span class="">
        <label><?php echo $C?></label>
        <input name="keyPA[]" type="hidden" id="codigo" value="<?php echo $myrow['keyPA'];?>" />
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style71"><span class=""><?php echo $myrow['descripcion']; ?>
            <?php 
	  if(!$bali){
	   echo '<img src="/sima/imagenes/stop.png" alt="NO TIENE ASIGNADO NINGUN PRECIO O ALMACEN" width="13" height="13" border="0" />';
	   }
	  ?>
            <?php if($myrow['generico']=='si'){?>
            <blink> <img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" /> </blink>
            <?php } else { echo '';}?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style71"><span class="Estilo24"><span class="">
        <?php 
	  if($myrow['descripcion1']){
	  echo $myrow['descripcion1'];
	  } else {
	  echo '(Sin Sustancia...)';
	  }
	   ?>
      </span></span></td>
      <td bgcolor="<?php echo $color;?>" class="style71"><?php //*********gpoProductos
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
          <select name="gpoProducto[]" class="Estilo24" id="gpoProducto[]" >
            <option value="">Escoje el Grupo</option>
            <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
            <option 
		    <?php 		if($_GET['gpoProducto1']==$myrow7['codigoGP'] or $myrow['gpoProducto']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']." - ".$myrow7['codigoGP']; ?></option>
            <?php } 
		
		?>
        </select></td>
      <td bgcolor="<?php echo $color;?>" class="style71"><?php if($myrow['um']){ ?>
          <a href="javascript:ventanaSecundaria7('ventanitaCambiaUM.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;gpoProducto=<?php echo $myrow['gpoProducto']; ?>')"><?php echo $UM=$myrow['um']; ?></a>
          <?php } else { ?>
          <a href="javascript:ventanaSecundaria7('ventanitaCambiaUM.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;gpoProducto=<?php echo $myrow['gpoProducto']; ?>')"> <?php echo '?'; ?> </a>
          <?php 
	  }
	  ?>
      </td>
      <td bgcolor="<?php echo $color;?>" class="style71" ><div align="left"><span class=""> <a href="javascript:ventanaSecundaria2('/sima/cargos/listaAlmacenes.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>')"> <img src="/sima/imagenes/almacen.jpeg" alt="Almacenes" width="12" height="12" border="0" /></a> </span></div></td>
      <td class="style71"><div align="left">
          <?php 
if($myrow['gpoProducto']=='PAT'){
$modifica='medicamentosPatentes.php';
} else if($myrow['gpoProducto']=='GEN'){
$modifica='medicamentosGenericos.php';
} else if($myrow['gpoProducto']=='MAT'){
$modifica='materiales.php';
} else if($myrow['gpoProducto']=='HONMED'){
$modifica='honorariosMedicos.php';
} else if($myrow['gpoProducto']=='sIVA'){
$modifica='interpHonMedicos.php';
} else if($myrow['gpoProducto']=='cIVA'){
$modifica='interpHonMedicos.php';
}


?>
          <?php if($modifica){ ?>
          <a href="<?php echo $modifica?>?nRequisicion=<?php echo $requisicion; ?>&amp;almacen=
		<?php echo $myrow13['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacen=<?php echo $ali; ?>"><img src="/sima/imagenes/Save.png" alt="Modificaci&oacute;n de Art&iacute;culos, M&aacute;ximo, M&iacute;nimo, Reorden.." width="12" height="12" border="0" /> </a>
          <?php } else { echo '?';} ?>
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="style71"><div align="center">
          <?php if($myrow['activo']=='A'){ ?>
          <span class="Estilo24"> <a href="listaMateriales.php?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>"> <img src="/sima/imagenes/surtido.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
          <?php } else { ?>
          <a href="listaMateriales.php?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C?>"> <img src="/sima/imagenes/candado.png" alt="INACTIVO" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
          <?php } ?>
      </span></div></td>
    </tr>
    <?php }?>
  </table>
  <p align="center">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label>
    <input name="actualizar" type="submit" class="style71" id="actualizar" value="Actualizar " />
    </label>
    <input name="gpoProducto1" type="hidden" id="gpoProducto1" value="<?php echo $_GET['gpoProducto1']; ?>" />
</p>
</form>


<div align="center" class="Estilo24"><?php


//pongo el número de registros total, el tamaño de página y la página que se muestra
echo "Número de registros encontrados: " . $num_total_registros . "<br>";
echo "Se muestran páginas de " . $TAMANO_PAGINA . " registros cada una<br>";
echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";


//construyo la sentencia SQL
/* $ssql = "select * from articulos " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
echo $ssql . "<p>"; */

/*
$rs = mysql_query($ssql);

 while ($fila = mysql_fetch_object($rs)){
	echo $fila->descripcion . "<br>";
} */

//cerramos el conjunto de resultados y la conexión con la base de datos
/* mysql_free_result($rs);
mysql_close($conn); 
 */
//echo "<p>";

//muestro los distintos índices de las páginas, si es que hay varias páginas
if ($total_paginas > 1){
	for ($i=1;$i<=$total_paginas;$i++){
		if ($pagina == $i) 
			//si muestro el índice de la página actual, no coloco enlace
			echo $pagina . "  ";
		else
			//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
			echo "<a href='listaMateriales.php?pagina=" . $i . "&criterio=" . $txt_criterio . "&registros=" . $_GET['registros'] . "'>" . $i . "</a> ";
	}
}

?>
<a href="javascript:ventanaSecundaria19('/sima/cargos/imprimirPrecios.php?nRequisicion=<?php echo $requisicion; ?>&amp;almacen=
		<?php echo $_POST['almacenDestino1']; ?>&amp;gpoProducto=<?php echo $gpoProducto; ?>&amp;codigo=<?php echo $C; ?>&amp;almacenes=<?php echo $Cd; ?>')"><img src="/sima/imagenes/impresora.jpg" alt="Modificar Precios" width="117" height="60" border="0" /></a></div>
</body>
</html>

<?php 
}
}
?>
