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
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
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
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
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
<style type="text/css">
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
-->
</style>
</head>



<META HTTP-EQUIV="Refresh"
CONTENT="100"> 
<body>




 <form id="form1" name="form1" method="post" action="#">
  <h1 align="center"><?php echo $titulo;?></h1>
  <p align="center">&nbsp;<em>Escoje el MiniAlmac&eacute;n a Surtir</em>    
  
  
<?php 
$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$ALMACEN."'
and
almacenConsumo='si'

 order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino1"  id="almacenDestino1" onChange="javascrip65.35t:this.form.submit();"/>
					<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino1']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
  </p>
  
  <p align="center">
   <a href="#"  onClick="javascript:ventanaSecundaria('/sima/cargos/despliegaSD.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacenDestino=<?php echo $bali; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&paciente=<?php echo $myrow8a['paciente'];?>&usuario=<?php echo $myrow['usuario'];?>')">
  Re-imprimir
  </a>
  </p>
  
  <table width="537" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="6"><img src="../../imagenes/bordestablas/borde1.png" width="540" height="21" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="53" class="negromid">Folio</td>
      <td width="272" class="negromid">Nombre Paciente </td>
      <td width="215" class="negromid">Procedencia</td>
      <td width="215" class="negromid">Usuario</td>
      <td width="215" class="negromid">Cubiculo</td>
    </tr>
<?php	
$sSQL= "
SELECT *
FROM
cargosCuentaPaciente 
where
(
entidad='".$entidad."'
and

almacenDestino='".$bali."'
and
statusCargo='standby'
and
(folioVenta!='' and folioVenta!='0')

and
(keyClientesInternos!='' and keyClientesInternos!='0')
and
naturaleza='C'
and
tipoPaciente='interno'
and
numSolicitud!=''
)
or
(
entidad='".$entidad."'
and
status='devolucion'
and
statusDevolucion='si'
and
almacenDestino='".$bali."'
and
statusCargo='standby'
and
(folioVenta!='' and folioVenta!='0')

and
(keyClientesInternos!='' and keyClientesInternos!='0')
and
naturaleza='A'
and
tipoPaciente='interno'
and
numSolicitud!=''
)


group by numSolicitud
order by keyCAP ASC";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 


$fV[0]=$myrow['folioVenta'];

$sSQL8a= "
SELECT paciente,cuarto,almacen
FROM
clientesInternos
WHERE
folioVenta='".$fV[0]."'";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);


$sSQL8ab= "
SELECT descripcion
FROM
almacenes
WHERE almacen='".$myrow8a['almacen']."'";
$result8ab=mysql_db_query($basedatos,$sSQL8ab);
$myrow8ab = mysql_fetch_array($result8ab);
	  ?>
	  
	  <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
      <td height="48" class="codigos"><?php echo $myrow['folioVenta'];?></td>
      <td class="normalmid"><span class="normal"><a href="#"  onclick="javascript:ventanaSecundaria('/sima/cargos/despliegaSolicitudesDirectas.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacenDestino=<?php echo $bali; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&paciente=<?php echo $myrow8a['paciente'];?>&usuario=<?php echo $myrow['usuario'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')">
        <?php 

		echo $myrow8a['paciente'];
		?>
      </a> <span class="Estilo1">
      <?php 
	  if($myrow['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Se solicito devolucion]';
	  }
	  ?>
      </span> </span></td>
      <td class="normal"><?php 
echo $myrow8ab['descripcion'];
?></td>
      <td class="normal"><?php echo $myrow['usuario'];?></td>
      <td class="normal"><?php echo $myrow8a['cuarto'];?></td>
    </tr>
    <?php  }?>
    <tr>
      <td colspan="6"><img src="../../imagenes/bordestablas/borde2.png" width="540" height="20" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center"><span class="style7">
    
  </span></p>
</form>
</body>
</html>
<?php 
 }//cierra funcion
 }//ciera clase
?>