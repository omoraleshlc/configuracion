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
     var jar="5";      
        if( vacio(F.numCorte.value) == false ) {   
                alert("Necesitas el n�mero de p�liza para poder abrir caja!")   
                return false   
        } else if( vacio(F.recibo.value) == false ) {   
                alert("Escoje el n�mero de recibo!")   
                return false   
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


<?php
$hoy = date("m/d/Y");
$hora = date("H:i a");
$numCorte=$_POST['numCorte'];



if($_POST['actualizar'] and $_POST['codigoCaja']){



$sSQL1= "Select * From statusCaja where keyCatC='".$_POST['codigoCaja']."' and '".$entidad."' order by keySTC DESC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);



if($myrow1['status']=='cerrada' or !$myrow1['status']){


$agrega = "INSERT INTO statusCaja (
keyCatC,status,usuario,entidad,numRecibo,numCorte,horaApertura,fechaApertura,descripcionCaja
) values (
'".$_POST['codigoCaja']."','abierta','".$usuario."','".$entidad."',
'".$myrow1['numRecibo']."','".$myrow1['numCorte']."'+1,'".$hora1."','".$fecha1."','".$_POST['descripcion']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>
<script>
window.alert("SE ABRIO LA CAJA ");
</script>
<?php 
exit;
} 
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

	  
	  


<h1 align="center" >Abrir Caja </h1>




<form id="form1" name="form1" method="post" action="">
    <p align="center">

<h1 align="center" >
<?php 

if($_POST['codigoCaja']){
$sSQL1= "Select * From statusCaja where entidad='".$entidad."' and
keyCatC='".$_POST['codigoCaja']."'
order by keySTC DESC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

	if($myrow1['status']=='abierta'){
	echo 'La caja esta abierta por: '.$myrow1['usuario'];
	} else{
	echo 'Disponible';
	}}
	?>
  </h1>
	</p>

    <table class="table-forma">
      <tr>
        <th colspan="3"  scope="col">Captura a Cuenta Paciente Particular </th>
      </tr>
      <tr>
        <td   scope="col"><p>&nbsp;</p>
        <p>&nbsp;</p></td>
        <td   scope="col"><div align="left" ># de Caja </div></td>
        <td   scope="col"><div align="left" >
		
          <?php 
	  $aCombo= "Select * From catCajas where
entidad='".$entidad."'  order by descripcionCaja ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="codigoCaja" id="codigoCaja"  onchange="javascript:this.form.submit();" />
          
          <option value="" >---</option>
          <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
          <option 
		<?php 
		if($_POST['codigoCaja']==$resCombo['keyCatC']){
		
		echo 'selected="selected"';		
		}   ?>
		value="<?php echo $resCombo['keyCatC']; ?>"><?php echo $resCombo['descripcionCaja']; ?></option>
          <?php } ?>
          </select>
        </div></td>
      </tr>
	  
	  
	  
	  	  <?php 
$sSQL1a= "Select * From statusCaja where entidad='".$entidad."' and
usuario='".$usuario."'
order by keySTC DESC";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);	  
?>



<?php if($myrow1a['status']=='abierta'){ 
    echo '<br>';
echo '<span class="error"><blink>'.'IMPOSIBLE ABRIR CAJA SI EXISTE UNA ABIERTA'.'</blink></span>';

}else{ ?>	
  
      <tr>
        <td   scope="col">&nbsp;</td>
        <td   scope="col"><div align="left" >N&uacute;mero de Corte </div></td>
        <td   scope="col"><div align="left" >
        <?php 
		   if($myrow1['numCorte']){
		   
		      echo $myrow1['numCorte'];
			  } else if($_POST['codigoCaja']){
			  echo 1;
			  }
			  ?>
    </div></td>
      </tr>
      <tr>
        <td    scope="col">&nbsp;</td>
        <td   scope="col"><div align="left" >N&uacute;mero de Recibo</div></td>
        <td   scope="col"><div align="left" >
       <?php 
		  if($myrow1['numRecibo']){
		  echo $myrow1['numRecibo'];
		  } else if($_POST['codigoCaja']){
		  echo 1;
		  }
		  ?>
      </div></td>
      </tr>
      <tr>
        <td    scope="col">&nbsp;</td>
        <td    scope="col"><div align="left" >Descripci&oacute;n</div></td>
        <td    scope="col"><div align="left" >
          <label>
<textarea name="descripcion" cols="30" id="descripcion" 
<?php if( !$_POST['codigoCaja'] or $myrow1['status']=='abierta')echo 'disabled';?>/>
<?php echo $myrow1['descripcionCaja'];?></textarea>
          </label>
        </div></td>
      </tr>
      <tr>
        <td  colspan="3" align="center" valign="middle" ><label>
          <p>
            <?php if($myrow1['status']=='abierta' or !$_POST['codigoCaja']){?>
            <input name="actualizar" type="submit"  id="actualizar" value="Abrir Caja"  disabled="disabled" />
            <?php } else { ?>
            <input name="actualizar" type="submit"  id="actualizar" value="Abrir Caja"  />
            <?php } ?>
          </p>
          <p>&nbsp;</p>
        </label></td>
		<?php } ?>
      </tr>
    </table>
  
</form>
</body>
</html>
