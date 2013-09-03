<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=900,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria66 (URL){ 
   window.open(URL,"ventanaSecundaria66","width=200,height=100,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria511 (URL){ 
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria511a (URL){ 
   window.open(URL,"ventanaSecundaria511a","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria511b(URL){ 
   window.open(URL,"ventanaSecundaria511b","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=300,scrollbars=YES") 
   
} 
</script>
<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=900,height=600,scrollbars=YES") 
} 
</script>



<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>



<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
$seguro=$_POST['seguro'];
$_GET['numeroE']=$_POST['numeroEx'];
if(!$ALMACEN){print  '<script>window.alert("Favor de asignar almacen en modulos secunarios, gracias!");</script>';}



$sSQLe= "SELECT 
ventas
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$ALMACEN."'   ";
$resulte=mysql_db_query($basedatos,$sSQLe);
$myrowe = mysql_fetch_array($resulte);
?>
<div align="center">
    <h1>VENTA AL PUBLICO</h1><br />
  
  <div id="ventaPublico">
  <h1><?php echo $_GET['warehouse'];?></h1>
  </div>
  <div id="ventaPublicoContent"> <br />
  
  <?php if($myrowe['ventas']=='si'){ ?>  
  
<a  onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqui para hacer notas de cargo..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo" id="nuevo" onclick="nueva('ventaParticulares.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria66','707','200','yes')">&nbsp;Particulares&nbsp;&nbsp;</a>|      
      
  <a  onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqui para hacer notas de cargo..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo" id="nuevo" onclick="nueva('ventaAseguradoras.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','900','500','yes')">&nbsp;Aseguradoras&nbsp;&nbsp;</a>|
  
  
  <a  onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqui para hacer notas de cargo..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo" id="nuevo" onclick="nueva('ventaEstudiantes.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','700','300','yes')">&nbsp;Estudiantes&nbsp;&nbsp;</a>|
  
 
 <a onmouseover="Tip('&lt;blink&gt;&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Este boton es para agregar cargos a pacientes que tienen un paquete..';?>&lt;/div&gt;&lt;/blink&gt;')" onmouseout="UnTip()" name="nuevo2" id="nuevo2" onclick="nueva('<?php echo $ventana1;?>?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','900','500','yes')">&nbsp;Pacientes por Paquetes&nbsp;&nbsp;</a>|
    
 <a onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para ver las notas de cargo y su estado actual..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo3" id="nuevo3"  onclick="nueva('<?php echo $ventana11;?>?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','900','500','yes')">&nbsp;Notas de cargo&nbsp;&nbsp;</a>|
  
  
  <a onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu� para ver los servicios recibidos..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo22" id="nuevo22"  onclick="nueva('/sima/cargos/aplicarServicios.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','900','500','yes')">&nbsp;Listado de Pacientes&nbsp;&nbsp;</a>|
    
    
<a onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para consultar saldos ..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo42" d="nuevo42" onclick="nueva('/sima/cargos/consultarSaldo.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','900','500','yes')">&nbsp;Consultar Saldos&nbsp;&nbsp;</a> |   
    

<a onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para consultar precios ..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo5" id="nuevo5" onclick="nueva('/sima/cargos/presupuestos.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria1','900','500','yes')">&nbsp;Consultar Precios&nbsp;&nbsp;</a>  |
    

       <?php }else{ echo 'Este  almacen no permite ventas!';}?>
  
  </div>



  
<?php   
  $sSQLu= "Select puntoVenta From almacenes where entidad='".$entidad."' and almacen='".$ALMACEN."'";
$resultu=mysql_db_query($basedatos,$sSQLu); 
$myrowu = mysql_fetch_array($resultu);
if($myrowu['puntoVenta']=='si') { ?>

  <p>
    <label>
   
    <input type="submit" name="button" id="button" value="Apertura de Caja" onclick="ventanaSecundaria511('/sima/INGRESOS HLC/caja/aperturaCajaModulos.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')" />
    </label>
   
   
    <input type="submit" name="button2" id="button2" value="Corte de Caja" onclick="ventanaSecundaria511a('/sima/INGRESOS HLC/caja/corteCajaModulo.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>')" />
    
    
    <input type="submit" name="button3" id="button3" value="Lista de Ordenes Pendientes" onclick="ventanaSecundaria511b('../ventanas/listadoOrdenesCaja.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&almacen=<?php echo $ALMACEN;?>')" />
  
  
  <input type="submit" name="button3" id="button3" value="Lista Cortes de Caja" onclick="ventanaSecundaria511b('../ventanas/reporteCajeros.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&almacen=<?php echo $ALMACEN;?>')" />
  
  
  
  </p>
  <?php }?>
  
  
  <p> 
</div>
