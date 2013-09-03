<?php class especialidades { 
public function listaEspecialidadesMedicas($entidad,$estilo,$id_especialidad,$especialidad,$basedatos){ ?>
	 
	  <?php 
$aCombo= "Select * From especialidades where 
entidad='".$entidad."'  
and
subEspecialidad='no'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 

?>


		 <select name="especialidad" class="<?php echo $estilo;?>" id="especialidad" onChange="javascript:this.form.submit();"/>        
     
  <option value="" >Escoje</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		?>
        <option 
		<?php 
if($_POST['especialidad']==$resCombo['codigo'] or $id_especialidad==$resCombo['codigo']){
		
		echo 'selected="selected"';		
		}  ?>
		value="<?php echo $resCombo['codigo']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
		<?php
		}
		
		
		
		
	public function listaEspecialidadesMedicasSS($entidad,$estilo,$id_especialidad,$especialidad,$basedatos){ ?>
	 
	  <?php 
$aCombo= "Select * From especialidades where 
entidad='".$entidad."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 

?>


		 <select name="especialidad" class="<?php echo $estilo;?>" id="especialidad" />        
     
  <option value="" >Escoje</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		if($resCombo['subEspecialidad']=='si'){
		$sub='[SubEspecialidad]';
		} else {
		$sub='';
		}
		?>
        <option 
		<?php 
if($_POST['especialidad']==$resCombo['codigo'] or $especialidad==$resCombo['codigo']){
		
		echo 'selected="selected"';		
		}  ?>
		value="<?php echo $resCombo['codigo']; ?>"><?php echo $resCombo['descripcion']." ".$sub; ?></option>
        <?php } ?>
        </select>
		<?php
		}	
		
		
		
		
		
		
		
		
		
		
public function listaSubEspecialidadesMedicas($codigo,$entidad,$estilo,$id_especialidad,$especialidad,$basedatos){ ?>
<?php 

$aCombo= "Select * From especialidades where 
entidad='".$entidad."'
and
(especialidadPrincipal='".$especialidad."' or especialidadPrincipal='".$id_especialidad."') or codigo='".$especialidad."' 
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 

?>


		 <select name="subEspecialidad" class="<?php echo $estilo;?>" id="subEspecialidad" onChange="javascript:this.form.submit();"/>        
<?php      if(!$rCombo){  ?>
  <option value="" >Escoje</option>
  <?php } ?>
  
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 

		?>
        <option 
		<?php 
	    if($_POST['subEspecialidad']==$resCombo['codigo'] ){
		echo 'selected="selected"';	
		}
		?>
		value="<?php echo $resCombo['codigo']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
		<?php
		}
		}
		?>