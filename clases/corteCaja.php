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
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.lengtd; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
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
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<?php 



//************CASO 1 **********************
$sSQL1t= "Select status,usuario,folioVenta From transacciones WHERE entidad='".$entidad."' and usuario='".$usuario."'  order by keyT DESC ";
$result1t=mysql_db_query($basedatos,$sSQL1t);
$myrow1t = mysql_fetch_array($result1t);
echo mysql_error();
//echo $_GET['folioVenta'];

//echo $myrow1t['status'].' '.$myrow1t['folioVenta'];

if($myrow1t['status']=='standby' and $myrow1t['folioVenta']!=$_GET['folioVenta']){ 
//echo "Debes terminar de  completar la transaccion: ".$myrow1t['folioVenta'];
$disabled='disabled=""';
?>
<script>
window.alert("Estimado: <?php echo $myrow1t['usuario'];?>, debes de completar la transaccion del folio: <?php echo $myrow1t['folioVenta'];?> ");
//window.close();
</script>
<?php }  

//************************************CANDADO DE USUARIO*****************************************





$sSQL1= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);




if(($myrow1['status']=='abierta') and $_POST['cerrar'] and $usuario ){

$agrega = "INSERT INTO statusCaja ( numCorte,
usuario,fechaCorte,horaCorte,status,entidad,numRecibo,keyCatC,descripcionCaja,horaApertura,fechaApertura
) values (
'".$myrow1['numCorte']."',
'".$usuario."',
'".$fecha1."',
'".$hora1."',
'cerrada',
'".$entidad."',
'".$myrow1['numRecibo']."','".$myrow1['keyCatC']."','".$myrow1['descripcionCaja']."','".$myrow1['horaApertura']."','".$myrow1['fechaApertura']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

echo 'La Caja esta cerrada';
echo '<script language="JavaScript" type="text/javascript">

    window.opener.document.forms["form1"].submit();

</script>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();


?>
<body>
<h1 align="center" >Corte de Caja </h1>
<?php 
//echo $hora1;
//echo '<br>';
//echo date("H:i a");
$sSQL1= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

?>
<form id="form1" name="form1" method="post" >
  
  <table width="287" class="table-forma">
    <tr>
      <td width="2"  scope="col">&nbsp;</td>
      <td width="131"  scope="col">&nbsp;</td>
      <td width="140"  scope="col"><label>
          <div align="left">
            <?php $sSQL1a= "Select descripcionCaja From catCajas where keyCatC='".$myrow1['keyCatC']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
		 echo $myrow1a['descripcionCaja']; 
		  ?>
          </div>
        </label></td>
    </tr>

    <tr>
      <td  scope="col">&nbsp;</td>
      <td  scope="col"><div align="left" >N&uacute;mero de Corte: </div></td>
      <td  scope="col"><div align="left">
        <?php 
		 echo $myrow1['numCorte']; 
		  ?>
      </div></td>
    </tr>
    <tr>
      <td width="2"   scope="col">&nbsp;</td>
      <td  scope="col"><div align="left" ><strong>Usuario:</strong></div></td>
      <td  scope="col"><div align="left" >
          <label></label>
          <?php echo $myrow1['usuario'];  ?> </div></td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td >Fecha Apertura: </td>
      <td ><span >
        <?php  
	  if($myrow1['fechaApertura']){
	  echo $myrow1['fechaApertura']; 
	  } else {
	  echo '---';
	  }
	   ?>
      </span></td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td >Hora Apertura:</td>
      <td ><span >
        <?php 
	  if($myrow1['horaApertura']){
	  echo $myrow1['horaApertura'];
	  } else {
	  echo '---';
	  }
	    ?>
      </span></td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td  scope="col"><div align="left" >Fecha Cierre </div></td>
      <td  scope="col"><div align="left" >
        <?php 
	  if($myrow1['fechaCorte']){
	  echo $myrow1['fechaCorte'];
	  } else {
	  echo '---';
	  }
	    ?>
      </div></td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td  scope="col"><div align="left" >Hora Cierre </div></td>
      <td  scope="col"><div align="left" >
        <?php 
	  if($myrow1['horaCorte']){
	  echo $myrow1['horaCorte'];
	  } else {
	  echo '---';
	  }
	    ?>
      </div></td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td  scope="col">&nbsp;</td>
      <td  scope="col"><div align="left" >
        <?php 
	  if($myrow1['status']=='abierta'){?>
      </div>      </td>
    </tr>
    <tr>
      <td height="36" ><label></label></td>
      <td height="36" >&nbsp;</td>
      <td height="36" ><div align="center">
          <label></label>
          <div align="left">
            <input name="cerrar" type="submit"  id="actualizar" value="Cerrar Caja" onClick="if(confirm('<?php echo $usuario;?>: estas seguro que deseas cerrar caja?') == false){return false;}" <?php if($disabled){
		  echo $disabled;
		  }?>/>
          </div>
       
      </div></td>
    </tr>
  </table>
 
<p align="center">
    <?php if($disabled){
echo '<span class="codigos"><blink>'.'Debes terminar la transaccion del folio: '.$myrow1t['folioVenta'].'</blink></span>';
}
?>
</p>
</form>
<p align="center">
  
  

  
  
  <?php } else {
echo 'Caja Cerrada';
}
?>
</p>

</body>
</html>
