<?php
class pacientesInternosPrepago{
public function listadoPIT($entidad,$TITULO,$ventana,$ventana1,$bali,$basedatos){
?>
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
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}
.style14 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style14 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style15 {color: #FFFFFF}
.style15 {color: #FFFFFF}
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center"><?php echo $TITULO;?></h1>
  <span class="style12"></span>
  <table width="417" border="0.2" align="center">
    <tr>
      <th width="50" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13"># Cuenta  </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente</span></div></th>
      <?php 
  if($ventana1){ ?>    <?php } ?>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Transfer</span></div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
status='prepago' 
and 

statusCuenta = 'abierta'
and
tipoPaciente='prepago'
and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


	  ?>
	  
<td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['keyClientesInternos'];
?></span></td>
      <td width="316" bgcolor="<?php echo $color?>" class="style12"><span class="style7"> 

	  <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicitó la transferencia de éste paciente]';
	  }
	  ?>
      </span></td>
      <?php if($ventana1){ ?>
	  <?php } ?>
		
      <td width="37" bgcolor="<?php echo $color?>" class="style12"><a href="#" onClick="javascript:ventanaSecundaria('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')">
	  <img src="/sima/imagenes/siguiente.png" alt="Aplicar Cargos" width="12" height="12" border="0" /></a></td>
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
<?php }
}
?>

































