<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=150,height=200,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 

<script language="javascript" type="text/javascript">   

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
           
        if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, ingresa el nombre del paciente!")   
                return false   
        }            
}   
  
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=YES") 
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

if($_POST['cargo']){
$pagina='ambulatorioEncabezado.php';
} else if($_POST['cargod']) {
$pagina='/sima/salir.php';
}

$sSQL331= "SELECT 
* 
FROM clientesInternos
order by keyClientesInternos DESC";
$result331=mysql_db_query($basedatos,$sSQL331);
$myrow331 = mysql_fetch_array($result331); 

$keyCI= $myrow331['keyClientesInternos']+1;

$URL='cargosAmbulatorios.php';
$ali=$ALMACEN;

$hora = date("H:i a");

//**************************ANTES DE HACER UN CARGO VERIFICAR SI TIENE CREDITO***************************
//****************************Comparo precio contra credito***********************
$codigoBeta=$_POST['codigoBeta'];
$priceLevel=$_POST["priceLevel"];
$ctaMayores=$_POST["ctaContable"];
$agregarlos = $_POST["agregarP"];
$banderita=$_POST['flag'];
$Cost=$_POST['Cost'];

for($i=0;$i<$banderita;$i++){
 $sSQL12= "
SELECT *
FROM
clientesPrecios
WHERE
codigo='".$agregarlos[$i]."'
and
numCliente='".$_POST['seguro']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$Cost=$myrow12["precioAseguradora"];
if(!$Cost){
$sSQL13= "
SELECT *
FROM
articulosPrecioNivel
WHERE
codigo='".$agregarlos[$i]."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
	$precioLevel=$myrow13['nivel1'];
	$precioLevel1=$myrow13['nivel3'];
	$Cost=$precioLevel;
}} //cierro comparacion

//*************************Cierro comparacion de precio contra credito********************
$sSQL39= "SELECT *
FROM
segurosLimites
where 
seguro='".$_POST['seguro']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$creditoTope=$myrow39['cantidad'];
$fechaInicial=$myrow39['fechaInicial'];
$fechaFinal=$myrow39['fechaFinal'];
$secureLoader=$myrow39['seguro'];
if($secureLoader==$_POST['seguro'] AND $_POST['credencial'] and !$_POST['nuevo']){
//and fecha1 between  '".$fechaInicial."' and '".$fechaFinal."'
$sSQL40= "SELECT sum(costo) as totalCredito
FROM
cargosCuentaPaciente
where 
credencial='".$_POST['credencial']."' and
seguro='".$secureLoader."' and fecha1 between  '".$fechaInicial."' and '".$fechaFinal."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$totalCredito=$myrow40['totalCredito'];
$totalCredito+=$Cost;

if($totalCredito<$creditoTope){
echo '<br>';
echo "El Paciente tiene un crédito disponible de: "."$".number_format($creditoTope-$totalCredito,2)." y un acumulado de "."$".number_format($totalCredito,2).", de un crédito de "."$".number_format($creditoTope,2);
$cumpleRequisitos="si";
} else {
$cumpleRequisitos="no";
}
} else {///si coinciden los seguros entondces es un estudiante
$cumpleRequisitos="si";
}
//*********************************************************
//********************CLIENTES AMBULATORIOS  A FARMACIA ***************************
if($cumpleRequisitos=="si"){


$sSQL1= "Select * From clientesInternos WHERE numeroE = '".$_POST['PACIENTE']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numeritoE=$_POST['numeroPaciente'];
if($_POST['nuevo']){
$_POST['paciente']="";
}

$sSQL4= "Select max(numeroE) as final From clientesInternos";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
//$numPaciente = $myrow4['final']+1; 

if($_POST['cargoTotal']){
$tipoConsulta='cxc';
} else {
$tipoConsulta='normal';
}

if($_POST['seguro']){
$status='cxc';
}else{
$status='pendiente';
}

//*************genero orden aleatoria*********
$nOrden=rand(0,100000);
if($nOrden1){

$nOrdenT=$nOrden1;
} else {
$nOrdenT=$nOrden;
}
 
$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE
usuario='".$usuario."' order by keyClientesInternos DESC";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33); 


//*****************cierro orden*****************

if($_POST['cargos'] AND $_POST['paciente']!=$myrow33['paciente']){
$agrega = "INSERT INTO clientesInternos ( 
numeroE,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden
) values (
'".$_POST['PACIENTE']."',
'".$_POST['medico']."',
'".$_POST['paciente']."',
'".$_POST['seguro']."',
'".$_POST['autoriza']."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'pendiente',
'".$_POST['cita']."',
'".$ali."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".$_POST['observaciones']."','".$_POST['edad']."','externo',
'".$nOrden."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33); 
$keyClientesI=$myrow33['keyClientesInternos'];

?>


<script type="text/vbscript">
msgbox "SE GENERO LA ORDEN # <?php echo $myrow33['keyClientesInternos']; ?>!"
</script><style type="text/css">
<!--
body {
	background-image: url(file:///Z|/sima/imagenes/imagenesModulos/screen_venta.jpg);
	background-repeat: no-repeat;
}
-->
</style>';
<?php 
}


//**********************CIERRO CLIENTES AMBULATORIOS A FARMACIA*********************

} else {//cierre de cumplir requisitos
echo '<script type="text/vbscript">
msgbox "YA SE SUPERO SU LIMITE DE CREDITO, NO PODEMOS AGREGAR CARGOS!"
</script>';
}
	



?>
<?php 

if($_POST['quitar']){
$codigo=$_POST['codigo'];

for($i=0;$i<$_POST['bandera'];$i++){
$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$codigo[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}

}
$nOrden1=$nOrdenT;
?>


<?php	
if($_POST['verCargos']){ 
$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
echo mysql_error();
if($myrow33['numeroE'] and !$_POST['nuevo']){
$numeroE1=$myrow33['numeroE'];
 } 
} 
 ?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.Estilo24 {font-size: 10px}
-->
</style>

<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
-->
</style>
<head>

<!-- Original:  Tom Khoury (twaks@yahoo.com) -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<script>
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[2].focus();
break;
         }
      }
   }
}

