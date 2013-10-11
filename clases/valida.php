<?php 
class validator {

static public function medico($usuario,$basedatos){


$sSQL1= "Select medico From usuarios WHERE usuario ='".$usuario."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
return $myrow1['medico'];
}

static public function tipoUsuario($usuario,$basedatos){


$sSQL1= "Select tipoUsuario From usuarios WHERE usuario ='".$usuario."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
return $myrow1['tipoUsuario'];
}


public function entidad($usuario,$basedatos){
$sSQL1= "Select entidad From usuarios WHERE usuario ='".$usuario."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
return $myrow1['entidad'];
}






var $url='/sima/index.php';
var $ID_EJERCICIO;

static function sesionesActivas($usuario,$llavePrimaria,$basedatos){
$llave = session_id(); 




$ip3 = "SELECT usuario
FROM
usuarios
WHERE


llave = '".$llave."' and status='activo' ";
$resultIP3=mysql_db_query($basedatos,$ip3);
$ipRes3 = mysql_fetch_array($resultIP3);
echo mysql_error();

if($ipRes3['usuario'] ){
return $ipRes3['usuario'];
}else{

session_destroy();
	return false;
	
?>	
<META HTTP-EQUIV="Refresh" 
      CONTENT="0; URL=/sima/index.php?usuario=<?php echo $ipRes3['usuario'];?>">';

<?php
	 echo exit; 

}


}//cierra funcion sesion es activas

static public function checallave($usuario,$basedatos){

$sSQL1= "Select usuario From usuarios WHERE usuario = '".$usuario."' and llave!='' and status='activo'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($myrow1['usuario']){
return true;
} else {
return false;
}
}


static public function ejercicio($ID_EJERCICIOM1,$basedatos,$db_conn){
/*
 $cmdstr4 = "select * from MATEO.CONT_EJERCICIO ORDER BY ID_EJERCICIO DESC";
$parsed4 = ociparse($db_conn, $cmdstr4);
ociexecute($parsed4);	 
$nrows4 = ocifetchstatement($parsed4,$resulta4);
$ID_EJERCICIOM1 = $resulta4['ID_EJERCICIO'][0];*/
return $ID_EJERCICIOM1; 
return '001-2010';
}






















//********************COMIENZAN VALIDACIONES***********************************
//funcion existe usuario?

//si no existe la sesi�n activa haz esto, valida en oracle

public function validaOracle($ip,$username,$passwd,$ingresar,$basedatos,$ID_EJERCICIOM,$dia,$hora1,$fecha1,$db_conn){
$crypt=$passwd;
//session_destroy();
//echo 'user'.$username;
//echo '<br>';
//echo 'passwd'.$passwd;
//echo '<br>';
//echo 'ingresar'.$ingresar;
$ingresar=1;

if($username and $passwd and $ingresar){ 
//***************existe?*****************************************
$username = mysql_real_escape_string($username); 
$passwd = mysql_real_escape_string($passwd); 


$sSQL1= "Select usuario From usuarios WHERE 
llave!=''
and
usuario = '".$username."'
and passwd ='".md5($passwd)."' 
and 
status='activo'  AND fechaIngreso!='' AND horaIngreso!=''";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$mm=$myrow1['usuario'];
//*****************probablemente est� inactivo
if($mm){ 
echo '<div class="error">
Tu Cuenta esta bloqueada... favor de comunicarse a sistemas o desbloquear manualmente, gracias!!

</div>';


//echo 'Tu Cuenta est� bloqueada... favor de comunicarse a sistemas o desbloquear manualmente, gracias!!';

return false;
} else {
$username = mysql_real_escape_string($username);  
$passwd = mysql_real_escape_string($passwd); 


  
$sSQL1= "Select usuario,passwd From usuarios WHERE usuario = '".$username."'
and passwd ='".md5($passwd)."' 
and 
status='inactivo'  AND fechaIngreso!='' AND horaIngreso!=''
and llave=''";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


$user = $myrow1['usuario'];
$passwd= $myrow1['passwd'];


if ($user) {
session_start();
$llave = session_id(); 



$q = "UPDATE usuarios set ip='".$ip."',
fechaIngreso='".$fecha1."',
horaIngreso='".$hora1."',
llave='".$llave."',
status='activo'
WHERE 
usuario='".$user."' and status='inactivo'
";
mysql_db_query($basedatos,$q);
echo mysql_error();


return $user;


		} else {

$agregaIP = "INSERT INTO usuariosIntentando ( 
usuario,password,fecha,hora,ip
) values ('".$username."','".$crypt."','".$fecha1."','".$hora1."','".$ip."')";
mysql_db_query($basedatos,$agregaIP);
echo mysql_error();
return false;
}

}//cuenta bloqueada

} else { //validacion de campos vacios

return false;
}

}//cierra comparacion del usuario en oracle

















static public function dia(){
return date("l");
}
static public function hora1(){
return date("H:i a");
}
static public function fecha1(){
return date("Y-m-d");
}


public function validaSession(){ 
echo '<script>';
echo 'alert("ESCRIBE TU USUARIO Y PASSWORD NUEVAMENTE !!!");';
echo '</script>';
/*echo '<div class="error">
error en tu usuario o password escribelos nuevamente

</div>';*/


echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/index.php">';
	  exit;   
}


static function usuarioInvalido(){
print  '<script type="text/vbscript">
msgbox "USUARIO NO VALIDO !" 
</script>';  

echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/index.php">';
	  exit;   
}

public function destruyeSesion($usuario,$hora1,$fecha1,$basedatos){


$q = "UPDATE usuarios set 
status='inactivo',
llave=null,
horaSalida='".$hora1."',
fechaSalida='".$fecha1."'
WHERE 
usuario='".$usuario."' and status='activo'
";
mysql_db_query($basedatos,$q);
echo mysql_error();


print '<script type="text/vbscript">
msgbox "FIN DE SESION, SE HA DESCONECTADO DE LA BASE DE DATOS !" 
</script>';
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/index.php">';
exit; 
session_destroy();
}

static public function javascript(){
echo '<script type="text/javascript"  src="/sima/js/stmenu.js"></script>';
echo '<script type="text/javascript">
window.onerror=function(m,u,l)
{
	window.status = "Java Script Error: "+m;
	return true;
}
</script>';
}


static function destruirSesion($llavePrimaria,$usuario,$basedatos,$db_conn){
//**********************parte de oracle*************************/
$actualiza="update pedro.usuario
set 
sesion =null,
sesion1=null
WHERE 
LOGIN='".$usuario."' ";
$actualiza2 = OCIParse($db_conn, $actualiza);
OCIExecute($actualiza2, OCI_DEFAULT);
OCICommit($db_conn);

//**************************************************************/
$borrame = "DELETE FROM sesiones WHERE usuario ='".$usuario."'";
mysql_db_query($basedatos,$borrame);
return true;

mysql_close();
}





public function validaOracle2($username,$basedatos,$llavePrimaria,$db_conn){
$crypt=$passwd;
$sSQL1= "Select * From usuarios WHERE usuario ='".$username."' and llave='".$llavePrimaria."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);




} //cierra funcion oracle2


static function conectaOracle($db_conecta){
//return $db_conecta = ocilogon("system", "hospital","//10.2.11.250/XE");
}


