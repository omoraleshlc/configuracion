<?php $ALMACEN=$_GET['datawarehouse'];?>  
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
   window.open(URL,"ventanaSecundaria","width=800,height=600,scrollbars=YES")
}
</script>









  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
 












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>








  <h1 align="center"><?php echo $titulo;?></h1>

  <br></br>
  
  <?php
  
  
  $sSQL= "
SELECT *
FROM
articulosSolicitudes
where

entidad='".$entidad."'
and
usuario='".$usuario."'
    and
    status='venta'
    and
    nOrden>0
    group by nOrden
";




$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
  
  
  ?>
  
  <p align="center">

  <h1>     
<div id="encabezado">
<p align="center">Reposiciones</p>
</div>
  </h1>      
      
<div id="contener">
<div id="liga1">

<a href="javascript:ventanaSecundaria('../cargos/solicitaReposicion.php?almacen=<?php echo $ALMACEN;?>&usuario=<?php echo $myrow['usuario'];?>&nOrden=<?php echo $myrow['nOrden'];?>');" >
Reposici&oacute;n x Venta</a><br />
&nbsp; <br />
<a href="javascript:ventanaSecundaria('../cargos/reposicionesPendientes.php?almacen=<?php echo $ALMACEN;?>&usuario=<?php echo $myrow['usuario'];?>&nOrden=<?php echo $myrow['nOrden'];?>');" >
Repo. Pendientes</a>

<div id="liga2">
&nbsp; <br />
<a href="javascript:ventanaSecundaria('../ventanas/consultarReposicion.php?almacen=<?php echo $ALMACEN;?>&usuario=<?php echo $myrow['usuario'];?>&nOrden=<?php echo $myrow['nOrden'];?>');" >
Reposiciones Enviadas</a><br />

<a href="#" target="_new">
&nbsp;</a>

<a href="javascript:ventanaSecundaria('../ventanas/misCargos.php?almacen=<?php echo $ALMACEN;?>&usuario=<?php echo $myrow['usuario'];?>&nOrden=<?php echo $myrow['nOrden'];?>');" >
Mis Cargos</a><br />
</div>


<div id="liga3">
&nbsp; <br />
<a href="javascript:ventanaSecundaria('../ventanas/consultarSolicitudesGranel.php?almacen=<?php echo $ALMACEN;?>&usuario=<?php echo $myrow['usuario'];?>&nOrden=<?php echo $myrow['nOrden'];?>');" >
Granel</a><br />

<a href="#" target="_new">
&nbsp;</a>
</div>




<a href="#" target="_new">
&nbsp;</a>
</div>

</div>
</div>

 



  
  
</body>
</html>
