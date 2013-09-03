<?php class imprimirServicios{
public function imprimirServiciosP($entidad,$fecha1,$hora1,$numeroE,$nCuenta,$keyCAP,$basedatos){ ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=800,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php





if($_POST['cerrar'] ){

?>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<script type="text/javascript">
	

		close();
	
</script>


<script language="JavaScript" type="text/javascript">
function imprimirPagina() { if (window.print) window.print(); else alert("Lo siento, pero a tu navegador no se le puede ordenar imprimir" + " desde la web. Actualizate o hazlo desde los menús"); }
</script>

<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
.style17 {color: #000000; font-size: 10px; font-weight: bold; }
-->
</style>
</head>
<h1 align="center">HOSPITAL LA CARLOTA</h1>
<h4 align="center">Ordenes de cargo </h4>
<form id="form1" name="form1" method="post" action="">
  <table width="577" border="0" align="center">
    <tr>
      <th width="93" scope="col"><div align="left"><span class="style17">Hora/Fecha</span></div></th>
      <th width="157" scope="col"><div align="left"><span class="style17">Paciente - Cuarto</span></div></th>
      <th width="177" scope="col"><div align="left"><span class="style17">Descripci&oacute;n</span></div></th>
    </tr>
    <tr>
<?php	



$sSQL18= "
SELECT 
*
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
statusImpresionSolicitud='standby'
and
usuario='".$_GET['usuario']."'
order by codProcedimiento ASC
";
$result18=mysql_db_query($basedatos,$sSQL18);
while($myrow18 = mysql_fetch_array($result18)){

$q = "UPDATE cargosCuentaPaciente set 
statusImpresionSolicitud='cargado'
where

keyCAP='".$myrow18['keyCAP']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();



$requi=$myrow18['id_requisicion'];
$id_proveedor=$myrow18['id_proveedor'];
$id_almacen=$myrow18['id_almacen'];
$b+='1';
$a+='1';

if($col){
$color = '#CCCCCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$code1=$myrow18['codProcedimiento'];
$sSQL4= "Select * From articulos WHERE entidad='".$entidad."' and codigo= '".$code1."'";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);


$descripcion=$myrow4['descripcion'];


$sSQL7= "Select * From existencias WHERE entidad='".$entidad."' and codigo= '".$code1."' and almacen='HALM'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


 $sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and numeroE= '".$myrow18['numeroE']."' 
and
nCuenta='".$myrow18['nCuenta']."'
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style7">
      </span><span class="style7">
      <?php 
	 
	  echo $myrow18['hora1']."-".cambia_a_normal($myrow18['fecha1']);
	  	 		?>
      </span></div>        
        <span class="style7"><label></label>
        <div align="center"></div>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	 
	  echo $myrow1['paciente']."-".$myrow1['cuarto'];
	  	 		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $descripcion; ?><span class="Estilo24">
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
      </span></span></td>
    </tr>
    <?php  } //cierra while ?>
  </table>
  <div align="center">  </div>
  <p align="center">
    <input name="cerrar" type="submit" class="style7" id="cerrar" value="Cerrar" />
  </p>
</form>
</body>
</html>
<?php
}
}
?>