static function banderaOracle1($username,$db_conn){
$actualiza="update pedro.usuario
set 
sesion =null,
sesion1=null
WHERE 
LOGIN='".$usuario."' ";
$actualiza2 = OCIParse($db_conn, $actualiza);
OCIExecute($actualiza2, OCI_DEFAULT);
OCICommit($db_conn);
}

static function banderaOracle2($username,$db_conn){
$actualiza="update pedro.usuario
set 
sesion =null,
sesion1=1
WHERE 
LOGIN='".$usuario."' ";
$actualiza2 = OCIParse($db_conn, $actualiza);
OCIExecute($actualiza2, OCI_DEFAULT);
OCICommit($db_conn);
}

} //cierra clase


class muestraSesion{

static public function sesionActiva($usuario,$basedatos,$ALMACEN){

echo '<body class="style12">';
echo ' <div align="center">';
$sSQL1= "Select * From usuarios WHERE usuario ='".$usuario."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$fechaSession=$myrow1['fechaIngreso'];
$horaSession=$myrow1['horaIngreso'];

echo $ALMACEN;
}
}


class tipoUsuario{
public function tipoDeUsuario($usuario,$basedatos,$ALMACEN){

$sSQL1= "Select * From usuarios WHERE usuario ='".$usuario."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
return $myrow1['tipoUsuario'];
}
}


class validacionesModulos{

	public function validaModulos($cantidadModulos,$codModulo,$codSM,$entidad,$basedatos){

		for($i=0;$i<=$cantidadModulos;$i++){
			$checaModuloScript= "Select * From usuariosSubmodulos WHERE codModulo='".$codModulo."' 
			and codSM = '".$codSM."' and 
			usuario1 = '".$usuario."'";
			$resScript=mysql_db_query($basedatos,$checaModuloScript);
			$resulScripModulo = mysql_fetch_array($resScript);
		}

	}

}





class informacion{
    public function mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos){
      





echo '<link rel="stylesheet" type="text/css" href="/sima/css/styles.css" />';
/*
echo '<table broder="0">';
echo '<tr>';
echo '<td width="500">';
echo '<div id="content" align="center" height="1" width="1" style="background-color:'.$fondo.'; border: 1px solid #000000;">';
echo '<h5>'.$encabezado.'</h5>';

if($blink=='si'){
echo '<p class="'.$color.'"><blink> '.$texto.' </blink></p>';
} else{
    

echo '<p class="'.$color.'">'.$texto.' </p>';
}

echo '</div>';
echo '<td>';
echo '</tr>';

echo '</table>';*/

echo '<div class="'.$tipoMensaje.'">';
echo $encabezado;
echo '<br>';
echo $texto;
echo '</div>';
    }

}

