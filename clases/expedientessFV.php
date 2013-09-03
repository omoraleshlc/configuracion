<?php  class expedientes{ 
public function expedientesDuplicados($ALMACEN,$fecha1,$hora1,$entidad,$usuario,$numeroE,$basedatos){ ?>

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
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") ;
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES"); 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") ;
} 
</script> 




<?php 

if($_POST['request'] and $_POST['numeroEx1'] and $_POST['almacenDestino'] and $_POST['medico']){
$numeroEx=$_POST['numeroEx1'];







 $sSQL32= "Select * From expedientesSolicitados WHERE entidad='".$entidad."' and numeroEx = '".$_POST['numeroEx1']."'  and status='solicitar' order by keyES DESC";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);


if(!$myrow32['status']){
$q4 = "INSERT INTO expedientesSolicitados (almacen,medico,motivo,usuario,hora,fecha,numeroEx,entidad,status) values ('".$_POST['almacenDestino']."','".$_POST['medico']."','".$_POST['motivo']."','".$usuario."','".$hora1."','".$fecha1."','".$_POST['numeroEx1']."','".$entidad."','solicitar')";
mysql_db_query($basedatos,$q4);
echo mysql_error();?>
<script>
window.alert("Se solicito el expediente: <?php echo $_GET['numeroEx1'];?>");
</script>
<?php 

} else{ ?>
<script>
window.alert("El expediente se encuentra fuera");
</script>
<?php 
}
}
?>



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
<h1 >&nbsp;</h1>
<h1 >Solicitar Expedientes sin folio de venta </h1>
<form name="form2" id="form2" method="post" action="">
  <p>&nbsp;</p>
  
  
  
  
  

  
  
  
<table width="524" class="table-forma" >
    <tr valign="middle" >
      <th><div align="center" >Datos del Paciente </div></th>
    </tr>
    <tr valign="middle" >
      <td  >Nuevo Paciente <span ><span ><a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&almacen=<?php echo $ALMACEN;?>')"><img src="/sima/imagenes/btns/addpatient.png" alt="Datos Generales del Paciente" width="22" height="22" border="0" /></a><a href="javascript:ventanaSecundaria1('modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span></td>
    </tr>
    <tr valign="middle" >
      <td >N&deg; Exp. Apellido o Nombre</td>
    </tr>
    <tr valign="top"  >
      <td  ><span >
        <input name="paciente" type="text"  id="paciente" size="60" onChange="this.form.submit();">
            </span>
        <input name="numeroEx" type="hidden"  id="numeroEx"  readonly="" />
        <label></label>
      &nbsp;</td>
    </tr>
  </table>

  <p align="center">

  <input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
  <input name="nombrePaciente12" type="hidden" id="nombrePaciente122" value="<?php echo $_POST['numPaciente'];?>"/>
    <input name="nCuenta" type="hidden"  id="nCuenta3" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
    <input name="numeroE" type="hidden"  id="numeroE3" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="" /></p>
	
	
	
	
	  <?php if($_POST['numeroEx']){ ?><br />
  <table width="524" class="table-forma">
   <tr>
      <td width="11">&nbsp;</td>
      <td width="198" >Departamento solicitante</td>
      <td width="225"><label>
<?php 	  $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="" id="almacenDestino" />        
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	  </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td >Dr. Solicitante</td>
      <td><label>
      <input name="medico" type="text" id="medico" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td >Motivo</td>
      <td><textarea name="motivo" wrap="virtual" id="motivo"></textarea></td>
    </tr>

  </table>
  <br />
     <input name="request" type="submit" id="request2" value="Solicitar" />
<br />
  <br />
  <table width="449" class="table table-striped">
    <tr >
      <th width="57"   scope="col"><div align="left" >Exp</div></th>
      <th width="269"  scope="col"><div align="left" >Paciente</div></th>
      <th width="109" scope="col"><div align="center" >Editar</div></th>
    </tr>
      
<?php 




 $sSQL= "
SELECT * from pacientes where 
entidad='".$entidad."'
and
numCliente='".$_POST['numeroEx']."'";



$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$numCliente=$myrow['numCliente'];
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']." ".$myrow['apellido1']." ".
$myrow['apellido2']." ".$myrow['apellido3'];
$a+=1;




$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$myrow['numCliente']."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$keyClientesInternos=$myrow31['keyClientesInternos'];
$NC=$myrow['numCliente'];
?>
<tr  onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
        <td height="24" bgcolor="<?php echo $color;?>" class="codigos">
		 <a href="#"  onClick="javascript:ventanaSecundaria('dxActuales.php?numeroE=<?php echo $myrow['numCliente']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $keyClientesInternos; ?>')">		 </a>
		 <?php echo $NC;?>		 
		  <input name="numeroEx1" type="hidden" id="bandera" value="<?php echo $myrow['numCliente'];?>" />
	  </td>
          <td bgcolor="<?php echo $color;?>" >
            <?php 
			if($myrow['nombreCompleto']){
		echo $myrow['nombreCompleto']; 
		}else{
		echo '---';
		}
		?>

          </span></span></span></td>
        <td bgcolor="<?php echo $color;?>" ><div align="center"><span class="style12">
          
          
          <a href="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/btns/editbtn.png" alt="Datos Generales del Paciente" width="22" height="22" border="0" />          </a>
          
        </span></div></td>
    </tr>

      <?php }?>
  </table>
  
  
  
  
  <br /><br />
  
  
  <p><label></label>
  </p>
  <p align="center">
    <input name="bandera" type="hidden" id="request" value="<?php echo $a;?>" />
  HISTORIAL DE EXPEDIENTES </p>
  <table width="998" class="table table-striped">
    <tr  >
      <th width="77"  scope="col"><div align="center" >
          <div align="left">Fecha</div>
      </div></th>
      <th width="53" scope="col"><div align="center" >
          <div align="left">#Exp.</span></div>
      </div></th>
      <th width="200" scope="col"><div align="center" >
          <div align="left">Paciente</span></div>
      </div></th>
      <th width="154" scope="col"><div align="center" >
          <div align="left">M&eacute;dico</span></div>
      </div></th>
      <th width="120" scope="col"><div align="center" >
        <div align="left">Usuario Solicita </span></div>
      </div></th>
      <th width="120" scope="col"><div align="center" >
        <div align="left">Usuario Recibe </span></div>
      </div></th>
      <th width="120" scope="col"><div align="center" >Motivo</div></th>
      <th width="120" scope="col"><div align="center" >
          <div align="left">Departamento</span></div>
      </div></th>
    </tr>
    <tr  >
      <?php 

	 
