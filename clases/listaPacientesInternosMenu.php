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
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<body>
<?php require("/configuracion/funciones.php");//ventanasPrototype::links();?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos">Cargos a  Pacientes Internos </h1>
 
  <table width="439" border="0.2" align="center">
    <tr>
      <th width="77" bgcolor="#660066" class="style12" scope="col"><div align="left" class="blancomid"># Cuenta</div></th>
      <th width="270" bgcolor="#660066" class="style12" scope="col"><div align="left" class="blancomid">Nombre del paciente:</div></th>
      <th width="78" bgcolor="#660066" class="style12" scope="col"><div align="left" class="blancomid">Cuarto</div></th>
    </tr>
    <tr>
      <?php	
$almacenesCierreCuenta=new articulosDetalles();
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' AND
statusCuenta = 'abierta'
and
(status='activa' or status='ontransfer')
and 
(statusDeposito='pagado' or statusDeposito='cxc' or statusDeposito='urgencias')
and
tipoPaciente='interno' 
or 
(solicitaTransferencia='si' and almacenTransferencia!='')
ORDER BY keyClientesInternos ASC
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

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

	  ?>
      <td height="24" bgcolor="<?php echo $color?>" class="codigosmid"><?php echo $myrow['keyClientesInternos'];
?></td>
      <td width="270" bgcolor="<?php echo $color?>"  class="normalmid">
		  <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicitó la transferencia de éste paciente]';
	  }
if(	  $almacenesCierreCuenta->almacenesCierreCuenta($bali,$fecha1,$hora1,$usuario,$myrow['keyClientesInternos'],$entidad,$numeroE,$nCuenta,$basedatos)=='cargado'){
echo '<span class="style9">'.' [La Cuenta en este departamento ha sido Liberada]'.'</span>';
}
	  ?>
      </span></td>
      <td width="78" bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow['cuarto']
?></span></td>
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