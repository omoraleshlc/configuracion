<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>


<SCRIPT language="javascript">
function imprimir()
{ if ((navigator.appName == "Netscape")) { window.print() ;
}
else
{ var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); WebBrowser1.outerHTML = "";
}
window.close();
}
</SCRIPT> 




<?php if(!$_POST['print']){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.Estilo4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
<style type="text/css">
.Estilo10 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
#form1 table {
	text-align: center;
}
#form1 table tr .Estilo4 .Estilo2 {
	text-align: left;
}
-->
</style>
</head>
<BODY >


<h1 align="center" class="Estilo1">HOSPITAL LA CARLOTA</h1>
<h4 align="center" class="Estilo2">Articulos Surtidos<span class="style7 Estilo3">

<?php
 $sSQL1= "Select usuario,hora From solicitudesDepartamentos WHERE
keySAL='".$_GET['orden']."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


$sSQL1a= "Select hora1 From faltantesSub WHERE  entidad='".$entidad."' and
nOrden='".$_GET['orden']."'
group by hora1
";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
?>

        <h2 align="center" class="normal">Usuario Cargo: <?php echo $_GET['usuario'];?><span class="style7 Estilo3">
 <h4 align="center" class="normal">Usuario Solicitante: <?php echo $myrow1['usuario'];?><span class="normal">
 <h5 align="center" class="normal">Hora Solicitud: <?php echo $myrow1['hora'];?><span class="normal">
          <h5 align="center" class="normal">Hora Cargo: <?php echo $myrow1a['hora1'];?><span class="normal">
  <?php 
 $sSQL1= "Select almacenSolicitante From faltantesSub WHERE
entidad='".$entidad."'
and
nOrden='".$_GET['orden']."'
and

random='".$_GET['random']."'
group by almacenSolicitante;
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


?>
  <br />
</span></h5>



                
<table width="580" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>

              <td width="415" align="Center" class="Estilo3"><span class="Estilo2"> Orden: <?php echo $_GET['orden'];

?><td width="95" align="left">&nbsp;</td></span></td>
      
    </tr>

</table></br>
</br>
<table>





    
<tr><td>#</td>
<td>Fecha</td>
<td>Descripcion</td>
<td>Almacen Destino</td>
<td>Cant</td>
</tr>
    <tr>
      
<?php	
if($_GET['orden'] !=NULL){



$sSQL18= "
SELECT 
*
FROM
faltantesSub
WHERE 
entidad='".$entidad."'
and
nOrden='".$_GET['orden']."'
   
       and
        random='".$_GET['random']."'
    group by keyPA
order by descripcion ASC
";




$result18=mysql_db_query($basedatos,$sSQL18);
if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$requi=$myrow18['id_requisicion'];
$id_proveedor=$myrow18['id_proveedor'];
$id_almacen=$myrow18['id_almacen'];
$b+='1';
$a+='1';

if($col){
$color = '#CCCCCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$codigo=$code1=$myrow18['codProcedimiento'];

if(!$descripcion){
$descripcion="No existen estos articulos o estan inactivos";
}

$sSQL7= "Select * From existencias WHERE entidad='".$entidad."' and codigo= '".$code1."' and almacen='HALM'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


$sSQL7a= "Select sum(cantidadSurtida) as c From faltantesSub WHERE entidad='".$entidad."'
    and nOrden= '".$_GET['orden']."'
        and keyPA='".$myrow18['keyPA']."'
                            and
        random='".$_GET['random']."'
";
$result7a=mysql_db_query($basedatos,$sSQL7a);
$myrow7a = mysql_fetch_array($result7a);
?>

<td bgcolor="<?php echo $color?>">

<div align="left" class="Estilo2">
<?php echo $a;?>
</div>
</td>


      <td height="24" bgcolor="<?php echo $color?>"><div align="left" class="Estilo2">
          <?php 
	 
	  echo cambia_a_normal($myrow18['fecha1']);
	  	 		?>
        </span></div>
        <span class="style7"><label></label>
        <div align="center"></div>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo4"><span class="Estilo2">
        <?php 
					echo $myrow18['descripcion'];
		
		?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
        <?php 
	  if($myrow18['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Este articulo es una devolucion]';
	  }
	  ?>      
        </span></span></td>
                     
      <td bgcolor="<?php echo $color?>" class="Estilo4">
        <div align="center" class="Estilo2">
          <?php 
 $sSQL2= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow1['almacenSolicitante']."';
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
	  echo $myrow2['descripcion'];
	  	 		?>      
        </div></td>



              <td bgcolor="<?php echo $color?>" class="Estilo4">
        <div align="center" class="Estilo2">
          <?php

	  echo $myrow7a['c'];
	  	 		?>
        </div></td>



  
    </tr>
    <?php  
	

	}}} //cierra while 
	

	
	?>
  </table>
  <div align="center">
    <label><br />
    <input name="print" type="submit" style="boton1" id="print" value="Imprimir"  onclick="imprimir();"/>
    </label>
</div>
  <p align="center">&nbsp;</p>
</form>
</body>

</html>
<?php } else { echo 'Datos ya impresos';
echo '<script>';
echo 'close();';
echo '</script>';
} ?>