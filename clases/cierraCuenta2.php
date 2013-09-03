<?php 
class eCuentas{
public function eCuenta($bali,$transacciones,$TITULO,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){

include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();
?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
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
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>




<?php 









$cargosParticulares=new  acumulados();
$totalxSurtir=new  acumulados();
$cargosAseguradora= new acumulados();
$otros= new acumulados();














if($_POST['cerrar']){
$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];



//cierro cuenta
$agrega4 = "UPDATE clientesInternos set 
tipoCuenta='H',
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."',
statusCaja='pagado'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

mysql_db_query($basedatos,$agrega4);
echo mysql_error();



//********************CIERRO STATUS CUENTA***********************
$agrega = "UPDATE cargosCuentaPaciente set 
statusCuenta='cerrada',fechaCierre='".$fecha1."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*********************************************




//cierro cuarto a sucio
if($myrow3['cuarto']){
$agregad = "UPDATE cuartos set 
status='sucio',
usuarioSalida='".$usuario."',
fechaSalida='".$fecha1."',
horaSalida='".$hora1."'

where
codigoCuarto='".$myrow3['cuarto']."' 
";

//mysql_db_query($basedatos,$agregad);
echo mysql_error();
}
$leyenda='Se cerró la cuenta';



  $sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['status']=='cerrada' and $myrow3['statusCuenta']=='cerrada'){?>
<script>
window.opener.document.forms["form1"].submit();
window.alert("Cuenta Cerrada");
//window.close();
</script>
<?php 
}else { ?>

<script>
window.opener.document.forms["form1"].submit();
window.alert("Hay un problema con la cuenta");
//window.close();
</script>


<?php 
}

}
?>




















<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  <?php
  $sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//***************aplicar pago**********************  