</script>
<body MS_POSITIONING="GridLayout" onLoad="javascript:placeFocus()">
<?php 
$sSQL39= "SELECT *
FROM
almacenes
where 
almacen='".$ALMACEN."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
?>
<h1 align="center">Venta al P&uacute;blico</h1>
<form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>"  onSubmit="return valida(this);">
    <table width="811" border="0" align="center" class="Estilo24">
      <tr>
        <th width="6" class="Estilo24" scope="col">+</th>
        <th colspan="3" bgcolor="#660066" class="style14" scope="col"><?php echo '[ '.$myrow39['descripcion'].' ]'; ?></th>
      </tr>
      <?php  ?>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <th bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">Edad: </div></th>
        <th colspan="2" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left">
          <input name="edad" type="text" class="Estilo24" id="edad" value="<?php 
		  if($_POST['edad'] and !$_POST['nuevo']){
		  echo $_POST['edad'];
		  } else if($myrow33['edad'] and !$_POST['nuevo']){
		  echo $myrow33['edad']; 
		  }
		  ?>" size="2" maxlength="2" onKeyPress="return checkIt(event)"/>
        </div></th>
      </tr>
      <tr>
        <th width="6" class="Estilo24" scope="col">&nbsp;</th>
        <th width="137" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
        <th colspan="2" class="Estilo24" scope="col"><div align="left"><strong>
            <label> </label>
            </strong>
                <input name="paciente" type="text" class="Estilo24" id="paciente" value="<?php 
		  if($_POST['paciente']){
		  echo $_POST['paciente'];
		  } else if($myrow33['paciente'] and !$_POST['nuevo']){
		  echo $myrow33['paciente']; 
		  }
		  ?>" size="60" />
        </div></th>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFCCFF" class="Estilo24">M&eacute;dico</td>
        <td colspan="2" bgcolor="#FFCCFF" class="Estilo24"><label>
          <input name="medico" type="text" class="Estilo24" id="medico"  value="<?php echo $_POST['medico'];?>" readonly=""/>
        </label>
          <input name="M" type="button" class="Estilo24" id="M"  onclick="javascript:ventanaSecundaria3(
		'/sima/cargos/listaMedicos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>')" value="M" />
          <input name="despliegaMedico" type="text" class="Estilo24"  size="60" readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaMedico']){ echo $_POST['despliegaMedico'];} else { echo "";}?>"/></td>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <th scope="col"><div align="left">M&eacute;dico For&aacute;neo </div></th>
        <th colspan="2" scope="col"><div align="left">
          <input name="medicoForaneo" type="text" class="Estilo24" id="medicoForaneo" value="<?php 
		  if($_POST['medicoForaneo']){
		  echo $_POST['medicoForaneo'];
		  } else if($myrow33['medicoForaneo']){
		  echo $myrow33['medicoForaneo']; 
		  }
		  ?>" size="60" />
        </div></th>
      </tr>
      <tr>
        <th width="6" class="Estilo24" scope="col">&nbsp;</th>
        <th scope="col"><div align="left"><strong>Compa&ntilde;&iacute;a</strong></div></th>
        <th colspan="2" scope="col"><div align="left">
            <div id="lista">
              <input name="seguro" type="text" class="Estilo24" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
              <input name="agregarCargos3" type="button" class="Estilo24" id="agregarCargos3"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/agregarSeguros.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="S" />
              <input name="nomSeguro" type="text" class="Estilo24" id="nomSeguro" size="80" readonly="" 
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
            </div>
        </div></th>
      </tr>
   
     
      <tr>
        <th width="6" class="Estilo24" scope="col">&nbsp;</th>
        <td class="Estilo24">N&deg; Credencial/N&oacute;mina: </td>
        <td colspan="2" class="Estilo24"><input name="credencial" type="text" class="Estilo24" id="credencial" 
	value="<?php 
	if($_POST['credencial'] and !$_POST['nuevo']){
	echo $_POST['credencial'];
	} else if($myrow33['credencial']){
	echo $myrow33['credencial']; 
	}
	?>" size="60" />        </td>
      </tr>
   
  
    
    
      <tr>
        <th width="6" class="Estilo24" scope="col">&nbsp;</th>
        <td bgcolor="#FFCCFF" class="Estilo24">Observaciones</td>
        <td colspan="2" bgcolor="#FFCCFF" class="Estilo24"><label>
          <textarea name="observaciones" cols="60" rows="3" class="Estilo24" id="observaciones"></textarea>
        </label></td>
      </tr>
      <tr>
        <th width="6" class="Estilo24" scope="col">&nbsp;</th>
        <td colspan="3" bgcolor="#660066" class="style12 style13"><div align="center"><?php echo $leyenda; ?></div></td>
      </tr>
      <tr>
        <th height="36" colspan="5" class="Estilo24" scope="col"><div align="center"></div>
            <label>
            <div align="center">
              <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo Px" />
              <input name="cargos" type="submit" class="Estilo24" id="cargos" value="Agregar Nota de Cargo" 
	 >
          </div>
          </label>
            <?php 
			
