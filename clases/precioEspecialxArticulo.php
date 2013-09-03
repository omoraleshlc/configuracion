<?php 
class pEspecialesIndividual{
public function agregarArticulosPE($almacen,$entidad,$basedatos){
?>


<?php  
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
	$q = "DELETE FROM preciosEspeciales WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>

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

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=350,height=189,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=450,height=170,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=450,height=170,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaDetalles (URL){ 
   window.open(URL,"ventanaDetalles","width=450,height=170,scrollbars=YES") 
} 
</script> 

<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_GET['actualizar']){
$keyPA=$_GET['keyPA'];
$gpoProducto=$_GET['gpoProducto'];
$descripcion=$_GET['descripcion'];
$cBarra=$_GET['cBarra'];
$precioEspecial=$_GET['precioEspecial'];
$codigo=$_GET['codigo'];
for($i=0;$i<=$_GET['bandera'];$i++){
if($keyPA[$i]!=NULL){
$q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',
cbarra='".$cBarra[$i]."',
fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
//mysql_db_query($basedatos,$q1);
echo mysql_error();

$sSQL39dc= "
	SELECT 
*
FROM
articulos
WHERE keyPA='".$keyPA[$i]."'";
$result39dc=mysql_db_query($basedatos,$sSQL39dc);
$myrow39dc = mysql_fetch_array($result39dc);


$sSQL39d= "
	SELECT 
precioEspecial
FROM
preciosEspeciales
WHERE keyPA='".$keyPA[$i]."'";
$result39d=mysql_db_query($basedatos,$sSQL39d);
$myrow39d = mysql_fetch_array($result39d);

if(!$myrow39d['precioEspecial'] and $precioEspecial[$i] and $_GET['fechaInicial'] and $_GET['fechaFinal']){
$q1a = "INSERT INTO preciosEspeciales (keyPA,codigo,fechaInicial,fechaFinal,entidad,gpoProducto,precioEspecial,usuario,tipoVentaEspecial) values ( 
'".$keyPA[$i]."','".$myrow39dc['codigo']."','".$_GET['fechaInicial']."','".$_GET['fechaFinal']."','".$entidad."','".$myrow39dc['gpoProducto']."','".$precioEspecial[$i]."','".$usuario."','individual')";
mysql_db_query($basedatos,$q1a);
echo mysql_error();
}



}
}?>

<script language="JavaScript1.2">

/*
Nudging text by Matthias (info@freejavascripts.f2s.com)
Modified by Dynamic Drive to function in NS6
For this script and more, visit http://www.dynamicdrive.com
*/

//configure message
message="Se actualizaron datos!"
//animate text in NS6? (0 will turn it off)
ns6switch=1

var ns6=document.getElementById&&!document.all
mes=new Array();
mes[0]=-1;
mes[1]=-4;
mes[2]=-7;mes[3]=-10;
mes[4]=-7;
mes[5]=-4;
mes[6]=-1;
num=0;
num2=0;
txt="";
function jump0(){
if (ns6&&!ns6switch){
jump.innerHTML=message
return
}
if(message.length > 6){
for(i=0; i != message.length;i++){
txt=txt+"<span style='position:relative;' id='n"+i+"'>"+message.charAt(i)+"</span>"};
jump.innerHTML=txt;
txt="";
jump1a()
}
else{
alert("Your message is to short")
}
}

function jump1a(){
nfinal=(document.getElementById)? document.getElementById("n0") : document.all.n0
nfinal.style.left=-num2;
if(num2 != 9){
num2=num2+3;
setTimeout("jump1a()",50)
}
else{
jump1b()
}
}

function jump1b(){
nfinal.style.left=-num2;
if(num2 != 0){num2=num2-3;
setTimeout("jump1b()",50)
}
else{
jump2()
}
}

function jump2(){
txt="";
for(i=0;i != message.length;i++){
if(i+num > -1 && i+num < 7){
txt=txt+"<span style='position:relative;top:"+mes[i+num]+"'>"+message.charAt(i)+"</span>"
}
else{txt=txt+"<span>"+message.charAt(i)+"</span>"}
}
jump.innerHTML=txt;
txt="";
if(num != (-message.length)){
num--;
setTimeout("jump2()",50)}
else{num=0;
setTimeout("jump0()",50)}}
</script>
<?php 
}
?>
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  

