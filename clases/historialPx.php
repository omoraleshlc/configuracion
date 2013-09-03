<?php 
class historialPacientesC{ 
public function historialPacientes($entidad,$TITULO,$basedatos){ 
?>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=800,height=750,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=600,height=750,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<head>
<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
	</head>
<body>


   <h4 align="center"><?php echo $TITULO;?></h4>
<form id="frmSearch" action="" method="post" name="frmSearch">
 <div align="center">
   <table width="200" border="0">
     <tr>
       <td>Paciente</td><input type="hidden" name="numeroE" id="numeroE" />
       <td><span id="sprytextfield1">
         <label>
         <input type="text" name="paciente" id="paciente" />
         </label>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><label>
         <input type="submit" name="button" id="button" value="Buscar" />
         <span class="style7">
         <input name="expediente" type="hidden" id="expediente" value="<?php echo $_POST['expediente'];?>" />
         </span></label></td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </div>
    
</form>

 <p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="modificaPacientes.php">
  <table width="365" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th width="71" class="style12" scope="col"><div align="left"><span class="style11 style13"># Paciente </span></div></th>
      <th class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
    </tr>
    <tr>
      <?php	

 $apellido3=$_POST['txtSearch'];
//$apellido3=substr($apellido3,"0","6");
$apellido3=trim($apellido3);

if($apellido3){
$sSQL= "SELECT *
  FROM
pacientes
WHERE 
entidad='".$entidad."'
AND
numCliente like '%$apellido3%'
or 
nombreCompleto like '%$apellido3%'

 ";

 
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];
	  $E=$myrow['numCliente'];
	  
	  
$sSQL3= "Select * From clientesInternos WHERE numeroE = '".$E."' order by nCuenta DESC ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);	  

	  ?>

<td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
     <?php echo $E?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
<?php 	  if($myrow3['keyClientesInternos']) { ?>
	   <a href="#" rel="htmltooltip" onClick="javascript:ventanaSecundaria('/sima/consultas/consultaEC.php?nT=<?php echo $myrow3['keyClientesInternos']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;basedatos=<?php echo $basedatos; ?>&amp;seguro=<?php echo $N; ?>&amp;numCliente=<?php echo $N?>')">	  <?php echo $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];?>
	  </a>
	  <?php } else { ?>
	  <?php echo $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];?>
	  <?php } ?>
	  </span>        <div align="center">	  <a href="javascript:ventanaSecundaria3('modificarP.php?numeroExpediente=<?php echo $myrow['numCliente']; ?>')">	  </a></div></td>
    </tr>
    <?php  }}}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
</form>
<p>&nbsp; </p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>

  <script>
		new Autocomplete("expediente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("paciente")[0].value = id;
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
			return "/sima/cargos/pacientesQuery.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>

</html>
<?php 
 } 
} ?>