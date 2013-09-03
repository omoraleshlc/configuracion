<?php	 		class despliegaEntidades{
public function listaEntidades($usuario,$basedatos){ ?>



<?php 
$sqlNombre11 = "SELECT * from entidades 

ORDER BY codigoEntidad ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
  <select name="entidades" class="normal" onchange="javascript:this.form.submit();"/>
<option value="">Escoje la entidad</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
    <?php   if($_POST['entidades']==$rNombre11["codigoEntidad"])echo 'selected'; ?>
   value="<?php echo $rNombre11["codigoEntidad"];?>"> <?php echo $rNombre11["descripcionEntidad"];?></option>
  <?php } ?>
</select>
<?php
}
}
?>