if($myrow3['statusCuenta']=='cerrada' and $myrow3['status']=='cerrada'){ 
  echo "LA CUENTA DEL PACIENTE ".$myrow3['paciente']." ESTA CERRADA...";
  ?>
    <input name="imprimir" type="submit" class="normal" id="imprimir" value="Imprimir" onClick="window.print();return false" />
   
   <?php 
    } else{
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>



<BODY  >
<?php //ventanasPrototype::links();?>
<h1 align="center"><?php echo $TITULO;?></h1>
<form id="form1" name="form1" method="post" action="">
  <table width="549" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="normal">
    <tr bgcolor="#330099">
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left">Folio de Venta</div></th>
      <th class="blanco" scope="col"><div align="left"><?php echo $_GET['folioVenta'];
		  $nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="normal" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="160" bgcolor="#330099" class="blancomid" scope="col"><div align="left"><strong>Paciente</strong></div></th>
      <th width="382" bgcolor="#FFFFFF" class="normal" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Compa&ntilde;&iacute;a</td>
  <td bgcolor="#FFFFFF" class="normal"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">N&deg; Credencial</td>
      <td bgcolor="#FFFFFF" class="normal"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <th bgcolor="#330099" class="blanco" scope="col"><div align="left">Fecha Ingreso</div></th>
      <th bgcolor="#FFFFFF" class="normal" scope="col"><div align="left"><?php echo cambia_a_normal($myrow3['fecha']); ?></div>      </th>
    </tr>
    <tr>
      <th bgcolor="#330099" class="blanco" scope="col"><div align="left"><strong>M&eacute;dico</strong></div></th>
      <th bgcolor="#FFFFFF" class="normal" scope="col"><div align="left">
          <label> <?php echo $medico=$myrow3['medico']; ?> </label>
          <label> </label>
          <?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$medico."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?> </div></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  
  
  
  
  
  
  
  
  
  
  <p>

  </p>



  
  
    <?php 
$content=new contenidos();
$content-> desplegarContenidos($entidad,$class,$estilo,$fechas1,$fechas2,$myrow3['keyClientesInternos'],$_GET['folioVenta'],$basedatos);

?>


  <p>&nbsp;</p>
          <p>
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" />
  </p>
  <div align="center">
    <div align="left">
      <p>&nbsp;</p>
      
      <p>&nbsp;</p>
	  <p>&nbsp;</p>
    </div>
   
<?php 
$despliegaTotales=new totales();
$despliegaTotales-> tt($entidad,$class,$estilo,$fechas1,$fechas2,$myrow3['keyClientesInternos'],$_GET['folioVenta'],$basedatos);
?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <p align="left">&nbsp;</p>

	
	<?php if($myrow3['status']!='cerrada'){ ?>
	
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="86%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="15%" scope="col">
		
		
		
		<table width="94" border="0" align="left">
          <tr bgcolor="#660066">
            <th class="blanco" scope="col">
			
			<span class="blanco">Particular<a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>')"> </a></span></th>
          </tr>
          <tr>
            <th width="98" bgcolor="#660066" class="blanco" scope="col"><span class="blanco"> <span class="blanco">Total a pagar </span> </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal"> <span class="normal">
                <?php  //echo "$".number_format($cargosParticulares->cargosParticulares($basedatos,$usuario,$numeroE,$nCuenta),2);

			
		
		$ttP=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']);
		// $T=round($T,$ase);
		if($ttP){ 
		
		if($cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos'])<0){
				$dev='si';
		$cantidadDevolucion=$cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']);
		}else{
		$dev='';
		}
		
		?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?almacenFuente=<?php echo $bali; ?>&numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'particular';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>&tipoTransaccion=particular&random=<?php echo rand(90000,900000000);?>&devolucion=<?php print $dev;?>&cantidadDevolucion=<?php echo $cantidadDevolucion;?>')">
                <?php 	
        
		echo "$".number_format($cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']),2);
		?>
                </a>
                <?php 
		} else {
	
	    echo "$".number_format($cargosParticularesCC->cargosParticularesCC($basedatos,$usuario,$myrow3['keyClientesInternos']),2);
		}
		?>
            </span></span></div></td>
          </tr>
        </table>
		
		
		
		</th>
        <th width="2%" scope="col">&nbsp;</th>
        <th width="15%" scope="col">&nbsp;</th>
        <th width="31%" scope="col">&nbsp;</th>
        <th width="2%" scope="col">&nbsp;</th>
        <th width="5%" scope="col">&nbsp;</th>
        <th width="16%" scope="col"><table width="94" border="0">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco">D.Coaseguro </span></th>
          </tr>
          <tr>
            <th width="88" bgcolor="#660066"  scope="col"><span class="blanco">Total a pagar </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal">
                <?php 
		$coaseguro=new acumulados();
		$ttCO=$coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT']);
		if($ttCO){    ?>
                <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'coaseguro';?>&tipoVenta=<?php echo 'interno';?>&tipoMovimiento=<?php echo 'transaccion';?>&tipoTransaccion=coaseguro&random=<?php echo rand(90000,900000000);?>')">
                <?php 
		echo "$".number_format($coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT']),2);?>
                </a>
                <?php } else {
		
		echo "$".number_format($coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT']),2);
		}
		?>
            </span></div></td>
          </tr>
        </table></th>
        <th width="14%" scope="col"><table width="94" border="0" align="right">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco"> Compa&ntilde;&iacute;a
                  <?php //echo "$".number_format($Tcargos,2);?>
                  <?php //echo "$".number_format( $Tabonos,2);
	  $t1=$TOTAL+$Tiva;?>
                  <?php //echo "$".number_format($deposito[0],2);
	  //echo "Pago por Otros";
	  $t2=$Tabonos;?>
            </span></th>
          </tr>
          <tr>
            <th width="172" bgcolor="#660066" class="blanco" scope="col">Saldo Cia. </th>
          </tr>
          <tr>
            <td><span class="normal">
            

              <?php 
			  $ttCA=$cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nT'] );
		if($ttCA && !$coaseguro->cargosCoaseguro($basedatos,$usuario,$_GET['nT'])){ ?>
              <a href="#" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>
		&almacen=<?php echo $bali; ?>&almacenFuente=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'aseguradora';?>&tipoVenta=<?php echo 'interno';?>&tipoTransaccion=aseguradora&random=<?php echo rand(90000,900000000);?>')">
              <?php 
			echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nT']),2);?>
              </a>
              <?php } else {
		
		echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($basedatos,$usuario,$_GET['nT']),2);
		}		
		?>
        
    
        
        
            </span> </td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>

    <p>&nbsp;</p>
  </div>
 

  <p align="center">
    
	<?php 

$variables=round($ttP+$ttO+$ttCO+$ttCA+$totalxSurtir->totalxSurtirFV($basedatos,$usuario,$myrow3['folioVenta']),2);
//****************************************


	
	if((!$myrow661['status'] and !$myrow14a['cierreCuenta']) and $variables ){ 
	?>
	<input name="faltan" type="image" src="/sima/imagenes/btns/aplypago.png" id="cerrar" value="Falta Aplicar Pagos" disabled=""/>	
	<?php } else if(!$variables){ ?>
	<input name="cerrar" type="submit" class="normal" id="cerrar" value="Cerrar Cuenta" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas cerrar la cuenta?') == false){return false;}" />
	<?php }//cierra validaciones de proceso de cierre de departamentos ?>
  </p>
  <div align="center">

    
    <?php } else { 
  echo "LA CUENTA DEL PACIENTE ".$myrow3['paciente']." ESTA CERRADA...";
  ?>
    <input name="imprimir" type="submit" class="normal" id="imprimir" value="Imprimir" onClick="window.print();return false" />
    <?php }
   ?>
  </div>
</form>

<p align="center">&nbsp;</p>
<?php if($_POST['banderaFecha']){ ?>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script>
<?php }} ?>
</body>
</html>
<?php }} ?>