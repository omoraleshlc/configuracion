<?php class muestraExternosDescuentos { 
public function listaExternosDescuentos($ALMACEN,$entidad,$TITULO,$ventana,$basedatos){
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script src="/sima/js/jquery.js" type="text/javascript"></script>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 

<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>


<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
<meta http-equiv="refresh" content="30" >
</head>

<body>
<?php 
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>


<form id="form10" name="form10" method="get" action="#">
  <h1 align="center" >Aplicar Descuentos Pacientes Externos</h1>
  <p align="center" >Fecha: 
  <input onChange="this.form.submit();" name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 echo $date;
		 ?>"/>
    </label>
    <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" /></p>

  <table width="536" class="table table-striped">
    <tr >
      <th width="49"   scope="col"><div align="center">Folio</div></th>
      <th width= "238"   scope="col"><div align="center">Nombre del paciente:</div></th>
      <th   scope="col"><div align="center">Departamento</div></th>
	  <th   scope="col"><div align="center">Usuario</div></th>
	  <th   scope="col"><div align="center">Aplicar</div></th>
    </tr>
    <tr >
      <?php	
$fecha1= date("Y-m-d");
$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
status!='cancelado'
and
tipoPaciente='externo'
and
fecha='".$date."'
and
statusCaja!='pagado'
and
folioVenta!=''

ORDER BY paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];
	  ?>
       <tr  > 
      <td height="24" ><?php echo $myrow['folioVenta'];
?></td>


      <td width="238" >

	  	  <?php 

$verificaCargos=new acumulados();
$verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta);
if($myrow['paciente']){	  
?>

	  <?php echo $myrow['paciente'];?>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  ?> 
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="104" ><?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></td>

<td width="74"  align="center"><?php
echo $myrow['usuario'];
?></td>
<td width="49"  align="center"><label>

<?php if($myrow['descuento']==''){ ?>
  <a href="javascript:nueva('../cargos/aplicarDescuentos.php?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
&nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&almacenSolicitante=<?php echo $ALMACEN; ?>&nT=<?php echo $nT; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&tipoVenta=<?php echo 'externo';?>','ventana1','800','600','yes')"><img src="/sima/imagenes/btns/desctbtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="24" height="24" border="0"/>  </a>
<?php }else{echo '---';}?>
   
</label></td>
    </tr> 
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
    <input name="main" type="hidden" value="<?php echo $_GET['main'];?>" />
    <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />
     <input name="datawarehouse" type="hidden" value="<?php echo $_GET['datawarehouse'];?>" />
  </table>

<p>&nbsp;</p>
</form>

<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script>
</body>
</html>
<?php 
}
}
?>