<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","width=700,height=500,scrollbars=YES")
}
</script>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

	echo '<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>';
echo '<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />';
?>

</head>

<body>
<h1 align="center" class="titulos">Bloquear Expedientes - Aseguradoras </h1>
<?php echo $leyenda; ?>
<div align="center"></div>
<form name="form2" id="form2" method="post" >
  <table width="600" class="table-forma" >
    <tr valign="middle" >
      <th colspan="3"><div align="center" >Datos del Paciente </div></th>
    </tr>
    <tr valign="middle" >
      <td height="49" colspan="3" ><div align="center">N&deg; Exp. Apellido o Nombre</div></td>
    </tr>
    <tr valign="top"  >
      <td width="185" height="36" ><input name="numeroEx" type="hidden"  id="numeroEx" value="<?php if($_POST['numeroEx'] and !$_POST['nuevo']){ echo $_POST['numeroEx'];}?>" readonly="" /></td>
      <td width="240" ><span >
        <input name="paciente" type="text"  id="paciente"  size="60" onChange="this.form.submit();">
      </span></td>
      <td width="97" ><label></label>
      &nbsp;</td>
    </tr>
  </table>
</form>
<form id="form1" name="form1" method="post" action="" >
<?php


if($_POST['numeroEx']){
$sSQL= "
SELECT * from pacientes where entidad='".$entidad."'
and
numCliente='".$_POST['numeroEx']."'
";



$result=mysql_db_query($basedatos,$sSQL);

?>

 <br /><br />
  <table width="621" class="table table-striped">
    <tr >
      <th width="57"    scope="col"><div align="left" >Exp</div></th>
      <th width="269"   scope="col"><div align="left" >Paciente</div></th>
      <th width="81"   scope="col">Usuario</th>
      <th width="83"   scope="col">Fecha </th>
      <th width="109"  scope="col"><div align="center" >Editar</div></th>
    </tr>

        <?php

while($myrow = mysql_fetch_array($result)){


?>
<tr  >
        <td height="32" bgcolor="<?php echo $color;?>" >

		 <?php echo $myrow['numCliente'];?>		  </td>
          <td bgcolor="<?php echo $color;?>" >
            <?php
		echo $myrow['nombreCompleto'];

		?>
          </span></span></span></td>
          <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
            <?php
		echo $myrow['usuario'];

		?>
          </span></div></td>
          <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
            <?php
			if ($myrow['fechaCreacion']){
		echo $myrow['fechaCreacion'];
		}
		else{
		 echo $myrow['fechaModificacion'];
		}
		?>
          </span></div></td>
        <td bgcolor="<?php echo $color;?>" ><div align="center"><span >


          <a href="javascript:ventanaSecundaria1('../cargos/aplicarBloqueo.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/btns/editbtn.png" alt="Datos Generales del Paciente" width="22" height="22" border="0" />          </a>

        </span></div></td>
    </tr>

      <?php }}?>
  </table>
  
</form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
	    <script>
		new Autocomplete("paciente", function() {
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
			}

			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");

			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick )
				return ;

			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/pacientesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>
</body>
</html>