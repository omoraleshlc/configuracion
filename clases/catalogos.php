<?php 
class catalogosOtros{


public function catalogoArticulos($entidad,$usuario,$codigo,$fecha1,$basedatos){
$hora1= date("H:i a");
?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=600,height=300,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=600,height=300,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=600,scrollbars=YES") 
} 
</script> 

<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
      if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe una breve descripci�n del art�culo!")   
                return false   
        } else if( vacio(F.gpoProducto.value) == false ) {   
                alert("Por Favor, escribe el grupo de producto que deseas anexar!")   
                return false   
        } else if( vacio(F.costo.value) == false ) {   
                alert("Por Favor, escoje el costo!")   
                return false   
        } else if( vacio(F.pmax.value) == false ) {   
                alert("Por Favor, escoje el m�ximo!")   
                return false   
        } else if( vacio(F.reorden.value) == false ) {   
                alert("Por Favor, escoje el punto de reorden!")   
                return false   
        } else if( vacio(F.pmin.value) == false ) {   
                alert("Por Favor, escoje el m�nimo!")   
                return false   
        } else if( vacio(F.precioEfectivo.value) == false ) {   
                alert("Por Favor, escoje el precio efectivo venta al p�blico!")   
                return false   
        } else if( vacio(F.precioCredito.value) == false ) {   
                alert("Por Favor, escoje el precio Credito venta al p�blico!")   
                return false   
         }  
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
<?php