class muestraEstilos{
public function styles(){ ?>
<style type="text/css">

@charset "utf-8";
/* CSS Document */

.syntax_comment {
    color: #808000;
}
.syntax_comment_mysql {
}
.syntax_comment_ansi {
}
.syntax_comment_c {
}
.syntax_digit {
}
.syntax_digit_hex {
    color: teal;
}
.syntax_digit_integer {
    color: teal;
}
.syntax_digit_float {
    color: aqua;
}
.syntax_punct {
    color: fuchsia;
}
.syntax_alpha {
}
.syntax_alpha_columnType {
    color: #FF9900;
}
.syntax_alpha_columnAttrib {
    color: #0000FF;
}
.syntax_alpha_reservedWord {
    color: #990099;
}
.syntax_alpha_functionName {
    color: #FF0000;
}
.syntax_alpha_identifier {
    color: black;
}
.syntax_alpha_charset {
    color: #6495ED;
}
.syntax_alpha_variable {
    color: #800000;
}
.syntax_quote {
    color: #008000;
}
.syntax_quote_double {
}
.syntax_quote_single {
}
.syntax_quote_backtick {
}
.syntax_indent0 {
    margin-left: 0;
}
.syntax_indent1 {
    margin-left: 1em;
}
.syntax_indent2 {
    margin-left: 2em;
}
.syntax_indent3 {
    margin-left: 3em;
}
.syntax_indent4 {
    margin-left: 4em;
}
.syntax_indent5 {
    margin-left: 5em;
}
.syntax_indent6 {
    margin-left: 6em;
}
.syntax_indent7 {
    margin-left: 7em;
}
html {
    font-size: 82%;
}
input, select, textarea {
    font-size: 1em;
}
body {
    background: none repeat scroll 0 0 #FFFFFF;
    color: #444444;
    font-family: sans-serif;
    margin: 0.5em;
    padding: 0;
}
textarea, tt, pre, code {
    font-family: monospace;
}
h1 {
    font-size: 100%;
    font-weight: bold;
}
h2 {
    color: #777777;
    font-size: 2em;
    font-weight: normal;
    padding: 10px 0 10px 3px;
    text-shadow: 0 1px 0 #FFFFFF;
}
h2 img {
    display: none;
}
h2 a img {
    display: inline;
}
.data {
    margin: 0 0 12px;
}
h3 {
    font-weight: bold;
}
a, a:link, a:visited, a:active {
    color: #235A81;
    cursor: pointer;
    outline: medium none;
    text-decoration: none;
}
a:hover {
    color: #235A81;
    text-decoration: underline;
}
#initials_table {
    background: none repeat scroll 0 0 #F3F3F3;
    border: 1px solid #AAAAAA;
    border-radius: 5px 5px 5px 5px;
    margin-bottom: 10px;
}
#initials_table td {
    padding: 8px !important;
}
#initials_table a {
    background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    border: 1px solid #AAAAAA;
    border-radius: 5px 5px 5px 5px;
    padding: 4px 8px;
}
dfn {
    font-style: normal;
}
dfn:hover {
    cursor: help;
    font-style: normal;
}
th {
    background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    color: #000000;
    font-weight: bold;
}
a img {
    border: 0 none;
}
hr {
    background-color: #000000;
    border: 0 none;
    color: #000000;
    height: 1px;
}
form {
    display: inline;
    margin: 0;
    padding: 0;
}
input[type="text"] {
    background: url("./images/input_bg.gif") repeat scroll 0 0 transparent;
    border: 1px solid #AAAAAA;
    border-radius: 2px 2px 2px 2px;
    box-shadow: 0 1px 2px #DDDDDD;
    color: #555555;
    margin: 6px;
    padding: 4px;
}
input[type="password"] {
    background: url("./images/input_bg.gif") repeat scroll 0 0 transparent;
    border: 1px solid #AAAAAA;
    border-radius: 2px 2px 2px 2px;
    box-shadow: 0 1px 2px #DDDDDD;
    color: #555555;
    margin: 6px;
    padding: 4px;
}
input[type="submit"] {
    background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    border: 1px solid #AAAAAA;
    border-radius: 12px 12px 12px 12px;
    color: #111111;
    font-weight: bold;
    margin-left: 14px;
    padding: 3px 7px;
    text-decoration: none;
    text-shadow: 0 1px 0 #FFFFFF;
}
input[type="submit"]:hover {
    background: -moz-linear-gradient(center top , #CCCCCC, #DDDDDD) repeat scroll 0 0 transparent;
    cursor: pointer;
    position: relative;
}
input[type="submit"]:active {
    left: 1px;
    position: relative;
    top: 1px;
}
textarea {
    height: 5em;
	width: auto;
    overflow: visible;
}
fieldset {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 1px solid #AAAAAA;
    border-radius: 4px 4px 0 0;
    box-shadow: 1px 1px 2px #FFFFFF inset;
    margin-top: 1em;
    padding: 1.5em;
    text-shadow: 0 1px 0 #FFFFFF;
}
fieldset fieldset {
    background: none repeat scroll 0 0 #E8E8E8;
    border: 1px solid #AAAAAA;
    margin: 0.8em;
}
fieldset legend {
    background-color: #FFFFFF;
    border: 1px solid #AAAAAA;
    border-radius: 2px 2px 2px 2px;
    box-shadow: 3px 3px 15px #BBBBBB;
    color: #444444;
    font-weight: bold;
    padding: 5px 10px;
}
button {
    display: inline;
}
table caption,  table td {
    margin: 0.1em;
    padding: 0.3em;
    text-shadow: 0 1px 0 #FFFFFF;
    vertical-align: top;
	font-size: 13px;
	border-top: 1px solid #dddddd;

}
table {
    border-collapse: collapse;
	background-color: transparent;
	border-spacing: 0;
}

.table-forma {
	border: 1px solid #CCC;
	/*border-collapse: collapse;*/
	/*background-color: transparent;*/
	/*border-spacing: 0;*/
}


th {
    /*border-top: 1px solid #dddddd;*/
    text-align: left;
	 vertical-align: top;
	   padding: 8px;
  line-height: 18px;
      margin: 0.1em;
    padding: 0.3em;
    text-shadow: 0 1px 0 #FFFFFF;
	font-size: 13px;
}

.table thead th {
  vertical-align: bottom;
}

.table caption + thead tr:first-child th,
.table caption + thead tr:first-child td,
.table colgroup + thead tr:first-child th,
.table colgroup + thead tr:first-child td,
.table thead:first-child tr:first-child th,
.table thead:first-child tr:first-child td {
  border-top: 0;
}

.table tbody + tbody {
  border-top: 2px solid #dddddd;
}

.table-condensed th,
.table-condensed td {
  padding: 4px 5px;
}



.table-bordered {
  border: 1px solid #dddddd;
  border-collapse: separate;
  *border-collapse: collapsed;
  border-left: 0;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
}

.table-bordered th,
.table-bordered td {
  border-left: 1px solid #dddddd;
}

.table-bordered caption + thead tr:first-child th,
.table-bordered caption + tbody tr:first-child th,
.table-bordered caption + tbody tr:first-child td,
.table-bordered colgroup + thead tr:first-child th,
.table-bordered colgroup + tbody tr:first-child th,
.table-bordered colgroup + tbody tr:first-child td,
.table-bordered thead:first-child tr:first-child th,
.table-bordered tbody:first-child tr:first-child th,
.table-bordered tbody:first-child tr:first-child td {
  border-top: 0;
}

.table-bordered thead:first-child tr:first-child th:first-child,
.table-bordered tbody:first-child tr:first-child td:first-child {
  -webkit-border-top-left-radius: 4px;
          border-top-left-radius: 4px;
  -moz-border-radius-topleft: 4px;
}

.table-bordered thead:first-child tr:first-child th:last-child,
.table-bordered tbody:first-child tr:first-child td:last-child {
  -webkit-border-top-right-radius: 4px;
          border-top-right-radius: 4px;
  -moz-border-radius-topright: 4px;
}

.table-bordered thead:last-child tr:last-child th:first-child,
.table-bordered tbody:last-child tr:last-child td:first-child {
  -webkit-border-radius: 0 0 0 4px;
     -moz-border-radius: 0 0 0 4px;
          border-radius: 0 0 0 4px;
  -webkit-border-bottom-left-radius: 4px;
          border-bottom-left-radius: 4px;
  -moz-border-radius-bottomleft: 4px;
}

.table-bordered thead:last-child tr:last-child th:last-child,
.table-bordered tbody:last-child tr:last-child td:last-child {
  -webkit-border-bottom-right-radius: 4px;
          border-bottom-right-radius: 4px;
  -moz-border-radius-bottomright: 4px;
}

.table-striped tbody tr:nth-child(odd) td,
.table-striped tbody tr:nth-child(odd) th {
  background-color: #f9f9f9;
}

.table tbody tr:hover td,
.table tbody tr:hover th {
  background-color: #f5f5f5;
}

table .span1 {
  float: none;
  width: 44px;
  margin-left: 0;
}

table .span2 {
  float: none;
  width: 124px;
  margin-left: 0;
}

table .span3 {
  float: none;
  width: 204px;
  margin-left: 0;
}

table .span4 {
  float: none;
  width: 284px;
  margin-left: 0;
}

table .span5 {
  float: none;
  width: 364px;
  margin-left: 0;
}

table .span6 {
  float: none;
  width: 444px;
  margin-left: 0;
}

table .span7 {
  float: none;
  width: 524px;
  margin-left: 0;
}

table .span8 {
  float: none;
  width: 604px;
  margin-left: 0;
}

table .span9 {
  float: none;
  width: 684px;
  margin-left: 0;
}

table .span10 {
  float: none;
  width: 764px;
  margin-left: 0;
}

table .span11 {
  float: none;
  width: 844px;
  margin-left: 0;
}

table .span12 {
  float: none;
  width: 924px;
  margin-left: 0;
}

table .span13 {
  float: none;
  width: 1004px;
  margin-left: 0;
}

table .span14 {
  float: none;
  width: 1084px;
  margin-left: 0;
}

table .span15 {
  float: none;
  width: 1164px;
  margin-left: 0;
}

table .span16 {
  float: none;
  width: 1244px;
  margin-left: 0;
}

table .span17 {
  float: none;
  width: 1324px;
  margin-left: 0;
}

table .span18 {
  float: none;
  width: 1404px;
  margin-left: 0;
}

table .span19 {
  float: none;
  width: 1484px;
  margin-left: 0;
}

table .span20 {
  float: none;
  width: 1564px;
  margin-left: 0;
}

table .span21 {
  float: none;
  width: 1644px;
  margin-left: 0;
}

table .span22 {
  float: none;
  width: 1724px;
  margin-left: 0;
}

table .span23 {
  float: none;
  width: 1804px;
  margin-left: 0;
}

table .span24 {
  float: none;
  width: 1884px;
  margin-left: 0;
}


img, input, select, button {
    vertical-align: middle;
}
select {
    background: url("./images/input_bg.gif") repeat scroll 0 0 transparent;
    border: 1px solid #AAAAAA;
    border-radius: 2px 2px 2px 2px;
    box-shadow: 0 1px 2px #DDDDDD;
    color: #333333;
    padding: 3px;
}
select[multiple] {
    background: -moz-linear-gradient(#FFFFFF, #F1F1F1 80%, #FBFBFB) repeat scroll 0 0 transparent;
}
.tools {
    padding: 0.2em;
}
.tools a {
    color: #3A7EAD !important;
}
.tools, fieldset.tblFooters {
    border-radius: 0 0 4px 5px;
    border-top: 0 none;
    clear: both;
    float: none;
    margin-bottom: 0.5em;
    margin-top: 0;
    text-align: right;
}
.null_ {
    font-style: normal;
    height: 20px;
    min-width: 50px;
    text-align: center;
}
fieldset .formelement {
    float: left;
    margin-right: 0.5em;
    white-space: nowrap;
}
fieldset [class="formelement"] {
    white-space: normal;
}
button.mult_submit {
    background-color: transparent;
    border: medium none;
}
table tr.odd th, .odd {
    background: none repeat scroll 0 0 #FFFFFF;
}
table tr.even th, .even {
    background: none repeat scroll 0 0 #F3F3F3;
}
table tr.odd th, table tr.odd, table tr.even th, table tr.even {
    text-align: left;
}
td.marked, table tr.marked td, table tr.marked th, table tr.marked {
    background: url("./images/marked_bg.png") repeat-x scroll 0 0 #B6C6D7;
    color: #000000;
}
.odd:hover, .even:hover, .hover, .structure_actions_dropdown {
    background: url("./images/marked_bg.png") repeat-x scroll 0 0 #B6C6D7;
    color: #000000;
}
table tr.odd:hover th, table tr.even:hover th, table tr.hover th {
    background: url("./images/marked_bg.png") repeat-x scroll 0 0 #B6C6D7;
    color: #000000;
}
tr.condition th, tr.condition td, td.condition, th.condition {
    border: 1px solid #FFCC99;
}
td.null {
    font-style: italic;
    text-align: right;
}
table .value {
    text-align: right;
    white-space: normal;
}
table [class="value"] {
    white-space: normal;
}
.value {
    font-family: monospace;
}
.value .attention {
    color: red;
    font-weight: bold;
}
.value .allfine {
    color: green;
}
img.lightbulb {
    cursor: pointer;
}
.pdflayout {
    background-color: #FFFFFF;
    border: 1px solid #000000;
    clip: inherit;
    display: none;
    overflow: hidden;
    position: relative;
}
.pdflayout_table {
    background: none repeat scroll 0 0 #D3DCE3;
    border: 1px dashed #000000;
    clip: inherit;
    color: #000000;
    cursor: move;
    display: inline;
    font-size: 80%;
    overflow: hidden;
    position: absolute;
    visibility: inherit;
    z-index: 2;
}
.syntax {
    font-family: Verdan,Arial,Tahoma;
    font-size: 110%;
}
.syntax a {
    border-bottom: 1px dotted black;
    text-decoration: none;
}
.syntax_comment {
    padding-left: 4pt;
    padding-right: 4pt;
}
.syntax_digit {
}
.syntax_digit_hex {
}
.syntax_digit_integer {
}
.syntax_digit_float {
}
.syntax_punct {
}
.syntax_alpha {
}
.syntax_alpha_columnType {
    text-transform: uppercase;
}
.syntax_alpha_columnAttrib {
    text-transform: uppercase;
}
.syntax_alpha_reservedWord {
    font-weight: bold;
    text-transform: uppercase;
}
.syntax_alpha_functionName {
    text-transform: uppercase;
}
.syntax_alpha_identifier {
}
.syntax_alpha_charset {
}
.syntax_alpha_variable {
}
.syntax_quote {
    white-space: pre;
}
.syntax_quote_backtick {
}
.icon, img.footnotemarker {
    margin-left: 0.3em;
    margin-right: 0.3em;
    vertical-align: -3px;
}
img.footnotemarker {
    display: none;
}
td .icon {
    margin: 0;
}
.selectallarrow {
    margin-left: 0.6em;
    margin-right: 0.3em;
}
.success h1, .notice h1, div.error h1 {
    border-bottom: 2px solid;
    font-weight: bold;
    margin: 0 0 0.2em;
    text-align: left;
}
div.success, div.notice, div.error, div.footnotes {
    /*background-position: 10px 50%;
    background-repeat: no-repeat;*/
    border: 1px solid;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 0 1px 1px #FFFFFF inset;
    margin: 0.5em 0 1.3em;
    padding: 10px 10px 10px 25px;
}
.success a {
    text-decoration: underline;
}
.notice a {
    text-decoration: underline;
}
.error a {
    text-decoration: underline;
}
.footnotes a {
    text-decoration: underline;
}
.success {
    background-color: #EBF8A4;
    color: #000000;
}
h1.success, div.success {
    background-image: url("./images/s_success.png");
    background-position: 5px 50%;
    background-repeat: no-repeat;
    border-color: #A2D246;
}
.success h1 {
    border-color: #00FF00;
}
.notice, .footnotes {
    background-color: #E8EEF1;
    color: #000000;
}
h1.notice, div.registrosAgregados, div.footnotes {
    background-image: url("./images/s_notice.png");
    background-position: 5px 50%;
    background-repeat: no-repeat;
    border-color: #3A6C7E;
}
.notice h1 {
    border-color: #FFB10A;
}
.error {
    background: none repeat scroll 0 0 pink;
    border: 1px solid maroon !important;
    color: #000000;
}
h1.error, div.error {
    background-image: url("./images/s_error.png");
    background-position: 5px 50%;
    background-repeat: no-repeat;
    border-color: #333333;
}
div.error h1 {
    border-color: #FF0000;
}
.confirmation {
    background-color: pink;
    color: #000000;
}
fieldset.confirmation {
}
fieldset.confirmation legend {
}
.tblcomment {
    color: #000099;
    font-size: 70%;
    font-weight: normal;
}
.tblHeaders {
    background: none repeat scroll 0 0 #D3DCE3;
    color: #000000;
    font-weight: bold;
}
div.tools, .tblFooters {
    background: none repeat scroll 0 0 #D3DCE3;
    color: #000000;
    font-weight: normal;
}
.tblHeaders a:link, .tblHeaders a:active, .tblHeaders a:visited, div.tools a:link, div.tools a:visited, div.tools a:active, .tblFooters a:link, .tblFooters a:active, .tblFooters a:visited {
    color: #0000FF;
}
.tblHeaders a:hover, div.tools a:hover, .tblFooters a:hover {
    color: #FF0000;
}
.noPrivileges {
    color: #FF0000;
    font-weight: bold;
}
.disabled, .disabled a:link, .disabled a:active, .disabled a:visited {
    color: #666666;
}
.disabled a:hover {
    color: #666666;
    text-decoration: none;
}
tr.disabled td, td.disabled {
    background-color: #F3F3F3;
    color: #AAAAAA;
}
.nowrap {
    white-space: nowrap;
}
body.loginform h1, body.loginform a.logo {
    display: block;
    text-align: center;
}
body.loginform {
    text-align: center;
}
body.loginform div.container {
    margin: 0 auto;
    text-align: left;
    width: 30em;
}
form.login label {
    float: left;
    font-weight: bolder;
    width: 10em;
}

#main_body {width:526px;margin-top:200px;text-align:left;height:295px;}

.commented_column {
    border-bottom: 1px dashed black;
}
.column_attribute {
    font-size: 70%;
}
#topmenu a {
    text-shadow: 0 1px 0 #FFFFFF;
}
#topmenu .error {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 0 none !important;
    color: #AAAAAA;
}
ul#topmenu, ul#topmenu2, ul.tabs {
    font-weight: bold;
    list-style-type: none;
    margin: 0;
    padding: 0;
}
ul#topmenu2 {
    clear: both;
    height: 2em;
    margin: 0.25em 0.5em 0;
}
ul#topmenu li, ul#topmenu2 li {
    float: left;
    margin: 0;
    vertical-align: middle;
}
#topmenu img, #topmenu2 img {
    margin-right: 0.5em;
    vertical-align: -3px;
}
#topmenucontainer {
    background: url("./images/tab_bg.png") repeat-x scroll 0 0 transparent;
    border-top: 1px solid #AAAAAA;
}
.tabactive {
    background: none repeat scroll 0 0 #FFFFFF !important;
}
ul#topmenu a, ul#topmenu span {
    display: block;
    margin: 0;
    padding: 0;
    white-space: nowrap;
}
ul#topmenu ul a {
    margin: 0;
}
ul#topmenu .submenu {
    display: none;
    position: relative;
}
ul#topmenu .shown {
    display: inline-block;
}
ul#topmenu ul {
    border: 1px solid #DDDDDD;
    display: none;
    list-style-type: none;
    margin: 0;
    padding: 0;
    position: absolute;
    right: 0;
}
ul#topmenu li:hover {
    background: url("./images/tab_hover_bg.png") repeat-x scroll 50% 0 transparent !important;
}
ul#topmenu li:hover ul, ul#topmenu .submenuhover ul {
    background: none repeat scroll 0 0 #FFFFFF;
    display: block;
}
ul#topmenu ul li {
    width: 100%;
}
ul#topmenu2 a {
    background: none repeat scroll 0 0 #F2F2F2;
    border: 1px solid #DDDDDD;
    border-radius: 20px 20px 20px 20px;
    display: block;
    margin: 7px 6px 7px 0;
    padding: 4px 10px;
    white-space: nowrap;
}
ul#topmenu span.tab {
    color: #666666;
}
fieldset.caution a {
    color: #FF0000;
}
fieldset.caution a:hover {
    background-color: #FF0000;
    color: #FFFFFF;
}
#topmenu {
    margin-top: 0.5em;
    padding: 0.1em 0.3em;
}
ul#topmenu ul {
    box-shadow: 2px 2px 3px #666666;
}
ul#topmenu > li {
    border-left: 1px solid #CCCCCC;
    border-right: 1px solid #FFFFFF;
}
ul#topmenu a, ul#topmenu span {
    padding: 10px;
}
ul#topmenu ul a {
    border-radius: 0 0 0 0;
    border-width: 1pt 0 0;
}
ul#topmenu ul li:first-child a {
    border-width: 0;
}
ul#topmenu > li > a:hover, ul#topmenu > li > .tabactive {
    text-decoration: none;
}
ul#topmenu ul a:hover, ul#topmenu ul .tabactive {
    text-decoration: none;
}
ul#topmenu a.tab:hover, ul#topmenu .tabactive {
}
ul#topmenu2 a.tab:hover, ul#topmenu2 a.tabactive {
    background-color: #E5E5E5;
    border-radius: 0.3em 0.3em 0.3em 0.3em;
    text-decoration: none;
}
ul#topmenu > li.active {
    border-right: 0 none;
}
ul#topmenu span.tab, a.error {
    color: #CCCCCC;
    cursor: url("./images/error.ico"), default;
}
table.calendar {
    width: 100%;
}
table.calendar td {
    text-align: center;
}
table.calendar td a {
    display: block;
}
table.calendar td a:hover {
    background-color: #CCFFCC;
}
table.calendar th {
    background-color: #D3DCE3;
}
table.calendar td.selected {
    background-color: #FFCC99;
}
img.calendar {
    border: medium none;
}
form.clock {
    text-align: center;
}
div#tablestatistics {
    border-bottom: 0.1em solid #669999;
    margin-bottom: 0.5em;
    padding-bottom: 0.5em;
}
div#tablestatistics table {
    float: left;
    margin-bottom: 0.5em;
    margin-right: 1.5em;
    margin-top: 0.5em;
}
div#tablestatistics table caption {
    margin-right: 0.5em;
}
#tableuserrights td, #tablespecificuserrights td, #tabledatabases td {
    vertical-align: middle;
}
#serverinfo {
    background: none repeat scroll 0 0 #888888;
    border-bottom: 1px solid #FFFFFF;
    border-radius: 4px 4px 0 0;
    padding: 10px;
    text-shadow: 0 1px 0 #000000;
}
#serverinfo .item {
    color: #FFFFFF;
    white-space: nowrap;
}
#span_table_comment {
    font-style: italic;
    font-weight: normal;
    white-space: nowrap;
}
#serverinfo img {
    margin: 0 0.1em 0 0.2em;
}
#textSQLDUMP {
    font-family: "Courier New",Courier,mono;
    font-size: 110%;
    height: 95%;
    width: 95%;
}
#TooltipContainer {
    background-color: #FFFFCC;
    border: 0.1em solid #000000;
    color: #006600;
    height: auto;
    overflow: visible;
    padding: 0.5em;
    position: absolute;
    visibility: hidden;
    width: 20em;
    z-index: 99;
}
#fieldset_add_user_login div.item {
    border-bottom: 1px solid silver;
    margin-bottom: 0.3em;
    padding-bottom: 0.3em;
}
#fieldset_add_user_login label {
    display: block;
    float: left;
    max-width: 100%;
    padding-right: 0.5em;
    text-align: right;
    width: 10em;
}
#fieldset_add_user_login span.options #select_pred_username, #fieldset_add_user_login span.options #select_pred_hostname, #fieldset_add_user_login span.options #select_pred_password {
    max-width: 100%;
    width: 100%;
}
#fieldset_add_user_login span.options {
    display: block;
    float: left;
    max-width: 100%;
    padding-right: 0.5em;
    width: 12em;
}
#fieldset_add_user_login input {
    clear: right;
    max-width: 100%;
    width: 12em;
}
#fieldset_add_user_login span.options input {
    width: auto;
}
#fieldset_user_priv div.item {
    float: left;
    max-width: 100%;
    width: 9em;
}
#fieldset_user_priv div.item div.item {
    float: none;
}
#fieldset_user_priv div.item label {
    white-space: nowrap;
}
#fieldset_user_priv div.item select {
    width: 100%;
}
#fieldset_user_global_rights fieldset {
    float: left;
}
div#serverstatus table caption a.top {
    float: right;
}
div#serverstatus div#serverstatusqueriesdetails table, div#serverstatus table#serverstatustraffic, div#serverstatus table#serverstatusconnections {
    float: left;
}
#serverstatussection, .clearfloat {
    clear: both;
}
div#serverstatussection table {
    margin-bottom: 1em;
    width: 100%;
}
div#serverstatussection table .name {
    width: 18em;
}
div#serverstatussection table .value {
    width: 6em;
}
div#serverstatus table tbody td.descr a, div#serverstatus table .tblFooters a {
    white-space: nowrap;
}
div#serverstatus div#statuslinks a:before, div#serverstatus div#sectionlinks a:before, div#serverstatus table tbody td.descr a:before, div#serverstatus table .tblFooters a:before {
}
div#serverstatus div#statuslinks a:after, div#serverstatus div#sectionlinks a:after, div#serverstatus table tbody td.descr a:after, div#serverstatus table .tblFooters a:after {
}
body#bodyquerywindow {
    background-color: #F5F5F5;
    background-image: none;
    margin: 0;
    padding: 0;
}
div#querywindowcontainer {
    margin: 0;
    padding: 0;
    width: 100%;
}
div#querywindowcontainer fieldset {
    margin-top: 0;
}
#togglequerybox {
    margin: 0 10px;
}
#serverstatus p {
    background: none repeat scroll 0 0 #555555;
    border: 1px solid #000000;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 0 1px 2px #FFFFFF;
    color: #D4FB6A;
    margin: 1.5em 0;
    padding: 10px 10px 10px 25px;
}
#serverstatus p a {
    color: #FFFFFF;
    text-decoration: underline;
}
#serverstatus h3 {
    color: #999999;
    font-size: 1.7em;
    font-weight: normal;
    margin: 35px 0;
}
#sectionlinks {
    background: none repeat scroll 0 0 #F3F3F3;
    border: 1px solid #AAAAAA;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 0 1px 1px #FFFFFF inset;
    padding: 16px;
}
#sectionlinks a, #statuslinks a {
    background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    border: 1px solid #AAAAAA;
    border-radius: 20px 20px 20px 20px;
    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    color: #111111;
    font-size: 0.88em;
    font-weight: bold;
    line-height: 35px;
    margin-left: 7px;
    padding: 5px 10px;
    text-decoration: none;
    text-shadow: 0 1px 0 #FFFFFF;
}
#sectionlinks a:hover, #statuslinks a:hover {
    background: -moz-linear-gradient(center top , #CCCCCC, #DDDDDD) repeat scroll 0 0 transparent;
}
div#sqlquerycontainer {
    float: left;
    width: 69%;
}
div#tablefieldscontainer {
    float: right;
    width: 29%;
}
div#tablefieldscontainer select {
    background: none repeat scroll 0 0 #FFFFFF;
    width: 100%;
}
textarea#sqlquery {
    border-radius: 4px 4px 4px 4px;
    font-family: inherit;
    padding: 5px;
    width: 100%;
}
textarea#sql_query_edit {
    display: block;
    height: 7em;
    width: 95%;
}
div#queryboxcontainer div#bookmarkoptions {
    margin-top: 0.5em;
}
#maincontainer {
}
#mysqlmaininformation, #pmamaininformation {
    float: left;
    width: 49%;
}
#maincontainer ul {
    list-style-type: disc;
    vertical-align: middle;
}
#maincontainer li {
    margin-bottom: 0.3em;
}
li#li_create_database {
    list-style-image: url("./images/b_newdb.png");
}
li#li_select_lang {
    list-style-image: url("./images/s_lang.png");
}
li#li_select_mysql_collation {
    list-style-image: url("./images/s_asci.png");
}
li#li_select_theme {
    list-style-image: url("./images/s_theme.png");
}
li#li_user_info {
}
li#li_mysql_status {
    list-style-image: url("./images/s_status.png");
}
li#li_mysql_variables {
    list-style-image: url("./images/s_vars.png");
}
li#li_mysql_processes {
    list-style-image: url("./images/s_process.png");
}
li#li_mysql_collations {
    list-style-image: url("./images/s_asci.png");
}
li#li_mysql_engines {
    list-style-image: url("./images/b_engine.png");
}
li#li_mysql_binlogs {
    list-style-image: url("./images/s_tbl.png");
}
li#li_mysql_databases {
    list-style-image: url("./images/s_db.png");
}
li#li_export {
    list-style-image: url("./images/b_export.png");
}
li#li_import {
    list-style-image: url("./images/b_import.png");
}
li#li_change_password {
    list-style-image: url("./images/s_passwd.png");
}
li#li_log_out {
    list-style-image: url("./images/s_loggoff.png");
}
li#li_mysql_privilegs {
    list-style-image: url("./images/s_rights.png");
}
li#li_switch_dbstats {
    list-style-image: url("./images/b_dbstatistics.png");
}
li#li_flush_privileges {
    list-style-image: url("./images/s_reload.png");
}
li#li_user_preferences {
    list-style-image: url("./images/b_tblops.png");
}
#body_browse_foreigners {
    background: none repeat scroll 0 0 #D0DCE0;
    margin: 0.5em 0.5em 0;
}
#bodyquerywindow {
    background: none repeat scroll 0 0 #D0DCE0;
}
#bodythemes {
    margin: auto;
    text-align: center;
    width: 500px;
}
#bodythemes img {
    border: 0.1em solid black;
}
#bodythemes a:hover img {
    border: 0.1em solid red;
}
#fieldset_select_fields {
    float: left;
}
#selflink {
    background: none repeat scroll 0 0 #F3F3F3;
    border-top: 0.1em solid silver;
    clear: both;
    display: block;
    margin-bottom: 1em;
    margin-top: 1em;
    text-align: right;
    width: 100%;
}
#table_innodb_bufferpool_usage, #table_innodb_bufferpool_activity {
    float: left;
}
#div_mysql_charset_collations table {
    float: left;
}
.operations_half_width {
    float: left;
    width: 48%;
}
.operations_full_width {
    clear: both;
    width: 100%;
}
#qbe_div_table_list {
    float: left;
}
#qbe_div_sql_query {
    float: left;
}
label.desc {
    float: left;
    width: 30em;
}
label.desc sup {
    position: absolute;
}
code.sql, div.sqlvalidate {
    background: none repeat scroll 0 0 #E5E5E5;
    border-bottom: 0 none;
    border-top: 0 none;
    display: block;
    margin-bottom: 0;
    margin-top: 0;
    max-height: 10em;
    overflow: auto;
    padding: 1em;
}
#main_pane_left {
    float: left;
    padding-top: 1em;
    width: 60%;
}
#main_pane_right {
    margin-left: 60%;
    padding-left: 1em;
    padding-top: 1em;
}
.group {
    background: none repeat scroll 0 0 #F3F3F3;
    border: 1px solid #999999;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 3px 3px 10px #DDDDDD;
    margin-bottom: 1em;
    padding-bottom: 1em;
}
.group h2 {
    background-color: #BBBBBB;
    box-shadow: 1px 1px 15px #999999 inset;
    color: #FFFFFF;
    font-size: 1.6em;
    font-weight: normal;
    margin-top: 0;
    padding: 0.1em 0.3em;
    text-shadow: 0 1px 0 #777777;
}
.group-cnt {
    display: inline-block;
    padding: 0 0 0 0.5em;
    width: 98%;
}
textarea#partitiondefinition {
    height: 3em;
}
.hide {
    display: none;
}
#li_select_server {
    list-style-image: url("./images/s_host.png");
}
#list_server {
    list-style-image: none;
}
div.upload_progress_bar_outer {
    border: 1px solid black;
    width: 202px;
}
div.upload_progress_bar_inner {
    background-color: #D0DCE0;
    height: 12px;
    margin: 1px;
    width: 0;
}
table#serverconnection_src_remote, table#serverconnection_trg_remote, table#serverconnection_src_local, table#serverconnection_trg_local {
    float: left;
}
input.invalid_value[type="text"], .invalid_value {
    background: none repeat scroll 0 0 #FF0000;
}
.ajax_notification {
    background-image: url("./images/ajax_clock_small.gif");
    background-position: 2% 50%;
    background-repeat: no-repeat;
    border: 1px solid #E2B709;
    display: inline;
    left: 0;
    margin: 0 auto;
    padding: 5px;
    position: fixed;
    right: 0;
    text-align: center;
    top: 0;
    width: 350px;
    z-index: 1100;
}
.ajax_notification {
    background: none repeat scroll 0 0 #FFE57E;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 0 5px 90px #888888;
    margin-top: 200px;
}
#loading_parent {
    position: relative;
    width: 100%;
}
.exportoptions h3, .importoptions h3 {
    border-bottom: 1px solid #999999;
    font-size: 110%;
}
.exportoptions ul, .importoptions ul, .format_specific_options ul {
    list-style-type: none;
    margin-bottom: 15px;
}
.exportoptions li, .importoptions li {
    margin: 7px;
}
.exportoptions label, .importoptions label, .exportoptions p, .importoptions p {
    float: none;
    margin: 5px;
}
#csv_options label.desc, #ldi_options label.desc, #latex_options label.desc, #output label.desc {
    float: left;
    width: 15em;
}
.exportoptions, .importoptions {
    margin: 20px 30px 30px 10px;
}
.exportoptions #buttonGo, .importoptions #buttonGo {
    background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    border: 1px solid #AAAAAA;
    border-radius: 12px 12px 12px 12px;
    color: #111111;
    cursor: pointer;
    font-weight: bold;
    margin-left: 14px;
    padding: 5px 12px;
    text-decoration: none;
    text-shadow: 0 1px 0 #FFFFFF;
}
#buttonGo:hover {
    background: -moz-linear-gradient(center top , #CCCCCC, #DDDDDD) repeat scroll 0 0 transparent;
}
.format_specific_options h3 {
    border: 0 none;
    margin: 10px 0 0 10px;
}
.format_specific_options {
    border: 1px solid #999999;
    margin: 7px 0;
    padding: 3px;
}
p.desc {
    margin: 5px;
}
select#db_select, select#table_select {
    width: 400px;
}
.export_sub_options {
    margin: 20px 0 0 30px;
}
.export_sub_options h4 {
    border-bottom: 1px solid #999999;
}
.export_sub_options li.subgroup {
    display: inline-block;
    margin-top: 0;
}
.export_sub_options li {
    margin-bottom: 0;
}
#quick_or_custom, #output_quick_export {
    display: none;
}
.importoptions #import_notification {
    font-style: italic;
    margin: 10px 0;
}
input#input_import_file {
    margin: 5px;
}
.formelementrow {
    margin: 5px 0;
}
p.enum_notice {
    font-size: 80%;
    margin: 5px 2px;
}
#enum_editor {
    display: none;
    overflow-x: hidden;
    overflow-y: auto;
    position: fixed;
    z-index: 101;
}
#enum_editor_no_js {
    margin: auto;
}
#enum_editor, #enum_editor_no_js {
    background: none repeat scroll 0 0 #D0DCE0;
    padding: 15px;
}
#popup_background {
    background: none repeat scroll 0 0 #000000;
    display: none;
    height: 100%;
    left: 0;
    overflow: hidden;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 100;
}
a.close_enum_editor {
    float: right;
}
#enum_editor #values, #enum_editor_no_js #values {
    margin: 15px 0;
    width: 100%;
}
#enum_editor #values input, #enum_editor_no_js #values input {
    margin: 5px 0;
    width: 100%;
}
.structure_actions_dropdown {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #AAAAAA;
    box-shadow: 0 3px 3px #DDDDDD;
    display: none;
    line-height: 24px;
    padding: 3px;
    position: absolute;
    z-index: 100;
}
.structure_actions_dropdown span {
    display: block;
}
.structure_actions_dropdown span:hover {
    background: none repeat scroll 0 0 #DDDDDD;
}
td.more_opts {
    white-space: nowrap;
}
iframe.IE_hack {
    border: 0 none;
    display: none;
    position: absolute;
    z-index: 1;
}
.config-form ul.tabs {
    font-weight: bold;
    list-style: none outside none;
    margin: 1.1em 0.2em 0;
    padding: 0 0 0.3em;
}
.config-form ul.tabs li {
    float: left;
}
.config-form ul.tabs li a {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #D5D5D5 #D5D5D5 -moz-use-text-color;
    border-style: solid solid none;
    border-width: 1px 1px medium;
    display: block;
    margin: 0.1em 0.2em 0;
    text-decoration: none;
    white-space: nowrap;
}
.config-form ul.tabs li a {
    background: none repeat scroll 0 0 #F2F2F2;
    border-radius: 5px 5px 0 0;
    color: #555555;
    padding: 7px 10px;
    text-shadow: 0 1px 0 #FFFFFF;
}
.config-form ul.tabs li a:hover, .config-form ul.tabs li a:active {
    background: none repeat scroll 0 0 #E5E5E5;
}
.config-form ul.tabs li a.active {
    background-color: #FFFFFF;
    color: #000000;
    margin-top: 1px;
    text-shadow: none;
}
.config-form fieldset {
    clear: both;
    margin-top: 0;
    padding: 0;
}
.config-form legend {
    display: none;
}
.config-form fieldset p {
    background: none repeat scroll 0 0 #FFFFFF;
    border-top: 0 none;
    margin: 0;
    padding: 0.5em;
}
.config-form fieldset .errors {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: none repeat scroll 0 0 #FBEAD9;
    border-color: #C83838;
    border-style: solid;
    border-width: 1px 0;
    font-family: sans-serif;
    font-size: small;
    list-style: none outside none;
    margin: 0 -2px 1em;
    padding: 0.5em 1.5em;
}
.config-form fieldset .inline_errors {
    color: #9A0000;
    font-size: small;
    list-style: none outside none;
    margin: 0.3em 0.3em 0.3em 0;
    padding: 0;
}
.config-form fieldset th {
    background: none repeat scroll 0 0 transparent;
    padding: 0.3em 0.3em 0.3em 0.5em;
    text-align: left;
    vertical-align: top;
    width: 40%;
}
.config-form fieldset .doc, .config-form fieldset .disabled-notice {
    margin-left: 1em;
}
.config-form fieldset .disabled-notice {
    color: #EE0000;
    cursor: help;
    font-size: 80%;
    text-transform: uppercase;
}
.config-form fieldset td {
    padding-bottom: 0.3em;
    padding-top: 0.3em;
    vertical-align: top;
}
.config-form fieldset th small {
    color: #444444;
    display: block;
    font-family: sans-serif;
    font-size: x-small;
    font-weight: normal;
}
.config-form fieldset th, .config-form fieldset td {
    border-right: medium none;
    border-top: 1px solid #D5D5D5;
}
fieldset .group-header th {
    background: none repeat scroll 0 0 #D5D5D5;
}
fieldset .group-header + tr th {
    padding-top: 0.6em;
}
fieldset .group-field-1 th, fieldset .group-header-2 th {
    padding-left: 1.5em;
}
fieldset .group-field-2 th, fieldset .group-header-3 th {
    padding-left: 3em;
}
fieldset .group-field-3 th {
    padding-left: 4.5em;
}
fieldset .disabled-field th, fieldset .disabled-field th small, fieldset .disabled-field td {
    background-color: #DDDDDD;
    color: #666666;
}
.config-form .lastrow {
    border-top: 1px solid #000000;
}
.config-form .lastrow {
    background: none repeat scroll 0 0 #D3DCE3;
    padding: 0.5em;
    text-align: center;
}
.config-form .lastrow input {
    font-weight: bold;
}
.config-form span.checkbox {
    display: inline-block;
    padding: 2px;
}
.config-form .custom {
    background: none repeat scroll 0 0 #FFFFCC;
}
.config-form span.checkbox.custom {
    background: none repeat scroll 0 0 #FFFFCC;
    border: 1px solid #EDEC90;
    padding: 1px;
}
.config-form .field-error {
    border-color: #AA1111 !important;
}
.config-form input[type="text"], .config-form select, .config-form textarea {
    border: 1px solid #A7A6AA;
    height: auto;
}
.config-form input[type="text"]:focus, .config-form select:focus, .config-form textarea:focus {
    background: none repeat scroll 0 0 #F7FBFF;
    border: 1px solid #6676FF;
}
.config-form .field-comment-mark {
    color: #000077;
    cursor: help;
    font-family: serif;
    font-style: italic;
    font-weight: bold;
    padding: 0 0.2em;
}
.config-form .field-comment-warning {
    color: #AA0000;
}
.config-form dd {
    margin-left: 0.5em;
}
.config-form dd:before {
    content: "▸ ";
}
.click-hide-message {
    cursor: pointer;
}
.prefsmanage_opts {
    margin-left: 2em;
}
#prefs_autoload {
    margin-bottom: 0.5em;
}


