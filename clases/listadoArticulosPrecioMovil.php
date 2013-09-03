<?php 
class consultaArticulosPrecio{
public function consultarArticulos($almacen,$entidad,$basedatos){
?>

<?php $articulo = $_POST['nomArticulo']; ?>

<?php 
if($_POST['borrar'] AND $_POST['quitar']){
$quitar=$_POST['quitar'];
for($i=0;$i<=$_POST['bandera'];$i++){
echo $borrame = "DELETE FROM articulos WHERE codigo ='".$_POST['codigo']."'";
//mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo $borrame1 = "DELETE FROM precioArticulos WHERE codigo ='".$_POST['codigo']."'";
//mysql_db_query($basedatos,$borrame1);
echo mysql_error();
echo $borrame2 = "DELETE FROM existencias WHERE codigo ='".$_POST['codigo']."'";
//mysql_db_query($basedatos,$borrame2);
echo mysql_error();
echo $borrameNivel = "DELETE FROM articulosPrecioNivel WHERE codigo ='".$_POST['codigo']."'";
//mysql_db_query($basedatos,$borrameNivel);
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL ARTICULO"
</script>';
}
}
?>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style14 {color: #0000FF}
.style18 {font-size: 10px; font-style: italic; }
.Estilo24 {font-size: 10px}
.style19 {color: #FFFFFF}
.style20 {font-size: 10px; color: #FFFFFF; }
.style7 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>
</head>

<body>
<h5 align="center">LISTADO DE ARTICULOS </h5>
<form id="form2" name="form2" method="post" action="">
  <table width="211" border="0" align="center">
    <tr>
      <th height="22" bgcolor="#660066" scope="col"><div align="center" class="style19"><span class="Estilo24">Art&iacute;culo </span></div></th>
      <th bgcolor="#660066" scope="col"><div align="right"><span class="style19"><span class="Estilo24">
        <input name="nomArticulo" type="text" class="Estilo24" id="nomArticulo" size="20" 
		  
		  value="<?php if($_POST['nomArticulo']){ echo $_POST['nomArticulo']; }?>"/>
      </span></span></div></th>
    </tr>
    <tr>
      <th width="59" height="22" scope="col">&nbsp;</th>
      <th width="108" scope="col"><div align="right"><span class="style20">
        </span><span class="style20"><span class="style19">
          <input name="buscar" type="submit" class="Estilo24" id="buscar" value="buscar" />
          </span>
          </select>
      </span></div></th>
    </tr>
  </table>
</form>
<p align="center" class="style14"><span class="style14">
  <?php	
if($_POST['nomArticulo']){	  
	  $articulo = $_POST['nomArticulo'];

if($articulo){ 
if($articulo=='*'){
$sSQL= "
SELECT  * FROM articulos,existencias
WHERE articulos.entidad='".$entidad."' 
AND
existencias.codigo=articulos.codigo
AND
existencias.almacen='".$almacen."'
order by articulos.descripcion ASC";
} else if($articulo=='**'){ 
$sSQL= "
SELECT  * FROM articulos
where
entidad='".$entidad."' order by descripcion ASC";
} else {
if(is_numeric($articulo)){
$sSQL= "
SELECT  * FROM articulos
WHERE entidad='".$entidad."' AND
cbarra='".$articulo."'";
} else {
$sSQL= "
SELECT  * FROM articulos
WHERE entidad='".$entidad."' AND
descripcion LIKE '%$articulo%' 
and
um<>'s'

 order by descripcion ASC";
}
}

} 


if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
</span></p>
      <form id="form1" name="form1" method="post" action="modificaA.php">
        <table width="264" border="0" align="center">
    <tr>
      <th width="163" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="31" bgcolor="#660066" scope="col"><span class="style11">Part</span></th>
      <th width="33" bgcolor="#660066" scope="col"><span class="style11">CIA</span></th>
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
      <td height="24"  bgcolor="<?php echo $color;?>" class="style7"><span class=""><?php echo $myrow['descripcion']; ?> 
	  	<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
	  </span></td>
      <td bgcolor="<?php echo $color;?>" class="style7">
	     <?php 
	  if($myrow7['nivel1']>"1"){ ?>

     <?php 
	  echo "$".number_format($myrow7['nivel1'],2); 
	  

	  } else {
	  echo "S/N";
	  }
	  ?>
	  
	  &nbsp;</td>
      <td bgcolor="<?php echo $color;?>" class="style7"><?php echo   "$".number_format($myrow7['nivel3'],2);?>&nbsp;</td>
      <?php
	  if($UM=='s' or $UM=='S'){
	  $modifica='modificaP.php';
	  } else {
	  $modifica='modificaA.php';
	  }
	  ?>
    </tr>
    <?php }}}?>
  </table>
  <p align="center">
    <label></label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
  </p>
</form>
<?php if($totalRegistros){ ?>
<div align="center"><a href="/sima/movil/sistemas/menuIndex.php"><span class="style71">Regresar a Men&uacute;</span></a> </div>
<p align="center"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>