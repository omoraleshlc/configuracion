 <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsación de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=600,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria112 (URL){ 
   window.open(URL,"ventanaSecundaria112","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que ya revisaste la cuenta? la operación es irreversible')) return true;
return false;
}
-->
</script>

<?php  
if(is_numeric($_GET['rand']) AND $_GET['cierre']=='si' ){

if($_GET['tipoCierre']=='final'){

$q = "UPDATE clientesInternos set 
statusCuenta='caja' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
} else if($_GET['tipoCierre']=='revisado'){
$q = "UPDATE clientesInternos set 
statusCuenta='final' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}


}
?>

<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="300"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos">Clasificar Cargos</h1>
  <p align="center" class="titulos">&nbsp;</p>
 
  
  <table width="537" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="4"><img src="../../imagenes/bordestablas/borde1.png" width="540" height="21" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="53" class="negromid"> F Venta</td>
      <td width="272" class="negromid">Datos Paciente</td>
      <td width="215" class="negromid">Aseguradora</td>
    </tr>
    <?php	

$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
(statusCuenta='activa' or statusCuenta='revision' or statusCuenta='final')
and
tipoPaciente='interno' 
and
folioVenta!='0'
and
seguro!=''
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];
	  ?>
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
      <td height="48" class="codigos"><?php echo $myrow['folioVenta'];
?></td>
      <td class="normalmid"><a href="javascript:nueva('/sima/cargos/discrimina1.php?folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>','ventana1','1024','1000','yes')"> <?php echo $myrow['paciente'];?></a>
          <span class="normal"> Departamento: </span><span class="negro">
<?php
$al=$myrow['almacen'];
$sSQL17= "
SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?>
            </span> </br>
          <span class="negro">Enviada por: </span><span class="codigos">
            <?php
echo $myrow['usuario'];
?>
          </span> </td>
      <td class="normal"><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "PARTICULAR";
		  }
?>
      </td>
    </tr>
    <?php  }}?>
    <tr>
      <td colspan="4"><img src="../../imagenes/bordestablas/borde2.png" width="540" height="20" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p class="style12">&nbsp;</p>
  <p class="style12"><span class="style7">
    <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
    <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
    <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
    </span>
    
  </p>
</form>
</body>
</html>