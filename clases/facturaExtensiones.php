<?php
if(($_POST['previzualizar'] or $_POST['aplicarFactura']) and $_POST['folioFactura']){
$sSQL3d= "Select numFactura From facturasAplicadas WHERE numFactura = '".$_POST['folioFactura']."' ";
$result3d=mysql_db_query($basedatos,$sSQL3d);
$myrow3d = mysql_fetch_array($result3d);
}
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

















<?php if($_POST['search'] and $_POST['folioVenta']){ 

 $sSQL3= "Select * From clientesInternos WHERE folioVenta='".$_POST['folioVenta']."' and statusCaja='pagado'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['folioVenta']){ 
?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/facturaExtensiones.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&rfc=<?php echo $_POST['rfc'];?>&razonSocial=<?php echo $_POST['razonSocial'];?>&calle=<?php echo $_POST['calle'];?>&colonia=<?php echo $_POST['colonia'];?>&ciudad=<?php echo $_POST['ciudad'];?>&estado=<?php echo $_POST['estado'];?>&cp=<?php echo $_POST['cp'];?>&pais=<?php echo $_POST['pais'];?>&delegacion=<?php echo $_POST['delegacion'];?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $_GET['numCliente'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>'); 

window.opener.document.forms["form1"].submit();
//window.location = 'dividirCuentas.php'
self.close();
</script> 
<?php } else {?>
<script>
window.alert("No existe ese folio de venta!");
</script>
<?php }
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
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>



	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>    
</head>



<BODY  >
<?php 
$sSQL3= "Select * From clientesInternos WHERE (entidad='".$entidad."' and tipoPaciente ='externo' and folioVenta = '".$_POST['folioVenta']."'  and statusFactura='' and statusCaja='pagado') or (
entidad='".$entidad."' and (tipoPaciente='interno' or tipoPaciente='urgencias') and status='cerrada' and statusCuenta='cerrada')";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>
<h1 align="center" >Facturacion por Extensiones</h1>
<p align="center" >&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="582" class="table-forma">
    <tr>
      <td width="168"   scope="col"><div align="left">Ingresa el Folio de Venta</div></td>
      <td width="407"   scope="col"><div align="left">
        <label>
        <input type="text" name="folioVenta" id="folioVenta" value="<?php print $_POST['folioVenta'];?>" />
        </label>
        </label>
        <span >
        <input type="submit" name="search" id="button" value="Buscar" />
        </span><span >
        <input type="reset" name="button3" id="button2" value="Restablecer" />
        </span></div>      </td>
    </tr>
    
    
    
<?php if($_POST['actualizar'] or $_POST['search'] or ($_POST['extension'] or $_POST['extension']=='0') and $_POST['seguro']){ ?>

  </table>
</form>

<p align="center">

  <?php } ?>
    <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>