<?php 
if($_GET['almacen']){
$ALMACEN=$_GET['almacen'];
} else {
$_GET['almacen']=$ALMACEN;
}

?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=150,height=200,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 



<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.numeroEx.value) == false ) {   
                alert("Por Favor, ingresa el expediente!")   
                return false   
        }            
}   
  
</script> 



<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=800,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 





<?php include("/configuracion/funciones.php"); ?>
<?php 


if($_POST['cargosPaquetes'] AND $_POST['keyClientesInternos'] AND $_POST['paciente']){
?>


<script language="JavaScript" type="text/javascript">
ventanaSecundaria20('/sima/cargos/agregaArticulosPaquetes.php?almacen=<?php echo $_GET['almacen']; ?>&numeroE=<?php echo $_POST['numeroEx']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $_GET['almacen']; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos'];?>&almacenSolicitud=<?php echo $_GET['almacenSolicitud'];?>&folioVenta=<?php echo $_POST['keyClientesInternos']; ?>');
close();
</script>


<?php 

}
?>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

<head>








<body>
<?php 


$sSQL39= "SELECT descripcion
FROM
almacenes
where 
entidad='".$entidad."' AND
almacen='".$ALMACEN."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
?>
<h1 align="center" class="titulos">Nota de Venta de Paquetes </h1>
<form id="form1" name="form1" method="post" action="#">

    <table width="565" class="table-forma">
      <tr>
        <td colspan="4"   scope="col"><?php echo '[ '.$myrow39['descripcion'].' ]'; ?></td>
      </tr>
      <?php  ?>
      
     
      <tr valign="middle">
        <td  scope="col"><div align="left"></div></td>
        <td  scope="col"><div align="left" >No. Referencia </div></td>
        <td width="391" colspan="2" valign="bottom"  scope="col"><div align="left">
	
<input name="keyClientesInternos" type="text"  id="keyClientesInternos" value="<?php echo $_POST['keyClientesInternos'];?>" size="15" readonly="" />
		
          <input name="edad" type="hidden"  id="edad" value="<?php 
		  if($_POST['edad'] and !$_POST['nuevo']){
		  echo $_POST['edad'];
		  } else if($myrow33['edad'] and !$_POST['nuevo']){
		  echo $myrow33['edad']; 
		  }
		  ?>" size="2" maxlength="2"/>
          <label>
          <input name="fechaNac" type="hidden"  id="fechaNac" size="10"  readonly="" value="<?php 
		  if($_POST['fechaNac'] and !$_POST['fechaNac']){
		  echo $_POST['fechaNac'];
		  } 
		  ?>"/>
          </label>
          <span >
          <input name="paquete" type="button" id="paquete"  onClick="javascript:ventanaSecundaria6(
		'/sima/cargos/ventanaCargaArticulosPaquetes.php?campoDespliega=<?php echo "paciente"; ?>&forma=<?php echo "form1"; ?>&campo=<?php echo "folioVenta"; ?>&fechaNac=<?php echo "fechaNac"; ?>&edad=<?php echo "edad"; ?>&almacen=<?php echo $ALMACEN; ?>')" value="EPAQ" src="/sima/imagenes/btns/searcharticles.png" align="bottom" />
          </span><br>
        </div></td>
      </tr>

      <tr>
        <td width="1"  scope="col">&nbsp;</td>
        <td width="157"  scope="col"><div align="left" ><strong>Paciente: </strong></div></td>
      <td colspan="2"  scope="col"><div align="left"><strong>
            <label> </label>
            </strong>
			
			
			 <?php if($myrow4['numeroE']){ ?>
			            <input name="paciente" type="text"  id="paciente" value="<?php 
		echo $myrow4['paciente'];
		  ?>" size="60" readonly=""  />   
			 <?php } else { ?>
            <input name="paciente" type="text"  id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="60" readonly=""  />                
          <span ><span c><span ><a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span> </span></div></td>
		  <?php } ?>
      </tr>
      
     
 
   
  
    
    
      <tr>
        <td  scope="col">&nbsp;</td>
        <td  >Motivo Consulta</td>
        <td colspan="2" ><textarea name="observaciones" cols="60" rows="3"  id="observaciones"></textarea></td>
      </tr>
  

   
	  
	  
	  
      <tr>
        <td height="36" colspan="5"  scope="col"><?php 
$sSQL1= "Select * From clientesInternos WHERE usuario = '".$usuario."' order by keyClientesInternos DESC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
          <p>
            <input name="fechaSolicitud" type="hidden"  id="nuevo" value="<?php echo $_GET['fechaSolicitud'];?>" />
            <input name="horaSolicitud" type="hidden"  id="nuevo" value="<?php echo $_GET['horaSolicitud'];?>" />
            <input name="cargosPaquetes" type="submit" src="/sima/imagenes/btns/agregacargos.png" id="boton" value="Agregar Cargos" />
            </p>
          </p>
        <div align="center"><strong>
            <input name="almacenImporte" type="hidden" id="almacenImporte" value="<?php echo $_POST['almacenImporte']; ?>"/>
            </strong>
            <input name="ali" type="hidden" id="ali" value="<?php echo $ali; ?>"/>
            <input name="pacientes" type="hidden" id="pacientes" value="<?php echo $_POST['paciente']; ?>" />
            <input name="PACIENTED" type="hidden" id="PACIENTED" value="<?php echo $_POST['paciente']; ?>" />
            <input name="FOLIOD" type="hidden" id="PACIENTED" value="<?php echo $Folio[0]; ?>" />
            <input name="keyClientesI" type="hidden" id="FOLIOD" value="<?php echo $keyClientesI; ?>" />
            <input name="pagina" type="hidden" id="keyClientesI" value="<?php echo $pagina; ?>" />
            <input name="nOrden" type="hidden" id="pagina" value="<?php echo $nOrden; ?>" />
            <input name="folioVenta" type="hidden" id="nOrden" />
          </div></td>
      </tr>
  </table>

</form>
  
  
 </body>
</html>