<?php class solicitudesxSurtir{
public function serviciosxSurtir($usuario,$entidad,$ventana,$titulo,$ALMACEN,$fecha1,$hora1,$basedatos){
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=600,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=300,scrollbars=YES") 
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





<?php

if($_POST['surte'] and $_POST['keyCAP']){

$keyCAP=$_POST['keyCAP'];

for($i=0;$i<=$_POST['bandera'];$i++){
$kC=$keyCAP[$i];
if($keyCAP[$i]){
$iS+=1;
$q = "UPDATE cargosCuentaPaciente set 
statusCargo = 'cargado',statusTraslado='standby',statusImpresionSolicitud='standby'
where

keyCAP='".$keyCAP[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

}
} ?>
<script>
javascript:ventanaSecundaria('/sima/cargos/imprimirServiciosPendientes.php?usuario=<?php echo $usuario;?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&bandera=<?php echo $iS;?>');
</script>
<?php 
}
?>

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
  <table width="756" border="0" align="center">
    <tr>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Hora:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Descripci&oacute;n</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">TipoPx</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Depto, Solicita</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cuarto</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Prioridad</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cargar</span></div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
cargosCuentaPaciente.entidad='".$entidad."' 
AND
cargosCuentaPaciente.almacenDestino = '".$ALMACEN."'  
AND 
cargosCuentaPaciente.fechaSolicitud='".$fecha1."'
and
cargosCuentaPaciente.statusCargo='standby' 
AND 
(cargosCuentaPaciente.tipoPaciente='interno' or cargosCuentaPaciente.tipoPaciente='urgencias')


ORDER BY cargosCuentaPaciente.horaSolicitud,cargosCuentaPaciente.prioridad ASC
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



$sSQL34= "Select max(nCuenta) as maximoNC From clientesInternos WHERE entidad='".$entidad."' AND numeroE = '".$numeroE."' ";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);
$nCuenta=$myrow34['maximoNC'];

$sSQL31= "SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."' AND
numeroE= '".$numeroE."' and nCuenta='".$nCuenta."'
 ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);




 $E=$myrow['keyCAP'];
	  $codigo=$myrow['codProcedimiento'];
	 
	  ?>
      <td width="70" height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  
	 

	  echo $myrow['hora1'];

?>
       
      </span></td>
      <td width="218" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
	<?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
	  </span></td>
      <td width="202" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow31['paciente']
?></span></td>
      <td width="55" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
	  <?php echo $myrow['tipoPaciente']
?>
      </span></td>
      <td width="68" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['almacenSolicitante']
?></span></td>
      <td width="29" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php 
	  if($myrow31['cuarto']){
	  echo $myrow31['cuarto'];
	  } else {
	  echo "---";
	  }
	  
?></span></td>
      <td width="40" bgcolor="<?php echo $color?>" class="style12"><?php echo $myrow['prioridad'];?></td>
      <td width="40" bgcolor="<?php echo $color?>" class="style12"><a href="javascript:ventanaSecundaria('reporteReportes.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta ?>&amp;codigoArticulo=<?php echo $myrow['codProcedimiento']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <label>        </label>
      </a>


<a href="javascript:ventanaSecundaria('/sima/cargos/imprimirServiciosPendientes.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta ?>&amp;keyCAP=<?php echo $E; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"></a>

	  <label>

	  <input name="keyCAP[]" type="checkbox" id="keyCAP" value="<?php echo $myrow['keyCAP'];?>" />
	  </label></td>
    </tr>
	    <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <p align="center">
    <label>
    <input name="surte" type="submit" class="style7" id="surte" value="Surtir" />
    </label>
</p>
</form>
</body>
</html>

<?php 
}
}
?>