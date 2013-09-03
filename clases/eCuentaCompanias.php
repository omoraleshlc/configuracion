<?php 
class eCuentas{
public function eCuenta($tipoFacturacion,$entidad,$fecha1,$hora1,$dia,$usuario,$nT,$basedatos){

include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();




?>



  <script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>








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
   window.open(URL,"ventana6","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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




<?php //************************ACTUALIZO **********************
//********************Llenado de datos
if(!$_GET['nT']){
$_GET['nT']=$nT;
}

//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************


if($_POST['aplicarFactura']){
$keyClientesInternos=$_POST['keyClientesInternos'];



for($i=0;$i<=$_POST['bandera'];$i++){

if($keyClientesInternos[$i]){


$agrega = "UPDATE clientesInternos set 
statusFactura='aplicado'

where
keyClientesInternos='".$_GET['folioGuia']."' ";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
sleep(1);
$agrega = "UPDATE clientesInternos set 
statusFactura='aplicado'

where
keyClientesInternos='".$keyClientesInternos[$i]."' ";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
sleep(1);
$agregaA = "UPDATE cargosCuentaPaciente
set 

statusFactura='aplicado'

where
keyClientesInternos='".$keyClientesInternos[$i]."' 
";

mysql_db_query($basedatos,$agregaA);
echo mysql_error();
}
} ?>
<script>
window.opener.document.forms["form2"].submit();
close();
</script>

<?php 
}




if($_POST['quitar']){
$keyCAP=$_POST['keyCAP1'];

for($i=0;$i<=$_POST['bandera'];$i++){
if($keyCAP[$i]){
$agrega = "UPDATE cargosCuentaPaciente set 

statusFactura='standby',
usuarioSolicitudFactura='".$usuario."',
fechaSolicitudFactura='".$fecha1."',
horaSolicitudFactura='".$hora1."'

where
keyCAP='".$keyCAP[$i]."' 
";

//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}
}
?>








<?php //preparando
if(!$_POST['aplicarFactura']){
if($_GET['usuario']){
$sSQL3= "Select solicitudes From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

if($myrow3['solicitudes']==''){
 $agrega = "UPDATE clientesInternos set 

solicitudes='request'

where
keyClientesInternos='".$_GET['keyClientesInternos']."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
$status='inactiva';
} else if($myrow3['solicitudes']=='request'){
 $agrega = "UPDATE clientesInternos set 

solicitudes=''

where
keyClientesInternos='".$_GET['keyClientesInternos']."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
$status='activa';

}

} 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">

<head>








<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
-->
</style>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
-->
</style>



</head>





<BODY  >

<h1 align="center">&nbsp;</h1>
<h1 align="center">Escoje la Factura para aplicar <?php echo $myrow3['keyClientesInternos'];?></h1>
<form id="form1" name="form1" method="post" >
  <table width="413" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="7" bgcolor="#3300FF" class="Estilo24 style13" scope="col">&nbsp;</th>
      <td width="84" bgcolor="#3300FF" class="Estilo24 style13">Compa&ntilde;&iacute;a: </td>
      <td width="312" bgcolor="#3300FF" class="Estilo24"><span class="style13">
        <label><?php echo $traeSeguro=$_GET['numCliente']; ?>
        <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
        </label>
      </span></td>
    </tr>
  </table>
  
  <p>&nbsp;</p>



 <br />
 <table width="435" border="0" align="center" class="style7">
    <tr>
      <th width="53" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Usuario </span></div></th>
      <th width="69" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">FolioVenta</span></div></th>
      <th width="78" height="14" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Fecha Expedici&ograve;n </span></div></th>
      <th width="71" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Factura Fiscal </span></div></th>
      <th width="53" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Vencimiento</span></div></th>
      <th width="52" bgcolor="#660066" class="style14" scope="col"><div align="left">Facturado</div></th>
      <th width="29" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Folio  </span></div></th>
    </tr>
	
      <?php //traigo agregados
	  


$sSQL81= "
SELECT 
*
FROM
clientesInternos
 WHERE 
 entidad='".$entidad."'
 and
 clientePrincipal = '".$_GET['numCliente']."'
and

statusFactura='facturado'
and
numeroFactura!=''
and
folioVenta!=''
";






if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+=1;
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];






if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$sSQL3a= "Select plazoPago From clientes WHERE clientePrincipal = '".$myrow81['seguro']."' ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);


$sSQL3b= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as importeTotal,usuarioFactura From cargosCuentaPaciente WHERE keyClientesInternos = '".$myrow81['keyClientesInternos']."' and naturaleza='C' ";
$result3b=mysql_db_query($basedatos,$sSQL3b);
$myrow3b = mysql_fetch_array($result3b);

?>	
	
	
	
    <tr>
<td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><?php echo $myrow3b['usuarioFactura'];?></span></div></td>





      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><?php echo $myrow81['folioVenta'];?></span></div></td>
      <td height="22" bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>">
      <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left"><span class="<?php echo $estilo;?>"><span class="style71">
        <?php 
					echo $myrow81['numeroFactura'];
		
		?>
        </span>
            
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24">
      <div align="left">
      <?php 
	  if($myrow3a['plazoPago']){
	  echo $myrow3a['plazoPago'].' dias'; 
	  } else {
	  echo '---';
	  }
	  ?>
      </div>      </td>

<td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><?php echo "$".number_format($myrow3b['importeTotal'],2);?></td>
      <td bgcolor="<?php echo $color;?>" class="<?php echo $estilo;?>"><div align="left">
	  
<?php if($myrow81['solicitudes']=='request'){ 
$porAplicar[0]+=$myrow3b['importeTotal'];
}?>

<label>
              <a href="<?php echo $_SERVER['PHP_SELF'];?>?usuario=<?php echo $usuario; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;status=<?php echo $status; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;raiz=Registro&numCliente=<?php echo $_GET['numCliente'];?>&keyClientesInternos=<?php echo $myrow81['keyClientesInternos'];?>&cantidadAplicar=<?php echo $_GET['cantidadAplicar'];?>&folioGuia=<?php echo $_GET['folioGuia'];?>">
	  <input type="checkbox" name="keyClientesInternos[]" value="<?php echo $myrow81['keyClientesInternos'];?>" <?php if($myrow81['solicitudes']=='request'){ echo 'checked=""';}?>  />
      </a>
	  </label>
	

</div></td>
    </tr>

	
	
    <?php }}?>
  </table>

  <p>&nbsp;</p>
  <p align="center">
  <?php if(round($_GET['cantidadAplicar'],2)!=round($porAplicar[0],2)){ 
  echo '*La cantidad que vas a aplicar debe ser igual a la del pago de la compania';
  }
  ?>
  </p>
  <?php if($a>0){ ?>
  <table width="301" border="1" align="center" class="style7">
    <tr>
      <td width="89" bgcolor="#0000FF"><span class="style13">Dep&oacute;sito Compa&ntilde;&iacute;a</span></td>
      <td width="95" bgcolor="#0000FF"><span class="style13">Por Aplicar</span></td>
      <td width="95" bgcolor="#0000FF"><span class="style13">Diferencia</span></td>
    </tr>
    <tr>
      <td><?php echo '$'.number_format($_GET['cantidadAplicar'],2);?></td>
      <td><?php echo '$'.number_format($porAplicar[0],2);?></td>
      <td><?php echo '$'.number_format($_GET['cantidadAplicar']-$porAplicar[0],2);?></td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <p align="center"><label></label>
    <label>
	 <input name="aplicarFactura" type="submit" class="style7" id="aplicarFactura" value="Aplicar folio" onClick="if(confirm('Vas a aplicar el pago de la compañía <?php displaySeguro::despliegaSeguro($traeSeguro,$basedatos);?>, la operacion es irreversible, estás seguro?') == false){return false;}" <?php if(round($_GET['cantidadAplicar'],2)!=round($porAplicar[0],2)){ echo 'disabled=""';}?> />
	</label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a; ?>" />
    

  </p>
</form>


<p>&nbsp;</p>
</body>
</html>
<?php
}
}
}
?>

