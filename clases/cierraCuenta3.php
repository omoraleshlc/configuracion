<?php 
class eCuentasE{
public function eCuentaE($folioVenta,$usuario,$entidad,$almacen,$fecha1,$hora1,$dia,$usu,$nT,$basedatos){

include("/configuracion/funciones.php"); 
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




<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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
//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$seguroT=ltrim($myrow3['seguro']);
//***************aplicar pago**********************

if($_POST['actualizar']){



$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];
for($i=0;$i<=$_POST['bandera2'];$i++){

if($aseguradora[$i]){
$status='efectivo';
$keyCAP[]=$aseguradora[$i];
} else {

$status='cxc';
$keyCAP[]=$particular[$i];
}


$agrega = "UPDATE cargosCuentaPaciente set 
statusAlta='".$status."',
usuarioAlta='".$usuario."',
fechaAlta='".$fecha1."',
horaAlta='".$hora1."'

where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();




} //cierra for

} //cierra actualizar






$cargosParticulares=new  acumulados();
$totalxSurtir=new  acumulados();
$cargosAseguradora= new acumulados();
$otros= new acumulados();


if($_POST['imprimir']){ 

//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$actualiza3 = "UPDATE clientesInternos,cargosCuentaPaciente
set
cargosCuentaPaciente.codigoCaja='".$myrowC['keyCatC']."',
cargosCuentaPaciente.numRecibo='".$myrowCa['numRecibo']."',
cargosCuentaPaciente.numCorte='".$myrowC['numCorte']."',
clientesInternos.codigoCaja='".$myrowC['keyCatC']."',
clientesInternos.numRecibo='".$RECIBO."',
clientesInternos.numCorte='".$myrowC['numCorte']."',
cargosCuentaPaciente.folioVenta='".$_GET['folioVenta']."',
clientesInternos.folioVenta='".$_GET['folioVenta']."'


WHERE 
clientesInternos.folioVenta='".$_GET['folioVenta']."'
and
clientesInternos.folioVenta=cargosCuentaPaciente.folioVenta
";
//mysql_db_query($basedatos,$actualiza3);
echo mysql_error();
//*************************************************************
?>
<?php if($_GET['paquete']=='si'){ ?>
<script language="javascript">
nueva('/sima/cargos/imprimirReciboPaquetes.php?numeroE=<?php echo $myrow3['numeroE']; ?>&nCuenta=<?php echo $myrow3['nCuenta']; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&codigoPaquete=<?php echo $myrow3['codigoPaquete'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&paciente=<?php echo $_POST['paciente'];?>&cantidadRecibida=<?php echo $_POST['cantidadRecibida'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>','ventana7','800','600','yes');
//window.opener.document.form10["form10"].submit();
//window.alert("sandra");
window.close();
</script>
<?php } else { ?>
<script>
nueva('/sima/cargos/imprimirCargosPA.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>','ventana7','800','600','yes');
//window.opener.document.form10["form"].submit();

window.close();
</script>
<?php } ?>

<?php }
?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>






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
</head>

<h1 align="center" class="titulos">Nota de Venta </h1>
<form id="form1" name="form1" method="post" action="#">
  <table width="642" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="blanco" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Folio de Venta</div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco"><?php 
		 echo $_GET['folioVenta'];
		  ?>
         
</label></div>      </th>
    </tr>
    <tr>
      <th width="10" class="normal" scope="col">&nbsp;</th>
      <th width="134" bgcolor="#FFCCFF" class="normal" scope="col"><div align="left" class="normal">Paciente: </div></th>
      <th width="408" bgcolor="#FFCCFF"  scope="col"><div align="left" class="normal"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td class="normal">Compa&ntilde;&iacute;a: </td>
      <td class="normal">
        <label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
        </label>
      </td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="normal">N&deg; Credencial: </td>
      <td bgcolor="#FFCCFF" class="normal"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
  </table>
  <p align="center">
  <?php if($_GET['codigoPaquete']){ 
  echo 'Paquete: '.$_GET['codigoPaquete'];
  
  }?></p>
  

  
  <table width="761" border="0" align="center">
    <tr>
      <th width="306" height="14" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Descripci&oacute;n/Concepto</div></th>
      <th width="33" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Cant</div></th>
      <th width="76" bgcolor="#660066" class="blanco" scope="col">P.Unitario</th>
      <th width="76" bgcolor="#660066" class="blanco" scope="col"><div align="left">Particular</div></th>
      <th width="76" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Aseguradora</div></th>
      <th width="47" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">IVA</div></th>
      <th width="96" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Convenio</div></th>
      <th width="17" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">N</div></th>
    </tr>
    <tr>
    
      <?php //traigo agregados
	  

$sSQL81= "
SELECT 
*
FROM
cargosCuentaPaciente 
 WHERE 
folioVenta='".$_GET['folioVenta']."'
 
 
 
  order by folioVenta asc
";






$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 
		 $a+= '1';


$chain=$myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];






		if($myrow81['naturaleza']=='A'){
		$abonos[0]+=$myrow81['precioVenta'];
		
		} else {
		$abonos[0]='0.00';
		}
