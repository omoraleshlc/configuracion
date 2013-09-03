<?php  class desplegar { 
public function internarPaciente($TITULO,$ventana,$ventana2,$keyPacientes,$entidad,$hora,$fecha,$almacen,$usuario,$numeroE,$basedatos){ 
?>

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
   window.open(URL,"ventana","width=500,height=150,scrollbars=YES") 
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
$estilos-> styles();

?>
 

</head>

<body>
<h1 align="center" >&nbsp;</h1>
<h1 align="center" >Reservar Expediente </h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >

<table width="548" align="center" cellpadding="4" cellspacing="0"  style="border: 1px solid #CCC;" >
      <tr valign="middle"   >
        <td colspan="3" ><div align="center" >Datos del Paciente </div></td>
      </tr>
      <tr valign="middle" >
        <td valign="top"  >Nuevo Paciente <a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/btns/addpatient.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" /></a></td>
        <td  >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>

    </tr>
      <tr valign="top"  >
        <td width="199" ><span >Apellido Paterno, Materno </span></td>
        <td width="240" ><div align="left" >
          <input name="nombres" type="text"  id="nombres" size="40" 
		value="<?php echo $_POST['nombres'];?>"  />
        </div></td>
        <td width="107" ><label>
          <input name="mostrar" type="submit" src="../imagenes/btns/searcharticles.png" id="mostrar" value="&gt;" />
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
          <input name="nCuenta" type="hidden"  id="nCuenta" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
        <input name="numeroE" type="hidden"  id="numeroE" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="" /></td>
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
CONCAT(apellido1,'',apellido2) like '%$nombres%'
or
CONCAT(apellido1,'  ',apellido2) like rtrim('%$nombres%')
or
CONCAT(nombre1) like '%$nombres%'
or
nombreCompleto like '%$nombres%'
)
order by
apellido1 asc
";



$result=mysql_db_query($basedatos,$sSQL);

?>
<p>&nbsp;</p>
<table width="450" class="table table-striped">
    <tr>
        <th   scope="col"><div align="left" >Expediente</div></th>
    <th   scope="col"><div align="left" >Paciente</div></th>
        <th   scope="col" >Reservar</th>
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
$color = '#FFFFCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$NUMEROE."' and status='cortesia'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>


        <td height="24" bgcolor="<?php echo $color;?>" >


        <?php 
			echo $myrow['numCliente'];
		
		  ?>        
		 
	    </td>
		  
		  <td bgcolor="<?php echo $color;?>" >
				<?php 
			
			 if($myrow31['status']=='cortesia'){
				$cliente=$nombrePaciente.' (Cliente Cortes�a)';
				} else {
					$cliente=$nombrePaciente;
				}
				
				echo $cliente;
				?>
		
		<span ></span> </span></td>
        <td bgcolor="<?php echo $color;?>" ><div align="center"><span >
          
          
          <a href="javascript:ventanaSecundaria('<?php echo $ventana;?>?almacen=<?php echo $almacen; ?>&forma=<?php echo "F"; ?>&keyPacientes=<?php echo $myrow['keyPacientes']; ?>&seguro=<?php echo $_POST['seguro']; ?>')">
          <img src="../imagenes/btns/reservbtn.png" alt="Expedientes" width="24" height="24" border="0" />          </a>
          
        </span></div></td>
    </tr>

      <?php }}?>
    </table>
<p>&nbsp;    </p>
	<p>
	  <input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    </p>
  </form>

</body>
</html>
<?php
}
}
?>