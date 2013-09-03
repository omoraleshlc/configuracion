<?php class despliegaExpedientesPendientes{
public function despliegaExpedientes($entidad,$ventana,$fecha1,$hora1,$almacen,$basedatos){ 
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
statusExpediente='standby',
usuarioRecepcionExpediente='".$usuario."'
where
keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se recibieron expedientes...';
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



  <body>
<br />

<form id="form1" name="form1" method="post" action="#">
  <p align="center" ><strong>Salida de Expedientes</strong></p>
  
  <p align="center" ><strong>
      
             <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
      
      </strong></p>
  
  <table width="600" class="table table-striped">

    <tr >
      <th width="80"  align="center">N&deg; Exp</th>
      <th width="301" >Paciente</th>
      <th width="257" >M&eacute;dico</th>
      <th width="42"  align="center">Salida</th>


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
statusExpediente='request'
and
(statusCaja='pagado' or status='cortesia')
and
folioVenta!=''
and
statusDevolucion!='si'
order by
numeroE ASC
";

$result11=mysql_db_query($basedatos,$sSQL11);

while($myrow11 = mysql_fetch_array($result11)){ 
echo mysql_error();
$bandera+=1;
?>
    <tr > 
      <td height="57" align="center" >
           <?php 
	  if($myrow11['expediente']=='si'){
	  echo $myrow11['numeroE'];
	  } else {
	  echo 'Sin Exp.';
	  }
	  ?>
     </td>
      <td > <?php 
	echo $myrow11['paciente']
	 
	  ?></br>
    <span >Hora y Fecha:<span >
    <?php 
 echo $myrow11['hora']." ".cambia_a_normal($myrow11['fecha']);


?>
    </span></span></br>
      <span >Departamento que solicita: </span> <span >
      <?php 
	 $sSQL711a="SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."' 

and
almacen='".$myrow11['almacen']."'
";
  $result711a=mysql_db_query($basedatos,$sSQL711a);
  $myrow711a = mysql_fetch_array($result711a);

	
	 ?>
      
      
	  <?php  echo $myrow711a['descripcion']; ?>	</span>  
      </td>
      <td >
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
  
     if($myrow711['descripcion']){
	 echo $myrow711['descripcion'];
	 }else{
	 print '---';
	 }
	 ?>
      </td>

      
      <td align="center">
       <label>
	        <input type="checkbox" name="keyClientesInternos[]" value="<?php echo $myrow11['keyClientesInternos'];?>" 
		<?php if($myrow11['statusExpediente']=='cargado')echo 'disabled';
		
		?> />
        </label>
      </td>
      
    </tr>
    <?php }?>


    
    <?php if($bandera>0){?>
    <tr>
      <td colspan="5" align="center"><input name="entregar" type="submit" src="../imagenes/btns/new_salida.png" id="entregar" value="Aplicar Salida" /></td>
    
    <?php }else{ echo '<div align="center">No hay registros para mostrar...';echo '</div>';}  ?>
      </tr>
  </table>

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