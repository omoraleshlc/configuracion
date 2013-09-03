<?php  class editarResultados{
 
public function editaResultados($entidad,$reporteReportes,$fecha1,$ventana,$TITULO,$ALMACEN,$basedatos){
?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
 window.open(URL,"ventana","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
 window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
 window.open(URL,"ventanaSecundaria5","width=150,height=100,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<form id="form1" name="form1" method="post" action="agregarResultados.php">
  <h1 >LISTA DE ORDENES<br />
    <br />
  </h1>

  <table width="652" class="table table-striped">
    <tr>
      <th width="73"  scope="col"><div align="left" >FolioVenta</div></th>
      <th width="75"  scope="col"><div align="left" >Expediente</div></th>
      <th  scope="col"><div align="left" >Paciente</div></th>
      <th  scope="col"><div align="left" >Cuarto</div></th>
      <th  scope="col"><div align="left" >TipoPaciente</div></th>
      <th  scope="col"><div align="left" >Hora</div></th>
      <th  scope="col"><div align="left" >Prioridad</div></th>
      <th  scope="col"><div align="left" >Detalles</div></th>
    </tr>
    
      
      
      

      <?php	

$sSQL= "SELECT *
FROM
clientesInternos

WHERE 
entidad='".$entidad."'
and
folioVenta!=''
and
statusCuenta='cerrada'
and
tipoPaciente='externo'
and
fecha='".$fecha1."'

";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$keyCAP=$myrow['keyCAP'];
$codigo=$myrow['codProcedimiento'];
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$tipoPaciente=$myrow['tipoPaciente'];

	  ?>
      
      
            <tr>
      <td height="20" bgcolor="<?php echo $color?>" ><div align="center" ><?php echo $myrow['folioVenta'];?> </div></td>
      <td height="20" bgcolor="<?php echo $color?>" ><div align="center" ><?php echo $myrow['numeroE'];?> </div></td>
      <td width="143" bgcolor="<?php echo $color?>" >
	  <?php 

echo $myrow['paciente'];
?></span></td>
      <td width="61" bgcolor="<?php echo $color?>" >
  	    <div align="center">
  	      <?php 
$devuelveCuarto=new pacientes();
if($devuelveCuarto->devuelveCuarto($numeroE,$nCuenta,$basedatos)==TRUE){
echo $devuelveCuarto->devuelveCuarto($numeroE,$nCuenta,$basedatos);
} else {
echo '---';
}
?>
      &nbsp;</div></td>
      <td width="94" bgcolor="<?php echo $color?>" ><?php echo $myrow['tipoPaciente'];?></td>
      <td width="44" bgcolor="<?php echo $color?>" ><?php echo $myrow['horaSolicitud'];?>

      </span></td>
      <td width="71" bgcolor="<?php echo $color?>" ><?php echo $myrow['prioridad'];?></td>
      <td width="57" bgcolor="<?php echo $color?>" ><div align="center" >
              <?php if($myrow['numeroE']>0){?>
              <a   href="javascript:ventanaSecundaria1('/queries/multipowupload/ejemplo.php?folioVenta=<?php echo trim($myrow['folioVenta']);?>&numeroE=<?php echo $myrow['numeroE']; ?>&keyPA=<?php echo $myrow18['keyPA'];?>&almacenDestino=<?php echo $_POST['almacenDestino'];?>')">
                  Cargar
              </a>
              <?php }else{ echo '---';}?>
          </div>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  
    
    
    
  <p align="center">
    <label></label>
  </p>
  <p><span ><span >
    <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
    </span></span>
    <input name="almacen1" type="hidden" id="almacen1" value="<?php echo $_POST['almacen']; ?>" />
    <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_POST['almacen1']; ?>" />
    <input name="almacen3" type="hidden" id="almacen3" value="<?php echo $_POST['almacen2']; ?>" />
    <input name="almacen" type="hidden" id="almacen3" value="<?php echo $_POST['almacen3']; ?>" />
  </p>
</form>
</body>
</html>
<?php
}
}

?>