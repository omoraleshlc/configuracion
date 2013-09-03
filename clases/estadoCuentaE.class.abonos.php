<?php 
class eCuentasE{
public function eCuentaE($mostrar,$usuario,$entidad,$almacen,$fecha1,$hora1,$dia,$usu,$nT,$basedatos){
$folioVenta=$_GET['folioVenta'];

$cargosCia=new acumulados();



//**********************************CANDADO PRINCIPAL**********************
$bali=$almacen;
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

/* $sSQL1= "Select usuario,folioVenta From transacciones WHERE entidad='".$entidad."' and folioVenta ='".$_GET['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error(); */




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
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();



//********************CIERRO STATUS CUENTA***********************
$agrega = "UPDATE cargosCuentaPaciente set 
statusCuenta='cerrada'
where
entidad='".$entidad."'
and
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
entidad='".$entidad."'
and
codigoCuarto='".$myrow3['cuarto']."' 
";

//mysql_db_query($basedatos,$agregad);
echo mysql_error();
}
$leyenda='Se cerr� la cuenta';



  $sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
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
  $sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$kCI=$myrow3['keyClientesInternos'];
//***************aplicar pago**********************  

if($myrow3['statusCuenta']=='cerrada' and $myrow3['status']=='cerrada'){ 
  echo "LA CUENTA DEL PACIENTE ".$myrow3['paciente']." ESTA CERRADA...";
  ?>
    <input name="print" type="button" class="normal" id="print" value="Imprimir EC" onClick="ventanaSecundaria7('/sima/INGRESOS HLC/caja/imprimirEstadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow3['folioVenta'];?>');">

 
   
   <?php 
    } else{
  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



  <?php include('/configuracion/clases/encabezado.php');?>
  <?php include('/configuracion/clases/mostrarDatosCuenta.php');?>
      <?php include('/configuracion/clases/mostrarDatosEC.php');?> 
  <?php include('/configuracion/clases/hacerAbonosSlide.php');?>
	       <?php include('/configuracion/clases/mostrarEfectuarTransacciones.php');?>
</body>
</html>
<?php } ?>

<?php 
}

}
?>
