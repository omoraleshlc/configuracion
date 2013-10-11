<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=450,height=200,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>





<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){

LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>

</head>

<body>
    
    

    
<?php
$estilo=new muestraEstilosV2();
$estilo->styles();

?>
    
<?php 

$sSQL2= "Select transacciones From almacenes WHERE almacen = '".$ALMACEN."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
//echo 'actualizar'.$_POST['actualizar'];
?>
    
    
  <header >
      
      

      
      
      
      
      
      
      
      
      
      
  <div class="container">   
<div class="barra_separadora">
     
     <span >CAJA</span>
     
</div>    
    

<h3> Alta de Pacientes Internos</h3>    
  





<?php 
$menuPrimario=new menus();
$menuPrimario->menuOperacionesBoot('../INGRESOS HLC/menuOperaciones.php?main=INGRESOS&warehouse=caja&datawarehouse=','Menu Principal ','INGRESOS','Caja',$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos);
?>    


















<form id="form1" name="form1" method="POST" >
  <h1 align="center" class="titulos"><br />
 </h1>

  <table class="table table-hover">

    <tr >
      <th  ><small>FolioV</small></th>
      <th  ><small>Datos del Paciente</small></th>

      <th  ><small>Departamento</small></th>
      <th  ><small>Enviar</small></th>
      <th  ><small>Pagar</small></th>
    </tr>
<?php	
	  
$cierreCuentaReporte=new articulosDetalles();
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
AND
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCuenta = 'caja'
and
status !='cerrada'

ORDER BY paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 



if($myrow['seguro']){
$sSQL40= "SELECT nomCliente
FROM
clientes
where 
numCliente='".$myrow['seguro']."' and entidad='".$entidad."'";

$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
}else{
$myrow40['nomCliente']='Particular';
}


	  ?>    
    
    
    <tr  >
      <td height="49" ><p><small><?php echo $myrow['folioVenta'];?></small></p></td>
      
      
      
      
      
      <td >
	        
      <small><?php echo $myrow['paciente'];	  ?></small>

	  <?php 
	  if($myrow['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '<span ><small><blink>'.'[Solicita Devolucion]'.'</blink></small></span>';
	  }
	  ?>
	  

	  
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $seguro; ?>"/>   
        
        
       <small> <br>
       <span > Enviada por:</span><span >  <?php echo $myrow['autoriza'];?>
      </span><span >
      el </span><span ><?php echo cambia_a_normal($myrow['fecha']);?></span>
       </small>
      </td>
      
      
      <td><small><span > 
	   <?php 
$sSQL42= "SELECT descripcion
FROM
almacenes
where 
almacen='".$myrow['almacen']."'";

$result42=mysql_db_query($basedatos,$sSQL42);
$myrow42 = mysql_fetch_array($result42);

 echo $myrow42['descripcion'];?></span></small></td>
      
      
      
      
      
      
      
      
      <td ><small> <?php 
	  if($myrow['statusDevolucion']!='si'){ $dev='';?>
          
	  <a  data-toggle="modal" href="#transferir">
          <img src="../bt/img/transfer.jpeg" alt="Transferir" height="30" width="30"> 
          </a>
                     
		<?php }else{ 
		$dev='si';
		echo '---';
		}
		?>


          
          
          </small>
          
          
          
          
      </td>
      
      
      <td>
          <small>
              <a href="javascript:nueva('/sima/cargos/cierraCuenta2.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>&devolucion=<?php echo $myrow['statusDevolucion'];?>&descripcionTransaccion=altaPacientes#final','ventanaNueva','1024','1000','yes')">
              <img src="../bt/img/pagar.jpg" alt="Pagar" height="30" width="30"> 
              </a>              
              
              
          </small>
          
      </td>
      
      
      
    </tr><?php  }}?>

  </table>

  
</form>



 


  <!-- Modal -->
  <div class="modal fade" id="transferir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">TRANSFERIR PX</h4>
        </div>
        <div class="modal-body">
        
            
            
            
            
        <?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar']  and $_POST['escoje']){


if($_POST['escoje']=='abierta'){

//******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$descripcion='Regresar a Cuenta Abierta';
$as=$_GET['almacen'];
$ad=$myrow7['almacen'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow7['folioVenta']."',
'".$myrow7['cuarto']."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************
$q = "UPDATE clientesInternos set 
statusCuenta='abierta' WHERE folioVenta='".$_GET['folioVenta']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
}else if($_POST['escoje']=='revision'){

    //******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$descripcion='Enviar a Revision o para cargar Coaseguro.';
$as=$_GET['almacen'];
$ad=$myrow7['almacen'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow7['folioVenta']."',
'".$myrow7['cuarto']."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************

$q = "UPDATE clientesInternos set 
statusCuenta='revision' WHERE folioVenta='".$_GET['folioVenta']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	


}

?>



<script >
window.alert("La cuenta se fue a status: <?php echo $_POST['escoje'];?>");
   window.opener.document.forms["form1"].submit();
  window.close();
</script>
<?php 
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />



</head>
<?php 
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

?>
<form name="form1" method="POST" >
    
    

      
      
      
      
  <table width="50" class="table table-hover">
    
      
    <tr>
      <th colspan="2">
      <small>Enviar Cuenta del px <?php echo $myrow['paciente'];?> </small>      </th>
    </tr>
      
      
    <tr>
      <td width="90" ><label>
        <input name="escoje" type="radio" value="abierta" />
      </label></td>
      <td width="416">Cuenta Activa (Hacer Cargos) </td>
    </tr>
      
      
      
    <tr>
      <td ><input name="escoje" type="radio" value="revision" /></td>
      <td>Cuenta en Revision (Cargar Coaseguro) </td>
    </tr>
      
      
  </table>
      
      
      
  <p align="center">
  <div class="modal-footer">
        <input type="Submit" name="actualizar" class="btn btn-success" value="Enviar"  ></input>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          
        </div>

  </p>
</form>


          
          
          
          
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  </div>
  </header>

</body>
</html>