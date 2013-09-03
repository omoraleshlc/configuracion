<?php class despliegaExpedientesPendientes{
public function despliegaExpedientesEnviados($entidad,$ventana,$fecha1,$hora1,$almacen,$basedatos){ 
$almacenDestino=$almacen;
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
require("/configuracion/componentes/comboAlmacen.php"); 
?>

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-win2k-2.css" title="win2k-cold-1" /> 
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
statusExpediente='recibido',
usuarioRecepcionExpediente='".$usuario."'
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
  <p align="center" ><strong>Expedientes que se Reciben </strong></p>
  <table width="600" class="table table-striped">

    <tr >
      <th width="79"  align="center">N&deg; Exp</th>
      <th width="271" >Paciente</th>
      <th width="253" >M&eacute;dico</th>
      <th width="47"  align="center">Recibir</th>
    </tr>
 <?php 

	 
$sSQL11= "
SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
    and
fechaSolicitud='".$fecha1."'
and

expediente='si'
and
statusExpediente='standby'
and
(statusCaja='pagado' or status='cortesia')
and
folioVenta!=''
order by
numeroE ASC
";

$result11=mysql_db_query($basedatos,$sSQL11);

while($myrow11 = mysql_fetch_array($result11)){ 
echo mysql_error();
$bandera+=1;


//****************************Terminan las validaciones
?>   
    
<tr  >
    
    
      <td   align="center">
        <?php 
	  if($myrow11['expediente']=='si'){
	  echo $myrow11['numeroE'];
	  } else {
	  echo 'Sin Exp.';
	  }
	  ?>
      </span></span></td>
      <td >
        <?php 
	echo $myrow11['paciente']
	 
	  ?>
      </br>
     <span >Hora y Fecha: </span>
      <span ><span>
      <?php 
 echo $myrow11['hora']." ".$myrow11['fecha'];


?>
      </span>      </span></td>
      <td><span >
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
      </span></td>
      <td align="center"><input type="checkbox" name="keyClientesInternos[]" value="<?php echo $myrow11['keyClientesInternos'];?>" 
		<?php if($myrow11['statusExpediente']=='recibido')echo 'disabled';
		
		?> /></td>
    </tr> <?php }?>


    
    <tr>
      <td colspan="4" align="center">
          <?php if($bandera>0){?>
          <input name="entregar" type="submit" src="/sima/imagenes/btns/new_recibe.png" id="entregar" value="Recibir" />
      <?php }else{ echo 'No hay registros para mostrar...';}?>      </td>
      
    </tr>
  </table>
 
 <label>

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