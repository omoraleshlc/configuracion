<?php
class editarClientes {



public function editarC($entidad,$numCliente,$usuario,$ID_EJERCICIOM,$db_conn,$basedatos){ 
if(!$_POST['numCliente2']){
$_POST['numCliente2']=$_GET['numCliente'];
}

//************contra Recibo****
if($_POST['contraRecibo']=='si'){
$contraRecibo='si';
} else {
$contraRecibo='no';
}
//************************************
//************TOMA PRECIO NIVEL 1****
if($_POST['baseParticular']=='si'){
$baseParticular='si';
} else {
$baseParticular='no';
}
//************************************

//************TOMA PRECIO NIVEL 1****
if($_POST['subCliente']=='si'){
$subCliente='si';
} else {
$subCliente='no';
}
//************************************



if($_POST['actualizar'] AND $_POST['numCliente']){
$sSQL1= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result1=pg_query($basedatos,$sSQL1);
$myrow1 = pg_fetch_array($result1);
if($_POST['numCliente']!=$myrow1['numCliente']){


$agrega = "INSERT INTO clientes (
numCliente,nomCliente,usuario,fecha,nivel,ID_AUXILIAR,ID_CTAMAYOR,
ciudad,estado,cp,telCasa,telTrabajo,responsable,nombreCorto,
rfc,pais,calle,colonia,delegacion,banderaCXCT,tipoCliente,entidad,baseParticular,plazoPago,contraRecibo,subCliente,clientePrincipal,saldoInicial
) values ('".$_POST['numCliente']."','".strtoupper($_POST['nomCliente'])."',
'".$usuario."','".$fecha1."','".$_POST['nivel']."','".$_POST['ID_AUXILIAR']."','".$_POST['ID_CTAMAYOR']."',
'".$_POST['ciudad']."',
'".$_POST['estado']."',
'".$_POST['cp']."',
'".$_POST['telCasa']."',
'".$_POST['telTrabajo']."',
'".$_POST['responsable']."',
'".$_POST['nombreCorto']."',
'".$_POST['rfc']."',
'".$_POST['pais']."',
'".$_POST['calle']."',
'".$_POST['colonia']."',
'".$_POST['delegacion']."',
'".$_POST['banderaCXCT']."','".$_POST['tipoCliente']."','".$entidad."','".$baseParticular."','".$_POST['plazoPago']."',
    '".$contraRecibo."','".$subCliente."','".$_POST['seguro']."','".$_POST['saldoInicial']."'
)";
pg_query($basedatos,$agrega);
echo mysql_error();
echo 'Se ingreso el cliente';
echo '<script type="text/vbscript">
msgbox "SE DIO DE ALTA AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">';
echo 'opener.location.reload(true);';
echo 'close();';
echo '</script>';
} else { 
$q = "UPDATE clientes set 
nomCliente='".strtoupper($_POST['nomCliente'])."',
nivel='".$_POST['nivel']."',
ciudad='".strtoupper($_POST['ciudad'])."',
estado='".strtoupper($_POST['estado'])."',
cp='".$_POST['cp']."',
telCasa='".$_POST['telCasa']."',
telTrabajo='".$_POST['telTrabajo']."',
responsable='".strtoupper($_POST['responsable'])."',
nombreCorto='".$_POST['nombreCorto']."',
rfc='".strtoupper($_POST['rfc'])."',
pais='".strtoupper($_POST['pais'])."',
calle='".strtoupper($_POST['calle'])."',
colonia='".strtoupper($_POST['colonia'])."',
delegacion='".strtoupper($_POST['delegacion'])."',
ID_AUXILIAR='".$_POST['ID_AUXILIAR']."',
ID_CTAMAYOR='".$_POST['ID_CTAMAYOR']."',
usuario='".$usuario."',
fecha='".$fecha1."',
banderaCXCT='".$_POST['banderaCXCT']."',
tipoCliente='".$_POST['tipoCliente']."',
baseParticular='".$baseParticular."',
plazoPago='".$_POST['plazoPago']."',
contraRecibo='".$_POST['contraRecibo']."',
subCliente='".$_POST['subCliente']."',
clientePrincipal='".$_POST['seguro']."',
    saldoInicial='".$_POST['saldoInicial']."'

WHERE entidad='".$entidad."' AND
numCliente='".$_POST['numCliente']."'";
pg_query($basedatos,$q);
echo mysql_error();
echo 'Se actualizo el cliente';
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">';
echo 'opener.location.reload(true);';
echo '</script>';
}
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=clientes.php">';
exit; */
}

if($_POST['borrar'] AND $_POST['numCliente']){
$borrame = "DELETE FROM clientes WHERE entidad='".$entidad."' AND numCliente ='".$_POST['numCliente']."'";
pg_query($basedatos,$borrame);
echo mysql_error();

echo '<script type="text/vbscript">
msgbox "CLIENTE ELIMINADO"
</script>';
echo '<script>';
echo 'close();';
echo '</script>';
echo '<script language="JavaScript" type="text/javascript">';
echo 'opener.location.reload(true);';
echo 'self.close();';
echo '</script>';

}

if($_POST['nuevo']){
$_POST['numCliente2']='000000000';
$_POST['numCliente1']='000000000';

}


if($_POST['numCliente2'] ){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente2']."' ";
$result2=pg_query($basedatos,$sSQL2);
$myrow2 = pg_fetch_array($result2);
} else if($_POST['numCliente1']){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente1']."' ";
$result2=pg_query($basedatos,$sSQL2);
$myrow2 = pg_fetch_array($result2);
}
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
           
