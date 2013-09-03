<?php  class expedientes{ 
public function expedientesDuplicados($entidad,$usuario,$numeroE,$basedatos){ ?>

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




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();


?>


</head>

<body  onLoad="document.getElementById('paciente').focus();">
<h1 align="center" class="titulos">Buscar Expedientes </h1>
<?php echo $leyenda; ?>
<div align="center"></div>
<form name="form1" id="form1" method="post" >
  <table width="524" class="table-forma">
    <tr valign="middle" >
      <th colspan="3"><div align="center" >Datos del Paciente </div></th>
    </tr>
    <tr valign="middle" >
      <td height="49" colspan="3" class="normalmid">Nuevo Paciente <span class="Estilo26"><span class="style121"><a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/btns/addpatient.png" alt="Datos Generales del Paciente" width="22" height="22" border="0" /></a><a href="javascript:ventanaSecundaria1('modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">
        <input name="numeroEx" type="hidden" class="Estilo28" id="numeroEx" size="60" readonly="" value="">
      </a></span></span></td>
    </tr>
    <tr valign="top"  >
      <td width="185" height="36" class="normalmid">N Exp. Apellido o Nombre</td>
      <td width="240" ><input name="paciente" type="text"  id="paciente" size="40" 
		value="<?php echo $_POST['nombres'];?>" /><p align="center">
  <a href="javascript:ventanaSecundaria1(
		'../cargos/busquedaAvanzada.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "numeroEx"; ?>&amp;seguro=<?php echo "paciente"; ?>')" class="style1">Busqueda Avanzada </a></p></td>
      <td width="97" >
      <input name="buscar" type="submit" src="../imagenes/btns/searcharticles.png"  id="mostrar2" value="Buscar" />  </td>
    </tr>
  </table>
<br /><br />

<?php

$descripcionA='Busca expedientes con el nombre de: '.$nombres;
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$nombres=$_POST['paciente'];
if($_POST['buscar']){
if(is_numeric($_POST['paciente'])){
$sSQL= "
SELECT * from pacientes where 
entidad='".$entidad."'
and
(numCliente='".$nombres."' or numEmpleado='".$nombres."' or numMatricula='".$nombres."')


";
}else{
$sSQL= "
SELECT * from pacientes where 
entidad='".$entidad."'
and
(concat(apellido1,' ',apellido2) like '%$nombres%' 
or 
concat(apellido1,' ',apellido2,' ',nombre1) like '%$nombres%')
or
nombreCompleto like '%$nombres%'

and numCliente > 0
order by nombreCompleto ASC";

}


$result=mysql_db_query($basedatos,$sSQL);

?>

<table width="621" class="table table-striped">
    <tr >
      <th width="57" height="19"   scope="col"><div align="left" >Exp</div></th>
      <th width="269"   scope="col"><div align="left" >Paciente</div></th>
      <th width="81"   scope="col">Usuario</th>
      <th width="83"   scope="col">Fecha </th>
      <th width="109"  scope="col"><div align="center" >Editar</div></th>
    </tr>
      
        <?php 

while($myrow = mysql_fetch_array($result)){ 

?>
<tr >
        <td height="24" bgcolor="<?php echo $color;?>" >
		 <a href="#" rel="htmltooltip" onClick="javascript:ventanaSecundaria('../ventanas/dxActuales.php?numeroE=<?php echo $myrow['numCliente']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $keyClientesInternos; ?>')">		 </a>
		 <?php echo $myrow['numCliente'];?>		  </td>
          <td bgcolor="<?php echo $color;?>" >
            <?php 
		echo $myrow['nombreCompleto']; 
		
		?>
          </span></span></span></td>
          <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
            <?php 
		echo $myrow['usuario']; 
		
		?>
          </span></div></td>
          <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
            <?php 			
			if ($myrow['fechaCreacion']){
		echo $myrow['fechaCreacion'];
		}
		else{
		 echo $myrow['fechaModificacion'];
		}
		?>
          </span></div></td>
        <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
          
          
          <a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/btns/editbtn.png" alt="Datos Generales del Paciente" width="22" height="22" border="0" /></a>
         
        </span></div></td>
    </tr>

      <?php }}?>
  </table>

</form>
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