#table_columns input, #table_columns select {
    -moz-box-sizing: border-box;
    width: 14em;
}
#table_columns select {
    margin: 0 6px;
}


#encabezado { 
	

	background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    color: #000000;
	width: 602px;
 	height: 20px;
	/*margin-top: -16px;*/
  	/*margin-left: 201px;*/


}  

#ventaPublico { 

	background: -moz-linear-gradient(center top , #FFFFFF, #CCCCCC) repeat scroll 0 0 transparent;
    color: #000000;
	width: 950px;
 	height: 20px;
	/*margin-top: -16px;*/
  	/*margin-left: 201px;*/

}  
#ventaPublicoContent { 

	background: #e8eef0;
    color: #000000;
	width: 950px;
 	height: 60px;

}  

#liga1 { 

	background: #e8eef0;
    color: #000000;
	width: 200px;
 	height: 60px;

}  
#liga2 { 
	
	float: left;
	background: #e8eef0;
    color: #000000;
	width: 200px;
 	height: 60px;
	margin-top: -48px;
  	margin-left: 201px;

}  

#liga3 { 
	
	float: left;
	background: #e8eef0;
    color: #000000;
	width: 200px;
 	height: 60px;
	margin-top: -60px;
  	margin-left: 402px;

} 


#liga4 { 
	
	float: left;
	background: #e8eef0;
    color: #000000;
	width: 200px;
 	height: 60px;
	margin-top: -60px;
  	margin-left: 603px;

} 