$sSQL11= "
Select * From expedientesSolicitados WHERE entidad='".$entidad."' and numeroEx='".$_POST['numeroEx']."'
";

$result11=mysql_db_query($basedatos,$sSQL11);

while($myrow = mysql_fetch_array($result11)){ 
echo mysql_error();
$bandera+=1;


//****************************Terminan las validaciones
?>
    </tr>
    <tr >
      <td><div align="center" >
          <?php 
 echo $myrow['hora']." ".cambia_a_normal($myrow['fecha']);


?>
          </span> </span> </div></td>
      <td ><?php 

	  echo $myrow['numeroEx'];
	  ?></td>
      <td ><?php 
	 $sSQL711a="SELECT *
FROM
pacientes
WHERE
entidad='".$entidad."' 

and
numCliente='".$myrow['numeroEx']."'
";
  $result711a=mysql_db_query($basedatos,$sSQL711a);
  $myrow711a = mysql_fetch_array($result711a);

	
	 ?>
          <?php 
	  
	echo $myrow711a['nombreCompleto'];
	 
	  ?>
        &nbsp;
          <div align="left"></div></td>
      <td ><div align="left" ></span>
              <?php 
	 
	  echo $myrow['medico'];
	
	  ?>
        </div>        �</td>
      <td ><?php  echo $myrow['usuario']; ?></td>
      <td ><?php  echo $myrow['usuarioRecepcion']; ?></td>
      <td ><?php  echo $myrow['motivo']; ?></td>
      <td ><?php  echo $myrow['almacen']; ?>      </td>
    </tr>
    <?php }?>
  </table>
  <?php } ?>
  <p>&nbsp;</p>
  <p align="center">&nbsp;</p>
</form>

	  

	  
	  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
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
			return "/sima/cargos/clientesTodosAjax.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
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
			if ( this.value.length < 4 && this.isNotClick ) 
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