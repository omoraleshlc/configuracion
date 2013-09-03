<?php class comprasDirectas{ 
public function compraDirecta($fecha1,$hora1,$departamento,$basedatos,$usuario,$entidad){ ?>
<?php  
if($_GET['keyR'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE OC set 

	status='cancelado'
		WHERE keyR='".$_GET['keyR']."'";
		//mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>


<?php 
if($_POST['actualizar'] ){

if($_POST['departamento'] and  is_numeric($_POST['cantidad']) and $_POST['descripcion'] ){






$agregaSaldo = "INSERT INTO OC ( codigo,id_almacen,usuario,fecha,hora,ID_EJERCICIO,cantidad,status,id_requisicion,prioridad,statusCompras,id_proveedor,entidad,proveedor1,descripcion,precioUnitario
) values ('1','".$_POST['departamento']."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$_POST['cantidad']."','request','".$myrow333['req']."',
'".$_POST['prioridad']."','comprar','".$_POST['proveedor']."','".$entidad."','".$_POST['proveedor1']."','".$_POST['descripcion']."','".$_POST['precioUnitario']."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
print '<p class="style1">'.'Se solicitó el artículo: '.$_POST['descripcion'].'</p>';





}else{
print('Te faltan campos por llenar');
}
}
?>



<script language=javascript> 
function ventanaSecundariaF (URL){ 
   window.open(URL,"ventanaSecundariaF","width=700,height=600,scrollbars=YES") 
} 
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.style1 {color: #0000FF}
-->
</style>
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form id="form2" name="form2" method="post" action="#">
  <p align="center" class="titulos">&nbsp;</p>
  <div align="center"><?php //echo $departamento;?>
  </div>
 
  <img src="/sima/imagenes/bordestablas/borde1.png" width="435" height="24" />
  <table width="310" border="0" align="center" cellpadding="4" cellspacing="0">

    <tr bgcolor="#FFFF00">
      <th colspan="3" class="style12" scope="col"><span class="titulos">CONTROL DE COMPRA</span></th>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th width="1" height="42" class="style12" scope="col"><div align="center"></div></th>
      <td width="30" class="negromid"><div align="center">Cant</div></td>
      <td width="265" class="negromid"><div align="center">Descripci&oacute;n General</div></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style19"><span class="Estilo24">
        <input name="cantidad" type="text" class="camposmid" id="cantidad" value ="<?php echo $myrow2['descripcion']; ?>" size="4" onKeyPress="return checkIt(event)"/>
      </span></td>
      <td rowspan="2" class="style19"><span class="style12">
        <textarea name="descripcion" cols="60" class="camposmid" id="descripcion"><?php echo $myrow2['descripcionGeneral']; ?></textarea>
      </span></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style19">&nbsp;</td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th width="1" class="style12" scope="col"></th>
      <td class="style12"><div align="center" class="style18"></div></td>
      <td class="style12"><div align="center">
        <input name="actualizar" type="image" src="../../imagenes/btns/addorden.png" id="actualizar" value="Agregar OC" />
        <input type="hidden" name="departamento" value="<?php echo $departamento;?>" />
      </div></td>
    </tr>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="435" height="24" />
</form>




























<p>&nbsp;</p>
<p align="center">
<a href="javascript:ventanaSecundariaF('enviarSolicitud.php?almacen=<?php echo $departamento;?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $almacen; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_GET['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos'];?>&almacenSolicitud=<?php echo $_GET['almacenDestino1'];?>')">Enviar Solicitud </a></p>
</body>
</html>
<?php
}
}
?>