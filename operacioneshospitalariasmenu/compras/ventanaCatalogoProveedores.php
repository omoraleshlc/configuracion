<?php include('/configuracion/ventanasEmergentes.php');?>
<?php 

if(!$_POST['id_proveedor2']){

$_POST['id_proveedor2']=$_GET['id_proveedor2'];
}

if($_POST['actualizar'] AND $_POST['id_proveedor'] ){

$sSQL1= "Select * From proveedores WHERE id_proveedor = '".$_POST['id_proveedor']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['id_proveedor']){

$agrega = "INSERT INTO proveedores (
id_proveedor,razonSocial,tipoPersona,rfc,curp,calle,status,usuario,fecha,telefono,id_fiscal,codigoPostal,ctaContable,ciudad,
estado,copiaCedula,copiaActa,copiaHacienda,comprobanteDomicilio,retenciones,tipoProveedor,procedenciaProveedor,entidad
) values ('".$_POST['id_proveedor']."','".$_POST['razonSocial']."',
'".$_POST['tipoPersona']."','".$_POST['rfc']."',
'".$_POST['curp']."',
'".$_POST['calle']."','".$_POST['status']."','".$usuario."','".$fecha1."','".$_POST['telefono']."',
'".$_POST['id_fiscal']."','".$_POST['codigoPostal']."','".$_POST['ctaContable']."','".$_POST['ciudad']."',
'".$_POST['estado']."','".$_POST['copiaCedula']."','".$_POST['copiaActa']."',
'".$_POST['copiaHacienda']."','".$_POST['comprobanteDomicilio']."','".$_POST['retenciones']."',
'".$_POST['tipoProveedor']."','".$_POST['procedenciaProveedor']."','".$entidad."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Proveedor Agregado...';

} else {
$q = "UPDATE proveedores set 
razonSocial='".$_POST['razonSocial']."',
tipoPersona='".$_POST['tipoPersona']."',
usuario='".$usuario."',
fecha='".$fecha1."',
rfc='".$_POST['rfc']."',
curp='".$_POST['curp']."',
calle='".$_POST['calle']."',
status='".$_POST['status']."',

cp='".$_POST['codigoPostal']."',
ctaContable='".$_POST['ctaContable']."',
ciudad='".$_POST['ciudad']."',
estado='".$_POST['estado']."',
copiaCedula='".$_POST['copiaCedula']."',
copiaActa='".$_POST['copiaActa']."',
copiaHacienda='".$_POST['copiaHacienda']."',
comprobanteDomicilio='".$_POST['comprobanteDomicilio']."',
retenciones='".$_POST['retenciones']."',
tipoProveedor='".$_POST['tipoProveedor']."',
procedenciaProveedor='".$_POST['procedenciaProveedor']."'
WHERE
entidad='".$entidad."'
    and
id_proveedor='".$_POST['id_proveedor']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Proveedor Modificado...';


}
?>
<script>
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php
}





if($_POST['borrar'] AND $_POST['id_proveedor']){
$borrame = "DELETE FROM proveedores WHERE entidad='".$entidad."' and id_proveedor ='".$_POST['id_proveedor']."'";
mysql_db_query($basedatos,$borrame);


echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Proveedor Eliminado...';

}

if($_POST['agregar']){
/** checo si existe**/
$_POST['id_proveedor'] = "";
}


