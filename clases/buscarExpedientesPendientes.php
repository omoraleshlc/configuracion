<?php class despliegaExpedientesPendientes{
public function despliegaExpedientes($entidad,$ventana,$fecha1,$hora1,$almacen,$basedatos){ 
$almacenDestino=$almacen;
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
require("/configuracion/componentes/comboAlmacen.php"); 
?>

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" /> 
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 

<?php

if($_POST['entregar']){
$keyClientesInternos=$_POST['keyClientesInternos'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyClientesInternos[$i]){
$sql="update clientesInternos
set
statusExpediente='recibido'
where
keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}
}
?>

  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>


<p align="center">&nbsp;</p>



<body>

<form id="form1" name="form1" method="post" action="#">
  <p ><strong>BUSCAR EXPEDIENTES PENDIENTES</strong></p>

  <table width="645" class="table table-striped">
    <tr >
      <th width="51"   scope="col"><div align="left" >#Exp.</div></th>
      <th width="77"  scope="col"><div align="left" >Fecha</div></th>
      <th width="242"  scope="col"><div align="left" >Paciente</div></th>
      <th width="199"  scope="col"><div align="left" >M&eacute;dico</div></th>
      <th width="54"  scope="col"><div align="left" >Recibir</div></th>
    </tr>
    <tr class="Estilo26">
      
<?php 

	 
 $sSQL11= "
SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
fechaSolicitud!='".$fecha1."'
and
tipoPaciente='externo'
and
expediente='si'
and 
statusExpediente='standby'
and
statusCaja='pagado'
order by
numeroE ASC
";

$result11=mysql_db_query($basedatos,$sSQL11);

while($myrow11 = mysql_fetch_array($result11)){ 

$bandera+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

//****************************Terminan las validaciones
?>

<td   ><?php 
	  if($myrow11['expediente']=='si'){
	  echo $myrow11['numeroE'];
	  } else {
	  echo 'Sin Exp.';
	  }
	  ?></td>
      <td  ><?php 
	echo cambia_a_normal($myrow11['fechaSolicitud']);
	 
	  ?></td>
      <td  >
      <?php 
	echo $myrow11['paciente']
	 
	  ?>&nbsp;
      <div align="left"></div></td>
      <td  ><div align="left">
        <?php 
	 $sSQL711="SELECT descripcion,numConsultorio
FROM
almacenes
WHERE
entidad='".$entidad."' 

and
almacen='".$myrow11['almacenSolicitud']."'
";
  $result711=mysql_db_query($basedatos,$sSQL711);
  $myrow711 = mysql_fetch_array($result711);
	 echo $myrow711['descripcion'];
	
	 ?>
      </span></div>
      </td>
      <td  ><div align="left">
        <label>
	        <input type="checkbox" name="keyClientesInternos[]" value="<?php echo $myrow11['keyClientesInternos'];?>" 
		<?php if($myrow11['statusExpediente']!='standby' or $myrow11['statusExpediente']=='cargado')echo 'disabled';
		
		?> />
        </label>
      </div></td>
    </tr>
    <?php }?>
  </table>

<label>
      <div align="center">
	  
        <p>
          <input name="entregar" type="submit" class="style7" id="entregar" value="Aplicar Recepcion" />
        </p>
      </div>
    </label>
	<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>


<p>&nbsp; </p>


</body>
</html>
<?php
}
}
?>