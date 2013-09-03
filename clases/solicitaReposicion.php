<?php 
class requestReposicion{
public function solicitarReposicion($usuario,$TITULO,$almacen,$entidad,$basedatos){
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

<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");
$codigo=$_POST['codigo'];
if($_POST['request'] and $_POST['trigger']=='on' and $_POST['ovidio']){

$nOrden=rand(0,8000000);


$sSQL23= "Select * From faltantes WHERE 
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino4']."'
and
status='sinsurtir'
";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 

if($rNombre23['nOrden']){


$agrega = "INSERT INTO ordenesResurtir 
(nOrden,fecha,hora,usuario,almacen,entidad) 
values 
('".$nOrden."','".$fecha1."','".$hora1."','".$usuario."','".$almacen."','".$entidad."')";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda='SE GENERO LA ORDEN #'.$nOrden;
}


for($i=0;$i<=$_POST['bandera'];$i++){

$sSQL23= "Select * From faltantes WHERE 
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino4']."'
and
status='sinsurtir'

";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 

if($rNombre23['nOrden']!=$nOrden){


$q1 = "UPDATE faltantes set 
status='request',
horaSolicitante='".$hora1."',
fechaSolicitante='".$fecha1."',
diaSolicitante='".$dia."',
usuarioSolicitante='".$usuario."',
nOrden='".$nOrden."'



WHERE 
entidad='".$entidad."'
and
codigo='".$codigo[$i]."'
and
almacen='".$_POST['almacenDestino4']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();


}
}//cierra validacion


echo 'Se Solicit� la orden'.$nOrden;
$trigger='off';
} else {
$trigger='on';
}
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style14 {color: #0000FF}
.Estilo24 {font-size: 10px}
.style19 {color: #FFFFFF}
.style20 {font-size: 10px; color: #FFFFFF; }
.style7 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style72 {font-size: 10px}
.style72 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center"><?php echo $TITULO?></h1>
<?php 
function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
?>


<form action="<?php echo $_SERVER['PHP_SELF'];?>?trigger=<?php echo $trigger;?>" method="post">
  <p align="center">
    <label class="style7"></label>
  </p>
  <table width="350" border="0" align="center">
    <tr>
      <td width="44"><span class="style71">Fecha</span></td>
      <td width="290"><label>
        <input name="fechaInicial" type="text" class="style7" id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];		 
		 } else {
		 echo $fecha1;

		 }
		 ?>"/>
      </label>
        <input name="button" type="button" class="Estilo24" id="lanzador" value="..." /></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style7">Almac&eacute;n</td>
      <td bgcolor="#FFCCFF"><?php require('/configuracion/componentes/comboAlmacen.php');

$comboAlmacen1=new comboAlmacen();
$comboAlmacen1->despliegaMiniAlmacenNM($entidad,'style7',$almacen,$almacenDestino,$basedatos);

?></td>
    </tr>


    <tr>
      <td>&nbsp;</td>
      <td><input name="Submit" type="submit" class="style71" value="buscar" /></td>
    </tr>
  </table>
  
  
  
  <?php if($_POST['Submit']){  ?>
  
  <p align="center">&nbsp;</p>
  <table width="568" border="0" align="center">
    <tr>
      <th width="30" bgcolor="#660066" class="style11" scope="col">Folio </th>

      <th width="502" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripci&oacute;n</span></div></th>
      <th width="121" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Fecha-Hora</span></div></th>
      <th width="47" bgcolor="#660066" scope="col"><div align="left"><span class="style11"> Vendidos </span></div></th>
      <th width="30" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Status </span></div></th>
    </tr>
	
<?php 	
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";
if ($_GET["criterio"]!="" and $_GET["criterio"]!='*'){
	$txt_criterio = $_GET["criterio"];
	$criterio = " where (articulos.descripcion like '%" . $txt_criterio . "%' or articulos.descripcion1 like '%" . $txt_criterio . "%') order by articulos.descripcion ASC";
} else if($_GET["criterio"]=='*'){
$criterio = "order by articulos.descripcion ASC";
}



if($_GET['criterio']){
$ssql = "select * from articulos,faltantes " . $criterio;
} else {
 $ssql = "select * from cargosCuentaPaciente
where
entidad='".$entidad."'
and
almacenDestino='".$_POST['almacenDestino4']."'
and
(gpoProducto='MAT' or gpoProducto='PAT' or gpoProducto='GEN' or gpoProducto='PERF')";
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
$ssql = "select * from cargosCuentaPaciente
where
entidad='".$entidad."'
and
almacenDestino='".$_POST['almacenDestino4']."'
and
(gpoProducto='MAT' or gpoProducto='PAT' or gpoProducto='GEN' or gpoProducto='PERF')
group by keyPA

";
}

if($result = mysql_db_query($basedatos,$ssql)){
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
 $sSQL5="SELECT descripcion,gpoProducto
FROM
  articulos
WHERE keyPA = '".$myrow['keyPA']."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
$gpoProducto=$myrow5['gpoProducto'];


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
$C=$myrow['codigo'];




$sSQL7="SELECT *
FROM
articulosPrecioNivel
WHERE entidad='".$entidad."' AND
codigo = '".$code."' 
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  

$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

?>
     
     
      <td bgcolor="<?php echo $color;?>" class="style71"><?php echo $myrow['folioVenta'];?></td>
      <td bgcolor="<?php echo $color;?>" class="style71"><span class=""><?php echo $myrow5['descripcion']; ?><?php if($myrow['generico']=='si'){?>
            <blink> <img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" /> </blink>
            <?php } else { echo '';}?>
            <input name="codigo[]" type="hidden" id="codigo" value="<?php echo $codigo;?>" />
      </span></td>
   
		
      <td bgcolor="<?php echo $color;?>" class="style71"><?php echo cambia_a_normal($myrow['fechaSolicitud']).' '.$myrow['hora1']; ?></td>
      <td bgcolor="<?php echo $color;?>" class="style71">
      <div align="center"><?php echo $myrow['cantidad'];?></div></td>
      <td bgcolor="<?php echo $color;?>" class="style71"><div align="center">
        <label>
        <input type="checkbox" name="checkbox" id="checkbox" />
        </label>
      </div></td>
    </tr>
    <?php } ?>
  </table>
  <p align="center">
  <input name="trigger" type="hidden" id="trigger" value="<?php echo $trigger; ?>" />
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label>
    <input name="request" type="submit" class="style71" id="request" value="Solicitar Orden Reposici&oacute;n" 
	<?php if( $totalRegistros==NULL){
	echo 'disabled="disabled"';
	}
	?> />
    </label>
    <input name="gpoProducto1" type="hidden" id="gpoProducto1" value="<?php echo $_GET['gpoProducto1']; ?>" />
</p>
</form>
<?php }} ?>
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
</body>
</html>

<?php 
}
}
?>
