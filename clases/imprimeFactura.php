<?php 
class printInvoice{
static public function imprimirFactura($nT,$nCuenta,$seguro,$fecha,$numeroE,$basedatos){ ?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
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



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
-->
</style>


</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.Estilo25 {color: #000000}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
-->
</style>
<BODY >
<div align="left">
  <table width="597" border="0" align="center">
    <tr>
      <th width="77" scope="col"><img src="/sima/imagenes/logohlc.jpg" width="68" height="60" align="left" /></th>
      <th width="411" scope="col"><h1>Hospital La Carlota </h1></th>
      <th width="95" scope="col"><span class="style7"><?php echo cambia_a_normal($fecha1); ?></span></th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style7"><div align="center">
          <h5 class="Estilo25">Camino al Vapor #201 Col. Zambrano, Montemorelos.</h5>
          <h5 class="Estilo25"> Tel. 8262633188 </h5>
      </div></td>
      <td class="style7"> Folio: <?php echo $numeroE; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center" class="Estilo25"></div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <?php 
$sSQL= "Select * From clientes WHERE numCliente = '".$seguro."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
  
  ?>
  <table width="603" border="0" align="center">
    <tr>
      <td width="31"><span class="style7">Cliente:</span></td>
      <td width="223" class="style7"><?php echo $myrow['nomCliente']; ?></td>
      <td width="26" class="style7">RFC:</td>
      <td width="92" class="style7"><?php echo $myrow['rfc']; ?></td>
      <td width="10" class="style7">&nbsp; </td>
      <td width="73" class="style7">Fecha</td>
      <td width="59" class="style7"><?php echo $fecha1; ?> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style7"><?php echo $myrow['ciudad']." "; ?><?php echo $myrow['estado']; ?></span></td>
      <td><span class="style7">CP:</span></td>
      <td><span class="style7"><?php echo $myrow['cp'];?></span></td>
      <td>&nbsp;</td>
      <td class="style7">Total a Pagar: </td>
      <td><span class="style7"><?php echo $myrow['RFC']; ?></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="style7">Pagar antes de </td>
      <td><span class="style7"><?php echo $myrow['RFC']; ?></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="center" class="Estilo25"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="style7">No. de Cliente: </td>
      <td><span class="style7"><?php echo $myrow['RFC']; ?></span></td>
    </tr>
  </table>
</div>
<form id="form1" name="form1" method="post" action="">
  <table width="615" border="0" align="center">
    <tr>
      <th width="65" height="21" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
      <th width="407" bgcolor="#660066" scope="col"><span class="style11">Descrpici&oacute;n</span></th>
      <th width="71" bgcolor="#660066" scope="col"><span class="style11">Importe</span></th>
      <th width="54" bgcolor="#660066" scope="col"><span class="style11">IVA</span></th>
    </tr>
    <tr>
      <?php 

$sqlNombre= "SELECT distinct * FROM cargosCuentaPaciente where numeroE = '".$numeroE."' and
statusFactura='facturame' group by codProcedimiento order by codProcedimiento ASC
";
$resultaNombre=mysql_db_query($basedatos,$sqlNombre);
while($myrow = mysql_fetch_array($resultaNombre)){ 
$bandera+=1;
 $art = $myrow['codProcedimiento'];
$registros+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$descripcion=descripcion($art,$basedatos);
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php 
		if($myrow['cantidad']){
	echo $myrow['cantidad'];
	} else {
	echo "N/A";
	}
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php 
	echo $descripcion;
	
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php 
	echo "$".number_format($myrow['costo'],2);
	
	  ?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php 
	echo "$".number_format($myrow['iva'],2);
	
	  ?>
      </span></td>
    </tr>
    <?php } //cierra while ?>
  </table>
</form>

</body>
</html>
<?php 
}//cierra function
}//cierra clase
?>