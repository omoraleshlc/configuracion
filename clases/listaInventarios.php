<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); require('/configuracion/funciones.php'); ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" class="titulos"><br />
Lista de Inventarios<br />
<?php echo $leyenda; ?>&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="514" border="0" align="center">
    <tr>
      <th width="49" bgcolor="#660066" scope="col"><div align="left" class="blancomid">FolioV</div></th>
      <th width="70" bgcolor="#660066" scope="col"><div align="left" class="blancomid">CP</div></th>
      <th width="70" bgcolor="#660066" scope="col"><div align="left" class="blancomid">Seguro</div></th>
      <th width="307" bgcolor="#660066" scope="col"><div align="left" class="blancomid">Descripci&oacute;n</div></th>
    </tr>
    <tr>
<?php	
$almacen='HALM';


    $sSQL1= "Select * From listasinventarios WHERE entidad='".$entidad."' 
        and
almacen='".$almacen."'    



";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){
$codigo+=1;
$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$sSQL3bd= "Select * From articulos WHERE entidad='".$entidad."' 
    and  codigo= '".$myrow1['codigo']."' and 
almacen='".$almacen."' 
";
$result3bd=mysql_db_query($basedatos,$sSQL3bd);
$myrow3bd = mysql_fetch_array($result3bd);






if(!$myrow3bd['codigo']){
//***************BORRADO1*************
$borra1 = "DELETE FROM existencias

where
codigo='".$myrow1['codigo']."'   ";

//mysql_db_query($basedatos,$borra1);
echo mysql_error();
//*************************************


//***************BORRADO2*************
$borra2 = "DELETE FROM articulosPrecioNivel

where
codigo='".$myrow1['codigo']."'   ";

//mysql_db_query($basedatos,$borra2);
echo mysql_error();
//*************************************

//***************BORRADO3*************
$borra3 = "DELETE FROM convenios

where
codigo='".$myrow1['codigo']."'   ";

//mysql_db_query($basedatos,$borra3);
echo mysql_error();
//*************************************

//***************BORRADO1*************
$borra4 = "DELETE FROM articulosPaquetes

where
codigo='".$myrow1['codigo']."'   ";

//mysql_db_query($basedatos,$borra4);
echo mysql_error();
//*************************************

//***************BORRADO1*************
$borra5 = "DELETE FROM articulosMaquilados

where
codigo='".$myrow1['codigo']."'   ";

//mysql_db_query($basedatos,$borra5);
echo mysql_error();
//*************************************


//***************BORRADO1*************
$borra6 = "DELETE FROM articulos

where
codigo='".$myrow1['codigo']."'   ";

//mysql_db_query($basedatos,$borra6);
echo mysql_error();
//*************************************
}
?>
      <td bgcolor="<?php echo $color?>" class="codigosmid">
      <label><?php echo $myrow1['codigo']; ?>      </label></td>
      <td bgcolor="<?php echo $color?>" class="normalmid">
      <?php 
      
      
      echo $myrow1['descripcion']; 
      if(!$myrow3bd['codigo']){
    echo '<br>';
          echo 'Ell articulo no existe en cendis';
          $cendis[0]+=1;
}
      ?>
      </td>
      <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow1['descripcion1']; ?></td>
      <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo $almacenIngreso; ?></td>
    </tr>
    <?php  } //cierra while ?>
  </table>
  <div align="center" class="informativo"><strong>
   
	<?php if($codigo>0){
	echo " que no existe en cendis".$cendis[0]; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>
</body>
</html>