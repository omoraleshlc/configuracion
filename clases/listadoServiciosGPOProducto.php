<?php 
class consultaArticulosPrecio{
public function consultarArticulos($almacen,$entidad,$basedatos){
$articulo = $_GET['nomArticulo']; 
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE articulos set 

		activo='I'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else if($_GET['activa']=="activa"){
 $q = "UPDATE articulos set 

		activo='A'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=350,height=189,scrollbars=YES") 
} 
</script>
 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=450,height=170,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=450,height=170,scrollbars=YES") 
} 
</script> 
<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['actualizar']){
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto1'];
$aseguradora=$_POST['aseguradora'];
$particular=$_POST['particular'];
$descripcion=$_POST['descripcion'];
$almacen=$_POST['almacen'];


for($i=0;$i<=$_POST['bandera'];$i++){
if($keyPA[$i]!=NULL){
$q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',

fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();

 $q2 = "UPDATE articulosPrecioNivel set 

nivel1='".$particular[$i]."',
nivel3='".$aseguradora[$i]."',
almacen='".$almacen[$i]."'

WHERE entidad='".$entidad."' and  keyPA='".$keyPA[$i]."' 
and
almacen='".$_POST['almacenDestino1']."'
";
mysql_db_query($basedatos,$q2);
echo mysql_error();

 $q3 = "UPDATE existencias set 

descripcion='".$descripcion[$i]."',
almacen='".$almacen[$i]."'


WHERE 

entidad='".$entidad."' and  keyPA='".$keyPA[$i]."' 
and
almacen='".$_POST['almacenDestino1']."'
";
mysql_db_query($basedatos,$q3);
echo mysql_error();
}
}
echo 'Se hicieron cambios en el sistema...';

}
?>










<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['delete']){
$keyPA=$_POST['keyPA1'];

for($i=0;$i<=$_POST['bandera'];$i++){
if($keyPA[$i]){


 $q3 = "DELETE FROM existencias where entidad='".$entidad."' and almacen='".$_POST['almacenDestino1']."' and keyPA='".$keyPA[$i]."' ";
mysql_db_query($basedatos,$q3);
echo mysql_error();

$q4 = "DELETE FROM articulosPrecioNivel where entidad='".$entidad."' and almacen='".$_POST['almacenDestino1']."' and keyPA='".$keyPA[$i]."' ";
mysql_db_query($basedatos,$q4);
echo mysql_error();


}
}
echo 'Se eliminaron cambios en el sistema...';

}
?>



        <script type="text/javascript" src="/sima/js/editp/spec/support/jquery.js"></script>
        <script type="text/javascript" src="/sima/js/editp/spec/support/jquery.ui.js"></script>
        <script type="text/javascript" src="/sima/js/editp/lib/jquery.editinplace.js"></script>
        


        
        
        
        
        
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>
<h1 align="center" >Listado por GPO </h1>







<form id="form1" name="form1" method="post" >

  <table width="474" class="table-forma">
    <tr>
      <td height="21"   scope="col"><div align="center" >Almac&eacute;n </div></td>
	  
	  
	  
	  
      <td   scope="col"><div align="left">
        <?php 
	  $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="almacenDestino" class="combos" id="almacenDestino" />
  
          <option value="">---</option>
          <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
          <option 
		<?php 
		if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
          <?php } ?>
          </select>
      </div></td>
    </tr>
	
	
	
	
	
	
  
	
	
	
	
	




    <tr>
      <td height="22"  scope="col">&nbsp;</td>
      <td  scope="col"><div align="left"><span >
          <input name="buscar" type="submit" src="/sima/imagenes/btns/searcharticles.png" id="buscar" value="buscar" />
      </span></div></td>
    </tr>
  </table>

<p>&nbsp;</p>
 
  <table width="791" class="table table-striped">
    <tr >
      <th width="5"  scope="col"><p align="left" >#</p></th>
      <th width="300"  scope="col"><p align="left" >Descripcion</p></th>
     <th width="50" scope="col"><p align="left" >Anaquel</p></th>
      <th width="200" scope="col"><p align="left" >Grupo</p></th>
 <th width="200" scope="col"><p align="left" >Costo</p></th>
      <th width="60" scope="col"><p align="left" >P Part</p></th>
      <th width="50" scope="col"><p align="left" >P Aseg</p></th>


      <!--<th width="52" bgcolor="#660066" scope="col" class="blanco">Usuario</th>-->
    </tr>