if($_POST['id_proveedor2']){
$sSQL2= "Select * From proveedores WHERE entidad='".$entidad."' and id_proveedor = '".$_POST['id_proveedor2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>
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
 <h1 align="center">Cat&aacute;logo de Proveedores </h1>
 <h2 align="center">

         <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
     

 </h2>
<form id="form1" name="form1" method="post" action="" >
   <p>
     <label></label>
   </p>
   <img src="/sima/imagenes/bordestablas/borde1.png" width="744" height="24" />
   <table width="744" border="0" align="center" cellpadding="4" cellspacing="0" style="border: 0px solid #000000;">
     <tr>
       <th width="12" bgcolor="#CCCCCC" class="normal" >&nbsp;</th>
       <th width="130" bgcolor="#CCCCCC"  class="normal" ><div align="left">ID_PROVEEDOR</div>
       <label></label></th>
       <th width="580" bgcolor="#CCCCCC"  class="normal" >
         <div align="left" class="normal">
           <input name="id_proveedor" type="text" class="normal" id="id_proveedor" value="<?php echo $myrow2['id_proveedor']?>"
size="60" <?php if($myrow2['id_proveedor']){ echo 'readonly=""';}?>/>
       </div></th>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Raz&oacute;n Social </td>
       <td bgcolor="#CCCCCC" class="normal"><textarea name="razonSocial" cols="80" class="normal" id="razonSocial"><?php echo $myrow2['razonSocial']?></textarea></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC"  class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">F&iacute;sica/Moral </td>
       <td bgcolor="#CCCCCC"  class="normal"><select name="tipoPersona" class="normal" id="tipoPersona">
         <?php 
		 if($myrow2['tipoPersona']){ ?>
         <option value="<?php echo $myrow2['tipoPersona'];?>"><?php echo $myrow2['tipoPersona'];?></option>
         <option value="">----</option>
         <?php }
		 ?>
		        <option value="F">F</option>
         <option value="M">M</option>
  
       </select></td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Tipo de Proveedor</td>
       <td bgcolor="#CCCCCC" class="normal"><span class="normal">
         <select name="tipoProveedor" class="normal" id="tipoProveedor">
           <?php 
		 if($myrow2['tipoProveedor']){ ?>
           <option value="<?php echo $myrow2['tipoProveedor'];?>"><?php echo $myrow2['tipoProveedor'];?></option>
           <option value="">----</option>
           <?php }
		 ?>
           
           <option value="productos">productos</option>
		              <option value="servicios">servicios</option>
					  <option value="ambos">ambos</option>
         </select>
       </span></td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC"  class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">Procedencia</td>
       <td bgcolor="#CCCCCC"  class="normal"><span class="normal">
         <select name="procedenciaProveedor" class="normal" id="procedenciaProveedor">
           <?php 
		 if($myrow2['procedenciaProveedor']){ ?>
           <option value="<?php echo $myrow2['procedenciaProveedor'];?>"><?php echo $myrow2['procedenciaProveedor'];?></option>
           <option value="">----</option>
           <?php }
		 ?>
           <option value="nacional">nacional</option>
           <option value="extranjero">extranjero</option>
         </select>
       </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Activo</td>
       <td bgcolor="#CCCCCC" class="normal"><select name="status" class="normal" id="status">
         <?php 
		 if($myrow2['status']){ ?>
         <option value="<?php echo $myrow2['status'];?>"><?php echo $myrow2['status'];?></option>
         <option value="">----</option>
         <?php }
		 ?>
         <option value="A">A</option>
         <option value="I">I</option>
       </select></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC"  class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">RFC</td>
       <td bgcolor="#CCCCCC"  class="normal"><span class="normal">
         <input name="rfc" type="text" class="normal" id="rfc"
	   value ="<?php echo $myrow2['rfc']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">CURP</td>
       <td bgcolor="#CCCCCC" class="normal"><span class="normal">
         <input name="curp" type="text" class="normal" id="curp"
	   value ="<?php echo $myrow2['curp']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">&nbsp;</td>
       <td bgcolor="#CCCCCC"  class="normal">&nbsp;</td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">RFC Copia de C&eacute;dula </td>
       <td bgcolor="#CCCCCC" class="normal">
	   <input name="copiaCedula" type="checkbox" id="copiaCedula" 
	   <?php if($myrow2['copiaCedula']){echo 'checked="checked"';}?>/> 
	   Archivo Expediente </td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">Copia de Acta Constitutiva </td>
       <td bgcolor="#CCCCCC"  class="normal"><input name="copiaActa" type="checkbox" id="copiaActa" <?php if($myrow2['copiaActa']){echo 'checked="checked"';}?>/> <span class="Estilo24">Archivo Expediente</span></td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC" class="normal" scope="col">&nbsp; </th>
       <td bgcolor="#CCCCCC" class="normal">Copia de alta de Hacienda </td>
       <td bgcolor="#CCCCCC" class="normal"><input name="copiaHacienda" type="checkbox" id="copiaHacienda"
	   <?php if($myrow2['copiaHacienda']){echo 'checked="checked"';}?>
	    /> <span class="normal">Archivo Expediente</span></td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC"  class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">Comprobante de Domicilio </td>
       <td bgcolor="#CCCCCC"  class="normal"><label>
         <input name="comprobanteDomicilio" type="checkbox" id="comprobanteDomicilio" 
		 <?php if($myrow2['comprobanteDomicilio']){echo 'checked="checked"';}?>
		  />
       <span class="normal">Archivo Expediente</span></label></td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Retenciones</td>
       <td bgcolor="#CCCCCC" class="normal"><input name="retenciones" type="checkbox" id="retenciones"
	   <?php if($myrow2['retenciones']){echo 'checked="checked"';}?>
	    />
       <span class="normal">Aplica </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC"  class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Ciudad</td>
       <td bgcolor="#CCCCCC" class="normal"><span class="normal">
         <input name="ciudad" type="text" class="normal" id="ciudad"
	   value ="<?php echo $myrow2['ciudad']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Calle</td>
       <td bgcolor="#CCCCCC" class="normal"><span class="normal">
         <textarea name="calle" cols="80" class="normal" id="calle"><?php echo $myrow2['calle']?></textarea>
       </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC"  class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">Estado</td>
       <td bgcolor="#CCCCCC"  class="normal"><span class="normal">
         <input name="estado" type="text" class="normal" id="estado"
	   value ="<?php echo $myrow2['estado']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">CodigoPostal</td>
       <td bgcolor="#CCCCCC" class="normal"><span class="normal">
         <input name="codigoPostal" type="text" class="normal" id="codigoPostal"
	   value ="<?php echo $myrow2['codigoPostal']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC"  class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC"  class="normal">Tel&eacute;fono</td>
       <td bgcolor="#CCCCCC" class="normal"><span class="normal">
         <input name="telefono" type="text" class="normal" id="telefono"
	   value ="<?php echo $myrow2['telefono']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <th width="12" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">&nbsp;</td>
       <td bgcolor="#CCCCCC" class="normal"><span class="normal">
	   
	   <input name="id_proveedor2" type="hidden" value="<?php echo $_GET['id_proveedor2'];?>">
       <input name="actualizar" type="submit" class="normal" id="actualizar" value="Alta/Modificar Proveedor" />
         </span>
<input name="borrar" type="submit" class="normal" id="borrar" value="Eliminar Proveedor"/>
<label>
<input name="Nuevo" type="submit" class="normal" id="Nuevo" value="Nuevo" />
</label></td>
     </tr>
   </table>
   <img src="/sima/imagenes/bordestablas/borde2.png" width="744" height="24" />
<p>&nbsp;</p>
 </form>
</body>
</html>
