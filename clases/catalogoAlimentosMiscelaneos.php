<?php class catalogos {
public function catalogoArticulos($entidad,$usuario,$codigo,$fecha1,$basedatos){
$hora1= date("H:i a");
?>


<?php
$sSQL2a1= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion='ARTVAR'  ";
$result2a1=mysql_db_query($basedatos,$sSQL2a1);
$myrow2a1 = mysql_fetch_array($result2a1);
if($myrow2a1['clasificacion']=='ARTVAR'){

$_GET['gpoProducto']=$myrow2a1['gpoProducto'];
} else { ?>
<script>
window.alert("Oops! hay un problema de configuracion");
window.close();
</script>
<?php 
}
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
$fecha1=date("Y-m-d");
/*
$_GET['codigo']=$codigo;
$_GET['actualizar']=$actualizar;
$_GET['borrar']=$borrar;
$_GET['descripcion']=$descripcion;
*/




if(!$_GET['generico']){
$_GET['generico']='no';
}

if(!$_GET['paquete']){
$_GET['paquete']='no';
}


if($_GET['nuevo']){
$_GET['keyPA']=NULL;
}else{
$_GET['nuevo']=NULL;
}




if($_GET['actualizar'] AND $_GET['descripcion']  ){


if($_GET['keyPA']){
$sSQL1= "Select * From articulos WHERE  keyPA = '".$_GET['keyPA']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();
 } else {
$sSQL1= "Select * From articulos WHERE  usuario='".$usuario."' and random='".$_GET['random']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
 }


if(!$myrow1['keyPA'] and !$_GET['keyPA']){
 $sSQL122= "SELECT 
max(codigo)+1 as ultimoDigito
FROM
articulos

";
$result122=mysql_db_query($basedatos,$sSQL122);
$myrow122 = mysql_fetch_array($result122);
$agrega = "INSERT INTO articulos (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,servicio,paquete,random,caducidad,antibiotico) 
values ('".$myrow122['ultimoDigito']."','".$_GET['descripcion']."','".$_GET['descripcion1']."','".$_GET['um']."','".$_GET['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_GET['cbarra']."','".$_GET['laboratorio']."','".$_GET['sustancia']."','A','".$_GET['umVentas']."',
'".$_GET['ventaPieza']."','".$_GET['observaciones']."','".$_GET['cajaCon']."','".$hora1."','".$entidad."',
'".$_GET['generico']."','no','".$_GET['paquete']."','".$_GET['random']."' ,'".$_GET['caducidad']."' ,'".$_GET['antibiotico']."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



?>

<script>
window.alert( "ARTICULO <?php echo $_GET['descripcion'];?> AGREGADO... ");
</script>
<?php
} else {
 $q1 = "UPDATE articulos set 
 antibiotico='".$_GET['antibiotico']."',
caducidad='".$_GET['caducidad']."',
descripcion='".$_GET['descripcion']."', 
descripcion1='".$_GET['descripcion1']."', 
um='".$_GET['um']."', 
gpoProducto='".$_GET['gpoProducto']."', 
cbarra='".$_GET['cbarra']."',
laboratorio='".$_GET['laboratorio']."',
sustancia='".$_GET['sustancia']."',
umVentas='".$_GET['umVentas']."',
fechaActualizacion='".$fecha1."',
ventaPieza='".$_GET['ventaPieza']."',
observaciones='".$_GET['observaciones']."',
cajaCon='".$_GET['cajaCon']."',
hora='".$hora1."',
usuario='".$usuario."',
entidad='".$entidad."',
generico='".$_GET['generico']."',
paquete='".$_GET['paquete']."'
WHERE keyPA='".$_GET['keyPA']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();

$qas = "UPDATE existencias set 
descripcion='".$myrow1['descripcion']."'
WHERE 
keyPA='".$_GET['keyPA']."'";

mysql_db_query($basedatos,$qas);
echo mysql_error();
?>
<script>
window.alert("ARTICULO ACTUALIZADO");
</script>

<?php 
//echo 'Articulo actualizado';
}


}








if($_GET['borrar'] AND $_GET['codigo']){

$agrega = "INSERT INTO articulosHistoria (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,tipoTransaccion) 
values ('".$_GET['codigo']."','".$_GET['descripcion']."','".$_GET['descripcion1']."','".$_GET['um']."','".$_GET['gpoProducto']."',

'".$usuario."','".$fecha1."',
'".$_GET['cbarra']."','".$_GET['laboratorio']."','".$_GET['sustancia']."','A','".$_GET['umVentas']."',
'".$_GET['ventaPieza']."','".$_GET['observaciones']."','".$_GET['cajaCon']."','".$hora1."','".$entidad."',
'".$_GET['generico']."','borrar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


 $q1 = "UPDATE articulos set 
activo='cancelado'

WHERE entidad='".$entidad."' AND keyPA='".$_GET['keyPA']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
echo 'Se elimino el articulo';
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL ARTICULO"
</script>';
}



if($_GET['keyPA']){
$r=NULL;
$sSQL= "Select * From articulos WHERE  keyPA = '".$_GET['keyPA']."' or keyPA='".$myrow['keyPA']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
} else if($_GET['random']) {
$r=NULL;
$sSQL= "Select * From articulos WHERE  usuario='".$usuario."' and random='".$_GET['random']."'";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

} else {
$r='disabled=""';
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
-->
</style>
</head>

<body>
<h1 align="center" class="titulos">Alta/Modifica Alimentos Miscelaneos</h1>
<form id="form1" name="form1" method="GET"/>
<table width="348" border="0" cellspacing="0" cellpadding="0">
<tr>
         
       
        
    <td width="115" align="right"><div align="center">
      <input name="nuevo" type="image" src="/sima/imagenes/bordestablas/btns/newbtn.png" id="nuevo" value="Nuevo" <?php echo $r;?> />
    </td>
    <td width="118" align="right"><div align="center"><input name="actualizar" type="image" src="/sima/imagenes/bordestablas/btns/refreshbtn.png"  id="actualizar" value="Actualizar/Grabar" />
    </div></td>
    <td width="115" align="right"><div align="center"> <input name="borrar" type="image" src='/sima/imagenes/bordestablas/btns/deletebtn.png' id="borrar" value="Borrar" /></div></td>
  </tr>
  <tr>
    <td align="right"><div align="center" class="codigos">Nuevo</div></td>
    <td align="right"><div align="center" class="codigos">Actualiza</div></td>
    <td align="right"><div align="center" class="codigos">Elimina</div></td>
  </tr>
</table>

  <table width="550" border="0" align="center" cellpadding="0" cellspacing="0" class="style12">
    <tr>
      <th colspan="4" scope="col"><img src="/sima/imagenes/bordestablas/borde1.png" width="550" height="22" /></th>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th width="3" scope="col">&nbsp;</th>
      <td width="103"><label> </label>
          <div align="left" class="negromid">Descripci&oacute;n:</div>
        <span class="style13"> </span></td>
      <td colspan="2"><label> </label>
          <div align="left">
            <?php $descripcion = $myrow['descripcion'];?>
            <textarea name="descripcion" cols="45" rows="3" class="camposmid" id="descripcion"><?php echo $myrow['descripcion'];?></textarea>
        </div></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th scope="col">&nbsp;</th>
      <td><div align="left" class="negromid">Descripci&oacute;n de impresi&oacute;n</div></td>
      <td width="426"><textarea name="descripcion1" cols="45" rows="3" class="camposmid" id="descripcion1"><?php echo $myrow['descripcion1'];?></textarea></td>
      <td width="18">&nbsp;</td>
    </tr>

    <?php 
	
	$sSQL111= "SELECT 
 *
FROM
  precioArticulos
where entidad='".$entidad."' AND codigo = '".$_GET['codigo']."'";
$result111=mysql_db_query($basedatos,$sSQL111);
$myrow111 = mysql_fetch_array($result111);
echo mysql_error();
$PA=$myrow111['keyPA'];
	
	
	
	?>
    <tr bgcolor="#CCCCCC">
      <th scope="col">&nbsp;</th>
      <td><span class="negromid">C&oacute;digo Barra:</span></td>
      <td colspan="2"><input name="cbarra" type="text" class="style12" id="cbarra" value="<?php echo $myrow['cbarra']; ?>" size="40"  autocomplete="off"/>
        <a href="javascript:ventanaSecundaria4(
		'/sima/cargos/agregaCB.php?descripcion=<?php echo $descripcion; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "cbarra"; ?>')">Adjuntar</a></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th scope="col">&nbsp;</th>
      <td class="negromid">&nbsp;</td>
      <td colspan="2" valign="middle" class="codigos">&nbsp;</td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th scope="col">&nbsp;</th>
      <td class="negromid">Generar C&oacute;digo</td>
      <td colspan="2" valign="middle" class="codigos"><a href="javascript:ventanaSecundaria3('/sima/cargos/cBarraSubeVentana.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"><img src="/sima/imagenes/barcode.gif" width="89" height="68" border="0" /></a>(Click en la imagen para generar el Codigo de Barra)</td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th scope="col">&nbsp;</th>

      <td><span class="negromid">Agregar Precios -Almacen:</span></td>
      <td colspan="2"><label></label>
          <label><a href="javascript:ventanaSecundaria('/sima/cargos/listaAlmacenesTodos.php?keyPA=<?php echo $myrow['keyPA']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"> <img src="/sima/imagenes/Save.png" alt="Almacenes" width="20" height="20" border="0" /></a></label></td>
    </tr>
 

    <tr bgcolor="#CCCCCC">
      <th width="3" scope="col">&nbsp;</th>
      <td colspan="3" bordercolor="#FFFFFF"><div align="center"><span class="style13"></span> <br />
        <input name="random" type="hidden" class="style12" id="random" value="<?php echo rand(50000,5000000);?>" />
              <input name="keyPA" type="hidden" class="style12" id="borrar" value="<?php echo $myrow['keyPA']; ?>" />
      </div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center" class="style12">
          <label></label>
          <label></label>
          <p>
            <label></label>
            <img src="/sima/imagenes/bordestablas/borde2.png" width="550" height="22" /></p>
      </div></td>
    </tr>
  </table>
</form>
<table width="348" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="115" align="right"><div align="center">
      <input name="nuevo2" type="image" src="/sima/imagenes/bordestablas/btns/newbtn.png" id="nuevo2" value="Nuevo" <?php echo $r;?> /></td>
    <td width="118" align="right"><div align="center">
      <input name="actualizar2" type="image" src="/sima/imagenes/bordestablas/btns/refreshbtn.png"  id="actualizar2" value="Actualizar/Grabar" />
    </div></td>
    <td width="115" align="right"><div align="center">
      <input name="borrar2" type="image" src='/sima/imagenes/bordestablas/btns/deletebtn.png' id="borrar2" value="Borrar" />
    </div></td>
  </tr>
  <tr>
    <td align="right"><div align="center" class="codigos">Nuevo</div></td>
    <td align="right"><div align="center" class="codigos">Actualiza</div></td>
    <td align="right"><div align="center" class="codigos">Elimina</div></td>
  </tr>
</table>
<p>&nbsp;</p>
<div align="center" class="negro"><a href="precios.php">Regresar al listado de art&iacute;culos</a> </div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>


<?php 
}
}
?>