?>

  <td height="21" bgcolor="<?php echo $color;?>" class="normal">
      <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
					if($myrow81['tipoPago']){
		echo '('.$myrow81['tipoPago'].')';
		}
		?>
         
		
        <?php  if($myrow811['um']=='s' or $myrow811['um']=='S'){
		echo '  ( Servicio )  ';
		} 
		?>      </td>
      <td bgcolor="<?php echo $color;?>" ><div align="center" class="normal">
          <?php  
	

		
		echo $cantidad=$myrow81['cantidad'];
			
		

		
		?>
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><?php 
	
echo '$'.number_format($myrow81['precioVenta'],2);
	
		?></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><?php 
	  if($myrow81['naturaleza']=='C'){
	$particular[0]+=$myrow81['cantidadParticular']*$myrow81['cantidad'];
	}
echo '$'.number_format($myrow81['cantidadParticular']*$myrow81['cantidad'],2);
	
		?></td>
      <td bgcolor="<?php echo $color;?>" class="normal">
        <?php 
			  if($myrow81['naturaleza']=='C'){
	$aseguradora[0]+=$myrow81['cantidadAseguradora']*$myrow81['cantidad'];
	}
echo '$'.number_format($myrow81['cantidadAseguradora']*$myrow81['cantidad'],2);
	
		?>   </td>
      <td bgcolor="<?php echo $color;?>" class="normal">
        <?php 
			  if($myrow81['naturaleza']=='C'){
		$ivaTotal[0]+=$myrow81['iva']*$myrow81['cantidad'];
	}
	
	
	echo '$'.number_format($myrow81['iva']*$myrow81['cantidad'],2);

		?>      </td>
      <td bgcolor="<?php echo $color;?>"><span class="normal">
        <?php 

	  if($myrow81['tipoConvenio'] AND $myrow81['tipoConvenio']!='No'){
	  echo '<img src="/sima/imagenes/cci/grafica.png" width="20" height="20" />';
	   }else{echo '---';}
		?>
      </span></td>
      <td bgcolor="<?php echo $color;?>"><div align="center" class="normal">
	   
      
        <div align="left">
          <?php 

	 echo $myrow81['naturaleza'];
		?>
             </div>
      </div></td>
	</tr>
 
	
	
    <?php }?>
  </table>

  <p>&nbsp;</p>
  <div align="center">
    <table width="558" border="0" align="center">
      <tr>
        <td width="113" class="style12">&nbsp;</td>
        <td width="124" class="style12">&nbsp;</td>
        <td width="97" class="normal">Total Cargos 
          <?php 
		 $suma=$particular[0]+$aseguradora[0]+$ivaTotal[0];
         echo '$'.number_format($suma,2);
		?>
      </td>
        <td width="106" height="23"><div align="left" class="normal">Total Abonos 
            <?php 		
echo '$'.number_format($abonos[0],2);
		?>
        </div></td>
        <td width="96"><div align="left" class="normal"><strong>Saldo Actual</strong><strong>
          <?php 
		  $total=($suma-$abonos[0]);
	
		  echo "$".number_format($suma-$abonos[0],2);
	
		
		?>
        </strong></div></td>
      </tr>
      <tr>
        <td class="style12">&nbsp;</td>
        <td class="style12">&nbsp;</td>
        <td class="style12"><input name="cantidadRecibida" type="hidden" class="style7" id="cantidadRecibida" value="" /></td>
        <td height="23" class="normal"><div align="right"></div></td>
        <td class="normal"><div align="right"></div></td>
      </tr>
      <tr>
        <td class="style12">&nbsp;</td>
        <td class="style12">&nbsp;</td>
        <td class="style12">&nbsp;</td>
        <td height="23" class="style23 Estilo24"><div align="right"></div></td>
        <td class="style12"><div align="right"></div></td>
      </tr>
    </table>



</div>
  <p align="center">
	<?php 

	
	//*********************************
	

	if(round($total)==NULL){ 
	?>
    <label>
    <input name="imprimir" type="image"  id="imprimir" value="Imprimir" src="/sima/imagenes/btns/printbutton.png" onclick="Disab (2)"/>
    </label>
	<?php } else {?>
    <input name="cargado" type="image" value="Aplicar Pagos" src="/sima/imagenes/btns/aplicapay.png"  onclick="nueva('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&numeroE=<?php echo $numeroE; ?>
&almacen=<?php echo $_GET['almacenSolicitante']; ?>&almacenFuente=<?php echo $almacen; ?>&seguro=<?php echo $seguroT; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'particular';?>&tipoVenta=<?php echo $_GET['tipoVenta'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&rand=<?php echo rand(1000,10000000);?>&paquete=<?php echo $_GET['paquete'];?>','ventana7','500','600','yes')"/>
   
	<?php } ?>
  </p>


</form>

<p align="center">&nbsp;</p>

</body>
</html>
<?php 
}

}
?>

