<?php class diagnostico{
public function diagnosticos($MEDICO,$entidad,$ruta,$seguro,$numeroPaciente,$keyCAP,$usuario,$hora1,$fecha1,$basedatos){ 
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 




<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=700,scrollbars=YES") 
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
           
        if( vacio(F.despliega.value) == false ) {   
                alert("Por Favor, escribe el Código Internacional!")   
                return false   
        }         
}   
</script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>


<?php
$random=rand(3, 15);

$sql2= "
SELECT *
FROM
clientesInternos
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 

";
$result2=mysql_db_query($basedatos,$sql2);
$myrow2= mysql_fetch_array($result2);


$numeroE=$myrow2['numeroE'];
$nCuenta=$myrow2['nCuenta'];
$seguro=$myrow2['seguro'];

$paciente=$myrow2['paciente'];

if($_GET['actualizar'] and $_GET['keyClientesInternos'] and $_GET['ci']){
$uploaddir = 'images/';
$uploadfile = $uploaddir.$random.basename($_FILES['userfile']['name']);
move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
//**********************************************************


//****************comprueba si ya existe****************/
$sql25= "
SELECT numeroE
FROM
dx
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 
and
ci='".$_GET['ci']."'
";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);

//actualiza
if(!$myrow25['numeroE']){

$agrega = "insert into dx 
(ci,observaciones,entidad,keyClientesInternos,fecha,hora,usuario,medico,numeroE,nCuenta,numeroExpediente,seguro,banderaCI) values('".$_GET['ci']."','".nl2br($_GET['observaciones'])."','".$entidad."','".$_GET['keyClientesInternos']."','".$fecha1."','".$hora1."','".$usuario."','".$MEDICO."','".$numeroE."','".$nCuenta."','".$numeroE."','".$seguro."','si')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
} else {
echo '<blink>'.'Ya existe éste Código Internacional'.'</blink>';
}


}else{
$inactiva='';
}



?>



<?php  //ELIMINA CODIGO INTERNACIONAL
if($_GET['ci'] AND $_GET['inactiva']){

 $q = "delete from dx WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' AND
		ci='".$_GET['ci']."'";
	mysql_db_query($basedatos,$q);
		echo mysql_error();
$inactiva='';
} else {
$inactiva='si';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo241 {font-size: 10px}
.Estilo241 {font-size: 10px}
.style19 {font-size: 10px}
.style19 {font-size: 10px}
.style1 {color: #0000FF}
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
</head>

<body>

  <p align="center">
  
  <?php 
  
  $sSQL2= "SELECT paciente
FROM
clientesInternos
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
 $px=$myrow2['paciente'];


  
 $sSQL24= "SELECT *
FROM
medicos
WHERE 
numMedico='".$MEDICO."'
 ";
$result24=mysql_db_query($basedatos,$sSQL24);
$myrow24 = mysql_fetch_array($result24);
$nombreMedico= $myrow24['nombre1'].' '.$myrow24['apellido1'];
?>
  
  &nbsp;</p>
<form id="form1" name="form1" method="GET" action="">
  <p>&nbsp;</p>
    <table width="532" border="1" align="center" class="style7">
      <tr>
        <td height="22" colspan="2" bgcolor="#660066" class="style11"><div align="center"><?php echo $px;?></div></td>
      </tr>
      <tr>
        <td width="156" height="40" bgcolor="#660066"><span class="style13">DX Codigo Internacional</span></td>
        <td width="514"><label>
          <?php 		
$sql121= "
SELECT banderaCI
FROM
dx
WHERE

keyClientesInternos ='".$_GET['keyClientesInternos']."' 


";
$result121=mysql_db_query($basedatos,$sql121);
$myrow121= mysql_fetch_array($result121);

?>
          <?php if(!$myrow121['banderaCI']){ ?>
          <a 
		   onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Agregar códigos Internacionales';?>&lt;/div&gt;')" onMouseOut="UnTip()"
		  href="javascript:ventanaSecundaria1('agregarCodigoInternacional.php?keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>&amp;ci=<?php echo $_GET['ci']; ?>&amp;keyDiagnostico=<?php echo $myrow25['keyDiagnostico']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>')"> (Sin agregar) </a>
          <?php } else {  ?>
C&oacute;digo Internacional <a 
					onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Editar código internacional';?>&lt;/div&gt;')" onMouseOut="UnTip()"
					href="javascript:ventanaSecundaria1('agregarCodigoInternacional.php?keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>&amp;ci=<?php echo $_GET['ci']; ?>&amp;keyDiagnostico=<?php echo $myrow25['keyDiagnostico']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>')"> (Editar) </a>
<?php } ?>
        </label></td>
      </tr>
      <tr>
        <td height="44" bgcolor="#660066"><span class="style13">HX Cuadro Cl&iacute;nico (SOAP) </span></td>
        <td><label>
          <?php 		
$sql121= "
SELECT banderaCuadro
FROM
dx
WHERE

keyClientesInternos ='".$_GET['keyClientesInternos']."' 


";
$result121=mysql_db_query($basedatos,$sql121);
$myrow121= mysql_fetch_array($result121);

?>
          <?php if(!$myrow121['banderaCuadro']){ ?>
          <a 
		   onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Agregar el cuadro clínico';?></div>')" onMouseOut="UnTip()"
		  href="javascript:ventanaSecundaria1('cuadroClinico.php?keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>&amp;ci=<?php echo $_GET['ci']; ?>&amp;keyDiagnostico=<?php echo $myrow25['keyDiagnostico']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>')"> (Sin agregar) </a>
          <?php } else {  ?>
          Cuadro Cl&iacute;nico Agregado 
		  
		  
		            <a 
					onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar cuadro clínico';?></div>')" onMouseOut="UnTip()"
					href="javascript:ventanaSecundaria1('cuadroClinico.php?keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>&amp;ci=<?php echo $_GET['ci']; ?>&amp;keyDiagnostico=<?php echo $myrow25['keyDiagnostico']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>')"> (Editar) </a>
          <?php } ?>
        </label></td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td><input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
            <input name="button" type="button" class="style7"
onclick="window.close();" value="Cerrar (x)" /></td>
      </tr>
    </table>
</form>
  </body>
</html>
<?php 
}
}
?>