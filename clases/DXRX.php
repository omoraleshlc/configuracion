<?php class DXRX{
public function diagnosticosRX($ruta,$seguro,$numeroPaciente,$keyCAP,$usuario,$hora1,$fecha1,$basedatos){ 
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=600,height=600,scrollbars=YES") 
} 
</script> 

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
           
        if( vacio(F.observaciones.value) == false ) {   
                alert("Por Favor, escribe las observaciones del diagnóstico!")   
                return false   
        } else if( vacio(F.receta.value) == false ) {   
                alert("Por Favor, escribe la receta!")   
                return false   
        }         
}   
</script> 



<?php
$random=rand(1000, 10015);

$sql2= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
keyCAP ='".$keyCAP."' 

";
$result2=mysql_db_query($basedatos,$sql2);
$myrow2= mysql_fetch_array($result2);
$numeroE=$myrow2['numeroE'];
$nCuenta=$myrow2['nCuenta'];
$seguro=$myrow2['seguro'];
$paciente=$myrow2['paciente'];

if($_POST['actualizar'] ){

$sql142= "
SELECT *
FROM
dx
WHERE
numeroE ='".$numeroE."' AND nCuenta='".$nCuenta."' AND keyCAP='".$keyCAP."' 

";
$result142=mysql_db_query($basedatos,$sql142);
$myrow142= mysql_fetch_array($result142);


////////////////////////////////////**//////////////
if($myrow142['numeroE']){

$agrega = "update dx 
set
CI='".$_POST['ci']."',
descripcion='".strtoupper($_POST['despliega'])."',
observaciones='".strtoupper($_POST['observaciones'])."',
receta='".$_POST['receta']."',
fecha='".$fecha1."',hora='".$hora1."',
usuario='".$usuario."',
medico='".$MEDICO."',
seguro='".$seguro."'
where
numeroE='".$numeroE."' and nCuenta='".$nCuenta."' and keyCAP='".$keyCAP."'";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$actualizaEstudio=new SQL();
$actualizaEstudio->actualizaEstudio($numeroE,$nCuenta,$keyCAP,$ruta,$basedatos);
echo $myrow11['descripcion'];	
echo '<script type="text/vbscript">';
echo 'msgbox "SE AGREGÓ EL DIAGNOSTICO "'.$myrow5['descripcion']; 
echo '</script>';
}
?>
   <script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    
  // -->
</script>
   

<?php 
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
-->
</style>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style18 {color: #FFFFFF; font-weight: bold; }
.style12 {font-size: 10px}
.style12 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
	<script src="/sima/js/prototype.js" type="text/javascript"></script>
	<script src="/sima/js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="/sima/js/lightboxXL.js" type="text/javascript"></script>
</head>

<body>

  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="" onSubmit="return valida(this);" >

    <table width="522" border="1" align="center" class="style7">
      <tr>
        <td width="156" height="22" bgcolor="#660066"><span class="style13">CI</span></td>
        <td width="514"><span class="style12">
          <input name="ci" type="text" class="style7" size="10"  readonly=""/>
          <input name="M2" type="button" class="style7" id="M2"  onclick="javascript:ventanaSecundaria(
		'/sima/cargos/despliegaCodigosInternacionales.php?campoDespliega=<?php echo "despliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "ci"; ?>&amp;keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>')" value="C" />
          <input name="despliega" type="text" class="style7" size="60"  readonly=""/>
</span></td>
      </tr>
      <tr>
        <td height="33" bgcolor="#660066"><span class="style13">DX</span></td>
        <td><label>
          <textarea name="observaciones" cols="80" rows="4" class="style7" id="observaciones"></textarea>
        </label></td>
      </tr>
      <tr>
        <td height="14" bgcolor="#660066"><span class="style13">Indicaciones</span></td>
        <td><textarea name="receta" cols="80" rows="4" class="style7" id="receta"></textarea></td>
      </tr>
      <tr>
        <td height="33" bgcolor="#660066">&nbsp;</td>
        <td><input name="actualizar" type="submit" class="style7" id="actualizar" value="Aplicar Dx" onClick="if(confirm('Esta seguro que deseas aplicar este diagnóstico?') == false){return false;}" />
        <a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"></a></td>
      </tr>
    </table>
	<p align="center">
	<?php 
$devuelvePlaca=new SQL();
$devuelvePlaca->devuelvePlacaRX($numeroE,$nCuenta,$keyCAP,$basedatos);
	?>
   
 </p>
    <p>&nbsp;</p>
  </form>
  <p>&nbsp;</p>
  <form id="form2" name="form2" method="post" action="">
    <?php	

$sSQL= "SELECT 
* 
FROM dx
WHERE
numeroE='".$numeroE."'
and
fecha='".$fecha1."'
ORDER BY keyDiagnostico DESC
";


$result=mysql_db_query($basedatos,$sSQL);

?>
    <span class="Estilo24"><span class="style7">
    <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codigo']; ?>" />
    </span></span>
    <table width="630" border="0" align="center">
      <tr>
        <th width="91" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Fecha - Hora </span></div></th>
        <th width="34" bgcolor="#660066" scope="col"><div align="left"><span class="style11">CI</span></div></th>
        <th width="219" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="268" bgcolor="#660066" scope="col"><span class="style11">Observaciones</span></th>
      </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$sSQL4= "
SELECT 
  *
FROM
existencias
WHERE codigo = '".$code1."'
and 
almacen='".$almacen."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$um=$myrow12['um'];
?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label></label>
          <?php echo $myrow['hora']." ".$myrow['fecha']; ?></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['CI']; ?></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12"><span class="style7"><?php echo $myrow['descripcion']; ?></span></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['observaciones']; ?></span></td>
      </tr>
      <?php }?>
    </table>
    <p align="center">&nbsp;    </p>
  </form>
  <p align="center">&nbsp;</p>
  <p>&nbsp;</p>

</body>
</html>
<?php 
}
}
?>