<script src="/sima/js/prototype.js" type="text/javascript"></script>
<!-- set focus to a field with the name "searchcontent" in my form -->


<script language="JavaScript1.2">

//Highlight form element- © Dynamic Drive (www.dynamicdrive.com)
//For full source code, 100's more DHTML scripts, and TOS,
//visit http://www.dynamicdrive.com

var highlightcolor="lightyellow"

var ns6=document.getElementById&&!document.all
var previous=''
var eventobj

//Regular expression to highlight only form elements
var intended=/INPUT|TEXTAREA|SELECT|OPTION/

//Function to check whether element clicked is form element
function checkel(which){
if (which.style&&intended.test(which.tagName)){
if (ns6&&eventobj.nodeType==3)
eventobj=eventobj.parentNode.parentNode
return true
}
else
return false
}

//Function to highlight form element
function highlight(e){
eventobj=ns6? e.target : event.srcElement
if (previous!=''){
if (checkel(previous))
previous.style.backgroundColor=''
previous=eventobj
if (checkel(eventobj))
eventobj.style.backgroundColor=highlightcolor
}
else{
if (checkel(eventobj))
eventobj.style.backgroundColor=highlightcolor
previous=eventobj
}
}

</script>
<?php
echo $_GET['buscar'];
?>






 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style13 {color: #FFFFFF}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
<?php if(!$_GET['criterio']){ ?>
<script>

function stopRKey(evt) {
var evt = (evt) ? evt : ((event) ? event : null);
var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
}
document.onkeypress = stopRKey;
</script>
<?php } ?>


</head>

<body>

<h1 align="center" class="titulos">Precios Especiales<?php 
function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 

if(!$_GET['criterio']){
$_GET['criterio']=$_GET['criterios'];
}
?>







</head>


</h1>
<h2><div id="jumpx" style="color:green"></div></h2>
<script>
if (document.all||document.getElementById){
jump=(document.getElementById)? document.getElementById("jumpx") : document.all.jumpx
jump0()
}
else
document.write(message)
</script>
<form method="get" name="Form2"  onKeyUp="highlight(event)" onClick="highlight(event)">


  <table width="228" border="0" align="center" class="Estilo24">
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td width="65" bgcolor="#660066"><div align="left" class="style13">Fecha Inicial :</div></td>
      <td width="234"><div align="left">
          <label>
          <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_GET['fechaInicial']){
		 echo $_GET['fechaInicial'];
		 }
		 ?>"/>
          </label>
          <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
      </div></td>
    </tr>
    <tr>
      <th width="1" scope="col">&nbsp;</th>
      <td bgcolor="#660066"><div align="left" class="style13">Fecha Final </div></td>
      <td><div align="left">
          <label></label>
          <label></label>
          <label>
          <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_GET['fechaFinal']){
		 echo $_GET['fechaFinal'];
		 }
		 ?>"/>
          </label>
          <input name="button1" type="button" class="Estilo24" id="lanzador1" value="..." />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="684" border="0" align="center">
    <tr>
      <td width="169"><span class="negro">Introduce el texto a buscar</span></td>
      <td width="142"><span class="negro">
        <input name="criterio" type="text" class="campos" size="22" maxlength="150"  onChange="stopRKey()"/>
        <script>
document.Form2.criterio.focus();
</script>
      </span></td>
      <td width="95"><span class="negro">
        <input type="image" src="/sima/imagenes/btns/searcharticles.png"  value="Buscar" />
      </span></td>
      <td width="113"><span class="negro">Mostrar Registros</span></td>
      <td width="143"><span class="negro">
        <label>
        <input name="registros" type="text" class="campos" id="registros" value="<?php if($_GET['registros']==NULL){ echo '30';} else { echo $_GET['registros'];}?>" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
        </label>
      </span></td>
    </tr>
  </table>
  <p align="center" class="negro">&nbsp;</p>
  <table width="975" border="2" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFF00" bgcolor="#0000FF">
    <tr>

      <th width="373" bgcolor="#660066" scope="col"><div align="left" class="blanco">
        <div align="left">Descripci&oacute;n</div>
      </div></th>
      <th width="167" bgcolor="#660066" scope="col"><div align="left" class="blanco">
        <div align="left">GRUPO</div>
      </div>      </th>
      <th width="113" bgcolor="#660066" scope="col">Precio Especial</th>
      <th width="56" bgcolor="#660066" scope="col"><div align="left">Inicio</div></th>
      <th width="56" bgcolor="#660066" scope="col"><div align="left">Termina</div></th>
      <th width="56" bgcolor="#660066" scope="col"><div align="left">Part</div></th>
      <th width="63" bgcolor="#660066" scope="col"><div align="left">Aseg</div></th>
      <th width="46" bgcolor="#660066" scope="col"><div align="left" class="blanco">
        <div align="left">Elimina </div>
      </div></th>
    </tr>
	
