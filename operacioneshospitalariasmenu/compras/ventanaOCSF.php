<?php require('/configuracion/ventanasEmergentes.php'); include('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=900,height=800,scrollbars=YES") 
} 
</script> 




<?php 
if($_POST['aplicar'] ){

if($_POST['departamento'] and ($_POST['proveedor'] or $_POST['proveedor1']) and $_POST['id_factura'] and $_POST['fechaFactura'] and $_POST['importeFactura']){

//*********************************************
$sSQL333= "SELECT
sum(nEntrada)+1 as NS
FROM ingresoFactura
WHERE entidad='".$entidad."'";

$result333=mysql_db_query($basedatos,$sSQL333);
$myrow333 = mysql_fetch_array($result333);

if(!$myrow333['NS']){
$myrow333['NS']=1;
}

//********************************SE INCREMENTA EN 1*****************************
$agrega = "INSERT INTO ingresoFactura (
nEntrada,usuario,entidad
) values (
'".$myrow333['NS']."','".$usuario."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//**********************************************

?>
<script>
javascript:ventanaSecundaria('enviarSolicitud.php?almacen=<?php echo $_GET['almacenDestino1'];?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $almacen; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_GET['fechaSolicitud']; ?>&id_factura=<?php echo $_POST['id_factura']; ?>&proveedor=<?php echo $_POST['proveedor'];?>&departamento=<?php echo $_POST['departamento'];?>&req=<?php echo $myrow333['NS'];?>&importeFactura=<?php echo $_POST['importeFactura'];?>&ivaFactura=<?php echo $_POST['ivaFactura'];?>');
//window.alert("SE GENERO EL # DE REQUISICION: <?php echo $myrow333['NS'];?>");
window.close();
</script>

<?php 

}else{
print('Te faltan campos por llenar');
}
}
?>



 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />


    <style type="text/css">
<!--
.Estilo1 {font-size: 10}
.Estilo24 {font-size: 10px}
-->
    </style>
</head>

<body>
<form id="form2" name="form2" method="post" action="#">
  <p align="center" class="titulos">Solicitudes sin OC</p>
  <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
  
  <?php 
	  $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
centroDistribucion='si'";
$rCombo=mysql_db_query($basedatos,$aCombo); 
$resCombo = mysql_fetch_array($rCombo);


  ?>
<input name="departamento" type="hidden" value="<?php echo $resCombo['almacen'];?>" />
    <tr>
      <td colspan="3"><img src="../../imagenes/bordestablas/borde1.png" width="650" height="22" /></td>
    </tr>
    <tr>
      <td width="17" height="25" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="106" bgcolor="#CCCCCC" class="negromid">Proveedor
      <input name="proveedor" type="hidden" class="camposmid" id="proveedor"   
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
	 />
      </span></span></td>
      <td width="527" bgcolor="#CCCCCC"><input name="nombreProveedor" type="text" class="camposmid" id="nombreProveedor" value="" size="80" /></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><span class="negromid">Fecha</span></td>
      <td bgcolor="#CCCCCC"><span class="titulo">
        <label>
          <input  name="fechaFactura" type="text" class="normal" id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 echo $date;
		 ?>"/>
        </label>
        <input name="button" type="image" src="../../imagenes/calendario.png" class="normal" id="lanzador" value="..." />
      </span></td>
    </tr>


<tr>
      <td height="23" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><span class="negromid"># Factura</span></td>
      <td bgcolor="#CCCCCC"><input type="text" name="id_factura" id="id_factura" /></td>
    </tr>


    <tr>
      <td height="23" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><span class="negromid">Importe</span></td>
      <td bgcolor="#CCCCCC"><span class="negromid"><input type="text" name="importeFactura" id="importeFactura" /></span></td>
    </tr>

    <tr>
      <td height="23" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><span class="negromid">IVA</span></td>
      <td bgcolor="#CCCCCC"><span class="negromid"><input type="text" name="ivaFactura" id="ivaFactura" /></span></td>
    </tr>
    <tr>
      <td height="29" colspan="3" align="center" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><img src="../../imagenes/bordestablas/borde2.png" width="650" height="22" /></td>
    </tr>
  </table>
  <p align="center" class="titulos"><span class="negromid">
    <input name="aplicar" type="submit" id="aplicar" value="Generar Orden" />
  </span></p>
  
  
  <p align="center">&nbsp;</p>
</form>
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
<script>
		new Autocomplete("nombreProveedor", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("proveedor")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/proveedoresx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
