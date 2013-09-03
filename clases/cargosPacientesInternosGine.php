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
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la cuenta de este paciente a admisiones? ya no podras hacer cargos, y la operación es irreversible')) return true;
return false;
}
-->
</script>

<?php  
if(is_numeric($_GET['rand']) AND $_GET['cierre']=='si' ){

$sSQL31= "SELECT statusCuenta FROM
clientesInternos
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($myrow31['statusCuenta']=='abierta' or $myrow31['statusCuenta']=='revision' or $myrow31['statusCuenta']=='caja'){

if($_GET['tipoCierre']=='revision' and $myrow31['statusCuenta']=='abierta'){
  $q = "UPDATE clientesInternos set 
statusCuenta='revision'

 WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' and statusCuenta!='cerrada'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
} else if($_GET['tipoCierre']=='caja' and $myrow31['statusCuenta']=='revision') {
 $q = "UPDATE clientesInternos set 
statusCuenta='caja'
 WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' and statusCuenta!='cerrada'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}
}
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

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="100"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos">Solicitudes a Pacientes Internos</h1>
  <p align="center" class="titulos">&nbsp;</p>
  <table width="794" border="0.2" align="center">
    <tr bgcolor="#330099">
      <th width="49" class="style12" scope="col"><div align="left" class="blanco">
        <div align="center">Folio </div>
      </div></th>
      <th class="style12" scope="col"><div align="left" class="blanco">
        <div align="center">Nombre del paciente</span></div>
      </div></th>
      <th class="style12" scope="col"><div align="left" class="blanco">
        <div align="center">Seguro</div>
      </div></th>
      <th class="style12" scope="col"><div align="center" class="blanco">
        <div align="center">Cub&iacute;culo</span></div>
      </div></th>
      

      <th class="style12" scope="col"><div align="center" class="blanco">
        <div align="center">Dar de Alta</div>
      </div></th>
      <th class="style12" scope="col"><div align="center" class="blanco">Edo. Cta</div></th>
      <th class="style12" scope="col"><div align="left" class="blanco">
        <div align="center">Solicitar</span></div>
      </div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
almacen='".$ALMACEN."'
and
(status='activa' or status='ontransfer' )
and 

(statusCuenta = 'abierta')
and
tipoPaciente='interno'
and

(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY folioVenta ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);






$sSQL31c= "SELECT keyCAP FROM
cargosCuentaPaciente
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'
and
statusCargo!='cargado'
";
$result31c=mysql_db_query($basedatos,$sSQL31c);
$myrow31c = mysql_fetch_array($result31c);

$sSQL31cd= "SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['seguro']."' 
";
$result31cd=mysql_db_query($basedatos,$sSQL31cd);
$myrow31cd = mysql_fetch_array($result31cd);
?>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >   

    <td height="24" bgcolor="<?php echo $color?>" class="codigos"><div align="left"><?php echo $myrow['folioVenta'];?></span></div></td>

    <td width="243" bgcolor="<?php echo $color?>" class="normal">

    <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicitó la transferencia de éste paciente]';
	  }
	 ?>
      </span></td>
      <td width="202" bgcolor="<?php echo $color?>" class="normal"><?php 
	  if($myrow31cd['nomCliente']){
	  echo $myrow31cd['nomCliente'];
	  } else {
	  echo 'particular';
	  }
?></td>
      <td width="60" bgcolor="<?php echo $color?>" class="normal"><div align="center"><?php echo $myrow['cuarto']
?></span></div></td>
    
	
	  
      
    
      <td width="77" bgcolor="<?php echo $color?>" class="style12"><div align="center">
        <?php if( $myrow['statusCuenta']=='abierta'){ ?>
        <a href="pacientesInternos.php?rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=revision" onClick="return comprueba();"> <img src="/sima/imagenes/btns/reservbtn.png" alt="Aplicar Cargos" width="22" height="22" border="0" /></a>
        <?php } else if($myrow['statusCuenta']=='revision'){ ?>
        <a href="pacientesInternos.php?rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=caja" onClick="return comprueba();"> <img src="/sima/imagenes/lupa.jpeg" alt="Aplicar Cargos" width="22" height="22" border="0" /></a>
        <?php } else {
		  
		  echo '---';
		  } ?>
</div></td>
      <td width="71" bgcolor="<?php echo $color?>" class="style12"><div align="center"><a href="#" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/edocta.png" alt="Lista de Cargos..." width="22" height="22" border="0" /></a></div></td>
      
      <td width="62" bgcolor="<?php echo $color?>" class="style12" align="center">
      <?php if($myrow['statusCuenta']!='revision'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria2('/sima/cargos/solicitaArticulos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/addbtn.png" alt="Aplicar Cargos" width="24" height="24" border="0" /></a>
        <?php } else { echo '---';}?>        </td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>

</form>
</body>
</html>