#contener { 
	
	width: 602px;
	text-align:center;

} 

#contener2 { 
	
	width: 602px;
	text-align:left;

} 

/*contenedor de tablas*/


#conterprin { 
	
	width: 602px;
	text-align:center;

} 


#cont1 { 

	/*background: #e8eef0;
    color: #000000;*/
	width: 200px;
 	height: 150px;

}  
#cont2 { 
	
	float: left;
	/*background: #e8eef0;*/
    color: #000000;
	width: 250px;
 	height: 350px;
	margin-top: -100px;
  	margin-left: 201px;

}  

#cont3 { 
	
	float: left;
	/*background: #e8eef0;*/
    color: #000000;
	width: 180px;
 	height: 60px;
	margin-top: 10px;
  	margin-left: 452px;

} 



.form-search input,
.form-inline input,
.form-horizontal input,
.form-search textarea,
.form-inline textarea,
.form-horizontal textarea,
.form-search select,
.form-inline select,
.form-horizontal select,
.form-search .help-inline,
.form-inline .help-inline,
.form-horizontal .help-inline,
.form-search .uneditable-input,
.form-inline .uneditable-input,
.form-horizontal .uneditable-input,
.form-search .input-prepend,
.form-inline .input-prepend,
.form-horizontal .input-prepend,
.form-search .input-append,
.form-inline .input-append,
.form-horizontal .input-append {
  display: inline-block;
  *display: inline;
  margin-bottom: 0;
  *zoom: 1;
}

