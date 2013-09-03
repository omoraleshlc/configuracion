<?PHP class desplegarACC{
public function eACC($usuario,$random,$entidad,$almacen,$basedatos){ 


?> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
} 
</script> 



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
-->
</style>
</head>



<?php 
$sSQL7e="SELECT *
FROM
almacenes
WHERE
entidad='".$entidad."'
and
almacen='".$almacen."'

";
$result7e=mysql_db_query($basedatos,$sSQL7e);
$myrow7e = mysql_fetch_array($result7e);


?>
<body>
 <h1 align="center">

 
  <?php print $myrow7e['descripcion']; ?> </h1>
    <p align="center"><br />
    </p>
<form id="form2" name="form2" method="post" action="">
  <div align="center">
   
<?php   

$sSQL= "Select gpoProducto,descripcionArticulo,keyCAP,naturaleza,folioVenta,efectivo,folioDevolucion From reportesFinancieros where 
random='".$random."'
and
usuario='".$usuario."'
and
honorarios='si'
and
almacenPrincipal='".$almacen."'
order by folioVenta,folioDevolucion ASC
";
$result=mysql_db_query($basedatos,$sSQL); 
?>
</div>
  <table width="662" border="0" align="center">
     <tr>
       <th width="28" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">#</span></div></th>
       <th width="58" bgcolor="#660066" scope="col"><span class="blanco">Mov</span></th>
       <th width="65" bgcolor="#660066" scope="col"><span class="blanco">Folio</span></th>
       <th width="65" bgcolor="#660066" scope="col"><span class="blanco">FolioDev</span></th>
       <th width="298" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Descripci&oacute;n</span></div></th>
       <th width="59" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Ingresos</span></div></th>
       <th width="59" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">N</span></div></th>
    </tr>
     <tr>
<?php	
while($myrow = mysql_fetch_array($result)){
 $sSQL7ab="SELECT codProcedimiento,almacenSolicitante,descripcionArticulo,descripcion,almacenDestino
FROM
cargosCuentaPaciente
WHERE
keyCAP='".$myrow['keyCAP']."'";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	



	$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}









//************************EFECTIVOS******************


if($myrow['naturaleza']=='C'){
$efectivo[0]+=$myrow['efectivo'];
}else{
$efectivoD[0]+=$myrow['efectivo'];
}

$sSQL7ss="SELECT descripcionGP

FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$myrow['gpoProducto']."'";
$result7ss=mysql_db_query($basedatos,$sSQL7ss);
$myrow7ss = mysql_fetch_array($result7ss);
?>




       <td bgcolor="<?php echo $color?>" class="normalmid"><span class="style7">
       
         <label>
         <?php 
	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
	   echo $a;
	   echo '</p>';
		}else{
		echo $a;
		}
	   ?>         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php 
	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
	   echo $myrow['keyCAP'];
	   echo '</p>';
	   }else{
	   echo $myrow['keyCAP'];
	   }
	   ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php 
	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
	   echo $myrow['folioVenta'];
	   echo '</p>';
	   }else{
	   echo $myrow['folioVenta'];
	   }	   
	   ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
       
	   <?php 
	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
	   echo $myrow['folioDevolucion'];
	   echo '</p>';
	   }else{
	   
	   echo '---'; 
	   
	   }
	   ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
<span class="style71">
<?php 
$sSQL7ab1="SELECT descripcion 
FROM
almacenes
WHERE
almacen='".$myrow7ab['almacenDestino']."'";
$result7ab1=mysql_db_query($basedatos,$sSQL7ab1);
$myrow7ab1 = mysql_fetch_array($result7ab1);	




	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
   	   echo $myrow7ab['descripcion'];
   	   echo '<br>';
	   echo $myrow7ab1['descripcion'];
	    echo '</p>';
	   }else{
	   echo $myrow7ab['descripcion'];
   	   echo '<br>';
	   echo $myrow7ab1['descripcion'];
       }
	   ?>	   </span>          </td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php //echo $myrow7['efectivos'].' '.$myrow7d['efectivos'].'<br>';
	   if($myrow['naturaleza']=='C'){
	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
	   echo "$".number_format($myrow['efectivo'],2); 
	   echo '</p>';
	   }else{
	   echo "$".number_format($myrow['efectivo'],2); 
	   }
	   }else{
	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
	   echo "-$".number_format($myrow['efectivo'],2); 
	   echo '</p>';
	   }
	   }  	   ?></td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><?php 
   	   if($myrow['folioDevolucion']){
	   echo '<p class="Estilo1">';
	   echo $myrow['naturaleza'];
	    echo '</p>';
	   }
	   ?></td>

     </tr>
     
    
<?php 

	}//cierra while
	
?>
  </table>
  
  
  
  

  
  
  
  
  
  
  
  
  <table width="200" border="1" align="center">
    <tr>
      <th colspan="2" scope="col">Subtotales</th>
    </tr>
    <tr>
      <td width="97"><div align="left">TOTAL</div></td>
      <td width="87"><div align="left">
	  <?php 
	  
	 	  print '$'.number_format($efectivo[0]-$efectivoD[0],2);
		  ?></div></td>
    </tr>
  </table>
</form>

</body>
</html>
<?php 
} 
}
?>