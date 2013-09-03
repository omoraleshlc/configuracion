<?php class subeImagen{
public function subirImagen($keyCAP,$usuario,$fecha1,$hora1,$basedatos){ ?>


<?php
$random=rand(1, 2000);
$ruta='/sima/OPERACIONESHOSPITALARIAS/rayosx/';
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

if($_POST['subir'] ){
$uploaddir = 'images/';
$uploadfile = $uploaddir.$fecha1.$hora1.$random.basename($_FILES['userfile']['name']);
move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
//**********************************************************


//****************comprueba si ya existe****************/

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

echo '<script type="text/vbscript">';
echo 'msgbox "YA EXISTE UNA IMAGEN"'; 
echo '</script>';
} else {
$agrega = "INSERT INTO dx (
numeroE,nCuenta,CI,descripcion,fecha,hora,usuario,medico,seguro,observaciones,receta,keyCAP,ruta,rutaImagen,status) 
values ('".$numeroE."','".$nCuenta."','".$_POST['ci']."','".strtoupper($_POST['despliega'])."',
'".$fecha1."','".$hora1."','".$usuario."','".$MEDICO."','".$seguro."','".strtoupper($_POST['observaciones'])."','".$_POST['receta']."',
'".$keyCAP."','".$ruta."','".$uploadfile."','standby')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$actualizaEstudio=new SQL();
$actualizaEstudio->actualizaEstudio($numeroE,$nCuenta,$keyCAP,$ruta,$basedatos);

echo $myrow11['descripcion'];	
echo '<script type="text/vbscript">';
echo 'msgbox "SE INSERTO LA IMAGEN "'.$myrow5['descripcion']; 
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

	<script src="/sima/js/prototype.js" type="text/javascript"></script>
	<script src="/sima/js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="/sima/js/lightboxXL.js" type="text/javascript"></script>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
-->
</style>
<form name="form1" method="post" action="#" enctype='multipart/form-data'>
  <p align="center"><?php 
  $codigo=$myrow2['codProcedimiento'];
  $sql14= "
SELECT descripcion
FROM
articulos 
WHERE
codigo ='".$codigo."'";
$result14=mysql_db_query($basedatos,$sql14);
$myrow14= mysql_fetch_array($result14);

$sql142= "
SELECT *
FROM
clientesInternos
WHERE
numeroE ='".$numeroE."' AND nCuenta='".$nCuenta."' ";
$result142=mysql_db_query($basedatos,$sql142);
$myrow142= mysql_fetch_array($result142);
  echo "Px: ".$myrow142['paciente']." "."Expediente: ".$numeroE.'<br>';
echo  "Estudio: ".$myrow14['descripcion'];
  ?>&nbsp;</p>
  <table width="311" border="0" align="center" class="style7">
    <tr>
      <td width="80" height="33" bgcolor="#660066"><span class="style11">Escoje la imagen </span></td>
      <td width="221"><span class="style121">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
        <!-- Name of input element determines name in $_FILES array -->
        <input name="userfile" type="file" class="style7"  value=""/>
      </span></td>
    </tr>
  </table>
  <p align="center">
    <input name="subir" type="submit" class="style7" id="subir" value="Subir Imagen">
  </p>
</form>
<p align="center">&nbsp;</p>
<?php
$sql= "
SELECT *
FROM
dx
WHERE
keyCAP='".$keyCAP."' AND 
numeroE ='".$numeroE."' AND nCuenta='".$nCuenta."' ";
$result=mysql_db_query($basedatos,$sql);
$myrow= mysql_fetch_array($result);

if($myrow['rutaImagen']){
?>
<p align="center"><a href="<?php 

echo $myrow['ruta'].$myrow['rutaImagen']; 

?>" rel="lightbox" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>">
<img src="<?php echo $myrow['ruta'].$myrow['rutaImagen']; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="157" height="145" border="0" /></a></p>
<?php 
}
}
}
?>
