<?php $ALMACEN=$_GET['datawarehouse'];?>
<script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=600,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la cuenta ?')) return true;
return false;
}
-->
</script>

<?php  
if(is_numeric($_GET['rand']) AND $_GET['cierre']=='si' ){

$sSQL31= "SELECT statusCuenta FROM
clientesInternos
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($myrow31['statusCuenta']=='abierta' or $myrow31['statusCuenta']=='revision' or $myrow31['statusCuenta']=='caja'){

if($_GET['tipoCierre']=='revision' and $myrow31['statusCuenta']=='abierta'){

//******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
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
statusCuenta='revision'

 WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' and statusCuenta!='cerrada'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
} else if($_GET['tipoCierre']=='caja' and $myrow31['statusCuenta']=='revision') {
        //******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
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
statusCuenta='caja'
 WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' and statusCuenta!='cerrada'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}
}
}
?>



<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventanaSecundaria20","width=500,height=240,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>





</head>
<META HTTP-EQUIV="Refresh"
CONTENT="100"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1  >Solicitudes a Pacientes Internos</h1>
  <p align="center" >
Escoje:       
<select name="almacenDestino1"  id="almacenDestino1" onChange="javascript:this.form.submit();" />        
<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND tieneCuartos = 'si' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($result1)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino1']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
  </p>
  <p align="center" >(Para ver el estado de cuenta y cargos que se han hecho al paciente, <br />
Presiona sobre su Nombre)</p>
  <table width="646s" class="table table-striped">

    <tr>
        <th width="10"  align="center">#</th>
      <th width="100"  align="center">Folio V</th>
      <th width="266" >Paciente</th>
      <th width="211"  align="center">Seguro</th>
      <th width="80"  align="center">Transferir</th>
      <th width="71"  align="center">Solicitar</th>
      <th width="118"  align="center">Alta de Px</th>
    </tr>
      <?php	
if(!$_POST['almacenDestino1']){
$_POST['almacenDestino1']=$ALMACEN;
}


$sSQLe= "SELECT 
ventas
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$ALMACEN."'   ";
$resulte=mysql_db_query($basedatos,$sSQLe);
$myrowe = mysql_fetch_array($resulte);


$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
(status='activa' or status='ontransfer' )
and 
statusCuenta = 'abierta'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
almacen='".$_POST['almacenDestino1']."'

ORDER BY paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$guia+=1;


$sSQL31cd= "SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['seguro']."' 
";
$result31cd=mysql_db_query($basedatos,$sSQL31cd);
$myrow31cd = mysql_fetch_array($result31cd);



$sSQL31cdd= "SELECT 
usuario
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."' 
    and
    statusCargo='standbyR'
    group by usuario
";
$result31cdd=mysql_db_query($basedatos,$sSQL31cdd);
$myrow31cdd = mysql_fetch_array($result31cdd);


//************VERIFICO SI PERMITE VENTAS***************

?>    
    
    <tr >
        <td  align="center" ><?php echo $guia;?></td>
      <td  align="center" ><?php echo $myrow['folioVenta'];?></td>
      <td >
<a name="ec<?php echo $guia;?>" href="#ec<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>
nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta']; ?>')">
	  <?php echo $myrow['paciente'];
	  if($myrow['solicitaTransferencia']=='si'){
	  echo '</a></br><span class="codigos">'.'   [Paciente Transferido]'.'</span>';
	  }
	 ?></a><br />
         
         
         
         
       <span > Cuarto: 
      <?php echo $myrow['cuarto']
?></span>
      
      
      
      
      
          <?php if($myrow31cdd['usuario']!=''){
          echo '<br>';
          echo '<blink><span class="error">ALERTA!</span></blink>';
          echo '<br>';
          echo  '<span class=precio1>-El usuario: '.$myrow31cdd['usuario'].', tiene articulos/Servicios pendientes de enviar...</span>';
          echo '<br>';
}
?>
      
         
         
         
      
      
      </td>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      <td  align="center">
        <?php 
	  if($myrow31cd['nomCliente']){
	  echo $myrow31cd['nomCliente'];
	  } else {
	  echo 'particular';
	  }
?>
          
          
               <?php if($myrow['statusCuenta']=='revision'){ ?>
        <?php if($myrow['fecha']==$fecha1){?>
      <a href="#" onClick="javascript:ventanaSecundaria1('../ventanas/actualizaPagos.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>')">
          <div class="success"><blink>Recalcular Cuenta</blink></div> 
      </a>
        <?php }else{?>
        <div class="error"><blink>Solo CxC puede recalcular la cuenta...</blink></div> 
        <?php }?>
<?php } ?>      
          
   </td>
   
   
   
      <td  align="center">
          
          <?php if($myrow31cdd['usuario']==''){?>
          <a href="javascript:ventanaSecundaria20('../ventanas/departamentoTransferencia.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;usuario=<?php echo $usuario; ?>#trans<?php echo $guia;?>')" name="trans<?php echo $guia;?>" id="trans<?php echo $guia;?>"  onclick="if(confirm('Estas seguro que deseas transferir la cuenta?') == false){return false;}">Transferir PX
      </a>
    <?php }else{
          echo '<br>';
          echo '<blink><span class="informativo"></span></blink>';
    }?>
              
              </td>
              
              
              
              
              
      <td  align="center" ><?php if($myrow['statusCuenta']!='revision'){ ?>

       <?php if($myrowe['ventas']=='si'){ ?>   
          <a href="#solicitar<?php echo $guia;?>" name="solicitar<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('../cargos/solicitaArticulos.php?numeroE=<?php echo $myrow['numeroE']; ?>
&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')">
    Solicitar
</a>
          <?php }else{ 'Restringido!';}?>
          
        <?php } else { echo '---';}?>        </td>
      
      
      
      
      
      
      <td  align="center">

     
          
          
          
      <?php if( $myrow['statusCuenta']=='abierta'){ ?>
        <a name="status<?php echo $guia;?>" href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=revision#status<?php echo $guia;?>" onClick="return comprueba();"> Alta de PX</a>
            
        <?php } else if($myrow['statusCuenta']=='revision'){ ?>
        <a name="status<?php echo $guia;?>" href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=caja#status" onClick="return comprueba();"> Alta de PX</a>
        <?php } else {
		  
		  echo '---';
		  } ?>
  
      
        <?php if($myrow31cdd['usuario']==''){
          echo '<br>';
          echo '<blink><span class="informativo"></span></blink>';
    }?>
      </td>
      
          <?php  }}?>
      
    </tr>
    

  </table>
  
  <span ><span >
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>

</form>
</body>
</html>