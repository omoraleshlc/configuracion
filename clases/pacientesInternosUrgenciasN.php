<?php
class pacientesInternosUrgencias{
public function listadoPI($entidad,$TITULO,$ventana,$ventana1,$bali,$basedatos){
?>
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
if (confirm('Estas seguro de enviar a caja?')) return true;
return false;
}
-->
</script>
<?php

if($_GET['transfer']=='yes'){





$q = "UPDATE clientesInternos set 
solicitaTransferencia='no',
statusCuenta = 'abierta',
tipoPaciente='interno', 
status='activa'
WHERE 
keyClientesInternos='".$_GET['keyCI']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
$_GET['transfer']='no';
$transfer='no';
?>
<script language="JavaScript" type="text/javascript">
ventanaSecundaria('/sima/OPERACIONESHOSPITALARIAS/admisiones/transferirPaciente1.php?keyClientesInternos=<?php echo $_GET['keyCI']; ?>');
  <!--
    opener.location.reload(true);

  // -->
</script>
<?php 
} else {

$transfer='yes';
}
?>

<script type="text/javascript">
<!--
function comprueba1()
{
if (confirm('Estas seguro(a) de empezar con la revision de la cuenta? ya no podras hacer cargos..')) return true;
return false;
}
-->
</script>


<?php  
if(is_numeric($_GET['rand']) AND $_GET['cierre']=='si' ){

if($_GET['tipoCierre']=='revision'){

$q = "UPDATE clientesInternos set 
statusCuenta='revision' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
} else if($_GET['tipoCierre']=='caja'){
$q = "UPDATE clientesInternos set 
statusCuenta='caja' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
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

<style type="text/css">
<!--
.Estilo1 {
	font-size: 14px;
	color: #0000FF;
}
.Estilo4 {font-size: 14px}
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos"><?php echo $TITULO;?></h1>
  <span class="style12"></span>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="954" height="24" />
  <table width="954" border="0.2" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="63" bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="left">Folio V</div>
      </div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">Nombre del paciente</span></div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">Seguro</div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="center" class="none">
        <div align="center">Departamento</span></div>
      </div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="center" class="none">
        <div align="center">Cub&iacute;culo</span></div>
      </div></th>
      

      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="center" class="none">Lista</div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="center" class="none">Status</div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="center" class="none">Coaseguro</div></th>

      
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="center" class="none">Part/Aseg</span></div></th>
      <?php if($ventana1){ ?>    
      <th bgcolor="#FFFF00" class="none" scope="col" align="center">Editar D.</th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="center">Cargos</span></div>
      </div></th>
      <?php } ?>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
(status='activa' or status='ontransfer' )
and 

(statusCuenta = 'abierta' or statusCuenta='revision')
and
(tipoPaciente='urgencias' or tipoPaciente='interno')
and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


	  ?>
	  
<td height="24" bgcolor="<?php echo $color?>" class="codigos"><div align="left"><?php echo $myrow['folioVenta'];
?></span></div></td>
      <td width="216" bgcolor="<?php echo $color?>" class="normal">

	  <?php echo $myrow['paciente'];?>
      </span></td>
      <td width="84" bgcolor="<?php echo $color?>" class="normal"><?php 
	  if($myrow['seguro']){
	  echo $myrow['seguro'];
	  } else {
	  echo 'particular';
	  }
?></td>
      <td width="98" bgcolor="<?php echo $color?>" class="normal"><?php 
$sSQL31c= "SELECT descripcion FROM
almacenes
WHERE 
almacen='".$myrow['almacen']."'";
$result31c=mysql_db_query($basedatos,$sSQL31c);
$myrow31c = mysql_fetch_array($result31c);

	  if($myrow31c['descripcion']){
	  echo $myrow31c['descripcion'];
	  } else {
	  echo '---';
	  }
?></td>
      <td width="59" bgcolor="<?php echo $color?>" class="normal"><div align="center"><?php echo $myrow['cuarto']
?></span></div></td>
    
	
	  
      
    
      <td width="35" bgcolor="<?php echo $color?>" class="style12"><div align="center">
        
        <a href="#" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/editexpediente.png" alt="Lista de Cargos..." width="24" height="24" border="0" /></a>
       
      </div></td>
      <td width="81" bgcolor="<?php echo $color?>" class="style12">
        <div align="center">
          <?php if($myrow['statusCuenta']=='abierta'){ ?> 
            <a href="pacientesInternos.php?rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=revision" class="Estilo1" onClick="return comprueba1();">
          Revisar          </a>
          <?php } else if($myrow['statusCuenta']=='revision'){ ?>
          <a href="pacientesInternos.php?rand=<?php echo rand(4555,42334543);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&cierre=si&tipoCierre=caja" onClick="return comprueba();">
          <span class="Estilo4">Caja</span>          </a>
          <?php } ?>      
      </div></td>
      <td width="72" bgcolor="<?php echo $color?>" class="style12"><div align="center">
      
        <?php if($myrow['statusCuenta']=='revision'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/aplicarCoaseguro.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/editbtn.png" alt="Aplicar Cargos" width="24" height="24" border="0" /></a>
               <?php } else { echo '---';}?>
        </div></td>
 
        
        
	  <td width="66" bgcolor="<?php echo $color?>" class="style12"><div align="center">
      <?php if($myrow['statusCuenta']=='revision'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria('actualizaPagos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/changebtn.png" alt="Aplicar Cargos" width="24" height="22" border="0" /></a>
         <?php } else { echo '---';}?>
        </div></td>
	  <?php if($ventana1){ ?>
	  <td width="64" bgcolor="<?php echo $color?>" class="style12"><div align="center"><a href="#" onClick="javascript:ventanaSecundaria2('<?php echo $ventana1;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/editbtn.png" alt="Aplicar Cargos" width="24" height="24" border="0" /></a></div></td>
	  <td width="70" bgcolor="<?php echo $color?>" class="style12" align="center">
      <?php if($myrow['statusCuenta']!='revision'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria2('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/addbtn.png" alt="Aplicar Cargos" width="24" height="24" border="0" /></a>
        <?php } else { echo '---';}?>        </td>
	  <?php } ?>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="954" height="24" />  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>

</form>
</body>
</html>
<?php }


































public function listadoPIT($entidad,$TITULO,$ventana,$bali,$basedatos){
?>
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
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<?php

if($_GET['transfer']=='yes'){
$transfer='no';
$q = "UPDATE clientesInternos set 
solicitaTransferencia='si',
almacenTransferencia='".$_GET['almacenTransferencia']."',
status='ontransfer'
WHERE 
keyClientesInternos='".$_GET['keyCI']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
} else {
$transfer='yes';
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
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center" class="titulos"><?php echo $TITULO;?></h1>
  <span class="style12"></span>
  <table width="499" border="0.2" align="center">
    <tr>
      <th width="50" bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco">N� Cuenta </div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco">Nombre del paciente</div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco">Cub&iacute;culo</div></th>
     
      <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco">Transferir</div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' AND
statusCuenta = 'abierta'
and
(status='activa' or status='ontransfer')
and 
tipoPaciente='urgencias'
and
solicitaTransferencia=''
ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


	  ?>
	  
<td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php echo $myrow['keyClientesInternos'];
?></span></td>
      <td width="316" bgcolor="<?php echo $color?>" class="normal">

	  <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicit� la transferencia de �ste paciente]';
	  }
	  ?>
      </span></td>
      <td width="37" bgcolor="<?php echo $color?>" class="normal" align="center"><?php echo $myrow['cuarto']
?></span></td>
      
	  
      <td width="37" bgcolor="<?php echo $color?>" class="style12"><div align="center">
	  

<?php if($myrow['status']=='activa'){ ?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta ?>&amp;transfer=<?php echo $transfer ?>&amp;keyCI=<?php echo $myrow['keyClientesInternos'];
?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;almacenTransferencia=<?php echo $bali; ?>&amp;usuario=<?php echo $usuario; ?>"><img src="/sima/imagenes/btns/reservbtn.png" alt="TRANSFERIR" width="24" height="22" border="0" onClick="if(confirm('Estas seguro que deseas **solicitar** transferir la cuenta?') == false){return false;}" /></a>
<?php } else {?>
<img src="/sima/imagenes/btns/reservbtn.png" alt="TRANSFERIR"  border="0"/>

    <?php }?>
</div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>

</form>
</body>
</html>


<?php }


} ?>