<?php		
if($_POST['buscar'] ){
//codigo
$sSQL= "
SELECT * from articulos,existencias where articulos.entidad='".$entidad."' and 
existencias.almacen='".$_POST['almacenDestino']."' and 
    articulos.descripcion!='' 
    and
existencias.codigo=articulos.codigo    
order by articulos.gpoProducto,articulos.descripcion ASC"
;


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;
$totalRegistros+=1;



  
$i=$myrow52['totalRegedit'];




 $sSQL78="SELECT nivel1,nivel3
FROM
articulosPrecioNivel
WHERE 
entidad='".$entidad."'
and
codigo = '".$myrow['codigo']."' 
and
almacen='".$_POST['almacenDestino']."'
  ";
  $result78=mysql_db_query($basedatos,$sSQL78);
  $myrow78 = mysql_fetch_array($result78);


 $sSQL78a="SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo = '".$myrow['codigo']."' 
order by keyC DESC
  ";
  $result78a=mysql_db_query($basedatos,$sSQL78a);
  $myrow78a = mysql_fetch_array($result78a);


$gpoProducto=$myrow['gpoProducto'];



$sSQL39= "
	SELECT 
prefijo,rutaModifica,descripcionGP
FROM
gpoProductos
WHERE 
codigoGP='".$myrow['gpoProducto']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$color1='#FF3300';
$bandera=+1;
?>

      
      
      
  <tr  >

          <td >
        <span  >

<?php echo $a;?>
	  </span></td>




  <td   >
        <span  >
        <input name="keyPA[]" type="hidden" id="codigo" value="<?php echo $myrow['keyPA'];?>" />
      </span>

	  	  <label>
<?php echo $myrow['descripcion']; 
if($myrow['sustancia']!=NULL){
    echo '<br>';
    echo 'Sustancia: '.$myrow['sustancia'];
    
}
?>
	  </label>
      

	  
	  	<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="../imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
	  </span></td>
      

         


<script type="text/javascript">
/*
 * Another In Place Editor - a jQuery edit in place plugin
 *
 * Copyright (c) 2009 Dave Hauenstein
 *
 * License:
 * This source file is subject to the BSD license bundled with this package.
 * Available online: {@link http://www.opensource.org/licenses/bsd-license.php}
 * If you did not receive a copy of the license, and are unable to obtain it,
 * email davehauenstein@gmail.com,
 * and I will send you a copy.
 *
 * Project home:
 * http://code.google.com/p/jquery-in-place-editor/
 *
 */
$(document).ready(function(){
	

	// Using a callback function to update 2 divs
	$("#<?php echo $myrow['keyE']; ?>").editInPlace({
            url: "/sima/cargos/ajusteAnaquel.php?keyE=<?php echo $myrow['keyE']; ?>"
		//callback: function(element_id,original_element, html, original){
                     
		//	$("#updateDiv1").html("The original html was: " + original);
		//	$("#updateDiv2").html( html);
                //        $("#updateDiv3").html("El ID es el: " + element_id);
		//	return(html);
		//}
	});
	
        
        	// A select input field so we can limit our options
	$("#<?php echo $myrow['keyPA'];?>").editInPlace({
		callback: function(unused, enteredText) { return enteredText; },
                url: "/sima/cargos/ajusteGpoProducto.php?gpoProducto=<?php echo $myrow['gpoProducto'];?>&keyPA=<?php echo $myrow['keyPA'];?>",
		field_type: "select",
		select_options: "<?php 
	 
 $sSQL7a= "Select * From gpoProductos where 
(codigoGP!='HONMED' and codigoGP!='sIVA' and codigoGP!='cIVA')     
ORDER BY descripcionGP ASC ";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
 while($myrow7a = mysql_fetch_array($result7a)){ echo $myrow7a['descripcionGP'].',';}?>"
	});

	
	// If you need to remove an already bound editor you can call

	// > $(selectorForEditors).unbind('.editInPlace')

	// Which will remove all events that this editor has bound. You need to make sure however that the editor is 'closed' when you call this.
	
});
</script>  


      <td   >
<div align="left" >
<?php echo $myrow['anaquel']; ?>      
</div>          


</td>

	 
    <?php /*?>  <td bgcolor="<?php echo $color;?>" >
	  <?php echo cambia_a_normal($myrow['fechaActualizacion'])." <".$myrow['hora'].">"; ?></td><?php */?>
      <td   >
          <?php //*********gpoProductos
 echo $myrow39['descripcionGP'];
	  ?>

</td>






   
      <td  >
          
          <?php //*********gpoProductos
 echo '$'.number_format($myrow78a['costo'],2);
	  ?>

</td>





         
      <td   >
	  
	  

	  <label>

 <?php echo '$'.number_format($myrow78['nivel1'],2);?>
	  </label>
	  </a></td>
      <td   >

	  	 <?php echo '$'.number_format($myrow78['nivel3'],2);?>
      </td>
      
      
      
      
      

         
    </tr>
    <?php }}?>
  </table>
 
</form>

<?php if($totalRegistros){ ?>
<div align="center" class="notice"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></div></a>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>