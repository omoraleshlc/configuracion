<?php class articulos{
public function catalogoArticulos($entidad,$usuario,$codigo,$fecha1,$basedatos){
?>


<?php
$sSQL2a1= "Select * From modulosGrupos WHERE  clasificacion='MAT'  ";
$result2a1=mysql_db_query($basedatos,$sSQL2a1);
$myrow2a1 = mysql_fetch_array($result2a1);
if($myrow2a1['clasificacion']=='MAT'){

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
where entidad='".$entidad."'
";
$result122=mysql_db_query($basedatos,$sSQL122);
$myrow122 = mysql_fetch_array($result122);
  $agrega = "INSERT INTO articulos (
codigo,descripcion,descripcion1,um,gpoProducto,
usuario,fecha,cbarra,laboratorio,sustancia,activo,umVentas,
ventaPieza,observaciones,cajaCon,hora,entidad,generico,servicio,paquete,random,
caducidad,maquilado,grupo) 
values ('".$myrow122['ultimoDigito']."','".$_GET['descripcion']."','".$_GET['descripcion1']."','".$_GET['um']."','".$_GET['gpoProducto']."',
'".$usuario."','".$fecha1."',
'".$_GET['cbarra']."','".$_GET['laboratorio']."','".$_GET['sustancia']."','A','".$_GET['umVentas']."',
'".$_GET['ventaPieza']."','".$_GET['observaciones']."','".$_GET['cajaCon']."','".$hora1."','".$entidad."',
'".$_GET['generico']."','no','".$_GET['paquete']."','".$_GET['random']."',
'".$_GET['caducidad']."','".$_GET['maquilado']."','".$_GET['grupo']."' )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//******************ASIGNAR ARTICULOS ALMACENES******************
$sSQL3ab= "Select keyPA From articulos WHERE entidad='".$entidad."' and codigo='".$myrow122['ultimoDigito']."'  ";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);

$sSQL3a= "Select almacen From almacenes WHERE entidad='".$entidad."' and centroDistribucion='si'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);

  $q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow122['ultimoDigito']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '1','1.10', '".$id_medico[$i]."','".$myrow3ab['keyPA']."','".$myrow3a['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();


  $agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,keyPA,descripcion,tipoVenta,existencia,cantidadTotal,anaquel,cantidadSurtir,cantidadIndividual
) values (
'".$myrow122['ultimoDigito']."',
'".$myrow3a['almacen']."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$myrow3ab['keyPA']."','".$_GET['descripcion']."','','','','".$anaquel[$i]."','',''

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***********************************************************

?>

<script>
window.alert( "ARTICULO <?php echo $_GET['descripcion'];?> AGREGADO... ");
</script>
<?php
} else {
 $q1 = "UPDATE articulos set 
grupo='".$_GET['grupo']."',     
 maquilado='".$_GET['maquilado']."',
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
<title></title>
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>

<form id="form1" name="form1" method="GET" action="" />
  <div align="center" ><br />
    Alta/Modifica de Materiales<br />
</div>


  <div align="center" >
    <p>
    <table width="348" >
<tr>
         
       
        
    <td width="115" align="right">
      <input name="nuevo"  type="submit" src="/sima/imagenes/bordestablas/btns/newbtn.png" id="nuevo" value="Nuevo" <?php echo $r;?> />
     </td>
    <td width="118" align="right"><div align="center"><input name="actualizar"   type="submit" src="/sima/imagenes/bordestablas/btns/refreshbtn.png"  id="actualizar" value="Actualizar/Grabar" />
    </div></td>
    <td width="115" align="right"><div align="center"> <input name="borrar"  type="submit" src='/sima/imagenes/bordestablas/btns/deletebtn.png' id="borrar" value="Borrar" /></div></td>
  </tr>

</table>
    </p>
  </div>

  <table width="516" class="table-forma" >
    <tr >
      <td width="4"  bgcolor="">&nbsp;</td>
      <td width="148" ><label> </label>
          <div align="left" >Descripci&oacute;n:</div>
      <span > </span></td>
      <td width="359" ><?php $descripcion = $myrow['descripcion'];?>
      <textarea name="descripcion" cols="50" rows="3"  id="descripcion"><?php echo $descripcion?></textarea></td>
      <td width="19" ><label> </label>
      <div align="left"></div></td>
    </tr>

      
      
      
      
      
 
              
              
    <tr >
      <td >&nbsp;</td>
      <td >Unidad de Medida </td>
      <td ><label>
        <?php //*********Unidades de Medida
	 


 $sSQL71= "Select * From unidadMedida
where entidad='".$entidad."' 

 ORDER BY descripcionUM ASC ";
$result71=mysql_db_query($basedatos,$sSQL71); 


	  ?>
        <select name="um"  >
          <?php  	 		 
		   while($myrow71 = mysql_fetch_array($result71)){ ?>
          <option
		    <?php if($myrow['um']==$myrow71['codigoUM']){ echo 'selected=""';} ?>
		   value="<?php echo $myrow71['codigoUM']; ?>"><?php echo $myrow71['descripcionUM']; ?></option>
          <?php } ?>
        </select></br>

            
           
      <a href="javascript:ventanaSecundaria4(
		'../ventanas/catalogoUM.php?codigoUM=<?php echo $myrow71['codigoUM']; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "cbarra"; ?>')">Editar</a>
