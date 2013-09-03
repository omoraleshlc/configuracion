<?php
class pacientesInternosUrgencias{
public function listadoPI($entidad,$TITULO,$ventana,$ventana1,$bali,$basedatos){
?>


<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventanaSecundaria111","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=850,height=600,scrollbars=YES") 
} 
</script>

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
   window.open(URL,"ventanaSecundaria","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=1024,height=1000,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script>
function PopupCenter(pageURL, title,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>

<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventanaSecundaria20","width=600,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
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


<script type="text/javascript">
<!--
function comprueba1()
{
if (confirm('Estas seguro(a) de empezar con la revision de la cuenta? ya no podras hacer cargos..')) return true;
return false;
}
-->
</script>

<!--script language=javascript>
var wid = "800";
var hei = "900";
if (document.all) {
var wid = document.body.clientWidth;
var hei = document.body.clientHeight;
}
else if (document.layers) {
var wid = window.innerWidth;
var hei = window.innerHeight;
}
alert(wid);
alert(hei);
var popwid = "400";
var pophei = "450";
var leftPos = (wid-popwid)/2;
var topPos = (hei-pophei)/2;

window.open('popup','width=' + popwid + ',height='+pophei+',top='+topPos+',left='+leftPos);
</script-->

<?php $bali='HURG';?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">


        
<script src="/sima/jquery/lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="/sima/jquery/lib/jquery.dimensions.js" type="text/javascript"></script>
<script src="/sima/jquery/jquery.tooltip.js" type="text/javascript"></script>

<script src="/sima/jquery/chili-1.7.pack.js" type="text/javascript"></script>
<script type="text/javascript" src="/sima/js/editp/spec/support/jquery.js"></script>
<script type="text/javascript" src="/sima/js/editp/spec/support/jquery.ui.js"></script>
<script type="text/javascript" src="/sima/js/editp/lib/jquery.editinplace.js"></script>


<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>        
    </head>

 


<form id="form1" name="form1" method="post" action="#">

  <h1  ><?php echo $TITULO;?></h1>
  <p align="center" >(Para ver los Cargos del Paciente presiona sobre el Folio de Venta)</p>
  
  
    <h1 align="center" >
      <a href="javascript:PopupCenter('../ventanas/pacientesActivos.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&usuario=<?php echo $usuario; ?>#trans<?php echo $guia;?>', 'ventanaSecundaria7',800,800)"  >
      Lista de Pacientes Activos
      </a>      
  </h1>
  
  <table width="800" class="table table-striped">

	
	
    <tr>
        <th width="63"  align="center">#</th>
      <th width="63"  align="center">Exp</th>
      <th width="62"  align="center">Folio</th>
      <th width="194" >Datos Paciente</th>
      <th width="156" >Seguro</th>
      <th width="64"  align="center">Cargos</th>
      <th width="99"  align="center">Coaseg</th>

	  <?php if($ventana1){ ?> 
      <th width="52"  align="center">Editar</th>
      <th width="72"  align="center">Transferir</th>
      <th width="56"  align="center">Enviar</th>
	  <?php } ?>
       <th width="16"  align="center">EDP</th>
    </tr>
	
	<?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
(status='activa' or status='ontransfer' )
and 
almacen='".$_GET['datawarehouse']."'
and

(statusCuenta = 'abierta' or statusCuenta='revision')
and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$guia+=1;
$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$sSQL31s= "SELECT nomCliente FROM
clientes
WHERE 
numCliente='".$myrow['seguro']."'";
$result31s=mysql_db_query($basedatos,$sSQL31s);
$myrow31s = mysql_fetch_array($result31s);
	  ?>
    
    

    
    <tr valign="top"  >
         <td height="44" align="center">
             <p ><?php echo $guia;?></p>
         </td>
        
        
      <td height="44" align="center">
	    <p >
	      <?php 
if($myrow['expediente']=='si'){
echo $myrow['numeroE'];
}else{
echo  'Sin Exp';
 
}
?>
	      <br />
<span  title="Impresion de la hoja de admision">
<a href="javascript:ventanaSecundaria7('../ventanas/impresionInternamiento.php?campoDespliega=<?php echo "campoDespliega"; ?>&forma=<?php echo "form1"; ?>&campoCuarto=<?php echo "cuarto"; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&entidad=<?php print $entidad;?>')">
    H de Adm
</a>
</span>
            </p>
      </td>
<td  align="center" title="Estado de cuenta el paciente">
<a href="#lista<?php echo $guia;?>" name="lista<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $_GET['datawarehouse']; ?>&seguro=<?php echo $_POST['seguro']; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"><?php 

echo $myrow['folioVenta'];

?></a>
</td>



         
        
        <td align="left" id="<?php echo $myrow['keyClientesInternos']; ?>"  >

<script type="text/javascript">
$(document).ready(function(){
	
	$("#<?php echo $myrow['keyClientesInternos']; ?>").editInPlace({
            url: "../cargos/upCIURG.php"
		
	});	
        


});
</script>   
  <div align="left"  title="Presiona aqui si deseas cambiar el nombre de la cuenta, no afecta el expediente!">
 <?php echo utf8_decode($myrow['paciente']); ?>
  </div>

            

            
            
        </td>



     
     
     
     
     
      
	  <td><span  title="Seguro">
        <?php 
	  if($myrow31s['nomCliente']){
	  echo $myrow31s['nomCliente'];
	  } else {?>
        <a href="#lista<?php echo $guia;?>" name="lista<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('../ventanas/responsableCuenta.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"> PARTICULAR </a>
        <?php 
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
      </span></td>
      
	  <td align="center"  title="Presiona aqui para hacer cargos..">
	  <?php if($myrow['statusCuenta']!='revision'){ ?>
        <a href="#cargos<?php echo $guia;?>" name="cargos<?php echo $guia;?>" id="cargos<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_GET['datawarehouse']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')">Cargos</a>
      <?php } else { echo '---';}?></td>
      <td align="center" >
	  <?php //if($myrow['statusCuenta']=='revision'){ ?>
      <a href="#coaseguro<?php echo $guia;?>" name="coaseguro<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('../ventanas/aplicarDeducible.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_GET['datawarehouse']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&rand=<?php echo rand(4555,423345430000);?>')">Coaseguro<br />
Deducible</a>
               <?php //} else { echo '---';}?>
	  </td>
      
              
              
          
          
          
<?php if($ventana1){ ?>
      <td align="center" ><a href="#revision<?php echo $guia;?>" name="revision<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('<?php echo $ventana1;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_GET['datawarehouse']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&rand=<?php echo rand(4555,423345430000);?>')">Edita</a></td>
      
      
      
      
      
      <td align="center" >
	  <?php 
if($myrow['expediente']=='si' and $myrow['numeroE']){ ?>

<?php if($myrow['statusCuenta']=='abierta'){ ?> 
 <a href="javascript:ventanaSecundaria20('../ventanas/departamentoTransferencia.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&usuario=<?php echo $usuario; ?>#trans<?php echo $guia;?>')" name="trans<?php echo $guia;?>"  onClick="if(confirm('Estas seguro que deseas transferir la cuenta?') == false){return false;}">

Transferir
</a>
<?php 
}
}else{
echo '---';

}
?>



	  </td >
      <td align="center" >
        
	  
	  
	  <a href="#" onClick="javascript:ventanaSecundaria111('/sima/cargos/enviarUrg.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;ali=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&paciente=<?php echo $myrow['paciente'];?>')">
              Enviar
          </a>
	 
	  </td>
              
              
          
          
                <td align="center"  title="Editar diagnostico">
          <a href="#lista<?php echo $guia;?>" name="lista<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('../ventanas/datosPaciente.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"> 
     Edit
          </a><br />
        <?php 
          if($myrow['beneficencia']=='si'){
         
          echo '<span class="informativo">Paciente con beneficencia Activada</span>';
          echo '<br>';
      }
      ?>
     <span >
         <?php if($myrow['cuarto']!=NULL){
             echo 'Cuarto: '.$myrow['cuarto'];
         }
?>
     </span>
                </td>
              
              
              <?php } ?><?php  }}?>
	 

  </tr>
	
    

  </table>

  <span ><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>


</form>
</body>
</html>


<?php }


} ?>
