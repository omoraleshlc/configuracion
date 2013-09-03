<?php 
class despliegaPacientesInternos{
public function displayPI($entidad,$bali,$ventana,$basedatos){

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


<?php	

$sSQL= "SELECT *
FROM
cargosCuentaPaciente,clientesInternos
where
clientesInternos.entidad='".$entidad."' AND
(
clientesInternos.numeroE=cargosCuentaPaciente.numeroE 
and 
clientesInternos.nCuenta=cargosCuentaPaciente.nCuenta) 
and
clientesInternos.status='activa'
and
cargosCuentaPaciente.almacenDestino='".$bali."'
and
cargosCuentaPaciente.status='standby'
and
cargosCuentaPaciente.statusCargo='standby'
group by 
cargosCuentaPaciente.numeroE
order by clientesInternos.keyClientesInternos ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);

 ?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center">Imprimir Art&iacute;culos Cargados a  Pacientes Internos  </h1>
  <table width="442" border="0.2" align="center">
    <tr>
      <th width="44" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13"># Cuenta  </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Departamento Solicitante </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cuarto</span></div></th>
    </tr>
    <tr>
<?php 
while($myrow = mysql_fetch_array($result)){ 
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
      <td width="355" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><a href="#" rel="htmltooltip" onClick="javascript:ventanaSecundaria('<?php echo $ventana?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;cuarto=<?php echo $myrow['cuarto']; ?>&amp;almacenDestino=<?php echo $ALMACEN; ?>')"><?php echo $myrow['paciente'];?></a>
      </span></td>
      <td width="165" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
<?php 
$almacenSolicitante=new nombreDepartamento();
$almacenSolicitante->nombre($myrow['almacenSolicitante'],$basedatos);

?></span></td>
      <td width="39" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['cuarto']
?></span></td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
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
<?php }} ?>