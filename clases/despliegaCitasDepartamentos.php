<?php class despliegaCitasDepartamentos{
public function despliegaCitas($entidad,$ventana,$fecha1,$hora1,$almacen,$basedatos){ 
$almacenDestino=$almacen;
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
require("/configuracion/componentes/comboAlmacen.php"); 


	
?>
<script src="/sima/js/jquery.js" type="text/javascript"></script>
<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-system.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
  <script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=600,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
  <script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=660,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<?php  
if($_GET['keyClientesInternos'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE clientesInternos set 

	status='cancelado'
		WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>



<meta http-equiv="refresh" content="90">


</head>
<body>
<form id="form1" name="form1" method="GET" action="citas.php">

  <h1 align="center">
    <?php 
  //**************VERIFICAR EL ESTADO DE LA CITA*****************

if(!$_GET['fechaSolicitud']){
$_GET['fechaSolicitud']=$fecha1;
}


if($myrow6['descripcion']){
echo $myrow6['descripcion'];
} 

//**************************************************************
?></h1>
  <table width="513" border="0" align="center">

    <tr valign="middle" class="style71">
      <th width="49" class="negro" scope="col"><span class="Estilo25">
        <input name="button" type="image"  id="lanzador" value="fecha"  src="/sima/imagenes/btns/fechadate.png"/>
      </span></th>
      <th width="283" scope="col"><div align="left">
        <input name="fechaSolicitud" type="text" class="campos" id="campo_fecha"
	  value="<?php 
	  if($_GET['fechaSolicitud']){
	  echo $fecha2=$_GET['fechaSolicitud'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" onChange="javascript:this.form.submit();"/>
        </div></th>
      <th width="19" scope="col">&nbsp;</th>
      <th width="144" scope="col"><span class="Estilo25">
        <label></label>
        </span>
      <div align="left"></div></th>
    </tr>
    <tr class="style71">
      <th class="negro" scope="col"><div align="left" class="negro">
        <div align="left">M&eacute;dico</div>
      </div></th>
      <th scope="col"><div align="left">
	  <?php 
 $aCombo= "Select almacen,descripcion From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$almacen."' 
and
medico='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
<select name="almacenDestino1" class="combos" id="almacenDestino1" onChange="javascript:this.form.submit();"/>        


	   
	   <option value="">EN LISTA DE ESPERA</option><option value="">------</option>
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
		
        <option 
		<?php if($resCombo['almacen']==$_GET['almacenDestino1'])echo 'selected=""'; ?>
		
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	  </div></th>
	  
	  
	  
	  
	  <?php 
	  if($_GET['almacenDestino1']){ ?>
      <th scope="col">
	  
	  
	  
	  <a href="#" onClick="javascript:ventanaSecundaria7('ventanaMedicosNotas.php?numeroE=<?php echo $numeroE; ?>
		&nCuenta=<?php echo $nCuenta; ?>&keyCAP=<?php echo $keyCAP; ?>&almacen=<?php echo $almacenDestino; ?>&fechaSolicitud=<?php echo $_GET['fechaSolicitud'];?>&id_medico=<?php echo $_GET['almacenDestino1'];?>&alma=<?php echo $almacen;?>')">
		<img src="/sima/imagenes/btns/addnote.png" alt="Agregar Notas" border="0" /></a>	  </th>
      <th scope="col"><div align="left">
	  
	  </div></th>
	  <?php } ?>
    </tr>
  </table>
  <h3 align="center"><?php
  
  
$sSQL6= "Select usuario,descripcion From medicosCitasCanceladas where
entidad='".$entidad."'
AND
almacen='".$_GET['almacenDestino1']."'
and
fecha = '".$_GET['fechaSolicitud']."' 
";

$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6); 



if($myrow6['descripcion']){
echo '<span class="style1">'.'<blink>'.'Aviso Importante: '.'</blink>'.'</span>'.$myrow6['descripcion'];
echo '</br>';
echo 'Atte: '.$myrow6['usuario'];
}
?></h3>
  
  <tr>
    <td>
    <div id="contentLoading" class="contentLoading">
<img src="/sima/imagenes/barras/loading30.gif" alt="Loading data, please wait...">
</div>
<div id="contentArea">
</div>
</td>
</tr>
    
</form>


<p>&nbsp; </p>
<script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>

<script type="text/javascript">
<!--
jQuery(function($) {
$("#contentArea").load("despliegaCitas.php?almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&fecha2=<?php echo $fecha2;?>&fecha1=<?php echo $fecha1;?>&almacen=<?php echo $almacen;?>");
});

$().ajaxSend(function(r,s){
$("#contentLoading").show();
});

$().ajaxStop(function(r,s){
$("#contentLoading").fadeOut("fast");
});

//-->
</script>
</html>
<?php
}
}
?>