<?php class consultaArticulosPrecio{
public function consultarVarios($TITULO,$gpoProducto,$almacen,$entidad,$basedatos){
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
<script language=javascript> 
function ventanaSecundaria19 (URL){ 
   window.open(URL,"ventana19","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES")
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
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
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
.Estilo241 {font-size: 12px}
-->
</style>
</head>

<body>
<h1 align="center"><?php echo $TITULO;?></h1>



<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" id="form1" name="form1">
  <table width="588" border="0" align="center">
    <tr>
      <td width="115"><span class="Estilo24">Introduce el texto a buscar:</span></td>
      <td width="412"><input name="criterio" type="text" class="Estilo24" size="22" maxlength="150" /></td>
    </tr>
    <tr>
      <td><span class="Estilo24">Compania Aseguradora </span></td>
      <td><input name="seguro" type="hidden" class="Estilo241" id="seguro"   readonly=""
		value="<?php if($_GET['seguro'] ){ echo $_GET['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        <input name="agregarCargos3" type="button" class="Estilo241" id="agregarCargos3"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/agregarSeguros.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>')" value="S" />
        <input name="nomSeguro" type="text" class="Estilo24" id="nomSeguro" size="80" readonly="" 
		value="<?php 
		 if($_GET['seguro'] ){ 
		echo $_GET['nomSeguro'];
		}
		?>"/></td>
    </tr>
    <tr>
      <td><span class="Estilo24">Mostrar Registros</span></td>
      <td><input name="registros" type="text" class="Estilo24" id="registros" value="<?php if($_GET['registros']==NULL){ echo $_GET['registros']='30';} else { echo $_GET['registros'];}?>" size="3" maxlength="3" onKeyPress="return checkIt(event)"/></td>
    </tr>
    <tr>
      <td><span class="Estilo24">Particular (reporte) </span></td>
      <td><label>
        <input name="particular" type="checkbox" id="particular" value="si" <?php if($_GET['particular']=='si') echo 'checked';?> />
      </label></td>
    </tr>
    <tr>
      <td><span class="Estilo24">Aseguradora</span> <span class="Estilo24">(reporte)</span></td>
      <td><input name="aseguradora" type="checkbox" id="aseguradora" value="si"  <?php if($_GET['aseguradora']=='si') echo 'checked';?>/></td>
    </tr>
    <tr>
      <td><span class="Estilo24">Referido</span></td>
      <td><input name="referido" type="checkbox" id="referido" value="si"  <?php if($_GET['referido']=='si') echo 'checked';?>/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="desplegar" type="submit" class="Estilo24" id="desplegar" value="Buscar/Desplegar Art&iacute;culos" /></td>
    </tr>
  </table>
  <p align="center">
    <label></label>
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
$ssql = "select *,articulos.activo as active from articulos,existencias " . $criterio;
} else {
$ssql = "select *,articulos.activo as active from articulos,existencias where 

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

if($_GET['criterio'] ){
$ssql = "select *,articulos.activo as active from articulos,existencias " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
} else {
$ssql = "select *,articulos.activo as active from articulos,existencias 
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
if($num_total_registros and $_GET['desplegar']){

?>
  </p>
  <table width="773" border="0" align="center" cellpadding="4" cellspacing="0" class="Estilo241">
    <tr bgcolor="#FFFF00">
      <th width="93" scope="col"><div align="left"><span class="normal">C&oacute;digo</span></div></th>
      <th width="463" scope="col"><div align="left"><span class="normal">Descripci&oacute;n</span></div></th>
      <th width="67" scope="col"><div align="left"><span class="normal">Precio P </span></div></th>
      <th width="54" scope="col"><div align="left"><span class="normal">Precio A </span></div></th>
      <th width="74" scope="col"><div align="left"><span class="normal">Precio Convenio. </span></div></th>
    </tr>
	

	
	
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
$color = '#FFFF99';
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
codigo = '".$myrow['codigo']."' 
and
almacen='".$ALMACEN."'
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
  
$sSQL8="SELECT *
FROM
convenios
WHERE entidad='".$entidad."' AND
codigo = '".$myrow['codigo']."' 
and
departamento='".$ALMACEN."'
and
numCliente='".$_GET['seguro']."'
  ";
  $result8=mysql_db_query($basedatos,$sSQL8);
  $myrow8 = mysql_fetch_array($result8);
  
  
$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);



?>
      <td bgcolor="<?php echo $color;?>" height="24" class="style71"><span class="">
        <label><?php echo $myrow39['prefijo'].$C?></label>
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
      <td bgcolor="<?php echo $color;?>" class="style71" ><?php 
	  if(!$myrow8['costo']){ 
	  echo "$".number_format($myrow7['nivel1'],2);
	  }else {
	  echo '---';
	  }
	  ?>&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" class="style71" ><?php 
	  if(!$myrow8['costo']){ 
	  echo "$".number_format($myrow7['nivel3'],2);
	  } else {
	  echo '---';
	  }
	  ?></td>
      <td bgcolor="<?php echo $color;?>" class="style71" ><?php 

echo "$".number_format($myrow8['costo'],2);
?></td>
    </tr>
    <?php }//cierra while?>
  </table>
  <p align="center">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label>
    <input name="actualizar" type="submit" class="style71" id="actualizar" value="Actualizar " />
    </label>
    <input name="gpoProducto1" type="hidden" id="gpoProducto1" value="<?php echo $_GET['gpoProducto1']; ?>" />
</p>
</form>


<div align="center" class="Estilo24">
  <p>
    <?php


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
echo "<a href=".$_SERVER['PHP_SELF']."?pagina=" . $i . "&criterio=" . $txt_criterio . "&registros=" . $_GET['registros'] ."&amp;particular=".$_GET['particular']."&amp;aseguradora=".$_GET['aseguradora']."&amp;desplegar=".$_GET['desplegar'].">". $i ."</a> ";
	}
}

?>
  </p>
  <p>  <a href="javascript:ventanaSecundaria19('/sima/cargos/imprimirPrecios.php?nRequisicion=<?php echo $requisicion; ?>&amp;almacen=
		<?php echo $ALMACEN; ?>&amp;referido=<?php echo $_GET['referido']; ?>&amp;aseguradora=<?php echo $_GET['aseguradora']; ?>&amp;particular=<?php echo $_GET['particular']; ?>&amp;gpoProducto=<?php echo $gpoProducto; ?>&amp;codigo=<?php echo $C; ?>&amp;almacenes=<?php echo $Cd; ?>')"><img src="/sima/imagenes/btns/new_print.png" alt="Modificar Precios" width="125" height="40" border="0" /></a></p>
</div>
</body>
</html>
<?php } else { echo 'No hay registros para mostrar!';}//cierro validacion de MYSQL?>
<?php 
}
}
?>
