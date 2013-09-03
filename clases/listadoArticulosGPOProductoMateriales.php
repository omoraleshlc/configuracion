<?php 
class consultaArticulosPrecio{
public function consultarArticulos($almacen,$entidad,$basedatos){
?>

<?php $articulo = $_GET['nomArticulo']; ?>

<?php  
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
<h1 align="center" class="titulos">Listado por GPO </h1>







<form id="form1" name="form1" method="post" action="">
  <img src="../imagenes/bordestablas/borde1.png" width="474" height="24" />
  <table width="474" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
      <th height="21" bgcolor="#CCCCCC" scope="col"><div align="center" class="none">Almac&eacute;n Principal</div></th>
	  
	  
	  
	  
      <th bgcolor="#CCCCCC" scope="col"><div align="left">
        <?php 
	  $aCombo= "Select * From almacenes where ventas='si' and entidad='".$entidad."' AND
activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="almacenDestino" class="combos" id="almacenDestino" onChange="javascript:this.form.submit();"/>
  
          <option value="">---</option>
          <option value="">TODOS</option>
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
      </div></th>
    </tr>
	
	
	
	
	
	
    <tr>
      <th height="21" bgcolor="#CCCCCC" class="none" scope="col">Mini Almac&eacute;n </th>
      <th bgcolor="#CCCCCC" class="style71" scope="col"><div align="left">
          <?php 
  $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$_POST['almacenDestino']."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="almacenDestino1" class="combos" id="almacenDestino1" onChange="javascript:this.form.submit();"/>
         
          <?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_POST['almacenDestino']."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
          <option value="<?php echo $_POST['almacenDestino'];?>"><?php echo $myrow1['descripcion'];?></option>
          <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
          <option 

		
		<?php 
		 if($_POST['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
          <?php } ?>
          </select>
      </div></th>
    </tr>
	
	
	
	
	
    <tr>
      <th width="185" height="22" bgcolor="#CCCCCC" scope="col"><div align="center" class="none">Grupo de Producto</div></th>
      <th width="525" bgcolor="#CCCCCC" scope="col"> </span>
          <div align="left" class="style19">
            <label>
            <?php //*********gpoProductos

	  
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' 
 and
 (codigoGP!='HONMED' and codigoGP!='sIVA' and codigoGP!='cIVA')
 ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
            <select name="gpoProducto" class="combos" id="select" >
              <option value="">---</option>
              <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
              <option 
		    <?php 		if($_POST['gpoProducto']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']." - ".$myrow7['codigoGP']; ?></option>
              <?php } 
		
		?>
            </select>
            </label>
            </span>

        </div></th>
    </tr>
    <tr bgcolor="#FFFFFF">
      <th height="22" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" scope="col"><div align="left"><span class="style19">
          <input name="buscar" type="submit" src="/sima/imagenes/btns/searcharticles.png" id="buscar" value="buscar" />
      </span></div></th>
    </tr>
  </table>
  <img src="../imagenes/bordestablas/borde2.png" width="474" height="24" />
<p>&nbsp;</p>
  <img src="../imagenes/bordestablas/borde1.png" width="791" height="24" />
  <table width="791" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr bgcolor="#FFFF00">
  
      <th width="324" scope="col"><div align="left" class="none">Descripci&oacute;n</div></th>
      <th width="162" scope="col"><div align="left" class="none">Almacen</div></th>
      <!--<th width="132" bgcolor="#660066" scope="col"><div align="left" class="blanco">Sustancia</div></th>-->
      <!--<th width="101" bgcolor="#660066" scope="col"><div align="left" class="blanco">Fecha / Hora Modifica </div></th>-->
      <th width="131" scope="col"><div align="left" class="none">GRUPO</div>        <div align="left"></div></th>
      <th width="51" scope="col"><div align="left" class="none">P Part</div></th>
      <th width="53" scope="col"><div align="left" class="none">P Aseg</div></th>
      <th width="44" scope="col"><div align="left" class="none">Mod </div></th>
      <!--<th width="52" bgcolor="#660066" scope="col" class="blanco">Usuario</th>-->
    </tr>
    <tr valign="middle">

<?php		
if($_POST['buscar'] || $_POST['actualizar'] || $_POST['delete']){
//codigo
    $sSQL= "
SELECT  existencias.keyE,articulos.keyPA,articulos.descripcion ,articulos.gpoProducto  from existencias,articulos
where
articulos.entidad='".$entidad."'
and
existencias.almacen='".$_POST['almacenDestino1']."' 
and
existencias.keyPA=articulos.keyPA
and
articulos.descripcion!=''
and
articulos.gpoProducto='".$_POST['gpoProducto']."'
order by 
articulos.descripcion ASC
"
;


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];
$sSQL52="SELECT count(*) as totalRegedit
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
  
$i=$myrow52['totalRegedit'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

$sSQL51="SELECT *
FROM
existencias
WHERE entidad='".$entidad."' AND
keyPA = '".$myrow['keyPA']."' 
and
almacen='".$_POST['almacenDestino1']."'
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
$bali=$myrow51['almacen'];

  

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$C=$myrow['codigo'];


 $sSQL78="SELECT nivel1,nivel3
FROM
articulosPrecioNivel
WHERE 
entidad='".$entidad."'
and
keyPA = '".$myrow['keyPA']."' 
and
almacen='".$_POST['almacenDestino1']."'
  ";
  $result78=mysql_db_query($basedatos,$sSQL78);
  $myrow78 = mysql_fetch_array($result78);




$gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo,rutaModifica
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$color1='#FF3300';
$bandera=+1;
?>

      
      
      
      <td bgcolor="<?php 

	  echo $color;

	  ?>" class="normal"><span class="codigos">
        <input name="keyPA[]" type="hidden" id="codigo" value="<?php echo $myrow['keyPA'];?>" />
      </span>
        <?php 
	  
	  if($bali){ ?>
	  	  <label>

	  
	  <textarea name="descripcion[]" cols="30" rows="" wrap="virtual" class="normal"><?php echo $myrow['descripcion']; ?></textarea>
	  </label>
      
      <?php 
        } else {
	  
	   $imagen='<img src="/sima/imagenes/stop.png" width="13" height="13" border="0" />';
	   echo $myrow['descripcion'].'<blink>'.$imagen.'</blink>'.'< Sin Almacen..>';
	   }
	  ?>
	  
	  	<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
	  </span></td>
      
      <td bgcolor="<?php echo $color;?>" class="style7">
	  
	  
	  
	  <?php 
		 if($myrow51['almacen'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
	  
	  
<?php 
  $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and miniAlmacen ='Si'
and
medico!='si' 


order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>

<?php 
 $sSQL39a= "
	SELECT 
*
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow51['almacen']."'";
$result39a=mysql_db_query($basedatos,$sSQL39a);
$myrow39a = mysql_fetch_array($result39a);
?>


          <select name="almacen[]" class="combos" id="almacen" />




<option value="<?php echo $myrow39a['almacen'];?>"><?php echo $myrow39a['descripcion'];?></option>

          <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
          <option 

		
		<?php 
		 if($myrow51['almacen'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
          <?php } ?>
          </select>
		
		
		</td>
      <?php /*?><td bgcolor=" <?php echo $color;/?>" class="normal">
	 /*   <?php 
	  if($myrow['descripcion1']){
	  echo $myrow['descripcion1'];
	  } else {
	  echo '(Sin Sustancia...)';
	  }
	   ?>
       
       </td><?php */?>
	 
    <?php /*?>  <td bgcolor="<?php echo $color;?>" class="normal">
	  <?php echo cambia_a_normal($myrow['fechaActualizacion'])." <".$myrow['hora'].">"; ?></td><?php */?>
      <td bgcolor="<?php echo $color;?>" class="style7"><?php //*********gpoProductos
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="gpoProducto1[]" class="combos" id="gpoProducto1[]" onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Escoje el Grupo de Producto para Art�culo: '.$myrow['descripcion'];?></div>')" onmouseout="UnTip()">
          <option value="">Escoje el Grupo</option>
          <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
          <option 
		    <?php 		if($_POST['gpoProducto1']==$myrow7['codigoGP'] or $myrow['gpoProducto']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
          <?php } 
		
		?>
        </select></td>
      <td bgcolor="<?php echo $color;?>" class="abonos" >
	  
	  

	  <label>
	  <input name="particular[]" type="text" id="particular[]" size="7" value="<?php echo $myrow78['nivel1'];?>" class="normal" />
	  </label>
	  </a></td>
      <td bgcolor="<?php echo $color;?>" class="cargos" >

	  	  <input name="aseguradora[]" type="text" id="aseguradora[]" size="7"  value="<?php echo $myrow78['nivel3'];?>" class="normal"/></td>
      
      
      
      
      
      <td class="style7"><div align="left">
        <label>
        <input name="keyPA1[]" type="checkbox" id="keyPA1[]" value="<?php echo $myrow['keyPA'];?>" />
        </label>

		
	  </div></td>
    </tr>
    <?php }}?>
  </table>
  <img src="../imagenes/bordestablas/borde2.png" width="791" height="24" />
  <p align="center">
    <label></label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label><?php if($totalRegistros>0){ ?>
    <input name="actualizar" type="submit" src="../imagenes/btns/refresh.png" id="actualizar" value="Actualizar " />
	    <input name="delete" type="submit" src="../imagenes/btns/refresh.png" id="actualizar" value="Eliminar [Aplica al almacen solamente]" />
	<?php } ?>
    </label>

  </p>
</form>

<?php if($totalRegistros){ ?>
<p align="center" class="negro"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p></a>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>
<?php 
}
}
?>