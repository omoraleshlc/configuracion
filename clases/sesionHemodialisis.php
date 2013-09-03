<?php
class sesionH {



public function hemodialisis($keyClientesInternos,$numeroE,$nCuenta,$entidad,$almacen,$basedatos){ 
if(!$_POST['numCliente2']){
$_POST['numCliente2']=$_GET['numCliente'];
}



if($_POST['actualizar'] AND $_POST['numCliente']){
$sSQL1= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($_POST['numCliente']!=$myrow1['numCliente']){


$agrega = "INSERT INTO clientes (
numCliente,nomCliente,usuario,fecha,nivel,ID_AUXILIAR,ID_CTAMAYOR,
ciudad,estado,cp,telCasa,telTrabajo,responsable,nombreCorto,
rfc,pais,calle,colonia,delegacion,banderaCXCT,tipoCliente,entidad
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
'".$_POST['banderaCXCT']."','".$_POST['tipoCliente']."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Se ingreso el cliente';
echo '<script type="text/vbscript">
msgbox "SE DIO DE ALTA AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">';
echo 'opener.location.reload(true);';
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
tipoCliente='".$_POST['tipoCliente']."'

WHERE entidad='".$entidad."' AND
numCliente='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$q);
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
mysql_db_query($basedatos,$borrame);
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



$sSQL1= "Select * From clientesInternos WHERE keyClientesInternos='".$keyClientesInternos."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);">
  <p align="center">&nbsp;  </p>
  <h1 align="center" class="titulos">Sesión de Hemodialisis</h1>
  <p>
    <label></label>
  </p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="358" height="24" />
  <table width="358" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="1" bgcolor="#CCCCCC" class="style12" scope="col">&nbsp;</th>
      <td width="91" bgcolor="#CCCCCC" class="style12">Nombre </td>
      <td width="405" bgcolor="#CCCCCC" class="style12">
	  <?php echo $myrow1['paciente'];?>
	  &nbsp;</td>
    </tr>
    <tr>
      <th bgcolor="#CCCCCC" class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#CCCCCC" class="style12">Edad</td>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <th bgcolor="#CCCCCC" class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#CCCCCC" class="style12">Sexo</td>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <th bgcolor="#CCCCCC" class="style12" scope="col">&nbsp;</th>
      <td bgcolor="#CCCCCC" class="style12">Fecha</td>
      <td bgcolor="#CCCCCC" class="style12"><?php echo $myrow1['fecha1'];?></td>
    </tr>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="358" height="24" />
<p>&nbsp;</p>
  <p>&nbsp;</p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="908" height="24" />
  <table width="908" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <td width="130" class="style12">INDICACIONES </td>
      <td width="153" class="style12">&nbsp;</td>
      <td width="122" class="style12">PRE MODIALISIS</td>
      <td width="149" class="style12">&nbsp;</td>
      <td width="154" class="style12">POST HEMODIALISIS </td>
      <td width="152" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">Tipo de Filtro </span></td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa22" type="text" class="Estilo24" id="telCasa22" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">Peso</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa2" type="text" class="Estilo24" id="telCasa2" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">Peso</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa7" type="text" class="Estilo24" id="telCasa7" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">Tiempo Programado </span></td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa23" type="text" class="Estilo24" id="telCasa23" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">T.A</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa3" type="text" class="Estilo24" id="telCasa3" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">T.A</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa8" type="text" class="Estilo24" id="telCasa8" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="style12">Anticoagulacion</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa24" type="text" class="Estilo24" id="telCasa24" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">F.C.</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa4" type="text" class="Estilo24" id="telCasa4" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">F.C.</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa" type="text" class="Estilo24" id="telCasa" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="style12">Objetivo UF </td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa25" type="text" class="Estilo24" id="telCasa25" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">T&deg;</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa5" type="text" class="Estilo24" id="telCasa5" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">T&deg;</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa9" type="text" class="Estilo24" id="telCasa9" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="style12">Medicamentos</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa26" type="text" class="Estilo24" id="telCasa26" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">Hora Inicio</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa6" type="text" class="Estilo24" id="telCasa6" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
      <td bgcolor="#CCCCCC" class="style12">Hora Inicio</td>
      <td bgcolor="#CCCCCC" class="style12"><span class="Estilo24">
        <input name="telCasa10" type="text" class="Estilo24" id="telCasa10" value ="<?php echo $myrow2['telCasa']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
      <td bgcolor="#CCCCCC" class="style12">&nbsp;</td>
    </tr>
  </table>
  <span class="style12"><img src="/sima/imagenes/bordestablas/borde2.png" width="908" height="24" /></span>
  <p align="center">
    <input name="numCliente1" type="hidden" id="numCliente1" value="<?php echo $myrow2['numCliente']; ?>" />
    <span class="style12">
    <input name="nuevo" type="submit" class="none" id="nuevo" value="Nuevo" />
    <input name="borrar" type="submit" class="none" id="borrar" value="Eliminar Cliente" />
    <input name="actualizar" type="submit" class="none" id="actualizar" value="Modificar/Grabar Cliente" />
  </span></p>
</form>
</body>
</html>


<?php } 

} //cierra clase
?>