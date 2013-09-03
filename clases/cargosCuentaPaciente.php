<?php class mostrarCargos { 
public function cargosCuentaPaciente($porcentajeFacturacion,$folioVenta,$extension,$gpoProducto,$entidad,$basedatos){ 
?>

<hr>
<p align="center">
<?php
$sSQL12a= "
SELECT descripcionGP
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."'
";
$result12a=mysql_db_query($basedatos,$sSQL12a);
$myrow12a = mysql_fetch_array($result12a);
echo $myrow12a['descripcionGP'];
?>
</p>
<table width="647" height="53" border="0.2" align="center">
    <tr bgcolor="#330099">
      <th width="39" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Ref</div>
      </div></th>

      <th width="232" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Descripcion</div>
      </div></th>


      <th width="36" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Cant.</div>
      </div></th>
      <th width="65" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Importe</div>
      </div></th>


      <th width="39" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
        <div align="left">ivaParticular</div>
      </div></th>
	  

	  
	  
      <th width="39" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">N</div>
      </div></th>
    </tr>

<tr>



<?php 

$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$folioVenta."'
and
gpoProducto='".$gpoProducto."'
and
cantidadAseguradora>0
order by descripcionArticulo ASC



";		




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

$bandera+=1;




?>
  </tr>
    
      
	  


	  
	   
      
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td bgcolor="<?php echo $color;?>" class="codigos"><div align="left"><span class="normalmid"><?php echo $myrow['keyCAP']; ?></span></div></td>
      

      
      <td height="24" bgcolor="<?php echo $color;?>" class="normal"><div align="left"><span class="normalmid">
        <?php 
		$sSQL12as= "
SELECT descripcion
FROM
articulos
WHERE 

codigo='".$myrow['codProcedimiento']."'
";
$result12as=mysql_db_query($basedatos,$sSQL12as);
$myrow12as = mysql_fetch_array($result12as);


		echo $myrow12as['descripcion'];

		?>

      </span>

        <?php 
		
		if($myrow['statusFactura']=='facturado'){
		//echo '<span class="codigos">'.'Registro Facturado'.'</span>'; 
		}
		?>

      </div></td>
      
      

      <td bgcolor="<?php echo $color;?>" class="normalmid"><div align="left"><?php echo $myrow['cantidad']?></div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
        <div align="left">
		
		
<?php 


if($myrow['naturaleza']=='C'){

if($porcentajeFacturacion>0 and $extension>0){
$total=($myrow['cantidadAseguradora']*$myrow['cantidad'])*$porcentajeFacturacion;
//$total=($myrow['cantidadAseguradora']*$myrow['cantidad'])-$pV;
}else{ 
$total=$myrow['cantidadAseguradora']*$myrow['cantidad'];
}		

$tot[0]+=$total;

}elseif($myrow['naturaleza']=='A'){
if($porcentajeFacturacion>0 and $extension>0){
$total1=($myrow['cantidadAseguradora']*$myrow['cantidad'])*$porcentajeFacturacion;
}else{ 
$total1=$myrow['cantidadAseguradora']*$myrow['cantidad'];
}	


$totDev[0]+=$total1;
}







if($myrow['naturaleza']=='C'){
		echo '$'.number_format($total,2);
		}else{
		echo '-$'.number_format($total1,2);
		}
		?>
        </div>
      <td bgcolor="<?php echo $color;?>" class="negromid"><?php 



if($myrow['naturaleza']=='C'){
if($porcentajeFacturacion>0){
$totalivaParticular=($myrow['ivaParticularParticular']*$myrow['cantidad'])*$porcentajeFacturacion;
//$totalivaParticularParticular=($myrow['ivaParticular']*$myrow['cantidad'])-$ivaParticular;
}else{
$totalivaParticular=$myrow['ivaParticular']*$myrow['cantidad'];
}

$totivaParticular[0]+=$totalivaParticular;

}else{

if($porcentajeFacturacion>0){
$totalivaParticular1=($myrow['ivaParticular']*$myrow['cantidad'])*$porcentajeFacturacion;
//$totalivaParticular=($myrow['ivaParticular']*$myrow['cantidad'])-$ivaParticular;
}else{
$totalivaParticular1=$myrow['ivaParticular']*$myrow['cantidad'];
}

$totivaParticularDEV[0]+=$totalivaParticular1;	
}


	
		
		
		if($myrow['naturaleza']=='C'){
	echo '$'.number_format($totalivaParticular,2);
	}else{
	echo '-$'.number_format($totalivaParticular1,2);
	}

	  ?></td>
	  
	  
	  

	  
      <td bgcolor="<?php echo $color;?>" class="negromid">
        <div align="left"></span>
		<?php echo $myrow['naturaleza'];?>		</div></td>
    </tr>
    
    
    

      
      
      
    <?php }?>
</table>
  <p>

  </p>
  <p align="center">
    <?php


  
  echo 'Total:  $' .number_format(($tot[0]-$totDev[0])+($totivaParticular[0]-$totivaParticularDEV[0]),2);?>
</p>
    <?php
  }
  }
  ?>