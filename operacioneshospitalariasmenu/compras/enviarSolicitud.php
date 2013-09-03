<?php require('/configuracion/ventanasEmergentes.php'); include('/configuracion/funciones.php');?>
<?php  
if($_GET['keyR'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "delete from OC

		WHERE keyR='".$_GET['keyR']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>


















<?php 
if($_POST['update'] ){
$precioSugerido=$_POST['precioSugerido'];$costo=$_POST['costo'];
$keyR=$_POST['keyR'];$cantidad=$_POST['cantidad'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyR[$i]){

    
    
    
    $sSQL12= "
	SELECT *
FROM
  OC

WHERE keyR='".$keyR[$i]."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
    

if($myrow12['descuentoPorcentaje']>0){
    $importeDescu=$costo[$i]-(($myrow12['descuentoPorcentaje']*0.01)*$costo[$i]);
}    else{
    $importeDescu=NULL;
}
    
    
 $q = "UPDATE OC set 
    cantidad='".$cantidad[$i]."',
        importeDescuento='".$importeDescu."',
        
precioSugerido='".$precioSugerido[$i]."',
precioUnitario='".$costo[$i]."'

		WHERE keyR='".$keyR[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}

}




}












if($_POST['descripcion'] and $_POST['keyPA'] and !$_POST['update'] and !$_POST['send']){


$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
keyPA='".$_POST['keyPA']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


$agregaSaldo = "INSERT INTO OC ( id_requisicion,id_almacen,usuario,fecha,hora,status,prioridad,id_proveedor,
    entidad,numFactura,keyPA,cantidadParticular,cantidadAseguradora,cantidad,descripcionArticulo

) values (

'".$_GET['req']."','".$_GET['departamento']."','".$usuario."','".$fecha1."','".$hora1."','request',
'".$_POST['prioridad']."','".$_GET['proveedor']."','".$entidad."','".$_GET['id_factura']."','".$_POST['keyPA']."' ,'0.00','0.00','0' ,'".$myrow12['descripcion']."' )";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();

}
?>

























<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['send']){
$keyR=$_POST['keyR'];
$costo=$_POST['costo'];
$cantidad=$_POST['cantidad'];
$keyPA=$_POST['keyPA'];

for($i=0;$i<=$_POST['bandera'];$i++){



if($keyR[$i]!=NULL){



$sSQL3a= "
	SELECT 
codigo,gpoProducto,descripcion
FROM
articulos
WHERE keyPA='".$keyPA[$i]."'";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);




$sSQLrd= "SELECT  
* 
FROM OC
WHERE
entidad='".$entidad."'
and
numFactura='".$_GET['id_factura']."'
and
codigo='".$myrow3a['codigo']."'";
$resultrd=mysql_db_query($basedatos,$sSQLrd);
$myrowrd = mysql_fetch_array($resultrd);


$_GET['departamento']=$myrowrd['id_almacen'];


//***************************************
if($cantidad[$i]>0 and  $costo[$i]>0 and $keyR[$i]  ){


$porcentajeParticular=($costo[$i]*$myrow3['porcentajeParticular'])/100;
$porcentajeAseguradora=($costo[$i]*$myrow3['porcentajeAseguradora'])/100;


if($keyPA[$i]!=NULL){
$q1a = "INSERT INTO precioArticulos 
(codigo,costo,usuario,fecha,hora,entidad,keyPA,ID_EJERCICIO,status,
cantidadParticular,cantidadAseguradora,descripcionArticulo)
values
('".$myrow3a['codigo']."','".$costo[$i]."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keyPA[$i]."','".$ID_EJERCICIOM."' ,'request'  ,'".$porcentajeParticular."' ,
        '".$porcentajeAseguradora."' ,'".$myrow3a['descripcion']."'  )";

mysql_db_query($basedatos,$q1a);
echo mysql_error();



/*
	1 	kk 	bigint(20) 			No 	None 	AUTO_INCREMENT 	Change Change 	Drop Drop 	More Show more actions
	2 	kc 	bigint(50) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
	3 	descripcion 	varchar(200) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	4 	evento 	varchar(30) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	5 	descripcionevento 	varchar(200) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	6 	naturaleza 	char(1) 	utf8_spanish_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	7 	usuario 	varchar(20) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	8 	fecha 	varchar(10) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	9 	hora 	varchar(10) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	10 	entidad 	varchar(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	11 	keyPA 	bigint(50) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
	12 	almacenSolicitante 	varchar(50) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
	13 	almacenDestino 	varchar(50) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
*/












//********************ACTUALIZO EXISTENCIAS***********************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow3a['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad[$i]*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad[$i];
}
//****************************************************************
$karticulos=new kardex();
$karticulos-> movimientoskardex($cantidad[$i],'ENTRADA POR COMPRAS','entrada',$usuario,$fecha1,$hora1,$_GET['departamento'],$_GET['departamento'],$keyPA[$i],$myrow3a['codigo'],$entidad,$basedatos);





$q1a = "UPDATE existencias set 
cantidadTotal=cantidadTotal+'".$ct."',
existencia=existencia+'".$cantidad[$i]."'
WHERE

keyPA='".$keyPA[$i]."'
and
almacen='".$_GET['departamento']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();

}
}











}

} ?>
<script>
window.alert("Factura Enviada");
window.close();
</script>
<?php 
}
?>



















