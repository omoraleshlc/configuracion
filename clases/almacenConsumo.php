<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=300,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=1024,height=800,scrollbars=YES")
} 
</script> 


<?php 

$ALMACEN=$_GET['datawarehouse'];
if(!$ALMACEN){print '<script>window.alert("Favor de asignar almacen en modulos primarios, gracias!");</script>';}
?>

<?php if($_POST['continue']){ ?>

<script>
javascript:ventanaSecundaria1('../cargos/ventaac.php?almacen=<?php echo $_POST['almacenDestino'];?>&nombreCliente=<?php echo $_GET['nombreCliente'];?>&keyMOV=<?php echo $_POST['keyMOV'];?>');

//opener.location.reload();


window.close();
</script>

<?php
}
?>


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la orden ?')) return true;
return false;
}
-->
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<h1 align="center">Almacen de Consumo </h1>
<form id="form1" name="form1" method="post" action="">
  <p align="center">&nbsp;<em>Escoje el MiniAlmacen</em>
<?php 
	
	if($_GET['almacenDestino']){
	$_POST['almacenDestino']=$_GET['almacenDestino'];
	}
	

	
	
$aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and
almacenPadre='".$ALMACEN."'
and
almacenConsumo='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="this.form.submit();" />        
     <option
	 	<?php 
		if( !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		}  ?>
	  value="">Escoje</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select><?php if($_POST['almacenDestino']){ ?>

  </p>



















   
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <div align="center" ><strong>
    <?php if($a){ 
	echo "Vendiste $vendiste[0] articulos..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
    <label>
    <input name="continue" type="submit"  id="solicitar" value="Solicitar Consumibles"    />
    </label>
    <label></label>
    <span class="style7">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a; ?>" />
  </span></p>
  <p align="center">
    <label></label>
  </p>
  <?php } ?>
</form>
</body>
</html>