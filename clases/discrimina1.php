<?php 
class eCuentas{
public function eCuenta($fecha1,$hora1,$dia,$usuario,$nT,$basedatos){
include("/configuracion/funciones.php"); 
$cargosParticularesDiscrimina=new  cierraCuenta();
$cargosAseguradoraDiscrimina=new cierraCuenta();
$entidad=$_GET['entidad'];
?>
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
<script type="text/javascript" src="/sima/js/public_smo_scripts.js"> </script>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
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
        status = "Este campo s�lo acepta n�meros."
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


if($_POST['actualizar']){

$sSQL45= "Select * from clientesInternos where entidad='".$_GET['entidad']."' and folioVenta ='".$_GET['folioVenta']."'";
$result45=mysql_db_query($basedatos,$sSQL45);
$myrow45 = mysql_fetch_array($result45);

$aseguradora=$_POST['aseguradora'];
$particular=$_POST['particular'];


for($i=0;$i<=$_POST['bandera'];$i++){


if($aseguradora[$i]!=NULL or $particular[$i]!=NULL){

if($particular[$i]){
$agrega = "UPDATE cargosCuentaPaciente set 

cantidadAseguradora=precioVenta,
ivaAseguradora=iva,
tipoCliente='aseguradora',
status='aseguradora',
seguro='".$myrow45['seguro']."',
clientePrincipal='".$myrow45['clientePrincipal']."',
cantidadParticular=NULL,
ivaParticular=NULL


where
keyCAP='".$particular[$i]."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


//******************************************


}else if($aseguradora[$i]){
$agrega = "UPDATE cargosCuentaPaciente set 
cantidadParticular=precioVenta,
ivaParticular=iva,
tipoCliente='particular',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
seguro=NULL,
clientePrincipal=NULL


where
keyCAP='".$aseguradora[$i]."'";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

}

}
} //cierra for
echo '<span ><blink>'.  'Se hicieron Cambios...'.'</blink></span>';
} //cierra actualizar
































//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE  entidad='".$_GET['entidad']."' and folioVenta ='".$_GET['folioVenta']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
//***************aplicar pago**********************

?>
<script type="text/javascript">
<!--
function checkAll(checkname, exby) {
for (i = 0; i < checkname.length; i++)
checkname[i].checked = exby.checked? true:false
}
// -->
</script>
<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  <SCRIPT LANGUAGE="JavaScript">
<!-- 	
// by Nannette Thacker
// http://www.shiningstar.net
// This script checks and unchecks boxes on a form
// Checks and unchecks unlimited number in the group...
// Pass the Checkbox group name...
// call buttons as so:
// <input type=button name="CheckAll"   value="Check All"
	//onClick="checkAll(document.myform.list)">
// <input type=button name="UnCheckAll" value="Uncheck All"
	//onClick="uncheckAll(document.myform.list)">
// -->

<!-- Begin
function checkAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
//  End -->
</script>





<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>



<BODY >

<h1 align="center" class="titulos">Ajustes a Cuentas </h1>
<form id="form1" name="form1" method="post" action="">

  <table width="800" class="table-forma">
    <tr align="center" >
      <td width="151"><span >FOLIO DE VENTA</span></td>
      <td width="68"><span >FECHA</span></td>
      <td width="453"><span >PACIENTE:</span> <a href="#" 
onclick="javascript:ventanaSecundaria7('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow3['folioVenta'];?>') "> <span > <?php echo $myrow3['paciente']; ?></span></a></td>
      <td width="145"><span >DEPTO.</td>
    </tr>
    <tr align="center">
      <td><span >
        <?php 
		 echo $nCliente=$myrow3['folioVenta'];
		  ?>
        <input name="numeroE" type="hidden" class="blanco" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
      </span></td>
      <td><span ><?php echo cambia_a_normal($myrow3['fecha']); ?></span></td>
      <td><span > Seguro:
<?php 
		

	if ($myrow3['seguro']) {
$sSQL4= "Select nomCliente From clientes WHERE entidad='".$entidad."' and numCliente='".$myrow3['seguro']."'  "; 
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	 
	echo $myrow4['nomCliente'];
} else {
echo particular;
}
?>
      </span></td>
      <td><span >
        <?php 

		
	$alma= $myrow3['almacen'];
	$sSQL4a= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$alma."';
";
$result4a=mysql_db_query($basedatos,$sSQL4a);
$myrow4a = mysql_fetch_array($result4a);
	 
	echo $myrow4a['descripcion'];

		  ?>
      </span></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
      <td  align="center">Credencial: <?php echo $myrow3['credencial']; ?></td>
      <td>&nbsp;</td>
    </tr>

  </table>
  
  
  <p>
  <table width="900" class="table table-striped">

    <tr >
      <th width="23" >#</th>
      <th width="51" >Ref</th>
      <th width="101" >Fecha/Hora</th>
      <th width="324" >Descripcion</th>
      <th width="17" >N</th>
      <th width="17" >C</th>
      <th width="69" >Importe</th>
      <th width="65" >Iva</th>
      <th width="55" >CPart</th>
      <th width="57" >CAseg</th>
      <th width="59" >ivaP</th>
      <th width="62" >ivaA</th>
      <th width="62" >P</th>
      <th width="62" >A</th>
    </tr>
<?php //traigo agregados

 
 $sSQL81= "
 SELECT 
*
 FROM
 cargosCuentaPaciente 
 WHERE 
 
folioVenta='".$_GET['folioVenta']."'
 
 and
gpoProducto!=''
  
 order by fecha1, hora1 asc
 ";





$primeraVez=NULL;
if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow = mysql_fetch_array($result81)){ 
$a+=1;

?>
    <?php include('/configuracion/clases/operacionesGlobales.php');?>

    <tr >
      <td height="48" ><?php echo $a;	?></td>
      <td ><?php echo $myrow['keyCAP'];	?></td>
      <td ><span ><?php echo cambia_a_normal($myrow['fecha1'])." ".$myrow['hora1'];
	?>

      </span></td>
      <td ><span ><span class="<?php echo $estilo;?>">
        <?php 
			print	$myrow['descripcionArticulo'];
		
		?>
      </span>
          <?php 
		if($myrow['statusCargo']=='pendiente' or $myrow['statusCargo']=='standby' ){ 
		echo '<blink>'." Art&iacute;culo No Surtido! ".'</blink>';
		echo " Solicita: ".$myrow16['almacenSolicitante']." Destino: ".$myrow16['almacenDestino'];
		}
		
		
		if($myrow['statusCargo']=='standby' or $myrow['statusCargo']=='request'){
		echo '<span class="style1">'.' [Este art�culo no ha sido surtido!]'.'<span>';
		} 
		?>
      </span></td>
      <td >&nbsp;</td>
      <td ></td>
      <td ><span class="<?php echo $estilo;?>"><?php echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);?></span></td>
      <td ><?php echo '$'.number_format($myrow['iva']*$myrow['cantidad'],2);?></td>
      <td ><?php echo '$'.number_format($myrow['cantidadParticular']*$myrow['cantidad'],2);?></td>
      <td ><?php echo '$'.number_format($myrow['cantidadAseguradora']*$myrow['cantidad'],2);?></td>
      <td ><?php echo '$'.number_format($myrow['ivaParticular']*$myrow['cantidad'],2);?></td>
      <td ><?php echo '$'.number_format($myrow['ivaAseguradora']*$myrow['cantidad'],2);?></td>
      <td ><?php 
		if($myrow['tipoCliente']=='particular'){?>
        <input type="checkbox" name="particular[]" id="particular[]" value="<?php echo $myrow['keyCAP'];?>" />
        <?php } else{ echo '---';} ?></td>
      <td ><span class="normalmid">
        <div align="center">
          <?php if($myrow['tipoCliente']=='aseguradora'){?>
          <input type="checkbox" name="aseguradora[]" id="aseguradora[]" value="<?php echo $myrow['keyCAP'];	?>"/>
          <?php } else{ echo '---';} ?>
        </div>
        </label>
      </span></td>
    </tr>
    <?php }?>

  </table><br />
  	   <?php include('/configuracion/clases/mostrarTotalesEC.php');?> <br />
   <?php include('/configuracion/clases/mostrarDatosEC.php');?> 
  
  <p><?php  include('/configuracion/clases/mostrarEfectuarTransacciones.php');?></p>
  <p>


    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a; ?>"  />


    <input name="actualizar" type="submit" class="style7" id="actualizar" value="Actualizar Cambios"
	  <?php if($a<1){ echo 'disabled="disabled"';} ?>/>
  </p>
  <div align="center"></div>
  <p>&nbsp;</p>
</form>
<?php 

} ?>
<p align="center">&nbsp;</p>

</body>
</html>
<?php }} ?>