<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria17 (URL){ 
   window.open(URL,"ventanaSecundaria17","width=550,height=300,scrollbars=YES") 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>


  <form id="form1" name="form1" method="post" >
    <p align="center"><span class="normalmid"><a href="javascript:ventanaSecundaria7('/sima/ADMINHOSPITALARIAS/inventarios/catalogoPatente.php')">PAT
	</a>
	</span>
	---
	    
	<span class="normalmid"><a href="javascript:ventanaSecundaria7('/sima/ADMINHOSPITALARIAS/inventarios/catalogoGenericos.php')">GEN
	</a>	</span>
	---

    <span class="normalmid"><a href="javascript:ventanaSecundaria7('/sima/ADMINHOSPITALARIAS/inventarios/catalogoMateriales.php')">MAT
	</a>	</span>
	---

    <span class="normalmid"><a href="javascript:ventanaSecundaria7('/sima/ADMINHOSPITALARIAS/inventarios/catalogoVarios.php')">VARIOS
	</a>	</span>
	---

    <span class="normalmid"><a href="javascript:ventanaSecundaria7('/sima/ADMINHOSPITALARIAS/inventarios/catalogoMateriales.php')">CONT
	</a>	</span>	</p>
    <p align="center" class="normal"><a href="javascript:ventanaSecundaria17('ventanaAgregarArticulos.php?proveedor=<?php echo $_GET['proveedor'];?>&id_factura=<?php echo $_GET['id_factura'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>')">CARGAR ARTICULOS </a></p>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <table width="807" border="0" align="center" class="normal" style="border: 1px solid #000000;">
      <tr>
        <td width="68" height="19" class="Estilo5" scope="col"><div align="center" class="normal">
            <div align="left" class="normal">
              <div align="left">keyPA</div>
            </div>
        </div>
        </div></td>
        <td width="283" class="normal" scope="col"><div align="center" class="normal">
          <div align="left" class="normal">
            <div align="left">Descripci&oacute;n</div>
          </div>
        </div></td>
        <td width="63" class="normal" scope="col"><span class="normal">Existencia</span></td>
        <td width="80" class="normal" scope="col"><span class="normal">C</span></td>
        <td width="91" class="normal" scope="col"> <div align="left" class="normal">
            <div align="left"> Costo Unit</div>
        </div></td>
        <td width="86" class="normal" scope="col"> IVA </td>
        <td width="86" class="normal" scope="col"><div align="left" class="normal">
          <div align="left"> Sugerido</div>
        </div></td>
        <td width="35" class="normal" scope="col"><span class="normal">Actual</span></td>
        <td width="48" class="normal" scope="col"><div align="center" class="normal">
            <div align="center">Eliminar</div>
        </div></td>
      </tr>
<?php	
$sSQL= "SELECT  
* 
FROM OC
WHERE
entidad='".$entidad."'
and
numFactura='".$_GET['id_factura']."'

";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
    $a+=1;
$bandera+=1;
$bandera1+=1;
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
keyPA='".$myrow['keyPA']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL4= "
SELECT 
razonSocial
FROM
proveedores
WHERE
entidad='".$entidad."'
and

 id_proveedor = '".$myrow['id_proveedor']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

$sSQL39d= "
	SELECT 
*
FROM
precioArticulos
WHERE keyPA='".$myrow['keyPA']."' order by keyC DESC";
$result39d=mysql_db_query($basedatos,$sSQL39d);
$myrow39d = mysql_fetch_array($result39d);

$sSQL39e1= "
	SELECT 
existencia,cantidadTotal
FROM
existencias
WHERE 
entidad='".$entidad."'
    and
almacen='".$_GET['departamento']."'
and
keyPA='".$myrow['keyPA']."' ";
$result39e1=mysql_db_query($basedatos,$sSQL39e1);
$myrow39e1= mysql_fetch_array($result39e1);


$sSQL39e= "
	SELECT 
tasaGP,descripcionGP
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$myrow12['gpoProducto']."'";
$result39e=mysql_db_query($basedatos,$sSQL39e);
$myrow39e = mysql_fetch_array($result39e);

if($myrow39e['tasaGP']>0){
$iva[0]+=($myrow['precioUnitario']*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01);
}


if($myrow['keyPA']){
$importeFactura[0]+=$myrow['precioUnitario']*$myrow['cantidad'];
}


if($myrow['descuentoPorcentaje']>0){
$descuentoTotal[0]+=    $myrow['importeDescuento']*$myrow['cantidad'];
$descuentoIva[0]+=$myrow['ivaDescuento']*$myrow['cantidad'];
}



if($myrow['notaCredito']=='si'){
$notaCredito[0]+=$myrow['precioUnitario']*$myrow['cantidad'];
}
//***************************


//*************
?>

    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor='#ffffff'" >
      <tr>




        

        <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
        <td height="21" bgcolor="<?php echo $color;?>" class="normal"><?php echo $myrow['keyPA'];?></td>
        <td bgcolor="<?php echo $color;?>" class="normal">
		<?php 
		echo $myrow['descripcionArticulo']; 
		echo '<br>';
		
		if($myrow['status']=='notaCredito'){
		echo '<span class="codigos">[Nota de Credito]</span>';		
		}
		
		if($myrow['gpoProducto']!=NULL){
		echo '<br>';
		echo '<span class="normal">['. 		$myrow39e['descripcionGP']      .']</span>';		
        }
        
        if($myrow['descuentoPorcentaje']>0){
   
		echo '<span class="codigos">Tiene un '.$myrow['descuentoPorcentaje'].'% de descuento</span>';	
        }
		?>
		  <input type="hidden" name="keyR[]" id="keyR[]" value="<?php echo $myrow['keyR'];?>" />
          <input type="hidden" name="keyPA[]" id="keyPA[]" value="<?php echo $myrow['keyPA'];?>" /></td>
          
        
        
        <td bgcolor="<?php echo $color;?>" class="normal">
        <?php echo $myrow39e1['cantidadTotal'];?>
        </td>
        
        
        
        <td bgcolor="<?php echo $color;?>" class="normal">
		
		<input name="cantidad[]" type="text" id="cantidad[]" size="3" value="<?php echo $myrow['cantidad']; ?>"  autocomplete="off" <?php  if($myrow['status']=='notaCredito')echo 'readonly=""';?>/>		</td>
        <td bgcolor="<?php echo $color;?>" class="normal"><label>
         
		 <input name="costo[]" type="text" id="costo[]" size="6" value="<?php echo $myrow['precioUnitario']; ?>" autocomplete="off"  <?php  if($myrow['status']=='notaCredito')echo 'readonly=""';?>/>
		 
        </label></td>
        <td bgcolor="<?php echo $color;?>" class="normal">
		<?php echo '$'.number_format(($myrow['precioUnitario']*$myrow['cantidad'])*($myrow39e['tasaGP']*0.01),2);?>
		</td>
        <td bgcolor="<?php echo $color;?>" class="normal">
		
		<input name="precioSugerido[]" type="text" id="precioSugerido[]" size="6" value="<?php echo $myrow['precioSugerido']; ?>" autocomplete="off" <?php  if($myrow['status']=='notaCredito')echo 'readonly=""';?>/>		</td>
        <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><span class=""> <a  href="javascript:ventanaSecundaria2('/sima/cargos/listaAlmacenes.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow['keyPA']; ?>')"> <img src="/sima/imagenes/btns/precio.png" alt="Almacenes" width="20" height="20" border="0" /></a></span></div></td>
        <td bgcolor="<?php echo $color;?>" class="normal"><div align="center">
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&amp;keyR=<?php echo $myrow['keyR'];?>&id_factura=<?php echo $_GET['id_factura'];?>&proveedor=<?php echo $_GET['proveedor'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>&id_proveedor=<?php echo $_GET['proveedor'];?>&importeFactura=<?php echo $_GET['importeFactura'];?>&ivaFactura=<?php echo $_GET['ivaFactura'];?>"> <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar <?php echo $myrow['descripcion']; ?>?') == false){return false;}" /></a></div></td>
      </tr>
      <?php } //cierra while
	
	  ?>
    </table>
    <p>&nbsp;</p>
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
	if(!$_GET['ivaFactura'])$_GET['ivaFactura']=0.00;
$myrow39es['importeFactura']=$_GET['importeFactura'];
$myrow39es['ivaFactura']=$_GET['ivaFactura'];
	?>
	
	
	 
    <table width="471" border="0" align="center" class="normal" style="border: 1px solid #000000;">
      <tr>
        <td width="15">-</td>
        <td width="118">Importe Factura </td>
        <td width="73"><?php echo '$'.number_format($myrow39es['importeFactura'],2);?></td>
        <td width="21">-</td>
        <td width="133">Importe Captura </td>
        <td width="71"><?php echo '$'.number_format($importeFactura[0]+$notaCredito[0],2);?></td>
      </tr>
      <tr>
        <td>-</td>
        <td>Iva Factura </td>
        <td><?php echo '$'.number_format($myrow39es['ivaFactura'],2);?></td>
        <td>-</td>
        <td>Iva Captura </td>
        <td><?php echo '$'.number_format($iva[0],2);?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Total Factura </td>
        <td><?php echo '$'.number_format($myrow39es['importeFactura']+$myrow39es['ivaFactura'],2);?></td>
        <td>&nbsp;</td>
        <td>Total Captura </td>
        <td><?php echo '$'.number_format(($importeFactura[0]+$iva[0])+$notaCredito[0],2);?></td>
      </tr>
        
          <tr>
        <td>&nbsp;</td>
        <td>Descuento</td>
        <td><?php 
        if($descuentoTotal[0]>0){
        $importeDescuento=($importeFactura[0]-$descuentoTotal[0])+($iva[0]-$descuentoIva[0]);
        
        echo '$'.number_format(($importeFactura[0]-$descuentoTotal[0])+($iva[0]-$descuentoIva[0]),2);
        }else{
            echo '$'.number_format("0",2);
        }
        ?></td>
        <td>&nbsp;</td>
        
      </tr>    
        
        
      <tr>
        <td colspan="6">
		<div align="center">
		<?php $total=(($myrow39es['importeFactura']+$myrow39es['ivaFactura'])-(($importeFactura[0]+$iva[0])+$notaCredito[0])+$importeDescuento); 
		
		?>
		
		
<?php
  if($total>-1 and $total<1){
  $total=0;
  }

 if($total>0 )	{ ?>	
<a href="#" 
onclick="javascript:ventanaSecundaria7('notaCredito.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow3['folioVenta'];?>&req=<?php echo $_GET['req'];?>&id_proveedor=<?php echo $_GET['proveedor'];?>&importe=<?php echo $total;?>&id_factura=<?php echo $_GET['id_factura'];?>') ">
<?php 	echo '$'.number_format($total,2);?>
</a>
<?php }else{ 
echo '$'.number_format($total,2);
}
?>
		</div></td>
      </tr>
    </table>
    <p align="center">&nbsp;</p>
    <p align="center"><label></label>
    </p>

    <div align="center">
      <label>
      <input name="update" type="submit" id="update" value="Actualizar Datos" />
      
      <br />
      <?php $total= number_format($total,2);

	  if(($total>-1 and $total<1) and $a>0){ ?>
      <input name="send" type="submit" src="../../imagenes/btns/sendsolicitud.png" id="send" value="Enviar Solicitud" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas enviar la solicitud?') == false){return false;}"  <?php if($total>1 ){ echo 'disabled=""';}?>/>
       <?php } ?>
	  </label>
      <label>
    
      </label>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </form>
  <p>&nbsp;    </p>
  <p><script>
		new Autocomplete("descripcion", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("keyPA")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/articulosx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>
</body>
</html>
