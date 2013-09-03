<?php 
class solicitudesAlmacenes{
public function despliegaSolicitudes($entidad,$titulo,$bali,$basedatos){

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
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<body>



 <?php require("/configuracion/componentes/comboAlmacen.php"); ?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos"><?php echo $titulo;?></h1>
  <p align="center">&nbsp;<em>Escoje el MiniAlmac&eacute;n a Surtir</em>    <?php 
$comboAlmacen1=new comboAlmacen();
$comboAlmacen1->despliegaMiniAlmacen($entidad,'style7',$bali,$almacenDestino,$basedatos);



if(!$bali){

$bali=$_POST['almacenDestino1'];
}
?>
  </p>
  <table width="551" border="0.2" align="center">
    <tr>
      <th width="61" bgcolor="#660066" class="style12" scope="col"><div align="left" class="blancomid">N&deg; Cta.</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blancomid">Nombre del paciente:</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blancomid">Dpto. Solicita</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blancomid">Cuarto</div></th>
    </tr>
    <tr>
	<?php	

$sSQL= "SELECT *
FROM
cargosCuentaPaciente 
where
entidad='".$entidad."'
and
almacenDestino='".$bali."'
and
statusCargo='standby'
and
folioVenta!=''
order by keyCAP ASC

 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


	  ?>
      <td height="24" bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow['keyClientesInternos'];
?></span></td>
      <td width="288" bgcolor="<?php echo $color?>" class="normalmid">
	  <a href="#" onClick="javascript:ventanaSecundaria('/sima/cargos/despliegaSolicitudesDirectas.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&numeroE=<?php echo $myrow['numeroE']; ?>
		&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&almacenDestino=<?php echo $bali; ?>')"><?php echo $myrow['paciente'];?></a>
      </span></td>
      <td width="138" bgcolor="<?php echo $color?>" class="normalmid">
<?php 
$almacenSolicitante=new nombreDepartamento();
$almacenSolicitante->nombre($myrow['almacenSolicitante'],$basedatos);

?></span></td>
      <td width="46" bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow['cuarto']
?></span></td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="normal">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
  <input name="almacen1" type="hidden" id="almacen1" value="<?php echo $_POST['almacen']; ?>" />
  <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_POST['almacen1']; ?>" />
  <input name="almacen3" type="hidden" id="almacen3" value="<?php echo $_POST['almacen2']; ?>" />
  <input name="almacen" type="hidden" id="almacen3" value="<?php echo $_POST['almacen3']; ?>" />
  <span class="style12"><span class="style7">
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente22" value="<?php echo $nombrePaciente; ?>"/>
</span></span>
</form>
</body>
</html>
<?php 
 }//cierra funcion
 }//ciera clase
?>