<?php 	
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";
if ($_GET["criterio"]!="" and $_GET["criterio"]!='*'){
	$txt_criterio = $_GET["criterio"];
	if(is_numeric($_GET["criterio"])){
	$criterio = " where cbarra= '".$txt_criterio."'";
	}else {
	$criterio = " where (descripcion like '%" . $txt_criterio . "%' or descripcion1 like '%" . $txt_criterio . "%')order by descripcion ASC";
	}
} else if($_GET["criterio"]=='*'){
$criterio = "order by descripcion ASC";
}



if($_GET['criterio']){
$ssql = "select * from articulos " . $criterio;
} else {
$ssql = "select * from articulos 
where
entidad='".$entidad."'
order by descripcion ASC";
}

$result = mysql_db_query($basedatos,$ssql);
$num_total_registros = mysql_num_rows($result);

//Limito la busqueda
if($_GET['registros']==NULL){
$TAMANO_PAGINA = 30;
} else {
$TAMANO_PAGINA=$_GET['registros'];
}
//examino la página a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
		$inicio = 0;
		$pagina=1;
}
else {
	$inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

//miro a ver el número total de campos que hay en la tabla con esa búsqueda

//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

if($_GET['criterio']){
$ssql = "select * from articulos " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
} else {
$ssql = "select * from articulos where descripcion !='' order by descripcion ASC limit " . $inicio . "," . $TAMANO_PAGINA;
}

$result = mysql_db_query($basedatos,$ssql);
?>
	
	
    <tr>
      <?php
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];
$sSQL52="SELECT count(*) as totalRegedit
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
  
