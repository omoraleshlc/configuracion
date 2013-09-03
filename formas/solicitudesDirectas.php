<?php include("/configuracion/funciones.php"); ?>
          <?php
$ali=$ALMACEN;
?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 

<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-1.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="lang/calendar-es.js"></script> 
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="calendar-setup.js"></script> 

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<?php




if($_POST['solicitar'] AND $_POST['request'] and $_POST['cantidad']){


$codigo=$_POST['request'];
$cantidad=$_POST['cantidad'];
$code1=$_POST['codigoAlfa'];
$banderaCantidad=$_POST['banderaCantidad'];

$sSQL1= "Select max(nRequisicion)+1 as Requisicion From listaRequisiciones where entidad='".$entidad."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$requisicion=$myrow1['Requisicion'];
if(!$requisicion){
$requisicion=1;
}


for($i=0;$i<$_POST['pasoBandera'];$i++){



$sSQL6= "Select * From existencias WHERE entidad='".$entidad."' AND codigo= '".$code1[$i]."' and almacen='".$ali."' ";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
$sSQL61= "Select * From articulos WHERE entidad='".$entidad."' AND codigo= '".$code1[$i]."'";
$result61=mysql_db_query($basedatos,$sSQL61);
$myrow61 = mysql_fetch_array($result61);
if($myrow6['maximo']>=$cantidad[$i]){

$s=$banderaCantidad[$i]+1;
if( $ali and $cantidad[$i] ){//validacion de almacen

if($code1[$i]){//validacion de cantidad

$sSQL17= "Select * From requisiciones WHERE entidad='".$entidad."' AND
codigo= '".$code1[$i]."' 
and 
id_almacen='".$ali."' 
and
status ='solicita'

order by keyR desc
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


if(!$myrow17['codigo']){ //insertar requisiciones

 $agregaSaldo = "INSERT INTO requisiciones ( codigo,id_almacen,usuario,fecha,hora,ID_EJERCICIO,cantidad,status,id_requisicion,prioridad,cantidadOriginal,entidad
) values ('".$code1[$i]."','".$ali."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$cantidad[$i]."','solicita','".$requisicion."','".$_POST['prioridad']."','".$cantidad[$i]."','".$entidad."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
$estado="insertado";
}//cierra insertar requisiciones
}//cierra validacion de cantidad
}//cierra validacion del almacen


}else {//excede el maximo
$estado="";

?>
<script type="text/vbscript">
window.alert( "LA CANTIDAD QUE ESTAS SOLICITANDO PARA <?php echo $myrow61['descripcion']?> EXCEDE EL MAXIMO PERMITIDO DE EXISTENCIAS DEL ALMACEN!!");
</script>

<?php 
}//for
} 



if($estado){
?>
<script type="text/vbscript">
msgbox "SE GENERO EL NUMERO DE REQUISICION: <?php echo $requisicion;?>"
</script>
<?php 
$agregaReq = "INSERT INTO listaRequisiciones ( nRequisicion,id_almacen,usuario,fecha,hora,ID_EJERCICIO,prioridad,status,entidad
) values ('".$requisicion."','".$ali."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$prioridad."','solicita','".$entidad."')";
mysql_db_query($basedatos,$agregaReq);
echo mysql_error();
}




}