</td>
 <td ><label></label></td>
 <td ><label></label></td>

    </tr>       
      
      
      
      
      
      
      
      
      
    <tr >
      <td>&nbsp;</td>
      <td ><span >C&oacute;digo Barra:</span></td>
      <td ><input name="cbarra" type="text"  id="cbarra" value="<?php echo $myrow['cbarra']; ?>" size="40"  autocomplete="off"/>
      <a href="javascript:ventanaSecundaria4(
		'/sima/cargos/agregaCB.php?descripcion=<?php echo $descripcion; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "cbarra"; ?>')">Adjuntar</a></td>

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
      <tr >
      <td scope="col">&nbsp;</td>
      <td >La caja contiene: (Opcional)</td>
      <td colspan="2" valign="middle" ><label>
        <input type="text" name="cajaCon" value="<?php echo $myrow['cajaCon']; ?>" size="10"  />
      </label></td>
    </tr>
    
    
    <tr >
      <td scope="col">&nbsp;</tdh>
      <td >Grupo  </td>
      
      
      <td colspan="2" valign="middle" ><label>
        
              <select name="grupo" >
                  <option value="">Escoje</option>
                  
                  <option
                      <?php if($myrow['grupo']=='I'){echo'selected=""';}?>
                      value="I">I</option>
                      
                  
                  <option
                      <?php if($myrow['grupo']=='II'){echo'selected=""';}?>
                      value="II">II</option>
                       
                                    
                      <option
                      <?php if($myrow['grupo']=='III'){echo'selected=""';}?>
                      value="III">III</option>
                                                      
                     <option
                      <?php if($myrow['grupo']=='IV'){echo'selected=""';}?>
                      value="IV">IV</option>
                                                                                    
                        <option
                      <?php if($myrow['grupo']=='V'){echo'selected=""';}?>
                      value="V">V</option>
                                                  
                                                                     <option
                      <?php if($myrow['grupo']=='VI'){echo'selected=""';}?>
                      value="VI">VI</option>
                                                                         
                                                        
                                                        
              </selected>
          
           
              
              
              
      </label></td>
      <td  >&nbsp;</td>
    </tr>    
    

    <tr >
      <td>&nbsp;</td>
      <td  >Generar C&oacute;digo:</td>
      <td  ><a href="javascript:ventanaSecundaria3('/sima/cargos/cBarraSubeVentana.php?codigo=<?php echo $_POST['codigo']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"><img src="/sima/imagenes/barcode.gif" width="89" height="68" border="0" /></a>(Click en la imagen para Generar)</td>
      <td >&nbsp;</td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td >Producto Maquilado?</td>
      <td >
        <input name="maquilado" type="checkbox" id="maquilado" value="si"  <?php if( $myrow['maquilado']){ echo 'checked=""';} ?> />
        
		<?php if( $myrow['maquilado']=='si'){ ?>
		<label>
		<a href="javascript:ventanaSecundaria('/sima/cargos/articulosMaquilados.php?keyPACOM=<?php echo $myrow['keyPA']; ?>&descripcion=<?php echo $myrow['descripcion'];?>')">
		<img src="/sima/imagenes/Save.png" alt="Almacenes" width="20" height="20" border="0" />
		</a>
		</label>
		
		<?php echo '<span >'.'[Agregar articulos que componen este producto]'.'</span>'; ?>

		<?php } ?>
		</td>
      <td >&nbsp;</td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td >Caducidad</td>
      <td >
	  <input name="caducidad" type="text"  id="caducidad" value="<?php echo $myrow['caducidad']; ?>" size="9" maxlength="9"  autocomplete="off"/>
	  <br />
	    Favor de respetar este formato de fecha para la caducidad: <?php echo '<span ><blink>'.$fecha1.'<blink></span>';?>	  </td>
      <td >&nbsp;</td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <?php 

	
	if($myrow['codigo']){ ?>
      <td ><span >Precios-Almacen:</span></td>
      <td >
        <a href="javascript:ventanaSecundaria('/sima/cargos/listaAlmacenesTodos.php?keyPA=<?php echo $myrow['keyPA']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"><img src="/sima/imagenes/Save.png" alt="Almacenes" width="20" height="20" border="0" /></a></td>
      <td >&nbsp;</td>
    </tr>

    <?php } ?>

    <tr >
      <td colspan="4">       
 
          <input name="random" type="hidden"  id="random" value="<?php echo rand(50000,5000000);?>" />
          <input name="keyPA" type="hidden"  id="borrar2" value="<?php echo $myrow['keyPA']; ?>" /></td>
    </tr>
</table>


          <input name="warehouse" type="hidden"  id="random" value="<?php echo $_GET['warehouse'];?>" />
          <input name="main" type="hidden"  id="borrar2" value="<?php echo $_GET['main']; ?>" />
</form>
<div align="center"><a href="precios.php">Regresar al listado de art&iacute;culos</a> </div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>


<?php 
}
}
?>