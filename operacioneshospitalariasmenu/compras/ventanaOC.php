<?php require('/configuracion/ventanasEmergentes.php'); include('/configuracion/funciones.php');?>


<?php  
if($_GET['keyR'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE OC set 

	status='cancelado'
		WHERE keyR='".$_GET['keyR']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>


<?php 
if($_POST['actualizar'] ){

if($_POST['departamento'] and ($_POST['proveedor'] or $_POST['proveedor1']) and is_numeric($_POST['cantidad']) and $_POST['descripcion'] and $_POST['precioUnitario'] ){

$sSQL333= "SELECT 
MAX(id_requisicion)+1 as req
FROM OC
WHERE entidad='".$entidad."'";
$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333); 




$agregaSaldo = "INSERT INTO OC ( codigo,id_almacen,usuario,fecha,hora,ID_EJERCICIO,cantidad,status,id_requisicion,prioridad,statusCompras,id_proveedor,entidad,proveedor1,descripcion,precioUnitario
) values ('1','".$_POST['departamento']."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$_POST['cantidad']."','request','".$myrow333['req']."',
'".$_POST['prioridad']."','comprar','".$_POST['proveedor']."','".$entidad."','".$_POST['proveedor1']."','".$_POST['descripcion']."','".$_POST['precioUnitario']."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
print 'SE GENERO # de requisición'.$myrow333['req'];





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

<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form id="form2" name="form2" method="post" action="#">
  <p align="center" class="titulos">Solicitud de  Compra (Materiales Varios) </p>
  <table width="544" border="0" align="center">
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style13" scope="col"><div align="left" class="blancomid">Departamento</div></th>
      <th colspan="3" class="style13" scope="col"> <div align="left">
          <?php 
	  $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="departamento" class="camposmid" id="departamento" />                    

          <option value="" >---</option>
          <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
          <option 

		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
          <?php } ?>
          </select>
      </div></th>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style13" scope="col"><div align="left" class="blancomid">Proveedor</div></th>
      <th colspan="3" class="style13" scope="col"><div align="left">
        <?php 
$aComboa= "Select * From proveedores where
entidad='".$entidad."' order by razonSocial ASC";
$rComboa=mysql_db_query($basedatos,$aComboa); ?>
        <select name="proveedor" class="camposmid" id="proveedor" />                
<option value="" >---</option>
        <?php while($resComboa = mysql_fetch_array($rComboa)){ 
		
		
		?>
        <option 
		value="<?php echo $resComboa['id_proveedor']; ?>"><?php echo $resComboa['razonSocial']; ?></option>
        <?php } ?>
      </div>
      <option value="" ></option></th>
    </tr>
    <tr>
      <th width="1" class="Estilo24" scope="col">&nbsp;</th>
      <th width="84" bgcolor="#660066" class="style13" scope="col"><div align="left" class="blanco">(Si no aparece en la lista el proveedor) </div></th>
      <th colspan="3" class="style13" scope="col"><label></label>
          <div align="left">
            <label>
            <textarea name="proveedor1" cols="60" class="camposmid" id="proveedor1"></textarea>
            </label>
        </div>
        <div align="left" class="style18"></div></th>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <table width="629" border="0" align="center">

    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td width="30" bgcolor="#FFCCFF" class="style19">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style19">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <th width="1" class="style12" scope="col"><div align="center"></div></th>
      <td class="negromid"><div align="center">Cant</div></td>
      <td width="265" class="negromid"><div align="center">Descripci&oacute;n General</div></td>
      <td width="40" class="negromid"><div align="center">P.Unit</div></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style19"><span class="Estilo24">
        <input name="cantidad" type="text" class="camposmid" id="cantidad" value ="<?php echo $myrow2['descripcion']; ?>" size="4" onKeyPress="return checkIt(event)"/>
      </span></td>
      <td rowspan="2" class="style19"><span class="style12">
        <textarea name="descripcion" cols="80" class="camposmid" id="descripcion"><?php echo $myrow2['descripcionGeneral']; ?></textarea>
      </span></td>
      <td class="style12">
        <input name="precioUnitario" type="text" class="camposmid" id="codigo2" 
		 value="1" size="10" maxlength="6"/>
      </span></span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style19">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <th width="1" class="style12" scope="col"></th>
      <td class="style12"><div align="center" class="style18"></div></td>
      <td class="style12"><div align="center">
        <input name="actualizar" type="image" src="../../imagenes/btns/addorden.png" id="actualizar" value="Agregar OC" />
		 
	
      </div></td>
      <td class="style12">&nbsp;</td>
    </tr>
  </table>
</form>




























<p>&nbsp;</p>
<p align="center">
<a href="javascript:ventanaSecundariaF('enviarSolicitud.php?almacen=<?php echo $_GET['almacenDestino1'];?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $almacen; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_GET['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos'];?>&almacenSolicitud=<?php echo $_GET['almacenDestino1'];?>')"><img src="../../imagenes/btns/sendsolicitud2.png" border="0"> </a></p>
</body>
</html>
