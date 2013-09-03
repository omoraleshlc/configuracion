<table width="642" border="0" align="center" class="normal" cellspacing="0" style="border: 1px solid #000000;">
  <tr bgcolor="#FFFF00">
    <td align="center" class="negromid">Particular</td>
    <td align="center" class="negromid">Aseguradora</td>
    <td align="center" class="negromid">Regreso Aseguradora </td>
    <td align="center" class="negromid">Regreso Particular </td>
    <td align="center" class="negromid">Coaseg1</td>
    <td align="center" class="negromid">Coaseg2</td>
    <td align="center" class="negromid">Deduc1</td>
    <td align="center" class="negromid">Deduc2</td>
  </tr>
  <tr bgcolor="#FFFF00">
   
   
   
   
   
   
   
    <td width="74" align="center" class="negromid">
	<?php  echo $myrow3['statusDevolucion'];
if( $totalParticular>1 ||  $myrow3['statusDevolucion']=='si'){ 
if($myrow3['tipoPaciente']=='externo'){ 


if($devolucionParticular[0]>0){	
$tipoPago='devolucionParticular';
if($totalParticular<0){ 
$totalParticular*=-1;
}
}else{
$s= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and pagoEfectivo='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}


}else{
$s= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and gastosParticulares='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$tipoPago='Efectivo';
}


?>




<?php echo '$'.number_format($totalParticular,2);?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	</td>
	
	
	
		
	
	
    <td width="78" align="center" class="negromid">
	<?php 
if( $totalAseguradora>1 || $myrow3['statusDevolucion']=='si'){ 

if($devolucionAseguradora[0]>0){ 
$s= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and devolucionAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

if($totalAseguradora<0){ 
$totalAseguradora*=-1;
}

}else{
$s= "Select codigoTT From catTTCaja WHERE entidad='".$entidad."' and trasladoAseguradora='si'";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);

}
?>
        <?php  if($totalCoaseguro1<1 and $totalCoaseguro2<1 and $totalDeducible1<1 and $totalDeducible2<1){ ?>
        <?php echo '$'.number_format($totalAseguradora,2);?>
        <?php } else{?>
        <?php echo '$'.number_format($totalAseguradora,2);?>
        <?php } ?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	</td>
    
	
	
	
<td width="77" align="center" class="negromid">
		    <?php 
if($totalAseguradora<-1  and $devolucionAseguradora[0]<1){ 
$tA=$totalAseguradora*-1;
?>
	<?php echo '$'.number_format($tA,2);?>
</a> 
  <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	</td>
	
	
	
	
    <td width="77" align="center" class="negromid">
			<?php
 if($totalParticular<-1){  
$tP=$totalParticular*-1;
?>
	<?php echo '$'.number_format($tP,2);?>
<?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	
	</td>
    
	
	
	<td width="77" align="center" class="negromid">
		<?php if($totalCoaseguro1>1){ 	?>
 <?php echo '$'.number_format($totalCoaseguro1,2);?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	</td>
    
	
	
	<td width="78" align="center" class="negromid">
		<?php if($totalCoaseguro2>1){ ?>
      <?php echo '$'.number_format($totalCoaseguro2,2);?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	</td>
    
	
	
	<td width="80" align="center" class="negromid">
		<?php if($totalDeducible1>1){ ?>
        <?php echo '$'.number_format($totalDeducible1,2);?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	</td>


    <td width="85" align="center" class="negromid">
		<?php if($totalDeducible2>1){ ?>
        <?php echo '$'.number_format($totalDeducible2,2);?>
        <?php } else{?>
        <img src="/sima/imagenes/btns/checkbtn.png" width="18" height="18">
        <?php } ?>
	</td>
  
  
  </tr>






  <tr>  </tr>
</table>

