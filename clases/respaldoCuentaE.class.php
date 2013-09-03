<?php 
class eCuentasE{
public function eCuentaE($usuario,$entidad,$almacen,$fecha1,$hora1,$dia,$usu,$nT,$basedatos){


$cargosCia=new acumulados();



//**********************************CANDADO PRINCIPAL**********************
$bali=$almacen;
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$sSQL1= "Select usuario,folioVenta From transacciones WHERE folioVenta ='".$_GET['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();



if($myrow1['folioVenta'] AND $myrow1['usuario']!=$usuario){ ?>
<script>
window.alert("Este proceso está siendo utilizado por: (<?php echo $myrow1['usuario'];?>) y sólo el puede terminar este proceso");
window.close();
</script>
<?php 
} else if(!$myrow1['folioVenta']){
$agrega = "INSERT INTO transacciones (
folioVenta,usuario,fecha,hora,keyCatC) 
values ('".$_GET['folioVenta']."','".$usuario."','".$fecha1."','".$hora1."','".$myrowC['keyCatC']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
//************************************CANDADO DE USUARIO
?>






<?php 
if($_POST['cerrar']){
$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];



//cierro cuenta
$agrega4 = "UPDATE clientesInternos set 
tipoCuenta='H',
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."',
statusCaja='pagado'
where
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();



//********************CIERRO STATUS CUENTA***********************
$agrega = "UPDATE cargosCuentaPaciente set 
statusCuenta='cerrada'
where
folioVenta='".$_GET['folioVenta']."'";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*********************************************




//cierro cuarto a sucio
if($myrow3['cuarto']){
$agregad = "UPDATE cuartos set 
status='sucio',
usuarioSalida='".$usuario."',
fechaSalida='".$fecha1."',
horaSalida='".$hora1."'

where
codigoCuarto='".$myrow3['cuarto']."' 
";

//mysql_db_query($basedatos,$agregad);
echo mysql_error();
}
$leyenda='Se cerró la cuenta';



  $sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['status']=='cerrada' and $myrow3['statusCuenta']=='cerrada'){?>
<script>
window.opener.document.forms["form1"].submit();
window.alert("Cuenta Cerrada");
//window.close();
</script>
<?php 
}else { ?>

<script>
window.opener.document.forms["form1"].submit();
window.alert("Hay un problema con la cuenta");
//window.close();
</script>


<?php 
}

}
?>



<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script>

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








<?php //************************ACTUALIZO **********************
//Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$seguroT=ltrim($myrow3['seguro']);
//***************aplicar pago**********************


?>

<?php if($_POST['imprimir']){ ?>
<?php if($_GET['paquete']=='si'){ ?>
<script language="javascript">
nueva('/sima/cargos/imprimirReciboPaquetes.php?numeroE=<?php echo $myrow3['numeroE']; ?>&nCuenta=<?php echo $myrow3['nCuenta']; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&codigoPaquete=<?php echo $myrow3['codigoPaquete'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&paciente=<?php echo $_POST['paciente'];?>&cantidadRecibida=<?php echo $_POST['cantidadRecibida'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&fechaSolicitud=<?php print $_POST['variable_php'];?>','ventana7','800','600','yes');
//window.opener.document.form10["form10"].submit();
//window.alert("sandra");
window.close();
</script>
<?php } else { ?>
<script>
nueva('/sima/cargos/imprimirCargosPA.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&fechaSolicitud=<?php print $_POST['variable_php'];?>','ventana7','800','600','yes');
//window.opener.document.form10["form"].submit();

window.close();
</script>
<?php } ?>

<?php } ?>









  <?php
  $sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//***************aplicar pago**********************  

if($myrow3['statusCuenta']=='cerrada' and $myrow3['status']=='cerrada'){ 
  echo "LA CUENTA DEL PACIENTE ".$myrow3['paciente']." ESTA CERRADA...";
  ?>
    <input name="print" type="button" class="normal" id="print" value="Imprimir EC" onClick="ventanaSecundaria7('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow3['folioVenta'];?>');">

 
   
   <?php 
    } else{
  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">




<title></title>
<?php
$link=new ventanasPrototype();
$link->links();

$estilo=new muestraEstilos();
$estilo->styles();
?>
  <style type="text/css">
    .popup_effect1 {
      background:#11455A;
      opacity: 0.2;
    }
    .popup_effect2 {
      background:#FF0041;
      border: 3px dashed #000;
    }
    
  </style>	
  
  <script languaje="JavaScript">
            
var reloj=new Date(); 

          varjs=  reloj.getHours()+":"+reloj.getMinutes(); 

</script>


<h1 align="center" class="titulos">Nota de Venta </h1>
<form id="form1" name="form1" method="post" action="#">
  <table width="484" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr bgcolor="#330099">
      <th class="blanco" scope="col"><div align="left" class="blanco">Folio de Venta</div></th>
      <th class="blanco" scope="col"><div align="left" class="blanco"><?php 
		 echo $nCliente=$myrow3['folioVenta'];
		  ?>
          <input name="numeroE" type="hidden" class="blanco" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="134" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blanco">Paciente: </div></th>
      <th width="343" bgcolor="#FFFFFF"  scope="col"><div align="left" class="normal"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blanco">Compa&ntilde;&iacute;a: </td>
      <td bgcolor="#FFFFFF" class="normal">
        <label> <?php echo $traeSeguro=$myrow3['seguro']; ?>

            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
        </label>      </td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blanco">N&deg; Credencial: </td>
      <td bgcolor="#FFFFFF" class="normal"><?php echo $myrow3['credencial']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blanco">Fecha</td>
      <td bgcolor="#FFFFFF" class="normal"><?php echo cambia_a_normal($myrow3['fecha']); ?></td>
    </tr>
  </table>
  <p align="center">
  <?php if($_GET['codigoPaquete']){ 
  echo 'Paquete: '.$_GET['codigoPaquete'];
  
  }?></p>
  

  
  
<a href="#" 
onclick="javascript:ventanaSecundaria7('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow3['folioVenta'];?>')">
  <p align="center">&nbsp;</p>
  </a><div align="center">
    <p>&nbsp;</p>
    <table width="1124" border="0.2" align="center">
    <tr>
      <th width="54" bgcolor="#660066" class="blanco" scope="col"><div align="center">#</div></th>
      <th width= "341" bgcolor="#660066" class="blanco" scope="col"><div align="center">Descripcion</div></th>
      <th width= "76" bgcolor="#660066" class="blanco" scope="col"><div align="center">Totales</div></th>
      <th width= "35" bgcolor="#660066" class="blanco" scope="col"><div align="center">N</div></th>
      <th width= "86" bgcolor="#660066" class="blanco" scope="col"><div align="center">Particular</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Aseguradora</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Otros</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Coaseguro1</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Coaseguro2</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Deducible1</div></th>
	  <th bgcolor="#660066" class="blanco" scope="col"><div align="center">Deducible2</div></th>
	  </tr>
    <tr>

      <?php	


$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
folioVenta='".$_GET['folioVenta']."'";
 

 
 

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
$a+=1;
$nT=$myrow['keyClientesInternos'];
if($myrow['naturaleza']=='A'){
$signo='-';
}else{
$signo=NULL;
}
?>



      <td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php print $a;?></td>
      <td width="341" bgcolor="<?php echo $color?>" class="normal"><?php
	  if($myrow['descripcionArticulo']!=''){
	   echo $myrow['descripcionArticulo'];
	   }else if($myrow['gpoProducto'] and $myrow['naturaleza']=='A'){
	   echo 'Devolucion';
	   }else{
	   echo 'Operacion de Caja';
	   }
	   ?></td>

      <td width="76" bgcolor="<?php echo $color?>" class="normal"><div align="center">
<?php
echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);
?>
      </div></td>
      <td width="35" bgcolor="<?php echo $color?>" class="normal"><div align="center">
        <?php
echo $myrow['naturaleza'];

?>
      </div></td>
      <td width="86" bgcolor="<?php echo $color?>" class="normal"><div align="center">


<?php
echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);

?>

