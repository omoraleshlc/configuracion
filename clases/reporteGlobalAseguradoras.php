<?php 
class ECC{ 
public function estadoCuenta($entidad,$basedatos){
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript>
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=400,height=400,scrollbars=YES") 
} 
</script> 


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
           
        if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje un médico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje algún tipo de seguro, o también si es particular!")   
                return false   
        }            
}   
</script> 

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();

?>

</head>

<body>
 <h1 align="center" >Reporte Global Saldos de Clientes </h1>
 <p>
   <label></label>
 </p>
 <form id="form1" name="form1" method="post" action="">

   <p align="center" >Periodo</p>
   <p align="center" >Fecha Inicial
     <label>
       <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
       </label>
       <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" />
       <label></label>
     a la fecha
  <label>
  <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
  </label>
  <input name="button2" type="image"src="/sima/imagenes/btns/fecha.png" />
  <label> <br />
  <br />
  <input name="buscar" type="submit"  id="search" value="Buscar" />
  </label></p>
  
  
  <?php if($_POST['buscar']){ ?>
   <table width="691" class="table table-striped">

     <tr >
       <th width="39"  align="center">#  </th>
       <th width="327" >Descripcion</th>
       <th width="111" align="center" >Debe</th>
       
       <th width="115" align="center" >Haber</th>
       <th width="115" align="center" >Saldo</th>
     </tr>
	 
 <?php   
 $sSQL= "Select numCliente,nomCliente From clientes
 where entidad='".$entidad."' AND clientePrincipal='' and
 subCliente=''
 and
 tipoCliente='compania'
  order by nomCliente ASC";
$result=mysql_db_query($basedatos,$sSQL); 



while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$N=$myrow['numCliente'];




$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFFF99';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}




$sSQLc="SELECT sum(precioVenta*cantidad)  as cargos,sum(iva*cantidad) as ivaCargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and


clientePrincipal='".$myrow['numCliente']."'
and
(fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."')
and
tipoCuenta='H'
and
numMovimiento>0
and
gpoProducto=''

";
$resultc=mysql_db_query($basedatos,$sSQLc);
$myrowc = mysql_fetch_array($resultc);

$sSQLd="SELECT sum(precioVenta*cantidad) as devoluciones,sum(iva*cantidad) as devolucionesIVA

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and


clientePrincipal='".$myrow['numCliente']."'
and
(fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."')
and

tipoCuenta='D'
and
numMovimiento>0
and
gpoProducto=''

";
$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);

$debe[0]+=($myrowd['devoluciones']+$myrowd['devolucionesIVA']);
$haber[0]+=($myrowc['cargos']+$myrowc['ivaCargos']);

$saldoFinal[0]+=($myrowd['devoluciones']+$myrowd['devolucionesIVA'])-($myrowc['cargos']+$myrowc['ivaCargos']);
?>
     <tr  >
       <td   align="center"><?php echo $bandera;?></td>
       <td ><?php echo $myrow['nomCliente'];?></td>
       <td  align="center">
<?php echo '$'.number_format($myrowd['devoluciones']+$myrowd['devolucionesIVA'],2);?>
</td>
       <td  align="center">
	   <?php echo '$'.number_format($myrowc['cargos']+$myrowc['ivaCargos'],2);?>
	   </td>
       <td  align="center">
        <?php echo '$'.number_format(($myrowd['devoluciones']+$myrowd['devolucionesIVA'])-($myrowc['cargos']+$myrowc['ivaCargos']),2);?>
		</td>
     </tr>
     <?php }?>

   </table>
   <div align="center">
     <?php } ?></div>
   <table width="691" class="table table-striped">
     <tr>
       <th><span >TOTALES</span></th>
       <th width="107"><span ><?php echo '$'.number_format($debe[0],2);?></span></th>
       <th width="103"><span ><?php echo '$'.number_format($haber[0],2);?></span></th>
       <th width="106"><span ><?php echo '$'.number_format($saldoFinal[0],2);?></span></th>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p align="center">&nbsp;</p>
 
 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 

<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script>
</body>
</html>
<?php 
}
} 
?>