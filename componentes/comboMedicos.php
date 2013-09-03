<?php	 		class despliegaMedicos{
public function listaMedicos($entidad,$medico,$basedatos){ ?>



<?php 
$sqlNombre11 = "SELECT * from medicos 
WHERE
entidad='".$entidad."' AND
status='A'
ORDER BY apellido1 ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
  <select name="medico" class="Estilo24" id="medico" onchange="javascript:this.form.submit();"/>
<option value="">---</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
    <?php   if($medico==$rNombre11["numMedico"])echo 'selected'; ?>
   value="<?php echo $rNombre11["numMedico"];?>"> <?php echo 
	  $rNombre11["apellido1"]." ".$rNombre11["apellido2"]
	  ." ".$rNombre11["apellido3"]." ".$rNombre11["nombre1"]." ".$rNombre11["nombre2"];?></option>
  <?php } ?>

<?php
}
}
?>



<?php	 		class despliegaMedicosSS{
public function listaMedicosSS($entidad,$medico,$basedatos){ ?>



<?php 
$sqlNombre11 = "SELECT * from medicos 
WHERE
entidad='".$entidad."' AND
status='A'
ORDER BY apellido1 ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
  <select name="medico" class="Estilo24" id="medico" />
<option value="">---</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
    <?php   if($medico==$rNombre11["numMedico"])echo 'selected'; ?>
   value="<?php echo $rNombre11["numMedico"];?>"> <?php echo 
	  $rNombre11["apellido1"]." ".$rNombre11["apellido2"]
	  ." ".$rNombre11["apellido3"]." ".$rNombre11["nombre1"]." ".$rNombre11["nombre2"];?></option>
  <?php } ?>

<?php
}
}
?>
