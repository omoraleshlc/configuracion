
<?php 
class comboAlmacen { 

public function despliegaAlmacenSS($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="<?php echo $estilos;?>" id="almacenDestino" />        
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }


public function despliegaAlmacenSSSV($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where ventas='no' and
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="" id="almacenDestino" />        
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }

public function despliegaAlmacenAAV($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenAlmacenes,almacenes where 
almacenes.entidad='".$entidad."' AND
 almacenAlmacenes.codigo='".$ALMACEN."' 
 and
 codigoAlmacenes=almacenes.almacen
  
  order by codigoAlmacenes ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		$A=$resCombo['codigoAlmacenes'];
		$aCombo1= "Select * From almacenes where 
		entidad='".$entidad."' AND
		almacen='".$A."' 
	    ";
		$rCombo1=mysql_db_query($basedatos,$aCombo1); 
        $resCombo1 = mysql_fetch_array($rCombo1);
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo1['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo1['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['codigoAlmacenes']; ?>"><?php echo $resCombo1['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }



             public function despliegaAlmacenExternos($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
 almacen='".$ALMACEN."' 
";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
	

		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }

             
             
             
             

public function despliegaAlmacenStock($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" />        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }




public function despliegaAlmacen($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and (miniAlmacen ='' or miniAlmacen='No')
and
ventas='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
			
			
			
			public function despliegaAlmacenSV($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where entidad='".$entidad."' AND
and ventas='no' and activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }

		
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
public function despliegaMiniAlmacen($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ ?>

<?php 
if(!$_POST['almacenDestino']){
$diferentes='si';
$_POST['almacenDestino']=$_GET['almacen'];
}elseif( $_POST['almacenDestino']!=$_POST['almacenDestino1'] ){
    $diferentes='si';
}else{
    $diferentes=NULL;
}








$sSQL1vext= "Select ventaBotiquinExternos From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."'

order by descripcion ASC
";
$result1vext=mysql_db_query($basedatos,$sSQL1vext);
$myrow1vext = mysql_fetch_array($result1vext);

?>





<select name="almacenDestino1"  id="almacenDestino1" onChange="javascript:this.form.submit();"/>        







<?php  	//BOTIQUINES

if($diferentes!='si'){
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacenPadre = '".$ALMACEN."'
and
miniAlmacen='No'
order by descripcion ASC
";
$result1=mysql_db_query($basedatos,$sSQL1);
$na=  mysql_num_rows($result1);
}else{
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
}



if($na>0 or $diferentes=='si'){ 
?>

<?php if($diferentes=='si'){?>
    <option value="<?php echo $myrow1['almacen']; ?>">
                <?php echo $myrow1['descripcion']; ?></option>
    <option value=""></option>
<?php }else{?>
<option value=""></option>
<option value="<?php echo $ALMACEN;?>">--------------ALMACEN PRINCIPAL------------</option>



<?php while($myrow1 = mysql_fetch_array($result1)){   $b+=1;    ?>
<option 
<?php 
if($_POST['almacenDestino']==$_POST['almacenDestino1']){                
             echo 'selected="selected"';   
}elseif($ALMACEN==$myrow1['almacenPadre'] and !$_POST['almacenDestino1']){
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$myrow1['almacen']){ 
		echo 'selected="selected"';		
		} ?>
		value="<?php echo $myrow1['almacen']; ?>">
                <?php echo $b.'.  '.$myrow1['descripcion']; ?>
       </option>

<?php }}}      ?>



       
       
       
       
       
       
       
       
       


<?php  	//BOTIQUINES


$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacenPadre = '".$ALMACEN."'
and
stock='si'
and
almacenConsumo=''
order by descripcion ASC
";
$result1=mysql_db_query($basedatos,$sSQL1);
$nb=  mysql_num_rows($result1);
if($nb>0){
?>


<option value=""></option>
<option value="<?php echo $ALMACEN;?>">--------------BOTIQUINES------------</option>

<?php if(($_GET['almacen']==$ALMACEN and ($_GET['tipoPaciente']=='interno' or $_GET['tipoPaciente']=='urgencias')) or ($myrow1vext['ventaBotiquinExternos']=='si' and $_GET['almacen']==$ALMACEN)){?>


<?php while($myrow1 = mysql_fetch_array($result1)){   $bb+=1;    ?>
<option 
		<?php 
		if($ALMACEN==$myrow1['almacen'] and !$_POST['almacenDestino1']){
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$myrow1['almacen']){ 
		echo 'selected="selected"';		
		} ?>
		value="<?php echo $myrow1['almacen']; ?>">
                <?php echo $bb.'.  '.$myrow1['descripcion']; ?>
   
       </option>
       <?php }?>
       
       
<?php }else{?>
      <option class="titulomed" value="">
      NO PERMITIDO! o el PACIENTE ES EXTERNO!
      </option>              
   

       
       

<?php }}      ?>
        

       
       
       
       
       
<?php  	//MEDICOS
$sSQL1= "Select descripcion,almacen From almacenes,medicos WHERE almacenes.entidad='".$entidad."' AND almacenes.almacenPadre = '".$ALMACEN."'
and
almacenes.id_medico=medicos.numMedico
and
medicos.status='A'
group by almacenes.almacen
order by almacenes.descripcion ASC
";
$result1=mysql_db_query($basedatos,$sSQL1);
$nc=  mysql_num_rows($result1);
if($nc>0){
?>


<option value=""></option>
<option value="<?php echo $ALMACEN;?>">--------------MEDICOS------------</option>
<?php while($myrow1 = mysql_fetch_array($result1)){   $bc+=1;    



?>
<option 
		<?php 
		if($ALMACEN==$myrow1['almacen'] and !$_POST['almacenDestino1']){
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$myrow1['almacen']){ 
		echo 'selected="selected"';		
		} ?>
		value="<?php echo $myrow1['almacen']; ?>">
                <?php echo $bc.'.  '.$myrow1['descripcion']; 
               
                
                ?>
    
       </option>

<?php }}      ?>
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
<?php  	//ALMACEN REFERIDO
 $sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacenPadre = '".$ALMACEN."'
and
contieneReferidos='si'
order by descripcion ASC
";
$result1=mysql_db_query($basedatos,$sSQL1);
$nr=  mysql_num_rows($result1);
if($nr>0){
?>


<option value=""></option>
<option value="<?php echo $ALMACEN;?>">--------ESTUDIOS REFERIDOS--------</option>
<?php while($myrow1 = mysql_fetch_array($result1)){   $bc+=1;    




?>
<option 
		<?php 
		if($ALMACEN==$myrow1['almacen'] and !$_POST['almacenDestino1']){
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$myrow1['almacen']){ 
		echo 'selected="selected"';		
		} ?>
		value="<?php echo $myrow1['almacen']; ?>">
                <?php echo $bc.'.  '.$myrow1['descripcion']; 
               
                
                ?>
    
       </option>

<?php }}      ?>       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       

</select>
	     <?php }//cierra clase
			
			
						
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             public function despliegaMiniAlmacenMedicosSS($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$ALMACEN."' 
and
medico='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino5"  id="almacenDestino5" />        
					<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino5']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino5'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
			
			
			
			
			
			
			
						public function despliegaMiniAlmacenMedicos($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$ALMACEN."' 
and
medico='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino5"  id="almacenDestino5" onChange="javascript:this.form.submit();"/>        
					<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino5']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino5'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
			
			
			
			
			
			
			
						public function despliegaMiniAlmacenGET($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$ALMACEN."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
<select name="almacenDestino1"  id="almacenDestino1" onChange="javascript:this.form.submit();"/>        
					<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_GET['almacenDestino1']){
		
		echo 'selected="selected"';		
		} else if($_GET['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
			
			
			
			
			
			
			
			
			
			
			public function despliegaMiniAlmacenNM($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 
//NO MEDICOS
$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$ALMACEN."'
and
medico='no' 
 order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino4"  id="almacenDestino4" />        
					<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino4']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino4'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
			
			
			
						public function despliegaMiniAlmacenSS($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$ALMACEN."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino1"  id="almacenDestino1" />        
					<?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$ALMACEN."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
       <option value="<?php echo $ALMACEN;?>"><?php echo $myrow1['descripcion'];?></option>
	   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$al=$resCombo['almacenPadre'];

			
		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino1']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
						public function almacenesCuartos($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

 $aCombo= "Select * From almacenes where activo='A' and tieneCuartos='si' and medico='no' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino2"  id="almacenDestino2" onChange="javascript:this.form.submit();"/>        
					<option value="">Escoje</option>
					
   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino2']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino2'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
		 
		 
		 
         public function almacenesCuartosGET($entidad,$estilos,$ALMACEN,$almacenDestino,$basedatos){ 

 $aCombo= "Select * From almacenes where activo='A' and tieneCuartos='si' and medico='no' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="departamento"  id="departamento" onChange="javascript:this.form.submit();"/>        
					<option value="">Escoje</option>
					
   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){		 ?>
		
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_GET['departamento']){
		
		echo 'selected="selected"';		
		} else if($_GET['departamento'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     <?php }
		 
		 
		 
		   public function cuartosGET($entidad,$estilos,$codigoCuarto,$almacen,$almacenDB,$basedatos){ 

 $aCombo= "Select * From cuartos where departamento='".$almacen."' or departamento='".$almacenDB."' order by descripcionCuarto ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="id_cuarto"  id="id_cuarto"/>        
					<option value="">Escoje</option>
					
   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){		 ?>
		
        <option 
		<?php 
		if($codigoCuarto==$resCombo['codigoCuarto']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['codigoCuarto']; ?>"><?php echo $resCombo['descripcionCuarto']; ?></option>
        <?php } ?>
        </select>
	     <?php }
		 }?>