$sSQL1= "Select * From clientesInternos WHERE keyClientesInternos = '".$keyClientesI."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
			
			
			
			?>
            <div align="center"></div></th>
      </tr>
      <tr>
        <th height="36" colspan="5" class="Estilo24" scope="col"><label>
  <label></label>
            <label>
          </label>
  <label></label>
          </label>
          <label>
          <div align="center">
       
			<?php if($_POST['cargos']){ ?>
            <a href="javascript:ventanaSecundaria('agregaArticulos.php?numeroE=<?php echo $myrow1['keyClientesInternos']; ?>')"></a> 
			<a href="javascript:ventanaSecundaria('/sima/cargos/agregaArticulos.php?numeroE=<?php echo $myrow1['keyClientesInternos']; ?>&amp;credencial=<?php echo $_POST['credencial']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>&amp;banderaCXC=<?php echo $_POST['banderaCXC']; ?>')"> 
			<img src="/sima/imagenes/draw_pen_ok_48.gif" alt="Cargar Art&iacute;culos" width="48" height="48" border="0" /></a>            <a href="javascript:ventanaSecundaria('/sima/cargos/despliegaArticulos.php?numeroE=<?php echo $myrow1['keyClientesInternos']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"> <img src="/sima/imagenes/draw_pen_remove_48.gif" alt="Quitar Art&iacute;culos" width="48" height="48" border="0" /></a>
            
            <a href="javascript:ventanaSecundaria2('/sima/cargos/imprimirServicios.php?numeroE=<?php echo $myrow1['keyClientesInternos']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>')"></a>          </div>
            
			<?php } ?>
			</label>          
			
			<div align="center"><strong>
            <input name="almacenImporte" type="hidden" id="almacenImporte" value="<?php echo $_POST['almacenImporte']; ?>" />
            </strong>
            <input name="ali" type="hidden" id="ali" value="<?php echo $ali; ?>" />
            <input name="pacientes" type="hidden" id="pacientes" value="<?php echo $_POST['paciente']; ?>" />
            <input name="PACIENTED" type="hidden" id="PACIENTED" value="<?php echo $_POST['paciente']; ?>" />
            <input name="FOLIOD" type="hidden" id="PACIENTED" value="<?php echo $Folio[0]; ?>" />
            <input name="keyClientesI" type="hidden" id="FOLIOD" value="<?php echo $keyClientesI; ?>" />
            <input name="pagina" type="hidden" id="keyClientesI" value="<?php echo $pagina; ?>" />
            <input name="nOrden" type="hidden" id="pagina" value="<?php echo $nOrden; ?>" />
