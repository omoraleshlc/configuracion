<?php class interpretarRX{
public function interpretaRX($ventana,$titulo,$ALMACEN,$fecha1,$hora1,$basedatos){
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=600,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
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
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center"><?php echo $titulo; ?></h1>
  <table width="812" border="0" align="center">
    <tr>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">fecha:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Descripci&oacute;n</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Ver</span></div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
status!='transaccion'
AND
almacenDestino = '".$ALMACEN."'  
AND 
statusDX='standby'

ORDER BY keyCAP DESC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
 $numeroE=$myrow['numeroE'];



$sSQL34= "Select max(nCuenta) as maximoNC From clientesInternos WHERE numeroE = '".$numeroE."' ";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);
$nCuenta=$myrow34['maximoNC'];

$sSQL31= "SELECT *
FROM
clientesInternos
WHERE 
numeroE= '".$numeroE."' and nCuenta='".$nCuenta."'
 ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);




 $E=$myrow['keyCAP'];
	  $codigo=$myrow['codProcedimiento'];
	 
	  ?>
      <td width="126" height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
<?php 
	  echo $myrow['hora1']." ".$myrow['fecha1'];
?>
      </span></td>
      <td width="304" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
	<?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
	  </span></td>
      <td width="301" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow31['paciente']
?></span></td>
      <td width="63" bgcolor="<?php echo $color?>" class="style12"><a href="javascript:ventanaSecundaria('reporteReportes.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta ?>&amp;codigoArticulo=<?php echo $myrow['codProcedimiento']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <label>        </label>
      </a>


<a href="javascript:ventanaSecundaria('/sima/dx/mostrarImagenRX.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta ?>&amp;keyCAP=<?php echo $E; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <img src="/sima/imagenes/camera.jpg" width="20" height="20" border="0" />
</a>

	  </td>
    </tr>
	    <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <p align="center">&nbsp;  </p>
</form>
<div align="center"><span class="style12">
<a href="javascript:ventanaSecundaria2('/sima/cargos/imprimirServicios.php?numeroE=<?php echo $numeroE; ?>&amp;codigo=<?php echo $myrow['codProcedimiento']; ?>&amp;nCuenta=<?php echo $nCuenta ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;orden=<?php echo $E; ?>')">
</a>
</span>
</div>
</body>
</html>

<?php 
}
}
?>