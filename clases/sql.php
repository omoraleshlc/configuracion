<?php class SQL{ 

public function devuelvePlacaRX($numeroE,$nCuenta,$keyCAP,$basedatos){
$SQL= "Select ruta,rutaImagen From dx WHERE numeroE = '".$numeroE."' AND nCuenta='".$nCuenta."' AND keyCAP='".$keyCAP."'";
$r=mysql_db_query($basedatos,$SQL);
$myrow = mysql_fetch_array($r); 
$baseRuta=$myrow['ruta'];
$rutaImagen=$myrow['rutaImagen'];
?>
	<a href="<?php 
echo $baseRuta.$rutaImagen; 
?>" rel="lightbox" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>"><img src="<?php echo $baseRuta.$rutaImagen; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="150" height="113" border="0" align="middle" class="style7" />
 </a>
 <?php 
}


public function devuelveDatosExistentesLAB($numeroE,$nCuenta,$keyCAP,$basedatos){
$SQL= "Select keyCAP From resultadoLaboratorio WHERE numeroE = '".$numeroE."' AND nCuenta='".$nCuenta."' AND keyCAP='".$keyCAP."'";
$r=mysql_db_query($basedatos,$SQL);
$row = mysql_fetch_array($r);
if($row['keyCAP']){
return true;
}else {
return false;
}
}


public function actualizaEstudio($numeroE,$nCuenta,$keyCAP,$ruta,$basedatos){
$agrega = "UPDATE cargosCuentaPaciente set 
statusEstudio='cargado',statusDX='cargado',statusAutorizacion='autorizado'
where
keyCAP='".$keyCAP."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
}

public function statusEstudio($numeroE,$nCuenta,$keyCAP,$basedatos){
$sql = "select statusEstudio 
FROM  
cargosCuentaPaciente 
WHERE numeroE = '".$numeroE."' AND nCuenta='".$nCuenta."' AND keyCAP='".$keyCAP."'";
$r=mysql_db_query($basedatos,$sql);
$row = mysql_fetch_array($r);
echo mysql_error();

if($row['statusEstudio']=='standby'){
echo '<input name="modificar" type="submit" id="modificar" value="Aplicar" />';
}
}








 
}//cierra clase queries
 
  ?>