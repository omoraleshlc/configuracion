<?php if(!$folioVenta){
$folioVenta=$_GET['folioVenta'];
}
?>

<?php
$link=new ventanasPrototype();
$link->links();

$estilo=new muestraEstilos();
$estilo->styles();
?>
	
  
  <script languaje="JavaScript">
            
var reloj=new Date(); 

          varjs=  reloj.getHours()+":"+reloj.getMinutes(); 

</script>



<form id="form1" name="form1" method="post" action="#">
<?php 


$sSQL= "SELECT *
FROM
clientesInternos 
where
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'

 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$entidad=$myrow['entidad'];
$keyClientesInternos=$myrow['keyClientesInternos'];
$folioVENTA=$myrow['folioVenta'];
$tipoPACIENTE=$myrow['tipoPaciente'];
$limiteSEGURO=$myrow['limiteSeguro'];
$SEGURO=$myrow['seguro'];

?>

<h1>ESTADO DE CUENTA</h1>
  <table width="993" style="border: 1px solid #CCC;">

    <tr >
      <td width="124" align="left" ><b>FOLIO N&deg;</b></td>
      <td width="655" align="center" > <b>PACIENTE: <span class="titulomedio"><?php echo $myrow['paciente']; ?></span></b></td>
      <td width="200" align="left" ><b>DEPTO - CUARTO</b></td>
    </tr>
	
	<?php if($myrow['statusCortesia']=='si'){ ?>
    <tr>
      <td colspan="3" style="text-align: center"><span class="codigos" style="size:14"><blink>*****EL PACIENTE ES DE CORTESIA****</blink></span></td>
    </tr>
    <?php } ?>
	
	<tr>
      <td align="left" style="text-align: center"><span ><?php echo $myrow['folioVenta']; ?></span></td>
      <td ><span  style="text-align: left">Seguro: <span class="normalmid">
        <?php 
		
	$segur= $myrow['seguro'];
	
	if ($segur!='') {
	$sSQL4= "Select nomCliente From clientes WHERE entidad='".$entidad."' and numCliente='".$segur."';
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	 
	echo $myrow4['nomCliente'];
} else {
echo particular;
}
?>
        - <?php echo $myrow['credencial']; ?></span></span></td>
      <td><span >
        <?php $id_almacen=$myrow['almacen']; 
	  $sSQL1= "SELECT almacen,descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$id_almacen."'
 ";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['descripcion'];
	  ?>
        - <?php echo $myrow['cuarto']; ?></span></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" >Fecha/Hora de Inter.: <span class="normalmid"><?php echo $myrow['fecha']." / ".$myrow['hora']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" >M&eacute;dico de Inter.: <span class="normalmid">
        <?php 

	if ($myrow['medico']) {
	 $medico1=$myrow['medico'];
	$sSQL3= "SELECT nombre1,apellido1,apellido2
	FROM
	medicos 
	where
	entidad='".$entidad."'
	and
	numMedico='".$medico1."'";
	
	$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
	 
	 echo $myrow3['nombre1']." ".$myrow3['apellido1']." ".$myrow3['apellido2']; 
     }
     else{
		 echo $myrow['medicoForaneo'];    
	 }
?>
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" >Diagn&oacute;stico: <span class="normalmid"><?php echo $myrow['dx']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" ><span  style="text-align: left">Fecha/Hora de Alta: <span class="normalmid"><?php echo $myrow['fechaCierre']." / ".$myrow['horaCierre']; ?></span></span></td>
      <td>&nbsp;</td>
    </tr>
    
    	<?php if($myrow['ticket']>0){ ?>
      <tr>
      <td colspan="2" style="text-align: left" ><span  style="text-align: left">ticket: <span class="normalmid"><?php echo $myrow['ticket'];?></span></span></td>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>
    
	
	<?php if($myrow['numeroFactura']){ ?>
    <tr>
      <td colspan="2" style="text-align: left" ><span  style="text-align: left">Numero Factura:  <span class="normalmid"><?php echo $myrow['numeroFactura']; ?></span></span></td>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>
  </table>
  <p align="center">
  <?php 
  
 	$sSQLnc= "SELECT *
	FROM
	clientesInternos 
	where
	entidad='".$entidad."'
	and
	folioVenta='".$myrow['folioDevolucion']."' and statusCuenta='cerrada' ";
	
	$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);
//echo $myrow3i['folioVenta'];
    ?>
	
	
	<?php if($myrownc['folioVenta']){ ?>
<h1 align="center" class="titulos"> 
   <a href="javascript:nueva('/sima/cargos/despliegaCargos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow['folioDevolucion'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=<?php echo $my['codigoTT'];?>&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=<?php if($_GET['devolucion']=='si'){echo 'devolucion';}else{ echo 'efectivo';} ?>&amp;tipoTransaccion=particular&amp;devolucion=<?php echo $_GET['devolucion'];?>&tipoPago=Efectivo','ventana7','800','600','yes');">
NOTA DE CREDITO
</a>
<?php } ?>
	
  </p>
