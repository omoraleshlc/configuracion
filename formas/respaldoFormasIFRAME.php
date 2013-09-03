<?php include("/configuracion/operacioneshospitalariasmenu/urgencias/urgencias.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ajax Rotating Includes Script</title>
<script type="text/javascript">

/***********************************************
* Dynamic Ajax Content- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var loadedobjects=""
var rootdomain="http://"+window.location.hostname

function ajaxpage(url, containerid){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
page_request.open('GET', url, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}

</script>

<style type="text/css">
#leftcolumn{
float:left;
width:150px;
height: 400px;
border: 3px solid black;
padding: 5px;
padding-left: 8px;

}

#leftcolumn a{
padding: 3px 1px;
display: block;
width: 100%;
text-decoration: none;
font-weight: bold;
border-bottom: 1px solid gray;
}

#leftcolumn a:hover{
background-color: #FFFF80;
}

#rightcolumn{
float:left;
width:1000px;
min-height: 400px;
border: 3px solid black;
margin-left: 10px;
padding: 5px;
padding-bottom: 8px;
}

* html #rightcolumn{ /*IE only style*/
height: 400px;
}
</style>
</head>

<body>
<p>
  <?php 
$imagen='ventapublicourgencias.jpg';
$ventana1='/sima/OPERACIONESHOSPITALARIAS/urgencias/ventaPublico.php';
$ventana11='/sima/cargos/listadoPacientes.php';
//include("/configuracion/formas/ventaPublicoMenu.php"); 
?>
</p>
<p>&nbsp; </p>
<div id="leftcolumn">
<a href="javascript:ajaxpage('/sima/OPERACIONESHOSPITALARIAS/urgencias/ventaPublico.php?cargos=si&almacen=<?php echo $ALMACEN;?>', 'rightcolumn');">Venta al P�blico</a>
<a href="javascript:ajaxpage('/sima/OPERACIONESHOSPITALARIAS/urgencias/ventaPublico.php?paquetes=si&almacen=<?php echo $ALMACEN;?>', 'rightcolumn');">Cargar Paquetes</a>
<a href="javascript:ajaxpage('/sima/cargos/listadoPacientes.php?almacen=<?php echo $ALMACEN;?>', 'rightcolumn');">Listado de Pacientes</a>


</div>

<div id="rightcolumn"><h3>Men� de Pacientes Externos</h3></div>
<div style="clear: left; margin-bottom: 1em"></div>

</body>

</html>