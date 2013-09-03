<?php 
class consultaMedicosPrecios{
public function consultarPrecios($almacen,$entidad,$basedatos){
?>

<?php $articulo = $_POST['nomArticulo']; ?>

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
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=350,height=189,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=350,height=170,scrollbars=YES") 
} 
</script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script> 
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
<h1 align="center">M&eacute;dicos Precios x Departamento </h1>
<form id="form2" name="form2" method="post" action="">
  <div align="center">
    <table width="600" class="table-forma">
      <?php if(verificaCargoTotal::verificaCT($seguro,$basedatos)){ ?>
      <?php } ?>
      <tr >
        <td  scope="col">&nbsp;</td>
        <td  scope="col"><div align="left" >Todos</div></td>
        <td  scope="col"><div align="left">
          <input name="todos" type="checkbox" id="todos" value="si" <?php if($_POST['todos']=='si'){ echo 'checked=""';}?> />
        </div></td>
        <td  scope="col"><input name="Submit" type="submit"  value="Mostrar" /></td>
      </tr>
      <tr >
        <td width="31"  scope="col"><label></label></td>
        <td width="103"  scope="col"><div align="left">Departamento</div></td>
        <td width="347"  scope="col"><div align="left">
          <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style7',$almacenSolicitante,$almacenDestino,$basedatos);
?>
        </div></td>
        <td width="104"  scope="col">&nbsp;</td>
      </tr>
    </table>

<label></label>
  </div>
  <p>&nbsp;</p>
</form>
<p align="center" class="style14">
  <?php	
  if($_POST['almacenDestino']){
	  $articulo = '*';

if($articulo==='*' and !$_POST['todos']){


$sSQL= "
select articulosPrecioNivel.codigo,articulosPrecioNivel.keyAPN,almacenes.almacenPadre,almacenes.almacen,almacenes.descripcion, articulosPrecioNivel.nivel1,articulosPrecioNivel.nivel3 
from almacenes,articulosPrecioNivel where almacenes.medico='si'
and
almacenes.almacen=articulosPrecioNivel.almacen
and
almacenes.almacenPadre='".$_POST['almacenDestino']."' 
group by almacenes.descripcion ASC
";

} else {

$sSQL= " select * from almacenes
where
almacenPadre='".$_POST['almacenDestino']."' 
and
medico='si'
";



}

if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
</p>
      <form id="form1" name="form1" method="post" action="modificaA.php">
  <p align="center">&nbsp;</p>

  <table width="600" class="table table-striped">
    <tr>
      <th width="69"  scope="col"><div align="left"><span >C&oacute;digo</span></div></th>
      <th width="321"  scope="col"><div align="left"><span >Mini Almac&eacute;n  (M&eacute;dico)</span></div></th>
      <th width="74"  scope="col"><div align="left"><span >Part.</span></div></th>
      <th width="68"  scope="col"><div align="left"><span >Aseg.</span></div></th>
      <th width="41"  scope="col"><div align="left"><span >Editar</span></div></th>
    </tr>
    <tr>

<?php
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;


 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);



$sSQL52="SELECT count(*) as totalRegedit
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
  
$i=$myrow52['totalRegedit'];


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
articulosPrecioNivel
WHERE entidad='".$entidad."' 
AND
almacen='".$myrow['almacen']."'

  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  
$C=$codigo=$code = $myrow6['codigo'];
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$Cd=$myrow['almacen'];
$sSQL7="SELECT *
FROM
articulos
WHERE entidad='".$entidad."' AND
codigo = '".$code."' 
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  


?>
      <td bgcolor="<?php echo $color;?>" height="24" ><span >
        <label><?php echo $Cd?></label>
      </span></td>
      <td bgcolor="<?php echo $color;?>" ><span ><?php echo $myrow['descripcion']; ?> 
        <?php 
	  if(!$bali){
	   echo '<img src="/sima/imagenes/stop.png" alt="NO TIENE ASIGNADO NINGUN PRECIO O ALMACEN" width="13" height="13" border="0" />';
	   }
	  ?>
	  
	  	<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="../imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
	  </span></td>
      <td bgcolor="<?php echo $color;?>" >
	   
	  <?php 
	  if($myrow6['nivel1']){
	  echo "$".number_format($myrow6['nivel1'],2);
	  } else {
	  echo '...';
	  }
	   ?>      </td>
      <td bgcolor="<?php echo $color;?>" ><span >
        <?php 
	  if($myrow6['nivel3']){
	  echo "$".number_format($myrow6['nivel3'],2);
	  } else {
	  echo '...';
	  }
	   ?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" >
	  
	  <a 
	   onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo ''.$myrow['descripcion'];;?></div>')" onMouseOut="UnTip()"
	  href="javascript:ventanaSecundaria2('../ventanas/cambiarMedicos.php?nRequisicion=<?php echo $requisicion; ?>&amp;almacenPadre=
		<?php echo $myrow['almacenPadre']; ?>&amp;keyAPN=<?php echo $myrow['keyAPN']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacen=<?php echo $Cd; ?>&keyPA=<?php echo $myrow['keyPA'];?>')">
		
		<img src="../imagenes/Save.png" alt="Modificar Precios" width="12" height="12" border="0" />
		
		</a></td>
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
  </p>
</form>
<?php if($totalRegistros){ ?>
<p align="center"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p>
<?php } }?>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>