<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<?php 







if($_POST['insertarArticulos'] ){
$keyCAP=$_POST['keyCAP'];
$random=$_GET['random'];
for($i=0;$i<=$_POST['bandera'];$i++){
//***************************************COMPRUEBA CANTIDAD*************************************
if($keyCAP[$i]){
$sSQL361a= "Select cantidad From cargosCuentaPaciente WHERE 
keyCAP='".$keyCAP[$i]."' ";
$result361a=mysql_db_query($basedatos,$sSQL361a);
$myrow361a = mysql_fetch_array($result361a);
echo mysql_error();



if($myrow361a['cantidad']==1){

 $qaa = "
UPDATE 
cargosCuentaPaciente 
set 
statusCargo='cargado',
random='".$random."'
WHERE 
keyCAP='".$keyCAP[$i]."' ";

mysql_db_query($basedatos,$qaa);
echo mysql_error();


} else {

 $qaa = "
UPDATE 
cargosCuentaPaciente 
set 
statusCargo='cargadoR',
cantidad=cantidad-1,
random='".$random."'
WHERE 
keyCAP='".$keyCAP[$i]."' ";
mysql_db_query($basedatos,$qaa);
echo mysql_error();

}
}//cierra if
}//cierra for
//********************************************************************************





//****************SI NO HAY YA cargosCuentaPaciente CARGO STANDBY QUITO EL ALMACEN*************
$sSQL361= "Select status From cargosCuentaPaciente WHERE 
folioVenta='".$_GET['folioVenta']."' 
and
statusCargo='cargadoR'
and
almacenDestino='".$_GET['almacen']."'
";
 $result361=mysql_db_query($basedatos,$sSQL361);
$myrow361 = mysql_fetch_array($result361); 
echo mysql_error();


if(!$myrow361['status']){
$qAb = "UPDATE almacenesPaquetes set 
status='cargado'
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."' 
and
id_almacen='".$_GET['almacen']."'
";
mysql_db_query($basedatos,$qAb);
echo mysql_error();
}





//********************ABRO IMPRESIONES*****************
?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosPaq.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $_GET['keyClientesInternos'];?>&entidad=<?php echo $entidad;?>&usuario=<?php echo $usuario;?>&keyCAP=<?php echo $myrow333['keyCAP'];?>&random=<?php echo $random;?>&departamento=<?php echo $_GET['almacen'];?>&codigoPaquete=<?php echo $_POST['codigoPaquete'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>');
window.opener.document.forms["form1"].submit();
</script>
<?php 
//*****************************************************
}


?>



<?php 


$sSQL311= "Select  * From clientesInternos WHERE folioVenta='".$_GET['folioVenta']."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);


$sSQL31= "Select  * From paquetesPacientes WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$codePackage=$myrow31['codigoPaquete'];

$paciente=$myrow31['nombre1']." ".$myrow31['nombre2']." ".$myrow31['apellido1']." ".$myrow31['apellido2']." ".$myrow31['apellido3'];

if($myrow311['paciente']){
$paciente=$myrow311['paciente'];
}













?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$estilos=new muestraEstilos();
$estilos-> styles();
?>


</head>

<body>


  <label></label>
  <form id="form2" name="form2" method="post" action="" >
  <table width="546" border="0" align="center">

    <tr>
      <th colspan="2"  scope="col"><div align="center" >
        <p>Cargos a Pacientes con Paquetes<br />
            <br />
          </p>
      </div></th>
    </tr>
	  <tr  >
      <th width="101" scope="col"><div align="left" class="negro">Paciente: </div></th>
      <th width="435"  scope="col"><div align="left" class="camposmid"><?php echo $paciente; ?>
      </div></th>
    </tr>
    <tr>
      <th  scope="col"><div align="left" class="negro">Paquete</div></th>
      <th  scope="col"><div align="left" id="mostrar"><strong> </strong>




          <input name="codigoPaquete" type="hidden"  id="medico"  value="<?php 
			 if($_POST['codigoPaquete']){
			  echo $_POST['codigoPaquete'];
			  } else {
			  echo $myrow31['codigoPaquete'];
			  }
			  			  ?>" readonly=""/>
          <!-- div que mostrara la lista de coincidencias -->
          <label></label>
      <?php echo $myrow31['codigoPaquete'];?>
      </div></th>
    </tr>
  </table>
  <p align="center"><span ><span >
  <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
  </span></span>
    <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />
    <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
    <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
    <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
    <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
    <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
    <span class="style15"><?php echo $leyenda; ?></span>  </p>
	
	
	

    <table width="608" class="table table-striped">
      <tr>
        <th width="39" height="19"  scope="col"><div align="left" >Cant.</div></th>
        <th width="361"  scope="col"><div align="left" >Descripci&oacute;n</div></th>
        <th width="49"  scope="col"><div align="left" >Precio</div></th>
        <th width="45"  scope="col"><div align="left" >Iva</div></th>
      
        <th width="20"  scope="col"><div align="left" >C</div></th>
        <th width="17"  scope="col"><div align="left" >D</div></th>
        <th width="47"  scope="col"><div align="left" >Status</div></th>
      </tr>
	  

	  
      <tr>
<?php 
if(!$_GET['almacenSolicitud']){
$_GET['almacenSolicitud']=$_GET['almacenDestino'];
}



if(($_POST['mostrar'] and $_POST['despliegaArticulo']) || $myrow311['folioVenta']){


$sSQL= "Select * From articulosPaquetes WHERE 
codigoPaquete='".$codePackage."'
and
almacen='".$_GET['almacenSolicitud']."'
";




$sSQL= "Select * From cargosCuentaPaciente WHERE 
keyCAP='".$_GET['keyCAP']."'
";




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

$almacen=$myrow['almacen'];
$bandera+="1";
$code1=$myrow['codProcedimiento'];
$codigo=$myrow['codProcedimiento'];
//*************************************CONVENIOS********************************************



//cierro descuento

if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;

}


$sSQL31= "Select nivel1 From articulosPrecioNivel WHERE 
entidad='".$entidad."'
and
codigo = '".$codigo."' 
and
almacen='".$_GET['almacenSolicitante']."'
";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31); 


$sSQL3145= "Select status,cantidad From articulosPaquetesPacientes WHERE 
keyE='".$myrow['keyE']."'
and
keyClientesInternos='".$myrow311['keyClientesInternos']."' 


";
$result3145=mysql_db_query($basedatos,$sSQL3145);
$myrow3145 = mysql_fetch_array($result3145); 

?>	
<input name="keyEs[]" type="hidden" id="keyEs[]" value="<?php echo $myrow['keyE']; ?>" />
        <td height="24" align="center" bgcolor="<?php echo $color;?>" ><?php echo $myrow['cantidad']; ?></td>
        <td bgcolor="<?php echo $color;?>"  >
		<?php 
		
		$sSQL314= "Select almacenPadre,descripcion From almacenes WHERE almacen = '".$myrow['almacen']."'  and medico='si'";
$result314=mysql_db_query($basedatos,$sSQL314);
$myrow314 = mysql_fetch_array($result314);

echo $myrow314['descripcion'];

		?>
		<?php 
		
		if($myrow31['ventaPaquete']=='si'){
		echo "<span class='style1'>".' [Artículo Cargado]'.'</span>';	
$pVC[0]+=$precioVenta->precioVenta($paquete,$_POST['generico'],$cantidad,$numeroPaciente,$nCuenta,$myrow['codigo'],$almacen,$basedatos);	
		} 
		?>
		
		
              		<?php if( $myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
		
		<?php if( $myrow3145['status']=='cargado'){echo '<span class="Estilo25">'.' [Articulo Cargado]'.'</span>';}?>
		
        </span>		<span >
        <input name="cantidad[]" type="hidden" id="cantidad[]" value="<?php  echo $myrow['cantidad']; ?>" />
        <span >
        <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
        <input name="almacenDestino[]" type="hidden" id="almacenDestino[]" value="<?php  echo $myrow['almacen']; ?>" />
        </span></span></td>
        <td bgcolor="<?php echo $color;?>" >
          <?php 


echo "$".number_format($myrow['precioVenta'],2);
$pV[0]+=$myrow['precioVenta'];
?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="negro">
<?php 
echo "$".number_format($myrow['iva'],2);
$ivas[0]+=$myrow['iva'];
?>
        </span></td>
		
<?php 
$statusExistencias=new articulosDetalles();
$statusExistencias->statusExistencias($entidad,$myrow['servicio'],$almacen,$myrow['codigo'],$basedatos);
?>


        <td bgcolor="<?php echo $color;?>" ><div align="left">
          <input name="keyCAP[]" type="checkbox"  value="<?php  echo $myrow['keyCAP']; ?>" <?php 
		if($myrow['statusCargo']=='cargado'){ echo 'disabled=""';}?>  onclick="Disable(this,'insertarArticulos')" /> 
        </div></td>
        <td bgcolor="<?php echo $color;?>" ><?php 
		if($statusExistencias->statusExistencias($myrow['servicio'],$almacen,$myrow['codigo'],$basedatos)=='disabled') { 
		$banderaDisabled='disabled';
		echo '<img src="/sima/imagenes/pregunta.png" width="12" height="12" alt="NO HAY EXISTENCIAS" />';
		} else {
		echo '<img src="/sima/imagenes/ok.jpeg" width="12" height="12" alt="OK" />';
		}
		?></td>
        <td bgcolor="<?php echo $color;?>" >
		<label>
		<?php 
		if($myrow['statusCargo']=='cargado'){
		echo $myrow['statusCargo'];
		$incrementa+=1;
		} else {
		echo '---';
		}
		?>
		</label>		</td>
      </tr>
<input name="mostrar" type="hidden"  id="mostrar" value="<?php echo $incrementa;?>" />
<input name="desplegarArticulo" type="hidden"  id="mostrar" value="<?php echo $_POST['desplegarArticulo'];?>" />
      <?php }?>
    </table>




    
       
      
    <p align="center">
<?php if($bandera>=1 and $bandera!=$incrementa){ 

?>
      <input name="insertarArticulos" type="image" src="/sima/imagenes/btns/addarticles.png" id="insertarArticulos" 
	  value="Agregar Articulos" />
	  <?php }} ?>
    
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
   
   
   
   <?php 
   if($_POST['mostrar']){ ?>
    <input name="despliegaArticulo" type="hidden"   size="60" readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaArticulo']){ echo $_POST['despliegaArticulo'];} else { echo "";}?>"/>

          <input name="mostrar" type="hidden"  id="mostrar" value="&gt;" />
		 <?php }?>
  </form>

     
</body>
</html>
