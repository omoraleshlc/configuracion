<?php //traigo agregados
class consultarCxC{


public function consulta($entidad,$ventana,$TITULO,$nCliente,$basedatos){
?>


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=800,scrollbars=YES") 
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


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">

.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}


div.htmltooltip{
position: absolute; /*leave this and next 3 values alone*/
z-index: 1000;
left: -1000px;
top: -1000px;
background: #272727;
border: 10px solid black;
color: white;
padding: 3px;
width: 250px; /*width of tooltip*/
}

</style>
</head>


<form id="form1" name="form1" method="get" action="#">
  <h1 align="center"> <?php echo $TITULO; ?></h1>
  <table width="722" border="0.2" align="center">
    <tr>
      <th width="50" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13"># Folio </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Depto.</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">tipo</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cargos</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Abonos</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left">
        <div align="left">
          <div align="left"><span class="style11 style13">Ver</span></div>
        </div>
      </div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
AND
seguro!=''
AND
seguro='".$nCliente."'


ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta']; 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$seguro=$myrow['seguro'];
$nT=$myrow['keyClientesInternos'];

$sSQL1711= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
numCliente = '".$seguro."'

";
$result1711=mysql_db_query($basedatos,$sSQL1711);
$myrow1711 = mysql_fetch_array($result1711);
$seguro=$myrow1711['nomCliente'];

if($seguro){
$tipoCliente='aseguradora';
} else {
$tipoCliente='particular';
}

if(!$seguro)$seguro='particular';
	  ?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['keyClientesInternos'];
?></span></td>


      <td width="253" bgcolor="<?php echo $color?>" class="style12"><span class="style7">

	  <?php echo $myrow['paciente'];?>
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>
      </span></td>
      <td width="143" bgcolor="<?php echo $color?>" class="style12"><span class="style121"><span class="style71">
	  <?php echo $myrow['almacen'];?></span></span></td>
      <td width="57" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['tipoPaciente']
?></span></td>
      <td width="79" bgcolor="<?php echo $color?>" class="style12"><?php 
		$totalAcumulado=new acumulados();
		$totalCargos[0]+=$totalAcumulado->totalAcumuladoAseguradoraCxC($basedatos,$usuario,$numeroE,$nCuenta);
		echo "$".number_format($totalAcumulado->totalAcumuladoAseguradoraCxC($basedatos,$usuario,$numeroE,$nCuenta),2);?></td>
      <td width="73" bgcolor="<?php echo $color?>" class="style12">$0.00</td>
      <td width="37" bgcolor="<?php echo $color?>" class="style12"><div align="left"><span class=""> 
	  <a href="javascript:ventanaSecundaria2('<?php echo $ventana;?>?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;nt=<?php echo $nT; ?>')">
	   <img src="/sima/imagenes/ver.jpg" alt="Consultar" width="12" height="12" border="0" />	   </a> 
	  </span></div></td>
    </tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>






  <table width="637" border="0" align="center">
    <tr>
      <td width="101">&nbsp;</td>
      <td width="101">&nbsp;</td>
      <td width="101">&nbsp;</td>
      <td width="156">&nbsp;</td>
      <td width="77">&nbsp;</td>
      <td width="75">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="right"><span class="style12"><span class="style7">TOTAL(S/iva)</span></span></div></td>
      <td class="style7"><?php echo "$".number_format($totalCargos[0],2);?>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>


<?php 

}//cierra funcion
}//cierra clase 
?>
