if($_GET['id_requisicion'] AND $_GET['elimina']=='yes'){

$sSQL17= "Select * From requisiciones WHERE entidad='".$entidad."' AND
codigo= '".$_POST['codigo']."' 
and 
id_almacen='".$ali."' 
and
status ='solicita'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
if(!$myrow17['codigo']){
$remover = "update listaRequisiciones
set
status='cancelado'
where entidad='".$entidad."' AND nRequisicion='".$_GET['id_requisicion']."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();
}
$remover = "update requisiciones 
set
status='cancelado'
where keyR='".$_GET['keyR']."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();


//}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<h1 align="center">TRASPASOS DIRECTOS </h1>
<form id="form2" name="form2" method="post" action="">
  <table width="684" border="0" align="center">
    <tr>
      <th width="22" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="156" scope="col"><div align="center"><span class="Estilo24">Escribe el nombre del art&iacute;culo </span></div></th>
      <th width="484" scope="col"><div align="left"><span class="Estilo24">
          <input name="nomArticulo" type="text" class="Estilo24" id="nomArticulo" size="80" 
		  
		  value="<?php if($_POST['nomArticulo']){ echo $_POST['nomArticulo']; }?>"/>
        </span></div>
          <span class="Estilo24">
          </select>
        </span></th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col"><label>
          <div align="left">
            <input name="buscar" type="submit" class="Estilo24" id="buscar" value="buscar" />
            <?php if($_POST['nomArticulo']==='*'){ ?>
            <span class="style18">Este proceso puede demorar varios minutos...</span>
            <?php } ?>
          </div>
        </label></th>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="740" border="0" align="center">
    <tr>
      <th width="35" bgcolor="#660066" scope="col"><span class="style11">#Req.</span></th>
      <th width="31" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="335" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripci&oacute;n</span></div></th>
      <th width="21" bgcolor="#660066" scope="col"><span class="style11">UM</span></th>
      <th width="37" bgcolor="#660066" scope="col"><span class="style11">Anaquel</span></th>
      <th width="41" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
      <th width="32" bgcolor="#660066" scope="col"><span class="style11">Solicita</span></th>
      <th width="38" bgcolor="#660066" scope="col"><span class="style11">Cancelar</span></th>
      <th width="27" bgcolor="#660066" scope="col"><span class="style11">Status</span></th>
      <th width="44" bgcolor="#660066" scope="col"><span class="style11">Hora</span></th>
      <th width="53" bgcolor="#660066" scope="col"><span class="style11">Fecha C. </span></th>
    </tr>
    <tr>
<?php	
$nomArticulo=$_POST['nomArticulo'];
if($ali and $nomArticulo){
 $sSQL18= "
SELECT 
*
FROM
articulos
WHERE 
 entidad='".$entidad."' AND
activo='A'
and
descripcion like '%$nomArticulo%' 
and
(gpoProducto!='s' or um!='s')
order by codigo ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$b+='1';
$a+='1';
if($col){
$color = '#FFFFFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$codigo=$code1=$myrow18['codigo'];


if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From requisiciones WHERE codigo= '".$code1."' and id_almacen='".$ali."'
and status='solicita'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

if($myrow17['cantidadOriginal']!=$myrow17['cantidad']){
$pendiente=1;
}

$sSQL2= "Select sum(cantidad) as totalExistencias
from cargosCuentaPaciente
 WHERE entidad='".$entidad."' AND codProcedimiento= '".$code1."' and fecha1 ='".$_POST['fechaInicial']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
echo mysql_error();

$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


//*********************************************************************************************************
$sSQL8= "
SELECT 
*
FROM
existencias
WHERE entidad='".$entidad."' AND
existencias.almacen='".$ali."' 
and 
codigo='".$code1."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);


?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
        <span class="Estilo24">
        <?php if($myrow17['id_requisicion']){
echo $myrow17['id_requisicion'];
} else {
echo "---";
} ?>
      </span></label></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7"><?php echo $code1?></span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="<?php echo $estilo;?>"><span class="style7">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($myrow['keyCAP'],$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
      </span></span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
        <?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
        <?php if($myrow8['anaquel']){
echo $myrow8['anaquel'];
} else {
echo "0";
} ?>
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><label><span class="Estilo24">
        <input name="cantidad[]" type="text" class="style7" id="cantidad[]" value="<?php 
		echo $myrow17['cantidadOriginal'];?>" size="3" maxlength="3" <?php if(	  $myrow17['codigo']){ 
	  echo 'readonly="readonly"'; 
	  } ?> onKeyPress="return checkIt(event)"/>
        <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
      </span></label></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
        <input name="request[]" type="checkbox" id="request[]" value="<?php echo $code1?>"
	 <?php if(	  $myrow17['codigo']){ 
	  echo 'disabled="disabled"'; 
	  } ?>/>
      </span></span></td>
      
	  
	  <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
	  <?php if(	  $myrow17['id_requisicion'] and $_POST['fechaInicial']==$fecha1){ ?>
	  <a href="solicitudArticulos.php?id_requisicion=<?php echo $myrow17['id_requisicion']; ?>&amp;almacen=<?php echo $ali; ?>&amp;elimina=<?php echo "yes"; ?>&amp;keyR=<?php echo $myrow17['keyR']; ?>&amp;codigo=<?php echo $myrow17['codigo']; ?>"><img src="borrar.png" alt="Cancelar el pedido" width="23" height="23" border="0"  
onclick="if(confirm('¿Estás seguro que deseas cancelar el articulo: <?php echo $myrow7['descripcion'];?>?') == false){return false;}" /></a>      </span></td>
      <?php } else {?>
	  <?php echo "---"; ?>
	  <?php } ?>
	  
	  <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <?php if(	  !$myrow17['id_requisicion']){ ?>
        <img src="/sima/imagenes/sinSolicitar.png" alt="No se ha generado una requisicion para este art&iacute;culo" width="23" height="23" />
        <?php } else if($pendiente=='1'){?>
		<img src="/sima/imagenes/pendiente.png" width="23" height="23" alt="Solicitud Pendiente" /> 
		
		<?php } else { ?>
        <img src="/sima/imagenes/solicitado.png" alt="Ya tiene una requisicion" width="23" height="23" />
        <?php } ?>
           </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['hora1']){
	  echo $myrow18['hora1'];
	  } else {
	  echo "0";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['fecha1']){
	  echo $myrow18['fecha1'];
	  } else {
	  echo "0";
	  }
	 
		?>
      </span></td>
    </tr>
    <?php  }}} //cierra while ?>
  </table>
  <div align="center"><strong>
    <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    <input name="solicitar" type="submit" class="style12" id="solicitar" value="Solicitar/Actualizar" 
	
	/>
    </label>
    <label></label>
    <span class="Estilo24">
    <input name="nomArticulo" type="hidden" id="nomArticulo" value="<?php echo $_POST['nomArticulo']; ?>" />
  </span></p>
</form>

</body>
</html>