
<?php  class listaPX{ 
public function mostrarPacientes($ventana1,$ventana,$entidad,$TITULO,$almacen,$usuario,$numeroE,$basedatos){ 
$ALMACEN=$almacen;
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
   window.open(URL,"ventana3","width=700,height=400,scrollbars=YES") 
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

<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>

</head>

<body>
<h1 align="center"><?php echo $TITULO;?></h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
<br /> 
<h1 >Datos del Paciente </h1>
   
<span >Apellido Paterno, Materno </span>
        
                
     


        <input name="paciente" type="text" class="normal" id="paciente" value="<?php
		
		  echo $myrow10['paciente'];
		
		  ?>" size="60" onChange="this.form.submit();"/>
         
				<?php echo '</br>';?>
		<a href="javascript:ventanaSecundaria1(
		'/sima/cargos/busquedaAvanzada.php?reload=si')" class="normal">
		Busqueda Avanzada 
		</a>
        

        <input name="numeroEx" type="hidden" class="normal" id="numeroE" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="readonly" />
   
<br />
<br />

       <span > Pacientes sin Exp.</span>
  
         

         
<a href="javascript:nueva('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numCliente'];?>&amp;codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>','ventana7','800','800','yes');">
    Agregar Paquete
</a>
        

<p>&nbsp;</p>

<table width="537" class="table table-striped">
      <tr >
        <th width="28" >&nbsp;</th>
        <th width="293"  >Paciente</th>
        <th width="73"  align="center">Agregar</th>
        <th width="68"  align="center">Lista  </th>
        <th width="78"  align="center">Edit</th>
    </tr>
<?php
$nombres=$_POST['paciente'];
if($nombres or $_POST['numeroEx']){

if(!$_POST['numeroEx']){
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
}else{
$sSQL= "
SELECT * FROM 
pacientes 
where 
entidad='".$entidad."'
AND
numCliente='".$_POST['numeroEx']."'
";
}




if($result=mysql_db_query($basedatos,$sSQL)){
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



$sSQL6= "SELECT 
status
FROM
paquetesPacientes
WHERE entidad='".$entidad."' 
AND 
numeroE = '".$NUMEROE."'
and
(status='activo' or status='standby')
";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
	  ?>
      <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
        <td height="48"  class="codigos">&nbsp;</td>
        <td  class="normalmid">
          <?php if(!$myrow31['numeroE']){ ?>
          <?php echo $nombrePaciente;?> </a>
          <?php 
		 if($myrow6['status']=='standby'){
		 echo '  [Ya tiene un paquete asignado]';
		 } 
		 
		 
		 } else {?>
          <?php echo $nombrePaciente." "."(Paquete Asignado)"; ?>
          <?php } ?>
          <br />
         <span class="negro"> Expediente: </span>
          <span class="codigos">
          <?php if(!$myrow31['numeroE']){ ?>
          <?php 
			echo $myrow['numCliente'];
		
		  ?>
          <?php } else {?>
          <?php echo $myrow31['numeroE']; ?>
          <?php } ?>
        </span></td>
        <td align="center"  class="normal">  <a href="javascript:nueva('<?php echo $ventana;?>?numeroE=<?php echo $myrow['numCliente'];?>&amp;codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>','ventana7','800','800','yes');"> Agregar Paquete </a> </span></div></td>
        <td align="center"  class="normal"><a href="#" onClick="ventanaSecundaria3('/sima/cargos/listaPacientesPaquetes.php?numeroE=<?php echo $myrow['numCliente'];?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">Ver Lista</a>&nbsp;</div></td>
        <td align="center"  class="normal"><span class="style12"> <a href="javascript:ventanaSecundaria1('<?php echo $ventana1;?>?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">Editar Expediente </a> </span></div></td>
      </tr>
	  <?php  }}}?>
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