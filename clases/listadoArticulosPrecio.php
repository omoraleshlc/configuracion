<?php 
class consultaArticulosPrecio{
public function consultarArticulos($almacen,$entidad,$basedatos){
?>

<?php  
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE articulos set 

		activo='I'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else if($_GET['activa']=="activa"){
 $q = "UPDATE articulos set 

		activo='A'
		WHERE keyPA='".$_GET['keyPA']."'";
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
        status = "Este campo s�lo acepta n�meros."
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
   window.open(URL,"ventana2","width=800,height=800,scrollbars=YES") 
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
for($i=0;$i<=$_GET['bandera'];$i++){
if($keyPA[$i]!=NULL){
$q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',
cbarra='".$cBarra[$i]."',
fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$qas = "UPDATE existencias set 
descripcion='".$descripcion[$i]."'
 
WHERE keyPA='".$keyPA[$i]."'";

mysql_db_query($basedatos,$qas);
echo mysql_error();
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

//Highlight form element- � Dynamic Drive (www.dynamicdrive.com)
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


	<link href="/sima/js/editinplace.css" rel="Stylesheet" type="text/css" />
	<script src="/sima/js/prototype.js" type="text/javascript"></script>
	<script src="/sima/js/editinplace.js" type="text/javascript"></script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

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





<script type="text/javascript">

/***********************************************
* Show Hint script- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var horizontal_offset="9px" //horizontal offset of hint box from anchor link

/////No further editting needed

var vertical_offset="0" //horizontal offset of hint box from anchor link. No need to change.
var ie=document.all
var ns6=document.getElementById&&!document.all

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=(whichedge=="rightedge")? parseInt(horizontal_offset)*-1 : parseInt(vertical_offset)*-1
if (whichedge=="rightedge"){
var windowedge=ie && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-30 : window.pageXOffset+window.innerWidth-40
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure+obj.offsetWidth+parseInt(horizontal_offset)
}
else{
var windowedge=ie && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetHeight
}
return edgeoffset
}

function showhint(menucontents, obj, e, tipwidth){
if ((ie||ns6) && document.getElementById("hintbox")){
dropmenuobj=document.getElementById("hintbox")
dropmenuobj.innerHTML=menucontents
dropmenuobj.style.left=dropmenuobj.style.top=-500
if (tipwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=tipwidth
}
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+obj.offsetWidth+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+"px"
dropmenuobj.style.visibility="visible"
obj.onmouseout=hidetip
}
}

function hidetip(e){
dropmenuobj.style.visibility="hidden"
dropmenuobj.style.left="-500px"
}

function createhintbox(){
var divblock=document.createElement("div")
divblock.setAttribute("id", "hintbox")
document.body.appendChild(divblock)
}

if (window.addEventListener)
window.addEventListener("load", createhintbox, false)
else if (window.attachEvent)
window.attachEvent("onload", createhintbox)
else if (document.getElementById)
window.onload=createhintbox

</script>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>

</head>

<body>

<h1 align="center" >Lista de articulos, servicios,etc.   </h1>
<?php 


if(!$_GET['criterio']){
$_GET['criterio']=$_GET['criterios'];
}
?>



<?php 
if($_GET['gpoProductos']=='*' or !$_GET['gpoProductos']){
$gpp="(gpoProducto!='HONMED' and gpoProducto!='sIVA' and gpoProducto!='cIVA')";
}else{
$gpp="gpoProducto='".$_GET['gpoProductos']."' ";    
}

?>


  


</head>


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

  <p align="center" >Escoje El Grupo
    <label>
        <?php //*********gpoProductos
	 
 $sSQL7a= "Select distinct * From gpoProductos where 
(codigoGP!='HONMED' and codigoGP!='sIVA' and codigoGP!='cIVA')     
ORDER BY descripcionGP ASC ";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
echo mysql_error();
	  ?>
        <select name="gpoProductos"  onChange="this.form.submit();">
            <option
                <?php if($_GET['gpoProductos']=='*' ){echo 'selected=""';}?>
                value="*">TODOS LOS GRUPOS</option>
          <?php  	 		 
		   while($myrow7a = mysql_fetch_array($result7a)){ ?>
          <option 
		   <?php if($_GET['gpoProductos']==$myrow7a['codigoGP']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7a['codigoGP']; ?>">
                   <?php echo $myrow7a['descripcionGP']; ?>
          </option>
          <?php } 
		
		?>
        </select>
        
    </label>
  </p>
  <table width="857" class="table-forma">
    <tr>
      <td width="162"><span >Introduce el texto a buscar<span >
        <input name="codigo" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['codigo'] ){ echo $_POST['codigo'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
      </span></span></td>
      <td width="419"><span >
        <input name="criterio" type="text"    size="60" autocomplete="off"/>
        <script>
document.Form2.criterio.focus();
</script>
      </span></td>
      <td width="102"><span >
        <input type="image" src="/sima/imagenes/btns/searcharticles.png"  value="Buscar" />
      </span></td>
      <td width="98"><span >Mostrar Registros</span></td>
      <td width="54"><span >
        <label>
        <input name="registros" type="text"  id="registros" value="<?php if($_GET['registros']==NULL){ echo '30';} else { echo $_GET['registros'];}?>" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
        </label>
      </span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="537" class="table table-striped">

    <tr >
      <th width="53" >#</th>
      <th width="381" >Descripcion</th>
      <th width="106" >Codigo Barra </th>
      <th width="106" >Grupo</th>
      <th width="106" >Caja Con</th>
      <th width="106" >Part</th>
      <th width="106" >Aseg</th>
      <th width="106" >Depto</th>
      <th width="106" >Editar</th>
      <th width="106" >Status</th>
    </tr>

    

    
    
    
<?php 	
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";
if ($_GET["criterio"]!="" and $_GET["criterio"]!='*'){
	$cr = explode(" ",$_GET["criterio"]);
	$txt_criterio=$cr[0];
	if(is_numeric($_GET["criterio"])){
	$criterio = " where (entidad='".$entidad."' and sustancia like '%$txt_criterio%') or (entidad='".$entidad."' 
        and ".$gpp.") and cbarra= '".$txt_criterio."'";
	}else {
	$criterio = " where (entidad='".$entidad."' and sustancia like '%$txt_criterio%') or (entidad='".$entidad."' and 
            ".$gpp." 
            and 
            (descripcion like '%" . $txt_criterio . "%' or descripcion1 like '%" . $txt_criterio . "%')) order by descripcion ASC";
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
and
".$gpp."
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
//examino la p�gina a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
		$inicio = 0;
		$pagina=1;
}
else {
	$inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

//miro a ver el n�mero total de campos que hay en la tabla con esa b�squeda

//calculo el total de p�ginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

if($_GET['criterio']){
$ssql = "select * from articulos " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
} else {
$ssql = "select * from articulos where
entidad='".$entidad."' 
and
".$gpp."
and  
descripcion !='' order by descripcion ASC limit " . $inicio . "," . $TAMANO_PAGINA;
}

$result = mysql_db_query($basedatos,$ssql);


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
WHERE codigoGP='".$myrow['gpoProducto']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

?>

    <tr >
      <td height="48" ><?php echo $totalRegistros;
?></td>
      <td >
        <input name="keyPA[]" type="hidden" id="codigo" value="<?php echo $myrow['keyPA'];?>" />
      
          <label>
          <textarea name="descripcion[]"  cols="30" rows="1" wrap="physical"  id="descripcion[]"><?php
		if($myrow['descripcion']){
		echo trim($myrow['descripcion']);
		} else  {
		echo trim($myrow['descripcion1']);
		}
		?>
          </textarea>
          </label>
          <label>
          <?php 
	  if(!$bali){
	   echo '<img src="/sima/imagenes/stop.png" alt="NO TIENE ASIGNADO NINGUN PRECIO O ALMACEN" width="13" height="13" border="0"  />';
	   }
	  ?>
          <?php if($myrow['generico']=='si'){?>
          <blink> <img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" /> </blink>
          <?php } else { echo '';}?>
		  
		  
		  <?php if($myrow['sustancia']!=NULL){
		   echo '['.$myrow['sustancia'].']';
           } else { echo '';}?>
		  
		  
          </label>
     </td>
      
      
      
      
          
      
      
      <td ><input name="cBarra[]" type="text"  id="cBarra[]" 
      value="<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>" size="15" /></td>
      
      
      
      
      <td ><?php //*********gpoProductos
	 
 $sSQL7= "Select distinct * From gpoProductos ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="gpoProducto[]"  id="gpoProducto[]">
          <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
          <option 
		   <?php if($myrow7['codigoGP']==$myrow['gpoProducto']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
          <?php } 
		
		?>
        </select></td>
        
        
          <td  align="center">
          <?php if($myrow['cajaCon']>0){ echo $myrow['cajaCon'];}else{echo 'N/A';} ?>
          </td>
        
        
      <td
         
           ><?php
	  
	  if($myrow39['precioPorAlmacen']=='si'){
	  echo 'Precio Individual';	  
	  }else{
	  echo '$'.number_format($myrow6['nivel1'],2);
	  }
	  ?></td>
      <td
          
          ><?php
	  if($myrow39['precioPorAlmacen']=='si'){
	  echo 'Precio Individual';
	  }else{
	  echo '$'.number_format($myrow6['nivel3'],2);
	  }	  
	  ?></td>
      <td ><a  href="javascript:ventanaSecundaria2('../cargos/listaAlmacenesTodos.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow['keyPA']; ?>&amp;gpoProducto=<?php echo $myrow['gpoProducto'];?>')" onMouseover="showhint('Presiona aqui para asignar almacenes a este articulo...', this, event, '150px')"><img src="../imagenes/btns/precio.png" alt="Almacenes" width="20" height="20" border="0" /></a></td>
      <td ><?php 

 $modifica=$myrow39['rutaModifica'];



?>
        <?php if($modifica){ ?>
        <a href="<?php echo $modifica?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&nRequisicion=<?php echo $requisicion; ?>&amp;almacen=<?php echo $myrow13['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacen=<?php echo $ali; ?>&amp;keyPA=<?php echo $myrow['keyPA']; ?>" onMouseover="showhint('Presiona aqui para editar...', this, event, '150px')">
            <img src="../imagenes/btns/editbtn.png" alt="Modificaci&oacute;n de Art&iacute;culos, M&aacute;ximo, M&iacute;nimo, Reorden.." width="22" height="20" border="0" /> 
        </a>
        <?php } else { echo '?';} ?></td>
      
      
      
      
      <td ><?php if($myrow['activo']=='A'){ ?>
        <span class="Estilo24"> <a   href="precios.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&gpoProductos=<?php echo $_GET['gpoProductos'];?>&codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> <img src="../imagenes/btns/checkbtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onMouseover="showhint('Presiona aqui para cambiar el status del articulo..', this, event, '150px')" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
        <?php } else { ?>
        <a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&gpoProductos=<?php echo $_GET['gpoProductos'];?>&codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> <img src="../imagenes/btns/lockbtn.png" alt="INACTIVO" width="18" height="18" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
        <?php } ?>
        </span></td>
    </tr>
    <?php  }?>

  </table>
  <p align="center" >&nbsp;</p>
  <p align="center">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label>
    <input name="actualizar" type="submit" src="../imagenes/btns/refresh.png"  id="actualizar" value="Actualizar" />
    <input name="criterios" type="hidden" value="<?php echo $_GET["criterio"];?>" />
    
    </label>
    <input name="gpoProducto1" type="hidden" id="gpoProducto1" value="<?php echo $_GET['gpoProducto1']; ?>" />
</p>
   <input name="main" type="hidden" id="gpoProducto1" value="<?php echo $_GET['main']; ?>" />
      <input name="warehouse" type="hidden" id="gpoProducto1" value="<?php echo $_GET['warehouse']; ?>" />
            <input name="datawarehouse" type="hidden" id="gpoProducto1" value="<?php echo $_GET['datawarehouse']; ?>" />
</form>


<div align="center" ><?php

$sSQL3bd= "Select count(*) as t From articulos WHERE entidad='".$entidad."' 
and    
(gpoProducto ='PAT' or gpoProducto='MAT' or gpoProducto='GEN' or gpoProducto='MEDC' or gpoProducto='ARTVAR' or gpoProducto='PERF')
    
";
$result3bd=mysql_db_query($basedatos,$sSQL3bd);
$myrow3bd = mysql_fetch_array($result3bd);
$num_total_registros = $myrow3bd['t'];
//pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
echo "Numero de registros encontrados: " . $num_total_registros . "<br>";
echo "Se muestran paginas de " . $TAMANO_PAGINA . " registros cada una<br>";
echo "Mostrando la pagina " . $pagina . " de " . $total_paginas . "<p>";


//construyo la sentencia SQL
/* $ssql = "select * from articulos " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
echo $ssql . "<p>"; */

/*
$rs = mysql_query($ssql);

 while ($fila = mysql_fetch_object($rs)){
	echo $fila->descripcion . "<br>";
} */

//cerramos el conjunto de resultados y la conexi�n con la base de datos
/* mysql_free_result($rs);
mysql_close($conn); 
 */
//echo "<p>";

//muestro los distintos �ndices de las p�ginas, si es que hay varias p�ginas
//echo $res=$i/$total_paginas;
$palabrasABC=32;

if ($total_paginas > 1){
	for ($i=1;$i<=$total_paginas;$i++){
		if ($pagina == $i) 
			//si muestro el �ndice de la p�gina actual, no coloco enlace
			echo $pagina . "  ";
		else
			//si el �ndice no corresponde con la p�gina mostrada actualmente, coloco el enlace para ir a esa p�gina
			echo "<a href='precios.php?main=".$_GET['main']."&warehouse=".$_GET['warehouse']."&gpoProductos=".$_GET['gpoProductos']."&pagina=" . $i . "&criterio=" . $txt_criterio . "&registros=" . $_GET['registros'] . "'>" . $i . "</a> ";
	}
}

?></div>


<br>
<br>


</body>
</html>

<?php 
}
}
?>