        if( vacio(F.numCliente.value) == false ) {   
                alert("Por Favor, escoje el numero del Cliente!")   
                return false   
        } else if( vacio(F.nomCliente.value) == false ) {   
                alert("Por Favor, escribe el nombre del cliente!")   
                return false   
        }           
}   
  
  
  
  
</script> 
<script>
function validar(obj){
	var d = document.formulario;
	
	if(obj.checked==true){


		d.subClientes.disabled = false;
	}else{


		d.subClientes.disabled= true;
	}
}
</script>

<script type="text/javascript">
<!--
onload = function () {
var e, i = 0;
while (e = document.forms[0].elements[['fie', 'foe', 'fum'][i++]]) {
e.disabled = true;
}
}
// -->
</script>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.Estilo241 {font-size: 12px}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);">
  <p align="center">&nbsp;  </p>
  <h1 align="center">
    <label>EDITAR CLIENTES</label>
  </h1>
  <p>
    <label></label>
  </p>
  <table width="640" border="0" align="center">
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <th bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">TIPO DE CLIENTE</div></th>
      <th bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">
        <select name="tipoCliente" class="style7" id="tipoTraspaso" />
        
    
        
          <option
				<?php if($myrow2['tipoCliente']=='Compania'){ echo 'selected="selected"'; }?>
				 value="Compania">Compania</option>
          <option <?php if($myrow2['tipoCliente']=='Otros'){ echo 'selected="selected"'; }?>
				value="Otros">Otros</option>
      </div></th>
    </tr>
    <tr>
      <th width="2" class="style12" scope="col">&nbsp;</th>
      <th width="132" class="style12" scope="col"><div align="left">CodigoCliente/Cuenta:
          <label></label>
      </div></th>
      <th width="492" class="style12" scope="col">
        <div align="left">
         <?php $ran=rand(1,14099999);?>
		  <input name="numCliente" type="text" class="style12" id="numCliente" 
		 value="<?php 
		 if($_POST['nuevo']){
		 echo "0000000000";
		 } else if($myrow2['numCliente']){
		 echo $myrow2['numCliente']; 
		 } else if(!$_POST['nuevo'] or !$myrow2['numCliente'] AND !$_POST['numCliente']){
		 
		 echo $ran;
		 }
		 ?>"/>
        ej. Pueden ser Iniciales OAMG1,etc. </div></th></tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Es un Sub-Cliente  </td>
      <td bgcolor="#FFCCFF" class="style12">

	  <label>
	  <select name="subCliente" class="style7" id="subCliente" onChange="javascript:this.form.submit();">
	    <option
		<?php if($myrow2['subCliente']==$_POST['subCliente']){ echo 'selected=""';} ?>
		 value="si">si</option>
	    <option 
		<?php if($myrow2['subCliente']==$_POST['subCliente']){ echo 'selected=""';} ?>
		value="no">no</option>
	    </select>
	  </label></td>
    </tr>
	

	
	
	  <?php if((($_POST['subCliente']==$myrow2['subCliente']) and $myrow2['subCliente']=='si') or ((!$_POST['subCliente']) and $myrow2['subCliente']=='no')){?>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
	  
	  
	  
	  
      <td class="style12">Cliente Principal 
      <input name="seguro" type="hidden" class="style7" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" /></td>
      <td class="style12"><input name="subClientes" type="button" class="style7" id="subClientes"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/agregarSeguros.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="S" />
      
	  
	<?php   
	  $sSQL24= "Select nomCliente From clientes WHERE entidad='".$entidad."' AND numCliente = '".$myrow2['numCliente']."' ";
$result24=pg_query($basedatos,$sSQL24);
$myrow24 = pg_fetch_array($result24);
?>
	  
	    <input name="nomSeguro" type="text" class="style7" id="nomSeguro" size="100" readonly="" 
		value="<?php 
		if($myrow24['nomCliente']){
		echo $myrow24['nomCliente'];
		} else if($_POST['nomSeguro'] ){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
		
		
		
		
    </tr>
	
<input name="nomCliente" type="hidden" class="style12" id="nomCliente" value ="<?php echo $myrow2['nomCliente']; ?>" size="100"/><input name="contraRecibo" type="hidden" id="contraRecibo" value="si" <?php if($myrow2['contraRecibo']=='si'){ echo 'checked=""';}?>/>
        <input name="plazoPago" type="hidden" class="Estilo24" id="plazoPago" value ="<?php echo $myrow2['plazoPago']; ?>" size="6"/>

        <input name="baseParticular" type="hidden" id="baseParticular" value="si" <?php if($myrow2['baseParticular']=='si'){ echo 'checked=""';}?>/>

        <input name="ID_AUXILIAR" type="hidden" class="Estilo24" id="ID_AUXILIAR" value ="<?php echo $myrow2['ID_AUXILIAR']; ?>" size="30"/>

        <input name="ciudad" type="hidden" class="Estilo24" id="ciudad" value ="<?php echo $myrow2['ciudad']; ?>" size="60"/>

        <input name="estado" type="hidden" class="Estilo24" id="estado" value ="<?php echo $myrow2['estado']; ?>" size="4"/>

        <input name="cp" type="hidden" class="Estilo24" id="cp" value ="<?php echo $myrow2['cp']; ?>" size="4"/>

        <input name="telCasa" type="hidden" class="Estilo24" id="telCasa" value ="<?php echo $myrow2['telCasa']; ?>" size="60"/>

        <input name="telTrabajo" type="hidden" class="Estilo24" id="telTrabajo" value ="<?php echo $myrow2['telTrabajo']; ?>" size="60"/>

        <input name="responsable" type="hidden" class="Estilo24" id="responsable" value ="<?php echo $myrow2['responsable']; ?>" size="60"/>

        <input name="nombreCorto" type="hidden" class="Estilo24" id="nombreCorto" value ="<?php echo $myrow2['nombreCorto']; ?>" size="60"/>

        <input name="rfc" type="hidden" class="Estilo24" id="rfc" value ="<?php echo $myrow2['rfc']; ?>" size="60"/>

        <input name="pais" type="hidden" class="Estilo24" id="pais" value ="<?php echo $myrow2['pais']; ?>" size="60"/>

        <input name="calle" type="hidden" class="Estilo24" id="calle" value ="<?php echo $myrow2['calle']; ?>" size="60"/>

        <input name="colonia" type="hidden" class="Estilo24" id="colonia" value ="<?php echo $myrow2['colonia']; ?>" size="60"/>

        <input name="delegacion" type="hidden" class="Estilo24" id="delegacion" value ="<?php echo $myrow2['delegacion']; ?>" size="60"/>
		<?php //CAMPOS OCULTOS?>
	<?php } else { ?>
	
	
	
	
    <tr>
	
	
	
	
      <th class="style12" scope="col">&nbsp;</th>
      <td colspan="2" bgcolor="#990033" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <th width="2" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Nombre del Cliente:</td>
      <td class="style12"><input name="nomCliente" type="text" class="style12" id="nomCliente" value ="<?php echo $myrow2['nomCliente']; ?>" size="100"/></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Requieren Contrarecibo?</td>
      <td bgcolor="#FFCCFF" class="style12"><input name="contraRecibo" type="checkbox" id="contraRecibo" value="si" <?php if($myrow2['contraRecibo']=='si'){ echo 'checked=""';}?>/></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Plazo de pago (Facturas) </td>
      <td class="style12"><span class="Estilo24">
        <input name="plazoPago" type="text" class="Estilo24" id="plazoPago" value ="<?php echo $myrow2['plazoPago']; ?>" size="6"/>
[N&uacute;mero de D&iacute;as] </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Tomar precios base de Particular </td>
      <td bgcolor="#FFCCFF" class="style12"><label>
        <input name="baseParticular" type="checkbox" id="baseParticular" value="si" <?php if($myrow2['baseParticular']=='si'){ echo 'checked=""';}?>/>
      </label></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Auxiliar:</td>
      <td class="style12"><span class="Estilo24">
        <input name="ID_AUXILIAR" type="text" class="Estilo24" id="ID_AUXILIAR" value ="<?php echo $myrow2['ID_AUXILIAR']; ?>" size="30"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Ciudad:</td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="ciudad" type="text" class="Estilo24" id="ciudad" value ="<?php echo $myrow2['ciudad']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12"><span class="Estilo24">Estado:</span></td>
      <td class="style12"><span class="Estilo24">
        <input name="estado" type="text" class="Estilo24" id="estado" value ="<?php echo $myrow2['estado']; ?>" size="4"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">CP: </span></td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="cp" type="text" class="Estilo24" id="cp" value ="<?php echo $myrow2['cp']; ?>" size="4"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Tel&eacute;fono Casa: </td>
      <td class="style12"><span class="Estilo24">
        <input name="telCasa" type="text" class="Estilo24" id="telCasa" value ="<?php echo $myrow2['telCasa']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Tel&eacute;fono Trabajo: </td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="telTrabajo" type="text" class="Estilo24" id="telTrabajo" value ="<?php echo $myrow2['telTrabajo']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Responsable:</td>
      <td class="style12"><span class="Estilo24">
        <input name="responsable" type="text" class="Estilo24" id="responsable" value ="<?php echo $myrow2['responsable']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Nombre Corto: </td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="nombreCorto" type="text" class="Estilo24" id="nombreCorto" value ="<?php echo $myrow2['nombreCorto']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">RFC:</td>
      <td class="style12"><span class="Estilo24">
        <input name="rfc" type="text" class="Estilo24" id="rfc" value ="<?php echo $myrow2['rfc']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Pa&iacute;s:</td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="pais" type="text" class="Estilo24" id="pais" value ="<?php echo $myrow2['pais']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Calle:</td>
      <td class="style12"><span class="Estilo24">
        <input name="calle" type="text" class="Estilo24" id="calle" value ="<?php echo $myrow2['calle']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="style12">Colonia: </td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="colonia" type="text" class="Estilo24" id="colonia" value ="<?php echo $myrow2['colonia']; ?>" size="60"/>
      </span></td>
    </tr>
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Delegaci&oacute;n:</td>
      <td class="style12"><span class="Estilo24">
        <input name="delegacion" type="text" class="Estilo24" id="delegacion" value ="<?php echo $myrow2['delegacion']; ?>" size="60"/>
      </span></td>
    </tr>



         <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <td class="style12">Saldo Inicial</td>
      <td class="style12"><span class="Estilo24">
        <input name="saldoInicial" type="text" class="Estilo24" id="delegacion" value ="<?php echo $myrow2['saldoInicial']; ?>" size="60"/>
      </span></td>
    </tr>
		<?php }  ?>
	
	
	
    <tr>
      <th colspan="3" class="style12" scope="col"><input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" />
          <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Cliente" />
          <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar Cliente" /></th>
    </tr>
  </table>
  <p>
    <input name="numCliente1" type="hidden" id="numCliente1" value="<?php echo $myrow2['numCliente']; ?>" />
  </p>
</form>
</body>
</html>


<?php } 
s
} //cierra clase
?>
