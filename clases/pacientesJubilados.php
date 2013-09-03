<?php  class jubilados{
public function pacientesJubilados($ventana,$entidad,$usuario,$numeroE,$basedatos){ ?>

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
   window.open(URL,"ventana3","width=800,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=550,height=180,scrollbars=YES") 
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
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
<h1>Porcentajes Especiales - Pacientes </h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >

<table width="496" class="table-forma">
  <tr >
      <td height="20" colspan="3" ><div align="center" >Datos del Paciente </div></td>
    </tr>
      <tr valign="middle" >
        <td colspan="3" ><span >Escribe las primeras letras del Apellido</span></td>
      </tr>
<tr>  
<td width="428" ><div align="left" >
        <input name="paciente" type="text"  id="paciente" value="<?php 
		
		  echo $myrow10['paciente'];
		
		  ?>" size="60" onChange="this.form.submit();"/>
         
				<?php echo '</br>';?>
		<a href="javascript:ventanaSecundaria1(
		'/sima/cargos/busquedaAvanzada.php?reload=si')" class="style1">
		<span align="center">Busqueda Avanzada 
		</a></span>
        </div></td>

        <td width="18">
         
      <input name="numeroEx" type="hidden"  id="numeroE" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="" /></td>
    </tr>
    </table>

<div align="center">
  <?php

if($nombres=$_POST['paciente']){
$sSQL= "
SELECT * FROM 
pacientes 
where 
(entidad='".$entidad."'
AND
(
(CONCAT(nombre1) like '%$nombres%')
or
(CONCAT(apellido1,' ',apellido2) like trim('%$nombres%'))
or
(CONCAT(apellido1,'  ',apellido2) like '%$nombres%')
or
(CONCAT(nombre1) like '%$nombres%')
or
(nombreCompleto like '%$nombres%')
)) or (entidad='".$entidad."'
and
numCliente='".$nombres."'
)
order by
nombreCompleto asc
";



$result=mysql_db_query($basedatos,$sSQL);

?>
</div>
<p>&nbsp;</p>
<table width="594" class="table table-striped">

       <tr >
 <th width="17"  scope="col"><div align="left" >
          <div align="center">#</div>
      </div></th>
        <th width="67" scope="col"><div align="left" >
          <div align="center">Exp.</div>
        </div></th>
      <th width="229" scope="col"><div align="left" >Paciente</div></th>
      <th width="91" scope="col"><div align="left" >
        <div align="center">Porcentajes</div>
      </div></th>
      <th width="68" scope="col"><div align="left" >
        <div align="center">Editar Exp.</div>
      </div></th>
    </tr>

        <?php 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

$bandera+="1";


//cierro descuento

$NUMEROE=$myrow['numCliente']; 

$sSQL33= "Select  * From porcentajeJubilados WHERE keyPacientes = '".$myrow['keyPacientes']."'";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
?>

<tr >
        <td  bgcolor="<?php echo $color;?>" ><span >
        <?php 
			echo $bandera;
		  ?>
        </span></td>
		  
		  <td bgcolor="<?php echo $color;?>" ><span >
		    <?php 
			echo $myrow['numCliente'];
		
		  ?></span></td>
		  <td bgcolor="<?php echo $color;?>" >
		 
		<?php echo $myrow['nombreCompleto']; ?>		</td>
        <td ><div align="center">
		  
		   <?php if($myrow['jubilado']=='si'){ ?>
		  <a href="#" onClick="ventanaSecundaria3('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numCliente'];?>&codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&keyPacientes=<?php echo $myrow['keyPacientes']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen2=<?php echo $A; ?>&seguro=<?php echo $_POST['seguro']; ?>&numCliente=<?php echo $N?>')"> Editar Porcentaje </a> 
		  <?php } else {
		  
		  echo '---';
		  }
		  ?>
     </div></td>
        <td   align="center">
        
		
		
<a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&porcentajeEspecial=si')">Editar</a></td>
    </tr>

      <?php }?>
   
    <?php }?>
</table>
	
	<?php if($nombres){ ?>
	<p align="center" ><span >Se encontraron:  <?php echo $bandera;?> registros..   </span></p>
	<?php } ?>
	<p>
	  <input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    </p>
  </form>
  <p>&nbsp;</p>

<script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/pacientesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
<?php 
}
}
?>