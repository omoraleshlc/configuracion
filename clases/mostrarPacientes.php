<?php  class listaPX{ 
public function mostrarPacientes($ventana1,$ventana,$entidad,$TITULO,$almacen,$usuario,$numeroE,$basedatos){ ?>

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
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el depósito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el médico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el límite que desees asignar!")   
                return false   
        }   
}   
  
  
  
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
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
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Está Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
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
.style12 {font-size: 10px}
.catalogo {    font-family: Verdana, Arial, Helvetica, sans-serif;  
    font-size: 9px;  
    color: #333333;  
}
.style13 {
	color: #FFFFFF;
	font-weight: bold;
}
.enlace {cursor:default;}
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
-->
</style>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style111 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style111 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.Estilo26 {font-size: 10px}
.Estilo26 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center"><?php echo $TITULO;?></h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
<table width="710" align="center" cellpadding="0" cellspacing="0" class="style7" style="border: 1px solid #000000;">
      <tr valign="middle" bordercolor="#FFFFFF" bgcolor="#DFDFDF" class="catalogo">
        <td colspan="2" bgcolor="#660066"><div align="center" class="style13">Datos del Paciente </div></td>
      </tr>
      <tr valign="middle" class="catalogo">
        <td>Nuevo Paciente </td>
        <td><span class="Estilo26"><span class="style121"><a href="javascript:ventanaSecundaria1('<?php echo $ventana;?>?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" /></a><a href="javascript:ventanaSecundaria1('modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span></td>
    </tr>
      <tr valign="middle" bgcolor="#FFCCFF" class="catalogo">
        <td width="137"><div align="left" class="style7">Apellido Paterno, Materno </div></td>
        <td width="571" bgcolor="#FFCCFF"><label>
        <input name="nombres" type="text" class="Estilo24" id="nombres" size="60" 
		value="<?php echo $_POST['nombres'];?>"  />
        <input name="mostrar" type="submit" class="style7" id="mostrar" value="&gt;" />
          </label>
          &nbsp;
          <input name="nombrePaciente1" type="hidden" id="nombrePaciente1" value="<?php echo $_POST['numPaciente'];?>"/>
          <?php
$sSQL311= "Select max(nCuenta) as tope from clientesInternos WHERE numeroE = '".$_POST['numeroE']."'
 ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$nCuenta=$myrow31['tope'];
$nCuenta+=1;
?>
          <input name="nCuenta" type="hidden" class="Estilo24" id="nCuenta" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
        <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="" /></td>
      </tr>
    </table>
	
<?php

if($nombres=$_POST['nombres']){
$sSQL= "
SELECT * FROM 
pacientes 
where 
entidad='".$entidad."'
AND
(
CONCAT(nombre1) like '%$nombres%'
or
CONCAT(apellido1,' ',apellido2) like '%$nombres%'
or
CONCAT(nombre1) like '%$nombres%'
or
nombreCompleto rlike '$nombres'
)
order by
apellido1 asc
";



$result=mysql_db_query($basedatos,$sSQL);

?>
<p>&nbsp;</p>
<table width="338" border="0" align="center">
    <tr>
        <th width="49" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Expediente</span></div></th>
        <th width="240" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Paciente</span></div></th>
        <th width="35" bgcolor="#660066" scope="col"><span class="style111">Editar</span></th>
    </tr>
      <tr>
        <?php 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']." ".$myrow['apellido1']." ".
$myrow['apellido2']." ".$myrow['apellido3'];
$bandera+="1";


//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$NUMEROE."' and statusCuenta='abierta'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>


        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
<?php if(!$myrow31['numeroE']){ ?>
<a href="#" onClick="javascript:ventanaSecundaria('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numCliente'];?>
&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $almacen; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPaciente=<?php echo "interno"; ?>')">
        <?php 
			echo $myrow['numCliente'];
		
		  ?>        
		  </a>
		  <?php } else {?>
		   <?php echo $myrow31['numeroE']; ?>
<?php } ?>
	    </td>
		  
		  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
		<?php if(!$myrow31['numeroE']){ ?>
		<a href="#" onClick="javascript:ventanaSecundaria('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numCliente']; ?>
		&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $almacen; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPaciente=<?php echo "interno"; ?>')"><?php echo $nombrePaciente;?>
		</a> 
		 <?php } else {?>
		 <?php echo $nombrePaciente." "."(Cliente Interno o Prepago)"; ?>
<?php } ?>
		 
		<span class="style12"></span> </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12">
		
		
		<a href="javascript:ventanaSecundaria1('<?php echo $ventana1;?>?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" />
		</a>
		
		</span></td>
    </tr>

      <?php }}?>
    </table>
	<p>&nbsp;    </p>
	<p>
	  <input name="nombrePaciente1" type="hidden" class="Estilo24" id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    </p>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>