<?php 
class consultaArticulosPrecio{
public function consultarArticulos($almacen,$entidad,$basedatos){
?>

<?php $articulo = $_GET['nomArticulo']; ?>

<?php  
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE articulos set 

		activo='I'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else if($_GET['activa']=="activa"){
 $q = "UPDATE articulos set 

		activo='A'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
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
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>
<h1 align="center" class="titulos">Listado por GPO </h1>
<?php 
function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
?>


<?php 
if(!$_GET['almacenDestino']){
$_GET['almacenDestino']=$_GET['almacenDestino'];
}
if(!$_GET['almacenDestino1']){
$_GET['almacenDestino1']=$_GET['almacenDestino1'];
}


?>

<form id="form2" name="form2" method="get" action="">
  <table width="474" border="0" align="center">
    <tr>
      <th height="21" bgcolor="#660066" scope="col"><div align="center" class="blanco">Almac&eacute;n Principal</div></th>
      <th bgcolor="#660066" scope="col"><div align="left"><?php 
	  $aCombo= "Select * From almacenes where ventas='si' and entidad='".$entidad."' AND
activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="combos" id="almacenDestino" onChange="javascript:this.form.submit();"/>        
<option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($_GET['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	  </div></th>
    </tr>
    <tr>
      <th height="21" class="negro" scope="col">Mini Almac&eacute;n </th>
      <th class="style71" scope="col"><div align="left">
	  <?php 
  $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$_GET['almacenDestino']."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino1" class="combos" id="almacenDestino1" onChange="javascript:this.form.submit();"/>        
<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_GET['almacenDestino']."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
       <option value="<?php echo $_GET['almacenDestino'];?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>



        <option 

		
		<?php 
		 if($_GET['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	  </div></th>
    </tr>
    <tr>
      <th width="185" height="22" bgcolor="#660066" scope="col"><div align="center" class="blanco">Grupo de Producto</div></th>
      <th width="525" bgcolor="#660066" scope="col">
          </span>
        <div align="left" class="style19">
          <label>
      <?php //*********gpoProductos
	  if(!$_GET['gpoProducto1']){
	  $_GET['gpoProducto1']=$_GET['gpoProducto1'];
	  }
	  
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
          <select name="gpoProducto1" class="combos" id="gpoProducto1" >
		  <option value="">---</option>
            <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
            <option 
		    <?php 		if($_GET['gpoProducto1']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']." - ".$myrow7['codigoGP']; ?></option>
            <?php } 
		
		?>
          </select>
          </label>
</span><?php 
		  if(!$_GET['gpoProducto1'] and $_GET['gpoProducto1']){
		  $_GET['gpoProducto1']=$_GET['gpoProducto1'];
		  } else if(!$_GET['gpoProducto1'] and $_GET['gpoProducto']){
		  $_GET['gpoProducto1']=$_GET['gpoProducto'];
		  }
		  ?>
        </div>        </th>
    </tr>
    <tr bgcolor="#FFFFFF">
      <th height="22" scope="col">&nbsp;</th>
      <th scope="col"><div align="left"><span class="style19">
        <input name="buscar" type="image" src="/sima/imagenes/btns/searcharticles.png" id="buscar" value="buscar" />
      </span></div></th>
    </tr>
  </table>
</form>
<p align="center" class="normal">
  <?php		  $articulo = $_GET['nomArticulo'];
  
if(!$_GET['gpoProducto'] and !$articulo and $_GET['buscar']){ //no se cumple nada


//echo '<blink>'.'Este proceso puede durar varios minutos!, ten paciencia'.$usuario.'</blink>';

$sSQL= "
SELECT  * FROM articulos
where 
entidad='".$entidad."' AND


gpoProducto=''
and
activo='A'
order by
descripcion ASC";
}  
  
  
  
if($_GET['nomArticulo'] or $_GET['gpoProducto1'] or $_GET['buscar']){	  




if($_GET['gpoProducto1']){ 


if($_GET['gpoProducto1'] and !$articulo){
//codigo
   $sSQL= "
SELECT  *,articulos.activo as active FROM articulos,existencias
where 
articulos.entidad='".$entidad."' AND
articulos.codigo=existencias.codigo
and
existencias.almacen='".$_GET['almacenDestino1']."'
and
articulos.gpoProducto='".$_GET['gpoProducto1']."'
and
articulos.activo!='cancelado'
order by
articulos.descripcion ASC";
} else {

$sSQL= "
SELECT  *,activo as active FROM articulos
where 
entidad='".$entidad."' AND
(descripcion LIKE '%$articulo%' or descripcion1 LIKE '%$articulo%')
AND
gpoProducto='".$_GET['gpoProducto1']."'
and
activo!='cancelado'
order by
descripcion ASC";

}


} else {




if($articulo and !$_GET['gpoProducto1']){ 

if($articulo==='#'){
$sSQL= "
SELECT  *,articulos.activo as active FROM articulos,existencias
where 
articulos.entidad='".$entidad."' AND
and
articulos.codigo=existencias.codigo
and
existencias.almacen='".$_GET['almacenDestino1']."'
and
articulos.activo!='cancelado'
order by
articulos.fechaActualizacion DESC";


} else {
if($articulo==='*'){
$sSQL= "
SELECT  *,articulos.activo as active FROM articulos,existencias
where 
articulos.entidad='".$entidad."' AND
and
articulos.codigo=existencias.codigo
and
existencias.almacen='".$_GET['almacenDestino1']."'
and

articulos.activo!='cancelado'
order by
articulos.descripcion ASC";
} else if($articulo==='**'){ 
$sSQL= "
SELECT  *,articulos.activo as active FROM articulos,existencias
where
articulos.entidad='".$entidad."'  AND
articulos.codigo=existencias.codigo
and
existencias.almacen='".$_GET['almacenDestino1']."'
and
articulos.activo!='cancelado'
order by articulos.descripcion ASC";
} else {
if(is_numeric($articulo)){
$sSQL= "
SELECT  *,articulos.activo as active FROM articulos,existencias
WHERE articulos.entidad='".$entidad."' AND
articulos.cbarra='".$articulo."'
and
articulos.codigo=existencias.codigo
and
existencias.almacen='".$_GET['almacenDestino1']."'
and
articulos.activo!='cancelado'
";
} else {

 $sSQL= "
SELECT  *,articulos.activo as active FROM articulos,existencias
WHERE articulos.entidad='".$entidad."' AND
(articulos.descripcion LIKE '%$articulo%' or articulos.descripcion1 LIKE '%$articulo%')
and
articulos.codigo=existencias.codigo
and
existencias.almacen='".$_GET['almacenDestino1']."'
and
articulos.activo!='cancelado'
 order by articulos.descripcion ASC";
}
}
}
} //cierra validacion de artículos
}

$result=mysql_db_query($basedatos,$sSQL);



?>
</p>
      <form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="704" border="0" align="center">
    <tr>
  
      <th width="365" bgcolor="#660066" scope="col"><div align="left" class="blanco">Descripci&oacute;n</div></th>
      <!--<th width="132" bgcolor="#660066" scope="col"><div align="left" class="blanco">Sustancia</div></th>-->
      <!--<th width="101" bgcolor="#660066" scope="col"><div align="left" class="blanco">Fecha / Hora Modifica </div></th>-->
      <th width="133" bgcolor="#660066" scope="col"><div align="left" class="blanco">GRUPO</div>        <div align="left"></div></th>
      <th width="41" bgcolor="#660066" scope="col"><div align="left" class="blanco">P Part</div></th>
      <th width="50" bgcolor="#660066" scope="col"><div align="left" class="blanco">P Aseg</div></th>
      <th width="43" bgcolor="#660066" scope="col"><div align="left" class="blanco">Mod </div></th>
      <!--<th width="52" bgcolor="#660066" scope="col" class="blanco">Usuario</th>-->
      <th width="46" bgcolor="#660066" scope="col" class="blanco"><div align="left">Status </div></th>
    </tr>
    <tr valign="middle">

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
keyPA = '".$myrow['keyPA']."' 
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
$bali=$myrow51['almacen'];

  

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$C=$myrow['codigo'];


 $sSQL78="SELECT nivel1,nivel3
FROM
articulosPrecioNivel
WHERE 
keyPA = '".$myrow['keyPA']."' 
and
almacen='".$_GET['almacenDestino1']."'
  ";
  $result78=mysql_db_query($basedatos,$sSQL78);
  $myrow78 = mysql_fetch_array($result78);




$gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo,rutaModifica
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$color1='#FF3300';
$bandera=+1;
?>

      
      
      
      <td bgcolor="<?php 

	  echo $color;

	  ?>" class="normal"><span class="codigos">
        <input name="keyPA[]" type="hidden" id="codigo" value="<?php echo $myrow['keyPA'];?>" />
      </span>
        <?php 
	  
	  if($bali){ ?>
	  	  <label>
	  <a   href="javascript:ventanaSecundaria6('ventanaCambiaDescripcion.php?keyPA=<?php echo $myrow['keyPA'];?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>')">
	  <?php echo $myrow['descripcion']; ?>
      </a>
	  </label>
      
      <?php 
        } else {
	  
	   $imagen='<img src="/sima/imagenes/stop.png" width="13" height="13" border="0" />';
	   echo $myrow['descripcion'].'<blink>'.$imagen.'</blink>'.'< Sin Almacen..>';
	   }
	  ?>
	  
	  	<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
	  </span></td>
      
  <?php /*?><td bgcolor=" <?php echo $color;/?>" class="normal">
	 /*   <?php 
	  if($myrow['descripcion1']){
	  echo $myrow['descripcion1'];
	  } else {
	  echo '(Sin Sustancia...)';
	  }
	   ?>
       
       </td><?php */?>
	 
    <?php /*?>  <td bgcolor="<?php echo $color;?>" class="normal">
	  <?php echo cambia_a_normal($myrow['fechaActualizacion'])." <".$myrow['hora'].">"; ?></td><?php */?>
      <td bgcolor="<?php echo $color;?>" class="style7"><?php //*********gpoProductos
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="gpoProducto[]" class="combos" id="gpoProducto[]" onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Escoje el Grupo de Producto para Artículo: '.$myrow['descripcion'];?></div>')" onmouseout="UnTip()">
          <option value="">Escoje el Grupo</option>
          <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
          <option 
		    <?php 		if($_GET['gpoProducto1']==$myrow7['codigoGP'] or $myrow['gpoProducto']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
          <?php } 
		
		?>
        </select></td>
      <td bgcolor="<?php echo $color;?>" class="abonos" >
	  
	  
	
	  <a
	 
	   href="javascript:ventanaSecundaria7('ventanitaCambiaPrecioParticular.php?codigo=<?php echo $code; ?>&keyAPN=<?php echo $myrow['keyAPN'];?>&almacen=<?php echo $_GET['almacenDestino1']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;gpoProducto=<?php echo $myrow['gpoProducto']; ?>&amp;keyE=<?php echo $myrow['keyE'];?>&keyPA=<?php echo $myrow['keyPA'];?>')">
	  <?php echo "$".number_format($myrow78['nivel1'],2);?>	  </a>
	  
	  
	  &nbsp;</td>
      <td bgcolor="<?php echo $color;?>" class="cargos" >
	  <a 
	  
	  href="javascript:ventanaSecundaria7('ventanitaCambiaPrecioAseguradora.php?codigo=<?php echo $code; ?>&amp;almacen=<?php echo $_GET['almacenDestino1']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;gpoProducto=<?php echo $myrow['gpoProducto']; ?>&keyPA=<?php echo $myrow['keyPA'];?>')">
	  	  <?php echo "$".number_format($myrow78['nivel3'],2);?>	    </a>
	  &nbsp;</td>
      
      
      
      
      
      <td class="style7"><div align="left">
<?php 

$modifica=$myrow39['rutaModifica'];



?>

	
	<?php if($modifica){ ?>
	<a 
	
	href="<?php echo $modifica?>?nRequisicion=<?php echo $requisicion; ?>&amp;almacen=
		<?php echo $myrow13['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacen=<?php echo $ali; ?>&keyPA=<?php echo $myrow['keyPA'];?>"><img src="/sima/imagenes/Save.png" alt="Modificaci&oacute;n de Art&iacute;culos, M&aacute;ximo, M&iacute;nimo, Reorden.." width="12" height="12" border="0" /> </a> 
		<?php } else { echo '?';} ?>
		
	  </div></td>

	  
	  
	  
	  
      <?php /*?><td bgcolor="<?php 
	  if($bali){
	  echo $color;
	  } else {
	  echo $color1;
	  }
	  ?>" class="normal"><?php 
	  if($bali){
	  echo $myrow['usuario'];
	  } else {
	  echo '<blink>'.$myrow['usuario'].'</blink>';
	  }
	   ?></td><?php */?>
      <td bgcolor="<?php echo $color;?>" class="style7"><div align="center"><span class="style71"> 
	  
	  <?php if($myrow['activo']=='A'){ ?>
</span>
<span class="Estilo24">
		
		<a 
		
		href="<?php echo $_SERVER['PHP_SELF'];?>?codigo5=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&inactiva=<?php echo'inactiva'; ?>&tipoAlmacen=<?php echo $_GET['tipoAlmacen']; ?>&codigo=<?php echo $C; ?>&criterio=<?php echo $_GET["criterio"];?>&gpoProducto=<?php echo $_GET['gpoProducto1'];?>&almacenDestino=<?php echo $_GET['almacenDestino'];?>&almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&gpoProducto1=<?php echo $_GET['gpoProducto1'];?>&keyPA=<?php echo $myrow['keyPA'];?>">
        
        <img src="/sima/imagenes/newicon/active_icon.jpg" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
              <?php } else { ?>
              <a
			 
			   href="<?php echo $_SERVER['PHP_SELF'];?>?codigo5=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&activa=<?php echo "activa"; ?>&usuario=<?php echo $E; ?>&tipoAlmacen=<?php echo $_GET['tipoAlmacen']; ?>&codigo=<?php echo $C?>&criterio=<?php echo $_GET["criterio"];?>&gpoProducto=<?php echo $_GET['gpoProducto1'];?>&almacenDestino=<?php echo $_GET['almacenDestino'];?>&almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&gpoProducto1=<?php echo $_GET['gpoProducto1'];?>&keyPA=<?php echo $myrow['keyPA'];?>"> <img src="/sima/imagenes/newicon/delete_icon.jpg" alt="INACTIVO" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
              <?php } ?>
      </span></div></td>
    </tr>
    <?php }}?>
  </table>
  <p align="center">
    <label></label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label><?php if($totalRegistros){ ?>
    <input name="actualizar" type="image" src="/sima/imagenes/btns/refresh.png" id="actualizar" value="Actualizar " />
	<?php } ?>
    </label>
    <input name="gpoProducto1" type="hidden" id="gpoProducto1" value="<?php echo $_GET['gpoProducto1']; ?>" />
  </p>
</form>

<?php if($totalRegistros){ ?>
<p align="center" class="negro"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p></a>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>