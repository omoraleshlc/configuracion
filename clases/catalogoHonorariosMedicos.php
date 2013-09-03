<?php 
class  catalogosS{
public function catalogosServicios($entidad,$almacenSolicitante,$usuario,$fecha1,$basedatos){
?>


<?php
$sSQL2a1= "Select * From modulosGrupos WHERE  clasificacion='HONMED'  ";
$result2a1=mysql_db_query($basedatos,$sSQL2a1);
$myrow2a1 = mysql_fetch_array($result2a1);
if($myrow2a1['clasificacion']=='HONMED'){

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
codigo,descripcion,descripcion1,um,gpoProducto,usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,ventaPieza,observaciones,cajaCon,hora,entidad,generico,servicio,paquete,random,especialidad,laboratorioReferido,referido,procedimiento) 
values ('".$myrow122['ultimoDigito']."','".$_GET['descripcion']."','".$_GET['descripcion1']."','".$_GET['um']."','".$_GET['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_GET['cbarra']."','".$_GET['laboratorio']."','".$_GET['sustancia']."','A','".$_GET['umVentas']."',
'".$_GET['ventaPieza']."','".$_GET['observaciones']."','".$_GET['cajaCon']."','".$hora1."','".$entidad."',
'".$_GET['generico']."','no','".$_GET['paquete']."','".$_GET['random']."','".$_GET['especialidad']."','".$_GET['referido']."','".$_GET['referido']."','".$_GET['procedimiento']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



?>

<script>
window.alert( "ARTICULO <?php echo $_GET['descripcion'];?> AGREGADO... ");
</script>
<?php
} else {
 $q1 = "UPDATE articulos set 

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
laboratorioReferido='".$_GET['referido']."',
procedimiento='".$_GET['procedimiento']."'
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


</h1>
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

<form id="form1" name="form1" method="GET" action=""/>
<p align="center" >Catalogo de Honorarios Medicos</p>

<table width="630" class="table-forma">
    <tr>
      <td width="3" scope="col">&nbsp;</td>
      <td width="227" >
        <label>
        
        <div align="left" >Descripci&oacute;n</div>
        <span >
        </label>
      </span></td>
      <td width="386" ><label>
        <div align="left">
<textarea name="descripcion" cols="57" rows="3"  id="descripcion"><?php echo $descripcion = $myrow['descripcion']?></textarea>
        </div>
      </label></td>
    </tr>
    <tr>
      <td scope="col">&nbsp;</td>
      <td ><div align="left" >Descripci&oacute;n (Impresi&oacute;n en Factura):</div></td>
      <td ><label>
        <input name="descripcion1" type="text"  id="descripcion1" value="<?php echo $descripcion = $myrow['descripcion1']?>" size="60" />
      </label></td>
    </tr>
	<tr>
	  <td scope="col">&nbsp;</td>
	  <td ><span >&iquest;Es un paquete? </span></td>
	  <td >   <input name="paquete" type="checkbox" id="referido" value="si"
		<?php if($myrow['paquete']=='si' ){
		echo 'checked="checked"';
		}
		?>/>	 </td>
    </tr>
	<tr>
	  <td scope="col">&nbsp;</td>
	  <td ><span >Especialidad </span></td>
	  <td >
	  
	  
<?php 
require_once('/configuracion/componentes/comboEspecialidades.php');
$listaEsp=new especialidades();
$listaEsp->listaEspecialidadesMedicasSS($entidad,'style12',$myrow['especialidad'],$myrow['especialidad'],$basedatos);
?>	  </td>
    </tr>
	<tr>
	  <td scope="col">&nbsp;</td>
	  <td  >Procedimiento</td>
	  <td ><input name="procedimiento" type="checkbox" id="procedimiento" value="si"
		<?php if($myrow['procedimiento']=='si' ){
		echo 'checked="checked"';
		}
		?> /></td>
  </tr>
	<tr>
	  <td scope="col">&nbsp;</td>
	  <td  >Referido</span></td>
	  <td >
	  	    <input name="referido" type="checkbox" id="referido" value="si"
		<?php if($myrow['laboratorioReferido']=='si' ){
		echo 'checked="checked"';
		}
		?> />
	  &nbsp;</td>
    </tr>
	<tr>
	  <td width="3" scope="col">&nbsp;</td>

      <td  >Agregar Precios - Almacen</span></td>
      <td >
 

    <label>
    
    <a href="javascript:ventanaSecundaria('/sima/cargos/listaAlmacenesTodos.php?codigo=<?php echo $myrow['codigo']; ?>&keyPA=<?php echo $myrow['keyPA']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&activar=si')"><img src="../imagenes/Save.png" alt="Almacenes" width="20" height="20" border="0" />          </a>          </label></td>
    </tr>
   



</table><br />
        <input name="nuevo" type="submit"  id="nuevo" value="Nuevo" <?php echo $r;?> />
        <input name="borrar" type="submit"  id="borrar" value="Borrar" />
        
        <input name="random" type="hidden"  id="random" value="<?php echo rand(50000,5000000);?>" />
          <input name="keyPA" type="hidden"  id="borrar2" value="<?php echo $myrow['keyPA']; ?>" />
        <input name="actualizar" type="submit"  id="actualizar" value="Actualizar/Grabar" />
        <br /><br />

        <input name="main" type="hidden" class="boton1" id="nuevo" value="<?php echo $_GET['main'];?>"  />
        <input name="warehouse" type="hidden" class="boton1" id="nuevo" value="<?php echo $_GET['warehouse'];?>"  />
</form>
<div align="center"><a href="listadoProcedimientos.php">Regresar a Listado de Servicios </a>
</div>
</body>
</html>

<?php
}
}
?>