</div>
          <div align="center"></div></th></tr>
    </table>
</form>
  
  
  <form id="form2" name="form2" method="post" action="">
    
    <div align="center"><span class="Estilo24"><span class="style7">
    <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
    </span></span>
      <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />
      <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
      <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
      <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
      <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
      <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
        <span class="style15"><?php echo $leyenda; ?></span>
      
      
      
      
      
      <?php	
if($_POST['verCargos']){
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
numeroE='".$numeroE1."'
";


if($numeroE1){ 
if($result=mysql_db_query($basedatos,$sSQL)){

?>	
      
      
      
    </div>
    <label>
    <div align="center">
      <input name="verCargos" type="submit" class="style12" id="verCargos" value="Ver Cargos" />
    </div>
    </label>
    <table width="462" border="0" align="center" class="style7">
      <tr>
        <th width="61" height="19" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style11">C&oacute;digo </span></div></th>
        <th width="290" bgcolor="#660066" class="style14" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="41" bgcolor="#660066" class="style14" scope="col"><span class="style11">Cantidad</span></th>
        <th width="52" bgcolor="#660066" class="style14" scope="col"><span class="style11">Precio</span></th>
      </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codProcedimiento'];

$sSQL7= "
	SELECT 
  *
FROM
articulosPrecioNivel
WHERE codigo = '".$code1."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

//traigo descuento

$sSQL11= "
	SELECT 
  *
FROM
 articulos
WHERE 

codigo = '".$code1."'
";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$sSQL4= "
	SELECT 
  *
FROM
existencias
WHERE codigo = '".$code1."'
and 
(almacen='HFARVP' or almacen='HFAR' )
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><label></label>
            <?php echo $myrow['codProcedimiento']; ?>
            <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />        </td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php echo $myrow11['descripcion']; ?></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php if($myrow['cantidad']){
echo $myrow['cantidad'];
} else {
echo "N/A";
}?></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	if($myrow7['nivel1']){
	  echo "$".number_format($myrow7['nivel1'],2);
	}  else {
	echo "0.00";
	}
	
	  ?>        </td>
      </tr>
      <?php }}?>
    </table>
    <p align="center">
      <label></label>
    </p>
<?php 
	}
	
	} ?>
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />

  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    
</p>
  <p>&nbsp;</p>

<p>&nbsp;</p>
  </form>
</body>
</html>