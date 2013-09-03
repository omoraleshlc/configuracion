<?php class AM {
public function articulosMaquilados($ALMACEN,$entidad,$basedatos){ ?>
<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventanaSecundaria8","width=600,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<?php 



if($_POST['surtir'] and $_POST['cantidadSurtida']){
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];
$cantidadVendida=$_POST['cantidadVendida'];




for($i=0;$i<=$_POST['bandera'];$i++){



if($keyPA[$i] and $cantidadSurtida[$i]>0){
$sSQL52a3="
SELECT keyPA,descripcion
FROM

faltantes
where
entidad='".$entidad."'
and
almacenSolicitante='".$almacenSolicitante[$i]."'
and
status='request' 
and
keyPA='".$keyPA[$i]."'  ";
  $result52a3=mysql_db_query($basedatos,$sSQL52a3);
  $myrow52a3 = mysql_fetch_array($result52a3);



if($myrow52a3['keyPA']){ 
//****************ACTUALIIZO CENDIS*****************
$sSQL52a="SELECT almacen
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
centroDistribucion='si' ";
  $result52a=mysql_db_query($basedatos,$sSQL52a);
  $myrow52a = mysql_fetch_array($result52a);


//*****************PUEDO TRANSFERIR A ESTE ALMACEN, TENGO PARA TRANSFERIRLE?******************
$sSQL52="SELECT existencia
FROM
existencias
WHERE 
entidad='".$entidad."'
and
keyPA = '".$keyPA[$i]."' and almacen='".$myrow52a['almacen']."' ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
//**************************************************************************************************
$cantidadEnStock=$myrow52['existencia'];
//**************************************************



if($cantidadEnStock>$cantidadSurtida[$i]){


$q2 = "UPDATE existencias set 
fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia-'".$cantidadSurtida[$i]."'

WHERE 
entidad='".$entidad."' AND
keyPA='".$keyPA[$i]."' 
AND 
almacen = '".$myrow52a['almacen']."'  ";

mysql_db_query($basedatos,$q2);
echo mysql_error();
//***************************************
  
  
  
  
  



$q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia+'".$cantidadSurtida[$i]."'

WHERE 
entidad='".$entidad."' AND
keyPA='".$keyPA[$i]."' 
AND 
almacen = '".$almacenSolicitante[$i]."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();



$q1 = "DELETE FROM faltantes 
WHERE 
entidad='".$entidad."'
and
keyPA='".$keyPA[$i]."'
and
almacenSolicitante='".$almacenSolicitante[$i]."'
and
status='request'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$status='exito';
}else{ 
$info='Intenta cargar una cantidad menor...';
$status='fallo';
$q1 = "UPDATE faltantes 
set
informacion='".$info."'
WHERE 
entidad='".$entidad."'
and
keyPA='".$keyPA[$i]."'
and
almacenSolicitante='".$almacenSolicitante[$i]."'
and
status='request'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}



}



}
}

//*****************************************************************




//*****************************************************************


//cierra validacion
?>


<?php if($status=='fallo'){ ?>
<script>
window.alert("EL ARTICULO <?php echo   $articulo;?> NO TIENE SUFICIENTES EXISTENCIAS PARA TRANSFERIRSE...");
</script>
<?php }else{ ?>
<script>
window.alert("Se surtieron articulos");
</script>
<?php } ?>


<?php 
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>



 <?php require("/configuracion/componentes/comboAlmacen.php"); include("/configuracion/funciones.php"); ?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center">Solicitudes desde Almacen Principal </h1>
  <p align="center">[Articulos Maquilados] </p>
  <table width="700" border="0.2" align="center">
        <tr bgcolor="#FFFF00">
      <th width="53" class="negromid">keyPA</th>
      <th width="435" class="negromid" ><div align="left">Descripcion</div></th>
      <th width="105"  class="negromid">Fecha</th>
      <th width="87"  class="negromid">Hora</th>
      <th width="87"  class="negromid">Usuario</th>
      <th width="132"  class="negromid">Cantidad Solicitada</th>
      <th width="132"  class="negromid">Almacen Solicitante </th>
    </tr>
	
	
	
		<?php	


$sSQL= "SELECT * 
FROM

articulosMaquilados
where
entidad='".$entidad."'
and

almacenPrincipal='".$ALMACEN."'
and
status='request'
and
keyPACOM=0
";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;






$sSQL1= "SELECT descripcion
FROM

articulos
where
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "SELECT descripcionGP
FROM

gpoProductos
where
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'  ";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);




$sSQL2= "SELECT sum(cantidad) as s
FROM

faltantes
where
entidad='".$entidad."'
and
almacenSolicitante='".$_POST['almacenDestino']."'
and
status='request' 
and
codigo='".$myrow['codigo']."'  ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


$sSQL52a="SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['id_almacen']."' ";
  $result52a=mysql_db_query($basedatos,$sSQL52a);
  $myrow52a = mysql_fetch_array($result52a);
  
   $sSQL52aa="SELECT existencia
FROM
existencias
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow52a['almacen']."' 
and
keyPA='".$myrow['keyPA']."'
";
  $result52aa=mysql_db_query($basedatos,$sSQL52aa);
  $myrow52aa = mysql_fetch_array($result52aa);
?>
	
	
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
	        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['keyPA'];?></td>
<td height="24" bgcolor="<?php echo $color?>" class="normal">
<a href="javascript:ventanaSecundaria8('/sima/cargos/cargarArticulosMaquilados.php?keyPA=<?php echo $myrow['keyPA']; ?>&descripcionArticulo=<?php echo $myrow['descripcionArticulo'];?>&keyR=<?php echo $myrow['keyR'];?>&almacenSolicitante=<?php echo $myrow['almacenPrincipal'];?>')">
<?php 
echo $myrow['descripcionArticulo'];
?>
</a></td>
	  <td bgcolor="<?php echo $color?>" class="normal">
	    <?php 
echo cambia_a_normal($myrow['fecha']);
?>
</td>
	  <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['hora'];?></td>
	  <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['usuario'];?></td>
	  <td bgcolor="<?php echo $color?>" class="normal"><?php 
	  
echo   $myrow['cantidad'];

	  ?></td>
	  <td bgcolor="<?php echo $color?>" class="normal">
	    <?php 
	  
echo   $myrow52a['descripcion'];

	  ?><a   href="javascript:ventanaSecundaria8('resurtirInventarios.php?nOrden=<?php echo $myrow['nOrden']; ?>')"></a>
	    <label></label></td>
	  <input name="almacenSolicitante[]" type="hidden" value="<?php echo $myrow['almacenSolicitante'];?>" />
	   <input name="cantidadVendida[]" type="hidden" value="<?php echo $myrow['c'];?>" />
	  	  <input name="keyPA[]" type="hidden" value="<?php echo $myrow['keyPA'];?>" />
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <label>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
</body>
</html>
<?php 
}
}
?>