$i=$myrow52['totalRegedit'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

$sSQL51="SELECT *
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
$bali=$myrow51['almacen'];

  
  $sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$color1='#FF3300';

$C=$myrow['codigo'];
$sSQL7="SELECT *
FROM
articulosPrecioNivel
WHERE entidad='".$entidad."' AND
codigo = '".$code."' 
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
$gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo,rutaModifica,precioPorAlmacen
FROM
gpoProductos
WHERE codigoGP='".ltrim($gpoProducto)."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);


$sSQL39d= "
	SELECT 
*
FROM
preciosEspeciales
WHERE keyPA='".$myrow['keyPA']."'";
$result39d=mysql_db_query($basedatos,$sSQL39d);
$myrow39d = mysql_fetch_array($result39d);

?>

      <td bgcolor="<?php echo $color;?>" class="normal"><span class="codigos">
        <input name="keyPA[]" type="hidden" id="keyPA" value="<?php echo $myrow['keyPA'];?>" />
        

      </span>
	  
      

      
	  <label>
      <?php 
		if($myrow['descripcion']){
		echo ltrim($myrow['descripcion']);
		} else  {
		echo ltrim($myrow['descripcion1']);
		}
		?>
	  </label>
			









            
            
			<label>
			<?php 
	  if(!$bali){
	   echo '<img src="/sima/imagenes/stop.png" alt="NO TIENE ASIGNADO NINGUN PRECIO O ALMACEN" width="13" height="13" border="0" />';
	   }
	  ?>
            <?php if($myrow['generico']=='si'){?>
            <blink> <img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" /> </blink>
            <?php } else { echo '';}?>   
            </label>      <span class="codigos">
            <?php //echo $myrow['codigo'];?>
            <input name="codigo[]" type="hidden" id="codigo" value="<?php echo $myrow['codigo'];?>" />
            </span></td>
            
      <td bgcolor="<?php echo $color;?>" class="normal">
	  <?php //*********gpoProductos
	 
 $sSQL7= "Select distinct * From gpoProductos where codigoGP='".$myrow['gpoProducto']."'";
$result7=mysql_db_query($basedatos,$sSQL7); 
$myrow7 = mysql_fetch_array($result7); 
       echo $myrow7['descripcionGP']; ?> 
       
      </td>
        <td bgcolor="<?php echo $color;?>" class="normal" ><span class="normal">
        
        
          <input name="precioEspecial[]" type="text" class="normalmid" id="precioEspecial[]" 
      value="<?php if($myrow39d['precioEspecial']){ echo ltrim($myrow39d['precioEspecial']);} ?>" size="15" />
      
      
      
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="normal" ><?php 
		if($myrow39d['fechaInicial']){
		echo cambia_a_normal($myrow39d['fechaInicial']);
		}else{
		echo '---';
		}
		?></td>
        <td bgcolor="<?php echo $color;?>" class="normal" ><?php 
		if($myrow39d['fechaFinal']){
		echo cambia_a_normal($myrow39d['fechaFinal']);
		}else{
		echo '---';
		}
		?></td>
        <?php 
         $sSQL6="SELECT codigo,nivel1,nivel3,almacen
FROM
  articulosPrecioNivel
WHERE keyPA='".$myrow['keyPA']."' order by keyAPN
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
        
        ?>
      <td bgcolor="<?php echo $color;?>" class="normal" ><?php echo '$'.number_format($myrow6['nivel1'],2);?></td>
      <td bgcolor="<?php echo $color;?>" class="normal" ><?php echo '$'.number_format($myrow6['nivel3'],2);?></td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
        <?php if($myrow39d['precioEspecial']){ ?>
        <span class="Estilo24"> <a   href="pEspeciales.php?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&keyPA=<?php echo $myrow['keyPA'];?>"> <img src="/sima/imagenes/btns/checkbtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
        <?php } else { 
        echo '---';
		} ?>
      </span></div></td>
    </tr>
    <?php }?>
  </table>
  <p align="center">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label>
    <input name="actualizar" type="image" src="/sima/imagenes/btns/refresh.png"  id="actualizar" value="Actualizar" />
    <input name="criterios" type="hidden" value="<?php echo $_GET["criterio"];?>" />
    
    </label>
    <input name="gpoProducto1" type="hidden" id="gpoProducto1" value="<?php echo $_GET['gpoProducto1']; ?>" />
</p>
</form>


<div align="center" class="normal"><?php


//pongo el número de registros total, el tamaño de página y la página que se muestra
echo "Número de registros encontrados: " . $num_total_registros . "<br>";
echo "Se muestran páginas de " . $TAMANO_PAGINA . " registros cada una<br>";
echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";


//construyo la sentencia SQL
/* $ssql = "select * from articulos " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
echo $ssql . "<p>"; */

/*
$rs = mysql_query($ssql);

 while ($fila = mysql_fetch_object($rs)){
	echo $fila->descripcion . "<br>";
} */

//cerramos el conjunto de resultados y la conexión con la base de datos
/* mysql_free_result($rs);
mysql_close($conn); 
 */
//echo "<p>";

//muestro los distintos índices de las páginas, si es que hay varias páginas
//echo $res=$i/$total_paginas;
$palabrasABC=32;

if ($total_paginas > 1){
	for ($i=1;$i<=$total_paginas;$i++){
		if ($pagina == $i) 
			//si muestro el índice de la página actual, no coloco enlace
			echo $pagina . "  ";
		else
			//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
			echo "<a href='precios.php?pagina=" . $i . "&criterio=" . $txt_criterio . "&registros=" . $_GET['registros'] . "'>" . $i . "</a> ";
	}
}

?></div>

<?php 
if($_POST['actualizar'] AND $_POST['keyPA'] AND $_POST['descripcion']  ){

$q1 = "UPDATE articulos set 

descripcion='".$_POST['descripcion']."',

fechaActualizacion='".$fecha1."',

hora='".$hora1."',
usuario='".$usuario."'

WHERE keyPA='".$_POST['keyPA']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
?>

  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script> 

</body>
</html>
<?php
}
}
?>