if($_POST['actualizar'] AND $_POST['descripcion']  ){
 $sSQL1= "Select * From articulos WHERE entidad='".$entidad."' AND codigo = '".$_POST['codigo']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();

if(!$_POST['generico']){
$_POST['generico']='no';
}

if(!$_POST['paquete']){
$_POST['paquete']='no';
}




$sSQL121= "SELECT 
 max(codigo)+1 as codigoFinal
FROM
articulos
where entidad='".$entidad."'
";
$result121=mysql_db_query($basedatos,$sSQL121);
$myrow121 = mysql_fetch_array($result121);
echo mysql_error();
$_POST['codigo2']=$_POST['codigo'];
$_POST['codigo']=$myrow121['codigoFinal'];
$sSQL122= "SELECT 
max(codigo)+1 as ultimoDigito
FROM
articulos
where entidad='".$entidad."'
";
$result122=mysql_db_query($basedatos,$sSQL122);
$myrow122 = mysql_fetch_array($result122);
$ultimoDigito=$myrow122['ultimoDigito'];
echo mysql_error();



if(!$myrow1['codigo']){
if(!$myrow1['codigo']){



 $agrega = "INSERT INTO articulos (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,servicio,paquete) 
values ('".$ultimoDigito."','".$_POST['descripcion']."','".$_POST['descripcion1']."','".$_POST['um']."','".$_POST['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_POST['cbarra']."','".$_POST['laboratorio']."','".$_POST['sustancia']."','A','".$_POST['umVentas']."',
'".$_POST['ventaPieza']."','".$_POST['observaciones']."','".$_POST['cajaCon']."','".$hora1."','".$entidad."',
'".$_POST['generico']."','no','".$_POST['paquete']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$agrega = "INSERT INTO articulosHistoria (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,tipoTransaccion) 
values ('".$_POST['codigo']."','".$_POST['descripcion']."','".$_POST['descripcion1']."','".$_POST['um']."','".$_POST['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_POST['cbarra']."','".$_POST['laboratorio']."','".$_POST['sustancia']."','A','".$_POST['umVentas']."',
'".$_POST['ventaPieza']."','".$_POST['observaciones']."','".$_POST['cajaCon']."','".$hora1."','".$entidad."',
'".$_POST['generico']."','insertar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>

<script >
window.alert( "ARTICULO <?php echo $_POST['descripcion'];?> AGREGADO... ");
window.close();
</script>';
<?php
}} else if(!$_POST['nuebo']){
 $q1 = "UPDATE articulos set 
activo='".$_POST['activo']."', 
descripcion='".$_POST['descripcion']."', 
descripcion1='".$_POST['descripcion1']."', 
um='".$_POST['um']."', 
gpoProducto='".$_POST['gpoProducto']."', 
cbarra='".$_POST['cbarra']."',
laboratorio='".$_POST['laboratorio']."',
sustancia='".$_POST['sustancia']."',
umVentas='".$_POST['umVentas']."',
fechaActualizacion='".$fecha1."',
ventaPieza='".$_POST['ventaPieza']."',
observaciones='".$_POST['observaciones']."',
cajaCon='".$_POST['cajaCon']."',
hora='".$hora1."',
usuario='".$usuario."',
entidad='".$entidad."',
generico='".$_POST['generico']."',
paquete='".$_POST['paquete']."'
WHERE keyPA='".$_POST['keyPA']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();


$agrega = "INSERT INTO articulosHistoria (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,tipoTransaccion) 
values ('".$_POST['codigo']."','".$_POST['descripcion']."','".$_POST['descripcion1']."','".$_POST['um']."','".$_POST['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_POST['cbarra']."','".$_POST['laboratorio']."','".$_POST['sustancia']."','A','".$_POST['umVentas']."',
'".$_POST['ventaPieza']."','".$_POST['observaciones']."','".$_POST['cajaCon']."','".$hora1."','".$entidad."',
'".$_POST['generico']."','actualizar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script >
window.alert( "ARTICULO ACTUALIZADO");
window.close();
</script>;';

}

}

if($_POST['borrar'] AND $_POST['codigo']){

$agrega = "INSERT INTO articulosHistoria (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,tipoTransaccion) 
values ('".$_POST['codigo']."','".$_POST['descripcion']."','".$_POST['descripcion1']."','".$_POST['um']."','".$_POST['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_POST['cbarra']."','".$_POST['laboratorio']."','".$_POST['sustancia']."','A','".$_POST['umVentas']."',
'".$_POST['ventaPieza']."','".$_POST['observaciones']."','".$_POST['cajaCon']."','".$hora1."','".$entidad."',
'".$_POST['generico']."','borrar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


 $q1 = "UPDATE articulos set 
activo='cancelado'

WHERE entidad='".$entidad."' AND keyPA='".$_POST['keyPA']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();

echo '<script >
window.alert( "SE ELIMINO EL ARTICULO");
window.close();
</script>';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.Estilo24 {font-size: 10px}
.style14 {color: #FFFFFF}
.style14 {color: #FFFFFF}
.style15 {color: #FFFFFF}
.style15 {color: #FFFFFF}
-->
</style>
</head>

<body>
<h1 align="center">ARTICULOS VARIOS <?php

if($_POST['nuevo'] ){

$_GET['codigo']=null;
 $sSQL122= "SELECT 
max(codigo)+1 as ultimoDigito
FROM
articulos

";
$result122=mysql_db_query($basedatos,$sSQL122);
$myrow122 = mysql_fetch_array($result122);
 $ultimoDigito=$myrow122['ultimoDigito'];
$_POST['codigo']= $ultimoDigito;
} else if($_POST['cbarra']){
$sSQL= "SELECT 
 *
FROM
  articulos

  where entidad='".$entidad."' AND
  cbarra='".$_POST['cbarra']."'
  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$ultimoDigito=$myrow['codigo'];
} else { //trae por codigo de barra
if(!$_POST['nuevo']){
 $sSQL= "SELECT 
 *
FROM
  articulos
where entidad='".$entidad."' AND
  codigo='".$_POST['codigo']."'

  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}
if($_GET['codigo']){

  $sSQL= "SELECT 
 *
FROM
  articulos
where entidad='".$entidad."' AND
  codigo='".$_GET['codigo']."'
  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}}
?>
</h1>


<form id="form1" name="form1" method="post" action="" />
  <table width="597" border="0" align="center" cellpadding="3" cellspacing="3" class="style12">
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">C&oacute;digo:</span></td>
      <td colspan="2" bgcolor="#FFCCFF">        
	  <input name="codigo" type="text" class="style12" id="codigo" value="<?php 
	  
	  if($_POST['nuevo'] ){

	   echo $ultimoDigito;
	  } else {
	 
	  echo $myrow['codigo'];
	
	 
	  }
	  ?>"  readonly=""/>      </td>
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td width="165" bgcolor="#660066">
        <label>
        
        <div align="left" class="style13">Descripci&oacute;n:</div>
        <span class="style13">
        </label>
      </span></td>
      <td colspan="2"><label>
        <div align="left">
		<?php $descripcion = $myrow['descripcion'];?>
          <textarea name="descripcion" cols="60" rows="3" class="style12" id="descripcion"><?php echo $descripcion?></textarea>
        </div>
      </label></td>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">Activo:</span></td>
      <td bgcolor="#FFCCFF"><input name="activo" type="checkbox" id="activo" value="A"
		<?php if($myrow['activo']=='A' ){
		echo 'checked="checked"';
		}
		?>></td>
      <td bgcolor="#FFCCFF">&nbsp;</td>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style14">Gen&eacute;rico:</span></td>
      <td><input name="generico" type="checkbox" id="generico" value="si"
		<?php if($myrow['generico']=='si' ){
		echo 'checked="checked"';
		}
		?> /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">Grupo Producto: </span></td>
      <td width="324" bgcolor="#FFCCFF">
	    <label>
	     <?php //*********ANAQUELES
	 
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
$gpoProducto=$myrow['gpoProducto'];
$sSQL11= "SELECT 
 *
FROM
  gpoProductos
where entidad='".$entidad."' AND codigoGP = '".$gpoProducto."'";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

	  ?>
	     <select name="gpoProducto" class="style12" id="gpoProducto">
  
           <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
           <option 
		    <?php 		if($myrow['gpoProducto']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']." - ".$myrow7['codigoGP']; ?></option>
           <?php } 
		
		?>
         </select>
      </label>	  </td>
      <td width="68" bgcolor="#FFCCFF"><a href="gpoProductos.php"></a><a href="javascript:ventanaSecundaria('/sima/cargos/gpoProductos.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
	  <img src="/sima/imagenes/Save.png" alt="Grupo de Producto" width="20" height="20" border="0" /></a></td>
    </tr>
    
	
	<tr>
	  <th width="1" scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">C&oacute;digo Barra:</span></td>
	  <td colspan="2"><label>
	    <input name="cbarra" type="text" class="style12" id="cbarra" value="<?php echo $myrow['cbarra']; ?>" size="40"  autocomplete="off"/>
	    <a href="javascript:ventanaSecundaria4(
		'/sima/cargos/agregaCB.php?descripcion=<?php echo $descripcion; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "cbarra"; ?>')">Adjuntar</a>
	    <a href="javascript:ventanaSecundaria3('/sima/cargos/cBarraSubeVentana.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
		<img src="/sima/imagenes/Save.png" alt="Grupo de Producto" width="20" height="20" border="0" /></a></label></td>
    </tr>
	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><div align="left" class="style13">Se vende por pieza </div></td>
	  <td bgcolor="#FFCCFF"><label>
	    <input name="ventaPieza" type="checkbox" id="ventaPieza" value="si"
		<?php if($myrow['ventaPieza']){
		echo 'checked="checked"';
		} else if($_POST['ventaPieza']){
		echo 'checked="checked"';
		}
		?>
		/>
		
<?php //if($myrow['cajaCon'] or $_POST['ventaPieza']){ ?>
	  Caja con: 
<input name="cajaCon" type="text" class="style12" id="cajaCon" value="<?php echo $myrow['cajaCon'];?>" size="6" />
<?php //} ?>
	  </label></td>
	  <td bgcolor="#FFCCFF">&nbsp;</td>
    </tr>
	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><div align="left" class="style13">Unidad de Medida:</div></td>
	  <td><label></select>
      </label>
      </label>
      <input name="um" type="text" class="Estilo24" id="um" 
		onchange="javascript:this.form.submit();"
		value="<?php echo $myrow['um']; ?>" size="4"   readonly="" />
      <span class="Estilo24"><a href="javascript:ventanaSecundaria2('/sima/cargos/ventanaEmergenteUM.php?campoDespliega=<?php echo "umDescripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;nombreCampo=<?php echo "um"; ?>&amp;usuario=<?php echo $usuario; ?>')">
	  <img src="/sima/imagenes/Save.png" alt="Unidad de Medida" width="20" height="20" border="0" /></a>
	  <?php
	  $um=$myrow['um'];
	  $sSQL11= "SELECT 
 *
FROM
  unidadMedida
where entidad='".$entidad."' AND codigoUM = '".$um."'";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
	  ?>
      <input name="umDescripcion" type="text" class="Estilo24" id="umDescripcion" value="<?php echo $myrow11['descripcionUM'];?>" size="40" readonly="" />
      <a href="javascript:ventanaSecundaria('/sima/cargos/um.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
	  <img src="/sima/imagenes/Save.png" alt="EDITAR UNIDAD DE MEDIDA" width="20" height="20" border="0" /></a></span></td>
    </tr>
    
	<?php 
	
	$sSQL111= "SELECT 
 *
FROM
  precioArticulos
where entidad='".$entidad."' AND codigo = '".$_POST['codigo']."'";
$result111=mysql_db_query($basedatos,$sSQL111);
$myrow111 = mysql_fetch_array($result111);
echo mysql_error();
$PA=$myrow111['keyPA'];
	
	
	
	?>

	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">Fecha de Creaci&oacute;n:</span></td>
	  <td colspan="2" bgcolor="#FFCCFF"><?php
	  if($myrow['fecha']){
	   echo $myrow['fecha'];
	   } else {
	   echo "---";
	   }
	   ?>&nbsp;</td>
    </tr>
	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">Fecha de Actualizaci&oacute;n:</span></td>
	  <td colspan="2"><?php  
	  if($myrow['fechaActualizacion']){
	  echo $myrow['fechaActualizacion'];
	     } else {
	   echo "---";
	   }
	  ?></td>
    </tr>
	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">Laboratorio Fabricante:</span></td>
	  <td colspan="2" bgcolor="#FFCCFF"><label>
	    <?php //*********Unidades de Medida
	 


 $sSQL71= "Select distinct * From catLabFabricante
where entidad='".$entidad."' AND
activo='activo'

 ORDER BY descripcionLF ASC ";
$result71=mysql_db_query($basedatos,$sSQL71); 


	  ?>
        <select name="laboratorio" class="style12" id="laboratorio">
   
          <?php  	 		 
		   while($myrow71 = mysql_fetch_array($result71)){ ?>
		  
          <option
		    <?php 		if($myrow['laboratorio']==$myrow71['id_LF']){ ?>
		  selected="selected"
		  <?php } ?>
		   value="<?php echo $myrow71['id_LF']; ?>"><?php echo $myrow71['descripcionLF']; ?></option>
          <?php } ?>
        </select>
      </label>
        </label> <a href="laboratorioF.php"></a><a href="javascript:ventanaSecundaria('laboratorioF.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"></a></td>
	</tr>
	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">Sustancia Activa:</span></td>
	  <td colspan="2"><textarea name="descripcion1" cols="60" rows="3" class="style12" id="descripcion1"><?php echo $myrow['descripcion1']; ?></textarea></td>
    </tr>
	<tr>
	  <th width="1" scope="col">&nbsp;</th>

	<?php if($myrow['codigo']){ ?>
      <td bgcolor="#660066"><span class="style13">Agregar Almacen:</span></td>
      <td colspan="2" bgcolor="#FFCCFF">
 
    <label></label>
    <label><a href="javascript:ventanaSecundaria('/sima/cargos/listaAlmacenes.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA'];?>')">
	<img src="/sima/imagenes/Save.png" alt="Almacenes" width="20" height="20" border="0" /></a></label></td>
    </tr>

	
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">M&aacute;ximos y M&iacute;nimos, Reorden: </span></td>
      <td colspan="2"><a href="javascript:ventanaSecundaria('/sima/cargos/maximosMinimos.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
	  <img src="/sima/imagenes/Save.png" alt="M&aacute;ximos y M&iacute;nimos" width="20" height="20" border="0" /></a></td>
    </tr>
	    <?php } ?>
        <tr>
          <th scope="col">&nbsp;</th>
          <td bgcolor="#660066"><span class="style13">Observaciones:</span></td>
          <td colspan="2" bgcolor="#FFCCFF"><textarea name="observaciones" cols="60" rows="3" class="style12" id="observaciones"><?php echo $myrow['observaciones']; ?></textarea></td>
        </tr>
    
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left"><span class="style13"></span></div></td>
      <td colspan="2"><div align="left">
        <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" />
        <input name="borrar" type="submit" class="style12" id="borrar" value="Borrar" />
		<input name="keyPA" type="hidden" class="style12" id="borrar" value="<?php echo $myrow['keyPA']; ?>" />
        <input name="actualizar" type="submit" class="style12" id="actualizar" value="Actualizar/Grabar" />
      </div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center" class="style12"> 
        <label></label>
        <label></label>
        <p><label></label></p>
      </div></td>
    </tr>
</table>
  </form>
<div align="center"><a href="precios.php">Regresar al listado de art&iacute;culos</a> </div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>


<?php 
}




















public function catalogosServicios($entidad,$almacenSolicitante,$usuario,$fecha1,$basedatos){



?>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 

<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
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
      if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe una breve descripci�n del art�culo!")   
                return false   
        } else if( vacio(F.gpoProducto.value) == false ) {   
                alert("Por Favor, escribe el grupo de producto que deseas anexar!")   
                return false   
         
        } 
           
}   
 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
		alert("S�lo Se aceptan N�meros!")
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php
$hora1= date("H:i a");
if(!$_POST['actualizar'] ){
$_POST['codigo']=$_GET['codigo'];
}

if($_POST['actualizar']  AND $_POST['descripcion']  AND $_POST['codigo']){
if(!$_POST['referido']){
$_POST['referido']="no";
}

if(!$_POST['paquete']){
$_POST['paquete']='no';
}

if(!$_POST['cargoAuto']){
$_POST['cargoAuto']='no';
}


$sSQL1= "Select * From articulos where entidad='".$entidad."' AND codigo = '".$_POST['codigo']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigo'] ){

$sSQL121= "SELECT 
 max(codigo)+1 as codigoFinal
FROM
articulos

";
$result121=mysql_db_query($basedatos,$sSQL121);
$myrow121 = mysql_fetch_array($result121);
$sSQL122= "SELECT 
 max(keyPA)+1 as ultimoDigito
FROM
articulos

";
$result122=mysql_db_query($basedatos,$sSQL122);
$myrow122 = mysql_fetch_array($result122);
$ultimoDigito=$myrow122['ultimoDigito'];
$_POST['codigo']=$myrow121['codigoFinal'];

$agrega = "INSERT INTO articulos (
codigo,descripcion,um,gpoProducto,cbarra,descripcion1,laboratorioReferido,activo,usuario,fecha,entidad,cargoAuto,
horaAuto,servicio,paquete) 
values ('".$_POST['codigo']."','".strtoupper($_POST['descripcion'])."','s','".$_POST['gpoProducto']."',
'".$_POST['cbarra']."','".$_POST['descripcion1']."','".$_POST['referido']."','".$_POST['activo']."','".$usuario."',
'".$fecha1."','".$entidad."','".$_POST['cargoAuto']."','".$_POST['horaAuto']."','si','".$_POST['paquete']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

echo '<script type="text/vbscript">
msgbox "ARTICULO AGREGADO, AHORA ESCOJE LOS ALMACENES QUE DESEAS QUE VENDAN ESTE ARTICULO"
</script>';

 $agrega = "INSERT INTO articulosHistoria (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,tipoTransaccion) 
values ('".$_POST['codigo']."','".$_POST['descripcion']."','".$_POST['descripcion1']."','".$_POST['um']."','".$_POST['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_POST['cbarra']."','".$_POST['laboratorio']."','".$_POST['sustancia']."','A','".$_POST['umVentas']."',
'".$_POST['ventaPieza']."','".$_POST['observaciones']."','".$_POST['cajaCon']."','".$hora1."','".$entidad."',
'".$_POST['generico']."','insertar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


} else if(!$_POST['nuebo']){

$q1 = "UPDATE articulos set 
descripcion='".$_POST['descripcion']."', 
descripcion1='".$_POST['descripcion1']."', 
cargoAuto='".$_POST['cargoAuto']."', 
horaAuto='".$_POST['horaAuto']."', 

gpoProducto='".$_POST['gpoProducto']."', 
cbarra='".$_POST['cbarra']."',
referido='".$_POST['referido']."',
laboratorioReferido='".$_POST['referido']."',

activo='".$_POST['activo']."',
usuario='".$usuario."',
fechaActualizacion='".$fecha1."',entidad='".$entidad."'
WHERE 
keyPA='".$_POST['keyPA']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();

echo '<script type="text/vbscript">
msgbox "ARTICULO ACTUALIZADO"
</script>';

 $agrega = "INSERT INTO articulosHistoria (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,tipoTransaccion) 
values ('".$_POST['codigo']."','".$_POST['descripcion']."','".$_POST['descripcion1']."','".$_POST['um']."','".$_POST['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_POST['cbarra']."','".$_POST['laboratorio']."','".$_POST['sustancia']."','A','".$_POST['umVentas']."',
'".$_POST['ventaPieza']."','".$_POST['observaciones']."','".$_POST['cajaCon']."','".$hora1."','".$entidad."',
'".$_POST['generico']."','actualizar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}

if($_POST['borrar'] AND $_POST['codigo']){

 $agrega = "INSERT INTO articulosHistoria (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,tipoTransaccion) 
values ('".$_POST['codigo']."','".$_POST['descripcion']."','".$_POST['descripcion1']."','".$_POST['um']."','".$_POST['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_POST['cbarra']."','".$_POST['laboratorio']."','".$_POST['sustancia']."','A','".$_POST['umVentas']."',
'".$_POST['ventaPieza']."','".$_POST['observaciones']."','".$_POST['cajaCon']."','".$hora1."','".$entidad."',
'".$_POST['generico']."','borrar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


 $q1 = "UPDATE articulos set 
activo='cancelado'

WHERE keyPA='".$_POST['keyPA']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();


echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL ARTICULO"
</script>';
}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['codigo'] = "";
$nuevo = "1";
$sSQL122= "SELECT 
 max(codigo)+1 as ultimoDigito
FROM
articulos

";
$result122=mysql_db_query($basedatos,$sSQL122);
$myrow122 = mysql_fetch_array($result122);
$ultimoDigito=$myrow122['ultimoDigito'];


}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center">SERVICIOS<?php
  if($_POST['siguiente'] AND $_POST['codigo']){
  $_POST['codigo'] =$_POST['codigo']+1;
  } 
  if($_POST['atras'] AND $_POST['codigo']){
  $_POST['codigo'] =$_POST['codigo']-1;
  }

$sSQL= "SELECT 
 *
FROM
  articulos
  WHERE codigo = '".$_POST['codigo']."'
  and
  activo!='cancelado'
  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);




$codec=$myrow['codigo'];
?>
</h1>
<form id="form1" name="form1" method="post" action=""/>
  <table width="755" border="0" align="center" class="style12">
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">C&oacute;digo de Referencia :</div></td>
      <td colspan="2" bgcolor="#FFCCFF"><input name="codigo" type="text" class="style12" id="codigo" value="<?php 
	  if($myrow['codigo']){
	  echo $myrow['codigo'];
	  } else if($_POST['nuevo']) {
	  echo $ultimoDigito;
	  }
	  ?>"  readonly=""/></td>
    </tr>
    <tr>
      <th width="4" scope="col">&nbsp;</th>
      <td width="153" bgcolor="#660066">
        <label>
        
        <div align="left" class="style13">Descripci&oacute;n:</div>
        <span class="style13">
        </label>
      </span></td>
      <td colspan="2"><label>
        <div align="left">
<textarea name="descripcion" cols="60" rows="3" class="style12" id="descripcion"><?php echo $descripcion = $myrow['descripcion']?></textarea>
        </div>
      </label></td>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">Descripci&oacute;n (Impresi&oacute;n en Factura):</div></td>
      <td colspan="2" bgcolor="#FFCCFF"><label>
        <input name="descripcion1" type="text" class="style12" id="descripcion1" value="<?php echo $descripcion = $myrow['descripcion1']?>" size="64" />
      </label></td>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">Activo:</span></td>
      <td bgcolor="#FFCCFF"><input name="activo" type="checkbox" id="activo" value="A"
		<?php if($myrow['activo']=='A' or $_POST['nuevo'] ){
		echo 'checked="checked"';
		}
		?> /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th width="4" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><span class="style13">Grupo Producto: </span></td>
      <td width="278">
	    <label>
	     <?php //*********ANAQUELES
	 
 $sSQL7= "Select distinct * From gpoProductos 
where entidad='".$entidad."' AND
 activo='activo'
 ORDER BY descripcionGP DESC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
$gpoProducto=$myrow['gpoProducto'];
$sSQL11= "SELECT 
 *
FROM
  gpoProductos
  where entidad='".$entidad."' AND codigoGP = '".$gpoProducto."'
  and 
  activo='activo'
  
  ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

	  ?>
     
        <select name="gpoProducto" class="style12" id="gpoProducto" >
		<?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
		
		<option <?php 		if($myrow['gpoProducto']==$myrow7['codigoGP']){ echo 'selected';} ?>  value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
		<?php } 
		
		?>
        </select>
      </label>	  </td>
      <td width="292"><a href="gpoProductos.php">Editar</a></td>
    </tr>
	


	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">&iquest;Cargo Autom&aacute;tico? </span></td>
	  <td colspan="2"><label>
	    <input name="cargoAuto" type="checkbox" id="cargoAuto" value="si" <?php
		if($myrow['cargoAuto']=='si'){
		echo 'checked=""';
		}
		?> />
	    <input name="horaAuto" type="text" class="Estilo24" id="horaAuto" size="3" value="<?php echo $myrow['horaAuto'];?>" />
	  </label></td>
    </tr>
	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">&iquest;Es un paquete? </span></td>
	  <td colspan="2">   <input name="paquete" type="checkbox" id="referido" value="si"
		<?php if($myrow['paquete']=='si' ){
		echo 'checked="checked"';
		}
		?>/>
	 </td>
    </tr>
	<tr>
	  <th scope="col">&nbsp;</th>
	  <td bgcolor="#660066"><span class="style13">Laboratorio Referido :</span></td>
	  <td colspan="2"><span class="Estilo24"><a href="javascript:ventanaSecundaria2('ventanaLabReferido.php?campoDespliega=<?php echo "umDescripcion"; ?>&amp;forma=<?php echo "form1"; ?>&amp;nombreCampo=<?php echo "laboratorioReferido"; ?>&amp;usuario=<?php echo $usuario; ?>')">
	  
	  
	 
	    <input name="referido" type="checkbox" id="referido" value="si"
		<?php if($myrow['laboratorioReferido']=='si' ){
		echo 'checked="checked"';
		}
		?> />
	  </a></span></td>
    </tr>
	<tr>
	  <th width="4" scope="col">&nbsp;</th>
	
	<?php if($codec){ ?>
      <td bgcolor="#660066"><span class="style13">Agregar Almacen</span></td>
      <td colspan="2">
 
    <label></label>
    <label>
    <a href="javascript:ventanaSecundaria('/sima/cargos/listaAlmacenes.php?codigo=<?php echo $_POST['codigo']; ?>&amp;almacen=<?php echo $almacenSolicitante; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
	<img src="/sima/imagenes/Save.png" alt="Almacenes" width="20" height="20" border="0" /></a>
    
    <?php if($myrow['codigo']){ ?><?php } else {?>
    <?php 
$sSQL121= "SELECT 
 max(codigo)+1 as codigoFinal
FROM
articulos
where entidad='".$entidad."' 
";
$result121=mysql_db_query($basedatos,$sSQL121);
$myrow121 = mysql_fetch_array($result121);
?><?php }?>
    </label></td>
    </tr>
    <?php } ?>
	<tr>
	  <th width="4" scope="col">&nbsp;</th>
      <?php /** ?>
	  <td bgcolor="#333333"><div align="left" class="style13">IVA</div></td>
      <td colspan="2"><div align="left">
        <label></label>
        <label>
        <input name="TASA" type="checkbox" id="TASA" value="si" 
		<?php if($myrow11['TASA']){
		echo " "."checked"; } ?>
		/>
        </label>
      </div></td>
	  <?php **/ ?>
    </tr>
    <tr>
      <th width="4" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left"><span class="style13"></span></div></td>
      <td colspan="2" bgcolor="#FFCCFF"><div align="left">
        <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" />
        <input name="borrar" type="submit" class="style12" id="borrar" value="Borrar" />
        <input name="actualizar" type="submit" class="style12" id="actualizar" value="Actualizar/Grabar" />
      </div></td>
    </tr>
    <tr>
      <td height="52" colspan="4"><div align="center" class="style12"> 
        <label></label>
        <label></label>
		<input name="keyPA" type="hidden" class="style12" id="borrar" value="<?php echo $myrow['keyPA']; ?>" />
		 <input name="codigoAlterno" type="hidden" id="nuebo" value="<?php echo $ultimoDigito; ?>" />
        <input name="nuebo" type="hidden" id="nuebo" value="<?php echo $nuevo; ?>" />
        <p><label></label></p>
      </div></td>
    </tr>
</table>
</form>
<p align="center"><a href="listadoProcedimientos.php">Regresar a Listado de Servicios </a></p>
<p>&nbsp;</p>


</body>
</html>

<?php 
} //cierra catalogo servicios

} //cierra clase 
?>