.form-search .hide,
.form-inline .hide,
.form-horizontal .hide {
  display: none;
}

.form-search label,
.form-inline label {
  display: inline-block;
}

.form-search .input-append,
.form-inline .input-append,
.form-search .input-prepend,
.form-inline .input-prepend {
  margin-bottom: 0;
}

.form-search .radio,
.form-search .checkbox,
.form-inline .radio,
.form-inline .checkbox {
  padding-left: 0;
  margin-bottom: 0;
  vertical-align: middle;
}

.form-search .radio input[type="radio"],
.form-search .checkbox input[type="checkbox"],
.form-inline .radio input[type="radio"],
.form-inline .checkbox input[type="checkbox"] {
  float: left;
  margin-right: 3px;
  margin-left: 0;
}

.control-group {
  margin-bottom: 9px;
}

legend + .control-group {
  margin-top: 18px;
  -webkit-margin-top-collapse: separate;
}

.form-horizontal .control-group {
  margin-bottom: 18px;
  *zoom: 1;
}

.form-horizontal .control-group:before,
.form-horizontal .control-group:after {
  display: table;
  content: "";
}

.form-horizontal .control-group:after {
  clear: both;
}

.form-horizontal .control-label {
  float: left;
  width: 140px;
  padding-top: 5px;
  text-align: right;
}

