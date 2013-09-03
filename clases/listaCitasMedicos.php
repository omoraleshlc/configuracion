<?php class listaCitas{
public function listadoCitas($retorno,$fecha1,$MEDICO,$basedatos){
?>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
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
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 



<?php


//***********************ABRE
/* $cmdstr4 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$usuario."' 
";
$parsed4 = ociparse($db_conn, $cmdstr4);
ociexecute($parsed4);	 
$nrows4 = ocifetchstatement($parsed4,$resulta4);

for ($i = 0; $i < $nrows4; $i++ ){
$NOMBRE= $resulta4['NOMBRE'][$i]." ".$resulta4['AP_PATERNO'][$i]." ".$resulta4['AP_MATERNO'][$i];
} */

///**********************
//**********************CIERRO CAMBIAR ALMACEN******************************





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
.Estilo24 {font-size: 10px}
.Estilo24 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<h1 align="center">Listado de Pacientes </h1>
<p align="center"> <?php echo $encabezado." ".$NOMBRE;?></p>
<form name="form2" id="form2" method="post" action="">
  <table width="317" border="0" align="center" class="style121">
    <tr>
      <td width="95" bgcolor="#660066"><div align="left" class="style13">Fecha Inicial </div></td>
      <td width="190"><div align="left">
          <label>
          <input name="fecha" type="text" class="style7" id="campo_fecha" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fecha']){
		 echo $_POST['fecha'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
          </label>
          <input name="button" type="button" class="style121" id="lanzador" value="..." />
          <input name="cambiar" type="submit" class="style7" id="cambiar" value="&gt;" />
      </div></td>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="get" action="antecedentes.php">
  <table width="395" border="0" align="center" class="style7">
    <tr>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13"> Orden </span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Nombre del paciente:</span></th>
      <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Hora</span></th>
    </tr>
    <tr>
      <?php	
	  if(!$_POST['fecha']){
	  $_POST['fecha']=$fecha1;
	  }
$MEDICO='HLC006';
 $sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
medico = '".$MEDICO."'  
AND 
fecha1='".$_POST['fecha']."'
and
statusCargo='standby'


 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
$cita=$myrow['cita'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$numeroE=$myrow['numeroE'];$nCuenta=$myrow['nCuenta'];
$sSQL2= "SELECT *
FROM
clientesInternos
WHERE 
numeroE = '".$numeroE."'
and
nCuenta='".$nCuenta."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$sSQL3= "SELECT *
FROM
movimientos
WHERE 
RECIBO= '".$numeroE."' AND FECHA='".$fecha1."'
 ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];
 $E=$myrow['numeroE'];
 $numeroExpediente=$myrow['numeroExpediente'];
 
 
$sSQL4= "SELECT *
FROM
catCitas
WHERE 
keyHora= '".$cita."'

 ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	  ?>
      <td width="46" height="23" bgcolor="<?php echo $color?>" class="style12"><?php echo $myrow['keyCAP']
?> </td>
      <td width="276" bgcolor="<?php echo $color?>" class="style12">
	  <a href="diagnosticos.php" onClick="javascript:form.this.submit();">
	  <?php echo $myrow2['paciente']
?></a></td>
      <td width="59" bgcolor="<?php echo $color?>" class="style12"><?php echo $myrow['horaSolicitud']
?></td>
    </tr>
    <?php  }}
	
	if(!$a){
	$a='0';
	}
	?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
  <input name="almacen1" type="hidden" id="almacen1" value="<?php echo $_POST['almacen']; ?>" />
  <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_POST['almacen1']; ?>" />
  <input name="almacen3" type="hidden" id="almacen3" value="<?php echo $_POST['almacen2']; ?>" />
  <input name="almacen" type="hidden" id="almacen3" value="<?php echo $_POST['almacen3']; ?>" />
</form>
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>

</html>
<?php

}
}

?>