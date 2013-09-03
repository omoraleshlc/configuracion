<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

 <script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=650,height=700,scrollbars=YES") 
} 
</script> 
 
  <script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=650,height=700,scrollbars=YES") 
} 
</script>  


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


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <script  src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />




<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>

<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos">ESTADO DE CUENTA<label></label></h1>
  <table width="420" >
    <tr>
      <td width="31"><input name="decide" type="radio" id="radio" value="abierto" <?php if($_POST['decide']=='abierto' or !$_POST['decide']){ echo 'checked="checked"';}?> onClick="javascript:this.form.submit();"  /></td>
      <td width="369" class="negro">Activos</td>
    </tr>
    <tr>
      <td><input type="radio" name="decide" id="radio2" value="cerrado" <?php if($_POST['decide']=='cerrado'){ echo 'checked="checked"';}?> onClick="javascript:this.form.submit();"/></td>
      <td class="negro">Folio Venta<span class="titulo"><?php if($_POST['decide']=='cerrado'){?>
        <input name="folioVenta" type="text" id="folioVenta" value="<?php if($_POST['decide']=='cerrado'){echo $_POST['folioVenta'];}?>" size="20" />
      </span></td> <?php } ?>
    </tr>
    <tr>
      <td><input type="radio" name="decide" id="radio3" value="nombre" <?php if($_POST['decide']=='nombre'){ echo 'checked="checked"';}?> onClick="javascript:this.form.submit();"/></td>
      <td class="negro"><p>Apellido del Paciente
        <?php if($_POST['decide']=='nombre'){?>
        <br />
        <input name="paciente" type="text" class="camposmid" id="paciente" size="60"  value="<?php echo $_POST['paciente'];?>"/>
          </span>
          
        </label>
        <br />
        <a href="javascript:ventanaSecundaria10('../cargos/busquedaAvanzada.php?reload=si')" class="style1">Busqueda Avanzada por Expediente</a>
		<input name="folioVenta" type="hidden" class="Estilo24" id="folioVenta" value="<?php echo $_POST['folioVenta'];?>" />
		<input name="numeroEx" type="hidden" class="Estilo24" id="numeroEx" value="<?php echo $_POST['numeroEx'];?>" />
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td><input type="radio" name="decide" id="radio4" value="rango" <?php if($_POST['decide']=='rango'){ echo 'checked="checked"';}?> onClick="javascript:this.form.submit();"/></td>
      <td class="negro"><p>
        <label>
          Por Fecha <?php if($_POST['decide']=='rango'){?>
          <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
        </label>
        <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
        a
  <label>
    <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
  </label>
  <input name="button1" type="button" class="Estilo24" id="lanzador1" value="..." />
      </p>
        <p>
          <?php } ?>
      </p></td>
    </tr>

    <tr>
      <td colspan="2" align="center"><span class="titulo">
        <input type="submit" src="../imagenes/btns/new_busca.png" name="buscar" id="button" value="Buscar" />
      </span></td>
    </tr>
  </table>

  <p align="center">
     <?php if($_POST['buscar'] ){ ?>
    <br />
   <span class="codigos">(Para ver la Nota de Venta, presiona sobre el Folio de Venta)<br /></span>
    <span class="negro">(Para
  ver el Estado de Cuenta del Paciente, presiona sobre el nombre del Paciente)</span>
  
  </p>
  
  
  <table width="900"  class="table table-striped">

    <tr bgcolor="#FFFF00">
      <th width="31" align="left" class="negromid">#</th>
      <th width="56" align="left" class="negromid">Folio V</th>
      <th width="256" align="left" class="negromid">Status Paciente</th>
      <th width="274" align="left" class="negromid">Aseguradora</th>

      <th width="110" align="center" class="negromid">Fechas</th>

      <th width="73" align="center" class="negromid">Usuario</th>
    </tr>
    
 <?php	
$paciente=$_POST['paciente'];
$nombreCompleto=$_POST['paciente'];


if($_POST['decide']=='cerrado'){
$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
    and
folioVenta='".$_POST['folioVenta']."'
order by paciente asc
 ";
 } else if($_POST['decide']=='nombre' or $_POST['decide']=='cerrado' ){ 
 
 
 if($_POST['numeroEx']){
 
  $sSQL= "SELECT *
FROM
clientesInternos
where
(entidad='".$entidad."'
and
numeroE='".$_POST['numeroEx']."'
and
folioVenta!=''
and
statusCaja='pagado'
and
tipoPaciente='externo'
)
or
(entidad='".$entidad."'
and
numeroE='".$_POST['numeroEx']."'
and
folioVenta!=''
and
statusCaja='pagado'
and
tipoPaciente!='externo'
)
 ";
 
 
 
 }else{
 if($_POST['folioVenta']){
 $sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
folioVenta='".$_POST['folioVenta']."'
";
}else{
$sSQL= "SELECT *
FROM
clientesInternos
where
(entidad='".$entidad."'
and
paciente like '%$paciente%'
and
folioVenta!=''
and
fechaCierre!=''
and
tipoPaciente='externo'
)
or
(entidad='".$entidad."'
and
paciente like '%$paciente%'
and
folioVenta!=''
and
fechaCierre!=''
and
tipoPaciente!='externo'
)

";
}
}



 } else if($_POST['decide']=='abierto'){ 
 $sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
statusCuenta='abierta'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
folioVenta!=''
order by paciente asc
 ";
 
 } else if($_POST['decide']=='rango'){
$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
folioVenta!=''
and 
fechaCierre>= '".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."'

order by paciente asc
 ";
 
 }else if($_POST['decide']=='recibo'){
$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
folioVenta!=''
and 
numRecibo ='".$_POST['recibo']."'

order by paciente asc
 ";
 
 }
 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];

$a+=1;
$nT=$myrow['keyClientesInternos'];
	  ?>    
   <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" > 
      <td height="46" align="center" class="codigos"><?php print $a;?></td>
      <td class="normalmid" valign="middle">

<?php if($myrow['statusCaja']=='pagado') {?>
<?php 	  if($_POST['decide']=='recibo'){ ?>
	  <a href="javascript:ventanaSecundaria('../ventanas/imprimirRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&cajero=<?php echo $myrow['usuario'];?>')"><?php echo $myrow['folioVenta'];?></a>

<?php }else {?>
	  <a href="javascript:ventanaSecundaria('../ventanas/imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>')"><?php echo $myrow['folioVenta'];?></a>
<?php } ?>	  
<?php } else {
echo 'Transaccion Pendiente';
} ?>



	  
	  </td>
      <td>
	 <span class="normalmid"> <a href="#" 
onclick="javascript:ventanaSecundaria11('../cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>')">  
	  

	  <?php echo $myrow['paciente']; ?>

          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
<input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/></a>
</span>
<br />


<span class="negro">
Paciente <?php echo $myrow['tipoPaciente'];?> de <?php
$al=$myrow['almacen'];
$sSQL17= "
SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?>
</br>



<span class="negro">Status de la Cuenta:</span><span><b>
   <?php    
   
	echo $myrow['status'];
	
?>



	</b></span>


              <?php if($myrow['tipoPaciente']=='interno' or $myrow['tipoPaciente']=='urgencias'){ ?>
          <br>
                <a href="javascript:ventanaSecundaria('../ventanas/impresionInternamiento.php?entidad=<?php echo $entidad; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>')">
                H. Admision
                </a>
          </br>
          <?php } ?>
	</td>






      <td class="normalmid"><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
entidad='".$entidad."'
    and
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "Sin Seguro";
		  }
?>
     </td>

       <td align="center" class="normal">Ingreso: <?php echo cambia_a_normal($myrow['fecha']);?></br>
      <span class="negro"> 
	  
	  <?php 
	  
	  if($myrow['fechaCierre']){
echo "Cerrada el " . cambia_a_normal($myrow['fechaCierre']);
}else{

if($myrow['tipoPaciente']!='externo'){
echo 'Cuenta Activa';
}else{
echo 'Paciente Externo';
}
}
?></span>
       
       </td>

      <td align="center" class="codigos"><?php echo $myrow['autoriza'];?>
      
      </td>
    </tr><?php  }}}?>

  </table>

    
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>






  <p>&nbsp;</p>
</form>
<script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("folioVenta")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesInternosx.php?basedatos=<?php echo $basedatos;?>&entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>

<?php if($_POST['decide']=='rango'){ ?>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 

  
<?php } ?>
</body>

</html>