.form-horizontal .controls {
  *display: inline-block;
  *padding-left: 20px;
  margin-left: 160px;
  *margin-left: 0;
}

.form-horizontal .controls:first-child {
  *padding-left: 160px;
}

.form-horizontal .help-block {
  margin-top: 9px;
  margin-bottom: 0;
}

.form-horizontal .form-actions {
  padding-left: 160px;
}


</style>


<?php 
} 
}
?>




<?php 
class muestraEstilosV2{
public function styles(){ ?>
<link href="../bt/css/bootstrap.css" rel="stylesheet">
    <link href="../bt/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../bt/css/prettify.css" rel="stylesheet">
    <link rel="shortcut icon" href="../imagenes/LOGOHLC.png">   
          <!-- Le styles -->


  
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="../bt/assets/js/jquery.js"></script>
    <script src="../bt/assets/js/bootstrap-transition.js"></script>
    <script src="../bt/assets/js/bootstrap-alert.js"></script>
    <script src="../bt/assets/js/bootstrap-modal.js"></script>
    <script src="../bt/assets/js/bootstrap-dropdown.js"></script>
    <script src="../bt/assets/js/bootstrap-scrollspy.js"></script>
    <script src="../bt/assets/js/bootstrap-tab.js"></script>
    <script src="../bt/assets/js/bootstrap-tooltip.js"></script>
    <script src="../bt/bt/assets/js/bootstrap-popover.js"></script>
    <script src="../bt/assets/js/bootstrap-button.js"></script>
    <script src="../bt/assets/js/bootstrap-collapse.js"></script>
    <script src="../bt/assets/js/bootstrap-carousel.js"></script>
    <script src="../bt/assets/js/bootstrap-typeahead.js"></script>
    <script src="../bt/assets/js/bootstrap-affix.js"></script>






    <script src="../bt/js/holder/holder.js"></script>
    <script src="../bt/assets/js/prettify.js"></script>
    <link href="../bt/assets/login-box.css" rel="stylesheet" type="text/css" />
    <script src="../bt/assets/js/application.js"></script>
    <link rel="stylesheet" type="text/css" href="../bt/js/styles3.css"></link>
    

<link href="../bt/css/armazon.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../bt/assets/m4a.js"></script>   
<link href="../bt/css/bootstrap-editable.css" media="screen" rel="stylesheet" type="text/css"></link>

<!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../bt/js/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../bt/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../bt/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../bt/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../imagenes/favicon.ico">
  
<!--bootrsap 3 -->



    
<!--barra separadora -->
<link href="../bt/docs.css" rel="stylesheet"></link>
<?php 
} 
}
?>