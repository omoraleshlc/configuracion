<?php $articulo = $_POST['nomArticulo']; ?>


<?php 
class listaServicios{

public function listadoServicios($titulo,$ventana,$entidad,$almacenSolicitante,$codigo,$basedatos){


if(!$_POST['almacenDestino'])$_POST['almacenDestino']=$ALMACEN;
?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","widtd=350,height=270,scrollbars=YES") 
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
<h1 ><?php echo $titulo;?></h1>
<form id="form2" name="form2" metdod="post" action="">

  <table widtd="482" class="table-forma">
    <tr>
      <td   scope="col">&nbsp;</td>
      <td    scope="col"><div align="left">Almac&eacute;n</div></td>
      <td   scope="col">
        <div align="left">
          <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style12',$almacenSolicitante,$almacenDestino,$basedatos);
?>
      </div></td>
    </tr>
    <tr>
      <td   scope="col">&nbsp;</td>
      <td height="36"   scope="col"><div align="left">Mini-Almac&eacute;n</div></td>
      <td   scope="col">
        <div align="left">
          <?php 
$comboAlmacen1=new comboAlmacen();
if(!$_POST['almacenDestino']){

$_POST['almacenDestino']=$almacenSolicitante;
}
$comboAlmacen1->despliegaMiniAlmacen($entidad,'style12',$_POST['almacenDestino'],$almacenDestino,$basedatos);

?>
      </div></td>
    </tr>
    <tr >
      <td widtd="10"  scope="col">&nbsp;</td>
      <td widtd="84" height="35"  scope="col"><div align="left"><span >Art&iacute;culo </span></div></td>
      <td widtd="388"  scope="col"><div align="left"><span >
          <input name="nomArticulo" type="text"  id="nomArticulo" size="60" 
		  
		  value="<?php if($_POST['nomArticulo']){ echo $_POST['nomArticulo']; }?>"/>
</span></div>
      </td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td   scope="col">&nbsp;</td>
      <td  scope="col"><div align="left">
        <input name="buscar" type="submit"  id="buscar" value="buscar" />
        <?php if($_POST['nomArticulo']==='*'){ ?>
        <span >Este proceso puede demorar varios minutos...</span>
        <?php } ?>
      </div>
        <label>
      </label></td>
    </tr>
  </table>

</form>
<p align="center" >&nbsp;</p>
<p align="center" >
  <?php	

if($_POST['buscar'] AND $_POST['nomArticulo'] AND $_POST['almacenDestino']){	

	  $articulo = $_POST['nomArticulo'];
if($articulo AND $_POST['almacenDestino']){

if($articulo!='*'){
$sSQL= "
SELECT * FROM articulos,existencias

 WHERE 
 articulos.entidad='".$entidad."' AND
 articulos.um='s'
 and
 existencias.almacen='".$_POST['almacenDestino1']."'
 and
 articulos.codigo=existencias.codigo and
 articulos.descripcion like '%$articulo%'
 order by articulos.descripcion ASC";
 } else {
$sSQL= "
SELECT * FROM articulos,existencias

 WHERE 
 articulos.entidad='".$entidad."' AND
 articulos.um='s'
 and
 existencias.almacen='".$_POST['almacenDestino1']."'
 and
 articulos.codigo=existencias.codigo 
 order by articulos.descripcion ASC";
 }//cierra todos
} else {
$sSQL= "
SELECT * FROM articulos
WHERE articulos.entidad='".$entidad."' AND
 articulos.um='s'
and
articulos.descripcion like '%$articulo%'

 order by articulos.descripcion ASC";
 }





if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
</p>
      <form id="form1" name="form1" metdod="get" action="<?php echo $modifica='modificaP.php';?>">
  <p>&nbsp;</p>

  <table widtd="584" class="table table-striped">
    <tr>
      <th widtd="84"   scope="col"><div align="left"><span >C&oacute;digo</span></div></th>
      <th widtd="359"   scope="col"><div align="left"><span >Descripci&oacute;n</span></div></th>
      <th widtd="57"   scope="col"><div align="left"><span >Cuarto</span></div></th>
      <th widtd="66"   scope="col"><div align="left">Editar</div></th>
    </tr>
    <tr>

<?php
while($myrow = mysql_fetch_array($result)){
$id_cuarto=$myrow['id_cuarto'];
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
  if($myrow6['nivel1'] and $myrow6['nivel3']){
  $color='#0000FF';
  $estilo="style11";
  } else {
  $myrow6['nivel1']="Falta Precio";
  $myrow6['nivel3']="Falta Precio";
  $estilo="style12";
  }
  
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
  

  
  
  
?>
      <td  >
        <label>
        <?php echo $C?>        </label>      </td>
      <td   ><span ><?php echo $myrow15['descripcion']; ?></span></td>
    
	  <td  ><span >

	  
	  <?php 
	 if($myrow['id_cuarto']){
	  echo $myrow['id_cuarto'];
	} else {
	  echo '---';
	}
	  ?>

	  
	  </span></td>
	 
      <td  > <div align="left"><a href="#" onClick="javascript:ventanaSecundaria('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_POST['almacenDestino1']; ?>&amp;codigo=<?php echo $codigo; ?>&amp;almacenPrincipal=<?php echo $ALMACEN; ?>&amp;codigo=<?php echo $code; ?>')"> <img src="/sima/imagenes/edit.jpg" alt="Editar el artículo: <?php echo $myrow15['descripcion']; ?>" widtd="12" height="12" border="0" /> </a> </div></td>
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