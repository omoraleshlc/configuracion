<?php 
class  catalogosS{
public function catalogosServicios($entidad,$almacenSolicitante,$usuario,$fecha1,$basedatos){
?>


<?php
$sSQL2a1= "Select * From modulosGrupos WHERE clasificacion='cIVA'  ";
$result2a1=mysql_db_query($basedatos,$sSQL2a1);
$myrow2a1 = mysql_fetch_array($result2a1);
if($myrow2a1['clasificacion']=='cIVA'){

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
$fecha1=date("Y-m-d");


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
where 
entidad='".$entidad."'
";
$result122=mysql_db_query($basedatos,$sSQL122);
$myrow122 = mysql_fetch_array($result122);
  $agrega = "INSERT INTO articulos (
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,servicio,paquete,random,especialidad,laboratorioReferido,referido,id_cuarto,departamento,cargosDirectos) 
values ('".$myrow122['ultimoDigito']."','".$_GET['descripcion']."','".$_GET['descripcion1']."','".$_GET['um']."','".$_GET['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_GET['cbarra']."','".$_GET['laboratorio']."','".$_GET['sustancia']."','A','".$_GET['umVentas']."',
'".$_GET['ventaPieza']."','".$_GET['observaciones']."','".$_GET['cajaCon']."','".$hora1."','".$entidad."',
'".$_GET['generico']."','no','".$_GET['paquete']."','".$_GET['random']."','".$_GET['especialidad']."','".$_GET['referido']."','".$_GET['referido']."','".$_GET['id_cuarto']."','".$_GET['departamento']."','".$_GET['cargosDirectos']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



?>

<script>
window.alert( "ARTICULO <?php echo $_GET['descripcion'];?> AGREGADO... ");
</script>
<?php
} else {
 $q1 = "UPDATE articulos set 
 cargosDirectos='".$_GET['cargosDirectos']."',
id_cuarto='".$_GET['id_cuarto']."',
departamento='".$_GET['departamento']."',
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
paquete='".$_GET['paquete']."',
especialidad='".$_GET['especialidad']."',
referido='".$_GET['referido']."',
laboratorioReferido='".$_GET['referido']."'
WHERE keyPA='".$_GET['keyPA']."'";
mysql_db_query($basedatos,$q1);
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
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<h1 align="center">SERVICIOS HOSPITALARIOS
</h1>
<form id="form1" name="form1" method="GET" action=""/>
  
  <table width="586" class="table-forma">
    <tr>
      <td width="2"  scope="col">&nbsp;</td>
      <td width="210" >
        <label>
        
        <div align="left" >Descripci&oacute;n:</div>
        <span >
        </label>
      </span></td>
      <td width="360"><label>
        <div align="left">
<textarea name="descripcion" cols="40" rows="3"  id="descripcion"><?php 
if($myrow['descripcion']){
echo $myrow['descripcion'];
} else {
echo $_GET['descripcion'];
}
?></textarea>
        </div>
      </label></td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td ><div align="left" >Descripci&oacute;n (Impresi&oacute;n en Factura):</div></td>
      <td ><label>
        <input name="descripcion1" type="text"  id="descripcion1" value="<?php 
		if($myrow['descripcion1']){
		echo $myrow['descripcion1'];
		} else {
		echo $_GET['descripcion1'];		
		}?>" size="60" />
      </label></td>
    </tr>
	<tr>
	  <td  scope="col">&nbsp;</td>
	  <td ><span >&iquest;Es un paquete? </span></td>
	  <td>   <input name="paquete" type="checkbox" id="referido" value="si"
		<?php if($myrow['paquete']=='si' or $_GET['paquete']=='si'){
		echo 'checked="checked"';
		}
		?>/>	 </td>
    </tr>
	<tr>
	  <td  scope="col">&nbsp;</td>
	  <td ><span >&iquest;Permite Cargos Directos? </span></td>
	  <td><span >
	    <input name="cargosDirectos" type="checkbox" id="cargosDirectos" value="si" <?php 
		if($myrow['cargosDirectos']=='si' or $_GET['cargosDirectos']=='si'){
		echo 'checked=""';
		} 
		?> />
	  </span></td>
    </tr>
	<tr>
	  <td  scope="col">&nbsp;</td>
	  <td ><span >Departamento (Solo si es un cuarto)</span></td>
	  <td><span >
	    <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->almacenesCuartosGET($entidad,'style12',$myrow['departamento'],$almacenDestino,$basedatos);

?>
	  </span></td>
    </tr>
	
    
    
    
    <?php if($_GET['departamento'] or $myrow['id_cuarto']){ ?>
    <tr>
	  <td  scope="col">&nbsp;</td>
	 <td ><span >Cuarto</span></td>
    <td><span >
	    <?php
$cuartosGET=new comboAlmacen();
$cuartosGET->cuartosGET($entidad,$estilos,$myrow['id_cuarto'],$_GET['departamento'],$myrow['departamento'],$basedatos);
?>
	  </span></td>
    </tr>
	<tr>
    <?php } ?>
    
    
	  <td width="2"  scope="col">&nbsp;</td>
	
	<?php if($myrow['keyPA']){ ?>
      <td ><span >Agregar Precios-Almacen</span></td>
      <td>
 &nbsp;
   
<a href="javascript:ventanaSecundaria('/sima/cargos/listaAlmacenesTodos.php?codigo=<?php echo $myrow['codigo']; ?>&keyPA=<?php echo $myrow['keyPA']; ?>&activar=si&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"><img src="/sima/imagenes/Save.png" alt="Almacenes" width="20" height="20" border="0" /></a>    </td>
    </tr>
    <?php } ?>



</table>
 <br />
         <input name="nuevo" type="submit"  id="nuevo" value="Nuevo" <?php echo $r;?> />
        <input name="main" type="hidden"  id="nuevo" value="<?php echo $_GET['main'];?>"  />
        <input name="warehouse" type="hidden"  id="nuevo" value="<?php echo $_GET['warehouse'];?>"  />
        <input name="borrar" type="submit"  id="borrar" value="Borrar" />
        <input name="random" type="hidden"  id="random" value="<?php echo rand(50000,5000000);?>" />
        <input name="keyPA" type="hidden"  id="borrar2" value="<?php echo $myrow['keyPA']; ?>" />
        <input name="actualizar" type="submit"  id="actualizar" value="Actualizar/Grabar" />
</form>

<p>&nbsp;</p>


</body>
</html>

<?php
}
}
?>