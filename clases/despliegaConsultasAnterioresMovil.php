<?php class despliegaCA{
public function consultasAnteriores($ventana,$TITULO,$numeroE,$basedatos){ ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=900,height=600,scrollbars=YES") 
} 
</script> 
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style13 {font-size: 10px}
.style12 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
-->
</style>
<p align="center"><?php echo $TITULO;?><a href="/sima/movil/principal.php"><span class="style7">Regresar a Men&uacute;</span></a></p>
<form name="form1" method="post" action="">
  <table width="568" border="0" align="center">
      <tr>
        <th width="86" height="16" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Fecha </span></div></th>
        <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Descripci&oacute;n</span></div></th>
        <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Depto.</span></div></th>
        <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">M&eacute;dico</span></div></th>
      </tr>
      <tr class="style7">
        <?php	
$sSQL= "SELECT almacen,codProcedimiento,keyCAP,ruta,fecha1,hora1,medico
FROM
cargosCuentaPaciente
WHERE 
statusEstudio='cargado'
and
numeroE='".$numeroE."' 
and
status!='transaccion'
and
statusCargo='cargado' 
and
um='s'
ORDER BY fecha1,hora1 DESC
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
$departamento=$myrow['almacen'];
$numeroE=$myrow['numeroE'];
$alma=$myrow['almacen'];
$codigo=$myrow['codProcedimiento'];
$keyCAP=$myrow['keyCAP'];
$ruta=$myrow['ruta'];
?>
        <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7"> <?php echo $myrow['hora1']?> <?php echo $myrow['fecha1']?> </span></td>
        <td width="298" bgcolor="<?php echo $color?>" class="style12"><span class="style7"> <span class="Estilo25">
          <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        </span> </span></td>
        <td width="47" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
		<a href="javascript:ventanaSecundaria('mostrarDiagnosticos.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numeroE']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">
        <?php $muestraReporte=new rutaReportes();
$muestraReporte->sacoRuta($numeroE,$keyCAP,$departamento,$ruta,$basedatos);
?>
</a>
		</span></td>
        <td width="45" bgcolor="<?php echo $color?>" class="style12"><span class="style7"> <?php echo $myrow['medico'];?> </span></td>
    </tr>
      <?php  }}?>
      <input name="numeroE" type="hidden" value="<?php echo $numeroE; ?>" />
  </table>
    <?php
   }
   }  //cierra clase
   ?>
</form>

