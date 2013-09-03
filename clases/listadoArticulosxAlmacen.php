<?php 
class consultaArticulosPrecioxAlmacen{
public function consultarArticulosxAlmacen($almacen,$entidad,$basedatos){
?>

<?php $articulo = $_POST['nomArticulo']; ?>

<?php 
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE articulos set 

		activo='I'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
 $q = "UPDATE articulos set 

		activo='A'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}




if(!$_POST['nomArticulo']){
$_POST['nomArticulo']=$_GET['nomArticulo'];
}
if(!$_POST['almacenDestino']){
$_POST['almacenDestino']=$_GET['almacenDestino'];
}
if(!$_POST['almacenDestino1']){
$_POST['almacenDestino1']=$_GET['almacenDestino1'];
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
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=350,height=170,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventanaSecundaria9","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES")
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
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
<h1 align="center" >Art&iacute;culos/Servicios x Almac&eacute;n </h1>
<form id="form2" name="form2" method="post" action="">

    <table width="399" class="table-forma">
      <?php if(verificaCargoTotal::verificaCT($seguro,$basedatos)){ ?>
      <?php } ?>
      <tr >
        <td width="88"   scope="col"><div align="left">Departamento</div></td>
        <td width="301"  scope="col"> <div align="left" >
            <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad, 'combos', $almacenSolicitante,$almacenDestino,$basedatos);
?>
        </div></td>
      </tr>
      <tr >
        <td   scope="col"><div align="left">Mini Almac&eacute;n </div></td>
        <td  scope="col"> <div align="left" >
            <?php 
$comboAlmacen1=new comboAlmacen();
if(!$almacenDestino){
$almacenDestino=$almacenSolicitante;
}
$comboAlmacen1->despliegaMiniAlmacen($entidad,'combos',$_POST['almacenDestino'],$almacenDestino,$basedatos);

?>
        </div></td>
      </tr>
    </table>

  <p>&nbsp;</p>
 
  <table width="532" class="table-forma">
    <tr>
      <td height="22"   scope="col"><div align="left">T&iacute;tulo</div></td>
      <td  scope="col"><label>
        <div align="left">
          <textarea name="titulo" cols="60" wrap="virtual"  id="titulo"><?php echo $_POST['titulo'];?></textarea>
        </div>
      </label></td>
    </tr>
    <tr>
      <td height="22"   scope="col"><div align="left">Incluir Referidos </div></td>
      <td  scope="col"><div align="left">
        <label>
        <input name="referidos" type="checkbox" id="referidos" value="si" <?php if($_POST['referidos']){ echo 'checked=""';}?> />
        </label>
      </div></td>
    </tr>
    <tr>
      <td height="22" align="left"   scope="col">Precio</td>
      <td  scope="col"><div align="left">
        <label>
        <input type="radio" name="radio" id="asegura" value="asegura" />
        </label>
      Aseguradora 
      <label>
      <input type="radio" name="radio" id="part" value="part" />
      Particular</label>
      <label>
      <input type="radio" name="radio" id="ambos" value="ambos" />
      Ambos Precios</label>
      </div></td>
    </tr>
    <tr>
      <td height="22"   scope="col"><div align="left">Porcentaje % </div></td>
      <td  scope="col"><div align="left">
        <label>
        <input name="porcentaje" type="text"  id="porcentaje" size="2" maxlength="2" value="<?php echo $_POST['porcentaje'];?>"  onkeypress="return checkIt(event)"/>
        </label>
      </div></td>
    </tr>
    <tr>
      <td width="88" height="22"  scope="col">&nbsp;</td>
      <td width="322"  scope="col"><span >
          </span>
        <div align="left" >
          <input name="buscar" type="submit" src="/sima/imagenes/btns/searcharticles.png" id="buscar" value="buscar" />
        </div>        </td>
    </tr>
  </table>

</form>
<p align="center" >
  <?php	

if($_POST['referidos']=='si'){
$sSQL= "
SELECT 
articulos.codigo,articulos.keyPA,articulos.descripcion 
FROM articulos,existencias
where 

articulos.entidad='".$entidad."' AND
articulos.codigo=existencias.codigo
and
existencias.almacen='".$_POST['almacenDestino1']."'
    AND
    articulos.activo='A'
order by articulos.descripcion ASC
";

} else {
$sSQL= "
SELECT  
articulos.codigo,articulos.keyPA,articulos.descripcion 
FROM articulos,existencias
where 

articulos.entidad='".$entidad."' AND
articulos.codigo=existencias.codigo
and
(articulos.laboratorioReferido='no' or articulos.laboratorioReferido='' )
and
existencias.almacen='".$_POST['almacenDestino1']."'
    AND
    articulos.activo='A'
order by articulos.descripcion ASC
";
}


if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
  <br />
  Listado de Servicios de: <?php 
  