      </div></td>

<td width="97" bgcolor="<?php echo $color?>" class="normal"><div align="center">
  <?php
echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
?>



</div></td>

<td width="63" bgcolor="<?php echo $color?>" class="codigos"><div align="center">
<?php
echo '$0.00';
?>
</div></td>
<td width="84" bgcolor="<?php echo $color?>" class="codigos"><div align="center">
<?php
if($myrow['tipoTransaccion']=='PCoaS1'){ 
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '$0.00';
}
?>
</div></td>
<td width="84" bgcolor="<?php echo $color?>" class="codigos"><div align="center">
<?php
if($myrow['tipoTransaccion']=='PCoaS2'){
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '$0.00';
}
?>
</div></td>
<td width="78" bgcolor="<?php echo $color?>" class="codigos">
<?php
if($myrow['tipoTransaccion']=='PDeduSeg1'){
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '$0.00';
}
?>
</td>
<td width="80" bgcolor="<?php echo $color?>" class="codigos">
<?php
if($myrow['tipoTransaccion']=='PDeduSeg2'){
echo '$'.number_format($myrow['precioVenta'],2);
} else {
echo '$0.00';
}
?>
</td>
</tr> 

<?php 
//**************************TOTALES*************************
if($myrow['gpoProducto']!='' and $myrow['status']!='transaccion'){
if($myrow['naturaleza']=='C'){
$pVC[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaC[0]+=$myrow['iva']*$myrow['cantidad'];
}else{
$pVA[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaA[0]+=$myrow['iva']*$myrow['cantidad'];
}
}else {
$transacciones[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}
//**********************************************************



//***********************PARTICULAR***********************

if($myrow['naturaleza']=='C'){
$cantidadParticularCargo[0]+=$myrow['cantidadParticular']*$myrow['cantidad'];
$ivaParticularCargo[0]+=$myrow['ivaParticular']*$myrow['cantidad'];
} else {
$cantidadParticularAbono[0]+=$myrow['cantidadParticular']*$myrow['cantidad'];
$ivaParticularAbono[0]+=$myrow['ivaParticular']*$myrow['cantidad'];
}

//**********************************************************






//***************************ASEGURADORA*******************


if($myrow['naturaleza']=='C'){
$cantidadAseguradoraCargo[0]+=$myrow['cantidadAseguradora']*$myrow['cantidad'];
$ivaAseguradoraCargo[0]+=$myrow['ivaAseguradora']*$myrow['cantidad'];
}else{
$cantidadAseguradoraAbono[0]+=$myrow['cantidadAseguradora']*$myrow['cantidad'];
$ivaAseguradoraAbono[0]+=$myrow['ivaAseguradora']*$myrow['cantidad'];
}



//********************************************************



//**********************COASEGURO1****************************


if($myrow['tipoTransaccion']=='PCoaS1'){ 
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro1[0]+=$myrow['precioVenta'];
}else{
$totalAbonoCoaseguro1[0]+=$myrow['precioVenta'];
}
}


if($myrow['tipoTransaccion']=='PCoaS2'){
if($myrow['naturaleza']=='-'){
$totalCargoCoaseguro2[0]+=$myrow['precioVenta'];
}else{
$totalAbonoCoaseguro2[0]+=$myrow['precioVenta'];
}
}


if($myrow['tipoTransaccion']=='PDeduSeg1'){ 
if($myrow['naturaleza']=='-'){
$totalCargoDeducible1[0]+=$myrow['precioVenta'];
}else{
$totalAbonoDeducible1[0]+=$myrow['precioVenta'];
}
}


if($myrow['tipoTransaccion']=='PDeduSeg2'){
if($myrow['naturaleza']=='-'){
$totalCargoDeducible2[0]+=$myrow['precioVenta'];
}else{
$totalAbonoDeducible2[0]+=$myrow['precioVenta'];
}
}




//************************************************************
?>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
	</p>
	
	
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php 

$totales[0]=($pVC[0]+$ivaC[0])-($pVA[0]+$ivaA[0]);
$totalParticular=($cantidadParticularCargo[0]+$ivaParticularCargo[0])-($cantidadParticularAbono[0]+$ivaParticularAbono[0]);
$totalAseguradora=($cantidadAseguradoraCargo[0]+$ivaAseguradoraCargo[0])-($cantidadAseguradoraAbono[0]+$ivaAseguradoraAbono[0]);
$totalCoaseguro1=$totalCargoCoaseguro1[0]-$totalAbonoCoaseguro1[0];
$totalCoaseguro2=$totalCargoCoaseguro2[0]-$totalAbonoCoaseguro2[0];
$totalDeducible1=$totalCargoDeducible1[0]-$totalAbonoDeducible1[0];
$totalDeducible2=$totalCargoDeducible2[0]-$totalAbonoDeducible2[0];
?>
  
  
  
  
  <table width="200" border="1" align="center" class="normal">
    <tr>
      <td>Total</td>
      <td>Particular</td>
      <td>Aseguradora</td>
      <td>Otros</td>
      <td>Coaseguro1</td>
      <td>Coaseguro2</td>
      <td>Deducible1</td>
      <td>Deducible2</td>
    </tr>
    <tr>
      <td><?php echo '$'.number_format($totales[0],2);?></td>
      <td><?php if($totalParticular>0){ ?>
      <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalParticular;?>&amp;modoPago=efectivo&amp;tipoTransaccion=PCoaS1','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalParticular,2);?></a>
      <?php } else{
echo 'Ok';
} ?></td>
      <td>
	        <?php if($totalAseguradora>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;precioVenta=<?php echo $totalAseguradora;?>&amp;modoPago=cxc&amp;transaccion=aseguradora&amp;tipoTransaccion=aseguradora','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalAseguradora,2);?></a>
      <?php } else{
echo 'Ok';
} ?>	  </td>
      <td>$0.00</td>
      <td>
	  	        <?php if($totalCoaseguro1>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalCoaseguro1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS1','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalCoaseguro1,2);?></a>
      <?php } else{
echo 'Ok';
} ?>	
	  </td>
      <td>
	  	  	        <?php if($totalCoaseguro2>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalCoaseguro2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PCoaS2','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalCoaseguro2,2);?></a>
      <?php } else{
echo 'Ok';
} ?>
	  </td>
      <td>
	  	  	  	        <?php if($totalDeducible1>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalDeducible1;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg1','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalDeducible1,2);?></a>
      <?php } else{
echo 'Ok';
} ?>
	  </td>
      <td>
	  	  	  	  	        <?php if($totalDeducible2>0){ ?>
            <a href="javascript:nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&amp;numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $_GET['almacenSolicitante']; ?>&amp;almacenFuente=<?php echo $almacen; ?>&amp;seguro=<?php echo $seguroT; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>&amp;tipoVenta=<?php echo $_GET['tipoVenta'];?>&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;rand=<?php echo rand(1000,10000000);?>&amp;paquete=<?php echo $_GET['paquete'];?>&amp;transaccion=particular&amp;precioVenta=<?php echo $totalDeducible2;?>&amp;modoPago=efectivo&amp;tipoTransaccion=coaseguro&amp;numCoaseguro=PDeduSeg2','ventana7','800','800','yes');"> <?php echo '$'.number_format($totalDeducible2,2);?></a>
      <?php } else{
echo 'Ok';
} ?>
	  </td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <p align="center">
    <?php 

	
	//*********************************
	if($myrow3['tipoPaciente']=='externo'){

	if($totalParticular==0 and $totalAseguradora==0){ 
	?>
    <label>
    <input name="imprimir" type="image"  id="imprimir" value="Imprimir" src="/sima/imagenes/btns/printbutton.png" onClick="Disab (2)"/>
    </label>
    <?php }?>
  </p>
  <?php }else{ ?>
	<input name="cerrar" type="submit" class="normal" id="cerrar" value="Cerrar Cuenta" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas cerrar la cuenta?') == false){return false;}" />
<?php } ?>


 <input type="hidden" name="variable_php" id="variable_php" />

</form>

<p align="center">&nbsp;</p>
<script languaje="JavaScript">            
              document.form1.variable_php.value=varjs;
    </script>
</body>
</html>
<?php } ?>

<?php 
}

}
?>