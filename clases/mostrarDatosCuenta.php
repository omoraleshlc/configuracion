
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<div align="center">
<span >Opciones de Grupo de Producto: </br></span>
      <?php   $sSQL7= "Select gpoProducto From cargosCuentaPaciente
          where entidad='".$entidad."'
             and
             folioVenta='".$_GET['folioVenta']."'
                 and
                 gpoProducto!=''
      group by gpoProducto";

$result7=mysql_db_query($basedatos,$sSQL7);
echo mysql_error();
	  ?>
          <select name="gpoProducto1"  id="gpoProducto1" onChange="this.form.submit();" >
		  <option value="">Todos</option>
            <?php
		   while($myrow7 = mysql_fetch_array($result7)){

                       $sSQL78="SELECT *
                            FROM
                                gpoProductos
                                WHERE
                                    entidad = '".$entidad."'
                                    and
                                codigoGP='".$myrow7['gpoProducto']."'
                                ";
                            $result78=mysql_db_query($basedatos,$sSQL78);
                            $myrow78 = mysql_fetch_array($result78);
                       ?>

            <option
		    <?php 		if($_POST['gpoProducto1']==$myrow7['gpoProducto'])echo 'selected'; ?>
		   value="<?php echo $myrow7['gpoProducto']; ?>"><?php echo $myrow78['descripcionGP'] ?></option>
            <?php }

		?>
          </select>
<p></p>
    

<table width="784" class="table table-striped" >

    <tr >
      <th width="22"   scope="col"><div align="center">#</div></th>
      <th width= "64"   scope="col"><div align="center"># Reg</div></th>
      <th width= "52"   scope="col"><div align="center">Fecha</div></th>
      <th width= "26"   scope="col"><div align="center">C</div></th>
      <th width= "217"   scope="col"><div align="center">Descripcion</div></th>
      <th width= "121"   scope="col"><div align="center">Totales</div></th>
      <th width= "29"   scope="col"><div align="center">N</div></th>
      <th width= "68"   scope="col">Part</th>
      <th width= "68"   scope="col">Benef</th>
	  <th  width= "43"  scope="col"><div align="center">Aseg</div></th>
	  </tr>
    <tr>



<?php	


$q = "DELETE FROM reportesTemporales
where
entidad='".$entidad."'
and
usuario='".$usuario."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();

if ($_POST['gpoProducto1']==null){
$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'


";}

else {
$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
    and
    gpoProducto='".$_POST['gpoProducto1']."'


";
}


if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$a+=1;
$nT=$myrow['keyClientesInternos'];
if($myrow['naturaleza']=='A'){
$signo='-';
}else{
$signo=NULL;
}



//   
?>


 <tr  >
      <td height="24"  ><?php print $a;?></td>
      <td width="64"   align="center"><?php
	echo $myrow['keyCAP'];
	   ?></td>
      <td width="52"  ><?php
	echo cambia_a_normal($myrow['fecha1']);
	   ?></td>
      <td width="26"  ><div align="center">
        <?php
	echo round($myrow['cantidad'],3);
	//echo $myrow['cantidad'];
        ?>
      </div></td>
      <td width="217"  ><?php
		
		echo '<span >';
       echo $myrow['descripcionArticulo'];
	   echo '</span>';
	   if($myrow['tipoPaciente']!='externo'){
	   if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=''){
echo '</br><div >'.'Devolucion, folio: '.$myrow['folioDevolucion'].'</div>';

}
}

if($myrow['gpoProducto']!=''){
	   if($myrow['statusCargo']=='cargado' ){
echo '</br><div >'.'[ '.$myrow['statusCargo'].']'.' a las '.'[ '.$myrow['horaCargo'].']'.' </div>Solicitado por: '.'[ '.$myrow['usuario'].']';
	}else{
	echo '</br><div ><blink>'.'*************** FAVOR DE SURTIR ********'.'</blink></div>';
	}
	}else{
	echo '</br><div >'.'[ Transaccion]'.'</div>';
	}
	
			   $sSQL341c= "Select descripcionGP From gpoProductos WHERE  entidad='".$entidad."' and codigoGP='".$myrow['gpoProducto']."'";
$result341c=mysql_db_query($basedatos,$sSQL341c);
$myrow341c = mysql_fetch_array($result341c);   
echo '</br>';
	   echo '- '.$myrow341c['descripcionGP'].' -';
echo '</br>';	
	
if($myrow['statusDescuentoGlobal']=='si'){
echo '</br><span >'.' ['.$myrow['descripcionDescuentoGlobal'].']'.'</span>';
}

if($myrow['facturacionEspecial']=='si'){
echo '</br><span >'.' ['.$myrow['descripcionSeguroFacturacion'].']'.'</span>';
}



//***********************************ALMACENES**********************************
$sSQL341cs= "Select * From almacenes WHERE  entidad='".$entidad."' and almacen='".$myrow['almacenSolicitante']."'";
$result341cs=mysql_db_query($basedatos,$sSQL341cs);
$myrow341cs = mysql_fetch_array($result341cs);  


