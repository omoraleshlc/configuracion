<?php  class expedientes{ 
public function buscarExpediente($entidad,$usuario,$numeroE,$basedatos){ ?>

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
                alert("Por Favor, escribe el dep�sito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el m�dico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el l�mite que desees asignar!")   
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
   window.open(URL,"ventana3","width=900,height=600,scrollbars=YES") 
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
        status = "Este campo s�lo acepta n�meros."
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
var agree=confirm("Est� Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>


<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>

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
.estilo25 {font-size: 18px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.Estilo27 {font-size: 10px}
.Estilo27 {font-size: 10px}
.Estilo28 {font-size: 10px}
.Estilo28 {font-size: 10px}
.Estilo29 {font-size: 10px}
.Estilo29 {font-size: 10px}
.Estilo30 {font-size: 10px}
.Estilo30 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center">Buscar Px<?php echo $leyenda; ?>
</h1>
<form name="form2" id="form2" method="post" action="">
  <table width="393" height="79" align="center" cellpadding="0" cellspacing="0" class="style71" style="border: 1px solid #000000;">
    <tr valign="middle" bordercolor="#FFFFFF" bgcolor="#DFDFDF" class="catalogo">
      <td colspan="2" bgcolor="#660066"><div align="center" class="style13">Datos del Paciente </div></td>
    </tr>
    <tr valign="middle" bgcolor="#FFCCFF" class="catalogo">
      <td bgcolor="#FFCCFF">Apellidos</td>
      <td><label>
        <input name="nombres" type="text" class="Estilo27" id="nombres" size="60" 
		value="<?php echo $_POST['nombres'];?>" />
        </label>
&nbsp;</td>
    </tr>
    <tr valign="middle" bgcolor="#FFCCFF" class="catalogo">
      <td width="105">&nbsp;</td>
      <td width="389"><label>
        <input name="mostrar" type="submit" class="style71" id="mostrar2" value="Buscar" />
      </label></td>
    </tr>
  </table>
</form>
<form id="form1" name="form1" method="post" action="consultasAnteriores.php" >
  <?php

if($nombres=$_POST['nombres']){
 $sSQL= "
SELECT * FROM 
pacientes 
where 
    
(entidad='".$entidad."'
         and
CONCAT(nombre1) like '%$nombres%'
or
CONCAT(apellido1,' ',apellido2) like '%$nombres%'
or
CONCAT(nombre1) like '%$nombres%'
or
nombreCompleto rlike '$nombres'
)
or
    (entidad='".$entidad."'
        and
numCliente='".$nombres."')
order by
apellido1 asc
";



$result=mysql_db_query($basedatos,$sSQL);

?>
<input name="nombrePaciente1" type="hidden" class="Estilo28" id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
<input name="nombrePaciente12" type="hidden" id="nombrePaciente122" value="<?php echo $_POST['numPaciente'];?>"/>
  <input name="nCuenta" type="hidden" class="Estilo27" id="nCuenta3" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
  <input name="numeroE" type="hidden" class="Estilo27" id="numeroE3" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="" />
  <table width="404" border="0" align="center" class="style7">
    <tr>
      <th width="60" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style111">Exp</span></div></th>
        <th width="409" bgcolor="#660066" scope="col"><div align="left"><span class="style11"><span class="style111">Paciente</span></span></div></th>
        <th width="48" bgcolor="#660066" scope="col"><div align="left">
          <div align="left"><span class="style11">Lista</span></div>
        </div></th>
    </tr>
      <tr>
        <?php 

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
$sSQL31= "Select  * From clientesInternos WHERE entidad='".$entidad."' and numeroE = '".$NUMEROE."' ";
//$result31=mysql_db_query($basedatos,$sSQL31);
//$myrow31 = mysql_fetch_array($result31);

$keyClientesInternos=$myrow31['keyClientesInternos'];
$NC=$myrow['numCliente'];
?>

        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24">
		 <span class="style12"><span class="Estilo30"><span class="style71"><a href="#"  onClick="javascript:ventanaSecundaria('dxActuales.php?numeroE=<?php echo $myrow['numCliente']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $keyClientesInternos; ?>')">
		 
		 </a>
	<?php echo $NC?>
		 </span></span></span> </td>
          <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">            
		  <a href="#"  onClick="javascript:ventanaSecundaria('dxActuales.php?numeroE=<?php echo $myrow['numCliente']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $keyClientesInternos; ?>')">          </a><span class="Estilo29">
          <?php if($myrow31['status']=='cerrada'){ 
		echo $nombrePaciente; 
		} else {
		echo $nombrePaciente;  
		} 
		?>
          </span>
         
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12">
		
		
		
<a href="#"  onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Revisar Historial Cl�nico del Paciente: '.$nombrePaciente;?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria3('antecedentesAnteriores.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen2=<?php echo $A; ?>&seguro=<?php echo $_POST['seguro']; ?>&numCliente=<?php echo $myrow['numCliente'];?>')"><img src="/sima/imagenes/listado.jpg" alt="Listado de Art&iacute;culos" width="12" height="12" border="0" /></a></span></td>
    </tr>

      <?php }}?>
  </table>
</form>
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