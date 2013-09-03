<?php
class muestraInternos{
public function listaInternos($entidad,$TITULO,$ventana,$basedatos){
?>



<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<?php require("/configuracion/funciones.php");ventanasPrototype::links();?>
<form id="form1" name="form1" method="get" action="#">
  <h1 align="center"> <?php echo $TITULO; ?></h1>
  <table width="707" border="0.2" align="center">
    <tr>
      <th width="49" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13"># Folio </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style121"><span class="style11 style13">Seguro</span></span></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cuarto</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Hora Inicial </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Hora Actual </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">TOTAL</span></div></th>
    </tr>
    <tr>
      <?php	

 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCuenta = 'abierta'
and
status='activa'
and 
(statusDeposito='pagado' or statusDeposito='cxc' or statusDeposito='urgencias')
ORDER BY keyClientesInternos DESC
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
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
	  
	  <?php echo $myrow['keyClientesInternos'];
?></span></td>


      <td width="249" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
<a href="#"  onClick="javascript:ventanaSecundaria11('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>')">
	  <?php echo $myrow['paciente'];?></a>
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>
      </span></td>

      <td width="69" bgcolor="<?php echo $color?>" class="style12"><span class="style121"><span class="style71">
	  <?php echo $seguro;?></span></span></td>
      <td width="49" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['cuarto']
?></span></td>
      <td width="98" bgcolor="<?php echo $color?>" class="style12">&nbsp;</td>
      <td width="84" bgcolor="<?php echo $color?>" class="style12">&nbsp;</td>
      <td width="79" bgcolor="<?php echo $color?>" class="style12">&nbsp;</td>
    </tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>



<?php 
$titulo='prueba';
$url=$ventana;
$abajo=70;
$izquierda=0;
$ancho=300;
$alto=200;
//$ventanas=new ventanasPrototype();
//$ventanas->despliegaVentana($titulo,$url,$abajo,$izquierda,$anchura,$altura);?>


  <p>&nbsp;</p>
</form>
</body>
</html>


<?php 

}//cierra funcion
}//cierra clase 
?>