$sSQL341ca= "Select * From almacenes WHERE  entidad='".$entidad."' and almacen='".$myrow['almacenDestino']."'";
$result341ca=mysql_db_query($basedatos,$sSQL341ca);
$myrow341ca = mysql_fetch_array($result341ca);  

if($myrow['gpoProducto']!=''){
echo '</br><span >'.' ['.$myrow341cs['descripcion'].'  >  '.$myrow341ca['descripcion'].'] '.'</span>';
}
//********************************************************************************************



if($myrow['numRecibo']){ ?>
</br><span > Recibo: </span>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

<?php 
}
	
	

if($myrow['naturaleza']=='-'){ ?>
</br><span > Cancelar </span>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

<?php 
}
	



	
	
	
	
	
if($myrow['gpoProducto']!=''  and $usuario){
$sSQLa= "
SELECT *
FROM
reportesTemporales
WHERE 
entidad='".$entidad."' 
and
usuario='".$usuario."'  
and
codigoGP='".$myrow['gpoProducto']."'   ";
 
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);



  $agrega = "INSERT INTO reportesTemporales (
gpoProducto,importe,entidad,usuario,random,codigoGP,naturaleza,folioVenta
) values (
'".$myrow341c['descripcionGP']."',
'".$myrow['precioVenta']*$myrow['cantidad']."',
'".$entidad."','".$usuario."','".$random."','".$myrow['gpoProducto']."','".$myrow['naturaleza']."','".$_GET['folioVenta']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

}	
	   ?>



<?php if($myrow['naturaleza']=='-'){ ?>
</br><span > 
	  <a href="javascript:ventanaSecundaria10('/sima/cargos/ventanaEditar.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','500','200','yes');">
Editar</a>
<?php } ?>

</span>
	   <hr />
      </td>

      <td width="121"  ><div align="center">
<?php
echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);
?>
      </div></td>
      <td width="29"  ><div align="center">
        <?php
echo $myrow['naturaleza'];

?>
      </div></td>
      
      
      
      
      <td width="68"  ><div align="center">

  <span >
<?php

$triggerParticular=(float) ($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);

?>
</span>
      </div></td>
      
      
           <td width="68"  ><div align="center">

  <span >
<?php

$triggerBeneficencia=(float) ($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']);
echo '$'.number_format(($myrow['cantidadBeneficencia']*$myrow['cantidad'])+($myrow['ivaBeneficencia']*$myrow['cantidad']),2);

?>
</span>
      </div></td> 
      
      
      
      

<td width="43"  ><div align="center">
  <span >
  <?php
$triggerAseguradora=(float) ($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);  
  
echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
?>
</span>


</div></td>
</tr> 

<?php require('/configuracion/clases/operacionesGlobales.php');?>

    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
	</p>	
  </div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <p>
 <?php require('/configuracion/clases/mostrarTotalesEC.php');?> 
  </p>
  
  
  <table width="312"   style="border: 1px solid #CCC;">
    <tr>
      <th width="212"   scope="col"><div align="left">Descripci&oacute;n</div></th>
      <th width="62"   scope="col"><div align="left">Importe</div></th>

    </tr>
    <tr>
<?php





$sSQL= "
SELECT gpoProducto
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and gpoProducto!=''
group by gpoProducto
 ";





if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];
$i+=1;



$sSQLac= "
SELECT sum(importe) as cargo
FROM
reportesTemporales
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
codigoGP='".$myrow['gpoProducto']."'
and
naturaleza='C'

  ";

$resultac=mysql_db_query($basedatos,$sSQLac);
$myrowac = mysql_fetch_array($resultac);
$sSQLaa= "
SELECT sum(importe) as abono
FROM
reportesTemporales
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
codigoGP='".$myrow['gpoProducto']."'
and
naturaleza='A'
 ";

$resultaa=mysql_db_query($basedatos,$sSQLaa);
$myrowaa = mysql_fetch_array($resultaa);

$sSQLaa1= "
SELECT *
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and codigoGP='".$myrow['gpoProducto']."'
order by descripcionGP ASC
 ";

$resultaa1=mysql_db_query($basedatos,$sSQLaa1);
$myrowaa1 = mysql_fetch_array($resultaa1);
?>
      <td   ><div align="left"><span > <?php echo $myrowaa1['descripcionGP']; ?></span></div></td>
      <td   align="right" ><?php

          echo "$".number_format($myrowac['cargo']-$myrowaa['abono'],2);
           ?></td>
    </tr>
    <?php }}?>

            <td  align="right" >
                IVA:
                <?php
                  echo "$".number_format($ivaTotal,2);
           ?></td>
  </table>


  






    <p align="center">





 <input type="hidden" name="variable_php" id="variable_php" />

</form>

<p align="center">&nbsp;</p>
<script languaje="JavaScript">            
              document.form1.variable_php.value=varjs;
</script>
<?php
//***************SOLO MOSTRAR

$q = "DELETE FROM reportesTemporales
where
entidad='".$entidad."'
and
usuario='".$usuario."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
 ?>