    $sSQL6a="SELECT descripcion
FROM
  almacenes
WHERE entidad='".$entidad."' AND
almacen='".$_POST['almacenDestino1']."'
  ";
  $result6a=mysql_db_query($basedatos,$sSQL6a);
  $myrow6a = mysql_fetch_array($result6a);
  echo $myrow6a['codigo'];
  
  ?>
</p>
      <form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>

  <table width="500" class="table table-striped">

      <tr >
        <th width="2"  scope="col"><div align="left" >#</div></th>
    <th width="539"  scope="col"><div align="left" >Descripci&oacute;n</div></th>
            <th width="62"  scope="col"><div align="left" >Part</div></th>
        <th width="59"  scope="col"><div align="left" >Aseg</div></th>
      </tr>
      <tr >
        <?php
while($myrow = mysql_fetch_array($result)){
$keyPA=$myrow['keyPA'];
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
codigo = '".$code."'  and
almacen='".$_POST['almacenDestino1']."'
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
$sSQL7="SELECT activo
FROM
articulos
WHERE entidad='".$entidad."' AND
codigo = '".$code."' 
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  $gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

?>
        <td height="24"  ><span >
          <label><?php echo $totalRegistros?></label>
        </span></td>
        <td  ><?php echo $myrow['descripcion']; ?>
          <?php 
	  if(!$bali){
	   echo '<img src="/sima/imagenes/stop.png" alt="NO TIENE ASIGNADO NINGUN PRECIO O ALMACEN" width="13" height="13" border="0" />';
	   }
	  ?>
          <?php if($myrow['generico']=='si'){?>
          <blink> <img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" /></blink>
          <?php } else { echo '';}?></td>
       
        <td align="right"  ><?php 
	  if($myrow6['nivel1']){
	  echo "$".number_format($myrow6['nivel1'],2);
	  } else {
	  echo '...';
	  }
	   ?></td>
        <td align="right"  ><?php 
	  if($myrow6['nivel3']){
	  echo "$".number_format($myrow6['nivel3'],2);
	  } else {
	  echo '...';
	  }
	   ?></td>
        <?php
	  if($UM=='s' or $UM=='S'){
	  $modifica='modificaP.php';
	  } else {
	  $modifica='modificaA.php';
	  }
	  ?>
      </tr>
      <?php }}?>
    </table>




  <p align="center">
    <label></label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
  
  
<?php if(  $totalRegistros>=1){ ?>
    <a href="javascript:ventanaSecundaria9('imprimirPrecios.php?nRequisicion=<?php echo $requisicion; ?>&almacen=
<?php echo $_POST['almacenDestino1']; ?>&medico=<?php echo $_GET['medico']; ?>&codigo=<?php echo $C; ?>&almacenes=<?php echo $Cd; ?>&porcentaje=<?php echo $_POST['porcentaje'];?>&referidos=<?php echo $_POST['referidos'];?>&titulo=<?php echo $_POST['titulo'];?>')"><br><img src="../imagenes/btns/printbutton.png" border="0" width="18" height="18"/></a>
<?php } ?>
</p>


<input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>">
<input name="main" type="hidden" value="<?php echo $_GET['main'];?>">


</form>
<?php if($totalRegistros){ ?>
<p align="center" ><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>
