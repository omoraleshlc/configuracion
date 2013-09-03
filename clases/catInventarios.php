<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.id_LF.value) == false ) {   
                alert("Por Favor, escoje el id_LF/departamento!")   
                return false   
        } else if( vacio(F.descripcionLF.value) == false ) {   
                alert("Por Favor, escribe la descripción de este id_LF!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 

<?php
$keyLF=$_POST['keyLF'];
if($_POST['actualizar'] AND $_POST['descripcionLF'] AND $_POST['id_LF'] ){
$sSQL1= "Select * From catLabFabricante WHERE keyLF= '".$keyLF."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['id_LF']){
if($_POST['id_LF']!=$myrow1['id_LF']){

$agrega = "INSERT INTO catLabFabricante (
id_LF,descripcionLF,usuario,fecha,activo,observaciones,entidad
) values ('".$_POST['id_LF']."','".$_POST['descripcionLF']."',
'".$usuario."','".$fecha1."','".$_POST['activo']."','".$_POST['observaciones']."','".$entidad."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ESTE LABORATORIO HA SIDO AGREGADO EXITOSAMENTE! "
</script>';
}} else {
$q = "UPDATE catLabFabricante set 
descripcionLF='".$_POST['descripcionLF']."', 

usuario='".$usuario."',
fecha='".$fecha1."',
activo='".$_POST['activo']."', 
observaciones='".$_POST['observaciones']."'
WHERE 
keyLF='".$keyLF."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ESTE LABORATORIO HA SIDO MODIFICADO! "
</script>';

}
}

if($_POST['borrar'] AND $keyLF){
$borrame = "DELETE FROM catLabFabricante WHERE keyLF ='".$keyLF."'";
mysql_db_query($basedatos,$borrame);


echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ESTE LABORATORIO HA SIDO ELIMINADO! "
</script>';
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['id_LF'] = "";
}


if($_POST['keyLF2']){
$sSQL2= "Select * From catLabFabricante WHERE keyLF = '".$_POST['keyLF2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>
 <p align="center" ><strong>Cat&aacute;logo de Laboratorio Fabricante </strong></p>
 <form id="form1" name="form1" method="post" action="" >
   <p>
     <label></label>
   </p>
   <table width="200" >
     <tr>
       <td><span >
         <input name="nuevo" type="submit" src="/sima/imagenes/bordestablas/btns/newbtn.png" id="nuevo" value="Nuevo" />
       </span></td>
       <td><span >
       <input name="actualizar" type="submit" src="/sima/imagenes/bordestablas/btns/refreshbtn.png" id="actualizar" value="Alta/Modificar Laboratorio" />
       </span></td>
       <td><span >
         <input name="borrar" type="submit" src="/sima/imagenes/bordestablas/btns/deletebtn.png" id="borrar" value="Eliminar Laboratorio" />
       </span></td>
     </tr>

   </table>
   <p>&nbsp;</p>

   <table width="600" class="table-forma">
     <tr>
       <td width="18" >&nbsp;</td>
       <td width="96" >Codigo</td>
       <td width="86" ><input name="id_LF" type="text"  id="id_LF" value="<?php echo $myrow2['id_LF']?>" 
size="10" <?php if($myrow2['id_LF']){ echo 'readonly=""';}?> autocomplete="off"/></td>
     </tr>
     <tr>
       <td >&nbsp;</td>
       <td >Descripcion</td>
       <td ><span >
         <input name="descripcionLF" type="text"  id="descripcionLF" 
	   value ="<?php echo $myrow2['descripcionLF']?>" size="60"/>
       </span></td>
     </tr>
     <tr>
       <td >&nbsp;</td>
       <td >Activo</td>
       <td ><span >
         <input name="activo" type="checkbox" id="activo" value="activo" 
 <?php 
 if($myrow2['activo']){
 echo 'checked=""';
 }
 ?>
		 />
       </span></td>
     </tr>
     <tr>
       <td >&nbsp;</td>
       <td >Observaciones</td>
       <td ><span ><span >
         <textarea name="observaciones" cols="50" rows="4"  id="observaciones"><?php echo $myrow2['observaciones']?></textarea>
       </span></span></td>
     </tr>
     <tr>
       <td >&nbsp;</td>
       <td >&nbsp;</td>
       <td >&nbsp;</td>
     </tr>
   </table>

<p>&nbsp;</p>

   <table width="600" class="table-forma">
     <tr>
       <td width="8"   scope="col">&nbsp;</td>
       <td width="119"   scope="col"><div align="left">C&oacute;digo </div>         
       <label></label></td>
       <td width="419"   scope="col">
     <div align="left"></div></td></tr>
     <tr>
       <td width="8"   scope="col">&nbsp;</td>
       <td  >Descripci&oacute;n</td>
       <td  >&nbsp;</td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td  >Activo</td>
       <td  >&nbsp;</td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td  >Observaciones</td>
       <td  >&nbsp;</td>
     </tr>
     <tr>

       <td width="8"   scope="col">&nbsp;</td>
       <td  >&nbsp;</td>
       <td  ><span >
         <input name="keyLF" type="hidden" id="keyLF" value="<?php echo $myrow2['keyLF']; ?>" />
       </span></td>
     </tr>
   </table>

<p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From catLabFabricante where entidad='".$entidad."' order by keyLF ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?> </p>
 <form id="form2" name="form2" method="post" action="">

   <table width="600" class="table table-striped">
     <tr>
       <th width="120"  scope="col"><span >C&oacute;digo Lab. </span></th>
       <th width="112"  scope="col"><span >C&oacute;digo del Lab </span></th>
       <th width="273"  scope="col"><span >Descripci&oacute;n del Laboratorio </span></th>
       <th width="60"  scope="col"><span >&iquest;Activo?</span></th>
     </tr>
     <tr>
       <?php	while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['keyLF'];
?>
       <td bgcolor="<?php echo $color?>" ><span ><span >
         <input name="keyLF2" type="submit"  id="id_LF2" value="<?php echo $A?>" />
       </span></span></td>
       <td bgcolor="<?php echo $color?>" ><span ><?php echo $myrow['id_LF'];?></span></td>
       <td bgcolor="<?php echo $color?>" ><span ><?php echo $myrow['descripcionLF'];?></span></td>
       <td bgcolor="<?php echo $color?>" ><span >
         <?php if($myrow['activo']){
echo $myrow['activo'];
} else {
echo "N/A";
}?>
       </span></td>
     </tr>
     <?php }?>
   </table>

</form>
 <p align="center">&nbsp;</p>
</body>
</html>